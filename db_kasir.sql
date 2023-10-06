/*
 Navicat Premium Data Transfer

 Source Server         : local mysql
 Source Server Type    : MySQL
 Source Server Version : 50734
 Source Host           : localhost:8889
 Source Schema         : db_kasir

 Target Server Type    : MySQL
 Target Server Version : 50734
 File Encoding         : 65001

 Date: 06/10/2023 10:12:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_jual
-- ----------------------------
DROP TABLE IF EXISTS `tbl_jual`;
CREATE TABLE `tbl_jual` (
  `id_jual` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(50) DEFAULT NULL,
  `tgl_jual` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `grand_total` varchar(50) DEFAULT NULL,
  `dibayar` varchar(50) DEFAULT NULL,
  `kembalian` varchar(50) DEFAULT NULL,
  `id_kasir` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id_jual`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_jual
-- ----------------------------
BEGIN;
INSERT INTO `tbl_jual` (`id_jual`, `no_faktur`, `tgl_jual`, `jam`, `grand_total`, `dibayar`, `kembalian`, `id_kasir`) VALUES (1, '202308160001', '2023-08-16', '12:08:54', '50000', '50000', '0', 'admin');
INSERT INTO `tbl_jual` (`id_jual`, `no_faktur`, `tgl_jual`, `jam`, `grand_total`, `dibayar`, `kembalian`, `id_kasir`) VALUES (2, '202309270001', '2023-09-27', '11:47:23', '50000', '50000', '0', 'admin');
INSERT INTO `tbl_jual` (`id_jual`, `no_faktur`, `tgl_jual`, `jam`, `grand_total`, `dibayar`, `kembalian`, `id_kasir`) VALUES (3, '202310040001', '2023-10-04', '10:01:59', '10000', '10000', '0', 'admin');
COMMIT;

-- ----------------------------
-- Table structure for tbl_jual_detil
-- ----------------------------
DROP TABLE IF EXISTS `tbl_jual_detil`;
CREATE TABLE `tbl_jual_detil` (
  `id_rinci` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(50) DEFAULT NULL,
  `kode_produk` varchar(11) DEFAULT NULL,
  `harga_jual` varchar(11) DEFAULT NULL,
  `qty` varchar(11) DEFAULT NULL,
  `total_harga` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id_rinci`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_jual_detil
-- ----------------------------
BEGIN;
INSERT INTO `tbl_jual_detil` (`id_rinci`, `no_faktur`, `kode_produk`, `harga_jual`, `qty`, `total_harga`) VALUES (1, '202308160001', '0001', '50000', '1', '50000');
INSERT INTO `tbl_jual_detil` (`id_rinci`, `no_faktur`, `kode_produk`, `harga_jual`, `qty`, `total_harga`) VALUES (2, '202309270001', '0004', '50000', '1', '50000');
INSERT INTO `tbl_jual_detil` (`id_rinci`, `no_faktur`, `kode_produk`, `harga_jual`, `qty`, `total_harga`) VALUES (3, '202310040001', '0006', '10000', '1', '10000');
COMMIT;

-- ----------------------------
-- Table structure for tbl_kategori
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kategori`;
CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_kategori
-- ----------------------------
BEGIN;
INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES (1, 'Softcase');
INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES (2, 'Kabel');
COMMIT;

-- ----------------------------
-- Table structure for tbl_pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pengeluaran`;
CREATE TABLE `tbl_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(50) NOT NULL,
  `jumlah_produk` varchar(11) NOT NULL,
  `harga_produk` varchar(11) NOT NULL,
  `jumlah_pengeluaran` varchar(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `id_kasir` varchar(11) NOT NULL,
  PRIMARY KEY (`id_pengeluaran`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_pengeluaran
-- ----------------------------
BEGIN;
INSERT INTO `tbl_pengeluaran` (`id_pengeluaran`, `nama_produk`, `jumlah_produk`, `harga_produk`, `jumlah_pengeluaran`, `created_at`, `id_kasir`) VALUES (1, 'Softcase Spigen Liquid Air Iphone X', '1', '0', '0', '2023-08-16', 'admin');
INSERT INTO `tbl_pengeluaran` (`id_pengeluaran`, `nama_produk`, `jumlah_produk`, `harga_produk`, `jumlah_pengeluaran`, `created_at`, `id_kasir`) VALUES (2, 'Softcase Iphone 11 Magsafe Dark Purple', '1', '25000', '25000', '2023-09-11', 'admin');
INSERT INTO `tbl_pengeluaran` (`id_pengeluaran`, `nama_produk`, `jumlah_produk`, `harga_produk`, `jumlah_pengeluaran`, `created_at`, `id_kasir`) VALUES (3, 'Softcase Iphone 12 Magsafe Black', '1', '25000', '25000', '2023-09-11', 'admin');
INSERT INTO `tbl_pengeluaran` (`id_pengeluaran`, `nama_produk`, `jumlah_produk`, `harga_produk`, `jumlah_pengeluaran`, `created_at`, `id_kasir`) VALUES (4, 'Kabel Anker USB C to C', '1', '0', '0', '2023-09-27', 'admin');
INSERT INTO `tbl_pengeluaran` (`id_pengeluaran`, `nama_produk`, `jumlah_produk`, `harga_produk`, `jumlah_pengeluaran`, `created_at`, `id_kasir`) VALUES (5, 'Softcase Hybrid AIORIA Carbon Fiber', '1', '45000', '45000', '2023-09-29', 'admin');
INSERT INTO `tbl_pengeluaran` (`id_pengeluaran`, `nama_produk`, `jumlah_produk`, `harga_produk`, `jumlah_pengeluaran`, `created_at`, `id_kasir`) VALUES (6, 'Softcase Iphone 11 Model Original', '1', '0', '0', '2023-10-04', 'admin');
INSERT INTO `tbl_pengeluaran` (`id_pengeluaran`, `nama_produk`, `jumlah_produk`, `harga_produk`, `jumlah_pengeluaran`, `created_at`, `id_kasir`) VALUES (7, 'Softcase Iphone 6 Plus Model Polos', '1', '0', '0', '2023-10-06', 'admin');
INSERT INTO `tbl_pengeluaran` (`id_pengeluaran`, `nama_produk`, `jumlah_produk`, `harga_produk`, `jumlah_pengeluaran`, `created_at`, `id_kasir`) VALUES (8, 'Softcase Iphone 11 Square Black', '1', '0', '0', '2023-10-06', 'admin');
COMMIT;

-- ----------------------------
-- Table structure for tbl_produk
-- ----------------------------
DROP TABLE IF EXISTS `tbl_produk`;
CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(25) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `id_kategori` varchar(3) NOT NULL,
  `id_satuan` varchar(3) NOT NULL,
  `harga_beli` varchar(11) NOT NULL,
  `harga_jual` varchar(11) NOT NULL,
  `stok` varchar(3) NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_produk
-- ----------------------------
BEGIN;
INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `id_kategori`, `id_satuan`, `harga_beli`, `harga_jual`, `stok`) VALUES (1, '0001', 'Softcase Spigen Liquid Air Iphone X', '1', '1', '0', '50000', '0');
INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `id_kategori`, `id_satuan`, `harga_beli`, `harga_jual`, `stok`) VALUES (2, '0002', 'Softcase Iphone 11 Magsafe Dark Purple', '1', '1', '25000', '40000', '1');
INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `id_kategori`, `id_satuan`, `harga_beli`, `harga_jual`, `stok`) VALUES (3, '0003', 'Softcase Iphone 12 Magsafe Black', '1', '1', '25000', '40000', '1');
INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `id_kategori`, `id_satuan`, `harga_beli`, `harga_jual`, `stok`) VALUES (4, '0004', 'Kabel Anker USB C to C', '2', '1', '0', '50000', '0');
INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `id_kategori`, `id_satuan`, `harga_beli`, `harga_jual`, `stok`) VALUES (5, '0005', 'Softcase Hybrid AIORIA Carbon Fiber', '1', '1', '45000', '60000', '1');
INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `id_kategori`, `id_satuan`, `harga_beli`, `harga_jual`, `stok`) VALUES (6, '0006', 'Softcase Iphone 11 Model Original', '1', '1', '0', '10000', '0');
INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `id_kategori`, `id_satuan`, `harga_beli`, `harga_jual`, `stok`) VALUES (7, '0007', 'Softcase Iphone 6 Plus Model Polos', '1', '1', '0', '20000', '1');
INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `id_kategori`, `id_satuan`, `harga_beli`, `harga_jual`, `stok`) VALUES (8, '0008', 'Softcase Iphone 11 Square Black', '1', '1', '0', '20000', '1');
COMMIT;

-- ----------------------------
-- Table structure for tbl_satuan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_satuan`;
CREATE TABLE `tbl_satuan` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_satuan
-- ----------------------------
BEGIN;
INSERT INTO `tbl_satuan` (`id_satuan`, `nama_satuan`) VALUES (1, 'pcs');
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `is_active` int(1) DEFAULT '0',
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` (`id`, `username`, `email`, `image`, `password`, `role_id`, `is_active`, `created_at`) VALUES (16, 'admin', 'admin@gmail.com', '1696560837_2de2c79f63914e8a2af9.png', '$2y$10$PX47Uw/FpAJvaQ1DHfz2EuezSawtzpuNyeWUVpVP8pUf7zGykR6OC', 1, 1, '2022-03-03');
INSERT INTO `user` (`id`, `username`, `email`, `image`, `password`, `role_id`, `is_active`, `created_at`) VALUES (17, 'user', 'user@gmail.com', 'default.jpg', '$2y$10$TwfkG2c9wZhuCxO6uDdrk.C3eaIiXeY5U/a.sMG8rYXjs1PSeixyC', 2, 1, '2022-11-22');
COMMIT;

-- ----------------------------
-- Table structure for user_access_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_access_menu`;
CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user_access_menu
-- ----------------------------
BEGIN;
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES (1, 1, 1);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES (2, 1, 2);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES (3, 1, 3);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES (4, 1, 4);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES (5, 1, 5);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES (13, 2, 2);
COMMIT;

-- ----------------------------
-- Table structure for user_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user_menu
-- ----------------------------
BEGIN;
INSERT INTO `user_menu` (`id`, `menu`) VALUES (1, 'Dashboard');
INSERT INTO `user_menu` (`id`, `menu`) VALUES (2, 'Kasir');
INSERT INTO `user_menu` (`id`, `menu`) VALUES (3, 'Transaksi');
INSERT INTO `user_menu` (`id`, `menu`) VALUES (4, 'Produk');
INSERT INTO `user_menu` (`id`, `menu`) VALUES (5, 'Laporan');
COMMIT;

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user_role
-- ----------------------------
BEGIN;
INSERT INTO `user_role` (`id`, `role`) VALUES (1, 'Admin');
INSERT INTO `user_role` (`id`, `role`) VALUES (2, 'Kasir');
COMMIT;

-- ----------------------------
-- Table structure for user_sub_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_sub_menu`;
CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user_sub_menu
-- ----------------------------
BEGIN;
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (1, 1, 'Dashboard', 'dashboard', 'nav-icon fa fa-tachometer-alt', '1');
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (2, 2, 'Kasir', 'kasir', 'nav-icon fa fa-cash-register', '1');
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (3, 3, 'Pengeluaran', 'pengeluaran', 'nav-icon fa fa-dollar-sign', '1');
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (4, 4, 'Produk', 'produk', 'nav-icon fa fa-list', '1');
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (5, 5, 'Laporan Harian', 'laporan/harian', 'nav-icon fa fa-file', '1');
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (6, 5, 'Laporan Bulanan', 'laporan/bulanan', 'nav-icon fa fa-file', '1');
COMMIT;

-- ----------------------------
-- Triggers structure for table tbl_jual_detil
-- ----------------------------
DROP TRIGGER IF EXISTS `pengurangan_otomatis_stok_produk`;
delimiter ;;
CREATE TRIGGER `pengurangan_otomatis_stok_produk` AFTER INSERT ON `tbl_jual_detil` FOR EACH ROW BEGIN
	UPDATE tbl_produk SET stok = stok - NEW.qty WHERE kode_produk = NEW.kode_produk;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
