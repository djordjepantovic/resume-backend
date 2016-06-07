-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 07, 2016 at 11:39 AM
-- Server version: 5.5.45-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `resume`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `street` varchar(100) CHARACTER SET utf8 NOT NULL,
  `city` varchar(50) CHARACTER SET utf8 NOT NULL,
  `country` varchar(50) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `street`, `city`, `country`, `latitude`, `longitude`) VALUES
(1, 'Nikole Tesle', 'Nikšić', 'Montenegro', '42.77463400', '18.95581200');

-- --------------------------------------------------------

--
-- Table structure for table `certification`
--

CREATE TABLE IF NOT EXISTS `certification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `institution` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `rank` varchar(50) NOT NULL,
  `id_number` varchar(20) DEFAULT NULL,
  `day` int(5) NOT NULL,
  `month` varchar(5) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `alt` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `certification`
--

INSERT INTO `certification` (`id`, `title`, `subtitle`, `institution`, `place`, `rank`, `id_number`, `day`, `month`, `thumb`, `image`, `alt`) VALUES
(1, 'ÖSD Zertifikat A1', 'Österreichisches Sprachdiplom Deutsch', 'am Prüfungszentrum Humboldt Gesellschaft', 'in Podgorica / Montenegro', 'serh gut bestanden', 'ZA11604330', 31, 'MAR', 'thumb-a1.jpg', 'a1-zertifikat.jpg', 'A1 Zertifikat');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `duration` varchar(20) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `department` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `duration`, `degree`, `faculty`, `department`) VALUES
(1, '2001 - 2005', 'Secondary School', 'Secondary Profession', 'Department of Computer Technician. Montenegro, Nikšić.'),
(2, '2005 - 2009', 'Bachelor’s Degree (BApp)', 'Faculty of Mathematics and Natural Sciences', 'Department of Computer Science and Information Technology, University of Montenegro, Podgorica.'),
(3, '2009 - 2012', 'Specialist Degree (Spec.App)', 'Faculty of Mathematics and Natural Sciences', 'Department of Computer Science and Information Technology, University of Montenegro, Podgorica.');

-- --------------------------------------------------------

--
-- Table structure for table `expirience`
--

CREATE TABLE IF NOT EXISTS `expirience` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `duration` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `expirience`
--

INSERT INTO `expirience` (`id`, `duration`, `company`, `title`, `desc`) VALUES
(1, 'January 2013 - October 2013', 'NECKOM d.o.o.', 'Full Stack developer', 'Upgrading existing software with new features on demand. Improving user experience and ease of access. Learned also about advanced Database concepts and Object Pascal while developing in Embarcadero Delphi IDE. Applying and extending my knowledge of Android programming, created brand new ecommerce application. Using Photoshop, InDesign, Illustrator and creating graphics for their website as well as flyers and advertising materials.'),
(2, 'March 2014 - Present', 'Freelance Web Development', 'Web Developer', 'Provide web development solutions using tools such as PHP, HTML, CSS, JavaScript, Laravel for multiple clients. SEO optimisation.');

-- --------------------------------------------------------

--
-- Table structure for table `funfact`
--

CREATE TABLE IF NOT EXISTS `funfact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `counter` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `funfact`
--

INSERT INTO `funfact` (`id`, `counter`, `title`, `icon`) VALUES
(1, 190, 'Hours Of Works', 'fa-clock-o'),
(2, 1280, 'Lines of code', 'fa-code'),
(3, 54, 'Cups of Coffee', 'fa-coffee'),
(4, 2, 'Awards', 'fa-trophy');

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE IF NOT EXISTS `interest` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`id`, `name`, `icon`) VALUES
(1, 'Photography', 'moon-icon-camera'),
(2, 'Basketball', 'moon-icon-basketball'),
(3, 'Music', 'moon-icon-headphones'),
(4, 'Books', 'moon-icon-books'),
(5, 'Watch Movies', 'moon-icon-play'),
(6, 'Learning Foreign Languages', 'moon-icon-language'),
(7, 'Travel', 'moon-icon-flight');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `percent` varchar(5) NOT NULL,
  `barcolor` varchar(7) NOT NULL,
  `trackcolor` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `percent`, `barcolor`, `trackcolor`) VALUES
(1, 'Serbian (Montenegrin)', '100', '#00bcd4', '#caf9ff'),
(2, 'English', '92', '#00bcd4', '#caf9ff'),
(3, 'German', '33', '#00bcd4', '#caf9ff');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `person_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(15) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `about_me` text CHARACTER SET utf8 NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `skype` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `img` varchar(80) DEFAULT NULL,
  `img_alt` varchar(50) NOT NULL,
  PRIMARY KEY (`person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`person_id`, `first_name`, `last_name`, `title`, `about_me`, `email`, `phone`, `skype`, `birthdate`, `img`, `img_alt`) VALUES
(1, 'Đorđe', 'Pantović', 'Web Developer', 'Hello, I''m a creative Software and Web Developer from Nikšić, Montenegro. I am a junior programmer with good knowledge of back-end techniques. I love structure and order and I also stand for quality.', 'contact@djordjepantovic.de', '+382 67 355 619', 'joshuaplay', '1986-07-11', 'djordje-pantovic.jpg', 'Djordje Pantovic');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE IF NOT EXISTS `social` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(50) CHARACTER SET utf8 NOT NULL,
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `link`, `icon`) VALUES
(1, 'https://plus.google.com/+ĐorđePantović', 'fa-google-plus'),
(2, 'https://github.com/djordjepantovic', 'fa-github'),
(3, 'https://www.linkedin.com/in/djordjepantovic', 'fa-linkedin');

-- --------------------------------------------------------

--
-- Table structure for table `tech_skills`
--

CREATE TABLE IF NOT EXISTS `tech_skills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `percent` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tech_skills`
--

INSERT INTO `tech_skills` (`id`, `name`, `percent`) VALUES
(1, 'PHP & MySQL', '91%'),
(2, 'HTML & CSS', '90%'),
(3, 'Delphi', '61%'),
(4, 'Android Development', '65%'),
(5, 'Git / Git Flow', '68%'),
(6, 'Laravel', '85%');

-- --------------------------------------------------------

--
-- Table structure for table `tool_skills`
--

CREATE TABLE IF NOT EXISTS `tool_skills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `percent` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tool_skills`
--

INSERT INTO `tool_skills` (`id`, `name`, `percent`) VALUES
(1, 'Windows', '92%'),
(2, 'jQuery', '90%'),
(3, 'Linux / elementary OS', '74%'),
(4, 'Sublime Text', '98%'),
(5, 'HeidiSQL', '75%'),
(6, 'Adobe Photoshop', '83%');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
