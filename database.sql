# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.29)
# Database: indysix_2
# Generation Time: 2013-11-27 09:45:11 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table LevelParts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `LevelParts`;

CREATE TABLE `LevelParts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `LevelParts` WRITE;
/*!40000 ALTER TABLE `LevelParts` DISABLE KEYS */;

INSERT INTO `LevelParts` (`id`, `description`, `image`)
VALUES
	(1,'Grindrail','/parts/grindrail.jpg'),
	(2,'Quarterpipe','/parts/quarterpipe.jpg'),
	(3,'Halfpipe','/parts/halfpipe.jpg');

/*!40000 ALTER TABLE `LevelParts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Levels
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Levels`;

CREATE TABLE `Levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_description` text NOT NULL,
  `difficulty` int(11) DEFAULT NULL,
  `part` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Levels` WRITE;
/*!40000 ALTER TABLE `Levels` DISABLE KEYS */;

INSERT INTO `Levels` (`id`, `level_description`, `difficulty`, `part`, `order`)
VALUES
	(1,'25cm grinden',1,1,1),
	(2,'50cm grinden',2,1,2),
	(3,'25cm hoog los van de pipe',1,2,1),
	(4,'50cm hoog los van de pipe',2,2,2),
	(5,'10x heen en weer op de halfpipe',1,3,1),
	(6,'20x heen en weer op de halfpipe',2,3,2);

/*!40000 ALTER TABLE `Levels` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table LoginSession
# ------------------------------------------------------------

DROP TABLE IF EXISTS `LoginSession`;

CREATE TABLE `LoginSession` (
  `username` varchar(32) NOT NULL,
  `token` varchar(136) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `loginDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`,`token`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `LoginSession` WRITE;
/*!40000 ALTER TABLE `LoginSession` DISABLE KEYS */;

INSERT INTO `LoginSession` (`username`, `token`, `ip`, `loginDate`)
VALUES
	('krukas','f079eff22878ad1d00cc2feb752b4b37642039a86f5ba5149971bb999b927a30100f09bc5bdd7f72fc6786040ed62dbb221a07a67e4f5529d458076daba6b735abacc5b9','::1','2013-11-18 12:49:35'),
	('krukas','f079eff2651c482c88869a8db1de06d69f3a84d50ac426678832314f445bcad3e5d212d02f31ccad2496d94265bd7f4d9c7e6e26f4185b6c2296b0c6a6ba4b360a0379bf','::1','2013-11-18 12:50:25'),
	('krukas','f079eff277c1458e14f185ecf06d6d01b50f17bdc6224045e3b192df008c48d4b4971cee4dc3434277c02c308ce6f893f217954e6b4c3298f4d139fac6a866d0434b071e','::1','2013-11-18 13:45:05'),
	('krukas','f079eff21a78e70824588c8de6d4eaf766e9a6689b7859ddec622c867daef33e342689f1fd5bb7180e9bd702e983da5f70d651532019c2a480214f9dbb901df8fab322ae','127.0.0.1','2013-11-18 13:48:20'),
	('krukas','f079eff208b9b74ce00085f39c2abd365c250e0860960eae095de999e33542c90af1553a456a619e1e9a5e29b5ea798341e3b6ed4f8c82257378f8555bd22b1dd6b32409','127.0.0.1','2013-11-18 13:59:16'),
	('krukas','f079eff2600e752de92762361fa254b6937de005391f02c5ab358f8e0f85e1fccbb35aeb2218abb0834116ac5f3c8b59474e0007dd8057a4663852b6d8c739811e4a2cf7','127.0.0.1','2013-11-19 12:28:56'),
	('krukas','f079eff2e1297e33debca035585cb95b11f29fb7133c707f1d68a2c9a70b7c35d691e3c025d436f119337acb8fe1ea9858380315dba0cd2f6b8f8822528d1f634574b5a9','127.0.0.1','2013-11-21 10:49:02'),
	('krukas','f079eff263bc0043c18baf35811daa4ac6fab4a244b7252c9cc817735de575fbecbd2c47642d9ddab93cee3eeb7c50af63e9b5d879dade76ddbf5e3edad5cfaf3f68c78c','127.0.0.1','2013-11-22 09:02:24'),
	('krukas','f079eff275441e36c34a237088ce8dea75baf21c3da2cb4bea6350dd3b211a822e3ec32846ba5a2b26bd7cc17fee8c3b4007b83003417bdbeb51d415af0b914735d42ab2','127.0.0.1','2013-11-22 09:15:35'),
	('joost','7b4b448479d76876add55cdead33994ba12a1cc06531387e9496e1ab5e6ba86e215e3e20ba1712c7687e9d9fe920212ed0890711de98f2b4a8b969e6fe1991e40cf9b5e9','127.0.0.1','2013-11-22 11:15:53'),
	('krukas','f079eff257fa00cff01401dc0d7c06bbc1b7a3075059ddfdd771c4773c3664dbc9238672bc6684dc55742b9651cf971f14183fb39d1486bf892491d31e6a423733d5a630','::1','2013-11-25 10:01:55'),
	('krukas','f079eff254f40b8d0dd6af7aab257e9ed4c66145bea1e80077248413f82fc9088149cffb974f77e46b3bea34e213139f545bea110fcc41e8a3489d5ed73b1dc18c53ac1a','::1','2013-11-26 22:41:02');

