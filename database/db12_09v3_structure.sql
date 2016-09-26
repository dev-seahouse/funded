-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2016 at 05:40 AM
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
DROP DATABASE IF EXISTS funded_db;
CREATE DATABASE IF NOT EXISTS `funded_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `funded_db`;

-- --------------------------------------------------------

--
-- Table structure for table `backer_project`
--

DROP TABLE IF EXISTS `backer_project`;
CREATE TABLE IF NOT EXISTS `backer_project` (
  `backer_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date_pledged` datetime DEFAULT NULL,
  `amount_pledged` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`project_id`,`backer_id`),
  KEY `FK_backer_project_user_id` (`backer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `backer_project`:
--   `project_id`
--       `project` -> `id`
--   `backer_id`
--       `user` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `color` char(7) CHARACTER SET utf8 DEFAULT '33BCFF' COMMENT 'let each category represented by a color in hex',
  `font_color` char(7) CHARACTER SET utf8 DEFAULT '#000000' COMMENT 'font color of cat in hex',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `category`:
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `body` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_user_id` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `comment`:
--   `created_by`
--       `user` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

DROP TABLE IF EXISTS `like`;
CREATE TABLE IF NOT EXISTS `like` (
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`project_id`),
  KEY `FK_like_project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `like`:
--   `project_id`
--       `project` -> `id`
--   `user_id`
--       `user` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT 'Do not allow projects with same name to be created',
  `start_date` Date NOT NULL COMMENT 'date needed for LOCALE TIME',
  `end_date` Date NOT NULL COMMENT 'date needed for locale time',
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `pledge_goal` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'fundraising goal amount',
  `status` tinyint(4) DEFAULT '3' COMMENT 'status code for project :0 = deleted, 1. cancelled, 2= funded , 3 = active  if status < 3, do not show project for landing page, if status < 2, do not show in browse project list. In view all project list sort desc where status > 0 because only admin can see deleted projects',
  `suml_pledged` decimal(10,2) DEFAULT '0.00',
  `category` varchar(50) DEFAULT 'General' COMMENT 'default = 0 which is general. Technology, Art etc',
  `backer_count` int(11) DEFAULT '0' COMMENT 'number of people who pledged, this should be somehow generate dynamically, select count(backer) from backer_project',
  `like_count` int(11) DEFAULT '0' COMMENT 'number of people who clicked on like',
  `creator_id` int(11) NOT NULL,
  `country` varchar(100) NOT NULL COMMENT 'country that the project originated from',
  `web_link` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL COMMENT 'email of founder',
  `video_link` varchar(255) DEFAULT NULL COMMENT 'embed video in prooject page',
  `overview` varchar(255) DEFAULT NULL COMMENT 'Lead with a compelling statement that describes your campaign and why it’s important to you, highlight key campaign features, and remember - keep it short! ',
  `view_count` int(11) DEFAULT '0' COMMENT 'number of views the project received',
  `img_s` varchar(255) DEFAULT 'default.jpg' COMMENT 'url of image to display on project list',
  `img_l` varchar(255) DEFAULT 'default.jpg' COMMENT 'url of image to display on project detail page',
  `pitch` varchar(255) DEFAULT NULL COMMENT 'Tell potential contributors more about your campaign. Provide details that will motivate people to contribute. A good pitch is compelling, informative, and easy to digest.',
  `featured` tinyint(1) DEFAULT '0' COMMENT 'used to generate featured project, on landing page, show random x featured projects from list, admin can mark a project as featured',
  `challenges` varchar(255) DEFAULT NULL COMMENT 'describe possible challenge/risk of project',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `FK_project_category` (`category`),
  KEY `FK_project_status_id` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `project`:
--   `category_id`
--       `category` -> `id`
--   `status`
--       `project_status` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

DROP TABLE IF EXISTS `project_status`;
CREATE TABLE IF NOT EXISTS `project_status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'projects are not to be deleted but marked as delete this is reflected by status = -1',
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 AVG_ROW_LENGTH=4096 DEFAULT CHARSET=latin1 COMMENT='status code for projects: 0 for cancelled, 1 for funded, 2 for active';

--
-- RELATIONS FOR TABLE `project_status`:
--

-- --------------------------------------------------------

--
-- Table structure for table `project_tag`
--

DROP TABLE IF EXISTS `project_tag`;
CREATE TABLE IF NOT EXISTS `project_tag` (
  `project_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`project_id`,`tag_id`),
  KEY `FK_project_tag_tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `project_tag`:
--   `project_id`
--       `project` -> `id`
--   `tag_id`
--       `tag` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 AVG_ROW_LENGTH=8192 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `role`:
--

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT 'tag names are all lower case. tags can be selected from database-powered jquery select/autocomplete box, if name already exist add new entry, else create entry in project-tag with returned tag id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `tag`:
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) UNIQUE NOT NULL ,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT 'default.jpg',
  `user_descriptn` varchar(255) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `join_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) NOT NULL,
  `DOB` varchar(255) DEFAULT NULL,
  `about_me` varchar(255) DEFAULT NULL,
  `twitter_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `user`:
--

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `FK_user_role_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `user_role`:
--   `role_id`
--       `role` -> `id`
--   `user_id`
--       `user` -> `id`
--

--
-- Constraints for dumped tables
--




--
-- Constraints for table `backer_project`
--
ALTER TABLE `backer_project`
  ADD CONSTRAINT `FK_backer_project_project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_backer_project_user_id` FOREIGN KEY (`backer_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_comment_user_id` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `FK_like_project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_like_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `FK_project_category` FOREIGN KEY (`category`) REFERENCES `category` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_project_status_id` FOREIGN KEY (`status`) REFERENCES `project_status` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_project_creator_id` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Constraints for table `project_tag`
--
ALTER TABLE `project_tag`
  ADD CONSTRAINT `FK_project_tag_project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_project_tag_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `FK_user_role_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_role_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
