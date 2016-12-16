<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/15
 * Time: 12:59
 */
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Get information
$student_id = test_input(mysqli_escape_string($conn, $_POST['student_id']));
$question = test_input(mysqli_escape_string($conn, $_POST['question']));
$answer = encrypt(test_input(mysqli_escape_string($conn, $_POST['answer'])));

$query_result = mysqli_query($conn, "select * from student 
                                         where student_id ='$student_id'");
if($fetched = mysqli_fetch_array($query_result)){
    if(strcmp($question,$fetched['question1'])==0){
        if(strcmp($answer,$fetched['answer1'])==0){
            $query_result = mysqli_query($conn, "update student
                                     set check_code = 1
                                     WHERE student_id = '$student_id';");
            $result = array(
                "code" => 0,
                "msg" => "验证成功",
                "res" => array()
            );
            echo json_encode($result);
            exit;
        }
        else{
            $result = array(
                "code" => -1,
                "msg" => "验证失败，答案错误",
                "res" => array()
            );
            echo json_encode($result);
        }
    }
    else if(strcmp($question,$fetched['question2'])==0){
        if(strcmp($answer,$fetched['answer2'])==0){
            $query_result = mysqli_query($conn, "update student
                                     set check_code = 1
                                     WHERE student_id = '$student_id';");
            $result = array(
                "code" => 0,
                "msg" => "验证成功",
                "res" => array()
            );
            echo json_encode($result);
            exit;
        }
        else{
            $result = array(
                "code" => -1,
                "msg" => "验证失败，答案错误",
                "res" => array()
            );
            echo json_encode($result);
        }
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "问题不存在，请联系管理员",
            "res" => array()
        );
        echo json_encode($result);
    }
}
else{
    $result = array(
        "code" => -1,
        "msg" => "无此学生",
        "res" => array()
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>