-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2019 at 09:41 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `course` varchar(50) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `sem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `course`, `branch`, `sem`) VALUES
(1, 'MCA', 'MCA', 1),
(2, 'MCA', 'MCA', 2),
(3, 'MCA', 'MCA', 3),
(4, 'MCA', 'MCA', 4),
(5, 'MCA', 'MCA', 5),
(6, 'BTECH', 'CIVIL', 1),
(7, 'BTECH', 'CIVIL', 2),
(8, 'BTECH', 'CIVIL', 3),
(9, 'BTECH', 'CIVIL', 4),
(10, 'BTECH', 'CIVIL', 5),
(11, 'BTECH', 'CIVIL', 6),
(12, 'BTECH', 'CIVIL', 7),
(13, 'BTECH', 'CIVIL', 8),
(14, 'BTECH', 'MECHANICAL', 1),
(15, 'BTECH', 'MECHANICAL', 2),
(16, 'BTECH', 'MECHANICAL', 3),
(17, 'BTECH', 'MECHANICAL', 4),
(18, 'BTECH', 'MECHANICAL', 5),
(19, 'BTECH', 'MECHANICAL', 6),
(20, 'BTECH', 'MECHANICAL', 7),
(21, 'BTECH', 'MECHANICAL', 8),
(22, 'BTECH', 'COMPUTER ', 1),
(23, 'BTECH', 'COMPUTER ', 2),
(24, 'BTECH', 'COMPUTER', 3),
(25, 'BTECH', 'COMPUTER', 4),
(26, 'BTECH', 'COMPUTER', 5),
(27, 'BTECH', 'COMPUTER', 6),
(28, 'BTECH', 'COMPUTER', 7),
(29, 'BTECH', 'COMPUTER', 8),
(30, 'BTECH', 'INFORMATION', 1),
(31, 'BTECH', 'INFORMATION', 2),
(32, 'BTECH', 'INFORMATION', 3),
(33, 'BTECH', 'INFORMATION', 4),
(34, 'BTECH', 'INFORMATION', 5),
(35, 'BTECH', 'INFORMATION', 6),
(36, 'BTECH', 'INFORMATION', 7),
(37, 'BTECH', 'INFORMATION', 8),
(38, 'BTECH', 'ELECTRONICS', 1),
(39, 'BTECH', 'ELECTRONICS', 2),
(40, 'BTECH', 'ELECTRONICS', 3),
(41, 'BTECH', 'ELECTRONICS', 4),
(42, 'BTECH', 'ELECTRONICS', 5),
(43, 'BTECH', 'ELECTRONICS', 6),
(44, 'BTECH', 'ELECTRONICS', 7),
(45, 'BTECH', 'ELECTRONICS', 8),
(46, 'BTECH', 'ELECTRICAL', 1),
(47, 'BTECH', 'ELECTRICAL', 2),
(48, 'BTECH', 'ELECTRICAL', 3),
(49, 'BTECH', 'ELECTRICAL', 4),
(50, 'BTECH', 'ELECTRICAL', 5),
(51, 'BTECH', 'ELECTRICAL', 6),
(52, 'BTECH', 'ELECTRICAL', 7),
(53, 'BTECH', 'ELECTRICAL', 8);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_assigned`
--

