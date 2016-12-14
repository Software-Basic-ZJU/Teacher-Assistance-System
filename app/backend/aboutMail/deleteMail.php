<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/14
 * Time: 16:22
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
//select * from resource JOIN select  where uploader_id = 10001 and type = 0
$select_result = mysqli_query($conn,"select * from mail WHERE mail_id = '$mail_id'");
if($fetched = mysqli_fetch_array($select_result)){
    $src_id = $fetched['src_id'];
    $dest_id = $fetched['dest_id'];
    $flag = $fetched['flag'];
}
else{
    $result = array(
        "code" => -1,
        "msg" => "此邮件不存在",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
    exit;
}
if($_SESSION['type']==1){
    $id = $_SESSION['student_id'];
}
elseif ($_SESSION['type']==2){
    $id = $_SESSION['teacher_id'];
}
elseif ($_SESSION['type']==3){
    $id = $_SESSION['assist_id'];
}
if($src_id == $id){//发送方要删除邮件
    if($flag == 0) $flag = 2;
    elseif ($flag == 1) $flag = 3;
    else{
        exit;
    }
}
elseif ($dest_id == $id){
    if($flag == 0) $flag = 1;
    elseif ($flag == 2) $flag = 3;
    else{
        exit;
    }
}
$query_result = mysqli_query($conn, "update mail
                                     set flag = '$flag'
                                     WHERE mail_id = '$mail_id';");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "删除成功",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "删除失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>