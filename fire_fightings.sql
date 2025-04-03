-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2022 at 11:03 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fire_fighting`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `station_id`, `complaint_latitude`, `complaint_longitude`, `complaint_image`, `contact`, `building`, `status`, `timestamp`) VALUES
(23, 3, '31.3832484', '73.1254275', '62b5724142e2e.png', '03368655492', '', 'new', '2022-06-24 08:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_detail` text NOT NULL,
  `post_image` varchar(100) NOT NULL,
  `post_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_detail`, `post_image`, `post_date`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat temporibus, distinctio repellendus labore, ducimus unde dignissimos fugiat ipsa! Ipsum necessitatibus nam deserunt, illo. Fugiat aspernatur distinctio, unde voluptatum sit, doloremque.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat temporibus, distinctio repellendus labore, ducimus unde dignissimos fugiat ipsa! Ipsum necessitatibus nam deserunt, illo. Fugiat aspernatur distinctio, unde volu', '1655645668.png', '2022-06-19'),
(2, 'Ipsum necessitatibus nam deserunt, illo. Fugiat aspernatur distinctio, unde voluptatum sit, doloremque.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat temporibus, distinctio repellendus labore, ducimus unde dignissimos fugiat ipsa! Ipsum necessitatibus nam deserunt, illo. \"\"', '1656003478.png', '2022-06-19'),
(3, 'Be care fhf wehdw ewd', '1656060775.jpg', '2022-06-24');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `station_id`, `case_name`, `deaths`, `city`, `location_name`, `year`, `report_date`, `complete_detail`, `report_timestamp`) VALUES
(3, 1, 'Satyana D Ground Road ', '2', 'Toba Tek Singh', 'HBL bank ', 2022, '2022-06-16', 'ore deserunt hic? Obcaecati voluptatum aspernatur ut delectus adipisci vero sunt eveniet, ', '2022-06-21 14:47:20');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rescue_team`
--

INSERT INTO `rescue_team` (`team_id`, `station_id`, `team_name`, `team_username`, `team_password`) VALUES
(2, 3, 'Shaheen1', 'asd228035', '123'),
(3, 1, 'Shaheen1', 'sha', '123');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `station_id`, `staff_name`, `father_name`, `staff_cnic`, `staff_address`, `staff_image`, `staff_timestamp`) VALUES
(4, 3, 'M Faizan', 'Shakoor', '3330368655419', 'Faisalbad ', '', '2022-06-02 08:16:06');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`station_id`, `station_name`, `station_contact`, `station_username`, `station_password`, `station_city`, `station_latitude`, `station_longitude`, `station_timestamp`) VALUES
(1, 'D Ground Station', 2222, 'dground1', '123', 'faisalabad', '31.40662422379463', '73.10950615723951', '2022-06-02'),
(3, 'Koh-e-Noor Station ', 112121212, 'kohenoor1', '123', 'Faisalabad', '31.411559638656282', '73.11531799238689', '2022-08-03'),
(4, 'Samnabad', 2212222, 'samnabad1', '123', 'faisalabad', '31.40521051443001', '73.07919743730821', '2022-06-19'),
(7, 'GTS Fire Station', 11111, 'gtsfire1', '123', 'faisalabad', '31.41683712032666', '73.09118737244383', '2022-06-24');

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
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rescue_team`
--
ALTER TABLE `rescue_team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
