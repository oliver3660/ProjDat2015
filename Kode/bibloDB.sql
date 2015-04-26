-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2015 at 02:48 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `bibliotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `bog`
--

CREATE TABLE `bog` (
  `boID` int(11) NOT NULL,
  `Titel` varchar(255) NOT NULL,
  `Forfatter` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bog`
--

INSERT INTO `bog` (`boID`, `Titel`, `Forfatter`) VALUES
(1, 'Stor fed pik', 'Piet Hein');

-- --------------------------------------------------------

--
-- Table structure for table `brugere`
--

CREATE TABLE `brugere` (
  `Navn` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `bID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brugere`
--

INSERT INTO `brugere` (`Navn`, `Mail`, `bID`) VALUES
('Casper Helms', 'ostsnabbelaost.dk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rykker`
--

CREATE TABLE `rykker` (
  `rID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `dato` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rykker`
--

INSERT INTO `rykker` (`rID`, `uID`, `dato`) VALUES
(1, 2, '2015-04-26 12:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `udlaan`
--

CREATE TABLE `udlaan` (
  `uID` int(11) NOT NULL,
  `boID` int(11) NOT NULL,
  `bID` int(11) NOT NULL,
  `dato` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Afleveret` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `udlaan`
--

INSERT INTO `udlaan` (`uID`, `boID`, `bID`, `dato`, `Afleveret`) VALUES
(2, 1, 1, '2015-04-26 12:38:33', 0),
(4, 1, 1, '2015-04-26 12:46:41', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bog`
--
ALTER TABLE `bog`
  ADD PRIMARY KEY (`boID`),
  ADD KEY `titel` (`Titel`),
  ADD KEY `forfatter` (`Forfatter`);

--
-- Indexes for table `brugere`
--
ALTER TABLE `brugere`
  ADD PRIMARY KEY (`bID`),
  ADD UNIQUE KEY `email` (`Mail`);

--
-- Indexes for table `rykker`
--
ALTER TABLE `rykker`
  ADD PRIMARY KEY (`rID`),
  ADD KEY `uID` (`uID`);

--
-- Indexes for table `udlaan`
--
ALTER TABLE `udlaan`
  ADD PRIMARY KEY (`uID`),
  ADD KEY `boID` (`boID`),
  ADD KEY `bID` (`bID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bog`
--
ALTER TABLE `bog`
  MODIFY `boID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `brugere`
--
ALTER TABLE `brugere`
  MODIFY `bID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rykker`
--
ALTER TABLE `rykker`
  MODIFY `rID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `udlaan`
--
ALTER TABLE `udlaan`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `rykker`
--
ALTER TABLE `rykker`
  ADD CONSTRAINT `rykker_ibfk_1` FOREIGN KEY (`uID`) REFERENCES `udlaan` (`uID`);

--
-- Constraints for table `udlaan`
--
ALTER TABLE `udlaan`
  ADD CONSTRAINT `udlaan_ibfk_1` FOREIGN KEY (`boID`) REFERENCES `bog` (`boID`),
  ADD CONSTRAINT `udlaan_ibfk_2` FOREIGN KEY (`bID`) REFERENCES `brugere` (`bID`);
