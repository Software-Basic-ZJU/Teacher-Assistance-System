<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/28
 * Time: 08:48
 */
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
loginCheck($_POST['token']);
//Get information
$title = test_input(mysqli_escape_string($conn, $_POST['title']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$author = test_input(mysqli_escape_string($conn, $_POST['author']));
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
$authority = test_input(mysqli_escape_string($conn, $_POST['authority']));
$time = date('y-m-d H:i:s',time());

$query_result = mysqli_query($conn, "INSERT INTO article 
                                     (title,content,time,teacher_id,author,authority) 
                                      values('$title','$content','$time','$teacher_id','$author','$authority');");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "文章发布成功",
        "res" => array(
            'article_id' => mysqli_insert_id($conn),
            'title' => $title,
            'time' => $time,
            'content' => $content,
            'author' => $author,
            'authority' => $authority
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "发布失败",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>