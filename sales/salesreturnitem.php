<?php

include_once ("../files/config.php");
include_once ("../sales/salesitem.php");
 class salesreturnitem{
     public $sretunitem_id;
     public $sreturnitem_returnid;//return id
     public $sreturnitem_saleid;//not  neccesary
     public $sreturnitem_itemid;//itemid
     public $sreturnitem_sid;//return sale item id
     public $sreturnitem_amount;
     public $sreturnitem_date;
     public $sreturnitem_status;
     public $db;

     function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }

   
    function insert_saleitems($returnid){
        $sales_item=new salesitem();
        $list=0;
        foreach($_POST["saleid"] as $item) {
            
            $sql="INSERT INTO salesreturnitem( sreturnitem_itemid,sreturnitem_sid,sreturnitem_amount,sreturnitem_returnid) VALUES ('".$_POST['saleid'][$list]."','".$_POST['item'][$list]."','".$_POST['price'][$list]."',$returnid)";
            //echo $sql;
            $this->db->query($sql);
//function to update sales return status as inactive
//edit this function so that the when the quantity is O it gets updated
            $sales_item->del_salesitem($_POST['saleid'][$list]);
            
            $list++;
        }
        return true;
    }

 }
?>