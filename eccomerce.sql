-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 12:19 PM
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
(37, 'Hoodie', 'Warm t-shirt with thick hood for winter', 36, '2025-02-26 04:31:42', '2025-02-26 06:16:28'),
(38, 'sweat shirt', 't-shirt with high GSM fabric without hood', 36, '2025-02-26 04:32:43', '2025-02-26 04:32:43'),
(39, 'Footwear', 'for legs ', 1, '2025-02-26 04:33:28', '2025-02-26 04:33:28'),
(40, 'Sport Shoes', 'for sports activity', 39, '2025-02-26 04:33:54', '2025-02-26 04:33:54'),
(41, 'Formal Shoes', 'for formal wear like office , party', 39, '2025-02-26 04:35:03', '2025-02-26 04:35:03'),
(42, 'Sneakers ', 'for casual wear', 39, '2025-02-26 04:35:24', '2025-02-26 04:35:24'),
(48, 'hb nm', 'jn m', NULL, '0000-00-00 00:00:00', '2025-02-26 06:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `catalog_media_gallery`
--

CREATE TABLE `catalog_media_gallery` (
  `media_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `type` enum('image','video','document') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalog_media_gallery`
--

INSERT INTO `catalog_media_gallery` (`media_id`, `product_id`, `file_path`, `type`, `created_at`) VALUES
(14, 20, 'media/thumbnail_67be9b198f607_ntm.png', 'image', '2025-02-26 04:39:53'),
(15, 20, 'media/67be9b199b52b_ntmlogo.png', 'image', '2025-02-26 04:39:53'),
(16, 20, 'media/67be9b19a3dfa_ntmback.png', 'image', '2025-02-26 04:39:53'),
(17, 20, 'media/67be9b19a7400_ntmelivatedtop.png', 'image', '2025-02-26 04:39:53'),
(18, 20, 'media/67be9b19afbd3_ntmtop1.png', 'image', '2025-02-26 04:39:53'),
(19, 20, 'media/67be9b19b8f16_ntmside1.png', 'image', '2025-02-26 04:39:53'),
(20, 20, 'media/67be9b19bf466_ntmbottom.png', 'image', '2025-02-26 04:39:53'),
(21, 21, 'media/thumbnail_67bea0ab47fcf_skt1.png', 'image', '2025-02-26 05:03:39'),
(22, 21, 'media/67bea0ab5026a_skt7.jpg', 'image', '2025-02-26 05:03:39'),
(23, 21, 'media/67bea0ab51e3c_skt6.png', 'image', '2025-02-26 05:03:39'),
(24, 21, 'media/67bea0ab585ea_skt5.jpg', 'image', '2025-02-26 05:03:39'),
(25, 21, 'media/67bea0ab60951_skt4.jpg', 'image', '2025-02-26 05:03:39'),
(26, 21, 'media/67bea0ab6883f_skt3.png', 'image', '2025-02-26 05:03:39'),
(27, 21, 'media/67bea0ab707ee_skt2.png', 'image', '2025-02-26 05:03:39'),
(28, 22, 'media/thumbnail_67bea19031834_aj1mse1.png', 'image', '2025-02-26 05:07:28'),
(29, 22, 'media/67bea1903d377_aj1mse6.png', 'image', '2025-02-26 05:07:28'),
(30, 22, 'media/67bea19044bde_aj1mse5.png', 'image', '2025-02-26 05:07:28'),
(31, 22, 'media/67bea19048d6e_aj1mse4.png', 'image', '2025-02-26 05:07:28'),
(32, 22, 'media/67bea19054ba5_aj1mse3.png', 'image', '2025-02-26 05:07:28'),
(33, 22, 'media/67bea1905d64f_aj1mse2.png', 'image', '2025-02-26 05:07:28'),
(34, 23, 'media/thumbnail_67bea52a114e6_aj1lse1.png', 'image', '2025-02-26 05:22:50'),
(35, 23, 'media/67bea52a19219_aj1lse7.png', 'image', '2025-02-26 05:22:50'),
(36, 23, 'media/67bea52a2098d_aj1lse6.png', 'image', '2025-02-26 05:22:50'),
(37, 23, 'media/67bea52a2937d_aj1lse5.png', 'image', '2025-02-26 05:22:50'),
(38, 23, 'media/67bea52a3128c_aj1lse4.png', 'image', '2025-02-26 05:22:50'),
(39, 23, 'media/67bea52a34f12_aj1lse3.png', 'image', '2025-02-26 05:22:50'),
(40, 23, 'media/67bea52a3d5d3_aj1lse2.png', 'image', '2025-02-26 05:22:50'),
(41, 24, 'media/thumbnail_67bea7207fd9e_10002.jpg', 'image', '2025-02-26 05:31:12'),
(42, 24, 'media/67bea7208ce20_10003.jpg', 'image', '2025-02-26 05:31:12'),
(43, 24, 'media/67bea72095212_10004.jpg', 'image', '2025-02-26 05:31:12'),
(44, 24, 'media/67bea7209ad72_10005.jpg', 'image', '2025-02-26 05:31:12'),
(45, 24, 'media/67bea720a1420_10006.jpg', 'image', '2025-02-26 05:31:12'),
(46, 24, 'media/67bea720a8945_10007.jpg', 'image', '2025-02-26 05:31:12'),
(47, 24, 'media/67bea720adcd0_fbl1.jpg', 'image', '2025-02-26 05:31:12'),
(48, 25, 'media/thumbnail_67c19ad843847_nkt5.png', 'image', '2025-02-28 11:15:36'),
(49, 25, 'media/67c19ad8539ed_nkt4.jpg', 'image', '2025-02-28 11:15:36'),
(50, 25, 'media/67c19ad85a699_nkt3.png', 'image', '2025-02-28 11:15:36'),
(51, 25, 'media/67c19ad85ff86_nkt2.png', 'image', '2025-02-28 11:15:36'),
(52, 25, 'media/67c19ad868212_nkt1.png', 'image', '2025-02-28 11:15:36');

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
(22, 'Air Jordan 1 Mid SE ', '  Take your neutral game to the next level with this special edition AJ1. Genuine leather ensures you step out in luxury style, while a plush mid-top collar and classic Nike Air cushioning make for a premium look and feel.', 'HF3216-102', 12295.00, 12, 42, '2025-02-26 05:07:27', '2025-02-26 05:07:27'),
(23, 'Air Jordan 1 Low SE', '  This fresh take on the AJ1 brings new energy to neutrals. Smooth, premium leather and classic Nike Air cushioning give you the quality and comfort you\'ve come to expect from Jordan.', 'HF3148-011', 11495.00, 5, 42, '2025-02-26 05:22:49', '2025-02-26 05:22:49'),
(24, 'Men Brown Leather Shoes', '      Men Brown Leather Oxford Shoes    ', 'LPSCRGFL00139', 5000.00, 4, 41, '2025-02-26 05:31:12', '2025-02-28 09:43:28'),
(25, 'Nike Sportswear', '  Dropped shoulders, longer sleeves and a roomy fit through the body and hips give this Max90 tee a relaxed look. The rich, heavyweight cotton fabric has a stiff drape and structured feel.\r\n\r\n', ' FZ7976-051', 1200.00, 34, 38, '2025-02-28 11:15:35', '2025-02-28 11:15:35');

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
(15, 2, 22, 'White/Black/Dark Pony'),
(16, 5, 22, 'Genuine leather '),
(17, 6, 22, 'Nike'),
(18, 8, 22, '2025-02-08'),
(19, 2, 23, 'Medium Grey/White/Cool'),
(20, 5, 23, 'premium leather '),
(21, 6, 23, 'Nike'),
(22, 8, 23, '2025-01-28'),
(23, 2, 24, 'Brown green'),
(24, 5, 24, 'Leather'),
(25, 6, 24, 'Louis Philippe'),
(26, 8, 24, '2025-02-09'),
(37, 9, 24, 'USA'),
(38, 2, 25, 'White'),
(39, 5, 25, 'Cotton'),
(40, 6, 25, 'Nike'),
(41, 8, 25, '2025-02-02'),
(42, 9, 25, 'China');

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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `order_invoice`
--
ALTER TABLE `order_invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `order_id` (`order_id`);

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
-- AUTO_INCREMENT for table `catalog_attribute`
--
ALTER TABLE `catalog_attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `catalog_category`
--
ALTER TABLE `catalog_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `catalog_media_gallery`
--
ALTER TABLE `catalog_media_gallery`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `catalog_product`
--
ALTER TABLE `catalog_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `catalog_product_attribute`
--
ALTER TABLE `catalog_product_attribute`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_invoice`
--
ALTER TABLE `order_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE SET NULL;

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
