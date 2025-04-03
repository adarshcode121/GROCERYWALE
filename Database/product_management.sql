-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 03, 2025 at 04:43 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `address`, `image`, `created_at`) VALUES
(6, 'Adarsh Prajapati ', 'adofficial121@gmail.com', '$2y$10$tn7F4NurjRCtWIpyZJwuEeC1AQzb8QuIcg2eZIM.9Bmr11GabPKE6', 'Silvassa ', NULL, '2025-04-01 09:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `u_id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `offer` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `address` varchar(250) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `child_categories`
--

DROP TABLE IF EXISTS `child_categories`;
CREATE TABLE IF NOT EXISTS `child_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `child_categories`
--

INSERT INTO `child_categories` (`id`, `parent_id`, `name`, `image`) VALUES
(27, 18, 'Rusks & Wafers', 'Rusks & Wafers.jpg'),
(26, 18, 'Chips & Ctisps', 'Chips & Crispa.webp'),
(25, 17, 'Mango Drinks', 'Mango Drinks.webp'),
(24, 17, 'Fruit & juices', 'Fruit juices.webp'),
(23, 17, 'Soft Drinks', 'Soft Drinks.webp'),
(28, 18, 'Energy Bars ', 'Energy Bars.png'),
(29, 15, 'Milk ', 'Milk.webp'),
(30, 15, 'Bread & Pav ', 'Bread & Pav.webp'),
(31, 15, 'Eggs ', 'Eggs.webp'),
(32, 16, 'Fresh Vegetables ', 'fresh Vegetables.png'),
(33, 16, 'Fresh Fruits ', 'Fresh Fruits.png'),
(34, 16, 'Mangoes & Melons', 'Mangoes & Melons.png'),
(35, 19, 'Noodles ', 'Noodles.webp'),
(37, 19, 'Frozen Veg Snacks ', 'Frozen Veg Snacks.webp'),
(38, 19, 'Frozen Non - Veg Snacks ', 'non veg.webp'),
(39, 20, 'Indian Sweets ', 'indian Sweets.webp'),
(40, 20, 'Chocolate Gift Pack ', 'Chocolate & Gits Pack.webp'),
(41, 20, 'Ice cream & Frozen Dessert ', 'Ice Cream & Frozen Dessert.webp'),
(43, 21, 'Diapers & more ', 'Diapers & More.webp'),
(44, 21, 'Bathing Needs ', 'Bathing Needs.webp'),
(45, 21, 'Baby Wipes', 'Baby Wipes.webp'),
(46, 23, 'Fresh  Meat ', 'Fresh Meat.webp'),
(49, 23, 'Fish & Seafood ', 'Fish & Seafood.jpg'),
(48, 23, 'Chicken', 'Chicken.jpg'),
(50, 22, 'Digestive Care ', 'Digestive Care.webp'),
(51, 22, 'Cough & Cold ', 'Cough & Cold.webp'),
(52, 22, 'Protein & Sports Supplements ', 'Protein & Sports Supplements.webp'),
(53, 24, 'Fresheners ', 'Fresheners.webp'),
(54, 24, 'Toilet & Bathroom Cleaners ', 'Toilet & Bathroom Cleaners.jpg'),
(55, 24, 'Detergents Power & Bars ', 'Detergents Power.webp'),
(56, 17, 'Water ', 'b013208c-1a44-4d34-b289-ad26e58382fb.avif'),
(57, 25, 'USB and OTG', '3099b8ee-74aa-4f12-a0cd-4940bd26c9f9.avif');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `offer` varchar(50) DEFAULT NULL,
  `weight` text,
  `old_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `name`, `description`, `price`, `image`, `offer`, `weight`, `old_price`) VALUES
