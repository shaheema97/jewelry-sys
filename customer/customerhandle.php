<?php
include ("../customer/cust.php");
//create an object for the class
$cust1=new cust();

//fetch values frm thee fom and assign in to the object
if(isset($_POST["firstnm"])){
    $cust1->cust_first_nm=$_POST["firstnm"];
    $cust1->cust_last_nm=$_POST["lastnm"];
    $cust1->cust_add=$_POST["add"];
    $cust1->cust_gen=$_POST["gen"];
    $cust1->cust_dob=$_POST["dob"];
    $cust1->cust_mob1=$_POST["mob1"];
    $cust1->cust_mob2=$_POST["mob2"];
    $cust1->cus_nic=$_POST["nic"];
    $cust1->cust_nicpic=$_POST["nicpic"];
    $cust1->cust_mail=$_POST["mail"];

    $cust1->addcust();


}
?>