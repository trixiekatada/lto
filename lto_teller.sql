-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2016 at 09:01 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lto_teller`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_client_info`
--

INSERT INTO `tbl_client_info` (`client_id`, `first_name`, `last_name`, `email`, `address`, `mobile`, `birth`, `gender`, `remember_token`, `client_type`, `created_at`, `updated_at`) VALUES
(9, 'Trixie', 'Olpoc', 'trixie@yahoo.com', 'cebu', '09173679136', '2012-01-02', 'Female', NULL, 0, '2016-02-29 03:02:17', '2016-02-29 03:02:17'),
(10, 'a', 'a', 'a@yahoo.com', 'a', '9867', '2012-01-02', 'Female', NULL, 0, '2016-02-29 03:03:11', '2016-02-29 03:03:11'),
(11, 'b', 'b', 'b@yahoo.com', 'b', '99', '0000-00-00', 'Female', NULL, 0, '2016-02-29 03:03:39', '2016-02-29 03:03:39'),
(12, 'C', 'CLCJLK', 'c@yahoo.com', 'cebu', '09173679136', '2012-01-02', 'Male', NULL, 2, '2016-02-29 11:16:59', '2016-02-29 11:16:59'),
(13, 'AAAA', 'AAA', 'trixie@yahoo.com', 'AAAAA', '3454354', '2012-01-02', 'Male', NULL, 1, '2016-03-02 04:56:49', '2016-03-02 04:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_process_labels`
--

CREATE TABLE IF NOT EXISTS `tbl_process_labels` (
`process_id` int(11) NOT NULL,
  `process_name` varchar(31) NOT NULL,
  `process_is_active` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'is process active? 0 - no 1 - yes',
  `process_parameter` enum('','') NOT NULL COMMENT 'what are the prerequisites for this proces?'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_process_labels`
--

INSERT INTO `tbl_process_labels` (`process_id`, `process_name`, `process_is_active`, `process_parameter`) VALUES
(1, 'Registration', 1, ''),
(2, 'Photo and Signature Capturing', 1, ''),
(3, 'Cashier', 1, ''),
(4, 'Approving', 1, ''),
(5, 'Receiving', 1, ''),
(6, 'releasing', 1, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tbl_queues`
--

INSERT INTO `tbl_queues` (`queue_id`, `queue_label`, `transactionID_fk`, `processID_fk`, `counterID_fk`, `updated_at`, `created_at`, `status`) VALUES
(29, 6, 12353, 5, 5, '2016-03-01 08:54:26', '2016-02-29 03:05:43', 0),
(30, 7, 12354, 5, 5, '2016-03-01 08:55:47', '2016-02-29 03:07:01', 0),
(31, 8, 12355, 3, 3, '2016-03-02 05:01:14', '2016-02-29 03:07:17', 0),
(32, 9, 12356, 3, 3, '2016-03-03 07:31:32', '2016-02-29 11:18:23', 0),
(33, 7, 12357, 3, 3, '2016-03-03 07:32:56', '2016-03-02 04:58:01', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_tellers`
--

INSERT INTO `tbl_tellers` (`teller_id`, `counter_id`, `firstname`, `lastname`, `email`, `address`, `mobile`, `birth`, `gender`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(10, 2, 'fadfasdf', 'afasfa', 'afafa@yahoo.com', 'asfasdf', '123456', '0000-00-00', 'afasfa', '$2y$10$wKQPJUfXJb2kwPjN6i8/k.HcsjcDLwuxSXr0DH9OBnIDR3M5KLXmO', NULL, '2016-02-25 00:42:21', '2016-02-25 00:42:21'),
(11, 1, 'Claire', 'Dela vina', 'claire@yahoo.com', 'cebu city', '43545435', '0000-00-00', 'Female', '$2y$10$OWKOVN.NIruD1C4ldwYZu.tC/XmyZsE8L8GDV4K7aaO1nYvuaZ6Z6', NULL, '2016-02-29 02:55:59', '2016-02-29 02:55:59'),
(12, 3, 'Oxy', 'Olpoc', 'oxy@yahoo.com', 'inayagan', '43545435', '0000-00-00', 'Female', '$2y$10$LKrq66gd5JhlilEWLEsJT.rNgun75fq5BSQJw64lNmJQ9O8nRfpnm', NULL, '2016-02-29 02:56:41', '2016-02-29 02:56:41'),
(13, 4, 'Angelica', 'Capucao', 'angelica@yahoo.com', 'cebu city', '09173679136', '2001-11-11', 'Female', '$2y$10$xLxGGMa1m/kpNUK2Oamv8..ohsV0jVSRPtohI7.Q14PRLahbslW2i', NULL, '2016-02-29 02:57:35', '2016-02-29 02:57:35'),
(14, 5, 'Inee Geneca', 'Abastas', 'inee@yahoo.com', 'inayagan', '0814432487', '1999-10-10', 'Female', '$2y$10$3K1KSzBLLRl7HJt0HIDIrO6ZnpIQYbPPrfF0HvXMb/ceL053.rhvy', NULL, '2016-02-29 02:58:25', '2016-02-29 02:58:25'),
(15, 6, 'Chyme', 'Yap', 'chyme@yahoo.com', 'Carcar', '09173679136', '2017-12-12', 'Female', '$2y$10$JoWFV3t45g/wY.g2LvQ65e/KnsyCE7SOw7Y5HLI7PUeGfoHtW.kLq', NULL, '2016-02-29 02:59:35', '2016-02-29 02:59:35');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12358 ;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`transactions_id`, `verification_code`, `clientID_fk`, `transaction_type`, `created_at`, `updated_at`) VALUES
(1234, '12345', 1, 1, '2016-02-28 09:27:54', '0000-00-00 00:00:00'),
(12353, '49034', 9, 2, '2016-02-29 03:02:17', '2016-02-29 03:02:17'),
(12354, '987100', 10, 3, '2016-02-29 03:03:11', '2016-02-29 03:03:11'),
(12355, '755703', 11, 2, '2016-02-29 03:03:39', '2016-02-29 03:03:39'),
(12356, '70998', 12, 2, '2016-02-29 11:16:59', '2016-02-29 11:16:59'),
(12357, '77997', 13, 3, '2016-03-02 04:56:49', '2016-03-02 04:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_type_labels`
--

CREATE TABLE IF NOT EXISTS `tbl_transaction_type_labels` (
`transaction_type_id` int(11) NOT NULL,
  `transaction_type_name` varchar(31) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
 ADD PRIMARY KEY (`counter_id`), ADD KEY `counter_id` (`counter_id`), ADD KEY `tellerID_fk` (`tellerID_fk`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

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
 ADD PRIMARY KEY (`queue_id`), ADD KEY `transactionID_fk` (`transactionID_fk`), ADD KEY `processID_fk` (`processID_fk`), ADD KEY `counterID_fk` (`counterID_fk`);

--
-- Indexes for table `tbl_tellers`
--
ALTER TABLE `tbl_tellers`
 ADD PRIMARY KEY (`teller_id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD KEY `counter_id` (`counter_id`);

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
 ADD PRIMARY KEY (`transactions_id`), ADD KEY `verfication_code` (`verification_code`), ADD KEY `clientID_fk` (`clientID_fk`);

--
-- Indexes for table `tbl_transaction_type_labels`
--
ALTER TABLE `tbl_transaction_type_labels`
 ADD PRIMARY KEY (`transaction_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

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
MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_process_labels`
--
ALTER TABLE `tbl_process_labels`
MODIFY `process_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_queues`
--
ALTER TABLE `tbl_queues`
MODIFY `queue_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tbl_tellers`
--
ALTER TABLE `tbl_tellers`
MODIFY `teller_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
MODIFY `transactions_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12358;
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
