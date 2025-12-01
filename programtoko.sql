-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2025 at 06:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `programtoko`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pembelian` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` bigint(11) NOT NULL,
  `total` bigint(11) NOT NULL,
  `id_varian` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `id_pembelian`, `id_produk`, `jumlah`, `harga`, `total`, `id_varian`) VALUES
(4, 8, 7, 15, 8000, 120000, NULL),
(8, 10, 10, 3, 5000000, 15000000, NULL),
(10, 12, 23, 5, 3000000, 15000000, NULL),
(11, 12, 11, 3, 4000000, 12000000, NULL),
(13, 14, 23, 3, 3000000, 9000000, NULL),
(14, 14, 23, 1, 3000000, 3000000, NULL),
(15, 15, 11, 5, 4000000, 20000000, NULL),
(16, 15, 11, 7, 4000000, 28000000, NULL),
(17, 16, 23, 2, 3000000, 6000000, 5),
(18, 16, 23, 1, 3000000, 3000000, 6),
(19, 17, 23, 4, 2000000, 8000000, 5),
(20, 18, 10, 3, 3000000, 9000000, 16),
(21, 19, 11, 3, 3000000, 9000000, 10),
(22, 20, 11, 3, 3000000, 9000000, 10),
(23, 21, 14, 1, 3000000, 3000000, 20),
(24, 22, 32, 5, 3000000, 15000000, 28),
(25, 22, 32, 3, 3000000, 9000000, 29),
(26, 23, 34, 3, 1500000, 4500000, 35),
(27, 23, 34, 3, 1500000, 4500000, 36),
(28, 23, 34, 3, 1500000, 4500000, 37),
(29, 23, 34, 3, 1500000, 4500000, 38),
(30, 24, 33, 3, 3000000, 9000000, 32),
(31, 24, 32, 3, 3000000, 9000000, 29);

-- --------------------------------------------------------

--
-- Table structure for table `detil_nota`
--

