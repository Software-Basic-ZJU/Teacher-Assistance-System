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
$term = test_input(mysqli_escape_string($conn, $_POST['term']));
$year = test_input(mysqli_escape_string($conn, $_POST['year']));
$name = test_input(mysqli_escape_string($conn, $_POST['name']));

$result=mysqli_query($conn,
	"INSERT INTO classes (class_id,term,year,name) VALUES ('$class_id',$term,'$year','$name');");

//echo "INSERT INTO classes (class_id,term,year,name) VALUES ('$class_id',$term,'$year','$name');";
$t=mysqli_affected_rows($conn);
//echo $t;

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