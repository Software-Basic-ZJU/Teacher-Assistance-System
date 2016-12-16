<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/15
 * Time: 14:49
 */
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Get information
$id = test_input(mysqli_escape_string($conn, $_POST['id']));
$type= test_input(mysqli_escape_string($conn, $_POST['type']));
$code = test_input(mysqli_escape_string($conn, $_POST['code']));
if($type==1){                       //学生
    $query_result = mysqli_query($conn, "select * from student WHERE check_code = '$code' and student_id = '$id';");
}
elseif($type==2){//教师
    $query_result = mysqli_query($conn, "select * from teacher WHERE check_code = '$code' and teacher_id = '$id';");
}
else{
    $result = array(
        "code" => -1,
        "msg" => "用户身份无效",
        "res" => array()
    );
    echo json_encode($result);
    exit;
}
if(mysqli_num_rows($query_result)==0){
    $result = array(
        "code" => -1,
        "msg" => "邮箱验证码错误",
        "res" => array()
    );
    echo json_encode($result);
    exit;
}
if($type==1){                       //学生
    $query_result = mysqli_query($conn, "update student
                                     set check_code = 1
                                     WHERE check_code = '$code' and student_id = '$id';");
}
elseif($type==2){//教师
    $query_result = mysqli_query($conn, "update teacher
                                     set check_code = 1
                                     WHERE check_code = '$code' and teacher_id = '$id';");
}
else{
    $result = array(
        "code" => -1,
        "msg" => "用户类型错误",
        "res" => array(
        )
    );
    echo json_encode($result);
    exit;
}
if(mysqli_affected_rows($conn)>0){
    $result = array(
        "code" => 0,
        "msg" => " 验证成功",
        "res" => array()
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "验证失败",
        "res" => array()
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>