-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 08:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `televoto`
--

-- --------------------------------------------------------

--
-- Table structure for table `assegnazioni`
--

CREATE TABLE `assegnazioni` (
  `mac` varchar(48) NOT NULL,
  `idTelecomando` int(11) NOT NULL,
  `idVotante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assegnazioni`
--

INSERT INTO `assegnazioni` (`mac`, `idTelecomando`, `idVotante`) VALUES
('1C:69:20:CD:82:94', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `collegi`
--

CREATE TABLE `collegi` (
  `IDcollegio` int(11) NOT NULL,
  `data` date NOT NULL,
  `IDutenteAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `collegi`
--

INSERT INTO `collegi` (`IDcollegio`, `data`, `IDutenteAdmin`) VALUES
(13, '2025-05-08', 5),
(14, '2025-05-08', 6);

-- --------------------------------------------------------

--
-- Table structure for table `partecipazioni`
--

CREATE TABLE `partecipazioni` (
  `IDutenteVotante` int(11) NOT NULL,
  `IDvotazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `partecipazioni`
--

INSERT INTO `partecipazioni` (`IDutenteVotante`, `IDvotazione`) VALUES
(5, 49),
(6, 49);

-- --------------------------------------------------------

--
-- Table structure for table `risposte`
--

CREATE TABLE `risposte` (
  `IDrisposta` int(11) NOT NULL,
  `IDvotazione` int(11) NOT NULL,
  `risposta` varchar(255) NOT NULL,
  `numeroVoti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `risposte`
--

INSERT INTO `risposte` (`IDrisposta`, `IDvotazione`, `risposta`, `numeroVoti`) VALUES
(119, 49, 'Filippino ', 10),
(120, 49, 'Congo', 22),
(121, 49, 'Italia', 63),
(122, 49, 'Marocco', 19),
(123, 50, 'Leone', 7),
(124, 50, 'Francesco', 4),
(125, 50, 'Innocenzo', 10),
(126, 50, 'Andrea', 2),
(127, 51, 'Settimana Corta', 11),
(128, 51, 'Sabato', 6),
(129, 52, '5A', 0),
(130, 52, '5B', 1),
(131, 52, '5C', 57);

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `IDutente` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `privilegio` enum('A','V','P','P+A') NOT NULL DEFAULT 'V'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `utenti`
--

INSERT INTO `utenti` (`IDutente`, `username`, `privilegio`) VALUES
(1, 'porro_daniele', 'V'),
(2, 'bolis_filippo', 'A'),
(4, 'bolis_filippo', 'V'),
(5, 'mario.rossi', 'P+A'),
(6, 'luigi.bianchi', 'V');

-- --------------------------------------------------------

--
-- Table structure for table `votazioni`
--

CREATE TABLE `votazioni` (
  `IDvotazione` int(11) NOT NULL,
  `domanda` varchar(255) NOT NULL,
  `IDcollegio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `votazioni`
--

INSERT INTO `votazioni` (`IDvotazione`, `domanda`, `IDcollegio`) VALUES
(49, 'Nuovo papa', 13),
(50, 'Come ti chiameresti da papa?', 13),
(51, 'Meglio Settimana Corta o facendo anche il sabato?', 13),
(52, 'Quale è la migliore sezione di Informatica?', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assegnazioni`
--
ALTER TABLE `assegnazioni`
  ADD PRIMARY KEY (`mac`);

--
-- Indexes for table `collegi`
--
ALTER TABLE `collegi`
  ADD PRIMARY KEY (`IDcollegio`),
  ADD KEY `IDutenteAdmin` (`IDutenteAdmin`);

--
-- Indexes for table `partecipazioni`
--
ALTER TABLE `partecipazioni`
  ADD KEY `IDutenteVotante` (`IDutenteVotante`),
  ADD KEY `IDrisposta` (`IDvotazione`);

--
-- Indexes for table `risposte`
--
ALTER TABLE `risposte`
  ADD PRIMARY KEY (`IDrisposta`),
  ADD KEY `IDvotazione` (`IDvotazione`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`IDutente`);

--
-- Indexes for table `votazioni`
--
ALTER TABLE `votazioni`
  ADD PRIMARY KEY (`IDvotazione`),
  ADD KEY `IDcollegio` (`IDcollegio`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collegi`
--
ALTER TABLE `collegi`
  MODIFY `IDcollegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `risposte`
--
ALTER TABLE `risposte`
  MODIFY `IDrisposta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `utenti`
--
ALTER TABLE `utenti`
  MODIFY `IDutente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `votazioni`
--
ALTER TABLE `votazioni`
  MODIFY `IDvotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collegi`
--
ALTER TABLE `collegi`
  ADD CONSTRAINT `collegi_ibfk_1` FOREIGN KEY (`IDutenteAdmin`) REFERENCES `utenti` (`IDutente`);

--
-- Constraints for table `partecipazioni`
--
ALTER TABLE `partecipazioni`
  ADD CONSTRAINT `partecipazioni_ibfk_1` FOREIGN KEY (`IDutenteVotante`) REFERENCES `utenti` (`IDutente`),
  ADD CONSTRAINT `partecipazioni_ibfk_2` FOREIGN KEY (`IDvotazione`) REFERENCES `votazioni` (`IDvotazione`);

--
-- Constraints for table `risposte`
--
ALTER TABLE `risposte`
  ADD CONSTRAINT `risposte_ibfk_1` FOREIGN KEY (`IDvotazione`) REFERENCES `votazioni` (`IDvotazione`);

--
-- Constraints for table `votazioni`
--
ALTER TABLE `votazioni`
  ADD CONSTRAINT `votazioni_ibfk_1` FOREIGN KEY (`IDcollegio`) REFERENCES `collegi` (`IDcollegio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
