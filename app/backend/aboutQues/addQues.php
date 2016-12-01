<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/1
 * Time: 11:31
 */
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);
//Get information
$hw_id = test_input(mysqli_escape_string($conn, $_POST['hw_id']));
$title = test_input(mysqli_escape_string($conn, $_POST['title']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$type = test_input(mysqli_escape_string($conn, $_POST['type']));
//Class_id,title,deadline,type, punish_type,punish_rate
$query_result = mysqli_query($conn, "INSERT INTO questions 
                                     (hw_id,title,content,type,submit_num,average_score)
                                      values('$hw_id','$title','$content','$type',0,0);");
if($query_result){
    $ques_id = mysqli_insert_id($conn);
    if($type == 0){
        $count_num = mysqli_query($conn, "select COUNT(DISTINCT student_id ) AS num from homework JOIN student on homework.class_id = student.class_id WHERE homework.hw_id = '$hw_id';");
        if($fetched2 = mysqli_fetch_array($count_num)){
            $should_num = $fetched2['num'];
        }
    }
    elseif ($type == 1){
        $count_num = mysqli_query($conn, "select COUNT(DISTINCT group_id ) AS num from homework JOIN student on homework.class_id = student.class_id  WHERE homework.hw_id = '$hw_id';");
        if($fetched2 = mysqli_fetch_array($count_num)){
            $should_num = $fetched2['num'];
        }
    }
    $result = array(
        "code" => 0,
        "msg" => "题目发布成功",
        "res" => array(
            "ques_id" => $ques_id,
            "title" => $title,
            "type" => $type,
            "content" => $content,
            "should_num" => $should_num,
            "submit_num" => 0
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "题目发布失败",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>