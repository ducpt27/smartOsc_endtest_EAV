-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2019 at 03:03 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fresher_ptduc`
--
CREATE DATABASE IF NOT EXISTS `fresher_ptduc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `fresher_ptduc`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `entity_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `parent_id` int(10) DEFAULT 0,
  PRIMARY KEY (`entity_id`),
  KEY `category_to_parent` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`entity_id`, `name`, `created_at`, `updated_at`, `parent_id`) VALUES
(1, 'Women\'s Fashion', '2019-12-01 16:02:30', '2019-12-01 16:02:30', 0),
(2, 'Men\'s Fashion', '2019-12-01 16:02:30', '2019-12-01 16:02:30', 0),
(4, 'Women Dresses', '2019-12-01 16:07:47', '2019-12-01 16:07:47', 1),
(5, 'Women Bottoms', '2019-12-01 16:07:47', '2019-12-01 16:07:47', 1),
(6, 'Women Tops', '2019-12-01 16:07:47', '2019-12-01 16:07:47', 1),
(7, 'Men Clothing', '2019-12-01 16:07:47', '2019-12-01 16:07:47', 2),
(8, 'Jeans', '2019-12-01 16:08:59', '2019-12-01 16:08:59', 5),
(9, 'Men Shoes', '2019-12-01 16:08:59', '2019-12-01 16:08:59', 2);

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute`
--

