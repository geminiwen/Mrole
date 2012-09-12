/*
MySQL Data Transfer
Source Host: 192.168.37.128
Source Database: mrole
Target Host: 192.168.37.128
Target Database: mrole
Date: 2012/9/13 0:21:34
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for friend
-- ----------------------------
CREATE TABLE `friend` (
  `user_id` varchar(10) NOT NULL,
  `friend_id` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`,`friend_id`),
  KEY `FK_TO` (`friend_id`),
  CONSTRAINT `FK_TO` FOREIGN KEY (`friend_id`) REFERENCES `stu_info` (`stu_username`),
  CONSTRAINT `FK_FROM` FOREIGN KEY (`user_id`) REFERENCES `stu_info` (`stu_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for status
-- ----------------------------
CREATE TABLE `status` (
  `status_no` int(11) NOT NULL AUTO_INCREMENT,
  `status_user` varchar(10) NOT NULL,
  `status_cotent` varchar(480) NOT NULL,
  `status_pic` varchar(530) DEFAULT NULL,
  `status_url` varchar(530) DEFAULT NULL,
  `status_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`status_no`),
  KEY `FK_USER` (`status_user`),
  CONSTRAINT `FK_USER` FOREIGN KEY (`status_user`) REFERENCES `stu_info` (`stu_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for stu_info
-- ----------------------------
CREATE TABLE `stu_info` (
  `stu_username` varchar(10) NOT NULL,
  `stu_realname` varchar(8) NOT NULL,
  `stu_password` varchar(32) DEFAULT NULL,
  `stu_job` varchar(30) DEFAULT NULL,
  `stu_birthday` date DEFAULT NULL,
  `stu_email` varchar(50) DEFAULT NULL,
  `stu_checked` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`stu_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `stu_info` VALUES ('0900301214', '温盛章', null, '学生会', '1992-06-17', '14291050@qq.com', '');
INSERT INTO `stu_info` VALUES ('1000304217', '赵倩', 'ea6e62b14aa383989c1545e29df0f27e', '团支书', '1991-12-07', '453255811@qq.com', '');
