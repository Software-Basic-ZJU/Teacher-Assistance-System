<?php

header('Content-type: application/json');
//session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);
//echo
$query_result = mysqli_query($conn, "select * from course_assist.classes");
if (!$query_result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
if($fetched = mysqli_fetch_array($query_result))
{
    $class = array();
    do{
        $class[] = array(
            "class_id" => $fetched['class_id'],
            "term" => $fetched['term'],
            "year" => $fetched['year'],
            "name" => $fetched['name']

        );
    }while($fetched = mysqli_fetch_array($query_result));
    $result = array(
        "code" => 0,
        "msg" => "读取成功",
        "res" => $class
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "读取失败",
        "res" => null
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
mysqli_close($conn);
?>