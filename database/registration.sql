-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3304
-- Generation Time: Jan 11, 2025 at 11:50 PM
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
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(1, 'Network', 'net200');

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `affiliate_id` int(11) NOT NULL,
  `affiliate_username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('affiliate','vendor') NOT NULL,
  `registered_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` enum('mobile_money','bank_transfer') NOT NULL,
  `bank_country` varchar(50) NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `country_of_residence` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `total_earnings` decimal(10,2) DEFAULT 0.00,
  `next_payout` date DEFAULT NULL,
  `incoming_payout` decimal(10,2) DEFAULT 0.00,
  `account_status` enum('active','deactivate','banned') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `affiliates`
--

INSERT INTO `affiliates` (`affiliate_id`, `affiliate_username`, `email`, `password`, `role`, `registered_date`, `payment_method`, `bank_country`, `bank_name`, `country_of_residence`, `phone_number`, `account_number`, `account_name`, `first_name`, `last_name`, `total_earnings`, `next_payout`, `incoming_payout`, `account_status`) VALUES
(1, 'Elizabeth', 'elizabeth@gmail.com', '1899158a7a4115ca234a9f029c3e1012', 'affiliate', '2024-08-27 12:16:16', 'bank_transfer', 'USA', 'Bank of America', 'libya', '0591273635', '243222225554', 'elizabeth nasara', 'elizabeth ', 'nasara', 200.00, NULL, 0.00, 'banned'),
(2, 'emmanuel', 'motey@gmail.com', '81430d84d95a00b65f3285fd0f845a72', 'vendor', '2024-08-23 16:45:56', 'mobile_money', '', NULL, 'Ghana', '0543973755', '', '', 'EMMANUEL', 'KYERE', 0.00, NULL, 0.00, 'deactivate'),
(3, 'kofi', 'hoji@gmail.com', 'aaf139000100659a24d4f5e7f6a8e762', 'affiliate', '2024-08-23 18:54:06', 'mobile_money', '', NULL, NULL, '', '', '', '', '', 0.00, NULL, 0.00, 'banned'),
(6, 'philip', 'philip12@gmail.com', '83aecf55b60ca89a04ef3db4ccb47aba', 'affiliate', '2024-08-25 11:53:21', 'mobile_money', '', NULL, NULL, '', '', '', '', '', 0.00, NULL, 0.00, 'banned'),
(8, 'love', 'love@gmail.com', 'love123', '', '0000-00-00 00:00:00', 'mobile_money', '', NULL, NULL, '', '', '', '', '', 0.00, NULL, 0.00, 'deactivate'),
(9, 'Fredrick', 'fredrick@gmail.com', '5b0002507a11c2d415723bd98707a22c', 'affiliate', '2024-08-30 09:16:54', 'mobile_money', '', NULL, NULL, '', '', '', '', '', 0.00, NULL, 0.00, 'deactivate'),
(10, 'abena', 'kyereemmamuel046@gmail.com', '1c3fed1f4f87c2f501a75f1f8eb927ba', 'affiliate', '2024-08-30 19:02:29', 'bank_transfer', 'Ghana', '', 'NIGERIA', '0543973755', '243222225554', 'fredico chiesa', ' Abena', 'laare', 60.00, '0000-00-00', 0.00, 'deactivate'),
(11, 'foo', 'foo@gmail.com', 'aee02a7df571b38b91023243e8f669b4', 'affiliate', '2024-08-30 19:10:02', 'mobile_money', '', NULL, 'tunisai', '1234567810', '', '', 'kyere', 'emmanuel', 0.00, NULL, 0.00, 'deactivate'),
(12, 'shona', 'shona@gmail.com', '179c997b09c6f19fbc8d1765618b164e', 'affiliate', '2024-08-31 17:59:15', 'mobile_money', '', NULL, NULL, '', '', '', '', '', 0.00, NULL, 0.00, 'deactivate'),
(13, 'Godfred', 'godfred@gmail.com', 'b7953dd75967981ec596c44600d86be6', 'affiliate', '2024-09-01 12:09:33', 'bank_transfer', 'Germany', 'Deutsche Bank', 'NIGERI', '788687678', '12232443535454', 'fredrick', 'GOFERED', 'YAKUBU', 0.00, NULL, 0.00, 'banned'),
(14, 'nana', 'nana@gmail.com', 'e00092f6aa29e5fdd00cbe1a16379d71', 'affiliate', '2024-09-08 15:39:54', 'mobile_money', '', NULL, NULL, '', '', '', '', '', 0.00, NULL, 0.00, 'active'),
(15, 'yawvybzs', 'yawwvbzs@gmail.com', '40a413992a4f0dc2853e1ffdec7c6c7c', 'affiliate', '2024-11-23 16:51:31', 'mobile_money', '', NULL, 'NIGERIA', '0591273635', '', '', 'yaw ', 'kusi', 0.00, NULL, 0.00, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_payouts`
--

