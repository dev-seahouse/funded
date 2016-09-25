-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2016 at 05:42 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `funded_db`
--

USE `funded_db`;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `color`, `font_color`) VALUES
(1, 'General', 'Anything', '#33BCFF', '#000000'),
(2, 'Art', 'From music to paintings, anything touches your souls', '#1abc9c', '#ecf0f1'),
(3, 'Technology', 'The next facebook or google', '#f1c40f', '#27ae60'),
(4, 'Food and Leisure', 'All about fun', '#2c3e50', '#95a5a6'),
(5, 'Healthcare', 'Making people lives better', '#f39c12', '#bdc3c7');

--
-- Dumping data for table `project_status`
--

INSERT INTO `project_status` (`id`, `name`, `description`) VALUES
(1, 'cancelled', 'Project is cacelled by admin, or it expires without meeting the amount pledged'),
(2, 'funded', 'Project met its amount pledged and is expired'),
(3, 'active', 'Project can still be backed and not expired');

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_name`, `password`) VALUES
('xuchen', 'abcde');

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(2, 'admin'),
(1, 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
