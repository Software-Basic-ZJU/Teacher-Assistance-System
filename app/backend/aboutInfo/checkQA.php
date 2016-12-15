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
//Verify token
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$student_id = test_input(mysqli_escape_string($conn, $_POST['student_id']));
$question1 = test_input(mysqli_escape_string($conn, $_POST['question1']));
$question2 = test_input(mysqli_escape_string($conn, $_POST['question2']));
$answer1 = encrypt(test_input(mysqli_escape_string($conn, $_POST['answer1'])));
$answer2 = encrypt(test_input(mysqli_escape_string($conn, $_POST['answer2'])));

$query_result = mysqli_query($conn, "select * from student 
                                         where student_id ='$student_id'");
if($fetched = mysqli_fetch_array($query_result)){
    if(strcmp($question1,$fetched['question1'])==0){
        if((strcmp($answer1,$fetched['answer1'])==0)&&(strcmp($answer2,$fetched['answer2'])==0)){
            $query_result = mysqli_query($conn, "update student
                                     set check_code = 1
                                     WHERE student_id = '$student_id';");
            $result = array(
                "code" => 0,
                "msg" => "验证成功",
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
                "msg" => "验证失败",
                "res" => array(
                    "token" => $_SESSION['token']
                )
            );
            echo json_encode($result);
        }
    }
    else{
        if((strcmp($answer1,$fetched['answer2'])==0)&&(strcmp($answer2,$fetched['answer1'])==0)){
            $query_result = mysqli_query($conn, "update student
                                     set check_code = 1
                                     WHERE student_id = '$student_id';");
            $result = array(
                "code" => 0,
                "msg" => "验证成功",
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
                "msg" => "验证失败",
                "res" => array(
                    "token" => $_SESSION['token']
                )
            );
            echo json_encode($result);
        }
    }
}
else{
    $result = array(
        "code" => -1,
        "msg" => "无此学生",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>