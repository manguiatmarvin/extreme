-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2014 at 03:46 PM
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
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(175) NOT NULL,
  `desc` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `runtime` varchar(50) NOT NULL,
  `embed_code` text,
  `video_src` varchar(500) NOT NULL,
  `video_path` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `uploaded` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `title`, `desc`, `category_id`, `runtime`, `embed_code`, `video_src`, `video_path`, `thumbnail`, `uploaded`, `modified`, `views`) VALUES
(1, 'Paul Gilbert', 'Paul Gilbert & Freddie Nelson - Let It Be (LIVE)', 3, '20:10', '<video width="400" controls>\r\n  <source src="http://xpedler.com/videos/serv/1" type="video/mp4">\r\n  Your browser does not support HTML5 video.\r\n</video>', 'http://173.45.66.115/serv/serv.php?id=1', '/home/marvin/Documents/vhost/marvin.extreme.com/data/videos/2014/10/video_1.mp4', '/img/thumbnails/vids/2014/10/sample320x200.png', '2014-10-28 10:24:11', '2014-09-23 00:00:00', 1042),
(2, 'Paul Gilbert', 'From licklibrary.com another piece ', 2, '30:41', '<iframe width="560" height="315" src="//www.youtube.com/embed/zU_KoxFQd64" frameborder="0" allowfullscreen></iframe>', 'http://173.45.66.115/serv/serv.php?vid=2', '/home/marvin/Documents/vhost/marvin.extreme.com/data/videos/2014/10/video_2.mp4', '/img/thumbnails/vids/2014/10/sample320x200.png', '2014-02-02 04:10:11', '2014-10-20 00:00:00', 52),
(3, 'Paul Gilbert', 'Far Beyond The Sun played by Yngwie Malmsteen', 1, '6:00', '<iframe width="420" height="315" src="//www.youtube.com/embed/eK0rvReE-4c" frameborder="0" allowfullscreen></iframe>', '/videos/2014/10/video_1.mp4', '', '/img/thumbnails/vids/2014/10/sample320x200-1.png', '2014-09-28 04:10:11', '0000-00-00 00:00:00', 103),
(4, 'YNGWIE MALMSTEEN Live [HD] Black Star', 'YNGWIE MALMSTEEN Live [HD] Black Star', 3, '10:46', '<iframe width="420" height="315" src="//www.youtube.com/embed/QvMKsgVBzMo" frameborder="0" allowfullscreen></iframe>', '/videos/2014/10/video_1.mp4', '', '/img/thumbnails/vids/2014/10/sample320x200-1.png', '2014-10-20 00:00:00', '2014-10-20 00:00:00', 65),
(5, 'Steve Vai Tender Surrender full HD', '2009 Where the Wild Things Are DVD', 3, '4:39', '<iframe width="560" height="315" src="//www.youtube.com/embed/_Tp7RHzm9x0" frameborder="0" allowfullscreen></iframe>', '/videos/2014/10/video_1.mp4', '', '/img/thumbnails/vids/2014/10/sample320x200-3.png', '2014-10-22 00:00:00', '2014-10-20 00:00:00', 12),
(6, 'Joe Satriani - Always With Me, Always With You (Live 2006)', 'Joe Satriani - Always With Me, Always', 3, '12:50', '<iframe width="560" height="315" src="//www.youtube.com/embed/b1DzRb4DHGw" frameborder="0" allowfullscreen></iframe>', '/videos/2014/10/video_1.mp4', '', '/img/thumbnails/vids/2014/10/sample320x200-2.png', '2014-10-24 04:14:17', '2014-10-20 00:00:00', 130);

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
