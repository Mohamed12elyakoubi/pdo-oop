-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 mrt 2024 om 14:56
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cascade`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE `bestelling` (
  `bestelling_id` int(11) NOT NULL,
  `ReserveringID` int(11) NOT NULL,
  `klant_id` int(11) NOT NULL,
  `tafel_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `omschrijving` varchar(255) NOT NULL,
  `datum` date NOT NULL,
  `tijd` time NOT NULL,
  `aantal` int(11) NOT NULL,
  `Prijs` decimal(10,0) NOT NULL,
  `totaal_prijs` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bestelling`
--

INSERT INTO `bestelling` (`bestelling_id`, `ReserveringID`, `klant_id`, `tafel_id`, `product_id`, `omschrijving`, `datum`, `tijd`, `aantal`, `Prijs`, `totaal_prijs`) VALUES
(24, 2, 4, 1, 3, 'Marokkaanse couscous', '2024-03-11', '14:44:30', 3, '7', '21'),
(25, 2, 4, 1, 1, 'Turkse koffie', '2024-03-11', '14:55:41', 2, '4', '8');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bon`
--

CREATE TABLE `bon` (
  `bonnr` int(11) NOT NULL,
  `datum` date NOT NULL,
  `tijd` time NOT NULL,
  `tafel_id` int(11) NOT NULL,
  `afdeling` varchar(255) NOT NULL,
  `aantal` int(11) NOT NULL,
  `omschrijving` varchar(255) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `Totaal` decimal(10,2) NOT NULL,
  `BTW` decimal(10,0) NOT NULL DEFAULT 6,
  `incBTW` decimal(10,2) NOT NULL,
  `ExclBTW` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klantId` int(11) NOT NULL,
  `klantnaam` varchar(255) NOT NULL,
  `email` varchar(70) NOT NULL,
  `telefoonnummer` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`klantId`, `klantnaam`, `email`, `telefoonnummer`) VALUES
(1, 'ilkan', 'ilkan@ilkan.nl', 787278281),
(2, 'Mohamed', 'elyakoubi412@gmail.com', 787278282),
(3, 'jurgen Mahn', 'jurgenmahn@9yards.nl', 674538363),
(4, 'osman', 'osman@gmail.com', 673682618);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `productid` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `omschrijving` varchar(255) NOT NULL,
  `soort` varchar(255) NOT NULL,
  `prijs` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`productid`, `product`, `omschrijving`, `soort`, `prijs`) VALUES
(1, 'Koffie', 'Turkse koffie', 'drinken', '4'),
(2, 'Thee', 'Marokkaanse Thee', 'drinken', '2'),
(3, 'Couscous', 'Marokkaanse couscous', 'Maaltijd', '7'),
(5, 'Kapsalon', 'Kapsalon met doner', 'Maaltijd', '11'),
(7, 'Cheesecake ', 'vanille - M', 'nagerecht', '3');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservering`
--

CREATE TABLE `reservering` (
  `ReserveringID` int(11) NOT NULL,
  `Tafel` int(11) DEFAULT NULL,
  `klantId` int(11) DEFAULT NULL,
  `start-reservering` timestamp NOT NULL DEFAULT current_timestamp(),
  `einde-reservering` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reservering`
--

INSERT INTO `reservering` (`ReserveringID`, `Tafel`, `klantId`, `start-reservering`, `einde-reservering`) VALUES
(2, 1, 4, '2024-03-06 13:00:00', '2024-03-06 14:00:00'),
(3, 2, 1, '2024-03-07 13:00:00', '2024-03-06 14:24:00'),
(4, 12, 3, '2024-03-06 13:49:00', '2024-03-06 14:49:00'),
(5, 9, 2, '2024-03-06 14:07:00', '2024-03-06 15:07:00'),
(6, 8, 3, '2024-03-08 09:57:00', '2024-03-08 10:57:00'),
(7, 6, 4, '2024-03-11 10:02:00', '2024-03-11 12:02:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `restaurant`
--

CREATE TABLE `restaurant` (
  `TafelId` int(11) NOT NULL,
  `tafel` varchar(50) NOT NULL,
  `stoelen` int(11) NOT NULL,
  `terras` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `restaurant`
--

INSERT INTO `restaurant` (`TafelId`, `tafel`, `stoelen`, `terras`) VALUES
(1, 'tafel 001', 2, 'Nee'),
(2, 'tafel 002', 12, 'Nee'),
(3, 'tafel 003', 6, 'JA'),
(4, 'tafel 004', 12, 'Nee'),
(5, 'tafel 005', 2, 'JA'),
(6, 'tafel 006', 3, 'Nee'),
(7, 'tafel 007', 10, 'JA'),
(8, 'tafel 008', 2, 'JA'),
(9, 'tafel 009', 6, 'Nee'),
(10, 'tafel 010', 2, 'Nee'),
(11, 'tafel 011', 8, 'JA'),
(12, 'tafel 012', 6, 'Nee'),
(13, 'tafel 013', 2, 'JA');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`bestelling_id`),
  ADD KEY `bestelling_ibfk_1` (`klant_id`),
  ADD KEY `bestelling_ibfk_2` (`tafel_id`),
  ADD KEY `bestelling_ibfk_3` (`product_id`),
  ADD KEY `bestelling_ibfk_4` (`Prijs`),
  ADD KEY `bestelling_ibfk_5` (`ReserveringID`);

--
-- Indexen voor tabel `bon`
--
ALTER TABLE `bon`
  ADD PRIMARY KEY (`bonnr`),
  ADD KEY `omschrijving` (`omschrijving`),
  ADD KEY `prijs` (`prijs`),
  ADD KEY `BTW` (`BTW`),
  ADD KEY `bon_ibfk_1` (`tafel_id`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`),
  ADD UNIQUE KEY `prijs` (`prijs`),
  ADD UNIQUE KEY `omschrijving` (`omschrijving`);

--
-- Indexen voor tabel `reservering`
--
ALTER TABLE `reservering`
  ADD PRIMARY KEY (`ReserveringID`),
  ADD KEY `reservering_ibfk_1` (`Tafel`),
  ADD KEY `reservering_ibfk_2` (`klantId`);

--
-- Indexen voor tabel `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`TafelId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestelling`
--
ALTER TABLE `bestelling`
  MODIFY `bestelling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `bon`
--
ALTER TABLE `bon`
  MODIFY `bonnr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `reservering`
--
ALTER TABLE `reservering`
  MODIFY `ReserveringID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `TafelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `bestelling_ibfk_1` FOREIGN KEY (`klant_id`) REFERENCES `reservering` (`klantId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bestelling_ibfk_2` FOREIGN KEY (`tafel_id`) REFERENCES `reservering` (`Tafel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bestelling_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bestelling_ibfk_4` FOREIGN KEY (`Prijs`) REFERENCES `product` (`prijs`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bestelling_ibfk_5` FOREIGN KEY (`ReserveringID`) REFERENCES `reservering` (`ReserveringID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `bon`
--
ALTER TABLE `bon`
  ADD CONSTRAINT `bon_ibfk_1` FOREIGN KEY (`tafel_id`) REFERENCES `reservering` (`Tafel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bon_ibfk_2` FOREIGN KEY (`omschrijving`) REFERENCES `product` (`omschrijving`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bon_ibfk_3` FOREIGN KEY (`prijs`) REFERENCES `product` (`prijs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `reservering`
--
ALTER TABLE `reservering`
  ADD CONSTRAINT `reservering_ibfk_1` FOREIGN KEY (`Tafel`) REFERENCES `restaurant` (`TafelId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservering_ibfk_2` FOREIGN KEY (`klantId`) REFERENCES `klanten` (`klantId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
