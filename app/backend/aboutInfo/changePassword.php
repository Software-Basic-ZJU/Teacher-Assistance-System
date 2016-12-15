<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/15
 * Time: 13:21
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
$newPassword = encrypt(test_input(mysqli_escape_string($conn, $_POST['newPassword'])));
$query_result = mysqli_query($conn, "select * from student 
                                         where student_id ='$student_id'");
if($fetched = mysqli_fetch_array($query_result)){
    if($fetched['check_code'] == 1){
        $update_result = mysqli_query($conn, "update student
                                     set password = '$newPassword'
                                     WHERE student_id = '$student_id';");
        if($update_result){
            $result = array(
                "code" => 0,
                "msg" => "修改成功",
                "res" => array(
                    "token" => $_SESSION['token']
                )
            );
            echo json_encode($result);
            exit;
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
            exit;
        }
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "用户还未通过验证",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }

}
else{
    $result = array(
        "code" => -1,
        "msg" => "无此学生",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>