<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/13
 * Time: 23:59
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
$dest_id = test_input(mysqli_escape_string($conn, $_POST['dest_id']));
$src_id = test_input(mysqli_escape_string($conn, $_POST['src_id']));
$title = test_input(mysqli_escape_string($conn, $_POST['title']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$time = date('y-m-d H:i:s',time());
$src_name = getAuthorName($conn,$src_id);
$dest_name = getAuthorName($conn,$dest_id);
if($dest_id == $src_id){
    $result = array(
        "code" => -1,
        "msg" => "不能给自己发邮件",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
    exit;
}
$query_result = mysqli_query($conn, "INSERT INTO mail 
                                     (title,content,time,src_id,dest_id,is_read,flag) 
                                      values('$title','$content','$time','$src_id','$dest_id',0,0);");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "信息发送成功",
        "res" => array(
            'mail_id' => mysqli_insert_id($conn),
            'title' => $title,
            'time' => $time,
            'content' => $content,
            'src_id' => $src_id,
            'src_name' => $src_name,
            'dest_id' => $dest_id,
            'dest_name' => $dest_name,
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "发送失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>