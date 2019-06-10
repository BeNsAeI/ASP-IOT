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
(1, 'testname', 'testid1', 'normal', 5, 0, '10.0.0.1', 8558),
(2, 'testname2', 'testid2', 'normal', 1, 1, '10.0.0.1', 4555),
(3, 'testname2', 'testid3', 'vr', 2, 2, '10.0.0.1', 4555);

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
(1, 'venue.png', 10, 10);
