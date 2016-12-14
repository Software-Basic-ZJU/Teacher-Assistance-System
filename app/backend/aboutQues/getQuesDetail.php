<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/13
 * Time: 10:07
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
//mailList[string](mail_id,title,content,time,src_id,src_name,dest_id,is_read)
$query_result = mysqli_query($conn, "select * from questions JOIN (select hw_id as id,class_id,title as hw_title from homework)as temp 
                                     where questions.hw_id = temp.id AND ques_id ='$ques_id';");
if($fetched = mysqli_fetch_array($query_result)){
    $type = $fetched['type'];
    $class_id = $fetched['class_id'];
    $shouldList = array();
    if($_SESSION['type']!=1) {
        if ($type == 0) {
            $getSubmittedList = mysqli_query($conn, "select name,student_id,score from student join works on student.student_id=works.uploader_id 
                                WHERE student.class_id = '$class_id' and works.ques_id='$ques_id'");
            if ($getSubmittedList) {
                while ($fetched2 = mysqli_fetch_array($getSubmittedList)) {
                    $shouldList[] = array(
                        "name" => $fetched2['name'],
                        "id" => $fetched2['student_id'],
                        "isSubmit" => 1,
                        "isCorrect"=>$fetched2['score']>0?$fetched2['score']:0
                    );
                }
            }
            $getUnsubmittedList = mysqli_query($conn, "select name,student_id from student 
                                WHERE class_id = '$class_id' and student_id NOT in (select uploader_id from works where ques_id ='$ques_id' );");
            if ($getUnsubmittedList) {
                while ($fetched2 = mysqli_fetch_array($getUnsubmittedList)) {
                    $shouldList[] = array(
                        "name" => $fetched2['name'],
                        "id" => $fetched2['student_id'],
                        "isSubmit" => 0,
                        "isCorrect"=> 0
                    );
                }
            }
        } elseif ($type == 1) {
            $getSubmittedList = mysqli_query($conn, "select group.group_id as id,group.group_name as name from student JOIN course_assist.group 
                                                    WHERE student.class_id = '$class_id' and student.student_id = group.leader_id 
                                                    AND group.leader_id in (select uploader_id from works where ques_id ='$ques_id' );");
            if ($getSubmittedList) {
                while ($fetched2 = mysqli_fetch_array($getSubmittedList)) {
                    $shouldList[] = array(
                        "name" => $fetched2['name'],
                        "id" => $fetched2['id'],
                        "isSubmit" => 1,
                        "isCorrect"=> 0
                    );
                }
            }
            $getUnsubmittedList = mysqli_query($conn, "select group.group_id as id,group.group_name as name from student JOIN course_assist.group 
                                                    WHERE student.class_id = '$class_id' and student.student_id = group.leader_id 
                                                    AND group.leader_id NOT in (select uploader_id from works where ques_id ='$ques_id' );");
            if ($getUnsubmittedList) {
                while ($fetched2 = mysqli_fetch_array($getUnsubmittedList)) {
                    $shouldList[] = array(
                        "name" => $fetched2['name'],
                        "id" => $fetched2['id'],
                        "isSubmit" => 0,
                        "isCorrect"=> 0
                    );
                }
            }
        }
    }

    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            'ques_id' => $fetched['ques_id'],
            'title' => $fetched['title'],
            'content' => $fetched['content'],
            'hw_id' => $fetched['hw_id'],
            'hw_title'=>$fetched['hw_title'],
            'submit_num' => $fetched['submit_num'],
            'average_score' => $fetched['average_score'],
            'type' => $type,
            'ques_finish' => $fetched['ques_finish'],
            'shouldList' => $shouldList,
            "token" => $_SESSION['token']
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