<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<!--teacher_id,email,phone,qq,wechar,other_contact-->
<h2>PHP 验证实例</h2>
<form method="post" action="aboutPost/getPostDetail.php">
    <br><br>
    post_id：<input type="text" name="post_id">
    <br><br>
    author_id：<input type="text" name="author_id">
    <br><br>
    content：<input type="text" name="content">
    <br><br>
    finish：<input type="text" name="finish">
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