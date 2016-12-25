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
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$hw_id = test_input(mysqli_escape_string($conn, $_POST['hw_id']));
$ques_id=test_input(mysqli_escape_string($conn,$_POST['ques_id']));
$title = test_input(mysqli_escape_string($conn, $_POST['title']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
//$type = test_input(mysqli_escape_string($conn, $_POST['type']));
//Class_id,title,deadline,type, punish_type,punish_rate
if($ques_id){
    $query_result=mysqli_query($conn,"select ques_id from questions where ques_id='$ques_id'");
    if($fetch=mysqli_fetch_array($query_result)){
        $update_result=mysqli_query($conn,"update questions set title='$title',content='$content' 
                                            where ques_id='$ques_id'");
        if($update_result){
            $result = array(
                "code" => 0,
                "msg" => "作业问题更新成功",
                "res" => array(
                    "token" => $_SESSION['token']
                )
            );
            echo json_encode($result);
            exit;
        }
        else{
            $result = array(
                "code" => -1,
                "msg" => "作业问题更新失败",
                "res" => array(
                    "token" => $_SESSION['token']
                )
            );
            echo json_encode($result);
            exit;
        }
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "作业问题不存在",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
        exit;
    }
}
$query_result=mysqli_query($conn,"select type from homework where hw_id='$hw_id'");
if($query_result){
    $fetch=mysqli_fetch_array($query_result);
    $type=$fetch['type'];
}
else{
    $result = array(
        "code" => -1,
        "msg" => "作业不存在",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
    exit;
}

$query_result = mysqli_query($conn, "INSERT INTO questions 
                                     (hw_id,title,content,type,submit_num,average_score,ques_finish)
                                      values('$hw_id','$title','$content','$type',0,0,0);");
if($query_result){
    $should_num=0;
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
            "content" => htmlspecialchars_decode($content),
            "should_num" => $should_num,
            "submit_num" => 0,
            "ques_finish" => 0,
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "题目发布失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>