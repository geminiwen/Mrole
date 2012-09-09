-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 09 月 09 日 13:51
-- 服务器版本: 5.1.36
-- PHP 版本: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mrole`
--

-- --------------------------------------------------------

--
-- 表的结构 `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `pic` varchar(20) NOT NULL COMMENT '状态发布人头像信息',
  `content` text NOT NULL COMMENT '状态内容',
  `S_ID` int(20) NOT NULL COMMENT '作者学号',
  `author` varchar(20) NOT NULL COMMENT '状态发布人',
  `type` varchar(20) NOT NULL COMMENT '状态类型',
  `address` varchar(20) DEFAULT NULL COMMENT '链接地址',
  `time` datetime NOT NULL COMMENT '状态发布时间',
  `commentNum` int(10) NOT NULL COMMENT '评论量',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `state`
--

INSERT INTO `state` (`ID`, `pic`, `content`, `S_ID`, `author`, `type`, `address`, `time`, `commentNum`) VALUES
(1, '', '一二三四五，上山打老虎！', 1000304217, '赵倩', '', NULL, '2012-09-07 15:38:05', 0),
(2, '', '我猜我们都是上帝眼中的罪人', 1000304201, '李寒', '', NULL, '2012-09-09 05:54:07', 0),
(3, '', '多读书多看报少吃零食多看报', 1000304201, '李寒', '', NULL, '2012-09-09 05:42:28', 0),
(4, '', '今天天气好晴朗处处好风光', 1000304217, '赵倩', '', NULL, '2012-09-09 05:26:05', 0),
(5, '', '好男人就是我，我就是曾小贤', 1000304217, '赵倩', '', NULL, '2012-09-09 05:38:02', 0),
(6, '', '哎呀呀哎呀呀', 1000304210, '张三', '', NULL, '2012-09-09 14:34:55', 0),
(34, '', '新年快乐', 1000304217, '赵倩', '', NULL, '2012-09-09 08:03:49', 0),
(35, '', '新年快乐22', 1000304217, '赵倩', '', NULL, '0000-00-00 00:00:00', 0),
(37, '', '明天要早起！', 1000304217, '赵倩', '', NULL, '2012-09-09 12:49:51', 0);
