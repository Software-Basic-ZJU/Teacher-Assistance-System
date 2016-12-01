/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100110
 Source Host           : localhost
 Source Database       : course_assist

 Target Server Type    : MySQL
 Target Server Version : 100110
 File Encoding         : utf-8

 Date: 12/01/2016 15:32:04 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `art_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `time` datetime NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `author` varchar(20) NOT NULL,
  `authority` varchar(1) NOT NULL,
  PRIMARY KEY (`art_id`),
  UNIQUE KEY `art_id` (`art_id`) USING BTREE,
  KEY `teacher_id` (`teacher_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `assists`
-- ----------------------------
DROP TABLE IF EXISTS `assists`;
CREATE TABLE `assists` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `assist_id` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  KEY `assist_id` (`assist_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `class_teacher`
-- ----------------------------
DROP TABLE IF EXISTS `class_teacher`;
CREATE TABLE `class_teacher` (
  `class_id` bigint(20) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `assist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `classes`
-- ----------------------------
DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes` (
  `class_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `term` bit(1) NOT NULL,
  `year` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `class_id` (`class_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `comment`
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `com_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` text,
  `author_id` varchar(20) NOT NULL,
  `target_id` bigint(20) NOT NULL,
  `time` datetime NOT NULL,
  `type` varchar(1) NOT NULL,
  PRIMARY KEY (`com_id`),
  UNIQUE KEY `com_id` (`com_id`) USING BTREE,
  KEY `target_id` (`target_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `course_info`
-- ----------------------------
DROP TABLE IF EXISTS `course_info`;
CREATE TABLE `course_info` (
  `info_id` bigint(20) NOT NULL,
  `course_name` text,
  `background` text,
  `course_plan` text,
  `textbook_precourse` text,
  `exam_homework` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `group`
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `group_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `leader_id` varchar(20) NOT NULL,
  `member_num` int(11) NOT NULL,
  `group_name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `group_id` (`group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `homework`
-- ----------------------------
DROP TABLE IF EXISTS `homework`;
CREATE TABLE `homework` (
  `hw_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `publish_time` datetime NOT NULL,
  `deadline` datetime NOT NULL,
  `class_id` bigint(20) NOT NULL,
  `type` varchar(1) NOT NULL,
  `over` varchar(1) NOT NULL,
  `punish_type` varchar(1) NOT NULL,
  `punish_rate` float DEFAULT NULL,
  PRIMARY KEY (`hw_id`),
  UNIQUE KEY `hw_id` (`hw_id`) USING BTREE,
  KEY `class_id` (`class_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `mail`
-- ----------------------------
DROP TABLE IF EXISTS `mail`;
CREATE TABLE `mail` (
  `mail_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `time` datetime NOT NULL,
  `src_id` varchar(20) NOT NULL,
  `dest_id` varchar(20) NOT NULL,
  `is_read` varchar(1) NOT NULL,
  `flag` varchar(1) NOT NULL,
  PRIMARY KEY (`mail_id`),
  UNIQUE KEY `mail_id` (`mail_id`) USING BTREE,
  KEY `src_id` (`src_id`) USING BTREE,
  KEY `dest_id` (`dest_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `msg_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `author` varchar(20) NOT NULL,
  `time` datetime NOT NULL,
  `msg_state` varchar(1) NOT NULL,
  PRIMARY KEY (`msg_id`),
  UNIQUE KEY `msg_id` (`msg_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `notification`
-- ----------------------------
DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `noti_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `level` varchar(1) NOT NULL,
  `time` datetime NOT NULL,
  `class_id` bigint(20) NOT NULL,
  PRIMARY KEY (`noti_id`),
  UNIQUE KEY `noti_id` (`noti_id`) USING BTREE,
  KEY `class_id` (`class_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `teacher_id` varchar(20) NOT NULL,
  `section` varchar(1) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `author_id` varchar(20) NOT NULL,
  `group_id` bigint(20) DEFAULT NULL,
  `publish_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`post_id`),
  UNIQUE KEY `post_id` (`post_id`) USING BTREE,
  KEY `teacher_id` (`teacher_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `questions`
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `ques_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `hw_id` bigint(20) NOT NULL,
  `submit_num` int(11) DEFAULT NULL,
  `average_score` int(11) DEFAULT NULL,
  `type` varchar(1) NOT NULL,
  `ques_finish` varchar(1) NOT NULL,
  PRIMARY KEY (`ques_id`),
  UNIQUE KEY `ques_id` (`ques_id`) USING BTREE,
  KEY `hw_id` (`hw_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `reply_post`
-- ----------------------------
DROP TABLE IF EXISTS `reply_post`;
CREATE TABLE `reply_post` (
  `repost_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `author_id` varchar(20) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`repost_id`),
  UNIQUE KEY `repost_id` (`repost_id`) USING BTREE,
  KEY `post_id` (`post_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `resource`
-- ----------------------------
DROP TABLE IF EXISTS `resource`;
CREATE TABLE `resource` (
  `resrc_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `path` text NOT NULL,
  `size` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `type` varchar(1) NOT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `uploader_id` varchar(20) NOT NULL,
  PRIMARY KEY (`resrc_id`),
  UNIQUE KEY `resrc_id` (`resrc_id`) USING BTREE,
  KEY `post_id` (`post_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `student`
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `question1` text,
  `question2` text,
  `answer1` text,
  `answer2` text,
  `class_id` bigint(20) DEFAULT NULL,
  `group_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  UNIQUE KEY `student_id` (`student_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `teacher`
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `teacher_id` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `wechat` varchar(30) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `other_contact` text,
  `teacher_info` text,
  `course_info` text,
  `photo_path` text,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  UNIQUE KEY `teacher_id` (`teacher_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `works`
-- ----------------------------
DROP TABLE IF EXISTS `works`;
CREATE TABLE `works` (
  `work_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ques_id` bigint(20) NOT NULL,
  `attachment` text,
  `content` text,
  `reply` text,
  `score` int(11) DEFAULT NULL,
  `uploader_id` varchar(20) NOT NULL,
  `type` varchar(1) NOT NULL,
  PRIMARY KEY (`work_id`),
  UNIQUE KEY `work_id` (`work_id`) USING BTREE,
  KEY `ques_id` (`ques_id`) USING BTREE,
  KEY `uploader_id` (`uploader_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
