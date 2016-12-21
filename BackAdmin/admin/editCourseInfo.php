<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/28
 * Time: 09:17
 */
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

//$info_id = test_input(mysqli_escape_string($conn, $_REQUEST['info_id']));

$course_name = test_input(mysqli_escape_string($conn, $_REQUEST['course_name']));
$background = test_input(mysqli_escape_string($conn, $_REQUEST['background']));
$course_plan = test_input(mysqli_escape_string($conn, $_REQUEST['course_plan']));
$textbook_precourse = test_input(mysqli_escape_string($conn, $_REQUEST['textbook_precourse']));
$exam_homework = test_input(mysqli_escape_string($conn, $_REQUEST['exam_homework']));

//select *, count(distinct name) from table group by name
$query_result = mysqli_query($conn, "update course_info
                                     set
                                     course_name = '$course_name',
                                     background = '$background',
                                     course_plan = '$course_plan',
                                     textbook_precourse = '$textbook_precourse',
                                     exam_homework = '$exam_homework'
                                     ");
if($query_result){
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