CREATE TABLE `faculty_assigned` (
  `serial` int(11) NOT NULL,
  `faculty_sr` int(11) DEFAULT NULL,
  `subject_sr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_assigned`
--

INSERT INTO `faculty_assigned` (`serial`, `faculty_sr`, `subject_sr`) VALUES
(16, 14, 5),
(18, 14, 31),
(19, 14, 32),
(20, 4, 2),
(24, 16, 30),
(25, 16, 29),
(26, 14, 33),
(27, 14, 34),
(28, 14, 35),
(29, 21, 1),
(30, 12, 3),
(31, 13, 4),
(32, 19, 6),
(33, 6, 17),
(34, 6, 23),
(35, 8, 18),
(36, 8, 24),
(37, 9, 21),
(38, 9, 27),
(39, 4, 36);

-- --------------------------------------------------------

--
-- Table structure for table `student_timetable`
--

CREATE TABLE `student_timetable` (
  `sr` int(11) NOT NULL,
  `day` int(11) DEFAULT NULL,
  `shift` int(11) DEFAULT NULL,
  `faculty_sr` int(11) DEFAULT NULL,
  `subject_sr` int(11) DEFAULT NULL,
  `branch` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `sem` int(11) NOT NULL,
  `col` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_timetable`
--

INSERT INTO `student_timetable` (`sr`, `day`, `shift`, `faculty_sr`, `subject_sr`, `branch`, `course`, `sem`, `col`) VALUES
(48, 4, 1, 4, 2, 'MCA', 'MCA', 4, 1),
(50, 2, 4, 4, 2, 'MCA', 'MCA', 4, 1),
(51, 5, 6, 4, 2, 'MCA', 'MCA', 4, 1),
(52, 5, 2, 14, 31, 'MCA', 'MCA', 4, 1),
(53, 5, 3, 14, 31, 'MCA', 'MCA', 4, 1),
(54, 5, 4, 14, 31, 'MCA', 'MCA', 4, 1),
(55, 5, 2, 16, 29, 'MCA', 'MCA', 4, 2),
(56, 5, 3, 16, 29, 'MCA', 'MCA', 4, 2),
(57, 5, 4, 16, 29, 'MCA', 'MCA', 4, 2),
(58, 1, 5, 14, 32, 'MCA', 'MCA', 4, 1),
(59, 1, 6, 14, 32, 'MCA', 'MCA', 4, 1),
(60, 1, 7, 14, 32, 'MCA', 'MCA', 4, 1),
(61, 1, 5, 16, 30, 'MCA', 'MCA', 4, 2),
(62, 1, 6, 16, 30, 'MCA', 'MCA', 4, 2),
(63, 1, 7, 16, 30, 'MCA', 'MCA', 4, 2),
(64, 3, 6, 14, 5, 'MCA', 'MCA', 4, 1),
(65, 3, 3, 14, 5, 'MCA', 'MCA', 4, 1),
(67, 3, 2, 14, 35, 'CIVIL', 'BTECH', 4, 1),
(68, 6, 1, 14, 35, 'CIVIL', 'BTECH', 4, 1),
(69, 1, 1, 14, 5, 'MCA', 'MCA', 4, 1),
(70, 2, 2, 21, 1, 'MCA', 'MCA', 4, 1),
(71, 3, 1, 12, 3, 'MCA', 'MCA', 4, 1),
(72, 3, 2, 13, 4, 'MCA', 'MCA', 4, 1),
(73, 5, 1, 19, 6, 'MCA', 'MCA', 4, 1),
(74, 4, 5, 6, 17, 'MCA', 'MCA', 4, 1),
(75, 4, 6, 6, 23, 'MCA', 'MCA', 4, 1),
(76, 2, 5, 8, 18, 'MCA', 'MCA', 4, 1),
(77, 2, 6, 8, 24, 'MCA', 'MCA', 4, 1),
(78, 6, 2, 9, 21, 'MCA', 'MCA', 4, 1),
(79, 6, 1, 9, 27, 'MCA', 'MCA', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `Sr` int(11) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `course` varchar(30) NOT NULL,
  `sem` int(11) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `shortform` varchar(20) NOT NULL,
  `class_count` int(10) NOT NULL,
  `class_type` varchar(10) NOT NULL,
  `batch` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Sr`, `branch`, `course`, `sem`, `subject_code`, `subject_name`, `shortform`, `class_count`, `class_type`, `batch`) VALUES
(1, 'MCA', 'MCA', 4, 'MCC-402', 'Web Technology', 'WT', 2, 'l', 'a'),
(2, 'MCA', 'MCA', 4, 'MCC-403', 'Computer Network', 'CN', 0, 'l', 'a'),
(3, 'MCA', 'MCA', 4, 'E2', 'Elective 2', 'ELECTIVE 2', 2, 'l', 'a'),
(4, 'MCA', 'MCA', 4, 'E3', 'Elective 3', 'ELECTIVE 3', 2, 'l', 'a'),
(5, 'MCA', 'MCA', 4, 'MCC-401', 'Software Engineering', 'SE', 0, 'l', 'a'),
(6, 'MCA', 'MCA', 4, 'HV', 'Human Values', 'HV', 2, 'l', 'a'),
(17, 'MCA', 'MCA', 4, 'MCC-402', 'Web Technology', 'WT', 0, 't', 'p1'),
(18, 'MCA', 'MCA', 4, 'MCC-403', 'Computer Network', 'CN', 0, 't', 'p1'),
(19, 'MCA', 'MCA', 4, 'E2', 'Elective 2', 'ELECTIVE 2', 1, 't', 'p1'),
(20, 'MCA', 'MCA', 4, 'E3', 'Elective 3', 'ELCTIVE 3', 1, 't', 'p1'),
(21, 'MCA', 'MCA', 4, 'MCC-401', 'Software Engineering', 'SE', 0, 't', 'p1'),
(23, 'MCA', 'MCA', 4, 'MCC-402', 'Web Technology', 'WT', 0, 't', 'p2'),
(24, 'MCA', 'MCA', 4, 'MCC-403', 'Computer Network', 'CN', 0, 't', 'p2'),
(25, 'MCA', 'MCA', 4, 'E2', 'Elective 2', 'ELECTIVE 2', 1, 't', 'p2'),
(26, 'MCA', 'MCA', 4, 'E3', 'Elective 3', 'ELECTIVE 3', 1, 't', 'p2'),
(27, 'MCA', 'MCA', 4, 'MCC-401', 'Software Engineering', 'SE', 0, 't', 'p2'),
(29, 'MCA', 'MCA', 4, 'MCC-453', 'Computer Network ', 'CN', 0, 'p', 'p2'),
(30, 'MCA', 'MCA', 4, 'MCC-453', 'Computer Network ', 'CN', 0, 'p', 'p1'),
(31, 'MCA', 'MCA', 4, 'Project-Lab', 'MIni Project Lab', 'PROJECT', 0, 'p', 'p1'),
(32, 'MCA', 'MCA', 4, 'Project-Lab', 'MIni Project Lab', 'PROJECT', 0, 'p', 'p2'),
(33, 'COMPUTER', 'BTECH', 4, 'B104', 'Data Structure and algorithm', 'DS', 3, 'l', 'a'),
(34, 'INFORMATION', 'BTECH', 4, 'IT104', 'Data Structure and algorithm', 'DS', 3, 'l', 'a'),
(35, 'CIVIL', 'BTECH', 4, 'CV104', 'C Programming', 'CPP', 1, 'l', 'a'),
(36, 'COMPUTER ', 'BTECH', 4, 'B105', 'Computer Architecture', 'CA', 3, 'l', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `faculty_code` varchar(20) NOT NULL,
  `faculty_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `faculty_code`, `faculty_name`, `department`, `type`, `password`) VALUES
(2, 'BPC', 'Prof. B.P. Chaurasia', 'Computer Science', 'professor', '12345678'),
(3, 'SS', 'Prof. Samir Srivastava', 'Computer Science', 'professor', '12345678'),
(4, 'AKA', 'Dr. Abhay Kumar Agraval', 'Computer Science', 'professor', '12345678'),
(5, 'G1', 'Prof. Pradeep Kumar', 'Computer Science', 'professor', '12345678'),
(6, 'G3', 'Prof. Kundan Kumar', 'Computer Science', 'professor', '12345678'),
(7, 'G4', 'Prof Rohit Kumar', 'Computer Science', 'professor', '12345678'),
(8, 'G5', 'Prof. Dhrub Kumar', 'Computer Science', 'professor', '12345678'),
(9, 'G6', 'Prof. Bharat Singh', 'Computer Science', 'professor', '12345678'),
(10, 'G12', 'Prof Ishwari Singh Rajput', 'Computer Science', 'professor', '12345678'),
(11, 'G13', 'Prof. Rakshita Mall', 'Computer Science', 'professor', '12345678'),
(12, 'G14', 'Prof Sunil Malviya', 'Computer Science', 'professor', '12345678'),
(13, 'G15', 'Prof Akhilesh Kumar Tripathi', 'Computer Science', 'professor', '12345678'),
(14, 'G16', 'Prof Raushan Kumar Singh', 'Computer Science', 'professor', '12345678'),
(15, 'G17', 'Prof Priyanka Gautam', 'Computer Science', 'professor', '12345678'),
(16, 'G18', 'Prof Sudhir Mohan', 'Computer Science', 'professor', '12345678'),
(18, 'PHD-2', 'Guest', 'Computer Science', 'professor', '12345678'),
(19, 'VS', 'Prof VidyaKant Shukla', 'Computer Science', 'professor', '12345678'),
(20, 'f', 'Arsh Rajput', 'Computer Science', 'Professor', '57668'),
(21, 'NB', 'Dr. Neelendra Baadal', 'Computer Science', 'Head of Department', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_assigned`
--

CREATE TABLE `teacher_assigned` (
  `id` int(11) NOT NULL,
  `faculty_code` varchar(20) DEFAULT NULL,
  `subject_code` varchar(20) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `course` varchar(50) NOT NULL,
  `semester` int(11) DEFAULT NULL,
  `class_type` varchar(10) NOT NULL,
  `batch` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_assigned`
--

INSERT INTO `teacher_assigned` (`id`, `faculty_code`, `subject_code`, `branch`, `course`, `semester`, `class_type`, `batch`) VALUES
(2, 'AKA', 'MCC-403', 'MCA', 'MCA', 4, 'l', 'a'),
(3, 'AKA', 'MCC-453', 'MCA', 'MCA', 4, 'p', 'p1'),
(20, 'AKA', 'MCC-453', 'MCA', 'MCA', 4, 'p', 'p2'),
(6, 'G1', 'MCC-402', 'MCA', 'MCA', 4, 't', ''),
(7, 'G1', 'MCC-403', 'MCA', 'MCA', 4, 't', ''),
(4, 'G14', 'E2', 'MCA', 'MCA', 4, 'l', 'a'),
(14, 'G14', 'E2', 'MCA', 'MCA', 4, 't', ''),
(8, 'G15', 'E3', 'MCA', 'MCA', 4, 'l', ''),
(15, 'G15', 'E3', 'MCA', 'MCA', 4, 't', ''),
(9, 'G16', 'MCC-401', 'MCA', 'MCA', 4, 'l', ''),
(13, 'G16', 'MCC-401', 'MCA', 'MCA', 4, 't', ''),
(11, 'G16', 'Project-Lab', 'MCA', 'MCA', 4, 'p', ''),
(1, 'NB', 'MCC-402', 'MCA', 'MCA', 4, 'l', 'a'),
(16, 'VS', 'HV', 'MCA', 'MCA', 4, 'l', ''),
(17, 'VS', 'HV', 'MCA', 'MCA', 4, 't', ''),
(18, 'VS', 'HVLAB(p1)', 'MCA', 'MCA', 4, 'p', ''),
(19, 'VS', 'HVLAB(p2)', 'MCA', 'MCA', 4, 'p', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_timetable`
--

CREATE TABLE `teacher_timetable` (
  `id` int(11) NOT NULL,
  `faculty_code` varchar(30) NOT NULL,
  `subject_code` varchar(30) NOT NULL,
  `class_type` varchar(10) NOT NULL,
  `batch` varchar(10) NOT NULL,
  `shift` varchar(10) NOT NULL,
  `day` varchar(20) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `sem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_assigned`
--
ALTER TABLE `faculty_assigned`
  ADD PRIMARY KEY (`serial`),
  ADD UNIQUE KEY `subject_sr` (`subject_sr`),
  ADD KEY `faculty_sr` (`faculty_sr`);

--
-- Indexes for table `student_timetable`
--
ALTER TABLE `student_timetable`
  ADD PRIMARY KEY (`sr`),
  ADD KEY `faculty_sr` (`faculty_sr`),
  ADD KEY `subject_sr` (`subject_sr`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`Sr`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_code` (`faculty_code`);

--
-- Indexes for table `teacher_assigned`
--
ALTER TABLE `teacher_assigned`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_code` (`faculty_code`,`subject_code`,`branch`,`course`,`semester`,`class_type`,`batch`);
ALTER TABLE `teacher_assigned` ADD FULLTEXT KEY `subject_code` (`subject_code`);
ALTER TABLE `teacher_assigned` ADD FULLTEXT KEY `subject_code_2` (`subject_code`);
ALTER TABLE `teacher_assigned` ADD FULLTEXT KEY `teacher_code_2` (`faculty_code`);
ALTER TABLE `teacher_assigned` ADD FULLTEXT KEY `teacher_code_3` (`faculty_code`);
ALTER TABLE `teacher_assigned` ADD FULLTEXT KEY `subject_code_3` (`subject_code`);

--
-- Indexes for table `teacher_timetable`
--
ALTER TABLE `teacher_timetable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `faculty_assigned`
--
ALTER TABLE `faculty_assigned`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `student_timetable`
--
ALTER TABLE `student_timetable`
  MODIFY `sr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `Sr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teacher_assigned`
--
ALTER TABLE `teacher_assigned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teacher_timetable`
--
ALTER TABLE `teacher_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faculty_assigned`
--
ALTER TABLE `faculty_assigned`
  ADD CONSTRAINT `faculty_assigned_ibfk_1` FOREIGN KEY (`faculty_sr`) REFERENCES `teacher` (`id`),
  ADD CONSTRAINT `faculty_assigned_ibfk_2` FOREIGN KEY (`subject_sr`) REFERENCES `subject` (`Sr`);

--
-- Constraints for table `student_timetable`
--
ALTER TABLE `student_timetable`
  ADD CONSTRAINT `student_timetable_ibfk_1` FOREIGN KEY (`faculty_sr`) REFERENCES `faculty_assigned` (`faculty_sr`),
  ADD CONSTRAINT `student_timetable_ibfk_2` FOREIGN KEY (`subject_sr`) REFERENCES `faculty_assigned` (`subject_sr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
