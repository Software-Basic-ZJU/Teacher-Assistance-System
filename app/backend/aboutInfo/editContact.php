<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/27
 * Time: 19:54
 */
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
loginCheck($_POST['token']);
//Get information
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
$email = test_input(mysqli_escape_string($conn, $_POST['email']));
$phone = test_input(mysqli_escape_string($conn, $_POST['phone']));
$qq = test_input(mysqli_escape_string($conn, $_POST['qq']));
$wechat = test_input(mysqli_escape_string($conn, $_POST['wechat']));
$other_contact = test_input(mysqli_escape_string($conn, $_POST['other_contact']));
if($_SESSION['type']!=2){
    $result = array(
        "code" => 403,
        "msg" => "无效用户尝试操作",
        "res" => null
    );
    echo json_encode($result);
    exit;
}
//select *, count(distinct name) from table group by name
$query_result = mysqli_query($conn, "update teacher
                                     set email = '$email', phone = '$phone' , qq = '$qq' , wechat = '$wechat', other_contact = '$other_contact'
                                     WHERE teacher_id = '$teacher_id'");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            "phone" => $phone,
            "email" => $email,
            "wechat" => $wechat,
            "qq" => $qq,
            "other_contact" => $other_contact
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "查找失败",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>