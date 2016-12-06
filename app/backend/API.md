# API文档

（默认给token）

## 1、登录功能

POST——Teacher-Assistance-System/app/backend/login/login.php

参数：id, password, type（登陆的身份类型，1为学生，2为教师，3为助教）

返回:

```php
    code: 0（学生登录成功）
    msg: 登陆成功
    res:{
        "token" （加密后的用户token，用于验证）
        "id"（student_id）
        'class_id'   
        'teacher_id'
        'name'    (sname)
        'type'     (此时为1，代表学生)
        'group_id'
    }
```
```php
	"code" => 1,（学生登录成功）
    "msg" => "登陆成功，其班级无教师信息",
	"res" => array(
         "token" 
         "id"    （student_id）
         'class_id' 
         'teacher_id'（null，没有找到教师信息）
         'name'  (sname)
         'type'   (此时为1，代表学生)
         'group_id' 
    )
```

```php
    "code" => 2,
    "msg" => "登录失败,用户名或密码或类型错误",
    "res" => array()
```

```php
	"code" => 3,(教师登陆成功)
    "msg" => "登陆成功",
    "res" => array(
          "token"
          "id"  （teacher_id）
          'class_id'  (null)
          'teacher_id'   (null)
          'name' （姓名）
          'type'  (此时为2，代表教师)
          'group_id' （null）
	)
```

```php
			"code" => 4,
            "msg" => "登陆成功",
            "res" => array(
                "token" 
                "id" (assist_id)
                'class_id'=>null,
                'teacher_id'=> null,
                'name'=>null,
                'type'(此时为3，代表助教)
                'group_id'=>null
            )
```



## 2、查找一个班级的通知列表功能

POST——Teacher-Assistance-System/app/backend/aboutNotice/getNotices.php

参数：class_id（查找一个班级的通知）

返回:

```php
		"code" => 0,
        "msg" => "查找成功",
        "res" => $notices
          
        //$notices是一个数组
        $notices[] = array(
            "notice_id" （通知的ID）,
            "title" ,
            "level" （级别，重要程度）,
            "time"（发布时间）
            "content" （通知内容）
        );
```

```php
		"code" => 1,
        "msg" => "查找失败，班级ID错误",
        "res" => null
```

## 3、查找一则通知功能

POST——Teacher-Assistance-System/app/backend/aboutNotice/getNoticeDetail.php

参数：notice_id

返回:

```php
		"code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "notice_id" 
            "title"
            "content"
            "time"
            "level"(0为普通，1为重要)
        )
```

```php
		"code" => 1,
        "msg" => "查找失败，notice_id错误",
        "res" => null
```

## 4、查找一个教师的文章列表功能

POST——Teacher-Assistance-System/app/backend/aboutArticle/getArticles.php

参数：teacher_id

返回:

```php
		"code" => 0,
        "msg" => "查找成功",
        "res" => $articles
 //其中$articles为数组的数组
          $articles[] = array(
            "article_id"
            "title"
            "content"
            "author"
            "time"
        );
```

```php
		"code" => 1,
        "msg" => "查找失败，teacher_id错误",
        "res" => null
```

## 5、查找一篇文章

POST——Teacher-Assistance-System/app/backend/aboutArticle/getArticleDetail.php

参数：article_id

返回:

```php
		"code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "article_id"
            "title"
            "content" 
            "author"
            "time"
        )
```

```php
		"code" => 1,
        "msg" => "查找失败，article_id错误",
        "res" => null
```

## 6、返回教师联系方式

POST——Teacher-Assistance-System/app/backend/aboutInfo/getContact.php

参数：teacher_id

返回:

```php
		"code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "name" （教师名字）
            "phone" 
            "email" 
            "wechat"
            "qq" 
            "other_contact" 
        )
```

```php
		"code" => 1,
        "msg" => "查找失败，class_id错误",
        "res" => null
```

## 7、返回课程信息

POST——Teacher-Assistance-System/app/backend/aboutInfo/getCourseInfo.php

参数：teacher_id

返回:

```php
		"code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "course_info"
        )
```

