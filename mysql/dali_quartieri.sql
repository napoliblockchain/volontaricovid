-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 08, 2020 alle 14:53
-- Versione del server: 10.1.38-MariaDB
-- Versione PHP: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `npay`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `dali_quartieri`
--

CREATE TABLE `dali_quartieri` (
  `id_quartiere` int(11) NOT NULL,
  `descrizione` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `dali_quartieri`
--

INSERT INTO `dali_quartieri` (`id_quartiere`, `descrizione`) VALUES
(1, 'Arenella'),
(2, 'Avvocata'),
(3, 'Bagnoli'),
(4, 'Barra'),
(5, 'Chiaia'),
(6, 'Chiaiano'),
(7, 'Fuorigrotta'),
(8, 'Mercato'),
(9, 'Miano'),
(10, 'Montecalvario'),
(11, 'Pendino'),
(12, 'Pianura'),
(13, 'Piscinola'),
(14, 'Poggioreale'),
(15, 'Ponticelli'),
(16, 'Porto'),
(17, 'Posillipo'),
(18, 'S.Carlo Arena'),
(19, 'S.Ferdinando'),
(20, 'S.Giov.a Ted'),
(21, 'S.Giuseppe'),
(22, 'S.Lorenzo'),
(23, 'S.Pietro a Pat.'),
(24, 'Scampia'),
(25, 'Secondigliano'),
(26, 'Soccavo'),
(27, 'Stella'),
(28, 'Vicaria'),
(29, 'Vomero'),
(30, 'Zona Industriale');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `dali_quartieri`
--
ALTER TABLE `dali_quartieri`
  ADD PRIMARY KEY (`id_quartiere`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `dali_quartieri`
--
ALTER TABLE `dali_quartieri`
  MODIFY `id_quartiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
