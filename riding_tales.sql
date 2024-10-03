-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 03:50 PM
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
-- Database: `riding_tales`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `admin_name` varchar(16) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `first_name`, `last_name`, `admin_name`, `email_id`, `phone_no`, `password_hash`, `created_at`) VALUES
(1, 'Monica', 'Black', 'monica_black', 'monicablack@gmail.com', '9877832165', 'Abc@1234', '2024-08-27 10:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `bike_models`
--

CREATE TABLE `bike_models` (
  `model_id` int(11) NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `bike_img` varchar(100) NOT NULL,
  `vehicle_type` enum('Scooter','Motorcycle') NOT NULL,
  `transmission_type` enum('Gear','Gearless') NOT NULL,
  `fuel_type` enum('Petrol','E-bike','Diesel') NOT NULL,
  `rental_rate` decimal(10,2) NOT NULL,
  `late_fee_rate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bike_models`
--

INSERT INTO `bike_models` (`model_id`, `model_name`, `bike_img`, `vehicle_type`, `transmission_type`, `fuel_type`, `rental_rate`, `late_fee_rate`) VALUES
(1, 'Bajaj Pulsar NS - 400', 'bajaj-pulsar-ns400.png', 'Motorcycle', 'Gearless', 'Petrol', 20.00, 10.00),
(2, 'Hero Splender', 'bajaj-pulsar-ns400.png', 'Scooter', 'Gearless', 'E-bike', 40.00, 20.00),
(3, 'Access 125', 'Access 125.png', 'Scooter', 'Gearless', 'E-bike', 50.00, 24.00);

-- --------------------------------------------------------

--
-- Table structure for table `bike_stocks`
--

CREATE TABLE `bike_stocks` (
  `stock_id` int(11) NOT NULL,
  `model_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bike_stocks`
--

INSERT INTO `bike_stocks` (`stock_id`, `model_id`, `city_id`, `quantity`) VALUES
(1, 1, 1, 10),
(2, 2, 1, 15),
(3, 1, 2, 20),
(4, 2, 2, 4),
(5, 3, 2, 30);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `pick_drop_loc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `pincode`, `pick_drop_loc`) VALUES
(1, 'Rajkot', '363603', 'Gundavadi'),
(2, 'Morbi', '123456', 'Super Market');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `feedback` text NOT NULL,
  `ratings` tinyint(4) NOT NULL,
  `date_submitted` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `user_id`, `subject`, `feedback`, `ratings`, `date_submitted`) VALUES
(2, 8, 'Very Good Service!!', 'Bike was in a very good condition and also staff is very supportive.', 5, '2024-09-28 13:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `rental_start_datetime` datetime NOT NULL,
  `rental_end_datetime` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `rental_status` varchar(20) NOT NULL DEFAULT 'Success'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`rental_id`, `user_id`, `city_id`, `model_id`, `rental_start_datetime`, `rental_end_datetime`, `quantity`, `amount`, `rental_status`) VALUES
(3, 8, 2, 1, '2024-09-30 15:00:00', '2024-09-30 16:00:00', 1, 20.00, 'Cancelled'),
(4, 8, 2, 1, '2024-09-30 15:00:00', '2024-09-30 16:00:00', 1, 20.00, 'Success'),
(5, 8, 2, 1, '2024-09-29 12:00:00', '2024-09-29 13:00:00', 1, 20.00, 'Success'),
(6, 8, 2, 1, '2024-09-29 12:00:00', '2024-09-29 13:00:00', 1, 20.00, 'Success');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_name` varchar(16) DEFAULT NULL,
  `gender` enum('M','F','O') DEFAULT NULL,
  `dob` date NOT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `phone_no` varchar(10) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `driving_lic_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_name`, `gender`, `dob`, `email_id`, `phone_no`, `password_hash`, `created_at`, `driving_lic_img`) VALUES
(7, 'Alien', 'Mars', 'new_alien@123', 'M', '2002-08-05', 'alien@gmail.com', '8989787789', '$2y$10$7Nuh1wi4kd.EEPCjD8fw7.eow9z12550.uJHQzKp3MRb0Eph/Y5hW', '2024-09-15 12:49:49', 'uploads/driving_lics/marie_curie_quote.jpg'),
(8, 'Heli', 'Aghara', 'heli_123', 'F', '2010-07-01', 'heliaghara04@gmail.com', '8777775458', '$2y$10$Dw8lmeNwNr7Rrfro29CSseNRLgOn6zG4fe1.V5jg/IOm77ix8qMHC', '2024-09-25 12:38:34', 'uploads/driving_lics/dummy_license.png'),
(9, 'Isha', 'Mirani', 'isha_123', 'F', '2005-05-02', 'isha_mirani@123.gmail.com', '8978978987', '$2y$10$u7hTqWMr.aRlsC2H0SFbie4ccy8Urj8/70kkKkL3FqIYAlvSFMXxK', '2024-09-28 05:58:18', 'uploads/driving_lics/dummy_license.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_name` (`admin_name`),
  ADD UNIQUE KEY `email_id` (`email_id`),
  ADD UNIQUE KEY `phone_no` (`phone_no`);

--
-- Indexes for table `bike_models`
--
ALTER TABLE `bike_models`
  ADD PRIMARY KEY (`model_id`),
  ADD UNIQUE KEY `model_name` (`model_name`);

--
-- Indexes for table `bike_stocks`
--
ALTER TABLE `bike_stocks`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `fk_model_id` (`model_id`) USING BTREE,
  ADD KEY `fk_city_id` (`city_id`) USING BTREE;

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `fk_feedbacks_user_id` (`user_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `fk_rentals_user_id` (`user_id`),
  ADD KEY `fk_rentals_city_id` (`city_id`),
  ADD KEY `fk_rentals_model_id` (`model_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bike_models`
--
ALTER TABLE `bike_models`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bike_stocks`
--
ALTER TABLE `bike_stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bike_stocks`
--
ALTER TABLE `bike_stocks`
  ADD CONSTRAINT `fk_city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_model_id` FOREIGN KEY (`model_id`) REFERENCES `bike_models` (`model_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `fk_feedbacks_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `fk_rentals_city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rentals_model_id` FOREIGN KEY (`model_id`) REFERENCES `bike_models` (`model_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rentals_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
