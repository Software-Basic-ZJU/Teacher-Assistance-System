<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/15
 * Time: 13:54
 */
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
$id = test_input(mysqli_escape_string($conn, $_POST['id']));
$type = test_input(mysqli_escape_string($conn, $_POST['type']));
$email = test_input(mysqli_escape_string($conn, $_POST['email']));
if($type==1){//学生
    $check_code = rand(100000,999999);
    $query_result = mysqli_query($conn, "update student
                                     set check_code = '$check_code'
                                     WHERE student_id = '$id';");
}
elseif($type==2){//教师
    $check_code = rand(100000,999999);
    $query_result = mysqli_query($conn, "update teacher
                                     set check_code = '$check_code'
                                     WHERE teacher_id = '$id';");
}
else{
    $result = array(
        "code" => -1,
        "msg" => "用户身份无效",
        "res" => array()
    );
    echo json_encode($result);
}

if($query_result){
    $error = sendCodesEmail($email,$check_code);
    switch($error){
        case -1:{
            $result = array(
                'code' => -1,
                'msg' => "邮件发送失败，请检查你的邮箱地址",
                'res' => array()
            );
            echo json_encode($result);
            exit;
        }
        case 0:{
            $result = array(
                'code' => 0,
                'msg' => "成功发送邮件",
                'res' => array()
            );
            echo json_encode($result);
            exit;
        }
        default:{
            $result = array(
                'code' => -1,
                'msg' => "邮件发送失败,邮件不在用户列表",
                'res' => array()
            );
            echo json_encode($result);
            exit;
        }
    }
}
else{
    $result = array(
        "code" => -1,
        "msg" => "修改数据表check_code失败",
        "res" => array()
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>