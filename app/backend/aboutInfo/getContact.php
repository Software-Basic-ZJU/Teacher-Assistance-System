<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/21
 * Time: 15:51
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
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
//select *, count(distinct name) from table group by name
$query_result = mysqli_query($conn, "select name,phone,email,wechat,qq,other_contact from teacher
                                         where teacher_id ='$teacher_id'");
if($fetched = mysqli_fetch_array($query_result)){
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "name" => $fetched['name'],
            "phone" => $fetched['phone'],
            "email" => $fetched['email'],
            "wechat" => $fetched['wechat'],
            "qq" => $fetched['qq'],
            "other_contact" => $fetched['other_contact']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "查找失败，class_id错误",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>