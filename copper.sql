-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 12, 2024 at 03:12 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `copper`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `touristID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cartImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `touristID`, `productID`, `name`, `price`, `quantity`, `cartImage`) VALUES
(24, 2, 13, 'Batu Bersurat', '255.00', 5, 'batu bersurat.png'),
(25, 2, 19, 'tepak sireh bulat', '155.00', 1, 'tepak sireh bulat.png');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `touristID` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `feedback_type` varchar(50) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `touristID`, `name`, `email`, `feedback_type`, `feedback`, `created_at`) VALUES
(1, 2, 'nurin batrisyia', 'nrin9@gmail.com', 'General', 'Your system awesome !', '2024-05-07 15:07:23'),
(3, 4, 'nurhuda', 'huda@gmail.com', 'General', 'Thankyou for this system <3', '2024-05-07 17:36:07'),
(4, 5, 'ikmal fitri', 'ikmal@gmail.com', 'General', 'I hope this can make you smile :)', '2024-05-07 17:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `login_register`
--

CREATE TABLE `login_register` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_register`
--

INSERT INTO `login_register` (`id`, `username`, `email`, `password`, `user_type`) VALUES
(2, 'nrin', 'nrin9@gmail.com', 'f83817113cd791f20eac471675cbed15', 'user'),
(3, 'Admin', 'admin123@gmail.com', '9dc9d5ed5031367d42543763423c24ee', 'admin'),
(4, 'huda', 'huda@gmail.com', 'c571cba5570ebb37c4af4b820c18adc9', 'user'),
(5, 'ikmal', 'ikmal@gmail.com', 'a08480a1c35d71ed6a76d4cfc599f28e', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productImage` varchar(25) NOT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productImage`, `productPrice`, `stock`) VALUES
(11, 'Tepak Sireh', 'tepak sireh.png', '210.00', 0),
(13, 'Batu Bersurat', 'batu bersurat.png', '255.00', 0),
(14, 'Periuk Kecil', 'periuk kecil.png', '180.00', 0),
(17, 'Sarang Apam Balik', 'Sarang apam balik.png', '235.00', 7),
(18, 'Gobek', 'gobek.png', '120.00', 0),
(19, 'tepak sireh bulat', 'tepak sireh bulat.png', '155.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stockID` int(100) NOT NULL,
  `productID` int(100) NOT NULL,
  `stockIn` int(100) NOT NULL,
  `stockOut` int(100) NOT NULL,
  `totalstock` int(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockID`, `productID`, `stockIn`, `stockOut`, `totalstock`, `status`, `timestamp`) VALUES
(1, 11, 16, 16, 0, 'low', '2024-05-10 13:01:10'),
(2, 14, 5, 5, 0, 'instock', '2024-05-10 14:32:52'),
(3, 17, 7, 3, 4, 'In Stock', '2024-05-10 14:56:03'),
(4, 13, 5, 5, 0, 'Out of Stock', '2024-05-10 15:32:38'),
(5, 11, 8, 0, 8, 'instock', '2024-05-10 18:15:50'),
(6, 19, 11, 2, 9, 'instock', '2024-05-10 18:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `touristorder`
--

CREATE TABLE `touristorder` (
  `id` int(100) NOT NULL,
  `touristID` int(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phonenumber` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `total_product` varchar(255) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(20) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `touristorder`
--

INSERT INTO `touristorder` (`id`, `touristID`, `fullname`, `phonenumber`, `email`, `method`, `address`, `total_product`, `total_price`, `placed_on`, `payment_status`) VALUES
(6, 2, 'nurin bat', '01114324515', 'nrin9@gmail.com', 'cash on delivery', 'flat no. 11, Jalan Perdana, Cheras, Malaysia - 43300', ', tepak sireh (2) ', 400, '23-Apr-2024', 'completed'),
(7, 2, 'nurhudazubir', '1687234517', 'nurhuda@gmail.com', 'cash on delivery', 'flat no. 12, jalan kuchai lama, temerloh, Malaysia - 25001', ', tepak sireh (2) , Batu Bersurat (1) ', 655, '24-Apr-2024', 'completed'),
(9, 2, 'nurin batrisyia', '01114324515', 'nrin9@gmail.com', 'cash on delivery', '32, padang besar, kokdiang, Malaysia - 24225', ', Tepak Sireh (1) ', 210, '05-May-2024', 'pending'),
(10, 5, 'ikmal fitri', '01234556789', 'ikmal@gmail.com', 'credit card', '77, taman perdana, jelifornia, Malaysia ,32144', ', Sarang Apam Balik (1) ', 235, '07-May-2024', 'pending'),
(11, 1, 'rin', '111111111', 'nrin9@gmail.com', 'cash on delivery', '2, Jalan Perdana, Cheras, Malaysia ,43300', ', Sarang Apam Balik (3) ', 705, '10-May-2024', 'pending'),
(12, 4, 'nurhuda', '01114324515', 'huda@gmail.com', 'cash on delivery', '12, Equine, 43300, Kajang ,Malaysia', 'Batu Bersurat (1) tepak sireh bulat (1) ', 410, '10-May-2024', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_register`
--
ALTER TABLE `login_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockID`);

--
-- Indexes for table `touristorder`
--
ALTER TABLE `touristorder`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_register`
--
ALTER TABLE `login_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `touristorder`
--
ALTER TABLE `touristorder`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
