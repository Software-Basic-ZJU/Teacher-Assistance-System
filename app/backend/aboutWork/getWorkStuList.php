<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/1
 * Time: 18:57
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
$type = test_input(mysqli_escape_string($conn, $_POST['type']));
if($type == 0){
    $count_num = mysqli_query($conn, "select student.student_id,student.name from questions JOIN homework JOIN student 
                        on ques_id = '$ques_id' AND questions.hw_id = homework.hw_id AND homework.class_id = student.class_id;");
    if($fetched = mysqli_fetch_array($count_num)){
        $stuList = array();
        do{//stuList[String](id,name,status)
            $id = $fetched['student_id'];
            $check = mysqli_query($conn, "select * from works WHERE uploader_id = '$id' AND ques_id = '$ques_id';");
            if($fetched2 = mysqli_fetch_array($check)){
                $status = 1;
            }
            else{
                $status = 0;
            }
            $stuList[] = array(
                "id" => $fetched['student_id'],
                "name" => $fetched['name'],
                "status" => $status
            );
        }while($fetched = mysqli_fetch_array($count_num));
        $result = array(
            "code" => 0,
            "msg" => "个人查找成功",
            "res" => $stuList
        );
        echo json_encode($result);
    }
    else{
        $result = array(
            "code" => 3,
            "msg" => "查找失败",
            "res" => null
        );
        echo json_encode($result);
    }
}
elseif ($type == 1){
    $count_num = mysqli_query($conn, "select student.student_id,student.name from questions JOIN homework JOIN student JOIN course_assist.group
                        on ques_id = '$ques_id' AND questions.hw_id = homework.hw_id AND homework.class_id = student.class_id AND student.student_id = course_assist.group.leader_id;");
    if($fetched = mysqli_fetch_array($count_num)){
        $stuList = array();
        do{//stuList[String](id,name,status)
            $id = $fetched['student_id'];
            $check = mysqli_query($conn, "select * from works WHERE uploader_id = '$id' AND ques_id = '$ques_id';");
            if($fetched2 = mysqli_fetch_array($check)){
                $status = 1;
            }
            else{
                $status = 0;
            }
            $stuList[] = array(
                "id" => $fetched['student_id'],
                "name" => $fetched['name'],
                "status" => $status
            );
        }while($fetched = mysqli_fetch_array($count_num));
        $result = array(
            "code" => 1,
            "msg" => "小组查找成功",
            "res" => $stuList
        );
        echo json_encode($result);
    }
    else{
        $result = array(
            "code" => 3,
            "msg" => "查找失败",
            "res" => null
        );
        echo json_encode($result);
    }
}