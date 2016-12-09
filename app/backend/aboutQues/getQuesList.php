<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/30
 * Time: 16:51
 */
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$hw_id = test_input(mysqli_escape_string($conn, $_POST['hw_id']));
//quesList[String](ques_id,type,title,content,should_num(应交人数),submit_num(实交人数))
$query_result = mysqli_query($conn, "select * from questions WHERE hw_id = '$hw_id';");
if($fetched = mysqli_fetch_array($query_result)){
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
    $quesList = array();
    do{
        $quesList[] = array(
            "ques_id" => $fetched['ques_id'],
            "title" => $fetched['title'],
            "type" => $fetched['type'],
            "content" => $fetched['content'],
            "should_num" => $should_num,
            "submit_num" => $fetched['submit_num'],
            "ques_finish" => $fetched['ques_finish']
        );
    }while($fetched = mysqli_fetch_array($query_result));
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => $quesList
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