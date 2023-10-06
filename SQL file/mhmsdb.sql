-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2023 at 07:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mhmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `p_address` varchar(255) NOT NULL,
  `sw_id` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`id`, `full_name`, `email`, `password`, `contact_no`, `c_address`, `p_address`, `sw_id`) VALUES
(4, 'Parvez Mosarof', 'parvez@example.edu', '$2y$10$idwRAxyPZZjacl7wmn2KGe1faLDnMsLZbZhFaT.pfUqXXyk50863O', '01630000972', 'Uttara, Dhaka', 'Kalkini, Madaripur', 'PM82');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp(),
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`, `role`) VALUES
(1, 'Admin User', 'admin', 163040000, 'parvez@whms.com', '13a0421c026d7834cccda1389e9bffe3', '2023-07-18 04:36:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `ID` int(5) NOT NULL,
  `CategoryName` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UnitPrice` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `CategoryName`, `CreationDate`, `UnitPrice`) VALUES
(2, 'Mopping', '2023-03-31 12:52:51', '65'),
(3, 'Dusting ', '2023-03-31 12:52:51', '60'),
(5, 'Toilet Clinning', '2023-03-31 12:52:51', '70'),
(13, 'Washing', '2023-07-24 13:01:57', '60'),
(18, 'Flat Cleaning', '2023-08-13 08:27:55', '500');

-- --------------------------------------------------------

--
-- Table structure for table `tblmaid`
--

