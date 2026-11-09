# Database POS Security

Aplikasi lokal memakai database `kiucoid_pos_security` dengan 29 tabel untuk 12 modul. Semua tabel memakai prefix `hrdga_`.

| Modul | Tabel |
| --- | --- |
| Laporan Distribusi | `hrdga_lap_distribusi` |
| Laporan Tamu | `hrdga_tamu`, `hrdga_tamu_lby` |
| Data Service Truk | `hrdga_service_truk` |
| General Check Truck | `hrdga_checkup_mekanik`, `hrdga_checkup_mekanik_detail`, `hrdga_checkup_mekanik_kategori`, `hrdga_checkup_mekanik_kategori_detail`, `hrdga_checkup_mekanik_kategori_foto` |
| Laporan Karyawan K-M | `hrdga_karyawan_keluarmasuk` |
| Laporan Expedisi | `hrdga_expedisi`, `hrdga_expedisi_penerimaan_riwayat`, `hrdga_user` |
| Laporan Issue | `hrdga_issue` |
| Data Karyawan dan login | `hrdga_user` |
| Laporan Penerimaan Paket | `hrdga_terima_paket` |
| Data Logistik Distribusi | `hrdga_tmp_lap_distribusi`, `hrdga_op_plat`, `hrdga_op_driver`, `hrdga_op_helper`, `hrdga_order_tracking_driver`, `hrdga_det_tracking_driver`, `hrdga_driver_pending` |
| Checklist Kendaraan | `hrdga_checklist_kendaraan`, `hrdga_checklist_kendaraan_detail`, `hrdga_gbrupload_cheklist` |
| Arsip Dokumen Digital | `hrdga_docsdig_documents`, `hrdga_docsdig_access`, `hrdga_docsdig_audit`, `hrdga_docsdig_reminder_reads` |

Data order, kendaraan, driver, helper, dan distribusi sementara dipakai oleh alur pengiriman yang memasok Laporan Distribusi. Tabel akun juga melayani login dan pemilihan penerima berkas Expedisi.

## Instalasi dari salinan lokal

Jalankan dari direktori proyek dengan pengguna database yang boleh membuat database tujuan dan membaca kedua database sumber.

```sh
mysql -u root -e 'CREATE DATABASE kiucoid_pos_security CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci'
mysql -u root kiucoid_pos_security < database/sql/pos_security_schema.sql
mysql -u root kiucoid_pos_security < database/sql/pos_security_import_local.sql
```

Skrip impor disiapkan untuk struktur sumber lokal saat pemisahan database. Jalankan satu kali pada skema yang baru dibuat. Tabel utama disalin dari `kiucoid_karismaerp_local`. Lima tabel General Check Truck disalin bersama dari `kiucoid_kpi`, karena salinan ERP lokal hanya memiliki kategori dan sebagian referensi foto. Beberapa detail historis dari salinan tersebut merujuk ke item kategori yang sudah tidak ada.

Laporan Expedisi lama memakai status awal `BELUM_DITERIMA` dengan penerima kosong. Riwayat penerimaan dan data pengiriman tertunda dimulai kosong karena tabelnya belum tersedia di sumber. Kolom urutan driver yang belum ada di sumber dimulai dengan nilai `0`.

File SQL mengimpor data tabel dan referensi nama foto. Simpan berkas foto Checklist Kendaraan dan General Check Truck di `uploads/checklist_kendaraan/` dan beri pengguna Apache akses tulis ke direktori tersebut. Lampiran Arsip Dokumen Digital memakai direktori privat terpisah. [Penyimpanan Arsip Dokumen Digital](digdocs.md#penyimpanan-dan-penyajian-lampiran)

Folder `db/` berisi dump historis, termasuk salinan POS Security saat skemanya masih berisi 21 tabel. Gunakan skema POS Security di atas untuk instalasi 12 modul.
