-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2018 at 02:17 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodcreation`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemID` int(11) NOT NULL,
  `itemName` varchar(30) NOT NULL,
  `itemStore` int(12) NOT NULL,
  `itemPrice` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receipt-items`
--

CREATE TABLE `receipt-items` (
  `purchaseID` int(11) NOT NULL,
  `purchaseQuantity` int(11) NOT NULL DEFAULT '1',
  `itemID` int(11) NOT NULL,
  `receiptID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `receiptID` int(11) NOT NULL,
  `totalCost` decimal(10,2) NOT NULL,
  `amountPaid` decimal(10,2) NOT NULL,
  `amountReturned` decimal(10,2) NOT NULL,
  `issueDate` date NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reserveID` int(11) NOT NULL,
  `reserveVenue` varchar(30) NOT NULL,
  `reserveDate` date NOT NULL,
  `reserveTime` time NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reserveID`, `reserveVenue`, `reserveDate`, `reserveTime`, `userID`) VALUES
(1, 'mcd plaza', '2018-11-30', '02:23:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(16) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(300) NOT NULL,
  `birthDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `fullName`, `email`, `address`, `birthDate`) VALUES
(1, 'Shoukaku', 'crane', '', 'mary.tateyama@gmail.com', '7045 Taman Gemencheh Baru 73200 Gemencheh Gemencheh Negeri Sembilan 73200 Malaysia', '2018-12-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `receipt-items`
--
ALTER TABLE `receipt-items`
  ADD PRIMARY KEY (`purchaseID`),
  ADD KEY `items-receipt` (`receiptID`),
  ADD KEY `items-number` (`itemID`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`receiptID`),
  ADD KEY `user-receipts` (`userID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reserveID`),
  ADD KEY `user-reservations` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt-items`
--
ALTER TABLE `receipt-items`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `receiptID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reserveID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `receipt-items`
--
ALTER TABLE `receipt-items`
  ADD CONSTRAINT `items-number` FOREIGN KEY (`itemID`) REFERENCES `items` (`itemID`),
  ADD CONSTRAINT `items-receipt` FOREIGN KEY (`receiptID`) REFERENCES `receipts` (`receiptID`);

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `user-receipts` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `user-reservations` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
