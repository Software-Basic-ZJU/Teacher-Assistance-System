<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/15
 * Time: 12:44
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
$name = test_input(mysqli_escape_string($conn, $_POST['name']));
$email = test_input(mysqli_escape_string($conn, $_POST['email']));
$type = test_input(mysqli_escape_string($conn, $_POST['type']));

if($type==1) {
    $query_result = mysqli_query($conn, "update student
                                     set name = '$name',email = '$email'
                                     WHERE student_id = '$id';");
}
elseif($type==2){
    $query_result = mysqli_query($conn, "update teacher
                                     set name = '$name',email = '$email'
                                     WHERE teacher_id = '$id';");
}
else{
    $result = array(
        "code" => -1,
        "msg" => "身份类型无效",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
    exit;
}
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
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
}
mysqli_close($conn);
?>