-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 09:10 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csms`
--

-- --------------------------------------------------------

--
-- Table structure for table `csms_category`
--

CREATE TABLE `csms_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `childId` int(11) DEFAULT NULL,
  `cname` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csms_category`
--

INSERT INTO `csms_category` (`id`, `parentId`, `childId`, `cname`) VALUES
(1, NULL, NULL, 'Network Accessories'),
(6, NULL, NULL, 'RAM'),
(11, NULL, NULL, 'Cable'),
(12, NULL, NULL, 'power system'),
(13, NULL, NULL, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `csms_orders`
--

CREATE TABLE `csms_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `ocid` int(10) UNSIGNED NOT NULL,
  `opid` int(11) UNSIGNED NOT NULL,
  `oquantity` int(11) NOT NULL,
  `odate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csms_orders`
--

INSERT INTO `csms_orders` (`id`, `ocid`, `opid`, `oquantity`, `odate`) VALUES
(72, 22, 33, 1, '2022-12-24 19:43:31'),
(73, 22, 33, 1, '2022-12-24 20:19:41'),
(74, 24, 33, 1, '2022-12-24 20:20:10'),
(75, 25, 32, 2, '2022-12-25 08:06:57'),
(76, 26, 30, 2, '2022-12-25 08:07:15'),
(77, 26, 24, 7, '2022-12-25 08:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `csms_product`
--

CREATE TABLE `csms_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `pname` varchar(50) NOT NULL,
  `pdescription` varchar(300) NOT NULL,
  `psprice` int(11) NOT NULL,
  `pcprice` int(11) NOT NULL,
  `pvat` int(11) NOT NULL,
  `pimg` varchar(300) NOT NULL,
  `pcid` int(10) UNSIGNED NOT NULL,
  `pvid` int(11) UNSIGNED NOT NULL,
  `pqstock` int(11) NOT NULL,
  `pstatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csms_product`
--

INSERT INTO `csms_product` (`id`, `pname`, `pdescription`, `psprice`, `pcprice`, `pvat`, `pimg`, `pcid`, `pvid`, `pqstock`, `pstatus`) VALUES
(21, 'TP-Link WD300', 'one kind of networks accessories', 1200, 900, 2, 'kk.jpg ', 1, 27, 1192, 1),
(23, 'GOT W3 router', 'networking tools', 1000, 880, 2, 'kk.jpg', 6, 28, 7786, 1),
(24, 'Switch ', 'networking tools', 5000, 4500, 2, 'R.png', 1, 30, 9000, 1),
(25, 'Dell', 'A renowned laptop', 70000, 73000, 5, 'l.jpg ', 13, 29, 8999, 1),
(27, 'Hp laptop', 'A renowned laptop', 80000, 75000, 5, 'h.jpg ', 13, 30, 90197, 1),
(28, 'cooler', 'Cooler', 7000, 8000, 4, 'th.jpg', 12, 31, 60091, 1),
(29, 'DD R3 RAM 8GB', 'RAM', 15000, 14000, 3, 'oo.jpg', 6, 29, 99999, 1),
(30, 'DDR3 4GB', 'RAM', 12000, 13000, 3, 'op.jpg', 6, 30, 9993, 1),
(31, 'Fibre Cable', 'Cable', 9000, 8000, 3, 'fi.jpg', 11, 31, 81214, 1),
(32, 'Kramer USB ', 'cable', 8000, 7000, 2, 'pm.jpg', 11, 27, 80595, 1),
(33, 'CAT 5', 'Cable', 6000, 5500, 2, 'catjpg.jpg', 11, 28, 107244, 1),
(34, '2m USB', 'Cable', 1200, 1300, 2, 'use.jpg', 11, 29, 7242, 1),
(35, 'Desktop UPS', 'Power', 20000, 18000, 2, 'lop.jpg', 12, 29, 89997, 1);

-- --------------------------------------------------------

--
-- Table structure for table `csms_purchases`
--

CREATE TABLE `csms_purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `pvid` int(11) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL,
  `pstock` int(11) NOT NULL,
  `vprice` int(11) NOT NULL,
  `pdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csms_purchases`
--

INSERT INTO `csms_purchases` (`id`, `pvid`, `pid`, `pstock`, `vprice`, `pdate`) VALUES
(39, 30, 32, 600, 60000, '2022-12-30'),
(40, 28, 33, 1209, 8000, '2022-12-17'),
(41, 27, 27, 120, 1200000, '2022-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `csms_services`
--

CREATE TABLE `csms_services` (
  `id` int(11) NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL,
  `pquantity` int(11) NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL,
  `oid` int(10) UNSIGNED NOT NULL,
  `return_date` timestamp NULL DEFAULT NULL,
  `repair_date` date DEFAULT NULL,
  `repair_price` varchar(255) DEFAULT NULL,
  `repaired` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csms_services`
--

INSERT INTO `csms_services` (`id`, `pid`, `pquantity`, `cid`, `oid`, `return_date`, `repair_date`, `repair_price`, `repaired`) VALUES
(36, 33, 1, 22, 70, '2024-12-21 20:48:20', NULL, NULL, 0),
(37, 33, 1, 22, 71, '2024-12-21 20:56:13', NULL, NULL, 0),
(38, 33, 2, 22, 0, NULL, '2024-12-22', '2444', 1),
(39, 33, 1, 22, 72, '2024-12-21 23:58:40', NULL, NULL, 0),
(40, 33, 1, 22, 72, '2024-12-22 02:43:31', NULL, NULL, 0),
(41, 23, 3, 22, 0, NULL, '2024-12-22', '3702', 1),
(42, 33, 2, 22, 73, '2024-12-22 03:19:41', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `csms_superadmin`
--

CREATE TABLE `csms_superadmin` (
  `id` int(111) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `passwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csms_superadmin`
--

INSERT INTO `csms_superadmin` (`id`, `username`, `passwd`) VALUES
(4, 'nitu', '202cb962ac59075b964b07152d234b70'),
(7, 'noksa', '827ccb0eea8a706c4c34a16891f84e7b'),
(9, 'rintu', '827ccb0eea8a706c4c34a16891f84e7b'),
(10, 'kaspia', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `csms_users`
--

CREATE TABLE `csms_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `cname` varchar(300) NOT NULL,
  `cemail` varchar(300) NOT NULL,
  `cnumber` varchar(100) NOT NULL,
  `caddr1` varchar(300) NOT NULL,
  `caddr2` varchar(300) DEFAULT NULL,
  `ccity` varchar(200) NOT NULL,
  `cstate` varchar(200) NOT NULL,
  `ccountry` varchar(200) NOT NULL,
  `czcode` varchar(100) NOT NULL,
  `ustatus` int(11) DEFAULT NULL CHECK (0 | 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csms_users`
--

INSERT INTO `csms_users` (`id`, `cname`, `cemail`, `cnumber`, `caddr1`, `caddr2`, `ccity`, `cstate`, `ccountry`, `czcode`, `ustatus`) VALUES
(22, 'nitu', 'anupa@gmail.com', '0000240', 'Noakhali', '888', 'uu', 'uuu', 'uuu', 'uuuu', 1),
(23, 'nowkshi', 'nowkshi@gmail.com', '0000240', 'Noakhali', 'yyy', 'yyy', 'yyyy', 'yyy', '878', 1),
(24, 'rintu', 'rintu@gmail.com', '0177223289', 'palton', 'uu', 'uuu', 'feni', 'Andorra', '8787', 1),
(25, 'Siam', 'siam@gmail.com', '0177223233', 'palton', 'noka', 'feni', 'uuu', 'Andorra', '878', 1),
(26, 'tabassomm', 'tb@gmail.com', '777', '77gg', 'ygg', 'ggg', 'ggg', 'gggg', '5555h', 1);

-- --------------------------------------------------------

--
-- Table structure for table `csms_vendor`
--

CREATE TABLE `csms_vendor` (
  `id` int(11) UNSIGNED NOT NULL,
  `vname` varchar(300) NOT NULL,
  `vaddress` varchar(300) NOT NULL,
  `vmobile` varchar(300) NOT NULL,
  `vemail` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csms_vendor`
--

INSERT INTO `csms_vendor` (`id`, `vname`, `vaddress`, `vmobile`, `vemail`) VALUES
(27, 'Microsoft', 'brhammonbaria', '01712233456', 'microsoft@gmail.com'),
(28, 'Shah', 'Dhaka', '01822234874', 'shah@gmail.com'),
(29, 'Bashundhora', 'Noakhali', '0192754590', 'boshundhora@gmail.com'),
(30, 'Hp', 'Maijdee', '0183434399', 'hp@gmail.com'),
(31, 'Dell', 'Kushtia', '0193434343', 'dell@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `csms_category`
--
ALTER TABLE `csms_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csms_orders`
--
ALTER TABLE `csms_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opid` (`opid`),
  ADD KEY `ocid` (`ocid`);

--
-- Indexes for table `csms_product`
--
ALTER TABLE `csms_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pvid` (`pvid`),
  ADD KEY `pcid` (`pcid`);

--
-- Indexes for table `csms_purchases`
--
ALTER TABLE `csms_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `pvid` (`pvid`);

--
-- Indexes for table `csms_services`
--
ALTER TABLE `csms_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `csms_superadmin`
--
ALTER TABLE `csms_superadmin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `csms_users`
--
ALTER TABLE `csms_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cemail` (`cemail`);

--
-- Indexes for table `csms_vendor`
--
ALTER TABLE `csms_vendor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vmobile` (`vmobile`),
  ADD UNIQUE KEY `vemail` (`vemail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `csms_category`
--
ALTER TABLE `csms_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `csms_orders`
--
ALTER TABLE `csms_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `csms_product`
--
ALTER TABLE `csms_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `csms_purchases`
--
ALTER TABLE `csms_purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `csms_services`
--
ALTER TABLE `csms_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `csms_superadmin`
--
ALTER TABLE `csms_superadmin`
  MODIFY `id` int(111) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `csms_users`
--
ALTER TABLE `csms_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `csms_vendor`
--
ALTER TABLE `csms_vendor`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `csms_orders`
--
ALTER TABLE `csms_orders`
  ADD CONSTRAINT `csms_orders_ibfk_1` FOREIGN KEY (`opid`) REFERENCES `csms_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `csms_orders_ibfk_2` FOREIGN KEY (`ocid`) REFERENCES `csms_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csms_product`
--
ALTER TABLE `csms_product`
  ADD CONSTRAINT `csms_product_ibfk_1` FOREIGN KEY (`pvid`) REFERENCES `csms_vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `csms_product_ibfk_2` FOREIGN KEY (`pcid`) REFERENCES `csms_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csms_purchases`
--
ALTER TABLE `csms_purchases`
  ADD CONSTRAINT `csms_purchases_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `csms_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `csms_purchases_ibfk_2` FOREIGN KEY (`pvid`) REFERENCES `csms_vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `csms_services`
--
ALTER TABLE `csms_services`
  ADD CONSTRAINT `csms_services_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `csms_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
