-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 jun 2022 om 08:36
-- Serverversie: 10.4.20-MariaDB
-- PHP-versie: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deboerlicht`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorieen`
--

CREATE TABLE `categorieen` (
  `CategorieID` int(11) NOT NULL,
  `Categorie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `categorieen`
--

INSERT INTO `categorieen` (`CategorieID`, `Categorie`) VALUES
(1, 'Stalampen'),
(2, 'Hanglampen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `ID` int(11) NOT NULL,
  `Categorie_ID` int(11) NOT NULL,
  `ProductNaam` varchar(100) NOT NULL,
  `Prijs` int(11) NOT NULL,
  `Korting` int(11) NOT NULL,
  `Beschikbaar` int(11) NOT NULL,
  `Tekst` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`ID`, `Categorie_ID`, `ProductNaam`, `Prijs`, `Korting`, `Beschikbaar`, `Tekst`) VALUES
(26, 1, 'Lamp1', 2, 5, 9, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venena'),
(27, 1, 'Lamp2', 4, 10, 95, 'Dit is de tweede lamp'),
(28, 2, 'Lamp3', 6, 0, 467, 'Dit is de derdelamp'),
(29, 2, 'Lamp4', 65, 1, 4673, 'Dit is de vierde lamp');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `productfoto`
--

CREATE TABLE `productfoto` (
  `ID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `productfoto`
--

INSERT INTO `productfoto` (`ID`, `ProductID`, `Foto`) VALUES
(11, 26, '../Fotos/Lamp1.png'),
(12, 26, '../Fotos/Lamp2.png'),
(13, 27, '../Fotos/Lamp3.png'),
(14, 27, '../Fotos/Lamp4.png'),
(15, 28, '../Fotos/Lamp5.png'),
(16, 28, '../Fotos/Lamp6.png'),
(17, 29, '../Fotos/Lamp7.png'),
(18, 29, '../Fotos/Lamp8.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Admin', 'Admin@admin.nl', 'Admin');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categorieen`
--
ALTER TABLE `categorieen`
  ADD PRIMARY KEY (`CategorieID`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Categorieen` (`Categorie_ID`);

--
-- Indexen voor tabel `productfoto`
--
ALTER TABLE `productfoto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Foto` (`ProductID`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categorieen`
--
ALTER TABLE `categorieen`
  MODIFY `CategorieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT voor een tabel `productfoto`
--
ALTER TABLE `productfoto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD CONSTRAINT `Categorieen` FOREIGN KEY (`Categorie_ID`) REFERENCES `categorieen` (`CategorieID`);

--
-- Beperkingen voor tabel `productfoto`
--
ALTER TABLE `productfoto`
  ADD CONSTRAINT `Foto` FOREIGN KEY (`ProductID`) REFERENCES `producten` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
