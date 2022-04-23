-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2022 at 02:05 PM
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
-- Table structure for table `cart item`
--

CREATE TABLE IF NOT EXISTS `cart item` (
  `TRANSACTION ID` int(50) NOT NULL,
  `ITEM ID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `COUPON ID` varchar(50) NOT NULL,
  `MANAGER ID` int(50) NOT NULL,
  `DISCOUNT RATE` double NOT NULL,
  `VALID` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `CUSTOMER ID` int(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `CUSTOMER NAME` varchar(50) NOT NULL,
  `FAVOURITE LIST` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `customer` (`CUSTOMER ID`, `EMAIL`, `PASSWORD`, `CUSTOMER NAME`, `FAVOURITE LIST`) VALUES
(0,'rockalltrafalgar@gmail.com','1qazxsw2','rockalltrafalgar','1,2,3'),
(1,'ravioliconclusion@gmail.com','1qazxsw2','ravioliconclusion','4,5,6'),
(2,'nutterhunt@gmail.com','1qazxsw2','nutterhunt','5,8'),
(3,'magicianmountain@gmail.com','1qazxsw2','magicianmountain','2'),
(4,'lakessplosh@gmail.com','1qazxsw2','lakessplosh','8,9,10'),
(5,'priorityabsorbing@gmail.com','1qazxsw2','priorityabsorbing','0,2,4'),
(6,'mutesee@gmail.com','1qazxsw2','mutesee','1,2'),
(7,'groupplatform@gmail.com','1qazxsw2','groupplatform','9,6,5'),
(8,'apparentlysaid@gmail.com','1qazxsw2','apparentlysaid','1,3,5'),
(9,'liquoriceprojector@gmail.com','1qazxsw2','liquoriceprojector','2,4,9');
-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `ITEM ID` int(50) NOT NULL,
  `ITEM NAME` varchar(50) NOT NULL,
  `CATEGORY` varchar(10) DEFAULT NULL,
  `PRICE` float NOT NULL,
  `IMAGEURL` varchar(100) NOT NULL,
  `VISIBLE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ITEM ID`, `ITEM NAME`, `CATEGORY`, `PRICE`, `IMAGEURL`, `VISIBLE`) VALUES
(0, 'Burger', 'Entree', 12, 'images/beef burger.png', 1),
(1, 'Carbonara', 'Entree', 11, 'images/carbonara.png', 0),
(2, 'Chicken Chop', 'Entree', 11.5, 'images/chicken chop.png', 1),
(3, 'Fish and Chips', 'Entree', 14, 'images/fish and chips.png', 1),
(4, 'Linguine', 'Entree', 11.5, 'images/Linguine-and-Clams.png', 1),
(5, 'Pork Chop', 'Entree', 12.5, 'images/pork chop.png', 1),
(6, 'Pizza', 'Entree', 22, 'images/pepperoni pizza.png', 1),
(7, 'Cheese Fries', 'Meals', 6, 'images/cheese fries.png', 1),
(8, 'Salad', 'Meals', 6, 'images/caesar salad.png', 1),
(9, 'Fries', 'Meals', 4, 'images/garlic-parmesan-french-fries.png', 1),
(10, 'Wings', 'Meals', 9, 'images/chicken wings.png', 1),
(11, 'Iced Tea', 'Drinks', 1.5, 'images/Iced-Tea-3-1.png', 1),
(12, 'Iced Coffee', 'Drinks', 2.5, 'images/iced coffee.png', 1),
(13, 'Matcha Latte', 'Drinks', 3.5, 'images/matcha latte.png', 1),
(14, 'Juice', 'Drinks', 2, 'images/orange juice.png', 1),
(15, 'Spaghetti', 'Entree', 10, 'images/meatball spaghetti.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `MANAGER ID` int(20) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `NAME` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `manager` (`MANAGER ID`, `USERNAME`, `PASSWORD`) VALUES
(0,'joesepthmama1','password123');
-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE IF NOT EXISTS `owner` (
  `OWNER ID` int(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
INSERT INTO `owner` (`OWNER ID`, `USERNAME`, `PASSWORD`) VALUES
(0,'joemama','password123');
--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `STAFF ID` int(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `staff` (`STAFF ID`,`USERNAME`,`PASSWORD`) VALUES
(0,'shampooimpetuous','1qazxsw2'),
(1,'xebecshelter','1qazxsw2'),
(2,'fishstarbolins','1qazxsw2'),
(3,'millwrighttherapist','1qazxsw2'),
(4,'tophatinflation','1qazxsw2'),
(5,'preservecodger','1qazxsw2'),
(6,'teenagerseason','1qazxsw2'),
(7,'taekwondomoo','1qazxsw2'),
(8,'capitalistcool','1qazxsw2'),
(9,'reputationexecutive','1qazxsw2');
-- --------------------------------------------------------
--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `TRANSACTION ID` int(50) NOT NULL,
  `TABLE ID` int(50) NOT NULL,
  `CUSTOMER ID` int(50) NOT NULL,
  `COUPON ID` int(50) NOT NULL,
  `STAFF ID` int(50) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `DATETIME` date NOT NULL,
  `TOTAL PRICE` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
