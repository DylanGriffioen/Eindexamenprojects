-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 sep 2017 om 07:17
-- Serverversie: 5.7.14
-- PHP-versie: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examendatabase`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `aanvragen`
--

CREATE TABLE `aanvragen` (
  `idAanvraag` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `reden` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `aanvragen`
--

INSERT INTO `aanvragen` (`idAanvraag`, `idUser`, `idProduct`, `reden`) VALUES
(7, 16, 985637, 'ik wil er nog een hebben'),
(8, 11, 985633, 'Ik wil er nog een hebben'),
(9, 22, 985632, 'test'),
(10, 25, 985632, 'Mijn oude intercity is kapot gegaan');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `betaalwijze`
--

CREATE TABLE `betaalwijze` (
  `idBetaalwijze` int(11) NOT NULL,
  `naam` varchar(80) NOT NULL,
  `beschrijving` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `betaalwijze`
--

INSERT INTO `betaalwijze` (`idBetaalwijze`, `naam`, `beschrijving`) VALUES
(1, 'iDeal', 'iDeal'),
(2, 'Mastercard', 'Mastercard'),
(3, 'Paypal', 'Paypal'),
(4, 'Overboeking', 'Overboeking');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `idContact` int(11) NOT NULL,
  `naam` varchar(80) NOT NULL,
  `emailAdres` varchar(80) NOT NULL,
  `telefoonNummer` varchar(80) NOT NULL,
  `bericht` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `contact`
--

INSERT INTO `contact` (`idContact`, `naam`, `emailAdres`, `telefoonNummer`, `bericht`) VALUES
(4, '1', '1@1.1', '1', '1'),
(5, '1', '2', '3', '4124'),
(6, '23', '324', '42141', '4214');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `favorieten`
--

CREATE TABLE `favorieten` (
  `idFavoriet` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `favorieten`
--

INSERT INTO `favorieten` (`idFavoriet`, `idProduct`, `idUser`) VALUES
(10, 4, 11),
(11, 985632, 11),
(12, 4, 18),
(13, 985632, 18);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klacht`
--

