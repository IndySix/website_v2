-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2013 at 06:09 
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `indysix_2`
--
CREATE DATABASE IF NOT EXISTS `indysix_2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `indysix_2`;

-- --------------------------------------------------------

--
-- Table structure for table `LoginSession`
--

CREATE TABLE IF NOT EXISTS `LoginSession` (
  `username` varchar(32) NOT NULL,
  `token` varchar(136) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `loginDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`,`token`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LoginSession`
--

INSERT INTO `LoginSession` (`username`, `token`, `ip`, `loginDate`) VALUES
('maikel', 'b7043f3890d1af320af14230a52dcd548026a726e7010dab7c923233dc304f29b0c159fa1f3c45bb9274f8cfae805b907113a8e89a6f238457dbe49b1dab002417a6ee6e', '127.0.0.1', '2013-11-17 17:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `Tokens`
--

CREATE TABLE IF NOT EXISTS `Tokens` (
  `token` varchar(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(16) NOT NULL,
  PRIMARY KEY (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(136) NOT NULL,
  `email` varchar(255) NOT NULL,
  `validEmail` int(1) NOT NULL DEFAULT '0',
  `level` int(11) DEFAULT '0',
  `blocked` int(1) NOT NULL DEFAULT '0',
  `registrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(32) NOT NULL DEFAULT 'noAvatar.jpg',
  `difficulty` varchar(64) DEFAULT 'Rookie',
  `woonplaats` varchar(128) NOT NULL,
  `geboortedatum` date NOT NULL DEFAULT '0000-00-00',
  `geslaccht` char(1) NOT NULL,
  `aboutMe` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
