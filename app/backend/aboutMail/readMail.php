<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/14
 * Time: 17:00
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
$mail_id = test_input(mysqli_escape_string($conn, $_POST['mail_id']));
$query_result = mysqli_query($conn, "update mail
                                     set is_read = 1
                                     WHERE mail_id = '$mail_id';");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "已阅读",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "阅读失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>