-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Set 11, 2018 alle 18:14
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
-- Struttura della tabella `members`
--

CREATE TABLE `members` (
  `memberID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL,
  `resetToken` varchar(255) DEFAULT NULL,
  `resetComplete` varchar(3) DEFAULT 'No',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `members`
--

INSERT INTO `members` (`memberID`, `username`, `password`, `email`, `active`, `resetToken`, `resetComplete`, `first_name`, `last_name`, `phone`) VALUES
(14, 'giuseppe', '$2y$10$1p3gmUayXlg0ibv6t51Hr.GfKaMIvvwez1FgalDlafurCgAhZwKvW', 'giuseppe.lamatrice@webkom.agency', 'Yes', '5f0eca5fcc9b7d2385ed7ecff13ce4c9729bec9897254a30798d1ef2f31d85a8', 'No', 'g', 'l', '347');

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
(1, 'Basic Cut', 'Servizio base di taglio di capelli. Dopo uno shampoo facoltativo si passa al taglio e ad unâ€™asciugatura tradizionale. Trattamento ideale per chi non pretende troppo dalla propria acconciatura e per chi â€œva di frettaâ€.', '14', '10.00'),
(2, 'Cut & Hairstyle', 'Trattamento classico di taglio e pettinatura. Dopo uno shampoo facoltativo, si passa al taglio dei capelli, lavaggio, asciugatura e lavoro di hair styling per dare al capello lâ€™acconciatura desiderata. Ideale per chi vuole presentarsi un modo impec', '20', '14.00'),
(3, 'Razor Fade', 'Trattamento che segue al classico shampoo e taglio. Qui si aggiunge il lavoro di precisione e professionale di un vero hair stylist che permette di avere la sfumatura che non irrita il proprio cuoio capelluto.', '21', '15.00'),
(4, 'Razor Fade & Hairstyle', 'La sfumatura puÃ² essere qualcosa di piÃ¹ che un tipo di taglio, puÃ² diventare uno stile caratteristico della persona. Questo trattamento prevede una cura specifica dellâ€™hair styling del capello e delle sfumature a rasoio che permettono di persona', '30', '20.00'),
(5, 'Children Hair Cut', 'll servizio per bambini rapido ed efficace. Questo trattamento Ã¨ stato studiato ed ottimizzato proprio per permettere di preparare i piÃ¹ piccoli il piÃ¹ velocemente possibile senza sacrificare la qualitÃ  di un servizio professionale.', '14', '10.00'),
(6, 'Beard Renovation', 'Trattamento riservato esclusivamente alla barba. Con la Beard Renivation ci prenderemo cura della tua barba attraverso shampoo e balsami specifici, tagli e spunte adatte al tuo viso e infine pulirla con oli naturali cosÃ¬ da mantenere morbidezza e lu', '30', '20.00'),
(7, 'Relax Superior', 'Il trattamento completo per chi desidera trattare al meglio i propri capelli e il proprio stile. Dopo uno shampoo specifico per il capello e il cuoio capelluto, passiamo ad individuare il talgio migliore per te studiando capigliatura e forma de capel', '60', '40.00');

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
(1, 'Maurizio', 'P.', 'TOP'),
(2, 'Davide', '', 'Collaboratore'),
(3, 'Antonio', '', 'Collaboratore'),
(4, 'Alessandro', '', 'Collaboratore'),
(8, 'Vincenzo', '', 'Collaboratore');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberID`);

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
-- AUTO_INCREMENT per la tabella `members`
--
ALTER TABLE `members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `resources`
--
ALTER TABLE `resources`
  MODIFY `id_resource` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