CREATE TABLE `tblmaid` (
  `ID` int(5) NOT NULL,
  `CatID` int(5) DEFAULT NULL,
  `MaidId` varchar(250) DEFAULT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `ContactNumber` bigint(10) DEFAULT NULL,
  `Gender` varchar(250) DEFAULT NULL,
  `Experience` varchar(250) DEFAULT NULL,
  `Dateofbirth` date DEFAULT NULL,
  `Address` varchar(250) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `ProfilePic` varchar(250) DEFAULT NULL,
  `IdProof` varchar(250) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblmaid`
--

INSERT INTO `tblmaid` (`ID`, `CatID`, `MaidId`, `Name`, `Email`, `ContactNumber`, `Gender`, `Experience`, `Dateofbirth`, `Address`, `Description`, `ProfilePic`, `IdProof`, `RegDate`) VALUES
(2, 6, 'mh123', 'Neena', 'neena@gmail.com', 9779789879, 'Female', '3', '1986-02-06', 'K-908', 'hkjhkjhdfkdhkg\r\nrjtetiuaeoy\r\njtgertiouo\r\noiuouoiuo\r\nopipoipoipoipoipoikpokfwf', 'ac510893dc8d91e7a0d7b9f4d7c45e221680333111.jpg', '3f72678c4339b844781889070368cc631680333512.jpg', '2023-03-31 14:39:09'),
(3, 5, 'm1234', 'Krisha', NULL, 8789789789, 'Female', '12', '1978-01-05', 'Kamar para, Dhaka', 'hjghjgjhgjyyutuy', '3f3141ed3b2293aaa6b66587343daa091680536067.jpg', '57a88eacc86363dbe4ea87c74b4bfc991680536067.png', '2023-04-03 15:34:27'),
(4, 2, 'm12', 'Ramu', 'ramu@gmail.com', 1231231230, 'Male', '10', '2011-01-05', 'kanakna goi Bihar', 'hiuyiuyiuyiuyuiu', 'fc5bf5c9948c416f7c1046c8f91ba9a91680536429.png', '48828368a938efd32d079dd542c28ebf1680536429.png', '2023-04-03 15:40:29'),
(6, 3, 'Gpl32', 'Gopal', NULL, 192537895, 'Male', '2', '1970-02-25', 'Savar, Dhaka', 'Average Height', 'b9fb9d37bdf15a699bc071ce49baea531690377865.jpg', '1e6ae4ada992769567b71815f124fac51690377865.jpg', '2023-07-26 13:24:25'),
(7, 3, 'Rtn32', 'Roton', NULL, 125469873, 'Male', '2', '1993-06-20', 'Abdullahpur, Dhaka', '', '4b6bb4964a8babdfbd678a503185e8851692552104.jpg', '890c2373fdb5e1a09f14004acee8b5371692552104.jpg', '2023-08-20 17:21:44'),
(8, 18, 'Rjn12', 'Rajon', NULL, 1254638972, 'Female', '1', '1998-06-09', 'Mirpur 10, Dhaka', '', '738fb08dba749062154c1a0001fccc1b1692552568.jpg', '890c2373fdb5e1a09f14004acee8b5371692552568.jpg', '2023-08-20 17:29:28'),
(9, 13, 'Slm12', 'Salam', NULL, 925687431, 'Male', '2', '1991-01-29', 'Rampura, Dhaka', 'Tall', '890c2373fdb5e1a09f14004acee8b5371692895502.jpg', '8fc4656387a9dd50885186ea7bd230de1692895502.jpg', '2023-08-24 16:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `tblmaidbooking`
--

CREATE TABLE `tblmaidbooking` (
  `ID` int(5) NOT NULL,
  `BookingID` int(10) DEFAULT NULL,
  `CatID` int(5) DEFAULT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `ContactNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `Address` varchar(250) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `WorkingShiftFrom` time DEFAULT NULL,
  `WorkingShiftTo` time DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `Notes` mediumtext DEFAULT NULL,
  `BookingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Remark` varchar(250) DEFAULT NULL,
  `Status` varchar(250) DEFAULT NULL,
  `AssignTo` varchar(250) DEFAULT NULL,
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `TotalAmount` int(11) NOT NULL DEFAULT 0,
  `p_status` varchar(255) DEFAULT NULL,
  `extra_pay` varchar(255) DEFAULT NULL,
  `total_pay` varchar(255) DEFAULT NULL,
  `extra_h` varchar(255) DEFAULT NULL,
  `complain` varchar(255) DEFAULT NULL,
  `comp_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblmaidbooking`
--

INSERT INTO `tblmaidbooking` (`ID`, `BookingID`, `CatID`, `Name`, `ContactNumber`, `Email`, `Address`, `Gender`, `WorkingShiftFrom`, `WorkingShiftTo`, `StartDate`, `Notes`, `BookingDate`, `Remark`, `Status`, `AssignTo`, `UpdationDate`, `TotalAmount`, `p_status`, `extra_pay`, `total_pay`, `extra_h`, `complain`, `comp_by`) VALUES
(205, 851914545, 3, 'Parvez Mosarof', 1630000972, 'parvez@example.edu', 'Uttara, Dhaka', NULL, '09:04:00', '17:04:00', '2023-08-29', 's8', '2023-08-29 03:04:32', 's8', 'Approved', 'Gpl32', '2023-08-29 03:43:57', 480, 'cash', '-120', '360', '-2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL,
  `Timing` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `Timing`) VALUES
(1, 'aboutus', 'About Us', 'Worker Hiring Management System\r\nWorker Hiring System offers trained personnel that are pandemic prepared for your home. Select the best maid service and worker agency for your new domestic help. ', NULL, NULL, NULL, ''),
(2, 'contactus', 'Contact Us', 'Sector 11, Uttara Model Town Dhaka 1230', 'info@gmail.com', 112035644, NULL, '10:30 am to 7:30 pm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `p_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `contact_no`, `c_address`, `p_address`) VALUES
(40, 'Parvez Mosarof', 'parvez@example.edu', '$2y$10$F2972zhNE9wMZ/N0zuJuWuTEc3fdQlSbaF4dR0LwSkLRlBaaenbu2', '01630000972', 'Uttara, Dhaka', 'Shibchar, Madaripur'),
(45, 'ABD', 'parvez02628@gmail.com', '$2y$10$0l9eXNGMpX4FXSjkM/xnweczSOJe5WwRZVYCS745Fl5ib9sxOOSzy', '444444', 'Dhaka', 'Kalkini, Madaripur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblmaid`
--
ALTER TABLE `tblmaid`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblmaidbooking`
--
ALTER TABLE `tblmaidbooking`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblmaid`
--
ALTER TABLE `tblmaid`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblmaidbooking`
--
ALTER TABLE `tblmaidbooking`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
