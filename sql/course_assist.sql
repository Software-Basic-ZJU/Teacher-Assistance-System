/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50622
Source Host           : localhost:3306
Source Database       : course_assist

Target Server Type    : MYSQL
Target Server Version : 50622
File Encoding         : 65001

Date: 2016-12-16 22:42:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('10000', 'admin', '6LzEFTTAytZMZ+b3poFASw==');

-- ----------------------------
-- Table structure for `article`
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
) ENGINE=InnoDB AUTO_INCREMENT=10022 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('10000', '今天去游玩', '真的好好玩&lt;p&gt;SADFSDFS&lt;/p&gt;', '2016-12-09 20:28:39', '1234567', '杨奕辉', '0');
INSERT INTO `article` VALUES ('10001', '阿斯顿发生', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '2016-12-09 19:53:34', '1234567', '', '0');
INSERT INTO `article` VALUES ('10002', '撒旦法撒旦', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '2016-12-09 19:59:33', '1234567', '发送到发', '0');
INSERT INTO `article` VALUES ('10003', '撒旦法撒旦', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '2016-12-09 19:59:50', '1234567', '发送到发', '0');
INSERT INTO `article` VALUES ('10004', 'asdf', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '2016-12-09 20:02:56', '1234567', 'sdfsd', '0');
INSERT INTO `article` VALUES ('10017', '今天去游玩', '真的好好玩&amp;amp;lt;p&amp;amp;gt;SADFSDFS&amp;amp;lt;/p&amp;amp;gt;&amp;lt;p&amp;gt;双方都胜多负少东方闪电&amp;lt;/p&amp;gt;&lt;p&gt;撒旦法撒旦&lt;/p&gt;', '2016-12-09 20:41:26', '1234567', '杨奕辉', '0');
INSERT INTO `article` VALUES ('10018', '今天去游玩', '真的好好玩&amp;amp;lt;p&amp;amp;gt;SADFSDFS&amp;amp;lt;/p&amp;amp;gt;&amp;lt;p&amp;gt;双方都胜多负少东方闪电&amp;lt;/p&amp;gt;&lt;p&gt;范德萨范德萨&lt;/p&gt;', '2016-12-09 20:42:45', '1234567', '杨奕辉', '0');
INSERT INTO `article` VALUES ('10020', '水电费', '&amp;lt;p&amp;gt;&amp;lt;br&amp;gt;&amp;lt;/p&amp;gt;&lt;p&gt;发斯蒂芬&lt;/p&gt;', '2016-12-09 20:47:15', '1234567', '地方', '0');
INSERT INTO `article` VALUES ('10021', 'dsfsd', '&amp;amp;amp;lt;p&amp;amp;amp;gt;&amp;amp;amp;lt;br&amp;amp;amp;gt;&amp;amp;amp;lt;/p&amp;amp;amp;gt;&amp;amp;lt;p&amp;amp;gt;东方闪电地方&amp;amp;lt;/p&amp;amp;gt;&amp;lt;p&amp;gt;&amp;lt;br&amp;gt;&amp;lt;/p&amp;gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '2016-12-16 21:13:54', '1234567', 'dsfdsfsd', '0');

-- ----------------------------
-- Table structure for `assists`
-- ----------------------------
DROP TABLE IF EXISTS `assists`;
CREATE TABLE `assists` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `assist_id` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  KEY `assist_id` (`assist_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of assists
-- ----------------------------

-- ----------------------------
-- Table structure for `classes`
-- ----------------------------
DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes` (
  `class_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `term` bit(1) NOT NULL,
  `year` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `class_id` (`class_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10003 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of classes
-- ----------------------------
INSERT INTO `classes` VALUES ('10001', '', '2016', '软工1班');
INSERT INTO `classes` VALUES ('10002', '', '2016', '软工2班');

-- ----------------------------
-- Table structure for `class_teacher`
-- ----------------------------
DROP TABLE IF EXISTS `class_teacher`;
CREATE TABLE `class_teacher` (
  `class_id` bigint(20) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `assist_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of class_teacher
-- ----------------------------
INSERT INTO `class_teacher` VALUES ('10001', '1234567', null);
INSERT INTO `class_teacher` VALUES ('10002', '1234567', null);

-- ----------------------------
-- Table structure for `comment`
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
) ENGINE=InnoDB AUTO_INCREMENT=10032 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('10019', 'fdfd', 'yyh1102', '10003', '2016-12-15 23:24:47', '1');
INSERT INTO `comment` VALUES ('10020', '回复吴志强：fdfd', 'yyh1102', '10003', '2016-12-15 23:24:50', '1');
INSERT INTO `comment` VALUES ('10021', '回复吴志强：fdsf', 'yyh1102', '10003', '2016-12-15 23:25:00', '1');
INSERT INTO `comment` VALUES ('10030', '发生的范德萨', 'yyh1102', '10004', '2016-12-16 17:50:27', '1');

-- ----------------------------
-- Table structure for `course_info`
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
-- Records of course_info
-- ----------------------------

-- ----------------------------
-- Table structure for `group`
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `group_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `leader_id` varchar(20) NOT NULL,
  `group_name` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `class_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `group_id` (`group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10010 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group
-- ----------------------------

-- ----------------------------
-- Table structure for `homework`
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
) ENGINE=InnoDB AUTO_INCREMENT=10006 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of homework
-- ----------------------------
INSERT INTO `homework` VALUES ('10001', '第二次作业', '2016-12-10 21:36:52', '2016-12-17 21:36:55', '10002', '1', '0', '0', '0.8');
INSERT INTO `homework` VALUES ('10005', '第三方', '2016-12-13 12:43:54', '2016-12-21 00:43:50', '10001', '0', '1', '0', '0');

-- ----------------------------
-- Table structure for `mail`
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
) ENGINE=InnoDB AUTO_INCREMENT=10025 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mail
-- ----------------------------
INSERT INTO `mail` VALUES ('10000', 'hihi', '啊哈哈', '2016-12-16 14:07:32', 'yyh1102', 'yyh951102', '1', '2');
INSERT INTO `mail` VALUES ('10001', '防守打法', '方法水电费', '2016-12-16 14:08:57', 'yyh1102', 'yyh951102', '1', '0');
INSERT INTO `mail` VALUES ('10002', 'fdsf鼎折覆餗', '胜多负少', '2016-12-15 14:23:16', 'yyh951102', '1234567', '0', '0');
INSERT INTO `mail` VALUES ('10003', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '1');
INSERT INTO `mail` VALUES ('10004', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '1');
INSERT INTO `mail` VALUES ('10005', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '1');
INSERT INTO `mail` VALUES ('10006', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '1');
INSERT INTO `mail` VALUES ('10007', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '1');
INSERT INTO `mail` VALUES ('10008', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '1');
INSERT INTO `mail` VALUES ('10009', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '1');
INSERT INTO `mail` VALUES ('10010', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '1');
INSERT INTO `mail` VALUES ('10011', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '0');
INSERT INTO `mail` VALUES ('10012', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '0');
INSERT INTO `mail` VALUES ('10013', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '0');
INSERT INTO `mail` VALUES ('10014', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '0');
INSERT INTO `mail` VALUES ('10015', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '0');
INSERT INTO `mail` VALUES ('10016', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '0');
INSERT INTO `mail` VALUES ('10017', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '0');
INSERT INTO `mail` VALUES ('10018', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '1');
INSERT INTO `mail` VALUES ('10019', '测试', '测试测试', '2016-12-16 14:07:32', 'yyh951102', 'yyh1102', '1', '0');
INSERT INTO `mail` VALUES ('10020', '回复 杨奕辉：测试', 'sdfs地方', '2016-12-16 15:45:34', 'yyh1102', 'yyh951102', '0', '0');
INSERT INTO `mail` VALUES ('10021', '回复 杨奕辉：测试', '水电费', '2016-12-16 15:46:52', 'yyh1102', 'yyh951102', '0', '0');
INSERT INTO `mail` VALUES ('10022', '回复 杨奕辉：测试', '似懂非懂是', '2016-12-16 16:57:49', 'yyh1102', 'yyh951102', '0', '0');
INSERT INTO `mail` VALUES ('10023', '回复 杨奕辉：测试', '撒旦法撒旦', '2016-12-16 17:02:10', 'yyh1102', 'yyh951102', '0', '0');
INSERT INTO `mail` VALUES ('10024', 'sds', 'd f', '2016-12-16 17:13:22', 'yyh1102', 'yyh951102', '0', '0');

-- ----------------------------
-- Table structure for `message`
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
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------

-- ----------------------------
-- Table structure for `notification`
-- ----------------------------
DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `noti_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `level` varchar(1) NOT NULL,
  `time` datetime NOT NULL,
  `teacher_id` varchar(30) NOT NULL,
  PRIMARY KEY (`noti_id`),
  UNIQUE KEY `noti_id` (`noti_id`) USING BTREE,
  KEY `class_id` (`teacher_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10024 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notification
-- ----------------------------
INSERT INTO `notification` VALUES ('10001', 'asdf', '&lt;p&gt;fsdfs&lt;/p&gt;', '0', '2016-12-09 16:27:00', '1234567');
INSERT INTO `notification` VALUES ('10002', 'fasdf', '&lt;p&gt;fsdaf&lt;/p&gt;', '0', '2016-12-09 16:27:39', '1234567');
INSERT INTO `notification` VALUES ('10004', 'fadsfas', '&lt;p&gt;fsdfsd&lt;/p&gt;', '0', '2016-12-09 16:33:10', '1234567');
INSERT INTO `notification` VALUES ('10008', '反倒是反倒是', '&lt;p&gt;范德萨发的&lt;/p&gt;', '0', '2016-12-09 18:09:15', '1234567');
INSERT INTO `notification` VALUES ('10011', '的所得税法', '&lt;p&gt;鼎折覆餗的&lt;/p&gt;', '1', '2016-12-09 21:55:43', '1234567');
INSERT INTO `notification` VALUES ('10019', 'fsdfsd撒旦法撒旦', '&lt;p&gt;发送到&lt;/p&gt;', '0', '2016-12-09 22:40:56', '1234567');
INSERT INTO `notification` VALUES ('10020', 'fsdfsd撒旦法撒旦', '&lt;p&gt;发送到发生的发生的&lt;/p&gt;', '0', '2016-12-09 22:41:05', '1234567');
INSERT INTO `notification` VALUES ('10021', 'fsdfsd', '&lt;p&gt;水电费&lt;/p&gt;', '0', '2016-12-09 22:42:35', '1234567');
INSERT INTO `notification` VALUES ('10022', 'testtset', '&lt;p&gt;水电费&lt;/p&gt;', '0', '2016-12-09 22:42:47', '1234567');
INSERT INTO `notification` VALUES ('10023', '范德萨范德萨', '&lt;p&gt;fdsfs 等等&lt;/p&gt;', '1', '2016-12-11 17:51:34', '1234567');

-- ----------------------------
-- Table structure for `posts`
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
) ENGINE=InnoDB AUTO_INCREMENT=10016 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('10000', '1234567', '0', '第一次发帖', '请多多关照', '1234567', null, '2016-12-12 18:39:11', '2016-12-12 18:39:15');
INSERT INTO `posts` VALUES ('10001', '1234567', '0', '的神烦大叔', '&lt;p&gt;的神烦大叔&lt;/p&gt;', '1234567', '0', '2016-12-12 22:11:48', '2016-12-12 22:11:48');
INSERT INTO `posts` VALUES ('10002', '1234567', '0', '分到f', '&lt;p&gt;撒旦法撒旦&lt;/p&gt;', '1234567', '0', '2016-12-13 19:56:57', '2016-12-13 19:56:57');
INSERT INTO `posts` VALUES ('10006', '1234567', '1', 'Hello world', '&lt;p&gt;今日第一帖~&lt;/p&gt;', 'yyh1102', '0', '2016-12-15 23:24:17', '2016-12-15 23:24:17');
INSERT INTO `posts` VALUES ('10010', '1234567', '0', '撒旦法撒旦', '&lt;p&gt;第三方&lt;/p&gt;', 'yyh951102', '0', '2016-12-16 13:47:34', '2016-12-16 13:47:34');
INSERT INTO `posts` VALUES ('10011', '1234567', '0', '', '&lt;p&gt;ffdsf&lt;/p&gt;', 'yyh951102', '0', '2016-12-16 13:49:27', '2016-12-16 13:49:27');
INSERT INTO `posts` VALUES ('10012', '1234567', '0', '的所发生的', '&lt;p&gt;等等&lt;/p&gt;', 'yyh951102', '0', '2016-12-16 13:49:37', '2016-12-16 13:49:37');
INSERT INTO `posts` VALUES ('10013', '1234567', '0', '发的所发生的', '&lt;p&gt;的所发生的&lt;/p&gt;', 'yyh951102', '0', '2016-12-16 13:50:44', '2016-12-16 13:50:44');
INSERT INTO `posts` VALUES ('10014', '1234567', '0', '防守打法', '&lt;p&gt;上的&amp;nbsp;&lt;/p&gt;', 'yyh951102', '0', '2016-12-16 13:50:46', '2016-12-16 13:50:46');
INSERT INTO `posts` VALUES ('10015', '1234567', '0', '佛挡杀佛', '&lt;p&gt;发送到&lt;/p&gt;', 'yyh951102', '0', '2016-12-16 13:50:49', '2016-12-16 13:50:49');

-- ----------------------------
-- Table structure for `questions`
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
) ENGINE=InnoDB AUTO_INCREMENT=10005 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES ('10004', '辅导辅导', '&lt;p&gt;佛挡杀佛&lt;/p&gt;', '10005', '1', '100', '0', '1');

