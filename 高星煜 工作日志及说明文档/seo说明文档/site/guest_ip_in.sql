-- phpMyAdmin SQL Dump
-- version 4.0.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017-08-21 14:54:47
-- 服务器版本: 5.6.37
-- PHP 版本: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `show_ip`
--

-- --------------------------------------------------------

--
-- 表的结构 `guest_ip_in`
--

DROP TABLE IF EXISTS `guest_ip_in`;
CREATE TABLE IF NOT EXISTS `guest_ip_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `web_site_id` int(11) NOT NULL,
  `go_in_ip` varchar(50) NOT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `web_site` (`web_site_id`),
  KEY `add_time` (`add_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3109 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
