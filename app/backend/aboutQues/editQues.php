<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/1
 * Time: 11:47
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
$ques_id = test_input(mysqli_escape_string($conn, $_POST['ques_id']));
$title = test_input(mysqli_escape_string($conn, $_POST['title']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$type = test_input(mysqli_escape_string($conn, $_POST['type']));
if($_SESSION['type']!=2){
    $result = array(
        "code" => 403,
        "msg" => "无效用户尝试操作",
        "res" => null
    );
    echo json_encode($result);
    exit;
}

$query_result = mysqli_query($conn, "update questions
                                     set title = '$title', content = '$content' , type = '$type'
                                     WHERE ques_id = '$ques_id';");
if($query_result){
    $query_result2 = mysqli_query($conn, "select * from questions WHERE ques_id = '$ques_id';");
    $fetched = mysqli_fetch_array($query_result2);
    $hw_id = $fetched['hw_id'];
    if($fetched['type'] == 0){
        $count_num = mysqli_query($conn, "select COUNT(DISTINCT student_id ) AS num from homework JOIN student on homework.class_id = student.class_id WHERE homework.hw_id = '$hw_id';");
        if($fetched2 = mysqli_fetch_array($count_num)){
            $should_num = $fetched2['num'];
        }
    }
    elseif ($fetched['type'] == 1){
        $count_num = mysqli_query($conn, "select COUNT(DISTINCT group_id ) AS num from homework JOIN student on homework.class_id = student.class_id  WHERE homework.hw_id = '$hw_id';");
        if($fetched2 = mysqli_fetch_array($count_num)){
            $should_num = $fetched2['num'];
        }
    }
    $result = array(
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            "ques_id" => $fetched['ques_id'],
            "title" => $fetched['title'],
            "type" => $fetched['type'],
            "content" => $fetched['content'],
            "should_num" => $should_num,
            "submit_num" => $fetched['submit_num'],
            "ques_finish" => $fetched['ques_finish']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "修改失败",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>