-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2012 at 07:41 PM
-- Server version: 5.5.22
-- PHP Version: 5.3.10-1ubuntu3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: phxibit
--

-- --------------------------------------------------------

--
-- Table structure for table category
--

CREATE TABLE category (
  id int(11) NOT NULL,
  name text NOT NULL,
  PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Table structure for table exhibition
--

CREATE TABLE exhibition (
  id int(11) NOT NULL,
  title varchar(100) NOT NULL,
  description text NOT NULL,
  PRIMARY KEY (id)
);


-- --------------------------------------------------------

--
-- Table structure for table link
--

CREATE TABLE link (
  id int(11) NOT NULL,
  url text NOT NULL,
  description text NOT NULL,
  PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Table structure for table news
--

CREATE TABLE news (
  text text NOT NULL,
  link varchar(100) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table page
--

CREATE TABLE page (
  id varchar(50) NOT NULL,
  active tinyint(1) NOT NULL,
  PRIMARY KEY (id)
);

--
-- Dumping data for table page
--

INSERT INTO page (id, active) VALUES ('biography', 1);
INSERT INTO page (id, active) VALUES ('contacts', 0);
INSERT INTO page (id, active) VALUES ('exhibitions', 1);
INSERT INTO page (id, active) VALUES ('links', 0);
INSERT INTO page (id, active) VALUES ('publications', 0);
INSERT INTO page (id, active) VALUES ('works', 1);

-- --------------------------------------------------------

--
-- Table structure for table publication
--

CREATE TABLE publication (
  id int(11) NOT NULL,
  category int(11) NOT NULL,
  title text NOT NULL,
  description text NOT NULL,
  text text NOT NULL,
  PRIMARY KEY (id,category)
);

-- --------------------------------------------------------

--
-- Table structure for table work
--

CREATE TABLE work (
  id int(11) NOT NULL,
  topic int(11) NOT NULL,
  title varchar(100) NOT NULL,
  description text NOT NULL,
  vimeo_url varchar(100) NOT NULL,
  PRIMARY KEY (id,topic)
);

-- --------------------------------------------------------

--
-- Table structure for table topic
--

CREATE TABLE topic (
  id int(11) NOT NULL,
  name varchar(100) NOT NULL,
  description text NOT NULL,
  PRIMARY KEY (id)
);


--
-- Constraints for dumped tables
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;