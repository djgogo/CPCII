-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 18. Nov 2016 um 12:40
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
  `cid` int(10) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL,
  `author` varchar(200) CHARACTER SET utf8 NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `picture` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`cid`, `pid`, `author`, `comment`, `picture`) VALUES
(2, 1, 'gogo', 'This is my absolutely most favourite Headphone ever :-)', ''),
(8, 1, 'gogo', 'one more time', 'smiley.jpg'),
(9, 1, 'test', 'test comment Bla Bla Bla!\r\nBla Bla Bla\r\nTest Test Test', ''),
(10, 2, 'gogo', 'amazinggreatsupercoolfabulous... :-)', ''),
(11, 1, 'test', 'test test', ''),
(12, 2, 'petersacco', 'test ', 'smiley.jpg'),
(13, 1, 'petersacco', '', ''),
(14, 1, 'petersacco', 'Test Photo ', 'smiley.jpg'),
(15, 1, 'petersacco', 'Kommentar 1', ''),
(16, 1, 'petersacco', 'Kommentar 2', ''),
(17, 1, 'petersacco', 'Kommentar 3', ''),
(18, 2, 'petersacco', 'Kommentar 1', ''),
(19, 2, 'petersacco', 'Kommentar 2', ''),
(20, 2, 'petersacco', 'Kommentar 3', ''),
(21, 2, 'suxxuser', 'Kommentar von SuxxUser', ''),
(22, 2, 'suxxuser', 'Smiley von the Suxx', 'smiley.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `pid` int(10) NOT NULL,
  `label` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`pid`, `label`, `img`, `price`, `created`, `updated`) VALUES
(1, 'Technics RP DJ 1210', 'Technics_RP_DJ_1210.jpg', 150, '2016-10-26 11:00:00', '2016-11-10 07:25:30'),
(2, 'Technics SL-1210 Plattenspieler', 'technics_sl1210mk2.jpg', 1260, '2016-10-31 15:11:28', '2016-11-04 14:59:32');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `email` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `descr` text NOT NULL,
  `picture` varchar(80) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uid`, `username`, `passwd`, `email`, `name`, `descr`, `picture`, `created`) VALUES
(10, 'petersacco', '$2y$10$H81dsPPsAbkT10oShO5AruHZsobbzAL5c7urFXg1dBZEzvSXPWGfi', 'peter@sacco.ch', 'Peter Sacco', 'Suxx Account', '', '2016-10-21 10:53:42'),
(11, 'gogo', '$2y$10$2SR0l.bZHmDEU/Flhr8gxeSFDlryH3WuLYw73dqIXoegXl/Qj0T9O', 'gogo@musiq.ch', 'Gogo', 'Suxx Account', '', '2016-10-21 15:05:50'),
(12, 'test', '$2y$10$SdxetgoS9CyCdcjq8RTY4Owiz0BoaT57YV7QkbKlizAdDWXyZttim', 'test@muster.ch', 'Test Muster', 'Suxx Account', '', '2016-10-24 08:05:09'),
(14, 'suxxuser', '$2y$10$GGa3aBaoARbvgyX0N4Lh4ejGXMV3tAU5Ui.kVSh6O1rSfhr9VH./6', 'suxx@user.net', 'Suxx User', 'Suxx Account', '', '2016-10-26 12:32:18'),
(15, 'suxx', '$2y$10$1VPd/2yfNKlcIxQeb8s8xu/cdVgUbr7oZjbXh/YTKZR7jHFC8tXM6', 'suxx@master.com', 'Suxx Master', 'Suxx Account', '', '2016-11-01 09:10:55');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `PID` (`pid`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `USERNAME` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
