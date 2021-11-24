<?php

$T=$_GET["type"];
$T();

function check_cusmail()
{
    include ("cust.php");
    $c=new cust();
    $c1=$c->get_cust_mail($_GET["ee"]);

    echo json_encode($c1);
    

}


function check_nic(){
    
    include ("cust.php");
    $c=new cust();
    $c1=$c-> get_cust_nic($_GET["nic_cus"]);

    echo json_encode($c1);
}

function filterpitem(){
    include "pawnitem.php";
    $pis=new pawnitem();
    $pis1=$pis->get_all_pitem_search();
    echo json_encode($pis1);
}




?>