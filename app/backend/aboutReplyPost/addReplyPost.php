<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/12
 * Time: 11:54
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
$post_id = test_input(mysqli_escape_string($conn, $_POST['post_id']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$author_id = test_input(mysqli_escape_string($conn, $_POST['author_id']));
$time = date('Y-m-d H:i:s',time());

$query_result = mysqli_query($conn, "INSERT INTO reply_post 
                                     (post_id,content,time,author_id) 
                                      values('$post_id','$content','$time','$author_id');");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "回帖成功",
        "res" => array(
            'repost_id' => mysqli_insert_id($conn),
            'time' => $time,
            'content' => $content,
            'author_id' => $author_id,
            'author_name' => $_SESSION['type']==1?$_SESSION['sname']:$_SESSION['tname'],
            'commentList'=>array(),
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "回帖失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>