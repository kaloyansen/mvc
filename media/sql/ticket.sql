-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 11, 2022 at 08:38 PM
-- Server version: 10.7.3-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `morla`
--

USE `morla`;
-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `position` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ticket description',
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ticket keywords'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `title`, `body`, `position`, `status`, `color`, `description`, `keywords`) VALUES
(18, 'newtitle', 'newbody', 'unknown', 'ok', 'orange', 'ticket description', 'ticket keywords'),
(19, 'title2', 'created by an api rest', 'unknown', 'ok', 'blue', 'ticket description', 'ticket keywords'),
(20, 'title1', 'created by an api rest', 'unknown', 'ok', 'red', 'ticket description', 'ticket keywords'),
(21, 'title2', 'created by an api rest', 'unknown', 'happy', 'blue', 'ticket description', 'ticket keywords'),
(22, 'title3', 'created by an api rest', 'unknown', 'sad', 'green', 'ticket description', 'ticket keywords'),
(23, 'title4', 'created by an api rest', 'unknown', 'ok', 'white', 'ticket description', 'ticket keywords'),
(24, 'title5', 'created by an api rest', 'unknown', 'ok', 'red', 'ticket description', 'ticket keywords'),
(25, 'title6', 'created by an api rest', 'unknown', 'dead', 'black', 'ticket description', 'ticket keywords'),
(26, 'title7', 'created by an api rest', 'unknown', 'ok', 'red', 'ticket description', 'ticket keywords'),
(27, 'title8', 'created by an api rest', 'unknown', 'sick', 'blue', 'ticket description', 'ticket keywords'),
(50, 'dfabce', 'ebdcfa', 'ebacfd', 'afdecb', 'abcdef', 'ticket description', 'ticket keywords'),
(54, 'bfdedf', 'cabdcc', 'aaffba', 'bcfeff', 'ffdaec', 'ticket description', 'ticket keywords'),
(62, 'bcdbba', 'fdcdfa', 'cbdbab', 'dbafdc', 'febbbc', 'ticket description', 'ticket keywords'),
(63, 'abeffc', 'eabbbe', 'abaaab', 'bdeded', 'fccbdf', 'ticket description', 'ticket keywords'),
(72, 'ecffcb', 'adaced', 'bdadba', 'ccaaaa', 'fcedcc', 'ticket description', 'ticket keywords'),
(79, 'ebdabd', 'bebfcf', 'eaebdf', 'baabef', 'dedaca', 'bfcebf', 'dcbbaf'),
(80, 'ecaeea', 'cbedfa', 'cfffeb', 'baeffc', 'ddcfdb', 'bdfdbc', 'fdfcfa'),
(81, 'adbaca', 'eebffd', 'ecaadd', 'accfba', 'ebfabb', 'aeabdd', 'eaacbb'),
(82, 'bdfcba', 'afcfcc', 'edfdbb', 'ebfdcd', 'bcdafd', 'cdabbc', 'abdcda'),
(83, 'cbbcfc', 'daebde', 'fdbcef', 'aecfcc', 'befdab', 'dafebd', 'ddecbd'),
(84, 'dffbff', 'bcabfb', 'baceec', 'fadfdb', 'baacfe', 'cdfaef', 'aaaafb'),
(85, 'ffabca', 'cfdfac', 'ccdaad', 'cbfadc', 'abbadd', 'fbdaea', 'fbcbfd'),
(86, 'proba', '', '', '', 'dfcbaf', '', ''),
(87, 'fcdaaf', 'bcacba', 'abccca', 'fccfdf', 'cabdca', 'edcdfd', 'bfedae'),
(88, 'fcfedc', 'fcfeaa', 'bcdfde', 'effaec', 'acabbf', 'ebcafd', 'cffddb'),
(89, 'cfcfba', 'abdedf', 'ffcaea', 'bdacba', 'dbbbac', 'dffbfe', 'caaecc'),
(90, 'dcddfc', 'dbcdfa', 'cfdffc', 'ffefaa', 'becafe', 'ecacdb', 'adabec'),
(91, '', '', '', '', 'bdcbad', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
