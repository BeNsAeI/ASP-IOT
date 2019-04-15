-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host: oniddb
-- Generation Time: Apr 15, 2019 at 11:12 AM
-- Server version: 5.5.58
-- PHP Version: 5.2.6-1+lenny16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `duvoisil-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE IF NOT EXISTS `devices` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` enum('normal','vr','microphone') NOT NULL,
  `row` int(11) NOT NULL,
  `column` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL DEFAULT '255.255.255.255',
  `port` int(11) NOT NULL DEFAULT '8080',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`ID`, `name`, `code`, `type`, `row`, `column`, `ip`, `port`) VALUES
(48, 'fghdfgh', 'dfghf', 'normal', 5, 0, '76.115.123.116', 8558),
(51, 'workspls', 'dfg', 'normal', 1, 1, '76.115.123.116', 4555),
(52, 'test360', 'dfgh', 'vr', 2, 2, '76.115.123.116', 4555);

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE IF NOT EXISTS `map` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `File` text NOT NULL,
  `Rows` int(11) NOT NULL,
  `Columns` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `map`
--

INSERT INTO `map` (`ID`, `File`, `Rows`, `Columns`) VALUES
(1, 'venue.jpg', 10, 10),
(2, 'test.jpg', 10, 10),
(3, 'images/venue.pngpng', 10, 10),
(4, 'images/venue.png', 10, 10),
(5, 'venue.png', 10, 10),
(6, 'favicon.png', 10, 10),
(7, 'venue.png', 10, 10),
(8, 'favicon.png', 10, 10),
(9, 'venue.png', 10, 10),
(10, 'favicon.png', 10, 10),
(11, 'venue.png', 10, 10),
(12, 'venue.png', 10, 10),
(13, 'venue.png', 0, 0),
(14, 'venue.png', 0, 0),
(15, 'venue.png', 15, 0),
(16, 'venue.png', 15, 15),
(17, 'venue.png', 10, 10),
(18, 'venue.png', 10, 10),
(19, 'venue.png', 10, 10),
(20, 'venue.png', 15, 15),
(21, 'venue.png', 20, 20),
(22, 'venue.png', 10, 10),
(23, 'venue.png', 20, 20),
(24, 'favicon.png', 5, 5),
(25, 'venue.png', 5, 5),
(26, 'venue.png', 15, 10),
(27, 'venue.png', 15, 15),
(28, 'venue.png', 4, 4),
(29, 'venue.png', 15, 15),
(30, 'venue.png', 5, 5),
(31, 'venue.png', 5, 5),
(32, 'venue.png', 15, 15),
(33, 'venue.png', 15, 15),
(34, 'favicon.png', 10, 10),
(35, 'venue.png', 10, 10),
(36, 'venue2.png', 12, 12),
(37, 'venue.png', 12, 12),
(38, 'venue2.png', 15, 15),
(39, 'venue.png', 12, 12),
(40, 'venue2.png', 14, 14),
(41, 'venue.png', 5, 5),
(42, 'venue2.png', 13, 13),
(43, 'venue.png', 15, 15),
(44, 'venue2.png', 10, 25),
(45, 'venue2.png', 18, 9),
(46, 'venue.png', 15, 15),
(47, 'venue2.png', 15, 15),
(48, 'venue.png', 17, 17),
(49, 'venue2.png', 15, 15),
(50, 'venue.png', 15, 15),
(51, 'venue2.png', 15, 15),
(52, 'venue.png', 13, 13),
(53, 'corvallis-map.png', 20, 20),
(54, 'venue.png', 10, 10);
