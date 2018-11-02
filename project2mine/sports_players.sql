-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2018 at 01:59 PM
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
-- Table structure for table `sports_players`
--

CREATE TABLE `sports_players` (
  `playerId` int(3) NOT NULL,
  `playerName` varchar(255) NOT NULL,
  `playerImage` varchar(255) NOT NULL,
  `playerPos` varchar(255) NOT NULL,
  `playerTeam` varchar(255) NOT NULL,
  `price` int(3) NOT NULL,
  `catId` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sports_players`
--

INSERT INTO `sports_players` (`playerId`, `playerName`, `playerImage`, `playerPos`, `playerTeam`, `price`, `catId`) VALUES
(1, 'Tom Brady', 'http://static.nfl.com/static/content/public/static/img/fantasy/transparent/200x200/BRA371156.png', 'Quarter Back', 'Patriots', 100, 1),
(2, 'Antonio Brown', 'https://d395i9ljze9h3x.cloudfront.net/req/20180910/images/headshots/BrowAn04_2018.jpg', 'Wide Receiver', 'Steelers', 100, 1),
(3, 'Carson Wentz', 'https://d395i9ljze9h3x.cloudfront.net/req/20180910/images/headshots/WentCa00_2018.jpg', 'Quarter Back', 'Eagles', 100, 1),
(4, 'Julio Jones', 'https://d395i9ljze9h3x.cloudfront.net/req/20180910/images/headshots/JoneJu02_2018.jpg', 'Wide Receiver', 'Falcons', 100, 1),
(5, 'LeVeon Bell', 'https://d395i9ljze9h3x.cloudfront.net/req/20180910/images/headshots/BellLe00_2018.jpg', 'Running Back', 'Steelers', 100, 1),
(6, 'Todd Gurley', 'https://d395i9ljze9h3x.cloudfront.net/req/20180910/images/headshots/GurlTo01_2018.jpg', 'Running Back', 'Rams', 100, 1),
(7, 'Aaron Donald', 'https://d395i9ljze9h3x.cloudfront.net/req/20180910/images/headshots/DonaAa00_2018.jpg', 'Defensive Tackle', 'Rams', 100, 1),
(8, 'Drew Brees', 'https://d395i9ljze9h3x.cloudfront.net/req/20180910/images/headshots/BreeDr00_2018.jpg', 'Quarter Back', 'Saints', 100, 1),
(9, 'Von Miller', 'https://d395i9ljze9h3x.cloudfront.net/req/20180910/images/headshots/MillVo00_2018.jpg', 'Line Backer', 'Broncos', 100, 1),
(10, 'Aaron Rodgers', 'https://d395i9ljze9h3x.cloudfront.net/req/20180910/images/headshots/RodgAa00_2018.jpg', 'Quarter Back', 'Packers', 100, 1),
(11, 'Mike Trout', 'https://d3k2oh6evki4b7.cloudfront.net/req/201810091/images/headshots/f/f322d40f_mlbam.jpg', 'Center Fielder', 'Angels', 200, 2),
(12, 'Jose Altuve', 'https://d3k2oh6evki4b7.cloudfront.net/req/201810091/images/headshots/f/f0e8fd62_mlbam.jpg', 'Second Baseman', 'Astros', 200, 2),
(13, 'Kris Bryant', 'https://d3k2oh6evki4b7.cloudfront.net/req/201810091/images/headshots/1/1d358f93_mlbam.jpg', 'Third Baseman and Outfielder', 'Cubs', 200, 2),
(14, 'Max Scherzer', 'https://d3k2oh6evki4b7.cloudfront.net/req/201810091/images/headshots/6/65381047_mlbam.jpg', 'Pitcher', 'Nationals', 200, 2),
(15, 'Joey Votto', 'https://d3k2oh6evki4b7.cloudfront.net/req/201810091/images/headshots/9/9f4721ab_mlbam.jpg', 'First Baseman', 'Reds', 200, 2),
(16, 'Mookie Betts', 'https://d3k2oh6evki4b7.cloudfront.net/req/201810091/images/headshots/f/f3a0cc68_mlbam.jpg', 'Right Fielder', 'Red Sox', 200, 2),
(17, 'Clayton Kershaw', 'https://d3k2oh6evki4b7.cloudfront.net/req/201810091/images/headshots/0/0caa3053_mlbam.jpg', 'Pitcher', 'Dodgers', 200, 2),
(18, 'Nolan Arenado', 'https://d3k2oh6evki4b7.cloudfront.net/req/201810091/images/headshots/4/4009314f_mlbam.jpg', 'Third Baseman', 'Rockies', 200, 2),
(19, 'Carlos Correa', 'https://d3k2oh6evki4b7.cloudfront.net/req/201810091/images/headshots/3/33687c9b_mlbam.jpg', 'Short Stop', 'Astros', 200, 2),
(20, 'Paul Goldschimidt', 'https://d3k2oh6evki4b7.cloudfront.net/req/201810091/images/headshots/6/6b37a7f2_mlbam.jpg', 'First Baseman', 'Diamondbacks', 200, 2),
(26, 'LeBron James', 'https://d2cwpp38twqe55.cloudfront.net/req/201810111/images/players/jamesle01.jpg', 'Power Forward and Shooting Guard and Small Forward', 'Lakers', 300, 3),
(27, 'Kevin Durant', 'https://d2cwpp38twqe55.cloudfront.net/req/201810111/images/players/duranke01.jpg', 'Shooting Guard and Power Forward and Small Forward', 'Warriors', 300, 3),
(28, 'Kawhi Leonard', 'https://d2cwpp38twqe55.cloudfront.net/req/201810111/images/players/leonaka01.jpg', 'Small Forward', 'Raptors', 300, 3),
(29, 'Stephen Curry', 'https://d2cwpp38twqe55.cloudfront.net/req/201810111/images/players/curryst01.jpg', 'Point Guard', 'Warriors', 300, 3),
(30, 'Russell Westbrook', 'https://d2cwpp38twqe55.cloudfront.net/req/201810111/images/players/westbru01.jpg', 'Point Guard', 'Thunder', 300, 3),
(31, 'James Harden', 'https://d2cwpp38twqe55.cloudfront.net/req/201810111/images/players/hardeja01.jpg', 'Shooting Guard and Point Guard', 'Rockets', 300, 3),
(32, 'Giannis Antetokounmpo', 'https://d2cwpp38twqe55.cloudfront.net/req/201810111/images/players/antetgi01.jpg', 'Small Forward and Point Guard and Power Forward and Shooting Guard', 'Bucks', 300, 3),
(33, 'Anthony Davis', 'https://d2cwpp38twqe55.cloudfront.net/req/201810111/images/players/davisan02.jpg', 'Center and Power Forward', 'Pelicans', 300, 3),
(34, 'Jimmy Butler', 'https://d2cwpp38twqe55.cloudfront.net/req/201810111/images/players/butleji01.jpg', 'Shooting Guard and Small Forward', 'Timberwolves', 300, 3),
(35, 'Karl-Anthony Towns', 'https://d2cwpp38twqe55.cloudfront.net/req/201810111/images/players/townska01.jpg', 'Center', 'Timberwolves', 300, 3),
(41, 'Dustin Johnson', 'https://pga-tour-res.cloudinary.com/image/upload/c_fill,d_headshots_default.png,f_auto,g_face:center,h_350,q_auto,w_280/headshots_30925.png', '', '', 400, 4),
(42, 'Jordan Spieth', 'https://pga-tour-res.cloudinary.com/image/upload/c_fill,d_headshots_default.png,f_auto,g_face:center,h_350,q_auto,w_280/headshots_34046.png', '', '', 400, 4),
(43, 'Justin Thomas', 'https://pga-tour-res.cloudinary.com/image/upload/c_fill,d_headshots_default.png,f_auto,g_face:center,h_350,q_auto,w_280/headshots_33448.png', '', '', 400, 4),
(44, 'Jon Rahm', 'https://pga-tour-res.cloudinary.com/image/upload/c_fill,d_headshots_default.png,f_auto,g_face:center,h_350,q_auto,w_280/headshots_46970.png', '', '', 400, 4),
(45, 'Hideki Matsuyama', 'https://pga-tour-res.cloudinary.com/image/upload/c_fill,d_headshots_default.png,f_auto,g_face:center,h_350,q_auto,w_280/headshots_32839.png', '', '', 400, 4),
(46, 'Justin Rose', 'https://pga-tour-res.cloudinary.com/image/upload/c_fill,d_headshots_default.png,f_auto,g_face:center,h_350,q_auto,w_280/headshots_22405.png', '', '', 400, 4),
(47, 'Rickie Fowler', 'https://pga-tour-res.cloudinary.com/image/upload/c_fill,d_headshots_default.png,f_auto,g_face:center,h_350,q_auto,w_280/headshots_32102.png', '', '', 400, 4),
(48, 'Brooks Koepka', 'https://pga-tour-res.cloudinary.com/image/upload/c_fill,d_headshots_default.png,f_auto,g_face:center,h_350,q_auto,w_280/headshots_36689.png', '', '', 400, 4),
(49, 'Henrik Stenson', 'https://pga-tour-res.cloudinary.com/image/upload/c_fill,d_headshots_default.png,f_auto,g_face:center,h_350,q_auto,w_280/headshots_21528.png', '', '', 400, 4),
(50, 'Sergio Garcia', 'https://pga-tour-res.cloudinary.com/image/upload/c_fill,d_headshots_default.png,f_auto,g_face:center,h_350,q_auto,w_280/headshots_21209.png', '', '', 400, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sports_players`
--
ALTER TABLE `sports_players`
  ADD PRIMARY KEY (`playerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sports_players`
--
ALTER TABLE `sports_players`
  MODIFY `playerId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
