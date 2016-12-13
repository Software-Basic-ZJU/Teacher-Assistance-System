/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50622
Source Host           : localhost:3306
Source Database       : course_assist

Target Server Type    : MYSQL
Target Server Version : 50622
File Encoding         : 65001

Date: 2016-12-12 22:54:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------

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
INSERT INTO `article` VALUES ('10021', 'dsfsd', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '2016-12-09 22:23:06', '1234567', 'dsfdsfsd', '0');

-- ----------------------------
-- 插入首页展示的三篇文章
-- ----------------------------
INSERT INTO `article` (`art_id`, `title`, `content`, `time`, `teacher_id`, `author`,`authority`) VALUES
(1, '关于公布《微积分（甲）Ⅰ》等数学物理化学类课程层次关系的通知', '各位同学：\n因2016级培养方案修订，部分数学、物理、化学类课程纳入自然科学类通识课程，其内容、名称、学分及课程代码有所调整，现就各相关课程间层次关系通知如下： \n一、自然科学类通识新课程之间层次关系\n开课院系	课程代码	课程名称	学分	层次关系	课程代码	课程名称	学分	层次关系	课程代码	课程名称	学分	层次关系	课程代码	课程名称	学分\n数学学院	821T0070	数学分析Ⅰ	4.5	＞	821T0010	微积分(甲)Ⅰ	4.5	＞	821T0030	微积分(乙)Ⅰ	4.5				\n	821T0080	数学分析Ⅱ	4.5	＞	821T0020	微积分(甲)Ⅱ	3.5	＞	821T0040	微积分(乙)Ⅱ	3.5				\n	821T0090	高等代数Ⅰ	3.5	＞	821T0050	线性代数(甲)	2.5	＞	821T0060	线性代数(乙)	2.5				\n	数学类自然科学通识课程	4	＞	821T0100	高等数学	4				\n	数学类自然科学通识课程	4	＞	821T0110	应用统计学	4				\n物理系	761T0080	物理学Ⅰ	3	＞	761T0010	大学物理（甲）Ⅰ	4	＞	761T0030	大学物理（乙）Ⅰ	3	＞	761T0050	大学物理（丙）	4\n	761T0090	物理学Ⅱ	5												\n	761T0100	物理学Ⅲ	4	＞	761T0020	大学物理（甲）Ⅱ	4	＞	761T0040	大学物理（乙）Ⅱ	3				\n	761T0110	物理学实验Ⅰ	1.5	≈	761T0060	大学物理实验	1.5	＞	761T0070	大学物理实验（丙）	1\n化学系	771T0030	无机及分析化学	4	＞	771T0010	普通化学	3	＞	771T0050	工程化学	2				\n	771T0040	大学化学实验（G）	2	＞	771T0020	化学实验（甲）	1.5	＞	771T0060	化学实验（丙）	0.5				\n\n二、竺可桢学院荣誉课程与新课程层次关系\n开课院系	课程代码	课程中文名称	学分	层次关系	课程代码	课程中文名称	学分\n数学学院	061R0110	数学分析（甲）Ⅰ（H）	4.5	＞	821T0070	数学分析Ⅰ	4.5\n	061R0120	数学分析（甲）Ⅱ（H）	4.5	＞	821T0080	数学分析Ⅱ	4.5\n	061R0170	微积分Ⅰ（H）	4.5	＞	821T0010	微积分（甲）Ⅰ	4.5\n	061R0180	微积分Ⅱ（H）	2	＞	821T0020	微积分（甲）Ⅱ	3.5\n	061R0190	微积分Ⅲ（H）	1.5				\n	061R0040	线性代数Ⅰ（H）	3.5	＞	821T0090	高等代数Ⅰ	3.5\n物理系	061R0060	普通物理学Ⅰ（H）	4.0 	＞	761T0010	大学物理（甲）Ⅰ	4\n	061R0070	普通物理学Ⅱ（H）	4.0 	＞	761T0020	大学物理（甲）Ⅱ	4\n化学系	061R0430	普通化学（H）	3.0 	≈	771T0010	普通化学	3\n\n \n三、新课程与原大类课程层次关系\n开课院系	新课程	层次关系	原课程\n	课程代码	课程中文名称	学分		课程代码	课程中文名称	学分\n数学学院	821T0010	微积分（甲）Ⅰ	4.5	≈	061B0170	微积分Ⅰ	4.5\n	821T0020	微积分（甲）Ⅱ	3.5	≈	061B0180	微积分Ⅱ	2\n					061B0190	微积分Ⅲ	1.5\n	821T0050	线性代数（甲）	2.5	≈	061B0200	线性代数	2.5\n	821T0090	高等代数Ⅰ	3.5	≈	061B0040	高等代数Ⅰ	3.5\n	821T0100	高等数学	4	≈	061B0060	高等数学	4\n物理系	761T0010	大学物理（甲）Ⅰ	4	≈	061B0211	大学物理（甲）Ⅰ	4\n	761T0020	大学物理（甲）Ⅱ	4	≈	061B0221	大学物理（甲）Ⅱ	4\n	761T0030	大学物理（乙）Ⅰ	3	≈	061B0212	大学物理（乙）Ⅰ	3\n	761T0040	大学物理（乙）Ⅱ	3	≈	061B0222	大学物理（乙）Ⅱ	3\n	761T0050	大学物理（丙）	4	≈	061B0213	大学物理（丙）	4\n	761T0060	大学物理实验	1.5	≈	061B0240	大学物理实验	1.5\n	761T0070	大学物理实验（丙）	1	≈	061B0241	大学物理实验（丙）	1\n	761T0080	物理学Ⅰ	3	≈	061B0300	物理学Ⅰ	3\n	761T0090	物理学Ⅱ	5	≈	061B0310	物理学Ⅱ	5\n	761T0100	物理学Ⅲ	4	≈	061B0320	物理学Ⅲ	4\n	761T0110	物理学实验Ⅰ	1.5	≈	061B0330	物理学实验Ⅰ	1.5\n化学系	771T0010	普通化学	3	≈	061B0430	普通化学	3\n	771T0020	化学实验（甲）	1.5	≈	061B0421	化学实验（甲）	1.5\n	771T0030	无机及分析化学	4	≈	061B0450	无机及分析化学	4\n	771T0040	大学化学实验（G）	2	≈	061B0370	大学化学实验（G）	2\n	771T0050	工程化学	2	≈	061B0410	工程化学	2\n	771T0060	化学实验（丙）	0.5	≈	061B0423	化学实验（丙）	0.5\n\n说明：\n1、以上表格中，符号“＞”为单向关系，表示修读高层次课程后可免修低层次课程；符号“≈”为相似关系，表示修读其中一门课程后可免修另一门课程。\n2、免修申请适用于学生因确认主修专业、修读高层次课程、辅修、学籍异动以及课程调整等引起的课程修读与培养方案要求有偏差等情况。\n免修申请需在现代教务管理系统中操作，具体路径为：登录“现代教务管理系统”——“申请”——“课程免修申请”。\n\n温馨提示：因部分学生仍有修读原大类课程的需求，经与相关开课院系沟通，16-17学年春夏学期将酌情继续开设部分原大类课程，请学生届时注意选课网相关通知。\n\n咨询方式：\n本科生院教务处：杨旸，88206416，yangyang19@zju.edu.cn。\n数学学院：骆亚华，87953841，mlyh@zju.edu.cn。\n物理系：郑丽玲，87953304，phyzll@zju.edu.cn。\n化学系：袁银霞，88206104，yuanyinxia@zju.edu.cn。\n   \n\n\n本科生院教务处\n 二○一六年十一月二十八日\n', '2016-11-29 00:00:00', '123456', '老师A1', '0'),
(2, '关于计算机学院2017年新年晚会节目、主持人征集的通知', '为了丰富我院师生的课余文化生活，计算机学院将举办“2017年新年晚会”。为了使晚会节目形式多样、内涵丰富，现面向学院师生征集节目，望大家踊跃参加。\n\n现将晚会节目、主持人及礼仪征集活动及要求通知如下：\n\n一、活动时间\n\n2016年12月23日(星期五)18:30\n\n二、活动地点\n\n永谦剧场三楼多功能厅\n\n三、晚会节目征集内容要求\n\n1、晚会节目征集\n\n（1）节目要求：每个节目时长5-15分钟。\n\n（2）节目种类：歌曲演唱；舞蹈；语言类：舞台剧／话剧、小品／相声／脱口秀／配乐诗朗诵；特长节目乐器表演、魔术／武术表演；其他创新类节目包括杂技、戏曲、时尚走秀、模仿秀、瑜伽、激光舞等。\n\n（3）报名以班级为单位 ，由各班班长统计好本班节目总数后统一上报至研究生会。(每班最少报1个节目，班与班之间可以合作) （报名表见附件1）\n\n2、主持人征集要求及礼仪\n\n（1）晚会所需主持人4人，暂定2名男生、2名女生。\n\n（2）晚会所需礼仪2人，暂定2名女生。\n\n（3）从气质、音色、舞台经验、控场能力、以及个人才艺和擅长渲染并能带动晚会现场气氛等方面综合考虑，从众报名者（自荐或推荐）中择优选择。（报名表见附件2）\n\n晚会表演者、主持人及礼仪课获得活动参与分1分，表现突出的班级将获得“文艺突出贡献奖”，请同学们踊跃报名。请填写报名表发送至邮箱：zhangeditor@163.com，截止时间2016年12月4日晚24:00，节目审查时间：2016年12月9日(具体时间地点后续会通知)。\n\n迎新晚会节目征集表（附件1）\n\n迎新晚会主持人、礼仪征集表（附件2）', '2016-11-29 09:00:00', '123456', 'yjsh', '0'),
(3, '“技通数字，艺贯媒体', ' 2016年11月19日、20日，浙江大学计算机学院数字媒体技术专业开放日活动在浙江大学紫金港校区月牙楼一楼展厅成功举办，历时两天。\n     \n      这是浙江大学计算机科学与技术学院的一年一度的重要活动之一，已经连续举办七届。开放日旨在在向全校师生展示数字媒体技术的专业风貌，让校友和社会来了解数字媒体技术专业。它虽然是一个新兴专业，但是却已经在行业内取得了优异的成绩。同时，也传达和表现了数媒学子的精神与理念，以坚实的理论和技术为基础支撑，以艺术和设计为创意内涵，技术艺术相结合。\n  \n \n       今年的开放日主题是“你的世界”，场馆使用小方盒子进行了统一的装饰布置。活动前期准备阶段，相关同学都积极参与，团结协作，使活动按照计划顺利进行。开放日当天，慕名而来的参观者络绎不绝，热情高涨。整个展区分为专业介绍区、平面设计区、交互游戏区、视频动画区、互动绘画区、虚拟现实区。今年首次将虚拟现实设立单独的展区，吸引了大量参观的同学。展览从师资力量、课程设置、教学设备、作品成果等方面将数字媒体技术专业全方位、多角度、深层次地进行了展示。数字摄影、动漫绘画、造型基础等课程作品广受好评，吸引大量同学驻足观看；学生动画短片展示出数媒学子的综合美术素养和技术，动画故事背后的哲理同样引人深思；学生游戏作品展示出数媒学子代码和美术相结合的综合能力，精心的游戏设计让很多同学直呼停不下来；互动创作区提供了一个低门槛平台，让每个同学都能参与到绘画到中来，体验创作的乐趣；互动答题游戏寓教于乐，提升同学们对数字媒体这个新兴领域的兴趣；目前最优秀的虚拟现实设备让参观同学们直接感受的世界；PS4、WII、Xbox、Kinect等专业数字媒体娱乐设备，让参观者体会到了尖端的游戏技术和有趣的游戏设计思想。\n \n \n       在同学们充分地准备和精心地布置下，完美地诠释了技术与艺术相结合的数字媒体技术专业特色，传递出数媒对于同学们，不但是一种热爱，更是一种享受。相信通过一代代数媒学子的传承和创新，数字媒体技术专业一定会得到更加蓬勃的发展！\n', '2016-11-29 00:00:00', '123456', '老师A1', '0');



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
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------

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


