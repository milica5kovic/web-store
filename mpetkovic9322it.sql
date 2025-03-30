-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2025 at 09:49 PM
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
-- Database: `mpetkovic9322it`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'mpetkovic', '0f1cbf02510b6714c483462190f2059666d6a024693072e610f99eae63572f671a1427dab7ab1400ec727520cecf6e38f0dfafdd21548a0050d362c833af2be9', 'mpetkovic9322it@raf.rs');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `product_id`, `date`) VALUES
(1, 2, '2025-03-30 19:14:38'),
(2, 2, '2025-03-30 19:15:48'),
(3, 2, '2025-03-30 19:15:48'),
(4, 2, '2025-03-30 19:15:48'),
(5, 2, '2025-03-30 19:15:49'),
(6, 2, '2025-03-30 19:15:49'),
(7, 2, '2025-03-30 19:15:49'),
(8, 2, '2025-03-30 19:15:49'),
(9, 2, '2025-03-30 19:15:49'),
(10, 2, '2025-03-30 19:15:50'),
(11, 2, '2025-03-30 19:15:50'),
(12, 2, '2025-03-30 19:15:50'),
(13, 2, '2025-03-30 19:15:56'),
(14, 2, '2025-03-30 19:15:57'),
(15, 2, '2025-03-30 19:15:58'),
(16, 2, '2025-03-30 19:15:58'),
(17, 2, '2025-03-30 19:15:59'),
(18, 2, '2025-03-30 19:15:59'),
(19, 2, '2025-03-30 19:16:00'),
(20, 2, '2025-03-30 19:16:00'),
(21, 2, '2025-03-30 19:16:01'),
(22, 2, '2025-03-30 19:16:07'),
(23, 2, '2025-03-13 20:14:38'),
(24, 2, '2025-03-01 20:14:38'),
(25, 2, '2025-03-30 19:15:48'),
(26, 2, '2025-03-30 19:15:48'),
(27, 2, '2025-03-30 19:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL DEFAULT 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png',
  `stock` int(11) NOT NULL,
  `price` float NOT NULL,
  `mark` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category`, `created_by`, `name`, `description`, `image_url`, `stock`, `price`, `mark`) VALUES
(1, 1, 1, 'IPhone 16e', '<p>iPhone 16e has an incredible design &mdash; inside and out &mdash; and is available in an elegant black or white finish. Made from durable aerospace‑grade aluminum, the enclosure on iPhone 16e is built to go the distance and survive life&rsquo;s oops, whoops, and oh nooos.</p>', 'https://www.telekoplus.com/repo/vesti/images/iphone-16e-all-colors.jpg', 11, 699.9, 1),
(2, 1, 1, 'IPhone 16', '<p>iPhone 16 has an incredible design &mdash; inside and out &mdash; and is available in an elegant black or white finish. Made from durable aerospace‑grade aluminum, the enclosure on iPhone 16 is built to go the distance and survive life&rsquo;s oops, whoops, and oh nooos.</p>', 'https://www.telekoplus.com/repo/vesti/images/iphone-16e-all-colors.jpg', 15, 899.9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `created_by`) VALUES
(1, 'Phones', 1),
(4, 'Cameras', 1),
(5, 'Smart Home', 1),
(6, 'CCTV', 1),
(7, 'Lightning', 1),
(8, 'Networking', 1),
(9, 'Arduino', 1),
(10, 'Raspberry Pi', 1),
(12, 'IoT', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category`) REFERENCES `product_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `admin` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `admin` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
