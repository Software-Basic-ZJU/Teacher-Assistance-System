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
<form method="post" action="aboutInfo/checkWithEmail.php">
    <br><br>
    student_id：<input type="text" name="student_id">
    <br><br>
    newPassword：<input type="text" name="newPassword">
    <br><br>
    email：<input type="text" name="email">
    <br><br>
    id：<input type="text" name="id">
    <br><br>
    type：<input type="text" name="type">
    <br><br>
    password：<input type="text" name="password">
    <br><br>
    code：<input type="text" name="code">
    <br><br>
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