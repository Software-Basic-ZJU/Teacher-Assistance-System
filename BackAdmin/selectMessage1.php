<?php
/**
 * Created by PhpStorm.
 * User: hongyeliang
 * Date: 2016/12/1
 * Time: 上午10:21
 */
$q=$_GET["q"];
$message[0] =array("id"=>"1212","content"=>"留言1212");
$message[1] =array("id"=>"1213","content"=>"留言1213");
$message[2] =array("id"=>"1214","content"=>"留言1214");
$tips =array("code"=>"3","msg"=>"成功","result"=>$message);
echo  json_encode($tips);
