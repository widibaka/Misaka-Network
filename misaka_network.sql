-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2020 at 12:31 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `misaka_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `aidi` int(11) NOT NULL,
  `chatroom_no_namae` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meseiji`
--

CREATE TABLE `meseiji` (
  `aidi` int(6) NOT NULL,
  `riyousha_no_aidi` int(6) NOT NULL,
  `nichiji` datetime NOT NULL,
  `meseiji_no_nakami` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meseiji`
--

INSERT INTO `meseiji` (`aidi`, `riyousha_no_aidi`, `nichiji`, `meseiji_no_nakami`) VALUES
(68, 7, '2020-05-11 08:26:39', '[[2=67=Pesan Quoted]] Ini pesan real'),
(69, 1, '2020-05-12 23:48:14', ''),
(70, 1, '2020-05-11 17:50:37', 'kasd'),
(71, 1, '2020-05-13 00:05:10', ''),
(72, 5, '2020-05-11 17:51:04', 'k'),
(73, 5, '2020-05-11 17:51:05', 'nfwqifn'),
(74, 5, '2020-05-11 19:11:02', 'Yamashita, Shingo!\r\nDorohedoro\r\nAnimation in between generator!\r\nNonton Ookami to koushinryou\r\ndenpa onna to seishun\r\nlucky star\r\nanisatul_farida@udb.ac.id\r\nfajar5uryani@yahoo.com\r\nDownload android 7\r\nDownload MEMU\r\n'),
(75, 5, '2020-05-11 19:11:26', ''),
(76, 5, '2020-05-11 19:31:57', '&lt;script&gt;'),
(77, 5, '2020-05-11 19:50:53', 'Industri game mer <a target=\"_blank\" class=\"link\" href=\"https://www.w3schools.com/bootstrap4/default.asp\">https://www.w3schools.com/bootstrap4/default.asp</a>'),
(78, 5, '2020-05-11 19:50:57', '<a target=\"_blank\" class=\"link\" href=\"https://www.w3schools.com/bootstrap4/default.asp\">https://www.w3schools.com/bootstrap4/default.asp</a>'),
(79, 5, '2020-05-11 21:58:54', 'halo'),
(80, 5, '2020-05-11 21:59:02', '[[5=79=halo...]]saya'),
(81, 5, '2020-05-11 22:01:30', '[[5=75=Industri game merupakan salah satu industri yang mengalami\r\npertumbuhan...]]Ini pesan jawaban pak'),
(82, 5, '2020-05-11 22:01:52', '[[7=68= Ini pesan real...]]hai'),
(83, 5, '2020-05-11 22:06:35', '[[1=69=ak...]]loh?'),
(84, 5, '2020-05-11 22:06:41', 'sip'),
(85, 5, '2020-05-11 22:06:55', '[[1=69=ak...]]SIPP'),
(86, 7, '2020-05-12 23:48:04', ''),
(87, 7, '2020-05-12 23:47:54', ''),
(88, 7, '2020-05-11 22:08:36', '[[5=78=https://www.w3schools.com/bootstrap4/default.asp...]]saa'),
(89, 7, '2020-05-12 23:49:08', ''),
(90, 5, '2020-05-12 23:53:41', ''),
(91, 5, '2020-05-12 23:34:26', ''),
(92, 5, '2020-05-12 23:34:20', ''),
(93, 5, '2020-05-12 23:27:29', ''),
(95, 1, '2020-05-12 23:17:50', ''),
(96, 1, '2020-05-13 00:04:00', ''),
(97, 1, '2020-05-13 00:05:37', ''),
(98, 1, '2020-05-13 00:06:49', ''),
(99, 1, '2020-05-13 00:11:34', 'saya mau cerita'),
(100, 1, '2020-05-13 00:11:40', 'ceritanya panjang sekali'),
(101, 1, '2020-05-13 00:12:24', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(102, 1, '2020-05-13 00:12:31', ''),
(103, 1, '2020-05-13 00:14:02', '[[1=102=Pesan ini telah dihapus...]]asa'),
(104, 1, '2020-05-13 00:14:02', '[[1=102=Pesan ini telah dihapus...]]asa'),
(105, 1, '2020-05-13 00:12:31', ''),
(106, 1, '2020-05-13 00:12:24', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(107, 1, '2020-05-13 00:11:40', 'ceritanya panjang sekali'),
(108, 1, '2020-05-13 00:11:34', 'saya mau cerita'),
(109, 1, '2020-05-13 00:06:49', ''),
(110, 1, '2020-05-13 00:05:37', ''),
(111, 1, '2020-05-13 00:04:00', ''),
(112, 1, '2020-05-12 23:17:50', ''),
(113, 5, '2020-05-12 23:27:29', ''),
(114, 5, '2020-05-12 23:34:20', ''),
(115, 5, '2020-05-12 23:34:26', ''),
(116, 5, '2020-05-12 23:53:41', ''),
(117, 7, '2020-05-12 23:49:08', ''),
(118, 7, '2020-05-11 22:08:36', '[[5=78=https://www.w3schools.com/bootstrap4/default.asp...]]saa'),
(119, 7, '2020-05-12 23:47:54', ''),
(120, 7, '2020-05-12 23:48:04', ''),
(121, 5, '2020-05-11 22:06:55', '[[1=69=ak...]]SIPP'),
(122, 5, '2020-05-11 22:06:41', 'sip'),
(123, 5, '2020-05-11 22:06:35', '[[1=69=ak...]]loh?'),
(124, 5, '2020-05-11 22:01:52', '[[7=68= Ini pesan real...]]hai'),
(125, 5, '2020-05-11 22:01:30', '[[5=75=Industri game merupakan salah satu industri yang mengalami\r\npertumbuhan...]]Ini pesan jawaban pak'),
(126, 5, '2020-05-11 21:59:02', '[[5=79=halo...]]saya'),
(127, 5, '2020-05-11 21:58:54', 'halo'),
(128, 5, '2020-05-11 19:50:57', '<a target=\"_blank\" class=\"link\" href=\"https://www.w3schools.com/bootstrap4/default.asp\">https://www.w3schools.com/bootstrap4/default.asp</a>'),
(129, 5, '2020-05-13 00:19:53', '[[5=74=Yamashita, Shingo!\r\nDorohedoro\r\nAnimation in between generator!\r\nNonton O...]]dulu pernah'),
(130, 5, '2020-05-13 01:45:50', 'Enek barang apik ki <a target=\"_blank\" class=\"link\" href=\"https://animetosho.org/search?q=%5BHR%5D\">https://animetosho.org/search?q=%5BHR%5D</a>'),
(131, 5, '2020-05-13 11:39:38', '[[5=130=Enek barang apik ki https://animetosho.org/search?q=%5BHR%5D...]]biasa');

-- --------------------------------------------------------

--
-- Table structure for table `riyousha`
--

CREATE TABLE `riyousha` (
  `aidi` int(6) NOT NULL,
  `yuzaaneimu` varchar(120) NOT NULL,
  `pasuwaado` varchar(120) NOT NULL,
  `iro` varchar(16) NOT NULL,
  `roguin_no_saigo` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riyousha`
--

INSERT INTO `riyousha` (`aidi`, `yuzaaneimu`, `pasuwaado`, `iro`, `roguin_no_saigo`) VALUES
(1, 'widibaka', '123', '#d88587', 0),
(2, 'mamat', '1234', '#8b3dd1', 0),
(3, 'rin', '1', '#4bb5d5', 0),
(4, 'Shiro', '123', '#6eb963', 0),
(5, 'accelerator', '123', '#ba9bd5', 0),
(6, 'Touma', '123', '#858bcc', 0),
(7, 'Yogi', '444', '#a1c556', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`aidi`);

--
-- Indexes for table `meseiji`
--
ALTER TABLE `meseiji`
  ADD PRIMARY KEY (`aidi`);

--
-- Indexes for table `riyousha`
--
ALTER TABLE `riyousha`
  ADD PRIMARY KEY (`aidi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `aidi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meseiji`
--
ALTER TABLE `meseiji`
  MODIFY `aidi` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `riyousha`
--
ALTER TABLE `riyousha`
  MODIFY `aidi` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
