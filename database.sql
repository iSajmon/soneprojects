-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 11:30 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `name`, `password`) VALUES
(1, 'admin', '$2y$10$p0d53j37mCXFHvzFYO73hufzIRbexKe/i7Wp2esZ3wHsqgJAkL2T2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conowego`
--

CREATE TABLE `conowego` (
  `id` int(11) NOT NULL,
  `data` varchar(10) DEFAULT date_format(curdate(),'%d-%m-%Y'),
  `zmiany` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conowego`
--

INSERT INTO `conowego` (`id`, `data`, `zmiany`) VALUES
(1, '26-11-2023', 'Dodano sekcję wyróżnionych projektów, Dodano sekcję wszystkich projektów, Dodano niekompletny projekt \"Kalkulator paliwa\", Dodano podstronę z aktualizacjami'),
(2, '13-03-2024', 'Dodano stronę \"Kalkulator paliwa\" w wersji demo, Odświeżono logo strony, Dodano tryb ciemny, Dodano plakietki określające stan projektu'),
(3, '17-03-2024', 'Dodano projekt ukończony \"Kalkulator paliwa\" w wersji 1.0, Nowe funkcje w najbliższej przyszłości, Zmieniono kolory poszczególnych plakietek'),
(4, '29-03-2024', 'Zaktualizowano stronę \"Whats New\", Zmieniono czcionkę poszczególnych elementów, Została zakupiona oraz podpięta pod projekt domena \"soneprojects.com\", Zmieniono logo strony oraz dodano logo podczas wysyłania linku'),
(5, '19-04-2024', 'Zaktualizowano stopkę strony głównej, Dodano podstronę \"plans\" na której będą umieszczane plany na rozwój strony'),
(6, '22-09-2024', 'Dodano nowy projekt \"Kalkulator Argusów\"'),
(7, '09-11-2024', 'Dodano projekt \"Study Timer\", Zaktualizowano wygląd strony, Zmieniono generowanie stron na skrypty PhP, Dodano panel administratora, Podłączono github i opublikowano niektóre projekty'),
(8, '09-11-2024', 'Zautomatyzowano plakietki projektów'),
(9, '12-11-2024', 'Dodano nowe grafiki dla planowanych aktualizacji i projektów'),
(10, '25-11-2024', 'Dodano licznik wizyt na stronie, Odświeżono wygląd podstron \"Co nowego?\" oraz \"Plany\", Odświezono wygląd przełącznika motywu jasny/ciemny na bardziej intuicyjny oraz naprawiono błąd powodujący opóźnioną zmianę motywu podczas pierwszego wejscia na stronę, Rozpozpoczęto pracę nad podstronami \"Biblioteka Github\" oraz \"Dowiedz się więcej\"'),
(11, '25-11-2024', 'Dodano nieukończony projekt \"soneque\"');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `githublinks`
--

CREATE TABLE `githublinks` (
  `id` int(11) NOT NULL,
  `id_projektu` int(11) DEFAULT NULL,
  `LINK` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `githublinks`
--

INSERT INTO `githublinks` (`id`, `id_projektu`, `LINK`) VALUES
(1, 5, 'https://github.com/iSajmon/Kalkulator-Paliwa'),
(2, 6, 'https://github.com/iSajmon/Kalkulator-Argusow'),
(3, 7, 'https://github.com/iSajmon/StudyTimer');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `newupdate`
--

CREATE TABLE `newupdate` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newupdate`
--

INSERT INTO `newupdate` (`id`, `data`) VALUES
(1, '2024-11-25');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `plany`
--

CREATE TABLE `plany` (
  `id` int(11) NOT NULL,
  `tytul` varchar(255) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `ukonczone` tinyint(1) DEFAULT 0,
  `przewidywanaData` date DEFAULT NULL,
  `dataUkonczenia` date DEFAULT NULL,
  `zdjecie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plany`
--

INSERT INTO `plany` (`id`, `tytul`, `opis`, `ukonczone`, `przewidywanaData`, `dataUkonczenia`, `zdjecie`) VALUES
(1, 'Plans & stopka', 'Dodanie strony z planami oraz zmodyfikowanie stopki na stronie głównej', 1, NULL, '2024-02-14', 'gear.png'),
(2, 'Project \"friday\"', 'Brak danych na temat ukończenia projektu', 0, NULL, NULL, 'fridayLogo.png'),
(3, 'Untitled Helldivers minigame', 'Przeglądarkowy minigame oparty o grę Helldivers II', 0, NULL, NULL, 'helldivers.png'),
(4, 'Zapisanie samochodu', 'Rozbudowanie projektu \"Kalkulator Paliwa\" o możliwość zapisywania własnego samochodu', 0, '2024-12-31', NULL, 'car.png'),
(5, 'Ciasteczka', 'Dodanie ciasteczek zapisujących motyw strony głównej (jasny/ciemny)', 1, '2024-04-01', '2024-04-18', 'cookies.png'),
(6, 'Modernizacja strony głównej', 'Ogolna modernizacja strony głównej i powiązanych z nią podstron', 1, '2024-11-15', '2024-11-10', 'gear.png'),
(9, 'Update StudyTimer', 'Aktualizacja projektu “StudyTimer” dodająca motywy strony oraz aktualizująca wygląd mobilny ', 0, '2024-11-30', NULL, 'projectUpdate.jpg'),
(11, 'Planner dnia ', 'Aplikacja pozwalająca na zaplanowanie czasu w danym dniu ', 0, '2025-01-15', NULL, 'projectPlan.jpg'),
(12, 'Tic Tac Toe', 'Prosta gra przeglądarkowa w Kółko i krzyżyk', 0, '2025-02-15', NULL, 'projectPlan.jpg'),
(13, 'Chat', 'Prosty chat', 0, '2025-01-20', NULL, 'projectPlan.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `badge` varchar(10) DEFAULT NULL COMMENT '0 - PC OLNY\r\n1 - BETA',
  `description` text DEFAULT NULL,
  `showcase` text NOT NULL,
  `lastUpdate` date DEFAULT NULL,
  `dominantColor` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='0 - PC OLNY';

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `nazwa`, `url`, `photo`, `badge`, `description`, `showcase`, `lastUpdate`, `dominantColor`) VALUES
(1, 'Zaproszenie', '18', 'p18.jpg', '', 'Zaproszenie na 18 urodziny', 'yes', '2023-05-25', NULL),
(2, 'PORTAL', 'portal', 'pportal.jpg', '0', 'Projekt szkolny', '', NULL, 'rgba(128, 205, 230)'),
(3, 'PLACEHOLDER', 'BB', 'BB.jpg', '', 'TEMPORARY PLACEHOLDER', '', NULL, 'rgba(128, 205, 230, 0.30)'),
(4, 'MULTIVERSE', 'multiverse', 'MULTIVERSE.jpg', '0', 'Projekt szkolny', '', NULL, 'rgba(128, 205, 230, 0.30)'),
(5, 'Kalkulator Paliwa', 'spalaniePaliwa', 'kp.jpg', '1', 'Kalkulator obliczający cenę paliwa dla danej trasy', 'yes', NULL, 'rgba(128, 205, 230)'),
(6, 'Kalkulator Argusów', 'kalkulatorArgusow', 'ka.jpg', '', 'Przelicznik argusów na pln', 'yes', '2024-10-15', 'rgba(108, 166, 118, 0.30)'),
(7, 'STUDY TIMER', 'studyTimer', 'st.jpg', '', 'Timer pomodoro', 'yes', '2024-11-09', 'rgba(209, 97, 87, 0.30);'),
(8, 'soneque', 'soneque', 'soneque.jpg', '0,2', 'Projekt w trakcie towrzenia', '', '2024-11-25', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `visitorsToday` int(11) NOT NULL DEFAULT 0,
  `visitorsTotal` int(11) NOT NULL DEFAULT 0,
  `currentDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `visitorsToday`, `visitorsTotal`, `currentDate`) VALUES
(1, 2, 114, '2024-12-02');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `conowego`
--
ALTER TABLE `conowego`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `githublinks`
--
ALTER TABLE `githublinks`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `newupdate`
--
ALTER TABLE `newupdate`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `plany`
--
ALTER TABLE `plany`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `conowego`
--
ALTER TABLE `conowego`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `githublinks`
--
ALTER TABLE `githublinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `newupdate`
--
ALTER TABLE `newupdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plany`
--
ALTER TABLE `plany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
