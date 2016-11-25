-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-11-25 13:42:38
-- 服务器版本： 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_assist`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `uid` bigint(20) NOT NULL,
  `admin_id` bigint(20) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE `article` (
  `art_id` bigint(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `time` datetime NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `author` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `assists`
--

CREATE TABLE `assists` (
  `uid` bigint(20) NOT NULL,
  `assist_id` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `classes`
--

CREATE TABLE `classes` (
  `class_id` bigint(20) NOT NULL,
  `term` bit(1) NOT NULL,
  `year` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `class_teacher`
--

CREATE TABLE `class_teacher` (
  `class_id` bigint(20) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `assist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `com_id` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `author_id` varchar(20) NOT NULL,
  `target_id` bigint(20) NOT NULL,
  `time` datetime NOT NULL,
  `type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `course_info`
--

CREATE TABLE `course_info` (
  `info_id` bigint(20) NOT NULL,
  `course_name` text,
  `background` text,
  `course_plan` text,
  `textbook_precourse` text,
  `exam_homework` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `course_info`
--

INSERT INTO `course_info` (`info_id`, `course_name`, `background`, `course_plan`, `textbook_precourse`, `exam_homework`) VALUES
(100, '操作系统', '课程名称：操作系统原理 	课程号: 21120050\n周学时：3-0 	学分: 3\n\n教学目的和教学要求\n\n《操作系统》是计算机应用专业和计算机软件专业的专业基础课。\n\n通过本课程的学习，要求学生理解操作系统在计算机系统中的作用、地位和特点，熟练掌握和运用操作系统在进行计算机软硬件资源管理和调度时常用的概念、方法、策略、算法、手段等。\n\n通过对LINUX的介绍，了解操作系统的一般性体系结构，了解相关方向（如网络操作系统、分布式系统、操作系统安全等）的发展趋势。\n\n通过外文教材的讲授和学习，使学生在专业英语资料的阅读和理解上达到应有的水平。 ', ' 教学内容和课时分配\n\n操作系统理论教学内容模块\n	\n\n内容细节\n	\n\n学时\n\n　　概述\n	\n\n　OS概念，OS发展，OS组成，OS服务，OS硬件基础\n	\n\n3\n\n \n\n \n\n　进程管理\n	\n\n　进程与线程基础\n	\n\n3\n\n　进程调度分析\n	\n\n3\n\n　同步问题，原始软件法，硬件方法\n	\n\n3\n\n　信号量，用信号量来解决典型同步问题\n	\n\n3\n\n　管程等其他同步方法\n	\n\n3\n\n　死锁问题，死锁防止\n	\n\n3\n\n　死锁避免，死锁检测等\n	\n\n3\n\n \n\n　内存管理\n	\n\n　内存管理概述，内存映射机制，连续区域划分\n	\n\n3\n\n　分页管理，分段管理\n	\n\n3\n\n　虚拟内存概述，按需调页及分析\n	\n\n3\n\n　页面分配，页面置换，抖动\n	\n\n3\n\n \n\n　文件系统\n	\n\n　文件系统接口：文件、目录等的接口\n	\n\n3\n\n　文件系统接口：文件系统，虚拟文件系统\n	\n\n3\n\n　文件系统实现：文件系统、目录、文件等的实现\n	\n\n3\n\n　文件系统实现：磁盘接口，磁盘调度，磁盘管理\n	\n\n3\n\n　I/O系统\n	\n\n　I/O系统：概述，I/O API\n	\n\n3\n\n　I/O系统: 流，缓存，SPOOLING等\n	\n\n3\n\n \n\n操作系统实践教学内容模块\n	\n\n　内容细节\n	\n\n学时\n\n \n\n　Linux使用、系统编程、内\n核分析\n	\n\n　Linux使用与系统编程\n	\n\n6\n\n　Booting过程，内核模块、时钟\n	\n\n6\n\n　Linux系统调用机制\n	\n\n6\n\n　Linux文件系统VFS与ext2\n	\n\n6\n\n　Linux内存管理: x86, 分段,分页机制\n	\n\n6\n\n　Linux物理内存管理: Buddy, Slab\n	\n\n6\n\n　Linux进程管理: PCB,fork，调度\n	\n\n6\n\n　Linux进程管理：进程通信，同步原语\n	\n\n6\n\n　Linux设备管理: 设备驱动程序\n	\n\n6\n　图　例 	\n\n\n \n\n基本内容\n	\n\n\n中级内容\n	\n\n\n高级内容\n	\n\n\n难点\n', '\n教材\n\nAbraham Silberschatz，etc， Operating System Concepts. 7th edition. 高等教育出版社，2005。', 'Linux操作实验内容：\n\nLinux操作实验1\n起步 	\nLinux操作实验2\nLinux shell基本命令 	\nLinux操作实验3\n文件编辑 	\nLinux操作实验4\n文件和文件系统结构\n\nLinux操作实验5\n文件安全 	\nLinux操作实验6\n基本文件处理 	\nLinux操作实验7\n高级文件处理 	\nLinux操作实验8\n文件共享\n\nLinux操作实验9\n管道和I/O重定向 	\nLinux操作实验10\n进程 	\nLinux操作实验11\nBash编程 	\nLinux操作实验12\n高级Bash编程\n\nLinux内核分析实验内容\n\n实验1 编写制作Linux启动盘的shell脚本程序 	\n实验2 Linux进程创建 	\n实验3 编写一个简单的内核模块 	\n实验4 定时器的应用\n\n实验5 添加系统调用 	\n实验6 利用共享内存进行进程同步 	\n实验7 统计操作系统缺页次数 	\n实验8 一段时间内系统缺页次数\n\n实验9 设计一个同步机制 	\n\n\n实验10 改进进程调度算法\n	\n实验11 设计自己的驱动程序 	\n实验12 添加一个文件系统');

-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE `group` (
  `group_id` bigint(20) NOT NULL,
  `leader_id` varchar(20) NOT NULL,
  `member_num` int(11) NOT NULL,
  `group_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `homework`
