<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>


<h2>PHP 验证实例</h2>
<form method="post" action="getInfo/getTeacherInfo.php">
    id：<input type="text" name="id">
    <br><br>
    password：<input type="text" name="password">
    <br><br>
    class_id：<input type="text" name="class_id">
    <br><br>
    teacher_id：<input type="text" name="teacher_id">
    <br><br>
    notice_id：<input type="text" name="notice_id">
    <br><br>
    article_id：<input type="text" name="article_id">
    <br><br>

    type：
    <input type="radio" name="type" value="1">student
    <input type="radio" name="type" value="2">teacher
    <br><br>
    <input type="submit" name="submit" value="登陆">
</form>


</body>
</html>