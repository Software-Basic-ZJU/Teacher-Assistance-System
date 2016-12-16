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
//Get information
$id = test_input(mysqli_escape_string($conn, $_POST['id']));
$newPassword = encrypt(test_input(mysqli_escape_string($conn, $_POST['newPassword'])));
$type = test_input(mysqli_escape_string($conn, $_POST['type']));

switch (changePassword($conn,$id,$newPassword,$type)){
    case 0:
    {
        $result = array(
            "code" => 0,
            "msg" => "修改成功",
            "res" => array()
        );
        break;
    }
    case -1:
    {
        $result = array(
            "code" => -1,
            "msg" => "修改失败",
            "res" => array()
        );
        break;
    }
    case -2:
    {
        $result = array(
            "code" => -1,
            "msg" => "用户还未通过验证",
            "res" => array()
        );
        break;
    }
    case -3:
    {
        $result = array(
            "code" => -1,
            "msg" => "无此用户",
            "res" => array()
        );
    }
}
echo json_encode($result);
mysqli_close($conn);
?>