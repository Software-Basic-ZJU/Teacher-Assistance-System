<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/20
 * Time: 16:40
 */
include 'loginCheck.php';
date_default_timezone_set('Asia/Shanghai');
function test_input($data) {
    $data = inject_prevent($data);
    $data = trim($data);//去除用户输入数据中不必要的字符（多余的空格、制表符、换行）
    $data = stripslashes($data);//删除用户输入数据中的反斜杠（\）
    $data = htmlspecialchars($data);//把特殊字符转换为 HTML 实体
    return $data;
}

function inject_prevent($Sql_Str) {//自动过滤Sql的注入语句。
    $check=preg_match('/select|insert|update|delete|\'|\\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/i',$Sql_Str);
    if ($check) {
        $Sql_Str = strtr($Sql_Str,array("select"=>" ", 'insert'=>' ', 'update'=>' ', 'delete'=>' '));
    }
    return $Sql_Str;
}
?>
