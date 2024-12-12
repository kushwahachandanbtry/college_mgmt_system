

























































































































-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 09:09 AM
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
-- Database: `school_mgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `bname` varchar(40) NOT NULL,
  `wname` varchar(50) NOT NULL,
  `class` varchar(20) NOT NULL,
  `pubdate` varchar(20) NOT NULL,
  `book_id` varchar(20) NOT NULL,
  `uploade` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `tname` varchar(40) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `time` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(40) NOT NULL,
  `classes` varchar(10) NOT NULL,
  `sections` varchar(20) NOT NULL,
  `Phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `tname`, `gender`, `time`, `email`, `address`, `classes`, `sections`, `Phone`) VALUES
(2, 'chandan', 'Male', '11:05', 'admin@example.com', 'Imadol', 'BBA', '', '9823196848');

-- --------------------------------------------------------

--
-- Table structure for table `exam_routine`
--

CREATE TABLE `exam_routine` (
  `id` int(11) NOT NULL,
  `class` varchar(40) NOT NULL,
  `schedule` varchar(1000) NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_routine`
--

INSERT INTO `exam_routine` (`id`, `class`, `schedule`, `time`) VALUES
(1, '9', '{\"date\":[\"05/31\",\"06/02\",\"06/04\",\"06/06\",\"06/08\"],\"subject\":[\"science\",\"Math\",\"Nepali\",\"English\",\"Social\"]}', '10:00 - 01:00'),
(2, '10', '{\"date\":[\"05/31\",\"06/02\",\"06/04\",\"06/06\",\"06/08\"],\"subject\":[\"science\",\"Math\",\"Nepali\",\"English\",\"Social\"]}', '10:00 - 01:00');

-- --------------------------------------------------------

--
-- Table structure for table `home-logo`
--

CREATE TABLE `home-logo` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_logo`
--

CREATE TABLE `home_logo` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_logo`
--

INSERT INTO `home_logo` (`id`, `image`) VALUES
(1, 'istockphoto-629628952-612x612.jpg'),
(7, 'json.webp'),
(8, 'IMG-20231005-WA0007 (1).png'),
(9, 'IMG-20231005-WA0007 (1).png'),
(10, 'IMG-20231005-WA0007 (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `occupation` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `childrens_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `bio` varchar(200) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `username`, `name`, `bio`, `image`) VALUES
(1, 'kushwahhachandan@gmail.com', 'chadnan', 'sdfdsfdsfsdaf', 'download (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `routines`
--

CREATE TABLE `routines` (
  `id` int(11) NOT NULL,
  `class` varchar(20) NOT NULL,
  `routine` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routines`
--

INSERT INTO `routines` (`id`, `class`, `routine`) VALUES
(2, '09', '{\"sunday\":{\"1st\":\"science\",\"2nd\":\"Math\",\"3rd\":\"english\",\"break\":\"health\",\"4th\":\"01-02\",\"5th\":\"nepali\"},\"monday\":{\"1st\":\"science\",\"2nd\":\"Math\",\"3rd\":\"english\",\"break\":\"health\",\"4th\":\"01-02\",\"5th\":\"nepali\"},\"tuesday\":{\"1st\":\"science\",\"2nd\":\"Math\",\"3rd\":\"english\",\"break\":\"health\",\"4th\":\"01-02\",\"5th\":\"nepali\"},\"wednesday\":{\"1st\":\"science\",\"2nd\":\"Math\",\"3rd\":\"english\",\"break\":\"health\",\"4th\":\"01-02\",\"5th\":\"nepali\"},\"thrusday\":{\"1st\":\"science\",\"2nd\":\"Math\",\"3rd\":\"english\",\"break\":\"health\",\"4th\":\"01-02\",\"5th\":\"nepali\"},\"friday\":{\"1st\":\"science\",\"2nd\":\"Math\",\"3rd\":\"english\",\"break\":\"health\",\"4th\":\"01-02\",\"5th\":\"nepali\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `blood` varchar(11) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `admissionid` varchar(20) NOT NULL,
  `section` varchar(10) NOT NULL,
  `shortbio` varchar(400) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `class` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `religions` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(30) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `shortbio` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(3, 'chandan', 'chandan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_routine`
--
ALTER TABLE `exam_routine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home-logo`
--
ALTER TABLE `home-logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_logo`
--
ALTER TABLE `home_logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routines`
--
ALTER TABLE `routines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_routine`
--
ALTER TABLE `exam_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home-logo`
--
ALTER TABLE `home-logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_logo`
--
ALTER TABLE `home_logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `routines`
--
ALTER TABLE `routines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
