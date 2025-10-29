-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2025 at 12:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fire_fightings`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `timestamp`) VALUES
(1, 'admin', 'admin', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `complaint_latitude` varchar(200) NOT NULL,
  `complaint_longitude` varchar(200) NOT NULL,
  `complaint_image` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `building` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'new',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `station_id`, `complaint_latitude`, `complaint_longitude`, `complaint_image`, `contact`, `building`, `status`, `timestamp`) VALUES
(23, 3, '31.3832484', '73.1254275', '62b5724142e2e.png', '03368655492', '', 'reject', '2022-06-24 08:13:53'),
(24, 0, '31.4380089', '74.3235424', '647ee9d70620b.png', '', '', 'reject', '2023-06-06 08:09:59'),
(25, 9, '31.506432', '74.3243776', '647eeb63a7174.png', '', '', 'reject', '2023-06-06 08:16:35'),
(26, 9, '31.506432', '74.3243776', '647eebbe029ab.png', '', '', 'reject', '2023-06-06 08:18:06'),
(27, 8, '31.4457978', '74.3170029', '647eec198044d.png', '', '', 'complete', '2023-06-06 08:19:37'),
(28, 8, '31.506432', '74.3243776', '647ef309ebd3b.png', '', '', 'complete', '2023-06-06 08:49:13'),
(29, 8, '31.4458172', '74.316186', '648d5a2780a1f.png', '', '', 'complete', '2023-06-17 07:00:55'),
(30, 8, '31.4457136', '74.3160532', '648d5ba79f215.png', '', '', 'reject', '2023-06-17 07:07:19'),
(31, 8, '31.4457136', '74.3160532', '648d5baf77e2d.png', '', '', 'reject', '2023-06-17 07:07:27'),
(32, 8, '31.4458037', '74.3162078', '648d5bee6ee74.png', '', '', 'complete', '2023-06-17 07:08:30'),
(33, 8, '31.4453499', '74.3158256', '648ff32117978.png', '', '', 'reject', '2023-06-19 06:18:09'),
(34, 8, '31.506432', '74.3243776', '648ffa6287582.png', '', '', 'reject', '2023-06-19 06:49:06'),
(35, 8, '31.506432', '74.3243776', '648ffbd81cc65.png', '', '', 'reject', '2023-06-19 06:55:20'),
(36, 8, '31.4440999', '74.3125451', '6493f28bce77c.png', '', '', 'complete', '2023-06-22 07:04:43'),
(37, 8, '31.4380112', '74.3230383', '64941708b2976.png', '', '', 'complete', '2023-06-22 09:40:24'),
(38, 8, '31.4350901', '74.3022764', '6611895608590.png', '', '', 'reject', '2024-04-06 17:41:42'),
(39, 8, '31.4380171', '74.3213426', '6616698d0600d.png', '', '', 'complete', '2024-04-10 10:27:25'),
(40, 8, '31.4441127', '74.3123896', '665a0e4e63398.png', '', '', 'reject', '2024-05-31 17:52:14'),
(41, 8, '31.4350807', '74.3008096', '665a101cda68c.png', '', '', 'complete', '2024-05-31 17:59:56'),
(42, 8, '31.4350901', '74.3022764', '66bb7bcde689a.png', '', '', 'reject', '2024-08-13 15:29:17'),
(43, 8, '31.4350901', '74.3022764', '66bb801b8d534.png', '', '', 'complete', '2024-08-13 15:47:39'),
(44, 8, '31.4441244', '74.312405', '6819a04dd2dca.png', '', '', 'complete', '2025-05-06 05:38:21'),
(45, 8, '31.444166944068986', '74.31243967644808', '69028e8ac33ca.png', '', '', 'reject', '2025-10-29 22:00:42'),
(46, 8, '31.44416411008939', '74.31241495673639', '6902a26aa437e.png', '', '', 'reject', '2025-10-29 23:25:30'),
(47, 8, '31.44416411008939', '74.31241495673639', '6902a294e6caa.png', '', '', 'reject', '2025-10-29 23:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_detail` text NOT NULL,
  `post_image` varchar(100) NOT NULL,
  `post_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_detail`, `post_image`, `post_date`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat temporibus, distinctio repellendus labore, ducimus unde dignissimos fugiat ipsa! Ipsum necessitatibus nam deserunt, illo. Fugiat aspernatur distinctio, unde voluptatum sit, doloremque.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat temporibus, distinctio repellendus labore, ducimus unde dignissimos fugiat ipsa! Ipsum necessitatibus nam deserunt, illo. Fugiat aspernatur distinctio, unde volu', '1655645668.png', '2022-06-19'),
