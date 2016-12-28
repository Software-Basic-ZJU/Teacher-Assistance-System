<?php
header('Content-type: application/json');
//header("content-Type: text/html; charset=gb2312");
//session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);

//include 'connectDB.php';
//connectDB();
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
//select *, count(distinct name) from table group by name
$query_result = mysqli_query($conn, "select teacher_info from teacher 
                                        where teacher_id ='$teacher_id'");


//echo $fetched['teacher_info'];
//echo $fetched;
    if ($fetched = mysqli_fetch_array($query_result)) {
        $result = array(
            "code" => 0,
            "msg" => "查找成功",
            "res" => $fetched['teacher_info']
        );
        //echo $result;
        echo json_encode($result);
    } else {
        $result = array(
            "code" => 1,
            "msg" => "查找失败",
            "res" => null
        );
        echo json_encode($result);
    }

mysqli_close($conn);
?>