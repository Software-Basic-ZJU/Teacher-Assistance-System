DROP TABLE IF EXISTS `course_info`;
CREATE TABLE `course_info` (
  `info_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_name` text,   -- 课程名称
  `background` text,  -- 课程国内国际背景
  `course_plan` text,  -- 课时安排、教学计划
  `textbook_precourse` text,  -- 使用教材、预修要求
  `exam_homework` text,  -- 考核方式、大作业介绍
  PRIMARY KEY (`info_id`),
  UNIQUE KEY `info_id` (`info_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `teacher_info`;
CREATE TABLE `teacher_info` (
  `info_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `teach_experience` text,  -- 教学经历、科研成果
  `profile` text,  -- 教学风格、个人简介
  `honor` text,  -- 所获荣誉、出版书籍
  `other_info` text,
  `course_info` text,
  PRIMARY KEY (`info_id`),
  UNIQUE KEY `info_id` (`info_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

ALTER TABLE `message` ADD `reply_content` text;

insert into message (content,author,time,msg_state) 
     values('$content','$author','$time','$msg_state')"
