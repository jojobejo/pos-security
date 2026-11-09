CREATE TABLE IF NOT EXISTS docsdig_access (
    username VARCHAR(16) CHARACTER SET ascii COLLATE ascii_bin PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    CONSTRAINT docsdig_access_user FOREIGN KEY (user_id) REFERENCES tb_user (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS docsdig_documents (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    category VARCHAR(100) NOT NULL,
    document_number VARCHAR(100) DEFAULT NULL,
    description TEXT,
    issued_on DATE DEFAULT NULL,
    expires_on DATE DEFAULT NULL,
    recurrence ENUM('none', 'daily', 'weekly', 'monthly', 'yearly') NOT NULL DEFAULT 'none',
    reminder_days SMALLINT UNSIGNED NOT NULL DEFAULT 30,
    reminder_frequency ENUM('daily', 'weekly', 'monthly') NOT NULL DEFAULT 'daily',
    original_name VARCHAR(255) NOT NULL,
    storage_name CHAR(64) CHARACTER SET ascii COLLATE ascii_bin NOT NULL UNIQUE,
    mime_type VARCHAR(100) NOT NULL,
    version INT UNSIGNED NOT NULL DEFAULT 1,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY docsdig_category (category),
    KEY docsdig_expiry (expires_on)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS docsdig_audit (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    document_id INT UNSIGNED NOT NULL,
    actor_id INT NOT NULL,
    action VARCHAR(24) NOT NULL,
    previous_expiry DATE DEFAULT NULL,
    new_expiry DATE DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY docsdig_audit_document (document_id, action, id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS docsdig_reminder_reads (
    document_id INT UNSIGNED NOT NULL,
    user_id INT NOT NULL,
    occurrence CHAR(64) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
    PRIMARY KEY (document_id, user_id),
    CONSTRAINT docsdig_read_document FOREIGN KEY (document_id) REFERENCES docsdig_documents (id) ON DELETE CASCADE,
    CONSTRAINT docsdig_read_user FOREIGN KEY (user_id) REFERENCES tb_user (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

START TRANSACTION;

-- Bind the existing HRD2 account only when its username is unambiguous.
INSERT INTO docsdig_access (username, user_id)
SELECT 'HRD2', MIN(id) FROM tb_user WHERE username = 'HRD2'
HAVING COUNT(*) = 1 AND SUM(BINARY username = 'HRD2') = 1
ON DUPLICATE KEY UPDATE user_id = docsdig_access.user_id;

UPDATE tb_user u JOIN docsdig_access a ON a.user_id = u.id
SET u.departemen = 'HRD&GA'
WHERE a.username = 'HRD2' AND BINARY u.username = 'HRD2'
    AND BINARY u.departemen <> 'HRD&GA';

-- An empty password column cannot pass password_verify(). Activate via User Management.
INSERT INTO tb_user (nik, kode_user, nama_user, nama_lengkap, departemen, alamat, tgl_lahir, username, password, akses_lv)
SELECT '', 'DIGDOCS-GA1', 'GA1', 'GA1', 'HRD&GA', '', '', 'GA1', '', 2
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM tb_user WHERE username = 'GA1')
    AND NOT EXISTS (SELECT 1 FROM docsdig_access WHERE username = 'GA1');

SET @docsdig_ga1_id = IF(ROW_COUNT() = 1, LAST_INSERT_ID(), NULL);
INSERT INTO docsdig_access (username, user_id)
SELECT 'GA1', @docsdig_ga1_id FROM DUAL WHERE @docsdig_ga1_id IS NOT NULL;
SET @docsdig_ga1_id = NULL;

COMMIT;

SELECT a.username, u.id, u.departemen, (u.password <> '') AS password_set
FROM docsdig_access a JOIN tb_user u ON a.user_id = u.id AND BINARY u.username = a.username
ORDER BY a.username;
