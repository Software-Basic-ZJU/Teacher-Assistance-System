<?php

function connectDB(){
    global $conn;
    $conn = mysqli_connect("localhost","root","mysql123","course_assis");
    $conn->query("set names 'utf8'");
    if(mysqli_connect_errno()){
        printf("Connect failed: %s\n", mysqli_connect_errno());
        exit();
    }
}
?>