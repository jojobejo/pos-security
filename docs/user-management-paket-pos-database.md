# Catatan database User Management dan Paket POS

Tanggal: 31 Oktober 2026

## Perubahan skema

Tidak ada perubahan skema database. Modul menggunakan tabel yang ada (`tb_user` dan `tb_terima_paket`); pilihan penerima disimpan pada kolom `kd_penerima` yang sudah tersedia.

Perubahan menu untuk akun `alif` dan `marisa` serta redirect login ALIF hanya berada di kode aplikasi. Tidak ada perubahan data atau struktur database untuk permintaan ini.

## Pembaruan akun admin

Akun `admin` sudah ada pada database aplikasi `db_karisma` (ID 1, departemen IT, level akses 1). Password awal yang diminta telah disetel ke `1234` menggunakan hash `password_hash` kompatibel dengan autentikasi aplikasi. Tidak ada password teks biasa yang disimpan di database.

Skrip idempotent untuk menyetel kembali akun tersebut ada di `database/sql/admin_user_management_setup_20261031.sql`. Jalankan pada database aplikasi yang tepat bila perlu mengulang setup.

## Eksekusi dan verifikasi

Skrip telah dieksekusi pada database lokal yang dikonfigurasi di `application/config/database.php` (`db_karisma`). Query verifikasi mengembalikan akun `admin` level 1 departemen IT. Tidak ada DDL atau perubahan tabel.

Gunakan **User Management** untuk mengganti kredensial awal segera setelah login. Password `1234` pendek dan sebaiknya hanya dipakai sebagai kredensial awal.

## Filter akses data Paket POS

Tidak ada perubahan skema database. Query tabel `tb_terima_paket` membatasi `kd_penerima` berdasarkan username sesi aplikasi; `HRD2` dan `HRD4` dikecualikan dari filter untuk tetap melihat seluruh daftar. Endpoint baca dan perubahan data menggunakan filter pemilik yang sama. Untuk input HRD4, nilai modal disimpan ke kolom `inputer` yang sudah ada. Tidak ada migrasi atau perubahan tabel.
