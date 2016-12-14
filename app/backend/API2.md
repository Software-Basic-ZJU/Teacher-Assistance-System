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

