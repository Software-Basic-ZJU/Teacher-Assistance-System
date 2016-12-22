<?php

header('Content-type: application/json');
//session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);

$result=mysqli_query($conn,
	"DELETE from message WHERE msg_id='" . $_POST['msg_id'] . "';");

if($result) {
$result = array (
	"code"=>"0",
	"msg"=>"删除成功！");}
else $result = array (
	"code"=>"1",
	"msg"=>"删除失败！");

echo json_encode($result);

mysqli_close($conn);
?>