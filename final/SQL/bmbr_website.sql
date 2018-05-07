-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2018 at 04:48 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmbr_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `bmbr_professors`
--

CREATE TABLE `bmbr_professors` (
  `prof_id` int(2) NOT NULL,
  `prof_first_name` varchar(25) NOT NULL,
  `prof_last_name` varchar(25) NOT NULL,
  `prof_user_name` varchar(25) NOT NULL,
  `prof_password` varchar(60) NOT NULL,
  `prof_email` varchar(30) NOT NULL,
  `prof_image_file_name` varchar(60) DEFAULT NULL,
  `prof_summary_file_name` varchar(60) DEFAULT NULL,
  `temp` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bmbr_professors`
--

INSERT INTO `bmbr_professors` (`prof_id`, `prof_first_name`, `prof_last_name`, `prof_user_name`, `prof_password`, `prof_email`, `prof_image_file_name`, `prof_summary_file_name`, `temp`) VALUES
(101, 'Darth', 'Vader', 'asd', '$2y$10$GHcqsYTcLvk67idEChIRHugWDothLYnHe//JlabKLHwgTBQv2zw6q', 'jacobszg@uwec.edu', 'Images/Vader.Darth.profile.DarthVader083111.jpg', 'Vader-Darth-about_me_summary.txt', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bmbr_resources`
--

CREATE TABLE `bmbr_resources` (
  `resource_id` bigint(20) NOT NULL,
  `resource_title` varchar(100) NOT NULL,
  `resource_type` char(1) NOT NULL,
  `resource_pdf_file_name` varchar(60) DEFAULT NULL,
  `resource_summary_file_name` varchar(60) NOT NULL,
  `resource_img_file_name` varchar(60) DEFAULT NULL,
  `prof_id` int(2) NOT NULL,
  `resource_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bmbr_resources`
--

INSERT INTO `bmbr_resources` (`resource_id`, `resource_title`, `resource_type`, `resource_pdf_file_name`, `resource_summary_file_name`, `resource_img_file_name`, `prof_id`, `resource_date`) VALUES
(52, 'The Research Topic', 'R', 'Vader.Lab1Copy2Copy.pdf', 'Vader.The Research Topic.txt', 'Vader.260F1.large.jpg', 101, '2018-05-03'),
(53, 'This is an Event', 'E', 'Vader.Lab1Copy4Copy.pdf', 'Vader.This is an Event.txt', 'Vader.iStock5054930921280x720RECROP.jpg', 101, '2018-05-03'),
(54, 'This is a Board Topic', 'B', 'Vader.Lab1Copy2Copy.pdf', 'Vader.This is a Board Topic.txt', 'Vader.374F1.large.jpg', 101, '2018-05-03'),
(55, 'This is an Equipment', 'Q', 'Vader.Lab1Copy6Copy.pdf', 'Vader.This is an Equipment.txt', 'Vader.Bonedaggers16x9.jpg', 101, '2018-05-03'),
(56, 'How to shake hands with someone you don\'t like', 'P', 'Vader.Lab1Copy.pdf', 'Vader.How to shake hands with someone you don\'t like.txt', 'Vader.Korea16x9.jpg', 101, '2018-05-03'),
(57, 'This is a download', 'D', 'Vader.UWECWorkshopSchedule.docx', 'Vader.This is a download.txt', 'Vader.377F1.large.jpg', 101, '2018-05-03'),
(58, 'When is graduation?', 'F', 'Vader.Presentationschedule2017.pdf', 'Vader.FAQ.1525363175.txt', 'NOTHING', 101, '2018-05-03'),
(59, 'How big is the world?', 'F', 'Vader.lab9.pdf', 'Vader.FAQ.1525363216.txt', 'NOTHING', 101, '2018-05-03'),
(60, 'This is Levi\'s Topic', 'R', 'Vader.Lab1Copy.pdf', 'Vader.This is Levi\'s Topic.txt', 'Vader.ma0504NIDEPApollutionWEB.jpg', 101, '2018-05-04');

-- --------------------------------------------------------

--
-- Table structure for table `bmbr_temp`
--

CREATE TABLE `bmbr_temp` (
  `temp_id` bigint(20) NOT NULL,
  `temp_name` varchar(75) NOT NULL,
  `temp_email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bmbr_professors`
--
ALTER TABLE `bmbr_professors`
  ADD PRIMARY KEY (`prof_id`);

--
-- Indexes for table `bmbr_resources`
--
ALTER TABLE `bmbr_resources`
  ADD PRIMARY KEY (`resource_id`);

--
-- Indexes for table `bmbr_temp`
--
ALTER TABLE `bmbr_temp`
  ADD PRIMARY KEY (`temp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bmbr_professors`
--
ALTER TABLE `bmbr_professors`
  MODIFY `prof_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `bmbr_resources`
--
ALTER TABLE `bmbr_resources`
  MODIFY `resource_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `bmbr_temp`
--
ALTER TABLE `bmbr_temp`
  MODIFY `temp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
