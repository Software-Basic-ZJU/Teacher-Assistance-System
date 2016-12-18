<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/12
 * Time: 12:10
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
//,type,content,author_id
$target_id = test_input(mysqli_escape_string($conn, $_POST['target_id']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$author_id = test_input(mysqli_escape_string($conn, $_POST['author_id']));
$type = test_input(mysqli_escape_string($conn, $_POST['type']));
$time = date('Y-m-d H:i:s',time());

$query_result = mysqli_query($conn, "INSERT INTO comment 
                                     (target_id,type,content,author_id,time) 
                                      values('$target_id','$type','$content','$author_id','$time');");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "评论发表成功",
        "res" => array(
            'com_id' => mysqli_insert_id($conn),
            'target_id' => $target_id,
            'time' => $time,
            'content' => $content,
            'author_id' => $author_id,
            'type' => $type,
            'author_name' => $_SESSION['uname'],
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "发表失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>