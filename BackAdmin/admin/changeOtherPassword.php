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
$password = test_input(mysqli_escape_string($conn, $_REQUEST['password']));
$admin_id = $_REQUEST['admin_id'];
//echo $admin_id;
$query_result = mysqli_query($conn, "select * from student
                                     WHERE student_id = '$admin_id';");

if(empty($query_result)){

    $query_result = mysqli_query($conn, "update student
                                     set
                                     password = '$password'
                                     WHERE student_id = '$admin_id';");

    $result = array(
        "code" => 0,
        "msg" => "修改成功"
    );
    echo json_encode($result);
}
else{
    $query_result = mysqli_query($conn, "update teacher
                                     set
                                     password = '$password'
                                     WHERE teacher_id = '$admin_id';");
    if($query_result) {
        $result = array(
            "code" => 2,
            "msg" => "修改成功"
        );
        echo json_encode($result);
    }
    else
        {
            $result = array(
                "code" => 1,
                "msg" => "修改失败"
            );
            echo json_encode($result);
        }
}
mysqli_close($conn);
?>