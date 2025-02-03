-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 11:05 AM
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
-- Database: `import-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin2', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `school_name` varchar(149) NOT NULL,
  `confirm_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `password`, `email`, `school_name`, `confirm_password`) VALUES
(13, 'anmol', '$2y$10$HTix.ySuotW6dYZ9AE7oYeDSXAYUr6BFe1sp8efFSGhjhwzf02o7q', 'an12@gmail.com', 'Anmol', '$2y$10$zjyXybhh8FbGaPIuN2XjkObuEBBmG/JiIn6yZmzXs/H.fxz4BC3/y'),
(14, 'Shivam', '$2y$10$VMn4LeUfoZ7j8wyIDu2h.uUXqPV5thSq6rcekMAucK8s/FDFrwHJ6', 'shivam6349@gmail.com', 'Micron-Infotech', '$2y$10$XC.BG81xEj8Djo3Hd7lppe3TK2/LCM.80ibnb1vzZFHviVVahHO06'),
(15, 'sultan', '$2y$10$3Uds5doQrfTkJyivR7PDHeLXog0JvjK4L01UjTM9/8Zhcrs0Cfn76', 'Sultanquraishi2002@gmail.com', 'ICA', '$2y$10$ZrR1nOLMbEEpczsRbavAtOw6A8JdTIt5qBGJBkRUmONsqCEETmzoa'),
(16, '', '$2y$10$imKnzcgZKpTki5a1dD5/C.DfP7AjRVDnnRBmDRtX17yZ8BVpmNp6y', '', '', '$2y$10$d.Lassa73zsrpeuTAk.VzumEKjhMW6WzaM72mkpcAvQgQMDNdsQju');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school`
--

CREATE TABLE `tbl_school` (
  `id` int(11) NOT NULL,
  `principal_name` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` text NOT NULL,
  `mobile_no` bigint(12) NOT NULL,
  `medium` varchar(50) NOT NULL,
  `board` char(5) NOT NULL,
  `address` text NOT NULL,
  `image_name` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schoolname`
--

CREATE TABLE `tbl_schoolname` (
  `id` int(11) NOT NULL,
  `name` varchar(149) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `id` int(10) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `mobile_no` bigint(12) NOT NULL,
  `email` text NOT NULL,
  `school_name` text NOT NULL,
  `address` text NOT NULL,
  `image_name` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`id`, `staff_id`, `name`, `designation`, `gender`, `mobile_no`, `email`, `school_name`, `address`, `image_name`, `updated_at`) VALUES
(51, 1, 'teacher', 'Raja', 'Male', 7897416349, 'male', 'CIC', 'gkp', 'SCHOOL-CIC-NAME-teacher-DESIGNATION-Raja-MOBILENO-7897416349-67189d97a730f.jpeg', '2024-10-23 06:54:15'),
(52, 2, 'peon', 'Rama', 'Male', 7897416348, 'male', 'CIC', 'gkp', 'SCHOOL-CIC-NAME-peon-DESIGNATION-Rama-MOBILENO-7897416348-67189d97a7a32.jpeg', '2024-10-23 06:54:15'),
(53, 3, 'Pt teacher', 'Mohan', 'Male', 7897416349, 'male', 'CIC', 'gkp', 'SCHOOL-CIC-NAME-Pt teacher-DESIGNATION-Mohan-MOBILENO-7897416349-67189d97a813b.jpeg', '2024-10-23 06:54:15'),
(61, 1, 'sultan', 'jdfghj', 'Male', 8115608639, 'Sultan2@gmail.com', 'HDFC', 'hujkl', 'SCHOOL-HDFC-NAME-sultan-Designation-jdfghj-MOBILENO-8115608639.png', '2024-11-11 07:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `id` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `father_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` char(11) NOT NULL,
  `class` int(11) NOT NULL,
  `section` char(3) NOT NULL,
  `mobile_no` bigint(12) NOT NULL,
  `class_teacher_name` varchar(50) NOT NULL,
  `school_name` text NOT NULL,
  `address` text NOT NULL,
  `image_name` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `roll_no`, `name`, `father_name`, `dob`, `gender`, `class`, `section`, `mobile_no`, `class_teacher_name`, `school_name`, `address`, `image_name`, `updated_at`) VALUES
(74, 1, 'shiv', 'mr.singh', '2002-09-11', 'male', 8, 'A', 7896541230, 'abdul', 'GKP', 'GKP', 'SCHOOL-GKP-NAME-shiv-Designation--MOBILENO-7896541230.webp', '2024-10-18 08:43:23'),
(79, 1, 'shiv', 'mr.varma', '2002-09-11', 'male', 8, 'A', 7896541230, 'abdul', 'GKP', 'micron', 'SCHOOL-GKP-NAME-shiv-Designation--MOBILENO-7896541230.jpg', '2024-10-18 09:02:28'),
(238, 1, 'Raja', 'mr.verma', '2002-09-11', 'male', 8, 'a', 7897416348, 'abdul', 'CIC', 'gkp', 'SCHOOL-CIC-NAME-Raja-ROLL-1-CLASS-8-SECTION-a.jpg', '2024-10-23 06:37:52'),
(239, 2, 'Rama', 'mr.verma', '2002-09-11', 'male', 9, 'b', 7897416348, 'abdul', 'CIC', 'gkp', 'SCHOOL-CIC-NAME-Rama-ROLL-2-CLASS-9-SECTION-b.jpeg', '2024-10-23 06:37:52'),
(240, 3, 'Mohan', 'mr.verma', '2002-09-11', 'male', 7, 'c', 7897416348, 'abdul', 'CIC', 'gkp', 'SCHOOL-CIC-NAME-Mohan-ROLL-3-CLASS-7-SECTION-c.png', '2024-10-23 06:37:52'),
(241, 1, 'Raja', 'mr.verma', '2002-09-11', 'male', 8, 'a', 7897416348, 'abdul', 'CIC', 'gkp', 'SCHOOL-CIC-NAME-Raja-ROLL-1-CLASS-8-SECTION-a.jpg', '2024-10-23 06:46:25'),
(242, 2, 'Rama', 'mr.verma', '2002-09-11', 'male', 9, 'b', 7897416348, 'abdul', 'CIC', 'gkp', 'SCHOOL-CIC-NAME-Rama-ROLL-2-CLASS-9-SECTION-b.jpeg', '2024-10-23 06:46:25'),
(243, 3, 'Mohan', 'mr.verma', '2002-09-11', 'male', 7, 'c', 7897416348, 'abdul', 'CIC', 'gkp', 'SCHOOL-CIC-NAME-Mohan-ROLL-3-CLASS-7-SECTION-c.png', '2024-10-23 06:46:25'),
(248, 22, 'shivam', 'mr', '2002-09-11', 'male', 11, 'A', 7897416348, 'abdul', 'micron', 'gkp', 'SCHOOL-micron-NAME-shivam-ROLL-22-CLASS-11-SECTION-A.jpeg', '2024-10-23 07:01:46'),
(249, 22, 'shivam', 'mr', '2002-09-11', 'male', 11, 'A', 7897416348, 'abdul', 'micron', 'gkp', 'SCHOOL-micron-NAME-shivam-ROLL-22-CLASS-11-SECTION-A.jpeg', '2024-10-23 08:13:08'),
(250, 22, 'shivam', 'mr', '1999-09-11', 'male', 11, 'A', 7897416348, 'abdul', 'micron', 'gkp', 'SCHOOL-micron-NAME-shivam-ROLL-22-CLASS-11-SECTION-A.jpeg', '2024-10-23 08:13:49'),
(251, 0, 'sdsdsd', 'sdsdsds', '2024-11-06', 'male', 0, 'A', 8115608639, 'Abdul', 'dsdsdsd', 'sdsdsds', 'SCHOOL-dsdsdsd-NAME-sdsdsd-ROLL-s-CLASS-sdsd-SECTION-A.png', '2024-11-13 17:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `class` int(12) NOT NULL,
  `email` text NOT NULL,
  `mobile_no` bigint(12) NOT NULL,
  `school_name` text NOT NULL,
  `address` text NOT NULL,
  `image_name` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`id`, `name`, `gender`, `class`, `email`, `mobile_no`, `school_name`, `address`, `image_name`, `updated_at`) VALUES
(4, 'Abdul', 'Male', 12, 'test@gmail.com', 8787878779, 'Micron infotechh', 'gkp', '1716541893_97fc2faefc18c3abeafc.jpeg', '2024-09-20 15:02:01'),
(5, 'Abdul', 'Male', 12, 'test@gmail.com', 8787878770, 'Micron infotec', 'gorakhpur', '1716541927_fe319ded8b61b236d966.jpeg', '2024-09-20 15:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(149) NOT NULL,
  `school_name` varchar(149) NOT NULL,
  `password` varchar(149) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_school`
--
ALTER TABLE `tbl_school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schoolname`
--
ALTER TABLE `tbl_schoolname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
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
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_school`
--
ALTER TABLE `tbl_school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_schoolname`
--
ALTER TABLE `tbl_schoolname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
