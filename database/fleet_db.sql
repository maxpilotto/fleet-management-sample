-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 04, 2018 alle 23:20
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
  `passwd` varchar(20) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `company` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `accounttypes`
--

CREATE TABLE `accounttypes` (
  `id` int(11) NOT NULL,
  `name` varchar(1) DEFAULT NULL,
  `description` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `accounttypes`
--

INSERT INTO `accounttypes` (`id`, `name`, `description`) VALUES
(1, 'a', 'Admin'),
(2, 'd', 'Driver');

-- --------------------------------------------------------

--
-- Struttura della tabella `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `PIVA` varchar(20) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `surname`) VALUES
(1, 'Driver', NULL),
(3, 'John', 'Doe'),
(4, 'Jane', 'Doe'),
(5, 'Mario', 'Rossi'),
(6, 'Mario', 'Bianchi'),
(7, 'Edward', 'Teach');

-- --------------------------------------------------------

--
-- Struttura della tabella `issues`
--

CREATE TABLE `issues` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `code` varchar(20) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `cause` varchar(100) DEFAULT NULL,
  `shipment` int(11) DEFAULT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `issues`
--

INSERT INTO `issues` (`id`, `title`, `code`, `description`, `cause`, `shipment`, `status`) VALUES
(1, 'Problem with the truck', '124', 'The truck doesn\'t start', 'Do I look like a mechanic?', 1, 'Open');

-- --------------------------------------------------------

--
-- Struttura della tabella `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `text` varchar(1024) DEFAULT NULL,
  `shipment` int(11) DEFAULT NULL,
  `sentFrom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `movements`
--

CREATE TABLE `movements` (
  `id` int(11) NOT NULL,
  `movDate` date DEFAULT NULL,
  `latitude` varchar(1024) NOT NULL,
  `longitude` varchar(1024) NOT NULL,
  `speed` float NOT NULL,
  `place` varchar(50) NOT NULL,
  `shipment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `movements`
--

INSERT INTO `movements` (`id`, `movDate`, `latitude`, `longitude`, `speed`, `place`, `shipment`) VALUES
(1, '2018-04-01', '1414515', '151511414', 0, 'Pordenone', 1),
(2, '2018-04-02', '1441414', '14141414', 0, 'Azzano', 1),
(3, '2018-04-06', '2526262', '626262626', 0, 'Pordenone', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `shipments`
--

CREATE TABLE `shipments` (
  `id` int(11) NOT NULL,
  `truck` int(11) DEFAULT NULL,
  `driver` int(11) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `destination` varchar(20) DEFAULT NULL,
  `company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `shipments`
--

INSERT INTO `shipments` (`id`, `truck`, `driver`, `startDate`, `endDate`, `destination`, `company`) VALUES
(1, 2, 7, '2018-04-01', '2018-04-03', 'Via della Frasche 12', 0),
(2, 1, 5, '2018-04-04', '2018-04-07', 'Viale dei Viali 69', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `trucks`
--

CREATE TABLE `trucks` (
  `id` int(11) NOT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `containerSize` int(11) DEFAULT NULL,
  `licensePlate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `trucks`
--

INSERT INTO `trucks` (`id`, `brand`, `model`, `containerSize`, `licensePlate`) VALUES
(1, 'Mercedes', 'C512', 30, 'czxczvq'),
(2, 'Fiat', 'A23o', 20, 'qwtg3af'),
(3, 'Ford', 'AD1GH1', 10, 'as3fasfza'),
(4, 'Ford', '1439fa', 123, '34afsfaf');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `company` (`company`);

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
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `driver` (`driver`);

--
-- Indici per le tabelle `trucks`
--
ALTER TABLE `trucks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `accounttypes`
--
ALTER TABLE `accounttypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `movements`
--
ALTER TABLE `movements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `trucks`
--
ALTER TABLE `trucks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`type`) REFERENCES `accounttypes` (`id`),
  ADD CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`company`) REFERENCES `companies` (`id`);

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
  ADD CONSTRAINT `shipments_ibfk_2` FOREIGN KEY (`driver`) REFERENCES `drivers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
