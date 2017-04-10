
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2017 at 12:06 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u342164714_porta`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `com_id` int(255) NOT NULL AUTO_INCREMENT,
  `comment` varchar(767) COLLATE utf8_unicode_ci NOT NULL,
  `posted_by_id` int(255) NOT NULL,
  `id_of` enum('faculty','student') COLLATE utf8_unicode_ci NOT NULL,
  `qid` int(255) DEFAULT NULL,
  `fqid` int(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`com_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `comment`, `posted_by_id`, `id_of`, `qid`, `fqid`, `timestamp`) VALUES
(1, 'Yo', 1, 'student', 2, NULL, '2017-03-04 08:36:09'),
(2, 'YO', 1, 'student', 2, NULL, '2017-03-04 08:40:34'),
(3, 'Yo', 1, 'student', 2, NULL, '2017-03-04 08:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `cid` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(767) NOT NULL,
  `duration_last_date` date NOT NULL,
  `min_marks` int(255) NOT NULL,
  `max_marks` int(255) NOT NULL,
  `total_students` int(255) NOT NULL,
  `fid` int(255) NOT NULL,
  `enroll_fee` int(255) NOT NULL,
  `image` varchar(767) NOT NULL,
  `description` varchar(767) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `course_faculty`
--

CREATE TABLE IF NOT EXISTS `course_faculty` (
  `cid` int(255) NOT NULL,
  `fid` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `fid` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(767) NOT NULL,
  `image` varchar(767) NOT NULL,
  `email` varchar(767) NOT NULL,
  `password` varchar(767) NOT NULL,
  `phone` bigint(255) NOT NULL,
  `address` varchar(767) NOT NULL,
  `username` varchar(767) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fid`, `name`, `image`, `email`, `password`, `phone`, `address`, `username`) VALUES
(9, 'Ayush Tiwari', '', 'vibhu.tiwari92@gmail.com', '@Platicane1', 8826458643, '', 'Ayush');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_comments`
--

CREATE TABLE IF NOT EXISTS `faculty_comments` (
  `com_id` int(255) NOT NULL AUTO_INCREMENT,
  `comment` varchar(767) COLLATE utf8_unicode_ci NOT NULL,
  `posted_by_id` int(255) NOT NULL,
  `qid` int(255) DEFAULT NULL,
  `fqid` int(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`com_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_questions`
--

CREATE TABLE IF NOT EXISTS `faculty_questions` (
  `qid` int(255) NOT NULL AUTO_INCREMENT,
  `question` varchar(767) COLLATE utf8_unicode_ci NOT NULL,
  `posted_by_id` int(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prime_tag` varchar(767) COLLATE utf8_unicode_ci NOT NULL,
  `shown_to` enum('faculty','student','all') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `faculty_questions`
--

INSERT INTO `faculty_questions` (`qid`, `question`, `posted_by_id`, `timestamp`, `prime_tag`, `shown_to`) VALUES
(1, 'Faculty question 1', 9, '2017-03-04 05:30:19', 'Algebra', 'all'),
(2, 'Faculty question 2', 9, '2017-03-04 05:30:42', 'Algebra', '');

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE IF NOT EXISTS `noticeboard` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `heading` varchar(767) NOT NULL,
  `description` varchar(767) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fid` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `qid` int(255) NOT NULL AUTO_INCREMENT,
  `question` varchar(767) COLLATE utf8_unicode_ci NOT NULL,
  `posted_by_id` int(255) NOT NULL,
  `id_of` enum('faculty','student') COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prime_tag` varchar(767) COLLATE utf8_unicode_ci NOT NULL,
  `shown_to` enum('faculty','student','all') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `question`, `posted_by_id`, `id_of`, `timestamp`, `prime_tag`, `shown_to`) VALUES
(1, 'Question 1', 1, 'faculty', '2017-03-04 08:25:52', 'Algebra', 'faculty'),
(2, 'Question 2', 1, 'student', '2017-03-04 08:25:52', 'Algebra', 'student'),
(3, 'Question 3', 1, 'faculty', '2017-03-04 08:27:48', 'Algebra', 'all'),
(4, 'Question 4', 1, 'student', '2017-03-04 08:27:48', 'Algebra', 'all');

-- --------------------------------------------------------

--
-- Table structure for table `student_comments`
--

CREATE TABLE IF NOT EXISTS `student_comments` (
  `com_id` int(255) NOT NULL AUTO_INCREMENT,
  `comment` varchar(767) COLLATE utf8_unicode_ci NOT NULL,
  `posted_by_id` int(255) NOT NULL,
  `qid` int(255) DEFAULT NULL,
  `fqid` int(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`com_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student_comments`
--

INSERT INTO `student_comments` (`com_id`, `comment`, `posted_by_id`, `qid`, `fqid`, `timestamp`) VALUES
(1, 'Student Answer on Faculty Question', 1, NULL, 1, '2017-03-04 05:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE IF NOT EXISTS `student_course` (
  `sid` int(255) NOT NULL,
  `cid` int(255) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enroll_fee` enum('paid','due') NOT NULL DEFAULT 'due'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE IF NOT EXISTS `student_details` (
  `sid` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(767) NOT NULL,
  `image` varchar(767) DEFAULT NULL,
  `email` varchar(767) NOT NULL,
  `phone` bigint(255) NOT NULL,
  `username` varchar(767) NOT NULL,
  `password` varchar(767) NOT NULL,
  `reg_fee` enum('paid','due') NOT NULL DEFAULT 'due',
  PRIMARY KEY (`sid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`sid`, `name`, `image`, `email`, `phone`, `username`, `password`, `reg_fee`) VALUES
(1, 'Vibhu', NULL, 'the21centinventor@gmail.com', 9557454995, 'Vibhu', '@Platicane1', 'due');

-- --------------------------------------------------------

--
-- Table structure for table `student_exams`
--

CREATE TABLE IF NOT EXISTS `student_exams` (
  `sid` int(255) NOT NULL,
  `sub_id` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_log`
--

CREATE TABLE IF NOT EXISTS `student_log` (
  `sid` int(255) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_questions`
--

CREATE TABLE IF NOT EXISTS `student_questions` (
  `qid` int(255) NOT NULL AUTO_INCREMENT,
  `question` varchar(767) COLLATE utf8_unicode_ci NOT NULL,
  `posted_by_id` int(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prime_tag` varchar(767) COLLATE utf8_unicode_ci NOT NULL,
  `shown_to` enum('faculty','student','all') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `student_questions`
--

INSERT INTO `student_questions` (`qid`, `question`, `posted_by_id`, `timestamp`, `prime_tag`, `shown_to`) VALUES
(5, 'Who is the writer of Harry Potter Series?', 1, '2017-03-03 08:55:35', 'Literature', 'all'),
(3, 'What is (a+b)^2?', 1, '2017-03-03 06:39:49', 'Algebra', 'faculty'),
(6, 'Faculty question 1', 9, '2017-03-04 05:27:02', 'Algebra', 'all');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `sub_id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(767) NOT NULL,
  `test_name` varchar(767) NOT NULL,
  `fid` int(255) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject_course`
--

CREATE TABLE IF NOT EXISTS `subject_course` (
  `cid` int(255) NOT NULL,
  `sub_id` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
