-- phpMyAdmin SQL Dump
-- version 2.11.8.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2011 at 06:58 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `moviesparx_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `us_states`
--

DROP TABLE IF EXISTS `us_states`;
CREATE TABLE IF NOT EXISTS `us_states` (
  `state_code` char(2) NOT NULL,
  `state_name` varchar(250) NOT NULL,
  PRIMARY KEY  (`state_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
