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

