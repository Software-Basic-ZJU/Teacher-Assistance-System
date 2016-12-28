<?php
/**
 * Created by PhpStorm.
 * User: asus-pc
 * Date: 2016/12/28
 * Time: 0:15
 */
function async_request($url, $post_data = array(), $token=""){
    $method = "GET";  //通过POST或者GET传递一些参数给要触发的脚本
    $url_array = parse_url($url); //获取URL信息
//    $port = isset($url_array['port'])? $url_array['port'] : 80;
    $fp = fsockopen("ssl://".$url_array['host'], 443, $errno, $errstr, 30);
    if (!$fp) {
        return FALSE;
    }
//    $getPath = $url_array['scheme']."://".$url_array['path'] ."?". $url_array['query'];
//    echo $getPath;
    if(!empty($post_data)){
        $method = "POST";
    }
    $header = $method . " " . $url;
    $header .= " HTTP/1.1\r\n";
    $header .= "Host: ". $url_array['host'] . "\r\n "; //HTTP 1.1 Host域不能省略
    /*以下头信息域可以省略
    $header .= "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13 \r\n";
    $header .= "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,q=0.5 \r\n";
    $header .= "Accept-Language: en-us,en;q=0.5 ";
    $header .= "Accept-Encoding: gzip,deflate\r\n";
     */
    $header .="X-Access-Token: ".$token;
    $header .= "Connection:Close\r\n";
    if(!empty($post_data)){
        $_post = strval(NULL);
        foreach($post_data as $k => $v){
            $_post .= $k."=".$v."&";
//            echo $k."=".$v;
        }
        $post_str  = "Content-Type: application/x-www-form-urlencoded\r\n";
        $post_str .= "Content-Length: ". strlen($_post) ." \r\n"; //POST数据的长度
        $post_str .= $_post."\r\n\r\n "; //传递POST数据
        $header .= $post_str;
    }
    fwrite($fp, $header);
    //echo fread($fp, 1024); //服务器返回
    fclose($fp);
    return true;
}
//if(async_request("https://127.0.0.1/app/backend/aboutResource/removeResource.php",array("resource_id"=>"10015"))) echo "yes";