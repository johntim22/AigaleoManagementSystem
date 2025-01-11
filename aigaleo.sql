-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 06:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE aigaleo;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aigaleo`
--

-- --------------------------------------------------------

--
-- Table structure for table `blockchain`
--

CREATE TABLE `blockchain` (
  `blockid` int(11) NOT NULL,
  `timedate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `blockinfo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blockchain`
--

INSERT INTO `blockchain` (`blockid`, `timedate`, `blockinfo`) VALUES
(1, '2025-01-11 17:34:52', 'GenesisBlock'),
(2, '2025-01-11 17:35:19', 'Airdrop of 20 to giannistim'),
(3, '2025-01-11 17:35:22', 'ADMIN: Removing balance of GiannisTim'),
(4, '2025-01-11 17:35:24', 'Airdrop of 10 to giannistim. New Balance: 10'),
(5, '2025-01-11 17:35:26', 'Transaction of -10 to giannistim. New Balance: 0'),
(6, '2025-01-11 17:35:34', 'Airdrop of 5 to giannistim. New Balance: 5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `userpassword` varchar(256) NOT NULL,
  `userbalance` int(11) DEFAULT NULL,
  `fullname` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `userpassword`, `userbalance`, `fullname`) VALUES
(1, 'giannistim', 'demopass1', 5, 'Ioannis-Marios Timotheatos');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blockchain`
--
ALTER TABLE `blockchain`
  ADD PRIMARY KEY (`blockid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blockchain`
--
ALTER TABLE `blockchain`
  MODIFY `blockid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
