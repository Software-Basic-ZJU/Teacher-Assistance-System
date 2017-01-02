<?php
// Connect database
include '_include.php';
global $conn;
connectDB();
// Get id and password and type
$id = test_input(mysqli_escape_string($conn, $_POST['id']));
$password = encrypt($_POST['password']);
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
                    'question2' => $fetched['question1']
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
else if ($type == 2){
    $year=(int)date('Y');
    $month=(int)date('m');
    if($month<7) $year-=1;  //如果在第二年的前半年，仍然属于前一年的学年
    $query_result = mysqli_query($conn, "select * from teacher 
                                         where teacher_id ='$id' and password='$password' limit 1");
    if($fetched = mysqli_fetch_array($query_result)){
        $token = $id."-".$type."-".time();
        $token = encrypt($token);
        $class_query=mysqli_query($conn,"select class_teacher.class_id,name from classes join class_teacher on classes.class_id=class_teacher.class_id
                                          where teacher_id='$id' and ((year='$year' and term=0) or (year='$year'+1 and term=1));");
        $class=[];
        while($class_fetch=mysqli_fetch_array($class_query)){
            $class[]=array(
                "class_id"=>$class_fetch['class_id'],
                "class_name"=>$class_fetch['name']
            );
        }
        if(count($class)==0){
            $result = array(
                "code" => -1,
                "msg" => "该教师还未分配班级",
                "res" => array()
            );
            echo json_encode($result);
        }
        else {
            $result = array(
                "code" => 2,
                "msg" => "登陆成功",
                "res" => array(
                    "token" => $token,
                    "id" => $id,
                    'class_id' => $class,
                    'teacher_id' => $id,
                    'email' => $fetched['email'],
                    'name' => $fetched['name'],
                    'type' => $type,
                    'group_id' => null
                )
            );
            echo json_encode($result);
        }
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
else if ($type == 3){
    $query_result = mysqli_query($conn, "select * from assists join class_teacher on assists.assist_id=class_teacher.assist_id where assists.assist_id ='$id' and password='$password' limit 1");
    if($fetched = mysqli_fetch_array($query_result)){
        $token = $id."-".$type."-".time();
        $token = encrypt($token);
        $result = array(
            "code" => 3,
            "msg" => "登陆成功",
            "res" => array(
                "token" => $token,
                "id" => $id,
                'class_id'=>$fetched['class_id'],
                'teacher_id'=> $fetched['teacher_id'],
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
else echo json_encode(array(
    "code"=> -1,
    "msg"=>"该身份类型不存在!",
    "res"=>array()
));

mysqli_close($conn);
