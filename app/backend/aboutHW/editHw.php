<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/28
 * Time: 20:57
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
$hw_id = test_input(mysqli_escape_string($conn, $_POST['hw_id']));
$title = test_input(mysqli_escape_string($conn, $_POST['title']));
$deadline = test_input(mysqli_escape_string($conn, $_POST['deadline']));
$class_id = test_input(mysqli_escape_string($conn, $_POST['class_id']));
$type = test_input(mysqli_escape_string($conn, $_POST['type']));
$punish_type = test_input(mysqli_escape_string($conn, $_POST['punish_type']));
$punish_rate = test_input(mysqli_escape_string($conn, $_POST['punish_rate']));
if($_SESSION['type']==1){
    $result = array(
        "code" => 403,
        "msg" => "无效用户尝试操作",
        "res" => null
    );
    echo json_encode($result);
    exit;
}

//select *, count(distinct name) from table group by name
$query_result = mysqli_query($conn, "update homework
                                     set title = '$title', deadline = '$deadline' , class_id = '$class_id' , type = '$type', punish_type = '$punish_type', punish_rate = '$punish_rate'
                                     WHERE hw_id = '$hw_id';");
if($query_result){
    $query_result2 = mysqli_query($conn, "select * from homework WHERE hw_id = '$hw_id';");
    $fetched = mysqli_fetch_array($query_result2);
    $update_type = mysqli_query($conn, "update questions set type='$type' where hw_id='$hw_id'");
    $result = array(
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            "hw_id" => $fetched['hw_id'],
            "title" => $fetched['title'],
            "type" => $fetched['type'],
            "publish_time" => $fetched['publish_time'],
            "deadline" => $fetched['deadline'],
            "punish_type" => $fetched['punish_type'],
            "punish_rate" => $fetched['punish_rate'],
            "over" => $fetched['over'],
            "out_of_deadline" => (date('y-m-d :i:s', time()) > $deadline) ? 0 : 1,//0是过期了,1是没过期
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "修改失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>