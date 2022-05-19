-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 19, 2022 at 06:38 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `TRANSACTION ID` int(50) NOT NULL,
  `ITEM ID` int(50) NOT NULL,
  `QUANTITY` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartitem`
--

INSERT INTO `cartitem` (`TRANSACTION ID`, `ITEM ID`, `QUANTITY`) VALUES
(1, 4, 1),
(1, 6, 4),
(1, 7, 3),
(1, 13, 2),
(2, 1, 2),
(2, 3, 3),
(2, 11, 5),
(2, 12, 3),
(2, 15, 3),
(3, 3, 4),
(3, 9, 3),
(3, 11, 1),
(3, 14, 2),
(4, 1, 4),
(4, 3, 3),
(4, 9, 1),
(4, 11, 1),
(5, 1, 3),
(5, 8, 5),
(6, 2, 2),
(6, 3, 2),
(7, 6, 4),
(7, 8, 2),
(7, 10, 5),
(7, 12, 4),
(7, 14, 1),
(7, 15, 3),
(8, 2, 2),
(8, 5, 2),
(8, 8, 5),
(8, 10, 4),
(9, 4, 5),
(9, 12, 4),
(10, 5, 4),
(10, 7, 4),
(10, 8, 1),
(10, 13, 2),
(11, 2, 3),
(11, 7, 5),
(11, 9, 1),
(11, 10, 4),
(11, 11, 4),
(11, 14, 5),
(12, 2, 4),
(12, 9, 1),
(12, 13, 5),
(13, 1, 4),
(13, 2, 5),
(13, 9, 4),
(13, 14, 5),
(14, 8, 1),
(14, 10, 5),
(15, 1, 3),
(15, 3, 2),
(15, 9, 1),
(16, 1, 2),
(16, 3, 4),
(16, 6, 5),
(16, 8, 2),
(16, 12, 1),
(16, 15, 4),
(17, 9, 4),
(17, 14, 2),
(18, 1, 4),
(18, 3, 2),
(18, 8, 1),
(18, 9, 3),
(18, 13, 4),
(19, 4, 1),
(19, 6, 2),
(19, 9, 2),
(20, 7, 2),
(21, 1, 4),
(21, 4, 2),
(21, 6, 3),
(21, 14, 3),
(22, 2, 2),
(22, 3, 4),
(22, 4, 2),
(22, 11, 2),
(22, 12, 4),
(22, 14, 3),
(23, 1, 1),
(23, 15, 2),
(24, 2, 2),
(24, 8, 1),
(25, 2, 5),
(25, 3, 3),
(25, 4, 4),
(25, 14, 3),
(26, 1, 2),
(26, 8, 2),
(26, 15, 2),
(27, 4, 2),
(27, 12, 2),
(28, 2, 5),
(28, 3, 4),
(28, 8, 5),
(28, 9, 4),
(28, 11, 5),
(29, 8, 3),
(29, 11, 3),
(29, 12, 2),
(29, 15, 2),
(30, 7, 5),
(30, 11, 2),
(30, 12, 3),
(30, 15, 5),
(31, 6, 1),
(31, 9, 3),
(31, 13, 1),
(31, 14, 4),
(32, 1, 1),
(32, 2, 2),
(32, 3, 2),
(32, 5, 4),
(32, 7, 3),
(33, 1, 1),
(33, 3, 1),
(33, 6, 5),
(33, 10, 2),
(33, 11, 4),
(33, 12, 3),
(34, 2, 4),
(34, 5, 1),
(34, 9, 4),
(34, 11, 1),
(34, 13, 3),
(35, 8, 5),
(35, 9, 2),
(35, 13, 5),
(35, 14, 5),
(36, 2, 1),
(36, 5, 3),
(36, 12, 2),
(37, 7, 3),
(37, 10, 1),
(37, 12, 1),
(37, 14, 5),
(38, 3, 3),
(38, 5, 2),
(38, 7, 4),
(38, 14, 1),
(38, 15, 5),
(39, 3, 1),
(39, 6, 5),
(39, 7, 2),
(39, 9, 1),
(40, 11, 1),
(40, 14, 2),
(40, 15, 5),
(41, 3, 5),
(41, 4, 4),
(41, 7, 4),
(42, 7, 5),
(42, 9, 2),
(43, 13, 1),
(43, 15, 1),
(44, 2, 2),
(44, 5, 3),
(44, 11, 1),
(44, 13, 1),
(45, 2, 1),
(45, 4, 5),
(45, 5, 4),
(45, 6, 1),
(45, 9, 1),
(46, 5, 2),
(46, 8, 4),
(46, 10, 2),
(46, 15, 5),
(47, 1, 5),
(47, 2, 4),
(47, 12, 1),
(47, 14, 2),
(48, 2, 5),
(48, 3, 4),
(48, 5, 5),
(48, 10, 5),
(49, 1, 4),
(49, 7, 4),
(49, 12, 3),
(50, 7, 3),
(50, 11, 5),
(50, 14, 5),
(51, 1, 3),
(51, 3, 2),
(51, 12, 2),
(51, 13, 2),
(52, 6, 2),
(52, 7, 1),
(52, 9, 3),
(52, 10, 1),
(52, 11, 4),
(52, 14, 5),
(53, 1, 5),
(53, 4, 5),
(54, 1, 3),
(54, 8, 4),
(54, 15, 2),
(55, 11, 5),
(55, 14, 2),
(56, 3, 4),
(56, 12, 3),
(56, 13, 4),
(57, 1, 4),
(57, 8, 2),
(57, 13, 2),
(58, 2, 4),
(58, 9, 1),
(58, 10, 3),
(58, 12, 2),
(59, 2, 4),
(59, 13, 3),
(60, 4, 4),
(60, 6, 5),
(60, 8, 4),
(60, 14, 2),
(60, 15, 1),
(61, 1, 2),
(61, 2, 3),
(61, 10, 4),
(62, 9, 1),
(62, 13, 4),
(62, 14, 5),
(63, 9, 5),
(63, 13, 3),
(64, 2, 1),
(64, 4, 1),
(64, 9, 5),
(64, 14, 4),
(65, 7, 4),
(65, 13, 5),
(65, 14, 3),
(65, 15, 3),
(66, 8, 1),
(66, 9, 3),
(67, 2, 2),
(67, 3, 1),
(67, 5, 3),
(67, 7, 2),
(67, 14, 1),
(68, 2, 5),
(68, 5, 5),
(68, 11, 4),
(69, 8, 4),
(69, 9, 1),
(69, 13, 1),
(70, 1, 1),
(70, 11, 2),
(70, 15, 3),
(71, 9, 1),
(71, 10, 5),
(71, 11, 3),
(71, 15, 4),
(72, 2, 5),
(72, 10, 3),
(73, 5, 3),
(73, 7, 1),
(74, 4, 1),
(74, 7, 3),
(74, 9, 5),
(74, 13, 4),
(75, 1, 5),
(75, 4, 3),
(75, 9, 3),
(75, 13, 4),
(75, 14, 1),
(76, 4, 2),
(76, 8, 5),
(76, 10, 4),
(76, 11, 4),
(76, 14, 1),
(77, 2, 4),
(77, 5, 5),
(77, 6, 5),
(77, 13, 5),
(77, 15, 3),
(78, 4, 4),
(78, 5, 4),
(78, 7, 4),
(78, 9, 5),
(78, 14, 3),
(79, 2, 5),
(79, 8, 4),
(79, 10, 4),
(79, 12, 3),
(80, 6, 3),
(80, 14, 4),
(81, 4, 5),
(81, 6, 1),
(81, 7, 5),
(81, 8, 2),
(81, 12, 1),
(82, 4, 4),
(82, 12, 3),
(83, 1, 2),
(83, 4, 1),
(83, 7, 1),
(83, 9, 2),
(83, 12, 4),
(84, 8, 1),
(84, 15, 1),
(85, 4, 1),
(85, 7, 4),
(85, 8, 2),
(85, 11, 5),
(85, 13, 2),
(86, 2, 5),
(86, 7, 5),
(87, 2, 4),
(87, 5, 5),
(87, 10, 3),
(87, 13, 2),
(87, 15, 3),
(88, 3, 5),
(88, 6, 1),
(88, 8, 3),
(88, 11, 4),
(88, 12, 5),
(89, 1, 1),
(89, 3, 2),
(89, 4, 3),
(89, 6, 1),
(90, 2, 3),
(90, 5, 1),
(90, 10, 1),
(91, 2, 4),
(91, 11, 1),
(91, 12, 4),
(91, 14, 5),
(91, 15, 1),
(92, 3, 1),
(92, 4, 3),
(92, 7, 2),
(92, 12, 4),
(93, 2, 3),
(93, 3, 5),
(93, 4, 1),
(93, 5, 2),
(93, 7, 2),
(93, 10, 3),
(94, 1, 2),
(94, 10, 5),
(94, 11, 2),
(94, 12, 5),
(95, 2, 1),
(95, 4, 4),
(95, 12, 3),
(96, 9, 3),
(96, 13, 3),
(97, 5, 3),
(98, 1, 5),
(98, 14, 4),
(99, 3, 4),
(99, 4, 2),
(99, 5, 3),
(99, 10, 4),
(99, 13, 2),
(100, 2, 4),
(100, 3, 3),
(100, 4, 2),
(100, 7, 3),
(100, 13, 3),
(100, 14, 5);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `COUPON ID` int(11) NOT NULL,
  `COUPON CODE` varchar(50) NOT NULL,
  `MANAGER ID` int(50) NOT NULL,
  `DISCOUNT RATE` double NOT NULL,
  `VALID` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`COUPON ID`, `COUPON CODE`, `MANAGER ID`, `DISCOUNT RATE`, `VALID`) VALUES
(1, 'ONEONESALE', 1, 20, 1),
(2, 'TWOTWOSALE', 1, 10, 1),
(3, 'THREETHREESALE', 1, 15, 1),
(4, 'FOURFOURSALE', 1, 8, 0),
(5, 'FIVEFIVESALE', 1, 10, 0),
(6, 'SIXSIXSALE', 1, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CUSTOMER ID` int(50) NOT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `CUSTOMER NAME` varchar(50) NOT NULL,
  `FAVOURITE LIST` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUSTOMER ID`, `EMAIL`, `PASSWORD`, `CUSTOMER NAME`, `FAVOURITE LIST`) VALUES
(1, NULL, '+gOQ1hlzSkGFoVglB24ZHYGzMbTDmjWshisED6Csly79YDzXiXoltpG1DuMFweXw2LuJDXkPEycGTlo=', 'guest', ''),
(2, 'hello1@gmail.com', '0F8uEtIqRv9d+kqvlFW6+D6dvuQZDikhWgFb2/y5DKVSdVtZN0rQ+6+QRuS48svd00qDkLQaQmeMFDY=', 'helloo', ''),
(3, 'customer@gmail.com', 'tVR62Ij0cieA/K9d5kZSMEnyLvfDO4gNYDqlW07290ygyE8G/5e1ssVi8XDdDrnWaHtHvXUT9vsbI5I=', 'customer', ''),
(4, 'test@gmail.com', 'AUpe4Nx+zwqk8nSvzF52ReV18+hlOKg5khEElB0x9UM+4EGIs2w/b6/8HbvgBM729IxI9CUpL0b/6qc=', 'testing', ''),
(5, 'testing@gmail.com', 'dqDc1Si8ewYhoM07Xsi0AbF3ej8WLEY9mbMUl9dAtoQggFmVIDvegH2mDy2SCS9BDtj9qqPI5B2PAnU=', 'testing', ''),
(6, 'customer1@gmail.com', 'roCgQ6xPxW4Qx/el0F74PmU4KVVz5T0UjOV9xT3YuM4WSdcAbNui9lxdTvVyYMtU1MuiDPrOeJQBQTo=', 'customerr', ''),
(7, 'hoho@gmail.com', 'Opzke/EdP1qHGMLhhMdF12z3++XKNmfIU9LcA/yTCIQ0yGzAa3ow9u1N5JKpBHgc8A0/0YulM5uOBj8=', 'hohoho', ''),
(8, 'hehe@gmail.com', 'hsg4XoRmu/Ne3f8bSwnMP40VCWJkf+Z9nK9ngCvnh8PPNPB9Euf2SxfXO14V0+ebMKcO+Lweeyca2yA=', 'heheh', ''),
(9, 'hohoho@gmail.com', 'DQpx9m8xibOlNlTjILC7z3zWoJSOq03XdQZxsthLHp9Kv22bZBGfHPRaPjaOJssTZ2obmyM6oAi0Cos=', 'hohoho', ''),
(10, 'hihihi@gmail.com', 'mFIXlC/z3y4SfBJKHYnJPa92F0jheh4U8KDqcUz9UuorUTM3hZ9Df0es3M4k1cfqP3dWoBdesQIF6/g=', 'hihihi', ''),
(11, 'testingg@gmail.com', 'rA8YDa09BdA+kYMhI5rydC8Z1fk3RsFrM7ss8D8Y2atvA4+owep8gL9U3iYUBKlvZsHQfI4GHJ130Uw=', 'testingg', ''),
(12, 'huhuhu@gmail.com', 'LHJY+kUbhuAdZY5zthU4uZyeIxl+MNqSpnx250uVl+mSG6X8latKxRJXon0oF2zny+mpLI79qSh4wPM=', 'huhuhu', ''),
(13, 'marktan90@gmail.com', 'lg1uAfnSXNBY2VxvhGfABekRTXs5MWqeUe4Gwm1CpbYfqPUANqRnXWuDX9s4DRa8u6a5m0/lSePQzNE=', 'Mark Tan', ''),
(14, 'Marylim87@gmail.com', 'mLR/UmRPmq4tDb2J1+hdTZzk675f+st0nM2Pi1OgCzTjPCJ5JskgAQRFgyYiugPorL/ImGWk/29OIk0=', 'Mary Lim', ''),
(15, 'makanclub@gmail.com', 'ZVfh1TjKY1a4XzzII50STddL9fRGsv6zGWzUpbbMjCRTa0Jd5QEZ9EDa4DBoLGtim3BrAxOblpOdMHY=', 'makan club', ''),
(16, 'localhost@gmail.com', '9Fbzs8LRJJBOO+bCh8C3hi2wWcjWc8X1i0QtFf7Im9qegNhNI7eYaeIO7S3ap91UdlGcO/PaXSqpY0k=', 'localhost', ''),
(17, 'phpmyadmin@gmail.com', 'nESbpqlyZIaVI0HH062yjZcCWG8VksuRZaQMtn+g86fCjYWh35Vg0ryx7fV/B6abqeDYDm/D2L4weks=', 'phpmyadmin', ''),
(18, 'jkjkjk@gmail.com', 'X+jnYwFjjq7MGpNQXWhg83EmG+7JutVM3DchQP0k8i+J0MOSPuMcSz4Uv+nsr0S2EvQs398SSQ4UP6o=', 'jkjkjk', ''),
(19, 'jkjkjkk@gmail.com', 'kRCkmClkBjLlHQDMxL/CgyQUO6pqyPA4nxuluk9eLWH85wdt6kJSTSRaX5QPAJlOXJG3FHWf1q4ZY0M=', 'jkjkjk', ''),
(20, 'uowstaff@gmail.com', 'TkYyyuWfZvSmLPNRI0UorKVfIGMlQschDN/0LSAIjenFPNJMb8pZcLWL5rstSRcEU8zXdkNDq0tGbek=', 'uow staff', ''),
(21, 'simstaff@gmail.com', 'Quia3V6kEAQqa7X7gDHm8GMdMboauo2793yct1WZIeJHRYemnX2dlzw0DA8wVl7H9lHvx+3cxrop8HU=', 'sim staff', ''),
(22, 'simstudent@gmail.com', 'CP5neFHl3BhimeuxVe5h2QRIyGGJWrpyGdn9WOpLWwlXViL00JW1GqwlbXhgSN3bB0/hApzm8JEMrN4=', 'sim student', ''),
(23, 'rainbow@gmail.com', '5YLaDl8T9i1/yco16GMj4fuu/BsFMw2pfmT4ecCe5ueVDlUEcx2PE4+g7E29wcdyLHa+A1d9hAUqV24=', 'rainbow', ''),
(24, 'githubmaster@gmail.com', 'JN2dCdBFZNoOwiwgCAorLHwiU1N2ZBQ9XlBZIWRhNDYWuvLvZ0QwwR9BCcweg2G+HnrClJEcKym3zC4=', 'Github Master', ''),
(25, 'bottle@gmail.com', 'RGh9Xf/hZhVNglO6UkklpzmwXMoRqIC88F2/iGrSInPV9vfJBEglvWSoa11rA0HVaNs7Wzyl28HwG1Q=', 'bottle', ''),
(26, 'plant@gmail.com', '9lrxvj7jNCRgARcolkL61pCptN7oEsxEvW1LpXNZWdxB2cgT1GjeFhuDLSwUo+k+/BHNzzEYcxjI5MQ=', 'plant', ''),
(27, 'outlook@gmail.com', '0BNmsSX4RzZUFMBKpT+lGZMjKAe5rWsr9RJUT5SlQUaryFD2Aj6jybvQvK1SPNcl/KaMfRFP/X2yUxU=', 'outlook', ''),
(28, 'gmail@gmail.com', '2Gi1CPcpAAG4rZgCvpM/TCaECQf76O5KaY8YV5KJztykrp2k+2eI1Uzz3o5dHSVjqyPNLk/6qysjBUA=', 'gmail', ''),
(29, 'gdrive@gmail.com', 'wtpL0Jq5LP8975ePwS9YhOPE2a8Egk/0974GCNDampn5pNqAydqxocy3XX02lEmW2nPFRyAJgFgF+m0=', 'gdrive', ''),
(30, 'sofa@gmail.com', 'eixDTESqc8JYPW/VCMnrBm5mZZWq9uW0cHtt8Z1FN2bu8KTN/IQvxpDwKlTQ8NBQLtCFd+9z8OE0Oww=', 'sofa', ''),
(31, 'table@gmail.com', 'jqSYqyADKsKY4Npc6n7uqriSSfesDbNVCd+fh+tC0C3J94l2JhoDq1KTnyGdi2jqNmeyika3itqnbGI=', 'table', ''),
(32, 'chair@gmail.com', 'glGs8wz3HoeuhamQHqiFcWx0AQMJkdzeQIk9CYidKmAUdcUFKuwDC5r4Mow73pcQDugBNN2EuXGaeVM=', 'chair', ''),
(33, 'Lucyloh@gmail.com', 'C8NM5mt31d+f+f7iqfP+R2KOcMFJMkS6vKAXWARD6qMFKXP6ootYuSW1e2FwfDZCmMmqP8AVmX95Euc=', 'Lucy Loh', ''),
(34, 'phone@gmail.com', 'a2To5P3bixz7ifV0mNsYYXLbWm+3s+xI9Q7boyklqLhpTGQ9bh8iN9ZcHKb0IndaLF1iG8F0axKWVdo=', 'phone', ''),
(35, 'michaelsim@gmail.com', 'AWjImtxmpHqDLPQwk3cXcw2GBM+ZMTM/sW1Y9aEN6bYQ3sJleZCSQgb/St3hWX/09mYOSMpqZM7x6QM=', 'Michael Sim', ''),
(36, 'pikachu@gmail.com', 'bbNMDMA32Q/t7q1lA8jP1DC11OsXO0aopN/48EtI1SSgVHUKGpqCf6D09KkEJoiXIzprmDLhQEuF7K8=', 'Pika Chu', ''),
(37, 'jaychou@gmail.com', '/2qKriEvgF8xwvwdo4ldfYEuMTfAgcKhLOYyI+QqHZfscxHdAQ48P8b3L6jyHr8fOWLEENaTfu3Bhr0=', 'Jay Chou', ''),
(38, 'jb@gmail.com', 'cjL1kQqOs8r3fIu7MYT2CCieub/c6myml+v1ZCTpDm4M2wyC3g/0rPlJAktcCZdScGqlhTAOrja5knU=', 'Justin Bieber', ''),
(39, 'jjlin@gmail.com', '0miplx4jTE8dwz0z0RkRq9Yon1h4xGtDSrbfvDwSLeMeUcU27cArGxorg8wISOs75y5HqQh45Aw7v/8=', 'JJ Lin', ''),
(40, 'marcus0099@gmail.com', '4If8p6ZT/YwDLdGTFaxU9cRwrq9SkDIilE7cqM1+Zqoz5+YtqTgRESPklXJEQRa+kwxdYtHUOGuX4yM=', 'Marcus Goh', ''),
(41, 'stephl@gmail.com', 'nXa261p4GRbkkNmUYbaQJOsgshUZcnw0DDk5sI3QTcUX3BmTZs37JHRYlBvSrWMzdiugNysurUDCzik=', 'Stephanie Lee', ''),
(42, 'joshtan@gmail.com', 'Xj+ZmBf5WqfNv0NWJ36RT9vdn0BQybTh9o7RyO5+AhWHfkHRgMHj8I714jUN0HIt45K05z0E8rfA1J8=', 'Joshua Tan', ''),
(43, 'Johnyap90@gmail.com', 'oTgvg1WKJhfuRtIma737pYgsmz2wsPIscSVECmNqt9kZ+NIMTE4hBegb8Tt7Qv/byVdEfpjJ0o6WRJk=', 'Johnathan Yap', ''),
(44, 'pokemon@gmail.com', '2aEdcgK/yGq0n6TXkgNPTFB+nhb9UDBioZjWKllhguGkfckyCElHSg+XCSPDeAAZZhc3ZpJdjmG+HGg=', 'pokemon', ''),
(45, 'macdonalds@gmail.com', '8/vkIVes1F1aEDcY7HsEn29uzsj0mHQMhN0GC0mvwy1eG4hszenVkx35gZBmfWbDLgTT8l6I83eG7y0=', 'macdonalds', ''),
(46, 'KFC@gmail.com', 'HgAayERRp2EI4ubu//MbUVA8V9LdAtXB2/vcUjVKAMzaIW8khVd6Um9LpUr3G0jCC7d6A9ldZykPXmg=', 'Kentucky', ''),
(47, 'samsung@gmail.com', 'uL7gAQfCnQ7GLXONRRMdY9mdum/Wd7qmRMVSWmVHX24qr1R7N2b3istSknFo7NSDEGX22BvcvnFrBdI=', 'samsung', ''),
(48, 'applec@gmail.com', 'TajPMCiLPquPSWqCyIKeoB+NqvneFrk7Xqjq3Cdq8qVB+YrAVVqRuNH9QQW/8bmX+1VTnwJuri6n9vQ=', 'apple chan', ''),
(49, 'ilovedurian@gmail.com', 'KM7gWeaaqRJJbTFeYbL9PT3ZFSPZ/mltT6RJoCiTjgLwmUjXq8vjZrwEuOITp0HIr0jWrAdoZUHIa2c=', 'Matthew Chua', ''),
(50, 'annetteltq97@gmail.com', '9oVNaGO8FmXmcR+sS38gVFThRoK6812tb4Q9A3AtEg84nDcQ58DaRBu9gjkfNTD9GeG3HlPcfZv1370=', 'Annette Lim', ''),
(51, 'gracietan@gmail.com', '5eVh5H3j+PYGQySz2Hs/Jn7GKLY0M7R3GV7t84NWOnOaQ+nMzV9qJ9d1cnjSJYitfla4vxALqFBYqgs=', 'Gracie Tan', ''),
(52, 'kennethsoh@gmail.com', 'V06mFWPNWdOVLdrdsqobMfY+x5iImoduetIm44KQhdEQ4Hl1bsaLS6B9wiqejJGiqTsU6qvLVSva0bk=', 'Kenneth Soh', ''),
(53, 'yapjiamin@gmail.com', 'HwbgagOZuOaoQJrQT472tyoCfusuYNEQPZNhShcYvScR70r/LYI8J/jN4vxoehk9dfThdGR/bU/YFkM=', 'Yap Jia Min', ''),
(54, 'tohjiaqi@gmail.com', 'UQvru5EA+c4FqMSaK5UigUihHfLcfpMFHAIqGjrMfKRuf1bDbramlTZnCK4E8oWqwkZ0Rrd/0AqQxMQ=', 'Toh Jia Qi', ''),
(55, 'anghaoming@gmail.com', 'kE8TJLqKaohw7r+OHqm6R9hXWYu8U7gQLpUwc9bqBE2C8W4m/BTPpREkqH+tr6QuiaiUxwc3T2jcg8Y=', 'Ang Hao Ming', ''),
(56, 'yehzhihui@gmail.com', '7u6e54wdSfYhFqzq+2YG0touaKUddlNS01aCAMpOJ/gt8qNesT7bmEJdvsyezbr/N8QRZfYgfJTCMrY=', 'Yeh Zhi Hui', ''),
(57, 'xuzhixin@gmail.com', 'efrDP3cF6XDfPkiH6EkDnCUboQo8UfMoDGPp0U5QVcOoG922idHeXpBAPw5H6ifVANmhic0U3UEO51s=', 'Xu Zhi Xin', ''),
(58, 'chuxiyin@gmail.com', 'Iox8tfi4m1b76pX1nhuXDj1z674ykpluI/UwQDXxy8yyLxlu9EN+4G/Cf8FwtUqzColxBluG/EdvXAc=', 'Chu Yi Xin', ''),
(59, 'chuyixin@gmail.com', '+hffCysQkA/W+FLGNrz39YehOSdl03mDyMBK4A7lWhrZHYHU9L6WSAukYFFdhsrlfU6j3AaPLwQD/Xg=', 'Chu Yi Xin', ''),
(60, 'lohyiling@gmaill.com', '9r4KnqYGT36ktQ1Tgq0Y/ZNG72IUpB0zW2O8VgDkYpfM5/DIpEdvK0etYs6y8PiEsMoU6QbHQJ9vsUo=', 'Loh Yi Ling', ''),
(61, 'yehruien@gmail.com', 'hnM/yEFLLUYdLLiCeWH3M8qVIfpbWQwgH1kmwfHYxVJWD4Xa0IaD9+WE6rioiV6fCMRkNhB8+YG+8Cg=', 'Yeh Rui En', ''),
(62, 'qinminghui@gmail.com', 'zNsK9BIJ5tJ+nN6uSUapSNh9DXDOiiKRnmi6nTbd0CWIEf+W5y8Fym+5j7sWcz9SOzcrHhACKK4mFoM=', 'Qin Ming Hui', ''),
(63, 'fungjunming@gmail.com', '24pNqyqtMusPP6Xo0FOP/7Q2V/btQh+0VyX7FVr63jhrItMSZMFEnLh+BFtwDa9rkqHiulO3rbx+eBE=', 'Fung Jun Ming', ''),
(64, 'chengkaifeng@gmail.com', 'Bb4RHWgs5VgMbooPZP3hLURaEKjwsimaMe7hvpMuV3qnh/HllSqwn6aj4HlCQ1fb+Hs1nfjkGKw5TtY=', 'Cheng Kai Feng', ''),
(65, 'oonkaixin@gmail.com', 'V4egRxd8IV2XVbZlRxEgArN3cv/FpcKzsDZaFeQsAsBn9DhkUzHSDZ4MC3VpmIm2DvDab9mTcxrZ2gU=', 'Oon Kai Xin', ''),
(66, 'leemingde@gmail.com', 'XK+F8MHG8IN9ugI4SSdmtut2vyhxiLglT/MmM1uorp+VgXnvBt1PBGaP92+vKxsgJxZ1yr8KDTjD+N4=', 'Lee Ming De', ''),
(67, 'punxuanhui@gmail.com', 'uoEjwYbavN6rlYHlN7nxT+8LgLfkv72F6WsJsAVRrhNfPLMdvPsgVLxiazXjzhg7nhpjE5khV5k/8y8=', 'Pun Xuan Hui', ''),
(68, 'linmingen@gmail.com', 'Ouvzy71cZJQBwlqf0ta0ubkZ/IOBxHpBdrREmax6mV8Vfsi1HunxMZ7LIB7R7Gl9fqkHyQrhsYkESBQ=', 'Lin Ming En', ''),
(69, 'yeoyongchang@gmail.com', 'r/QECMmlXp50jNKQf1aO6D+6HJ4ZpSYOrurHeOWGKf+eBRZaZkXUxGYfZ3uX7SyHBO9NpytEcXdD4g8=', 'Yeo Yong Chang', ''),
(70, 'linmingde@gmail.com', 'v7oXemb5J17H3WEf5h8cmJOWq6puFppE8UdQ357nNJo/4NU1EkaG7e2h+u/q6vHtfrSbDrcVxP/Za4Y=', 'Lin Ming De', ''),
(71, 'chenjiale@gmail.com', 'mKIuT+yvfR8kWl0x9L5t8HBsgXc3pdk+Xy71yKt0TOnqQuCWQeHFtIc4e38R7MIxU+u3wAayXshWr/w=', 'Chen Jia Le', ''),
(72, 'tangkaiwen@gmail.com', 'rwIkbjXmio1HFcTBxTX8bvYvKa3O5q25iYCqAnJOPjPVinAMr003z3oVQYjmPUxE9/+ZROVe93NmImU=', 'Tang Kai Wen', ''),
(73, 'lyejiale@gmail.com', '0O6UamE2tNDKgngSFwVVDwwcSUFW9P/mtN3HqQA26JwNDD5g20i6dMRQkz4YTlezrcvOi3ScfCPEnAg=', 'Lye Jia Le', ''),
(74, 'tengguoming@gmail.com', '8gRFmGK0faedzX3Gc6A12Chq46qGlJ2qijqKuxDWzqKTFhzx19h0Z3Hmg4geJQu7kal47yDyhltMMxg=', 'Teng Guo Ming', ''),
(75, 'linjunde@gmail.com', 'iB1EnlxI2LD8XQTpYLlcOauB0rgIDAbRwV2H1mtIPFATS56i0FhKaDFjnLk4AFcmmn+IBEKJuCZEX/0=', 'Lin Jun De', ''),
(76, 'tonglinghui@gmail.com', 'YopgRBnW/ZmN8cnhxFntPYcTvmeQTQllUfXlYPFw5fohR+OTEfUUfdgLayLJqoD+cZ3NullN4XVmBH8=', 'Tong Ling Hui', ''),
(77, 'yeodeming@gmail.com', '30gPzQTXT7gp3rfbWrifmwTFD1E3NweA3P3CThUe/AVhI6rKcVH6Hp+WOQ/sfrlgmoAVSSxECOe53cs=', 'Yeo De Ming', ''),
(78, 'teohjiaxin@gmail.com', 'vzNyw01buhm0zaW9CDoqjPEvxkDMqDXu7aiAOhpeATmvDglccgs+8Gj3XjLcGGCl9oD140vaIDg01Ts=', 'Teoh Jia Xin', ''),
(79, 'angjunjie@gmail.com', 'kNCW3QAFx3BzU/BeA72udQuVDvY0kIk0LETkpoQZ2HoFfsPqP83Px93UT+BCWCmX1Ku7/aeeyRfvzCc=', 'Ang Jun Jie', ''),
(80, 'laujingan@gmail.com', '0IwqBU8usXs7K26mGvjfuWWfCtXrECXNcILp/zAxLet4TyfPGdvZEuyJilR1LdVfgBQtmoE+szmlYkM=', 'Lau Jing An', ''),
(81, 'behyongbin@gmail.com', 'VJlN6/vdgm+lUYubZoCoKum7Z3TPDUT/OtMno0xNjODa0drDOSQ9+Pmqchmi96Kswah8GIRbeYmtkLg=', 'Beh Yong Bin', ''),
(82, 'teoyixi@gmail.com', 'xV/fu1oPuq6u09MDGCR6fZgKSY+1t8MCxEQPhMHl2xfG/jDpzarqhagwdTKABg0JSEiQ1Rr9r9DwVE0=', 'Teo Yi Xi', ''),
(83, 'teohjiaxi@gmail.com', 'jWsnQf2WnO86dHTfnGpjJESSoTHp+uST3EnLD8c/uLN3xNx2bnkSfcVQwEF1j5C0LX+zbX79/eIQ5Zw=', 'Teoh Jia Qi', ''),
(84, 'saywenkai@gmail.com', 'oRxgV+92SG7UJHixLVLaJZTHp20fZX1MWx3uYqEdKkwgaukYks0rhIxKGc4Imy24rC1/3rGdI+nuL4o=', 'Say Wen Kai', ''),
(85, 'choohuishan@gmail.com', '1kFG0GsyM6WbRzxyNNB2B+nN9ObeX5OpKZ+/mvRFcm5hC3j48DRkFCuKawhlOsfrzxjKZqEcx9LvBbA=', 'Choo Hui Shan', ''),
(86, 'liguoen@gmail.com', 'sFF7Y/7DBDs0YAbvu0uGpFNsWXjGoQoEdDfoswAwV1WS7rWnce0heZ8gby6N1vAF308xhporETJa4eI=', 'Li Guo En', ''),
(87, 'lewkaiwen@gmail.com', 'eHpiRCEqK6lULGfN3zrf5MOa5hTBAH6mmZ73emb3CGXFfbpJa53TK6z2ZacqtE5WrFWYP20ZRGFOpaQ=', 'Lew Kai Wen', ''),
(88, 'helinghui@gmail.com', 'd1lSb8GsEITIRSozt98s/v84xgb6NP8XUcI6V0H43CFIpb9fUehF0JIkD0n5Wpwrjzbj8LBg+LexTMw=', 'He Ling Hui', ''),
(89, 'wukangmin@gmail.com', '2c/7D/sAd+3rnomRbMESKsWwdluKihK4wcJloO+o36bMJhsS+iExL1RID8ixF4d9E3Vq9cwMUJmJ+PE=', 'Wu Kang Min', ''),
(90, 'teoxinen@gmail.com', '2+mpIU5ir9+R/cfWNiImym2/Nq45fkAmWHNquftDxcQXOKuKSl4UgUg5mmmsFPWM0xpdtiNI+2TySsk=', 'Teo Xin En', ''),
(91, 'ongzhihui@gmail.com', '4M5gGH4+KvNWQdvrwKo9pM3sh8BIBlBCTRAmxdzM6XXqvAsAISJeS+FpiOT5Ilta64Fusr7P5ULxcvM=', 'Ong Zhi Hui', ''),
(92, 'chengjunrui@gmail.com', 'OOIqtieLL5WccX6GX8BWSnTWQ+aAo6285a2WJJkJoLOdgX3bmH2mwvNC7WY3rjkcKdqMJOv3T3iYzP0=', 'Cheng Jun Rui', ''),
(93, 'leeweile@gmail.com', 'Jp9jExxGoI+7n0g2c20CXB9Lqs95TAj6qGAGDfiSwxAgG61QS0tT3iUfH5dt0Iq1s8NCGk58w0prAsA=', 'Lee Wei Le', ''),
(94, 'huyinghui@gmail.com', 'SUtpPcFEn4fXE+O6lR2YLAMDzM0L6nTakA1KPcMa1rC7s/AXtFzZ624bUWPXjWsoTZq4zhBN6vCw3tw=', 'Hu Ying Hui', ''),
(95, 'Oonjiawen@gmail.com', 'TCO9Tizg4JP/Ta4nd5z0N3b8rMmhX8Gsl64zz3uOypPxxmzKPeuQV7vzT+nwlEfzCxjMfXo5XS6Zb5k=', 'Oon Jia Wen', ''),
(96, 'oonxuanying@gmail.com', 'fqZPwaQXBCeYPVARg9oaHbfcn1t4Hbd0zklc+RX+0ja99AA5k5lFZBtxyPL/UTVd6by9bEY9xQiG3ws=', 'Oon Xuan Ying', ''),
(97, 'panxihui@gmail.com', 'BtAdtqogCjdkpiYE9kGOF7j9Dq6IummuxSKaogNwmXv3EG68U5gD85Cv4+LsSwlk/ZyNj1FgHMxNVtI=', 'Pan Xi Hui', ''),
(98, 'huangjingan@gmail.com', 'vF29VH3h0/Uj/Y4IGjgghaW+2aJ3LoRDx+8ThvXRkHzuRh42jD1pKcfhOO/FRXtChAkWsfX3QoBUIXU=', 'Huang Jing An', ''),
(99, 'ngxiling@gmail.com', '/S/0rMno+YnAKT/1sb0OtNe4M/FqBXBPkB6HjQG75Le/v1/ezlc0qsXGuaEnRCIRORzCvLTerQPVbC4=', 'Ng Xi Ling', ''),
(100, 'lamkangmin@gmail.com', 'ypCHpoqu9/4NHU1OFJbiFxfOvW8zez5X3apr/WMPnQc2/4j18FxppumyYFKzFbMnTTvS2N8xTkki+MQ=', 'Lam Kang Min', '');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
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
(1, 'Burger', 'Entree', 12, 'images/beef burger.png', 1),
(2, 'Carbonara', 'Entree', 11, 'images/carbonara.png', 0),
(3, 'Chicken Chop', 'Entree', 11.5, 'images/chicken chop.png', 1),
(4, 'Fish and Chips', 'Entree', 14, 'images/fish and chips.png', 1),
(5, 'Linguine', 'Entree', 11.5, 'images/Linguine-and-Clams.png', 1),
(6, 'Pork Chop', 'Entree', 12.5, 'images/pork chop.png', 1),
(7, 'Pizza', 'Entree', 22, 'images/pepperoni pizza.png', 1),
(8, 'Cheese Fries', 'Meals', 6, 'images/cheese fries.png', 1),
(9, 'Salad', 'Meals', 6, 'images/caesar salad.png', 1),
(10, 'Fries', 'Meals', 4, 'images/garlic-parmesan-french-fries.png', 1),
(11, 'Wings', 'Meals', 9, 'images/chicken wings.png', 1),
(12, 'Iced Tea', 'Drinks', 1.5, 'images/Iced-Tea-3-1.png', 1),
(13, 'Iced Coffee', 'Drinks', 2.5, 'images/iced coffee.png', 1),
(14, 'Matcha Latte', 'Drinks', 3.5, 'images/matcha latte.png', 1),
(15, 'Juice', 'Drinks', 2, 'images/orange juice.png', 1),
(16, 'Spaghetti', 'Entree', 10, 'images/meatball spaghetti.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `MANAGER ID` int(20) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `NAME` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`MANAGER ID`, `USERNAME`, `PASSWORD`, `NAME`) VALUES
(1, 'joesepthmama1', 'password123', 'Joesepth');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `OWNER ID` int(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`OWNER ID`, `USERNAME`, `PASSWORD`, `NAME`) VALUES
(1, 'joemama', 'password123', 'Joe');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `STAFF ID` int(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`STAFF ID`, `USERNAME`, `PASSWORD`, `NAME`) VALUES
(1, 'shampooimpetuous', '1qazxsw2', 'shampoo'),
(2, 'xebecshelter', '1qazxsw2', 'xebec'),
(3, 'fishstarbolins', '1qazxsw2', 'fishstar'),
(4, 'millwrighttherapist', '1qazxsw2', 'mill'),
(5, 'tophatinflation', '1qazxsw2', 'tophat'),
(6, 'preservecodger', '1qazxsw2', 'preserve'),
(7, 'teenagerseason', '1qazxsw2', 'teenage'),
(8, 'taekwondomoo', '1qazxsw2', 'tae'),
(9, 'capitalistcool', '1qazxsw2', 'capt'),
(10, 'reputationexecutive', '1qazxsw2', 'executive');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `TABLES ID` int(50) NOT NULL,
  `CAPACITY` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`TABLES ID`, `CAPACITY`) VALUES
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 8),
(6, 8),
(7, 8),
(8, 8),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 6),
(14, 6),
(15, 6),
(16, 6),
(17, 10),
(18, 10),
(19, 10),
(20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `TRANSACTION ID` int(50) NOT NULL,
  `TABLES ID` int(50) NOT NULL,
  `CUSTOMER ID` int(50) NOT NULL,
  `COUPON ID` int(50) DEFAULT NULL,
  `STAFF ID` int(50) DEFAULT NULL,
  `STATUS` varchar(50) NOT NULL,
  `DATETIME` datetime NOT NULL,
  `TOTAL PRICE` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`TRANSACTION ID`, `TABLES ID`, `CUSTOMER ID`, `COUPON ID`, `STAFF ID`, `STATUS`, `DATETIME`, `TOTAL PRICE`) VALUES
(1, 18, 37, NULL, 9, 'COMPLETED', '2022-04-05 09:56:51', '63.26'),
(2, 19, 74, 5, 7, 'COMPLETED', '2022-04-02 09:24:29', '73.26'),
(3, 6, 60, 3, 7, 'COMPLETED', '2022-04-22 09:19:14', '51.09'),
(4, 12, 78, 3, 3, 'COMPLETED', '2022-04-28 08:36:28', '72.60'),
(5, 6, 27, 4, 5, 'COMPLETED', '2022-04-07 09:45:09', '52.46'),
(6, 2, 40, 1, 9, 'COMPLETED', '2022-04-12 08:40:00', '52.65'),
(7, 7, 87, NULL, 5, 'COMPLETED', '2022-04-28 11:17:18', '63.48'),
(8, 11, 42, 4, 4, 'COMPLETED', '2022-04-18 08:28:07', '64.87'),
(9, 6, 3, 1, 8, 'COMPLETED', '2022-04-12 08:56:38', '68.17'),
(10, 1, 47, 1, 7, 'COMPLETED', '2022-04-23 09:16:58', '57.53'),
(11, 15, 20, 1, 7, 'COMPLETED', '2022-04-07 08:26:13', '92.33'),
(12, 12, 100, 2, 1, 'COMPLETED', '2022-04-22 08:36:23', '95.08'),
(13, 1, 99, 5, 9, 'COMPLETED', '2022-04-23 09:53:36', '51.23'),
(14, 16, 78, 3, 8, 'COMPLETED', '2022-05-01 11:15:58', '83.76'),
(15, 5, 27, 1, 1, 'COMPLETED', '2022-04-10 08:40:40', '91.90'),
(16, 1, 12, 1, 6, 'COMPLETED', '2022-04-08 10:32:03', '82.00'),
(17, 20, 16, 5, 8, 'COMPLETED', '2022-04-30 11:06:43', '56.84'),
(18, 9, 83, 1, 4, 'COMPLETED', '2022-04-29 08:58:28', '78.65'),
(19, 6, 55, 1, 2, 'COMPLETED', '2022-04-18 11:09:46', '91.78'),
(20, 7, 21, 4, 10, 'COMPLETED', '2022-04-22 09:14:46', '69.69'),
(21, 6, 8, 1, 4, 'COMPLETED', '2022-04-25 08:57:25', '91.48'),
(22, 18, 8, NULL, 5, 'COMPLETED', '2022-04-12 10:49:50', '51.91'),
(23, 15, 77, 2, 6, 'COMPLETED', '2022-04-26 09:17:38', '83.84'),
(24, 10, 63, NULL, 2, 'COMPLETED', '2022-04-08 11:16:39', '50.59'),
(25, 14, 78, NULL, 1, 'COMPLETED', '2022-04-21 09:03:15', '73.89'),
(26, 2, 82, 4, 4, 'COMPLETED', '2022-04-26 10:36:03', '60.94'),
(27, 3, 97, 1, 2, 'COMPLETED', '2022-04-20 09:39:36', '88.61'),
(28, 8, 20, 1, 6, 'COMPLETED', '2022-04-30 09:45:08', '76.52'),
(29, 8, 54, 2, 5, 'COMPLETED', '2022-04-14 10:20:23', '54.03'),
(30, 13, 31, 2, 5, 'COMPLETED', '2022-04-17 11:00:56', '66.08'),
(31, 7, 29, NULL, 8, 'COMPLETED', '2022-04-26 09:25:18', '93.98'),
(32, 5, 45, 4, 5, 'COMPLETED', '2022-04-10 09:40:16', '73.21'),
(33, 10, 52, 4, 7, 'COMPLETED', '2022-04-28 10:34:37', '74.56'),
(34, 7, 7, 3, 2, 'COMPLETED', '2022-05-01 09:24:49', '58.11'),
(35, 3, 46, 5, 10, 'COMPLETED', '2022-04-21 10:38:59', '77.69'),
(36, 8, 67, NULL, 3, 'COMPLETED', '2022-04-19 08:30:09', '60.62'),
(37, 14, 12, NULL, 5, 'COMPLETED', '2022-04-17 10:52:54', '94.99'),
(38, 15, 85, 5, 1, 'COMPLETED', '2022-04-10 11:13:10', '95.62'),
(39, 7, 26, 1, 8, 'COMPLETED', '2022-04-17 10:13:16', '66.52'),
(40, 5, 2, 4, 9, 'COMPLETED', '2022-04-10 10:16:29', '96.79'),
(41, 15, 45, NULL, 5, 'COMPLETED', '2022-04-27 10:11:08', '58.48'),
(42, 1, 55, 2, 2, 'COMPLETED', '2022-04-27 08:30:58', '50.56'),
(43, 14, 3, 1, 10, 'COMPLETED', '2022-04-01 09:56:28', '72.82'),
(44, 15, 93, 5, 8, 'COMPLETED', '2022-04-09 08:33:28', '60.03'),
(45, 15, 72, 1, 9, 'COMPLETED', '2022-04-30 08:52:58', '66.18'),
(46, 11, 26, 4, 1, 'COMPLETED', '2022-04-21 10:31:27', '84.50'),
(47, 10, 78, 5, 1, 'COMPLETED', '2022-04-30 10:25:01', '94.22'),
(48, 11, 67, NULL, 4, 'COMPLETED', '2022-04-18 09:13:31', '64.24'),
(49, 8, 16, 3, 1, 'COMPLETED', '2022-04-10 09:17:58', '83.29'),
(50, 15, 96, 2, 2, 'COMPLETED', '2022-04-03 10:18:46', '54.82'),
(51, 5, 57, 4, 7, 'COMPLETED', '2022-04-03 11:16:29', '88.45'),
(52, 19, 54, 3, 10, 'COMPLETED', '2022-04-12 09:00:13', '50.90'),
(53, 9, 31, 5, 4, 'COMPLETED', '2022-04-30 11:08:12', '63.39'),
(54, 16, 5, 1, 1, 'COMPLETED', '2022-04-25 08:31:50', '65.32'),
(55, 17, 54, NULL, 5, 'COMPLETED', '2022-04-28 08:36:49', '51.11'),
(56, 3, 29, 1, 3, 'COMPLETED', '2022-04-07 10:10:16', '56.79'),
(57, 15, 61, 3, 4, 'COMPLETED', '2022-04-22 08:50:09', '94.96'),
(58, 6, 95, 3, 9, 'COMPLETED', '2022-05-01 08:29:59', '56.24'),
(59, 12, 99, 2, 9, 'COMPLETED', '2022-04-09 10:37:54', '72.90'),
(60, 6, 11, 1, 4, 'COMPLETED', '2022-04-08 10:57:11', '97.59'),
(61, 2, 57, NULL, 4, 'COMPLETED', '2022-04-13 09:31:02', '75.37'),
(62, 10, 80, 4, 2, 'COMPLETED', '2022-04-15 11:16:36', '60.76'),
(63, 3, 8, 5, 6, 'COMPLETED', '2022-04-30 08:24:55', '53.12'),
(64, 9, 68, 2, 9, 'COMPLETED', '2022-05-01 09:13:59', '78.45'),
(65, 16, 4, 5, 6, 'COMPLETED', '2022-04-05 09:19:31', '99.78'),
(66, 19, 85, 5, 1, 'COMPLETED', '2022-04-13 11:05:41', '77.20'),
(67, 10, 86, 1, 1, 'COMPLETED', '2022-04-01 11:03:29', '91.58'),
(68, 14, 86, 3, 2, 'COMPLETED', '2022-04-30 08:19:30', '50.29'),
(69, 12, 44, 1, 8, 'COMPLETED', '2022-04-27 08:22:39', '97.28'),
(70, 16, 76, 2, 4, 'COMPLETED', '2022-04-21 09:56:07', '98.51'),
(71, 7, 89, NULL, 5, 'COMPLETED', '2022-04-13 10:53:18', '83.60'),
(72, 14, 48, 2, 5, 'COMPLETED', '2022-04-10 08:52:10', '80.56'),
(73, 12, 10, 3, 1, 'COMPLETED', '2022-04-26 10:12:33', '83.67'),
(74, 3, 44, NULL, 5, 'COMPLETED', '2022-04-28 08:53:32', '67.17'),
(75, 16, 13, 2, 5, 'COMPLETED', '2022-04-29 09:20:12', '53.43'),
(76, 4, 50, NULL, 5, 'COMPLETED', '2022-04-27 10:38:50', '82.96'),
(77, 1, 87, 3, 10, 'COMPLETED', '2022-04-03 10:16:50', '57.84'),
(78, 4, 12, 3, 5, 'COMPLETED', '2022-04-27 09:01:59', '75.75'),
(79, 5, 4, 4, 9, 'COMPLETED', '2022-04-01 08:15:24', '91.50'),
(80, 18, 56, 5, 8, 'COMPLETED', '2022-04-14 09:07:33', '52.51'),
(81, 15, 9, 1, 4, 'COMPLETED', '2022-04-03 09:02:47', '85.58'),
(82, 5, 51, 2, 7, 'COMPLETED', '2022-04-11 09:39:21', '75.20'),
(83, 7, 69, 2, 1, 'COMPLETED', '2022-04-26 09:35:53', '97.05'),
(84, 18, 91, NULL, 1, 'COMPLETED', '2022-04-30 10:49:06', '63.70'),
(85, 2, 1, 1, 4, 'COMPLETED', '2022-04-21 08:54:14', '59.55'),
(86, 18, 41, 2, 7, 'COMPLETED', '2022-04-02 08:53:25', '79.07'),
(87, 18, 87, 2, 4, 'COMPLETED', '2022-04-27 10:10:33', '92.49'),
(88, 4, 77, NULL, 3, 'COMPLETED', '2022-04-08 09:43:13', '88.36'),
(89, 16, 64, 3, 2, 'COMPLETED', '2022-04-20 10:10:56', '84.23'),
(90, 4, 50, NULL, 4, 'COMPLETED', '2022-04-01 08:15:58', '77.92'),
(91, 19, 38, 5, 6, 'COMPLETED', '2022-04-08 10:29:14', '57.88'),
(92, 16, 21, 4, 2, 'COMPLETED', '2022-05-01 09:00:23', '60.81'),
(93, 16, 1, 2, 6, 'COMPLETED', '2022-04-11 09:34:46', '52.82'),
(94, 4, 73, 5, 2, 'COMPLETED', '2022-04-14 10:02:00', '81.62'),
(95, 6, 39, 2, 7, 'COMPLETED', '2022-04-30 09:44:45', '63.62'),
(96, 19, 28, 1, 7, 'COMPLETED', '2022-04-12 09:17:32', '84.22'),
(97, 16, 84, 1, 3, 'COMPLETED', '2022-04-06 10:27:11', '84.77'),
(98, 10, 1, NULL, 5, 'COMPLETED', '2022-04-20 09:06:52', '95.30'),
(99, 2, 73, 2, 6, 'COMPLETED', '2022-05-01 11:05:35', '51.50'),
(100, 5, 33, 4, 1, 'COMPLETED', '2022-04-22 08:37:42', '63.95');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`TRANSACTION ID`,`ITEM ID`),
  ADD KEY `ITEM ID` (`ITEM ID`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`COUPON ID`),
  ADD KEY `MANAGER ID` (`MANAGER ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CUSTOMER ID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ITEM ID`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`MANAGER ID`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`OWNER ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`STAFF ID`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`TABLES ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`TRANSACTION ID`),
  ADD KEY `STAFF ID` (`STAFF ID`),
  ADD KEY `CUSTOMER ID` (`CUSTOMER ID`),
  ADD KEY `TABLES ID` (`TABLES ID`),
  ADD KEY `COUPON ID` (`COUPON ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `COUPON ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CUSTOMER ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ITEM ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `MANAGER ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `OWNER ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `STAFF ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `TABLES ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `TRANSACTION ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_ibfk_1` FOREIGN KEY (`TRANSACTION ID`) REFERENCES `transaction` (`TRANSACTION ID`),
  ADD CONSTRAINT `cartitem_ibfk_2` FOREIGN KEY (`ITEM ID`) REFERENCES `item` (`ITEM ID`);

--
-- Constraints for table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`MANAGER ID`) REFERENCES `MANAGER` (`MANAGER ID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`STAFF ID`) REFERENCES `staff` (`STAFF ID`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`CUSTOMER ID`) REFERENCES `customer` (`CUSTOMER ID`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`TABLES ID`) REFERENCES `tables` (`TABLES ID`),
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`COUPON ID`) REFERENCES `coupon` (`COUPON ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
