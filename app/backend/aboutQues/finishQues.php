<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/1
 * Time: 14:38
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
if($_SESSION['type']!=2){
    $result = array(
        "code" => 2,
        "msg" => "无效用户尝试操作",
        "res" => null
    );
    echo json_encode($result);
    exit;
}
$query_result = mysqli_query($conn, "select * from works WHERE ques_id = '$ques_id' AND score IS NULL ;");

if($fetched = mysqli_fetch_array($query_result)){
    $result = array(
        "code" => 1,
        "msg" => "还有未点评的work",
        "res" => null
    );
    echo json_encode($result);
}
else{
    $get_avg_score = mysqli_query($conn, "select AVG(score) as avg_score from works WHERE ques_id = '$ques_id';");
    if($fetched_avg_score = mysqli_fetch_array($get_avg_score)){
        $avg_score = $fetched_avg_score['avg_score'];
        mysqli_query($conn, "update questions set average_score = '$avg_score' WHERE ques_id = '$ques_id';");
        $get_hw_id = mysqli_query($conn, "select hw_id from questions WHERE ques_id = '$ques_id';");
        if($fetched_hw_id = mysqli_fetch_array($get_hw_id)){
            $hw_id = $fetched_hw_id['hw_id'];
        }
        $query_result3 = mysqli_query($conn, "select * from questions 
                                              WHERE hw_id = '$hw_id' AND ques_finish = 0;");
        if(!($fetched3 = mysqli_fetch_array($query_result3))){
            mysqli_query($conn, "update homework set over = 1 WHERE hw_id = '$hw_id';");
        }
        $result = array(
            "code" => 0,
            "msg" => "提交成功",
            "res" => null
        );
        echo json_encode($result);
    }



}
mysqli_close($conn);
?>