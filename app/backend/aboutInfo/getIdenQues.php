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
$id = test_input(mysqli_escape_string($conn, $_POST['id']));

$query_result = mysqli_query($conn, "select * from student 
                                         where student_id ='$id'");
if($fetched = mysqli_fetch_array($query_result)){
    $question1=$fetched['question1'];
    $question2=$fetched['question2'];
    $result=array(
        "code"=>0,
        "msg"=>"获取身份成功",
        "res"=>array(
            "type"=>1,  //学生身份
            "question1"=>$question1,
            "question2"=>$question2
        )
    );
    echo json_encode($result);
}
else{
    $query_result = mysqli_query($conn, "select * from teacher 
                                         where teacher_id ='$id'");
    if($fetched=mysqli_fetch_array($query_result)){
        $result=array(
            "code"=>0,
            "msg"=>"获取身份成功",
            "res"=>array(
                "type"=>2,  //教师身份
            )
        );
        echo json_encode($result);
    }
    else {
        $result = array(
            "code" => -1,
            "msg" => "该用户不存在",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
}
mysqli_close($conn);
?>