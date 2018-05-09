-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 09, 2018 alle 23:21
-- Versione del server: 10.1.28-MariaDB
-- Versione PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fleet_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `passwd` varchar(30) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `accounttypes` (
  `id` int(11) NOT NULL,
  `code` varchar(1) DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `mainPage` varchar(1024) DEFAULT NULL,
  `piva` varchar(30) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `mainOccupation` varchar(100) DEFAULT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `companies`
--

INSERT INTO `companies` (`id`, `name`, `mainPage`, `piva`, `city`, `mainOccupation`, `active`) VALUES
(1, 'ACSE', '<br />\r\n		<br />\r\n		Do you need to ship some presents to your parent\'s home? Ship them! <br />\r\n		Do you need to transfer some dirty money? Ship them! <br />\r\n		Do you hate your president? Ship him to the moon! <br />\r\n		<br />\r\n		<br />\r\n		ACSE (A Company that Ships Everything) is a business that will ship all you needs!<br />\r\n		<br />\r\n		<br />\r\n		<br />\r\n		<br />\r\n		<font size=\"1\">We don\'t ship to the moon</font>', '13t2gfaf123fqfa', 'Pordenone', 'Shippings', 1),
(2, 'Apple', '<br />\r\n<br />\r\nWe are Apple\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<font size=\"1\">Buy our phones NOW</font>', '13tgfafadf2', 'Atlanta', 'Selling broken phones', 1),
(4, 'Wayne Corp.', '<br/>\r\n<br/>\r\n<h2>Some Men Just Want their packages to be shipped</h2>', 'N0TBRUC3W4YN3', 'Gotham', 'Absolutely not weapon dealing', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `account` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `surname`, `company`, `account`) VALUES
(1, 'Mario', 'Rossi', 1, 6),
(2, 'Mario', 'Bianchi', 2, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `issues`
--

CREATE TABLE `issues` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `cause` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `shipment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `issues`
--

INSERT INTO `issues` (`id`, `title`, `code`, `description`, `cause`, `status`, `shipment`) VALUES
(1, 'The truck won\'t start', '1342', 'I don\'t know why but I cannot start the engine', 'Do I look like a mechanic?', 'open', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `text` varchar(1024) DEFAULT NULL,
  `shipment` int(11) DEFAULT NULL,
  `sender` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `movements` (
  `id` int(11) NOT NULL,
  `movDate` date DEFAULT NULL,
  `movTime` time NOT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `shipment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `movements`
--

INSERT INTO `movements` (`id`, `movDate`, `movTime`, `latitude`, `longitude`, `speed`, `shipment`) VALUES
(1, '2018-04-02', '00:00:00', 52252400, 525253000, 56, 1),
(2, '2018-04-03', '00:00:00', 36636500, 3636660000, 90, 1),
(3, '2018-04-09', '00:00:00', 783738000, 3757380000, 45, 2),
(4, '2018-04-11', '00:00:00', 834578000, 383435000, 67, 2),
(5, '2018-04-17', '00:00:00', 252525, 234135000, 12, 3),
(6, '2018-04-05', '00:00:00', 2345250000, 25352500, 34, 1),
(7, '2018-05-09', '18:19:32', 33.422, -122.084, 68, 1),
(8, '2018-05-09', '18:38:54', 33.422, -122.084, 75, 1),
(9, '2018-05-09', '18:39:02', 33.422, -123.084, 105, 1),
(10, '2018-05-09', '18:39:08', 32.422, -123.084, 82, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `shipments`
--

CREATE TABLE `shipments` (
  `id` int(11) NOT NULL,
  `truck` int(11) DEFAULT NULL,
  `driver` int(11) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL COMMENT 'This is not the actual end date but an estimated date',
  `startTime` time NOT NULL,
  `endTime` time NOT NULL COMMENT 'This is not the actual end time but an estimated time',
  `destination` varchar(20) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '4' COMMENT 'This is set by the operator'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `shipments`
--

INSERT INTO `shipments` (`id`, `truck`, `driver`, `startDate`, `endDate`, `startTime`, `endTime`, `destination`, `company`, `status`) VALUES
(1, 1, 1, '2018-04-01', '2018-04-05', '00:00:00', '00:00:00', 'Pordenone', 1, 2),
(2, 1, 1, '2018-04-08', '2018-04-12', '00:00:00', '00:00:00', 'Roma', 1, 2),
(3, 2, 2, '2018-04-22', '2018-04-25', '00:00:00', '00:00:00', 'Milano', 2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `shipmentstatuses`
--

CREATE TABLE `shipmentstatuses` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `trucks` (
  `id` int(11) NOT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `containerSize` int(11) DEFAULT NULL,
  `licensePlate` varchar(20) DEFAULT NULL,
  `company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `trucks`
--

INSERT INTO `trucks` (`id`, `brand`, `model`, `containerSize`, `licensePlate`, `company`) VALUES
(1, 'Fiat', 'M124', 50, '18fhas', 1),
(2, 'Mercedes', 'AFSJI1', 30, 'AF1G5AS', 2);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company` (`company`),
  ADD KEY `type` (`type`);

--
-- Indici per le tabelle `accounttypes`
--
ALTER TABLE `accounttypes`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company` (`company`),
  ADD KEY `account` (`account`);

--
-- Indici per le tabelle `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment` (`shipment`);

--
-- Indici per le tabelle `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment` (`shipment`);

--
-- Indici per le tabelle `movements`
--
ALTER TABLE `movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment` (`shipment`);

--
-- Indici per le tabelle `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `truck` (`truck`),
  ADD KEY `driver` (`driver`),
  ADD KEY `company` (`company`),
  ADD KEY `status` (`status`);

--
-- Indici per le tabelle `shipmentstatuses`
--
ALTER TABLE `shipmentstatuses`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `trucks`
--
ALTER TABLE `trucks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company` (`company`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `accounttypes`
--
ALTER TABLE `accounttypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `movements`
--
ALTER TABLE `movements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `shipmentstatuses`
--
ALTER TABLE `shipmentstatuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `trucks`
--
ALTER TABLE `trucks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
