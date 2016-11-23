<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/23
 * Time: 17:24
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
//select *, count(distinct name) from table group by name

$query_result = mysqli_query($conn, "select old_teaching,achievement,teaching_style,publishment,honor,other_info from teacher JOIN teacher_info
                                         where teacher_id ='$teacher_id'");
if($fetched = mysqli_fetch_array($query_result)){
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "old_teaching" => $fetched['old_teaching'],
            "achievement" => $fetched['achievement'],
            "teaching_style" => $fetched['teaching_style'],
            "publishment" => $fetched['publishment'],
            "honor" => $fetched['honor'],
            "other_info" => $fetched['other_info']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "查找失败，class_id错误",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>