<?php
header('Content-type: application/json;charset=utf-8');
include dirname(dirname(__FILE__)).'/connectDB.php';

global $conn;
connectDB();

$query_courseinfo = mysqli_query($conn, "select * from course_info 
                                         where course_name ='操作系统' limit 1");
if($fetched = mysqli_fetch_array($query_courseinfo))
{
    //course_info(course_name,background,course_plan,textbook_precourse,exam_homework)
    $result = array(
        "code" => 0,
        "msg" => "获取成功",
        "res" => array(
            "background" => $fetched['background'],
            "course_plan" => $fetched['course_plan'],
            "textbook_precourse" => $fetched['textbook_precourse'],
            "exam_homework" => $fetched['exam_homework']
        )
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