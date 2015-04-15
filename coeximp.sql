-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2015 at 12:53 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coeximp`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `activity_id` int(11) NOT NULL,
  `week_no` int(11) NOT NULL,
  `summary_of_activity` text NOT NULL,
  `created_date` date NOT NULL,
  `modified_date` date NOT NULL,
  `intern_id` int(11) NOT NULL,
  PRIMARY KEY (`activity_id`),
  KEY `intern_id` (`intern_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `application_id` int(100) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `department` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL,
  `duration` int(2) NOT NULL,
  `start_date` datetime NOT NULL,
  `skill_rating` int(2) NOT NULL,
  `skill_description` varchar(200) NOT NULL,
  `target_achievements` varchar(200) NOT NULL,
  `previous_works` varchar(250) NOT NULL,
  `why_coex` varchar(200) NOT NULL,
  `cv_id` int(10) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(70) NOT NULL,
  `phone_no` int(15) NOT NULL,
  `website` varchar(50) NOT NULL,
  `letter_id` int(10) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status_id` int(2) NOT NULL,
  PRIMARY KEY (`application_id`),
  KEY `applications_ibfk_1` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `authorization`
--

CREATE TABLE IF NOT EXISTS `authorization` (
  `authorization_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(30) NOT NULL,
  PRIMARY KEY (`authorization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `authorization`
--

INSERT INTO `authorization` (`authorization_id`, `user_type`) VALUES
(1, 'admin'),
(2, 'supervisor'),
(3, 'intern');

-- --------------------------------------------------------

--
-- Table structure for table `interns`
--

CREATE TABLE IF NOT EXISTS `interns` (
  `intern_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `duration` int(2) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_id` int(10) NOT NULL,
  `supervisor_id` int(5) NOT NULL,
  `created_date` datetime NOT NULL,
  `status_id` int(2) NOT NULL,
  PRIMARY KEY (`intern_id`),
  KEY `status_id` (`status_id`),
  KEY `supervisor_id` (`supervisor_id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `intern_task`
--

CREATE TABLE IF NOT EXISTS `intern_task` (
  `intern_task_id` int(11) NOT NULL AUTO_INCREMENT,
  `intern_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`intern_task_id`),
  KEY `task_id` (`task_id`),
  KEY `intern_id` (`intern_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(10) unsigned NOT NULL,
  `subject` varchar(150) NOT NULL,
  `msg_body` text NOT NULL,
  `sender` int(11) NOT NULL COMMENT 'Holds profile ID of sender',
  `receiver` int(11) NOT NULL COMMENT 'Holds profile ID of receiver',
  `status` int(11) NOT NULL COMMENT 'Holds the status of msg, read,unread,sent,draft,delivered',
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `sender` (`sender`),
  KEY `status` (`status`),
  KEY `receiver` (`receiver`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `profile_id` int(11) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `user_auth_id` int(11) NOT NULL COMMENT 'Hold key to user authentication',
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`profile_id`),
  KEY `user_auth_id` (`user_auth_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(2) NOT NULL AUTO_INCREMENT,
  `status_description` varchar(20) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_description`) VALUES
(1, 'active'),
(2, 'inactive'),
(3, 'rejected application'),
(4, 'invited applicant'),
(5, 'new application');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE IF NOT EXISTS `supervisor` (
  `supervisor_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`supervisor_id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(10) NOT NULL AUTO_INCREMENT,
  `task_title` varchar(100) NOT NULL,
  `task_description` varchar(300) NOT NULL,
  `due_date` date NOT NULL,
  `supervisor_id` int(3) NOT NULL COMMENT 'task initiator',
  `created_date` datetime NOT NULL,
  `task_comments` varchar(255) NOT NULL,
  `status_id` int(3) NOT NULL,
  PRIMARY KEY (`task_id`),
  KEY `status_id` (`status_id`),
  KEY `supervisor_id` (`supervisor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_auth`
--

CREATE TABLE IF NOT EXISTS `user_auth` (
  `user_auth_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `authorization_id` int(11) NOT NULL,
  PRIMARY KEY (`user_auth_id`),
  KEY `authorization_id` (`authorization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`intern_id`) REFERENCES `interns` (`intern_id`);

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `interns`
--
ALTER TABLE `interns`
  ADD CONSTRAINT `interns_ibfk_3` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`),
  ADD CONSTRAINT `interns_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `interns_ibfk_2` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisor` (`supervisor_id`);

--
-- Constraints for table `intern_task`
--
ALTER TABLE `intern_task`
  ADD CONSTRAINT `intern_task_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`),
  ADD CONSTRAINT `intern_task_ibfk_1` FOREIGN KEY (`intern_id`) REFERENCES `interns` (`intern_id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_3` FOREIGN KEY (`receiver`) REFERENCES `interns` (`intern_id`),
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `supervisor` (`supervisor_id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_auth_id`) REFERENCES `user_auth` (`user_auth_id`);

--
-- Constraints for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `supervisor_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisor` (`supervisor_id`);

--
-- Constraints for table `user_auth`
--
ALTER TABLE `user_auth`
  ADD CONSTRAINT `user_auth_ibfk_1` FOREIGN KEY (`authorization_id`) REFERENCES `authorization` (`authorization_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