INSERT INTO `course_info` (`info_id`, `course_name`, `background`, `course_plan`, `textbook_precourse`, `exam_homework`) VALUES
(1, '软件需求工程', '为了使这门课上的出色，使学生能够获得最多的资料，使学生及时的了解世界需求工程的最新动态，以及学生和教师的有效地沟通，老师提出了这么一个设想；作为他的学生也需要一个与教师及同学之间相互交流，及获取资料的平台；还有一些同学并没有选这几门课，但是也想了解项目管理，需求工程，统一建模的相关知识，以备到时决定该选不选这门课程。通过这三方提出的需求考虑，我们构思做一个软件工程教学、学习、交流的网站。', '/images/course_plan.png', '预修要求： 具有基础的软件工程知识（即预修"软件工程基础"）。\r\n<br />\r\n参考教材及相关资料：\r\n1.	Software Requirements (Second Edition), Karl E. Wiegers, Microsoft Press, 2003\r\n<br>\r\n2.	《软件需求》第2版，[美] Karl E. Wiegers 著，刘伟琴、刘洪涛 译，清华大学出版社，2004年\r\n</br>\r\n3.	UML User Guide (Second Edition)，Grady Booch，James Rumbaugh，Ivar Jacobson. Addison-Wesley，2005年5月\r\n\r\n4.	UML用户指南（第2版·修订版），邵维忠等译，清华大学出版社，2004年11月\r\n\r\n5.	《需求工程--基础、原理和技术》，[德]Klaus Pohl著，彭鑫、沈立炜、赵文耕 等译，机械工业出版社，2012年\r\n\r\n6.	《软件需求管理-统一方法》，[美] Dean Leffingwell Don Widrig 著，蒋慧、林东 译，2003年第1版，机械工业出版社。\r\n\r\n7.	《统一软件开发过程》，[美] Ivar Jacobson, Grady Booch, James Rambaugh 著，周伯生、冯学民、樊东平 译，2002年1月第1版，机械工业出版社。\r\n\r\n8.	《面向对象技术UML教程》，王少锋 编著，清华大学出版社。\r\n\r\n9.	《面向对象设计UML实践》，Mark Priestley著，龚晓庆、卞雷等译，王少锋审，清华大学出版社。\r\n\r\n10.	《Practical Object-oriented Design with UML》 2th Edition，Mark priestley，清华大学出版社。\r\n\r\n11.	《UML用户指南》第2版，Grady Booch 等著，邵维忠、麻志毅、马浩海、刘辉 译，人民邮电出版社。\r\n\r\n12.	《UML与Rational Rose2002从入门到精通》，Wendy Boggs等著，邱促潘等译，电子工业出版社。\r\n', '三、课程要求\r\n（一）授课方式与要求\r\n授课方式：\r\n1.	教师讲授（讲授核心内容、引导讨论、总结、答疑、点评课程设计报告等）；双语教学；\r\n2.	综合性需求工程实例练习和团队合作；综合性课程报告；\r\n3.	部分内容闭卷考试。\r\n实验组织：\r\n以大型课程作业的方式，采用项目管理的方法，对“软件工程课程教学支持系统”项目的需求进行需求工程全过程的实践。\r\n具体要求如下：\r\n1.	每5-6人组成一个项目小组，在项目经理（组长）的领导下，团结协作共同完成课程作业。\r\n2.	实践需求工程的各个过程，主要包括：\r\nl	完成《软件需求工程计划》\r\nl	需求识别：教师、学生、技术专家等需求\r\nl	重点完成需求分析与设计：OOA方法，UML描述\r\nl	需求定义：软件需求说明文档\r\nl	需求的确认：需求评审会议及报告，完成基准《软件需求规格说明书》\r\nl	需求管理：变更的控制与跟踪记录报告\r\n3.	采用UML方法，完成基本的《软件概要设计说明书》\r\n4.	完成项目总结，并提出改进措施，包括：技术方法的改进，软件需求分析及设计过程的改进建议等。\r\n课程要求：\r\n熟悉基本知识、掌握基本技能、培养思维和表达能力及合作精神、提高中外文计算机科学文献的阅读能力。\r\n\r\n（二）	考试评分与建议\r\n1.	按照课程作业上交的各阶段的文档进行评分，各文档评分加权平均后作为小组的项目平时成绩A；\r\n2.	期末每组准备10分钟PPT进行陈述，由其他全部小组的组长和成员对其进行提问和回答（10分钟），再由其他小组组长和教师进行打分，去掉最高和最低分，取平均分数作为小组的项目答辩成绩B；\r\n3.	上述两项成绩各以相同权重形成小组的项目成绩C；\r\n4.	组内各成员交叉评议，并由组长或协调、或调整、或裁决，形成组内的组员评分D；\r\n5.	根据上述小组成绩C，参考组内评分D，推算出每个同学的个人项目成绩E；\r\n6.	UML部分，平时成绩F占40%，期末测试成绩G占60%，形成UML个人成绩H；\r\n7.	项目成绩E占80%，UML部分成绩H占20%，形成学生个人总评分；\r\n8.	教师根据学生出勤、回答问题、参加需求调研实践等表现，以及担任组长或有特殊贡献等因素给出调整（原则上不超过正负5分），作为最终个人总评分。\r\n');