```php
		"code" => 1,
        "msg" => "查找失败，class_id错误",
        "res" => null
```

## 8、返回教师信息

POST——Teacher-Assistance-System/app/backend/aboutInfo/getTeacherInfo.php

参数：teacher_id

返回:

```php
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "teacher_info" => $fetched['teacher_info'],
        )
```

```php
		"code" => 1,
        "msg" => "查找失败，class_id错误",
        "res" => null
```

## 9、返回教师资源列表

POST——Teacher-Assistance-System/app/backend/aboutResource/getResourceList.php

参数：teacher_id

返回:

```php
		"code" => 0,
        "msg" => "查找成功",
        "res" => $resourceList
          
         其中
          $resourceList[] = array(
            "resource_id" 
            "name" 资源名字
            "path"路径
            "upload_time" 
            "uploader_name"
            "size" 资源大小
        );
```

```php
		"code" => 1,
        "msg" => "查找失败，class_id错误,或者没有资源",
        "res" => null
```

## 10、上传文件到服务器并插入resource表

POST——Teacher-Assistance-System/app/backend/aboutResource/addResource.php

参数：uploader_id、type（0为教师资源，1为帖子资源）、file

返回:

```php
    $result = array(
        'code' => 0,
        'msg' => '添加成功',
        'res' => array(
            'resource_id' => $resource_id,
            'name' => $name,
            'time' => $time,
            'size' => $size,
            'path' => $path,
            'uploader_name' => $user_name,
            'uploader_id' => $uploader_id
        )
    );
```

```php
  			'code' => 1,
            'msg' => '添加失败,数据库错误',
            'res' => null
```

## 11、上传资源确认名字

POST——Teacher-Assistance-System/app/backend/aboutResource/resourceConfirm.php

参数：resource_id、name、old_resource_id

返回:

```php
	$result = array(
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            'name' => $name
        )
    );
```

```php
	$result = array(
        "code" => 1,
        "msg" => "修改失败",
        "res" => null
    );
```

## 12、删除资源

POST——Teacher-Assistance-System/app/backend/aboutResource/removeResource.php

参数：resource_id

返回:

```php
            "code" => 0,
            "msg" => "删除成功",
            "res" => null
```

```php
            "code" => 1,
            "msg" => "删除失败",
            "res" => null
```

```php
        "code" => 2,
        "msg" => "没有这个资源",
        "res" => null
```

```php
		"code" => 3,
        "msg" => "无效用户尝试删除文件",
        "res" => null
```

## 14、教师修改联系方式

POST——Teacher-Assistance-System/app/backend/aboutInfo/editContact.php

参数：teacher_id,email,phone,qq,wechar,other_contact

返回:

```php
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            "phone"
            "email" 
            "wechat"
            "qq"
            "other_contact"
        )
```

```php
        "code" => 1,
        "msg" => "查找失败",
        "res" => null
```

## 15、发布通知

POST——Teacher-Assistance-System/app/backend/aboutNotice/addNotice.php

参数：title、content、level、class_id

返回:

```php
        "code" => 0,
        "msg" => "通知发布成功",
        "res" => array(
            'notice_id'
            'title'
            'level' => $level,
            'time' => $time,
            'content' => $content,
            'class_id' => $class_id
        )
```

```php
        "code" => 1,
        "msg" => "通知发布失败",
        "res" => null
```

## 16、修改通知

POST——Teacher-Assistance-System/app/backend/aboutNotice/editNotice.php

参数：notice_id、title、content、level、class_id

返回:

```php
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            'notice_id' => $notice_id,
            'title' => $title,
            'level' => $level,
            'time' => $time,
            'content' => $content,
            'class_id' => $class_id
        )
```

```php
        "code" => 1,
        "msg" => "查找失败",
        "res" => null
```

```php
        "code" => 2,
        "msg" => "无效用户尝试操作",
        "res" => null
```

## 17、删除通知

POST——Teacher-Assistance-System/app/backend/aboutNotice/deleteNotice.php

参数：notice_id

返回:

```php
		"code" => 0,
        "msg" => "删除成功",
        "res" => null
```

```php
        "code" => 1,
        "msg" => "删除失败",
        "res" => null
```

