# User Management dan penerima paket POS

Tanggal: 31 Oktober 2026

## Perubahan aplikasi

- Menambahkan halaman `User Management` melalui route `userAdmin`.
- Akses controller dibatasi pada sesi login dengan `akses_lv = 1` dan `departemen = IT`. Pemeriksaan dilakukan di sisi server untuk halaman maupun proses simpan.
- Admin dapat mengubah `nama_user`, `username`, dan password pada akun mana pun. Password opsional saat menyimpan; jika diisi, aplikasi menyimpan `password_hash()` dan mensyaratkan minimal 4 karakter. Username duplikat ditolak. Hak akses, departemen, dan kode user tidak dapat diubah dari modul ini.
- Pengelolaan dilakukan lewat menu User Management pada sidebar admin IT.
- Route `hrd_lap_paket_pos`: penerima baru mengganti `IKA` dengan `SUKMA`, dan `NITA` dengan `MARISA`. Ditambahkan `ALIF / KURNIAWAN / LOGISTIK`. Pemetaan departemen pada tabel dan filter data ikut disesuaikan, dengan data kode lama tetap dikenali untuk riwayat.
- Akun username `alif` dan `marisa` menampilkan menu **Laporan Paket POS**. Login username `alif` diarahkan langsung ke route `hrd_lap_paket_pos`. Akun `marisa` juga menampilkan menu **Laporan Tamu** melalui route `hrd_lap_tamu`.

## Cara menggunakan

1. Login sebagai `admin`.
2. Buka menu **User Management**.
3. Klik **Ubah** pada user yang dipilih, lalu simpan nama dan username baru.
4. Isi password baru jika ingin menggantinya; biarkan kosong untuk mempertahankan password saat ini.
5. Pada **Laporan Penerimaan Paket**, gunakan penerima MARISA, SUKMA, atau ALIF / KURNIAWAN / LOGISTIK ketika membuat atau mengedit laporan.

## Validasi yang telah dilakukan

- File PHP terkait dicek dengan PHP lint.
- Akun `admin` pada database `db_karisma` diperbarui dan hasil query memastikan satu akun `admin`, level 1, departemen IT.
- Pengujian browser dengan sesi akun non-admin dan uji alur form belum dilakukan.


## Penyesuaian data Paket POS berdasarkan akun

- Route halaman tetap `hrd_lap_paket_pos`; tabel mengambil data melalui endpoint AJAX `lap_penerimaan_pos_serverside`.
- Filter server-side memakai `username` dari sesi login. Username `HRD2` dan `HRD4` dapat melihat seluruh data Paket POS. Akun lain hanya melihat baris dengan `kd_penerima` sesuai username akun (dibandingkan tanpa membedakan huruf besar/kecil dan spasi). Akun `ALIF` juga dapat melihat label historis `ALIF KURNIAWAN`.
- Endpoint detail, ubah, hapus, dan konfirmasi memakai batas pemilik yang sama. Saat akun selain HRD2/HRD4 membuat atau mengubah data, penerima ditetapkan dari username sesi. Khusus input oleh HRD4, nilai `inputer` diambil dari field **Inputer** pada modal; akun lain tetap memakai nama dari sesi login.
- Tampilan AJAX untuk departemen KEUANGAN, MIA, dan HRD & GA mengirim sepuluh sel sesuai header tabel dan menyediakan aksi konfirmasi. Akun MARISA (HRD & GA) mengikuti susunan seperti gambar; konfirmasi untuk akun non-HRD2 tetap terbatas pada data miliknya.
- Cara penggunaan: login ke **Laporan Penerimaan Paket**. HRD2 dan HRD4 melihat semua penerima; misalnya login MARISA hanya melihat data MARISA. Gunakan salah satu akun HRD tersebut untuk pekerjaan yang memerlukan daftar gabungan.
- File PHP terkait telah lolos pengecekan sintaks. Uji browser dengan sesi HRD2 dan akun individual belum dilakukan.
