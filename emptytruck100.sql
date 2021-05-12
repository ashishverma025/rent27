-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 31, 2020 at 05:24 PM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emptytruck100`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `email`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`, `email_verified_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '$2y$10$uNOtqtGucaZS1xW1sHHLlOD/oElz1V2zg4t41n/DM9JB8Xm1J37Nu', NULL, 'FrTfyfBC03e4g5ptGf8puaDP03bGFe3vg697CYRf9VhMxRmaErLDA2ttAwRv', '2019-06-20 13:00:00', '2019-06-20 22:54:10', '2019-06-17 02:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `advertise_image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `title`, `url`, `description`, `advertise_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Advertise 1', 'https://www.youtube.com/watch?v=E5ln4uR4TwQ', '<p>Advertise 1 Desc<br></p>', '2020123026blog-img2.jpg', 'Active', '2020-12-30 11:27:47', '2020-12-30 11:44:26'),
(2, 'Advertise 2', 'https://app.opensolar.com/#/studio/59122', '<p>Advertise 2&nbsp;Advertise 2 Desc<br></p>', '2020123011package5.jpg', 'Active', '2020-12-30 13:56:11', '0000-00-00 00:00:00'),
(3, 'Advertise 3', 'https://www.youtube.com/watch?v=E5ln4uR4TwQ', '<p>Advertise 3 desc<br></p>', '202012303442845.jpg', 'Active', '2020-12-30 14:11:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `user_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blog_image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `url`, `description`, `user_id`, `blog_image`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Blog 1', 'https://app.opensolar.com/#/studio/59122', '<p>Blog Description</p>', NULL, '2020123053blog-img1.jpg', 5, 'Active', '2020-12-29 08:13:30', '2020-12-30 11:03:53'),
(2, 'Blog 2', 'https://www.youtube.com/watch?v=E5ln4uR4TwQ', '<p>https://www.youtube.com/watch?v=E5ln4uR4TwQ<br></p>', NULL, '2020123043blog-img2.jpg', 4, 'Active', '2020-12-30 11:00:22', '2020-12-30 11:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `booking_percentage`
--

CREATE TABLE `booking_percentage` (
  `id` int(11) NOT NULL,
  `booking_percentage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_percentage`
--

INSERT INTO `booking_percentage` (`id`, `booking_percentage`) VALUES
(1, '25');

-- --------------------------------------------------------

--
-- Table structure for table `commision_percentages`
--

CREATE TABLE `commision_percentages` (
  `id` int(11) NOT NULL,
  `percentage` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commision_percentages`
--

INSERT INTO `commision_percentages` (`id`, `percentage`) VALUES
(1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `company_logo` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_logo`, `created_at`, `updated_at`) VALUES
(1, 'Honda', 'fBsz7rtBQwuDyuk1bwk8.jpg', '2020-01-26 06:52:37', '2020-01-26 07:53:20'),
(2, 'TVS', NULL, '2020-01-26 07:52:45', '2020-01-26 07:52:45'),
(3, 'Toyota', NULL, '2020-01-26 08:08:26', '2020-01-26 08:08:26'),
(4, 'Maruti Suzuki', NULL, '2020-01-26 08:08:44', '2020-01-26 08:08:44'),
(5, 'Bajaj', NULL, '2020-01-26 08:08:57', '2020-01-26 08:08:57'),
(6, 'Hero', NULL, '2020-01-26 08:09:05', '2020-01-26 08:09:05'),
(7, 'Tata', NULL, '2020-01-26 08:09:17', '2020-01-26 08:09:17'),
(8, 'Mahindra', NULL, '2020-01-26 08:09:48', '2020-01-26 08:09:48'),
(9, 'Suzuki', NULL, '2020-01-26 08:10:01', '2020-01-26 08:10:01'),
(10, 'Kia', NULL, '2020-01-26 08:13:05', '2020-01-26 08:13:05'),
(11, 'Yamaha', NULL, '2020-01-26 08:15:04', '2020-01-26 08:15:04'),
(12, 'Ford', NULL, '2020-01-26 08:15:22', '2020-01-26 08:15:22'),
(13, 'Force', NULL, '2020-01-26 08:17:01', '2020-01-26 08:17:01'),
(14, 'Isuzu', NULL, '2020-01-26 08:17:26', '2020-01-26 08:17:26'),
(15, 'BMW', NULL, '2020-01-26 08:17:36', '2020-01-26 08:17:36'),
(16, 'Audi', NULL, '2020-01-26 08:17:48', '2020-01-26 08:17:48'),
(17, 'Hyundai', NULL, '2020-01-26 08:18:13', '2020-01-26 08:18:13'),
(18, 'Volks Wagen', NULL, '2020-01-26 08:19:05', '2020-01-26 08:19:05'),
(19, 'Royal Enfield', NULL, '2020-01-26 08:22:24', '2020-01-26 08:22:24'),
(20, 'Fiat', NULL, '2020-01-26 08:25:59', '2020-01-26 08:25:59'),
(21, 'Renault', NULL, '2020-01-26 08:26:11', '2020-01-26 08:26:11'),
(22, 'MG - Morris Garages', NULL, '2020-01-26 08:27:48', '2020-01-26 08:27:48'),
(23, 'Mitsubishi', NULL, '2020-01-26 08:43:02', '2020-01-26 08:43:02'),
(24, 'KTM', NULL, '2020-01-26 08:53:33', '2020-01-26 08:53:33'),
(25, 'Kawasaki', NULL, '2020-01-26 08:54:11', '2020-01-26 08:54:11'),
(26, 'Jawa', NULL, '2020-01-26 08:54:48', '2020-01-26 08:54:48'),
(27, 'Harley Davidson', NULL, '2020-01-26 08:58:43', '2020-01-26 08:58:43'),
(28, 'Triumph', NULL, '2020-01-26 08:59:22', '2020-01-26 08:59:22'),
(29, 'Benelli', NULL, '2020-01-26 08:59:49', '2020-01-26 08:59:49'),
(30, 'Nissan', NULL, '2020-01-26 09:01:32', '2020-01-26 09:01:32'),
(31, 'Skoda', NULL, '2020-01-26 09:02:00', '2020-01-26 09:02:00'),
(32, 'Mercedes', NULL, '2020-01-26 09:02:50', '2020-01-26 09:02:50'),
(33, 'Land Rover', NULL, '2020-01-26 09:04:54', '2020-01-26 09:04:54'),
(34, 'Jaguar', NULL, '2020-01-26 09:05:04', '2020-01-26 09:05:04'),
(35, 'Piaggio', NULL, '2020-01-26 09:07:27', '2020-01-26 09:07:27'),
(36, 'Jeep', NULL, '2020-01-26 09:15:11', '2020-01-26 09:15:11'),
(37, 'Shobhit shukla', NULL, '2020-12-10 06:45:26', '2020-12-10 01:15:45'),
(38, 'UFO', '202012285780693.png', '2020-12-11 14:19:41', '2020-12-28 01:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `day_id` int(11) DEFAULT NULL,
  `day` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `day_id`, `day`) VALUES
(1, 1, 'Monday'),
(2, 2, 'Tuesday'),
(3, 3, 'Wednesday'),
(4, 4, 'Thursday'),
(5, 5, 'Friday'),
(6, 6, 'Saturday'),
(7, 7, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dealer_name` varchar(200) DEFAULT NULL,
  `gender` enum('m','f','o') DEFAULT NULL COMMENT 'm: malem f: female, o: others',
  `date_of_birth` date DEFAULT NULL,
  `bank_acc_number` varchar(50) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `alternative_contact_no` varchar(20) DEFAULT NULL,
  `address_line1` varchar(100) DEFAULT NULL,
  `address_line2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `dealer_type` enum('1','2') DEFAULT NULL COMMENT '1: Individual, 2: Company',
  `company_name` varchar(500) DEFAULT NULL,
  `company_logo` varchar(100) DEFAULT NULL,
  `agreement_completed` enum('0','1') DEFAULT '0' COMMENT '0: Not completed yet, 1: Completed',
  `agreement_file_path` varchar(200) DEFAULT NULL COMMENT 'Contains the file path of agreement file',
  `shift_start_time` time DEFAULT NULL,
  `shift_end_time` time DEFAULT NULL,
  `google_map_address` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealers`
--

INSERT INTO `dealers` (`id`, `user_id`, `dealer_name`, `gender`, `date_of_birth`, `bank_acc_number`, `contact_no`, `alternative_contact_no`, `address_line1`, `address_line2`, `city`, `gst_no`, `pincode`, `dealer_type`, `company_name`, `company_logo`, `agreement_completed`, `agreement_file_path`, `shift_start_time`, `shift_end_time`, `google_map_address`, `created_at`, `updated_at`) VALUES
(1, 5, 'romie singh', 'o', '2019-07-01', '1234567', '9632587410', '9874563210', 'D-101', 'Deen Dayal Nagar', 'Gwalior', '123456', '474002', '2', 'nimrat travels', NULL, '1', 'public/agreements/t7XbU5L42ylMx1lPq0qViNfr0EQXuKfvnDLMI2o2.pdf', '07:00:00', '23:00:00', 'https://goo.gl/maps/pCtg99LXMj8qdnW66', '2019-12-18 07:50:25', '2020-03-10 22:52:15'),
(2, 6, 'amit singh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '0', NULL, NULL, NULL, NULL, '2019-12-18 08:27:41', '2019-12-18 02:57:41'),
(3, 15, 'Ashish', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'VE', NULL, '0', NULL, NULL, NULL, NULL, '2020-12-16 11:41:44', '2020-12-16 06:11:44'),
(4, 16, 'Ashish2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'VE2', NULL, '0', NULL, NULL, NULL, NULL, '2020-12-16 11:48:20', '2020-12-16 06:18:20'),
(5, 17, 'Ashish2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'VE2', NULL, '0', NULL, NULL, NULL, NULL, '2020-12-16 11:49:33', '2020-12-16 06:19:33'),
(6, 18, 'Ashish2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'VE2', NULL, '0', NULL, NULL, NULL, NULL, '2020-12-16 12:01:15', '2020-12-16 06:31:15'),
(7, 19, 'Ashish2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'VE2', NULL, '0', NULL, NULL, NULL, NULL, '2020-12-16 12:02:25', '2020-12-16 06:32:25'),
(8, 22, 'Ashika', NULL, NULL, NULL, '07042929284', NULL, NULL, NULL, NULL, NULL, NULL, '2', 'sJ4h5Sqz57', NULL, '0', NULL, NULL, NULL, NULL, '2020-12-17 08:07:44', '2020-12-17 08:17:06'),
(9, 23, 'Teeeesssttttttttt', NULL, NULL, NULL, '4015625649', NULL, NULL, NULL, NULL, NULL, NULL, '2', 'AM1SfdsfQi', NULL, '0', NULL, NULL, NULL, NULL, '2020-12-17 08:24:54', '2020-12-17 03:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `dealers_old`
--

CREATE TABLE `dealers_old` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dealer_name` varchar(200) DEFAULT NULL,
  `gender` enum('m','f','o') DEFAULT NULL COMMENT 'm: malem f: female, o: others',
  `date_of_birth` date DEFAULT NULL,
  `bank_acc_number` varchar(50) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `alternative_contact_no` varchar(20) DEFAULT NULL,
  `address_line1` varchar(100) DEFAULT NULL,
  `address_line2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `dealer_type` enum('1','2') DEFAULT NULL COMMENT '1: Individual, 2: Company',
  `company_name` varchar(500) DEFAULT NULL,
  `company_logo` varchar(100) DEFAULT NULL,
  `agreement_completed` enum('0','1') DEFAULT '0' COMMENT '0: Not completed yet, 1: Completed',
  `agreement_file_path` varchar(200) DEFAULT NULL COMMENT 'Contains the file path of agreement file',
  `shift_start_time` time DEFAULT NULL,
  `shift_end_time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealers_old`
--

INSERT INTO `dealers_old` (`id`, `user_id`, `dealer_name`, `gender`, `date_of_birth`, `bank_acc_number`, `contact_no`, `alternative_contact_no`, `address_line1`, `address_line2`, `city`, `gst_no`, `pincode`, `dealer_type`, `company_name`, `company_logo`, `agreement_completed`, `agreement_file_path`, `shift_start_time`, `shift_end_time`, `created_at`, `updated_at`) VALUES
(1, 5, 'romie singh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', 'nimrat travels', NULL, '1', 'public/agreements/t7XbU5L42ylMx1lPq0qViNfr0EQXuKfvnDLMI2o2.pdf', '08:00:00', '22:00:00', '2019-12-18 07:50:25', '2019-12-21 05:19:44'),
(2, 6, 'amit singh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '0', NULL, NULL, NULL, '2019-12-18 08:27:41', '2019-12-18 02:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `dealer_vehicles`
--

CREATE TABLE `dealer_vehicles` (
  `id` int(11) NOT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `vehicle_type_id` int(11) DEFAULT NULL,
  `vehicle_sub_type_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `hourly_charge` float DEFAULT NULL,
  `day1_charge` float DEFAULT NULL COMMENT 'Monday',
  `day2_charge` float DEFAULT NULL COMMENT 'Tuesday',
  `day3_charge` float DEFAULT NULL COMMENT 'Wednesday',
  `day4_charge` float DEFAULT NULL COMMENT 'Thursday',
  `day5_charge` float DEFAULT NULL COMMENT 'Friday',
  `day6_charge` float DEFAULT NULL COMMENT 'Saturday',
  `day7_charge` float DEFAULT NULL COMMENT 'Sunday',
  `weekly_charge` float DEFAULT NULL,
  `monthly_charge` float DEFAULT NULL,
  `renting_policies` text,
  `registration_number` varchar(50) DEFAULT NULL,
  `year_of_purchase` varchar(4) DEFAULT NULL,
  `distance_covered` float DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `fuel_type_id` int(11) DEFAULT NULL,
  `air_condition` enum('0','1') DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '0' COMMENT '0: Inactive, 1: Approved, 2: On Hold',
  `is_paused` enum('0','1') DEFAULT '0' COMMENT 'is_paused means it is not available for short duration and will not be listed, used for routine maintenance.',
  `comment` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'If admin found something not acceptable then he can put comment and put the vehicle on hold',
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealer_vehicles`
--

INSERT INTO `dealer_vehicles` (`id`, `dealer_id`, `vehicle_type_id`, `vehicle_sub_type_id`, `vehicle_id`, `hourly_charge`, `day1_charge`, `day2_charge`, `day3_charge`, `day4_charge`, `day5_charge`, `day6_charge`, `day7_charge`, `weekly_charge`, `monthly_charge`, `renting_policies`, `registration_number`, `year_of_purchase`, `distance_covered`, `color`, `fuel_type_id`, `air_condition`, `status`, `is_paused`, `comment`, `created_at`, `updated_at`, `updated_by`) VALUES
(2, 1, 1, NULL, 1, 59, 499, 499, 499, 499, 499, 499, 599, 2799, 6499, '<p>Security Deposit- one original government issued ID</p>\n<p>Security Deposit- Rs2,000</p>', 'MP07NJ8739', '2019', 2100, '#ff0000', 2, '0', '1', '0', NULL, '2020-01-26 12:52:38', '2020-01-27 16:31:21', NULL),
(3, 1, 2, NULL, 12, 120, 1200, 1200, 1200, 1200, 1200, 1200, 1299, 6000, 12999, '<p>Three</p>\r\n<p>Four</p>', 'mp07op0001', '2020', 100, '#000000', 3, '1', '1', '0', NULL, '2020-01-26 13:08:31', '2020-12-17 07:33:29', NULL),
(4, 1, 1, NULL, 5, 90, 699, 699, 699, 699, 699, 699, 849, 3499, 8499, '<p>Security Deposit- one original government issued ID</p>\n<p>Security Deposit- Rs2,500 (Refundable)</p>', 'MP07NB1210', '2017', 23000, '#000000', 2, '0', '1', '0', NULL, '2020-01-26 13:12:32', '2020-01-27 16:31:21', NULL),
(5, 1, 2, NULL, 3, 180, 1799, 1799, 1799, 1799, 1799, 1799, 1999, 9000, 15000, '<p>Three</p>\n<p>Four</p>', 'MP07BA3240', '2013', 170000, '#5c5c5c', 1, '1', '1', '0', NULL, '2020-01-26 14:19:10', '2020-01-27 16:31:21', NULL),
(6, 1, 2, NULL, 4, 150, 1500, 1500, 1500, 1500, 1500, 1500, 1799, 7500, 13999, '<p>Three</p>\n<p>Four</p>', 'MP07TA2026', '2019', 8000, '#ffffff', 1, '1', '1', '0', NULL, '2020-01-26 14:24:56', '2020-01-27 16:31:21', NULL),
(7, 1, 2, NULL, 16, 150, 1499, 1499, 1499, 1499, 1499, 1499, 1799, 7499, 14999, '<p>Three</p>\n<p>Four</p>', 'MP07CD9276', '2015', 50000, '#d4d4d4', 1, '1', '1', '0', NULL, '2020-01-26 14:35:34', '2020-01-27 16:31:21', NULL),
(8, 1, 2, NULL, 10, 120, 1199, 1199, 1199, 1199, 1199, 1199, 1399, 5999, 11999, '<p>Three</p>\n<p>Four</p>', 'Mp07cd9999', '2020', 900, '#000000', 3, '1', '1', '0', NULL, '2020-01-26 14:44:37', '2020-01-27 16:31:21', NULL),
(9, 1, 1, NULL, 8, 45, 449, 449, 449, 449, 449, 449, 499, 2199, 4999, '<p>Security Deposit- one original government issued id</p>', 'Mp07gh6666', '2020', 800, '#000000', 2, '0', '1', '0', NULL, '2020-01-26 14:46:53', '2020-01-27 16:31:21', NULL),
(10, 1, 2, NULL, 19, 180, 1799, 1799, 1799, 1799, 1799, 1799, 1999, 8999, 14999, '<p>Three</p>\n<p>Four</p>', 'MP07hg8765', '2019', 1500, '#000000', 1, '1', '1', '0', NULL, '2020-01-26 14:52:02', '2020-01-27 16:31:21', NULL),
(11, 9, 3, NULL, 4, 25, 2, 3, 4, 5, 6, 7, 8, 500, 15000, 'Renting Policies- Renting Policies:', 'REGNO123', '2018', 2333, '#000000', 3, '1', '1', '0', 'test comment', '2020-12-17 13:18:04', '2020-12-17 07:48:04', NULL),
(12, 9, 1, NULL, 11, 0, 0, 0, 0, 0, 0, 29, 0, 68, 0, 'tdPrVwCgkB', 'NHedwEKB3c', '2013', 0, '#000000', 2, '1', NULL, '0', 'zZoHxylp6O', '2020-12-17 13:19:10', '2020-12-17 07:49:10', NULL),
(13, 2, 1, NULL, 11, 0, 0, 0, 0, 0, 0, 5, 0, 0, 2, 'Xc8xKqg7At', 'NkJFxO6dpG', '2013', 0, '#000000', 2, '1', '1', '0', '38yQTQ2in8', '2020-12-17 13:40:27', '2020-12-17 13:42:17', NULL),
(14, 22, 1, NULL, 11, 234, 23, 45, 78, 34, 45, 67, 78, 2345, 87654, 'GDHD1SKODb', 'REGNO345', '2013', 23456, '#db1414', 2, '1', '0', '0', 'lfT3Cbig4k', '2020-12-17 13:48:18', '2020-12-17 08:18:18', NULL),
(15, 6, 1, NULL, 11, 0, 23, 45, 78, 34, 45, 67, 78, 2345, 87654, '13BEhgztof', 'reg', '2013', 0, '#000000', 2, '1', '0', '0', 'QL1cUjKa59', '2020-12-17 13:52:33', '2020-12-17 08:22:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dealer_vehicle_images`
--

CREATE TABLE `dealer_vehicle_images` (
  `id` int(11) NOT NULL,
  `dealer_vehicle_id` int(11) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealer_vehicle_images`
--

INSERT INTO `dealer_vehicle_images` (`id`, `dealer_vehicle_id`, `image`, `updated_at`) VALUES
(1, 3, 'public/dealers/vehicles/3XuZhxsMa1Xb92Be6Uqv9ISn7QJ4pstxEQ35KOz7.jpeg', '2020-01-26 13:08:31'),
(2, 3, 'public/dealers/vehicles/hqej2WSODz4VzUU8sLLDYfDcyB4cjBOYWR7Gk60I.jpeg', '2020-01-26 13:08:31'),
(3, 3, 'public/dealers/vehicles/IsvgPYxgz7LKNfWpkhl2LvWNKkso3O9YCaVH2dvQ.jpeg', '2020-01-26 13:08:31'),
(4, 3, 'public/dealers/vehicles/lezSiPmKtqOYnaoQn7gkEG6TP0wSlkbA8boTyU2R.jpeg', '2020-01-26 13:08:31'),
(5, 3, 'public/dealers/vehicles/Tc7QEO0RNpIgQtZOIMisXTajdtqfX1DzVxZout3O.jpeg', '2020-01-26 13:08:31');

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE `email_logs` (
  `id` bigint(20) NOT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `email_content` text,
  `status` enum('0','1','2') DEFAULT NULL COMMENT '0: Initial, 1: Email Sent, 2: Some Error',
  `email_type` tinyint(4) DEFAULT NULL COMMENT '1: Dealer, 2: User',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_details`
--

CREATE TABLE `enquiry_details` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `pickup_location` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `dropping_location` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `drop_date` date DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `enquiry_details`
--

INSERT INTO `enquiry_details` (`id`, `name`, `email`, `mobile_no`, `message`, `pickup_location`, `pickup_date`, `dropping_location`, `drop_date`, `status`, `created_at`, `updated_at`) VALUES
(2, 'test', 'test@yopmail.com', '2365987595', NULL, 'Kanpur, Uttar Pradesh, India', '2020-12-30', 'Kolkata, West Bengal, India', '2020-12-30', 'Active', '2020-12-30 09:41:25', '2020-12-30 15:11:25'),
(3, 'user2', 'user2@yopmail.com', '8965321485', NULL, 'Dubai - United Arab Emirates', '2020-12-30', 'Australia', '2020-12-31', 'Active', '2020-12-30 10:02:05', '2020-12-30 15:32:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_110506_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `minimum_booking_hours`
--

CREATE TABLE `minimum_booking_hours` (
  `id` int(11) NOT NULL,
  `hours` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `minimum_booking_hours`
--

INSERT INTO `minimum_booking_hours` (`id`, `hours`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Dealer', 1),
(1, 'App\\User', 1),
(2, 'App\\Dealer', 2),
(2, 'App\\Dealer', 3),
(2, 'App\\Dealer', 4),
(2, 'App\\Dealer', 5),
(2, 'App\\Dealer', 6),
(2, 'App\\Dealer', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rent_types`
--

CREATE TABLE `rent_types` (
  `id` int(11) NOT NULL,
  `rent_type` varchar(50) DEFAULT NULL,
  `no_of_days` int(11) DEFAULT '0',
  `status` enum('0','1') DEFAULT NULL COMMENT '0: Disable, 1: Enable'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rent_types`
--

INSERT INTO `rent_types` (`id`, `rent_type`, `no_of_days`, `status`) VALUES
(1, 'hourly', 0, '1'),
(2, 'daily', 1, '1'),
(3, 'weekly', 7, '1'),
(4, 'monthly', 30, '1');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Customer', 'web', '2019-12-14 09:01:16', '2019-12-14 09:01:16'),
(2, 'Driver', 'web', '2019-12-14 09:01:43', '2019-12-14 09:01:43'),
(3, 'Front User', 'web', '2019-12-14 09:02:16', '2019-12-14 09:02:16'),
(4, 'Gold', '', '2020-12-27 18:30:00', '2020-12-27 18:30:00'),
(5, 'Silver', '', '2020-12-28 09:01:00', '2020-12-28 00:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_emails`
--

CREATE TABLE `system_emails` (
  `id` int(11) NOT NULL,
  `message` text,
  `comment` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_emails`
--

INSERT INTO `system_emails` (`id`, `message`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'Congratulations! You got a new booking.<br><br>[full_name] ([mobile_no]) has requested [vehicle_name] on [trip_start_date] - [trip_start_time] till [trip_end_date] - [trip_end_time] via [app_name] Booking ID - [booking_id]. Please collect Rs. [pending_amount] from customer while picking up the bike. Ensure timely delivery to earn best reviews.<br><br>Team [app_name] [app_url]', 'dealer booking email content.', '2020-02-23 11:00:00', '2020-02-29 01:41:08'),
(2, 'Hey, <br/><br/>Welcome to [app_name] family, your booking for [vehicle_name] [trip_start_date] [trip_start_time] was successful [booking_id]. Please carry your original id, security money and remaining rent (if any) while receiving the vehicle.<br>Contact [dealer_name] on [dealer_contact], Map Link: [dealer_google_map_link].<br><br>Team [app_name]', 'user booking email content', '2020-02-23 11:00:00', '2020-02-29 01:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `system_messages`
--

CREATE TABLE `system_messages` (
  `id` int(11) NOT NULL,
  `message` text,
  `comment` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_messages`
--

INSERT INTO `system_messages` (`id`, `message`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'Congratulations! You got a new booking. [full_name] ([mobile_no]) has requested [vehicle_name] on [trip_start_date] - [trip_start_time] till [trip_end_date] - [trip_end_time] via [app_name] Booking ID - [booking_id]. Please collect Rs. [pending_amount] from customer while picking up the bike. Ensure timely delivery to earn best reviews. Team [app_name] [app_url]', 'dealer booking sms content.', '2020-02-23 11:00:00', '2020-02-25 04:45:18'),
(2, 'Thanks for booking a vehicle on [app_name]. Booking details are following: Booking ID - [booking_id], Vehicle - [vehicle_name] booked from [trip_start_date] - [trip_start_time] till [trip_end_date] - [trip_end_time]. Please give the remaining amount Rs. [pending_amount] to [dealer_name] at the time of taking the vehicle. Vehicle can be taken from [dealer_address], contact [dealer_contact].Team [app_name] [app_url]', 'user booking sms content', '2020-02-23 11:00:00', '2020-03-15 09:15:03'),
(3, 'Thanks for booking a vehicle on [app_name]. Booking details are following: Booking ID - [booking_id], [vehicle_name] booked from trip_start_date] - [trip_start_time] till [trip_end_date] - [trip_end_time]. Please give the remaining amount Rs. [pending_amount] to [dealer_name] at the time of taking the vehicle. Vehicle can be taken from [dealer_address].Team [app_name] [app_url]', 'user booking sms content', NULL, '2020-03-15 09:15:03'),
(4, 'Thanks for booking a vehicle on [app_name]. Booking details are following: Booking ID - [booking_id], [vehicle_name] booked from trip_start_date] - [trip_start_time] till [trip_end_date] - [trip_end_time]. Please give the remaining amount Rs. [pending_amount] to [dealer_name] at the time of taking the vehicle. Vehicle can be taken from [dealer_address].Team [app_name] [app_url]', 'user booking sms content', NULL, '2020-03-15 09:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `user_id`, `name`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'SAMANTHA GRANT, MD', '2020122902package3.jpg', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.<br></p>', 'Active', '2020-12-29 08:20:40', '2020-12-29 08:24:43'),
(2, NULL, 'What is Lorem Ipsum?', '2020122943travel.jpg', '<p><strong style=\"margin: 0px; padding: 0px; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem Ipsum</strong><span style=\"font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy.</span><br></p>', 'Active', '2020-12-29 08:40:43', '2020-12-29 08:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `trucks`
--

CREATE TABLE `trucks` (
  `id` int(11) NOT NULL,
  `truck_name` varchar(100) DEFAULT NULL,
  `truck_logo` varchar(200) DEFAULT NULL,
  `source_address` varchar(500) DEFAULT NULL,
  `destination_address` varchar(500) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trucks`
--

INSERT INTO `trucks` (`id`, `truck_name`, `truck_logo`, `source_address`, `destination_address`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Truck 4', '202012280471494.png', 'Delhi', 'Mumbai', 'Active', '2020-12-28 07:34:04', '2020-12-28 07:34:04'),
(5, 'Truck 5', '202012282774766.jpg', 'Delhi', 'Banglore', 'Active', '2020-12-28 11:58:27', '2020-12-28 11:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0: Inactive / Initial, 1: Active, 2: On Hold',
  `role_id` int(11) DEFAULT NULL COMMENT '1: Customer, 2: Driver, 3:Frontend User, 4:Gold, 5:Silver',
  `user_type` enum('Gold','Silver') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `fname`, `lname`, `email`, `address`, `gender`, `dob`, `email_verified_at`, `password`, `mobile_no`, `status`, `role_id`, `user_type`, `avatar`, `remember_token`, `created_at`, `updated_at`, `last_login`) VALUES
(5, 'romie singh', NULL, NULL, 'romiesingh@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$3APpy6nguvg86wijreHqK.g6nZanqRZAI8m1zWvyOnl3ngldZvFk6', NULL, '2', 2, NULL, NULL, NULL, '2019-12-18 02:20:25', '2020-12-16 05:24:24', '2020-03-10 22:51:43'),
(12, 'Aman', NULL, NULL, 'driver@yopmail.com', NULL, NULL, NULL, NULL, '$2y$10$BaRwXmI8PrNuO/t7mycQVOC/5/XmiycCB5cnMI3ickv4EVwygh7tW', '8077430609', '1', 2, NULL, NULL, NULL, '2020-02-29 05:43:37', '2020-03-21 09:56:06', '2020-03-21 09:56:06'),
(16, 'Ashish Kumar', NULL, NULL, 'customer@yopmail.com', 'New ashok nagar test', 'Male', '0000-00-00', NULL, '$2y$10$ox7LUxzeZGuke9HuCy7mE.HVdsx0KaJM94cqs6LR45r/dulW/zIU2', '07042929284', '0', 1, NULL, NULL, NULL, '2020-12-16 06:18:20', '2020-12-28 06:26:55', NULL),
(22, 'Driver Gold', NULL, NULL, 'goldDriver@yopmail.com', NULL, NULL, '0000-00-00', NULL, '$2y$10$JIZmo51EuT57fZruF.SJxe5phnGfkxJVqp6yRZ5LdeVA4vNYQc.O.', NULL, NULL, 2, 'Gold', NULL, NULL, '2020-12-29 08:07:29', '2020-12-29 08:07:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `vehicle_type_id` int(11) DEFAULT NULL,
  `vehicle_name` varchar(100) NOT NULL,
  `vehicle_image` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `company_id`, `vehicle_type_id`, `vehicle_name`, `vehicle_image`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'Activa 5G', NULL, '2020-01-26 07:56:04', '2020-01-26 12:03:14'),
(3, 3, 2, 'Innova 2nd Generation', NULL, '2020-01-26 08:20:59', '2020-01-26 12:04:18'),
(4, 4, 2, 'Swift Dzire Tour', NULL, '2020-01-26 08:22:06', '2020-01-26 12:08:30'),
(5, 19, 1, 'Bullet Standard 350', NULL, '2020-01-26 08:23:05', '2020-01-26 12:10:08'),
(6, 19, 1, 'Classic 350', NULL, '2020-01-26 08:23:28', '2020-01-26 12:10:53'),
(7, 1, 1, 'Activa 4G', NULL, '2020-01-26 08:23:59', '2020-01-26 12:11:07'),
(8, 2, 1, 'Jupiter', NULL, '2020-01-26 08:24:14', '2020-01-26 12:11:26'),
(9, 4, 2, 'Swift', NULL, '2020-01-26 08:24:52', '2020-01-26 12:12:52'),
(10, 17, 2, 'Sentro New Generation', NULL, '2020-01-26 08:25:20', '2020-01-26 12:15:12'),
(11, 17, 2, 'i20', NULL, '2020-01-26 08:25:35', '2020-01-26 12:15:20'),
(12, 17, 2, 'i10 Nios', NULL, '2020-01-26 08:43:43', '2020-01-26 12:15:29'),
(13, 17, 2, 'i10 Grand', NULL, '2020-01-26 08:43:58', '2020-01-26 12:15:38'),
(14, 4, 2, 'Baleno', NULL, '2020-01-26 08:44:30', '2020-01-26 12:16:00'),
(15, 17, 2, 'Xcent', NULL, '2020-01-26 08:44:49', '2020-01-26 12:16:14'),
(16, 17, 2, 'Verna', NULL, '2020-01-26 08:45:03', '2020-01-26 12:16:50'),
(17, 17, 2, 'Eon', NULL, '2020-01-26 08:45:15', '2020-01-26 12:17:15'),
(18, 7, 2, 'Nexon', NULL, '2020-01-26 08:45:28', '2020-01-26 12:18:34'),
(19, 7, 2, 'Xenon', NULL, '2020-01-26 08:46:01', '2020-01-26 12:18:46'),
(20, 7, 2, 'Harrier', NULL, '2020-01-26 08:46:20', '2020-01-26 19:58:18'),
(21, 17, 2, 'Venue', NULL, '2020-01-26 08:46:40', '2020-01-26 19:58:30'),
(22, 19, 1, 'Himalayan', NULL, '2020-01-26 08:46:56', '2020-01-26 19:58:39'),
(23, 11, 1, 'R15', NULL, '2020-01-26 08:47:09', '2020-01-26 19:58:49'),
(24, 4, 2, 'Swift Dzire', NULL, '2020-01-26 08:48:17', '2020-01-26 19:59:09'),
(25, 3, 2, 'Innova Crysta', NULL, '2020-01-26 08:48:49', '2020-01-26 19:59:18'),
(26, 8, 2, 'Thar', NULL, '2020-01-26 08:49:26', '2020-01-26 19:59:31'),
(27, 13, 2, 'Gorkha 4X4', NULL, '2020-01-26 08:50:01', '2020-01-26 19:59:43'),
(28, 7, 2, 'Tigor', NULL, '2020-01-26 08:50:19', '2020-01-26 19:59:53'),
(29, 5, 1, 'Dominar 400', NULL, '2020-01-26 08:50:52', '2020-01-26 20:00:04'),
(30, 5, 1, 'Avenger', NULL, '2020-01-26 08:51:37', '2020-01-26 20:00:17'),
(31, 3, 2, 'Fortuner', NULL, '2020-01-26 08:51:52', '2020-01-26 20:00:26'),
(32, 12, 2, 'Figo Aspire', NULL, '2020-01-26 08:52:27', '2020-01-26 20:00:34'),
(33, 1, 1, 'Aviator', NULL, '2020-01-26 08:53:10', '2020-01-26 20:00:43'),
(34, 19, 1, 'Bullet Electra 350', NULL, '2020-01-26 08:55:22', '2020-01-26 20:01:03'),
(35, 4, 2, 'Ignis', NULL, '2020-01-26 09:05:56', '2020-01-26 20:01:11'),
(36, 35, 1, 'Vespa', NULL, '2020-01-26 09:07:44', '2020-01-26 20:01:22'),
(37, 8, 2, 'Scorpio', NULL, '2020-01-26 09:08:18', '2020-01-26 20:01:30'),
(38, 8, 2, 'XUV 500', NULL, '2020-01-26 09:08:33', '2020-01-26 20:01:38'),
(39, 8, 2, 'XUV 300', NULL, '2020-01-26 09:08:44', '2020-01-26 20:01:49'),
(40, 1, 1, 'Dio', NULL, '2020-01-26 09:10:57', '2020-01-26 20:01:59'),
(41, 1, 2, 'Brio', NULL, '2020-01-26 09:11:25', '2020-01-26 20:02:11'),
(42, 9, 1, 'Access 125', NULL, '2020-01-26 09:13:54', '2020-01-26 20:02:21'),
(43, 4, 2, 'Ertiga', NULL, '2020-01-26 09:14:49', '2020-01-26 20:02:31'),
(44, 3, 3, 'Innova 2nd Generation', NULL, '2020-01-26 12:06:51', '2020-01-26 12:06:51'),
(45, 4, 3, 'Swift Dzire Tour', NULL, '2020-01-26 12:08:09', '2020-01-26 12:08:09'),
(46, 13, 4, 'Tempo Traveller', NULL, '2020-01-26 20:03:07', '2020-01-26 20:03:07'),
(47, 14, 2, 'D Max (Pick-up Truck)', NULL, '2020-01-26 20:04:59', '2020-01-26 20:04:59'),
(48, 8, 2, 'Marazzo', NULL, '2020-01-26 20:05:54', '2020-01-26 20:05:54'),
(49, 25, 1, 'Z 800', NULL, '2020-01-26 20:06:35', '2020-01-26 20:06:35'),
(50, 7, 2, 'Altroz', NULL, '2020-01-26 20:09:42', '2020-01-26 20:09:42'),
(51, 1, 1, 'sdffsfads', 'public/vehicles/Ix8sFA2tXtVPsLu3n2cfb0yXriOZPjSxOhwDxW10.jpeg', '2020-12-11 14:20:23', '2020-12-11 14:20:23'),
(53, 2, NULL, 'sdfdfsfs', NULL, '2020-12-17 07:40:33', '2020-12-17 07:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_bookings`
--

CREATE TABLE `vehicle_bookings` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(50) DEFAULT NULL COMMENT 'A random number to identify booking',
  `order_id` varchar(255) NOT NULL,
  `dealer_vehicle_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `booking_start_date` date DEFAULT NULL,
  `booking_start_time` time DEFAULT NULL,
  `booking_end_date` date DEFAULT NULL,
  `booking_end_time` time DEFAULT NULL,
  `renting_policy` text,
  `total_charge` float DEFAULT NULL,
  `dealer_payable_charge` float DEFAULT NULL COMMENT 'Dealer amount after deducting commision',
  `charge_details` text COMMENT 'a json array',
  `payment_status` enum('0','1','2') NOT NULL,
  `payment_done` varchar(255) NOT NULL,
  `payment_remain` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_bookings`
--

INSERT INTO `vehicle_bookings` (`id`, `booking_id`, `order_id`, `dealer_vehicle_id`, `user_id`, `booking_start_date`, `booking_start_time`, `booking_end_date`, `booking_end_time`, `renting_policy`, `total_charge`, `dealer_payable_charge`, `charge_details`, `payment_status`, `payment_done`, `payment_remain`, `payment_mode`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 'BK23537621', '', 9, 12, '2020-02-28', '09:00:00', '2020-02-28', '12:00:00', '<p>Security Deposit- one original government issued id</p>', 135, 108, '{\"charge\":45,\"duration\":3,\"duration_type\":\"hourly\",\"total_charge\":135,\"partial_charge\":33.75}', '0', '135', '135', 'full_payment', '', '2020-02-27 18:01:33', '2020-03-03 17:09:09'),
(2, 'BK58318832', '', 9, 12, '2020-02-28', '09:00:00', '2020-02-28', '12:00:00', '<p>Security Deposit- one original government issued id</p>', 135, 108, '{\"charge\":45,\"duration\":3,\"duration_type\":\"hourly\",\"total_charge\":135,\"partial_charge\":33.75}', '0', '33.75', '135', 'partial', '', '2020-02-27 18:01:43', '2020-03-03 17:09:09'),
(3, 'BK84161206', '', 2, 12, '2020-02-28', '09:00:00', '2020-02-28', '12:00:00', '<p>Security Deposit- one original government issued ID</p>\n<p>Security Deposit- Rs2,000</p>', 177, 141.6, '{\"charge\":59,\"duration\":3,\"duration_type\":\"hourly\",\"total_charge\":177,\"partial_charge\":44.25}', '0', '44.25', '177', 'partial', '', '2020-02-27 18:05:46', '2020-03-03 17:09:09'),
(4, 'BK30472182', '1111111113', 4, 12, '2020-02-28', '08:00:00', '2020-02-28', '12:00:00', '<p>Security Deposit- one original government issued ID</p>\n<p>Security Deposit- Rs2,500 (Refundable)</p>', 360, 288, '{\"charge\":90,\"duration\":4,\"duration_type\":\"hourly\",\"total_charge\":360,\"partial_charge\":90}', '0', '90', '360', 'partial', '0', '2020-02-27 18:12:43', '2020-03-03 17:09:09'),
(5, 'BK88748237', '11111111140', 4, 12, '2020-02-28', '08:00:00', '2020-02-28', '12:00:00', '<p>Security Deposit- one original government issued ID</p>\n<p>Security Deposit- Rs2,500 (Refundable)</p>', 360, 288, '{\"charge\":90,\"duration\":4,\"duration_type\":\"hourly\",\"total_charge\":360,\"partial_charge\":90}', '0', '90', '360', 'partial', '0', '2020-02-27 18:13:03', '2020-03-03 17:09:09'),
(6, 'BK27182127', '11111111138', 1, 12, '2020-02-28', '08:00:00', '2020-02-28', '12:00:00', '<p>Security Deposit- one original government issued id</p>', 180, 144, '{\"charge\":45,\"duration\":4,\"duration_type\":\"hourly\",\"total_charge\":180,\"partial_charge\":45}', '1', '180', '180', 'full_payment', '0', '2020-02-27 18:16:41', '2020-03-03 17:09:09'),
(7, 'BK14372529', '11111111162', 1, 12, '2020-02-28', '09:00:00', '2020-02-28', '12:00:00', '<p>Security Deposit- one original government issued id</p>', 135, 108, '{\"charge\":45,\"duration\":3,\"duration_type\":\"hourly\",\"total_charge\":135,\"partial_charge\":33.75}', '0', '135', '0', 'full_payment', '0', '2020-02-27 18:27:19', '2020-03-03 17:09:09'),
(8, 'BK02292020110734', '02292020110734', 1, 12, '2020-03-01', '08:00:00', '2020-03-01', '12:00:00', '<p>Security Deposit- one original government issued id</p>', 180, 144, '{\"charge\":45,\"duration\":4,\"duration_type\":\"hourly\",\"total_charge\":180,\"partial_charge\":45}', '0', '180', '0', 'full_payment', '0', '2020-02-29 11:07:34', '2020-03-03 17:09:09'),
(9, 'BK02292020110835', '02292020110835', 1, 12, '2020-03-01', '08:00:00', '2020-03-01', '12:00:00', '<p>Security Deposit- one original government issued id</p>', 180, 144, '{\"charge\":45,\"duration\":4,\"duration_type\":\"hourly\",\"total_charge\":180,\"partial_charge\":45}', '0', '180', '0', 'full_payment', '0', '2020-02-29 11:08:35', '2020-03-03 17:09:09'),
(10, 'BK02292020111751', '02292020111751', 1, 12, '2020-03-01', '09:00:00', '2020-03-01', '12:00:00', '<p>Security Deposit- one original government issued id</p>', 135, 108, '{\"charge\":45,\"duration\":3,\"duration_type\":\"hourly\",\"total_charge\":135,\"partial_charge\":33.75}', '1', '135', '0', 'full_payment', '0', '2020-02-29 11:17:51', '2020-02-29 05:48:43'),
(11, 'BK02292020112448', '02292020112448', 4, 12, '2020-03-01', '09:00:00', '2020-03-01', '12:00:00', '<p>Security Deposit- one original government issued ID</p>\n<p>Security Deposit- Rs2,500 (Refundable)</p>', 270, 216, '{\"charge\":90,\"duration\":3,\"duration_type\":\"hourly\",\"total_charge\":270,\"partial_charge\":67.5}', '1', '67.5', '202.5', 'partial', '0', '2020-02-29 11:24:48', '2020-02-29 05:55:13'),
(12, 'BK03022020043003', '03022020043003', 1, 12, '2020-03-02', '09:00:00', '2020-03-02', '12:00:00', '<p>Security Deposit- one original government issued id</p>', 135, 108, '{\"charge\":45,\"duration\":3,\"duration_type\":\"hourly\",\"total_charge\":135,\"partial_charge\":33.75}', '0', '33.75', '101.25', 'partial', '0', '2020-03-02 04:30:03', '2020-03-03 17:09:09'),
(13, 'BK03022020043052', '03022020043052', 1, 12, '2020-03-02', '11:00:00', '2020-03-02', '14:00:00', '<p>Security Deposit- one original government issued id</p>', 135, 108, '{\"charge\":45,\"duration\":3,\"duration_type\":\"hourly\",\"total_charge\":135,\"partial_charge\":33.75}', '0', '33.75', '101.25', 'partial', '0', '2020-03-02 04:30:52', '2020-03-01 23:00:52'),
(14, 'BK03022020043124', '03022020043124', 1, 12, '2020-03-02', '11:00:00', '2020-03-02', '14:00:00', '<p>Security Deposit- one original government issued id</p>', 135, 108, '{\"charge\":45,\"duration\":3,\"duration_type\":\"hourly\",\"total_charge\":135,\"partial_charge\":33.75}', '0', '33.75', '101.25', 'partial', '0', '2020-03-02 04:31:24', '2020-03-01 23:01:24'),
(15, 'BK03042020174253', '03042020174253', 4, 12, '2020-03-05', '09:00:00', '2020-03-05', '12:00:00', '<p>Security Deposit- one original government issued ID</p>\n<p>Security Deposit- Rs2,500 (Refundable)</p>', 270, 216, '{\"charge\":90,\"duration\":3,\"duration_type\":\"hourly\",\"total_charge\":270,\"partial_charge\":67.5}', '1', '68', '202', 'partial', '0', '2020-03-04 17:42:53', '2020-03-04 12:13:44'),
(16, 'BK03042020174451', '03042020174451', 2, 12, '2020-03-05', '09:00:00', '2020-03-05', '12:00:00', '<p>Security Deposit- one original government issued ID</p>\n<p>Security Deposit- Rs2,000</p>', 177, 142, '{\"charge\":59,\"duration\":3,\"duration_type\":\"hourly\",\"total_charge\":177,\"partial_charge\":44.25}', '0', '44', '133', 'partial', '0', '2020-03-04 17:44:51', '2020-03-04 12:14:51'),
(17, 'BK03112020042349', '03112020042349', 1, 12, '2020-03-11', '10:00:00', '2020-03-11', '13:00:00', '<p>Security Deposit- one original government issued id</p>', 135, 108, '{\"charge\":45,\"duration\":3,\"duration_type\":\"hourly\",\"total_charge\":135,\"partial_charge\":33.75}', '1', '135', '0', 'full_payment', '0', '2020-03-11 04:23:49', '2020-03-10 22:54:18'),
(18, 'BK03152020104553', '03152020104553', 1, 12, '2020-03-15', '15:00:00', '2020-03-15', '22:00:00', '<p>Security Deposit- one original government issued id</p>', 315, 252, '{\"charge\":45,\"duration\":7,\"duration_type\":\"hourly\",\"total_charge\":315,\"partial_charge\":78.75}', '1', '315', '0', 'full_payment', '0', '2020-03-15 10:45:53', '2020-03-15 05:17:24'),
(19, 'BK03152020104756', '03152020104756', 2, 12, '2020-03-15', '15:00:00', '2020-03-15', '22:00:00', '<p>Security Deposit- one original government issued ID</p>\n<p>Security Deposit- Rs2,000</p>', 413, 330, '{\"charge\":59,\"duration\":7,\"duration_type\":\"hourly\",\"total_charge\":413,\"partial_charge\":103.25}', '2', '413', '0', 'full_payment', '0', '2020-03-15 10:47:56', '2020-03-15 05:18:48'),
(20, 'BK03152020105536', '03152020105536', 4, 12, '2020-03-16', '11:00:00', '2020-03-16', '17:00:00', '<p>Security Deposit- one original government issued ID</p>\n<p>Security Deposit- Rs2,500 (Refundable)</p>', 540, 432, '{\"charge\":90,\"duration\":6,\"duration_type\":\"hourly\",\"total_charge\":540,\"partial_charge\":135}', '2', '540', '0', 'full_payment', '0', '2020-03-15 10:55:36', '2020-03-15 05:26:03'),
(21, 'BK03212020063813', '03212020063813', 1, 12, '2020-03-22', '08:00:00', '2020-03-22', '14:00:00', '<p>Security Deposit- one original government issued id</p>', 270, 216, '{\"charge\":45,\"duration\":6,\"duration_type\":\"hourly\",\"total_charge\":270,\"partial_charge\":67.5}', '0', '270', '0', 'full_payment', '0', '2020-03-21 06:38:13', '2020-03-21 01:08:13'),
(22, 'BK03212020152612', '03212020152612', 1, 12, '2020-03-22', '07:00:00', '2020-03-22', '12:00:00', '<p>Security Deposit- one original government issued id</p>', 225, 180, '{\"charge\":45,\"duration\":5,\"duration_type\":\"hourly\",\"total_charge\":225,\"partial_charge\":56.25}', '0', '225', '0', 'full_payment', '0', '2020-03-21 15:26:12', '2020-03-21 09:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_fuel_types`
--

CREATE TABLE `vehicle_fuel_types` (
  `id` int(11) NOT NULL,
  `fuel_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_fuel_types`
--

INSERT INTO `vehicle_fuel_types` (`id`, `fuel_type`) VALUES
(1, 'diesel'),
(2, 'petrol'),
(3, 'cng');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_renting_policies`
--

CREATE TABLE `vehicle_renting_policies` (
  `id` int(11) NOT NULL,
  `vehicle_type_id` int(11) DEFAULT NULL,
  `policy` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_renting_policies`
--

INSERT INTO `vehicle_renting_policies` (`id`, `vehicle_type_id`, `policy`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>Security Deposit- one original government issued id</p>', '2019-12-22 11:23:30', '2020-01-26 07:58:31'),
(2, 2, '<p>Three</p>\n<p>Four</p>', '2019-12-22 11:25:55', '2019-12-22 05:55:55'),
(3, 2, '<p>Four</p>\n<p>Five</p>\n<p>Six</p>', '2019-12-22 11:30:25', '2019-12-22 06:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_sub_types`
--

CREATE TABLE `vehicle_sub_types` (
  `id` int(11) NOT NULL,
  `vehicle_type_id` int(11) DEFAULT NULL,
  `vehicle_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_sub_types`
--

INSERT INTO `vehicle_sub_types` (`id`, `vehicle_type_id`, `vehicle_type`) VALUES
(1, 2, 'Hatchback'),
(2, 2, 'Sedan'),
(3, 2, 'SUV - 4*2'),
(4, 2, 'SUV - 4*4'),
(5, 3, 'Hatchback'),
(6, 3, 'Sedan'),
(7, 3, 'SUV - 4*2'),
(8, 3, 'SUV - 4*4'),
(9, 4, '10 seater'),
(10, 1, 'Bike'),
(11, 1, 'Scooter');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` int(11) NOT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `vehicle_type`) VALUES
(1, 'Refrigerated'),
(2, 'Trailers'),
(3, 'Tractors'),
(4, 'Vans & Lutons'),
(5, 'Rigids');

-- --------------------------------------------------------

--
-- Table structure for table `website_ratings`
--

CREATE TABLE `website_ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `website_ratings`
--

INSERT INTO `website_ratings` (`id`, `user_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 13, 4, 'daadadaadadadadad', '2020-12-11 11:22:35', '2020-12-11 05:52:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_percentage`
--
ALTER TABLE `booking_percentage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commision_percentages`
--
ALTER TABLE `commision_percentages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_old`
--
ALTER TABLE `dealers_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_vehicles`
--
ALTER TABLE `dealer_vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_vehicle_images`
--
ALTER TABLE `dealer_vehicle_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_details`
--
ALTER TABLE `enquiry_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minimum_booking_hours`
--
ALTER TABLE `minimum_booking_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rent_types`
--
ALTER TABLE `rent_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `system_emails`
--
ALTER TABLE `system_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_messages`
--
ALTER TABLE `system_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trucks`
--
ALTER TABLE `trucks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_bookings`
--
ALTER TABLE `vehicle_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_fuel_types`
--
ALTER TABLE `vehicle_fuel_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_renting_policies`
--
ALTER TABLE `vehicle_renting_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_sub_types`
--
ALTER TABLE `vehicle_sub_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_ratings`
--
ALTER TABLE `website_ratings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `booking_percentage`
--
ALTER TABLE `booking_percentage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `commision_percentages`
--
ALTER TABLE `commision_percentages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `dealers_old`
--
ALTER TABLE `dealers_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dealer_vehicles`
--
ALTER TABLE `dealer_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `dealer_vehicle_images`
--
ALTER TABLE `dealer_vehicle_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `email_logs`
--
ALTER TABLE `email_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enquiry_details`
--
ALTER TABLE `enquiry_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `minimum_booking_hours`
--
ALTER TABLE `minimum_booking_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rent_types`
--
ALTER TABLE `rent_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `system_emails`
--
ALTER TABLE `system_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `system_messages`
--
ALTER TABLE `system_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `trucks`
--
ALTER TABLE `trucks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `vehicle_bookings`
--
ALTER TABLE `vehicle_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `vehicle_fuel_types`
--
ALTER TABLE `vehicle_fuel_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vehicle_renting_policies`
--
ALTER TABLE `vehicle_renting_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vehicle_sub_types`
--
ALTER TABLE `vehicle_sub_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `website_ratings`
--
ALTER TABLE `website_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
