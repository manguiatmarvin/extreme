-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 18, 2014 at 05:29 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1-log
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `edplayground`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(175) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Rock'),
(2, 'Progressive Rock'),
(3, 'pop'),
(4, 'musical');

-- --------------------------------------------------------

--
-- Table structure for table `encodingJobs`
--

CREATE TABLE IF NOT EXISTS `encodingJobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `source` text NOT NULL,
  `destination` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `command` text NOT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `encodingJobs`
--

INSERT INTO `encodingJobs` (`job_id`, `video_id`, `source`, `destination`, `status`, `created`, `command`) VALUES
(1, 0, '/var/www/videos/2014/10/video_1.mp4', '/var/www/videos/2014/10/video_1encoded.mp4', 'completed', '2014-11-17 00:00:00', 'ffmpeg -i /var/www/videos/2014/10/video_1.mp4 /var/www/videos/2014/10/video_1encoded.flv'),
(2, 0, '/var/www/videos/2014/10/video_2.mp4', '/var/www/videos/2014/10/video_2encoded.flv', 'completed', '2014-11-17 00:00:00', 'ffmpeg -i /var/www/videos/2014/10/video_2.mp4 /var/www/videos/2014/10/video_2encoded.flv'),
(18, 25, '/var/www/videos/2014/11/video_546a63bbc88d2.mp4', '/var/www/videos/2014/11/video_546a63bbc88d2.mp4.mp4', 'completed', '2014-11-18 05:08:11', ''),
(19, 26, '/var/www/videos/2014/11/video_546a641666891.mp4', '/var/www/videos/2014/11/video_546a641666891.mp4.mp4', 'completed', '2014-11-18 05:09:42', ''),
(20, 27, '/var/www/videos/2014/11/video_546a65b17e18f.mp4', '/var/www/videos/2014/11/video_546a65b17e18f.mp4.mp4', 'completed', '2014-11-18 05:16:33', ''),
(21, 28, '/var/www/videos/2014/11/video_546a6651846da.mp4', '/var/www/videos/2014/11/video_546a6651846da.mp4.mp4', 'completed', '2014-11-18 05:19:13', ''),
(22, 29, '/var/www/videos/2014/11/video_546a671abc249.mp4', '/var/www/videos/2014/11/video_546a671abc249.mp4.mp4', 'completed', '2014-11-18 05:22:34', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(75) NOT NULL,
  `desc` text NOT NULL,
  `thumbnail` varchar(125) NOT NULL,
  `image_file` varchar(125) NOT NULL,
  `uploaded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `pass_word` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `pass_word`, `email`, `role`) VALUES
(11, 'mmanguiat', 'secret123', 'marvin.manguiat@sourcefit.com', 'admin'),
(12, 'jsalillas', 'secret123', 'jayson.salillas@sourcefit.com', 'employee'),
(13, 'edelacruz', 'secret123', 'edgar.delacruz@sourcefit.com', 'manager'),
(14, 'peterdinklage', 'secret123', 'peterdinklage@yahoo.com', 'admin'),
(15, 'nikolacosterwaldau', 'secret123', 'nikolacosterwaldau@yahoo.com', 'employee'),
(16, 'lenaheadey', 'secret123', 'lenaheadey@gmail.com', 'employee'),
(17, 'isaachempstead', 'secret123', 'isaachempstead@gmail.com', 'manager'),
(18, 'client1', 'secret123', 'client1.e62014@gmail.com', 'client'),
(19, 'client2', 'secret123', 'client2.e62014@gmail.com', 'client');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(175) DEFAULT NULL,
  `desc` text,
  `category_id` varchar(3) DEFAULT NULL,
  `runtime` varchar(50) DEFAULT NULL,
  `embed_code` text,
  `video_src` varchar(500) DEFAULT NULL,
  `video_path` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `uploaded` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `likes` int(11) DEFAULT '0',
  `dislikes` int(11) DEFAULT '0',
  `publish` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `title`, `desc`, `category_id`, `runtime`, `embed_code`, `video_src`, `video_path`, `thumbnail`, `uploaded`, `modified`, `views`, `likes`, `dislikes`, `publish`) VALUES
(1, 'Paul Gilbert', 'Paul Gilbert & Freddie Nelson - Let It Be (LIVE)', '3', '20:10', NULL, 'http://173.45.66.115/serv/serv.php?id=1', '/videos/2014/10/video_1.mp4', '/img/thumbnails/vids/2014/10/sample320x200.png', '2014-10-28 10:24:11', '2014-09-23 00:00:00', 1061, 12, 10, 1),
(2, 'Paul red guitar', 'Paul playing red ibanez', '4', '30:41', NULL, 'http://173.45.66.115/serv/serv.php?id=2', '/videos/2014/10/video_2.mp4', '/img/thumbnails/vids/2014/10/sample320x200.png', '2014-02-02 04:10:11', '2014-10-20 00:00:00', 101, 15, 6, 1),
(6, 'Joe Satriani - Always With Me, Always With You (Live 2006)', 'Joe Satriani - Always With Me, Always', '3', '12:50', NULL, 'http://173.45.66.115/serv/serv.php?id=1', '/videos/2014/10/video_1.mp4', '/img/thumbnails/vids/2014/10/sample320x200-2.png', '2014-10-24 04:14:17', '2014-10-20 00:00:00', 133, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `video_category`
--

CREATE TABLE IF NOT EXISTS `video_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `video_category`
--

INSERT INTO `video_category` (`id`, `video_id`, `category_id`, `date`) VALUES
(1, 1, 1, '2014-10-21 00:00:00'),
(2, 1, 2, '2014-10-21 00:00:00'),
(3, 1, 4, '2014-10-08 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;