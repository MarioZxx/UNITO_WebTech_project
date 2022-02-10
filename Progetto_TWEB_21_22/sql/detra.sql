-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2022 at 03:28 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `detra`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `offer_id`) VALUES
(20, 2, 23),
(21, 2, 27),
(22, 2, 25);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `time` text NOT NULL,
  `category` text DEFAULT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `image` text DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title`, `time`, `category`, `description`, `price`, `image`, `user_id`) VALUES
(13, 'Noodle sofa', '02/Feb/2022', 'forniture', 'Special noodle sofa\nSpecial noodle sofa\nSpecial noodle sofa\nSpecial noodle sofa\nSpecial noodle sofa\nSpecial noodle sofa\nSpecial noodle sofa\nSpecial noodle sofa\nSpecial noodle sofa\nSpecial noodle sofa\nSpecial noodle sofa\nSpecial noodle sofa\nSpecial noodle sofa', 249.99, '../img/offers/noodle_sofa.png', 2),
(21, 'Dress', '05/Feb/2022', 'clothings', '\"Black Pink Dress\" <p>hahaha 666</p>', 50, '../img/offers/dress.png', 2),
(22, 'Shoes', '05/Feb/2022', 'clothings', 'shoes <a href=\"home.php\"><div style=\"background-color: red;\">AAAAA</div></a>', 29, '../img/offers/shoes.png', 2),
(23, 'Italic chair', '10/Feb/2022', 'forniture', 'A italic chair <p></p> <div style=\"color:red;\">this won\'t be red</div> ', 60, '../img/offers/chair_italic.png', 0),
(24, 'Microwave', '10/Feb/2022', 'electronics', 'White microwave', 30, '../img/offers/microwave.png', 0),
(25, 'Nintendo switch OLED', '10/Feb/2022', 'electronics', 'Nintendo switch OLEDNintendo switch OLEDNintendo switch OLEDNintendo switch OLEDNintendo switch OLEDNintendo switch OLEDNintendo switch OLED\nNintendo switch OLEDNintendo switch OLEDNintendo switch OLEDNintendo switch OLEDNintendo switch OLEDNintendo switch OLEDNintendo switch OLED\nNintendo switch OLEDNintendo switch OLEDNintendo switch OLEDNintendo switch OLEDNintendo switch OLEDNintendo switch OLEDNintendo switch OLED', 300, '../img/offers/nintendo_switch_oled.png', 0),
(26, 'Scooter', '10/Feb/2022', 'electronics', 'Electronic scooter', 200, '../img/offers/scooter.png', 0),
(27, 'Weird sofa', '10/Feb/2022', 'forniture', 'weird sofa on the wall', 299, '../img/offers/sofa_on_wall.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(0, 'admin'),
(1, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role_id`) VALUES
(0, 'admin@email.com', '21232f297a57a5a743894a0e4a801fc3', 0),
(1, 'xiaozhao@email.com', 'ea416ed0759d46a8de58f63a59077499', 1),
(2, 'a@a.a', '0cc175b9c0f1b6a831c399e269772661', 1),
(5, 'b@b.b', '92eb5ffee6ae2fec3ad71c777531578f', 1),
(6, 'c@c.c', '4a8a08f09d37b73795649038408b5f33', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`) USING HASH;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
