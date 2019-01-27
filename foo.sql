-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: foo
-- ------------------------------------------------------
-- Server version	10.1.37-MariaDB-3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  `dateStamp` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (1,'The office is open today!','short description...','2019-01-01 10:30:00'),(2,'The office is closed today! :(','short description...','2019-02-02 10:30:00'),(3,'The office is burning down..','short description...','2019-04-04 10:30:00'),(4,'This is a test announcement, lets see how far this baby can stretch! YEAHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur erat eros, mattis at rhoncus in, rutrum vitae justo. Pellentesque faucibus felis ante, vitae scelerisque dolor ultrices sed. Fusce augue purus, mollis interdum augue quis, condimentum vari','2019-01-22 10:30:00');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boardContact`
--

DROP TABLE IF EXISTS `boardContact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boardContact` (
  `board_id` int(11) NOT NULL AUTO_INCREMENT,
  `board_name` tinytext NOT NULL,
  `board_position` tinytext NOT NULL,
  `board_company` tinytext NOT NULL,
  `board_type` tinytext NOT NULL,
  PRIMARY KEY (`board_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boardContact`
--

LOCK TABLES `boardContact` WRITE;
/*!40000 ALTER TABLE `boardContact` DISABLE KEYS */;
INSERT INTO `boardContact` VALUES (1,'Lynne Allan','EVP,COO','Greater Hudson Bank','Business'),(2,'Joe Allen','Senior Vice President','Active International','Business'),(3,'Robert Dutra','Labor Rep.','Sheet Metal Worker\'s Local 38 Craft Training Fund','Work Force'),(4,'Sr. Kathleem Sullivan','Chancellor','Dominican College','Other'),(5,'Howard Hellman','Chairman','All Bright Electric','Business'),(6,'Jeremy Schulman','President and CEO','Rockland Economic Development Corp.','Other'),(7,'Craig Jacobs','Training Director','I.B.E.W. Local Union 363','Work Force');
/*!40000 ALTER TABLE `boardContact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bocesContact`
--

DROP TABLE IF EXISTS `bocesContact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bocesContact` (
  `boces_id` int(11) NOT NULL AUTO_INCREMENT,
  `boces_name` tinytext NOT NULL,
  `boces_position` tinytext NOT NULL,
  `boces_email` tinytext NOT NULL,
  `boces_phone` varchar(12) NOT NULL,
  `boces_phoneTwo` varchar(12) DEFAULT NULL,
  `boces_ext` tinytext NOT NULL,
  PRIMARY KEY (`boces_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bocesContact`
--

LOCK TABLES `bocesContact` WRITE;
/*!40000 ALTER TABLE `bocesContact` DISABLE KEYS */;
INSERT INTO `bocesContact` VALUES (1,'Stephanie Compasso','Youth Services Coordinator','scompasso@rboces.org','845-348-3500',NULL,'3530'),(2,'Manuel Juarez','Youth Case Manager','mjuarez@rboces.org','845-348-3500',NULL,'3530');
/*!40000 ALTER TABLE `bocesContact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `careerCenterContact`
--