-- ----------------------------
-- Table structure for `group`
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `group_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `leader_id` varchar(20) NOT NULL,
  `group_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `class_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `group_id` (`group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=10005 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of homework
-- ----------------------------
INSERT INTO `homework` VALUES ('10001', '第二次作业', '2016-12-10 21:36:52', '2016-12-17 21:36:55', '10002', '1', '0', '0', '0.8');

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
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mail
-- ----------------------------

-- ----------------------------
-- Table structure for `message`
-- msg_state:0为未审核，1为已审核
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `msg_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `author` varchar(20) NOT NULL,
  `time` datetime NOT NULL,
  `msg_state` varchar(1) NOT NULL,
  `reply_content` text,
  PRIMARY KEY (`msg_id`),
  UNIQUE KEY `msg_id` (`msg_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` (`msg_id`, `content`, `author`, `time`, `msg_state`, `reply_content`) VALUES
(1, 'test1消息', '匿名', '2016-11-25 00:00:00', '0', NULL),
(2, 'test2消息', '匿名', '2016-11-25 10:00:00', '0', NULL),
(3, 'test3消息', '匿名', '2016-11-25 10:00:00', '1', '你好啊'),
(4, 'tttttest1', '游客(::1)', '2016-11-25 18:51:33', '1', '1111'),
(5, 'tttttest1', '游客(::1)', '2016-11-25 18:52:12', '1', '!@#$%^&*(_'),
(6, 'HELLO你好￥%…………', '游客(::1)', '2016-11-25 19:04:56', '1', '我再试试能不能回复\r\n'),
(7, '士大夫士大夫', '游客(::1)', '2016-11-25 21:09:44', '1', '三墩发'),
(8, 'tttttest1', '游客(::1)', '2016-11-25 18:51:33', '1', '！@#￥%……&'),
(9, 'aaa', '游客(::1)', '2016-12-12 16:25:14', '0', NULL),
(10, '我就试试能不能留言\r\n', '游客(::1)', '2016-12-12 16:30:39', '1', '我再试试能不能回复\r\n');
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
) ENGINE=InnoDB AUTO_INCREMENT=10002 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('10000', '1234567', '0', '第一次发帖', '请多多关照', '1234567', null, '2016-12-12 18:39:11', '2016-12-12 18:39:15');
INSERT INTO `posts` VALUES ('10001', '1234567', '0', '的神烦大叔', '&lt;p&gt;的神烦大叔&lt;/p&gt;', '1234567', '0', '2016-12-12 22:11:48', '2016-12-12 22:11:48');

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
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES ('10000', '第三方', '&lt;p&gt;辅导辅导地方的&lt;/p&gt;', '10004', '0', '0', '0', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reply_post
-- ----------------------------

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
  PRIMARY KEY (`resrc_id`),
  UNIQUE KEY `resrc_id` (`resrc_id`) USING BTREE,
  KEY `post_id` (`post_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10072 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of resource
-- ----------------------------
INSERT INTO `resource` VALUES ('10036', '水电费', 'upload/7e387ccf52427d520dcea284.docx', '13401', '2016-12-12 19:10:43', '0', null, '1234567');
INSERT INTO `resource` VALUES ('10066', 'SQL', 'upload/155655abc56e24d6c6522575.sql', '20053', '2016-12-12 22:51:26', '0', null, '1234567');
INSERT INTO `resource` VALUES ('10067', '360Safe.exe', 'upload/89a2452b5ae5f65599d7bd03.exe', '962984', '2016-12-12 22:51:36', '0', null, '1234567');

--
-- 转存表中的数据 `resource`
--

INSERT INTO `resource` (`resrc_id`, `name`, `path`, `size`, `time`, `type`, `post_id`, `uploader_id`) VALUES
(1, '测试1', './resource/1.txt', 1, '2016-12-12 19:00:00', '0', NULL, ''),
(2, '测试2', './resource/2.txt', 1, '2016-12-12 19:00:00', '0', NULL, ''),
(3, '测试3', './resource/word.docx', 1, '2016-12-12 19:00:00', '0', NULL, ''),
(4, '测试4', './resource/pdf.pdf', 1, '2016-12-12 19:00:00', '0', NULL, ''),
(5, '测试5', './resource/ppt.pptx', 1, '2016-12-12 19:00:00', '0', NULL, '');

