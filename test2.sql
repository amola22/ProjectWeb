-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2023 at 12:35 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test2`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(8) NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `profile_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `phone`, `email`, `password`, `date_from`, `date_to`, `time_from`, `time_to`, `profile_image`) VALUES
(1, 'amal mohamed', '01234567897', 'amal@gmail.com', '1234', '2023-05-13', '2023-05-27', '11:31:00', '22:32:00', '../images/doctor_profile_images/16840149811213204642646007858a9e4.png'),
(2, 'nora mohamed', '01234567897', 'nora@gmail.com', '4321', '2023-04-02', '2023-04-03', '23:52:00', '12:52:00', NULL),
(3, 'hamed mohamed', '123', 'hamed@gmail.com', '1234', NULL, NULL, NULL, NULL, NULL),
(4, 'sayed mohamed', '45454', 'mahmoud@gmail.com', '1234', NULL, NULL, NULL, NULL, NULL),
(6, 'khaled saeed', '1111', 'kaheld@gmail.com', '1234', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `MRN` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`MRN`, `name`, `phone`, `password`, `email`, `date`, `time`, `profile_image`, `doctor_id`, `service_id`) VALUES
(1, 'mahmoud ahmed', '01116721576', '1234', 'mahmoud@gmail.com', '2023-05-11', '10:03:00', '../images/patient_profile_images/168401491631099123864600744ec927.png', 1, 2),
(2, 'mostafa ahmed', '01221540137', '4321', 'mostafa@gmail.com', '2023-05-11', '12:26:00', NULL, 1, 1),
(3, 'aseed mohamed', '123', '1234', 'saeed@gmail.com', NULL, NULL, NULL, NULL, NULL),
(4, 'naeem ahmed', '11111111111', '1234', 'naeem@gmail.com', '2023-05-13', '21:32:00', NULL, 1, 3),
(5, 'aseed mohamed', 'aaa', 'aaa', 'kamiladel117@yahoo.com', NULL, NULL, NULL, NULL, NULL),
(6, 'ahmed mohamed', '12345678912', '123456789', 'ahmed_mohamed@yahoo.com', NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `content` varchar(100) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_MRN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `content`, `doctor_id`, `patient_MRN`) VALUES
(26, 'aaaa', 4, NULL),
(27, 'adertyt444', 4, NULL),
(28, 'babababababa', 4, NULL),
(29, 'hallo', 4, NULL),
(30, '999', 4, NULL),
(31, 'qqqq', 4, NULL),
(32, 'aaaewewewe', 4, NULL),
(33, 'aaaewewewe', 4, NULL),
(34, 'sjslsd', 4, NULL),
(35, 'fhfhfh', NULL, NULL),
(36, '545', 4, NULL),
(37, 'dpwd', 4, NULL),
(38, 'htghggh', 4, NULL),
(39, 'wkhwkhfkw', 4, 1),
(40, 'I think we do it bro', 4, 1),
(41, 'I think we do it bro', 4, 1),
(42, 'aaaaa', 4, 1),
(43, 'shcjhsjsf', 2, 1),
(44, 'sljf;lsjf;sjflsj;sjf;sjfs,jfl;jsl;fj', 2, 1),
(45, 'hallo', 1, 1),
(46, 'hallo mostafa', 6, 2),
(47, 'assmhfmshfmshfmsmfshmsfhmhffffffffffffffffffffffffffffffffffffffffffffffffffff', 1, 1),
(48, 'hallo I am nora\r\n', 2, 1),
(49, 'good', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receptionist`
--

INSERT INTO `receptionist` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service`, `id`, `price`) VALUES
('Diagnosis and treatment of diseases and infections of the mouth, gums and teeth.', 1, '500$'),
('Perform x-rays and dental fillings and fixtures.', 2, '450$'),
('Perform periodontal treatment and root canal treatment.', 3, '500$'),
('Performing dental implants, oral surgery and orthodontics.', 4, '700$'),
('Providing tips and advice for preventing tooth decay and maintaining oral health.', 5, '200$');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`MRN`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `patient_ibfk_1` (`doctor_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_MRN` (`patient_MRN`);

--
-- Indexes for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `MRN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `receptionist`
--
ALTER TABLE `receptionist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `prescription_ibfk_3` FOREIGN KEY (`patient_MRN`) REFERENCES `patient` (`MRN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
