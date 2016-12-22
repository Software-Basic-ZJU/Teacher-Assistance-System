<?php

header('Content-type: application/json');
//session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);

$teacher_id=$_POST['teacher_id'];
//$password1=$_GET['password'];
$name=$_POST['name'];
$password=encrypt('123456');
//echo "$password1";

$query_result=mysqli_query($conn,
	"INSERT INTO teacher (teacher_id,password,name) VALUES ('$teacher_id','$password','$name');");


if($query_result) {
$result = array (
	"code"=>"0",
	"msg"=>"增加成功");}
else $result = array (
	"code"=>"1",
	"msg"=>"增加失败");

echo json_encode($result);

mysqli_close($conn);
?>