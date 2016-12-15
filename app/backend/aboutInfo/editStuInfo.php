<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/15
 * Time: 12:44
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
$student_id = test_input(mysqli_escape_string($conn, $_POST['student_id']));
$name = test_input(mysqli_escape_string($conn, $_POST['name']));
$email = test_input(mysqli_escape_string($conn, $_POST['email']));
$question1 = test_input(mysqli_escape_string($conn, $_POST['question1']));
$question2 = test_input(mysqli_escape_string($conn, $_POST['question2']));
$answer1 = encrypt(test_input(mysqli_escape_string($conn, $_POST['answer1'])));
$answer2 = encrypt(test_input(mysqli_escape_string($conn, $_POST['answer2'])));
if($_SESSION['student_id']!=$student_id){
    $result = array(
        "code" => 403,
        "msg" => "无效用户尝试删除",
        "res" => null
    );
    echo json_encode($result);
    exit;
}
$query_result = mysqli_query($conn, "update student
                                     set name = '$name',email = '$email',question1 = '$question1',question2 = '$question2',answer1 = '$answer1',answer2 = '$answer2'
                                     WHERE student_id = '$student_id';");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            'student_id' => $student_id,
            'name' => $name,
            'email' => $email,
            'question1' => $question1,
            'question2' => $question2,
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "修改失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>