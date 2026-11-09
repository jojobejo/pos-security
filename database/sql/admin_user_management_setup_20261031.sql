-- Setup akun admin untuk modul User Management (CodeIgniter / hrdga_user).
-- Jalankan hanya pada database aplikasi yang benar; tidak mengubah skema.
UPDATE `hrdga_user`
SET `nama_user` = 'SUPERADMIN',
    `departemen` = 'IT',
    `akses_lv` = 1,
    `password` = '$2y$10$tVt.9mIOrUFYNaoGYP6He.Wu835T7ida/oDYNv6CyHQoFhWJOWLDO'
WHERE `username` = 'admin';

-- Verifikasi harus menghasilkan tepat satu baris akun level 1 departemen IT.
SELECT `id`, `username`, `nama_user`, `departemen`, `akses_lv`
FROM `hrdga_user`
WHERE `username` = 'admin';
