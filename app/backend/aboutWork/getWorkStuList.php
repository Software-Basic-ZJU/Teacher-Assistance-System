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
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$ques_id = test_input(mysqli_escape_string($conn, $_POST['ques_id']));
$type = test_input(mysqli_escape_string($conn, $_POST['type']));
if($type == 0){
    $count_num = mysqli_query($conn, "select student.student_id,student.name,temp.work_id from questions JOIN homework JOIN student LEFT JOIN (select * from works) as temp
                        ON temp.uploader_id = student.student_id AND temp.ques_id = '$ques_id'
                        WHERE questions.ques_id = '$ques_id' AND questions.hw_id = homework.hw_id AND homework.class_id = student.class_id;");
    if($count_num){
        $stuList = array();
        while($fetched = mysqli_fetch_array($count_num)){
//            $id = $fetched['student_id'];
//            $check = mysqli_query($conn, "select * from works WHERE uploader_id = '$id' AND ques_id = '$ques_id';");
//            if($fetched2 = mysqli_fetch_array($check)){
//                $status = 1;
//            }
//            else{
//                $status = 0;
//            }
            $stuList[] = array(
                "id" => $fetched['student_id'],
                "name" => $fetched['name'],
                "status" => $fetched['work_id']?1:0
            );
        }
        $result = array(
            "code" => 0,
            "msg" => "个人查找成功",
            "res" => array(
                'stuList' => $stuList,
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "获取应交学生列表失败",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
}
elseif ($type == 1){
    $count_num = mysqli_query($conn, "select student.student_id,student.name from questions JOIN homework JOIN student JOIN course_assist.group LEFT JOIN (select * from works) as temp
                        ON temp.uploader_id = student.student_id AND temp.ques_id = '$ques_id'
                        WHERE ques_id = '$ques_id' AND questions.hw_id = homework.hw_id AND homework.class_id = student.class_id AND student.student_id = course_assist.group.leader_id;");
    if($count_num){
        $stuList = array();
        while($fetched = mysqli_fetch_array($count_num)){
//            $id = $fetched['student_id'];
//            $check = mysqli_query($conn, "select * from works WHERE uploader_id = '$id' AND ques_id = '$ques_id';");
//            if($fetched2 = mysqli_fetch_array($check)){
//                $status = 1;
//            }
//            else{
//                $status = 0;
//            }
            $stuList[] = array(
                "id" => $fetched['student_id'],
                "name" => $fetched['name'],
                "status" => $fetched['work_id']?1:0
            );
        }
        $result = array(
            "code" => 1,
            "msg" => "小组查找成功",
            "res" => array(
                'stuList' => $stuList,
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "获取应交小组列表失败",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
}