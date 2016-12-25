<?php

header('Content-type: application/json');
//session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);

$query_result = mysqli_query($conn, " select * from course_assist.group   ");
if (!$query_result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
if($fetched = mysqli_fetch_array($query_result))
{
    $group = array();
    do{ 
        $group[] = array(
            "group_id" => $fetched['group_id'],
            "leader_id" => $fetched['leader_id'],
            "member_num" => $fetched['member_num'],
            "group_name" => $fetched['group_name']

        );
    }while($fetched = mysqli_fetch_array($query_result));
    $result = array(
        "code" => 0,
        "msg" => "读取成功",
        "res" => $group
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