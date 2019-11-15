-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2019 at 07:32 AM
-- Server version: 5.7.21
-- PHP Version: 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csvd`
--



--
-- Table structure for table `cs_text`
--

CREATE TABLE `cs_texte` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cs_edition` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '版本',
  `cs_vnx`    varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '舊約／新約',
  `cs_links`  varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '索引',
  `cs_liber`  varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '書目',
  `cs_caput`  int(10) UNSIGNED DEFAULT '0' COMMENT '章',
  `cs_verse`  varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '段',
  `cs_section` int(10) UNSIGNED DEFAULT '0' COMMENT '節',
  `cs_title`  varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '标题1',
  `cs_texte`  longtext CHARACTER SET utf8 COLLATE utf8_bin COMMENT '正文',
  `cs_quote`  longtext CHARACTER SET utf8 COLLATE utf8_bin COMMENT '引用',
  `cs_note`   longtext CHARACTER SET utf8 COLLATE utf8_bin COMMENT '備註',
  `cs_cate`   tinyint(1) UNSIGNED DEFAULT '0' COMMENT '分類',
  `cs_date`   timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  `cs_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新時間',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  FULLTEXT KEY `cs_title` (`cs_title`),
  FULLTEXT KEY `cs_texte` (`cs_texte`),
  FULLTEXT KEY `cs_quote` (`cs_quote`),
  FULLTEXT KEY `cs_note` (`cs_note`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000;



-- --------------------------------------------------------

--
-- Table structure for table `cs_liber`
--

CREATE TABLE `cs_liber` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cs_edition` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '版本',
  `cs_links`  varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '書目索引',
  `cs_liber`  varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '書目簡訊',
  `cs_title`  varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '标题1',
  `cs_subtitle` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '标题2',
  `cs_caput`  int(8) UNSIGNED DEFAULT '0' COMMENT '章節',
  `cs_cate`   tinyint(1) UNSIGNED DEFAULT '0' COMMENT '類目',
  `cs_date`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  `cs_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新時間',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000;

-- --------------------------------------------------------

--
-- Table structure for table `cs_preface`
--

CREATE TABLE `cs_preface` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cs_edition` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '版本',
  `cs_links`  varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '書目索引',
  `cd_index`  int(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '索引',
  `cs_liber`  varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '書目簡訊',
  `cs_title`  varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '标题',
  `cs_texte`  longtext CHARACTER SET utf8 COLLATE utf8_bin COMMENT '正文',
  `cs_quote`  longtext CHARACTER SET utf8 COLLATE utf8_bin COMMENT '引用',
  `cs_note`   longtext CHARACTER SET utf8 COLLATE utf8_bin COMMENT '備註',
  `cs_cate`   tinyint(1) UNSIGNED DEFAULT '0' COMMENT '類目',
  `cs_date`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  `cs_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新時間',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  FULLTEXT KEY `cs_title` (`cs_title`),
  FULLTEXT KEY `cs_texte` (`cs_texte`),
  FULLTEXT KEY `cs_quote` (`cs_quote`),
  FULLTEXT KEY `cs_note` (`cs_note`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000;

-- --------------------------------------------------------



-- --------------------------------------------------------

--
-- Table structure for table `cs_bible`
--

CREATE TABLE `cs_bible` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cs_edition` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '版本',
  `cs_vnx`    varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '舊約／新約',
  `cs_links`  varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '索引',
  `cs_liber`  varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '書目',
  `cs_caput`  int(10) UNSIGNED DEFAULT '0' COMMENT '章節',
  `cs_verse`  varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '段落',
  `cs_title`  varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '标题1',
  `cs_texte`  longtext CHARACTER SET utf8 COLLATE utf8_bin COMMENT '正文',
  `cs_quote`  longtext CHARACTER SET utf8 COLLATE utf8_bin COMMENT '引用',
  `cs_note`   longtext CHARACTER SET utf8 COLLATE utf8_bin COMMENT '備註',
  `cs_cate`   tinyint(1) UNSIGNED DEFAULT '0' COMMENT '分類',
  `cs_date`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  `cs_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新時間',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  FULLTEXT KEY `cs_title` (`cs_title`),
  FULLTEXT KEY `cs_texte` (`cs_texte`),
  FULLTEXT KEY `cs_quote` (`cs_quote`),
  FULLTEXT KEY `cs_note` (`cs_note`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000;



CREATE TABLE `cs_texte` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cs_edition` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '版本',
  `cs_vnx`    varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '舊約／新約',
  `cs_links`  varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '索引',
  `cs_liber`  varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '書目',
  `cs_caput`  int(10) UNSIGNED DEFAULT '0' COMMENT '章節',
  `cs_verse`  varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '段落',
  `cs_section`int(10) UNSIGNED DEFAULT '0' COMMENT '節',
  `cs_title`  varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '标题1',
  `cs_texte`  longtext CHARACTER SET utf8 COLLATE utf8_bin COMMENT '正文',
  `cs_quote`  longtext CHARACTER SET utf8 COLLATE utf8_bin COMMENT '引用',
  `cs_note`   longtext CHARACTER SET utf8 COLLATE utf8_bin COMMENT '備註',
  `cs_cate`   tinyint(1) UNSIGNED DEFAULT '0' COMMENT '分類',
  `cs_date`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  `cs_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新時間',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  FULLTEXT KEY `cs_title` (`cs_title`),
  FULLTEXT KEY `cs_texte` (`cs_texte`),
  FULLTEXT KEY `cs_quote` (`cs_quote`),
  FULLTEXT KEY `cs_note` (`cs_note`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000;

--
-- Dumping data for table `cs_bible`
--
