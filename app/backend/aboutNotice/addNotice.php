<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/27
 * Time: 20:32
 */
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
//title、content、level
$title = test_input(mysqli_escape_string($conn, $_POST['title']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$level = test_input(mysqli_escape_string($conn, $_POST['level']));
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
$time = date('Y-m-d H:i:s',time());

$query_result = mysqli_query($conn, "INSERT INTO notification 
                                     (title,content,level,time,teacher_id) 
                                      values('$title','$content','$level','$time','$teacher_id');");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "通知发布成功",
        "res" => array(
            'notice_id' => mysqli_insert_id($conn),//notice_id,title,level,time,content，class_id
            'title' => $title,
            'level' => $level,
            'time' => $time,
            'content' => htmlspecialchars_decode($content),
            'token' => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "通知发布失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>