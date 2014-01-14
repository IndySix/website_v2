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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Table structure for table `LevelHistory`
--

CREATE TABLE IF NOT EXISTS `LevelHistory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `level_completed` tinyint(1) DEFAULT NULL,
  `video_name` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `score` int(100) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Table structure for table `LevelParts`
--

CREATE TABLE IF NOT EXISTS `LevelParts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Table structure for table `Levels`
--

CREATE TABLE IF NOT EXISTS `Levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_description` text NOT NULL,
  `difficulty` int(11) DEFAULT NULL,
  `part` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `one_star_score` int(11) NOT NULL,
  `two_star_score` int(11) NOT NULL,
  `three__star_score` int(11) NOT NULL,
  `four__star_score` int(11) NOT NULL,
  `targetScore` text NOT NULL,
  `playTime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
-- Table structure for table `PartQueue`
--

CREATE TABLE IF NOT EXISTS `PartQueue` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `part_id` int(10) NOT NULL,
  `level_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `queueStartTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `playing` int(1) NOT NULL DEFAULT '0',
  `playStartTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;