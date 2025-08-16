-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2025 at 02:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studuents`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(11) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Acc_Number` int(25) NOT NULL,
  `IFSC` varchar(20) NOT NULL,
  `Balance` int(11) NOT NULL,
  `Phone` int(100) NOT NULL,
  `Address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`UserID`, `Name`, `Email`, `Acc_Number`, `IFSC`, `Balance`, `Phone`, `Address`) VALUES
(346569, 'hemanth', 'hemanth@gmail.com', 6100, 'AS189754V', 89338, 889045634, '89/chennai'),
(841652, 'jayam', 'jayam4@outlook.com', 6500, 'SD9856785X', 907324, 786545789, '56/thiruvanamalai'),
(346578, 'rohith', 'rohith@gmail.com', 6598, 'AS189231', 104755, 987689657, '123/kallakurichi'),
(9045864, 'jothi', 'jothi0@gmail.com', 7100, 'AC3475370D', 81247, 768965432, '45/marimalainagar'),
(4567, 'roshan', 'roshan@gmail.com', 9865, 'AD1892317', 65131, 638320283, '123/kallakurichi'),
(446516, 'pranav', 'pranav@gmail.com', 10700, 'WWQ9551562', 7264, 623467094, '20/chennai'),
(876815, 'prasana', 'prasana@gmial.com', 10800, 'AS576457S', 37126, 994276899, '321/mathuranthagam'),
(14119, 'ranjith', 'ranjith@gmail.com', 11900, 'ASQ9981562', 1024357, 638338986, '139/kallakurichi'),
(847543, 'gopi', 'gopi@outlook.com', 30500, 'SD985675Y', 84267, 658909467, '11/manimangalam'),
(9045236, 'guru', 'guru@gmail.com', 30600, 'AC3465890D', 90401, 987654342, '306/kalpakkam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Acc_Number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
