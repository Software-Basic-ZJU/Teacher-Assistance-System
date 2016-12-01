<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/1
 * Time: 13:43
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
$work_id = test_input(mysqli_escape_string($conn, $_POST['work_id']));
$score = test_input(mysqli_escape_string($conn, $_POST['score']));
$reply = test_input(mysqli_escape_string($conn, $_POST['reply']));

if($_SESSION['type']!=2 && $_SESSION['type']!=3){
    $result = array(
        "code" => 2,
        "msg" => "无效用户尝试操作",
        "res" => null
    );
    echo json_encode($result);
    exit;
}
$query_result = mysqli_query($conn, "update works
                                 set score = '$score', reply = '$reply'
                                 WHERE work_id = '$work_id';");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "点评成功",
        "res" => null
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "点评失败",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>