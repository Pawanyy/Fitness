-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220319.d20d6a34fc
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2023 at 11:53 AM
-- Server version: 5.7.33
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nss`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `name`, `email`, `subject`, `phone`, `message`, `date`) VALUES
(4, 'Jalsss', 'admin@gmail.com', 'www', '123456789', 'www', '2023-04-06 02:34:01 AM'),
(5, 'Pawan Yadav', 'yadavpawan69290@gmail.com', '31434321221', '07276616829', 'hi', '2023-04-06 03:50:40 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_donation`
--

CREATE TABLE `tbl_donation` (
  `id` int(11) NOT NULL,
  `donation` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_donation`
--

INSERT INTO `tbl_donation` (`id`, `donation`, `user_id`, `date`) VALUES
(6, 5000, 3, '2023-04-05 10:33:57 PM'),
(7, 500, 3, '2023-04-05 11:08:54 PM'),
(8, 500, 7, '2023-04-06 03:11:40 PM'),
(9, 8000, 7, '2023-04-06 03:48:24 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`id`, `name`, `description`, `date`) VALUES
(2, 'Campus Cleanupp', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mollis maecenas finibus proin condimentum id tortor torquent mollis sagittis. Per purus sagittis magna orci fermentum dignissim. Turpis aliquet eleifend metus velit maecenas vehicula est tempus urna fusce vestibulum viverra. Aliquam est curae vehicula netus egestas iaculis ornare placerat litora et odio netus.', '2023-04-05'),
(3, 'FOLD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mollis maecenas finibus proin condimentum id tortor torquent mollis sagittis. Per purus sagittis magna orci fermentum dignissim. Turpis aliquet eleifend metus velit maecenas vehicula est tempus urna fusce vestibulum viverra. Aliquam est curae vehicula netus egestas iaculis ornare placerat litora et odio netus.', '2023-04-05'),
(4, 'Blood Donation', 'aaaaa', '2023-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_register`
--

CREATE TABLE `tbl_event_register` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_register`
--

INSERT INTO `tbl_event_register` (`id`, `event_id`, `user_id`, `date`) VALUES
(12, 2, 3, '2023-04-06 03:06:33 AM'),
(13, 3, 7, '2023-04-06 03:11:58 PM'),
(14, 4, 7, '2023-04-06 03:46:51 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`id`, `question`, `answer`) VALUES
(1, 'hi', 'hello'),
(3, 'how are you ?', 'fine.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `about_desc` text NOT NULL,
  `main_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `name`, `address`, `phone`, `email`, `website`, `about_desc`, `main_desc`) VALUES
(5, 'S M Shetty College', 'Thane, Maharashtra, India', '+911234567890', 'nss@gmail.com', 'www.nss.com', 'Mollis pretium lorem primis senectus habitasse lectus scelerisque donec, ultricies tortor suspendisse adipiscing fusce morbi volutpat pellentesque, consectetur mi risus molestie curae malesuada cum. Dignissim lacus convallis massa mauris enim ad mattis magnis senectus montes, mollis taciti phasellus accumsan bibendum semper blandit suspendisse faucibus nibh est, metus lobortis morbi cras magna vivamus per risus fermentum.', 'Mollis pretium lorem primis senectus habitasse lectus scelerisque donec, ultricies tortor suspendisse adipiscing fusce morbi volutpat pellentesque, consectetur mi risus molestie curae malesuada cum. Dignissim lacus convallis massa mauris enim ad mattis magnis senectus montes, mollis taciti phasellus accumsan bibendum semper blandit suspendisse faucibus nibh est, metus lobortis morbi cras magna vivamus per risus fermentum.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `aboutme` text NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1' COMMENT '0-admin\r\n1-user',
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `password`, `phone`, `aboutme`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '1234567890', 'hi', 0, ''),
(3, 'demo', 'demo@gmail.com', '123456', '1234567890', 'Hii', 1, '2023-04-05 07:20:16 PM'),
(6, 'demo2', 'demo2@gmail.com', '12345', '123456789', 'hi', 1, '2023-04-06 03:30:00 AM'),
(7, 'demo4', 'demo4@gmail.com', '123456', '1234567890', 'hi', 1, '2023-04-06 03:08:21 PM'),
(8, 'Pawan Yadav', 'yadavpawan69290@gmail.com', '123456', '07276616829', 'hi', 1, '2023-04-06 04:09:24 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_donation`
--
ALTER TABLE `tbl_donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_event_register`
--
ALTER TABLE `tbl_event_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_donation`
--
ALTER TABLE `tbl_donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_event_register`
--
ALTER TABLE `tbl_event_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
