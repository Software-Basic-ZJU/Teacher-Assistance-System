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

//function _get($str){
//    $val = !empty($_GET[$str]) ? $_GET[$str] : null;
//    return $val;
//}
//include 'connectDB.php';
//connectDB();
//echo
$info_id = test_input(mysqli_escape_string($conn, $_POST['info_id']));

$course_name = test_input(mysqli_escape_string($conn, $_POST['course_name']));
$background = test_input(mysqli_escape_string($conn, $_POST['background']));
$course_plan = test_input(mysqli_escape_string($conn, $_POST['course_plan']));
$textbook_precourse = test_input(mysqli_escape_string($conn, $_POST['textbook_precourse']));
$exam_homework = test_input(mysqli_escape_string($conn, $_POST['exam_homework']));
//echo $info_id;
$query_result = mysqli_query($conn, "update course_info
                                     set
                                     course_name = '$course_name',
                                     background = '$background',
                                     course_plan = '$course_plan',
                                     textbook_precourse = '$textbook_precourse',
                                     exam_homework = '$exam_homework'
                                     where info_id='$info_id';
                                     ");

$query_result1 = mysqli_query($conn, "select * from course_info
                                        where info_id ='$info_id'");

if($fetched = mysqli_fetch_array($query_result1)){
    $result = array(
        "code" => 0,
        "msg" => "修改成功"
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "修改失败"
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>