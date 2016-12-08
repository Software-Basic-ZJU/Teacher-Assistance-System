<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/1
 * Time: 20:53
 */
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
loginCheck($_POST['token']);
//Get information
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));

$query_result = mysqli_query($conn, "select section,count(post_id) as total_num,COUNT( CASE WHEN to_days(publish_time) = to_days(now()) THEN 1 ELSE NULL END ) as today_num from posts where teacher_id = '$teacher_id' group by section;");
if($fetched = mysqli_fetch_array($query_result)){
    $sectionList = array();
    do{
        $sectionList[] = array(
            "section" => $fetched['section'],
            "total_num" => $fetched['total_num'],
            "today_num" => $fetched['today_num']
        );
    }while($fetched = mysqli_fetch_array($query_result));
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => $sectionList
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "查找失败",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>