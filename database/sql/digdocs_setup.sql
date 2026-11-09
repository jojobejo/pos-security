-- Jalankan setelah skema POS Security dibuat. Skrip ini hanya menyiapkan akun arsip.

START TRANSACTION;

-- Bind the existing HRD2 account only when its username is unambiguous.
INSERT INTO hrdga_docsdig_access (username, user_id)
SELECT 'HRD2', MIN(id) FROM hrdga_user WHERE username = 'HRD2'
HAVING COUNT(*) = 1 AND SUM(BINARY username = 'HRD2') = 1
ON DUPLICATE KEY UPDATE user_id = hrdga_docsdig_access.user_id;

UPDATE hrdga_user u JOIN hrdga_docsdig_access a ON a.user_id = u.id
SET u.departemen = 'HRD&GA'
WHERE a.username = 'HRD2' AND BINARY u.username = 'HRD2'
    AND BINARY u.departemen <> 'HRD&GA';

-- An empty password column cannot pass password_verify(). Activate via User Management.
INSERT INTO hrdga_user (nik, kode_user, nama_user, nama_lengkap, departemen, alamat, tgl_lahir, username, password, akses_lv)
SELECT '', 'DIGDOCS-GA1', 'GA1', 'GA1', 'HRD&GA', '', '', 'GA1', '', 2
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM hrdga_user WHERE username = 'GA1')
    AND NOT EXISTS (SELECT 1 FROM hrdga_docsdig_access WHERE username = 'GA1');

SET @docsdig_ga1_id = IF(ROW_COUNT() = 1, LAST_INSERT_ID(), NULL);
INSERT INTO hrdga_docsdig_access (username, user_id)
SELECT 'GA1', @docsdig_ga1_id FROM DUAL WHERE @docsdig_ga1_id IS NOT NULL;
SET @docsdig_ga1_id = NULL;

COMMIT;

SELECT a.username, u.id, u.departemen, (u.password <> '') AS password_set
FROM hrdga_docsdig_access a JOIN hrdga_user u ON a.user_id = u.id AND BINARY u.username = a.username
ORDER BY a.username;