DROP TABLE IF EXISTS `careerCenterContact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `careerCenterContact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_name` tinytext NOT NULL,
  `contact_position` tinytext NOT NULL,
  `contact_email` tinytext NOT NULL,
  `contact_phone` varchar(12) NOT NULL,
  `contact_phoneTwo` varchar(12) DEFAULT NULL,
  `contact_ext` tinytext NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `careerCenterContact`
--

LOCK TABLES `careerCenterContact` WRITE;
/*!40000 ALTER TABLE `careerCenterContact` DISABLE KEYS */;
INSERT INTO `careerCenterContact` VALUES (1,'Egbert Shillingford','Director','eshillin@sunyrockland.edu','845-406-6450',NULL,'210'),(2,'Dorothy Damiani','Suffern Receptionist','ddamiani@sunyrockland.edu','845-406-6450',NULL,'201');
/*!40000 ALTER TABLE `careerCenterContact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employers`
--

DROP TABLE IF EXISTS `employers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employers` (
  `employer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `employer_company` tinytext NOT NULL,
  `employer_tax` varchar(30) NOT NULL,
  `employer_unemployNum` varchar(30) NOT NULL,
  `employer_web` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`employer_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `employers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employers`
--

LOCK TABLES `employers` WRITE;
/*!40000 ALTER TABLE `employers` DISABLE KEYS */;
INSERT INTO `employers` VALUES (1,2,'TeckoUSA','1231231231','1231231231','This employer has not shared a website.');
/*!40000 ALTER TABLE `employers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `description` longtext NOT NULL,
  `location` tinytext NOT NULL,
  `dateStamp` datetime NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  `type` tinytext NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Microsoft Word','This is a microsoft Word event','JERSEY','2018-11-14 00:00:00','2018-11-14 12:00:00','2018-11-14 14:00:00','engineering'),(2,'Microsoft Access','This is a microsoft Access event','HACKENSACK','2018-11-16 00:00:00','2018-11-16 12:00:00','2018-11-18 14:00:00','Math'),(3,'Microsoft Excell','This is a microsoft Excell event','MONROE','2018-11-16 00:00:00','2018-11-16 12:00:00','2018-11-18 14:00:00','Math'),(4,'Microsoft Excell','This is another microsoft Excell event','MONROE','2018-11-11 00:00:00','2018-11-11 12:00:00','2018-11-11 14:00:00','Math'),(5,'Matthews test workshop','This is a testing workshop will will be used for only testing purposes!','Monroe, NY','2018-12-01 00:00:00','2019-01-08 22:00:00','2019-01-09 22:00:00','IT'),(6,'Another testing workshop',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur erat eros, mattis at rhoncus in, rutrum vitae justo. Pellentesque faucibus felis ante, vitae scelerisque dolor ultrices sed. Fusce augue purus, mollis interdum augue quis, condimentum varius massa. Maecenas commodo vitae nisi quis scelerisque. Nulla at elementum felis. Pellentesque eu arcu at nisi tincidunt porta ac sit amet eros. In hac habitasse platea dictumst. Vivamus auctor lacinia tincidunt. Phasellus eget ex et nunc maximus dapibus nec in ligula. Proin ullamcorper nisi a placerat viverra. Etiam feugiat velit nec justo feugiat, sed ornare odio egestas. Pellentesque ut posuere lectus. Vestibulum sed venenatis magna.','MONROE NY','2019-01-11 10:30:00','2019-01-12 10:30:00','2019-01-12 14:00:00','IT'),(7,'Another testing workshopppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppp',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur erat eros, mattis at rhoncus in, rutrum vitae justo. Pellentesque faucibus felis ante, vitae scelerisque dolor ultrices sed. Fusce augue purus, mollis interdum augue quis, condimentum varius massa. Maecenas commodo vitae nisi quis scelerisque. Nulla at elementum felis. Pellentesque eu arcu at nisi tincidunt porta ac sit amet eros. In hac habitasse platea dictumst. Vivamus auctor lacinia tincidunt. Phasellus eget ex et nunc maximus dapibus nec in ligula. Proin ullamcorper nisi a placerat viverra. Etiam feugiat velit nec justo feugiat, sed ornare odio egestas. Pellentesque ut posuere lectus. Vestibulum sed venenatis magna.','MONROE NY','2019-01-11 10:30:00','2019-01-12 10:30:00','2019-01-12 14:00:00','IT');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `employer_id` int(11) NOT NULL,
  `job_title` tinytext NOT NULL,
  `job_description` longtext NOT NULL,
  `job_position` tinytext NOT NULL,
  `job_location` tinytext NOT NULL,
  `isMedical` tinytext,
  `isIT` tinytext,
  `isHealthcare` tinytext,
  `isBusiness` tinytext,
  `isFoodservice` tinytext,
  `isHospitality` tinytext,
  `isCulinary` tinytext,
  `dateStamp` datetime DEFAULT NULL,
  PRIMARY KEY (`job_id`),
  KEY `employer_id` (`employer_id`),
  CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`employer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,1,'Sr. Full Stack Developer','This is a description','Sr. Full Stack Developer','Monroe, NY','true','false','true','false','false','false','true',NULL);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laborContact`
--

DROP TABLE IF EXISTS `laborContact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laborContact` (
  `labor_id` int(11) NOT NULL AUTO_INCREMENT,
  `labor_name` tinytext NOT NULL,
  `labor_position` tinytext NOT NULL,
  `labor_email` tinytext NOT NULL,
  `labor_phone` varchar(12) NOT NULL,
  `labor_phoneTwo` varchar(12) DEFAULT NULL,
  `labor_ext` tinytext NOT NULL,
  PRIMARY KEY (`labor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laborContact`
--

LOCK TABLES `laborContact` WRITE;
/*!40000 ALTER TABLE `laborContact` DISABLE KEYS */;
INSERT INTO `laborContact` VALUES (1,'Sandra Brandes','Supervising Labor Services Representative','Sandra.Bandes@labor.ny.gov','845-406-6450',NULL,'114'),(2,'Elizabeth Martinez','Labor Services Representative','Elizabeth.Martinez@labor.ny.gov','845-406-6450',NULL,'117');
/*!40000 ALTER TABLE `laborContact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupations`
--

DROP TABLE IF EXISTS `occupations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occupations` (
  `user_id` int(11) NOT NULL,
  `medical` tinytext NOT NULL,
  `IT` tinytext NOT NULL,
  `healthcare` tinytext NOT NULL,
  `business` tinytext NOT NULL,
  `foodservice` tinytext NOT NULL,
  `hospitality` tinytext NOT NULL,
  `culinary` tinytext NOT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `occupations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupations`
--

LOCK TABLES `occupations` WRITE;
/*!40000 ALTER TABLE `occupations` DISABLE KEYS */;
INSERT INTO `occupations` VALUES (1,'false','false','false','false','false','false','false'),(2,'false','true','true','false','false','true','false'),(1,'true','false','false','true','true','false','true'),(2,'false','true','true','false','false','true','false');
/*!40000 ALTER TABLE `occupations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seekers`
--

DROP TABLE IF EXISTS `seekers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seekers` (
  `seeker_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_stateNum` int(11) DEFAULT NULL,
  PRIMARY KEY (`seeker_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `seekers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seekers`
--

LOCK TABLES `seekers` WRITE;
/*!40000 ALTER TABLE `seekers` DISABLE KEYS */;
INSERT INTO `seekers` VALUES (1,1,1231231231);
/*!40000 ALTER TABLE `seekers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_event`
--

DROP TABLE IF EXISTS `user_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_event` (
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  KEY `user_id` (`user_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `user_event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `user_event_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_event`
--

LOCK TABLES `user_event` WRITE;
/*!40000 ALTER TABLE `user_event` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_first` tinytext NOT NULL,
  `user_last` tinytext NOT NULL,
  `user_email` tinytext NOT NULL,
  `user_phone` varchar(11) NOT NULL,
  `user_uid` tinytext NOT NULL,
  `user_pw` longtext NOT NULL,
  `user_type` tinytext NOT NULL,
  `user_a3` tinytext,
  `user_a2` tinytext,
  `user_a1` tinytext,
  `user_q3` tinytext,
  `user_q2` tinytext,
  `user_q1` tinytext,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Matthew','Pecko','mpecko@sunyrockland.edu','18458260005','mpecko','$2y$10$rYtrgfORUzcAPyZ82bu7yeaSQnAcmkvlxkTV3vIGRdvsFB4QP52Du','user','blue3','blue2','blue1','what color is blue3','What is blue2','what color is blue1'),(2,'Johnny','Cage','jcage@gmail.com','11111111111','jcage123','$2y$10$7bVgH8cSpbJgsXz20XK/8uG3KFeP5uzbXH8WWGLlLyp37bUgU65qW','employer','blue3','blue2','blue','what color is blue3','what color is blue2','what color is blue');
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

-- Dump completed on 2019-01-26 22:09:43
