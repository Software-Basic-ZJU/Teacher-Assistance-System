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
//Verify token
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$id = test_input(mysqli_escape_string($conn, $_POST['id']));
$code = test_input(mysqli_escape_string($conn, $_POST['code']));
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
    $query_result = mysqli_query($conn, "update student
                                     set check_code = 1
                                     WHERE check_code = '$code' and student_id = '$id';");
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
    $query_result = mysqli_query($conn, "update teacher
                                     set check_code = 1
                                     WHERE check_code = '$code' and teacher_id = '$id';");
}
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => " 验证成功",
        "res" => array(
            'token' => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "验证失败",
        "res" => array(
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>