CREATE TABLE `affiliate_payouts` (
  `payout_id` int(11) NOT NULL,
  `affiliate_username` varchar(255) NOT NULL,
  `payout_amount` decimal(10,2) NOT NULL,
  `payout_date` date NOT NULL,
  `payout_status` enum('pending','completed','failed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `affiliate_payouts`
--

INSERT INTO `affiliate_payouts` (`payout_id`, `affiliate_username`, `payout_amount`, `payout_date`, `payout_status`) VALUES
(1, 'abena', 4.70, '0000-00-00', ''),
(2, 'abena', 4.70, '0000-00-00', 'completed'),
(3, 'abena', 4.70, '0000-00-00', ''),
(4, 'abena', 4.70, '0000-00-00', 'completed'),
(5, 'abena', 4.70, '0000-00-00', 'completed'),
(7, 'abena', 4.70, '2024-09-05', 'completed'),
(8, 'abena', 0.00, '2024-09-05', ''),
(9, 'abena', 0.00, '2024-09-06', ''),
(10, 'abena', 0.00, '2024-09-06', 'completed'),
(11, 'abena', 0.00, '2024-09-06', 'completed'),
(12, 'abena', 0.00, '2024-09-06', 'completed'),
(13, 'abena', 0.00, '2024-09-06', 'completed'),
(14, 'abena', 0.00, '2024-09-06', ''),
(15, 'abena', 100.00, '2024-09-06', ''),
(16, 'Elizabeth', 200.00, '2024-09-06', 'completed'),
(17, 'foo', 0.00, '2024-09-07', 'completed'),
(18, 'foo', 0.00, '2024-09-08', 'completed'),
(19, 'shona', 0.00, '2024-09-08', 'completed'),
(20, 'shona', 0.00, '2024-09-08', 'completed'),
(21, 'shona', 0.00, '2024-09-08', 'completed'),
(22, 'nana', 0.00, '2024-09-09', 'completed'),
(23, 'yawvybzs', 0.00, '2024-11-23', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `contests`
--

CREATE TABLE `contests` (
  `contest_id` int(11) NOT NULL,
  `contest_name` varchar(255) NOT NULL,
  `contest_description` text NOT NULL,
  `status` enum('active','ended') DEFAULT 'active',
  `contest_url` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `vendor_username` varchar(255) NOT NULL,
  `prize_details` text NOT NULL,
  `criteria` enum('most_sales','highest_revenue') NOT NULL,
  `flyer` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contests`
--

INSERT INTO `contests` (`contest_id`, `contest_name`, `contest_description`, `status`, `contest_url`, `start_date`, `end_date`, `product_id`, `vendor_username`, `prize_details`, `criteria`, `flyer`, `created_at`, `updated_at`) VALUES
(1, 'anb', 'n v v mn vm nv vvn', 'active', NULL, '2024-09-05', '2022-08-09', 15, 'tei3', 'car', '', '(18).jpg', '2024-09-04 19:02:59', '2024-09-04 19:02:59'),
(2, 'aff', 'ndcjdchjcd', 'active', NULL, '2024-09-02', '2024-09-13', 32, 'tei3', 'motto', '', '(18).jpg', '2024-09-04 19:06:53', '2024-09-04 19:06:53'),
(3, 'money online', 'make mnore money', 'active', NULL, '2024-09-20', '2024-09-26', 34, 'tei3', '6 billions', '', '(42).jpg', '2024-09-05 08:11:06', '2024-09-05 08:11:06'),
(4, 'money online', ' , m m m', 'active', NULL, '2024-09-19', '2024-09-27', 32, 'tei3', 'nipa', '', '', '2024-09-05 08:13:13', '2024-09-05 08:13:13'),
(5, 'money online', 'v v v v v', 'active', NULL, '2024-09-27', '2024-09-10', 15, 'tei3', 'mn n mn', '', '', '2024-09-05 08:18:30', '2024-09-05 08:18:30'),
(6, 'money online', 'nmbnbmnmnm', 'active', NULL, '2024-09-14', '2024-09-26', 32, 'tei3', 'make money', '', '(42).jpg', '2024-09-05 08:35:17', '2024-09-05 08:35:17'),
(7, 'eded', 'efeeece', 'active', NULL, '2024-09-19', '2024-09-18', 15, 'tei3', 'ekekff', '', '', '2024-09-05 08:42:34', '2024-09-05 08:42:34'),
(8, 'amp', 'fbfbfbfb', 'active', NULL, '2024-09-04', '2024-09-13', 45, 'deborah', 'cvdvdvd', '', '(6).jpg', '2024-09-08 20:47:05', '2024-09-08 20:47:05'),
(13, 'money online', 'dvvkjfv ', 'active', NULL, '2024-09-04', '2024-09-19', 45, 'deborah', 'n fvf', '', '', '2024-09-09 02:01:08', '2024-09-09 02:01:08'),
(17, 'money online', 'cvddvdvd', 'active', NULL, '2024-09-12', '2024-09-19', 45, 'deborah', 'gbgbfbffbf', '', '', '2024-09-09 13:23:11', '2024-09-09 13:23:11'),
(18, 'money online', 'mnjhbjh', 'active', 'https://network.com', '2024-09-19', '2024-09-12', 45, 'deborah', 'enr cr', '', '', '2024-09-09 13:53:14', '2024-09-09 13:53:14'),
(19, 'cvjnvknj', 'vfvfvfvf', 'active', 'https://network.com', '2024-09-05', '2024-09-05', 45, 'deborah', 'vfgklvglb', 'most_sales', '', '2024-09-09 15:44:07', '2024-09-09 15:44:07'),
(20, 'money online', 'hbghvvvvvvvjjhhbg', 'active', 'https://network.com', '2024-09-18', '2024-09-11', 45, 'deborah', 'nhgvgfcgjvcgvfg', 'most_sales', '(1).jpg', '2024-09-09 19:54:25', '2024-09-09 19:54:25'),
(21, 'money online', 'bgkjhgkghvjghvghggggggghb', 'active', 'https://network.com', '2024-09-11', '2024-09-11', 44, 'abena', 'gvhvhhgvjhvfgj', 'most_sales', '(2).jpg', '2024-09-09 21:24:04', '2024-09-09 21:24:04'),
(22, 'BAMM', 'software development', 'active', 'https://network.com', '2024-12-05', '2025-01-23', 46, 'abena', 'car', '', 'girl.jpg', '2024-12-08 00:47:52', '2024-12-08 00:47:52'),
(23, 'FAM', 'ko nu', 'active', 'https://network.com', '2024-12-25', '2024-11-28', 44, 'abena', 'jsjjs', '', 'tran.jpg', '2024-12-08 01:03:57', '2024-12-08 01:03:57'),
(24, 'money online', ' jkjj', 'active', 'https://network.com', '2024-12-05', '2024-12-18', 44, 'abena', ' kjnkjnkj', '', 'web2.webp', '2024-12-08 01:15:50', '2024-12-08 01:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `contest_affiliates`
--

CREATE TABLE `contest_affiliates` (
  `contest_affiliate_id` int(11) NOT NULL,
  `contest_id` int(11) DEFAULT NULL,
  `affiliate_username` varchar(255) DEFAULT NULL,
  `join_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contest_products`
--

CREATE TABLE `contest_products` (
  `contest_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` text NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `commission` decimal(5,2) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `sale_page_url` varchar(255) NOT NULL,
  `resources_page_url` varchar(255) DEFAULT NULL,
  `thank_you_page_url` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `vendor_id` int(11) DEFAULT NULL,
  `vendor_username` varchar(255) DEFAULT NULL,
  `is_in_contest` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_image`, `product_name`, `product_description`, `product_category`, `product_type`, `price`, `commission`, `currency`, `sale_page_url`, `resources_page_url`, `thank_you_page_url`, `status`, `vendor_id`, `vendor_username`, `is_in_contest`) VALUES
(15, 'uploads/(1).jpg', 'phone for all', 'phnone for all', 'tech', 'services', 20.00, 20.00, 'USD', 'https://networkghblog.com', 'https://classyou.com', 'https://networkghblog.com', 'rejected', NULL, 'tei3', 0),
(24, 'uploads/(33).jpg', 'affiliate marketting', 'cxdsbxfdxgc', 'tech', 'digital', 2.00, 10.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'tei3', 0),
(25, 'uploads/(33).jpg', 'affiliate marketting', 'cxdsbxfdxgc', 'tech', 'digital', 2.00, 10.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'tei3', 0),
(26, 'uploads/(4).jpg', 'sales fuunel', 'make more money on the go', 'tech', 'digital', 100.00, 50.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'maabena', 0),
(30, 'uploads/(4).jpg', 'CARTOON CREATION AND ANIMATION', 'njvghgvnhg jhv', 'tech', 'physical', 78.00, 78.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'maabena', 0),
(31, 'uploads/(33).jpg', 'affiliate marketting', 'cxdsbxfdxgc', 'tech', 'digital', 2.00, 10.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'rejected', NULL, 'maabena', 0),
(32, 'uploads/(2).jpg', 'how to curve masterbation', 'stop masterbating your future is bright', 'tech', 'digital', 40.00, 67.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'tei3', 0),
(33, 'uploads/1629991.jpg', 'love', ' c cvdvdv', 'tech', 'services', 40.00, 30.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'tei3', 0),
(34, 'uploads/1629991.jpg', 'love', ' c cvdvdv', 'tech', 'services', 40.00, 30.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'rejected', NULL, 'tei3', 0),
(35, 'uploads/(2).jpg', 'affiliate marketting copy and paste', '', 'affiliatemarketing', 'digital', 12.00, 65.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'rejected', NULL, 'Doris', 0),
(36, 'uploads/1629991.jpg', 'love', ' c cvdvdv', 'tech', 'services', 40.00, 30.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'rejected', NULL, 'Doris', 0),
(37, 'uploads/1629991.jpg', 'love', ' c cvdvdv', 'tech', 'services', 40.00, 30.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'Doris', 0),
(38, 'uploads/(4).jpg', 'youtube masterclass', 'make money online by emma', 'internetmarketing', 'digital', 70.00, 60.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'rejected', NULL, 'Doris', 0),
(39, 'uploads/(4).jpg', 'youtube masterclass', 'make money online by emma', 'internetmarketing', 'digital', 70.00, 60.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'rejected', NULL, 'Doris', 0),
(40, 'uploads/(4).jpg', 'youtube masterclass', 'make money online by emma', 'internetmarketing', 'digital', 70.00, 60.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'Doris', 0),
(41, 'uploads/(42).jpg', 'java masterclass', 'learn java the right way', 'training', 'digital', 60.00, 40.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'NeworkGh', 0),
(42, 'uploads/(4).jpg', 'cyber security course', 'learn cyber security', 'tech', 'physical', 40.00, 60.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'deactivated', NULL, 'Edina001', 0),
(43, 'uploads/(4).jpg', 'cyber security course', 'learn cyber security', 'tech', 'physical', 40.00, 60.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'deactivated', NULL, 'Edina001', 0),
(44, 'uploads/(42).jpg', 'computer networking', 'learn networking the right way', 'affiliatemarketing', 'digital', 90.00, 70.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'pending', NULL, 'abena', 0),
(45, 'uploads/(2).jpg', 'computer networking engineering', 'fbfvfbfbfbfbd', 'tech', 'services', 30.00, 20.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'deborah', 0),
(46, 'uploads/2018_aprilia_rsv4_factory_works_fw_gp_4k-3840x2160.jpg', 'NETWORKING COURSE', 'Learn networking from beginner to advance', 'tech', 'services', 17.00, 40.00, 'USD', 'https://networkghblog.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'abena', 0),
(47, 'uploads/(178).jpg', 'web development', 'cjkndjvhbvfj', 'digital', 'digital', 60.00, 60.00, 'USD', 'https://classyou.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'abena', 0),
(48, 'uploads/(178).jpg', 'web development', 'cjkndjvhbvfj', 'digital', 'digital', 60.00, 60.00, 'USD', 'https://classyou.com', 'https://networkghblog.com', 'https://networkghblog.com', 'approved', NULL, 'abena', 0),
(49, 'uploads/(178).jpg', 'web development', 'cjkndjvhbvfj', 'digital', 'digital', 60.00, 60.00, 'USD', 'https://classyou.com', 'https://networkghblog.com', 'https://networkghblog.com', 'pending', NULL, 'abena', 0),
(50, 'uploads/(178).jpg', 'web development', 'cjkndjvhbvfj', 'digital', 'digital', 60.00, 60.00, 'USD', 'https://classyou.com', 'https://networkghblog.com', 'https://networkghblog.com', 'pending', NULL, 'abena', 0),
(51, 'uploads/(349).jpg', 'akwaaba', 'moedjwnj', 'tech', 'digital', 50.00, 50.00, 'USD', 'https://networkghblog.com', 'https://classyou.com', 'https://networkghblog.com', 'pending', NULL, 'abena', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `affiliate_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `sale_date` datetime DEFAULT current_timestamp(),
  `sale_amount` decimal(10,2) DEFAULT NULL,
  `commission_earned` decimal(10,2) DEFAULT NULL,
  `affiliate_earnings` decimal(10,2) DEFAULT NULL,
  `vendor_earnings` decimal(10,2) DEFAULT NULL,
  `affiliate_username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `product_id`, `affiliate_id`, `vendor_id`, `sale_date`, `sale_amount`, `commission_earned`, `affiliate_earnings`, `vendor_earnings`, `affiliate_username`) VALUES
(10, 15, 10, 17, '2024-09-05 00:00:00', 150.00, 30.00, 25.00, 120.00, 'abena');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `country` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `vendor_username` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `bank_country` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `country_of_residence` varchar(255) NOT NULL,
  `account_status` enum('active','deactivate','banned') DEFAULT 'active',
  `incoming_payout` decimal(10,2) DEFAULT 0.00,
  `total_earnings` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `firstname`, `lastname`, `email`, `country`, `password`, `phone_number`, `bank_name`, `account_number`, `created_at`, `vendor_username`, `payment_method`, `bank_country`, `account_name`, `country_of_residence`, `account_status`, `incoming_payout`, `total_earnings`) VALUES
(1, 'xnnmndc dnc', 'nyankey', 'kyere@gmail.com', '', '$2y$10$o11CV.Cwy0l3Hf5CZ5JdZeBZvJfgZugRkeC3u/rM.eWO9/ztKmcWW', NULL, NULL, NULL, '2024-08-25 08:19:41', NULL, '', '', '', '', 'deactivate', 0.00, 0.00),
(2, 'xnnmndc dnc', 'nyankey', 'kwame@gmail.com', '', '$2y$10$wQOxublxhNyZsUv9cXQoAO39ePhrOJBRJ4Gfj4MKAH0gTKv6A2hA2', NULL, NULL, NULL, '2024-08-25 08:40:26', NULL, '', '', '', '', 'active', 0.00, 0.00),
(3, 'emmanuel', 'nyankey', 'emmanuel@gmail.com', '', '$2y$10$JuV2qWDVWZdQvP7q6n7MuOuRuEppWLsj1EwIEtRjji4FKYKCwFk5e', NULL, NULL, NULL, '2024-08-25 08:49:34', NULL, '', '', '', '', 'active', 0.00, 0.00),
(4, 'xnnmndc dnc', 'nyankey', 'Edina@gmail.com', '', '$2y$10$heJNCNSCwW5HhS2SGKsOc.Ou6M5dfHTXiObS.0Wk5waG4Ary7OMDK', NULL, NULL, NULL, '2024-08-25 09:00:53', NULL, '', '', '', '', 'active', 0.00, 0.00),
(5, 'xnnmndc dnc', 'nyankey', 'kyerew@gmail.com', '', '$2y$10$bos0aY0k9bgZKIpQA.NgMur0h5e1WYHnLfFgXc/e9Mh3MOQ3Czm6S', NULL, NULL, NULL, '2024-08-25 09:35:19', NULL, '', '', '', '', 'active', 0.00, 0.00),
(6, 'emmanuel', 'nyankey', 'kye444re@gmail.com', '', '$2y$10$F/i1nAxBCwL04esVeemDNulY9rDInlzVtXN89.DMbPwwmCAGqQVSq', NULL, NULL, NULL, '2024-08-25 10:05:37', NULL, '', '', '', '', 'active', 0.00, 0.00),
(7, 'emmanuel', 'nyankey', 'kye444rre@gmail.com', '', '$2y$10$lGIVNr4pQZKobeyTE0jchOJZPhcfkPk8z9AwwHtDY4kvwo3R15QaK', NULL, NULL, NULL, '2024-08-25 10:08:45', NULL, '', '', '', '', 'active', 0.00, 0.00),
(8, 'Emmanuel', 'Kyere', 'kyereemmanuel046@gmail.com', '', '$2y$10$w0tdgn0udcUyf9n.5/UJPufRTfW5i.vJ6KC2KkLcm9jy43qaT0nHm', NULL, NULL, NULL, '2024-08-25 10:10:32', NULL, '', '', '', '', 'active', 0.00, 0.00),
(9, 'dapaah', 'philip', 'philip@gmail.com', '', '$2y$10$KLP6.G3ZSLdVPhIUYz7Rt.2HUJdgknak6fCjghP.JAn6h8NlUTx62', NULL, NULL, NULL, '2024-08-25 10:52:54', NULL, '', '', '', '', 'active', 0.00, 0.00),
(10, 'emmanuel', 'nyankey', 'love@gmail.com', '', '$2y$10$J2F0kvy.RB7fdGdqDAqdke0BfR45bvot/yy6Qt/wOJiviMf042EEu', NULL, NULL, NULL, '2024-08-27 12:18:56', NULL, '', '', '', '', 'active', 0.00, 0.00),
(11, 'kwame', 'frimpong', 'frimpong@gmail.com', '', '$2y$10$RBXREVL3tWPQVnEhxN7IIO.h/kFuesxIZGFb1mDdojSvuNP6E3G/6', NULL, NULL, NULL, '2024-08-29 16:13:59', NULL, '', '', '', '', 'active', 0.00, 0.00),
(12, 'yaw', 'koo', 'koo@gmail.com', '', '$2y$10$LQlg.q4PayztZ6nVlqRsEOE7j8YxLnBlFjL.ZzFkoDNkLa3SWnz.e', NULL, NULL, NULL, '2024-08-29 16:27:56', NULL, '', '', '', '', 'active', 0.00, 0.00),
(13, 'fei', 'ko', 'fei@gmail.com', '', '$2y$10$m0UYRFdptl7mUmuwxa7RlOvGwlMPgbfOzM5gOZgcbx.2O7Is7ZVS.', NULL, NULL, NULL, '2024-08-29 16:29:54', NULL, '', '', '', '', 'active', 0.00, 0.00),
(14, 'emmanuel', 'frim00', 'tei@gmail.com', '', '$2y$10$RTiFYZbVYYN5vy8kuJIi2ePGufXmNJFmftL35hI5V8jRaLRKpC/ri', NULL, NULL, NULL, '2024-08-30 10:19:38', 'tei', '', '', '', '', 'active', 0.00, 0.00),
(15, 'fred', 'ddd', 'kyereemmamuel046@gmail.com', '', '$2y$10$FQ8mtPw3CTF601Zd5oXCoOg7b1h2F6RypCNkTDpCLTPJh4RIJfJxG', NULL, NULL, NULL, '2024-08-30 10:29:48', 'teit', '', '', '', '', 'active', 0.00, 0.00),
(17, '', '', 'kyereemmammuel046@gmail.com', '', '$2y$10$AGH//OGNDJOXpLKt8gssreWQpdMNItbaYoaEX2VOumn/qbCUTmpuC', '0543973755', 'Bank of America', '12232443535454', '2024-08-30 11:32:13', 'tei3', 'mobile_money', 'USA', 'fredico yaw', 'NIGERIA', 'active', 0.00, 0.00),
(18, 'ohene', 'junoir', 'ju@gmail.com', '', '$2y$10$V3gsZdgr6/qun8RclneT1eLUAZbZBH4/VDIbhlGWpsyMgYGWFhg1u', NULL, NULL, NULL, '2024-08-30 12:03:50', 'junior', '', '', '', '', 'active', 0.00, 0.00),
(19, '', '', '', '', '', NULL, NULL, NULL, '2024-08-30 14:49:37', 'missing_vendor_username', '', '', '', '', 'active', 0.00, 0.00),
(20, 'laare', 'felicia', 'motey@gmail.com', '', '$2y$10$0/oa8FyBsESuVs9PO4qereR1ClIlLEzsmwLAZLgzKXj2Yi0oeJ9I2', NULL, NULL, NULL, '2024-08-30 15:41:54', 'maabena', '', '', '', '', 'active', 0.00, 0.00),
(21, 'emmanuel', 'nyankey', 'abena@gmail.com', '', '$2y$10$EGJwy1Brv8WkaxHpqRhTE.9lj.hKe8usEduCKOMUjBn44jiM2nSAe', NULL, NULL, NULL, '2024-08-30 18:21:18', 'abena', '', '', '', '', 'active', 0.00, 0.00),
(22, 'doris', 'kyere', 'doris@gmail.com', '', '$2y$10$wa41HXpjiX6fZiirzogIaeLGPNPChr/g1CwCHiHDow9756OskbLoi', NULL, NULL, NULL, '2024-08-30 22:06:39', 'Doris', '', '', '', '', 'active', 0.00, 0.00),
(23, ' emmanuel', 'kyere', 'net@gmail.com', '', '$2y$10$ss/jdiza/zU.NU.ozJ75/eO6gtnwBkNd/WZonG1yGXU.Vuaql7NhW', NULL, NULL, NULL, '2024-08-31 08:22:26', 'NeworkGh', '', '', '', '', 'active', 0.00, 0.00),
(24, 'dapila', 'edina', 'edina2@gmail.com', '', '$2y$10$Y92WJgSW.Go5TCIepkx5geVvjlnbuE27m5P06/Nr/VXUkgZePf2kO', '0543973755', NULL, NULL, '2024-09-05 11:14:08', 'Edina001', '', '', '', 'ghana', 'active', 0.00, 0.00),
(25, 'boabeng', 'deborah', 'deborah@gmail.com', '', '$2y$10$Bjr7t45aWE8sEpAYvO1laOIGS65nmVrEOnKkk8hy6AZByWFOjsDMG', NULL, NULL, NULL, '2024-09-08 15:42:36', 'deborah', '', '', '', '', 'active', 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_payouts`
--

CREATE TABLE `vendor_payouts` (
  `payout_id` int(11) NOT NULL,
  `vendor_username` varchar(255) NOT NULL,
  `payout_amount` decimal(10,2) NOT NULL,
  `payout_date` date NOT NULL,
  `payout_status` enum('pending','completed','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_payouts`
--

INSERT INTO `vendor_payouts` (`payout_id`, `vendor_username`, `payout_amount`, `payout_date`, `payout_status`) VALUES
(1, 'deborah', 0.00, '2024-09-09', 'pending'),
(2, 'deborah', 0.00, '2024-09-09', 'pending'),
(3, 'deborah', 0.00, '2024-09-09', 'pending'),
(4, 'deborah', 0.00, '2024-09-09', 'pending'),
(5, 'deborah', 0.00, '2024-09-09', 'pending'),
(6, 'abena', 0.00, '2024-11-27', 'pending'),
(7, 'abena', 0.00, '2024-12-07', 'pending'),
(8, 'Edina001', 0.00, '2025-01-11', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`affiliate_id`),
  ADD UNIQUE KEY `username` (`affiliate_username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username_2` (`affiliate_username`);

--
-- Indexes for table `affiliate_payouts`
--
ALTER TABLE `affiliate_payouts`
  ADD PRIMARY KEY (`payout_id`),
  ADD KEY `affiliate_username` (`affiliate_username`);

--
-- Indexes for table `contests`
--
ALTER TABLE `contests`
  ADD PRIMARY KEY (`contest_id`),
  ADD KEY `contests_ibfk_1` (`product_id`),
  ADD KEY `contests_ibfk_2` (`vendor_username`);

--
-- Indexes for table `contest_affiliates`
--
ALTER TABLE `contest_affiliates`
  ADD PRIMARY KEY (`contest_affiliate_id`),
  ADD KEY `contest_id` (`contest_id`),
  ADD KEY `affiliate_username` (`affiliate_username`);

--
-- Indexes for table `contest_products`
--
ALTER TABLE `contest_products`
  ADD KEY `contest_id` (`contest_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_vendor` (`vendor_id`),
  ADD KEY `fk_vendor_username` (`vendor_username`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `sales_ibfk_2` (`affiliate_id`),
  ADD KEY `fk_affiliate_username` (`affiliate_username`),
  ADD KEY `fk_product` (`product_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`vendor_username`),
  ADD UNIQUE KEY `unique_username` (`vendor_username`);

--
-- Indexes for table `vendor_payouts`
--
ALTER TABLE `vendor_payouts`
  ADD PRIMARY KEY (`payout_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `affiliate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `affiliate_payouts`
--
ALTER TABLE `affiliate_payouts`
  MODIFY `payout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contests`
--
ALTER TABLE `contests`
  MODIFY `contest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `contest_affiliates`
--
ALTER TABLE `contest_affiliates`
  MODIFY `contest_affiliate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `vendor_payouts`
--
ALTER TABLE `vendor_payouts`
  MODIFY `payout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affiliate_payouts`
--
ALTER TABLE `affiliate_payouts`
  ADD CONSTRAINT `affiliate_payouts_ibfk_1` FOREIGN KEY (`affiliate_username`) REFERENCES `affiliates` (`affiliate_username`);

--
-- Constraints for table `contests`
--
ALTER TABLE `contests`
  ADD CONSTRAINT `contests_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `contests_ibfk_2` FOREIGN KEY (`vendor_username`) REFERENCES `vendors` (`vendor_username`);

--
-- Constraints for table `contest_affiliates`
--
ALTER TABLE `contest_affiliates`
  ADD CONSTRAINT `contest_affiliates_ibfk_1` FOREIGN KEY (`contest_id`) REFERENCES `contests` (`contest_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contest_affiliates_ibfk_2` FOREIGN KEY (`affiliate_username`) REFERENCES `affiliates` (`affiliate_username`) ON DELETE CASCADE;

--
-- Constraints for table `contest_products`
--
ALTER TABLE `contest_products`
  ADD CONSTRAINT `contest_products_ibfk_1` FOREIGN KEY (`contest_id`) REFERENCES `contests` (`contest_id`),
  ADD CONSTRAINT `contest_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`),
  ADD CONSTRAINT `fk_vendor_username` FOREIGN KEY (`vendor_username`) REFERENCES `vendors` (`vendor_username`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_affiliate_username` FOREIGN KEY (`affiliate_username`) REFERENCES `affiliates` (`affiliate_username`),
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`affiliate_id`) REFERENCES `affiliates` (`affiliate_id`),
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