```php
        "code" => 2,
        "msg" => "无效用户尝试删除",
        "res" => null
```

## 18、发布文章

POST——Teacher-Assistance-System/app/backend/aboutArticle/addArticle.php

参数：title、content、teacher_id，author、authority

返回:

```php
        "code" => 0,
        "msg" => "文章发布成功",
        "res" => array(
            'article_id' 
            'title' => $title,
            'time' => $time,
            'content' => $content,
            'author' => $author,
            'authority' => $authority
```

```php
		"code" => 1,
        "msg" => "发布失败",
        "res" => null
```

## 19、编辑文章

POST——Teacher-Assistance-System/app/backend/aboutArticle/editArticle.php

参数：article_id、title、content、teacher_id，author、authority

返回:

```php
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            'article_id' => $article_id,
            'title' => $title,
            'time' => $time,
            'content' => $content,
            'author' => $author,
            'authority' => $authority
        )
```

```php
        "code" => 1,
        "msg" => "修改失败",
        "res" => null
```

```php
        "code" => 2,
        "msg" => "无效用户尝试操作",
        "res" => null
```

##  20、删除文章

POST——Teacher-Assistance-System/app/backend/aboutArticle/deleteArticle.php

参数：article_id

返回:

```php
        "code" => 0,
        "msg" => "删除成功",
        "res" => null
```

```php
        "code" => 1,
        "msg" => "删除失败",
        "res" => null
```

```php
        "code" => 2,
        "msg" => "无效用户尝试删除",
        "res" => null
```

## 21、编辑课程信息

POST——Teacher-Assistance-System/app/backend/aboutInfo/editCourseInfo.php

参数：course_info、teacher_id

返回:

```php
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            'course_info' => $course_info
        )
```

```php
        "code" => 1,
        "msg" => "修改失败",
        "res" => null
```

```php
        "code" => 2,
        "msg" => "无效用户尝试操作",
        "res" => null
```

## 22、编辑教师信息

POST——Teacher-Assistance-System/app/backend/aboutInfo/editTeacherInfo.php

参数：teacher_info、teacher_id

返回:

```php
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            'teacher_info' => $teacher_info
        )
```

```php
        "code" => 1,
        "msg" => "修改失败",
        "res" => null
```

```php
        "code" => 2,
        "msg" => "无效用户尝试操作",
        "res" => null
```

## 23、获取作业列表

POST——Teacher-Assistance-System/app/backend/aboutHW/getHwList.php

参数：class_id

返回:

```php
        "code" => 0,
        "msg" => "查找成功",
        "res" => $hwList
          
        $hwList[] = array(
            "hw_id" => $fetched['hw_id'],
            "title" => $fetched['title'],
            "type" => $fetched['type'],
            "publish_time" => $fetched['publish_time'],
            "deadline" => $fetched['deadline'],
            "punish_type" => $fetched['punish_type'],
            "punish_rate" => $fetched['punish_rate'],
            "over" => $fetched['over'],//老师是否已经全部批改
            "out_of_deadline" => $out_of_deadline//0是过期了,1是没过期
        );
```

```php
        "code" => 1,
        "msg" => "查找失败，class_id错误",
        "res" => null
```

## 24、发布作业

POST——Teacher-Assistance-System/app/backend/aboutHW/addHw.php

参数：class_id,title,deadline,type,punish_type,punish_rate

返回:

```php
        "code" => 0,
        "msg" => "作业发布成功",
        "res" => null
```

```php
        "code" => 1,
        "msg" => "作业发布失败",
        "res" => null
```

## 25、编辑作业

POST——Teacher-Assistance-System/app/backend/aboutHW/editHw.php

参数：hw_id,class_id,title,deadline,type,punish_type,punish_rate

返回:

```php
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            "hw_id" => $fetched['hw_id'],
            "title" => $fetched['title'],
            "type" => $fetched['type'],
            "publish_time" => $fetched['publish_time'],
            "deadline" => $fetched['deadline'],
            "punish_type" => $fetched['punish_type'],
            "punish_rate" => $fetched['punish_rate'],
            "over" => $fetched['over']
        )
```