(2, 'Ipsum necessitatibus nam deserunt, illo. Fugiat aspernatur distinctio, unde voluptatum sit, doloremque.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat temporibus, distinctio repellendus labore, ducimus unde dignissimos fugiat ipsa! Ipsum necessitatibus nam deserunt, illo. \"\"', '1656003478.png', '2022-06-19'),
(3, 'Be care fhf wehdw ewd', '1656060775.jpg', '2022-06-24'),
(4, 'The image captures a devastating fire engulfing multiple stories of a building. Flames are intensely visible, erupting from several windows and consuming the interior. Thick, black smoke billows upwards, obscuring the upper parts of the structure and indicating a significant amount of burning material. ', '1747381416.jpg', '2025-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `case_name` varchar(255) NOT NULL,
  `deaths` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `year` year(4) NOT NULL DEFAULT current_timestamp(),
  `report_date` varchar(20) NOT NULL,
  `complete_detail` text NOT NULL,
  `report_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `station_id`, `case_name`, `deaths`, `city`, `location_name`, `year`, `report_date`, `complete_detail`, `report_timestamp`) VALUES
(4, 8, 'Fire in building', '6', 'Lahore', 'Rana Road Township', '2023', '2025-06-05', 'Report is completed.', '2023-06-06 08:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `rescue_team`
--

CREATE TABLE `rescue_team` (
  `team_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `team_name` varchar(200) NOT NULL,
  `team_username` varchar(200) NOT NULL,
  `team_password` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rescue_team`
--

INSERT INTO `rescue_team` (`team_id`, `station_id`, `team_name`, `team_username`, `team_password`) VALUES
(2, 3, 'Shaheen1', 'asd228035', '123'),
(3, 1, 'Shaheen1', 'sha', '123'),
(5, 8, 'township fire engine', 'townshipteam', 'townshipteam');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `staff_name` text NOT NULL,
  `father_name` text NOT NULL,
  `staff_cnic` varchar(30) NOT NULL,
  `staff_address` varchar(255) NOT NULL,
  `staff_image` varchar(100) NOT NULL,
  `staff_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `station_id`, `staff_name`, `father_name`, `staff_cnic`, `staff_address`, `staff_image`, `staff_timestamp`) VALUES
(4, 3, 'Ali', 'Haider', '3330368655419', 'Lahore', '', '2022-06-02 08:16:06'),
(7, 8, 'Margoob', 'Ahmad', '31302-21334231-76', 'Lahore', '', '2023-06-06 08:35:01'),
(8, 8, 'Jahanzab', 'Sha', '73334-1255234-54', 'Brother', '', '2023-06-17 07:14:13'),
(9, 8, 'Zeshan', 'Musa', '53278-12753-12', 'Boys', '', '2023-06-17 07:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `station_id` int(11) NOT NULL,
  `station_name` text NOT NULL,
  `station_contact` int(100) NOT NULL,
  `station_username` varchar(100) NOT NULL,
  `station_password` varchar(100) NOT NULL,
  `station_city` text NOT NULL,
  `station_latitude` varchar(200) NOT NULL,
  `station_longitude` varchar(200) NOT NULL,
  `station_timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`station_id`, `station_name`, `station_contact`, `station_username`, `station_password`, `station_city`, `station_latitude`, `station_longitude`, `station_timestamp`) VALUES
(8, 'Township Station', 2147483647, 'township station', 'township', 'lahore', '31.44560383742592', '74.30824892995626 ', '2025-05-16'),
(9, 'Model Town Station', 2147483647, 'modeltown', 'modeltown', 'lahore', '31.500263402908236', '74.425284818575', '2025-05-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `rescue_team`
--
ALTER TABLE `rescue_team`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`station_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rescue_team`
--
ALTER TABLE `rescue_team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
