<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/21
 * Time: 13:40
 */
header('Content-type: application/json');
session_start();
// Connect database
include '_include.php';
global $conn;
connectDB();
//Verify token
loginCheck($_POST['token']);
//Get information
$class_id = test_input(mysqli_escape_string($conn, $_POST['class_id']));
$query_result = mysqli_query($conn, "select * from notification 
                                         where class_id ='$class_id'");
if($fetched = mysqli_fetch_array($query_result)){
    $notices = array();
    do{ //Notices[String](notice_id,title,level,time,content)
        $notices[] = array(
            "notice_id" => $fetched['noti_id'],
            "title" => $fetched['title'],
            "level" => $fetched['level'],
            "time" => $fetched['time'],
            "content" => $fetched['content']
        );
    }while($fetched = mysqli_fetch_array($query_result));
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => $notices
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "查找失败，class_id错误",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>