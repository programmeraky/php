-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2018 at 02:50 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `usersdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `thumb_image_name` varchar(255) NOT NULL,
  `image_create_date` datetime NOT NULL,
  `image_update` datetime NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `user_id`, `image_name`, `thumb_image_name`, `image_create_date`, `image_update`) VALUES
(12, 4, 'ABC5b1b02852bb26.jpg', 'ABC5b1b02852bb26.jpg', '2018-06-09 03:56:13', '2018-06-09 03:56:13'),
(13, 4, 'WhatsApp-DP-for-Girls-1185b1b02853948c.jpg', 'WhatsApp-DP-for-Girls-1185b1b02853948c.jpg', '2018-06-09 03:56:13', '2018-06-09 03:56:13'),
(29, 5, '5149815-beautiful-wallpaper-hd5b1b194c4c292.jpg', '5149815-beautiful-wallpaper-hd5b1b194c4c292.jpg', '2018-06-09 05:33:24', '2018-06-09 05:33:24'),
(30, 5, 'plant-flower-bloom-367645b1b194c64b4e.jpg', 'plant-flower-bloom-367645b1b194c64b4e.jpg', '2018-06-09 05:33:24', '2018-06-09 05:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE IF NOT EXISTS `interest` (
  `interest_id` int(11) NOT NULL AUTO_INCREMENT,
  `interest_name` varchar(50) NOT NULL,
  `interest_create_date` datetime NOT NULL,
  `interest_update` datetime NOT NULL,
  PRIMARY KEY (`interest_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`interest_id`, `interest_name`, `interest_create_date`, `interest_update`) VALUES
(1, 'Development', '2018-06-01 09:12:16', '0000-00-00 00:00:00'),
(2, 'Designing', '2018-06-01 09:12:16', '2018-06-01 12:00:00'),
(3, 'Marketing', '2018-06-01 15:08:07', '0000-00-00 00:00:00'),
(4, 'Business', '2018-06-01 14:17:08', '2018-06-01 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_gender` enum('Male','Female') NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_job_role_id` int(11) NOT NULL,
  `user_create_date` datetime NOT NULL,
  `user_update` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_name`, `user_email`, `user_gender`, `user_password`, `user_job_role_id`, `user_create_date`, `user_update`) VALUES
(4, 'test', 'p@gmail.com', 'Male', '147258', 5, '2018-06-09 00:00:00', '2018-06-09 03:56:13'),
(5, 'prachi', 'p@gmail.com', 'Female', '123456', 4, '2018-06-09 00:00:00', '2018-06-09 05:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_interest`
--

CREATE TABLE IF NOT EXISTS `user_interest` (
  `user_interest_id` int(11) NOT NULL AUTO_INCREMENT,
  `interest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_interest_create_date` datetime NOT NULL,
  `user_interest_update` datetime NOT NULL,
  PRIMARY KEY (`user_interest_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `user_interest`
--

INSERT INTO `user_interest` (`user_interest_id`, `interest_id`, `user_id`, `user_interest_create_date`, `user_interest_update`) VALUES
(4, 1, 1, '2018-06-09 03:52:09', '2018-06-09 03:52:09'),
(5, 2, 1, '2018-06-09 03:52:09', '2018-06-09 03:52:09'),
(6, 3, 2, '2018-06-09 03:52:52', '2018-06-09 03:52:52'),
(7, 4, 2, '2018-06-09 03:52:52', '2018-06-09 03:52:52'),
(10, 2, 3, '2018-06-09 03:54:48', '2018-06-09 03:54:48'),
(11, 3, 3, '2018-06-09 03:54:48', '2018-06-09 03:54:48'),
(14, 3, 4, '2018-06-09 03:56:13', '2018-06-09 03:56:13'),
(15, 4, 4, '2018-06-09 03:56:13', '2018-06-09 03:56:13'),
(39, 2, 5, '2018-06-09 05:33:24', '2018-06-09 05:33:24'),
(40, 3, 5, '2018-06-09 05:33:24', '2018-06-09 05:33:24'),
(41, 4, 5, '2018-06-09 05:33:24', '2018-06-09 05:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_job_role`
--

CREATE TABLE IF NOT EXISTS `user_job_role` (
  `user_job_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_field_name` varchar(50) NOT NULL,
  `user_field_value` varchar(50) NOT NULL,
  `user_job_role_create_date` datetime NOT NULL,
  `user_job_role_update` datetime NOT NULL,
  PRIMARY KEY (`user_job_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_job_role`
--

INSERT INTO `user_job_role` (`user_job_role_id`, `user_field_name`, `user_field_value`, `user_job_role_create_date`, `user_job_role_update`) VALUES
(1, 'Front End Developer', 'front_end_developer', '2018-05-29 12:41:08', '2018-05-29 22:08:00'),
(2, 'Back End Developer', 'back_end_developer', '2018-05-22 04:37:32', '2018-05-29 22:08:00'),
(3, 'Tester', 'tester', '2018-05-29 12:41:08', '2018-05-29 22:08:00'),
(4, 'Designer', 'designer', '2018-05-29 10:06:00', '0000-00-00 00:00:00'),
(5, 'Analyst', 'analyst', '2018-05-29 00:00:00', '2018-05-29 22:08:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
