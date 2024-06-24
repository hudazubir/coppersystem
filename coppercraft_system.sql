-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 07:14 AM
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
-- Database: `coppercraft_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `touristID` int(11) DEFAULT NULL,
  `productID` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(111) DEFAULT NULL,
  `cartImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `touristID`, `name`, `email`, `feedback_type`, `feedback`, `created_at`) VALUES
(1, 3, 'Neisyamimie', 'neisha@gmail.com', 'General', 'The design is visually appealing, with a clean layout and well-chosen color scheme <3 I like it !', '2024-06-22 07:30:42');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_register`
--

INSERT INTO `login_register` (`id`, `username`, `email`, `password`, `user_type`) VALUES
(1, 'Admin', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
(2, 'Nurhuda', 'nurhuda@gmail.com', 'da9a3799cc9f6816f999f2ff19ad3f29', 'user'),
(3, 'Neisyamimie', 'neisha@gmail.com', '5465603303191d039c7358612fcfbbd0', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` varchar(100) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productImage`, `productPrice`, `stock`) VALUES
('AD001', 'Periuk Kecil', 'periuk kecil.png', 285.00, 0),
('AD002', 'Gobek', 'gobek.png', 125.00, 0),
('AD003', 'Sarang Apam Balik', 'Sarang apam balik.png', 300.00, 0),
('AD004', 'Sudu Garfu Tembaga', 'sudu garfu.png', 75.00, 0),
('AH001', 'Batu Bersurat', 'batu bersurat.png', 315.00, 0),
('AP101', 'Renjis Air Mawar', 'renjis air mawar.png', 235.00, 0),
('AP102', 'Tepak Sireh', 'tepak sireh.png', 215.00, 0),
('AP103', 'Bekas Cincin Tembaga', 'Bekas Cincin.png', 185.00, 0),
('AP104', 'Tepak Sireh Bulat', 'tepak sireh bulat.png', 295.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stockID` int(11) NOT NULL,
  `productID` varchar(100) NOT NULL,
  `stockIn` int(11) NOT NULL,
  `stockOut` int(11) NOT NULL,
  `totalstock` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockID`, `productID`, `stockIn`, `stockOut`, `totalstock`, `status`, `timestamp`) VALUES
(1, 'AD001', 8, 1, 7, 'instock', '2024-06-22 05:37:54'),
(2, 'AD002', 8, 0, 8, 'instock', '2024-06-22 05:38:43'),
(3, 'AD003', 5, 0, 5, 'instock', '2024-06-22 05:39:03'),
(4, 'AD004', 9, 0, 9, 'instock', '2024-06-22 05:55:09'),
(5, 'AH001', 7, 0, 7, 'instock', '2024-06-22 07:12:42'),
(6, 'AP101', 6, 0, 6, 'instock', '2024-06-22 07:13:04'),
(7, 'AP102', 8, 0, 8, 'instock', '2024-06-22 07:14:01'),
(8, 'AP103', 5, 1, 4, 'instock', '2024-06-22 07:17:43'),
(9, 'AP104', 7, 0, 7, 'instock', '2024-06-22 07:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `touristorder`
--

CREATE TABLE `touristorder` (
  `id` int(11) NOT NULL,
  `touristID` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phonenumber` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `total_product` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `placed_on` varchar(25) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `receipt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `touristorder`
--

INSERT INTO `touristorder` (`id`, `touristID`, `fullname`, `phonenumber`, `email`, `method`, `address`, `total_product`, `total_price`, `placed_on`, `payment_status`, `receipt`) VALUES
(1, 2, 'Nurhudazubir', '01114324515', 'nurhuda@gmail.com', 'Cash on Delivery', '17, Taman Equine, 43300, Seri Kembangan, Malaysia', 'Periuk Kecil (1) ', 285.00, '22-Jun-2024', 'Pending', ''),
(2, 3, 'Neisyamimie', '01114324515', 'neisha@gmail.com', 'Online Banking', '19, Jalan Razak, 46500, Bangi, Malaysia', 'Bekas Cincin Tembaga (1) ', 185.00, '22-Jun-2024', 'Pending', 'assets/1719041182_Receipt Payments.pdf');

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
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_register`
--
ALTER TABLE `login_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `touristorder`
--
ALTER TABLE `touristorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
