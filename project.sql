-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2025 at 01:52 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', 'admin', 'admin123', '2025-07-09 09:20:13', '2025-07-09 09:20:13'),
(2, 'Super Admin', 'superadmin@example.com', 'superadmin', 'super123', '2025-07-09 09:20:13', '2025-07-09 09:20:13');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `session_date` date NOT NULL,
  `session_time` time NOT NULL,
  `duration` int(11) NOT NULL DEFAULT 60,
  `session_type` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('scheduled','completed','cancelled') DEFAULT 'scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `started_at` datetime DEFAULT NULL,
  `ended_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `trainer_id`, `title`, `client_name`, `session_date`, `session_time`, `duration`, `session_type`, `description`, `status`, `created_at`, `updated_at`, `started_at`, `ended_at`) VALUES
(24, 2, 'SS', 'Johnson', '2025-07-09', '11:00:00', 60, 'Group Class', '', '', '2025-07-09 05:29:27', '2025-07-09 11:26:46', NULL, NULL),
(37, 1, 'SS', 'Smith', '2025-07-11', '11:00:00', 60, 'Personal Training', '', 'completed', '2025-07-09 11:24:37', '2025-07-09 11:46:00', '2025-07-09 17:15:58', '2025-07-09 17:16:00'),
(38, 1, 'SS', 'Smith', '2025-07-12', '11:00:00', 60, 'Personal Training', '', 'scheduled', '2025-07-09 11:24:37', '2025-07-09 11:24:37', NULL, NULL),
(45, 1, 'CORE JAVA', 'Smith', '2025-07-11', '18:00:00', 60, 'Personal Training', '', 'completed', '2025-07-09 11:42:24', '2025-07-10 09:16:20', '2025-07-10 14:46:11', '2025-07-10 14:46:20'),
(46, 1, 'CORE JAVA', 'Smith', '2025-07-14', '18:00:00', 60, 'Personal Training', '', 'scheduled', '2025-07-09 11:42:24', '2025-07-09 11:42:24', NULL, NULL),
(47, 1, 'CORE JAVA', 'Smith', '2025-07-15', '18:00:00', 60, 'Personal Training', '', 'scheduled', '2025-07-09 11:42:24', '2025-07-09 11:42:24', NULL, NULL),
(48, 1, 'CORE JAVA', 'Smith', '2025-07-16', '18:00:00', 60, 'Personal Training', '', 'scheduled', '2025-07-09 11:42:24', '2025-07-09 11:42:24', NULL, NULL),
(49, 1, 'CORE JAVA', 'Smith', '2025-07-17', '18:00:00', 60, 'Personal Training', '', 'scheduled', '2025-07-09 11:42:24', '2025-07-09 11:42:24', NULL, NULL),
(67, 1, 'SS', 'Smith', '2025-07-14', '22:00:00', 60, 'Personal Training', '', 'scheduled', '2025-07-09 15:49:59', '2025-07-09 15:49:59', NULL, NULL),
(76, 1, 'SS', 'Smith', '2025-07-23', '10:00:00', 120, 'Online', '', 'scheduled', '2025-07-09 16:04:29', '2025-07-09 16:04:29', NULL, NULL),
(77, 1, 'SS', 'Smith', '2025-07-30', '10:00:00', 120, 'Online', '', 'scheduled', '2025-07-09 16:04:29', '2025-07-09 16:04:29', NULL, NULL),
(79, 1, 'SS', 'Smith', '2025-07-10', '03:00:00', 60, 'Online', '', 'completed', '2025-07-09 19:33:48', '2025-07-09 19:34:19', '2025-07-10 01:04:14', '2025-07-10 01:04:19'),
(81, 2, 'SS', 'Johnson', '2025-07-14', '11:00:00', 60, 'Online', '', 'completed', '2025-07-10 02:55:56', '2025-07-10 02:56:25', '2025-07-10 08:26:15', '2025-07-10 08:26:25'),
(82, 2, 'SS', 'Johnson', '2025-07-16', '11:00:00', 60, 'Online', '', 'scheduled', '2025-07-10 02:55:56', '2025-07-10 02:55:56', NULL, NULL),
(83, 2, 'SS', 'Johnson', '2025-07-21', '11:00:00', 60, 'Online', '', 'scheduled', '2025-07-10 02:55:56', '2025-07-10 02:55:56', NULL, NULL),
(84, 2, 'SS', 'Johnson', '2025-07-23', '11:00:00', 60, 'Online', '', 'scheduled', '2025-07-10 02:55:56', '2025-07-10 02:55:56', NULL, NULL),
(85, 2, 'SS', 'Johnson', '2025-07-28', '11:00:00', 60, 'Online', '', 'scheduled', '2025-07-10 02:55:56', '2025-07-10 02:55:56', NULL, NULL),
(86, 2, 'SS', 'Johnson', '2025-07-30', '11:00:00', 60, 'Online', '', 'scheduled', '2025-07-10 02:55:56', '2025-07-10 02:55:56', NULL, NULL),
(87, 2, 'SS', 'Johnson', '2025-07-10', '10:00:00', 120, 'Online', '', 'completed', '2025-07-10 04:17:33', '2025-07-10 04:20:37', '2025-07-10 09:50:27', '2025-07-10 09:50:37'),
(88, 2, 'SS', 'Johnson', '2025-07-17', '10:00:00', 120, 'Online', '', 'scheduled', '2025-07-10 04:17:33', '2025-07-10 04:17:33', NULL, NULL),
(90, 1, 'JAVA', 'Smith', '2025-07-10', '23:00:00', 30, 'Online', '', 'completed', '2025-07-10 17:26:48', '2025-07-10 17:27:28', '2025-07-10 22:57:26', '2025-07-10 22:57:28'),
(97, 5, 'JAVA', 'om', '2025-07-11', '10:35:00', 15, 'Online', '', 'scheduled', '2025-07-11 04:47:28', '2025-07-11 04:47:28', NULL, NULL),
(100, 4, 'SS', 'pintoo', '2025-07-15', '13:55:00', 65, 'Online', '', 'completed', '2025-07-11 08:12:02', '2025-07-11 08:21:05', '2025-07-11 13:51:04', '2025-07-11 13:51:05'),
(101, 4, 'SS', 'pintoo', '2025-07-16', '13:55:00', 65, 'Online', '', 'scheduled', '2025-07-11 08:12:02', '2025-07-11 08:12:02', NULL, NULL),
(102, 4, 'SS', 'pintoo', '2025-07-17', '13:55:00', 65, 'Online', '', 'scheduled', '2025-07-11 08:12:02', '2025-07-11 08:12:02', NULL, NULL),
(103, 4, 'SS', 'pintoo', '2025-07-22', '13:55:00', 65, 'Online', '', 'scheduled', '2025-07-11 08:12:02', '2025-07-11 08:12:02', NULL, NULL),
(104, 4, 'SS', 'pintoo', '2025-07-23', '13:55:00', 65, 'Online', '', 'scheduled', '2025-07-11 08:12:02', '2025-07-11 08:12:02', NULL, NULL),
(105, 4, 'SS', 'pintoo', '2025-07-24', '13:55:00', 65, 'Online', '', 'scheduled', '2025-07-11 08:12:02', '2025-07-11 08:12:02', NULL, NULL),
(106, 4, 'SS', 'pintoo', '2025-07-29', '13:55:00', 65, 'Online', '', 'scheduled', '2025-07-11 08:12:02', '2025-07-11 08:12:02', NULL, NULL),
(107, 4, 'SS', 'pintoo', '2025-07-30', '13:55:00', 65, 'Online', '', 'scheduled', '2025-07-11 08:12:02', '2025-07-11 08:12:02', NULL, NULL),
(108, 4, 'SS', 'pintoo', '2025-07-31', '13:55:00', 65, 'Online', '', 'scheduled', '2025-07-11 08:12:02', '2025-07-11 08:12:02', NULL, NULL),
(109, 4, 'SS', 'pintoo', '2025-07-11', '14:00:00', 60, 'Online', '', 'scheduled', '2025-07-11 08:17:24', '2025-07-11 08:17:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verify_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `name`, `email`, `username`, `password`, `created_at`, `updated_at`, `verify_token`) VALUES
(1, 'Smith', 'john@example.com', 'johnsmith', 'password123', '2025-07-08 17:35:52', '2025-07-08 17:35:52', NULL),
(2, 'Johnson', 'sarah@example.com', 'sarahj', 'trainer456', '2025-07-08 17:35:52', '2025-07-08 17:35:52', NULL),
(3, 'Wilson', 'mike@example.com', 'mikew', 'fitness789', '2025-07-08 17:35:52', '2025-07-08 17:35:52', NULL),
(4, 'pintoo', 'pintooprajapati027@gmail.com', 'pintoo', 'pintoo123', '2025-07-10 17:19:20', '2025-07-11 08:23:20', ''),
(5, 'om', 'omvjoshi297@gmail.com', 'om', 'om123', '2025-07-11 04:46:17', '2025-07-11 04:46:17', NULL),
(6, 'smit', 'ssathavara602@gamil.com', 'Ssmit', 'smit123', '2025-07-11 07:40:33', '2025-07-11 07:40:33', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
