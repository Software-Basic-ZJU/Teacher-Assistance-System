<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/15
 * Time: 11:51
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
$query_result = mysqli_query($conn, "select class_teacher.assist_id as assist_id,class_id,name from assists join class_teacher on class_teacher.assist_id = assists.assist_id and teacher_id = '$teacher_id';");
if($query_result){
    $assistList = array();
    while($fetched = mysqli_fetch_array($query_result)){
        $assistList[] = array(
            "assist_id" => $fetched['assist_id'],
            "class_id" => $fetched['class_id'],
            "name" => $fetched['name'],
        );
    }
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "token" => $_SESSION['token'],
            "assistList" => $assistList
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "查找失败，teacher_id错误",
        "res" => array(
            "token"=>$_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>