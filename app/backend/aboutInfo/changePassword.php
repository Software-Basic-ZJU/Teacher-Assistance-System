<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/15
 * Time: 23:05
 */
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Get information
$id = test_input(mysqli_escape_string($conn, $_POST['id']));
$oldPassword = encrypt(test_input(mysqli_escape_string($conn, $_POST['oldPassword'])));
$newPassword = encrypt(test_input(mysqli_escape_string($conn, $_POST['newPassword'])));
$type = test_input(mysqli_escape_string($conn, $_POST['type']));
if($type == 1){//学生
    $query_result = mysqli_query($conn, "select * from student 
                                         where student_id ='$id'");
    if($fetched = mysqli_fetch_array($query_result)){
        if($fetched['password']==$oldPassword){
            mysqli_query($conn, "update student set password = '$newPassword'
                                         where student_id ='$id'");
            $result = array(
                "code" => 0,
                "msg" => "修改成功",
                "res" => array()
            );
            echo json_encode($result);
            exit;
        }
        else{
            $result = array(
                "code" => -1,
                "msg" => "旧密码错误",
                "res" => array()
            );
            echo json_encode($result);
            exit;
        }
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "无此用户",
            "res" => array()
        );
        echo json_encode($result);
        exit;
    }
}
elseif($type == 2){             //教师
    $query_result = mysqli_query($conn, "select * from teacher 
                                         where teacher_id ='$id'");
    if($fetched = mysqli_fetch_array($query_result)){
        if($fetched['password']==$oldPassword){
            mysqli_query($conn, "update teacher set password = '$newPassword'
                                         where teacher_id ='$id'");
            $result = array(
                "code" => 0,
                "msg" => "修改成功",
                "res" => array()
            );
            echo json_encode($result);
            exit;
        }
        else{
            $result = array(
                "code" => -1,
                "msg" => "旧密码错误",
                "res" => array()
            );
            echo json_encode($result);
            exit;
        }
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "无此用户",
            "res" => array()
        );
        echo json_encode($result);
        exit;
    }
}

mysqli_close($conn);
?>