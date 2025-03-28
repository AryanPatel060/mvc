-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2025 at 09:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eccomerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE `admin_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('superadmin','admin','editor') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`admin_id`, `username`, `password_hash`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'aryan', '1234', 'aryanpatel19aug3@gmail.com', 'admin', '2025-02-28 07:20:26', '2025-02-28 07:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_amount` decimal(11,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `coupon_code` varchar(100) NOT NULL,
  `coupon_discount` decimal(10,2) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `shipping_method` varchar(50) NOT NULL,
  `shipping_charges` decimal(10,2) NOT NULL,
  `payment_method` varchar(250) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `total_amount`, `created_at`, `updated_at`, `coupon_code`, `coupon_discount`, `customer_email`, `shipping_method`, `shipping_charges`, `payment_method`, `is_active`) VALUES
(19, 0, 12891, '2025-03-12 04:25:02', '2025-03-17 00:51:52', 'abc20', 3217.80, 'aryan2208patel@gmail.com', 'bluedart', 20.00, 'pay_on_delivery', 0),
(20, 0, 1461, '2025-03-17 13:00:02', '2025-03-17 19:51:55', 'abc20', 359.00, 'aryan2208patel@gmail.com', 'fastpost', 25.00, 'pay_on_delivery', 0),
(21, 0, 24615, '2025-03-18 07:52:01', '2025-03-19 06:36:01', '', 0.00, 'aryan2208patel@gmail.com', 'fastpost', 25.00, 'pay_on_delivery', 0),
(22, 0, 25, '2025-03-19 07:35:12', '2025-03-18 19:56:44', '', 0.00, 'aryan2208patel@gmail.com', 'fastpost', 25.00, 'pay_on_delivery', 0),
(23, 0, 41407, '2025-03-19 07:56:47', '2025-03-18 20:05:53', 'abc10', 4598.00, '', 'fastpost', 25.00, '', 0),
(24, 0, 28247, '2025-03-19 08:05:56', '2025-03-20 04:36:03', 'abc20', 7057.00, '', 'indianpost', 19.00, 'pay_on_delivery', 1),
(25, 0, 11705, '2025-03-20 07:59:40', '2025-03-19 23:54:49', 'abc5', 614.75, 'aryan2208patel@gmail.com', 'fastpost', 25.00, 'pay_on_delivery', 0),
(26, 6, 11515, '2025-03-20 11:54:54', '2025-03-19 23:57:07', '', 0.00, 'aryan2208patel@gmail.com', 'bluedart', 20.00, '', 0),
(27, 6, 2420, '2025-03-20 11:57:13', '2025-03-20 00:05:48', '', 0.00, 'aryan2208patel@gmail.com', 'bluedart', 20.00, 'pay_on_delivery', 0),
(28, 6, 23381, '2025-03-20 12:06:04', '2025-03-21 05:52:41', 'abc5', 1229.50, '', 'bluedart', 20.00, 'pay_on_delivery', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `address_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `region` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `address_type` varchar(50) DEFAULT NULL,
  `cart_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_address`
--

INSERT INTO `cart_address` (`address_id`, `first_name`, `last_name`, `phone_number`, `street_address`, `city`, `zipcode`, `region`, `country`, `address_type`, `cart_id`, `created_at`, `updated_at`) VALUES
(12, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 19, '2025-03-12 10:22:45', '2025-03-12 10:22:45'),
(13, 'Bipinbhai', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 19, '2025-03-12 10:22:45', '2025-03-17 07:35:07'),
(14, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 20, '2025-03-18 06:06:16', '2025-03-18 06:06:16'),
(15, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 20, '2025-03-18 06:06:16', '2025-03-18 06:06:16'),
(16, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 21, '2025-03-19 06:32:19', '2025-03-19 06:35:57'),
(17, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 21, '2025-03-19 06:32:19', '2025-03-19 06:32:19'),
(18, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 22, '2025-03-19 07:35:36', '2025-03-19 07:35:36'),
(19, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 22, '2025-03-19 07:35:36', '2025-03-19 07:42:46'),
(20, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 25, '2025-03-20 11:54:18', '2025-03-20 11:54:18'),
(21, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 25, '2025-03-20 11:54:18', '2025-03-20 11:54:18'),
(22, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 26, '2025-03-20 11:56:53', '2025-03-20 11:56:53'),
(23, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 26, '2025-03-20 11:56:53', '2025-03-20 11:56:53'),
(24, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 27, '2025-03-20 12:05:35', '2025-03-20 12:05:35'),
(25, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 27, '2025-03-20 12:05:35', '2025-03-20 12:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `sub_total` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`item_id`, `cart_id`, `product_id`, `product_quantity`, `price`, `sub_total`) VALUES
(40, 19, 22, 1, 12295.00, 12295.00),
(41, 19, 34, 2, 1897.00, 3794.00),
(44, 20, 36, 1, 1795.00, 1795.00),
(45, 21, 22, 2, 12295.00, 24590.00),
(46, 23, 23, 4, 11495.00, 45980.00),
(48, 24, 23, 2, 11495.00, 22990.00),
(49, 24, 22, 1, 12295.00, 12295.00),
(50, 25, 22, 1, 12295.00, 12295.00),
(51, 26, 23, 1, 11495.00, 11495.00),
(52, 27, 25, 2, 1200.00, 2400.00),
(53, 28, 22, 2, 12295.00, 24590.00);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_attribute`
--

CREATE TABLE `catalog_attribute` (
  `attribute_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('text','number','date','boolean') NOT NULL,
  `attribute_code` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalog_attribute`
--

INSERT INTO `catalog_attribute` (`attribute_id`, `name`, `type`, `attribute_code`) VALUES
(2, 'Color', 'text', 'color'),
(5, 'Material', 'text', 'material'),
(6, 'Brand', 'text', 'brand'),
(8, 'Release Date', 'date', 'releasedate'),
(9, 'Made In', 'text', 'madein');

-- --------------------------------------------------------

--
-- Table structure for table `catalog_category`
--

CREATE TABLE `catalog_category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalog_category`
--

INSERT INTO `catalog_category` (`category_id`, `name`, `description`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'NA', 'select this if no parent category is defined', NULL, '2025-02-26 04:30:28', '2025-02-26 04:30:28'),
(36, 'Tshirt', 'main category for t-shirts', 1, '2025-02-26 04:31:02', '2025-02-26 04:31:02'),
(39, 'Footwear', 'for legs ', 1, '2025-02-26 04:33:28', '2025-02-26 04:33:28'),
(40, 'Sport Shoes', 'for sports activity', 39, '2025-02-26 04:33:54', '2025-02-26 04:33:54'),
(41, 'Formal Shoes', 'for formal wear like office , party', 39, '2025-02-26 04:35:03', '2025-02-26 04:35:03'),
(42, 'Sneakers ', 'for casual wear', 39, '2025-02-26 04:35:24', '2025-02-26 04:35:24'),
(50, 'Low Tops', 'shoes with low height', 39, '2025-03-17 08:07:27', '2025-03-17 08:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `catalog_media_gallery`
--

CREATE TABLE `catalog_media_gallery` (
  `media_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `type` enum('image','video','document') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cover_image` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalog_media_gallery`
--

INSERT INTO `catalog_media_gallery` (`media_id`, `product_id`, `file_path`, `type`, `created_at`, `cover_image`) VALUES
(14, 20, 'media/thumbnail_67be9b198f607_ntm.png', 'image', '2025-02-26 04:39:53', 1),
(15, 20, 'media/67be9b199b52b_ntmlogo.png', 'image', '2025-02-26 04:39:53', 0),
(16, 20, 'media/67be9b19a3dfa_ntmback.png', 'image', '2025-02-26 04:39:53', 0),
(17, 20, 'media/67be9b19a7400_ntmelivatedtop.png', 'image', '2025-02-26 04:39:53', 0),
(18, 20, 'media/67be9b19afbd3_ntmtop1.png', 'image', '2025-02-26 04:39:53', 0),
(19, 20, 'media/67be9b19b8f16_ntmside1.png', 'image', '2025-02-26 04:39:53', 0),
(20, 20, 'media/67be9b19bf466_ntmbottom.png', 'image', '2025-02-26 04:39:53', 0),
(21, 21, 'media/thumbnail_67bea0ab47fcf_skt1.png', 'image', '2025-02-26 05:03:39', 1),
(22, 21, 'media/67bea0ab5026a_skt7.jpg', 'image', '2025-02-26 05:03:39', 0),
(23, 21, 'media/67bea0ab51e3c_skt6.png', 'image', '2025-02-26 05:03:39', 0),
(24, 21, 'media/67bea0ab585ea_skt5.jpg', 'image', '2025-02-26 05:03:39', 0),
(25, 21, 'media/67bea0ab60951_skt4.jpg', 'image', '2025-02-26 05:03:39', 0),
(26, 21, 'media/67bea0ab6883f_skt3.png', 'image', '2025-02-26 05:03:39', 0),
(27, 21, 'media/67bea0ab707ee_skt2.png', 'image', '2025-02-26 05:03:39', 0),
(28, 22, 'media/thumbnail_67bea19031834_aj1mse1.png', 'image', '2025-02-26 05:07:28', 1),
(29, 22, 'media/67bea1903d377_aj1mse6.png', 'image', '2025-02-26 05:07:28', 0),
(30, 22, 'media/67bea19044bde_aj1mse5.png', 'image', '2025-02-26 05:07:28', 0),
(31, 22, 'media/67bea19048d6e_aj1mse4.png', 'image', '2025-02-26 05:07:28', 0),
(32, 22, 'media/67bea19054ba5_aj1mse3.png', 'image', '2025-02-26 05:07:28', 0),
(33, 22, 'media/67bea1905d64f_aj1mse2.png', 'image', '2025-02-26 05:07:28', 0),
(34, 23, 'media/thumbnail_67bea52a114e6_aj1lse1.png', 'image', '2025-02-26 05:22:50', 1),
(35, 23, 'media/67bea52a19219_aj1lse7.png', 'image', '2025-02-26 05:22:50', 0),
(36, 23, 'media/67bea52a2098d_aj1lse6.png', 'image', '2025-02-26 05:22:50', 0),
(37, 23, 'media/67bea52a2937d_aj1lse5.png', 'image', '2025-02-26 05:22:50', 0),
(38, 23, 'media/67bea52a3128c_aj1lse4.png', 'image', '2025-02-26 05:22:50', 0),
(39, 23, 'media/67bea52a34f12_aj1lse3.png', 'image', '2025-02-26 05:22:50', 0),
(40, 23, 'media/67bea52a3d5d3_aj1lse2.png', 'image', '2025-02-26 05:22:50', 0),
(41, 24, 'media/thumbnail_67bea7207fd9e_10002.jpg', 'image', '2025-02-26 05:31:12', 1),
(42, 24, 'media/67bea7208ce20_10003.jpg', 'image', '2025-02-26 05:31:12', 0),
(43, 24, 'media/67bea72095212_10004.jpg', 'image', '2025-02-26 05:31:12', 0),
(44, 24, 'media/67bea7209ad72_10005.jpg', 'image', '2025-02-26 05:31:12', 0),
(45, 24, 'media/67bea720a1420_10006.jpg', 'image', '2025-02-26 05:31:12', 0),
(46, 24, 'media/67bea720a8945_10007.jpg', 'image', '2025-02-26 05:31:12', 0),
(47, 24, 'media/67bea720adcd0_fbl1.jpg', 'image', '2025-02-26 05:31:12', 0),
(48, 25, 'media/thumbnail_67c19ad843847_nkt5.png', 'image', '2025-02-28 11:15:36', 1),
(49, 25, 'media/67c19ad8539ed_nkt4.jpg', 'image', '2025-02-28 11:15:36', 0),
(50, 25, 'media/67c19ad85a699_nkt3.png', 'image', '2025-02-28 11:15:36', 0),
(51, 25, 'media/67c19ad85ff86_nkt2.png', 'image', '2025-02-28 11:15:36', 0),
(52, 25, 'media/67c19ad868212_nkt1.png', 'image', '2025-02-28 11:15:36', 0),
(53, 33, 'media/67d7d50485934_jb1.jpg', 'image', '2025-03-17 07:53:40', 1),
(54, 33, 'media/67d7d5048fd05_jb7.png', 'image', '2025-03-17 07:53:40', 0),
(55, 33, 'media/67d7d5049a42c_jb6.png', 'image', '2025-03-17 07:53:40', 0),
(57, 33, 'media/67d7d504b0e6b_jb4.png', 'image', '2025-03-17 07:53:40', 0),
(58, 33, 'media/67d7d504b89f0_jb3.png', 'image', '2025-03-17 07:53:40', 0),
(59, 33, 'media/67d7d504bfa45_jb2.png', 'image', '2025-03-17 07:53:40', 0),
(60, 34, 'media/67d7d64787d51_mvp1.jpg', 'image', '2025-03-17 07:59:03', 1),
(61, 34, 'media/67d7d647966f8_mvp5.png', 'image', '2025-03-17 07:59:03', 0),
(62, 34, 'media/67d7d6479e1c1_mvp4.jpg', 'image', '2025-03-17 07:59:03', 0),
(63, 34, 'media/67d7d647a92af_mvp3.jpg', 'image', '2025-03-17 07:59:03', 0),
(64, 34, 'media/67d7d647b1943_mvp2.jpg', 'image', '2025-03-17 07:59:03', 0),
(65, 35, 'media/67d7d98f04119_aj1rl1.png', 'image', '2025-03-17 08:13:03', 1),
(66, 35, 'media/67d7d98f0b20e_aj1rl6.png', 'image', '2025-03-17 08:13:03', 0),
(67, 35, 'media/67d7d98f13653_aj1rl5.png', 'image', '2025-03-17 08:13:03', 0),
(68, 35, 'media/67d7d98f1ad1e_aj1rl4.png', 'image', '2025-03-17 08:13:03', 0),
(69, 35, 'media/67d7d98f228a8_aj1rl3.png', 'image', '2025-03-17 08:13:03', 0),
(70, 35, 'media/67d7d98f29e65_aj1rl2.png', 'image', '2025-03-17 08:13:03', 0),
(71, 36, 'media/67d7da5cafecb_mdf1.png', 'image', '2025-03-17 08:16:28', 1),
(72, 36, 'media/67d7da5cbdd33_mdf5.png', 'image', '2025-03-17 08:16:28', 0),
(73, 36, 'media/67d7da5cc64de_mdf4.png', 'image', '2025-03-17 08:16:28', 0),
(74, 36, 'media/67d7da5cd4089_mdf3.png', 'image', '2025-03-17 08:16:28', 0),
(75, 36, 'media/67d7da5cdcc1c_mdf2.png', 'image', '2025-03-17 08:16:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_product`
--

CREATE TABLE `catalog_product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sku` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalog_product`
--

INSERT INTO `catalog_product` (`product_id`, `name`, `description`, `sku`, `price`, `stock_quantity`, `category_id`, `created_at`, `updated_at`) VALUES
(20, 'Nike Terra Manta', '   The Terra Manta delivers a fresh take on the low-profile look while preserving the retro style we love. Its textile and leather upper pays homage to the classics that came before it, and the outsole features a high-traction design that is both durable and flexible. ', ' HQ1940-200', 7495.00, 25, 42, '2025-02-26 04:39:53', '2025-02-28 05:01:24'),
(21, 'Nike SB Dunk Low Pro ', '  An \'80s b-ball icon returns with classic details and throwback hoops flair. Channelling vintage style back onto the streets, its padded low-cut collar lets you comfortably take your game anywhere.', 'HF3704-800', 9695.00, 32, 42, '2025-02-26 05:03:39', '2025-02-26 05:03:39'),
(22, 'Air Jordan 1 Mid SE ', '     Take your neutral game to the next level with this special edition AJ1. Genuine leather ensures you step out in luxury style, while a plush mid-top collar and classic Nike Air cushioning make for a premium look and feel.   ', 'HF3216-102', 12295.00, 12, 42, '2025-02-26 05:07:27', '2025-03-06 04:44:55'),
(23, 'Air Jordan 1 Low SE', '  This fresh take on the AJ1 brings new energy to neutrals. Smooth, premium leather and classic Nike Air cushioning give you the quality and comfort you\'ve come to expect from Jordan.', 'HF3148-011', 11495.00, 5, 42, '2025-02-26 05:22:49', '2025-02-26 05:22:49'),
(24, 'Men Brown Leather Shoes', '       Men Brown Leather Oxford Shoes     ', 'LPSCRGFL00139', 5000.00, 4, 41, '2025-02-26 05:31:12', '2025-03-05 11:29:18'),
(25, 'Nike Sportswear', '          Dropped shoulders, longer sleeves and a roomy fit through the body and hips give this Max90 tee a relaxed look. The rich, heavyweight cotton fabric has a stiff drape and structured feel.\r\n\r\n        ', ' FZ7976-051', 1200.00, 34, 36, '2025-02-28 11:15:35', '2025-03-17 08:09:12'),
(33, 'Jordan Heir Series PF Bloodline\'', '   Looking to ignite your competitive edge? Cue the Jordan Heir. Crafted with insights from women basketball players, these shoes are all about helping you play shifty and stay low to the ground. A drop-in midsole helps give you extra mobility, while a built-in cage provides a fit that contours to your foot for added support as you move from side to side. So run and cut in confidence. You\'re the game\'s main character, after all. ', 'FQ3859-006', 9695.00, 3, 40, '2025-03-17 07:53:40', '2025-03-17 07:55:40'),
(34, 'Jordan Flight MVP', '   That\'s a clean lookin\' tee! And it\'s made from 100% soft cotton for a classic feel. Nice.\r\n\r\n ', 'FN5958-436', 1897.00, 5, 36, '2025-03-17 07:59:03', '2025-03-17 08:09:21'),
(35, 'Air Jordan 1 Retro Low', '  Every Jordan Retro is a classic sneaker done up in new colours and textures for a fresh feel. Premium materials and accents keep the look modern and on point.', ' HV8293-100', 14995.00, 6, 50, '2025-03-17 08:13:03', '2025-03-17 08:13:03'),
(36, 'Men\'s Dri-FIT Fitness T-Shirt', '   This classic tee has a breathable, lightweight feel that\'s perfect for workouts. Nike Dri-FIT technology moves sweat away from your skin for quicker evaporation, helping you stay dry and comfortable. ', 'HJ3606-100', 1795.00, 65, 36, '2025-03-17 08:16:28', '2025-03-17 08:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `catalog_product_attribute`
--

CREATE TABLE `catalog_product_attribute` (
  `value_id` int(11) NOT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalog_product_attribute`
--

INSERT INTO `catalog_product_attribute` (`value_id`, `attribute_id`, `product_id`, `value`) VALUES
(7, 2, 20, 'Light Brown/Sail'),
(8, 5, 20, 'Textile and leather '),
(9, 6, 20, 'Nike'),
(10, 8, 20, '2025-02-01'),
(11, 2, 21, 'Burnt Sunrise/Gum Light Brown/Vintage Green'),
(12, 5, 21, 'Textile and leather '),
(13, 6, 21, 'Nike'),
(14, 8, 21, '2025-02-02'),
(15, 2, 22, ''),
(16, 5, 22, ''),
(17, 6, 22, 'Nike'),
(18, 8, 22, ''),
(19, 2, 23, 'Medium Grey/White/Cool'),
(20, 5, 23, 'premium leather '),
(21, 6, 23, 'Nike'),
(22, 8, 23, '2025-01-28'),
(23, 2, 24, 'Brown green'),
(24, 5, 24, 'Leather'),
(25, 6, 24, 'Louis Philippe'),
(26, 8, 24, '2025-02-09'),
(37, 9, 24, 'USA'),
(38, 2, 25, 'white'),
(39, 5, 25, 'cotton'),
(40, 6, 25, 'Nike'),
(41, 8, 25, '2025-03-01'),
(42, 9, 25, 'Taiwan'),
(43, 9, 22, ''),
(59, 2, 33, 'Black'),
(60, 5, 33, 'Textile and Fabric'),
(61, 6, 33, 'Nike'),
(62, 8, 33, '2025-03-02'),
(63, 9, 33, 'Singapore'),
(64, 2, 34, 'Blue'),
(65, 5, 34, 'Blue'),
(66, 6, 34, 'Nike'),
(67, 8, 34, '2025-03-06'),
(68, 9, 34, 'China, Vietnam'),
(69, 2, 35, 'Oatmeal'),
(70, 5, 35, 'Fabric'),
(71, 6, 35, 'Nike'),
(72, 8, 35, '2025-03-02'),
(73, 9, 35, 'China'),
(74, 2, 36, 'white'),
(75, 5, 36, 'cotton'),
(76, 6, 36, 'Nike'),
(77, 8, 36, '2025-03-08'),
(78, 9, 36, 'usa');

-- --------------------------------------------------------

--
-- Table structure for table `cms_block`
--

CREATE TABLE `cms_block` (
  `block_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `page_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `email`, `phone`, `created_at`, `updated_at`, `password`) VALUES
(1, 'user1', 'lastname', 'user1@gmail.com', '0000000302', '2025-03-19 12:35:00', '2025-03-24 07:20:27', '12345'),
(4, 'bipin kumar', 'Patel', 'aryan220patel@gmail.com', '09714560206', '2025-03-20 11:06:29', '2025-03-20 11:06:29', '1234'),
(6, 'Aryan', 'Patel', 'aryan1patel@gmail.com', '09714560206', '2025-03-20 11:18:04', '2025-03-20 11:18:04', '12341');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `customer_id`, `street`, `city`, `state`, `zip_code`, `country`, `created_at`, `is_default`) VALUES
(1, 1, '801 sector 27', 'Gandhinagar', 'Gujarat', '382027', 'India', '2025-03-20 08:21:17', 1),
(9, 1, 'Jantral,Jaguvado', 'Vijapur', 'Gujarat', '382860', 'India', '2025-03-20 10:07:40', 0),
(11, 6, '801 sector 27', 'Gandhinagar', 'Gujarat', '382027', 'India', '2025-03-20 11:18:04', 1),
(12, NULL, '', '', '', '', '', '2025-03-20 11:18:17', 0),
(13, 6, 'Jantral,Jaguvado', 'Vijapur', 'Gujarat', '382860', 'India', '2025-03-20 12:02:27', 0),
(16, NULL, '', '', '', '', '', '2025-03-21 04:14:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_status` enum('pending','shipped','delivered','cancelled') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `coupon_code` varchar(50) NOT NULL,
  `coupon_discount` decimal(10,2) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `shipping_method` varchar(50) NOT NULL,
  `shipping_charges` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `customer_id`, `total_amount`, `order_status`, `created_at`, `updated_at`, `coupon_code`, `coupon_discount`, `customer_email`, `shipping_method`, `shipping_charges`, `payment_method`, `order_number`) VALUES
(33, 0, 12891.00, 'shipped', '2025-03-17 00:51:51', '2025-03-24 05:28:33', 'abc20', 3217.80, 'aryan2208patel@gmail.com', 'bluedart', 20.00, 'pay_on_delivery', 'ORD17422843159598'),
(34, 0, 1461.00, 'delivered', '2025-03-17 19:51:55', '2025-03-21 09:04:43', 'abc20', 359.00, 'aryan2208patel@gmail.com', 'fastpost', 25.00, 'pay_on_delivery', 'ORD17422843159597'),
(35, 1, 24615.00, 'delivered', '2025-03-19 06:36:00', '2025-03-21 08:57:59', '', 0.00, 'aryan2208patel@gmail.com', 'fastpost', 25.00, 'pay_on_delivery', 'ORD17423661603505'),
(37, 1, 41407.00, 'pending', '2025-03-18 20:05:52', '2025-03-20 05:56:35', 'abc10', 4598.00, '', 'fastpost', 25.00, '', 'ORD17423715528396'),
(38, 0, 11705.00, 'pending', '2025-03-19 23:54:48', '2025-03-19 23:54:48', 'abc5', 614.75, 'aryan2208patel@gmail.com', 'fastpost', 25.00, 'pay_on_delivery', 'ORD17424716886653'),
(39, 6, 11515.00, 'pending', '2025-03-19 23:57:06', '2025-03-19 23:57:06', '', 0.00, 'aryan2208patel@gmail.com', 'bluedart', 20.00, '', 'ORD17424718268671'),
(40, 6, 2420.00, 'pending', '2025-03-20 00:05:48', '2025-03-20 00:05:48', '', 0.00, 'aryan2208patel@gmail.com', 'bluedart', 20.00, 'pay_on_delivery', 'ORD17424723487672');

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `address_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `region` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `address_type` varchar(50) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`address_id`, `first_name`, `last_name`, `phone_number`, `street_address`, `city`, `zipcode`, `region`, `country`, `address_type`, `order_id`, `created_at`, `updated_at`) VALUES
(9, 'Bipinbhai', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 33, '2025-03-17 00:51:51', '2025-03-18 12:49:49'),
(10, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 33, '2025-03-17 00:51:51', '2025-03-18 12:49:53'),
(11, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 34, '2025-03-17 19:51:55', '2025-03-18 12:49:57'),
(12, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 34, '2025-03-17 19:51:55', '2025-03-18 12:50:01'),
(13, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 0, '2025-03-19 06:36:00', '2025-03-19 06:36:00'),
(14, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 0, '2025-03-19 06:36:00', '2025-03-19 06:36:00'),
(15, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 0, '2025-03-18 19:56:44', '2025-03-18 19:56:44'),
(16, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 0, '2025-03-18 19:56:44', '2025-03-18 19:56:44'),
(17, '', '', '', '', '', '', '', '', NULL, 0, '2025-03-18 20:05:53', '2025-03-18 20:05:53'),
(18, '', '', '', '', '', '', '', '', NULL, 0, '2025-03-18 20:05:53', '2025-03-18 20:05:53'),
(19, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 0, '2025-03-19 23:54:49', '2025-03-19 23:54:49'),
(20, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 0, '2025-03-19 23:54:49', '2025-03-19 23:54:49'),
(21, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 0, '2025-03-19 23:57:07', '2025-03-19 23:57:07'),
(22, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 0, '2025-03-19 23:57:07', '2025-03-19 23:57:07'),
(23, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Billing', 0, '2025-03-20 00:05:48', '2025-03-20 00:05:48'),
(24, 'Aryan', 'Patel', '09714560206', '801 sector 27', 'Gandhinagar', '382027', 'Gujarat', 'India', 'Shipping', 0, '2025-03-20 00:05:48', '2025-03-20 00:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_invoice`
--

CREATE TABLE `order_invoice` (
  `invoice_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `invoice_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `sub_total` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_quantity`, `price`, `sub_total`) VALUES
(49, 33, 22, 1, 12295.00, 12295.00),
(50, 33, 34, 2, 1897.00, 3794.00),
(51, 34, 36, 1, 1795.00, 1795.00),
(52, 35, 22, 2, 12295.00, 24590.00),
(53, 37, 23, 4, 11495.00, 45980.00),
(54, 38, 22, 1, 12295.00, 12295.00),
(55, 39, 23, 1, 11495.00, 11495.00),
(56, 40, 25, 2, 1200.00, 2400.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_payment`
--

CREATE TABLE `order_payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_payment_type`
--

CREATE TABLE `order_payment_type` (
  `payment_type_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_shipment`
--

CREATE TABLE `order_shipment` (
  `shipment_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `shipment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `tracking_number` varchar(255) DEFAULT NULL,
  `carrier` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_shipment_type`
--

CREATE TABLE `order_shipment_type` (
  `shipment_type_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_config`
--

CREATE TABLE `system_config` (
  `config_id` int(11) NOT NULL,
  `config_key` varchar(255) NOT NULL,
  `config_value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `catalog_attribute`
--
ALTER TABLE `catalog_attribute`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `catalog_category`
--
ALTER TABLE `catalog_category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `catalog_media_gallery`
--
ALTER TABLE `catalog_media_gallery`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `catalog_product`
--
ALTER TABLE `catalog_product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `catalog_product_attribute`
--
ALTER TABLE `catalog_product_attribute`
  ADD PRIMARY KEY (`value_id`),
  ADD KEY `attribute_id` (`attribute_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `cms_block`
--
ALTER TABLE `cms_block`
  ADD PRIMARY KEY (`block_id`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `order_invoice`
--
ALTER TABLE `order_invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `order_payment`
--
ALTER TABLE `order_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_payment_type`
--
ALTER TABLE `order_payment_type`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `order_shipment`
--
ALTER TABLE `order_shipment`
  ADD PRIMARY KEY (`shipment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_shipment_type`
--
ALTER TABLE `order_shipment_type`
  ADD PRIMARY KEY (`shipment_type_id`);

--
-- Indexes for table `system_config`
--
ALTER TABLE `system_config`
  ADD PRIMARY KEY (`config_id`),
  ADD UNIQUE KEY `config_key` (`config_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `catalog_attribute`
--
ALTER TABLE `catalog_attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `catalog_category`
--
ALTER TABLE `catalog_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `catalog_media_gallery`
--
ALTER TABLE `catalog_media_gallery`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `catalog_product`
--
ALTER TABLE `catalog_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `catalog_product_attribute`
--
ALTER TABLE `catalog_product_attribute`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `cms_block`
--
ALTER TABLE `cms_block`
  MODIFY `block_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_invoice`
--
ALTER TABLE `order_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `order_payment`
--
ALTER TABLE `order_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_payment_type`
--
ALTER TABLE `order_payment_type`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_shipment`
--
ALTER TABLE `order_shipment`
  MODIFY `shipment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_shipment_type`
--
ALTER TABLE `order_shipment_type`
  MODIFY `shipment_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_config`
--
ALTER TABLE `system_config`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `catalog_category`
--
ALTER TABLE `catalog_category`
  ADD CONSTRAINT `catalog_category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `catalog_category` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `catalog_media_gallery`
--
ALTER TABLE `catalog_media_gallery`
  ADD CONSTRAINT `catalog_media_gallery_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `catalog_product` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `catalog_product`
--
ALTER TABLE `catalog_product`
  ADD CONSTRAINT `catalog_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `catalog_category` (`category_id`) ON DELETE SET NULL;

--
-- Constraints for table `catalog_product_attribute`
--
ALTER TABLE `catalog_product_attribute`
  ADD CONSTRAINT `catalog_product_attribute_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `catalog_attribute` (`attribute_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalog_product_attribute_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `catalog_product` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_invoice`
--
ALTER TABLE `order_invoice`
  ADD CONSTRAINT `order_invoice_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_payment`
--
ALTER TABLE `order_payment`
  ADD CONSTRAINT `order_payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_shipment`
--
ALTER TABLE `order_shipment`
  ADD CONSTRAINT `order_shipment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
