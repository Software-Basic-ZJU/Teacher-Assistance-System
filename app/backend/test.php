<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
<!--,,,-->
<h2>PHP 验证实例</h2>
<form method="post" action="aboutTA/">
    <br><br>
    class_id：<input type="text" name="class_id">
    <br><br>
    teacher_id：<input type="text" name="teacher_id">
    <br><br>
    assist_id：<input type="text" name="assist_id">
    <br><br>
    assist_password：<input type="text" name="assist_password">
    <br><br>
    name：<input type="text" name="name">
    <br><br>
    type：
    <input type="radio" name="type" value="0">0
    <input type="radio" name="type" value="1">1
    <input type="radio" name="type" value="2">2
    <br><br>
    <input type="submit" name="submit" value="登陆">
</form>


</body>
</html>
<?php
//date_default_timezone_set('Asia/Shanghai');
//header('Content-type: application/json;charset=utf-8');
//
//include 'login/_include.php';
//$password = encrypt("haha");
//echo "this is :".$password;
//echo "     hahahahaha      ";
//echo decrypt($password);
//?>