-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 05:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_sample_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `menuitems` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(5) NOT NULL,
  `pickupOnly` boolean NOT NULL,
  `imageLink` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `menuitems` (`id`, `name`, `category`, `price`, `pickupOnly`, `imageLink`) VALUES
(1, 'Cabonara', 'Pastas', 23, 'false','https://img.jamieoliver.com/jamieoliver/recipe-database/oldImages/large/1558_1_1436795948.jpg?tr=w-800,h-1066'),
(2, 'Marghereita', 'Pizzas', 25, 'true','https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Pizza_Margherita_stu_spivack.jpg/330px-Pizza_Margherita_stu_spivack.jpg'),
(3, 'Marghereita with olives', 'Pizzas', 28, 'true','https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Pizza_Margherita_stu_spivack.jpg/330px-Pizza_Margherita_stu_spivack.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `menuitems`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;