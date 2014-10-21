-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2014 at 03:59 PM
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
  `runtime` varchar(50) NOT NULL,
  `embed_code` text NOT NULL,
  `file_path` varchar(200) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `uploaded` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `title`, `desc`, `runtime`, `embed_code`, `file_path`, `thumbnail`, `uploaded`, `modified`, `views`) VALUES
(1, 'Paul Gilbert & Freddie Nelson - Let It Be (LIVE)', 'Paul Gilbert & Freddie Nelson - Let It Be (LIVE)', '20:10', '<video width="400" controls>\r\n  <source src="/videos/stream-video/1" type="video/mp4">\r\n  Your browser does not support HTML5 video.\r\n</video>', '/videos/2014/10/video_1.mp4', '/img/thumbnails/vids/2014/10/sample320x200.png', '2014-09-23 00:00:00', '2014-09-23 00:00:00', 1023),
(2, 'Paul Gilbert - Technical Difficulties', 'From licklibrary.com another piece of great music from Racer X.\r\nPerformed by Paul at LIMS ''08.', '30:41', '<iframe width="560" height="315" src="//www.youtube.com/embed/zU_KoxFQd64" frameborder="0" allowfullscreen></iframe>', '/videos/2014/10/video_1.mp4', '/img/thumbnails/vids/2014/10/sample320x200.png', '2014-10-20 00:00:00', '2014-10-20 00:00:00', 46),
(3, 'Far Beyond The Sun - Yngwie Malmsteen', 'Far Beyond The Sun played by Yngwie Malmsteen', '6:00', '<iframe width="420" height="315" src="//www.youtube.com/embed/eK0rvReE-4c" frameborder="0" allowfullscreen></iframe>', '/videos/2014/10/video_1.mp4', '/img/thumbnails/vids/2014/10/sample320x200-1.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 96),
(4, 'YNGWIE MALMSTEEN Live [HD] Black Star', 'YNGWIE MALMSTEEN Live [HD] Black Star', '10:46', '<iframe width="420" height="315" src="//www.youtube.com/embed/QvMKsgVBzMo" frameborder="0" allowfullscreen></iframe>', '/videos/2014/10/video_1.mp4', '/img/thumbnails/vids/2014/10/sample320x200-1.png', '2014-10-20 00:00:00', '2014-10-20 00:00:00', 65),
(5, 'Steve Vai Tender Surrender full HD', '2009 Where the Wild Things Are DVD', '4:39', '<iframe width="560" height="315" src="//www.youtube.com/embed/_Tp7RHzm9x0" frameborder="0" allowfullscreen></iframe>', '/videos/2014/10/video_1.mp4', '/img/thumbnails/vids/2014/10/sample320x200-3.png', '2014-10-20 00:00:00', '2014-10-20 00:00:00', 12),
(6, 'Joe Satriani - Always With Me, Always With You (Live 2006)', 'Joe Satriani - Always With Me, Always With You (Live 2006)\r\nLive at The Grove, Anaheim\r\nOff of the "Satriani: Live!" DVD (2006)', '12:50', '<iframe width="560" height="315" src="//www.youtube.com/embed/b1DzRb4DHGw" frameborder="0" allowfullscreen></iframe>', '/videos/2014/10/video_1.mp4', '/img/thumbnails/vids/2014/10/sample320x200-2.png', '2014-10-20 00:00:00', '2014-10-20 00:00:00', 127);

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
