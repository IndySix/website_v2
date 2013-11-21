-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2013 at 07:30 
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
  `avatar` varchar(32) NOT NULL DEFAULT 'noavatar.jpg',
  `difficulty` varchar(64) DEFAULT 'Rookie',
  `place` varchar(128) NOT NULL,
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `gender` char(1) NOT NULL,
  `aboutMe` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `username`, `password`, `email`, `validEmail`, `level`, `blocked`, `registrationDate`, `avatar`, `difficulty`, `place`, `birthday`, `gender`, `aboutMe`) VALUES
(25, 'krukas', 'f079eff2bd6c354e8896d713d3d9ff0fb6413165ba04f6fea38a153c0772a653c37bc5604314368f7b7c72cb89687b80c867f76ed636bbc2fe3b16a7f238c0a15dd4f273', 'test123@test.nl', 1, 0, 0, '2013-11-17 17:18:28', 'noavatar.jpg', 'Rookie', 'Utrecht', '1992-11-13', 'm', 'Somthing about me');

--
-- Table structure for table `Friends`
--

CREATE TABLE IF NOT EXISTS `Friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `friendSince` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `request` int(1) NOT NULL DEFAULT '1',
  `requestDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accepted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;