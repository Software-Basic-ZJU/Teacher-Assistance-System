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
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
$query_result = mysqli_query($conn, "select * from notification 
                                              where teacher_id ='$teacher_id';");

if($query_result){
    $notices = array();
    while($fetched = mysqli_fetch_array($query_result)){
        $notices[] = array(
            "notice_id" => $fetched['noti_id'],
            "title" => $fetched['title'],
            "level" => $fetched['level'],
            "time" => $fetched['time'],
            "content" => htmlspecialchars_decode($fetched['content'])
        );
    }
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            'notices' => $notices,
            'token' => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "查找失败，class_id错误",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>