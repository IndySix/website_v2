-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2013 at 12:51 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `indysix_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Videos`
--

CREATE TABLE `Videos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `completed` tinyint(1) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Videos`
--

INSERT INTO `Videos` (`id`, `user`, `path`, `completed`, `level`, `thumbnail`) VALUES
(1, 25, '/videos/1.mp4', 0, 1, 'http://placehold.it/300x100'),
(2, 26, '/videos/2.mp4', 1, 3, 'http://placehold.it/300x100'),
(3, 25, '/videos/2.mp4', 1, 2, 'http://placehold.it/300x100'),
(4, 26, '/videos/2.mp4', 1, 1, 'http://placehold.it/300x100');
