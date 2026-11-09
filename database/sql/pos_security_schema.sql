-- Skema POS Security untuk instalasi baru. Jalankan pada database tujuan yang kosong.

-- Contoh database lokal: CREATE DATABASE kiucoid_pos_security CHARACTER SET utf8mb4;

SET NAMES utf8mb4;

CREATE TABLE `hrdga_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(30) NOT NULL,
  `kode_user` varchar(25) NOT NULL,
  `nama_user` text NOT NULL,
  `nama_lengkap` text NOT NULL,
  `departemen` text NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lahir` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `akses_lv` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_lap_distribusi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nopol` varchar(255) NOT NULL,
  `nolambung` varchar(255) NOT NULL,
  `namadriver` varchar(255) NOT NULL,
  `namahelper` varchar(255) NOT NULL,
  `tujuan` text NOT NULL,
  `tglkeluar` text NOT NULL,
  `jamkeluar` varchar(255) NOT NULL,
  `kmkeluar` text NOT NULL,
  `tglmasuk` text NOT NULL,
  `jammasuk` varchar(255) NOT NULL,
  `kmmasuk` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `inputer` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_tamu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `perusahaan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jumlahpersonil` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `jammasuk` text NOT NULL,
  `jamkeluar` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nm_inputer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_tamu_lby` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` text NOT NULL,
  `nama` text NOT NULL,
  `perusahaan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jumlahpersonil` int(11) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `jammasuk` text NOT NULL,
  `jamkeluar` text NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nm_inputer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_service_truk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_truk` varchar(50) NOT NULL,
  `no_pol` varchar(50) NOT NULL,
  `thn_kendaran` int(11) NOT NULL,
  `png_jawab` text NOT NULL,
  `km_sekarang` int(11) NOT NULL,
  `km_sebelum` int(11) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_sblm` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_karyawan_keluarmasuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `departemen` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `jamkeluar` varchar(255) NOT NULL,
  `jammasuk` varchar(255) NOT NULL,
  `nopol` text NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nm_inputer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_expedisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` text NOT NULL,
  `jammasuk` varchar(255) NOT NULL,
  `jamkeluar` varchar(255) NOT NULL,
  `nopol` varchar(255) NOT NULL,
  `namadriver` varchar(255) NOT NULL,
  `notlpndriver` varchar(255) NOT NULL,
  `perusahaanpengirim` varchar(255) NOT NULL,
  `namabarang` varchar(255) NOT NULL,
  `jumlahbarang` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nm_inputer` text NOT NULL,
  `penerima_berkas_id` int(11) DEFAULT NULL,
  `status_berkas` enum('BELUM_DITERIMA','SUDAH_DITERIMA') NOT NULL DEFAULT 'BELUM_DITERIMA',
  `diterima_oleh_id` int(11) DEFAULT NULL,
  `diterima_pada` datetime DEFAULT NULL,
  `catatan_penerimaan` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_expedisi_penerima` (`penerima_berkas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` text NOT NULL,
  `issue` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_op_plat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noplat` varchar(25) NOT NULL,
  `nm_truk` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_op_driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_driver` varchar(25) NOT NULL,
  `no_urut_hr_i` int(12) NOT NULL DEFAULT 0,
  `nama_driver` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_op_helper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_helper` varchar(25) NOT NULL,
  `nama_helper` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_order_tracking_driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd_order` varchar(25) NOT NULL,
  `tgl_jalan` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_det_tracking_driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `norut` int(11) NOT NULL,
  `kd_deliveri` varchar(25) NOT NULL,
  `tgl_jalan` text NOT NULL,
  `kd_driver` varchar(25) NOT NULL,
  `kd_helper` varchar(25) NOT NULL,
  `kd_truk` varchar(25) NOT NULL,
  `destinasi` text NOT NULL,
  `jml_kios` int(11) NOT NULL,
  `tonase` double NOT NULL,
  `kubikasi` double NOT NULL,
  `sts_driver` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `nm_toko` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_tmp_lap_distribusi` (
  `id_lap_dis` int(11) NOT NULL AUTO_INCREMENT,
  `kd_deliveri` varchar(25) NOT NULL,
  `tgl_jalan` text NOT NULL,
  `kd_driver` varchar(25) NOT NULL,
  `kd_helper` varchar(25) NOT NULL,
  `kd_truk` varchar(25) NOT NULL,
  `destinasi` text NOT NULL,
  `tgl_masuk` text NOT NULL,
  `jm_masuk` text NOT NULL,
  `km_masuk` int(11) NOT NULL,
  `tgl_keluar` text NOT NULL,
  `jm_keluar` text NOT NULL,
  `km_keluar` int(11) NOT NULL,
  `status` text NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_lap_dis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_checkup_mekanik` (
  `id_ckup` int(11) NOT NULL AUTO_INCREMENT,
  `nopol` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` text NOT NULL,
  `kilometer` int(11) NOT NULL,
  `input_by` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_ckup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_checkup_mekanik_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nm_kategori` text NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_checkup_mekanik_kategori_detail` (
  `id_detail_kat` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `nm_detail` text NOT NULL,
  PRIMARY KEY (`id_detail_kat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_checkup_mekanik_detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_ckup` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_detail_kat` int(11) NOT NULL,
  `status` text NOT NULL,
  `keterangan` text NOT NULL,
  `evident` text NOT NULL,
  `input_by` text NOT NULL,
  `input_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_checkup_mekanik_kategori_foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ckup` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `input_by` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_ckup` (`id_ckup`),
  KEY `idx_kategori` (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hrdga_driver_pending` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `kd_deliveri` varchar(25) NOT NULL,
  `tgl_jalan` text NOT NULL,
  `kd_driver` varchar(25) NOT NULL,
  `kd_truk` varchar(25) NOT NULL,
  `destinasi` text NOT NULL,
  `nm_toko` text NOT NULL,
  `note_pending` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hrdga_expedisi_penerimaan_riwayat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expedisi_id` int(11) NOT NULL,
  `penerima_id` int(11) NOT NULL,
  `status_berkas` enum('BELUM_DITERIMA','SUDAH_DITERIMA') NOT NULL,
  `catatan` text DEFAULT NULL,
  `diterima_pada` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_riwayat_expedisi` (`expedisi_id`, `diterima_pada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
