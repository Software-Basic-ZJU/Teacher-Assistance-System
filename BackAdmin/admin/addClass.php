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
	"INSERT INTO classes (class_id,term,year,name) VALUES ('" . $_POST['class_id'] . "','" . $_POST['term'] . "','" . $_POST['year'] . "','" . $_POST['name'] . "');");

if($result) {
$result = array (
	"code"=>"0",
	"msg"=>"增加成功！");}
else $result = array (
	"code"=>"1",
	"msg"=>"增加失败！");

echo json_encode($result);

mysqli_close($conn);
?>