--

CREATE TABLE `homework` (
  `hw_id` bigint(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `publish_time` datetime NOT NULL,
  `deadline` datetime NOT NULL,
  `class_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mail`
--

CREATE TABLE `mail` (
  `mail_id` bigint(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `time` datetime NOT NULL,
  `src_id` varchar(20) NOT NULL,
  `dest_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE `message` (
  `msg_id` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(20) NOT NULL,
  `time` datetime NOT NULL,
  `msg_state` varchar(1) NOT NULL,
  `reply_content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`msg_id`, `content`, `author`, `time`, `msg_state`, `reply_content`) VALUES
(1, 'test1消息', '匿名', '2016-11-25 00:00:00', '0', NULL),
(2, 'test2消息', '匿名', '2016-11-25 10:00:00', '0', NULL),
(3, 'test3消息', '匿名', '2016-11-25 10:00:00', '1', 'sdfsdf'),
(4, 'tttttest1', '游客(::1)', '2016-11-25 18:51:33', '1', '12312你好HELLO'),
(5, 'tttttest1', '游客(::1)', '2016-11-25 18:52:12', '0', NULL),
(6, 'HELLO你好￥%…………', '游客(::1)', '2016-11-25 19:04:56', '0', NULL),
(7, '士大夫士大夫', '游客(::1)', '2016-11-25 21:09:44', '0', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `notification`
--

CREATE TABLE `notification` (
  `noti_id` bigint(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `level` varchar(1) NOT NULL,
  `time` datetime NOT NULL,
  `class_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `posts`
--

CREATE TABLE `posts` (
  `post_id` bigint(20) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `section` varchar(1) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `author_id` varchar(20) NOT NULL,
  `group_id` bigint(20) DEFAULT NULL,
  `publish_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `questions`
--

CREATE TABLE `questions` (
  `ques_id` bigint(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `hw_id` bigint(20) NOT NULL,
  `submit_num` int(11) DEFAULT NULL,
  `average_score` int(11) DEFAULT NULL,
  `type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `reply_post`
--

CREATE TABLE `reply_post` (
  `repost_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `author_id` varchar(20) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `resource`
--

CREATE TABLE `resource` (
  `resrc_id` bigint(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `path` text NOT NULL,
  `size` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `type` varchar(1) NOT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `uploader_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE `student` (
  `uid` bigint(20) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `question1` text,
  `question2` text,
  `answer1` text,
  `answer2` text,
  `class_id` bigint(20) DEFAULT NULL,
  `group_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `teacher`
--

CREATE TABLE `teacher` (
  `uid` bigint(20) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `info_id` bigint(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `wechat` varchar(30) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `other_contact` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacher`
--

INSERT INTO `teacher` (`uid`, `teacher_id`, `password`, `name`, `info_id`, `phone`, `email`, `wechat`, `qq`, `other_contact`) VALUES
(1, '123456', '123456', '寿黎但', 100, '0571-87952026', 'should@zju.edu.cn', 'test', 'test', 'testtest'),
(2, '223456', '123456', '寿黎但2', 200, '0571-87952026', 'should@zju.edu.cn', 'test', 'test', 'testtest');

-- --------------------------------------------------------

--
-- 表的结构 `teacher_info`
--

CREATE TABLE `teacher_info` (
  `info_id` bigint(20) NOT NULL,
  `teach_experience` text,
  `profile` text,
  `honor` text,
  `other_info` text,
  `course_info` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacher_info`
--

INSERT INTO `teacher_info` (`info_id`, `teach_experience`, `profile`, `honor`, `other_info`, `course_info`) VALUES
(100, ' 1.讲授的主要课程\r\n\r\n课程名称\r\n	\r\n\r\n课程类别\r\n	\r\n\r\n周学时\r\n	\r\n\r\n届　数\r\n	\r\n\r\n学生人数\r\n\r\n　操作系统\r\n	\r\n\r\n　专业基础课\r\n	\r\n\r\n3\r\n	\r\n\r\n2008级起3届\r\n	\r\n\r\n约166人 ', '姓　　名 	　寿黎但 	性　别 	　男 	出生年月 	1974年11月\r\n　最终学历 	　博士研究生 	职　称 	　副教授 	电　　话 	0571-87952026\r\n　学　　位 	　博　士 	职　务 	  	传　　真 	 \r\n　所在院系 	　计算机学院 	E-mail 	\r\n\r\n　should@acm.org\r\nshould@zju.edu.cn\r\n　通信地址（邮编） 	　浙江省杭州市浙大路38号浙江大学计算机学院（310027）\r\n　研究方向 	　数据管理与信息获取', ' 2.教学研究课题\r\n\r\n课题名称\r\n	\r\n\r\n来　源\r\n	\r\n\r\n年　限\r\n	\r\n\r\n本人作用\r\n	\r\n\r\n完成情况\r\n\r\n　浙江大学“全英”课程建设\r\n	\r\n\r\n浙江大学\r\n	\r\n\r\n2010年起\r\n	\r\n\r\n参与\r\n	\r\n\r\n完成\r\n\r\n　浙江大学研究生“全英”教学课程建设\r\n	\r\n\r\n浙江大学\r\n	\r\n\r\n2010年起\r\n	\r\n\r\n负责人\r\n	\r\n\r\n在研 ', 'tetetetest', 'ttttttest'),
(200, 'ttteach_experience', 'ppprofile', 'hhhonor', 'ooother_info', 'cccourse_info');

-- --------------------------------------------------------

--
-- 表的结构 `works`
--

CREATE TABLE `works` (
  `work_id` bigint(20) NOT NULL,
  `ques_id` bigint(20) NOT NULL,
  `attachment` text NOT NULL,
  `content` text NOT NULL,
  `reply` text,
  `score` int(11) DEFAULT NULL,
  `uploader_id` varchar(20) NOT NULL,
  `type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uid` (`uid`) USING BTREE,
  ADD KEY `admin_id` (`admin_id`) USING BTREE;

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`art_id`),
  ADD UNIQUE KEY `art_id` (`art_id`) USING BTREE,
  ADD KEY `teacher_id` (`teacher_id`) USING BTREE;

--
-- Indexes for table `assists`
--
ALTER TABLE `assists`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uid` (`uid`) USING BTREE,
  ADD KEY `assist_id` (`assist_id`) USING BTREE;

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_id` (`class_id`) USING BTREE;

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`com_id`),
  ADD UNIQUE KEY `com_id` (`com_id`) USING BTREE,
  ADD KEY `target_id` (`target_id`) USING BTREE,
  ADD KEY `type` (`type`) USING BTREE;

--
-- Indexes for table `course_info`
--
ALTER TABLE `course_info`
  ADD PRIMARY KEY (`info_id`),
  ADD UNIQUE KEY `info_id` (`info_id`) USING BTREE;

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`) USING BTREE;

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`hw_id`),
  ADD UNIQUE KEY `hw_id` (`hw_id`) USING BTREE;

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`mail_id`),
  ADD UNIQUE KEY `mail_id` (`mail_id`) USING BTREE,
  ADD KEY `src_id` (`src_id`) USING BTREE,
  ADD KEY `dest_id` (`dest_id`) USING BTREE;

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`),
  ADD UNIQUE KEY `msg_id` (`msg_id`) USING BTREE;

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`noti_id`),
  ADD UNIQUE KEY `noti_id` (`noti_id`) USING BTREE,
  ADD KEY `class_id` (`class_id`) USING BTREE;

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`) USING BTREE,
  ADD KEY `teacher_id` (`teacher_id`) USING BTREE;

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ques_id`),
  ADD UNIQUE KEY `ques_id` (`ques_id`) USING BTREE,
  ADD KEY `hw_id` (`hw_id`) USING BTREE;

--
-- Indexes for table `reply_post`
--
ALTER TABLE `reply_post`
  ADD PRIMARY KEY (`repost_id`),
  ADD UNIQUE KEY `repost_id` (`repost_id`) USING BTREE,
  ADD KEY `post_id` (`post_id`) USING BTREE;

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`resrc_id`),
  ADD UNIQUE KEY `resrc_id` (`resrc_id`) USING BTREE,
  ADD KEY `post_id` (`post_id`) USING BTREE;

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uid` (`uid`) USING BTREE,
  ADD UNIQUE KEY `student_id` (`student_id`) USING BTREE;

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uid` (`uid`) USING BTREE,
  ADD UNIQUE KEY `teacher_id` (`teacher_id`) USING BTREE;

--
-- Indexes for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD PRIMARY KEY (`info_id`),
  ADD UNIQUE KEY `info_id` (`info_id`) USING BTREE;

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`work_id`),
  ADD UNIQUE KEY `work_id` (`work_id`) USING BTREE,
  ADD KEY `ques_id` (`ques_id`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `uid` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `art_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `assists`
--
ALTER TABLE `assists`
  MODIFY `uid` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `com_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `course_info`
--
ALTER TABLE `course_info`
  MODIFY `info_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- 使用表AUTO_INCREMENT `group`
--
ALTER TABLE `group`
  MODIFY `group_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `homework`
--
ALTER TABLE `homework`
  MODIFY `hw_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `mail`
--
ALTER TABLE `mail`
  MODIFY `mail_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `notification`
--
ALTER TABLE `notification`
  MODIFY `noti_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `questions`
--
ALTER TABLE `questions`
  MODIFY `ques_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `reply_post`
--
ALTER TABLE `reply_post`
  MODIFY `repost_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `resource`
--
ALTER TABLE `resource`
  MODIFY `resrc_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `student`
--
ALTER TABLE `student`
  MODIFY `uid` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `teacher`
--
ALTER TABLE `teacher`
  MODIFY `uid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `teacher_info`
--
ALTER TABLE `teacher_info`
  MODIFY `info_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;
--
-- 使用表AUTO_INCREMENT `works`
--
ALTER TABLE `works`
  MODIFY `work_id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
