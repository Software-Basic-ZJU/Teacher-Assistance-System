<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/28
 * Time: 13:27
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
$class_id = test_input(mysqli_escape_string($conn, $_POST['class_id']));
$query_result = mysqli_query($conn, "select * from homework WHERE class_id = '$class_id';");
if($fetched = mysqli_fetch_array($query_result)){
    $hwList = array();
    do{
        $out_of_deadline = (date('y-m-d h:i:s',time())>$fetched['deadline'])?0:1;//0是过期了,1是没过期
        $hwList[] = array(
            "hw_id" => $fetched['hw_id'],
            "title" => $fetched['title'],
            "type" => $fetched['type'],
            "publish_time" => $fetched['publish_time'],
            "deadline" => $fetched['deadline'],
            "punish_type" => $fetched['punish_type'],
            "punish_rate" => $fetched['punish_rate'],
            "over" => $fetched['over'],//老师是否已经全部批改
            "out_of_deadline" =>$out_of_deadline,
            "token" => $_SESSION['token']
        );
    }while($fetched = mysqli_fetch_array($query_result));
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => $hwList
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