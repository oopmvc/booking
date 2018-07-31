-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Lug 31, 2018 alle 18:33
-- Versione del server: 10.1.32-MariaDB
-- Versione PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mauriziobarbershop`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `products`
--

CREATE TABLE `products` (
  `id_product` int(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `time` varchar(50) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `products`
--

INSERT INTO `products` (`id_product`, `name`, `description`, `time`, `price`) VALUES
(1, 'Acconciatura', 'Acconciatura compresa di taglio e shampoo', '30 minuti', '13.00'),
(2, 'Acconciatura + Shampoo', 'Shampoo e acconciatura, piastrata e lavorata con spazzola e phon', '30 minuti', '8.00'),
(3, 'Rasatura barba tradizionale', 'Barba tradizionale oppure rasata con la macchinetta', '15 minuti', '5.00'),
(4, 'Razor fade', 'Rasatura a lametta ai lati e dietro con taglio e shampoo', '30 minuti', '15.00'),
(5, 'Stiratura alla cheratina', 'Stiraggio ondulato/riccio/crespo', '30 minuti', '25.00'),
(6, 'Taglio Donna', 'Taglio Donna corto compreso di acconciatura', '30 minuti', '15.00'),
(7, 'Taglio Uomo', 'Taglio uomo compreso di shampoo e asciugatura naturale', '30 minuti', '10.00'),
(8, 'test 1', 'test 1', '60 minuti', '60.00'),
(9, 'test 2', 'test 2', '75 minuti', '75.00'),
(10, 'test 3', 'test 3', '90 minuti', '90.00');

-- --------------------------------------------------------

--
-- Struttura della tabella `resources`
--

CREATE TABLE `resources` (
  `id_resource` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `resources`
--

INSERT INTO `resources` (`id_resource`, `first_name`, `last_name`, `description`) VALUES
(1, 'Chiunque', '', ''),
(2, 'Maurizio', 'P.', '');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indici per le tabelle `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id_resource`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `resources`
--
ALTER TABLE `resources`
  MODIFY `id_resource` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
