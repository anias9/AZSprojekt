-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Cze 2017, 20:00
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `azs`


CREATE DATABASE IF NOT EXISTS `azs` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `azs`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tartykuly`
--

CREATE TABLE `tartykuly` (
  `id_art` int(10) UNSIGNED NOT NULL,
  `id_kat` int(10) UNSIGNED NOT NULL,
  `tytul` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `tresc` text COLLATE utf8_polish_ci NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `tartykuly`
--

INSERT INTO `tartykuly` (`id_art`, `id_kat`, `tytul`, `tresc`, `data`) VALUES
(1, 1, 'Biuro zamknięte 16 czerwca', 'Informujemy, iż w dniu 16 czerwca (piątek) biuro Organizacji Środowiskowej AZS będzie zamknięte.\r\n\r\nZa utrudnienia przepraszamy i zapraszamy w innym terminie.', '2017-06-07 15:20:06'),
(2, 2, 'Koszykówka na ulicy', 'Koszykarki i koszykarze mimo zakończenia sezonu \"pod dachem\", będą mieli  jeszcze jedną okazję, aby się ze sobą zmierzyć. Akademickie Mistrzostwa Śląska w Streetbaskecie, bo o nich mowa, odbędą się 20 maja w Ośrodku Sportowym \"Słowian\" w Katowicach od godz. 11:00.\r\n\r\nNa zawody zapraszamy także kibiców - pogoda ma być wyśmienita ;)', '2017-06-07 15:21:51'),
(3, 2, '501 d.o. ', 'Zapraszamy serdecznie na Akademickie Mistrzostwa Śląska w Darcie. Zawody odbędą się 23 maja w Pubie Sportowym przy Alei Róż 3 w Dąbrowie Górniczej. Początek rywalizacji o godz. 15.00.\r\n\r\nZgłoszenia prosimy przysyłać drogą elektroniczną do dnia 19 maja na adres msadowski@wsb.edu.pl', '2017-06-07 15:22:21'),
(4, 1, 'Godziny pracy biura', 'Informujemy, iż od 1 lutego 2017 r. zmianie ulegają godziny pracy biura Organizacji Środowiskowej AZS Katowice.<br />\r\nZapraszamy:<br />\r\nw poniedziałki, czwartki w godz. 8:00 - 17:00,<br />\r\nwe wtorki, środy, piątki w godz. 8:00 - 16:00.', '2017-06-07 15:24:18'),
(5, 2, 'Kto pierwszy...', 'Rywalizacja w ramach Akademickich Mistrzostw Śląska we Wspinaczce Sportowej rozstrzygnie się 10 marca. III edycja zawodów - wspinaczka na czas, odbędzie się na ścianie wspinaczkowej Klif przy Parku Wodnym w Tarnowskich Górach (ul. Obwodnica 8).<br />\r\n<br />\r\nZgłoszenia przyjmowane są do 7 marca pod adresem katowice@azs.pl', '2017-06-07 15:24:52');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tkategorie`
--

