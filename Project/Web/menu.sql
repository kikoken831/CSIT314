-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2022 at 10:04 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csit 314`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(100) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `menuCat` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`name`, `price`, `image`, `visible`, `menuCat`) VALUES
('Burger', 12, 'images/beef burger.png', 1, 'Entree'),
('Carbonara', 11, 'images/carbonara.png', 0, 'Entree'),
('Chicken Chop', 11.5, 'images/chicken chop.png', 1, 'Entree'),
('Fish and Chips', 14, 'images/fish and chips.png', 1, 'Entree'),
('Linguine', 11.5, 'images/Linguine-and-Clams.png', 1, 'Entree'),
('Pork Chop', 12.5, 'images/pork chop.png', 1, 'Entree'),
('Pizza', 22, 'images/pepperoni pizza.png', 1, 'Entree'),
('Cheese Fries', 6, 'images/cheese fries.png', 1, 'Meals'),
('Salad', 6, 'images/caesar salad.png', 1, 'Meals'),
('Fries', 4, 'images/garlic-parmesan-french-fries.png', 1, 'Meals'),
('Wings', 9, 'images/chicken wings.png', 1, 'Meals'),
('Iced Tea', 1.5, 'images/Iced-Tea-3-1.png', 1, 'Drinks'),
('Iced Coffee', 2.5, 'images/iced coffee.png', 1, 'Drinks'),
('Matcha Latte', 3.5, 'images/matcha latte.png', 1, 'Drinks'),
('Juice', 2, 'images/orange juice.png', 1, 'Drinks'),
('Spaghetti', 10, 'images/meatball spaghetti.png', 1, 'Entree');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
