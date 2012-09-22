-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 09 月 22 日 10:55
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
-- 表的结构 `album_info`
--

CREATE TABLE IF NOT EXISTS `album_info` (
  `album_name` varchar(50) NOT NULL COMMENT '相册名',
  `album_user` varchar(10) NOT NULL COMMENT '学号',
  `build_time` datetime NOT NULL COMMENT '建立时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`album_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `album_info`
--

INSERT INTO `album_info` (`album_name`, `album_user`, `build_time`, `update_time`) VALUES
('zhaoqian', '1000304217', '2012-09-22 18:39:42', '2012-09-22 18:44:59');

-- --------------------------------------------------------

--
-- 表的结构 `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `ID` int(20) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `user_id` varchar(10) NOT NULL COMMENT '学号',
  `friend_id` varchar(10) NOT NULL COMMENT '好友学号',
  `type` int(2) NOT NULL COMMENT '是好友或者关注者',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `friend`
--

INSERT INTO `friend` (`ID`, `user_id`, `friend_id`, `type`) VALUES
(19, '1000304217', '1000304217', 0),
(17, '1000304217', '1000304217', 0),
(18, '0900301214', '0900301214', 0);

-- --------------------------------------------------------

--
-- 表的结构 `photo_info`
--

CREATE TABLE IF NOT EXISTS `photo_info` (
  `photo_name` varchar(50) NOT NULL COMMENT '文件（照片）名',
  `photo_album_name` varchar(50) NOT NULL COMMENT '照片所属相册名',
  `photo_user` varchar(10) NOT NULL COMMENT '学号',
  `upload_time` date NOT NULL COMMENT '上传时间',
  PRIMARY KEY (`photo_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `photo_info`
--

INSERT INTO `photo_info` (`photo_name`, `photo_album_name`, `photo_user`, `upload_time`) VALUES
('hello', 'zhaoqian', '1000304217', '2012-09-22'),
('happy', 'zhaoqian', '1000304217', '2012-09-22');

-- --------------------------------------------------------

--
-- 表的结构 `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(20) NOT NULL AUTO_INCREMENT COMMENT '状态编号',
  `status_user` varchar(10) NOT NULL COMMENT '学号',
  `status_content` varchar(500) NOT NULL COMMENT '内容',
  `status_time` datetime NOT NULL COMMENT '发表时间',
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `status`
--


-- --------------------------------------------------------

--
-- 表的结构 `status_comment`
--

CREATE TABLE IF NOT EXISTS `status_comment` (
  `comment_id` int(20) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `comment_status_id` int(20) NOT NULL COMMENT '对应状态序号',
  `comment_user` varchar(10) NOT NULL COMMENT '学号',
  `comment_content` varchar(500) NOT NULL COMMENT '评论内容',
  `comment_time` datetime NOT NULL COMMENT '评论时间',
  `comment_reply_id` int(20) NOT NULL COMMENT '回复评论对应的评论号',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `status_comment`
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
('0900301214', '温盛章', '948b5904da610204ec4edff8a069bf3b', '会长', '1992-06-07', '123@qq.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, b'1'),
('1000304217', '赵倩', 'cc9f4328e026878631d31720239402d3', '团支书', '1991-12-07', '453255811@qq.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, b'1');