CREATE TABLE `tkategorie` (
  `id_kat` int(10) UNSIGNED NOT NULL,
  `nazwa_kategorii` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `tkategorie`
--

INSERT INTO `tkategorie` (`id_kat`, `nazwa_kategorii`) VALUES
(1, 'Ogólne'),
(2, 'Zawody');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tstudenci`
--

CREATE TABLE `tstudenci` (
  `id_student` int(11) NOT NULL,
  `id_uzytkownik` int(11) NOT NULL,
  `nr_legitymacji` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `imie` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `data_urodzenia` date NOT NULL,
  `telefon` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
  `kierunek_studiow` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `tstudenci`
--

INSERT INTO `tstudenci` (`id_student`, `id_uzytkownik`, `nr_legitymacji`, `imie`, `nazwisko`, `data_urodzenia`, `telefon`, `kierunek_studiow`, `email`) VALUES
(2, 2, '127297', 'Adrian', 'Borowski', '1995-11-09', '792084039', 'Informatyka i ekonometria', 'adik_borowski@tlen.pl'),
(3, 3, '123456', 'Edyta', 'Gorniak', '1972-11-14', '123456789', 'Informatyka i ekonometria', 'e.gorniak@gmail.com'),
(4, 4, '111111', 'sdvsv', 'xvxc', '2017-06-07', '123456789', 'xyz', 'adrian.borowski@edu.uekat.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ttrenerzy`
--

CREATE TABLE `ttrenerzy` (
  `id_trener` int(11) NOT NULL,
  `id_uzytkownik` int(11) NOT NULL,
  `nr_pracownika` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `imie` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ttreningi`
--

CREATE TABLE `ttreningi` (
  `id_trening` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_trener` int(11) NOT NULL,
  `data` date NOT NULL,
  `dyscyplina` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `miejsce` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tuzytkownicy`
--

CREATE TABLE `tuzytkownicy` (
  `id_uzytkownik` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
  `haslo` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL,
  `uprawnienia` char(1) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `tuzytkownicy`
--

INSERT INTO `tuzytkownicy` (`id_uzytkownik`, `login`, `haslo`, `uprawnienia`) VALUES
(2, '127297', 'ab497ff5667192a8320fb889d289388f8d2166ba', '0'),
(3, '123456', 'ab497ff5667192a8320fb889d289388f8d2166ba', '0'),
(4, '111111', 'ab497ff5667192a8320fb889d289388f8d2166ba', '0');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `tartykuly`
--
ALTER TABLE `tartykuly`
  ADD PRIMARY KEY (`id_art`),
  ADD KEY `id_kat` (`id_kat`);

--
-- Indexes for table `tkategorie`
--
ALTER TABLE `tkategorie`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indexes for table `tstudenci`
--
ALTER TABLE `tstudenci`
  ADD PRIMARY KEY (`id_student`),
  ADD KEY `id_uzytkownik` (`id_uzytkownik`);

--
-- Indexes for table `ttrenerzy`
--
ALTER TABLE `ttrenerzy`
  ADD PRIMARY KEY (`id_trener`),
  ADD KEY `id_uzytkownik` (`id_uzytkownik`);

--
-- Indexes for table `ttreningi`
--
ALTER TABLE `ttreningi`
  ADD PRIMARY KEY (`id_trening`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `id_trener` (`id_trener`);

--
-- Indexes for table `tuzytkownicy`
--
ALTER TABLE `tuzytkownicy`
  ADD PRIMARY KEY (`id_uzytkownik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `tartykuly`
--
ALTER TABLE `tartykuly`
  MODIFY `id_art` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `tkategorie`
--
ALTER TABLE `tkategorie`
  MODIFY `id_kat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `tstudenci`
--
ALTER TABLE `tstudenci`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `ttrenerzy`
--
ALTER TABLE `ttrenerzy`
  MODIFY `id_trener` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `ttreningi`
--
ALTER TABLE `ttreningi`
  MODIFY `id_trening` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `tuzytkownicy`
--
ALTER TABLE `tuzytkownicy`
  MODIFY `id_uzytkownik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `tartykuly`
--
ALTER TABLE `tartykuly`
  ADD CONSTRAINT `id_kat` FOREIGN KEY (`id_kat`) REFERENCES `tkategorie` (`id_kat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `tstudenci`
--
ALTER TABLE `tstudenci`
  ADD CONSTRAINT `tstudenci_ibfk_1` FOREIGN KEY (`id_uzytkownik`) REFERENCES `tuzytkownicy` (`id_uzytkownik`);

--
-- Ograniczenia dla tabeli `ttrenerzy`
--
ALTER TABLE `ttrenerzy`
  ADD CONSTRAINT `ttrenerzy_ibfk_1` FOREIGN KEY (`id_uzytkownik`) REFERENCES `tuzytkownicy` (`id_uzytkownik`);

--
-- Ograniczenia dla tabeli `ttreningi`
--
ALTER TABLE `ttreningi`
  ADD CONSTRAINT `ttreningi_ibfk_1` FOREIGN KEY (`id_trener`) REFERENCES `ttrenerzy` (`id_trener`),
  ADD CONSTRAINT `ttreningi_ibfk_2` FOREIGN KEY (`id_student`) REFERENCES `tstudenci` (`id_student`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
