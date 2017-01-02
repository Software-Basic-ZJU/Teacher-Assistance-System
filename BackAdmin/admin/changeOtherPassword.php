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
$id = test_input(mysqli_escape_string($conn, $_POST['id']));
$newPassword = encrypt(test_input(mysqli_escape_string($conn, $_POST['newPassword'])));
//$newPassword1 = test_input(mysqli_escape_string($conn, $_POST['newPassword']));
$type = test_input(mysqli_escape_string($conn, $_POST['type']));

if($type == 1){//学生
    $query_result = mysqli_query($conn, "select * from student
                                         where student_id ='$id'");
    if($fetched = mysqli_fetch_array($query_result)){
            mysqli_query($conn, "update student set password = '$newPassword'
                                         where student_id ='$id'");
            $result = array(
                "code" => 0,
                "msg" => "修改成功",
                "res" => array()
            );
            echo json_encode($result);
            exit;
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "无此用户",
            "res" => array()
        );
        echo json_encode($result);
        exit;
    }
}
else if($type == 2){             //教师
    $query_result = mysqli_query($conn, "select * from teacher
                                         where teacher_id ='$id'");
    if($fetched = mysqli_fetch_array($query_result)){
            mysqli_query($conn, "update teacher set password = '$newPassword'
                                         where teacher_id ='$id'");
            $result = array(
                "code" => 0,
                "msg" => "修改成功",
                "res" => array()
            );
            echo json_encode($result);
            exit;
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "无此用户",
            "res" => array()
        );
        echo json_encode($result);
        exit;
    }
}
else if($type == 3){
    $query_result = mysqli_query($conn, "select * from assists
                                         where assist_id ='$id'");
    if($fetched = mysqli_fetch_array($query_result)){
        mysqli_query($conn, "update assists set password = '$newPassword'
                                         where assist_id ='$id'");
        $result = array(
            "code" => 0,
            "msg" => "修改成功",
            "res" => array()
        );
        echo json_encode($result);
        exit;
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "无此用户",
            "res" => array()
        );
        echo json_encode($result);
        exit;
    }
}
/*
$password = test_input(mysqli_escape_string($conn, $_POST['password']));
$admin_id = $_POST['admin_id'];
$newPassword = encrypt(test_input(mysqli_escape_string($conn, $_POST['password'])));

//echo $admin_id;
$query_result = mysqli_query($conn, "select * from student
                                     WHERE student_id = '$admin_id';");

$query_result1 = mysqli_query($conn, "select * from student
                                     WHERE student_id = '$admin_id';");

//echo "$query_result1";
if($fetched = mysqli_fetch_array($query_result1)){
    $query_result1 = mysqli_query($conn, "update student
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
    $query_result2 = mysqli_query($conn, "select * from teacher
                                     WHERE teacher_id = '$admin_id';");

    $query_result = mysqli_query($conn, "update teacher
                                     set
                                     password = '$password'
                                     WHERE teacher_id = '$admin_id';");
    if($fetched = mysqli_fetch_array($query_result2)) {
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
}*/
mysqli_close($conn);
?>