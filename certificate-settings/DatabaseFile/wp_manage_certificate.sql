-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2021 at 05:37 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wordpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_manage_certificate`
--

CREATE TABLE `wp_manage_certificate` (
  `ID` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `certificate_no` varchar(50) NOT NULL,
  `profile_image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wp_manage_certificate`
--

INSERT INTO `wp_manage_certificate` (`ID`, `student_name`, `student_email`, `course_title`, `issue_date`, `expiry_date`, `certificate_no`, `profile_image`) VALUES
(1, 'Anshu Sharma', 'rahulsharma1298@gmail.com', 'MCA', '2021-03-25', '2022-02-25', '2021MAR00001', 'http://localhost/Wordpress/wordpress/wp-content/uploads/2021/04/anshu.jpg'),
(2, 'Anshu Sharma', 'test@gmail.com', 'MCA', '2021-04-28', '2024-03-28', '20210400002', 'http://localhost/Wordpress/wordpress/wp-content/uploads/2021/04/anshu-26.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_manage_certificate`
--
ALTER TABLE `wp_manage_certificate`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_manage_certificate`
--
ALTER TABLE `wp_manage_certificate`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
