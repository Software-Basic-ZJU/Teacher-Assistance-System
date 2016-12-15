## 49、查看一个帖子

POST——Teacher-Assistance-System/app/backend/aboutPost/getPostDetail.php

参数：post_id

返回:

```php
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "post_id" => $fetched['post_id'],
            "teacher_id" => $fetched['teacher_id'],
            "section" => $fetched['section'],
            "title" => $fetched['title'],
            "content" => $fetched['content'],
            "author_id" => $fetched['author_id'],
            "author_name" => getAuthorName($conn,$fetched['author_id']),
            "group_id" => $fetched['group_id'],
            "publish_time" => $fetched['publish_time'],
            "update_time" => $fetched['update_time'],
            "resource" => $resource,
            "token" => $_SESSION['token']

          //有资源的话
        $resource = array(
            "resrc_id" => $fetched2['resrc_id'],
            "name" => $fetched2['name'],
            "path" => $fetched2['path'],
            "size" => $fetched2['size'],
            "time" => $fetched2['time'],
            "type" => $fetched2['type'],
            "post_id" => $fetched2['post_id'],
            "uploader_id" => $fetched2['uploader_id']
        );
         //没有资源的话
          $resource = null
```

```php
        "code" => -1,
        "msg" => "查找失败，post_id错误",
        "res" => array(
            "token" => $_SESSION['token']
        )
```

## 50、发送帖子

POST——Teacher-Assistance-System/app/backend/aboutMail/sendMail.php

参数：dest_id、src_id、title、content

返回:

```php
        "code" => 0,
        "msg" => "信息发送成功",
        "res" => array(
            'mail_id' => mysqli_insert_id($conn),
            'title' => $title,
            'time' => $time,
            'content' => $content,
            'src_id' => $src_id,
            'src_name' => $src_name,
            'dest_id' => $dest_id,
            'dest_name' => $dest_name,
            "token" => $_SESSION['token']
```

```php
        "code" => -1,
        "msg" => "发送失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
```

## 51、删除邮件

POST——Teacher-Assistance-System/app/backend/aboutMail/deleteMail.php

参数：mail_id

返回:

```php
    $result = array(
        "code" => 0,
        "msg" => "删除成功",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
```

```php
    $result = array(
        "code" => -1,
        "msg" => "删除失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
```

## 52、读邮件

POST——Teacher-Assistance-System/app/backend/aboutMail/readMail.php

参数：mail_id

返回:

```php
        "code" => 0,
        "msg" => "已阅读",
        "res" => array(
            "token" => $_SESSION['token']
        )
```

```php
        "code" => -1,
        "msg" => "阅读失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
```

## 53、创建小组

POST——Teacher-Assistance-System/app/backend/aboutGroup/createGroup.php

参数：leader_id,group_name,group_password,class_id

返回:

```php
            "code" => 0,
            "msg" => "小组创建成功",
            "res" => array(
                'group_id' => $group_id,
                'group_name' => $group_name,
                "token" => $_SESSION['token']
            )
```

```php
            "code" => -1,
            "msg" => "小组创建成功,小组组长小组信息更新未成功",
            "res" => array(
                'group_id' => $group_id,
                'group_name' => $group_name,
                "token" => $_SESSION['token']
            )
```

```php
        "code" => -1,
        "msg" => "小组创建失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
```

## 54、删除小组

POST——Teacher-Assistance-System/app/backend/aboutGroup/createGroup.php

参数：leader_id,group_id

返回:

```php
    $result = array(
        "code" => 403,
        "msg" => "无效用户尝试删除",
        "res" => null
    );
```

```php
    $result = array(
        "code" => -1,
        "msg" => "无此小组",
        "res" => null
    );
```

```php
    $result = array(
        "code" => 0,
        "msg" => "删除成功",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
```

```php
        "code" => -1,
        "msg" => "删除失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
```

## 55、获取小组列表

POST——Teacher-Assistance-System/app/backend/aboutGroup/getGroupList.php

参数：class_id

返回:

```php
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            'groupList' => $groupList,
            "token" => $_SESSION['token']
        )
          
          $groupList[] = array(
            "group_id" => $group_id,
            "class_id" => $fetched['class_id'],
            "group_name" => $fetched['group_name'],
            "group_leader" => getAuthorName($conn ,$leader_id),
            "group_member" => $group_member
        );

		$group_member[] = array(
                "name" => $fetched_name['name']
            );
```

```php
        "code" => -1,
        "msg" => "查找失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
```

## 56、加入小组

POST——Teacher-Assistance-System/app/backend/aboutGroup/joinGroup.php

参数：group_id、student_id、password

返回:

```php
    $result = array(
        "code" => 403,
        "msg" => "密码错误",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
```

```php
        "code" => 0,
        "msg" => "加入成功",
        "res" => array(
            'name' 学生姓名
            'token' => $_SESSION['token']
        )
```

```php
        "code" => -1,
        "msg" => "加入失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
```

## 57、退出小组

POST——Teacher-Assistance-System/app/backend/aboutGroup/quitGroup.php

参数：student_id

返回:

```php
    $result = array(
        "code" => 0,
        "msg" => "退出成功",
        "res" => array(
            'token' => $_SESSION['token']
        )
    );
```

```php
    $result = array(
        "code" => -1,
        "msg" => "退出失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
```

## 58、增加助教

POST——Teacher-Assistance-System/app/backend/aboutTA/addTA.php

参数：class_id,teacher_id,assist_id,assist_password,name

返回:

```php
            "code" => 0,
            "msg" => "助教增加成功",
            "res" => array(
                'class_id' => $class_id,
                'teacher_id' => $teacher_id,
                'assist_id' => $assist_id,
                'name' => $name,
                "token" => $_SESSION['token']
            )
```

```php
            "code" => -1,
            "msg" => "助教表,联系表未增加成功",
            "res" => array(
                'class_id' => $class_id,
                'teacher_id' => $teacher_id,
                'assist_id' => $assist_id,
                'name' => $name,
                "token" => $_SESSION['token']
```

```php
        "code" => -1,
        "msg" => "助教未增加成功",
        "res" => array(
            "token" => $_SESSION['token']
        )
```

## 59、获取助教列表

POST——Teacher-Assistance-System/app/backend/aboutTA/getTAList.php

参数：teacher_id

返回:

```php
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "token" => $_SESSION['token'],
            "assistList" => $assistList
        )
        
        $assistList[] = array(
            "assist_id" => $fetched['assist_id'],
            "class_id" => $fetched['class_id'],
            "name" => $fetched['name'],
        );

```

```php
        "code" => -1,
        "msg" => "查找失败，teacher_id错误",
        "res" => array(
            "token"=>$_SESSION['token']
        )
```

## 60、删除助教

POST——Teacher-Assistance-System/app/backend/aboutTA/deleteTA.php

参数：teacher_id、assist_id

返回:

```php
    $result = array(
        "code" => 403,
        "msg" => "无效用户尝试删除",
        "res" => null
    );
```

```php
        $result = array(
            "code" => 0,
            "msg" => "删除成功",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
```

```php
            "code" => 0,
            "msg" => "联系表删除成功,助教表删除失败",
            "res" => array(
                "token" => $_SESSION['token']
            )
```

```php
        "code" => -1,
        "msg" => "删除失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
```