-- ----------------------------
-- Table structure for `reply_post`
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
) ENGINE=InnoDB AUTO_INCREMENT=10005 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reply_post
-- ----------------------------
INSERT INTO `reply_post` VALUES ('10001', '10000', '第三方', 'yyh951102', '2016-12-15 01:55:06');
INSERT INTO `reply_post` VALUES ('10002', '10000', '反倒是', 'yyh951102', '2016-12-15 01:57:18');
INSERT INTO `reply_post` VALUES ('10003', '10006', 'df地方', 'yyh1102', '2016-12-15 23:24:42');
INSERT INTO `reply_post` VALUES ('10004', '10015', '的神烦大叔', 'yyh1102', '2016-12-16 17:42:21');

-- ----------------------------
-- Table structure for `resource`
-- ----------------------------
DROP TABLE IF EXISTS `resource`;
CREATE TABLE `resource` (
  `resrc_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `size` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `type` varchar(1) NOT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `uploader_id` varchar(20) NOT NULL,
  `authority` varchar(1) NOT NULL,
  PRIMARY KEY (`resrc_id`),
  UNIQUE KEY `resrc_id` (`resrc_id`) USING BTREE,
  KEY `post_id` (`post_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10122 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of resource
-- ----------------------------
INSERT INTO `resource` VALUES ('10120', '方式的说法', 'upload/4207d913b1f15f2b425c9156.docx', '13401', '2016-12-15 23:49:33', '0', '0', '1234567', '0');

-- ----------------------------
-- Table structure for `student`
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `question1` text,
  `question2` text,
  `answer1` text,
  `answer2` text,
  `class_id` bigint(20) DEFAULT NULL,
  `group_id` bigint(20) DEFAULT NULL,
  `check_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  UNIQUE KEY `student_id` (`student_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10002 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('10000', 'yyh951102', '6LzEFTTAytZMZ+b3poFASw==', '杨奕辉', null, null, null, null, null, '10001', '-1', null);
INSERT INTO `student` VALUES ('10001', 'yyh1102', 'B050OB3jAk8DOYTnHBZdsA==', '吴志强', '234347589@qq.com', '我的大学', '我的家乡', 'Momw54cmlc/kebIoVqsKRIkQeAVcFQRf', 'KBkgkPrS81W/Xqyhz7YtDQ==', '10001', '-1', '298660');

-- ----------------------------
-- Table structure for `teacher`
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `teacher_id` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `wechat` varchar(30) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `other_contact` text,
  `teacher_info` text,
  `course_info` text,
  `photo_path` text,
  `check_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  UNIQUE KEY `teacher_id` (`teacher_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('10000', '1234567', '6LzEFTTAytZMZ+b3poFASw==', '杨奕辉', '分到', '234347589@qq.com', '发送到', '地方', '防守打法', '这是教师信息fsdfsd都是&amp;lt;p&amp;gt;ds fsd&amp;lt;/p&amp;gt;&lt;p&gt;f第三方水电费&lt;/p&gt;', '&lt;p&gt;这是课程信息&amp;amp;lt;p&amp;amp;gt;asdfsdfsdf&amp;amp;lt;/p&amp;amp;gt;&amp;lt;p&amp;gt;sdfsd&amp;lt;/p&amp;gt;&lt;/p&gt;&lt;h2&gt;dfdfgdf&lt;/h2&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', null, '');

-- ----------------------------
-- Table structure for `works`
-- ----------------------------
DROP TABLE IF EXISTS `works`;
CREATE TABLE `works` (
  `work_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ques_id` bigint(20) NOT NULL,
  `resrc_id` bigint(20) DEFAULT NULL,
  `content` text,
  `reply` text,
  `score` int(11) DEFAULT NULL,
  `uploader_id` varchar(20) NOT NULL,
  `finish` varchar(1) NOT NULL,
  PRIMARY KEY (`work_id`),
  UNIQUE KEY `work_id` (`work_id`) USING BTREE,
  KEY `ques_id` (`ques_id`) USING BTREE,
  KEY `uploader_id` (`uploader_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of works
-- ----------------------------
INSERT INTO `works` VALUES ('10000', '10004', '10114', 'dsf 第三方&amp;lt;p&amp;gt;d&amp;lt;/p&amp;gt;方法', '最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的最吼的', '100', 'yyh951102', '1');