```php
        "code" => 1,
        "msg" => "修改失败",
        "res" => null
```

```php
        "code" => 2,
        "msg" => "无效用户尝试操作",
        "res" => null
```

## 26、删除作业

POST——Teacher-Assistance-System/app/backend/aboutHW/deleteHw.php

参数：hw_id

返回:

```php
        "code" => 0,
        "msg" => "删除成功",
        "res" => null
```

```php
        "code" => 1,
        "msg" => "删除失败",
        "res" => null
```

## 27、查找一份作业中的问题列表

POST——Teacher-Assistance-System/app/backend/aboutQues/getQuesList.php

参数：hw_id

返回:

```php
		"code" => 0,
        "msg" => "查找成功",
        "res" => $quesList
          
          $quesList[] = array(
            "ques_id" => $fetched['ques_id'],
            "title" => $fetched['title'],
            "type" => $fetched['type'],
            "content" => $fetched['content'],
            "should_num" => $should_num,
            "submit_num" => $fetched['submit_num'],
            "ques_finish" => $fetched['ques_finish']
        );
```

```php
        "code" => 1,
        "msg" => "查找失败",
        "res" => null
```

## 28、增加一份作业中的一个问题

POST——Teacher-Assistance-System/app/backend/aboutQues/addQues.php

参数：Hw_id,title,content,type

返回:

```php
        "code" => 0,
        "msg" => "题目发布成功",
        "res" => array(
            "ques_id" => $ques_id,
            "title" => $title,
            "type" => $type,
            "content" => $content,
            "should_num" => $should_num,
            "submit_num" => 0,
            "ques_finish" => 0
        )
```

```php
        "code" => 1,
        "msg" => "题目发布失败",
        "res" => null
```

## 29、删除一份作业中的一个问题

POST——Teacher-Assistance-System/app/backend/aboutQues/removeQues.php

参数：ques_id

返回:

```php
        "code" => 0,
        "msg" => "删除成功",
        "res" => null
```

```php
        "code" => 1,
        "msg" => "删除失败",
        "res" => null
```

```php
        "code" => 2,
        "msg" => "无效用户尝试操作",
        "res" => null
```



## 30、修改一份作业中的一个问题

POST——Teacher-Assistance-System/app/backend/aboutQues/editQues.php

参数：ques_id,title,content,type

返回:

```php
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            "ques_id" => $fetched['ques_id'],
            "title" => $fetched['title'],
            "type" => $fetched['type'],
            "content" => $fetched['content'],
            "should_num" => $should_num,
            "submit_num" => $fetched['submit_num'],
            "ques_finish" => $fetched['ques_finish']
        )
```

```php
        "code" => 1,
        "msg" => "修改失败",
        "res" => null

```

```php
        "code" => 2,
        "msg" => "无效用户尝试操作",
        "res" => null
```

## 31、一个学生交一个问题的作业（work）

POST——Teacher-Assistance-System/app/backend/aboutWork/submitWork.php

参数：ques_id,content,attachment,uploader_id,type

返回:

```php
        "code" => 0,
        "msg" => "作业提交成功",
        "res" => null
```

```php
        "code" => 1,
        "msg" => "作业提交失败",
        "res" => null
```

```php
            "code" => 2,
            "msg" => "作业提交成功,但是数据库已交数目并未更新",
            "res" => null
```

## 32、得到一个学生对于一个问题的提交

POST——Teacher-Assistance-System/app/backend/aboutWork/getStuWork.php

参数：ques_id,uploader_id

返回:

```php
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "work_id" => $fetched['work_id'],
            "reply" => $fetched['reply'],
            "content" => $fetched['content'],
            "score" => $fetched['score'],
            "attachment" => $fetched['attachment'],
            "uploader_id" => $fetched['uploader_id']
```

```php
        "code" => 1,
        "msg" => "查找失败",
        "res" => null
```

## 33、批改一个提交（work）

POST——Teacher-Assistance-System/app/backend/aboutWork/correctWork.php

参数：work_id,score,reply

返回:

```php
        "code" => 0,
        "msg" => "点评成功",
        "res" => null
```

