<?php

header('Content-type: application/json');
//session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);
//Get information

$admin_id = test_input(mysqli_escape_string($conn, $_POST['admin_id']));
//$admin_id = $_GET['admin_id'];

$query_mail = mysqli_query($conn, "select * from mail where dest_id = '$admin_id'");
if($fetched = mysqli_fetch_array($query_mail))
{
    
    $mail = array();
    do{ 
        $mail[] = array(
            "mail_id" => $fetched['mail_id'],
            "content" => $fetched['content'],
            "title" => $fetched['title']
        );
    }while($fetched = mysqli_fetch_array($query_mail));
    $result = array(
        "code" => 0,
        "msg" => "读取成功",
        "res" => $mail
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "读取失败",
        "res" => null
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
mysqli_close($conn);
?>