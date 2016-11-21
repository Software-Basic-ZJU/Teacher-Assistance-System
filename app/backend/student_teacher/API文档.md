# API文档

## 1、登录功能

POST——Teacher-Assistance-System/app/backend/student_teacher/login.php

参数：id, password, type（登陆的身份类型，1为学生，2为教师）

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

## 2、查找通知功能

POST——Teacher-Assistance-System/app/backend/student_teacher/getNotices.php

参数：class_id

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

