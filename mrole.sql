-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 09 月 19 日 11:04
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
-- 表的结构 `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `user_id` varchar(10) NOT NULL COMMENT '学号',
  `friend_id` varchar(10) NOT NULL COMMENT '好友学号',
  `type` int(2) NOT NULL COMMENT '是好友或者关注者',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `friend`
--

INSERT INTO `friend` (`user_id`, `friend_id`, `type`) VALUES
('1000304217', '0900301214', 0);

-- --------------------------------------------------------

--
-- 表的结构 `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(20) NOT NULL AUTO_INCREMENT COMMENT '状态编号',
  `status_user` varchar(10) NOT NULL COMMENT '学号',
  `status_content` varchar(500) NOT NULL COMMENT '内容',
  `status_time` datetime NOT NULL COMMENT '发表时间',
  `status_comment_num` int(10) NOT NULL COMMENT '评论数',
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `status`
--


-- --------------------------------------------------------

--
-- 表的结构 `stu_info`
--

CREATE TABLE IF NOT EXISTS `stu_info` (
  `stu_username` varchar(10) NOT NULL COMMENT '学号',
  `stu_realname` varchar(8) NOT NULL COMMENT '姓名',
  `stu_password` varchar(32) DEFAULT NULL COMMENT '密码',
  `stu_job` varchar(30) DEFAULT NULL COMMENT '职位',
  `stu_birthday` date DEFAULT NULL COMMENT '生日',
  `stu_email` varchar(50) DEFAULT NULL COMMENT '电邮',
  `stu_sex` varchar(10) DEFAULT NULL COMMENT '性别',
  `stu_sex2` varchar(10) DEFAULT NULL COMMENT '性向',
  `stu_constellation` varchar(10) DEFAULT NULL COMMENT '星座',
  `stu_school` varchar(10) DEFAULT NULL COMMENT '学校',
  `stu_college` varchar(10) DEFAULT NULL COMMENT '学院',
  `stu_class` varchar(10) DEFAULT NULL COMMENT '班级',
  `stu_tel` varchar(15) DEFAULT NULL COMMENT '手机号',
  `stu_question` varchar(50) DEFAULT NULL COMMENT '保密问题',
  `stu_answer` varchar(50) DEFAULT NULL COMMENT '保密问题答案',
  `stu_checked` bit(1) NOT NULL COMMENT '是否已注册',
  PRIMARY KEY (`stu_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `stu_info`
--

INSERT INTO `stu_info` (`stu_username`, `stu_realname`, `stu_password`, `stu_job`, `stu_birthday`, `stu_email`, `stu_sex`, `stu_sex2`, `stu_constellation`, `stu_school`, `stu_college`, `stu_class`, `stu_tel`, `stu_question`, `stu_answer`, `stu_checked`) VALUES
('0900301214', '温盛章', NULL, '学生会', '1992-06-17', '14291050@qq.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, b'1'),
('1000304217', '赵倩', 'ea6e62b14aa383989c1545e29df0f27e', '班长', '1991-12-07', '453255811@qq.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, b'0');
