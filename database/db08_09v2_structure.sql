--
-- Definition for database
--
DROP DATABASE IF EXISTS funded_db;
CREATE DATABASE IF NOT EXISTS funded_db
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

-- 
-- Disable foreign keys
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set SQL mode
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

-- 
-- Set default database
--
USE funded_db;

--
-- Definition for table category
--
CREATE TABLE IF NOT EXISTS category (
  id int(11) ZEROFILL NOT NULL  AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  description varchar(255) NOT NULL,
  color char(7) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '#33BCFF' COMMENT 'let each category represented by a color in hex',
  font_color char(7) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '#000000' COMMENT 'font color of cat in hex',
  PRIMARY KEY (id),
  UNIQUE INDEX name (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table project_stage
--
CREATE TABLE IF NOT EXISTS project_stage (
  id tinyint(4) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  description varchar(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX name (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table project_status
--
CREATE TABLE IF NOT EXISTS project_status (
  id tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'projects are not to be deleted but marked as delete this is reflected by status = -1',
  name varchar(50) NOT NULL,
  description varchar(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 4096
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table role
--
CREATE TABLE IF NOT EXISTS role (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX name (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tag
--
CREATE TABLE IF NOT EXISTS tag (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(20) NOT NULL COMMENT 'tag names are all lower case. tags can be selected from database-powered jquery select/autocomplete box, if name already exist add new entry, else create entry in project-tag with returned tag id',
  PRIMARY KEY (id),
  UNIQUE INDEX name (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table user
--
CREATE TABLE IF NOT EXISTS user (
  id int(11) ZEROFILL NOT NULL AUTO_INCREMENT,
  user_name varchar(50) NOT NULL,
  password varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  first_name varchar(50) DEFAULT NULL,
  last_name varchar(50) DEFAULT NULL,
  profile_pic varchar(255) DEFAULT 'default.jpg',
  user_descriptn varchar(255) DEFAULT NULL,
  last_login timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  join_date datetime DEFAULT CURRENT_TIMESTAMP,
  email varchar(50) NOT NULL,
  DOB varchar(255) DEFAULT NULL,
  about_me varchar(255) DEFAULT NULL,
  twitter_id varchar(255) DEFAULT NULL,
  facebook_id varchar(255) DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX email (email),
  UNIQUE INDEX user_name (user_name)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table comment
--
CREATE TABLE IF NOT EXISTS comment (
  id int(11) NOT NULL AUTO_INCREMENT,
  update_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  created_by int(11) NOT NULL,
  body varchar(255) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT FK_comment_user_id FOREIGN KEY (created_by)
  REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table project
--
CREATE TABLE IF NOT EXISTS project (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(100) NOT NULL COMMENT 'Do not allow projects with same name to be created',
  start_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp needed for LOCALE TIME',
  end_date timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'timestamp needed for locale time',
  created_on datetime DEFAULT CURRENT_TIMESTAMP,
  pledge_goal decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT 'fundraising goal amount',
  status tinyint(4) DEFAULT 3 COMMENT 'status code for project :0 = deleted, 1. cancelled, 2= funded , 3 = active  if status < 3, do not show project for landing page, if status < 2, do not show in browse project list. In view all project list sort desc where status > 0 because only admin can see deleted projects',
  suml_pledged decimal(10, 2) DEFAULT 0.00,
  category_id int(11) ZEROFILL DEFAULT 0 COMMENT 'default = 0 which is general. Technology, Art etc',
  backer_count int(11) DEFAULT 0 COMMENT 'number of people who pledged, this should be somehow generate dynamically, select count(backer) from backer_project',
  like_count int(11) DEFAULT 0 COMMENT 'number of people who clicked on like',
  founder_name varchar(50) NOT NULL,
  country varchar(100) NOT NULL COMMENT 'country that the project originated from',
  web_link varchar(255) DEFAULT NULL,
  email varchar(50) NOT NULL COMMENT 'email of founder',
  video_link varchar(255) DEFAULT NULL COMMENT 'embed video in prooject page',
  overview varchar(255) DEFAULT NULL COMMENT 'Lead with a compelling statement that describes your campaign and why it’s important to you, highlight key campaign features, and remember - keep it short! ',
  view_count int(11) DEFAULT 0 COMMENT 'number of views the project received',
  img_s varchar(255) DEFAULT 'default.jpg' COMMENT 'url of image to display on project list',
  img_l varchar(255) DEFAULT 'default.jpg' COMMENT 'url of image to display on project detail page',
  project_stage tinyint(4) DEFAULT NULL COMMENT 'N/A / Concept/ Prototype/Production',
  pitch varchar(255) DEFAULT NULL COMMENT 'Tell potential contributors more about your campaign. Provide details that will motivate people to contribute. A good pitch is compelling, informative, and easy to digest.',
  featured tinyint(1) DEFAULT 0 COMMENT 'used to generate featured project, on landing page, show random x featured projects from list, admin can mark a project as featured',
  challenges varchar(255) DEFAULT NULL COMMENT 'describe possible challenge/risk of project',
  PRIMARY KEY (id),
  UNIQUE INDEX title (title),
  CONSTRAINT FK_project_category_id FOREIGN KEY (category_id)
  REFERENCES category (id) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT FK_project_project_stage_id FOREIGN KEY (project_stage)
  REFERENCES project_stage (id) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT FK_project_status_id FOREIGN KEY (status)
  REFERENCES project_status (id) ON DELETE RESTRICT ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table user_role
--
CREATE TABLE IF NOT EXISTS user_role (
  user_id int(11) NOT NULL,
  role_id int(11) NOT NULL,
  PRIMARY KEY (role_id, user_id),
  CONSTRAINT FK_user_role_role_id FOREIGN KEY (role_id)
  REFERENCES role (id) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT FK_user_role_user_id FOREIGN KEY (user_id)
  REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table `like`
--
CREATE TABLE IF NOT EXISTS `like` (
  user_id int(11) NOT NULL,
  project_id int(11) NOT NULL,
  PRIMARY KEY (user_id, project_id),
  CONSTRAINT FK_like_project_id FOREIGN KEY (project_id)
  REFERENCES project (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_like_user_id FOREIGN KEY (user_id)
  REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table backer_project
--
CREATE TABLE IF NOT EXISTS backer_project (
  backer_id int(11) NOT NULL,
  project_id int(11) NOT NULL,
  date_pledged datetime DEFAULT NULL,
  amount_pledged decimal(8, 2) DEFAULT NULL,
  PRIMARY KEY (project_id, backer_id),
  CONSTRAINT FK_backer_project_project_id FOREIGN KEY (project_id)
  REFERENCES project (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT FK_backer_project_user_id FOREIGN KEY (backer_id)
  REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table project_tag
--
CREATE TABLE IF NOT EXISTS project_tag (
  project_id int(11) NOT NULL,
  tag_id int(11) NOT NULL,
  PRIMARY KEY (project_id, tag_id),
  CONSTRAINT FK_project_tag_project_id FOREIGN KEY (project_id)
  REFERENCES project (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FK_project_tag_tag_id FOREIGN KEY (tag_id)
  REFERENCES tag (id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

-- 
-- Restore previous SQL mode
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;