-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2021 at 06:08 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fswd13_cr11_petadoption_patrickk`
--
CREATE DATABASE IF NOT EXISTS `fswd13_cr11_petadoption_patrickk` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fswd13_cr11_petadoption_patrickk`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) UNSIGNED NOT NULL,
  `location` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'available',
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `location`, `name`, `description`, `hobbies`, `breed`, `age`, `picture`, `status`, `type`) VALUES
(7, 'Simmeringer Hauptstraße 121', 'Nex', 'Talking, kind', 'Flying', 'Parrot', 5, '611fa13774629.jpg', 'adopted', 'large'),
(9, 'Neilreichgasse 75', 'Zeus', 'Cute lovely, family lover', 'Walking, eating, sleeping', 'Dog', 10, '611fbe270d8b8.jpg', 'adopted', 'large'),
(10, 'Praterstraße 34', 'Jasper', 'Real Protector, lovely friend', 'Running', 'Dog', 5, '611fbefb62cfb.jpg', 'available', 'large'),
(11, 'Erdergerstraße 115', 'Miau', 'Cute, sleppy ', 'Chasing the Mouses', 'Cat', 12, '611fbf3a3681a.jpg', 'available', 'small'),
(12, 'Nordbahnstraße 95', 'Atheros', 'Cute', 'Slepping, eating', 'Cat', 1, '611fbfd396c0d.jpg', 'available', 'small'),
(13, 'Mariahliferstraße 165', 'Stew', 'Lonely cat', 'Playing ', 'Cat', 5, '611fc03a72e11.jpg', 'available', 'small'),
(14, 'Nordbahnstraße 116', 'Zeno', 'Fluffy', 'Eating carrot', 'Rabbit', 3, '611fc07e196e5.jpg', 'adopted', 'small'),
(15, 'Praterstraße 185', 'Orpheus', 'Cute', 'Eating green fields', 'Alpaca', 18, '611fc0d198861.jpg', 'available', 'large'),
(16, 'Matzleinsdorfer Gürtel 123', 'Sneez', 'Looks dangerous', 'eating', 'Sneak', 20, '611fc151ee170.jpg', 'available', 'large'),
(17, 'Wiedner Gürtel 45', 'Runner', 'Active ', 'Running', 'Dog', 14, '611fc19aa2450.jpg', 'available', 'large');

-- --------------------------------------------------------

--
-- Table structure for table `petadoption`
--

CREATE TABLE `petadoption` (
  `id` int(11) UNSIGNED NOT NULL,
  `fk_animal_id` int(11) UNSIGNED NOT NULL,
  `fk_user_id` int(11) UNSIGNED NOT NULL,
  `adoption_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petadoption`
--

INSERT INTO `petadoption` (`id`, `fk_animal_id`, `fk_user_id`, `adoption_date`) VALUES
(30, 7, 5, '2021-08-20'),
(31, 14, 7, '2021-08-20'),
(32, 9, 7, '2021-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telnumber` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `email`, `telnumber`, `address`, `date_of_birth`, `picture`, `status`) VALUES
(4, 'Patrick', 'Kereszturi', 'b8df47a991b31b8e04a9c4c7880a730f5817002f9c58827dd6f5b8918aac4954', 'patrick@gmail.com', '0645292625', 'Alxingergasse 55', '1996-10-05', 'avatar.png', 'adm'),
(5, 'John', 'Doe', 'cb33543128f1ab03660c44968f2a7dcc240bb53f18be1c92ba84a3322fdda42d', 'doe@mail.com', '06824525', 'Praterstraße 77', '1998-08-01', 'avatar.png', 'user'),
(7, 'Johnson', 'Johnson', '2d296f0a562aab71b6871f1610f959143058934c0bfcfeb0078de6bca08cbed4', 'johnson@gmail.com', '06875215', 'Schwedenplatz 15', '1994-08-12', 'avatar.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petadoption`
--
ALTER TABLE `petadoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_animal_id` (`fk_animal_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `petadoption`
--
ALTER TABLE `petadoption`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `petadoption`
--
ALTER TABLE `petadoption`
  ADD CONSTRAINT `petadoption_ibfk_1` FOREIGN KEY (`fk_animal_id`) REFERENCES `animals` (`id`),
  ADD CONSTRAINT `petadoption_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
