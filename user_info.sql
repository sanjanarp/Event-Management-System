-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2022 at 02:03 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_info`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getBookings` (IN `emailid` VARCHAR(25))  SELECT * FROM venue_booking, equipments WHERE email = emailid and venue_booking_id = id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `eid` int(3) NOT NULL,
  `chairs_no` int(3) NOT NULL,
  `tables_no` int(3) NOT NULL,
  `lights_no` int(3) NOT NULL,
  `speakers_no` int(3) NOT NULL,
  `microphones_no` int(3) NOT NULL,
  `venue_booking_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`eid`, `chairs_no`, `tables_no`, `lights_no`, `speakers_no`, `microphones_no`, `venue_booking_id`) VALUES
(67, 100, 50, 20, 10, 7, 82),
(70, 10, 5, 5, 2, 6, 86);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(1) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `description`) VALUES
(2, 'Fiesta Music Festival', 'Fiesta Music festival is brought to you by U4Yeah events. Make sure to be there in time!'),
(3, 'Birthday', 'We will be your partners in your child\'s birthday events.'),
(19, 'Fun Sports Festival', 'Badminton Tournaments in Bengaluru Register online Happening on - 12th Feb');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(1) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `usertype` varchar(10) NOT NULL,
  `dt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone_number`, `password`, `usertype`, `dt`) VALUES
(1, 'admin', 'admin@gmail.com', 123, 'admin', 'admin', '0000-00-00'),
(4, 'xyz', 'xyz1@xyz.com', 987654322, 'xyz', 'user', '2022-01-12'),
(91, 'abc', 'abc@gmail.com', 1234567890, '1234', 'user', '2022-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `id` int(1) NOT NULL,
  `name` varchar(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `rate` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `name`, `address`, `description`, `rate`) VALUES
(1, 'Church Street', '4th Main, 16th cross, opp to socials ', 'grand and historic', 300),
(2, 'Palace Ground', '#23, opp to Shiva temple', 'Largest Indoor', 700),
(10, 'Star Banquets', 'Jayanagar, Bangalore.', 'Public and appropriate', 780),
(11, 'Lemon Tree Hotel', 'Electronic City, Bangalore.', 'More rewarding', 470),
(12, 'Whitefield Banquets', 'Whitefield, Bangalore.', 'Telly festival', 780);

--
-- Triggers `venue`
--
DELIMITER $$
CREATE TRIGGER `tr_delete` AFTER DELETE ON `venue` FOR EACH ROW INSERT into venue_logs(venue_id,name,address,description,rate) VALUES(old.id, old.name, old.address, old.description, old.rate)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `venue_booking`
--

CREATE TABLE `venue_booking` (
  `id` int(3) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_phone` int(10) NOT NULL,
  `venue_id` int(1) NOT NULL,
  `event_id` int(1) NOT NULL,
  `date` date NOT NULL,
  `audience_size` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venue_booking`
--

INSERT INTO `venue_booking` (`id`, `user_name`, `email`, `user_phone`, `venue_id`, `event_id`, `date`, `audience_size`) VALUES
(82, 'xyz', 'xyz1@xyz.com', 987654322, 1, 2, '2022-03-15', 100),
(86, 'xyz', 'xyz1@xyz.com', 987654322, 2, 19, '2022-04-26', 10);

-- --------------------------------------------------------

--
-- Table structure for table `venue_logs`
--

CREATE TABLE `venue_logs` (
  `id` int(2) NOT NULL,
  `venue_id` int(2) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `description` varchar(20) NOT NULL,
  `rate` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venue_logs`
--

INSERT INTO `venue_logs` (`id`, `venue_id`, `name`, `address`, `description`, `rate`) VALUES
(12, 13, 'venue 5', 'ad5', 'desc5', 450),
(15, 14, 'Venue2', 'add2', 'desc2', 8);

--
-- Triggers `venue_logs`
--
DELIMITER $$
CREATE TRIGGER `del_logs` AFTER DELETE ON `venue_logs` FOR EACH ROW INSERT into venue VALUES(old.venue_id,old.name,old.address,old.description,old.rate)
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `venue_booking_id` (`venue_booking_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`phone_number`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `address` (`address`);

--
-- Indexes for table `venue_booking`
--
ALTER TABLE `venue_booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `venue_id` (`venue_id`,`event_id`,`date`),
  ADD KEY `venue_booking_ibfk_1` (`event_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `venue_logs`
--
ALTER TABLE `venue_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `eid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `venue_booking`
--
ALTER TABLE `venue_booking`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `venue_logs`
--
ALTER TABLE `venue_logs`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipments`
--
ALTER TABLE `equipments`
  ADD CONSTRAINT `equipments_ibfk_1` FOREIGN KEY (`venue_booking_id`) REFERENCES `venue_booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `venue_booking`
--
ALTER TABLE `venue_booking`
  ADD CONSTRAINT `venue_booking_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venue_booking_ibfk_2` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venue_booking_ibfk_3` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
