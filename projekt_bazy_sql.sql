-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Sie 2021, 16:53
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt_bazy_sql`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `samochody`
--

CREATE TABLE `samochody` (
  `id` int(11) NOT NULL,
  `Marka_samochodu` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `Numer_silnika` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `Numer_nadwozia` varchar(17) COLLATE utf8_polish_ci DEFAULT NULL,
  `Kolor` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `Rok_produkcji` year(4) DEFAULT NULL,
  `id_wlasciciela` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `samochody`
--

INSERT INTO `samochody` (`id`, `Marka_samochodu`, `Numer_silnika`, `Numer_nadwozia`, `Kolor`, `Rok_produkcji`, `id_wlasciciela`) VALUES
(1, 'Audi S3', 'BMM1234', 'B12345M123S4K', 'Pomarańczowy', 2015, 1),
(2, 'Ford Focus RS', 'BNM563', '123456789M', 'Niebieski', 2016, 2),
(3, 'Alfa Romeo', 'YTF5563', 'VINESSA1234', 'Granatowy', 2005, 1),
(4, 'Audi A3', 'BNM3213123', 'VINEK12345', 'Srebrny', 2007, 4),
(9, 'Audi A3', 'BMM57867', 'WIZA96834', 'Srebrny Metalic', 2007, 5),
(10, 'Citroen', 'PFF5678', 'KMB456323', 'Czarny', 2001, 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wlasciciele`
--

CREATE TABLE `wlasciciele` (
  `Imie` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `Nazwisko` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `Numer_rejestracyjny` varchar(12) COLLATE utf8_polish_ci DEFAULT NULL,
  `Miejsce_zarejestrowania` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `id_wlasciciela` int(11) DEFAULT NULL,
  `Uwagi_do_samochodu` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wlasciciele`
--

INSERT INTO `wlasciciele` (`Imie`, `Nazwisko`, `Numer_rejestracyjny`, `Miejsce_zarejestrowania`, `id_wlasciciela`, `Uwagi_do_samochodu`) VALUES
('Kamil', 'Budda', 'DOL0875', 'Syców', 1, 'Brak uwag'),
('Wiesław', 'Maj', 'POS1234', 'Ostrów', 2, ''),
('Kacper', 'Kowalski', 'POT4212', 'Ostrzeszów', 3, 'Szybki jest'),
('Krystek', 'Kozak', 'TOS997', 'Ostrowiec Świętokrzyski', 4, 'Fajen Car'),
('Rafał', 'Mencel', 'DOL57896', 'Syców', 5, ''),
('Antek', 'Radom', 'KOT 5632', 'Radom', 6, 'Brak');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `samochody`
--
ALTER TABLE `samochody`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wlasciciele`
--
ALTER TABLE `wlasciciele`
  ADD UNIQUE KEY `id_wlasciciela` (`id_wlasciciela`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `samochody`
--
ALTER TABLE `samochody`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
