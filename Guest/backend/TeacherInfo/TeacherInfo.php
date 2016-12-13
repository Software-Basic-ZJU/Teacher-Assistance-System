<?php
header('Content-type: application/json;charset=utf-8');
include dirname(dirname(__FILE__)).'/connectDB.php';

global $conn;
connectDB();

$query_teacherinfo = mysqli_query($conn, "select * from teacher");
if($fetched = mysqli_fetch_array($query_teacherinfo))
{
    $teacher_info = array();
    do{ 
        $teacher_info[] = array(
            "teacher_id" => $fetched['teacher_id'],
            "teacher_info" => $fetched['teacher_info'],
            "brief_intro" => $fetched['brief_intro'],
            "name" => $fetched['name'],
            "photo_path" => $fetched['photo_path']
        );
    }while($fetched = mysqli_fetch_array($query_teacherinfo));
    $result = array(
        "code" => 0,
        "msg" => "获取成功",
        "res" => $teacher_info
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "获取失败",
        "res" => null
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
mysqli_close($conn);

?>