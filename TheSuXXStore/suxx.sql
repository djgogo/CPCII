-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 21. Okt 2016 um 07:55
-- Server-Version: 5.5.51
-- PHP-Version: 7.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `suxx`
--
CREATE DATABASE IF NOT EXISTS `suxx` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `suxx`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE `comments` (
  `CID` int(10) UNSIGNED NOT NULL,
  `PID` int(10) UNSIGNED NOT NULL,
  `AUTHOR` varchar(200) NOT NULL,
  `COMMENT` text NOT NULL,
  `PICTURE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`CID`, `PID`, `AUTHOR`, `COMMENT`, `PICTURE`) VALUES
(2, 1, 'gogo', 'This is my absolutely most favourite Headphone ever :-)', ''),
(8, 1, 'gogo', 'one more time', 'smiley.jpg'),
(9, 1, 'test', 'test comment Bla Bla Bla!\r\nBla Bla Bla\r\nTest Test Test', ''),
(10, 2, 'gogo', 'amazinggreatsupercoolfabulous... :-)', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `PID` int(10) NOT NULL,
  `LABEL` varchar(200) NOT NULL,
  `IMG` varchar(200) NOT NULL,
  `PRICE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`PID`, `LABEL`, `IMG`, `PRICE`) VALUES
(1, 'Technics RP DJ 1200 Headphones', 'Technics_RP_DJ_1210.jpg', 115),
(2, 'Technics SL-1210 Plattenspieler', 'technics_sl1210mk2.jpg', 1250);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `UID` int(11) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWD` varchar(255) NOT NULL,
  `EMAIL` varchar(80) NOT NULL,
  `NAME` varchar(80) NOT NULL,
  `DESCR` text NOT NULL,
  `PICTURE` varchar(80) NOT NULL,
  `CREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`UID`, `USERNAME`, `PASSWD`, `EMAIL`, `NAME`, `DESCR`, `PICTURE`, `CREATED`) VALUES
(1, 'test', '1234', 'hans@muster.ch', 'Hans Muster', '', '', '2016-10-18 08:16:46'),
(5, 'gogo', '1234', 'peter@bluewin.ch', 'Peter Sacco', 'Test Account', '', '2016-10-19 08:16:53');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CID`),
  ADD KEY `PID` (`PID`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `CID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `PID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
