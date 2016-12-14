<?php

header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);


//include 'connectDB.php';
//connectDB();
$info_id = test_input(mysqli_escape_string($conn, $_GET['info_id']));
//select *, count(distinct name) from table group by name
$query_result = mysqli_query($conn, "select * from course_info ");
if($fetched = mysqli_fetch_array($query_result)){
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "course_name" => $fetched['course_name'],
            "background" => $fetched['background'],
            "course_plan" => $fetched['course_plan'],
            "textbook_precourse" => $fetched['textbook_precourse'],
            "exam_homework" => $fetched['exam_homework'],
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "查找失败",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>