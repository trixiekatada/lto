-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2016 at 12:47 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teller`
--

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE IF NOT EXISTS `counters` (
  `counter_id` int(11) NOT NULL,
  `counter_name` varchar(50) NOT NULL,
  `tellerID_fk` int(11) DEFAULT '0',
  `estimated_time` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`counter_id`, `counter_name`, `tellerID_fk`, `estimated_time`) VALUES
(1, 'registration', 0, '00:00:00'),
(2, 'receiving', 0, '00:00:00'),
(3, 'approving', 0, '00:00:00'),
(4, 'photo and signature', 0, '00:00:00'),
(5, 'cashier', 0, '00:00:00'),
(6, 'releasing', 0, '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `queue_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `transactionID` int(11) NOT NULL,
  `counter_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`queue_id`, `id`, `transactionID`, `counter_id`, `created_at`, `updated_at`) VALUES
(5, 5, 23, 1, '2016-02-06 02:08:45', '2016-02-06 02:08:45'),
(6, 6, 2, 1, '2016-02-03 20:03:18', '2016-02-03 20:03:18'),
(7, 7, 1, 1, '2016-02-03 20:03:20', '2016-02-03 20:03:20'),
(8, 8, 1, 1, '2016-02-03 20:03:23', '2016-02-03 20:03:23'),
(9, 9, 2, 1, '2016-02-03 20:03:26', '2016-02-03 20:03:26'),
(10, 10, 3, 1, '2016-02-03 20:03:35', '2016-02-03 20:03:35'),
(11, 11, 3, 1, '2016-02-03 20:03:38', '2016-02-03 20:03:38'),
(12, 12, 3, 1, '2016-02-03 20:03:45', '2016-02-03 20:03:45'),
(5, 5, 23, 1, '2016-02-06 02:08:45', '2016-02-06 02:08:45'),
(6, 6, 2, 1, '2016-02-03 20:03:18', '2016-02-03 20:03:18'),
(7, 7, 1, 1, '2016-02-03 20:03:20', '2016-02-03 20:03:20'),
(8, 8, 1, 1, '2016-02-03 20:03:23', '2016-02-03 20:03:23'),
(9, 9, 2, 1, '2016-02-03 20:03:26', '2016-02-03 20:03:26'),
(10, 10, 3, 1, '2016-02-03 20:03:35', '2016-02-03 20:03:35'),
(11, 11, 3, 1, '2016-02-03 20:03:38', '2016-02-03 20:03:38'),
(12, 12, 3, 1, '2016-02-03 20:03:45', '2016-02-03 20:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_10_03_174814_Add_Course', 1),
('2015_10_19_180111_addUser', 1),
('2016_01_21_042921_create_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_info`
--

