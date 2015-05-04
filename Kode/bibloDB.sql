-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Vært: 127.0.0.1
-- Genereringstid: 04. 05 2015 kl. 16:00:40
-- Serverversion: 5.6.17
-- PHP-version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bibliotek`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `bog`
--

CREATE TABLE IF NOT EXISTS `bog` (
  `boID` int(11) NOT NULL AUTO_INCREMENT,
  `Titel` varchar(255) NOT NULL,
  `Forfatter` varchar(255) NOT NULL,
  PRIMARY KEY (`boID`),
  KEY `titel` (`Titel`),
  KEY `forfatter` (`Forfatter`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Data dump for tabellen `bog`
--

INSERT INTO `bog` (`boID`, `Titel`, `Forfatter`) VALUES
(1, 'stor fed pik', 'piet hein'),
(2, 'stor fed pik', 'piet hein');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `brugere`
--

CREATE TABLE IF NOT EXISTS `brugere` (
  `Navn` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `bID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`bID`),
  UNIQUE KEY `email` (`Mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Data dump for tabellen `brugere`
--

INSERT INTO `brugere` (`Navn`, `Mail`, `bID`) VALUES
('oliver kogut', 'oliver@kogut.dk', 1),
('osten', 'ost@ost.dk', 2);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `rykker`
--

CREATE TABLE IF NOT EXISTS `rykker` (
  `rID` int(11) NOT NULL AUTO_INCREMENT,
  `uID` int(11) NOT NULL,
  `rdato` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Antal` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`rID`),
  KEY `uID` (`uID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Data dump for tabellen `rykker`
--

INSERT INTO `rykker` (`rID`, `uID`, `rdato`, `Antal`) VALUES
(7, 4, '2015-04-07 13:58:27', 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `udlaan`
--

CREATE TABLE IF NOT EXISTS `udlaan` (
  `uID` int(11) NOT NULL AUTO_INCREMENT,
  `boID` int(11) NOT NULL,
  `bID` int(11) NOT NULL,
  `udato` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Afleveret` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uID`),
  KEY `boID` (`boID`),
  KEY `bID` (`bID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Data dump for tabellen `udlaan`
--

INSERT INTO `udlaan` (`uID`, `boID`, `bID`, `udato`, `Afleveret`) VALUES
(1, 1, 1, '2015-03-11 11:37:22', 0),
(4, 2, 2, '2015-03-03 11:12:31', 0),
(5, 1, 1, '2015-05-04 10:44:49', 1);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `rykker`
--
ALTER TABLE `rykker`
  ADD CONSTRAINT `rykker_ibfk_1` FOREIGN KEY (`uID`) REFERENCES `udlaan` (`uID`);

--
-- Begrænsninger for tabel `udlaan`
--
ALTER TABLE `udlaan`
  ADD CONSTRAINT `udlaan_ibfk_1` FOREIGN KEY (`boID`) REFERENCES `bog` (`boID`),
  ADD CONSTRAINT `udlaan_ibfk_2` FOREIGN KEY (`bID`) REFERENCES `brugere` (`bID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
