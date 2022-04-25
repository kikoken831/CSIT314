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



--
-- Table structure for table `coupon`
--
DROP database if exists `restaurant`;
create database `restaurant`;
use `restaurant`;


--
-- Table structure for table `manager`
--
DROP table if exists `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `MANAGER ID` int(20) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `NAME` varchar(30) NOT NULL,
  PRIMARY KEY(`MANAGER ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `manager` (`USERNAME`, `PASSWORD`, `NAME`) VALUES
('joesepthmama1','password123','Joesepth');


drop table if exists `coupon`;
CREATE TABLE `coupon` (
  `COUPON ID` int NOT NULL AUTO_INCREMENT,
  `COUPON CODE` varchar(50) NOT NULL,
  `MANAGER ID` int(50) NOT NULL,
  `DISCOUNT RATE` double NOT NULL,
  `VALID` tinyint(1) NOT NULL,
  PRIMARY KEY (`COUPON ID`),
  FOREIGN KEY(`MANAGER ID`) REFERENCES `MANAGER`(`MANAGER ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `coupon` (`MANAGER ID`,`COUPON CODE`,`DISCOUNT RATE`,`VALID`) VALUES
-- --------------------------------------------------------
(1,'ONEONESALE',20,1),
(1,'TWOTWOSALE',10,1),
(1,'THREETHREESALE',15,1),
(1,'FOURFOURSALE',8,0),
(1,'FIVEFIVESALE',10,0),
(1,'SIXSIXSALE',16,0);
-- --------------------------------------------------------

--
-- Table structure for table `customer`
--
drop table if exists `customer`;
CREATE TABLE `customer` (
  `CUSTOMER ID` int(50) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `CUSTOMER NAME` varchar(50) NOT NULL,
  `FAVOURITE LIST` varchar(500) NULL,
  PRIMARY KEY(`CUSTOMER ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `customer` ( `EMAIL`, `PASSWORD`, `CUSTOMER NAME`, `FAVOURITE LIST`) VALUES
( 'hello@gmail.com', '+gOQ1hlzSkGFoVglB24ZHYGzMbTDmjWshisED6Csly79YDzXiXoltpG1DuMFweXw2LuJDXkPEycGTlo=', 'hello', ''),
('hello1@gmail.com', '0F8uEtIqRv9d+kqvlFW6+D6dvuQZDikhWgFb2/y5DKVSdVtZN0rQ+6+QRuS48svd00qDkLQaQmeMFDY=', 'helloo', ''),
('customer@gmail.com', 'tVR62Ij0cieA/K9d5kZSMEnyLvfDO4gNYDqlW07290ygyE8G/5e1ssVi8XDdDrnWaHtHvXUT9vsbI5I=', 'customer', ''),
( 'test@gmail.com', 'AUpe4Nx+zwqk8nSvzF52ReV18+hlOKg5khEElB0x9UM+4EGIs2w/b6/8HbvgBM729IxI9CUpL0b/6qc=', 'testing', ''),
( 'testing@gmail.com', 'dqDc1Si8ewYhoM07Xsi0AbF3ej8WLEY9mbMUl9dAtoQggFmVIDvegH2mDy2SCS9BDtj9qqPI5B2PAnU=', 'testing', ''),
( 'customer1@gmail.com', 'roCgQ6xPxW4Qx/el0F74PmU4KVVz5T0UjOV9xT3YuM4WSdcAbNui9lxdTvVyYMtU1MuiDPrOeJQBQTo=', 'customerr', ''),
( 'hoho@gmail.com', 'Opzke/EdP1qHGMLhhMdF12z3++XKNmfIU9LcA/yTCIQ0yGzAa3ow9u1N5JKpBHgc8A0/0YulM5uOBj8=', 'hohoho', ''),
( 'hehe@gmail.com', 'hsg4XoRmu/Ne3f8bSwnMP40VCWJkf+Z9nK9ngCvnh8PPNPB9Euf2SxfXO14V0+ebMKcO+Lweeyca2yA=', 'heheh', ''),
( 'hohoho@gmail.com', 'DQpx9m8xibOlNlTjILC7z3zWoJSOq03XdQZxsthLHp9Kv22bZBGfHPRaPjaOJssTZ2obmyM6oAi0Cos=', 'hohoho', ''),
( 'hihihi@gmail.com', 'mFIXlC/z3y4SfBJKHYnJPa92F0jheh4U8KDqcUz9UuorUTM3hZ9Df0es3M4k1cfqP3dWoBdesQIF6/g=', 'hihihi', ''),
( 'testingg@gmail.com', 'rA8YDa09BdA+kYMhI5rydC8Z1fk3RsFrM7ss8D8Y2atvA4+owep8gL9U3iYUBKlvZsHQfI4GHJ130Uw=', 'testingg', ''),
( 'huhuhu@gmail.com', 'LHJY+kUbhuAdZY5zthU4uZyeIxl+MNqSpnx250uVl+mSG6X8latKxRJXon0oF2zny+mpLI79qSh4wPM=', 'huhuhu', ''),
( 'marktan90@gmail.com', 'lg1uAfnSXNBY2VxvhGfABekRTXs5MWqeUe4Gwm1CpbYfqPUANqRnXWuDX9s4DRa8u6a5m0/lSePQzNE=', 'Mark Tan', ''),
( 'Marylim87@gmail.com', 'mLR/UmRPmq4tDb2J1+hdTZzk675f+st0nM2Pi1OgCzTjPCJ5JskgAQRFgyYiugPorL/ImGWk/29OIk0=', 'Mary Lim', ''),
('makanclub@gmail.com', 'ZVfh1TjKY1a4XzzII50STddL9fRGsv6zGWzUpbbMjCRTa0Jd5QEZ9EDa4DBoLGtim3BrAxOblpOdMHY=', 'makan club', ''),
( 'localhost@gmail.com', '9Fbzs8LRJJBOO+bCh8C3hi2wWcjWc8X1i0QtFf7Im9qegNhNI7eYaeIO7S3ap91UdlGcO/PaXSqpY0k=', 'localhost', ''),
( 'phpmyadmin@gmail.com', 'nESbpqlyZIaVI0HH062yjZcCWG8VksuRZaQMtn+g86fCjYWh35Vg0ryx7fV/B6abqeDYDm/D2L4weks=', 'phpmyadmin', ''),
( 'jkjkjk@gmail.com', 'X+jnYwFjjq7MGpNQXWhg83EmG+7JutVM3DchQP0k8i+J0MOSPuMcSz4Uv+nsr0S2EvQs398SSQ4UP6o=', 'jkjkjk', ''),
( 'jkjkjkk@gmail.com', 'kRCkmClkBjLlHQDMxL/CgyQUO6pqyPA4nxuluk9eLWH85wdt6kJSTSRaX5QPAJlOXJG3FHWf1q4ZY0M=', 'jkjkjk', ''),
( 'uowstaff@gmail.com', 'TkYyyuWfZvSmLPNRI0UorKVfIGMlQschDN/0LSAIjenFPNJMb8pZcLWL5rstSRcEU8zXdkNDq0tGbek=', 'uow staff', ''),
( 'simstaff@gmail.com', 'Quia3V6kEAQqa7X7gDHm8GMdMboauo2793yct1WZIeJHRYemnX2dlzw0DA8wVl7H9lHvx+3cxrop8HU=', 'sim staff', ''),
( 'simstudent@gmail.com', 'CP5neFHl3BhimeuxVe5h2QRIyGGJWrpyGdn9WOpLWwlXViL00JW1GqwlbXhgSN3bB0/hApzm8JEMrN4=', 'sim student', ''),
( 'rainbow@gmail.com', '5YLaDl8T9i1/yco16GMj4fuu/BsFMw2pfmT4ecCe5ueVDlUEcx2PE4+g7E29wcdyLHa+A1d9hAUqV24=', 'rainbow', ''),
( 'githubmaster@gmail.com', 'JN2dCdBFZNoOwiwgCAorLHwiU1N2ZBQ9XlBZIWRhNDYWuvLvZ0QwwR9BCcweg2G+HnrClJEcKym3zC4=', 'Github Master', ''),
( 'bottle@gmail.com', 'RGh9Xf/hZhVNglO6UkklpzmwXMoRqIC88F2/iGrSInPV9vfJBEglvWSoa11rA0HVaNs7Wzyl28HwG1Q=', 'bottle', ''),
( 'plant@gmail.com', '9lrxvj7jNCRgARcolkL61pCptN7oEsxEvW1LpXNZWdxB2cgT1GjeFhuDLSwUo+k+/BHNzzEYcxjI5MQ=', 'plant', ''),
( 'outlook@gmail.com', '0BNmsSX4RzZUFMBKpT+lGZMjKAe5rWsr9RJUT5SlQUaryFD2Aj6jybvQvK1SPNcl/KaMfRFP/X2yUxU=', 'outlook', ''),
( 'gmail@gmail.com', '2Gi1CPcpAAG4rZgCvpM/TCaECQf76O5KaY8YV5KJztykrp2k+2eI1Uzz3o5dHSVjqyPNLk/6qysjBUA=', 'gmail', ''),
( 'gdrive@gmail.com', 'wtpL0Jq5LP8975ePwS9YhOPE2a8Egk/0974GCNDampn5pNqAydqxocy3XX02lEmW2nPFRyAJgFgF+m0=', 'gdrive', ''),
( 'sofa@gmail.com', 'eixDTESqc8JYPW/VCMnrBm5mZZWq9uW0cHtt8Z1FN2bu8KTN/IQvxpDwKlTQ8NBQLtCFd+9z8OE0Oww=', 'sofa', ''),
( 'table@gmail.com', 'jqSYqyADKsKY4Npc6n7uqriSSfesDbNVCd+fh+tC0C3J94l2JhoDq1KTnyGdi2jqNmeyika3itqnbGI=', 'table', ''),
( 'chair@gmail.com', 'glGs8wz3HoeuhamQHqiFcWx0AQMJkdzeQIk9CYidKmAUdcUFKuwDC5r4Mow73pcQDugBNN2EuXGaeVM=', 'chair', ''),
( 'Lucyloh@gmail.com', 'C8NM5mt31d+f+f7iqfP+R2KOcMFJMkS6vKAXWARD6qMFKXP6ootYuSW1e2FwfDZCmMmqP8AVmX95Euc=', 'Lucy Loh', ''),
( 'phone@gmail.com', 'a2To5P3bixz7ifV0mNsYYXLbWm+3s+xI9Q7boyklqLhpTGQ9bh8iN9ZcHKb0IndaLF1iG8F0axKWVdo=', 'phone', ''),
( 'michaelsim@gmail.com', 'AWjImtxmpHqDLPQwk3cXcw2GBM+ZMTM/sW1Y9aEN6bYQ3sJleZCSQgb/St3hWX/09mYOSMpqZM7x6QM=', 'Michael Sim', '');
-- --------------------------------------------------------

--
-- Table structure for table `item`
--
Drop table if exists `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `ITEM ID` int(50) NOT NULL AUTO_INCREMENT,
  `ITEM NAME` varchar(50) NOT NULL,
  `CATEGORY` varchar(10) DEFAULT NULL,
  `PRICE` float NOT NULL,
  `IMAGEURL` varchar(100) NOT NULL,
  `VISIBLE` tinyint(1) NOT NULL,
  PRIMARY KEY(`ITEM ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Dumping data for table `item`
--

INSERT INTO `item` ( `ITEM NAME`, `CATEGORY`, `PRICE`, `IMAGEURL`, `VISIBLE`) VALUES
( 'Burger', 'Entree', 12, 'images/beef burger.png', 1),
( 'Carbonara', 'Entree', 11, 'images/carbonara.png', 0),
( 'Chicken Chop', 'Entree', 11.5, 'images/chicken chop.png', 1),
( 'Fish and Chips', 'Entree', 14, 'images/fish and chips.png', 1),
( 'Linguine', 'Entree', 11.5, 'images/Linguine-and-Clams.png', 1),
( 'Pork Chop', 'Entree', 12.5, 'images/pork chop.png', 1),
( 'Pizza', 'Entree', 22, 'images/pepperoni pizza.png', 1),
( 'Cheese Fries', 'Meals', 6, 'images/cheese fries.png', 1),
( 'Salad', 'Meals', 6, 'images/caesar salad.png', 1),
( 'Fries', 'Meals', 4, 'images/garlic-parmesan-french-fries.png', 1),
( 'Wings', 'Meals', 9, 'images/chicken wings.png', 1),
( 'Iced Tea', 'Drinks', 1.5, 'images/Iced-Tea-3-1.png', 1),
( 'Iced Coffee', 'Drinks', 2.5, 'images/iced coffee.png', 1),
( 'Matcha Latte', 'Drinks', 3.5, 'images/matcha latte.png', 1),
( 'Juice', 'Drinks', 2, 'images/orange juice.png', 1),
( 'Spaghetti', 'Entree', 10, 'images/meatball spaghetti.png', 1);

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Table structure for table `owner`
--
DROP table if exists `owner`;
CREATE TABLE IF NOT EXISTS `owner` (
  `OWNER ID` int(50) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  PRIMARY KEY(`OWNER ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
INSERT INTO `owner` ( `USERNAME`, `PASSWORD`, `NAME`) VALUES
('joemama','password123','Joe');
--
-- Table structure for table `staff`
--
Drop table if exists `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `STAFF ID` int(50) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  PRIMARY KEY(`STAFF ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `staff` (`USERNAME`,`PASSWORD`,`NAME`) VALUES
('shampooimpetuous','1qazxsw2','shampoo'),
('xebecshelter','1qazxsw2','xebec'),
('fishstarbolins','1qazxsw2','fishstar'),
('millwrighttherapist','1qazxsw2','mill'),
('tophatinflation','1qazxsw2','tophat'),
('preservecodger','1qazxsw2','preserve'),
('teenagerseason','1qazxsw2','teenage'),
('taekwondomoo','1qazxsw2','tae'),
('capitalistcool','1qazxsw2','capt'),
('reputationexecutive','1qazxsw2','executive');

-- --------------------------------------------------------
Drop table if exists `tables`;
CREATE TABLE `tables`(
  `TABLES ID` int(50) NOT NULL AUTO_INCREMENT,
  `CAPACITY` int(50) NOT NULL,
  PRIMARY KEY(`TABLES ID`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tables` (`CAPACITY`) VALUES
(4),
(4),
(4),
(4),
(8),
(8),
(8),
(8),
(2),
(2),
(2),
(2),
(6),
(6),
(6),
(6),
(10),
(10),
(10),
(10);
-- --------------------------------------------------------
--
-- Table structure for table `transaction`
--
Drop table if exists `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `TRANSACTION ID` int(50) NOT NULL AUTO_INCREMENT,
  `TABLES ID` int(50) NOT NULL,
  `CUSTOMER ID` int(50) NOT NULL,
  `COUPON ID` int(50) NULL,
  `STAFF ID` int(50) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `DATETIME` datetime NOT NULL,
  `TOTAL PRICE` decimal(10,2) NOT NULL,
  PRIMARY KEY(`TRANSACTION ID`),
  FOREIGN KEY(`STAFF ID`) REFERENCES `staff`(`STAFF ID`),
  FOREIGN KEY(`CUSTOMER ID`) REFERENCES `customer`(`CUSTOMER ID`),
  FOREIGN KEY(`TABLES ID`) REFERENCES `tables`(`Tables ID`),
  FOREIGN KEY(`COUPON ID`) REFERENCES `coupon`(`COUPON ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `transaction` ( `TABLES ID`, `CUSTOMER ID`, `COUPON ID`,
 `STAFF ID`, `STATUS`, `DATETIME`, `TOTAL PRICE`) VALUES 
 
(1, 1, 1, 1, 'COMPLETED', '2008-11-11 13:23:44', 12.34),
(3, 2, 2, 1, 'PENDING', '2008-11-11 13:23:44', 99.00),
(4, 3, 3, 2, 'COMPLETED', '2008-11-11 13:23:44', 55.50),
(5, 4, 4, 2, 'PENDING', '2008-11-11 13:23:44', 12.34),
(1, 5, 5, 3, 'COMPLETED', '2008-11-11 13:23:44', 12.34),
(2, 6, 1, 3, 'PENDING', '2008-11-11 13:23:44', 12.34),
(2, 7, 2, 4, 'COMPLETED', '2008-11-11 13:23:44', 12.34),
(3, 8, 3, 5, 'PENDING', '2008-11-11 13:23:44', 12.34),
(3, 9, 4, 6, 'COMPLETED', '2008-11-11 13:23:44', 12.34),
(4, 10,NULL, 1, 'COMPLETED', '2008-11-11 13:23:44', 12.34),
(7, 1,NULL, 1, 'PENDING', '2008-11-11 13:23:44', 12.34),
(7, 2,NULL, 1, 'PENDING', '2008-11-11 13:23:44', 12.34),
(6, 3,NULL, 1, 'COMPLETED', '2008-11-11 13:23:44', 12.34),
(8, 4,NULL, 1, 'COMPLETED', '2008-11-11 13:23:44', 12.34),
(9, 5,NULL, 1, 'PENDING', '2008-11-11 13:23:44', 12.34),
(2, 6,NULL, 1, 'COMPLETED', '2008-11-11 13:23:44', 12.34),
(3, 7,NULL, 1, 'PENDING', '2008-11-11 13:23:44', 12.34),
(2, 3,NULL, 1, 'COMPLETED', '2008-11-11 13:23:44', 34.56);
--
-- Table structure for table `cart item`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart item`
--
Drop table if exists `cartitem`;
CREATE TABLE IF NOT EXISTS `cartitem` (
  `TRANSACTION ID` int(50) NOT NULL,
  `ITEM ID` int(50) NOT NULL,
  `QUANTITY` int(50) NOT NULL,
  PRIMARY KEY(`TRANSACTION ID`,`ITEM ID`),
  FOREIGN KEY(`TRANSACTION ID`) REFERENCES `transaction`(`TRANSACTION ID`),
  FOREIGN KEY(`ITEM ID`) REFERENCES `item`(`ITEM ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cartitem` (`TRANSACTION ID`,`ITEM ID`,`QUANTITY`) VALUES
(1,1,1),
(1,2,1),
(1,3,1),
(1,10,2);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