CREATE TABLE `klacht` (
  `idKlacht` int(11) NOT NULL,
  `idUserKlacht` int(11) NOT NULL,
  `klacht` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klacht`
--

INSERT INTO `klacht` (`idKlacht`, `idUserKlacht`, `klacht`) VALUES
(1, 22, 'resr');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order`
--

CREATE TABLE `order` (
  `idOrder` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `totaalPrijs` float NOT NULL,
  `orderdatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `order`
--

INSERT INTO `order` (`idOrder`, `idUser`, `totaalPrijs`, `orderdatum`) VALUES
(51, 25, 70, '2017-09-08');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orderregel`
--

CREATE TABLE `orderregel` (
  `idOrderregel` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `prijsOr` float NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `orderregel`
--

INSERT INTO `orderregel` (`idOrderregel`, `idProduct`, `idOrder`, `prijsOr`, `aantal`) VALUES
(31, 4, 47, 15, 3),
(32, 985635, 47, 20, 1),
(33, 985633, 48, 30, 2),
(34, 1, 48, 20, 1),
(35, 4, 48, 10, 1),
(36, 985633, 47, 45, 3),
(37, 4, 47, 10, 1),
(39, 985633, 47, 45, 3),
(40, 4, 47, 10, 1),
(41, 985635, 47, 40, 2),
(42, 1, 51, 40, 2),
(43, 985634, 51, 30, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `idProduct` int(11) NOT NULL,
  `naam` varchar(80) NOT NULL,
  `beschrijving` varchar(80) NOT NULL,
  `prijs` float NOT NULL,
  `foto` varchar(100) NOT NULL,
  `beschikbaar` tinyint(1) NOT NULL,
  `aantalBeschikbaar` int(11) NOT NULL,
  `aantalVerkocht` int(11) NOT NULL,
  `aanvragen` int(11) NOT NULL,
  `datumVerwijdering` date NOT NULL,
  `type` int(11) NOT NULL,
  `dagProduct` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`idProduct`, `naam`, `beschrijving`, `prijs`, `foto`, `beschikbaar`, `aantalBeschikbaar`, `aantalVerkocht`, `aanvragen`, `datumVerwijdering`, `type`, `dagProduct`) VALUES
(1, 'Flirt', 'De nieuwste soort', 20, 'trein1.jpg', 1, 15, 8, 0, '0000-00-00', 3, 0),
(4, 'Sprinter', 'Gemaakt voor korte stukjes', 10, 'trein2.jpg', 0, 14, 26, 0, '2017-06-19', 1, 0),
(985632, 'Intercity', 'Stopt alleen bij de grote steden', 30, 'trein3.jpg', 1, 8, 10, 2, '0000-00-00', 2, 0),
(985633, 'Intercity', 'Stopt alleen bij de grote steden', 30, 'trein3.jpg', 1, 7, 16, 1, '2017-06-16', 2, 1),
(985634, 'Sprinter', 'Gemaakt voor korte stukjes', 10, 'trein2.jpg', 1, 31, 9, 0, '0000-00-00', 1, 0),
(985635, 'Flirt', 'De nieuwste soort', 20, 'trein1.jpg', 1, 43, 19, 0, '2017-06-18', 3, 0),
(985636, 'Sprinter', 'Gemaakt voor korte stukjes', 10, 'trein2.jpg', 1, 27, 12, 0, '0000-00-00', 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rollen`
--

CREATE TABLE `rollen` (
  `idRol` int(11) NOT NULL,
  `naam` varchar(80) NOT NULL,
  `beschrijving` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `rollen`
--

INSERT INTO `rollen` (`idRol`, `naam`, `beschrijving`) VALUES
(1, 'Admin', 'Admin kan alles'),
(2, 'Klant', 'Klant kan niet alles'),
(3, 'Verkoopleidster', 'Gaat over alle verkopen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `type`
--

CREATE TABLE `type` (
  `idType` int(11) NOT NULL,
  `naam` varchar(80) NOT NULL,
  `beschrijving` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `type`
--

INSERT INTO `type` (`idType`, `naam`, `beschrijving`) VALUES
(1, 'Sprinter', 'Dit is een sprinter'),
(2, 'Intercity', 'Dit is een intercity'),
(3, 'Flirt', 'Dit is een flirt');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `naam` varchar(80) NOT NULL,
  `emailAdres` varchar(80) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `adres` varchar(80) NOT NULL,
  `woonplaats` varchar(80) NOT NULL,
  `betaalwijze` int(11) NOT NULL,
  `rol` int(11) NOT NULL,
  `geactiveerd` tinyint(1) NOT NULL,
  `activatiedatum` date NOT NULL,
  `geblokkeerd` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`idUser`, `naam`, `emailAdres`, `wachtwoord`, `adres`, `woonplaats`, `betaalwijze`, `rol`, `geactiveerd`, `activatiedatum`, `geblokkeerd`) VALUES
(11, '4', '4@4.4', '098f6bcd4621d373cade4e832627b4f6', '4', 'test', 2, 1, 1, '2017-06-13', 0),
(13, 'Jan de Vries', 'Jan.DeVries@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Schiestraat18', 'Utrecht', 2, 2, 1, '2017-06-13', 0),
(18, 'testuser', 'test@user.com', '5d9c68c6c50ed3d02a2fcf54f63993b6', 'testuser', 'testuser', 1, 2, 1, '2017-08-22', 0),
(22, 'Jan De Vries', 'JanDeVries@Gmail.com', '9f7442d9f1e42e43bcf878c84ca2a615', 'Vaartstraat 18', 'Rotterdam', 4, 2, 1, '2017-09-07', 0),
(23, 'Willie Powers', 'Willie.Powers@Gmail.com', '4376e7989d1c17f44febfaa68a251cc3', 'Schiestraat 21', 'Culemborg', 2, 1, 1, '2017-09-07', 0),
(24, 'Herman Brood', 'Herman.Brood@gmail.com', 'a279765cc0baa277cbdb50ff81fda3e2', 'Gouwestraat 1', 'Amsterdam', 3, 3, 1, '2017-09-07', 0),
(25, 'Dylan Griffioen', 'Dylan.griffioen@gmail.com', '701f33b8d1366cde9cb3822256a62c01', 'Schiestraat 18', 'Culemborg', 3, 2, 1, '2017-09-08', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `winkelmand`
--

CREATE TABLE `winkelmand` (
  `idWinkelmand` int(11) NOT NULL,
  `idUserWm` int(11) NOT NULL,
  `idProductWm` int(11) NOT NULL,
  `aantalWm` int(11) NOT NULL,
  `dagProductWm` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `winkelmand`
--

INSERT INTO `winkelmand` (`idWinkelmand`, `idUserWm`, `idProductWm`, `aantalWm`, `dagProductWm`) VALUES
(46, 19, 4, 1, 0),
(47, 19, 1, 2, 0),
(48, 19, 985633, 2, 1),
(58, 18, 985633, 1, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `aanvragen`
--
ALTER TABLE `aanvragen`
  ADD PRIMARY KEY (`idAanvraag`),
  ADD KEY `fk_Aanvragen_Users_idx` (`idUser`),
  ADD KEY `fk_Aanvragen_Producten_idx` (`idProduct`);

--
-- Indexen voor tabel `betaalwijze`
--
ALTER TABLE `betaalwijze`
  ADD PRIMARY KEY (`idBetaalwijze`);

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`idContact`);

--
-- Indexen voor tabel `favorieten`
--
ALTER TABLE `favorieten`
  ADD PRIMARY KEY (`idFavoriet`),
  ADD KEY `fk_Favorieten_Producten` (`idProduct`),
  ADD KEY `fk_Favorieten_Users` (`idUser`);

--
-- Indexen voor tabel `klacht`
--
ALTER TABLE `klacht`
  ADD PRIMARY KEY (`idKlacht`);

--
-- Indexen voor tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `fk_Order_Users` (`idUser`) USING BTREE;

--
-- Indexen voor tabel `orderregel`
--
ALTER TABLE `orderregel`
  ADD PRIMARY KEY (`idOrderregel`),
  ADD KEY `Fk_Orderregel_Producten_idx` (`idProduct`),
  ADD KEY `Fk_Orderregel_Order_idx` (`idOrder`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `fk_Producten_genre_idx` (`type`);

--
-- Indexen voor tabel `rollen`
--
ALTER TABLE `rollen`
  ADD PRIMARY KEY (`idRol`);

--
-- Indexen voor tabel `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`idType`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `fk_Users_Betaalwijze` (`betaalwijze`),
  ADD KEY `fk_Users_Rollen` (`rol`);

--
-- Indexen voor tabel `winkelmand`
--
ALTER TABLE `winkelmand`
  ADD PRIMARY KEY (`idWinkelmand`),
  ADD KEY `idProduct` (`idProductWm`),
  ADD KEY `idUser` (`idUserWm`),
  ADD KEY `idUser_2` (`idUserWm`),
  ADD KEY `idProduct_2` (`idProductWm`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `aanvragen`
--
ALTER TABLE `aanvragen`
  MODIFY `idAanvraag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT voor een tabel `betaalwijze`
--
ALTER TABLE `betaalwijze`
  MODIFY `idBetaalwijze` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `idContact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `favorieten`
--
ALTER TABLE `favorieten`
  MODIFY `idFavoriet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT voor een tabel `klacht`
--
ALTER TABLE `klacht`
  MODIFY `idKlacht` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `order`
--
ALTER TABLE `order`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT voor een tabel `orderregel`
--
ALTER TABLE `orderregel`
  MODIFY `idOrderregel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=985637;
--
-- AUTO_INCREMENT voor een tabel `rollen`
--
ALTER TABLE `rollen`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT voor een tabel `winkelmand`
--
ALTER TABLE `winkelmand`
  MODIFY `idWinkelmand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_Order_Users` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD CONSTRAINT `fk_Producten_genre` FOREIGN KEY (`type`) REFERENCES `type` (`idType`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_Users_Betaalwijze` FOREIGN KEY (`betaalwijze`) REFERENCES `betaalwijze` (`idBetaalwijze`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Users_Rollen` FOREIGN KEY (`rol`) REFERENCES `rollen` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
