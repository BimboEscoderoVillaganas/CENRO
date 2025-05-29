-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 07:41 AM
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
-- Database: `cenro_records_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabinet_tbl`
--

CREATE TABLE `cabinet_tbl` (
  `cabinet_number` int(11) NOT NULL,
  `cabinet_code` varchar(50) DEFAULT NULL,
  `cabinet_location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabinet_tbl`
--

INSERT INTO `cabinet_tbl` (`cabinet_number`, `cabinet_code`, `cabinet_location`) VALUES
(20, '001', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `document_tbl`
--

CREATE TABLE `document_tbl` (
  `document_id` int(11) NOT NULL,
  `document_number` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `approving_authority` varchar(100) DEFAULT NULL,
  `document_type` varchar(50) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `filed_by` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `retention_schedule` varchar(100) DEFAULT NULL,
  `access_level` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `deleted` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_tbl`
--

INSERT INTO `document_tbl` (`document_id`, `document_number`, `description`, `approving_authority`, `document_type`, `date_created`, `filed_by`, `location`, `retention_schedule`, `access_level`, `remarks`, `status`, `deleted`) VALUES
(5, 0, 'dvfbgn h', 'fs', 's', '2025-05-20', 'asd', '20', 'sdfv', 'Confidential', 'dgnhm', 'Active', 'Yes'),
(6, 0, 'sample', 'fs', 's', '2025-05-20', 'asd', '20', 'sdfv', 'Confidential', 'sample', 'Active', ''),
(7, 12, 'as', 'fs', 's', '2025-05-20', 'asd', '20', '2', 'Public', 'as', 'Active', ''),
(8, 0, 'erf', 'fs', 's', '2025-05-20', 'asd', '20', 'sdfv', 'Public', 'er', 'Active', 'no'),
(9, 0, 'sample 4', 'sample 4', 'sample 4', '2025-05-29', 'sample 4', '20', '2025-05-30', 'Public', 'sample 4', NULL, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `file_tbl`
--

CREATE TABLE `file_tbl` (
  `file_number` int(11) NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_tbl`
--

INSERT INTO `file_tbl` (`file_number`, `document_id`, `file_name`, `date_added`) VALUES
(3, 9, '6837b1280017a_PATIENTINFOSHEET.docx', '2025-05-29'),
(4, 9, '6837b12800779_701802.jpg', '2025-05-29'),
(5, 9, '6837b12800d6b_reap-form-annotated.pdf', '2025-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  `logout_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`log_id`, `user_id`, `user_name`, `login_date`, `logout_date`) VALUES
(156, 2, 'admin Bimbo', '2024-10-05 11:36:10', '2024-10-05 17:36:33'),
(157, 2, 'admin Bimbo', '2024-10-05 11:36:49', '2024-10-05 23:20:03'),
(159, 2, 'admin Bimbo', '2024-10-05 17:28:37', '2024-10-05 23:32:50'),
(160, 2, 'admin Bimbo', '2024-10-05 17:33:01', NULL),
(161, 2, 'admin Bimbo', '2024-10-05 17:33:18', '2024-10-05 23:33:46'),
(162, 2, 'admin Bimbo', '2024-10-05 17:33:55', NULL),
(163, 2, 'admin Bimbo', '2024-10-06 12:12:06', '2024-10-06 18:27:24'),
(165, 2, 'admin Bimbo', '2024-10-06 12:28:27', NULL),
(166, 2, 'admin Bimbo', '2024-10-08 03:59:13', '2024-10-08 11:54:45'),
(168, 2, 'admin Bimbo', '2024-10-08 05:56:58', NULL),
(171, 2, 'admin Bimbo', '2024-10-08 14:17:56', '2024-10-08 20:18:03'),
(179, 2, 'admin Bimbo', '2024-10-08 15:30:56', NULL),
(181, 51, 'user', '2024-10-08 15:34:31', NULL),
(188, 2, 'admin Bimbo', '2024-10-10 07:11:25', NULL),
(189, 2, 'admin Bimbo', '2024-10-12 08:47:59', '2024-10-12 16:34:49'),
(190, 2, 'admin Bimbo', '2024-10-12 10:35:01', NULL),
(191, 2, 'admin Bimbo', '2024-10-12 10:36:35', NULL),
(192, 2, 'admin Bimbo', '2024-10-13 14:32:00', '2024-10-14 00:12:45'),
(195, 2, 'admin Bimbo', '2024-10-13 17:53:29', '2024-10-14 00:01:23'),
(197, 2, 'admin Bimbo', '2024-10-13 18:12:48', '2024-10-14 03:19:11'),
(199, 2, 'admin Bimbo', '2024-10-13 21:22:33', '2024-10-14 03:23:32'),
(205, 2, 'admin Bimbo', '2024-10-14 01:19:28', NULL),
(208, 2, 'admin Bimbo', '2024-10-14 02:59:31', '2024-10-14 09:01:40'),
(209, 51, 'user', '2024-10-14 03:00:04', '2024-10-14 09:00:57'),
(210, 51, 'user', '2024-10-14 03:01:05', NULL),
(212, 51, 'user', '2024-10-14 03:03:24', '2024-10-14 09:04:48'),
(213, 2, 'admin Bimbo', '2024-10-14 03:04:06', NULL),
(214, 51, 'user', '2024-10-14 03:04:55', NULL),
(215, 2, 'admin Bimbo', '2024-10-14 14:26:48', NULL),
(216, 2, 'admin Bimbo', '2024-10-14 15:30:50', NULL),
(217, 2, 'admin Bimbo', '2024-10-15 02:19:01', '2024-10-15 11:40:23'),
(218, 2, 'admin Bimbo', '2024-10-15 02:36:48', '2024-10-15 09:05:10'),
(222, 2, 'admin Bimbo', '2024-10-15 05:54:22', '2024-10-15 12:05:20'),
(227, 2, 'admin Bimbo', '2024-10-15 06:14:14', '2024-10-15 12:14:19'),
(228, 51, 'user', '2024-10-15 06:14:25', NULL),
(229, 51, 'user', '2024-10-15 06:16:54', '2024-10-15 12:17:30'),
(231, 2, 'admin Bimbo', '2024-10-16 08:22:57', NULL),
(232, 2, 'admin Bimbo', '2024-10-17 15:03:08', NULL),
(233, 2, 'admin Bimbo', '2024-10-17 15:37:35', '2024-10-17 22:17:44'),
(240, 2, 'admin Bimbo', '2024-10-18 07:24:40', NULL),
(245, 2, 'admin Bimbo', '2024-10-23 04:46:00', NULL),
(246, 2, 'admin Bimbo', '2024-10-23 06:38:41', NULL),
(247, 2, 'admin Bimbo', '2024-10-23 09:21:02', NULL),
(248, 2, 'admin Bimbo', '2024-10-23 09:21:41', '2024-10-23 21:45:19'),
(252, 2, 'admin Bimbo', '2024-10-23 16:26:27', '2024-10-23 22:27:13'),
(256, 2, 'admin Bimbo', '2024-10-24 08:51:35', NULL),
(257, 2, 'admin Bimbo', '2024-10-24 08:51:35', NULL),
(258, 2, 'admin Bimbo', '2024-10-25 09:14:33', NULL),
(259, 2, 'admin Bimbo', '2024-10-27 07:12:03', '2024-10-27 14:14:29'),
(260, 2, 'admin Bimbo', '2024-10-27 07:23:25', '2024-10-27 14:23:59'),
(261, 2, 'admin Bimbo', '2024-10-27 07:24:40', NULL),
(262, 2, 'admin Bimbo', '2024-10-27 12:21:37', NULL),
(263, 2, 'admin Bimbo', '2024-11-01 15:04:02', NULL),
(265, 2, 'admin Bimbo', '2024-11-01 15:58:09', '2024-11-01 23:43:25'),
(267, 2, 'admin Bimbo', '2024-11-04 06:51:25', '2024-11-04 13:59:28'),
(273, 2, 'admin Bimbo', '2024-11-04 20:21:33', NULL),
(275, 2, 'admin Bimbo', '2024-11-04 21:20:25', '2024-11-05 04:29:07'),
(281, 2, 'admin Bimbo', '2024-11-04 21:57:57', NULL),
(283, 2, 'admin Bimbo', '2024-11-05 01:25:37', '2024-11-05 08:39:47'),
(286, 2, 'admin Bimbo', '2024-11-05 02:37:28', '2024-11-05 10:04:43'),
(292, 2, 'admin Bimbo', '2024-11-05 03:17:11', NULL),
(293, 2, 'admin Bimbo', '2024-11-05 03:26:41', NULL),
(295, 2, 'admin Bimbo', '2024-11-05 07:03:31', '2024-11-05 14:12:42'),
(298, 2, 'admin Bimbo', '2024-11-08 07:21:40', NULL),
(299, 2, 'admin Bimbo', '2024-11-09 11:56:25', NULL),
(300, 2, 'admin Bimbo', '2024-11-13 15:16:09', NULL),
(301, 2, 'admin Bimbo', '2024-11-13 15:38:01', NULL),
(302, 2, 'admin Bimbo', '2024-11-13 22:42:33', '2024-11-14 06:21:14'),
(304, 2, 'admin Bimbo', '2024-11-14 00:28:30', '2024-11-14 07:31:00'),
(306, 2, 'admin Bimbo', '2024-11-13 20:50:21', NULL),
(307, 2, 'admin Bimbo', '2024-11-13 21:53:17', '2024-11-13 19:21:54'),
(310, 2, 'admin Bimbo', '2024-11-13 23:18:24', NULL),
(311, 2, 'admin Bimbo', '2024-11-13 23:34:55', NULL),
(312, 2, 'admin Bimbo', '2024-11-14 04:28:16', '2024-11-14 02:30:27'),
(313, 2, 'admin Bimbo', '2024-11-14 09:00:17', '2024-11-14 06:03:53'),
(315, 2, 'admin Bimbo', '2024-11-14 10:23:26', '2024-11-15 00:54:25'),
(317, 2, 'admin Bimbo', '2024-11-14 22:15:51', NULL),
(318, 2, 'admin Bimbo', '2024-11-14 23:08:49', '2024-11-15 06:10:14'),
(320, 2, 'admin Bimbo', '2024-11-15 01:46:04', '2024-11-15 09:27:28'),
(325, 2, 'admin Bimbo', '2024-11-15 02:33:03', '2024-11-15 09:33:23'),
(327, 2, 'admin Bimbo', '2024-11-15 02:41:57', '2024-11-15 10:04:02'),
(328, 2, 'admin Bimbo', '2024-11-15 03:04:54', NULL),
(329, 2, 'admin Bimbo', '2024-11-22 08:22:41', '2024-11-22 15:35:48'),
(331, 2, 'admin Bimbo', '2024-11-22 08:55:17', NULL),
(332, 51, 'user', '2024-11-22 09:15:11', '2024-11-22 16:15:20'),
(341, 2, NULL, '2024-11-22 20:47:29', '2024-11-23 03:47:33'),
(348, 2, 'admin Bimbo', '2024-11-24 18:17:24', NULL),
(350, 51, 'user', '2024-11-24 18:20:54', '2024-11-25 01:22:17'),
(353, 51, 'user', '2024-11-24 18:26:26', NULL),
(354, 2, 'admin Bimbo', '2024-11-24 19:12:36', NULL),
(357, 2, 'admin Bimbo', '2025-05-16 03:07:01', '2025-05-16 09:26:58'),
(358, 2, 'admin Bimbo', '2025-05-16 03:37:01', NULL),
(359, 2, 'admin Bimbo', '2025-05-16 03:44:17', NULL),
(360, 2, 'admin Bimbo', '2025-05-16 04:31:17', NULL),
(362, 2, 'admin Bimbo', '2025-05-16 07:00:10', '2025-05-16 13:49:27'),
(365, 2, 'admin Bimbo', '2025-05-16 08:14:44', NULL),
(367, 2, 'admin Bimbo', '2025-05-16 08:31:27', '2025-05-16 14:36:21'),
(368, 2, 'admin Bimbo', '2025-05-16 08:36:36', NULL),
(369, 2, 'admin Bimbo', '2025-05-16 09:15:24', '2025-05-16 15:24:11'),
(370, 2, 'admin Bimbo', '2025-05-19 07:03:56', NULL),
(371, 2, 'admin Bimbo', '2025-05-20 02:38:04', NULL),
(372, 2, 'admin Bimbo', '2025-05-20 03:41:27', NULL),
(373, 2, 'admin Bimbo', '2025-05-29 02:28:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `id_number` int(12) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `district` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `id_number`, `user_name`, `email`, `phone_number`, `pass`, `district`, `user_type`, `status`) VALUES
(2, 20201259, 'admin Bimbo', 'admin@gmail.com', '0556282485', '$2y$10$TWyAZbbDQcms2lAoXPvqzOsotVJHvS/Cc9Ef5gi1MxrnXIhMqEHQm', '1', 'supervisor', ''),
(51, 20201259, 'user', 'user@gmail.com', '09123456789', '$2y$10$t5s1OamaFxb/lfKweuNyQeNYAUo/GOXgxDapPsMdj2LNqFv3ZMa22', 'District 4', 'Implementer', 'enable'),
(53, 20201259, 'admin Bimbo', 'bimbo@gmail.com', '09999999999', '$2y$10$zF0Odp6OP26PXE.jzDHqdOJ625TNUjWS72yk8gXrlvaqvxFPgTK7W', 'District 1', 'Supervisor', ''),
(74, 20201259, 'ako', 'bimbo@gmail.com', '09999999999', '$2y$10$kqy6y5pXXkPVkrcd6GKaOu6R9oUE2duy1xQNPCvLsYmgUWoaEmGLm', 'District 4', 'Volunteer', ''),
(75, 20201259, 'ako', 'villaganasbimbo123@gmail.com', '09123456789', '$2y$10$pknYoNr90SkUH0roWZ7VJ.sGDVdNbvU1WuEe9v3AguRIEztyEbg4C', 'District 1', 'Volunteer', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabinet_tbl`
--
ALTER TABLE `cabinet_tbl`
  ADD PRIMARY KEY (`cabinet_number`);

--
-- Indexes for table `document_tbl`
--
ALTER TABLE `document_tbl`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `document_number` (`document_number`);

--
-- Indexes for table `file_tbl`
--
ALTER TABLE `file_tbl`
  ADD PRIMARY KEY (`file_number`),
  ADD KEY `document_id` (`document_id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabinet_tbl`
--
ALTER TABLE `cabinet_tbl`
  MODIFY `cabinet_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `document_tbl`
--
ALTER TABLE `document_tbl`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `file_tbl`
--
ALTER TABLE `file_tbl`
  MODIFY `file_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file_tbl`
--
ALTER TABLE `file_tbl`
  ADD CONSTRAINT `file_tbl_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `document_tbl` (`document_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `user_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
