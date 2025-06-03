-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 08:07 AM
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
-- Database: `cenro_records`
--

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
(176, 42, 'teacher', '2024-10-08 15:23:01', '2024-10-08 21:25:51'),
(177, 42, 'teacher', '2024-10-08 15:26:03', NULL),
(178, 42, 'teacher', '2024-10-08 15:26:48', '2024-10-08 21:32:26'),
(179, 2, 'admin Bimbo', '2024-10-08 15:30:56', NULL),
(181, 51, 'user', '2024-10-08 15:34:31', NULL),
(187, 42, 'teacher', '2024-10-09 00:40:14', NULL),
(188, 2, 'admin Bimbo', '2024-10-10 07:11:25', NULL),
(189, 2, 'admin Bimbo', '2024-10-12 08:47:59', '2024-10-12 16:34:49'),
(190, 2, 'admin Bimbo', '2024-10-12 10:35:01', NULL),
(191, 2, 'admin Bimbo', '2024-10-12 10:36:35', NULL),
(192, 2, 'admin Bimbo', '2024-10-13 14:32:00', '2024-10-14 00:12:45'),
(193, 54, 'head', '2024-10-13 17:45:11', '2024-10-13 23:51:25'),
(194, 54, 'head', '2024-10-13 17:51:35', '2024-10-13 23:53:16'),
(195, 2, 'admin Bimbo', '2024-10-13 17:53:29', '2024-10-14 00:01:23'),
(196, 54, 'head', '2024-10-13 18:01:31', NULL),
(197, 2, 'admin Bimbo', '2024-10-13 18:12:48', '2024-10-14 03:19:11'),
(198, 54, 'head', '2024-10-13 21:19:16', '2024-10-14 03:22:30'),
(199, 2, 'admin Bimbo', '2024-10-13 21:22:33', '2024-10-14 03:23:32'),
(200, 54, 'head', '2024-10-13 21:23:35', '2024-10-14 03:43:19'),
(201, 54, 'head', '2024-10-13 21:43:23', NULL),
(202, 54, 'head', '2024-10-14 01:18:05', NULL),
(203, 42, 'teacher', '2024-10-14 01:18:44', '2024-10-14 07:18:50'),
(204, 54, 'head', '2024-10-14 01:18:54', '2024-10-14 07:19:18'),
(205, 2, 'admin Bimbo', '2024-10-14 01:19:28', NULL),
(206, 54, 'head', '2024-10-14 01:31:07', '2024-10-14 08:59:26'),
(207, 54, 'head', '2024-10-14 01:42:28', '2024-10-14 08:58:14'),
(208, 2, 'admin Bimbo', '2024-10-14 02:59:31', '2024-10-14 09:01:40'),
(209, 51, 'user', '2024-10-14 03:00:04', '2024-10-14 09:00:57'),
(210, 51, 'user', '2024-10-14 03:01:05', NULL),
(211, 54, 'head', '2024-10-14 03:01:46', NULL),
(212, 51, 'user', '2024-10-14 03:03:24', '2024-10-14 09:04:48'),
(213, 2, 'admin Bimbo', '2024-10-14 03:04:06', NULL),
(214, 51, 'user', '2024-10-14 03:04:55', NULL),
(215, 2, 'admin Bimbo', '2024-10-14 14:26:48', NULL),
(216, 2, 'admin Bimbo', '2024-10-14 15:30:50', NULL),
(217, 2, 'admin Bimbo', '2024-10-15 02:19:01', '2024-10-15 11:40:23'),
(218, 2, 'admin Bimbo', '2024-10-15 02:36:48', '2024-10-15 09:05:10'),
(219, 54, 'head', '2024-10-15 03:05:30', '2024-10-15 09:05:48'),
(220, 54, 'head', '2024-10-15 03:05:56', '2024-10-15 12:04:14'),
(221, 54, 'head', '2024-10-15 05:40:29', '2024-10-15 11:54:19'),
(222, 2, 'admin Bimbo', '2024-10-15 05:54:22', '2024-10-15 12:05:20'),
(223, 54, 'head', '2024-10-15 06:04:22', NULL),
(224, 54, 'head', '2024-10-15 06:05:25', '2024-10-15 12:08:55'),
(225, 54, 'head', '2024-10-15 06:09:02', '2024-10-15 12:11:32'),
(226, 54, 'head', '2024-10-15 06:11:38', '2024-10-15 12:14:10'),
(227, 2, 'admin Bimbo', '2024-10-15 06:14:14', '2024-10-15 12:14:19'),
(228, 51, 'user', '2024-10-15 06:14:25', NULL),
(229, 51, 'user', '2024-10-15 06:16:54', '2024-10-15 12:17:30'),
(230, 54, 'head', '2024-10-15 06:17:53', NULL),
(231, 2, 'admin Bimbo', '2024-10-16 08:22:57', NULL),
(232, 2, 'admin Bimbo', '2024-10-17 15:03:08', NULL),
(233, 2, 'admin Bimbo', '2024-10-17 15:37:35', '2024-10-17 22:17:44'),
(234, 54, 'head', '2024-10-17 16:17:52', '2024-10-17 22:18:24'),
(235, 54, 'head', '2024-10-17 16:18:37', '2024-10-17 22:21:12'),
(237, 54, 'head', '2024-10-18 06:41:54', '2024-10-18 12:42:56'),
(240, 2, 'admin Bimbo', '2024-10-18 07:24:40', NULL),
(242, 42, 'teacher', '2024-10-18 09:31:09', '2024-10-18 15:39:06'),
(244, 42, 'teacher', '2024-10-18 09:58:02', '2024-10-18 16:52:21'),
(245, 2, 'admin Bimbo', '2024-10-23 04:46:00', NULL),
(246, 2, 'admin Bimbo', '2024-10-23 06:38:41', NULL),
(247, 2, 'admin Bimbo', '2024-10-23 09:21:02', NULL),
(248, 2, 'admin Bimbo', '2024-10-23 09:21:41', '2024-10-23 21:45:19'),
(249, 54, 'head', '2024-10-23 15:45:26', '2024-10-23 21:48:42'),
(250, 42, 'teacher', '2024-10-23 15:48:50', '2024-10-23 22:07:55'),
(251, 42, 'teacher', '2024-10-23 16:08:03', '2024-10-23 22:26:15'),
(252, 2, 'admin Bimbo', '2024-10-23 16:26:27', '2024-10-23 22:27:13'),
(253, 54, 'head', '2024-10-23 16:27:20', '2024-10-23 22:29:08'),
(254, 42, 'teacher', '2024-10-23 16:29:18', NULL),
(255, 42, 'teacher', '2024-10-24 08:46:00', '2024-10-24 14:51:21'),
(256, 2, 'admin Bimbo', '2024-10-24 08:51:35', NULL),
(257, 2, 'admin Bimbo', '2024-10-24 08:51:35', NULL),
(258, 2, 'admin Bimbo', '2024-10-25 09:14:33', NULL),
(259, 2, 'admin Bimbo', '2024-10-27 07:12:03', '2024-10-27 14:14:29'),
(260, 2, 'admin Bimbo', '2024-10-27 07:23:25', '2024-10-27 14:23:59'),
(261, 2, 'admin Bimbo', '2024-10-27 07:24:40', NULL),
(262, 2, 'admin Bimbo', '2024-10-27 12:21:37', NULL),
(263, 2, 'admin Bimbo', '2024-11-01 15:04:02', NULL),
(264, 54, 'head', '2024-11-01 15:17:09', '2024-11-01 22:58:04'),
(265, 2, 'admin Bimbo', '2024-11-01 15:58:09', '2024-11-01 23:43:25'),
(266, 54, 'head', '2024-11-01 16:43:32', NULL),
(267, 2, 'admin Bimbo', '2024-11-04 06:51:25', '2024-11-04 13:59:28'),
(268, 42, 'teacher', '2024-11-04 06:59:46', NULL),
(269, 42, 'teacher', '2024-11-04 14:48:24', NULL),
(270, 42, 'teacher', '2024-11-04 17:59:42', '2024-11-05 04:20:18'),
(271, 42, 'teacher', '2024-11-04 19:39:49', '2024-11-05 03:06:33'),
(272, 54, 'head', '2024-11-04 20:06:43', '2024-11-05 03:21:03'),
(273, 2, 'admin Bimbo', '2024-11-04 20:21:33', NULL),
(274, 54, 'head', '2024-11-04 20:32:28', NULL),
(275, 2, 'admin Bimbo', '2024-11-04 21:20:25', '2024-11-05 04:29:07'),
(276, 54, 'head', '2024-11-04 21:29:14', '2024-11-05 04:29:59'),
(277, 54, 'head', '2024-11-04 21:30:27', '2024-11-05 04:30:56'),
(278, 54, 'head', '2024-11-04 21:33:07', '2024-11-05 04:33:43'),
(280, 54, 'head', '2024-11-04 21:41:56', '2024-11-05 04:57:52'),
(281, 2, 'admin Bimbo', '2024-11-04 21:57:57', NULL),
(282, 54, 'head', '2024-11-04 21:59:44', NULL),
(283, 2, 'admin Bimbo', '2024-11-05 01:25:37', '2024-11-05 08:39:47'),
(284, 54, 'head', '2024-11-05 01:39:59', '2024-11-05 09:04:08'),
(285, 42, 'teacher', '2024-11-05 02:04:22', NULL),
(286, 2, 'admin Bimbo', '2024-11-05 02:37:28', '2024-11-05 10:04:43'),
(287, 42, 'teacher', '2024-11-05 03:05:17', '2024-11-05 10:08:11'),
(288, 42, 'Teacher', '2024-11-05 03:08:33', '2024-11-05 10:10:17'),
(289, 54, 'head', '2024-11-05 03:10:34', '2024-11-05 10:13:23'),
(290, 66, 'BIMBO', '2024-11-05 03:13:45', '2024-11-05 10:14:35'),
(291, 54, 'head', '2024-11-05 03:16:28', '2024-11-05 10:26:23'),
(292, 2, 'admin Bimbo', '2024-11-05 03:17:11', NULL),
(293, 2, 'admin Bimbo', '2024-11-05 03:26:41', NULL),
(294, 54, 'head', '2024-11-05 04:59:09', NULL),
(295, 2, 'admin Bimbo', '2024-11-05 07:03:31', '2024-11-05 14:12:42'),
(296, 54, 'head', '2024-11-05 07:13:34', '2024-11-05 14:14:48'),
(297, 42, 'Teacher', '2024-11-05 07:15:24', NULL),
(298, 2, 'admin Bimbo', '2024-11-08 07:21:40', NULL),
(299, 2, 'admin Bimbo', '2024-11-09 11:56:25', NULL),
(300, 2, 'admin Bimbo', '2024-11-13 15:16:09', NULL),
(301, 2, 'admin Bimbo', '2024-11-13 15:38:01', NULL),
(302, 2, 'admin Bimbo', '2024-11-13 22:42:33', '2024-11-14 06:21:14'),
(303, 54, 'head', '2024-11-13 23:21:25', '2024-11-14 07:27:31'),
(304, 2, 'admin Bimbo', '2024-11-14 00:28:30', '2024-11-14 07:31:00'),
(305, 79, 'Jessa', '2024-11-14 00:34:24', NULL),
(306, 2, 'admin Bimbo', '2024-11-13 20:50:21', NULL),
(307, 2, 'admin Bimbo', '2024-11-13 21:53:17', '2024-11-13 19:21:54'),
(308, 80, 'Jaylah Binayao', '2024-11-13 22:18:37', '2024-11-13 20:34:02'),
(309, 81, 'Evelyn Secuya', '2024-11-13 22:22:14', NULL),
(310, 2, 'admin Bimbo', '2024-11-13 23:18:24', NULL),
(311, 2, 'admin Bimbo', '2024-11-13 23:34:55', NULL),
(312, 2, 'admin Bimbo', '2024-11-14 04:28:16', '2024-11-14 02:30:27'),
(313, 2, 'admin Bimbo', '2024-11-14 09:00:17', '2024-11-14 06:03:53'),
(314, 82, 'lalay', '2024-11-14 09:04:48', '2024-11-14 07:22:57'),
(315, 2, 'admin Bimbo', '2024-11-14 10:23:26', '2024-11-15 00:54:25'),
(316, 54, 'head', '2024-11-14 17:54:32', NULL),
(317, 2, 'admin Bimbo', '2024-11-14 22:15:51', NULL),
(318, 2, 'admin Bimbo', '2024-11-14 23:08:49', '2024-11-15 06:10:14'),
(319, 79, 'Jessa', '2024-11-14 23:11:40', NULL),
(320, 2, 'admin Bimbo', '2024-11-15 01:46:04', '2024-11-15 09:27:28'),
(321, 54, 'head', '2024-11-15 01:49:59', '2024-11-15 08:50:14'),
(322, 54, 'head', '2024-11-15 01:52:41', '2024-11-15 08:53:17'),
(323, 54, 'head', '2024-11-15 01:53:27', NULL),
(324, 54, 'head', '2024-11-15 02:27:54', '2024-11-15 09:31:42'),
(325, 2, 'admin Bimbo', '2024-11-15 02:33:03', '2024-11-15 09:33:23'),
(326, 79, 'Jessa', '2024-11-15 02:33:30', '2024-11-15 09:38:38'),
(327, 2, 'admin Bimbo', '2024-11-15 02:41:57', '2024-11-15 10:04:02'),
(328, 2, 'admin Bimbo', '2024-11-15 03:04:54', NULL),
(329, 2, 'admin Bimbo', '2024-11-22 08:22:41', '2024-11-22 15:35:48'),
(330, 54, 'head', '2024-11-22 08:35:54', '2024-11-23 03:44:57'),
(331, 2, 'admin Bimbo', '2024-11-22 08:55:17', NULL),
(332, 51, 'user', '2024-11-22 09:15:11', '2024-11-22 16:15:20'),
(333, 79, 'Jessa', '2024-11-22 09:17:28', NULL),
(334, 79, 'Jessa', '2024-11-22 10:17:50', NULL),
(335, 79, NULL, '2024-11-22 20:45:08', NULL),
(336, 79, NULL, '2024-11-22 20:45:19', NULL),
(337, 79, NULL, '2024-11-22 20:45:45', NULL),
(338, 79, NULL, '2024-11-22 20:46:29', NULL),
(339, 79, NULL, '2024-11-22 20:46:57', NULL),
(340, 79, NULL, '2024-11-22 20:47:14', NULL),
(341, 2, NULL, '2024-11-22 20:47:29', '2024-11-23 03:47:33'),
(342, 79, NULL, '2024-11-22 20:48:04', NULL),
(343, 54, NULL, '2024-11-22 21:44:25', NULL),
(344, 79, NULL, '2024-11-22 21:53:06', NULL),
(345, 79, 'Jessa', '2024-11-22 21:53:48', NULL),
(346, 79, 'Jessa', '2024-11-24 17:20:42', '2024-11-25 02:24:10'),
(347, 54, 'head', '2024-11-24 17:24:05', '2024-11-25 02:12:31'),
(348, 2, 'admin Bimbo', '2024-11-24 18:17:24', NULL),
(349, 42, 'Teacher', '2024-11-24 18:18:28', '2024-11-25 01:20:46'),
(350, 51, 'user', '2024-11-24 18:20:54', '2024-11-25 01:22:17'),
(351, 61, 'coordinator', '2024-11-24 18:23:31', '2024-11-25 01:23:40'),
(352, 82, 'lalay', '2024-11-24 18:25:08', '2024-11-25 01:26:13'),
(353, 51, 'user', '2024-11-24 18:26:26', NULL),
(354, 2, 'admin Bimbo', '2024-11-24 19:12:36', NULL),
(355, 54, 'head', '2024-11-24 19:24:17', NULL),
(356, 79, 'Jessa', '2024-11-24 19:29:41', NULL),
(357, 2, 'admin Bimbo', '2025-05-16 03:07:01', '2025-05-16 09:26:58'),
(358, 2, 'admin Bimbo', '2025-05-16 03:37:01', NULL),
(359, 2, 'admin Bimbo', '2025-05-16 03:44:17', NULL),
(360, 2, 'admin Bimbo', '2025-05-16 04:31:17', NULL),
(361, 79, 'Jessa', '2025-05-16 06:59:21', '2025-05-16 13:00:01'),
(362, 2, 'admin Bimbo', '2025-05-16 07:00:10', '2025-05-16 13:49:27'),
(363, 79, 'Jessa', '2025-05-16 07:49:29', NULL);

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
(42, 20201259, 'Teacher', 'teacher@gmail.com', '0', '$2y$10$fSy0.UXmf0caJjNZT2I/MOj4yWApbWGuGFYu986fDvNFAsnQFLucm', 'District 2', 'Implementer', 'enable'),
(51, 20201259, 'user', 'user@gmail.com', '09123456789', '$2y$10$t5s1OamaFxb/lfKweuNyQeNYAUo/GOXgxDapPsMdj2LNqFv3ZMa22', 'District 4', 'Implementer', 'enable'),
(53, 20201259, 'admin Bimbo', 'bimbo@gmail.com', '09999999999', '$2y$10$zF0Odp6OP26PXE.jzDHqdOJ625TNUjWS72yk8gXrlvaqvxFPgTK7W', 'District 1', 'Supervisor', ''),
(54, 20201259, 'head', 'head@gmail.com', '09999999999', '$2y$10$GSs8oNclWUeOBJ7iWWEw0ud..gK280MMpebi7WFt.uwdrrv.7PneO', 'District 4', 'Coordinator', ''),
(61, 20201259, 'coordinator', 'villaganasbimbo123@gmail.com', '09123456789', '$2y$10$GFq61ulnZjNdHtz2GHft5eaUVc1cA2XpmCpmmzrD.MhMsYUeyYVOG', 'District 4', 'Coordinator', ''),
(66, 20201259, 'BIMBO', 'villaganasbimbo123@gmail.com', '09123456789', '$2y$10$KYj4K3Jp5Dzr.hDV0ROoS.HRL4g7xP9jWuyxncqYLWG884Fz0UjOm', 'District 1', 'Coordinator', ''),
(74, 20201259, 'ako', 'bimbo@gmail.com', '09999999999', '$2y$10$kqy6y5pXXkPVkrcd6GKaOu6R9oUE2duy1xQNPCvLsYmgUWoaEmGLm', 'District 4', 'Volunteer', ''),
(75, 20201259, 'ako', 'villaganasbimbo123@gmail.com', '09123456789', '$2y$10$pknYoNr90SkUH0roWZ7VJ.sGDVdNbvU1WuEe9v3AguRIEztyEbg4C', 'District 1', 'Volunteer', ''),
(78, 20201259, 'BIMBO', 'villaganasbimbo123@gmail.com', '09123456789', '$2y$10$6x21rbpXSzLYCKwk31fdeus9feHrQsKnYwGBG73bkmaSiLtO3yW2G', 'District 1', 'Implementer', 'enable'),
(79, 20211629, 'Jessa', '20211629@nbsc.edu.ph', '09350147772', '$2y$10$m1dqhzG9R9kEVlG9Fk2gIe5Ood.L7UE.HrRxduvAcKBERA5Dbj0ma', 'District 4', 'Implementer', 'enable'),
(80, 20201299, 'Jaylah Binayao', 'jaylahbinayao@gmail.com', '09658517377', '$2y$10$WfJtETOOW3MfdHmYpGrM0e2DAKrUNXMSvSctsDpz4RhJPnGcNYuj.', 'District 1', 'Implementer', 'enable'),
(81, 20211476, 'Evelyn Secuya', 'secuyaevelyn@gmail.com', '09262377595', '$2y$10$W2u8KCGP4nx3uLLG85SrTOV8uUrKRhoO7xzORjlwOwiMNMQvbdH7q', 'District 3', 'Implementer', ''),
(82, 20211629, 'lalay', 'abarquezjessa34@gmail.com', '09350147772', '$2y$10$L2btX6JseZVXqmYHXDgGLeEJMPpVdtwU.9OPtCJn7y1qJlgnb9k5K', 'District 3', 'Implementer', ''),
(83, 20211629, 'lalay', 'abarquezjessa34@gmail.com', '09350147772', '$2y$10$lGoT9hi.Y1nA2S.8CGkyJesvkF8iZ0rah6YqfScNkiAIVqQr/xnxG', 'District 3', 'Implementer', ''),
(84, 20211629, 'lalay', 'abarquezjessa34@gmail.com', '09350147772', '$2y$10$GM66j0v.sdH3s9uVnPOLk.PwAQRzSUN89oz6DDJSOicW09nAVf1Ye', 'District 3', 'Implementer', ''),
(85, 20201299, 'Jessa Bakang', '20201299@gmail.com', '09658517377', '$2y$10$l0dnPNcrfsTjpu2so6tWSuLsenh.geQHOuP937ddcFjE6wkGj/dF2', 'District 1', 'Implementer', '');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `user_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
