<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/21
 * Time: 16:10
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
$notice_id = test_input(mysqli_escape_string($conn, $_POST['notice_id']));
$query_result = mysqli_query($conn, "select * from notification 
                                         where noti_id ='$notice_id';");
if($fetched = mysqli_fetch_array($query_result)){
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "notice_id" => $fetched['noti_id'],
            "title" => $fetched['title'],
            "content" => $fetched['content'],
            "time" => $fetched['time'],
            "level" => $fetched['level'],
            "class_id"=>$fetched['class_id'],
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "查找失败，notice_id错误",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>