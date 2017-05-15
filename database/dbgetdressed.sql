-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 05, 2017 at 06:58 PM
-- Server version: 5.5.55-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbgetdressed`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_type` enum('Admin','Subadmin') COLLATE utf8_unicode_ci NOT NULL,
  `last_logout` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `is_deleted` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `admin_type`, `last_logout`, `status`, `is_deleted`, `created_by`, `updated_by`, `created_date`, `updated_date`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin', 'zqclA6IPm8pPoQZL-tMww3Z0zl6d_sTG', '$2y$13$R1c8rhVqGKq1fhHBaBYuVuEsXp61kxd4ppFuIfhB9QctBNpVL13nm', 'xdlvBl0B7gA0-wT5lbJhXKIoVFA39ogW_1493966831', 'admin@getdressed.com', 'Admin', '2017-05-03 13:29:29', 10, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-05 06:56:36', 1493717827, 1493966831),
(2, 'Gorakh', 'Wagh', 'gorakh', 'TLbTx7Pv3TZ9jkTQG8OQK_xBt4DlyRcf', '$2y$13$4jg162QuJoMAf4pJ2T0YGOuzd5qACTv8MbfQKxgCBHN3l18Yvt8ku', NULL, 'gorakh.w@edreamz.in', 'Admin', '2017-05-05 06:07:24', 10, 0, 1, 0, '2017-05-03 10:13:26', '2017-05-05 06:07:11', 0, 1493964412),
(3, 'Pradip', 'Pradhan', 'pradip', 'Z7X-5wCWPNWo3Pug7oOPQqKYkFifO62U', '$2y$13$dU7AYkEeNoIi8gp8e0qbk.8Zo2ZamD1NRwdj/pprpPhZ0GirysoY6', NULL, 'pradip.p@edreamz.in', 'Subadmin', '2017-05-03 13:05:42', 10, 0, 1, 2, '2017-05-03 11:18:16', '2017-05-03 12:15:00', 0, 0),
(4, 'Vijay', 'Badgujar', 'vijay', '5TmhNIARIKgEwdjYxKmNX2HfypiRDJpO', '$2y$13$7XIvN7pox3dEMSiRyU54..QhzC3TJi11bRh6PW6Ou7sd1UpjqAW9u', NULL, 'vijay.b@edreamz.in', 'Subadmin', '2017-05-03 13:29:54', 10, 0, 1, 0, '2017-05-03 13:29:10', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1493717459),
('m130524_201442_init', 1493717461);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'm06ZDqGiJ6M_K-lrQzwcs1CM3KBVMk6F', '$2y$13$bMr27SyvURFXQeb0N/noaOEcCG9eN59x.TOoBMsMuHpXLCHVVUPfe', NULL, 'admin@getdressed.com', 10, 1493717827, 1493717827);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
