<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/14
 * Time: 22:08
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
$leader_id = test_input(mysqli_escape_string($conn, $_POST['leader_id']));
$group_name = test_input(mysqli_escape_string($conn, $_POST['group_name']));
$group_password = encrypt(test_input(mysqli_escape_string($conn, $_POST['group_password'])));
$class_id = test_input(mysqli_escape_string($conn, $_POST['class_id']));

$query_result = mysqli_query($conn, "INSERT INTO course_assist.group 
                                     (leader_id,group_name,password,class_id) 
                                      values('$leader_id','$group_name','$group_password','$class_id');");
if($query_result){
    $group_id = mysqli_insert_id($conn);
    $updateStudent = mysqli_query($conn,"update student set group_id = '$group_id' where student_id = '$leader_id';");
    if($updateStudent){
        $result = array(
            "code" => 0,
            "msg" => "小组创建成功",
            "res" => array(
                'group_id' => $group_id,
                'group_name' => $group_name,
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
        exit;
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "小组创建成功,小组组长小组信息更新未成功",
            "res" => array(
                'group_id' => $group_id,
                'group_name' => $group_name,
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
        "msg" => "小组创建失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>