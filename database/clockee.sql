-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 04:07 AM
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
-- Database: `clockee`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `check_in` time NOT NULL,
  `in_status` varchar(255) NOT NULL,
  `check_out` time NOT NULL,
  `out_status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`id`, `employee_id`, `department`, `shift`, `location`, `message`, `date`, `check_in`, `in_status`, `check_out`, `out_status`, `created_at`) VALUES
(2, 'CLK-4', 'HR', '18:00:00-04:00:00', 'Office', '', '2024-12-14', '07:15:49', 'On Time', '07:15:52', 'Over Time', '2024-12-13 23:15:52'),
(3, 'CLK-5', 'Admin', '18:00:00-04:00:00', 'Office', '', '2024-12-14', '07:16:08', 'On Time', '00:00:00', '', '2024-12-13 23:16:08'),
(4, 'CLK-6', 'Account', '08:00:00-16:00:00', 'Field', 'meeting with investor ', '2024-12-14', '07:19:09', 'On Time', '00:00:00', '', '2024-12-13 23:19:09'),
(5, 'CLK-2', 'Account', '08:00:00-16:00:00', 'Home', 'I have a cold but can still work', '2024-12-14', '10:57:20', 'Late', '00:00:00', '', '2024-12-14 02:57:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `department_name` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `department_id`, `department_name`, `status`, `created_at`) VALUES
(1, 'ACD', 'Account', 1, '2023-09-29 05:47:23'),
(2, 'ADM', 'Admin', 1, '2023-09-29 05:47:39'),
(3, 'HRD', 'HR', 1, '2023-09-29 05:47:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `emailid` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `employee_id` varchar(250) NOT NULL,
  `joining_date` varchar(250) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT '0' COMMENT '1=Admin, 0=Employee',
  `status` tinyint(4) NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `first_name`, `last_name`, `username`, `emailid`, `password`, `dob`, `gender`, `employee_id`, `joining_date`, `phone`, `shift`, `department`, `role`, `status`, `created_at`) VALUES
(1, 'admin', '', 'admin', 'admin@eam.com', 'adminpass', '', '', '', '', '', '', '', '1', 1, '2024-12-13 22:28:49'),
(3, 'Genesis', 'La Rosa', 'gen', 'genlarosa@gmail.com', 'genpass', '01/12/2024', 'Male', 'CLK-2', '01/12/2024', '0945691623', '08:00:00-16:00:00', 'Account', '0', 1, '2024-12-13 22:32:31'),
(4, 'Mike', 'Cortez', 'mike', 'mikecortez@gmail.com', 'mikepass', '01/12/2024', 'Male', 'CLK-4', '01/12/2024', '0945612382', '18:00:00-04:00:00', 'HR', '0', 1, '2024-12-13 22:33:18'),
(5, 'Daisy Rey', 'Gondao', 'daisy', 'daisyreygondao@gmail.com', 'daisypass', '01/12/2024', 'Male', 'CLK-5', '01/12/2024', '0923114851', '18:00:00-04:00:00', 'Admin', '0', 1, '2024-12-13 22:35:27'),
(6, 'Mae', 'Cabillo', 'mae', 'maecabillo@gmail.com', 'maepass', '01/12/2024', 'Female', 'CLK-6', '01/12/2024', '0123456789', '08:00:00-16:00:00', 'Account', '0', 1, '2024-12-13 23:17:02'),
(7, 'Mary Grace', 'Sayaboc', 'mary', 'marygracesayaboc@gmail.com', 'marypass', '01/12/2024', 'Female', 'CLK-7', '01/12/2024', '0945784659', '08:00:00-16:00:00', 'Admin', '0', 0, '2024-12-13 22:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave`
--

CREATE TABLE `tbl_leave` (
  `id` int(10) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `message` text NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave`
--

INSERT INTO `tbl_leave` (`id`, `employee_id`, `type`, `date`, `message`, `status`) VALUES
(3, 'CLK-2', 'Vacation Leave', '2024-12-14', '', 'approved'),
(4, 'CLK-2', 'Vacation Leave', '2024-12-20', '', 'pending'),
(5, 'CLK-2', 'Vacation Leave', '2024-12-14', '', 'pending'),
(6, 'CLK-2', 'Vacation Leave', '2024-12-25', '', 'approved'),
(7, 'CLK-2', 'Sick Leave', '2025-02-14', '', 'denied');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `location`, `created_at`) VALUES
(1, 'Office', '2023-09-29 05:52:28'),
(2, 'Field', '2023-09-29 05:52:40'),
(3, 'Home', '2023-09-29 05:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift`
--

CREATE TABLE `tbl_shift` (
  `id` int(11) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Active,0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_shift`
--

INSERT INTO `tbl_shift` (`id`, `start_time`, `end_time`, `status`, `created_at`) VALUES
(3, '08:00:00', '16:00:00', 1, '2024-12-13 22:31:42'),
(4, '18:00:00', '04:00:00', 1, '2024-12-13 22:31:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
