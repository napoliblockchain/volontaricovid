-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Apr 03, 2020 alle 18:49
-- Versione del server: 5.7.29-0ubuntu0.18.04.1
-- Versione PHP: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struttura della tabella `dali_lista_di_consegna`
--

CREATE TABLE `dali_lista_di_consegna` (
  `id_ldc` int(11) NOT NULL,
  `id_volontario` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `id_archive` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `dali_lista_di_consegna`
--
ALTER TABLE `dali_lista_di_consegna`
  ADD PRIMARY KEY (`id_ldc`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `dali_lista_di_consegna`
--
ALTER TABLE `dali_lista_di_consegna`
  MODIFY `id_ldc` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
