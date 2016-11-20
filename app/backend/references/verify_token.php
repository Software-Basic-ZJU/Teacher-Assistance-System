<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/20
 * Time: 11:13
 */
function connectDB(){
    global $conn;
    $conn = mysqli_connect("127.0.0.1", "root", "root", "online_pay");//要改密码
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
function verify_token($token){
    $token_array = explode("-", decrypt($token));
    $expireTime = time() + 7200;
    //Check user_name
    global $conn;
    connectDB();
    $query_result = mysqli_query($conn,
        "select * from user where user_name='".$token_array[0]."' ");
    if(!$query_result){
        $result = array(
            'code' => 233,
            'msg' => '当前用户名与token中的用户名不一致',
            'res' => array()
        );
        echo json_encode($result);
        exit;
    } elseif($token_array[1] > $expireTime){
        $result = array(
            'code' => 233,
            'msg' => 'token已过期',
            'res' => array()
        );
        echo json_encode($result);
        exit;
    } else{
        $fetched = mysqli_fetch_array($query_result);
        $_SESSION['user_name'] = $fetched['user_name'];
        $_SESSION['user_id'] = $fetched['user_id'];
        $new_token = encrypt($token_array[0]."-".time());
        $_SESSION['token'] = $new_token;
        return $fetched;
    }
}