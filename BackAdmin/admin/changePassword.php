<?php
error_reporting(E_ALL ^ E_NOTICE);
header('Content-type: application/json');
session_save_path("/tmp");
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token


function _get($str){
    $val = !empty($_GET[$str]) ? $_GET[$str] : null;
    return $val;
}


loginCheck(_get('token'));
//Get information
$password = test_input(mysqli_escape_string($conn, $_GET['password']));
$admin_id = _get('admin_id');
//$password = _get('password');

//echo $password;

//$password = md5($password);

//echo $password;

$query_result = mysqli_query($conn, "update admin
                                     set
                                     password = '$password'
                                     WHERE admin_id = '$admin_id';");
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