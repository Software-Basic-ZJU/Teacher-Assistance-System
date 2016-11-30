<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/30
 * Time: 16:26
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
$Hw_id = test_input(mysqli_escape_string($conn, $_POST['hw_id']));
if($_SESSION['type']!=2){
    $result = array(
        "code" => 2,
        "msg" => "无效用户尝试删除",
        "res" => null
    );
    echo json_encode($result);
    exit;
}
//select * from resource JOIN select  where uploader_id = 10001 and type = 0
$query_result = mysqli_query($conn, "delete from homework WHERE hw_id = '$Hw_id';");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "删除成功",
        "res" => null
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "删除失败",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>