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
	"UPDATE message SET msg_state = 1 WHERE msg_id='" . $_POST['msg_id'] . "';");

if($result) {
$result = array (
	"code"=>"0",
	"msg"=>"通过成功！");}
else $result = array (
	"code"=>"1",
	"msg"=>"通过失败！");

echo json_encode($result);

mysqli_close($conn);
?>