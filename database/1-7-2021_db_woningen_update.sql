-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 jul 2021 om 13:46
-- Serverversie: 10.4.19-MariaDB
-- PHP-versie: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_woningen_update`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `houses`
--

CREATE TABLE `houses` (
  `house_id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `price` decimal(20,2) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `address` varchar(110) DEFAULT NULL,
  `postalcode` varchar(55) DEFAULT NULL,
  `place` varchar(55) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `houses`
--

INSERT INTO `houses` (`house_id`, `title`, `price`, `description`, `address`, `postalcode`, `place`, `date_time`) VALUES
(1, 'test titel1', '8787.00', 'test description', 'ltraat 1', '2323 PD', 'Leiden', '2021-06-29 20:25:09'),
(2, 'test titel2', '45954.00', 'test description2', 'lolstraat 2', '0923 PD', 'Utrecht', '2021-06-29 20:25:09');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `houses_locations`
--

CREATE TABLE `houses_locations` (
  `house_location_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `houses_locations`
--

INSERT INTO `houses_locations` (`house_location_id`, `house_id`, `location_id`, `date_time`) VALUES
(1, 1, 2, '2021-06-29 20:26:15'),
(2, 2, 2, '2021-06-29 20:26:15'),
(3, 2, 3, '2021-06-29 20:26:15');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `houses_properties`
--

CREATE TABLE `houses_properties` (
  `house_propertie_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `propertie_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `houses_properties`
--

INSERT INTO `houses_properties` (`house_propertie_id`, `house_id`, `propertie_id`, `date_time`) VALUES
(1, 1, 3, '2021-06-29 20:37:51'),
(2, 2, 4, '2021-06-29 20:37:51');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `houses_status`
--

CREATE TABLE `houses_status` (
  `house_status_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `houses_status`
--

INSERT INTO `houses_status` (`house_status_id`, `house_id`, `status_id`, `date_time`) VALUES
(1, 1, 1, '2021-06-29 20:41:52'),
(2, 2, 2, '2021-06-29 20:41:52'),
(3, 2, 1, '2021-06-29 20:41:52');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `image_path` varchar(90) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `images`
--

INSERT INTO `images` (`image_id`, `house_id`, `image_path`, `order`, `date_time`) VALUES
(1, 1, 'first.jpg', 1, '2021-06-29 20:52:44'),
(2, 1, '1.jpg', 2, '2021-06-29 20:52:44'),
(3, 1, '2.jpg', 3, '2021-06-29 20:52:44'),
(4, 1, '3.jpg', 4, '2021-06-29 20:52:44'),
(5, 1, '4.jpg', 5, '2021-06-29 20:52:44'),
(6, 2, '1.jpg', 2, '2021-06-29 20:52:44'),
(7, 2, 'first.jpg', 1, '2021-06-29 20:52:44'),
(8, 2, '2.jpg', 3, '2021-06-29 20:52:44'),
(9, 2, '3.jpg', 4, '2021-06-29 20:52:44'),
(10, 2, '4.jpg', 5, '2021-06-29 20:52:44');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `value_location` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `locations`
--

INSERT INTO `locations` (`location_id`, `value_location`) VALUES
(1, '-Dicht bij een stad. '),
(2, '-Dicht bij een bos. '),
(3, '-Dicht bij de zee. '),
(4, '-In het heuvelland. '),
(5, '-Aan het water. ');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `properties`
--

CREATE TABLE `properties` (
  `propertie_id` int(11) NOT NULL,
  `value_propertie` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `properties`
--

INSERT INTO `properties` (`propertie_id`, `value_propertie`) VALUES
(1, '-Inclusief overname inventaris. '),
(2, '-Zwembad op het park. '),
(3, '-Winkel op het park. '),
(4, '-Entertainment op het park. '),
(5, '-Op een privepark. ');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `value_status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `status`
--

INSERT INTO `status` (`status_id`, `value_status`) VALUES
(1, 'beschikbaar'),
(2, 'verkocht');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `date_time`) VALUES
(1, 'user1', 'pass1', '2021-06-27 18:55:33');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`house_id`);

--
-- Indexen voor tabel `houses_locations`
--
ALTER TABLE `houses_locations`
  ADD PRIMARY KEY (`house_location_id`);

--
-- Indexen voor tabel `houses_properties`
--
ALTER TABLE `houses_properties`
  ADD PRIMARY KEY (`house_propertie_id`);

--
-- Indexen voor tabel `houses_status`
--
ALTER TABLE `houses_status`
  ADD PRIMARY KEY (`house_status_id`);

--
-- Indexen voor tabel `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexen voor tabel `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexen voor tabel `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`propertie_id`);

--
-- Indexen voor tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `houses`
--
ALTER TABLE `houses`
  MODIFY `house_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `houses_locations`
--
ALTER TABLE `houses_locations`
  MODIFY `house_location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `houses_properties`
--
ALTER TABLE `houses_properties`
  MODIFY `house_propertie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `houses_status`
--
ALTER TABLE `houses_status`
  MODIFY `house_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `properties`
--
ALTER TABLE `properties`
  MODIFY `propertie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
