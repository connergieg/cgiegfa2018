-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2018 at 08:18 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sports`
--

-- --------------------------------------------------------

--
-- Table structure for table `sports_purchase`
--

CREATE TABLE `sports_purchase` (
  `playerId` int(3) NOT NULL,
  `playerName` varchar(55) NOT NULL,
  `quantity` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sports_purchase`
--

INSERT INTO `sports_purchase` (`playerId`, `playerName`, `quantity`) VALUES
(1, 'Tom Brady', 0),
(2, 'Antonio Brown', 0),
(3, 'Carson Wentz', 0),
(4, 'Julio Jones', 0),
(5, 'LeVeon Bell', 0),
(6, 'Todd Gurley', 0),
(7, 'Aaron Donald', 0),
(8, 'Drew Brees', 0),
(9, 'Von Miller', 0),
(10, 'Aaron Rodgers', 0),
(11, 'Mike Trout', 0),
(12, 'Jose Altuve', 0),
(13, 'Kris Bryant', 0),
(14, 'Max Scherzer', 0),
(15, 'Joey Votto', 0),
(16, 'Mookie Betts', 0),
(17, 'Clayton Kershaw', 0),
(18, 'Nolan Arenado', 0),
(19, 'Carlos Correa', 0),
(20, 'Paul Goldschimidt', 0),
(21, 'LeBron James', 0),
(22, 'Kevin Durant', 0),
(23, 'Kawhi Leonard', 0),
(24, 'Stephen Curry', 0),
(25, 'Russell Westbrook', 0),
(26, 'James Harden', 0),
(27, 'Giannis Antetokounmpo', 0),
(28, 'Anthony Davis', 0),
(29, 'Jimmy Butler', 0),
(30, 'Karl-Anthony Towns', 0),
(31, 'Dustin Johnson', 0),
(32, 'Jordan Spieth', 0),
(33, 'Justin Thomas', 0),
(34, 'Jon Rahm', 0),
(35, 'Hideki Matsuyama', 0),
(36, 'Justin Rose', 0),
(37, 'Rickie Fowler', 0),
(38, 'Brooks Koepka', 0),
(39, 'Henrik Stenson', 0),
(40, 'Sergio Garcia', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sports_purchase`
--
ALTER TABLE `sports_purchase`
  ADD PRIMARY KEY (`playerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sports_purchase`
--
ALTER TABLE `sports_purchase`
  MODIFY `playerId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
