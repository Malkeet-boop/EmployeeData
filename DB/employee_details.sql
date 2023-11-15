-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 07:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `id` int(255) NOT NULL COMMENT 'ID',
  `company_name` varchar(100) NOT NULL COMMENT 'Company Name',
  `email` varchar(50) NOT NULL COMMENT 'Company Email',
  `password` varchar(50) NOT NULL COMMENT 'Company Password',
  `created_by` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_ip` varchar(30) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_on` datetime NOT NULL,
  `modified_ip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_login`
--

CREATE TABLE `company_login` (
  `id` int(255) NOT NULL,
  `company_id` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_ip` varchar(30) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_on` datetime NOT NULL,
  `modified_ip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `id` int(255) NOT NULL COMMENT 'ID',
  `company_id` int(255) NOT NULL,
  `employee_name` varchar(100) NOT NULL COMMENT 'Employee Name',
  `employee_code` varchar(50) NOT NULL COMMENT 'Employee Code',
  `mobile_number` varchar(10) NOT NULL COMMENT 'Mobile Number',
  `email` varchar(50) NOT NULL COMMENT 'Email',
  `archived` varchar(10) NOT NULL COMMENT 'Archived',
  `created_by` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_ip` varchar(30) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_on` datetime NOT NULL,
  `modified_ip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_login`
--
ALTER TABLE `company_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- AUTO_INCREMENT for table `company_login`
--
ALTER TABLE `company_login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'ID';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
