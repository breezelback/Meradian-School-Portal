-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2023 at 08:41 AM
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
-- Database: `db_meradian`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_academic_year`
--

CREATE TABLE `tbl_academic_year` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_academic_year`
--

INSERT INTO `tbl_academic_year` (`id`, `academic_year`, `status`, `date_created`) VALUES
(3, '2022-2023', 'Inactive', '2023-09-06 22:07:33'),
(4, '2023-2024', 'Active', '2023-09-06 22:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

CREATE TABLE `tbl_announcement` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `announcement` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_announcement`
--

INSERT INTO `tbl_announcement` (`id`, `title`, `announcement`, `status`, `created_by`, `date_created`) VALUES
(1, 'New Announcement', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum feugiat, nisl sit amet eleifend tincidunt, erat arcu facilisis sem, at commodo arcu ex at dolor. In a ligula turpis. Vivamus in iaculis erat. Praesent ac porta sapien, eget finibus ex. Nam quis ultricies nisi. Nullam sed luctus nisl. Mauris quis urna leo.', 0, '', '2023-09-02 10:39:20'),
(3, 'Buwan ng Wika', 'sfsd fasdfadd afdsa sfsd fasdfadd afdsa sfsd fasdfadd afdsa sfsd fasdfadd afdsa sfsd fasdfadd afdsa sfsd fasdfadd afdsa sfsd fasdfadd afdsa sfsd fasdfadd afdsa ', 0, '', '2023-09-02 11:24:50'),
(8, 'Sample Announcement', 'Details...', 0, '', '2023-09-23 14:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enrollment`
--

CREATE TABLE `tbl_enrollment` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_drop` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_enrollment`
--

INSERT INTO `tbl_enrollment` (`id`, `academic_year_id`, `student_id`, `status`, `date_created`, `date_drop`) VALUES
(3, 4, 3, 'Enrolled', '2023-09-22 21:49:19', '2023-09-22 21:49:11'),
(4, 3, 1, 'Enrolled', '2023-09-23 14:14:57', '2023-09-23 14:14:44'),
(5, 4, 1, 'Enrolled', '2023-09-23 14:19:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grades`
--

CREATE TABLE `tbl_grades` (
  `id` int(11) NOT NULL,
  `stud_schedule_id` int(11) NOT NULL,
  `first` int(11) NOT NULL,
  `second` int(11) NOT NULL,
  `third` int(11) NOT NULL,
  `fourth` int(11) NOT NULL,
  `average` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_grades`
--

INSERT INTO `tbl_grades` (`id`, `stud_schedule_id`, `first`, `second`, `third`, `fourth`, `average`, `academic_year_id`, `date_created`) VALUES
(4, 9, 88, 88, 87, 87, 0, 0, '2023-09-23 01:16:03'),
(5, 10, 80, 86, 82, 80, 0, 0, '2023-09-23 01:21:16'),
(6, 11, 79, 78, 77, 79, 0, 0, '2023-09-23 01:21:16'),
(7, 12, 87, 85, 82, 82, 0, 0, '2023-09-23 01:21:16'),
(8, 13, 83, 82, 84, 88, 0, 0, '2023-09-23 13:25:41'),
(9, 14, 0, 0, 0, 0, 0, 0, '2023-09-23 13:25:41'),
(10, 15, 85, 88, 87, 90, 0, 0, '2023-09-23 14:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teaching_day` varchar(255) NOT NULL,
  `teaching_time` time NOT NULL,
  `schedule_code` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `teaching_time_to` time NOT NULL,
  `monday` tinyint(1) NOT NULL,
  `tuesday` tinyint(1) NOT NULL,
  `wednesday` tinyint(1) NOT NULL,
  `thursday` tinyint(1) NOT NULL,
  `friday` tinyint(1) NOT NULL,
  `saturday` tinyint(1) NOT NULL,
  `sunday` tinyint(1) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`id`, `teacher_id`, `subject_id`, `teaching_day`, `teaching_time`, `schedule_code`, `status`, `date_created`, `teaching_time_to`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `school_year`, `section`) VALUES
(1, 2, 13, '', '22:13:00', '', 0, '2023-09-22 22:13:25', '23:13:00', 1, 0, 1, 0, 1, 0, 0, 'Kinder', '1A'),
(2, 2, 5, '', '22:13:00', '', 0, '2023-09-22 22:13:39', '23:13:00', 0, 1, 1, 1, 0, 0, 0, 'Second Year', '1A'),
(3, 2, 14, '', '14:09:00', '', 0, '2023-09-23 14:10:14', '15:10:00', 1, 0, 1, 0, 1, 0, 0, 'Kinder', '1A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_schedule`
--

CREATE TABLE `tbl_student_schedule` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_student_schedule`
--

INSERT INTO `tbl_student_schedule` (`id`, `student_id`, `schedule_id`, `date_created`, `academic_year_id`, `teacher_id`) VALUES
(9, 1, 1, '2023-09-23 01:14:46', 4, 2),
(10, 1, 2, '2023-09-23 01:14:46', 4, 2),
(11, 3, 1, '2023-09-23 01:15:08', 4, 2),
(12, 3, 2, '2023-09-23 01:15:08', 4, 2),
(13, 1, 1, '2023-09-23 13:18:55', 3, 2),
(14, 1, 2, '2023-09-23 13:18:55', 3, 2),
(15, 1, 3, '2023-09-23 14:20:18', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `school_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`id`, `subject_name`, `subject_code`, `date_created`, `school_year`) VALUES
(5, 'Filipino 101', 'FIL101', '2023-07-22 22:53:58', ''),
(13, 'Mathematics 101', 'Math101', '2023-07-26 21:02:30', 'Grade 1'),
(14, 'Mathematics 200', 'Math102', '2023-07-26 21:03:58', 'Grade 2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `birthdate` datetime NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `profile_picture` longtext NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = active, 1= inactive',
  `date_created` datetime NOT NULL,
  `student_status` varchar(255) NOT NULL,
  `enrollment_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created`, `student_status`, `enrollment_status`) VALUES
(1, 'STDNT001', 'John', 'D', 'Doe', '', 'Male', 'a@gmail.com', '09123456789', '', '2023-09-18 00:00:00', '0215', '021518', '021518016', '', 'Kinder', '1A', '', '', '1234', 'student', 0, '2023-09-22 21:19:56', 'New', 'Not Enrolled'),
(2, 'TCHR001', 'Blake', 'R', 'Griffin', '', 'Male', 'abc@gmail.com', '09123456789', '', '2023-09-15 00:00:00', '0215', '021519', '021519018', '', 'Kinder', '1A', '', '', '1234', 'teacher', 0, '2023-09-22 21:20:38', '', ''),
(3, 'STDNT002', 'Portgas', 'D', 'Ace', '', 'Male', 'ace@gmail.com', '09123456789', '', '2023-09-29 00:00:00', '1013', '101316', '101316017', '', 'Kinder', '1', '', '', '1234', 'student', 0, '2023-09-22 21:36:38', 'Transferee', 'Not Enrolled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_academic_year`
--
ALTER TABLE `tbl_academic_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_enrollment`
--
ALTER TABLE `tbl_enrollment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_grades`
--
ALTER TABLE `tbl_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student_schedule`
--
ALTER TABLE `tbl_student_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_academic_year`
--
ALTER TABLE `tbl_academic_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_enrollment`
--
ALTER TABLE `tbl_enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_grades`
--
ALTER TABLE `tbl_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_student_schedule`
--
ALTER TABLE `tbl_student_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
