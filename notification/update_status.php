<?php
session_start();
include_once ("../notification/notification.php");
$notify6=new notification();

if(!isset($_SESSION["user"])){
    header("location:../login/loginfrm.php");
    exit;
}

if(isset($_SESSION["user"]["u_id"])){
    $notify6->update_status($_SESSION["user"]["u_id"]);
}




?>