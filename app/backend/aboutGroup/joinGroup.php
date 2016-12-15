<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/14
 * Time: 23:08
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
$group_id = test_input(mysqli_escape_string($conn, $_POST['group_id']));
$student_id = test_input(mysqli_escape_string($conn, $_POST['student_id']));
$password = encrypt(test_input(mysqli_escape_string($conn, $_POST['password'])));
$query_result = mysqli_query($conn, "select * from student WHERE student_id = '$student_id' AND group_id IS NOT NULL ;");
if($fetched = mysqli_fetch_array($query_result)){
    if($fetched['group_id']==$group_id){
        $result = array(
            "code" => -1,
            "msg" => "已加入此小组",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
        exit;
    }
    if($fetched['group_id']!=-1){
        $result = array(
            "code" => -1,
            "msg" => "您已在小组中",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
        exit;
    }
}
$query_result = mysqli_query($conn, "select * from course_assist.group WHERE group_id = '$group_id' AND password = '$password';");
if(!$fetched = mysqli_fetch_array($query_result)){
    $result = array(
        "code" => -1,
        "msg" => "小组密码错误",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
    exit;
}
$query_result = mysqli_query($conn, "update student
                                     set group_id = '$group_id'
                                     WHERE student_id = '$student_id';");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "加入成功",
        "res" => array(
            'name' => getAuthorName($conn,$student_id),
            'token' => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "加入失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>