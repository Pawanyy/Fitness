-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220319.d20d6a34fc
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2023 at 04:55 PM
-- Server version: 10.3.10-MariaDB-log
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness`
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
(1, 'What are your gym hours?', 'Our gym is open 24/7.'),
(2, 'Do you offer personal training?', 'Yes, we offer personal training sessions with certified trainers.'),
(3, 'What is your cancellation policy?', 'We require a 24-hour notice for cancellations.'),
(4, 'Do you have group fitness classes?', 'Yes, we offer a variety of group fitness classes including yoga, Pilates, and spinning.'),
(5, 'What is your membership fee?', 'Our membership fee is $50 per month.'),
(6, 'Do you offer a free trial?', 'Yes, we offer a 3-day free trial for new members.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id` int(11) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `gym_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gyms`
--

CREATE TABLE `tbl_gyms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `activities` varchar(255) NOT NULL,
  `phy_disabled` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gyms`
--

INSERT INTO `tbl_gyms` (`id`, `name`, `location`, `activities`, `phy_disabled`, `description`, `date`) VALUES
(1, 'Muscle Max', 'Mumbai, Maharashtra, India', 'Weightlifting, Cardio, CrossFit', 0, 'State-of-the-art gym with top-notch equipmentWith top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!With top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!', '2023-04-26'),
(2, 'Flex Fitness', 'Delhi, India', 'Yoga, Pilates, Zumba', 1, 'Accessible gym for people with physical disabilitiesWith top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!With top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!', '2023-04-25'),
(3, 'Fit Zone', 'Hyderabad, Telangana, India', 'Cycling, Swimming, Boxing', 0, 'Variety of activities for all fitness levelsWith top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!With top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!', '2023-04-24'),
(4, 'Sweat and Shred', 'Bangalore, Karnataka, India', 'HIIT, Bootcamp, Circuit training', 0, 'Intense workouts to help you achieve your fitness goalsWith top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!With top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!', '2023-04-23'),
(5, 'Power House', 'Chennai, Tamil Nadu, India', 'Powerlifting, Bodybuilding, Strongman', 0, 'Serious gym for serious athletesWith top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!With top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!', '2023-04-22'),
(6, 'Fitness First', 'Kolkata, West Bengal, India', 'Martial Arts, Kickboxing, TRX', 0, 'Expert trainers and top-of-the-line equipmentWith top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!With top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!', '2023-04-21'),
(7, 'Core Fitness', 'Ahmedabad, Gujarat, India', 'Pilates, Barre, TRX', 1, 'Focus on building core strength and stabilityWith top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!With top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!', '2023-04-20'),
(8, 'Iron Paradise', 'Pune, Maharashtra, India', 'Weightlifting, Powerlifting, Bodybuilding', 0, 'Gym for hardcore lifters and bodybuildersWith top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!With top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!', '2023-04-19'),
(9, 'Sweat Equity', 'Jaipur, Rajasthan, India', 'Functional training, CrossFit, Boxing', 0, 'Sweat it out with challenging workoutsWith top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!With top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!', '2023-04-18'),
(10, 'Fitness Junction', 'Lucknow, Uttar Pradesh, India', 'Yoga, Pilates, Aerobics', 0, 'Friendly gym with a welcoming atmosphereWith top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!With top-notch equipment, expert trainers, and a variety of classes, we\'re dedicated to helping you achieve your fitness goals. Our modern facilities include a cardio area, weight room, group fitness studio, and more. Come join our community and start your fitness journey today!', '2023-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gym_plans`
--

CREATE TABLE `tbl_gym_plans` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `gym_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `facilities` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gym_plans`
--

INSERT INTO `tbl_gym_plans` (`id`, `name`, `price`, `gym_id`, `duration`, `facilities`) VALUES
(1, 'Bronze', 500, 1, 1, 'Cardio Equipment, Weight Machines, Showers'),
(2, 'Silver', 800, 1, 2, 'Cardio Equipment, Weight Machines, Group Classes, Showers'),
(3, 'Gold', 1200, 1, 3, 'Cardio Equipment, Weight Machines, Group Classes, Personal Trainer, Sauna'),
(4, 'Bronze', 600, 2, 1, 'Cardio Equipment, Weight Machines, Showers'),
(5, 'Silver', 900, 2, 2, 'Cardio Equipment, Weight Machines, Group Classes, Showers'),
(6, 'Gold', 1300, 2, 3, 'Cardio Equipment, Weight Machines, Group Classes, Personal Trainer, Sauna'),
(7, 'Bronze', 450, 3, 1, 'Cardio Equipment, Weight Machines, Showers'),
(8, 'Silver', 750, 3, 2, 'Cardio Equipment, Weight Machines, Group Classes, Showers'),
(9, 'Gold', 1100, 3, 3, 'Cardio Equipment, Weight Machines, Group Classes, Personal Trainer, Sauna'),
(10, 'Bronze', 550, 4, 1, 'Cardio Equipment, Weight Machines, Showers'),
(11, 'Silver', 850, 4, 2, 'Cardio Equipment, Weight Machines, Group Classes, Showers'),
(12, 'Gold', 1250, 4, 3, 'Cardio Equipment, Weight Machines, Group Classes, Personal Trainer, Sauna'),
(13, 'Bronze', 650, 5, 1, 'Cardio Equipment, Weight Machines, Showers'),
(14, 'Silver', 950, 5, 2, 'Cardio Equipment, Weight Machines, Group Classes, Showers'),
(15, 'Gold', 1350, 5, 3, 'Cardio Equipment, Weight Machines, Group Classes, Personal Trainer, Sauna'),
(16, 'Bronze', 400, 6, 1, 'Cardio Equipment, Weight Machines, Showers'),
(17, 'Silver', 700, 6, 2, 'Cardio Equipment, Weight Machines, Group Classes, Showers'),
(18, 'Gold', 1000, 6, 3, 'Cardio Equipment, Weight Machines, Group Classes, Personal Trainer, Sauna'),
(19, 'Bronze', 500, 7, 1, 'Cardio Equipment, Weight Machines, Showers'),
(20, 'Silver', 800, 7, 2, 'Cardio Equipment, Weight Machines, Group Classes, Showers'),
(21, 'Gold', 1200, 7, 3, 'Cardio Equipment, Weight Machines, Group Classes, Personal Trainer, Sauna'),
(22, 'Bronze', 550, 8, 1, 'Cardio Equipment, Weight Machines, Showers'),
(23, 'Silver', 850, 8, 2, 'Cardio Equipment, Weight Machines, Group Classes, Showers'),
(24, 'Gold', 1250, 8, 3, 'Cardio Equipment, Weight Machines, Group Classes, Personal Trainer, Sauna'),
(25, 'Bronze', 600, 9, 1, 'Cardio Equipment, Weight Machines, Showers'),
(26, 'Silver', 900, 9, 2, 'Cardio Equipment, Weight Machines, Group Classes, Showers'),
(27, 'Gold', 1300, 9, 3, 'Cardio Equipment, Weight Machines, Group Classes, Personal Trainer, Sauna'),
(28, 'Bronze', 450, 10, 1, 'Cardio Equipment, Weight Machines, Showers'),
(29, 'Silver', 750, 10, 2, 'Cardio Equipment, Weight Machines, Group Classes, Showers'),
(30, 'Gold', 1350, 10, 3, 'Cardio Equipment, Weight Machines, Group Classes, Personal Trainer, Sauna');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gym_register`
--

CREATE TABLE `tbl_gym_register` (
  `id` int(11) NOT NULL,
  `gym_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(14, 'FitNess', 'Thane, Maharashtra, India', '+911234567890', 'fit@gmail.com', 'www.fit.com', 'Welcome to our fitness website! We are passionate about helping people live healthier lives through physical fitness and overall wellness. Our team is comprised of experienced fitness professionals who are dedicated to helping our members achieve their fitness goals.\r\n\r\n<br><br>Our fitness center is equipped with state-of-the-art facilities and top-of-the-line equipment to ensure that our members have everything they need to achieve their desired results. We offer a variety of fitness programs to cater to our members\' individual needs and preferences. From group fitness classes, personal training sessions, to nutrition coaching, we have everything our members need to get fit and stay healthy.', 'Welcome to our fitness website! We are passionate about helping people live healthier lives through physical fitness and overall wellness. <br>Our team is comprised of experienced fitness professionals who are dedicated to helping our members achieve their fitness goals.\r\n\r\nOur fitness center is equipped with state-of-the-art facilities and top-of-the-line equipment to ensure that our members have everything they need to achieve their desired results. We offer a variety of fitness programs to cater to our members\' individual needs and preferences. From group fitness classes, personal training sessions, to nutrition coaching, we have everything our members need to get fit and stay healthy.');

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
  `role` int(11) NOT NULL DEFAULT 1 COMMENT '0-admin\r\n1-user',
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `password`, `phone`, `aboutme`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '1234567890', 'hi', 0, ''),
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
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gyms`
--
ALTER TABLE `tbl_gyms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gym_plans`
--
ALTER TABLE `tbl_gym_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gym_register`
--
ALTER TABLE `tbl_gym_register`
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
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_gyms`
--
ALTER TABLE `tbl_gyms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_gym_plans`
--
ALTER TABLE `tbl_gym_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_gym_register`
--
ALTER TABLE `tbl_gym_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
