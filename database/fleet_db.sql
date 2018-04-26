-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generato il: Apr 26, 2018 alle 12:02
-- Versione del server: 5.5.32
-- Versione PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fleet_db`
--
CREATE DATABASE IF NOT EXISTS `fleet_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fleet_db`;

-- --------------------------------------------------------

--
-- Struttura della tabella `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `passwd` varchar(30) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company` (`company`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `passwd`, `type`, `company`) VALUES
(1, 'IOwnTheWorld', 'pass', 3, NULL),
(2, 'RealSteveJobs', 'pass', 1, 2),
(3, 'admin', 'pass', 1, 1),
(4, 'emp1', 'pass', 4, 1),
(5, 'emp2', 'pass', 4, 2),
(6, 'driv1', 'pass', 2, 1),
(7, 'driv2', 'pass', 2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `accounttypes`
--

CREATE TABLE IF NOT EXISTS `accounttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(1) DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `accounttypes`
--

INSERT INTO `accounttypes` (`id`, `code`, `description`) VALUES
(1, 'a', 'Company administrator'),
(2, 'd', 'Company driver'),
(3, 'm', 'ACME Administrator'),
(4, 'e', 'Company employee');

-- --------------------------------------------------------

--
-- Struttura della tabella `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `mainPage` varchar(1024) DEFAULT NULL,
  `piva` varchar(30) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `mainOccupation` varchar(100) DEFAULT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `companies`
--

INSERT INTO `companies` (`id`, `name`, `mainPage`, `piva`, `city`, `mainOccupation`, `active`) VALUES
(1, 'ACSE', '<br />\r\n		<br />\r\n		Do you need to ship some presents to your parent''s home? Ship them! <br />\r\n		Do you need to transfer some dirty money? Ship them! <br />\r\n		Do you hate your president? Ship him to the moon! <br />\r\n		<br />\r\n		<br />\r\n		ACSE (A Company that Ships Everything) is a business that will ship all you needs!<br />\r\n		<br />\r\n		<br />\r\n		<br />\r\n		<br />\r\n		<font size="1">We don''t ship to the moon</font>', '13t2gfaf123fqfa', 'Pordenone', 'Shippings', 1),
(2, 'Apple', '<br />\r\n<br />\r\nWe are Apple\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<font size="1">Buy our phones NOW</font>', '13tgfafadf2', 'Atlanta', 'Selling broken phones', 1),
(4, 'Wayne Corp.', '<br/>\r\n<br/>\r\n<h2>Some Men Just Want their packages to be shipped</h2>', 'N0TBRUC3W4YN3', 'Gotham', 'Absolutely not weapon dealing', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `drivers`
--

CREATE TABLE IF NOT EXISTS `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company` (`company`),
  KEY `account` (`account`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `surname`, `company`, `account`) VALUES
(1, 'Mario', 'Rossi', 1, NULL),
(2, 'Mario', 'Bianchi', 2, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `issues`
--

CREATE TABLE IF NOT EXISTS `issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `cause` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `shipment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipment` (`shipment`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `issues`
--

INSERT INTO `issues` (`id`, `title`, `code`, `description`, `cause`, `status`, `shipment`) VALUES
(1, 'The truck won''t start', '1342', 'I don''t know why but I cannot start the engine', 'Do I look like a mechanic?', 'open', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(1024) DEFAULT NULL,
  `shipment` int(11) DEFAULT NULL,
  `sender` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipment` (`shipment`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `messages`
--

INSERT INTO `messages` (`id`, `text`, `shipment`, `sender`) VALUES
(2, 'Hello there!', 2, 'emp1'),
(3, 'I delivered the package', 2, 'driv1'),
(4, 'Great, I can finally set the shipment as done', 2, 'emp1'),
(5, 'ciao', 2, 'emp1'),
(6, 'hello', 2, 'emp1'),
(7, 'hellosdadsadadasdad', 2, 'emp1'),
(8, 'Ciao steffi', 2, 'emp1');

-- --------------------------------------------------------

--
-- Struttura della tabella `movements`
--

CREATE TABLE IF NOT EXISTS `movements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movDate` date DEFAULT NULL,
  `movTime` time NOT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `shipment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipment` (`shipment`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `movements`
--

INSERT INTO `movements` (`id`, `movDate`, `movTime`, `latitude`, `longitude`, `speed`, `shipment`) VALUES
(1, '2018-04-02', '00:00:00', 52252400, 525253000, 56, 1),
(2, '2018-04-03', '00:00:00', 36636500, 3636660000, 90, 1),
(3, '2018-04-09', '00:00:00', 783738000, 3757380000, 45, 2),
(4, '2018-04-11', '00:00:00', 834578000, 383435000, 67, 2),
(5, '2018-04-17', '00:00:00', 252525, 234135000, 12, 3),
(6, '2018-04-05', '00:00:00', 2345250000, 25352500, 34, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `shipments`
--

CREATE TABLE IF NOT EXISTS `shipments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `truck` int(11) DEFAULT NULL,
  `driver` int(11) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL COMMENT 'This is not the actual end date but an estimated date',
  `startTime` time NOT NULL,
  `endTime` time NOT NULL COMMENT 'This is not the actual end time but an estimated time',
  `destination` varchar(20) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '4' COMMENT 'This is set by the operator',
  PRIMARY KEY (`id`),
  KEY `truck` (`truck`),
  KEY `driver` (`driver`),
  KEY `company` (`company`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `shipments`
--

INSERT INTO `shipments` (`id`, `truck`, `driver`, `startDate`, `endDate`, `startTime`, `endTime`, `destination`, `company`, `status`) VALUES
(1, 1, 1, '2018-04-01', '2018-04-05', '00:00:00', '00:00:00', 'Pordenone', 1, 1),
(2, 1, 1, '2018-04-08', '2018-04-12', '00:00:00', '00:00:00', 'Roma', 1, 2),
(3, 2, 2, '2018-04-22', '2018-04-25', '00:00:00', '00:00:00', 'Milano', 2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `shipmentstatuses`
--

CREATE TABLE IF NOT EXISTS `shipmentstatuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `shipmentstatuses`
--

INSERT INTO `shipmentstatuses` (`id`, `name`, `description`) VALUES
(1, 'done', 'Assigned when a shipment is completed'),
(2, 'in progress', 'Assigned when a shipment is in progress'),
(3, 'failed', 'Assigned when a shipment has failed'),
(4, 'waiting', 'Assigned when the driver or the truck is not ready ');

-- --------------------------------------------------------

--
-- Struttura della tabella `trucks`
--

CREATE TABLE IF NOT EXISTS `trucks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(20) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `containerSize` int(11) DEFAULT NULL,
  `licensePlate` varchar(20) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company` (`company`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `trucks`
--

INSERT INTO `trucks` (`id`, `brand`, `model`, `containerSize`, `licensePlate`, `company`) VALUES
(1, 'Fiat', 'M124', 50, '18fhas', 1),
(2, 'Mercedes', 'AFSJI1', 30, 'AF1G5AS', 2);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`company`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`company`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `accounts_ibfk_3` FOREIGN KEY (`type`) REFERENCES `accounttypes` (`id`);

--
-- Limiti per la tabella `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`company`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `drivers_ibfk_2` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`);

--
-- Limiti per la tabella `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `issues_ibfk_1` FOREIGN KEY (`shipment`) REFERENCES `shipments` (`id`);

--
-- Limiti per la tabella `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`shipment`) REFERENCES `shipments` (`id`);

--
-- Limiti per la tabella `movements`
--
ALTER TABLE `movements`
  ADD CONSTRAINT `movements_ibfk_1` FOREIGN KEY (`shipment`) REFERENCES `shipments` (`id`);

--
-- Limiti per la tabella `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_ibfk_1` FOREIGN KEY (`truck`) REFERENCES `trucks` (`id`),
  ADD CONSTRAINT `shipments_ibfk_2` FOREIGN KEY (`driver`) REFERENCES `drivers` (`id`),
  ADD CONSTRAINT `shipments_ibfk_3` FOREIGN KEY (`company`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `shipments_ibfk_4` FOREIGN KEY (`status`) REFERENCES `shipmentstatuses` (`id`);

--
-- Limiti per la tabella `trucks`
--
ALTER TABLE `trucks`
  ADD CONSTRAINT `trucks_ibfk_1` FOREIGN KEY (`company`) REFERENCES `companies` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
