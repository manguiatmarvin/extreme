-- MySQL dump 10.15  Distrib 10.0.14-MariaDB, for Linux (i686)
--
-- Host: localhost    Database: edplayground
-- ------------------------------------------------------
-- Server version	10.0.14-MariaDB

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(175) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Rock'),(2,'Progressive Rock'),(3,'pop'),(4,'musical');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(75) NOT NULL,
  `desc` text NOT NULL,
  `thumbnail` varchar(125) NOT NULL,
  `image_file` varchar(125) NOT NULL,
  `uploaded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(175) NOT NULL,
  `desc` text NOT NULL,
  `runtime` varchar(50) NOT NULL,
  `embed_code` text NOT NULL,
  `video_src` varchar(500) NOT NULL,
  `video_path` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `uploaded` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (1,'Paul Gilbert','Paul Gilbert & Freddie Nelson - Let It Be (LIVE)','20:10','<video width=\"400\" controls>\r\n  <source \nsrc=\"http://xpedler.com/videos/serv/1\" type=\"video/mp4\">\r\n  Your browser does not support HTML5 video.\r\n</video>','http://173.45.66.115/serv/serv.php?id=1','/var/www/html/videos/2014/10/video_1.mp4','/img/thumbnails/vids/2014/10/sample320x200.png','2014-10-28 10:24:11','2014-09-23 00:00:00',1052),(2,'Paul Gilbert','From licklibrary.com another piece ','30:41','<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/zU_KoxFQd64\" \nframeborder=\"0\" allowfullscreen></iframe>','http://173.45.66.115/serv/serv.php?id=2','/var/www/html/videos/2014/10/video_2.mp4','/img/thumbnails/vids/2014/10/sample320x200.png','2014-02-02 04:10:11','2014-10-20 00:00:00',56),(3,'Paul Gilbert','Far Beyond The Sun played by Yngwie Malmsteen','6:00','<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/eK0rvReE-4c\" frameborder=\"0\" allowfullscreen></iframe>','/videos/2014/10/video_1.mp4','/var/www/html/videos/2014/10/video_1.mp4','/img/thumbnails/vids/2014/10/sample320x200-1.png','2014-09-28 04:10:11','0000-00-00 00:00:00',102),(4,'YNGWIE MALMSTEEN Live [HD] Black Star','YNGWIE MALMSTEEN Live [HD] Black Star','10:46','<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/QvMKsgVBzMo\" frameborder=\"0\" allowfullscreen></iframe>','/videos/2014/10/video_1.mp4','/var/www/html/videos/2014/10/video_1.mp4','/img/thumbnails/vids/2014/10/sample320x200-1.png','2014-10-20 00:00:00','2014-10-20 00:00:00',68),(5,'Steve Vai Tender Surrender full HD','2009 Where the Wild Things Are DVD','4:39','<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/_Tp7RHzm9x0\" frameborder=\"0\" allowfullscreen></iframe>','/videos/2014/10/video_1.mp4','/var/www/html/videos/2014/10/video_1.mp4','/img/thumbnails/vids/2014/10/sample320x200-3.png','2014-10-22 00:00:00','2014-10-20 00:00:00',13),(6,'Joe Satriani - Always With Me, Always With You (Live 2006)','Joe Satriani - Always With Me, Always','12:50','<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/b1DzRb4DHGw\" frameborder=\"0\" allowfullscreen></iframe>','/videos/2014/10/video_1.mp4','/var/www/html/videos/2014/10/video_1.mp4','/img/thumbnails/vids/2014/10/sample320x200-2.png','2014-10-24 04:14:17','2014-10-20 00:00:00',129);
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_category`
--

DROP TABLE IF EXISTS `video_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_category`
--

LOCK TABLES `video_category` WRITE;
/*!40000 ALTER TABLE `video_category` DISABLE KEYS */;
INSERT INTO `video_category` VALUES (1,1,1,'2014-10-21 00:00:00'),(2,1,2,'2014-10-21 00:00:00'),(3,1,4,'2014-10-08 00:00:00');
/*!40000 ALTER TABLE `video_category` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-03 17:58:23
