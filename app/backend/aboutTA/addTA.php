<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/15
 * Time: 11:22
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
$class_id = test_input(mysqli_escape_string($conn, $_POST['class_id']));
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
$assist_id = test_input(mysqli_escape_string($conn, $_POST['assist_id']));
$assist_password = encrypt(test_input(mysqli_escape_string($conn, $_POST['assist_password'])));
$name = test_input(mysqli_escape_string($conn, $_POST['name']));

//$query_result = mysqli_query($conn, "INSERT INTO class_teacher
//                                     (class_id,teacher_id,assist_id)
//                                      values('$class_id','$teacher_id','$assist_id');");
$query_result = mysqli_query($conn, "update class_teacher set assist_id = '$assist_id' WHERE class_id = '$class_id' AND teacher_id = '$teacher_id';");

if($query_result){
    $query_result = mysqli_query($conn, "INSERT INTO assists
                                     (assist_id,password,name) 
                                      values('$assist_id','$assist_password','$name');");
    if($query_result){
        $result = array(
            "code" => 0,
            "msg" => "助教增加成功",
            "res" => array(
                'class_id' => $class_id,
                'teacher_id' => $teacher_id,
                'assist_id' => $assist_id,
                'name' => $name,
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
        exit;
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "助教表,联系表未增加成功",
            "res" => array(
                'class_id' => $class_id,
                'teacher_id' => $teacher_id,
                'assist_id' => $assist_id,
                'name' => $name,
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
        exit;
    }
}
else{
    $result = array(
        "code" => -1,
        "msg" => "助教未增加成功",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
    exit;
}
mysqli_close($conn);
?>