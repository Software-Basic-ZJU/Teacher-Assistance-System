<?php

header('Content-type: application/json');
//session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);

$assist_id=$_POST['assist_id'];
//$password1=$_GET['password'];
$name=$_POST['name'];
$password=encrypt('123456');
//echo $password;

$query_result=mysqli_query($conn,
	"INSERT INTO assists (assist_id,password) VALUES ('$assist_id','$password');");

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