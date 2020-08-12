-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Cze 2018, 06:39
-- Wersja serwera: 10.1.29-MariaDB
-- Wersja PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wypozyczalnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `filmy`
--

CREATE TABLE `filmy` (
  `id` int(11) NOT NULL,
  `Nosnik` int(1) NOT NULL,
  `tytul` varchar(50) NOT NULL,
  `Rok_produkcji` int(4) NOT NULL,
  `rezyser` int(5) NOT NULL,
  `gatunek` int(3) NOT NULL,
  `Opis` text,
  `Cena` int(3) NOT NULL,
  `kara` int(3) NOT NULL,
  `plakat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `filmy`
--

INSERT INTO `filmy` (`id`, `Nosnik`, `tytul`, `Rok_produkcji`, `rezyser`, `gatunek`, `Opis`, `Cena`, `kara`, `plakat`) VALUES
(1, 1, 'Avangers', 2012, 1, 1, 'Grupa superbohaterów, na czele z Thorem, Iron Manem i Hulkiem, łączy siły, by obronić Ziemię przed inwazją kosmitów.', 12, 8, 1),
(2, 1, 'Shrek', 2001, 1, 1, 'By odzyskać swój dom, brzydki ogr z gadatliwym osłem wyruszają uwolnić piękną księżniczkę.', 5, 5, 2),
(3, 1, 'Titanic', 1997, 3, 5, 'Rok 1912, brytyjski statek Titanic wyrusza w swój dziewiczy rejs do USA. Na pokładzie emigrant Jack przypadkowo spotyka arystokratkę Rose. ', 4, 2, 3),
(4, 2, 'Gwiezdne wojny: Przebudzenie mocy', 2015, 4, 6, 'Złe Imperium zostaje zastąpione przez Najwyższy Porządek, który chce władzy nad galaktyką. Plany wrogiej organizacji może pokrzyżować Ruch Oporu.', 12, 12, 4),
(5, 1, 'Wladca pierscieni:druzyna pierscienia', 2001, 5, 7, NULL, 10, 5, 5),
(6, 2, 'Pacific Rim', 2013, 7, 1, NULL, 12, 12, 7),
(7, 1, 'Kewin sam w domu', 1990, 1, 3, 'Kewin zostaje sam w domu', 8, 2, 6),
(8, 2, 'Dr. Strange', 2016, 8, 1, 'Potężny czarodziej doktor Strange walczy z siłami ciemności, aby ocalić świat.', 8, 4, 8),
(29, 2, 'Resident Evil', 2002, 10, 2, NULL, 12, 7, 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gatunek`
--

CREATE TABLE `gatunek` (
  `Id_g` int(11) NOT NULL,
  `gatunek` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `gatunek`
--

INSERT INTO `gatunek` (`Id_g`, `gatunek`) VALUES
(1, 'Akcja'),
(2, 'horror'),
(3, 'komedia'),
(4, 'Animacja'),
(5, 'Dramat'),
(6, 'Sci-fi'),
(7, 'fantasy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `imie`
--

CREATE TABLE `imie` (
  `Id_g` int(11) NOT NULL,
  `imiona` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `imie`
--

INSERT INTO `imie` (`Id_g`, `imiona`) VALUES
(1, 'Josh'),
(2, 'Jakub'),
(3, 'Andrew'),
(4, 'James'),
(5, 'J.J.'),
(6, 'Peter'),
(7, 'Chris'),
(8, 'Szymon'),
(11, 'Milosz'),
(12, 'Marcel'),
(13, 'Tobiasz'),
(14, 'Adrian'),
(15, 'Eustachy'),
(16, 'Andrzej'),
(17, 'Jadwiga'),
(18, 'Hilary'),
(19, 'Hermiona'),
(20, 'Jolanta'),
(21, 'Julia'),
(22, 'Timur'),
(23, 'Krzysztof'),
(24, 'Marek'),
(25, 'Damian'),
(26, 'Zenona'),
(27, 'Justyna'),
(28, 'Małgorata'),
(29, 'Edyta'),
(33, 'Hubert'),
(35, '	Guillermo'),
(36, 'Scott'),
(40, 'Kewin'),
(45, 'Kajetan'),
(46, 'Serweryn'),
(47, 'Arkadiusz'),
(48, 'Kajtek'),
(58, 'Sara'),
(59, 'Karol'),
(60, 'Paul W.S.'),
(62, 'Kajtus'),
(63, 'Tobiaszowaty'),
(64, 'Kewin'),
(65, 'sd'),
(66, 'df3e'),
(67, '.km'),
(68, 'gffghggg'),
(69, 'yuhj'),
(70, 'df3eff'),
(71, 'eed'),
(72, 'Joseph');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE `klient` (
  `Id_kl` int(11) NOT NULL,
  `imie` int(11) NOT NULL,
  `nazwisko` int(11) NOT NULL,
  `miasto` int(11) NOT NULL,
  `ulica` int(11) NOT NULL,
  `kod_pocztowy` varchar(6) NOT NULL,
  `numer_domu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `klient`
--

INSERT INTO `klient` (`Id_kl`, `imie`, `nazwisko`, `miasto`, `ulica`, `kod_pocztowy`, `numer_domu`) VALUES
(1, 2, 2, 1, 1, '95-100', 12),
(2, 3, 4, 2, 2, '34-200', 4),
(3, 8, 12, 7, 1, '12-345', 54),
(4, 25, 19, 1, 5, '95-100', 3),
(6, 6, 4, 3, 2, '95-100', 3),
(7, 2, 57, 2, 3, '95-100', 3),
(8, 13, 4, 2, 1, '95-100', 12),
(9, 46, 29, 10, 12, '100-98', 13),
(17, 58, 54, 1, 10, '95-100', 14),
(18, 59, 2, 1, 16, '95-100', 55),
(19, 59, 12, 1, 17, '100-98', 12),
(22, 13, 58, 18, 21, '88-100', 123);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarze`
--

CREATE TABLE `komentarze` (
  `Id_kom` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `content` int(11) NOT NULL,
  `komentaz` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `ocena` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `komentarze`
--

INSERT INTO `komentarze` (`Id_kom`, `uzytkownik_id`, `content`, `komentaz`, `ocena`) VALUES
(9, 1, 8, 'Świetny film, polecam', 1),
(10, 3, 8, 'Dobry film, wary obejzenia, pełen akcji', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta`
--

CREATE TABLE `konta` (
  `id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `haslo` text NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Typkonta` int(1) NOT NULL,
  `klient` int(11) DEFAULT NULL,
  `aktywacja` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `konta`
--

INSERT INTO `konta` (`id`, `login`, `haslo`, `email`, `Typkonta`, `klient`, `aktywacja`) VALUES
(1, 'Nilx', '$2y$10$XD9J3GgeTko5Ju1vt16mkON5ENIHPfYialhhSiuuz8lVzxpWZpJnK', 'karol129912@wp.pl', 3, NULL, 'aktywne'),
(2, 'karole', '$2y$10$XDUM/TRoM5SVtHK8PYVwwuhE7x8GNiMoJHI7EbhZ5zau4BQk6vJCu', 'karol129912@wp.pl', 1, NULL, 'aktywne'),
(3, 'karoldsc', '$2y$10$nZNRI5o.BRo7qCAQHvFYROTVmvUb1mBgF7Eko.D/yTih63VfNSPga', 'karol129912@wp.pl', 1, NULL, 'khcgfwgyvhd'),
(4, 'Nlxad', '$2y$10$DvcRCX5NmmEkOa/fh/.DR.8O4IRKK4Jlfb1Ly4zdWG0hPDYuXcV.S', 'karolexis123@gmail.com', 1, NULL, 'khcgfwgyvhd');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `id_koszyk` int(11) NOT NULL,
  `id_kl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `koszyk`
--

INSERT INTO `koszyk` (`id_koszyk`, `id_kl`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `miasta`
--

CREATE TABLE `miasta` (
  `Id_m` int(11) NOT NULL,
  `Miasto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `miasta`
--

INSERT INTO `miasta` (`Id_m`, `Miasto`) VALUES
(1, 'Zgierz'),
(2, 'Łódź'),
(3, 'Warszawa'),
(4, 'Piotrków trybunalskich'),
(5, 'Strykow'),
(6, 'Ozorków'),
(7, 'Aleksandrów'),
(8, 'Bielsko Biała'),
(10, 'Gorlice'),
(11, 'Białystok'),
(12, 'Gdynia'),
(13, 'Szczawin'),
(14, 'Białystok'),
(16, 'Łęczyca'),
(17, 'Ozorek'),
(18, 'Berlin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nawizska`
--

CREATE TABLE `nawizska` (
  `Id_n` int(11) NOT NULL,
  `nazwiska` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nawizska`
--

INSERT INTO `nawizska` (`Id_n`, `nazwiska`) VALUES
(1, 'Whedon'),
(2, 'Przybysz'),
(3, 'Kowalski'),
(4, 'Nowak'),
(5, 'Janowski'),
(6, 'wierczynski'),
(7, 'Adams'),
(8, 'cameron'),
(9, 'Abrams'),
(10, 'Jackson'),
(11, 'Columbus'),
(12, 'Pluta'),
(13, 'Szczepanik'),
(14, 'Szczepanik'),
(15, 'Muszynski'),
(16, 'Nowka'),
(17, 'Kowalski'),
(18, 'Nowak'),
(19, 'Blaszczyk'),
(20, 'Salonkiewicz'),
(21, 'Stachurski'),
(23, 'del Toro'),
(24, 'Derrickson'),
(27, 'Bialy stok'),
(28, 'Komorowski'),
(29, 'Ochala'),
(30, 'Szpakowski'),
(42, 'Szpakowska'),
(43, 'Przytulski'),
(44, 'Smiechowski'),
(45, 'Anderson'),
(47, 'Karpiak'),
(48, 'Kajtkowski'),
(49, 'Sarkowa'),
(50, 'Sadowska'),
(51, 'Sad'),
(52, 'kvjvddf'),
(53, 'Niwdiadomiaty'),
(54, 'Świderkowska'),
(55, 'Kordegir'),
(56, 'fdfr'),
(57, 'Sadowski'),
(58, 'Paryka'),
(59, 'ffd'),
(60, 'gt');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nosnik`
--

CREATE TABLE `nosnik` (
  `Id_n` int(11) NOT NULL,
  `nosnik` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nosnik`
--

INSERT INTO `nosnik` (`Id_n`, `nosnik`) VALUES
(1, 'DvD'),
(2, 'Blue-ray');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `id_o` int(11) NOT NULL,
  `id_f` int(11) NOT NULL,
  `id_k` int(11) NOT NULL,
  `ocena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `oceny`
--

INSERT INTO `oceny` (`id_o`, `id_f`, `id_k`, `ocena`) VALUES
(4, 2, 1, 5),
(5, 3, 1, 3),
(12, 6, 1, 4),
(13, 7, 1, 3),
(14, 4, 1, 3),
(19, 8, 1, 5),
(20, 5, 4, 3),
(21, 5, 1, 5),
(22, 29, 1, 4),
(23, 1, 1, 5),
(24, 8, 3, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `plakat`
--

CREATE TABLE `plakat` (
  `id_p` int(11) NOT NULL,
  `url` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `plakat`
--

INSERT INTO `plakat` (`id_p`, `url`) VALUES
(1, 'avangers.jpg'),
(2, 'shrek.jpg'),
(3, 'titanic.jpg'),
(4, 'starwars1.jpg'),
(5, 'lotr.jpg'),
(6, 'kewin.jpg'),
(7, 'pac.jpg'),
(8, 'strang.jpg'),
(20, 'resident-evil-retrybucja-b-iext36402602.jpg'),
(24, 'bajty.PNG'),
(25, 'ppaugi.jpg'),
(26, 'ppaugi.jpg'),
(27, 'ppaugi.jpg'),
(28, 'ppaugi.jpg'),
(29, 'Bez&nbsp;tytułu.png'),
(30, 'plakaty/Bez tyddtułu.png'),
(31, 'c54.jpg'),
(32, 'Bez&nbsp;tytułu.png'),
(33, 'plakaty/Bez tyddtułu.png'),
(34, 'plakaty/Bez tyddtułu.png'),
(35, 'zgierz.jpg'),
(36, 'Bez tyddtułu.png'),
(37, ''),
(38, 'woz.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezyser`
--

CREATE TABLE `rezyser` (
  `Id_r` int(11) NOT NULL,
  `id_i` int(11) NOT NULL,
  `id_n` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `rezyser`
--

INSERT INTO `rezyser` (`Id_r`, `id_i`, `id_n`) VALUES
(1, 1, 1),
(9, 2, 44),
(2, 3, 7),
(3, 4, 8),
(4, 5, 9),
(5, 6, 10),
(6, 7, 11),
(7, 35, 23),
(8, 36, 24),
(10, 60, 45),
(11, 71, 60),
(13, 72, 12),
(14, 72, 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typ_konta`
--

CREATE TABLE `typ_konta` (
  `Id_typu` int(1) NOT NULL,
  `typ` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `typ_konta`
--

INSERT INTO `typ_konta` (`Id_typu`, `typ`) VALUES
(3, 'Administrator'),
(2, 'Moderator'),
(1, 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ulice`
--

CREATE TABLE `ulice` (
  `Id_ul` int(11) NOT NULL,
  `ulice` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ulice`
--

INSERT INTO `ulice` (`Id_ul`, `ulice`) VALUES
(1, 'Pierwszego maja'),
(2, 'Piotrkowska'),
(3, 'Łęczycka'),
(4, 'Księdza Popieluszki'),
(5, 'Smiechowskiego'),
(6, 'Smutna'),
(8, 'Ponura'),
(9, 'Piotrkowa'),
(10, 'Piotra skargi'),
(11, 'Warecka'),
(12, 'Gorlicka'),
(13, 'Traktorowa'),
(14, 'Śmieszna'),
(15, 'salowska'),
(16, 'Parzęczewska'),
(17, 'Kolejowa'),
(19, 'Parzeczewska'),
(20, 'Obornicka'),
(21, 'Pitrawa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

CREATE TABLE `wypozyczenia` (
  `Id` int(11) NOT NULL,
  `Id_k` int(11) NOT NULL,
  `data_wyp` date NOT NULL,
  `data_zwr` date NOT NULL,
  `data_odd` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`Id`, `Id_k`, `data_wyp`, `data_zwr`, `data_odd`) VALUES
(1, 1, '2018-03-08', '2018-03-15', '2013-12-11'),
(2, 2, '2018-03-08', '2018-03-15', '0000-00-00'),
(3, 3, '2018-03-01', '2018-03-07', '1999-02-12'),
(4, 4, '2018-03-07', '2018-03-08', '2039-12-03'),
(5, 4, '2018-03-07', '2018-03-08', '2018-03-08'),
(7, 6, '2018-03-12', '2018-03-16', '2018-03-18'),
(8, 8, '2018-01-09', '2018-01-16', '2018-01-16'),
(52, 17, '2018-01-03', '2018-02-09', NULL),
(53, 9, '0000-00-00', '0000-00-00', NULL),
(55, 2, '2029-12-12', '2019-12-12', '2012-12-12'),
(56, 19, '2018-04-27', '2019-12-12', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyp_filmowe`
--

CREATE TABLE `wyp_filmowe` (
  `Id_wyp_film` int(11) NOT NULL,
  `Id_wypo` int(11) NOT NULL,
  `id_filmu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `wyp_filmowe`
--

INSERT INTO `wyp_filmowe` (`Id_wyp_film`, `Id_wypo`, `id_filmu`) VALUES
(1, 1, 1),
(2, 1, 2),
(14, 1, 7),
(15, 1, 7),
(4, 2, 2),
(5, 2, 3),
(18, 2, 6),
(3, 2, 7),
(8, 3, 2),
(13, 3, 3),
(26, 3, 4),
(23, 4, 3),
(21, 4, 4),
(7, 4, 5),
(22, 4, 8),
(9, 5, 1),
(10, 5, 7),
(12, 7, 3),
(33, 7, 3),
(34, 7, 8),
(35, 7, 8),
(19, 8, 1),
(16, 8, 3),
(17, 8, 4),
(20, 8, 5),
(59, 52, 7),
(62, 53, 3),
(61, 53, 4),
(60, 53, 8),
(64, 55, 2),
(66, 55, 3),
(65, 55, 4),
(67, 55, 7),
(68, 56, 1),
(70, 56, 3),
(69, 56, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zawartosc`
--

CREATE TABLE `zawartosc` (
  `id_zawartosc` int(11) NOT NULL,
  `id_koszyk` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `zawartosc`
--

INSERT INTO `zawartosc` (`id_zawartosc`, `id_koszyk`, `id_film`, `ilosc`) VALUES
(1, 1, 3, 1),
(2, 1, 3, 1),
(3, 1, 4, 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `filmy`
--
ALTER TABLE `filmy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Nosnik` (`Nosnik`,`rezyser`,`gatunek`,`plakat`),
  ADD KEY `rezyser` (`rezyser`),
  ADD KEY `Nosnik_2` (`Nosnik`,`rezyser`),
  ADD KEY `Nosnik_3` (`Nosnik`),
  ADD KEY `plakat` (`plakat`),
  ADD KEY `gatunek` (`gatunek`);

--
-- Indexes for table `gatunek`
--
ALTER TABLE `gatunek`
  ADD PRIMARY KEY (`Id_g`);

--
-- Indexes for table `imie`
--
ALTER TABLE `imie`
  ADD PRIMARY KEY (`Id_g`);

--
-- Indexes for table `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`Id_kl`),
  ADD KEY `imie` (`imie`,`nazwisko`,`miasto`,`ulica`),
  ADD KEY `nazwisko` (`nazwisko`),
  ADD KEY `ulica` (`ulica`),
  ADD KEY `miasto` (`miasto`);

--
-- Indexes for table `komentarze`
--
ALTER TABLE `komentarze`
  ADD PRIMARY KEY (`Id_kom`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`),
  ADD KEY `content` (`content`);

--
-- Indexes for table `konta`
--
ALTER TABLE `konta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Ty konta` (`Typkonta`),
  ADD KEY `klient` (`klient`);

--
-- Indexes for table `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`id_koszyk`),
  ADD KEY `id_kl` (`id_kl`);

--
-- Indexes for table `miasta`
--
ALTER TABLE `miasta`
  ADD PRIMARY KEY (`Id_m`);

--
-- Indexes for table `nawizska`
--
ALTER TABLE `nawizska`
  ADD PRIMARY KEY (`Id_n`);

--
-- Indexes for table `nosnik`
--
ALTER TABLE `nosnik`
  ADD PRIMARY KEY (`Id_n`);

--
-- Indexes for table `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`id_o`),
  ADD KEY `id_f` (`id_f`,`id_k`),
  ADD KEY `id_k` (`id_k`);

--
-- Indexes for table `plakat`
--
ALTER TABLE `plakat`
  ADD PRIMARY KEY (`id_p`);

--
-- Indexes for table `rezyser`
--
ALTER TABLE `rezyser`
  ADD PRIMARY KEY (`Id_r`),
  ADD KEY `id_i` (`id_i`,`id_n`),
  ADD KEY `id_n` (`id_n`);

--
-- Indexes for table `typ_konta`
--
ALTER TABLE `typ_konta`
  ADD PRIMARY KEY (`Id_typu`),
  ADD KEY `typ` (`typ`);

--
-- Indexes for table `ulice`
--
ALTER TABLE `ulice`
  ADD PRIMARY KEY (`Id_ul`);

--
-- Indexes for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_k` (`Id_k`);

--
-- Indexes for table `wyp_filmowe`
--
ALTER TABLE `wyp_filmowe`
  ADD PRIMARY KEY (`Id_wyp_film`),
  ADD KEY `Id_wypo` (`Id_wypo`,`id_filmu`),
  ADD KEY `id_filmu` (`id_filmu`);

--
-- Indexes for table `zawartosc`
--
ALTER TABLE `zawartosc`
  ADD PRIMARY KEY (`id_zawartosc`),
  ADD KEY `id_koszyk` (`id_koszyk`,`id_film`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `filmy`
--
ALTER TABLE `filmy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT dla tabeli `gatunek`
--
ALTER TABLE `gatunek`
  MODIFY `Id_g` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `imie`
--
ALTER TABLE `imie`
  MODIFY `Id_g` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT dla tabeli `klient`
--
ALTER TABLE `klient`
  MODIFY `Id_kl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  MODIFY `Id_kom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `konta`
--
ALTER TABLE `konta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `id_koszyk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `miasta`
--
ALTER TABLE `miasta`
  MODIFY `Id_m` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `nawizska`
--
ALTER TABLE `nawizska`
  MODIFY `Id_n` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT dla tabeli `nosnik`
--
ALTER TABLE `nosnik`
  MODIFY `Id_n` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `oceny`
--
ALTER TABLE `oceny`
  MODIFY `id_o` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT dla tabeli `plakat`
--
ALTER TABLE `plakat`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT dla tabeli `rezyser`
--
ALTER TABLE `rezyser`
  MODIFY `Id_r` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `typ_konta`
--
ALTER TABLE `typ_konta`
  MODIFY `Id_typu` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `ulice`
--
ALTER TABLE `ulice`
  MODIFY `Id_ul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT dla tabeli `wyp_filmowe`
--
ALTER TABLE `wyp_filmowe`
  MODIFY `Id_wyp_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT dla tabeli `zawartosc`
--
ALTER TABLE `zawartosc`
  MODIFY `id_zawartosc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `filmy`
--
ALTER TABLE `filmy`
  ADD CONSTRAINT `filmy_ibfk_1` FOREIGN KEY (`Nosnik`) REFERENCES `nosnik` (`Id_n`),
  ADD CONSTRAINT `filmy_ibfk_2` FOREIGN KEY (`rezyser`) REFERENCES `rezyser` (`Id_r`),
  ADD CONSTRAINT `filmy_ibfk_3` FOREIGN KEY (`plakat`) REFERENCES `plakat` (`id_p`),
  ADD CONSTRAINT `filmy_ibfk_4` FOREIGN KEY (`gatunek`) REFERENCES `gatunek` (`Id_g`);

--
-- Ograniczenia dla tabeli `klient`
--
ALTER TABLE `klient`
  ADD CONSTRAINT `klient_ibfk_1` FOREIGN KEY (`imie`) REFERENCES `imie` (`Id_g`),
  ADD CONSTRAINT `klient_ibfk_2` FOREIGN KEY (`nazwisko`) REFERENCES `nawizska` (`Id_n`),
  ADD CONSTRAINT `klient_ibfk_3` FOREIGN KEY (`ulica`) REFERENCES `ulice` (`Id_ul`),
  ADD CONSTRAINT `klient_ibfk_4` FOREIGN KEY (`miasto`) REFERENCES `miasta` (`Id_m`);

--
-- Ograniczenia dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  ADD CONSTRAINT `komentarze_ibfk_2` FOREIGN KEY (`uzytkownik_id`) REFERENCES `konta` (`id`),
  ADD CONSTRAINT `komentarze_ibfk_3` FOREIGN KEY (`content`) REFERENCES `filmy` (`id`);

--
-- Ograniczenia dla tabeli `konta`
--
ALTER TABLE `konta`
  ADD CONSTRAINT `konta_ibfk_1` FOREIGN KEY (`Typkonta`) REFERENCES `typ_konta` (`Id_typu`),
  ADD CONSTRAINT `konta_ibfk_2` FOREIGN KEY (`klient`) REFERENCES `klient` (`Id_kl`);

--
-- Ograniczenia dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD CONSTRAINT `oceny_ibfk_2` FOREIGN KEY (`id_k`) REFERENCES `konta` (`id`),
  ADD CONSTRAINT `oceny_ibfk_3` FOREIGN KEY (`id_f`) REFERENCES `filmy` (`id`);

--
-- Ograniczenia dla tabeli `rezyser`
--
ALTER TABLE `rezyser`
  ADD CONSTRAINT `rezyser_ibfk_1` FOREIGN KEY (`id_i`) REFERENCES `imie` (`Id_g`),
  ADD CONSTRAINT `rezyser_ibfk_2` FOREIGN KEY (`id_n`) REFERENCES `nawizska` (`Id_n`);

--
-- Ograniczenia dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `wypozyczenia_ibfk_1` FOREIGN KEY (`Id_k`) REFERENCES `klient` (`Id_kl`);

--
-- Ograniczenia dla tabeli `wyp_filmowe`
--
ALTER TABLE `wyp_filmowe`
  ADD CONSTRAINT `wyp_filmowe_ibfk_1` FOREIGN KEY (`Id_wypo`) REFERENCES `wypozyczenia` (`Id`),
  ADD CONSTRAINT `wyp_filmowe_ibfk_2` FOREIGN KEY (`id_filmu`) REFERENCES `filmy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
