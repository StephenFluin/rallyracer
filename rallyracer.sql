-- phpMyAdmin SQL Dump
-- version 3.2.2.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2010 at 01:55 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.10-2ubuntu6.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `rallyracer`
--
DROP DATABASE `rallyracer`;
CREATE DATABASE `rallyracer` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rallyracer`;

-- --------------------------------------------------------

--
-- Table structure for table `desired_event`
--

CREATE TABLE IF NOT EXISTS `desired_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `action` varchar(1) NOT NULL,
  `quantity` int(11) NOT NULL,
  `round` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=734 ;

--
-- Dumping data for table `desired_event`
--

INSERT INTO `desired_event` (`id`, `gameid`, `unit`, `priority`, `action`, `quantity`, `round`, `timestamp`) VALUES
(487, 0, 1, 231, 'l', 2, 0, '0000-00-00 00:00:00'),
(488, 0, 1, 843, 'r', 1, 1, '0000-00-00 00:00:00'),
(489, 0, 1, 774, 'f', 1, 2, '0000-00-00 00:00:00'),
(490, 0, 1, 270, 'f', 2, 3, '0000-00-00 00:00:00'),
(491, 0, 1, 833, 'b', 1, 4, '0000-00-00 00:00:00'),
(492, 0, 1, 0, '', 0, 5, '0000-00-00 00:00:00'),
(559, 2, 0, 913, 'b', 1, 0, '2010-04-26 16:07:34'),
(560, 2, 0, 310, 'f', 1, 1, '2010-04-26 16:07:34'),
(561, 2, 0, 309, 'l', 2, 2, '2010-04-26 16:07:34'),
(562, 2, 0, 860, 'b', 1, 3, '2010-04-26 16:07:34'),
(563, 2, 0, 828, 'r', 1, 4, '2010-04-26 16:07:34'),
(564, 2, 0, 0, '', 0, 5, '2010-04-26 16:07:34'),
(565, 3, 0, 256, 'l', 1, 0, '2010-04-26 16:11:50'),
(566, 3, 0, 447, 'l', 1, 1, '2010-04-26 16:11:50'),
(567, 3, 0, 270, 'l', 2, 2, '2010-04-26 16:11:50'),
(568, 3, 0, 782, 'r', 1, 3, '2010-04-26 16:11:50'),
(569, 3, 0, 866, 'f', 2, 4, '2010-04-26 16:11:50'),
(570, 3, 0, 0, '', 0, 5, '2010-04-26 16:11:50'),
(639, 13, 0, 406, 'b', 1, 0, '2010-04-26 16:28:16'),
(640, 13, 0, 292, 'b', 2, 1, '2010-04-26 16:28:16'),
(641, 13, 0, 534, 'f', 2, 2, '2010-04-26 16:28:16'),
(642, 13, 0, 87, 'b', 1, 3, '2010-04-26 16:28:16'),
(643, 13, 0, 727, 'f', 1, 4, '2010-04-26 16:28:16'),
(659, 49, 0, 660, 'b', 2, 0, '2010-04-26 22:34:21'),
(660, 49, 0, 541, 'f', 2, 1, '2010-04-26 22:34:21'),
(661, 49, 0, 628, 'l', 1, 2, '2010-04-26 22:34:21'),
(662, 49, 0, 211, 'r', 1, 3, '2010-04-26 22:34:21'),
(663, 49, 0, 916, 'f', 1, 4, '2010-04-26 22:34:21'),
(664, 53, 1, 474, 'r', 1, 0, '2010-04-26 22:44:15'),
(665, 53, 1, 658, 'f', 1, 1, '2010-04-26 22:44:15'),
(666, 53, 1, 939, 'r', 1, 2, '2010-04-26 22:44:15'),
(667, 53, 1, 736, 'f', 1, 3, '2010-04-26 22:44:15'),
(668, 53, 1, 76, 'b', 1, 4, '2010-04-26 22:44:15'),
(674, 54, 2, 650, 'l', 2, 0, '2010-04-27 12:18:29'),
(675, 54, 2, 252, 'l', 2, 1, '2010-04-27 12:18:29'),
(676, 54, 2, 219, 'f', 2, 2, '2010-04-27 12:18:29'),
(677, 54, 2, 504, 'b', 1, 3, '2010-04-27 12:18:29'),
(678, 54, 2, 816, 'r', 1, 4, '2010-04-27 12:18:29'),
(709, 55, 1, 154, 'l', 1, 0, '2010-04-27 13:01:57'),
(710, 55, 1, 476, 'l', 2, 1, '2010-04-27 13:01:57'),
(711, 55, 1, 54, 'r', 2, 2, '2010-04-27 13:01:57'),
(712, 55, 1, 581, 'f', 1, 3, '2010-04-27 13:01:57'),
(713, 55, 1, 461, 'f', 1, 4, '2010-04-27 13:01:57'),
(714, 55, 0, 895, 'f', 1, 0, '2010-04-27 13:02:08'),
(715, 55, 0, 837, 'l', 2, 1, '2010-04-27 13:02:08'),
(716, 55, 0, 137, 'b', 1, 2, '2010-04-27 13:02:08'),
(717, 55, 0, 496, 'b', 1, 3, '2010-04-27 13:02:08'),
(718, 55, 0, 149, 'b', 1, 4, '2010-04-27 13:02:08'),
(719, 56, 3, 70, 'f', 1, 0, '2010-04-27 13:02:47'),
(720, 56, 3, 857, 'b', 2, 1, '2010-04-27 13:02:47'),
(721, 56, 3, 623, 'b', 1, 2, '2010-04-27 13:02:47'),
(722, 56, 3, 438, 'l', 2, 3, '2010-04-27 13:02:47'),
(723, 56, 3, 543, 'l', 1, 4, '2010-04-27 13:02:47'),
(724, 56, 4, 449, 'r', 1, 0, '2010-04-27 13:02:49'),
(725, 56, 4, 353, 'l', 2, 1, '2010-04-27 13:02:49'),
(726, 56, 4, 500, 'l', 2, 2, '2010-04-27 13:02:49'),
(727, 56, 4, 812, 'r', 2, 3, '2010-04-27 13:02:49'),
(728, 56, 4, 233, 'r', 1, 4, '2010-04-27 13:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `created`) VALUES
(60, '2010-05-01 13:51:57'),
(61, '2010-05-01 13:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `pending_event`
--

CREATE TABLE IF NOT EXISTS `pending_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `unit` int(11) NOT NULL DEFAULT '0',
  `x` int(11) NOT NULL DEFAULT '0',
  `y` int(11) NOT NULL DEFAULT '0',
  `rot` int(11) NOT NULL DEFAULT '0',
  `round` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pending_event`
--


-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `unit` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `player`
--