/*!40000 ALTER TABLE `LoginSession` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Tokens`;

CREATE TABLE `Tokens` (
  `token` varchar(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(16) NOT NULL,
  PRIMARY KEY (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `Tokens` WRITE;
/*!40000 ALTER TABLE `Tokens` DISABLE KEYS */;

INSERT INTO `Tokens` (`token`, `user_id`, `createDate`, `type`)
VALUES
	('ccOADNE8FnJL6Z2m3IJ2UGwY9Z6J0cb3',26,'2013-11-22 11:15:53','mail');

/*!40000 ALTER TABLE `Tokens` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;

INSERT INTO `Users` (`id`, `username`, `password`, `email`, `validEmail`, `level`, `blocked`, `registrationDate`, `avatar`, `difficulty`, `place`, `birthday`, `gender`, `aboutMe`)
VALUES
	(25,'krukas','f079eff2bd6c354e8896d713d3d9ff0fb6413165ba04f6fea38a153c0772a653c37bc5604314368f7b7c72cb89687b80c867f76ed636bbc2fe3b16a7f238c0a15dd4f273','test123@test.nl',1,0,0,'2013-11-17 18:18:28','noavatar.jpg','Rookie','Utrecht','1992-11-13','m','Somthing about me'),
	(26,'joost','89ad5ca43e8ebf15f11b3a9e9f1b369a0db0baffa4a8e1f110de4b58960b2ca1b39ded92be43c484e756618b74721c282149f4cca8a8c924d724d85713d2d43f784452c8','jsplattel@gmail.com',0,0,0,'2013-11-22 11:15:53','noavatar.jpg','Easy','','0000-00-00','m','');

/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table levelHistory
# ------------------------------------------------------------

DROP TABLE IF EXISTS `levelHistory`;

CREATE TABLE `levelHistory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `level_completed` tinyint(1) DEFAULT NULL,
  `video_name` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `score` int(100) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `levelHistory` WRITE;
/*!40000 ALTER TABLE `levelHistory` DISABLE KEYS */;

INSERT INTO `levelHistory` (`id`, `user_id`, `level_id`, `level_completed`, `video_name`, `timestamp`, `score`, `data`)
VALUES
	(1,25,1,0,'3123123','2013-11-27 10:37:13',0,NULL),
	(2,26,3,1,'3123131','2013-11-27 10:37:16',100,NULL),
	(3,25,2,1,'3213123','2013-11-27 10:37:18',120,NULL),
	(4,26,1,1,'3213221','2013-11-27 10:37:21',123,NULL);

/*!40000 ALTER TABLE `levelHistory` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
