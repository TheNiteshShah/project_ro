-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 01:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a_choudhary_jewellers`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_sidebar`
--

CREATE TABLE `tbl_admin_sidebar` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `url` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_sidebar`
--

INSERT INTO `tbl_admin_sidebar` (`id`, `name`, `url`) VALUES
(1, 'Dashboard', 'home'),
(2, 'Team', '#'),
(4, 'Slideshow', '#');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_sidebar2`
--

CREATE TABLE `tbl_admin_sidebar2` (
  `id` int(11) NOT NULL,
  `main_id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `url` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_sidebar2`
--

INSERT INTO `tbl_admin_sidebar2` (`id`, `main_id`, `name`, `url`) VALUES
(1, 2, 'View Team', 'system/view_team'),
(2, 2, 'Add Team', 'system/add_team'),
(3, 4, 'Slider 1', 'Slider/view_slider'),
(4, 4, 'Slider 2', 'Slider1/view_slider1'),
(5, 4, 'Slider 3', 'Slider2/view_slider2'),
(6, 4, 'Slider 4', 'Slider3/view_slider3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `url`, `image`, `is_active`) VALUES
(1, 'Bridal', 'wedding-and-engagement', 'assets/uploads/slider1/slider120210606060642.jpg', 1),
(2, 'Wedding Bands', 'wedding_bands', 'assets/uploads/slider1/slider120210606070653.jpg', 1),
(3, 'Jewelry', 'jewelry', 'assets/uploads/slider3/slider320210714080724.jpg', 1),
(4, 'Chan & Cord', 'chain-and-cord', 'assets/uploads/slider/slider20210528060504.jpg', 1),
(5, 'Mountings', 'mountings', 'assets/uploads/slider3/slider320210606070606.jpg', 1),
(6, 'Findings', 'findings', NULL, 1),
(7, 'Diamonds', 'diamonds', NULL, 1),
(8, 'Gemstones', 'gemstones', NULL, 1),
(9, 'Metals', 'metals', NULL, 1),
(10, 'Tools & Supplies', 'tools-and-supplies', NULL, 1),
(11, 'Watch Services & Batteries', 'watch-services-and-batteries', NULL, 1),
(12, 'Packaging & Displays', 'packaging-and-display', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `seq` varchar(255) DEFAULT NULL,
  `ip` varchar(100) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `name`, `url`, `image`, `seq`, `ip`, `added_by`, `date`, `is_active`) VALUES
(1, 'Shop Bridal', 'https://www.fineoutput.co.in/chaudhary_jewellers', 'assets/uploads/slider/slider20210528050546.jpg', '1', '', 0, '', 1),
(2, 'Shop Lab-Grown Diamond Jewelry', 'https://www.fineoutput.co.in/chaudhary_jewellers', 'assets/uploads/slider/slider20210528050501.jpg', '3', '', 0, '', 1),
(3, 'Shop Wedding Bands', 'https://www.fineoutput.co.in/chaudhary_jewellers', 'assets/uploads/slider/slider20210603050627.jpg', '4', '', 0, '', 1),
(4, 'Customized Jewelry', 'https://www.fineoutput.co.in/chaudhary_jewellers', 'assets/uploads/slider/slider20210528060504.jpg', '5', '', 0, '', 1),
(9, 'Design A Ring', 'https://www.fineoutput.co.in/chaudhary_jewellers', 'assets/uploads/slider/slider20210612050635.jpg', '2', '71.198.147.200', 19, '2021-06-12 17:59:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider1`
--

CREATE TABLE `tbl_slider1` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `seq` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider1`
--

INSERT INTO `tbl_slider1` (`id`, `name`, `image`, `link`, `seq`, `ip`, `date`, `added_by`, `is_active`) VALUES
(2, 'Eternity Bands', 'assets/uploads/slider1/slider120210606060642.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '4', '1.39.212.63', '2021-06-05 18:26:39', 19, 1),
(3, 'Stackable Bands', 'assets/uploads/slider1/slider120210606070653.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '5', '1.39.212.63', '2021-06-05 18:29:03', 19, 1),
(5, 'Engagement Rings', 'assets/uploads/slider1/slider120210611020609.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '1', '71.198.147.200', '2021-06-11 02:56:09', 19, 1),
(6, 'Wedding Bands', 'assets/uploads/slider1/slider120210611030609.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '3', '71.198.147.200', '2021-06-11 03:00:09', 19, 1),
(7, 'Certified Lab-Grown Diamonds', 'assets/uploads/slider1/slider120210714080751.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '2', '71.198.147.200', '2021-07-14 20:13:51', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider2`
--

CREATE TABLE `tbl_slider2` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `seq` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider2`
--

INSERT INTO `tbl_slider2` (`id`, `name`, `image`, `link`, `seq`, `ip`, `date`, `added_by`, `is_active`) VALUES
(1, 'Personalized Jewelry', 'assets/uploads/slider2/slider220210606070605.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '1', '1.39.212.63', '2021-06-05 18:33:42', 19, 1),
(2, 'Customizable Jewelry', 'assets/uploads/slider2/slider220210606070620.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '3', '71.198.147.200', '2021-06-06 07:33:20', 19, 1),
(3, 'Monogram Jewelry', 'assets/uploads/slider2/slider220210611030602.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '2', '71.198.147.200', '2021-06-11 03:02:02', 19, 1),
(4, 'Men\'s Jewelry', 'assets/uploads/slider2/slider220210611030604.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '4', '71.198.147.200', '2021-06-11 03:28:04', 19, 1),
(5, 'Charms', 'assets/uploads/slider2/slider220210611030607.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '5', '71.198.147.200', '2021-06-11 03:30:07', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider3`
--

CREATE TABLE `tbl_slider3` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `seq` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider3`
--

INSERT INTO `tbl_slider3` (`id`, `name`, `image`, `link`, `seq`, `ip`, `date`, `added_by`, `is_active`) VALUES
(1, 'Chains', 'assets/uploads/slider3/slider320210606070606.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '1', '1.39.212.63', '2021-06-05 18:34:56', 19, 1),
(2, 'Bracelets', 'assets/uploads/slider3/slider320210611030604.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '5', '71.198.147.200', '2021-06-11 03:05:04', 19, 1),
(3, 'Earrings', 'assets/uploads/slider3/slider320210611030658.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '4', '71.198.147.200', '2021-06-11 03:06:58', 19, 1),
(4, 'Rings', 'assets/uploads/slider3/slider320210611030621.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '2', '71.198.147.200', '2021-06-11 03:08:21', 19, 1),
(5, 'Necklaces and Pendants', 'assets/uploads/slider3/slider320210611030640.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '6', '71.198.147.200', '2021-06-11 03:26:40', 19, 1),
(6, 'Lab-Grown Diamond Stud Earrings', 'assets/uploads/slider3/slider320210714080724.jpg', 'https://www.fineoutput.co.in/chaudhary_jewellers', '3', '71.198.147.200', '2021-07-14 20:06:24', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team`
--

CREATE TABLE `tbl_team` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(2000) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` varchar(2000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `power` int(11) NOT NULL,
  `services` varchar(1000) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `added_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_team`
--

INSERT INTO `tbl_team` (`id`, `name`, `email`, `password`, `phone`, `address`, `image`, `power`, `services`, `ip`, `date`, `added_by`, `is_active`) VALUES
(1, 'Anay Pareek', 'anaypareek@rocketmail.com', '9ffd3dfaf18c6c0dededaba5d7db9375', '9799655891', '19 kalyanpuri new sanganer road sodala', '', 1, '[\"999\"]', '1000000', '16-05-2018', 1, 1),
(19, 'Demo', 'demo@gmail.com', 'f702c1502be8e55f4208d69419f50d0a', '9999999999', 'jaipur', NULL, 1, '[\"999\"]', '::1', '2020-01-04 18:12:55', 1, 1),
(29, 'Animesh Sharma', 'animesh.skyline@gmail.com', '8bda6fe26dad2b31f9cb9180ec3823e8', '8441849182', 'pratap nagar sitapura jaipur', '', 2, '[\"999\"]', '::1', '2020-01-06 14:47:11', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_sidebar`
--
ALTER TABLE `tbl_admin_sidebar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_sidebar2`
--
ALTER TABLE `tbl_admin_sidebar2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider1`
--
ALTER TABLE `tbl_slider1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider2`
--
ALTER TABLE `tbl_slider2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider3`
--
ALTER TABLE `tbl_slider3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_team`
--
ALTER TABLE `tbl_team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_sidebar`
--
ALTER TABLE `tbl_admin_sidebar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_admin_sidebar2`
--
ALTER TABLE `tbl_admin_sidebar2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_slider1`
--
ALTER TABLE `tbl_slider1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_slider2`
--
ALTER TABLE `tbl_slider2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_slider3`
--
ALTER TABLE `tbl_slider3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_team`
--
ALTER TABLE `tbl_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
