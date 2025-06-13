
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `cabinet_tbl` (
  `cabinet_number` int(11) NOT NULL,
  `cabinet_code` varchar(50) DEFAULT NULL,
  `cabinet_location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cabinet_tbl` (`cabinet_number`, `cabinet_code`, `cabinet_location`) VALUES
(20, '001', 'A'),
(21, '002', 'A');

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



CREATE TABLE `document_type` (
  `document_type_id` int(11) NOT NULL,
  `document_type` varchar(100) NOT NULL,
  `shelf_life` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_type`
--

INSERT INTO `document_type` (`document_type_id`, `document_type`, `shelf_life`) VALUES
(4, 'CERTIFICATIONS', '1'),
(6, 'CHARTS', 'PERMANENT'),
(7, 'DELIVERY RECEIPTS', '2'),
(8, 'GATE PASS', '1'),
(9, 'INQUIRIES', '2'),
(10, 'LISTS', '1'),
(11, 'CORRESPONDENCES', '2');

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

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `user_name`, `email`, `phone_number`, `pass`, `user_type`, `status`) VALUES
(2, 'admin Bimbo', 'admin@gmail.com', '0556282485', '$2y$10$TWyAZbbDQcms2lAoXPvqzOsotVJHvS/Cc9Ef5gi1MxrnXIhMqEHQm', 'superadmin', ''),
(51, 'user', 'user@gmail.com', '09123456789', '$2y$10$t5s1OamaFxb/lfKweuNyQeNYAUo/GOXgxDapPsMdj2LNqFv3ZMa22', 'admin', 'enable'),
(53, 'admin Bimbo', 'bimbo@gmail.com', '09999999999', '$2y$10$zF0Odp6OP26PXE.jzDHqdOJ625TNUjWS72yk8gXrlvaqvxFPgTK7W', 'superadmin', ''),
(88, 'sample', 'sample@gmail.com', '09000000001', '$2y$10$FzOnKtwZU5yl9fdef8Lbju/lYP31iK5E/kuGgYApxBFI8Lwr/TsYO', 'admin', ''),
(89, 'samp', 'samp@gmail.com', '09000000000', '$2y$10$pytvmH0UGNG/MMvvm9HNOufz4F7fzkP48iWsT9DUOMaB3e62kHkHy', 'user', 'enable');

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
-- Indexes for table `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`document_type_id`);

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
  MODIFY `cabinet_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `document_tbl`
--
ALTER TABLE `document_tbl`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `document_type`
--
ALTER TABLE `document_type`
  MODIFY `document_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `file_tbl`
--
ALTER TABLE `file_tbl`
  MODIFY `file_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

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
