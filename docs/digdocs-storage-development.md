# Perbaikan penyimpanan privat arsip

Tanggal: 12 November 2026.

## Penyebab dan perilaku

`digdocs/save` membuat library penyimpanan sebelum menyimpan lampiran, kemudian mencatat metadata/audit jika unggahan berhasil. `digdocs/import` memakai library yang sama untuk setiap lampiran sebelum mencatat satu batch. `digdocs/download/{id}` memeriksa dokumen dan membuka lampiran melalui library tersebut.

Warning `Penyimpanan privat arsip belum tersedia.` berasal dari validasi konstruktor `Digdocs_storage`. Di Windows lokal, direktori bawaan `C:\xampp\var\pos-security-digdocs` belum ada. Pemeriksaan mode POSIX juga tidak sesuai dengan ACL NTFS Windows.

## Perubahan

- Validasi mode direktori dan pengaturan mode file tetap berlaku pada Linux/macOS. Windows memakai ACL NTFS dari direktori yang disiapkan administrator.
- Perbandingan batas direktori menormalkan separator dan mengabaikan perbedaan huruf besar/kecil pada Windows. Penyimpanan di dalam atau sebagai induk document root/proyek tetap ditolak.
- Direktori lokal dibuat di luar web root; ACL dibatasi ke akun Apache yang teramati (`KARISMA\bram`), SYSTEM, dan Administrators. Penyiapan folder/ACL merupakan perubahan lingkungan lokal, bukan migrasi yang otomatis berjalan di server lain.
- Konfigurasi `DIGDOCS_STORAGE_DIR` dan autentikasi/hak akses modul tetap berlaku. Lihat [panduan penggunaan](digdocs.md#penyimpanan-dan-penyajian-lampiran).

## Verifikasi

PHP 7.4.33: lint library berhasil. Uji CLI dengan stub konfigurasi menjalankan library asli dan berhasil menulis file percobaan, membuka/membaca, serta menghapusnya. Direktori hilang, web root, proyek, dan induk web root ditolak. Perbandingan path Windows dengan beda kapital/separator lolos. `git diff --check` berhasil.

Uji CLI tidak membuktikan unggahan HTTP atau transaksi database. UAT login akun berwenang masih diperlukan: simpan dokumen beserta lampiran, impor batch, unduh dan bandingkan isi file, serta cek metadata/audit. Folder baru tidak memulihkan lampiran lama; jika unduhan lama menghasilkan 404 setelah perbaikan, pulihkan file dari backup direktori privat sesuai `storage_name` tanpa mengganti nama acaknya.
