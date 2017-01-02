<?php

header('Content-type: application/json');
//session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);
$class_id = test_input(mysqli_escape_string($conn, $_POST['class_id']));

$result1=mysqli_query($conn, "select * from classes
                                        where class_id ='$class_id'");


if($fetched = mysqli_fetch_array($result1)) {
	$result=mysqli_query($conn,
			"DELETE from classes WHERE class_id=$class_id;");

	$result = array (
	"code"=>"0",
	"msg"=>"删除成功！");}
else $result = array (
	"code"=>"1",
	"msg"=>"删除失败！");

echo json_encode($result);

mysqli_close($conn);
?>