-- --------------------------------------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('10000', 'yyh951102', 'c92f606717d8826c16893e9bacdd6c47', '杨奕辉', null, null, null, null, null, '10001', null, null);

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
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  UNIQUE KEY `teacher_id` (`teacher_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('10000', '1234567', '21232f297a57a5a743894a0e4a801fc3', '杨奕辉', '172555222', '234347589@qq.com', 'fsd', '334345', 'fsdfds', '这是教师信息fsdfsd都是&amp;lt;p&amp;gt;ds fsd&amp;lt;/p&amp;gt;&lt;p&gt;f第三方水电费&lt;/p&gt;', '&lt;p&gt;这是课程信息&amp;amp;lt;p&amp;amp;gt;asdfsdfsdf&amp;amp;lt;/p&amp;amp;gt;&amp;lt;p&amp;gt;sdfsd&amp;lt;/p&amp;gt;&lt;/p&gt;&lt;h2&gt;dfdfgdf&lt;/h2&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', null);

-- ----------------------------
-- Table structure for `works`
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
  `finish` varchar(1) NOT NULL,
  PRIMARY KEY (`work_id`),
  UNIQUE KEY `work_id` (`work_id`) USING BTREE,
  KEY `ques_id` (`ques_id`) USING BTREE,
  KEY `uploader_id` (`uploader_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of works
-- ----------------------------

-- --------------------------------------------------------

--
-- 表的结构 `teacher_info`
--
DROP TABLE IF EXISTS `teacher_info`;
CREATE TABLE `teacher_info` (
  `info_id` bigint(20) NOT NULL,
  `teach_experience` text,
  `profile` text,
  `honor` text,
  `brief_intro` text,
  `course_info` text,
  `name` varchar(20) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacher_info`
--
INSERT INTO `teacher_info` (`info_id`, `teach_experience`, `profile`, `honor`, `brief_intro`, `course_info`, `name`, `photo`) VALUES
(1, '自2004-2005学年起，\r\n我就和计算机学院的操作系统教学团队一起承担了专业骨干课程“操作系统”的教学工作，至今已有十年。\r\n我一直非常认真地对待教学工作。自2004-2005学年起，我就和计算机学院的操作系统教学团队一起承担了专业骨干课程“操作系统”的教学工作，至今已有十年。我坚持认真备课，每年滚动更新授课材料，并注意结合计算机技术当下的新发展，不断补充新案例到课堂教学之中。同时，有意识地改善和提炼自己的课堂教学技能和技巧，注意启发和诱导学生主动思考、积极反馈。在自2004学年起的连续十年中，我取得了几乎全优的评价结果（仅第2年即2005-2006学年评价良好）[1]。\r\n在2011-2012学年，我受浙江省委组织部和浙江大学委派，承担了援疆任务，远赴天山脚下沙漠边缘的塔里木大学任职任教，在担任信息工程学院副院长分管科研和对外合作等工作、担任学校信息化工作领导小组办公室常务副主任，主管全校信息化建设特别是一卡通工程等工作之外，也担负了塔里木大学信息工程学院的操作系统课程的教学，根据学生特点和采用的教材对课程进行调整，并对该校青年教师进行传帮带，进行示范教学，获得了该校师生的一致好评，并获得了先进工作者、优秀援疆干部等荣誉称号[2]。\r\n同时，我注重团队合作，积极参加整个课程教学团队的教研活动，研讨教案和教学方法、课程安排等等。在2006年，我参加了操作系统课程申报国家级精品课程的工作，经过团队共同努力，申报成功。在2013年，我又参加了该课程国家级精品资源共享课程的建设工作[3]，参与制作了课件、讲义、习题与解答，拍摄了授课视频，准备了其他课程相关材料，等等，最终和团队一起圆满完成了建设任务。\r\n2012年7月结束援疆工作回校后，在操作系统课程之外，我又担负起“软件需求分析与设计”课程的教学工作，是该课程的责任老师（该课程原责任老师调离了浙江大学）。软件工程特别是需求工程课程，表面上看理论少，很难讲好；浅则容易流于形式照本宣科，深则需要学生的工程实践积淀为基础。为此，我花费了大量的时间准备教案，同时充分发挥了自工作以来约二十年的科研项目特别是科技支撑类项目、横向研发项目中积累的实际软件工程经验，将课程中的知识点、方法论原理都尽可能和实践结合起来进行实例化分析和讲授，取得了较好的效果。同时，自始至终强化学生的实践，通过分组和角色分工，让学生全过程地完成一个复杂案例（课程教学支持系统），在亲身体验中学习，并采用组内互评、组间交叉点评等方式，教学相长。为了搞好配套的需求获取、需求分析和表述、需求维护等实验环节，我投入了大量的时间，扮演样本用户，实际花费时间远超课程规定的实验指导时间。欣慰的是在两个小班的教学质量评价中均取得了优秀的成绩[4]。\r\n2013年暑期开始，我还以责任老师身份和其他老师共同新开了课程“项目实训”。该课程是软件工程建设中的专业骨干课程。先前由几位老师分散指导软工专业部分学生开展企业和社会实践等环节，进行深度和完整度不一的软件工程实践，加深学生对软件工程全过程的理解。自软件工程专业2010级培养方案起，“项目实训”正式列入专业必修课，为全体软件工程学生所必修。对于这门新开课程，我勇挑重担，与合作老师还有企业外聘老师一起，策划了整个课程的结构，设计了完整的、符合当下技术热点和应用热点的项目案例，建立企业氛围，把学生编制为项目小组，有角色分工，全过程指导学生经历完整的软件工程过程，完成设定的项目目标，达到全面复习、巩固、提升本专业各门专业前导课程的知识点，组合训练各项技能，强化学生团队工作能力的课程目标。目前该课程已运行了两年，同学反应很好，课程积累了很好的基础，正在不断提升。学院已上报本科生院把该课程纳入专业核心课程建设体系中。（奇怪的是在本科教务系统中没有该课程的教学质量评价结果）。\r\n在上述年均教学工作量明显超过教学科研并重岗的平均工作量的课程教学工作之外，在2012年7月结束援疆工作回校后，我还担负起了计算机学院软件工程专业软件工程课程组组长的工作，出任学院教学指导委员会成员，担任计算机学院的校内实习基地和毕业设计基地的责任老师，并自2014年4月起担任了计算机系主任，在课程组建设、基层教学组织建设、学院本科教学指导和管理、对学业较困难的学生进行实习和毕业设计指导、学院各专业培养方案制定和修订、学院本科毕业设计的组织和管理等等方面，做了许多公益性的工作，得到学院领导和广大师生的认可。\r\n\r\n', '邢卫老师，男，1967年生，浙江大学计算机科学与技术学院博士，副教授，硕士生导师。1992年起先后在浙江大学工业控制技术国家实验室、浙江大学信息学院控制科学与工程系、浙江大学计算机科学与技术学院任职；1994年晋升讲师，2000年12月晋升副教授；2011年2月至2012年7月作为援疆干部，任塔里木大学信息工程学院副院长，学校信息化工作领导小组办公室常务副主任。近年来，作为课题负责人承担国家科技支撑计划项目课题“动漫内容的发布交易技术与服务”和浙江省重大科技计划项目“数字媒体网络家庭智能终端研究与开发”、“多层次职业技术教育网络平台研究与应用示范”等多项；作为技术负责人或主要骨干承担国家自然科学基金重点项目“数字媒体网络系统及关键技术研究”、国家科技支撑计划项目“现代农村信息化关键技术研究与示范”项目“基层农村综合信息服务技术集成与应用”课题、教育部“百万册数字图书服务系统IPv6升级”项目、浙江省重大科技攻关项目“浙江省信息化科技村镇建设与示范”、“农村党员干部现代远程教育工程关键技术与设备研究及其应用”等多项。获得科研成果3项、获省部级科技奖励2项，获发明专利授权4项，发表学术论文20余篇，持有软件著作权20余项。主要研究方向包括计算机网络技术和多媒体技术。近十年已有30多位研究生在他指导下毕业并获得学位。', '近三年获奖情况	\n\n	浙江大学优秀共产党员，2011年6月，浙大党委发[2011]73号\n	浙江大学2011年度先进工作者，2012年2月，浙大发人[2012]12号\n	塔里木大学2011年度先进工作者，2012年3月，塔里木大学 校字[2012]7号\n	塔里木大学优秀援疆干部，2012年6月，塔里木大学 校党字[2012]12号\n', '邢卫老师是计算机学院计算机系的系主任。对待教学工作认真负责，教学效果优秀。', '软件需求工程', '邢卫', 'images/teacher/1.jpg'),
(2, '海外导师主讲科学可视化\r\nVisualization Modlie introduction\r\n\r\nThe modlie is expected to include both scientific and information visualization.\r\n\r\nScientific visualization is a research area that focuses on the use of visualization techniques to help people understand and analyze data. While fields such as scientific visualization involve the presentation of data in their geometric correspondence.\r\n\r\nInformation visualization focuses on abstract data using symbolic, tabliar, networked, hierarchical, or textual information sources.\r\n\r\nThe course also includes tailored design of visualization techniques to handle Big Data in nowadays application, and to integrate with the latest computing architecture such as Cloud.\r\n\r\nThe project of the modlie will involve the solution of scientific problems using computer graphics, modeling, and visualization. Working in small groups, students will identify scientific problems, propose solutions involving computational modeling and visualization, evaluate the proposals, design and implement the solutions, apply them to the problems, evaluate their success, and report on reslits.\r\n\r\nThe objectives of the course are\r\n\r\n    Learn the principals involved in scientific and information visualization\r\n    Learn about the variety of existing techniques and systems in scientific information visualization\r\n    Develop skills in critiquing different visualization techniques as applied to particliar tasks\r\n    Learn how to evaluate visualization systems\r\n    Gain a background that will aid the design of new, innovative visualizations\r\n\r\nThe course will follow a lecture/seminar style with much discussion of assigned readings, as well as viewing of videos and hands-on experience with research and commercial visualization tools.\r\n\r\nThe content include\r\n\r\n    scalar visualization\r\n    volume visualization\r\n    vector and tensor visualization\r\n    basic of info vis\r\n    scalable visualization techniques\r\n    high dimensional visualization: sub-space clustering & dimension reduction\r\n    uncertainty visualization\r\n    visualization design\r\n    visualization in a cloud based environment\r\n', 'Dr. Hai Lin is a professor in State Key Lab. of CAD&CG, Zhejiang University. He got M.Eng and B.Eng from Xidian University  in 1990 and 1987 respectively. He joined in State Key Lab. of CAD&CG in 1990. After he obtained a PhD in computer science from Zhejiang University, he had been a Research Fellow in Medical Visualization at De Montfort University, UK from 2000 to 2003. He was a visiting professor of the Department of Computing and Information Systems,  University of Bedfordshire, UK. His research interests include computer graphics, scientific visualization, volume rendering, virtual reality and graphical electromagnetic computing.', 'Papers\r\n\r\n    Gang Hua, Hai Lin and JinGuang Sun. A New Quantization Method for 3-D Seismic Visualization. Proceedings 2009 11th IEEE International Conference on Computer-Aided Design and Computer Graphics, August 19-21, 2009 Yellow Mountain City, China, pages 457-462.\r\n\r\n    Li, Zhuo; Cui, Tie Jun; Zhong, Xing Jian; Tao, Yu Bo; Lin, Hai. Electromagnetic scattering characteristics of PEC targets in the terahertz regime. IEEE Antennas and Propagation Magazine, v 51, n 1, p 39-50, 2009\r\n\r\n    Tao, Yubo; Lin, Hai; Bao, Hujun; Dong, Feng; Clapworthy, Gordon; Structure-aware viewpoint selection for volume visualization. IEEE Pacific Visualization Symposium, PacificVis 2009 - Proceedings, p 193-200, 2009\r\n\r\n    Yubo Tao,Hai Lin, Hujun Bao, Feng Dong, Gordon Clapworthy, Feature Enhancement by Volumetric Unsharp Masking , Visual Computer, Volume 25, Numbers 5-7, May 2009, pages 581-588.\r\n\r\n    Zhongding Jiang, Junyi Tao, Lei Zhang, Hai Lin, and Hujun Bao. A Streaming-Based Approach for Remote Interaction of the Multi-Channel Display System for Group Users. Proc. IEEE International Conference on Multimedia and Expo (ICME 2008), pp.397-400, 2008.\r\n\r\n    Wang, Xiuhui; Yang, Haibo; Lin, Hai; Geometry calibration for multi-projector tiled display wall. Journal of Computer-Aided Design and Computer Graphics (Chinese), v 20, n 6, p 707-712, June 2008\r\n\r\n    Wang, Xiuhui ; Yang, Haibo; Lin, Hai; Arm motion estimation based on predictive control. Journal of Computer-Aided Design and Computer Graphics (Chinese), v 20, n 6, p 801-807, June 2008\r\n\r\n    Yubo Tao, Wenjie Tu, Hai Lin, Hujun Bao, Feng Dong, Gordon Clapworthy. Designing Transfer Functions from Photographic Volumes for Rendering Features of Interest. In Proceedings of CGI 2008, 48-55, 2008.\r\n\r\n     X. B. Wang, X. Y. Zhou, T. J. Cui, Y. B. Tao, H. Lin. High-resolution inverse synthetic aperture radar imaging based on the shooting and bouncing ray method. Global Symposium on Millimeter Waves 2008, 2008:1-3\r\n\r\n    Y. C. Ruan, X. Y. Zhou, Y. J. Chin, T. J. Cui, Y. B. Tao, H. Lin. The UTD analysis to EM scattering by arbitrarily convex objects using ray tracing of creeping waves on numerical meshes. IEEE International Symposium on Antennas and Propagation, 2008, 2008:1-4\r\n\r\n    Yubo Tao, Hai Lin, Hujun Bao. From CPU to GPU: GPU-based Electromagnetic Computing (GPUECO). Progress In Electromagnetics Research, PIER 81, 1-19, 2008.\r\n\r\n    Yubo Tao, Hai Lin, Hujun Bao. Kd-Tree Based Fast Ray Tracing for RCS Prediction. Progress In Electromagnetics Research, PIER 81, 329-341, 2008.\r\n\r\n    Feng Dong; Clapworthy, G.; Lin, H. ; Pseudo surface-texture synthesis. Computers and Graphics (Pergamon), v 31, n 2, p 252-61, April 2007\r\n\r\n    X. J. Zhong, T. J. Cui, Z. Li, Y. B. Tao, H. Lin. Terahertz-wave scattering by perfectly electrical conduction objects[J]. Journal of Electromagnetic Waves and Applications. 2007, 21(15):2331-2340\r\n\r\n    Zhongding Jiang, Xuan Luo, Yandong Mao, Binyu Zang, Hai Lin, and Hujun Bao. Interactive Browsing of Large Images on Multi-Projector Display Wall System. Proc. the 12th International Conference on Human-Computer Interaction (HCI International 2007), 2007, LNCS, vol. 4551, pp. 827-836.\r\n\r\n    Wang, Xiu-Hui (College of Information Engineering, China Jiliang University, Hangzhou 310018, China); Hua, Wei; Lin, Hai; Bao, Hu-Jun; Screen calibration techniques for multi-projector tiled display wall. Journal of Software, v 18, n 11, p 2955-2964, November 2007\r\n\r\n    Meng, Jiayuan ; Lin, Hai; Shi, Jiaoying; High-resolution image viewing on projection-based tiled display wall.  Proceedings of SPIE - The International Society for Optical Engineering, v 6058, 2006, Color Imaging XI: Processing, Hardcopy, and Applications - Proceedings of SPIE-IS and T Electronic Imaging\r\n\r\n    Zhang, Kai; Li, Chao; Lin, Hai; Shi, Jiaoying;  Current display wall software calibration system. Computer Engineering (Chinese), v 32, n 16, p 215-217, Aug 20 2006\r\n\r\n    Hai Lin, Hongxin Zhang, Hujun Bao, Feng Dong, and Gordon Clapworthy , "Navigation Path Extraction for Virtual Endoscopy by Shape-Sensitive Voronoi-Diagram Filtering" , Proceedings of International Conference Computer Graphics, Imaging and Vision - CGIV05, pp.44-48,2005\r\n\r\n    Jianfeng Lu, Zhigeng Pan, Hai Lin, Mingmin Zhang, Jiaoying Shi, “Virtual learning environment for medical education based on VRML and VTK”. Computers & Graphics 29(2): 283-288 (2005)\r\n\r\n    Dong, Feng; Lin, Hai; Clapworthy, Gordon; “Cutting and Pasting Irregularly Shaped Patches for Texture Synthesis”, Computer Graphics Forum, Volume 24, Number 1, March 2005, pp. 17-26(10)\r\n\r\n    Chao Li, Hai Lin, Jiaoying Shi, “Multi-projector tiled display wall calibration with a camera”, IS&T/SPIE Symposium on Electronic Imaging, 2005, Proc. SPIE Vol. 5668, p. 294-301, Image Quality and System Performance II\r\n\r\n    Chao Li, Hai Lin, Jiaoying Shi. "A Survey of Multi-Projector Tiled Display Wall Construction," ICIG, pp. 452-455, Third International Conference on Image and Graphics (ICIG04), 2004\r\n\r\n    Jianfeng Lu, Hai Lin, Zhigeng Zhang Pan, Hao Zhang, “Medical Images Segmentation Using Adaptive Region Growing”, Chinagraph’04, Sept, 2004, Xi’an China,pp343-345.\r\n\r\n    Pan,ZG; Yang, BL; Zhang, MM; Yu,QZ; Lin,H; “Remote visualization based on Grid Computing”, Computational Science and Its Applications- ICCSA 2004, PT 2 3044; 236-245,2004\r\n\r\n    Hua Wang, Hai Lin, HuJun Bao, “Rapid RCS Prediction Using Graphics Hardware”, Journal of Image and Graphics (Chinese), Vol.9, No.,9 Sept. 2004，pp1101-1106.\r\n\r\n    Krokos, M. ; Savenko, A.; Clapworthy, G.J.; Lin, H.; Mayoral, R.; Viceconti, M.; Van Sint Jan, S.; Real-time visualisation within the multimod application framework. Information Visualization, IV2004, IEEE Computer Society Press,v 8, p 21-26, 2004\r\n\r\n    ZheFang Jin, Hai Lin, JiaoYing Shi, “Research and Implementation of a Data Distributed Sort-First Parallel Rendering System”, Journal of Computer Research and Development (Chinese), Vol.41 No.2, 2004, pp.376-382\r\n\r\n    ZhongDing Jiang, Hai Lin, HuJun Bao, LiZhuang Ma, “A Super-Resolution Method with EWA” Journal of Computer Science&Technology, Nov. 2003, Vol.18.No.6, pp.822-832\r\n\r\n    M. Krokos, Hai Lin, G. J. Clapworthy and F. Dong, “Focal Points and Intuitive 3D Controls for Human Kinematics Visualisation”, Information Visualization - IV 2003  IEEE Computer Society Press, 176-180, 2003\r\n\r\n    F. Dong, G. J. Clapworthy, Hai Lin, M. Krokos, “Nonphotorealistic Rendering of Medical Volume Data”, IEEE Computer Graphics and Applications, pp.44-52, July/August 2003\r\n\r\n    Hai Lin, Gordon Clapworthy, Feng Dong, Mel Krokos, Jiaoying Shi, “Slice-based Virtual Endoscopy Navigation”,  Information Visualisation, IV2001, IEEE Computer Society Press, 711-716, 2001\r\n\r\n    Hai Lin, Jiaoying Shi, An Architecture of Application-Specific Visualization Environment (ASVE), Journal of Computer-Aided Design & Computer Graphics (Chinese), 12(10), pp.796-800, 2000\r\n\r\n    Hai Lin, Feng Jin, Yun Bai and Jiaoying Shi, A Reference Model for Application-Specific Visualization, Proceedings of CIC’2000, Las Vegas, Nevada, pp.41-46\r\n\r\n    Hai Lin, Min Hu, Jiaoying Shi, Web-based Volume Data Visualization, Proceedings of Chinagraph’2000, Hangzhou, China 2000, pp.190-196\r\n\r\n    Hai Lin, H.J.Bao, Q.S.Peng, J.Y.Shi, An Adaptive Displacement Texture Mapping Technique, Journal of Software( In Chinese), Vol.9 Supplement,1998 pp.48-51\r\n\r\n    Hui Xiang, Lindong Wang, Hai Lin, Jiaoying Shi, Digital Watermarking Systems with Chaotic Sequences, Electronic Imagine99, Security and Watermarking of Multimedia Contents, SPIE Vol. 3657, pp.449-457,1999.1\r\n\r\n    Lifeng Wang, Hai Lin, Zhigeng Pan, Jiaoying Shi, A New Method for Image Morphing based View Point, Journal of Computer-Aided Design & Computer Graphics(In Chinese), Vol.11, 1998\r\n\r\nBook\r\n\r\n    Hai Lin, Browser/Server Application Development, Science Press (ISBN 7-03-008131-5, In Chinese). 2000\r\n\r\n    Hai Lin, Chapter XI: Multi-Dimensional Transfer Functions Design;   "User Centered Design for Medical Visualization", Edited by Feng Dong, George Ghinea, Sherry Y. Chen, pages 223-240, Medical Information Science Reference, IGI Global (ISBN 978-159904777-5),2008', '林海老师，浙江大学CAD&CG国家重点实验室固定研究人员，研究科学计算可视化', '软件需求工程', '林海', 'images/teacher/2.jpg'),
(3, '● Model-driven Engineering Design; Model-based Systems Engineering (MBSE)\r\n\r\n● Multi-disciplinary Mechatronic System Modeling, Design and Simulation\r\n\r\n● CAD/CAE/CAM Integration & Virtual Prototyping\r\n\r\n● 3D Model Retrieval & Knowledge Reuse', '刘玉生，男，1970年生，博士，浙江大学计算机学院研究员，博士生导师，CAD&CG国家重点实验室固定研究人员。1995年7月在浙江大学获硕士学位后赴澳门贺田工业有限公司从事机电产品的研发。1997年9月起在浙江大学机械制造及自动化专业攻读博士学位并于2000年9月毕业。同年10月进入浙江大学CAD&CG国家重点实验室从事博士后研究，2002年10月出站后前往在香港城市大学继续从事博士后研究。2003年4月开始在浙江大学计算机学院CAD&CG国家重点实验室任固定研究人员，2007年晋升为研究员，2008年被评为博士生导师。2009年8月至2010年8月在佐治亚理工学院基于模型的系统工程中心从事访问研究一年，取得了满意的访问成果。近年来主要从事软件工程、MBSE、模型驱动产品设计、三维形貌检测、三维模型检索、计算机辅助公差建模等方面的研究，共发表论文30余篇，其中SCI收录13篇，EI收录20余篇，作为第一作者或通讯作者，在国际顶级期刊和著名期刊CAD、IEEE T-ASE、Pattern Recognition等发表的论文已取得较大影响，同时也是上述国际期刊的通讯评委。', ' Selected Papers\r\n\r\n【2011】\r\n\r\n[1]  Zhongfei Sun, Yusheng LIU. A novel automated functional decomposition approach for aystem design of mechatronic products. ADDE 2011, Shanghai, Aug. 26-28.\r\n\r\n[2] Yue Cao, Yusheng Liu, Christiaan J.J. Paredis. System-level model integration of design and simulation for mechatronic systems based on SysML. Mechatronics, 2011,21(6):1063-1075.\r\n\r\n[3] Huang Yuanghao, Liu Yusheng, Hung S. Y. Dynamic phase evaluation in sparse-sampled temporal speckle pattern sequence. Optics Letters, 2011, 36(4): 526-528\r\n\r\n[4]  Huang Yuanhao, Janabi-Sharifi Farrokh, Liu Yusheng, et al. Dynamic phase measurement in shearography by clustering method and Fourier filtering.. Optics Express, 2011, 19(2): 606-615\r\n\r\n[5] Housheng Zhu, LIU Yusheng .  3D Constructive MA Generation. (GD/SPM11).  SIAM/ACM Joint Conference on Geometric and Physical Modeling. Orlando, Florida, U.S.A. Oct. 24-27, 2011.\r\n\r\n　\r\n\r\n【2010】\r\n\r\n [1] Hu baokun, Liu Yusheng, Gao Shuming.  Parallel Relevance Feedback for 3D Model Retrieval Based on Fast  Weighted-Center Particle Swarm Optimization. Pattern Recognition,43: 2950-2961, 2010.\r\n\r\n [2] Cao Yue, Liu Yusheng, Chris Paredis. Integration of system-level design and analysis models of mechatronic system behavior based on SysML and Simscape. Proc. of the ASME 2010 IDETC/CI E, Aug. 15-18, 2010, Montreal, Quebec, Canada. (Best paper of SEIKM Committee)\r\n\r\n [3] Cao Yue, Liu  Yusheng. Uniform behaviour modelling for mechatronic systems based on SysML parametric diagram: A case study. Proc. of the TMCE 2010, April 12–16, 2010, Ancona, Italy.( Recommended to Int. J. of Computer aided engineering and technology)\r\n\r\n \r\n\r\n【2009】\r\n\r\n [1] LIU Yusheng, Gao Shuming, Cao Yanlong. An Efficient Approach to Interpreting Rigorous Tolerance Semantics for Complicated Tolerance Specification. IEEE Transaction on automation science and engineering, 6(4):670-684, 2009.\r\n\r\n [2] Zhao Wei, Gao Shuming, Liu Yusheng, Lin Hongwei. Poisson Based Reuse of Free-form Features with NURBS Representation. Computers in Industry, 2009,60(1):64-74.\r\n\r\n [3] HU Baokun, LIU Yusheng, GAO Shuming. Fast Weighted Center Particle Swarm Optimization. The 8th IEEE/ACIS Int. Conf. on Computer and Information Science (ICIS 2009), Shanghai, China, June 1-3, 2009.\r\n\r\n[4] Tang Jianguo, Gao Shuming, LIU Yusheng. An Evaluation Index for Estimating Defeaturing– Induced Impacts on Finite Element Analysis[DETC2009 ‑87115]. ASME IDETC/CIE’2009, San Diego, CA, USA. Aug. 29-Sept. 2, 2009\r\n\r\n[5] Cao Weijuan, Wu haipang, Jiang Yuqin, Liu Yusheng, Gao Shuming. Representation and Automated Generation of Analysis Feature Model for Finite Element Analysis [DETC2009‑86322]. ASME IDETC/CIE’2009, San Diego, CA, USA. Aug. 29-Sept. 2, 2009\r\n\r\n [6] Fan Yamin, Zhang Mabiao, and Liu Yusheng. 2D Partial Similarity Estimation Based on Energy Segmentation — II. Feature based Similarity Calculation. Global Congress on Intelligent Systems(GCIS), Xiamen, China, 2009，May,18-22.\r\n\r\n [7] Ye Xiaoping, Zhang Mabiao, and Liu Yusheng. 2D Partial Similarity Estimation Based on Energy Segmentation I: Segmentation. Global Congress on Intelligent Systems（GCIS）,Xiamen, China, 2009，May,18-22.\r\n\r\n [8] Bai Jing, Gao Shuming, Tang Weihua, Liu Yusheng, Guo Song. Semantic-based partial retrieval of CAD models for design reuse. 2009 SIAM/ACM Conference on Geometric and Physical Modeling，Oct 5-8, 2009, San Francisco.\r\n\r\n [9] 白静, 唐韦华, 刘玉生, 高曙明. 面向实体模型相似评价的层次图生成与高效匹配. 计算机辅助设计与图形学学报，2009, 21(7): 869-879.\r\n\r\n [10] Chuhua Xian, Shuming Gao, Hongwei Lin, Yusheng Liu, and Dong Xiao. FEA-Mesh Editing with Feature Constrained.  CAD/Graphics 2009, Aug.19—22. Yellow Mountain City, China.\r\n\r\n \r\n\r\n【2008】\r\n\r\n [1] HU Baokun, LIU Yusheng, GAO Shuming. Partial Relevance Feedback for 3D Model Retrieval. Int. Symp. On Computer Science and Computational Tech., Dec. 20~22, 2008, shanghai, China.\r\n\r\n [2] 白静，唐韦华，刘玉生，高曙明. 面向实体模型相似评价的层次图生成与高效匹配研究.  全国第15届计算机辅助设计与图形学会议，大连，2008.7.22-24.\r\n\r\n　\r\n\r\n【2007】\r\n\r\n [1] 白静，刘玉生，高曙明. 基于局部蔓延的多层次实体模型检索. 计算机辅助设计与图形学学报, 2007, 17(4)： 480 –485.\r\n\r\n [2] Jianhua LI, Shuming GAO, Yusheng LIU. Solid-based CAPP for surface micromachined MEMS devices. Computer Aided Design. 2007, 39(3) 190-201.\r\n\r\n [3] 叶晓平，刘玉生.  具有不等定位公差约束的轴线特征变动建模及其实现. 机械工程学报. 2007，43(5)：167-174.\r\n\r\n  [4] BAI Jing, LIU Yusheng, Ga o Shuming. Multi-mode solide model retrieval based on partial matching. Proc. Of 2007 10th IEEE Int. Conf. on Computer-Aided Design and Computer Graphics. Beijing, China. Oct. 15-18, 2007.\r\n\r\n  [5] HU Baokun, LIU Yusheng, Gao Shuming. Parallel global optimal approach of feedback for 3D CAD model retrieval. Proc. Of 2007 10th IEEE Int. Conf. on Computer-Aided Design and Computer Graphics. Beijing, China. Oct. 15-18, 2007.\r\n\r\n  [6] XIAN Chuhua, LIU Yusheng, Gao Shuming. Constructive MA generation for 2D models. Proc. Of 2007 10th IEEE Int. Conf. on Computer-Aided Design and Computer Graphics. Beijing, China. Oct. 15-18, 2007.\r\n\r\n \r\n\r\n【2006】\r\n\r\n[1]  Liu Yusheng, Gao Shuming. Generating Variational Geometry of a Hole With Composite Tolerances.  IEEE Transactin on Automation science and technology. 3(1):92-107, 2006.\r\n\r\n[2]  Ye Xiaoping, Liu Yusheng. An Efficient Similarity Assessment Approach of 3D Models Based on Frequency Spectrum.  Journal of Computational Information Systems 1(2): 203-213,2006.\r\n\r\n　\r\n\r\n【2005】\r\n\r\n[1]  Gao Shuming, Zhou Guangping, Liu Yusheng. A Divide-and-Conquer Algorithm for Machining Feature Recognition Over Network.   ASME’2005 DETC/CIE84912, Long Beach, CA, USA. Sept. 24-28.\r\n\r\n[2]  Gao Wei, Gao Shuming, Liu Yusheng.  3D CAD Model Similarity Assessment and Retrieval Using DBS.  ASME’2005 DETC/CIE84912, Long Beach, CA, USA. Sept. 24-28.\r\n\r\n[3]  Li Jianhua, Liu Yusheng, Gao Shuming. Mask Synthesis and Verification based on geometric model for surface micro-machined MEMS.   J. of Zhejiang University Science. 6A(9):1007-1010, 2005.\r\n\r\n[4]  Li Jianhua, Gao Shuming, Liu Yusheng. Feature based process layer modeling for surface micromachined MEMS.  J. Micromech. Microeng. 15(3):620-635, 2005.\r\n\r\n[5]  Liu Yusheng, Gao Shuming, Cao Yanlong. Generic Approach to Generating Variatioal Geometry of Holesin Three Dimensional CAD Systems. Chinese Journal of Mechanical Engineering. 41(7):112-118, 2005.\r\n\r\n　\r\n\r\n【2004】\r\n\r\n[1]  Liu Yusheng, Gao Shuming. Variational Geometry Based Tolerance Pre-evaluation for Pattern of Holes. J.of Production Research. 42(8):1659-1675, 2004.\r\n\r\n[2]  Li Jianhua,Gao Shuming, Liu Yusheng. Automated Generation of Layered Model for Surface Micro-machined MEMS. Int. J. of Computer-Aided Design and Application. 1(1):137-146, 2004.\r\n\r\n　\r\n\r\n【2003】\r\n\r\n[1]  Liu Yusheng, Gao Shuming, Wu Zhaotong, Yang Jiangxin. Feature based Hierarchical Tolerance Representation Model. Chinese J. of Mechanical Engineering. 39（3）：1-7, 2003.\r\n\r\n[2]  Liu Yusheng, Gao Shuming, Wu Zhaotong, Yang Jiangxin. An approach to Representing 3D tolerance Semantics based on Mathematical Definition. 14(3):241-245, 2003.\r\n\r\n[3]  Li Jianhua,Gao Shuming, Liu Yusheng. Generation of Surface Micromachined MEMS process model based on Geometric Model. CIMS. 9（12）：1126-1131, 2003.\r\n\r\n　　\r\n\r\n【2002】\r\n\r\n[1]   Liu Yusheng, Gao Shuming. An Approach for Generating Variational Geometry of A Pattern of Holes with Composite Positional Tolerances.    ASME’2002 DETC/DAC34233. Montreal, Canada, September 29-October 2, 2002.\r\n\r\n[2]   Liu Yusheng, Yang Jiangxin, Wu Zhaotong.  A Mathematical Model of Symmetry Based on Mathematical Definition.  Journal of Zhejiang University. ( in English ).   2002,2(1).\r\n\r\n[3]   Liu Yusheng. A Mathematical Model For Straightness Based on DOF Variation. Engineering Design( in Chinese) 2002, 9(1).\r\n\r\n　\r\n\r\n【2001】\r\n\r\n[1]   Liu Yusheng, , Wu Zhaotong Yang Jiangxin.  Mathemathical model of size tolerance for plane based on mathematical definition. Chinese Journal of Mechanical Engineering( in Chinese ). 2001,31(9).\r\n\r\n[2]   Liu Yusheng, , Wu Zhaotong Yang Jiangxin, Gao Shuming. A survey of modeling and representation of tolerance information in CAD systems.  Journal of computer aided design & computer graphics.( in Chinese) 2001, 13(11).\r\n\r\n[3]  Liu Yusheng, Yang Jiangxin, Wu Zhaotong. Fuzzy Optimal design of concurrent tolerance. Journal of Zhejiang University(Engineering ). 2001.35(1).\r\n\r\n[4]   Liu Yusheng. Research On Tolerance Analysis of Visualization. Engineering Design( in Chinese) 2001, 8(4).\r\n\r\n　\r\n\r\n【2000】\r\n\r\n[1]   Yang Jiangxin, Liu Yusheng, Tang Jianrong , Wu Zhaotong.  A CAD Model for Concurrent Tolerance. Chinese Journal of Mechanical  Engineering(in English).  2000,13(2).\r\n\r\n[2]   Liu Yusheng, Yang Jiangxin, Wu Zhaotong. Machining Capability Oriented Tolerance Reverse Design.  Chinese Mechanical Engineering( in Chinese ). 2000.11(6).\r\n\r\n[3]  Liu Yusheng, Wu Zhaotong. An evaluation method of technology economics for multi process planning.  Mechanical Manufacturing( in Chinese).  2000.38(7).\r\n\r\n　　\r\n\r\n【1999】\r\n\r\n[1]   Liu Yusheng, Yang Jiangxin, Wu Zhaotong.  A CAD Model for Geometric Tolerance( in English). The 6th international conference of CAD/CG.  Shanghai. 1999.12：29-34.\r\n\r\n[2]  Liu Yusheng, Wu Zhaotong, Fang Hongfang  Optimal design of tolerance in the integration of CAD/CAPP. Journal of Zhejiang University(Engineering ). 1999.\r\n\r\n Research Projects\r\n\r\n　\r\n\r\nUndertaken\r\n\r\n(1) "Research on SysML-based Automatic Modeling of System-Level Multi-Domain Coupling of Complex Products"  (No. 61173126) Supported by National Natural Science Foundation of China.  2012.1 – 2015.12\r\n\r\n　\r\n\r\n(2) "Research on System-level model integration of design and analysis for complex mechatronics" (No. R1110377). Supported by Zhejiang Provincial Outstanding Natural Science Foundation of China. 2011.1-2014.12\r\n\r\n　\r\n\r\n(3) "Simulation and Optimization of Orange Peeling Equipment " Supported by the 863 High-Technology Project of China (No. 2011AA100804). 2011.1-2015.12\r\n\r\n \r\n\r\nPrevious\r\n\r\n(1) “3D Model retrieval platform for supporting product creative design”(2008C01048-1).  Key project of Zhejiang province.  2009.1-2010.12.\r\n\r\n(2) “Research on System-level integration of design and analysis based on SysML” (No. 61070064).  Supported by National Natural Science Foundation of China.  2011.1 – 2011.12\r\n\r\n(3)  “CAE Platform for mechanical systems”(No. 2009AA044501). Sub-project of Key 863 project.  2010.1-2011.12\r\n\r\n(4)  “Creative product design based 3D geometric resource reuse” (No. 2005C21096), Key project of Zhejiang Province. 2005.1-2006.12\r\n\r\n(5) “Integration of Collaborative Design and ERP for Print&Package Enterprise”  (No. 2005C11050), Key project of Zhejiang Province. 2005.6-2007.6\r\n\r\n(6)  “MEMS component function modeling based on solid model”.  Project of aerospace support technology. 2006.1-2007.12', '刘玉生老师，浙江大学CAD&CG国家重点实验室固定研究人员，研究计算机辅助设计', '软件需求工程', '刘玉生', 'images/teacher/3.jpg'),
(15, '这是金波老师的教学经历', '这是金波老师的个人介绍', '这是金波老师的所获荣誉', '金波老师，浙江大学系统结构与网络安全研究所', '软件工程管理', '金波', 'images/teacher/4.jpg');
