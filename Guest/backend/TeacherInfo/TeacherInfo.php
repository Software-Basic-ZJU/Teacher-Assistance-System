<?php
//header('Content-type: application/json;charset=utf-8');
include '../connectDB.php';

global $conn;
connectDB();

$query_teacherinfo = mysqli_query($conn, "select * from teacher_info");
if($fetched = mysqli_fetch_array($query_teacherinfo))
{
    //teacher_info(info_id,teach_experience,profile,honor,other_info,course_info)
    $teacher_info = array();
    do{ 
        $teacher_info[] = array(
            "info_id" => $fetched['info_id'],
            "teach_experience" => $fetched['teach_experience'],
            "profile" => $fetched['profile'],
            "honor" => $fetched['honor'],
            "other_info" => $fetched['other_info']
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