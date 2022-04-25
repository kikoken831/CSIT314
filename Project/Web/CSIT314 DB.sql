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

INSERT INTO `customer` (`CUSTOMER ID`, `EMAIL`, `PASSWORD`, `CUSTOMER NAME`, `FAVOURITE LIST`) VALUES
(1, 'hello@gmail.com', '+gOQ1hlzSkGFoVglB24ZHYGzMbTDmjWshisED6Csly79YDzXiXoltpG1DuMFweXw2LuJDXkPEycGTlo=', 'hello', ''),
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