DROP TABLE IF EXISTS `eav_attribute`;
CREATE TABLE IF NOT EXISTS `eav_attribute` (
  `attribute_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `attribute_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frontend_input` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frontend_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `backend_type` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'static',
  `is_filterable` smallint(5) NOT NULL DEFAULT 0,
  `default_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eav_attribute`
--

INSERT INTO `eav_attribute` (`attribute_id`, `attribute_code`, `frontend_input`, `frontend_label`, `backend_type`, `is_filterable`, `default_value`) VALUES
(1, 'name', 'text', 'Name', 'varchar', 0, ''),
(2, 'price', 'price', 'Price', 'decimal', 0, '0'),
(3, 'color', 'multiselect', 'Color', 'varchar', 1, NULL),
(4, 'size', 'multiselect', 'Size', 'varchar', 1, NULL),
(5, 'description', 'textarea', 'Description', 'text', 0, ''),
(6, 'category_id', 'multilevel', 'Category', 'int', 0, '0'),
(7, 'image', 'image', 'Image', 'varchar', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `product_entity`
--

DROP TABLE IF EXISTS `product_entity`;
CREATE TABLE IF NOT EXISTS `product_entity` (
  `entity_id` int(10) NOT NULL AUTO_INCREMENT,
  `sku` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_entity`
--

INSERT INTO `product_entity` (`entity_id`, `sku`, `created_at`, `updated_at`) VALUES
(1, 'sku-a-12', '2019-12-01 15:37:06', '2019-12-01 22:02:33'),
(2, 'sku-a-13', '2019-12-01 15:37:25', '2019-12-01 15:37:25'),
(3, 'sku-a-14', '2019-12-01 15:38:06', '2019-12-01 15:38:06'),
(4, 'sku-a-15', '2019-12-01 15:38:24', '2019-12-01 15:38:24'),
(5, 'sku-test-1', '2019-12-08 13:15:54', '2019-12-08 13:15:54'),
(111, 'sku-test-2', '2019-12-09 15:44:00', '2019-12-09 15:44:00'),
(112, 'sku-test-3', '2019-12-09 15:44:33', '2019-12-09 15:44:33'),
(118, 's-400944178', '2019-12-10 14:57:37', '2019-12-10 14:57:37'),
(119, 's-478244417', '2019-12-10 15:31:02', '2019-12-10 15:31:02'),
(120, 's-765671664', '2019-12-10 15:32:49', '2019-12-10 15:32:49'),
(121, 's-243809450', '2019-12-10 15:33:49', '2019-12-10 15:33:49'),
(122, 's-609513743', '2019-12-10 15:39:24', '2019-12-10 15:39:24'),
(123, 's-909130302', '2019-12-10 15:40:24', '2019-12-10 15:40:24'),
(124, 's-942421441', '2019-12-10 15:43:42', '2019-12-10 15:43:42'),
(125, 's-421789153', '2019-12-10 15:44:19', '2019-12-10 15:44:19'),
(126, '30286012811575', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(127, '5602211528081296', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(128, '3583983892728292', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(129, '5602226699612810', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(130, '6304074067331491', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(131, '6767349048939541', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(132, '3553094240714822', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(133, '5020884008652605053', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(134, '3577675585811967', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(135, '3556425587634768', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(136, '3552147457776693', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(137, '201931094330472', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(138, '337941838399227', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(139, '3584719076131849', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(140, '3569303542196865', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(141, '4017952393106', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(142, '490360255584498064', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(143, '5108750026562223', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(144, '3562648993220656', '2019-12-11 10:25:46', '2019-12-11 10:25:46'),
(145, '3574117796361246', '2019-12-11 10:25:46', '2019-12-11 10:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_value_datetime`
--

DROP TABLE IF EXISTS `product_value_datetime`;
CREATE TABLE IF NOT EXISTS `product_value_datetime` (
  `value_id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(10) NOT NULL,
  `attribute_id` smallint(5) NOT NULL,
  `value` datetime DEFAULT NULL,
  PRIMARY KEY (`value_id`),
  KEY `product_value_datetime_to_entity` (`entity_id`),
  KEY `product_value_datetime_to_attribute` (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_value_decimal`
--

DROP TABLE IF EXISTS `product_value_decimal`;
CREATE TABLE IF NOT EXISTS `product_value_decimal` (
  `value_id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(10) NOT NULL,
  `attribute_id` smallint(5) NOT NULL,
  `value` decimal(20,2) DEFAULT NULL,
  PRIMARY KEY (`value_id`),
  KEY `product_value_decimal_to_entity` (`entity_id`),
  KEY `product_value_decimal_to_attribute` (`attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_value_decimal`
--

INSERT INTO `product_value_decimal` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 1, 2, '9.90'),
(2, 2, 2, '15.00'),
(3, 3, 2, '32.00'),
(4, 4, 2, '3.00'),
(5, 5, 2, '69.00'),
(14, 111, 2, '38.15'),
(15, 112, 2, '132.80'),
(19, 118, 2, '3123.00'),
(20, 119, 2, '204.91'),
(21, 120, 2, '245.31'),
(22, 121, 2, '55.48'),
(23, 122, 2, '324.25'),
(24, 123, 2, '285.05'),
(25, 124, 2, '907.47'),
(26, 125, 2, '826.03'),
(27, 126, 2, '346.78'),
(28, 127, 2, '949.31'),
(29, 128, 2, '948.56'),
(30, 129, 2, '714.70'),
(31, 130, 2, '195.50'),
(32, 131, 2, '16.09'),
(33, 132, 2, '39.08'),
(34, 133, 2, '601.18'),
(35, 134, 2, '505.80'),
(36, 135, 2, '921.36'),
(37, 136, 2, '593.87'),
(38, 137, 2, '310.92'),
(39, 138, 2, '633.52'),
(40, 139, 2, '497.06'),
(41, 140, 2, '739.21'),
(42, 141, 2, '954.87'),
(43, 142, 2, '349.03'),
(44, 143, 2, '938.68'),
(45, 144, 2, '185.98'),
(46, 145, 2, '164.26');

-- --------------------------------------------------------

--
-- Table structure for table `product_value_int`
--

DROP TABLE IF EXISTS `product_value_int`;
CREATE TABLE IF NOT EXISTS `product_value_int` (
  `value_id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(10) NOT NULL,
  `attribute_id` smallint(5) NOT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`value_id`),
  KEY `product_value_int_to_entity` (`entity_id`),
  KEY `product_value_int_to_attribute` (`attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_value_int`
--

INSERT INTO `product_value_int` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 1, 6, 8),
(2, 1, 6, 5),
(3, 1, 6, 1),
(4, 2, 6, 5),
(5, 3, 6, 2),
(6, 4, 6, 2),
(7, 4, 6, 7),
(19, 118, 6, 1),
(20, 119, 6, 2),
(21, 120, 6, 2),
(22, 121, 6, 1),
(23, 122, 6, 1),
(24, 122, 6, 2),
(25, 123, 6, 1),
(26, 124, 6, 1),
(27, 125, 6, 2),
(28, 126, 6, 6),
(29, 127, 6, 9),
(30, 128, 6, 8),
(31, 129, 6, 3),
(32, 130, 6, 4),
(33, 131, 6, 2),
(34, 132, 6, 9),
(35, 133, 6, 1),
(36, 134, 6, 8),
(37, 135, 6, 1),
(38, 136, 6, 1),
(39, 137, 6, 3),
(40, 138, 6, 6),
(41, 139, 6, 9),
(42, 140, 6, 7),
(43, 141, 6, 9),
(44, 142, 6, 3),
(45, 143, 6, 5),
(46, 144, 6, 6),
(47, 145, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_value_text`
--

DROP TABLE IF EXISTS `product_value_text`;
CREATE TABLE IF NOT EXISTS `product_value_text` (
  `value_id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(10) NOT NULL,
  `attribute_id` smallint(5) NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`value_id`),
  KEY `product_value_text_to_entity` (`entity_id`),
  KEY `product_value_text_to_attribute` (`attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_value_text`
--

INSERT INTO `product_value_text` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 1, 5, NULL),
(8, 111, 5, 'Reposition Left Tibia with Hybrid Ext Fix, Open Approach'),
(9, 112, 5, 'Reposition Left Tibia with Hybrid Ext Fix, Open Approach'),
(13, 118, 5, 'No description'),
(14, 119, 5, 'Biopsy of iris'),
(15, 120, 5, 'Laparoscopic removal of both ovaries and tubes at same operative episode'),
(16, 121, 5, 'Other arthrotomy, hand and finger'),
(17, 122, 5, 'Wide excision of lesion of lip'),
(18, 123, 5, 'Application of external fixator device, unspecified site'),
(19, 124, 5, '	Implantation or replacement of subcutaneous device for intracardiac or great vessel hemodynamic monitoring'),
(20, 125, 5, 'Creation of conduit between atrium and pulmonary artery');

-- --------------------------------------------------------

--
-- Table structure for table `product_value_varchar`
--

DROP TABLE IF EXISTS `product_value_varchar`;
CREATE TABLE IF NOT EXISTS `product_value_varchar` (
  `value_id` int(10) NOT NULL AUTO_INCREMENT,
  `entity_id` int(10) NOT NULL,
  `attribute_id` smallint(5) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`value_id`),
  KEY `product_value_varchar_to_entity` (`entity_id`),
  KEY `product_value_varchar_to_attribute` (`attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_value_varchar`
--

INSERT INTO `product_value_varchar` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 1, 1, 'Half Zip'),
(2, 2, 1, 'Short Sleeves Tee'),
(3, 3, 1, 'Basic Floral Tee'),
(4, 4, 1, 'Floral  Tee'),
(6, 1, 3, 'Blue'),
(7, 1, 3, 'Black'),
(8, 1, 3, 'Red'),
(9, 2, 3, 'Blue'),
(10, 2, 3, 'Black'),
(11, 1, 4, 'L'),
(12, 1, 4, 'XL'),
(13, 2, 4, 'S'),
(14, 2, 4, 'M'),
(15, 3, 4, 'L'),
(34, 1, 7, 'upload/image/b1.jpg'),
(35, 2, 7, 'upload/image/f1.jpg'),
(36, 3, 7, 'upload/image/f2.jpg'),
(37, 3, 7, 'upload/image/f3.jpg'),
(38, 4, 7, 'upload/image/m1.png'),
(39, 4, 7, 'upload/image/m2.png'),
(40, 4, 7, 'upload/image/m3.png'),
(41, 5, 7, 'upload/image/v3.jpg'),
(42, 5, 1, 'Hanes Men\'s Pullover'),
(78, 111, 1, 'Margie Dorton'),
(79, 111, 3, 'Red'),
(80, 111, 4, 'S'),
(81, 111, 7, 'upload/image/dadw15dee6bc09a08d4.16891151.jpg'),
(82, 111, 7, 'upload/image/dawd5dee6bc09a3ab1.88409759.jpg'),
(83, 112, 1, 'Vidovic Hurlestone'),
(84, 112, 3, 'Red'),
(85, 112, 4, 'S'),
(86, 112, 7, 'upload/image/dadw15dee6be1b76a20.82568820.jpg'),
(87, 112, 7, 'upload/image/dawd5dee6be1b78487.96618589.jpg'),
(104, 118, 1, 'Google'),
(105, 118, 3, 'Black'),
(106, 118, 4, 'XL'),
(107, 118, 7, 'upload/image/dawd5dee6bc09a3ab15defb261c86934.73713383.jpg'),
(108, 118, 7, 'upload/image/f35defb261c88226.38156353.jpg'),
(109, 118, 7, 'upload/image/v15defb261c89703.98763058.jpg'),
(110, 119, 1, 'Met-Tox'),
(111, 119, 3, 'Red'),
(112, 119, 4, 'XL'),
(113, 119, 7, 'upload/image/giay-the-thao-den-g215_2_small-10621-t5defba369faf81.71394889.jpg'),
(114, 119, 7, 'upload/image/giay-the-thao-trang-g215_2_small-10622-t5defba369fcc34.51314482.jpg'),
(115, 120, 1, 'Guinea Pig Epithelia'),
(116, 120, 3, 'Red'),
(117, 120, 4, 'XL'),
(118, 120, 7, 'upload/image/giay-the-thao-trang-g212_2_small-10616-t5defbaa1c01bc2.40771143.jpg'),
(119, 120, 7, 'upload/image/giay-the-thao-trang-g215_2_small-10622-t5defbaa1c04366.09783018.jpg'),
(120, 121, 1, 'Cryptotox Combo'),
(121, 121, 3, 'Black'),
(122, 121, 4, 'XL'),
(123, 121, 7, 'upload/image/ao-len-reu-al122_2_small-10541-t5defbadddd3dc6.40032883.jpg'),
(124, 120, 3, 'Green'),
(125, 120, 3, 'Yellow'),
(126, 122, 1, 'Softlips Cube Vanilla Bean'),
(127, 122, 7, 'upload/image/ao-len-xanh-den-al123_2_small-10704-t5defbc2cdb5de7.76406272.jpg'),
(128, 123, 1, 'Rosmarinus Poterium'),
(129, 123, 3, 'Yellow'),
(130, 123, 4, 'M'),
(131, 123, 7, 'upload/image/ao-len-xanh-den-al123_2_small-10705-t5defbc685d2b71.05615018.jpg'),
(132, 124, 1, 'Lorazepam namfix'),
(133, 124, 3, 'Yellow'),
(134, 124, 4, 'M'),
(135, 124, 7, 'upload/image/ao-len-vang-kem-al122_2_small-10543-t5defbd2e3cbd47.05117141.jpg'),
(136, 125, 1, 'Greenlam'),
(137, 125, 3, 'Yellow'),
(138, 125, 4, 'M'),
(139, 125, 7, 'upload/image/ao-len-co-tim-xam-al81_small-10497-t.jpg'),
(140, 126, 1, 'Dakota Club'),
(141, 127, 1, 'Boxster'),
(142, 128, 1, 'Avalon'),
(143, 129, 1, 'Trans Sport'),
(144, 130, 1, 'Defender Ice Edition'),
(145, 131, 1, 'Discovery'),
(146, 132, 1, 'Bronco II'),
(147, 133, 1, 'TrailBlazer'),
(148, 134, 1, 'GTI'),
(149, 135, 1, 'Continental Flying Spur'),
(150, 136, 1, 'Stratus'),
(151, 137, 1, 'Grand Voyager'),
(152, 138, 1, 'Vision'),
(153, 139, 1, 'Altima'),
(154, 140, 1, 'Club Wagon'),
(155, 141, 1, 'Pajero'),
(156, 142, 1, 'Avalanche'),
(157, 143, 1, 'Mountaineer'),
(158, 144, 1, 'Pilot'),
(159, 145, 1, 'Matrix'),
(180, 126, 3, 'Green'),
(181, 127, 3, 'Red'),
(182, 128, 3, 'Yellow'),
(183, 129, 3, 'Red'),
(184, 130, 3, 'Yellow'),
(185, 131, 3, 'Green'),
(186, 132, 3, 'Black'),
(187, 133, 3, 'Blue'),
(188, 135, 3, 'Red'),
(189, 136, 3, 'Blue'),
(190, 137, 3, 'Green'),
(191, 138, 3, 'Green'),
(192, 139, 3, 'Yellow'),
(193, 142, 3, 'Black'),
(194, 143, 3, 'Blue'),
(195, 144, 3, 'Yellow'),
(197, 145, 3, 'Green'),
(198, 144, 3, 'Red'),
(199, 143, 3, 'Yellow'),
(200, 142, 3, 'Red'),
(201, 141, 3, 'Yellow'),
(202, 140, 3, 'Green'),
(203, 139, 3, 'Black'),
(204, 138, 3, 'Blue'),
(205, 126, 4, 'S'),
(206, 127, 4, 'M'),
(207, 128, 4, 'XL'),
(208, 129, 4, 'M'),
(209, 130, 4, 'XL'),
(210, 131, 4, 'S'),
(211, 132, 4, 'XXL'),
(212, 133, 4, 'L'),
(213, 135, 4, 'M'),
(214, 136, 4, 'L'),
(215, 137, 4, 'S'),
(216, 138, 4, 'S'),
(217, 139, 4, 'XL'),
(218, 142, 4, 'XXL'),
(219, 143, 4, 'L'),
(220, 144, 4, 'XL'),
(221, 145, 4, 'S'),
(222, 144, 4, 'M'),
(223, 143, 4, 'XL'),
(224, 142, 4, 'M'),
(225, 141, 4, 'XL'),
(226, 140, 4, 'S'),
(227, 139, 4, 'XXL'),
(228, 138, 4, 'L'),
(229, 126, 4, 'XL'),
(230, 127, 4, 'S'),
(231, 128, 4, 'XXL'),
(232, 129, 4, 'L'),
(233, 130, 4, 'M'),
(234, 131, 4, 'L'),
(235, 145, 7, 'upload/image/tb1.jpg'),
(236, 126, 7, 'upload/image/tb2.jpg'),
(237, 127, 7, 'upload/image/tb3.jpg'),
(238, 128, 7, 'upload/image/tb4.jpg'),
(239, 129, 7, 'upload/image/tb5.jpg'),
(240, 130, 7, 'upload/image/tb6.jpg'),
(241, 131, 7, 'upload/image/tb7.jpg'),
(242, 132, 7, 'upload/image/tb8.jpg'),
(243, 133, 7, 'upload/image/tb9.jpg'),
(244, 134, 7, 'upload/image/tb10.jpg'),
(245, 135, 7, 'upload/image/tb11.jpg'),
(246, 136, 7, 'upload/image/tb12.jpg'),
(247, 137, 7, 'upload/image/tb13.jpg'),
(248, 138, 7, 'upload/image/tb14.jpg'),
(249, 139, 7, 'upload/image/tb15.jpg'),
(250, 140, 7, 'upload/image/tb16.jpg'),
(251, 141, 7, 'upload/image/tb17.jpg'),
(252, 142, 7, 'upload/image/tb18.jpg'),
(253, 143, 7, 'upload/image/tb19.jpg'),
(254, 144, 7, 'upload/image/tb20.jpg'),
(255, 145, 7, 'upload/image/tb20.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_value_datetime`
--
ALTER TABLE `product_value_datetime`
  ADD CONSTRAINT `product_value_datetime_to_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`),
  ADD CONSTRAINT `product_value_datetime_to_entity` FOREIGN KEY (`entity_id`) REFERENCES `product_entity` (`entity_id`);

--
-- Constraints for table `product_value_decimal`
--
ALTER TABLE `product_value_decimal`
  ADD CONSTRAINT `product_value_decimal_to_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`),
  ADD CONSTRAINT `product_value_decimal_to_entity` FOREIGN KEY (`entity_id`) REFERENCES `product_entity` (`entity_id`);

--
-- Constraints for table `product_value_int`
--
ALTER TABLE `product_value_int`
  ADD CONSTRAINT `product_value_int_to_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`),
  ADD CONSTRAINT `product_value_int_to_entity` FOREIGN KEY (`entity_id`) REFERENCES `product_entity` (`entity_id`);

--
-- Constraints for table `product_value_text`
--
ALTER TABLE `product_value_text`
  ADD CONSTRAINT `product_value_text_to_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`),
  ADD CONSTRAINT `product_value_text_to_entity` FOREIGN KEY (`entity_id`) REFERENCES `product_entity` (`entity_id`);

--
-- Constraints for table `product_value_varchar`
--
ALTER TABLE `product_value_varchar`
  ADD CONSTRAINT `product_value_varchar_to_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`),
  ADD CONSTRAINT `product_value_varchar_to_entity` FOREIGN KEY (`entity_id`) REFERENCES `product_entity` (`entity_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
