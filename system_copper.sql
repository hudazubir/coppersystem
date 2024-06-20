-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 08:24 AM
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
-- Database: `system_copper`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `touristID` int(11) DEFAULT NULL,
  `productID` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cartImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `touristID`, `productID`, `name`, `price`, `quantity`, `cartImage`) VALUES
(39, 2, 'AD003', 'Gobek', 100.00, 1, 'gobek.png');

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
(1, 2, 'Nurhuda', 'nurhuda@gmail.com', 'Feature', 'Make your system more user friendly <3 hiks', '2024-05-16 07:47:32');

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
(1, 'admin', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
(2, 'Nurhuda', 'nurhuda@gmail.com', '5310bd8ee74f4425856af002be0f3f60', 'user'),
(3, 'Nurin batrisyia', 'nurin@gmail.com', '368a954d81be0b89c30c5d1bbd31ade2', 'user'),
(4, 'neisha', 'neisha@gmail.com', '5465603303191d039c7358612fcfbbd0', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `touristID` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `receipt_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `touristID`, `transaction_id`, `amount`, `payment_method`, `payment_status`, `receipt_path`, `created_at`) VALUES
(1, 3, '3_6644506971267', 235.00, 'Online Banking', 'pending', '', '2024-05-15 06:04:25'),
(2, 3, 'YourTransactionIDHere', 235.00, 'Online Banking', 'pending', 'assets/Transaction_Receipt_13052024143103.pdf', '2024-05-15 06:08:59'),
(3, 3, 'YourTransactionIDHere', 235.00, 'Online Banking', 'pending', 'assets/Transaction_Receipt_13052024143103.pdf', '2024-05-15 06:09:51'),
(4, 3, 'YourTransactionIDHere', 235.00, 'Online Banking', 'pending', 'assets/Receipt Payments.pdf', '2024-05-15 06:13:32'),
(5, 3, 'YourTransactionIDHere', 235.00, 'Online Banking', 'pending', 'assets/Receipt Payments.pdf', '2024-05-15 06:14:03'),
(6, 3, 'YourTransactionIDHere', 235.00, 'Online Banking', 'pending', 'assets/Receipt Payments.pdf', '2024-05-15 06:16:12'),
(7, 3, 'YourTransactionIDHere', 235.00, 'Online Banking', 'pending', 'assets/Receipt Payments.pdf', '2024-05-15 06:17:25'),
(8, 3, 'YourTransactionIDHere', 235.00, 'Online Banking', 'pending', 'assets/Receipt Payments.pdf', '2024-05-15 06:21:49'),
(9, 3, 'YourTransactionIDHere', 235.00, 'Online Banking', 'pending', '', '2024-05-15 06:24:02'),
(10, 3, 'YourTransactionIDHere', 235.00, 'Online Banking', 'pending', 'assets/Receipt Payments.pdf', '2024-05-15 06:54:52'),
(11, 3, 'TXN_66445f09c31d5_3_1715756809', 215.00, 'Online Banking', 'pending', '', '2024-05-15 07:06:49'),
(12, 3, 'YourTransactionIDHere', 215.00, 'Online Banking', 'Accepted', 'assets/Receipt Payments.pdf', '2024-05-15 07:08:48'),
(13, 3, 'YourTransactionIDHere', 215.00, 'Online Banking', 'Accepted', 'assets/Receipt Payments.pdf', '2024-05-15 07:10:34'),
(14, 3, 'YourTransactionIDHere', 215.00, 'Online Banking', 'pending', 'assets/Receipt Payments.pdf', '2024-05-15 07:14:52'),
(15, 2, 'YourTransactionIDHere', 235.00, 'Online Banking', 'pending', 'assets/Receipt Payments.pdf', '2024-05-16 02:51:07'),
(16, 2, 'YourTransactionIDHere', 215.00, 'Online Banking', 'pending', 'assets/Receipt Payments.pdf', '2024-05-17 06:25:39');

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
('AD001', 'Periuk Kecil', 'periuk kecil.png', 333.00, 0),
('AD003', 'Gobek', 'gobek.png', 100.00, 0),
('AD004', 'Sarang Apam Balik', 'Sarang apam balik.png', 300.00, 0),
('AD005', 'Sudu Garfu Tembaga', 'sudu garfu.png', 75.00, 0),
('AH001', 'Batu Bersurat', 'batu bersurat.png', 315.00, 0),
('AP101', 'Renjis Air Mawar', 'renjis air mawar.png', 235.00, 1),
('AP102', 'Tepak Sireh', 'tepak sireh.png', 215.00, 0),
('AP103', 'Bekas Cincin Tembaga', 'IMG_4870.png', 150.00, 0);

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
(1, 'AP101', 19, 12, 7, 'In Stock', '2024-05-15 04:30:08'),
(2, 'AP102', 14, 9, 5, 'In Stock', '2024-05-15 04:33:01'),
(3, 'AD001', 13, 9, 4, 'In Stock', '2024-05-17 09:15:02'),
(4, 'AD002', 10, 6, 4, 'In Stock', '2024-05-23 08:53:58'),
(5, 'AD003', 5, 1, 4, 'instock', '2024-06-04 03:27:40'),
(6, 'AD004', 5, 2, 3, 'instock', '2024-06-04 03:27:46'),
(7, 'AD005', 5, 0, 5, 'instock', '2024-06-04 03:28:07'),
(8, 'AH001', 5, 1, 4, 'instock', '2024-06-04 03:28:14'),
(9, 'AP103', 5, 0, 5, 'instock', '2024-06-04 03:28:23');

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
(4, 2, 'Nurhuda', '01114324515', 'nurhuda@gmail.com', 'Online Banking', '17, Equine, 43300, Serdang ,Malaysia', 'Renjis Air Mawar (1) ', 235.00, '17-May-2024', 'Completed', NULL),
(5, 3, 'Nurin batrisyia', '01156990087', 'nurin@gmail.com', 'Online Banking', '1, Taman Permatang Jaya, 32000, Setiawan ,Malaysia', 'Renjis Air Mawar (1) ', 235.00, '17-May-2024', 'Completed', NULL),
(6, 2, 'Nurhuda', '01114324515', 'nurhuda@gmail.com', 'Online Banking', '17, Equine, 43300, Serdang ,Malaysia', 'Periuk Kecil (1) ', 333.00, '17-May-2024', 'Completed', NULL),
(8, 3, 'Nurin batrisyia', '01156990087', 'nurin@gmail.com', 'Online Banking', '1, Taman Permatang Jaya, 32000, Setiawan ,Malaysia', 'Periuk Kecil (1) ', 333.00, '17-May-2024', 'Completed', NULL),
(11, 2, 'NURHUDA BINTI ZUBIR', '01114324515', 'hudazubir21@gmail.com', 'Online Banking', '6, sdad, 43300, adada, Malaysia', 'Dulang (1) ', 287.00, '23-May-2024', 'Completed', 'assets/1716454541_Receipt Payments.pdf'),
(12, 3, 'Nurin', '12414151', 'nurin@gmail.com', 'Online Banking', '1, efafaf, 43300, yga, gagad', 'Dulang (1) ', 287.00, '23-May-2024', 'Pending', 'assets/1716454829_Receipt Payments.pdf'),
(13, 3, 'NURHUDA BINTI ZUBIR', '01114324515', 'nur@gmail.com', 'Online Banking', '21, TAMAN EQUINE, 43300, SERI KEMBANGAN, Malaysia', 'Dulang (1) ', 287.00, '23-May-2024', 'Successful', 'receipts/1716455283_1716454829_Receipt Payments.pdf'),
(14, 3, 'farisha', '31313114', 'farisha@gmail.com', 'Online Banking', '1, cherafka, 43300, sajkja, ajfavaj', 'Renjis Air Mawar (1) ', 235.00, '23-May-2024', 'Successful', 'receipts/1716455742_Receipt Payments.pdf'),
(15, 3, 'NURHUDA BINTI ZUBIR', '01114324515', 'hudazubir21@gmail.com', 'Cash on Delivery', '2, TAMAN EQUINE, 43300, SERI KEMBANGAN, Malaysia', 'Renjis Air Mawar (1) ', 235.00, '23-May-2024', 'Pending', ''),
(16, 3, 'Casca', '41414', 'aga2@gmail.com', 'Cash on Delivery', '1, afa, 43300, vava, aga', 'Renjis Air Mawar (1) ', 235.00, '23-May-2024', 'Pending', ''),
(17, 3, 'erqr', '01114324515', 'fafaf@gmail.com', 'Online Banking', '3131, TAMAN EQUINE, 43300, SERI KEMBANGAN, Malaysia', 'Dulang (1) ', 287.00, '23-May-2024', 'Pending', 'assets/1716456244_Receipt Payments.pdf'),
(18, 3, 'qqqq', '01114324515', 'qqq@gmail.com', 'Online Banking', '1, qqq, 43300, q, q', 'Dulang (1) ', 287.00, '23-May-2024', 'Pending', ''),
(19, 3, 'hdhdhfh', '01114324515', 'nrin9@gmail.com', 'Online Banking', '1, Jalan Perdana, 43300, Cheras, Malaysia', 'Renjis Air Mawar (1) ', 235.00, '23-May-2024', 'Pending', 'assets/1716457154_Receipt Payments.pdf'),
(20, 3, 'nurhuda', '01114324515', 'qweq@gmail.com', 'Cash on Delivery', '31, Equine, 43300, Serdang, Malaysia', 'Renjis Air Mawar (1) ', 235.00, '23-May-2024', 'Pending', ''),
(21, 3, 'mal', '211313123', 'mal@gmail.com', 'Online Banking', '31, Equine, 43300, Serdang, Malaysia', 'Dulang (1) ', 287.00, '23-May-2024', 'Pending', 'assets/1716457460_Receipt Payments.pdf'),
(22, 2, 'huderss', '01745277811', 'nurhuda@gmail.com', 'Online Banking', '9, cheras, 43300, kajang, Malaysia', 'Batu Bersurat (1) ', 315.00, '04-Jun-2024', 'Pending', 'assets/1717472058_Receipt Payments.pdf'),
(23, 2, 'kanda', '01114324515', 'kanda@gmail.com', 'Online Banking', '1, TAMAN EQUINE, 43300, SERI KEMBANGAN, Malaysia', 'Sarang Apam Balik (1) ', 300.00, '04-Jun-2024', 'Pending', 'assets/1717521699_Receipt Payments.pdf'),
(24, 4, 'neisha', '01132414114', 'neisha@gmail.com', 'Online Banking', '12, bangi, 43300, cheras, Malaysia', 'Periuk Kecil (1) ', 333.00, '11-Jun-2024', 'Successful', 'assets/1718083258_Receipt Payments.pdf'),
(25, 4, 'Neishaaaa', '01114324515', 'neishaaaaaaa@gmail.com', 'Online Banking', '12, TAMAN EQUINE, 43300, SERI KEMBANGAN, Malaysia', 'Sarang Apam Balik (1) ', 300.00, '12-Jun-2024', 'Successful', 'assets/1718174216_Receipt Payments.pdf');

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
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
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_register`
--
ALTER TABLE `login_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `touristorder`
--
ALTER TABLE `touristorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
