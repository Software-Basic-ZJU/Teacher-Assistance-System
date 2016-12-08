<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/20
 * Time: 14:57
 */
header('Content-type: application/json');
session_start();
// Connect database
include '_include.php';
global $conn;
connectDB();
// Get id and password and type
$id = test_input(mysqli_escape_string($conn, $_POST['id']));
$password = md5($_POST['password']);
$type = test_input(mysqli_escape_string($conn, $_POST['type']));
// Check id and password and type
//type: 1->student 2->teacher
if($type == 1){
    $query_result = mysqli_query($conn, "select * from student 
                                         where student_id ='$id' and password='$password' limit 1");
    if($fetched = mysqli_fetch_array($query_result)){
        $token = $id."-".$type."-".time();
        $token = encrypt($token);
        $class_id = $fetched['class_id'];
        $query_result2 = mysqli_query($conn, "select teacher_id from class_teacher where class_id ='$class_id'");
        if($fetched2 = mysqli_fetch_array($query_result2)){
            //Token,id,class_id,teacher_id,name,type,group_id
            $result = array(
                "code" => 1,
                "msg" => "登陆成功",
                "res" => array(
                    "token" => $token,
                    "id" => $id,
                    'class_id'=>$fetched['class_id'],
                    'teacher_id'=> $fetched2['teacher_id'],
                    'name'=>$fetched['name'],
                    'type'=>$type,
                    'group_id'=>$fetched['group_id'],
                    'email' => $fetched['email'],
                    'question1' => $fetched['question1'],
                    'question2' => $fetched['question1'],
                    'answer1' => $fetched['answer1'],
                    'answer2' => $fetched['answer2']
                )
            );
            echo json_encode($result);
        }
    } else {
        $result = array(
            "code" => -1,
            "msg" => "登录失败,用户名或密码或类型错误",
            "res" => array()
        );
        echo json_encode($result);
    }
}
elseif ($type == 2){
    $query_result = mysqli_query($conn, "select * from teacher 
                                         where teacher_id ='$id' and password='$password' limit 1");
    if($fetched = mysqli_fetch_array($query_result)){
        $token = $id."-".$type."-".time();
        $token = encrypt($token);

        $result = array(
            "code" => 2,
            "msg" => "登陆成功",
            "res" => array(
                "token" => $token,
                "id" => $id,
                'class_id'=>null,
                'teacher_id'=> null,
                'name'=>$fetched['name'],
                'type'=>$type,
                'group_id'=>null
            )
        );
        echo json_encode($result);
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "登录失败,用户名或密码或类型错误",
            "res" => array()
        );
        echo json_encode($result);
    }
}
elseif ($type == 3){
    $query_result = mysqli_query($conn, "select * from assists 
                                         where assist_id ='$id' and password='$password' limit 1");
    if($fetched = mysqli_fetch_array($query_result)){
        $token = $id."-".$type."-".time();
        $token = encrypt($token);
        $result = array(
            "code" => 3,
            "msg" => "登陆成功",
            "res" => array(
                "token" => $token,
                "id" => $id,
                'class_id'=>null,
                'teacher_id'=> null,
                'name'=>null,
                'type'=>$type,
                'group_id'=>null
            )
        );
        echo json_encode($result);
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "登录失败,用户名或密码或类型错误",
            "res" => array()
        );
        echo json_encode($result);
    }
}


mysqli_close($conn);
?>