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
$query_result=mysqli_query($conn,"select * from homework where hw_id='$hw_id'");
if($fetched=mysqli_fetch_array($query_result)){
    $hwTitle=$fetched['title'];     //获取作业名称
    $hwType=$fetched['type'];
    $hwPublishTime=$fetched['publish_time'];
    $hwDeadline=$fetched['deadline'];
}
else{
    $result = array(
        "code" => -1,
        "msg" => "没有找到该作业",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
    exit;
}
$query_result = mysqli_query($conn, "select * from questions WHERE hw_id = '$hw_id';");
if($query_result){
    $quesList = array();
    $indiviNum=0;   //个人作业的应交人数
    $groupNum=0;    //小组作业的应交人数
    while($fetched = mysqli_fetch_array($query_result)){
        if($fetched['type'] == 0){
            if($indiviNum==0) {
                $count_num = mysqli_query($conn, "select COUNT(DISTINCT student_id ) AS num from homework JOIN student on homework.class_id = student.class_id WHERE homework.hw_id = '$hw_id';");
                if ($fetched2 = mysqli_fetch_array($count_num)) {
                    $indiviNum=0;
                    $should_num = $fetched2['num'];
                }
            }
            else{
                $should_num=$indiviNum;
            }
        }
        elseif ($fetched['type'] == 1){
            if($groupNum==0) {
                $count_num = mysqli_query($conn, "select COUNT(DISTINCT group_id ) AS num from homework JOIN student on homework.class_id = student.class_id  WHERE homework.hw_id = '$hw_id';");
                if ($fetched2 = mysqli_fetch_array($count_num)) {
                    $should_num = $fetched2['num'];
                }
            }
            else{
                $should_num=$groupNum;
            }
        }
        $quesList[] = array(
            "ques_id" => $fetched['ques_id'],
            "title" => $fetched['title'],
            "type" => $fetched['type'],
            "content" => htmlspecialchars_decode($fetched['content']),
            "should_num" => $should_num,
            "submit_num" => $fetched['submit_num'],
            "ques_finish" => $fetched['ques_finish'],
        );
    }
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            'hwTitle'=>$hwTitle,
            'hwType'=>$hwType,
            'hwPublishTime'=>$hwPublishTime,
            'hwDeadline'=>$hwDeadline,
            'quesList' => $quesList,
            'token' => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "查找失败",
        "res" => array(
        "token" => $_SESSION['token']
    )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>