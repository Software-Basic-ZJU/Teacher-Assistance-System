<?php
header('Content-type: application/json');
//session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);
//Get information
$teacher_info = test_input(mysqli_escape_string($conn, $_POST['teacher_info']));
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));

$query_result = mysqli_query($conn, "update teacher
                                     set teacher_info = '$teacher_info'
                                     WHERE teacher_id = '$teacher_id';");

$query_result1 = mysqli_query($conn, "select * from teacher
                                        where teacher_id ='$teacher_id'");

    if ($fetched = mysqli_fetch_array($query_result1)) {
        $result = array(
            "code" => 0,
            "msg" => "更改成功",
            "res" => array(
                'teacher_info' => $teacher_info
            )
        );
        echo json_encode($result);
    } else {
        $result = array(
            "code" => 1,
            "msg" => "更改失败",
            "res" => null
        );
        echo json_encode($result);
    }

mysqli_close($conn);
?>