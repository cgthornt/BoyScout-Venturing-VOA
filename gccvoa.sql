-- MySQL dump 10.11
--
-- Host: 97.74.31.70    Database: gccvoa
-- ------------------------------------------------------
-- Server version	5.0.96-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachments` (
  `ID` int(32) unsigned NOT NULL auto_increment,
  `ID_USER` int(32) unsigned NOT NULL,
  `is_image` tinyint(1) NOT NULL,
  `filesize` int(8) unsigned NOT NULL,
  `filename` varchar(124) NOT NULL,
  `mime` varchar(40) NOT NULL,
  `width` int(4) unsigned NOT NULL,
  `height` int(4) unsigned NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crews`
--

DROP TABLE IF EXISTS `crews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crews` (
  `ID` int(16) unsigned NOT NULL auto_increment,
  `ID_OWNER` int(32) unsigned NOT NULL,
  `crew` int(4) unsigned NOT NULL,
  `zip` int(5) unsigned NOT NULL,
  `city` varchar(124) NOT NULL,
  `address` varchar(124) NOT NULL,
  `url` varchar(128) NOT NULL,
  `desc` text NOT NULL,
  `specialties` text NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Contains all of the data for the crews';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crews`
--

LOCK TABLES `crews` WRITE;
/*!40000 ALTER TABLE `crews` DISABLE KEYS */;
INSERT INTO `crews` VALUES (1,1,2040,85022,'Phoenix','','','This is our crew','Our interests are...');
/*!40000 ALTER TABLE `crews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `ID` int(32) unsigned NOT NULL auto_increment,
  `ID_CREW` int(16) unsigned NOT NULL,
  `ID_ATTACHMENT` int(32) unsigned NOT NULL,
  `title` varchar(128) NOT NULL,
  `desc` text NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `openings` int(5) NOT NULL,
  `zip` int(5) unsigned NOT NULL default '0',
  `address` varchar(255) NOT NULL,
  `sticky` tinyint(1) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Every event that''s posted';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (3,1,0,'Rifle Shooting','We have opportunities for people to go shotgun shooting on the weekend of the 16. Please call us at (602) 555-1455','rmdirbin@gmail.com','2010-02-16',3,85022,'',0),(4,0,0,'V.O.A. Meeting','Wild life Conservation in Arizona.\r\nSummer Activity\'s\r\nTesting you survivability in the wild.\r\n\r\nOver all planning for the year.','duane-p@cox.net','2010-04-13',4,0,'',1),(5,1,0,'Test','This is a test event','rmdirbin@gmail.com','2011-08-12',12,0,'',0);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_requests`
--

DROP TABLE IF EXISTS `events_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_requests` (
  `ID` int(16) NOT NULL auto_increment,
  `ID_USER` int(32) NOT NULL,
  `ID_EVENT` int(32) unsigned NOT NULL,
  `date_sent` datetime NOT NULL,
  `ip` varchar(40) NOT NULL,
  `title` varchar(124) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_requests`
--

LOCK TABLES `events_requests` WRITE;
/*!40000 ALTER TABLE `events_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `events_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `ID` int(64) unsigned NOT NULL auto_increment,
  `ID_USER` int(32) unsigned NOT NULL,
  `ID_TYPE` int(12) unsigned NOT NULL COMMENT 'The type, i.e. Critical, Notice, Warning, etc',
  `ID_EVENT` int(16) unsigned NOT NULL,
  `ip` varchar(30) NOT NULL,
  `details` varchar(30) NOT NULL,
  `timestamp` int(32) unsigned NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,1,1,1,'70.162.40.149','Login successfull',1265844014),(2,1,1,1,'70.162.40.149','Login successfull',1266959030),(3,1,1,1,'70.162.40.149','Login successfull',1266966622),(4,1,1,1,'70.162.40.149','Login successfull',1266967225),(5,1,1,1,'70.162.40.149','Login successfull',1266971167),(6,1,1,1,'70.162.40.149','Login successfull',1266987764),(7,5,1,1,'68.2.104.22','Login successfull',1268250620),(8,1,1,1,'216.138.124.75','Login successfull',1268671390),(9,1,1,1,'70.162.40.149','Login successfull',1270843274),(10,1,1,1,'70.162.40.149','Login successfull',1270849178),(11,0,3,1,'209.147.149.4','Login attempt failed with user',1301649847),(12,0,3,1,'209.147.149.4','Login attempt failed with user',1301649850),(13,0,3,1,'209.147.149.4','Login attempt failed with user',1301649853),(14,1,1,1,'209.147.149.4','Login successfull',1301649856);
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `ID` int(16) unsigned NOT NULL auto_increment,
  `ID_SUB` int(16) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_url` varchar(255) NOT NULL,
  `meta_desc` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_created` date NOT NULL,
  `date_edited` date NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `read_only` tinyint(1) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `title_url` (`title_url`),
  KEY `position` (`position`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (3,0,'Home','home','the home page','','<p>\r\n		Welcome to the Web site of the Grand Canyon Council Venturing Officers\' Association! Currently we are still in the\r\n		formation stages of the council VOA, so expect more content to appear as time goes on. For more information, check\r\n		out the About section.\r\n	</p>\r\n	\n	<h2>For those at the Jamborama</h2>\n	<p>\n		Please note that this Web site is developed during my spare time and is still undergoing testing, so there might be some\n		issues with the Web site. If you encounter any, please <a href=\"mailto:rmdirbin@gmail.com\">Email Me</a> and let me know\n		of any feedback or issues you might have encountered!\n	</p>\n\r\n	<h2>Project \"Venturing Connect\" (Under Development)</h2>\r\n\r\n	<p>\r\n		Ever canceled an activity due to a lack of participants? Or perhaps you\'re a crew looking for participants for an upcoming activity. With <em>Venturing Connect</em>, you can look for activities and crews within the Grand Canyon Council!\r\n	</p>\r\n	\r\n	<p>\r\n	With <em>Venturing Connect</em>, any crew can advertise their crew activity for <em>free</em>! Simply create an account and post an event. You can post as little or as much information as you want. You can upload a PDF or Word document with the details of your event, for all to see.\r\n	</p>\r\n\r\n	\r\n	<p>\r\n	Currently <em>Venturing Connect</em> is in the development stages. However, expect to see something in the next month.\r\n	</p>\r\n	\r\n	<h3>Privacy</h3>\r\n	<p>\r\n	This project will have privacy in mind; you can post as little or as much information as you want.\r\n	</p>   \n\n\n<script type=\"text/javascript\" src=\"http://static.ak.connect.facebook.com/connect.php/en_US\"></script><script type=\"text/javascript\">FB.init(\"6508f8c9bda60438e06f42f1ddb400cc\");</script><fb:fan profile_id=\"10150110736995043\" stream=\"0\" connections=\"0\" logobar=\"1\" width=\"300\"></fb:fan><div style=\"font-size:8px; padding-left:10px\"><a href=\"http://www.facebook.com/pages/Phoenix-AZ/Grand-Canyon-Council-VOA/10150110736995043\">Grand Canyon Council VOA</a> on Facebook</div>','2010-02-08','2010-02-08',1,1,1),(4,0,'About','about','About the Grand Canyon Council VOA and what we do, and everything you\'ve wanted to know about project Venturing Connect','','<p>\n	The Grand Canyon Council Venturing Officer\'s Association is a <em>youth-run</em> association of\n	venturing youth who plan and create events for venturing crews in the Grand Canyon Council. In the\n	Venturing handbook, the VOA was formerly called the <b>Teen Leader\'s Council</b>. \n</p>\n\n<p>\n	Currently we meet on the <b>second Tuesday of each month @ 7:00 pm</b> at the Grand Canyon Council office.\n	As we are in the forming stages of this association, <em>anyone is welcome to come</em>!\n</p>\n\n<h2>Venturing Connect BETA</h2>\n<p>\n	Currently under development is a Web site project written in PHP using the\n	<a href=\"http://www.yiiframework.com/\" target=\"_blank\" title=\"This stuff is advanced\">Yii Framework</a>. <em>Venturing Connect</em> is\n	like a Craigslist for Venturing events; crews can promote events, for example, if they don\'t have enough people to\n	make the trip happen.\n</p>\n\n<p>\n	With Venturing Connect, <b>you can reveal as little or as much information as you want!</b> You are not required to\n	post any addresses or telephone numbers, though it might be helpful if you do. The choice is yours.\n</p>\n\n<p>\n	Currently Venturing Connect is under <b>BETA</b> (meaning that it\'s currently testing and features will be added and\n	removed as time goes on). Feel free to create an account and test it out! Please send feedback to\n	<a href=\"mailto:cthornton10@brophybroncos.org\">cthornton10@brophybroncos.org</a>.\n</p>','2010-02-15','2010-02-08',2,0,1),(5,4,'Meetings','meetings','Information about our meetings','','<p>\n	We meet at the Grand Canyon Council office on the second Tuesday of each month\n	from 7:00 - 8:00 pm. All are welcome to attend and you do not have to be a crew \n	officer to attend.\n</p>\n<p>\n	Our next meeting is on <strong>April 13</strong>. \n</p>','2010-02-23','2010-02-23',3,0,0);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `ID` int(32) unsigned NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `salt` varchar(80) NOT NULL,
  `date_created` date NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `activation_hash` varchar(60) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'chris','','rmdirbin@gmail.com','','2010-02-08',1,'1219c1dd79c2645d10763761f07bd2d9',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-25 12:42:16
