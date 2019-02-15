-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Feb 14, 2019 alle 13:32
-- Versione del server: 10.0.37-MariaDB-cll-lve
-- Versione PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avodvovr_bookingmauriziobarbershop`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `members`
--

CREATE TABLE `members` (
  `memberID` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL,
  `resetToken` varchar(255) DEFAULT NULL,
  `resetComplete` varchar(3) DEFAULT 'No',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `country` varchar(40) DEFAULT NULL,
  `oauth_provide` enum('','facebook') DEFAULT NULL,
  `oauth_uid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `members`
--

INSERT INTO `members` (`memberID`, `type`, `username`, `password`, `email`, `active`, `resetToken`, `resetComplete`, `first_name`, `last_name`, `phone`, `address`, `postal_code`, `city`, `country`, `oauth_provide`, `oauth_uid`) VALUES
(3, 1, 'admin', '$2y$10$feEj/dHQSbM67LdfOawANO9OeX4e4Ij8eVX/nsD/ezp/mz8xvYFki', 'giuseppelamatrice@gmail.com', 'Yes', 'acba6ba0683ed58a38c862cb7d4ca83c1629a857afdedafe35faf91e2306056c', 'Yes', 'Maurizio', 'Pizzuto', '3472295261', 'Via Benedetto Croce 8/10', '71121', 'Foggia', 'Italia', NULL, NULL),
(14, 1, 'giuseppe', '$2y$10$tGdlCrMpCMCTWE.2.Yqxu.w.o11JmEpgakJWtBdT/dAZ8/IO7dcp6', 'giuseppe.lamatrice@webkom.agency', 'Yes', '7feff99bf2bad247a9fa3a65f9566bae213b8d542604af8459c0e701a80e2d94', 'Yes', 'Giuseppe', 'Lamatrice', '+393472295261', 'Via A. Manzoni 179', '71121', 'Foggia', 'Italia', NULL, NULL),
(20, 0, 'ildottore87fg', '$2y$10$/zV7Mx3J3nUWGU5o6kdu5OXcT3wiyvSbXgRR/QmbM9ZjT0zRYCaCW', 'ildottore87fg@gmail.com', 'Yes', '4d59cf3282574d3d677e6c7dcd9dcafccdf5aad61e2dc09b66a2844d71932872', 'Yes', 'Valentino', 'Rossi', '3472295261', 'Via A. Manzoni 179', '71121', 'Foggia', 'Italia', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `start_time` time(4) DEFAULT NULL,
  `resource` int(11) DEFAULT NULL,
  `customer` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `orders`
--

INSERT INTO `orders` (`id_order`, `order_date`, `start_time`, `resource`, `customer`, `status`, `note`) VALUES
(85, '2019-02-13', '12:00:00.0000', 4, '14', NULL, NULL),
(86, '2019-02-12', '12:30:00.0000', 1, '14', NULL, NULL),
(87, '2019-02-12', '09:30:00.0000', 3, '14', NULL, NULL),
(88, '2019-02-13', '12:00:00.0000', 1, '3', NULL, NULL),
(89, '2019-02-13', '17:00:00.0000', 1, '3', NULL, NULL),
(90, '2019-02-13', '10:00:00.0000', 1, '3', NULL, NULL),
(91, '0000-00-00', '00:00:09.0000', 1, '3', NULL, NULL),
(92, '2019-02-13', '09:30:00.0000', 1, '3', NULL, NULL),
(93, '2019-02-13', '09:30:00.0000', 1, '3', NULL, NULL),
(94, '2019-02-13', '09:30:00.0000', 1, '3', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_quantity`, `product_id`) VALUES
(136, 85, 1, 6),
(137, 86, 1, 6),
(138, 87, 1, 6),
(139, 88, 1, 6),
(140, 89, 1, 6),
(141, 89, 2, 5),
(142, 90, 1, 6),
(143, 91, 1, 6),
(144, 92, 1, 6),
(145, 93, 1, 6),
(146, 94, 1, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `products`
--

CREATE TABLE `products` (
  `id_product` int(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `time` varchar(50) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `active` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `products`
--

INSERT INTO `products` (`id_product`, `name`, `description`, `time`, `price`, `active`) VALUES
(2, 'Cut & Hairstyle', 'Trattamento di taglio e pettinatura. Dopo uno shampoo, si passa al taglio dei capelli, lavaggio, asciugatura e lavoro di hair styling per dare al capello lâ€™acconciatura desiderata. Ideale per chi vuole presentarsi un modo impeccabile.', '25', '15.00', b'0'),
(3, 'Razor Fade', 'Trattamento che segue allo shampoo e taglio. Qui si aggiunge il lavoro di precisione e professionale di un vero hair stylist che permette di avere la sfumatura che non irrita il proprio cuoio capelluto.', '25', '15.00', b'1'),
(4, 'Razor Fade & Hairstyle', 'La sfumatura puÃ² essere qualcosa di piÃ¹ che un tipo di taglio, puÃ² diventare uno stile caratteristico della persona. Questo trattamento prevede una cura specifica dellâ€™hair styling del capello e delle sfumature dello shave che permettono di personalizzare il taglio fin nei minimi dettagli.', '30', '20.00', b'1'),
(5, 'Children Hair Cut', 'l servizio per bambini rapido ed efficace. Questo trattamento Ã¨ stato studiato ed ottimizzato proprio per permettere di preparare i piÃ¹ piccoli il piÃ¹ velocemente possibile senza sacrificare la qualitÃ  di un servizio professionale.', '15', '15.00', b'1'),
(6, 'Beard Renovation', 'Trattamento riservato esclusivamente alla barba. Con la Beard Renivation ci prenderemo cura della tua barba attraverso shampoo e balsami specifici, tagli e spunte adatte al tuo viso e infine pulirla con oli naturali cosÃ¬ da mantenere morbidezza e lucentezza.', '30', '20.00', b'1'),
(7, 'Relax Superior', 'Il trattamento completo per chi desidera trattare al meglio i propri capelli e il proprio stile. Dopo uno shampoo specifico per il capello e il cuoio capelluto, passiamo ad individuare il talgio migliore per te studiando capigliatura e forma de capello. Soltanto dopo lavoriamo di fino per proporre alla tua immagine lo stile migliore. Un servizio per chi non si accontenta del solito â€œtaglioâ€.', '60', '40.00', b'1');

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
(1, 'Maurizio', 'Pizzuto', 'Collaboratore'),
(2, 'Davide', '', 'Collaboratore'),
(3, 'Antonio', '', 'Collaboratore'),
(4, 'Alessandro', '', 'Collaboratore'),
(8, 'Vincenzo', '', 'Collaboratore');

-- --------------------------------------------------------

--
-- Struttura della tabella `slot_time`
--

CREATE TABLE `slot_time` (
  `id_slot_time` int(11) NOT NULL,
  `start_slot` time NOT NULL,
  `end_slot` time NOT NULL,
  `sunday` tinyint(1) NOT NULL,
  `monday` tinyint(1) NOT NULL,
  `tuesday` tinyint(1) NOT NULL,
  `wednesday` tinyint(1) NOT NULL,
  `thursday` tinyint(1) NOT NULL,
  `friday` tinyint(1) NOT NULL,
  `saturday` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `slot_time`
--

INSERT INTO `slot_time` (`id_slot_time`, `start_slot`, `end_slot`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`) VALUES
(1, '08:00:00', '08:30:00', 0, 0, 1, 1, 1, 1, 1),
(2, '08:30:00', '09:00:00', 0, 0, 1, 1, 1, 1, 1),
(3, '09:00:00', '09:30:00', 0, 0, 1, 1, 1, 1, 1),
(4, '09:30:00', '10:00:00', 0, 0, 1, 1, 1, 1, 1),
(5, '10:00:00', '10:30:00', 0, 0, 1, 1, 1, 1, 1),
(6, '10:30:00', '11:00:00', 0, 0, 1, 1, 1, 1, 1),
(7, '11:30:00', '12:00:00', 0, 0, 1, 1, 1, 1, 1),
(8, '12:00:00', '12:30:00', 0, 0, 1, 1, 1, 1, 1),
(9, '12:30:00', '13:00:00', 0, 0, 1, 1, 1, 1, 1),
(10, '15:30:00', '16:00:00', 0, 0, 1, 1, 1, 1, 1),
(11, '16:00:00', '16:30:00', 0, 0, 1, 1, 1, 1, 1),
(12, '16:30:00', '17:00:00', 0, 0, 1, 1, 1, 1, 1),
(13, '17:00:00', '17:30:00', 0, 0, 1, 1, 1, 1, 1),
(14, '17:30:00', '18:00:00', 0, 0, 1, 1, 1, 1, 1),
(15, '18:00:00', '18:30:00', 0, 0, 1, 1, 1, 1, 1),
(16, '18:30:00', '19:00:00', 0, 0, 1, 1, 1, 1, 1),
(17, '19:00:00', '19:30:00', 0, 0, 1, 1, 1, 1, 1),
(19, '19:30:00', '20:00:00', 0, 0, 1, 1, 1, 1, 1),
(20, '20:00:00', '20:30:00', 0, 0, 1, 1, 1, 1, 1),
(21, '11:00:00', '11:30:00', 0, 0, 1, 1, 1, 1, 1),
(22, '13:00:00', '13:30:00', 0, 0, 0, 0, 0, 0, 1),
(23, '13:30:00', '14:00:00', 0, 0, 0, 0, 0, 0, 1),
(24, '14:00:00', '14:30:00', 0, 0, 0, 0, 0, 0, 1),
(25, '14:30:00', '15:00:00', 0, 0, 0, 0, 0, 0, 1),
(26, '15:00:00', '15:30:00', 0, 0, 0, 0, 0, 0, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indici per le tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indici per le tabelle `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

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
-- Indici per le tabelle `slot_time`
--
ALTER TABLE `slot_time`
  ADD PRIMARY KEY (`id_slot_time`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `members`
--
ALTER TABLE `members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT per la tabella `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

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

--
-- AUTO_INCREMENT per la tabella `slot_time`
--
ALTER TABLE `slot_time`
  MODIFY `id_slot_time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
