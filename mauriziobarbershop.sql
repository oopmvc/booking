-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2018 at 10:25 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

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
-- Table structure for table `members`
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
  `country` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memberID`, `type`, `username`, `password`, `email`, `active`, `resetToken`, `resetComplete`, `first_name`, `last_name`, `phone`, `address`, `postal_code`, `city`, `country`) VALUES
(3, 2, 'admin', '$2y$10$8uUShxZkoZBzB0OkED9quuBn2exjETzPyFAvRpOgdu9to2.Wi7fcq', '7tein@yopmail.com', 'Yes', NULL, 'No', 'Vorname', 'admin', '46545555', NULL, NULL, NULL, NULL),
(14, 0, 'giuseppe', '$2y$10$1mjhyCEm4BeT9l.IsFJTT.S4XEyHAimfqGk3HwnIWD7MUlogGX6Fm', 'giuseppe.lamatrice@webkom.agency', 'Yes', '6fc100c9b3cc32d7260640f8823f706a8914a7727878e314b08372e34dd7d633', 'Yes', 'Giuseppe', 'Lamatrice', '+393472295261', 'Via A. Manzoni 179', '71121', 'Foggia', 'Italia');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `order_date` varchar(255) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `resource` int(11) DEFAULT NULL,
  `customer` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `order_date`, `start_time`, `resource`, `customer`, `status`, `note`) VALUES
(1, '02-10-2018', '03:30:00', 1, '30', '0', ''),
(2, '02-10-2018', '16:00:00', 1, '15', '0', ''),
(3, NULL, NULL, NULL, '15', NULL, NULL),
(4, NULL, NULL, NULL, '15', NULL, NULL),
(5, NULL, NULL, NULL, '3', NULL, NULL),
(6, NULL, NULL, NULL, '15', NULL, NULL),
(7, NULL, NULL, NULL, '15', NULL, NULL),
(8, NULL, NULL, NULL, '15', NULL, NULL),
(9, NULL, NULL, NULL, '15', NULL, NULL),
(10, NULL, NULL, NULL, '15', NULL, NULL),
(11, NULL, NULL, NULL, '15', NULL, NULL),
(12, NULL, NULL, NULL, '15', NULL, NULL),
(13, NULL, NULL, NULL, '15', NULL, NULL),
(14, NULL, NULL, NULL, '15', NULL, NULL),
(15, NULL, NULL, NULL, '15', NULL, NULL),
(16, NULL, NULL, NULL, '15', NULL, NULL),
(17, '02-10-2018', '00:00:00', 1, '15', NULL, NULL),
(18, '02-10-2018', '00:00:00', 1, '15', NULL, NULL),
(19, '02-10-2018', '00:00:00', 1, '15', NULL, NULL),
(20, '02-10-2018', '00:00:00', 1, '30', NULL, NULL),
(21, '02-10-2018', '13:30:00', 1, '15', NULL, NULL),
(22, '02-10-2018', '13:30:00', 1, '15', NULL, NULL),
(23, '31-10-2018', '00:00:00', 1, '3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_quantity`, `product_id`) VALUES
(1, 12, 1, 7),
(2, 12, 1, 1),
(3, 14, 1, 1),
(4, 14, 1, 3),
(5, 14, 1, 2),
(6, 14, 1, 7),
(7, 14, 1, 4),
(8, 15, 1, 1),
(9, 15, 1, 3),
(10, 15, 1, 2),
(11, 15, 1, 7),
(12, 15, 1, 4),
(13, 16, 1, 1),
(14, 16, 1, 3),
(15, 16, 1, 2),
(16, 16, 1, 7),
(17, 16, 1, 4),
(18, 17, 1, 1),
(19, 17, 1, 3),
(20, 17, 1, 2),
(21, 17, 1, 7),
(22, 17, 1, 4),
(23, 18, 1, 1),
(24, 18, 1, 3),
(25, 18, 1, 2),
(26, 18, 1, 7),
(27, 18, 1, 4),
(28, 19, 1, 1),
(29, 19, 1, 3),
(30, 19, 1, 2),
(31, 19, 1, 7),
(32, 19, 1, 4),
(33, 20, 1, 1),
(34, 20, 1, 3),
(35, 20, 1, 2),
(36, 20, 1, 7),
(37, 20, 1, 4),
(38, 21, 1, 3),
(39, 21, 1, 2),
(40, 21, 1, 7),
(41, 21, 1, 4),
(42, 21, 1, 1),
(43, 22, 1, 3),
(44, 22, 1, 2),
(45, 22, 1, 7),
(46, 22, 1, 4),
(47, 22, 1, 1),
(48, 23, 1, 1),
(49, 23, 1, 7),
(50, 23, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `time` varchar(50) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
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
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id_resource` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id_resource`, `first_name`, `last_name`, `description`) VALUES
(1, 'Maurizio', 'P.', 'TOP'),
(2, 'Davide', '', 'Collaboratore'),
(3, 'Antonio', '', 'Collaboratore'),
(4, 'Alessandro', '', 'Collaboratore'),
(8, 'Vincenzo', '', 'Collaboratore');

-- --------------------------------------------------------

--
-- Table structure for table `slot_time`
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
-- Dumping data for table `slot_time`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id_resource`);

--
-- Indexes for table `slot_time`
--
ALTER TABLE `slot_time`
  ADD PRIMARY KEY (`id_slot_time`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id_resource` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `slot_time`
--
ALTER TABLE `slot_time`
  MODIFY `id_slot_time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