CREATE TABLE `detil_nota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_nota` bigint(20) UNSIGNED DEFAULT NULL,
  `id_produk` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` bigint(11) NOT NULL,
  `subtotal` bigint(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hpp` bigint(11) DEFAULT 0,
  `diskon` bigint(11) NOT NULL DEFAULT 0,
  `id_varian` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detil_nota`
--

INSERT INTO `detil_nota` (`id`, `id_nota`, `id_produk`, `jumlah`, `harga`, `subtotal`, `created_at`, `updated_at`, `hpp`, `diskon`, `id_varian`) VALUES
(52, 92, 7, 1, 10000, 10000, NULL, NULL, 8000, 0, NULL),
(53, 92, 9, 1, 100000, 100000, NULL, NULL, 30000, 10000, NULL),
(54, 93, 9, 1, 100000, 100000, NULL, NULL, 30000, 25000, NULL),
(55, 93, 7, 2, 10000, 20000, NULL, NULL, 8000, 5000, NULL),
(56, 94, 10, 1, 5780000, 5780000, NULL, NULL, 5000000, 30000, NULL),
(57, 94, 12, 1, 6580000, 6580000, NULL, NULL, 5500000, 30000, NULL),
(58, 94, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 200000, NULL),
(59, 95, 9, 1, 600000, 600000, NULL, NULL, 30000, 0, NULL),
(60, 95, 10, 1, 5780000, 5780000, NULL, NULL, 5000000, 30000, NULL),
(61, 96, 9, 2, 600000, 1200000, NULL, NULL, 30000, 0, NULL),
(62, 96, 10, 1, 5780000, 5780000, NULL, NULL, 5000000, 0, NULL),
(63, 97, 10, 1, 5780000, 5780000, NULL, NULL, 5000000, 0, NULL),
(64, 97, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 0, NULL),
(65, 98, 10, 1, 5780000, 5780000, NULL, NULL, 5000000, 0, NULL),
(66, 99, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 0, NULL),
(67, 100, 10, 1, 5780000, 5780000, NULL, NULL, 5000000, 0, NULL),
(68, 101, 9, 1, 600000, 600000, NULL, NULL, 30000, 0, NULL),
(69, 102, 10, 1, 5780000, 5780000, NULL, NULL, 5000000, 0, NULL),
(70, 103, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 0, NULL),
(71, 104, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 0, NULL),
(72, 105, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 0, NULL),
(73, 106, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 20000, NULL),
(74, 107, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 20000, NULL),
(75, 108, 10, 1, 5780000, 5780000, NULL, NULL, 5000000, 0, NULL),
(76, 109, 12, 1, 6580000, 6580000, NULL, NULL, 5500000, 0, NULL),
(77, 110, 14, 1, 5850000, 5850000, NULL, NULL, 5250000, 0, NULL),
(78, 111, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 20000, NULL),
(79, 112, 10, 1, 5780000, 5780000, NULL, NULL, 5500000, 30000, NULL),
(80, 113, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 20000, NULL),
(81, 115, 23, 1, 3750000, 3750000, NULL, NULL, 3500000, 0, 5),
(82, 116, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 20000, 12),
(83, 117, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 20000, 10),
(84, 118, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 0, 12),
(85, 119, 23, 2, 3750000, 7500000, NULL, NULL, 3500000, 100000, 5),
(86, 119, 23, 1, 3750000, 3750000, NULL, NULL, 3500000, 50000, 6),
(87, 120, 10, 1, 5780000, 5780000, NULL, NULL, 5500000, 30000, 16),
(88, 121, 23, 2, 3750000, 7500000, NULL, NULL, 3500000, 0, 5),
(89, 121, 23, 1, 3750000, 3750000, NULL, NULL, 3500000, 50000, 6),
(90, 122, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 20000, 10),
(91, 123, 32, 3, 4000000, 12000000, NULL, NULL, 3200000, 500000, 28),
(92, 123, 32, 1, 4000000, 4000000, NULL, NULL, 3200000, 500000, 29),
(93, 125, 33, 1, 5400000, 5400000, NULL, NULL, 5000000, 0, 31),
(94, 127, 35, 1, 8500000, 8500000, NULL, NULL, 7500000, 0, 42),
(95, 128, 35, 1, 8500000, 8500000, NULL, NULL, 7500000, 0, 42),
(96, 129, 34, 1, 2100000, 2100000, NULL, NULL, 1500000, 0, 38),
(97, 130, 11, 1, 4220000, 4220000, NULL, NULL, 4000000, 0, 10),
(98, 131, 35, 2, 8500000, 17000000, NULL, NULL, 7500000, 1000000, 43),
(99, 132, 35, 1, 8500000, 8500000, NULL, NULL, 7500000, 0, 42),
(100, 133, 11, 2, 4220000, 8440000, NULL, NULL, 4000000, 0, 10),
(101, 134, 33, 1, 5400000, 5400000, NULL, NULL, 5000000, 0, 32),
(102, 135, 34, 1, 2100000, 2100000, NULL, NULL, 1500000, 100000, 38);

-- --------------------------------------------------------

--
-- Table structure for table `detil_produk`
--

CREATE TABLE `detil_produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `id_supplier` bigint(20) UNSIGNED DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `id_varian` bigint(20) UNSIGNED DEFAULT NULL,
  `harga` bigint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detil_produk`
--

INSERT INTO `detil_produk` (`id`, `id_produk`, `id_supplier`, `stok`, `id_varian`, `harga`) VALUES
(5, 9, 17, 4, 7, 450000),
(13, 10, 16, 3, 16, 5500000),
(17, 23, NULL, 5, 5, 3500000),
(18, 23, NULL, 8, 6, 3500000),
(22, 23, 17, 5, 6, 3000000),
(23, 11, 17, 1, 12, 4000000),
(24, 23, 17, 3, 5, 3000000),
(25, 23, 17, 1, 6, 3000000),
(27, 11, 17, 7, 12, 4000000),
(28, 23, 17, 2, 5, 3000000),
(29, 23, 17, 1, 6, 3000000),
(30, 10, NULL, 3, 16, 5000000),
(31, 23, 16, 4, 5, 2000000),
(36, 30, NULL, 2, 25, 2000000),
(37, 10, 17, 3, 16, 3000000),
(38, 11, 16, 3, 10, 3000000),
(39, 11, 17, 3, 10, 3000000),
(40, 14, 17, 1, 20, 3000000),
(41, 12, NULL, 230000, 27, 3000000),
(43, 32, NULL, 2, 29, 3200000),
(44, 32, NULL, 3, 30, 3200000),
(45, 33, NULL, 1, 31, 5000000),
(46, 33, NULL, 1, 32, 5000000),
(47, 33, NULL, 2, 33, 5000000),
(48, 33, NULL, 2, 34, 5000000),
(49, 32, 15, 5, 28, 3000000),
(50, 32, 15, 3, 29, 3000000),
(52, 35, NULL, 1, 43, 7500000),
(53, 34, 18, 3, 35, 1500000),
(54, 34, 18, 3, 36, 1500000),
(55, 34, 18, 3, 37, 1500000),
(56, 34, 18, 1, 38, 1500000),
(57, 33, 18, 3, 32, 3000000),
(58, 32, 18, 3, 29, 3000000),
(59, 11, NULL, 1, 44, 4000000);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(5, 'Sepeda Gunung', NULL, NULL),
(6, 'Sepeda Hobi', NULL, NULL),
(7, 'Sepeda Lipat', NULL, NULL),
(9, 'Sepeda Listrik', NULL, NULL),
(10, 'Mobil Aki', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_05_110025_produk', 1),
(5, '2025_03_05_110030_nota', 1),
(6, '2025_03_05_110036_detil_nota', 1),
(7, '2025_03_10_055842_lokasiadd', 1),
(8, '2025_03_12_115536_add_inv_num', 1),
(9, '2025_03_12_171303_create_personal_access_tokens_table', 1),
(10, '2025_03_16_140841_add_jabatan', 2),
(11, '2025_03_23_083722_supplier', 3),
(12, '2025_03_23_084551_toko', 4),
(13, '2025_03_23_084942_restock', 5),
(14, '2025_03_26_163237_kategori', 6),
(15, '2025_03_26_164214_prodkat', 7),
(16, '2025_03_27_112843_add_kategori', 8),
(17, '2025_03_27_113047_cobaan', 9),
(18, '2025_03_27_113936_detil_update', 10),
(19, '2025_03_27_114150_notau', 11),
(20, '2025_03_27_114532_produkupt', 12),
(21, '2025_03_31_145516_labilan', 13),
(22, '2025_04_22_191742_addinv', 14),
(23, '2025_07_01_142629_addesc', 15),
(24, '2025_07_13_173525_adprodstat', 16),
(25, '2025_07_13_174254_adstatss', 17),
(26, '2025_07_15_075139_createdetilkulak', 18),
(27, '2025_07_15_075603_modifrestock', 19),
(28, '2025_07_15_084806_addnum', 20),
(29, '2025_07_15_092803_adhpp', 21),
(30, '2025_07_16_134011_addtabledetprod', 21),
(31, '2025_07_16_150152_hap', 22),
(32, '2025_07_16_181153_addhpp', 23),
(33, '2025_07_19_173304_addlaku', 24),
(34, '2025_07_24_143634_adddiskon', 25),
(35, '2025_08_01_130058_droplokasi', 26),
(37, '2025_08_04_134643_addketerangan', 27),
(38, '2025_08_06_115312_adtabvarian', 28),
(39, '2025_08_06_120142_addidvar', 29),
(40, '2025_08_06_150838_adharga', 30),
(41, '2025_08_07_155328_advarnot', 31),
(42, '2025_08_11_183639_advar', 32),
(43, '2025_08_13_165606_addtbayar', 33),
(44, '2025_08_21_162703_dropclicks', 34),
(45, '2025_08_31_155430_addminstok', 35);

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kasir` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `total` bigint(11) NOT NULL,
  `bayar` bigint(11) NOT NULL,
  `kembali` bigint(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `metode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inv_num` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id`, `id_kasir`, `tanggal`, `total`, `bayar`, `kembali`, `status`, `metode`, `created_at`, `updated_at`, `inv_num`) VALUES
(92, 3, '2025-07-26', 100000, 100000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250726-001'),
(93, 3, '2025-07-26', 90000, 100000, 10000, 'lunas', 'cash', NULL, NULL, 'INV-20250726-002'),
(94, 3, '2025-07-27', 16320000, 16400000, 80000, 'lunas', 'cash', NULL, NULL, 'INV-20250727-003'),
(95, 3, '2025-07-31', 6350000, 6350000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250731-004'),
(96, 3, '2025-07-31', 6980000, 7000000, 20000, 'lunas', 'cash', NULL, NULL, 'INV-20250731-005'),
(97, 3, '2025-07-31', 10000000, 10000000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250731-006'),
(98, 3, '2025-07-31', 5780000, 6000000, 220000, 'lunas', 'cash', NULL, NULL, 'INV-20250731-007'),
(99, 3, '2025-07-31', 4220000, 42250000, 38030000, 'lunas', 'cash', NULL, NULL, 'INV-20250731-008'),
(100, 3, '2025-07-31', 5780000, 5800000, 20000, 'lunas', 'cash', NULL, NULL, 'INV-20250731-009'),
(101, 3, '2025-07-31', 600000, 600000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250731-010'),
(102, 3, '2025-07-31', 5780000, 5800000, 20000, 'lunas', 'cash', NULL, NULL, 'INV-20250731-011'),
(103, 3, '2025-07-31', 4220000, 4250000, 30000, 'lunas', 'cash', NULL, NULL, 'INV-20250731-012'),
(104, 3, '2025-07-31', 4220000, 4250000, 30000, 'lunas', 'cash', NULL, NULL, 'INV-20250731-013'),
(105, 3, '2025-07-31', 4220000, 4250000, 30000, 'lunas', 'cash', NULL, NULL, 'INV-20250731-014'),
(106, 3, '2025-07-31', 4200000, 4200000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250731-015'),
(107, 3, '2025-07-31', 4200000, 4200000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250731-016'),
(108, 3, '2025-07-31', 5780000, 5800000, 20000, 'lunas', 'cash', NULL, NULL, 'INV-20250731-017'),
(109, 3, '2025-07-31', 6580000, 6600000, 20000, 'lunas', 'cash', NULL, NULL, 'INV-20250731-018'),
(110, 3, '2025-08-03', 5850000, 5850000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250803-019'),
(111, 3, '2025-08-06', 4200000, 4200000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250806-020'),
(112, 3, '2025-08-07', 5750000, 5800000, 50000, 'lunas', 'cash', NULL, NULL, 'INV-20250807-021'),
(113, 3, '2025-08-08', 4200000, 4200000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250808-022'),
(115, 3, '2025-08-10', 3750000, 3750000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250810-023'),
(116, 3, '2025-08-12', 4200000, 4210000, 10000, 'lunas', 'cash', NULL, NULL, 'INV-20250812-024'),
(117, 3, '2025-08-14', 4200000, 4200000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250814-025'),
(118, 6, '2025-08-15', 4220000, 4220000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250815-026'),
(119, 3, '2025-08-15', 11100000, 11100000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250815-027'),
(120, 3, '2025-08-15', 5750000, 5750000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250815-028'),
(121, 3, '2025-08-24', 11200000, 11200000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250824-029'),
(122, 3, '2025-08-29', 4200000, 4300000, 100000, 'lunas', 'cash', NULL, NULL, 'INV-20250829-030'),
(123, 3, '2025-08-31', 15000000, 15000000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250831-031'),
(125, 6, '2025-09-02', 5400000, 5400000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250902-033'),
(127, 3, '2025-09-06', 8500000, 8500000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250906-033'),
(128, 3, '2025-09-08', 8500000, 8500000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250908-034'),
(129, 3, '2025-09-11', 2100000, 2100000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250911-035'),
(130, 3, '2025-09-16', 4220000, 4300000, 80000, 'lunas', 'cash', NULL, NULL, 'INV-20250916-036'),
(131, 3, '2025-09-17', 16000000, 16000000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250917-037'),
(132, 3, '2025-09-17', 8500000, 8600000, 100000, 'lunas', 'cash', NULL, NULL, 'INV-20250917-038'),
(133, 3, '2025-09-18', 8440000, 8500000, 60000, 'lunas', 'cash', NULL, NULL, 'INV-20250918-039'),
(134, 3, '2025-09-18', 5400000, 5400000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250918-040'),
(135, 3, '2025-09-18', 2000000, 2000000, 0, 'lunas', 'cash', NULL, NULL, 'INV-20250918-041');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'auth_token', '1567171e6f7a97b0ede3ed40a6d215f3ddf6d1e968750b1273b8a8712e0c6b68', '[\"*\"]', NULL, NULL, '2025-03-13 22:49:21', '2025-03-13 22:49:21'),
(2, 'App\\Models\\User', 2, 'auth_token', '79ee9046cac2b4a762955e2876a4411a726c50c14abd83ee9066256ddfb885df', '[\"*\"]', NULL, NULL, '2025-03-13 22:49:42', '2025-03-13 22:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id_kategori` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'aktif',
  `laku` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`, `deskripsi`, `status`, `laku`) VALUES
(6, 'lamlgma', 51000, '', NULL, NULL, NULL, NULL, 'nonaktif', 0),
(7, 'Testing', 10000, '', 5, NULL, NULL, NULL, 'nonaktif', 0),
(9, 'Anak 213', 600000, '', 5, NULL, NULL, 'Anda penjelajah?? Ingin sepeda tangguh tapi harga tetap terjangkau?? Sepeda ini sangatlah cocok untuk anda!', 'nonaktif', 0),
(10, 'Sepeda London Taxi CRB 26M', 5780000, 'produk/XvRhsUB1SXQ66WxvqlhHTFF2RuGruHNCeR1zw2Ft.jpg', 6, NULL, NULL, 'Sepeda klasik dengan ukuran medium yang menawan... Gayanya gagah, sederhana, terlihat mewah dan mahal... cocok untuk digunakan bersama kawan', 'nonaktif', 0),
(11, 'Sepeda Lipat London Taxi 20ST', 4220000, 'varian/yZ6iZTmeSMHrhqheIk2lmJK81kVALzWg0SVbJm9j.png', 7, NULL, NULL, 'Sepeda lipat model klasik yang nampak keren dari sisi manapun... sepeda ini cocok bagi anda yang suka berjalan-jalan, suka bergaya, namun tidak ingin membuang banyak ruang penyimpanan dan mudah dibawa-bawa...', 'aktif', 0),
(12, 'Sepeda London Taxi CRB 26L', 6580000, 'varian/veZ1EshVnkXvcAjiQrU9poQHZqH4ZBrFc8GEQhVQ.png', 6, NULL, NULL, 'Sepeda dengan gaya klasik yang nyaman dan menawan... Cocok digunakan untuk bersantai bersama teman', 'aktif', 0),
(14, 'Sepeda London Taxi CRB 700 L', 5850000, 'produk/UbzHTWVD9fUBGZBmEqEf7CXYhku7NfHxiRRMD70m.jpg', 6, NULL, NULL, 'Sepeda hobi yang memilliki desain klasik khas Inggris... Terinspirasi dari taxi khas London', 'nonaktif', 0),
(23, 'sepeda gunung MTB united avand factor one 27,5\"', 3750000, 'produk/CmdSw45POBijneuRddkyw8631dV7OB5nDRqYB6ET.jpg', 5, NULL, NULL, 'ada', 'nonaktif', 0),
(25, 'adakah', 3000, '', 5, NULL, NULL, 'ada', 'nonaktif', 0),
(26, 'United Clovis', 8500000, '', 5, NULL, NULL, '-', 'nonaktif', 0),
(30, 'wq', 2000000, '', 6, NULL, NULL, '1', 'nonaktif', 0),
(31, 'w', 2, '', 6, NULL, NULL, '1', 'nonaktif', 0),
(32, 'Uwinfly D60', 4000000, 'varian/lNP08r5xke5Zstf1SNwEcIKp9DB8sNxbla6lDKkt.jpg', 9, NULL, NULL, 'Sepeda listrik keren, tangguh, dengan lampu full LED dan memiliki harga terjangkau', 'aktif', 0),
(33, 'UWINFLY T65', 5400000, 'varian/oDiFsUjkAaSTegnOZp1fBhwJQoWzvJT5hsGEAj0p.png', 9, NULL, NULL, 'Sepeda listrik modern yang memiliki gaya menarik. Cocok bagi kaum Ibu rumah tangga yang suka pergi berbelanja', 'aktif', 0),
(34, 'Mainan mobil aki anak Varsa PMB M-6188', 2100000, 'varian/CqLefr214FKszmB151MXfgBFindMAoCh7IfVEYQv.png', 10, NULL, NULL, 'Ngueeenggg', 'aktif', 0),
(35, 'MTB UNITED CLOVIS 6.10 12SP', 8500000, 'varian/4S8aU0lO9YmDUwcEYGLu28GKnfkSTJYsw9WZ5K6Y.png', 5, NULL, NULL, 'Naik-naik ke puncak gunung', 'aktif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `restock`
--

CREATE TABLE `restock` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_supplier` bigint(20) UNSIGNED DEFAULT NULL,
  `total` bigint(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT '2025-03-23',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_trans` varchar(255) DEFAULT NULL,
  `tanggal_tempo` date DEFAULT NULL,
  `metode` varchar(255) NOT NULL DEFAULT 'termin',
  `tbayar` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restock`
--

INSERT INTO `restock` (`id`, `id_supplier`, `total`, `tanggal`, `created_at`, `updated_at`, `no_trans`, `tanggal_tempo`, `metode`, `tbayar`) VALUES
(8, 16, 120000, '2025-07-26', NULL, NULL, NULL, NULL, 'termin', '2025-07-26 23:43:16'),
(10, 16, 15000000, '2025-07-28', NULL, NULL, 'BUY-20250728-005', NULL, 'termin', '2025-08-16 18:32:25'),
(12, 17, 27000000, '2025-08-11', NULL, NULL, 'BUY-20250811-004', NULL, 'termin', '2025-08-16 18:32:32'),
(14, 17, 12000000, '2025-08-11', NULL, NULL, 'BUY-20250811-005', '2025-08-31', 'termin', '2025-09-17 07:06:02'),
(15, 17, 48000000, '2025-08-11', NULL, NULL, 'BUY-20250811-006', NULL, 'termin', '2025-08-19 00:00:00'),
(16, 17, 9000000, '2025-08-11', NULL, NULL, 'BUY-20250811-007', NULL, 'termin', '2025-08-19 04:52:53'),
(17, 16, 8000000, '2025-08-14', NULL, NULL, 'BUY-20250814-008', NULL, 'termin', '2025-08-19 04:52:57'),
(18, 17, 9000000, '2025-08-16', NULL, NULL, 'BUY-20250816-009', NULL, 'termin', '2025-08-19 04:53:00'),
(19, 16, 9000000, '2025-08-19', NULL, NULL, 'BUY-20250819-010', NULL, 'termin', '2025-08-19 04:40:48'),
(20, 17, 9000000, '2025-08-19', NULL, NULL, 'BUY-20250819-011', '2025-09-30', 'termin', NULL),
(21, 17, 3000000, '2025-08-19', NULL, NULL, 'BUY-20250819-012', '2025-08-19', 'termin', '2025-08-19 04:52:27'),
(22, 15, 24000000, '2025-08-31', NULL, NULL, 'BUY-20250831-012', NULL, 'termin', '2025-08-31 17:34:43'),
(23, 18, 18000000, '2025-09-02', NULL, NULL, 'BUY-20250902-013', '2025-09-02', 'tempo', NULL),
(24, 18, 18000000, '2025-09-08', NULL, NULL, 'BUY-20250908-014', NULL, 'termin', '2025-09-08 12:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jcaxkb7rvuJSb5AGDQCiGip5NbwCQHFcJ0PHljwS', 3, '192.168.1.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZUVQeVVTMEJ4c1hQRFlEOXhkb1NRSXQ5SU5UQjlHR3RoN3JFclpsSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xOTIuMTY4LjEuOTo4MDAwL3Jlc3RvY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1758212052);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `telepon`, `created_at`, `updated_at`, `keterangan`) VALUES
(15, 'Rudi General Bike', 'Jogja', '081228332621', NULL, NULL, NULL),
(16, 'Tri Widodo FTBike', 'Magelang', '081252411145', NULL, NULL, 'PT. FTBike Indonesia'),
(17, 'Sun Sun United', 'Semarang', '08122966861', NULL, NULL, NULL),
(18, 'Vito Scalleta', 'Yogyakarta jalan Kartanegara', '081226544587', NULL, NULL, 'PT. Tabindo');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `verify_key` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `foto`, `email_verified_at`, `password`, `verify_key`, `active`, `remember_token`, `created_at`, `updated_at`, `jabatan`) VALUES
(3, 'Erick Marcellino P', 'resibebekeke5@gmail.com', 'user/gTjYRCMnBjXr3knNsZaPRpxhAQqdymXD4vBAQkJJ.jpg', '2025-07-07 22:09:50', '$2y$12$3lHc3jTZdKW7YExSkItmDu3fKfr3UaFOTvmyFD2CkzVaSDUHNuohi', 'RbfrC4oygkERu39lVdcO604Yce2UenadazY3ANi6VbkXXKWWGMydd80Z9J1xhacDQn2s274kvsgtbCoL0KEbyMjUkBP37GtNnsIH', 1, 'qZ55Mc9VxY19iiJm9EYntzvY7TffDBc62xr3Zd05jWbQFExTm5GH8z7PsILt', '2025-07-07 22:09:27', '2025-09-17 00:16:56', 'admin'),
(5, 'Joe Mamer', 'lynnvynna@gmail.com', NULL, '2025-07-30 04:52:18', '$2y$12$CI72WG9.N85.SKz1fh75Wu7v/3UCAx0mqloL0L2mhEIXKptcjs.OW', 'PmXaOs2zdearXrg0coXxzkJDHPehlmVgHCWQbuNdA9etQhfuosGEMVPyb4tJcy3vwA7Q6H1gLYF54yRrVbhyCLde5SSdKeK4NVWu', 1, NULL, '2025-07-30 04:51:20', '2025-09-16 09:58:27', 'kasir'),
(6, 'Erick123', 'resibebekeke@gmail.com', 'user/WmV2DuQC4y7TrrBIXWAYaMOTWp4CZYZIPYO6ngJE.jpg', '2025-08-15 09:52:57', '$2y$12$xi/td3Nkqei2PBYfHxMj2.wm6KqoPOMMK2/ywJ1XkFFqi05/cIYDe', 'BrhmVduQHul1HXd4ZhZPtzIWIUFKfdfZVSWLvz8wzPeUB1lqlfa0B1RPEZM18flhXqLwVVl4aESPAl0lfkFs1rI2ymi49f2GhcZb', 1, 'JUGE4f1oLwd7MiuQHO75shptAOh3xF9k0PFzun3CTySAZALtaS8gODTQu3FC', '2025-08-15 09:52:38', '2025-09-16 09:58:27', 'kasir'),
(8, 'TESTER1', 'erickmarcellinop@gmail.com', NULL, '2025-09-16 09:44:18', '$2y$12$omb0AgbM.jeEH4q/dBEgo.6/j.bHKJMpITSLveSS9t0j3DE10VLOO', '2Z8w58lHrJYwHkjutRQPdgtEm3LmdwRoTdMGvf1deESCtpwFqAqvsqmCdWXOrBjoSRowx9vG9vzyyoFuPwU0Vt5THFI6vu3zvjTK', 1, NULL, '2025-09-16 09:44:01', '2025-09-16 09:58:27', 'non');

-- --------------------------------------------------------

--
-- Table structure for table `varian`
--

CREATE TABLE `varian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `nama_varian` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `min_stok` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `varian`
--

INSERT INTO `varian` (`id`, `id_produk`, `nama_varian`, `gambar`, `status`, `created_at`, `updated_at`, `min_stok`) VALUES
(5, 23, 'Light Steel Blue', 'varian/qehUc02alaxhyIVlQ0wVFyuZnQOcUckFeb1aU2t9.jpg', 1, NULL, NULL, 3),
(6, 23, 'Sage Green', 'varian/3dfJ6tcfD8w8jEvYawEwGGI5aCAlDsxXsdb5GBr9.jpg', 1, NULL, NULL, 3),
(7, 9, 'Standard', '', 0, NULL, NULL, 3),
(10, 11, 'Jade Color', 'varian/cxq9y3mz16hbBdEXAuZkY38diZAQ2AADuig87jVN.png', 1, NULL, NULL, 3),
(12, 11, 'Charcoal Color', 'varian/dD1gEAMTWgaFMfPSSINbbD2iT2CgfSzMXLZYFTfs.png', 1, NULL, NULL, 3),
(14, 25, 'tintin', 'varian/UxMEMlVJ0kIYyZXzwgr0dGYw3NfMawfWIEJ7lQll.png', 1, NULL, NULL, 3),
(15, 14, 'Charcoal Color', 'varian/l6J8KF1N7sEn4V0BTgg3J6Mn9sBXbvh4yF4dLROa.jpg', 1, NULL, NULL, 3),
(16, 10, 'Green', 'varian/9FF4OFpxt57g1Nc3B0OJQrFdGwsZkPJqEOA2wksn.jpg', 1, NULL, NULL, 3),
(17, 12, 'Jade', 'varian/veZ1EshVnkXvcAjiQrU9poQHZqH4ZBrFc8GEQhVQ.png', 1, NULL, NULL, 3),
(18, 12, 'Racing Red', 'varian/SiIrnaOepeQzgkx038t9X5iM140EfkHkJIs9ZCeq.png', 1, NULL, NULL, 3),
(19, 12, 'Cool Silver', 'varian/ZlYHH9eDpWu2kxO2C6XOIINqUiPKwlRjKi3xQYGi.png', 1, NULL, NULL, 3),
(20, 14, 'Ivory Color', 'varian/3HlNtTB5LLKMtyWG6yws9yV749DzS1tXYp00lQfZ.jpg', 1, NULL, NULL, 3),
(21, 26, 'Silver', '', 0, NULL, NULL, 3),
(25, 30, '1', '', 0, NULL, NULL, 3),
(26, 31, 'Dummer', '', 0, NULL, NULL, 3),
(27, 12, 'Merah merona', 'varian/fKX5ojLZvlf1kkYr63fayiid6dKABxrNsXqzAMFk.png', 0, NULL, NULL, 3),
(28, 32, 'Biru', 'varian/lNP08r5xke5Zstf1SNwEcIKp9DB8sNxbla6lDKkt.jpg', 1, NULL, NULL, 3),
(29, 32, 'Merah', 'varian/ouZwYNuevUsrmMSRbzVgGqSDZCv7snzw9Hkyg14O.jpg', 1, NULL, NULL, 3),
(30, 32, 'Kuning', 'varian/nEEXhMQCJXpaofdJ8CPs974VyBDMdJQbyHQoY8bT.jpg', 1, NULL, NULL, 3),
(31, 33, 'Biru', 'varian/oDiFsUjkAaSTegnOZp1fBhwJQoWzvJT5hsGEAj0p.png', 1, NULL, NULL, 3),
(32, 33, 'Silver', 'varian/I3eLq5pglUcpUmAVzk6KTXOcZoLdQIyzxNqEqtdh.png', 1, NULL, NULL, 3),
(33, 33, 'Hijau', 'varian/Roro8pPTjw9RZLTriKysD2sZhnrHZRBdGIkTElxq.png', 1, NULL, NULL, 3),
(34, 33, 'Putih', 'varian/aQcLdSZZDdAP3z2Qnp9I5mtmcOEMNJKb9NNqvOmM.png', 1, NULL, NULL, 3),
(35, 34, 'Merah', 'varian/CqLefr214FKszmB151MXfgBFindMAoCh7IfVEYQv.png', 1, NULL, NULL, 1),
(36, 34, 'Kuning', 'varian/zJ0mFqhgAro3lcjAjxq0xej8Ni27PtTPLR65ARTb.png', 1, NULL, NULL, 1),
(37, 34, 'Orange', 'varian/BPga83REHcR6COkFzP5oH5r8ohBIiQZnuxu5Z8rM.png', 1, NULL, NULL, 1),
(38, 34, 'Putih', 'varian/y1aBa1puBaaeqftT1YFqzSWid5HuSuBbfBKJvvkR.png', 1, NULL, NULL, 1),
(42, 35, 'Silver', 'varian/4S8aU0lO9YmDUwcEYGLu28GKnfkSTJYsw9WZ5K6Y.png', 1, NULL, NULL, 2),
(43, 35, 'Green', 'varian/uvjNWL5b02SXnJNR9LvvmHpI6EzBvhKW5SLz3SRS.png', 1, NULL, NULL, 2),
(44, 11, 'Merah', 'varian/yZ6iZTmeSMHrhqheIk2lmJK81kVALzWg0SVbJm9j.png', 1, NULL, NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pembelian_id_pembelian_foreign` (`id_pembelian`),
  ADD KEY `detail_pembelian_id_produk_foreign` (`id_produk`),
  ADD KEY `detail_pembelian_id_varian_foreign` (`id_varian`);

--
-- Indexes for table `detil_nota`
--
ALTER TABLE `detil_nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detil_nota_id_nota_foreign` (`id_nota`),
  ADD KEY `detil_nota_id_produk_foreign` (`id_produk`),
  ADD KEY `detil_nota_id_varian_foreign` (`id_varian`);

--
-- Indexes for table `detil_produk`
--
ALTER TABLE `detil_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detil_produk_id_produk_foreign` (`id_produk`),
  ADD KEY `detil_produk_id_supplier_foreign` (`id_supplier`),
  ADD KEY `detil_produk_id_varian_foreign` (`id_varian`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nota_id_kasir_foreign` (`id_kasir`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `restock`
--
ALTER TABLE `restock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restock_id_supplier_foreign` (`id_supplier`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `varian`
--
ALTER TABLE `varian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `varian_id_produk_foreign` (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `detil_nota`
--
ALTER TABLE `detil_nota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `detil_produk`
--
ALTER TABLE `detil_produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `restock`
--
ALTER TABLE `restock`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `varian`
--
ALTER TABLE `varian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_id_pembelian_foreign` FOREIGN KEY (`id_pembelian`) REFERENCES `restock` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pembelian_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pembelian_id_varian_foreign` FOREIGN KEY (`id_varian`) REFERENCES `varian` (`id`);

--
-- Constraints for table `detil_nota`
--
ALTER TABLE `detil_nota`
  ADD CONSTRAINT `detil_nota_id_nota_foreign` FOREIGN KEY (`id_nota`) REFERENCES `nota` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detil_nota_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detil_nota_id_varian_foreign` FOREIGN KEY (`id_varian`) REFERENCES `varian` (`id`);

--
-- Constraints for table `detil_produk`
--
ALTER TABLE `detil_produk`
  ADD CONSTRAINT `detil_produk_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detil_produk_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detil_produk_id_varian_foreign` FOREIGN KEY (`id_varian`) REFERENCES `varian` (`id`);

--
-- Constraints for table `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_id_kasir_foreign` FOREIGN KEY (`id_kasir`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `restock`
--
ALTER TABLE `restock`
  ADD CONSTRAINT `restock_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `varian`
--
ALTER TABLE `varian`
  ADD CONSTRAINT `varian_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
