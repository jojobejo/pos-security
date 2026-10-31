-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Okt 2024 pada 09.35
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_karisma`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_det_tracking_driver`
--

CREATE TABLE `tb_det_tracking_driver` (
  `id` int(12) NOT NULL,
  `norut` int(5) NOT NULL,
  `kd_deliveri` varchar(25) NOT NULL,
  `tgl_jalan` text NOT NULL,
  `kd_driver` varchar(25) NOT NULL,
  `kd_helper` varchar(25) NOT NULL,
  `kd_truk` varchar(25) NOT NULL,
  `destinasi` text NOT NULL,
  `jml_kios` int(25) NOT NULL,
  `tonase` double NOT NULL,
  `kubikasi` double NOT NULL,
  `sts_driver` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `nm_toko` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_det_tracking_driver`
--

INSERT INTO `tb_det_tracking_driver` (`id`, `norut`, `kd_deliveri`, `tgl_jalan`, `kd_driver`, `kd_helper`, `kd_truk`, `destinasi`, `jml_kios`, `tonase`, `kubikasi`, `sts_driver`, `keterangan`, `nm_toko`) VALUES
(19, 1, 'KIUD0909230001', '2023-09-01', 'KIU0508230009', 'KIU0508230023', 'K 17', 'TUBAN', 3, 3.3, 2.6, 'READY', '', ''),
(20, 2, 'KIUD0909230001', '2023-09-01', 'KIU0508230010', 'KIU0508230026', 'K 59', 'SURABAYA', 8, 3.9, 7.4, 'READY', '', ''),
(21, 3, 'KIUD0909230001', '2023-09-01', 'KIU0508230011', 'KIU0508230027', 'K 12', 'NGANJUK', 11, 3.4, 6.1, 'READY', '', ''),
(22, 4, 'KIUD0909230001', '2023-09-01', 'KIU0508230012', '-', '-', '', 0, 0, 0, 'WAITING', '-', ''),
(23, 5, 'KIUD0909230001', '2023-09-01', 'KIU0508230013', '-', '-', '', 0, 0, 0, 'WAITING', '-', ''),
(24, 6, 'KIUD0909230001', '2023-09-01', 'KIU0508230014', '-', '-', '', 0, 0, 0, 'WAITING', '-', ''),
(25, 7, 'KIUD0909230001', '2023-09-01', 'KIU0508230015', '-', '-', '', 0, 0, 0, 'WAITING', '-', ''),
(26, 8, 'KIUD0909230001', '2023-09-01', 'KIU0508230016', '-', '-', '', 0, 0, 0, 'WAITING', '-', ''),
(27, 9, 'KIUD0909230001', '2023-09-01', 'KIU0209230017', '-', '-', '', 0, 0, 0, 'WAITING', '-', ''),
(28, 10, 'KIUD0909230001', '2023-09-01', 'KIU0209230018', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(29, 11, 'KIUD0909230001', '2023-09-01', 'KIU0508230001', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(30, 12, 'KIUD0909230001', '2023-09-01', 'KIU0508230002', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(31, 13, 'KIUD0909230001', '2023-09-01', 'KIU0508230003', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(32, 14, 'KIUD0909230001', '2023-09-01', 'KIU0508230004', '-', '-', '', 0, 0, 0, 'PENDING', 'KIR', ''),
(33, 15, 'KIUD0909230001', '2023-09-01', 'KIU0508230005', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(34, 16, 'KIUD0909230001', '2023-09-01', 'KIU0508230006', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(35, 17, 'KIUD0909230001', '2023-09-01', 'KIU0508230007', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(36, 18, 'KIUD0909230001', '2023-09-01', 'KIU0508230008', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(37, 1, 'KIUD0909230002', '2023-09-02', 'KIU0508230012', 'KIU0508230028', 'K 58', 'BOJONEGORO', 7, 5.3, 9.1, 'READY', '', ''),
(38, 2, 'KIUD0909230002', '2023-09-02', 'KIU0508230013', 'KIU0508230021', 'K 45', 'MALANG', 9, 3.2, 6.9, 'READY', '', ''),
(39, 3, 'KIUD0909230002', '2023-09-02', 'KIU0508230014', 'KIU0508230029', 'K 36', 'TUBAN', 5, 4.6, 8.2, 'READY', '', ''),
(40, 4, 'KIUD0909230002', '2023-09-02', 'KIU0508230015', 'KIU0508230030', 'K 28', 'NGAWI', 2, 5.7, 9.9, 'READY', '', ''),
(41, 5, 'KIUD0909230002', '2023-09-02', 'KIU0508230016', 'KIU0508230037', 'K 78', 'TABANAN DENPASAR', 10, 4.3, 10.7, 'READY', '', ''),
(42, 6, 'KIUD0909230002', '2023-09-02', 'KIU0209230017', 'KIU0508230032', 'K 27', 'NGAWI', 5, 4.2, 9.8, 'READY', '', ''),
(43, 7, 'KIUD0909230002', '2023-09-02', 'KIU0209230018', 'KIU0508230033', 'K 23', 'SURABAYA', 7, 3.4, 5.9, 'READY', '', ''),
(44, 8, 'KIUD0909230002', '2023-09-02', 'KIU0508230001', '-', '-', '', 0, 0, 0, 'WAITING', '-', ''),
(45, 9, 'KIUD0909230002', '2023-09-02', 'KIU0508230002', '-', '-', '', 0, 0, 0, 'WAITING', '-', ''),
(46, 10, 'KIUD0909230002', '2023-09-02', 'KIU0508230003', '-', '-', '', 0, 0, 0, 'WAITING', '-', ''),
(47, 11, 'KIUD0909230002', '2023-09-02', 'KIU0508230004', 'KIU0508230021', 'K 16', 'SUKOWONO', 5, 0.8, 1.6, 'ON THE ROAD', '-', ''),
(48, 12, 'KIUD0909230002', '2023-09-02', 'KIU0508230005', 'KIU0508230032', 'K 99', 'JEMBER FAST KOTA KOTA', 2, 0.9, 1.9, 'ON THE ROAD', '', ''),
(49, 13, 'KIUD0909230002', '2023-09-02', 'KIU0508230006', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(50, 14, 'KIUD0909230002', '2023-09-02', 'KIU0508230007', 'KIU0508230024', 'K 57', 'SANGGAR KALIPAIT', 16, 3.1, 5.4, 'ON THE ROAD', '-', ''),
(51, 15, 'KIUD0909230002', '2023-09-02', 'KIU0508230008', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(52, 16, 'KIUD0909230002', '2023-09-02', 'KIU0508230009', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(53, 17, 'KIUD0909230002', '2023-09-02', 'KIU0508230010', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(54, 18, 'KIUD0909230002', '2023-09-02', 'KIU0508230011', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '-', ''),
(55, 1, 'KIUD0909230003', '2023-09-04', 'KIU0508230001', 'KIU0508230034', 'K 15', 'MALANG', 3, 4.8, 7.9, 'READY', '', ''),
(56, 2, 'KIUD0909230003', '2023-09-04', 'KIU0508230002', 'KIU0508230022', 'K 25', 'MADURA', 2, 4, 6.6, 'READY', '', ''),
(57, 3, 'KIUD0909230003', '2023-09-04', 'KIU0508230003', 'KIU0508230036', 'K 21', 'KINTAMANI', 8, 4, 8.7, 'READY', '', ''),
(58, 4, 'KIUD0909230003', '2023-09-04', 'KIU0508230004', 'KIU0508230021', 'K 16', 'TULUNGAGUNG', 15, 3.7, 5.8, 'READY', '', ''),
(59, 5, 'KIUD0909230003', '2023-09-04', 'KIU0508230005', 'KIU0508230027', 'K 22', 'PONOROGO', 4, 4.5, 7.6, 'READY', '', ''),
(60, 6, 'KIUD0909230003', '2023-09-04', 'KIU0508230006', 'KIU0508230028', 'K 89', 'NGANJUK', 17, 5.3, 9.5, 'READY', '', ''),
(61, 7, 'KIUD0909230003', '2023-09-04', 'KIU0508230007', 'KIU0508230024', 'K 99', 'JEMBER KOTA FAST', 3, 0.9, 3, 'ON THE ROAD', '', ''),
(62, 8, 'KIUD0909230003', '2023-09-04', 'KIU0508230008', 'KIU0508230025', 'K 11', 'SITUBONDO', 13, 3.1, 5, 'ON THE ROAD', '', ''),
(63, 9, 'KIUD0909230003', '2023-09-04', 'KIU0508230009', 'KIU0508230023', 'K 17', 'AMBULU KENCONG', 11, 3.3, 5.6, 'ON THE ROAD', '', ''),
(64, 10, 'KIUD0909230003', '2023-09-04', 'KIU0508230010', 'KIU0508230027', 'K 59', 'PROBOLINGGO', 10, 4.5, 7.7, 'ON THE ROAD', '', ''),
(65, 11, 'KIUD0909230003', '2023-09-04', 'KIU0508230011', 'KIU0508230035', 'K 12', 'WONGSOREJO', 7, 4.6, 7.6, 'ON THE ROAD', '', ''),
(66, 12, 'KIUD0909230003', '2023-09-04', 'KIU0508230012', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '', ''),
(67, 13, 'KIUD0909230003', '2023-09-04', 'KIU0508230013', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '', ''),
(68, 14, 'KIUD0909230003', '2023-09-04', 'KIU0508230014', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '', ''),
(69, 15, 'KIUD0909230003', '2023-09-04', 'KIU0508230015', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '', ''),
(70, 16, 'KIUD0909230003', '2023-09-04', 'KIU0508230016', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '', ''),
(71, 17, 'KIUD0909230003', '2023-09-04', 'KIU0209230017', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '', ''),
(72, 18, 'KIUD0909230003', '2023-09-04', 'KIU0209230018', '-', '-', '', 0, 0, 0, 'ON THE ROAD', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_driver_pending`
--

CREATE TABLE `tb_driver_pending` (
  `id` int(12) NOT NULL,
  `kd_deliveri` varchar(25) NOT NULL,
  `tgl_jalan` text NOT NULL,
  `kd_driver` varchar(25) NOT NULL,
  `kd_truk` varchar(25) NOT NULL,
  `destinasi` text NOT NULL,
  `nm_toko` text NOT NULL,
  `note_pending` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_expedisi`
--

CREATE TABLE `tb_expedisi` (
  `id` int(11) NOT NULL,
  `tanggal` text NOT NULL,
  `jammasuk` varchar(255) NOT NULL,
  `jamkeluar` varchar(255) NOT NULL,
  `nopol` varchar(255) NOT NULL,
  `namadriver` varchar(255) NOT NULL,
  `notlpndriver` varchar(255) NOT NULL,
  `perusahaanpengirim` varchar(255) NOT NULL,
  `namabarang` varchar(255) NOT NULL,
  `jumlahbarang` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_expedisi`
--

INSERT INTO `tb_expedisi` (`id`, `tanggal`, `jammasuk`, `jamkeluar`, `nopol`, `namadriver`, `notlpndriver`, `perusahaanpengirim`, `namabarang`, `jumlahbarang`, `keterangan`) VALUES
(1, '2024-06-20', '03:40', '', 'BG 82466 LQ', 'SODIK', '085231820243', 'PT.KALATHAM', 'GANDASIL', '1100', 'BONGKAR'),
(2, '2024-06-20', '08.40', '09.50', 'L 8105 BAC', 'YUSUF', '08119505521', 'PT. ROYAL AGRO', 'AGIL', '103 BOX', 'BONGKAR'),
(3, '2024-06-20', '09.14', '', 'P 8432 UY', 'RISKY', '085234987591', 'PT. BERBAK ARGO', 'BASRATA', '50 BOX', 'BONGKAR'),
(4, '2024-06-20', '09.20', '10:00', 'AE 8529 K', 'EGO', '085868660069', 'TOKO ALAM TANI ( NGAWI )', '', '', 'AMBIL BARANG'),
(5, '2024-06-20', '09.33', '', 'B 9258 UEW', 'HENDRA ', '081460305247', 'PT.AGRI', 'SPONTAN ', '10 TON', 'BONGKAR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_generate_kd`
--

CREATE TABLE `tb_generate_kd` (
  `id` int(11) NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inventaris`
--

CREATE TABLE `tb_inventaris` (
  `id` int(11) NOT NULL,
  `kdinventaris` text NOT NULL,
  `kdpic` varchar(25) NOT NULL,
  `departement` varchar(25) NOT NULL,
  `typebarang` text NOT NULL,
  `deskripsi` text NOT NULL,
  `tglbeli` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ipkp`
--

CREATE TABLE `tb_ipkp` (
  `id` int(11) NOT NULL,
  `nilai_kp` int(2) NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_issue`
--

CREATE TABLE `tb_issue` (
  `id` int(11) NOT NULL,
  `tanggal` text NOT NULL,
  `issue` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_issue`
--

INSERT INTO `tb_issue` (`id`, `tanggal`, `issue`, `lokasi`, `nama`) VALUES
(1, '2024-06-04', 'Bambu menjalar ke area gudang baru kandang no 8', 'Gudang baru', 'Dedy hidayat'),
(2, '2024-06-08', 'ranting menutup rambu', 'depan pintu masuk', 'Dedy hidayat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_itinventariskomputer`
--

CREATE TABLE `tb_itinventariskomputer` (
  `id` int(11) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `kd_inventaris` varchar(255) NOT NULL,
  `departement` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `descripsi` varchar(255) NOT NULL,
  `tanggal_beli` text NOT NULL,
  `harga_beli` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `History` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_karyawan_keluarmasuk`
--

CREATE TABLE `tb_karyawan_keluarmasuk` (
  `id` int(11) NOT NULL,
  `tanggal` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `departemen` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `jamkeluar` varchar(255) NOT NULL,
  `jammasuk` varchar(255) NOT NULL,
  `nopol` text NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_karyawan_keluarmasuk`
--

INSERT INTO `tb_karyawan_keluarmasuk` (`id`, `tanggal`, `nama`, `departemen`, `status`, `jamkeluar`, `jammasuk`, `nopol`, `keterangan`) VALUES
(1, '2024-06-19', 'KRISTIAN', 'DRIVER LOGISTIK', 'DINAS', '09.24', '10.50', 'P 1465 HE', 'SAMSAT'),
(2, '2024-06-19', 'FANDI', 'DRIVER LOGISTIK', 'DINAS', '09.30', '11.23', 'P 8694 UG', 'TAP OLI DI DWI JAYA'),
(3, '2024-06-19', 'IMAM TURMUDI & TIMAN ', 'DRIVER LOGISTIK', 'DINAS', '09.33', '11.05', 'P 9629 UG', 'AMBIL MOBIL'),
(4, '2024-06-19', 'RAHMAT', 'DRIVER LOGISTIK', 'DINAS', '09.39', '11.20', 'P 8179 UG', 'BENGKEL DWI JAYA TAP OLI'),
(5, '2024-06-19', 'FAWAS , BILLY K ', 'ADMIN ECERAN & HELPER', 'PRIBADI', '11.35', '12.27', 'MOTOR PRIBADI', 'ISTIRAHAT DI LUAR'),
(6, '2024-06-19', 'MIFTAH ', 'HELPER  LOGISTIK', 'PRIBADI', '12.02', '13.22', 'MOTOR PRIBADI', 'ISTIRAHAT DI LUAR'),
(7, '2024-06-20', 'KRISTIAN', 'DRIVER LOGISTIK', 'DINAS', '08.50', '10.18', 'P 8622 UG', 'SAMSAT'),
(8, '2024-06-20', 'IMAM TURMUDI , MANGGALA , YOGA', 'DRIVER LOGISTIK & HELPER ', 'DINAS', '09.04', '11.00', 'P 9629 UG', 'GUDANG TAMRIN ( AMBIL BISI -18 )'),
(9, '2024-06-20', 'SAMHADI , HERI , SONY', 'DRIVER LOGISTIK & HELPER', 'DINAS', '08.50', '10.59', 'P 9161 UG', 'GUDANG TAMRIN ( AMBIL BISI -18 )'),
(10, '2024-06-20', 'FENDI , BAYU , NOVIANTO', 'CHKEER GUDANG , DRIVER', 'DINAS', '09.12', '11.11', 'P 8731 GG', 'GUDANG TAMRIN ( AMBIL BISI -18 )'),
(11, '2024-06-20', 'JEFRI , BILLY.K ', 'HELPER  LOGISTIK', 'DINAS', '09.04', '10.57', 'MOTOR PRIBADI', 'GUDANG TAMRIN ( AMBIL BISI -18 )'),
(12, '2024-06-20', 'BUDI OB', 'GA,LOGISTIK', 'DINAS', '09.20', '10.40', 'P 3174 JB ( BEAT )', 'BELI TULANGAN DI PASAR TANJUNG'),
(13, '2024-06-20', 'YUYUN INDAH WATI ', 'SALES', 'PRIBADI', '09.30', '10.10', 'MOTOR PRIBADI', 'AMBIL RAPOT ANAK '),
(14, '2024-06-20', 'JONI', 'DRIVER LOGISTIK', 'DINAS', '10.05', '', 'P 8060 UG', 'BENGKEL JENDRAL'),
(15, '2024-06-20', 'SUYONOD', 'DRIVER LOGISTIK', 'DINAS', '10:30', '11.44', 'N 1297 ABH', 'KE AC-01'),
(16, '2024-06-20', 'BILI.K', 'HELPER  LOGISTIK', 'PRIBADI', '12:00', '13:00', '', 'MAKAN DI LUAR'),
(17, '2024-06-20', 'FAWAS', 'ADMIN ECERAN', 'PRIBADI', '11.30', '12:30', '', 'MAKAN DI LUAR'),
(18, '2024-06-20', 'FAISAL', 'SELES', 'PRIBADI', '11.45', '12.15', '', 'MAKAN DI LUAR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kpi1`
--

CREATE TABLE `tb_kpi1` (
  `id` int(11) NOT NULL,
  `code_karyawan` varchar(255) NOT NULL,
  `nm_karyawan` varchar(25) NOT NULL,
  `dept_karyawan` varchar(255) NOT NULL,
  `atasan_karyawan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kpibobotutama`
--

CREATE TABLE `tb_kpibobotutama` (
  `id` int(11) NOT NULL,
  `code_karyawan` varchar(255) NOT NULL,
  `tgl` text NOT NULL,
  `what` int(255) NOT NULL,
  `how` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kpihow`
--

CREATE TABLE `tb_kpihow` (
  `id` int(11) NOT NULL,
  `kd_how` varchar(255) NOT NULL,
  `how` varchar(255) NOT NULL,
  `bulan` text NOT NULL,
  `indikator` varchar(255) NOT NULL,
  `nilai_indikator` int(255) NOT NULL,
  `nilai` int(255) NOT NULL,
  `bobot` int(255) NOT NULL,
  `hasil` int(255) NOT NULL,
  `bobotutama` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kpiwhat`
--

CREATE TABLE `tb_kpiwhat` (
  `id` int(11) NOT NULL,
  `kode_user` varchar(255) NOT NULL,
  `kd_how` varchar(255) NOT NULL,
  `bulan` text NOT NULL,
  `what` varchar(255) NOT NULL,
  `indikator` varchar(255) NOT NULL,
  `nilai_indikator` int(255) NOT NULL,
  `nilai` int(255) NOT NULL,
  `bobot` int(255) NOT NULL,
  `hasil` int(255) NOT NULL,
  `bobotutama` int(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lap_distribusi`
--

CREATE TABLE `tb_lap_distribusi` (
  `id` int(255) NOT NULL,
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
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_lap_distribusi`
--

INSERT INTO `tb_lap_distribusi` (`id`, `nopol`, `nolambung`, `namadriver`, `namahelper`, `tujuan`, `tglkeluar`, `jamkeluar`, `kmkeluar`, `tglmasuk`, `jammasuk`, `kmmasuk`, `keterangan`, `inputer`, `create_at`) VALUES
(1, 'P 8731 GG', 'CARRY', 'IMRON', 'RICO', 'DAKOTA', '2024-06-19', '11.18', '22775', '2024-06-19', '14.20', '22816', 'KIRIM BARANG', 'Security', '2024-06-19 07:30:44'),
(2, 'P 8201 UG', 'Q-1', 'MAKRUF', 'EKO', 'TUBAN', '2024-06-19', '19:23', '30690', '', '', '', 'KIRIM', '', '2024-06-19 12:25:59'),
(3, 'P 9904 UG', 'K 27', 'ADE', 'UBAY', 'SURABAYA', '2024-06-19', '20:58', '455191', '', '', '', 'KIRIM', 'Security', '2024-06-19 14:00:12'),
(4, 'P 8199 UG', 'Q-2', 'RIBUT', 'IMRON', 'TUBAN', '2024-06-19', '19:30', '27794', '', '', '', 'KIRIM', 'Security', '2024-06-19 12:37:44'),
(5, 'P 8290 UG', 'K 28', 'MAHRUS', 'IWAN', 'BALI', '2024-06-19', '20:00', '576736', '', '', '', 'KIRIM', 'Security', '2024-06-19 13:14:26'),
(6, 'P 8178 UG', 'Q-7', 'MUSTAJAB', 'RIKO', 'NGAWI', '2024-06-19', '19:59', '25499', '', '', '', 'KIRIM', 'Security', '2024-06-19 13:13:29'),
(7, 'P 9903 UG', 'K 36', 'WALUYO', 'HARI', 'BANYUWANGI', '2024-06-20', '05:45', '426558', '', '', '', 'KIRIM', 'Security', '2024-06-19 23:03:47'),
(8, 'P 8694 UG', 'K 89', 'FANDI', 'BILLI B', 'SITUBONDO', '2024-06-20', '05:53', '331759', '', '', '', 'KIRIM', 'Security', '2024-06-19 23:04:52'),
(9, 'P 8925 GC', 'K 22', 'GOVIL', 'LUCKY', 'AMBULU - KENCONG', '2024-06-20', '06:00', '506271', '', '', '', 'KIRIM', 'Security', '2024-06-19 23:06:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_op_driver`
--

CREATE TABLE `tb_op_driver` (
  `id` int(11) NOT NULL,
  `kd_driver` varchar(25) NOT NULL,
  `no_urut_hr_i` int(12) NOT NULL,
  `nama_driver` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_op_driver`
--

INSERT INTO `tb_op_driver` (`id`, `kd_driver`, `no_urut_hr_i`, `nama_driver`, `status`, `create_at`) VALUES
(7, 'KIU0508230001', 2, 'TIMAN', 'ACTIVE', '2024-04-04 07:11:46'),
(8, 'KIU0508230002', 1, 'SAMHADI', 'ACTIVE', '2024-04-04 07:11:46'),
(9, 'KIU0508230003', 3, 'JONI', 'ACTIVE', '2023-09-09 04:08:56'),
(10, 'KIU0508230004', 4, 'GOVIL', 'ACTIVE', '2023-09-09 04:08:56'),
(11, 'KIU0508230005', 5, 'ALI WAFA', 'ACTIVE', '2023-09-09 04:08:56'),
(12, 'KIU0508230006', 6, 'FANDI', 'ACTIVE', '2023-09-09 04:08:56'),
(13, 'KIU0508230007', 7, 'ROHMAN', 'ACTIVE', '2023-09-09 04:08:56'),
(14, 'KIU0508230008', 8, 'ANANG', 'ACTIVE', '2023-09-09 04:08:56'),
(15, 'KIU0508230009', 9, 'SUGIHARTONO', 'ACTIVE', '2023-09-09 04:08:56'),
(16, 'KIU0508230010', 10, 'MAKRUF', 'ACTIVE', '2023-09-09 04:08:56'),
(17, 'KIU0508230011', 11, 'ADE', 'ACTIVE', '2023-09-09 04:08:56'),
(18, 'KIU0508230012', 12, 'RIBUT', 'ACTIVE', '2023-09-09 04:08:56'),
(19, 'KIU0508230013', 13, 'MUSTAJAB', 'ACTIVE', '2023-09-09 04:08:56'),
(20, 'KIU0508230014', 14, 'IMAM T', 'ACTIVE', '2023-09-09 04:08:56'),
(21, 'KIU0508230015', 15, 'KRISTIAN', 'ACTIVE', '2023-09-09 04:08:56'),
(22, 'KIU0508230016', 16, 'SUYONO', 'ACTIVE', '2023-09-09 04:08:56'),
(26, 'KIU0209230017', 17, 'HERI', 'ACTIVE', '2023-09-09 04:08:56'),
(27, 'KIU0209230018', 18, 'RAHMAT', 'ACTIVE', '2023-09-09 04:08:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_op_helper`
--

CREATE TABLE `tb_op_helper` (
  `id` int(12) NOT NULL,
  `kd_helper` varchar(25) NOT NULL,
  `nama_helper` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_op_helper`
--

INSERT INTO `tb_op_helper` (`id`, `kd_helper`, `nama_helper`, `status`, `create_at`) VALUES
(2, 'KIU0508230020', 'BILLY B', 'ACTIVE', '2023-08-07 04:18:03'),
(5, 'KIU0508230021', 'YOGA', 'ACTIVE', '2023-08-24 02:08:45'),
(7, 'KIU0508230022', 'IHSAN', 'ACTIVE', '2023-08-24 02:08:49'),
(8, 'KIU0508230023', 'EKO', 'ACTIVE', '2023-08-24 02:08:56'),
(9, 'KIU0508230024', 'HARI', 'ACTIVE', '2023-08-24 02:08:59'),
(10, 'KIU0508230025', 'MIFTAH', 'ACTIVE', '2023-08-24 02:09:04'),
(11, 'KIU0508230026', 'RIKO', 'ACTIVE', '2023-08-24 02:09:08'),
(12, 'KIU0508230027', 'BILLY K', 'ACTIVE', '2023-08-24 02:09:13'),
(13, 'KIU0508230028', 'FAJAR P', 'ACTIVE', '2023-08-24 02:09:18'),
(14, 'KIU0508230029', 'MANGGALA', 'ACTIVE', '2023-08-24 02:09:25'),
(15, 'KIU0508230030', 'GUNADI', 'ACTIVE', '2023-08-24 02:09:29'),
(16, 'KIU0508230031', 'ARIS', 'ACTIVE', '2023-08-24 02:09:34'),
(17, 'KIU0508230032', 'BAGUS', 'ACTIVE', '2023-08-24 02:09:37'),
(18, 'KIU0508230033', 'JEFRI', 'ACTIVE', '2023-08-24 02:09:40'),
(19, 'KIU0508230034', 'MAHRUS', 'ACTIVE', '2023-08-24 02:09:43'),
(20, 'KIU0508230035', 'SONI', 'ACTIVE', '2023-08-24 02:09:46'),
(21, 'KIU0508230036', 'IWAN', 'ACTIVE', '2023-08-24 02:09:50'),
(22, 'KIU0508230037', 'IMAM B', 'ACTIVE', '2023-08-24 02:09:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_op_plat`
--

CREATE TABLE `tb_op_plat` (
  `id` int(11) NOT NULL,
  `noplat` varchar(25) NOT NULL,
  `nm_truk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_op_plat`
--

INSERT INTO `tb_op_plat` (`id`, `noplat`, `nm_truk`) VALUES
(2, 'P 8925 GC', 'K 22'),
(3, 'P 9962 UG', 'K 15'),
(4, 'P 9805 UG', 'K 25'),
(5, 'P 8808 G', 'K 21'),
(6, 'P 8305 UK', 'K 16'),
(8, 'P 8241 UG', 'K 89'),
(9, 'P 9695 UG', 'K 57'),
(10, 'P 9068 UG', 'K 11'),
(11, 'P 8306 UK', 'K 17'),
(12, 'P 8060 UG', 'K 59'),
(13, 'P 9276 UG', 'K 12'),
(14, 'P 9880 UG', 'K 58'),
(15, 'P 8058 UQ', 'K 45'),
(16, 'P 9905 UG', 'K 36'),
(17, 'P 8290 UG', 'K 28'),
(18, 'P 8092 UG', 'K 78'),
(19, 'P 9904 UG', 'K 27'),
(20, 'P 9629 UG', 'K 23'),
(21, 'P 8242 UG', 'K 88'),
(22, 'P 9161 UG', 'K 77'),
(23, 'P 9475 UG', 'K 18'),
(24, 'P 8297 UQ', 'K 99'),
(25, 'P 8252 GE', 'GRANDMAX'),
(26, 'P 9611 GE', 'FUTURA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order_tracking_driver`
--

CREATE TABLE `tb_order_tracking_driver` (
  `id` int(11) NOT NULL,
  `kd_order` varchar(25) NOT NULL,
  `tgl_jalan` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_order_tracking_driver`
--

INSERT INTO `tb_order_tracking_driver` (`id`, `kd_order`, `tgl_jalan`, `create_at`) VALUES
(2, 'KIUD0909230001', '2023-09-01', '2023-09-09 02:57:27'),
(3, 'KIUD0909230002', '2023-09-02', '2023-09-09 03:15:31'),
(4, 'KIUD0909230003', '2023-09-04', '2023-09-09 04:22:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_service_truk`
--

CREATE TABLE `tb_service_truk` (
  `id` int(11) NOT NULL,
  `kd_truk` varchar(50) NOT NULL,
  `no_pol` varchar(50) NOT NULL,
  `thn_kendaran` int(5) NOT NULL,
  `png_jawab` text NOT NULL,
  `km_sekarang` int(25) NOT NULL,
  `km_sebelum` int(25) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_sblm` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_service_truk`
--

INSERT INTO `tb_service_truk` (`id`, `kd_truk`, `no_pol`, `thn_kendaran`, `png_jawab`, `km_sekarang`, `km_sebelum`, `update_at`, `update_sblm`) VALUES
(1, 'K 22', 'P 8925 GC', 2015, 'Ali Wafa', 450898, 450898, '2023-09-07 03:59:11', ''),
(2, 'K 15', 'P 9962 UG', 2012, 'Timan', 527542, 528129, '2023-08-22 04:31:38', ''),
(3, 'K 25', 'P 9805 UG', 2016, 'Samhadi', 60000, 50000, '2023-08-26 04:04:27', ''),
(4, 'K 21', 'P 8808 G', 2010, 'Office', 80000, 50000, '2023-08-26 04:06:55', ''),
(5, 'K 16', 'P 8305 UK', 2013, 'M. Govil Ardianto', 603055, 597527, '2023-09-07 04:01:24', ''),
(6, 'K 89', 'P 8241 UG', 2018, 'M. Rifandi', 0, 0, '2023-08-22 02:27:35', ''),
(7, 'K 57', 'P 9695 UG', 2011, 'Rohman Ali', 0, 0, '2023-08-22 02:27:35', ''),
(8, 'K 11', 'P 9068 UG', 2010, 'Anang Sudarto', 0, 0, '2023-08-22 02:27:35', ''),
(9, 'K 17', 'P 8306 UK', 2013, 'Sugihartono', 0, 0, '2023-08-22 02:27:35', ''),
(10, 'K 59', 'P 8060 UG', 2022, 'Amal Ma\'ruf', 0, 0, '2023-08-22 02:27:35', ''),
(11, 'K 12', 'P 9276 UG', 2010, 'Ade Bagus', 0, 0, '2023-08-22 02:27:35', ''),
(12, 'K 58', 'P 9880 UG', 2022, 'Ribut Santoso', 0, 0, '2023-08-22 02:27:35', ''),
(13, 'K 45', 'P 8058 UQ', 2017, 'Ali Mustajab', 0, 0, '2023-08-22 02:27:35', ''),
(14, 'K 36', 'P 9905 UG', 2017, 'Imam Turmudi', 0, 0, '2023-08-22 02:27:35', ''),
(15, 'K 28', 'P 8290 UG', 2013, 'Kristian Budi', 0, 0, '2023-08-22 02:27:35', ''),
(16, 'K 78', 'P 8092 UG', 2022, 'Office', 0, 0, '2023-08-22 02:27:35', ''),
(17, 'K 27', 'P 9904 UG', 2017, 'Heri Hermanto', 0, 0, '2023-08-22 02:27:35', ''),
(18, 'K 23', 'P 9629 UG', 2016, 'Rahmat Hidayat', 0, 0, '2023-08-22 02:27:35', ''),
(19, 'K 88', 'P 8242 UG', 2018, 'Joni H', 0, 0, '2023-08-22 02:27:35', ''),
(20, 'K 77', 'P 9161 UG', 2020, 'Suyono', 0, 0, '2023-08-22 02:27:35', ''),
(21, 'K 18', 'P 9475 UG', 2011, 'Office', 0, 0, '2023-08-22 02:27:35', ''),
(22, 'K 99', 'P 8297 UQ', 2018, 'Office', 0, 0, '2023-08-22 02:27:35', ''),
(23, 'GRANDMAX', 'P 8252 GE', 2016, 'Office', 0, 0, '2023-08-22 02:27:35', ''),
(24, 'FUTURA', 'P 9611 GE', 2017, 'Office', 0, 0, '2023-08-22 02:27:35', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tamu`
--

CREATE TABLE `tb_tamu` (
  `id` int(11) NOT NULL,
  `tanggal` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `perusahaan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jumlahpersonil` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `jammasuk` text NOT NULL,
  `jamkeluar` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tamu`
--

INSERT INTO `tb_tamu` (`id`, `tanggal`, `nama`, `perusahaan`, `alamat`, `jumlahpersonil`, `tujuan`, `jammasuk`, `jamkeluar`, `keterangan`) VALUES
(1, '2024-06-19', 'ROZAK', '#', 'KLOMPANGAN AJUNG', '1', 'LOBY', '10:26', '10:30', 'COUSTOMER'),
(2, '2024-06-19', 'BADAR', '#', 'SUKOWONO', '1', 'IBU YUYUN', '09:07', '10:41', 'COUSTOMER'),
(3, '2024-06-19', 'CEPI', 'PT. BCA', 'JEMBER', '2', 'BPK YANTO', '10:23', '10:53', 'TAMU'),
(4, '2024-06-19', 'AGUNG', 'PT.EXCEL', 'JEMBER', '3', 'BAPAK AGUS', '10:18', '11:34', 'TAMU'),
(5, '2024-06-19', 'YENI', 'BANK BCA', 'JEMBER', '2', 'IBU ANNELIA', '10:20', '11:35', 'TAMU'),
(6, '2024-06-19', 'EDI', 'POLSEK AJUNG', 'AJUNG', '3', 'BAPAK YANTO', '11:38', '12:07', 'TAMU'),
(7, '2024-06-19', 'ALDI', '#', 'JEMBER', '1', 'BPK YANTO', '10:34', '12:11', 'TAMU'),
(8, '2024-06-19', 'EDI', 'FMC', 'JEMBER', '1', 'BPK AGOES', '10:29', '12:19', 'TAMU'),
(9, '2024-06-19', 'IKBAL', 'ANT', 'JEMBER', '1', 'BAPAK IBNU', '10:41', '12:19', 'TAMU'),
(10, '2024-06-19', 'Dedy hidayat', 'BM', 'JEMBER', '1', 'NURUL IMAM', '11:37', '12:19', 'TAMU'),
(11, '2024-06-19', 'HUDA', 'PT.RAJA', 'JEMBER', '3', 'BAPAK AGUS', '10:19', '13:01', 'TAMU'),
(12, '2024-06-19', 'OBIT,EVA', 'BANK BRI', 'JEMBER', '2', 'IBU IKA', '12:41', '13:14', 'TAMU'),
(13, '2024-06-19', 'IZUL', '#', 'JEMBER', '1', 'IBU YUYUN', '13:16', '14:13', 'COUSTOMER'),
(14, '2024-06-19', 'WIDI', 'PT. PRIMA KARYA', 'JEMBER', '2', 'BPK AGOES', '13:01', '14:13', 'TAMU'),
(15, '2024-06-19', 'TEGUH', 'PT. SAPROTAN UTAMA', 'JEMBER', '1', 'BAPAK SUPRI', '14:14', '14:36', 'TAMU'),
(16, '2024-06-19', 'AGUS', 'MITRA TANI', 'JEMBER', '3', 'IBU YUYUN', '15:03', '16:39', 'COUSTOMER'),
(17, '2024-06-19', 'HENDRIK', 'PT.BAF', 'JEMBER', '2', 'IBU ITA', '14:17', '16:39', 'TAMU'),
(18, '2024-06-19', 'IMAM', 'PT. BISI', 'JEMBER', '1', 'BAPAK AGUS', '14:14', '16:39', 'TAMU');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tamu_lby`
--

CREATE TABLE `tb_tamu_lby` (
  `id` int(11) NOT NULL,
  `tanggal` text NOT NULL,
  `nama` text NOT NULL,
  `perusahaan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jumlahpersonil` int(12) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `jammasuk` text NOT NULL,
  `jamkeluar` text NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tamu_lby`
--

INSERT INTO `tb_tamu_lby` (`id`, `tanggal`, `nama`, `perusahaan`, `alamat`, `jumlahpersonil`, `tujuan`, `jammasuk`, `jamkeluar`, `keterangan`) VALUES
(892, '2024-06-20', 'EDI', 'BENH MEYER', 'JEMBER', 2, 'BPK.AGUS', '13:47', '', 'TAMU'),
(893, '2024-06-20', 'YENI', 'BCA', 'JEMBER', 1, 'IBU ANNELIA', '14:11', '', 'TAMU');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tmp_lap_distribusi`
--

CREATE TABLE `tb_tmp_lap_distribusi` (
  `id_lap_dis` int(12) NOT NULL,
  `kd_deliveri` varchar(25) NOT NULL,
  `tgl_jalan` text NOT NULL,
  `kd_driver` varchar(25) NOT NULL,
  `kd_helper` varchar(25) NOT NULL,
  `kd_truk` varchar(25) NOT NULL,
  `destinasi` text NOT NULL,
  `tgl_masuk` text NOT NULL,
  `jm_masuk` text NOT NULL,
  `km_masuk` int(12) NOT NULL,
  `tgl_keluar` text NOT NULL,
  `jm_keluar` text NOT NULL,
  `km_keluar` int(12) NOT NULL,
  `status` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tmp_lap_distribusi`
--

INSERT INTO `tb_tmp_lap_distribusi` (`id_lap_dis`, `kd_deliveri`, `tgl_jalan`, `kd_driver`, `kd_helper`, `kd_truk`, `destinasi`, `tgl_masuk`, `jm_masuk`, `km_masuk`, `tgl_keluar`, `jm_keluar`, `km_keluar`, `status`, `keterangan`) VALUES
(2, 'KIUD2310230001', '2023-10-24', 'KIU0508230010', 'KIU0508230021', 'K 25', 'Malang', '', '', 0, '', '', 0, 'READY', ''),
(3, 'KIUD2310230001', '2023-10-24', 'KIU0508230011', 'KIU0508230022', 'K 15', 'Ponorogo', '2023-10-23', '12.00', 35123, '2023-10-23', '10.00', 30000, 'READY', ''),
(4, 'KIUD2310230001', '2023-10-24', 'KIU0508230012', 'KIU0508230023', 'K 21', 'Surabaya', '', '', 0, '', '', 0, 'READY', ''),
(5, 'KIUD2310230001', '2023-10-24', 'KIU0508230013', 'KIU0508230024', 'K 16', 'Madura', '', '', 0, '', '', 0, 'READY', ''),
(6, 'KIUD2310230001', '2023-10-24', 'KIU0508230014', 'KIU0508230025', 'K 89', 'Bali', '', '', 0, '', '', 0, 'READY', ''),
(7, 'KIUD2310230001', '2023-10-24', 'KIU0508230015', 'KIU0508230026', 'K 57', 'Kediri', '', '', 0, '', '', 0, '', ''),
(8, 'KIUD2310230001', '2023-10-24', 'KIU0508230016', 'KIU0508230027', 'K 11', 'Lumajang', '', '', 0, '', '', 0, '', ''),
(9, 'KIUD2310230001', '2023-10-24', 'KIU0508230017', 'KIU0508230028', 'K 17', 'Randuagung', '', '', 0, '', '', 0, '', ''),
(10, 'KIUD2310230001', '2023-10-24', 'KIU0508230018', 'KIU0508230029', 'K 59', 'Tanggul', '', '', 0, '', '', 0, '', ''),
(11, 'KIUD2310230001', '2023-10-24', 'KIU0508230002', 'KIU0508230030', 'K 12', 'Bangsal', '', '', 0, '', '', 0, '', ''),
(12, 'KIUD2310230001', '2023-10-24', 'KIU0508230003', 'KIU0508230031', 'K 58', 'Banyuwangi', '', '', 0, '', '', 0, '', ''),
(13, 'KIUD2310230001', '2023-10-24', 'KIU0508230005', 'KIU0508230032', 'K 45', 'Situbondo', '', '', 0, '', '', 0, '', ''),
(14, 'KIUD2310230001', '2023-10-24', 'KIU0508230006', 'KIU0508230034', 'K 36', 'Bondowoso', '', '', 0, '', '', 0, '', ''),
(15, 'KIUD2310230001', '2023-10-24', 'KIU0508230007', 'KIU0508230033', 'K 28', 'Klakah', '', '', 0, '', '', 0, '', ''),
(16, 'KIUD2310230001', '2023-10-24', 'KIU0508230008', 'KIU0508230035', 'K 78', 'Pasuruan', '', '', 0, '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_truck`
--

CREATE TABLE `tb_truck` (
  `id` int(11) NOT NULL,
  `nm_plat` varchar(25) NOT NULL,
  `no_plat` varchar(25) NOT NULL,
  `kd_driver` varchar(25) NOT NULL,
  `nm_driver` text NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `kode_user` varchar(25) NOT NULL,
  `nama_user` text NOT NULL,
  `nama_lengkap` text NOT NULL,
  `departemen` text NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lahir` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `akses_lv` int(2) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nik`, `kode_user`, `nama_user`, `nama_lengkap`, `departemen`, `alamat`, `tgl_lahir`, `username`, `password`, `akses_lv`, `create_at`) VALUES
(1, '', 'KIU1007230001', 'SUPERADMIN', '', 'IT', '', '', 'admin', '$2y$10$MGM1lvOhXAOJA8qN7E6ddOtoiy6IwRKmE4NOFvs9vDOXrgbJYPZGi', 1, '2023-08-22 05:58:36'),
(2, '', 'KIU1007230002', 'Maulana Malik Ibrahim', 'MAULANA MALIK IBRAHIM', 'KEUANGAN', '', '', 'bram', '$2y$10$356r0xaFtVhf07EAi8f/KOMbu2IdjfGQ8UMWIXLOmgcDWIGBxIjI6', 2, '2023-08-22 05:58:36'),
(3, '', 'KIU1107230001', 'Admin Logistik', '', 'LOGISTIK', '', '', 'logistik', '$2y$10$foKXIn2aqQgVpi9s7hHLEuKCSzZzANzO.O1P3MvPzkIpmjZNIP3I2', 1, '2023-08-22 05:58:36'),
(4, '', 'KIU3107230004', 'Security', '', 'HRD GA', '', '', 'HRD4', '$2y$10$.xAZu8QGLrYkkNpUYTkruesZvupQ3WxlRnylR9gaiTvaT07FRCsWW', 2, '2023-08-22 05:58:36'),
(5, 'QIU0412025', 'KIU2208230001', 'Yanto', 'LISGIANTO', 'HRD GA', 'JL. SUMATRA VII/126 LINGK.TEGAL BOTO KIDUL, RT/RW : 002/032, DS. SUMBERSARI, KEC. SUMBERSARI - JEMBER', '1972-12-03', 'HRD1', '$2y$10$.xAZu8QGLrYkkNpUYTkruesZvupQ3WxlRnylR9gaiTvaT07FRCsWW', 2, '2023-08-22 07:01:06'),
(6, 'QIU1610178', 'KIU2208230002', 'Arif R', 'ARIF RAOSA FIKRI', 'HRD GA', 'DUSUN SUMBEREJO, RT/RW : 003/003, DESA PONDOKREJO, KECAMATAN TEMPUREJO, KABUPATEN JEMBER', '1990-06-14', 'HRD3', '$2y$10$.xAZu8QGLrYkkNpUYTkruesZvupQ3WxlRnylR9gaiTvaT07FRCsWW', 2, '2023-08-22 05:58:36'),
(7, 'QIU1011047', 'KIU2208230003', 'Wawan', 'WAWAN SAURODI', 'HRD GA', 'JL. HAYAM WURUK 178 LINGK.KRAJAN RT/RW : 001/011 DS. MANGLI KEC. KALIWATES - JEMBER', '1982-06-15', 'karisma1', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(8, 'QIU1511098', 'KIU2208230004', 'Ivan', 'IVAN RIAN PRAYUGO', 'HRD GA', 'DUSUN BOTOSARI, RT/RW : 002/004, DS. DUKUH MENCEK, KEC. SUKORAMBI - JEMBER (68151', '1994-06-30', 'karisma2', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(9, 'QIU1609156', 'KIU2208230005', 'Firman', 'FIRMAN KURNIAWAN', 'HRD GA', 'PERUMDIM V/18 DUSUN KRAJAN, RT/RW : 005/004, DS. JUBUNG, KEC.SUKORAMBI - JEMBER (68151)', '1986-04-04', 'karisma3', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(10, 'QIU1612182', 'KIU2208230006', 'ELDI ABDILLAH', 'ELDI ABDILLAH', 'HRD GA', 'DUSUN KRAJAN RT.002, RW.006 DS. PETUNG KEC. BANGSALSARI KAB. JEMBER ', '1993-10-26', 'karisma4', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(11, 'QIU1705210', 'KIU2208230007', 'TRIYONO', 'TRIYONO', 'HRD GA', 'PERUM SUMBERSARI PERMAI 2 BLOK BS-04, KEL. KRANJINGAN KEC. SUMBERSARI KAB.  JEMBER', '1979-12-20', 'karisma5', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(12, 'QIU1709224', 'KIU2208230008', 'SETYO BUDI PRAYITNO', 'SETYO BUDI PRAYITNO', 'HRD GA', 'DUSUN DUKLENGKONG RT.003 RW.015 DS. PATEMON KEC. PAKUSARI KAB. JEMBER', '1988-02-24', 'karisma6', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(13, 'QIU1709228', 'KIU2208230009', 'ROYSON', 'ROYSON', 'HRD GA', 'DUSUN CURAHREJO RT.004, RW.025 DS. CANGKRING KEC. JENGGAWAH KAB. JEMBER', '1992-02-20', 'karisma7', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(14, 'QIU1707220', 'KIU2208230010', 'AHMAD EFENDI', 'AHMAD EFENDI', 'HRD GA', 'JL. IMAM BONJOL NO.171 LINGK. KRAJAN RT/RW.003/004 KALIAWATES - JEMBER', '1974-07-01', 'karisma8', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(15, 'QIU2211304', 'KIU2208230011', 'Ria', 'DZIKRIA LINDA PURYANTI', 'HRD GA', 'JL. KERTAJAYA II/155, KEL JEMBER KIDUL, KECAMATAN KALIWATES, JEMBER', '1988-10-16', 'KARYAWAN-', '$2y$10$.xAZu8QGLrYkkNpUYTkruesZvupQ3WxlRnylR9gaiTvaT07FRCsWW', 2, '2024-03-19 03:03:47'),
(16, 'SPM001', 'KIU2208230012', 'ABDUL HAJI', 'ABDUL HAJI', 'HRD GA', 'DUSUN LECES RT.005 RW.006 DS. SRUNI KEC. JENGGAWAH KAB. JEMBER', '1990-01-03', 'karisma9', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(17, 'SPM002', 'KIU2208230013', 'AGHI ACHSANNA NOVIAN', 'AGHI ACHSANNA NOVIAN', 'HRD GA', 'DUSUN CURAH KETING, RT.001 RW.003 DS. KARANGSONO KEC. BANGSALSARI KAB. JEMBER', '1996-11-06', 'karisma10', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(18, 'SPM003', 'KIU2208230014', 'YUSJI', 'YUSJI', 'HRD GA', 'DUSUN LUMBUNG RT.013 RW.005 DS. KEMIRIAN KEC. TAMANAN KAB. BONDOWOSO ', '1985-05-24', 'karisma11', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(19, 'SPM028', 'KIU2208230015', 'AHMAD BASORI', 'AHMAD BASORI', 'HRD GA', 'DUSUN BEDADUNG KULON RT.009 RW.013, DS. KALIWINING, KEC. RAMBIPUJI, KAB. JEMBER ', '1999-01-26', 'karisma12', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(20, 'SPM004', 'KIU2208230016', 'SUWITO EFENDI', 'SUWITO EFENDI', 'HRD GA', 'DUSUN SEKARPUTIH, RT.020/RW.005 DS.  SEKARPUTIH KEC. TEGALAMPEL KAB. BONDOWOSO', '1983-07-12', 'karisma13', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(21, 'QIU0110011', 'KIU2208230017', 'DIANA WULANDARI', 'DIANA WULANDARI', 'KEUANGAN', 'JL. PB SUDIRMAN VI/44 LINGK. PAGAH, RT/RW : 003/019, DESA: JEMBER LOR, KECAMATAN: PATRANG -JEMBER (68118)', '1977-07-05', 'karisma14', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(22, 'QIU1101054', 'KIU2208230018', 'VITA', 'VITA ARI PUSPITA', 'KEUANGAN', 'JL. MANYAR 46, RT/RW: 001/003, DESA: SLAWU, KECAMATAN: PATRANG - JEMBER (68116)', '1987-01-19', 'KIUTC1', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-23 03:53:33'),
(23, 'QIU1101054', 'KIU2208230019', 'SUPRIYANTO', 'SUPRIYANTO', 'KEUANGAN', 'JL. MANYAR 46, RT/RW: 001/003, DESA: SLAWU, KECAMATAN: PATRANG - JEMBER (68116)', '1987-01-19', 'karisma16', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(24, 'QIU0910042', 'KIU2208230020', 'IKA HERDIANA UTAMI', 'IKA HERDIANA UTAMI', 'KEUANGAN', 'JL. ANGGUR I/8, RT/RW: 002/002, DESA: PATRANG, KECAMATAN: PATRANG - JEMBER (68111)', '1982-05-07', 'karisma17', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(25, 'QIU1311074', 'KIU2208230021', 'DEWI SUNDARI', 'DEWI SUNDARI', 'KEUANGAN', 'JL. TEUKU UMAR 29, RT/RW: 001/004, DESA: KEBONSARI, KECAMATAN: SUMBERSARI - JEMBER (68122)', '1986-04-05', 'karisma18', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(26, 'QIU1503088', 'KIU2208230022', 'ARFINILA MAZIDAH', 'ARFINILA MAZIDAH', 'KEUANGAN', 'PERUM GUNUNG BATU PERMAI CC-3 LINGK. KRAJAN BARAT, RT/RW: 002/006, DESA: SUMBERSARI, KECAMATAN: SUMBERSARI - JEMBER (68121)', '1992-06-12', 'karisma19', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(27, 'QIU0711036', 'KIU2208230023', 'TRI SULISTIYO ARTANTO K', 'TRI SULISTIYO ARTANTO K', 'KEUANGAN', 'JL. ARGOPURO DUSUN KRAJAN KIDUL, RT/RW: 001/018, DESA: RAMBIGUNDAM, KECAMATAN: RAMBIPUJI - JEMBER (68152)', '1977-12-27', 'karisma20', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(28, 'QIU1503089', 'KIU2208230024', 'ARINI DINA YASMIN', 'ARINI DINA YASMIN', 'KEUANGAN', 'JL. RA. KARTINI 14/24, RT/RW: 001/006, KELURAHAN: SIDOMORO, KECAMATAN: KEBOMAS - GRESIK (61122)', '1992-03-12', 'karisma21', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(29, 'QIU1608149', 'KIU2208230025', 'IFA ISTIFARINI', 'IFA ISTIFARINI', 'KEUANGAN', 'DUSUN PRING TALI, RT/RW: 002/017, DESA: MRAWAN, KECAMATAN: MAYANG -JEMBER (68182)', '1992-01-15', 'karisma22', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(30, 'QIU1709230', 'KIU2208230026', 'FATIKHATUL FAJRIYAH', 'FATIKHATUL FAJRIYAH', 'KEUANGAN', 'DUSUN KRANGKONGAN, RT 002, RW 012, DESA TEGAL WANGI, KECAMATAN UMBULSARI, JEMBER', '1992-06-06', 'karisma23', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(31, 'QIU1808278', 'KIU2208230027', 'RIZA DWI FITRIANINGTYAS', 'RIZA DWI FITRIANINGTYAS', 'KEUANGAN', 'DUSUN MOJO, RT 003, RW 004, DESA BITING, KECAMATAN ARJASA, JEMBER', '1996-02-19', 'HRD2', '$2y$10$.xAZu8QGLrYkkNpUYTkruesZvupQ3WxlRnylR9gaiTvaT07FRCsWW', 2, '2024-03-19 03:04:36'),
(32, 'QIU1907303', 'KIU2208230028', 'NADIA PRAVITA', 'NADIA PRAVITA', 'KEUANGAN', 'JL KARIMATA GG PAJAK NO.9, RT 004, RW 004, KEL SUMBERSARI, KECAMATAN SUMBERSARI, JEMBER', '1996-12-03', 'karisma25', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(33, 'QIU1910311', 'KIU2208230029', 'MIRZA', 'MUHAMMAD MIRZA FIRDAUS', 'KEUANGAN', 'DUSUN BRINGIN LAWANG, RT 005, RW 005, DESA WONOJATI, KECAMATAN JENGGAWAH, JEMBER', '1995-01-20', 'KIUTC4', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-23 03:53:44'),
(34, 'QIU1910315', 'KIU2208230030', 'WAHYU ARIF PRASETYO', 'WAHYU ARIF PRASETYO', 'KEUANGAN', 'DUSUN LIMBUNGAN, RT 002, RW 019, DESA AJUNG, KECAMATAN AJUNG, JEMBER', '1994-02-07', 'karisma27', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(35, 'QIU1912323', 'KIU2208230031', 'MITRA SEPTIANA', 'MITRA SEPTIANA', 'KEUANGAN', 'DUSUN JAMBESARI, RT 002, RW 009, DESA LENGKONG, KECAMATAN MUMBULSARI, JEMBER', '1997-09-15', 'karisma28', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(36, 'MIA2101254', 'KIU2208230032', 'IKA ANISA PUTRI', 'IKA ANISA PUTRI', 'KEUANGAN', 'DUSUN LATENG, RT/RW.02/01 DESA GLAGAH, KEC. ROGOJAMPI, BANYUWANGI', '1998-12-21', 'karisma29', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(37, 'QIU2108265', 'KIU2208230033', 'AHMAD SYAITI', 'AHMAD SYAITI', 'KEUANGAN', 'DUSUN TEGAL PAKIS, RT 006, RW 003, DESA KALIBARU WETAN, KECAMATAN KALIBARU, BANYUWANGI', '1996-02-04', 'karisma30', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(38, 'QIU2102255', 'KIU2208230034', 'HENDRA', 'HENDRA ARIS SETIAWAN', 'KEUANGAN', 'DUSUN KRAJAN, RT 003, RW 001, DESA SIDODADI, KECAMATAN TEMPUREJO, KABUPATEN JEMBER.', '1996-03-14', 'KIUTC2', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-23 03:53:53'),
(39, 'QIU2205287', 'KIU2208230035', 'FARIDA', 'DEWI FARIDA', 'KEUANGAN', 'JL JAGUNG SUPRAPTO GG TIRTO ARUM, RT 004, RW 002, DESA PENGANJURAN, KECAMATAN BANYUWANGI, KABUPATEN BANYUWANGI', '1996-04-18', 'KIUTC3', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-23 03:53:57'),
(40, 'QIU2206294', 'KIU2208230036', 'MAULANA MALIK IBRAHIM', 'MAULANA MALIK IBRAHIM', 'KEUANGAN', 'JL. SEMANGKA 31 A, RT 001, RW 004, KEL BARATAN, KECAMATAN PATRANG, JEMBER', '1996-06-19', 'karisma33', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(41, 'QIU2206295', 'KIU2208230037', 'DHANY RIFALDI FEBRIANSYAH', 'DHANY RIFALDI FEBRIANSYAH', 'KEUANGAN', 'JL. KALIMANTAN 142 DUSUN KARANGANYAR, RT 002, RW 004, DESA BALUNG LOR, KECAMATAN BALUNG, JEMBER', '1999-02-21', 'karisma34', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(42, 'QIU2203285', 'KIU2208230038', 'PUTRI SUKMA IANATUNNISA', 'PUTRI SUKMA IANATUNNISA', 'KEUANGAN', 'JL GAJAH MADA XIV LINGK CONDRO, RT 005, RW 007, KALIWATES, KECAMATAN KALIWATES, JEMBER.', '1996-06-20', 'karisma35', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(43, 'QIU2210301', 'KIU2208230039', 'ADHINDA RACHMA AMINY', 'ADHINDA RACHMA AMINY', 'KEUANGAN', 'JL. CEMPAKA NO 38, RT 003, RW 004, KEL GEBANG, KECAMATAN PATRANG, JEMBER', '1999-03-26', 'karisma36', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(44, 'QIU2211303', 'KIU2208230040', 'DEVA SARI VIOLANDANI', 'DEVA SARI VIOLANDANI', 'KEUANGAN', 'DUSUN KRATON, RT 008, RW 002, DESA WONOASRI, KECAMATAN TEMPUREJO, KABUPATEN JEMBER', '1999-12-04', 'karisma37', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(45, 'QIU2212306', 'KIU2208230041', 'FARIS', 'FARIS SEPTIA NILASARI', 'KEUANGAN', 'DUSUN KRATON, RT 004, RW 002, DESA WONOASRI, KECAMATAN TEMPUREJO, KABUPATEN JEMBER', '2000-09-17', 'KIUTC5', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-23 03:54:05'),
(46, 'QIU2212307', 'KIU2208230042', 'NANANG KHOIRUL ANAM', 'NANANG KHOIRUL ANAM', 'KEUANGAN', 'DUSUN KRAJAN, RT 002, RW 010, DESA SLATENG, KECAMATAN LEDOKOMBO, KABUPATEN JEMBER', '1999-12-14', 'karisma39', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(47, 'QIU2301311', 'KIU2208230043', 'RENI', 'RENI ICHA ASTARI', 'KEUANGAN', 'DUSUN KRAJAN, RT 002, RW 008, DESA MOJOSARI, KECAMATAN PUGER, KABUPATEN JEMBER', '1999-11-12', 'KIUTC6', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-23 03:54:09'),
(48, 'QIU2302314', 'KIU2208230044', 'ARIYANI', 'ARIYANI', 'KEUANGAN', 'DUSUN PRINGTALI, RT 002, RW 017, DESA MRAWAN, KECAMATAN MAYANG, KABUPATEN JEMBER', '1998-07-26', 'KIUTC7', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-23 03:52:45'),
(49, 'QIU2308220', 'KIU2208230045', 'MUSTOFA', 'MUSTOFA', 'KEUANGAN', 'DUSUN KRAJAN, RT 003, RW 003, DESA KLUNGKUNG, KECAMATAN SUKORAMBI, KABUPATEN JEMBER', '1991-07-03', 'karisma42', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(50, 'QIU1401080', 'KIU2208230046', 'NANDANG ERNOKO', 'NANDANG ERNOKO', 'LOGISTIC', 'PESONA CENGGER AYAM F-2, RT/RW : 001/014, DS. TULUSREJO KEC. LOWOKWARU - MALANG (65141)', '1966-10-19', 'karisma43', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(51, 'QIU0703034', 'KIU2208230047', 'MUHAMMAD SHOLEH', 'MUHAMMAD SHOLEH', 'LOGISTIC', 'JL. KH. WAHID HASYIM I/III/84 LINGK. KEPATIHAN, RT/RW : 003/002 DS. KEPATIHAN KEC. KALIWATES - JEMBER (68137)', '1987-01-20', 'karisma44', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(52, 'QIU0705035', 'KIU2208230048', 'NOVIANTO PUTRA KUSUMARDIKO', 'NOVIANTO PUTRA KUSUMARDIKO', 'LOGISTIC', 'JL. KERTABUMI II/113 LINGK. TELENGSARI, RT/RW : 001/007, DS. JEMBER KIDUL KEC. KALIWATES - JEMBER (68131)', '1986-11-03', 'karisma45', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(53, 'QIU1202060', 'KIU2208230049', 'HENDRI YANTO', 'HENDRI YANTO', 'LOGISTIC', 'JL. ARGOPURO 20, RT/RW: 002/001, DS. RAMBIGUNDAM KEC. RAMBIPUJI - JEMBER (68152)', '1985-07-07', 'karisma46', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(54, 'QIU0202014', 'KIU2208230050', 'MOHAMMAD ROSYID', 'MOHAMMAD ROSYID', 'LOGISTIC', 'JL. DARMAWANGSA 94 DSN. KRAJAN RT/RW : 003/002 DS. JUBUNG KEC. SUKORAMBI - JEMBER (68151)', '1969-08-08', 'karisma47', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(55, 'QIU0605032', 'KIU2208230051', 'SUGIANTO', 'SUGIANTO', 'LOGISTIC', 'PERUM JEMBER PERMAI II/P-5 LINGK. KRAJAN TIMUR RT/RW : 003/005 DS. SUMBERSARI KEC. SUMBERSARI - JEMBER (68121)', '1986-06-07', 'karisma48', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(56, 'QIU0501026', 'KIU2208230052', 'FARUQ ABDULLOH MANSYHUR', 'FARUQ ABDULLOH MANSYHUR', 'LOGISTIC', 'DUSUN CURAH BUNTU, RT/RW : 008/009 DS. JENGGAWAH KEC. JENGGAWAH - JEMBER (68171)', '1984-07-27', 'karisma49', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(57, 'QIU1011045', 'KIU2208230053', 'HERI SETIAWAN', 'HERI SETIAWAN', 'LOGISTIC', 'DUSUN CURAH BUNTU, RT/RW : 008/009 DS. JENGGAWAH KEC. JENGGAWAH - JEMBER (68171)', '1988-09-20', 'karisma50', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(58, 'QIU1608150', 'KIU2208230054', 'ALLIF FATUN NASU ALLIFIN', 'ALLIF FATUN NASU ALLIFIN', 'LOGISTIC', 'DUSUN KOTOKAN RT/RW : 001/008 DS. JATIROTO KEC. JATIROTO - LUMAJANG (67355)', '1990-10-10', 'karisma51', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(59, 'QIU1608151', 'KIU2208230055', 'FERY BUDI SETIAWAN', 'FERY BUDI SETIAWAN', 'LOGISTIC', 'PERUMDIM JALUR VI NO.F41 DSN KRAJAN RT/RW : 004/007 DS. JUBUNG, KEC. SUKORAMBI - JEMBER (68161)', '1991-03-31', 'karisma52', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(60, 'QIU1705212', 'KIU2208230056', 'NURUL IMAM FITRIADI YASIN', 'NURUL IMAM FITRIADI YASIN', 'LOGISTIC', 'JL KENANGA 6 NO. 71 KEL. JEMBER KIDUL KEC. KALIWATES - JEMBER', '1992-04-06', 'karisma53', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(61, 'QIU1709231', 'KIU2208230057', 'NURUL AINI', 'NURUL AINI', 'LOGISTIC', 'JL. KENANGA I/79 LINGK LEDOK KEBON KOPI RT.003 RW.019 KEL. JEMBER KIDUL KEC. KALIWATES - JEMBER', '1993-12-14', 'karisma54', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(62, 'QIU1807269', 'KIU2208230058', 'ANITA HERI UTAMI', 'ANITA HERI UTAMI', 'LOGISTIC', 'DUSUN KRAJAN RT.002 RW.008 DS. SUKORAMBI KEC. SUKORAMBI - JEMBER', '1993-02-08', 'karisma55', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(63, 'QIU1810285', 'KIU2208230059', 'YUNIKA DEWI WULANINGTYAS', 'YUNIKA DEWI WULANINGTYAS', 'LOGISTIC', 'DUSUN CURAH REJO RT.002 RW.001 DS. SUKAMAKMUR KEC. AJUNG - JEMBE', '1990-06-02', 'karisma56', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(64, 'QIU0111012', 'KIU2208230060', 'AMAL MARUF', 'AMAL MARUF', 'LOGISTIC', 'JL. TAWANGMANGU NO.115 RT/RW : 003/002 KEL. TEGALGEDE KEC. SUMBERSARI - JEMBER ', '1982-02-15', 'karisma57', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(65, 'QIU1101052', 'KIU2208230061', 'SUYONO', 'SUYONO', 'LOGISTIC', 'DUSUN AMPELDENTO RT/RW : 002/001 DS. BAGOREJO KEC. GUMUKMAS - JEMBER (68165)', '1971-11-10', 'karisma58', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(66, 'QIU1011046', 'KIU2208230062', 'KRISTIAN BUDI WALUYO', 'KRISTIAN BUDI WALUYO', 'LOGISTIC', 'DUSUN CURAH BUNTU RT/RW : 008/009 DS. JENGGAWAH KEC. JENGGAWAH - JEMBER (68171)', '1989-02-27', 'karisma59', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(67, 'QIU1409084', 'KIU2208230063', 'ALI WAFA', 'ALI WAFA', 'LOGISTIC', 'JL. IMAM BONJOL VII/40 LINGK. KRAJAN, RT/RW. 003/004 DS. KALIWATES KEC. KALIWATES - JEMBER (68133)', '1996-08-04', 'karisma60', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(68, 'QIU1605130', 'KIU2208230064', 'RIBUT SANTOSO', 'RIBUT SANTOSO', 'LOGISTIC', 'JL. TERATAI VII LINGK. CONDRO UTARA RT/RW : 002/006 DS. KALIWATES KEC. KALIWATES - JEMBER (68133)', '1982-08-28', 'karisma61', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(69, 'QIU1704209', 'KIU2208230065', 'JONI HARIYANTO', 'JONI HARIYANTO', 'LOGISTIC', 'DSN KRAJAN RT.001 RW.005 DS. AJUNG KEC. AJUNG, JEMBER', '1979-01-16', 'karisma62', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(70, 'QIU1804261', 'KIU2208230066', 'SAMHADI', 'SAMHADI', 'LOGISTIC', 'JL. IMAM BONJOL KEDUNG PIRING RT. 002 /RW.013 KEL. TEGAL BESAR KEC. TEGAL BESAR - JEMBER', '1982-07-01', 'karisma63', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(71, 'QIU0102006', 'KIU2208230067', 'TIMAN', 'TIMAN', 'LOGISTIC', 'DUSUN WEDUSAN, RT/RW: 003/009, DESA: JATIROTO, KECAMATAN: JATIROTO - LUMAJANG (67355)', '1966-06-30', 'karisma64', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(72, 'QIU0301019', 'KIU2208230068', 'GUNADI', 'GUNADI', 'LOGISTIC', 'DUSUN KRAJAN TENGAH RT/RW. 006/003 DS. KERTONEGORO KEC. JENGGAWAH - JEMBER (68171)', '1981-07-01', 'karisma65', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(73, 'QIU1311075', 'KIU2208230069', 'MIFTAHUL HUDA', 'MIFTAHUL HUDA', 'LOGISTIC', 'JL. PB. SUDIRMAN VI/48 LINGK. PAGAH RT/RW. 003/004 DS. JEMBER LOR KEC. PATRANG - JEMBER (68118)', '1987-07-08', 'karisma66', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(74, 'QIU1409085', 'KIU2208230070', 'MOCH. RICO PRATAMA', 'MOCH. RICO PRATAMA', 'LOGISTIC', 'JL. IMAM BONJOL NO. 176 RT/RW. 004/001 DS. KALIWATES KEC. KALIWATES -JEMBER (68133)', '1994-09-04', 'karisma67', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(75, 'QIU1409086', 'KIU2208230071', 'RAHMAT HIDAYAT', 'RAHMAT HIDAYAT', 'LOGISTIC', 'JL. MELATI GG. LINGK GEBANG TUNGGUL RT/RW. 001/004 DS. GEBANG KEC. PATRANG - JEMBER (68117)', '1985-05-21', 'karisma68', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(76, 'QIU1509095', 'KIU2208230072', 'IMAM BUKHORI', 'IMAM BUKHORI', 'LOGISTIC', 'JL. IMAM BONJOL NO. 10 GG IMAM HAMBALI RT/RW. 001/012 KEL. TEGAL BESAR KEC. KALIWATES - JEMBER (68132)', '1991-09-19', 'karisma69', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(77, 'QIU1606133', 'KIU2208230073', 'HERI HERMANTO', 'HERI HERMANTO', 'LOGISTIC', 'JL. IMAM BONJOL LINGK KEDUNG PERENG RT/RW. 003/013 KEL. TEGAL BESAR, KEC. KALIWATES - JEMBER (68132)', '1989-05-24', 'karisma70', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(78, 'QIU1606134', 'KIU2208230074', 'IWAN HIDAYAT', 'IWAN HIDAYAT', 'LOGISTIC', 'JL. SULTAN AGUNG 8/81 LINGK KAUMAN RT/RW. 002/013 KEL. KEPATIHAN KEC. KALIWATES - JEMBER (68137)', '1991-08-28', 'karisma71', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(79, 'QIU1707219', 'KIU2208230075', 'AHMAD ARIFIN', 'AHMAD ARIFIN', 'LOGISTIC', 'DUSUN AJUNG TENGAH RT.003 RW.010 DS. AJUNG KEC. KALISAT - JEMBER', '1992-07-01', 'karisma72', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(80, 'QIU1709226', 'KIU2208230076', 'EKO WAHYUDI', 'EKO WAHYUDI', 'LOGISTIC', 'JL. PANGANDARAN RT.001 RW.002 KEL. ANTIROGO KEC. SUMBERSARI - JEMBER', '1993-08-31', 'karisma73', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(81, 'QIU2104259', 'KIU2208230077', 'KURNIAWAN PRATAMA ARIFIN', 'KURNIAWAN PRATAMA ARIFIN', 'LOGISTIC', 'DUSUN GURIT, RT 001, RW 001, DESA PENGATIGAN, KECAMATAN ROGOJAMPI, KABUPATEN BANYUWANGI', '1993-12-20', 'karisma74', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(82, 'QIU1803259', 'KIU2208230078', 'MUHAMMAD DAVI FIRMANSYAH', 'MUHAMMAD DAVI FIRMANSYAH', 'LOGISTIC', 'DUSUN KRASAK RT.006 RW.004 DS. PANCAKARYA KEC. AJUNG -  JEMBER', '1997-05-30', 'karisma75', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(83, 'QIU2002330', 'KIU2208230079', 'BAYU ISLAM SEPTIAN WILDANI', 'BAYU ISLAM SEPTIAN WILDANI', 'LOGISTIC', ' JALAN JERUK NOMOR 25, RT 002, RW 018, KELURAHAN PATRANG, KECAMATAN PATRANG, KABUPATEN JEMBER', '1993-09-14', 'karisma76', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(84, 'QIU2205288', 'KIU2208230080', 'MARIAN FITRIANSYAH', 'MARIAN FITRIANSYAH', 'LOGISTIC', 'JL. IMAM BONJOL 45 LINGK KEDUNG PIRING, RT 001, RW 012, TEGAL BESAR, KALIWATES, JEMBER', '1993-03-03', 'karisma77', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(85, 'QIU2206293', 'KIU2208230081', 'MOCH KHOZINUL ASROR', 'MOCH KHOZINUL ASROR', 'LOGISTIC', 'DUSUN GADUNGAN, RT 003, RW 013, DESA KASIYAN, KECAMATAN PUGER, KABUPATEN JEMBER', '1998-06-20', 'karisma78', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(86, 'SPM018', 'KIU2208230082', 'IMAM TURMUDI', 'IMAM TURMUDI', 'LOGISTIC', 'JL. SEMERU NO.64 DSN. KRAJAN RT. 001 RW.005 DS. AJUNG KEC. AJUNG KAB. JEMBER', '1983-07-09', 'karisma79', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(87, 'SPM027', 'KIU2208230083', 'MUHAMMAD RIFANDI', 'MUHAMMAD RIFANDI', 'LOGISTIC', 'DUSUN KRAJAN, RT 002, RW 006, DESA KASIYAN, KECAMATAN PUGER, JEMBER', '1994-08-07', 'karisma80', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(88, 'SPM031', 'KIU2208230084', 'SUGIHARTONO', 'SUGIHARTONO', 'LOGISTIC', 'DUSUN PDUKUAN LOR, RT 004, RW 010, DESA KARANGSEMANDING, KECAMATAN BALUNG, JEMBER', '1988-02-04', 'karisma81', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(89, 'SPM032', 'KIU2208230085', 'ROHMAN ALI', 'ROHMAN ALI', 'LOGISTIC', 'DUSUN KARANGAN, RT 004, RW 005, DESA CURAHKALONG, KECAMATAN BANGSALSARI, JEMBER', '1986-06-12', 'karisma82', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(90, 'SPM005', 'KIU2208230086', 'MUH. GOVIL ARDIANTO', 'MUH. GOVIL ARDIANTO', 'LOGISTIC', 'DUSUN LANGSEPAN RT/RW. 005/004 DS. JENGGAWAH KEC. JENGGAWAH - JEMBER', '1996-05-24', 'karisma83', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(91, 'SPM007', 'KIU2208230087', 'IHSAN MAHMUDI', 'IHSAN MAHMUDI', 'LOGISTIC', 'DUSUN CANGKRING BARU, RT.003 RW.017 DS. CANGKRING KEC. JENGGAWAH - JEMBER', '1996-04-04', 'karisma84', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(92, 'SPM011', 'KIU2208230088', 'HARI ISWANTO', 'HARI ISWANTO', 'LOGISTIC', 'DUSUN SUMBER DANDANG RT.001 RW.009 DS. KERTOSARI KEC. PAKUSARI - JEMBER', '1988-06-22', 'karisma85', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(93, 'SPM016', 'KIU2208230089', 'FERIKA KURNIAWAN', 'FERIKA KURNIAWAN', 'LOGISTIC', 'DUSUN GUMUK SEGAWE RT.002 RW.003 DS. PANCAKARYA KEC. AJUNG - JEMBER', '1996-07-22', 'karisma86', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(94, 'SPM017', 'KIU2208230090', 'DENI BAHTIAR', 'DENI BAHTIAR', 'LOGISTIC', 'DUSUN KLANCENG RT.005 RW.001 DS. AJUNG KEC. AJUNG - JEMBER', '1998-05-30', 'karisma87', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(95, 'SPM021', 'KIU2208230091', 'BAGUS SEPTIADHI', 'BAGUS SEPTIADHI', 'LOGISTIC', 'JL. DIPONEGORO IV/95 LINGK. KAMP TENGAH RT.003 RW.016 KEL. KEPATIHAN KEC. KALIWATES - JEMBER', '1996-09-03', 'karisma88', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(96, 'SPM033', 'KIU2208230092', 'YOGA PRIYO UTOMO', 'YOGA PRIYO UTOMO', 'LOGISTIC', 'DUSUN KRASAK, RT 001, RW 001, DESA PANCAKARYA, AJUNG, JEMBER', '1999-04-29', 'karisma89', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(97, 'SPM035', 'KIU2208230093', 'SONI SUPRIADI', 'SONI SUPRIADI', 'LOGISTIC', 'DUSUN KRASAK, RT 001, RW 001, DESA PANCAKARYA, AJUNG, JEMBER', '2001-08-02', 'karisma90', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(98, 'SPM036', 'KIU2208230094', 'BILLY BAGOCHI JIHAD', 'BILLY BAGOCHI JIHAD', 'LOGISTIC', 'DUSUN KRAJAN, RT 001, RW 002, DESA SUKORAMBI, KECAMATAN SUKORAMBI, KABUPATEN JEMBER', '1995-01-14', 'karisma91', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(99, 'SPM037', 'KIU2208230095', 'ADE BAGUS WICAKSONO', 'ADE BAGUS WICAKSONO', 'LOGISTIC', 'JL MH THAMRIN DUSUN KRAJAN, RT 002, RW 007, DESA AJUNG, KECAMATAN AJUNG, KABUPATEN JEMBER', '1995-07-06', 'karisma92', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(100, 'SPM037', 'KIU2208230096', 'BILLY KENCANA', 'BILLY KENCANA', 'LOGISTIC', 'JL MH THAMRIN DUSUN KRAJAN, RT 002, RW 007, DESA AJUNG, KECAMATAN AJUNG, KABUPATEN JEMBER', '1995-07-06', 'karisma93', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(101, 'SPM038', 'KIU2208230097', 'CATUR JEFRI PRADANA', 'CATUR JEFRI PRADANA', 'LOGISTIC', 'DUSUN CURAHBUNTU, RT 003, RW 009, DESA JENGGAWAH, KECAMATAN JENGGAWAH, KABUPATEN JEMBER', '1993-10-11', 'karisma94', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(102, 'SPM039', 'KIU2208230098', 'ENDHO AMMRI MADHA MANGGALA', 'ENDHO AMMRI MADHA MANGGALA', 'LOGISTIC', 'JL PB SUDIRMAN, RT 005, RW 003, DESA SERUT, KECAMATAN PANTI, KABUPATEN JEMBER', '1995-01-13', 'karisma95', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(103, 'SPM042', 'KIU2208230099', 'FAJAR PRASTIO', 'FAJAR PRASTIO', 'LOGISTIC', 'DUSUN KRESEK, RT 002, RW 008, DESA PANCAKARYA, KECAMATAN AJUNG, KABUPATEN JEMBER', '1998-12-03', 'karisma96', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(104, 'SPM044', 'KIU2208230100', 'ARIS FANDI FATHONI', 'ARIS FANDI FATHONI', 'LOGISTIC', 'DUSUN KRAJAN, RT 002, RW 008, DESA AMBULU, KECAMATAN AMBULU, KABUPATEN JEMBER', '1997-10-18', 'karisma97', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(105, 'SPM045', 'KIU2208230101', 'ALI MUSTAJAB', 'ALI MUSTAJAB', 'LOGISTIC', 'JL IMAM BONJOL GANG IMAM HAMBALI 44, RT 001, RW 012, KEL TEGALBESAR, KEC KALIWATES, JEMBER', '1997-07-27', 'karisma98', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(106, 'SPM047', 'KIU2208230102', 'ANANG SUDARTO', 'ANANG SUDARTO', 'LOGISTIC', 'DUSUN KRAJAN, RT 002, RW 005, DESA AJUNG, KECAMATAN AJUNG, KABUPATEN JEMBER', '1976-05-07', 'karisma99', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(107, 'SPM048', 'KIU2208230103', 'MAHRUS ALI', 'MAHRUS ALI', 'LOGISTIC', 'DUSUN KRAJAN, RT 001, RW 001, DESA KLATAKAN, KECAMATAN TANGGUL, KABUPATEN JEMBER', '1996-12-25', 'karisma100', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(108, 'QIU0905132', 'KIU2208230104', 'M. SYAIHU', 'M. SYAIHU', 'SALES', 'DUSUN REJOSARI RT/RW. 002/012 DS. GUMELAR KEC. BALUNG - JEMBER', '1970-12-04', 'karisma101', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(109, 'QIU1801281', 'KIU2208230105', 'JEFFRY FIRMANSYAH', 'JEFFRY FIRMANSYAH', 'SALES', 'JL. PB.SUDIRMAN GG RAHAYU III RT.001 RW.002 DS. PATOKAN KEC. SITUBONDO - SITUBONDO', '1988-04-25', 'karisma102', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(110, 'QIU1801256', 'KIU2208230106', 'HERU SUCAHYO', 'HERU SUCAHYO', 'SALES', 'DUSUN BANARAN, RT 018, RW 003, DESA KERIK, KECAMATAN TAKERAN, KABUPATEN MAGETAN', '1973-10-15', 'karisma103', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(111, 'QIU0101002', 'KIU2208230107', 'IBNU SUTORO', 'IBNU SUTORO', 'SALES', 'PERUM TEGAL BESAR PERMAI I AX/6F RT/RW : 001/009 DS. TEGALBESAR KEC. KALIWATES - JEMBER', '1973-10-12', 'karisma104', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(112, 'QIU0507028', 'KIU2208230108', 'WIRA GUNAWAN', 'WIRA GUNAWAN', 'SALES', 'PERUM TEGAL BESAR PERMAI I/AX-6 RT/RW : 005/007 DS. TEGALBESAR KEC. KALIWATES - JEMBER', '1974-01-07', 'karisma105', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(113, 'QIU0511030', 'KIU2208230109', 'EVI YULIA PURNAMA SARI', 'EVI YULIA PURNAMA SARI', 'SALES', 'JL.SUMATRA VII/126 LINGK.TEGAL BOTO KIDUL RT/RW : 002/032 DS.SUMBERSARI KEC.SUMBERSARI - JEMBER', '1987-07-11', 'karisma106', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(114, 'QIU1112056', 'KIU2208230110', 'YUNITASARI', 'YUNITASARI', 'SALES', 'JL LETJEN SUPRAPTO IV/104 RT/RW : 002/016 DS. KEBONSARI KEC. SUMBERSARI - JEMBER', '1990-06-09', 'karisma107', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(115, 'QIU1202062', 'KIU2208230111', 'NINA PUTRI AGUSTININGSIH', 'NINA PUTRI AGUSTININGSIH', 'SALES', 'JL.TERATAI VIII/148 LINGK.CONDRO RT/RW : 002/006 DS. KALIWATES KEC.KALIWATES - JEMBER', '1988-08-20', 'karisma108', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(116, 'QIU0106008', 'KIU2208230112', 'YUYUN INDAH WATI', 'YUYUN INDAH WATI', 'SALES', 'PERUM TEGAL BESAR II BLOK R-8 RT/RW : 005/002 DS. TEGAL BESAR KEC. KALIWATES - JEMBER', '1980-03-12', 'karisma109', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(117, 'QIU1607137', 'KIU2208230113', 'UMI ZULFA', 'UMI ZULFA', 'SALES', 'DUSUN PEKIRINGAN, RT/RW: 001/001, DESA SUMBERSARI, KECAMATAN SRONO, KABUPATEN BANYUWANGI', '1993-01-22', 'karisma110', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(118, 'QIU1702195', 'KIU2208230114', 'MUHAMMAD NUR HAFID', 'MUHAMMAD NUR HAFID', 'SALES', 'DUSUN PEKULO RT.002/RW.002 DS. KEPUNDUNGAN KEC. SRONO KAB. BANYUWANGI', '1989-10-30', 'karisma111', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(119, 'QIU1703200', 'KIU2208230115', 'PERDHANA YULINTINIA CAHYANI', 'PERDHANA YULINTINIA CAHYANI', 'SALES', 'PERUM ISTANA TIDAR REGENCY B 2/3, RT 006, RW 015, KELURAHAN SUMBERSARI, KECAMATAN SUMBERSARI, JEMBER', '1986-07-01', 'karisma112', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(120, 'QIU1810288', 'KIU2208230116', 'DIAN RIFA SYAIFUDIN', 'DIAN RIFA SYAIFUDIN', 'SALES', 'RINGIN ANOM RT.017/RW.003 DS. DOHO KEC. DOLOPO KAB. MADIUN', '1975-06-04', 'karisma113', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(121, 'QIU1811291', 'KIU2208230117', 'TOMI ARDIHANSYAH', 'TOMI ARDIHANSYAH', 'SALES', 'JL. TERUSAN SEGAWE NO. 14 MALANG', '1981-03-17', 'karisma114', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(122, 'QIU1708273', 'KIU2208230118', 'JULKIFLI', 'JULKIFLI', 'SALES', 'DUSUN KARYA, RT 003, RW 001, DESA NISA, KECAMATAN WOHA, BIMA, NTB', '1985-07-11', 'karisma115', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(123, 'QIU1904295', 'KIU2208230119', 'MUHAMAT ARIF', 'MUHAMAT ARIF', 'SALES', 'JL. SULTAN AGUNG RT.003 / RW.007 KEL. JOGOTRUMAN KEC. LUMAJANG KAB. LUMAJANG', '1991-10-04', 'karisma116', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(124, 'QIU1906301', 'KIU2208230120', 'NURUL OCFANI', 'NURUL OCFANI', 'SALES', 'JL MELATI GG PHB 80 LINGK PATTIMURA, RT 003, RW 027, KEL JEMBER KIDUL, KEC KALIWATES, JEMBER', '1994-10-23', 'karisma117', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(125, 'QIU1911321', 'KIU2208230121', 'ELOK RAUDATUL ADAWIYAH', 'ELOK RAUDATUL ADAWIYAH', 'SALES', 'JALAN KALIURANG PERUM ISTANA TIDAR, RT 006, RW 002, KEL SUMBERSARI, KEC SUMBERSARI, JEMBER', '1995-07-27', 'karisma118', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(126, 'QIU2001326', 'KIU2208230122', 'ZAQIATUL BAITY JANAH', 'ZAQIATUL BAITY JANAH', 'SALES', 'JALAN SUMATRA NO 115, DUSUN DUKUH, RT 003, RW 022, DESA DUKUH DEMPOK, KEC WULUHAN, JEMBER', '1995-05-13', 'karisma119', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(127, 'QIU2101253', 'KIU2208230123', 'NONIK DIA PERMATASARI', 'NONIK DIA PERMATASARI', 'SALES', 'DUSUN KRAJAN, RT 001, RW 007, DESA AMBULU, KECAMATAN AMBULU, KABUPATEN JEMBER.', '1996-11-10', 'karisma120', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(128, 'QIU2010245', 'KIU2208230124', 'MOHAMMAD FAHRI', 'MOHAMMAD FAHRI', 'SALES', 'DUSUN GAMBIRAN, RT 003, RW 004, DESA GAMBIRAN, KECAMATAN GAMBIRAN, MUMBULSARI, JEMBER.', '1997-01-18', 'karisma121', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(129, 'QIU2009244', 'KIU2208230125', 'AHMAD MUHLISIN', 'AHMAD MUHLISIN', 'SALES', 'DESA SETANGOR KEC. SUKAMULIA - LOMBOK TIMUR', '1989-03-12', 'karisma122', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(130, 'QIU2110270', 'KIU2208230126', 'ARDI SAPUTRA', 'ARDI SAPUTRA', 'SALES', 'DUSUN KARYA MULYA, RT 002, RW 004, DESA PLAMPANG, KECAMATAN PLAMPANG, KABUPATEN SUMBAWA', '1986-05-27', 'karisma123', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(131, 'QIU2201273', 'KIU2208230127', 'AGRIYANI PUTRA', 'AGRIYANI PUTRA', 'SALES', 'PERUM SUMBERSARI PERMAI II BLOK BM-6 KRAMAT, KEL KRANJINGAN, KEC SUMBERSARI, JEMBER', '1996-01-06', 'karisma124', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(132, 'QIU2201274', 'KIU2208230128', 'DANNIS SYAHROBY AZIZI', 'DANNIS SYAHROBY AZIZI', 'SALES', 'JL KARIMATA GANG MASJID NO 54, SUMBERSARI, JEMBER', '1996-07-18', 'karisma125', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(133, 'QIU2202278', 'KIU2208230129', 'LUQMAN HAKIM', 'LUQMAN HAKIM', 'SALES', 'DUSUN KRAJAN RT.001/RW.001 DS. BANGOAN KEC. KEDUNGWARU KAB. TULUNGAGUNG', '1993-03-30', 'karisma126', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(134, 'QIU2203279', 'KIU2208230130', 'RIZA AGUS PRASETYO', 'RIZA AGUS PRASETYO', 'SALES', 'JL KH ABDUL HAMID GG. TOKAN NO. 174, RT 002, RW 005, KEBONSARI KULON, KECAMATAN KANIGARAN, KOTA PROBOLINGGO.', '1991-08-23', 'karisma127', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(135, 'QIU2203280', 'KIU2208230131', 'NANDA ADI KURNIANTO', 'NANDA ADI KURNIANTO', 'SALES', 'KALONGAN, RT 003, RW 004, DESA LAWAK, KECAMATAN NGIMBANG, LAMONGAN', '1997-12-25', 'karisma128', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(136, 'QIU2203281', 'KIU2208230132', 'MUKHAMMAD RIDWAN', 'MUKHAMMAD RIDWAN', 'SALES', 'DUSUN BANONG, RT 003, RW 001, DESA GEBANGSARI, KECAMATAN JATIREJO, MOJOKERTO', '1994-08-14', 'karisma129', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(137, 'QIU2207296', 'KIU2208230133', 'JIMY PRAYOGA', 'JIMY PRAYOGA', 'SALES', 'SANGKANAYU, RT 005, RW 001, DESA SANGKANAYU, KECAMATAN BOJONG, KABUPATEN TEGAL, JAWA TENGAH', '1997-04-15', 'karisma130', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(138, 'QIU2207297', 'KIU2208230134', 'FAISAL AMMAR F', 'FAISAL AMMAR F', 'SALES', 'JL. KERTANEGARA IX NO 227, KALIWATES, KABUPATEN JEMBER', '1997-02-16', 'karisma131', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(139, 'QIU2208299', 'KIU2208230135', 'RIZKY SURYA ABADI', 'RIZKY SURYA ABADI', 'SALES', 'DUSUN JAMBE, RT 001, RW 014, DESA SUGIHWARAS, KECAMATAN PRAMBON, KABUPATEN NGANJUK', '1997-07-05', 'karisma132', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(140, 'QIU2212305', 'KIU2208230136', 'DAFI CHOIRUBIN', 'DAFI CHOIRUBIN', 'SALES', 'PERUM JOMBANG CITRA RAYA BLOK C4-19, PANDANWANGI, DIWEK, JOMBANG', '1983-12-20', 'karisma133', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(141, 'QIU2212308', 'KIU2208230137', 'MUHAMMAD KURDI', 'MUHAMMAD KURDI', 'SALES', 'DUSUN PECALONGAN, RT 001, RW 001, DESA SUKOSARI, KABUPATEN BONDOWOSO', '1988-06-29', 'karisma134', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(142, 'QIU2212309', 'KIU2208230138', 'RENGGA BAYU PANGESTU', 'RENGGA BAYU PANGESTU', 'SALES', 'DUSUN BANGOREJO, RT 001, RW 006, DESA BANGOREJO, KECAMATAN BANGOREJO, BANYUWANGI', '1999-09-09', 'karisma135', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(143, 'QIU2302312', 'KIU2208230139', 'MOHAMAD FAJAR SYAHRONI', 'MOHAMAD FAJAR SYAHRONI', 'SALES', 'DUSUN TANGGUNG, RT 003, RW 010, DESA TANGGUNG, KECAMATAN CAMPURDARAT, KABUPATEN TULUNGAGUNG', '1999-06-01', 'karisma136', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(144, 'QIU2302313', 'KIU2208230140', 'ADETYA YULISTANTO NUGROHO', 'ADETYA YULISTANTO NUGROHO', 'SALES', 'DESA TALES, RT 001, RW 002, DESA KARANGLO, KECAMATAN NGADILUWIH, KABUPATEN KEDIRI', '1995-03-19', 'karisma137', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(145, 'QIU2302315', 'KIU2208230141', 'BIMA FAJAR BAHARI', 'BIMA FAJAR BAHARI', 'SALES', 'GRIYA GROGOL INDAH C5 SINGOEGARAN, KECAMATAN PESANTREN, KABUPATEN KEDIRI', '1999-04-04', 'karisma138', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(146, 'QIU2305316', 'KIU2208230142', 'UDIN SUPRIHATMOKO', 'UDIN SUPRIHATMOKO', 'SALES', 'JL. KAWI NO 3, RT 001, RW 024, KEL TOMPOKERSAN, KEC LUMAJANG, KABUPATEN LUMAJANG', '1985-01-08', 'karisma139', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(147, 'QIU2305317', 'KIU2208230143', 'FAHRIZAL ABDULLAH', 'FAHRIZAL ABDULLAH', 'SALES', 'DUSUN JAGUR, RT 003, RW 004, DESA BANYUURIP, KEC SENORI, KABUPATEN TUBAN', '1995-04-20', 'karisma140', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(148, 'QIU2306219', 'KIU2208230144', 'MUHAMMAD AGUNG PRASETYO', 'MUHAMMAD AGUNG PRASETYO', 'SALES', 'DUSUN KRAJAN, RT 002, RW 001, DESA LUMBANG, KECAMATAN LUMBANG, KABUPATEN PROBOLINGGO', '2000-03-16', 'karisma141', '$2y$10$8zo4Hf7Z3tOS66AJHgKu1OTACGRpTjYwOd.Mpr1t4PR0HWcUH3.2.', 2, '2023-08-22 05:58:36'),
(150, '', 'KIU2308230001', 'KIUTC', '', 'KEUANGAN', '', '', 'KIUTC', '$2y$10$NHS4Aa/jP0GA3tvU8dIuJexSBma4WUkt0/6ypMHSb.T/IWF/vN5PC', 2, '2023-08-23 03:49:16'),
(151, '', 'KIU2602240001', 'admsales', '', 'SALES', '', '', 'admsales', '$2y$10$KpxpWJc81Y3/v3A0wmtUEuVCIUw2cxebunxKuFEscAW7Uj7DU4SF.', 2, '2024-02-26 03:59:26'),
(152, '', 'KIU2006240001', 'admsales', '', 'SALES', '', '', 'admsales', '$2y$10$.xAZu8QGLrYkkNpUYTkruesZvupQ3WxlRnylR9gaiTvaT07FRCsWW', 2, '2024-02-26 03:59:26');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_det_tracking_driver`
--
ALTER TABLE `tb_det_tracking_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_driver_pending`
--
ALTER TABLE `tb_driver_pending`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_expedisi`
--
ALTER TABLE `tb_expedisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_generate_kd`
--
ALTER TABLE `tb_generate_kd`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_inventaris`
--
ALTER TABLE `tb_inventaris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_issue`
--
ALTER TABLE `tb_issue`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_itinventariskomputer`
--
ALTER TABLE `tb_itinventariskomputer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_karyawan_keluarmasuk`
--
ALTER TABLE `tb_karyawan_keluarmasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kpi1`
--
ALTER TABLE `tb_kpi1`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kpibobotutama`
--
ALTER TABLE `tb_kpibobotutama`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kpihow`
--
ALTER TABLE `tb_kpihow`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kpiwhat`
--
ALTER TABLE `tb_kpiwhat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_lap_distribusi`
--
ALTER TABLE `tb_lap_distribusi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_op_driver`
--
ALTER TABLE `tb_op_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_op_helper`
--
ALTER TABLE `tb_op_helper`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_op_plat`
--
ALTER TABLE `tb_op_plat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_order_tracking_driver`
--
ALTER TABLE `tb_order_tracking_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_service_truk`
--
ALTER TABLE `tb_service_truk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_tamu`
--
ALTER TABLE `tb_tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_tamu_lby`
--
ALTER TABLE `tb_tamu_lby`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_tmp_lap_distribusi`
--
ALTER TABLE `tb_tmp_lap_distribusi`
  ADD PRIMARY KEY (`id_lap_dis`);

--
-- Indeks untuk tabel `tb_truck`
--
ALTER TABLE `tb_truck`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_det_tracking_driver`
--
ALTER TABLE `tb_det_tracking_driver`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `tb_driver_pending`
--
ALTER TABLE `tb_driver_pending`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_expedisi`
--
ALTER TABLE `tb_expedisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_generate_kd`
--
ALTER TABLE `tb_generate_kd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=787;

--
-- AUTO_INCREMENT untuk tabel `tb_inventaris`
--
ALTER TABLE `tb_inventaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_issue`
--
ALTER TABLE `tb_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_itinventariskomputer`
--
ALTER TABLE `tb_itinventariskomputer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_karyawan_keluarmasuk`
--
ALTER TABLE `tb_karyawan_keluarmasuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_kpi1`
--
ALTER TABLE `tb_kpi1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kpibobotutama`
--
ALTER TABLE `tb_kpibobotutama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kpihow`
--
ALTER TABLE `tb_kpihow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kpiwhat`
--
ALTER TABLE `tb_kpiwhat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_lap_distribusi`
--
ALTER TABLE `tb_lap_distribusi`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_op_driver`
--
ALTER TABLE `tb_op_driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_op_helper`
--
ALTER TABLE `tb_op_helper`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_op_plat`
--
ALTER TABLE `tb_op_plat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tb_order_tracking_driver`
--
ALTER TABLE `tb_order_tracking_driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_service_truk`
--
ALTER TABLE `tb_service_truk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_tamu`
--
ALTER TABLE `tb_tamu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_tamu_lby`
--
ALTER TABLE `tb_tamu_lby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=894;

--
-- AUTO_INCREMENT untuk tabel `tb_tmp_lap_distribusi`
--
ALTER TABLE `tb_tmp_lap_distribusi`
  MODIFY `id_lap_dis` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_truck`
--
ALTER TABLE `tb_truck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
