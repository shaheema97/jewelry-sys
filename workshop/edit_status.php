<?php

include_once ("../workshop/workshop.php");
$ws_order4=new workshop();

if(isset($_POST["ws_id"])){
    $ws_order4->workshop_id=$_POST["ws_id"];
    $ws_order4->workshop_workstatus=$_POST["status"];
    $ws_order4->update_status($_POST["ws_id"]);
    
}
?> 