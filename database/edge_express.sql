-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2026 at 11:14 AM
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
-- Database: `edge_express`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone_number` varchar(150) DEFAULT NULL,
  `faculty` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `full_name`, `email`, `password_hash`, `created_at`, `phone_number`, `faculty`) VALUES
(1, 'Adithi', 'adithiarundi@gmail.com', '$2y$10$/1Js/hsrTfGWrU.xbAWJKerBtDevGvFT9MZnIy6sgnMjqz1NalWe6', '2026-07-03 06:17:21', '071234567', 'foc'),
(3, 'Adithi Arundi', 'appealingflora@gmail.com', '$2y$10$bY/B3RWgR14PqfICkT8ZQuyVO9He5AgTjT30qk4uyL90jnTO1xU8u', '2026-07-03 06:21:09', NULL, NULL),
(5, 'Adithi Arundi', 'abc@gmail.com', '$2y$10$8gH/bcismJZuuG6OuqZX1ucYZSBTLJVieMhSZ2DmTmnWJQvRvvOSq', '2026-07-03 06:25:30', NULL, NULL),
(12, '', '', '$2y$10$BvYxfoPBmMInVjGBI/YUTeZg5M4BfbKYe1UCj7b2w6KgjMlC0wt0y', '2026-07-03 09:58:59', '', ''),
(15, 'jdksk', 'asd@gmail.com', '$2y$10$PwsUGJGU/kW7BwJK3PMG3./jehVzzxS9vuxey2mJmHCWVnWX.uKUC', '2026-07-03 10:01:30', '0719921688', 'foc'),
(17, 'gfy', 'fdgg@gmail.com', '$2y$10$Gy5pWKMlrbYxOWnU0LZOU.yh8.POum2Rjlr2vLhs.WqCE4OXT6p3O', '2026-07-03 10:58:14', '0719921678', 'foc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
