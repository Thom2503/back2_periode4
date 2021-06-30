-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2021 at 02:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `periode4`
--

-- --------------------------------------------------------

--
-- Table structure for table `inschrijver`
--

CREATE TABLE `inschrijver` (
  `Inschrijf_ID` char(36) NOT NULL,
  `count` int(11) NOT NULL,
  `Voornaam` varchar(128) NOT NULL,
  `Achternaam` varchar(128) NOT NULL,
  `Geboortedatum` date NOT NULL,
  `Telefoonnummer` varchar(32) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `UniekeCode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inschrijver`
--
ALTER TABLE `inschrijver`
  ADD PRIMARY KEY (`Inschrijf_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
