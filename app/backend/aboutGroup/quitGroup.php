<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/14
 * Time: 23:23
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

$query_result = mysqli_query($conn, "update student
                                     set group_id = -1
                                     WHERE student_id = '$student_id';");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "退出成功",
        "res" => array(
            'token' => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "退出失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>