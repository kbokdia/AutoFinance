-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2014 at 03:02 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wayanad`
--
CREATE DATABASE IF NOT EXISTS `wayanad` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `wayanad`;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name_id` int(10) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_id` (`name_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name_id`, `mobile`, `email`, `password`) VALUES
(1, 1, '9444610605', 'kbokdia@gmail.com', 'kamlesh'),
(2, 2, '9566238612', 'poojabokdia@gmail.com', 'poojabokdia');

-- --------------------------------------------------------

--
-- Table structure for table `namelist`
--

CREATE TABLE IF NOT EXISTS `namelist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name_id` int(10) NOT NULL,
  `father_name_id` int(10) DEFAULT NULL,
  `house` varchar(50) NOT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `post_id` int(10) NOT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `vehicle_id` int(10) DEFAULT NULL,
  `member_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_name_id` (`name_id`),
  KEY `fk_father_name_id` (`father_name_id`),
  KEY `fk_post_id` (`post_id`),
  KEY `fk_vehicle_id` (`vehicle_id`),
  KEY `fk_member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

CREATE TABLE IF NOT EXISTS `names` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `names`
--

INSERT INTO `names` (`id`, `first_name`, `middle_name`, `last_name`) VALUES
(1, 'Kamlesh', '', 'Bokdia'),
(2, 'Naresh', NULL, 'Pincha'),
(6, 'Pooja', 'A', 'Bokdia');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `district` varchar(50) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `state` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `vehicle_no` varchar(50) NOT NULL,
  `model` varchar(5) DEFAULT NULL,
  `make` varchar(30) DEFAULT NULL,
  `engine_no` varchar(50) DEFAULT NULL,
  `chasis_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `fk_names` FOREIGN KEY (`name_id`) REFERENCES `names` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `namelist`
--
ALTER TABLE `namelist`
  ADD CONSTRAINT `fk_member_id` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `fk_father_name_id` FOREIGN KEY (`father_name_id`) REFERENCES `names` (`id`),
  ADD CONSTRAINT `fk_name_id` FOREIGN KEY (`name_id`) REFERENCES `names` (`id`),
  ADD CONSTRAINT `fk_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