```php
        "code" => 1,
        "msg" => "点评失败",
        "res" => null
```

```php
        "code" => 2,
        "msg" => "无效用户尝试操作",
        "res" => null
```

## 34、提交对于一个问题（ques）的所有评价

POST——Teacher-Assistance-System/app/backend/aboutQues/finishQues.php

参数：ques_id

返回:

```php
            "code" => 0,
            "msg" => "提交成功",
            "res" => null
```

```php
        "code" => 1,
        "msg" => "还有未点评的work",
        "res" => null
```

```php
        "code" => 2,
        "msg" => "无效用户尝试操作",
        "res" => null
```

## 35、获取一道题目（ques）的应交名单

POST——Teacher-Assistance-System/app/backend/aboutWork/getWorkStuList.php

参数：ques_id，type

返回:

```php
           "code" => 0,
            "msg" => "个人查找成功",
            "res" => $stuList
              
              $stuList[] = array(
                "id" => $fetched['student_id'],
                "name" => $fetched['name'],
                "status" => $status//已交是1，未交是0
            );
```

```php
        $result = array(
            "code" => 1,
            "msg" => "小组查找成功",
            "res" => $stuList
        );
        
            $stuList[] = array(
                "id" => $fetched['student_id'],
                "name" => $fetched['name'],
                "status" => $status
            );
```

```php
            "code" => 3,
            "msg" => "查找失败",
            "res" => null
```

## 36、获取论坛首页信息

POST——Teacher-Assistance-System/app/backend/aboutPost/getForumInfo.php

参数：teacher_id

返回:

```php
        "code" => 0,
        "msg" => "查找成功",
        "res" => $sectionList
         
          $sectionList[] = array(
            "section" => $fetched['section'],
            "total_num" => $fetched['total_num'],
            "today_num" => $fetched['today_num']
        );
```

```php
        "code" => 1,
        "msg" => "查找失败",
        "res" => null
```

## 37、获取帖子列表 

POST——Teacher-Assistance-System/app/backend/aboutPost/getPostList.php

参数：section,teacher_id,group_id//若section为2的时候要传group-id

//sction：0为教师答疑区，1为公共讨论区，2为小组讨论区

返回:

```php
            "code" => 0,
            "msg" => "查找成功",
            "res" => $postList
              
              $postList[] = array(
                "post_id" => $post_id,
                "title" => $fetched['title'],
                "content" => $fetched['content'],
                "author_id" => $author_id,
                "author_name" => $author_name,
                "publish_time" => $fetched['publish_time'],
                "update_time" => $fetched['update_time'],
                "reply_num" => $reply_num,
                "attachment" => $attachment
            );

       		$attachment[] = array(
                        "resrc_id" => $fetched_resource['resrc_id'],
                        "name" => $fetched_resource['name'],
                        "path" => $fetched_resource['path'],
                        "size" => $fetched_resource['size']
                    );
```

```php
            "code" => 1,
            "msg" => "查找失败，错误",
            "res" => null
```

```php
                        "code" => 2,
                        "msg" => "无此上传人",
                        "res" => null
```

## 38、发布帖子

POST——Teacher-Assistance-System/app/backend/aboutPost/addPost.php

参数：title,content,teacher_id,section、resrc_id

（要发布帖子，首先使用aboutResource/addResource.php上传附件，再使用此脚本发布文章）

返回:

```php
		"code" => 0,
        "msg" => "帖子发布成功",
        "res" => array(
            'post_id' => $post_id,
            'title' => $title,
            'content' => $content,
            'author_id' => $author_id,
            'author_name' => $author_name,
            'publish_time' => $time,
            'update_time' => $time,
            'reply_num' => 0
        )
```

```php
        "code" => 1,
        "msg" => "帖子发布失败",
        "res" => null
```

```php
            $result = array(
                "code" => 2,
                "msg" => "发帖人并无所在小组",
                "res" => null
            );
```

```php
            $result = array(
                "code" => 3,
                "msg" => "无此发帖人",
                "res" => null
            );
```

```php
            "code" => 4,
            "msg" => "无法插入资源",
            "res" => null
```

