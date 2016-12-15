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
//Verify token
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$student_id = test_input(mysqli_escape_string($conn, $_POST['student_id']));
$email = test_input(mysqli_escape_string($conn, $_POST['email']));
if($_SESSION['type']==1){//学生
    if($_SESSION['student_id']!=$id){
        $result = array(
            "code" => 403,
            "msg" => "无效用户尝试操作",
            "res" => null
        );
        echo json_encode($result);
        exit;
    }
    $check_code = rand(100000,999999);
    $query_result = mysqli_query($conn, "update student
                                     set check_code = '$check_code'
                                     WHERE student_id = '$id';");
}
elseif($_SESSION['type']==2){//教师
    if($_SESSION['teacher_id']!=$id){
        $result = array(
            "code" => 403,
            "msg" => "无效用户尝试操作",
            "res" => null
        );
        echo json_encode($result);
        exit;
    }
    $check_code = rand(100000,999999);
    $query_result = mysqli_query($conn, "update teacher
                                     set check_code = '$check_code'
                                     WHERE teacher_id = '$id';");
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
                'res' => array(
                    "token" => $_SESSION['token']
                )
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
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>