(41, 25, 'Maaza Mango Drink ', '', 73.00, 'mango Drinks.webp', '', '1.2 ltr ', 73.00),
(40, 29, 'Amul cow Fresh Milk ', '', 28.35, 'milk7.avif', '19% OFF', '500 ml', 35.00),
(39, 29, 'Mother Dairy Toned Fresh Milk ', '', 28.00, 'milk4.avif', '', '500 ml', 28.00),
(38, 29, 'Amul Taaza Toned Fresh Milk + Baby Banana ', '', 58.50, 'milk14.avif', '10% OFF', '4 pieces + 500 ml ', 65.00),
(36, 29, 'Amil Taaza Toned Fresh Milk ', '', 52.25, 'milk2.avif', '5% OFF', '1 ltr ', 55.00),
(37, 29, 'Amul Gold Full Cream Milk ', '', 34.00, 'milk1.avif', '', '500 ml', 34.00),
(42, 25, 'Frooti Mango Drink ', '', 80.00, '2 frooti.avif', '', '600 + 600 ml ', 80.00),
(43, 25, 'Frooti ', '', 10.00, 'Frooti.avif', '', '125 ml ', 10.00),
(44, 25, 'Slice Mango Drink ', '', 83.16, 'Slice.avif', '16% OFF', '1.75', 99.00),
(45, 24, 'Real Orange Juice ', '', 67.50, 'Real fruit power.avif', '10% OFF', '1 ltr ', 75.00),
(46, 24, 'Apple juice ', '', 10.00, 'Apple Juce.avif', '', '125 ml', 10.00),
(47, 24, 'Berry Blast Juice ', '', 148.80, 'yu berry.avif', '7% OFF', '3 *  250 ml ', 160.00),
(48, 24, 'Mix Juicee ', '', 60.00, 'Mix Juce.avif', '', '100 ml', 60.00),
(50, 23, 'Sprite ( 750 ml ) ', '', 79.00, 'sprite.avif', '', '2 * 750 ml ', 79.00),
(51, 23, 'Thums Up Cola ', '', 72.00, 'pepsi.avif', '20% OFF', '2 * 750', 90.00),
(52, 23, '7 UP Nimbooz juice', '', 25.00, '7up.avif', '', '350', 25.00),
(53, 23, 'Fanta Orange Drink ', '', 45.00, 'fanta.avif', '', '750', 45.00),
(54, 23, 'Coco - Cola Diet Coke ', '', 39.00, 'coco-cola.avif', '', '300 ml ', 39.00),
(55, 32, 'Onion ( Kanda ) ', '', 56.70, 'f1.avif', '10% OFF', '1 kg ', 63.00),
(56, 32, 'Potato ', '', 45.00, 'f2.avif', '10% OFF', '1 kg ', 50.00),
(57, 32, 'Hybrid Tomato ', '', 19.25, 'f3.avif', '23% OFF', '500 g ', 25.00),
(58, 32, 'Green Chilli ', '', 27.00, 'f4.avif', '25% OFF', '200 g', 36.00),
(59, 32, 'Desi Tomato ', '', 36.00, 'f5.avif', '', '2 * 500 g ', 36.00),
(60, 33, 'Banana (keli) ', '', 45.00, 'fr1.avif', '', '3 pieces ', 45.00),
(63, 33, 'Brown Coconut  ( Naral) ', '', 44.80, 'fr2.avif', '20% OFF', '1 peice ', 56.00),
(62, 33, 'Baby Banana ', '', 28.00, 'fr3.avif', '', '4 pieces ', 28.00),
(64, 33, 'Kiran Watermelon ', '', 74.40, 'fr5.avif', '20% OFF', '3 kg ', 93.00),
(65, 34, 'Muskmelon ', '', 53.60, 'ft1.avif', '20% OFF', '5000 g', 67.00),
(67, 33, 'Desi Mango ', '', 60.00, 'ft2.avif', '', '4 pieces ', 60.00),
(68, 34, 'Watermelon', '', 50.00, 'fr5.avif', '', '2 kg ', 50.00),
(69, 34, 'Sindhura mango ', '', 150.40, 'ft4.avif', '20% OFF', '3 pieces ', 188.00),
(70, 30, 'The Health Factory', '', 52.25, 'The Health Factory.avif', '5% OFF', '250 ', 55.00),
(71, 30, 'Britannia Vatarich Bread ', '', 40.00, 'Britannia.avif', '', '100g', 40.00),
(72, 31, 'Table White Eggs ', '', 192.80, 'Table White.avif', '20% OFF', '30 pieces ', 241.00),
(73, 31, 'Yojaana Poultry ', '', 104.50, 'Yojana Poultry.avif', '5% OFF', '12 pieces ', 110.00),
(74, 27, 'Britannia Rusk ', '', 40.00, 'r2.avif', '20% OFF', '100g', 50.00),
(75, 27, 'Malpanis Bake  lite', '', 85.00, 'r4.avif', '', '100g', 85.00),
(76, 26, 'Lays Wafer', '', 20.00, 'c2.avif', '', '48 g ', 20.00),
(77, 26, 'Uncle Chips Spicy ', '', 20.00, 'c4.avif', '', '48 g', 20.00),
(78, 26, 'Kurkure Masala Munch ', '', 20.00, 'c5.avif', '', '75 g ', 20.00),
(79, 28, 'Avolt Birthday cake ', '', 130.00, 'e1.avif', '', '100g', 130.00),
(80, 28, 'Yoga Bar ', '', 50.00, 'e2.avif', '', '35 g ', 50.00),
(81, 56, 'Aquafina Packaged Water', '', 20.00, '9a33cf3e-72c0-4116-aae8-2eab9e09bf67.avif', '', '1 ltr', 20.00),
(82, 56, 'Bisleri Packaged Water', '', 70.00, 'cfeaa68b-2ce1-4c1e-95c5-450bbb9bb281.avif', '', '5 ltr', 70.00),
(84, 56, 'Bisleri Packaged Water - Pack of 48', '', 252.90, '0c29147f-de20-4a9c-ba72-f8a95766db34.avif', '10%', '1 pack (48 x 250 ml)', 281.00),
(85, 56, 'Kinley Packaged Water', '', 20.00, 'b013208c-1a44-4d34-b289-ad26e58382fb.avif', '', '1 ltr', 20.00),
(102, 56, 'Booster Alkaline Water - Pack of 4', '', 312.00, '77aea43c-36cb-4476-a241-3450903b2c98.avif', '', '4 x 500 ml', 312.00),
(101, 56, 'Ocean Crispy Apple Flavoured ', '', 62.00, 'b61aeb15-0906-4e7f-a503-bb298f8278a4.avif', '', '500 ml', 62.00),
(100, 56, 'OceanFruit Flavoured Water', '', 62.00, '2eb460c7-e102-470d-8a58-e68e5bc627f5.avif', '', '500 ml', 62.00),
(105, 57, 'Ambrane USB A to Type C Cable', '', 121.22, '887406b9-cff2-4adb-b44f-5c4b9677cfd9.avif', '62%off', '1 Unit ', 319.00),
(106, 25, 'Real Fruit mango drink', '', 103.00, 'a1b7dd56-42e5-4109-9dae-845fb2999907.avif', '', '1 ltr ', 103.00),
(107, 25, 'paper boat Swing Mango Drink - Pack of 2', '', 60.00, '548b633b-b542-49a7-8acd-68369af52909.avif', '', '2 * 600 ml', 60.00),
(104, 23, 'Mirinda ', '', 55.00, 'mirinda-orange-2-25-l-product-images-o490004177-p490004177-0-202412230830.webp', '', '500 ml', 55.00),
(108, 25, 'paper boat Aam Panna Mango Drink', '', 38.00, '670adb86-6322-47fc-915a-3106e0a2202d.avif', '', '200 ml', 38.00),
(109, 25, 'Raw Pressery Alphonso Mango Drink', '', 58.00, 'bd5c1be3-88db-4f84-a80c-db20d5cceaf2.avif', '', '200 ml', 58.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payment_status` enum('Paid','Failed') DEFAULT 'Failed',
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','Processing','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `email`, `product_name`, `quantity`, `total_price`, `payment_id`, `payment_status`, `order_date`, `status`) VALUES
(20, 6, 'Adarsh Prajapati', 'Amli Silvassa ', 'code.adarsh121@gmail.com', '7 UP Nimbooz juice', 1, 45.00, 'pay_QDg64qhvQ0L89H', '', '2025-04-01 05:28:55', 'Pending'),
(21, 6, 'Adarsh Prajapati', 'Amli Silvassa ', 'code.adarsh121@gmail.com', 'Aquafina Packaged Water', 1, 45.00, 'pay_QDg64qhvQ0L89H', '', '2025-04-01 05:28:55', 'Pending'),
(31, 3, 'Adarsh Prajapati', 'Rofel college ', 'adofficial121@gmail.com', 'Uncle Chips Spicy ', 1, 595.50, 'pay_QEBB7hS7rzH4VQ', '', '2025-04-02 11:53:10', 'Pending'),
(32, 3, 'Adarsh Prajapati', 'Rofel college ', 'adofficial121@gmail.com', 'Lays Wafer', 1, 595.50, 'pay_QEBB7hS7rzH4VQ', '', '2025-04-02 11:53:10', 'Pending'),
(25, 6, 'Adarsh Prajapati ', 'Amali Silvassa ', 'code.adarsh121@gmail.com', 'Raw Pressery Alphonso Mango Drink', 1, 242.40, 'pay_QE2RytkMFtmnlQ', '', '2025-04-02 03:20:53', 'Pending'),
(26, 6, 'Adarsh Prajapati ', 'Amali Silvassa ', 'code.adarsh121@gmail.com', 'Sindhura mango ', 1, 242.40, 'pay_QE2RytkMFtmnlQ', '', '2025-04-02 03:20:53', 'Pending'),
(27, 6, 'Adarsh Prajapati ', 'Amali Silvassa ', 'code.adarsh121@gmail.com', 'Amul Gold Full Cream Milk ', 1, 242.40, 'pay_QE2RytkMFtmnlQ', '', '2025-04-02 03:20:53', 'Pending'),
(33, 3, 'Adarsh Prajapati', 'Rofel college ', 'adofficial121@gmail.com', 'Real Fruit mango drink', 1, 595.50, 'pay_QEBB7hS7rzH4VQ', '', '2025-04-02 11:53:10', 'Pending'),
(34, 3, 'Adarsh Prajapati', 'Rofel college ', 'adofficial121@gmail.com', 'Yojaana Poultry ', 1, 595.50, 'pay_QEBB7hS7rzH4VQ', '', '2025-04-02 11:53:10', 'Pending'),
(35, 3, 'Adarsh Prajapati', 'Rofel college ', 'adofficial121@gmail.com', 'Frooti Mango Drink ', 1, 595.50, 'pay_QEBB7hS7rzH4VQ', '', '2025-04-02 11:53:10', 'Pending'),
(37, 3, 'Adarsh Prajapati', 'Rofel college ', 'adofficial121@gmail.com', 'paper boat Swing Mango Drink - Pack of 2', 1, 595.50, 'pay_QEBB7hS7rzH4VQ', '', '2025-04-02 11:53:10', 'Pending'),
(38, 3, 'Adarsh Prajapati', 'Rofel college ', 'adofficial121@gmail.com', 'paper boat Aam Panna Mango Drink', 1, 595.50, 'pay_QEBB7hS7rzH4VQ', '', '2025-04-02 11:53:10', 'Pending'),
(39, 3, 'Adarsh Prajapati', 'Rofel college ', 'adofficial121@gmail.com', 'Raw Pressery Alphonso Mango Drink', 1, 595.50, 'pay_QEBB7hS7rzH4VQ', '', '2025-04-02 11:53:10', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `otp_verification`
--

DROP TABLE IF EXISTS `otp_verification`;
CREATE TABLE IF NOT EXISTS `otp_verification` (
  `otp_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `otp` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`otp_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `otp_verification`
--

INSERT INTO `otp_verification` (`otp_id`, `user_id`, `otp`, `created_at`) VALUES
(26, 3, 246015, '2025-03-17 07:21:06'),
(25, 3, 177121, '2025-03-17 07:21:01'),
(24, 3, 577996, '2025-03-17 07:09:21'),
(27, 3, 125332, '2025-03-31 05:58:12'),
(28, 5, 779453, '2025-03-31 06:01:11'),
(29, 6, 731862, '2025-03-31 10:49:43'),
(30, 5, 114898, '2025-03-31 10:50:13'),
(31, 5, 646316, '2025-03-31 10:50:17'),
(32, 5, 486095, '2025-03-31 10:50:22'),
(33, 3, 173318, '2025-04-01 02:19:42'),
(34, 3, 592550, '2025-04-01 03:30:01'),
(35, 6, 426633, '2025-04-01 05:26:55'),
(36, 3, 917171, '2025-04-01 06:20:00'),
(37, 6, 557063, '2025-04-01 08:34:17'),
(38, 3, 269691, '2025-04-01 09:18:32'),
(39, 3, 755069, '2025-04-01 09:19:11'),
(40, 6, 466122, '2025-04-02 02:51:40'),
(41, 6, 664344, '2025-04-02 03:18:02'),
(42, 3, 269998, '2025-04-02 03:22:15'),
(43, 6, 588907, '2025-04-02 05:17:47'),
(44, 3, 802515, '2025-04-02 06:00:13'),
(45, 3, 648249, '2025-04-02 06:02:34'),
(46, 6, 332984, '2025-04-02 06:05:04'),
(47, 6, 369052, '2025-04-02 06:05:27'),
(48, 6, 706807, '2025-04-02 06:07:44'),
(49, 3, 636927, '2025-04-02 06:21:08'),
(50, 3, 420599, '2025-04-02 06:53:25'),
(51, 3, 763067, '2025-04-02 06:53:34'),
(52, 3, 868066, '2025-04-02 06:53:40'),
(53, 3, 934510, '2025-04-02 08:22:14'),
(54, 3, 833526, '2025-04-02 08:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `parent_categories`
--

DROP TABLE IF EXISTS `parent_categories`;
CREATE TABLE IF NOT EXISTS `parent_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `parent_categories`
--

INSERT INTO `parent_categories` (`id`, `name`, `image`) VALUES
(17, 'Cold Drinks & Juices', 'Cold Drink & Juices.avif'),
(16, 'Fruits & Vegetables', 'Fruits & Vegetables.avif'),
(15, 'Dairy , Bread &  Eggs', 'Dairy, Bread & Eggs.avif'),
(18, 'Snacks & Munchies', 'Snacks & Munchies.avif'),
(19, 'Breakfast & Insstant Food', 'Breakfast & Insstant Food.avif'),
(20, 'Sweet Tooth', 'Sweet Tooth.avif'),
(21, 'Baby Care', 'Baby Care.avif'),
(22, 'Pharma & Wellness', 'Pharma & Wellness.avif'),
(23, 'Chicken , Meat & Fish ', 'Chicken, Meat & Fish.avif'),
(24, 'Cleaning Essentials', 'Cleaning Essentials.avif');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `shop` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('pending','approved','denied') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `firstname`, `shop`, `email`, `mobile`, `address`, `image`, `password`, `status`, `created_at`) VALUES
(6, 'Akash', 'food market', 'ap9157@gmail.com', '09157960138', 'K.C Powertracks company Dokmardi Silvassa', 'upload/logo2.png', '$2y$10$1hC/zMS9FkyJvBkjFag5ker0MuB0NybSQEbNIDBg34yURhW0gBSWC', 'pending', '2025-03-17 06:47:01'),
(7, 'Adarsh Prajapati', 'ABCD SHOP', 'code.adarsh121@gmail.com', '9428070438', 'Amli Silvassa ', 'upload/ad3.jpg', '$2y$10$SuA3HOrQYXbmpwqxNXMAveClkgP5/sFQNvYf59cNf0PR..UFEaIBW', 'approved', '2025-04-01 05:14:32'),
(8, 'sarvesh jore ', 'JORE  PADPAD  HOUES ', 'sarveshjore@gmail.com', '9724866396', 'silvassa', '', '$2y$10$qSE85BeVIKnksBBctAz4h.krdjmdGsqgznmafrOi8IJC/2a5qgL2y', 'approved', '2025-04-01 09:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  `status` enum('inactive','active') NOT NULL DEFAULT 'inactive',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `mobile`, `address`, `image`, `created_at`, `password`, `status`) VALUES
(5, 'Adarsh Prajapati ', '', 'ad.crypto121@gmail.com', '', 'ad.crypto121@gmial.com', '', '2025-03-31 06:01:11', '', 'inactive'),
(6, 'Adarsh Prajapati', '', 'code.adarsh121@gmail.com', '', 'Amli Silvassa ', '', '2025-03-31 10:49:42', '', 'inactive');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