CREATE TABLE IF NOT EXISTS `tbl_client_info` (
  `client_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `birth` date NOT NULL,
  `gender` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_type` tinyint(4) NOT NULL COMMENT '0 - regular  1- senior citizen 2 - pwd',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_client_info`
--

INSERT INTO `tbl_client_info` (`client_id`, `first_name`, `last_name`, `email`, `address`, `mobile`, `birth`, `gender`, `remember_token`, `client_type`, `created_at`, `updated_at`) VALUES
(1, 'rheageonzon', '', 'rhea@gmail.com', 'Basak', '123', '2015-12-03', 'female', 'ZTjruwlRbXHGx7EjlmRypi6zhMBqlmWxtYZUq6egcOt5GLwwLhzUpLb4pOLu', 0, '2015-12-02 22:09:01', '2016-02-14 02:37:08'),
(2, 'Marjune', 'Abellana', 'marjune_abellana@yahoo.com.sg', 'Cebu City', '1212121', '0000-00-00', 'Male', NULL, 1, '2016-02-28 11:34:39', '2016-02-28 11:34:39'),
(3, 'Monicko', 'Abellan', 'asdfas@yahoo.com', 'Cebu City', '1212121', '2016-05-01', 'adfasf', NULL, 2, '2016-02-28 11:37:15', '2016-02-28 11:37:15'),
(4, 'Marjune', 'Abellana', 'marjune_abellana@yahoo.com.sg', 'cebu', '09079968661', '2016-05-01', 'Male', NULL, 0, '2016-02-28 11:39:50', '2016-02-28 11:39:50'),
(5, 'Marjune', 'Abellana', 'marjune_abellana@yahoo.com.sg', 'cebu', '09079968661', '2016-05-01', 'Male', NULL, 0, '2016-02-28 11:41:02', '2016-02-28 11:41:02'),
(6, 'Marjune', 'Abellana', 'marjune_abellana@yahoo.com.sg', 'cebu', '09079968661', '2016-05-01', 'Male', NULL, 0, '2016-02-28 11:41:24', '2016-02-28 11:41:24'),
(7, 'Marjune', 'Abellana', 'marjune_abellana@yahoo.com.sg', 'cebu', '09079968661', '2016-05-01', 'Male', NULL, 2, '2016-02-28 11:44:05', '2016-02-28 11:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_process_labels`
--

CREATE TABLE IF NOT EXISTS `tbl_process_labels` (
  `process_id` int(11) NOT NULL,
  `process_name` varchar(31) NOT NULL,
  `process_is_active` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'is process active? 0 - no 1 - yes',
  `process_parameter` enum('','') NOT NULL COMMENT 'what are the prerequisites for this proces?'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_process_labels`
--

INSERT INTO `tbl_process_labels` (`process_id`, `process_name`, `process_is_active`, `process_parameter`) VALUES
(1, 'Registration', 1, ''),
(2, 'Photo and Signature Capturing', 1, ''),
(3, 'Cashier', 1, ''),
(4, 'Approving', 1, ''),
(5, 'Receiving', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_queues`
--

CREATE TABLE IF NOT EXISTS `tbl_queues` (
  `queue_id` int(11) NOT NULL,
  `queue_label` int(11) NOT NULL,
  `transactionID_fk` int(11) NOT NULL,
  `processID_fk` int(11) NOT NULL,
  `counterID_fk` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - active 1 - inactive'
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_queues`
--

INSERT INTO `tbl_queues` (`queue_id`, `queue_label`, `transactionID_fk`, `processID_fk`, `counterID_fk`, `updated_at`, `created_at`, `status`) VALUES
(1, 0, 1234, 15, 15, '2016-02-28 10:44:30', '0000-00-00 00:00:00', 1),
(2, 0, 1, 3, 3, '2016-02-28 08:51:07', '0000-00-00 00:00:00', 0),
(3, 0, 123456, 3, 3, '2016-02-28 09:14:44', '0000-00-00 00:00:00', 0),
(4, 0, 1234, 4, 4, '2016-02-25 10:27:07', '2016-02-23 01:47:17', 0),
(5, 0, 1234, 3, 3, '2016-02-28 09:16:25', '2016-02-23 02:00:29', 0),
(6, 0, 1234, 3, 3, '2016-02-28 09:18:08', '2016-02-23 02:02:30', 0),
(7, 0, 1234, 3, 3, '2016-02-28 09:19:49', '2016-02-23 02:04:21', 0),
(8, 0, 1234, 3, 3, '2016-02-28 09:21:31', '2016-02-23 02:06:11', 0),
(9, 0, 1234, 3, 3, '2016-02-28 09:23:13', '2016-02-23 02:06:29', 0),
(10, 0, 1234, 3, 3, '2016-02-28 09:28:12', '2016-02-23 02:06:46', 0),
(11, 0, 1234, 3, 3, '2016-02-28 09:28:14', '2016-02-23 02:08:39', 0),
(12, 0, 1234, 3, 3, '2016-02-28 09:28:16', '2016-02-23 02:08:48', 0),
(13, 0, 1234, 3, 3, '2016-02-28 09:29:57', '2016-02-23 02:09:35', 0),
(14, 0, 12345, 3, 3, '2016-02-28 09:31:39', '2016-02-24 23:54:54', 0),
(15, 0, 1234, 3, 3, '2016-02-28 09:33:21', '2016-02-24 23:58:00', 0),
(16, 0, 1234, 3, 3, '2016-02-28 09:35:03', '2016-02-25 00:05:35', 0),
(17, 0, 1234, 7, 7, '2016-02-25 10:39:42', '2016-02-25 00:57:59', 1),
(18, 0, 1234, 3, 3, '2016-02-28 09:36:45', '2016-02-25 01:58:22', 0),
(19, 0, 1234, 3, 3, '2016-02-28 09:38:27', '2016-02-25 01:58:48', 0),
(20, 0, 1234, 3, 3, '2016-02-25 10:11:33', '2016-02-25 09:00:56', 0),
(21, 1, 1234, 3, 3, '2016-02-28 10:52:44', '2016-02-28 10:20:16', 0),
(22, 349, 1234, 3, 3, '2016-02-28 10:53:24', '2016-02-28 10:20:27', 0),
(23, 350, 1234, 3, 3, '2016-02-28 11:13:46', '2016-02-28 10:21:23', 0),
(24, 100, 1234, 2, 2, '2016-02-28 11:14:18', '2016-02-28 10:21:33', 0),
(25, 2, 1234, 9, 9, '2016-02-28 10:49:55', '2016-02-28 10:24:21', 1),
(26, 3, 12351, 1, 1, '2016-02-28 11:44:52', '2016-02-28 11:44:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tellers`
--

CREATE TABLE IF NOT EXISTS `tbl_tellers` (
  `teller_id` int(10) unsigned NOT NULL,
  `counter_id` int(11) NOT NULL,
  `firstname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `birth` date NOT NULL,
  `gender` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_tellers`
--

INSERT INTO `tbl_tellers` (`teller_id`, `counter_id`, `firstname`, `lastname`, `email`, `address`, `mobile`, `birth`, `gender`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 2, '', 'rheageonzon', 'rhea@gmail.com', 'Basak', '123', '2015-12-03', 'female', '$2y$10$D9sZ6NoBEzVP7CWLLPWWFONVYTVulHzyxEFc6YUstKYHjoGl2R5Ae', 'ZTjruwlRbXHGx7EjlmRypi6zhMBqlmWxtYZUq6egcOt5GLwwLhzUpLb4pOLu', '2015-12-03 06:09:01', '2016-02-14 10:37:08'),
(9, 1, 'Marjune', 'Abellana', 'marjune_abellana@yahoo.com.sg', 'cebu', '09079968661', '2016-05-01', 'Male', '$2y$10$3p9tSzFowxr9FMu3G1zc2.hUBXTB0ty/NGu.3TspnozVxhAQFdUNy', NULL, '2016-02-21 01:52:21', '2016-02-21 01:52:21'),
(10, 2, 'fadfasdf', 'afasfa', 'afafa@yahoo.com', 'asfasdf', '123456', '0000-00-00', 'afasfa', '$2y$10$wKQPJUfXJb2kwPjN6i8/k.HcsjcDLwuxSXr0DH9OBnIDR3M5KLXmO', NULL, '2016-02-25 00:42:21', '2016-02-25 00:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE IF NOT EXISTS `tbl_transactions` (
  `transactions_id` int(11) NOT NULL,
  `verification_code` varchar(63) NOT NULL,
  `clientID_fk` int(11) NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=12352 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`transactions_id`, `verification_code`, `clientID_fk`, `transaction_type`, `created_at`, `updated_at`) VALUES
(1234, '12345', 1, 1, '2016-02-28 09:27:54', '0000-00-00 00:00:00'),
(12346, '43143', 2, 1, '2016-02-28 11:34:39', '2016-02-28 11:34:39'),
(12347, '515091', 3, 1, '2016-02-28 11:37:15', '2016-02-28 11:37:15'),
(12348, '523822', 4, 1, '2016-02-28 11:39:50', '2016-02-28 11:39:50'),
(12349, '593825', 5, 1, '2016-02-28 11:41:02', '2016-02-28 11:41:02'),
(12350, '226713', 6, 1, '2016-02-28 11:41:24', '2016-02-28 11:41:24'),
(12351, '291156', 7, 2, '2016-02-28 11:44:05', '2016-02-28 11:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_type_labels`
--

CREATE TABLE IF NOT EXISTS `tbl_transaction_type_labels` (
  `transaction_type_id` int(11) NOT NULL,
  `transaction_type_name` varchar(31) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_transaction_type_labels`
--

INSERT INTO `tbl_transaction_type_labels` (`transaction_type_id`, `transaction_type_name`, `created_at`, `updated_at`) VALUES
(1, 'license application', '2016-02-28 06:45:38', '0000-00-00 00:00:00'),
(2, 'license renewal', '2016-02-28 06:45:38', '0000-00-00 00:00:00'),
(3, 'vehicle registration', '2016-02-28 06:45:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionID` varchar(200) NOT NULL,
  `transactionType` varchar(200) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `date` varchar(200) NOT NULL,
  `priorityID` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `transactionType`, `name`, `address`, `date`, `priorityID`, `id`) VALUES
('Register_License_1', 'Register_License', 'rheageonzon', 'Basak', '02/14/2016', 1, 5),
('Register_License_2', 'Register_License', 'rheageonzon', 'Basak', '02/14/2016', 2, 5),
('Register_License_1', 'Register_License', 'rheageonzon', 'Basak', '02/14/2016', 1, 5),
('Register_License_2', 'Register_License', 'rheageonzon', 'Basak', '02/14/2016', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`counter_id`),
  ADD KEY `counter_id` (`counter_id`),
  ADD KEY `tellerID_fk` (`tellerID_fk`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `tbl_client_info`
--
ALTER TABLE `tbl_client_info`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_process_labels`
--
ALTER TABLE `tbl_process_labels`
  ADD PRIMARY KEY (`process_id`);

--
-- Indexes for table `tbl_queues`
--
ALTER TABLE `tbl_queues`
  ADD PRIMARY KEY (`queue_id`),
  ADD KEY `transactionID_fk` (`transactionID_fk`),
  ADD KEY `processID_fk` (`processID_fk`),
  ADD KEY `counterID_fk` (`counterID_fk`);

--
-- Indexes for table `tbl_tellers`
--
ALTER TABLE `tbl_tellers`
  ADD PRIMARY KEY (`teller_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `counter_id` (`counter_id`);

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`transactions_id`),
  ADD KEY `verfication_code` (`verification_code`),
  ADD KEY `clientID_fk` (`clientID_fk`);

--
-- Indexes for table `tbl_transaction_type_labels`
--
ALTER TABLE `tbl_transaction_type_labels`
  ADD PRIMARY KEY (`transaction_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `counter_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_client_info`
--
ALTER TABLE `tbl_client_info`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_process_labels`
--
ALTER TABLE `tbl_process_labels`
  MODIFY `process_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_queues`
--
ALTER TABLE `tbl_queues`
  MODIFY `queue_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tbl_tellers`
--
ALTER TABLE `tbl_tellers`
  MODIFY `teller_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `transactions_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12352;
--
-- AUTO_INCREMENT for table `tbl_transaction_type_labels`
--
ALTER TABLE `tbl_transaction_type_labels`
  MODIFY `transaction_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
