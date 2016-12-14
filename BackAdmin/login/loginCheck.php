<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/20
 * Time: 11:13
 */
function connectDB(){
    global $conn;
    $conn = mysqli_connect("localhost","root","","BackAdmin");
    $conn->query("set names 'utf8'");
    if(mysqli_connect_errno()){
        printf("Connect failed: %s\n", mysqli_connect_errno());
        exit();
    }
}
function encrypt($data) {
    $key = "123w4er5";
    $prep_code = serialize($data);
    $block = mcrypt_get_block_size('des', 'ecb');
    if (($pad = $block - (strlen($prep_code) % $block)) < $block) {
        $prep_code .= str_repeat(chr($pad), $pad);
    }
    $encrypt = mcrypt_encrypt(MCRYPT_DES, $key, $prep_code, MCRYPT_MODE_ECB);
    return base64_encode($encrypt);
}
function decrypt($str) {
    $key = "123w4er5";
    $str = base64_decode($str);
    $str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);
    $block = mcrypt_get_block_size('des', 'ecb');
    $pad = ord($str[($len = strlen($str)) - 1]);
    if ($pad && $pad < $block && preg_match('/' . chr($pad) . '{' . $pad . '}$/', $str)) {
        $str = substr($str, 0, strlen($str) - $pad);
    }
    return unserialize($str);
}
function loginCheck($token){
    $token_array = explode("-", decrypt($token));//$token = $id."-".time();
    $expireTime = time() + 7200;
    //Check user_name
    global $conn;
    connectDB();
    //if($token_array[1]==1){//type: 1->student 2->teacher
        $query_result = mysqli_query($conn,
            "select * from admin where admin_id ='".$token_array[0]."' ");
    //}
    /*elseif ($token_array[1]==2){
        $query_result = mysqli_query($conn,
            "select * from teacher where teacher_id ='".$token_array[0]."' ");
    }
    elseif ($token_array[1]==3){
        $query_result = mysqli_query($conn,
            "select * from teacher where assist_id ='".$token_array[0]."' ");
    }*/
    //else{
      //  $query_result = null;
    //}
    if(!$query_result){
        $result = array(
            'code' => -1,
            'msg' => '当前用户名与token中的用户名不一致',
            'res' => array()
        );
        echo json_encode($result);
        exit;
    } elseif($token_array[1] > $expireTime){
        $result = array(
            'code' => -1,
            'msg' => 'token已过期',
            'res' => array()
        );
        echo json_encode($result);
        exit;
    } else{
        $fetched = mysqli_fetch_array($query_result);
        //if($token_array[1]==1){
            $_SESSION['student_id'] = $fetched['admin_id'];
        //}
        /*elseif ($token_array[1]==2){
            $_SESSION['teacher_id'] = $fetched['teacher_id'];
            $_SESSION['tname']= $fetched['name'];
            $_SESSION['email']= $fetched['email'];
            $_SESSION['info_id']= $fetched['info_id'];
        }
        elseif($token_array[1]==3){
            $_SESSION['assist_id'] = $fetched['assist_id'];
        }
        $_SESSION['type']= $token_array[1];*/
        $new_token = encrypt($token_array[0].time());
        $_SESSION['token'] = $new_token;
        return $fetched;
    }
}
?>