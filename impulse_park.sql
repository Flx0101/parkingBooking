-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2018 at 07:56 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `impulse_park`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` int(2) NOT NULL,
  `password` varchar(40) NOT NULL,
  `admin_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `password`, `admin_name`) VALUES
(1, 'admin123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `slot_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `uid` int(2) DEFAULT NULL,
  `md_reg_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`slot_id`, `status`, `uid`, `md_reg_no`) VALUES
(2, 1, 1, 'asdasda');

-- --------------------------------------------------------

--
-- Table structure for table `booking_timing`
--

CREATE TABLE `booking_timing` (
  `md_reg_no` varchar(10) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imp_user`
--

CREATE TABLE `imp_user` (
  `name` int(10) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `id` int(11) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imp_user`
--

INSERT INTO `imp_user` (`name`, `email`, `phone`, `id`, `password`) VALUES
(0, 'test1@gmail.com', '12541254', 1, '5a105e8b9d40e1329780d62ea2265d8a'),
(0, 'dharmil@gmail.com', '9876543210', 2, '25f9e794323b453885f5181f1b624d0b'),
(0, 'abhi@gmail.com', '1234567890', 3, 'e10adc3949ba59abbe56e057f20f883e'),
(0, 'test2@gmail.com', '1234567890', 4, 'a3dcb4d229de6fde0db5686dee47145d'),
(0, 'test3@gmail.com', '12541254', 5, '8ad8757baa8564dc136c1e07507f4a98');

-- --------------------------------------------------------

--
-- Table structure for table `imp_user_vehicle`
--

CREATE TABLE `imp_user_vehicle` (
  `md_name` varchar(20) NOT NULL,
  `md_reg_no` varchar(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `md_icon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imp_user_vehicle`
--

INSERT INTO `imp_user_vehicle` (`md_name`, `md_reg_no`, `uid`, `md_icon`) VALUES
('two wheeler', 'asdasda', 1, 0),
('asdasdasd', 'asdasdasd', 5, 0),
('two wheeler', 'qeqweqweq', 1, 0),
('four wheeler', 'qfwff', 3, 0),
('four wheeler', 'qweqweqwe', 1, 0),
('four wheeler', 'wgwsg', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `parking_area`
--

CREATE TABLE `parking_area` (
  `four_wheel` int(2) NOT NULL,
  `two_wheel` int(2) NOT NULL,
  `truck` int(2) NOT NULL,
  `pid` int(2) NOT NULL,
  `available` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parking_area`
--

INSERT INTO `parking_area` (`four_wheel`, `two_wheel`, `truck`, `pid`, `available`) VALUES
(1, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slot_location`
--

CREATE TABLE `slot_location` (
  `slot_id` int(11) NOT NULL,
  `latitude` varchar(10) NOT NULL,
  `longitude` varchar(10) NOT NULL,
  `available` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slot_location`
--

INSERT INTO `slot_location` (`slot_id`, `latitude`, `longitude`, `available`) VALUES
(1, '18.9799', '72.8435', 1),
(2, '18.9877', '72.8318', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_card_details`
--

CREATE TABLE `user_card_details` (
  `md_reg_no` varchar(20) NOT NULL,
  `card_number` varchar(50) NOT NULL,
  `exp_date` varchar(10) NOT NULL,
  `cv_code` varchar(10) NOT NULL,
  `coupon_code` bigint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`md_reg_no`);

--
-- Indexes for table `booking_timing`
--
ALTER TABLE `booking_timing`
  ADD PRIMARY KEY (`md_reg_no`);

--
-- Indexes for table `imp_user`
--
ALTER TABLE `imp_user`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `imp_user_vehicle`
--
ALTER TABLE `imp_user_vehicle`
  ADD PRIMARY KEY (`md_reg_no`);

--
-- Indexes for table `parking_area`
--
ALTER TABLE `parking_area`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `slot_location`
--
ALTER TABLE `slot_location`
  ADD PRIMARY KEY (`slot_id`);

--
-- Indexes for table `user_card_details`
--
ALTER TABLE `user_card_details`
  ADD PRIMARY KEY (`md_reg_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `imp_user`
--
ALTER TABLE `imp_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
