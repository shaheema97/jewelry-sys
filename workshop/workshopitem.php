<?php
include_once ("../files/config.php");
include_once ("../sales/orderitem.php");
include_once ("../sales/order.php");

class workshopitem{
public $wsitem_id;    
public $wsitem_orderid;    
public $wsitem_type;    
public $wsitem_typeid;    
public $wsitem_quan;
public $wsitem_date;    
public $wsitem_status;  
public $db;

    
    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }  

    function add_workshopitem($orderid){
        $o_item=new orderitem();
        $order8=new order();
        $list=0;
        foreach($_POST["type1"] as $item){
            //print_r($_SESSION["pawn"]);
             $sql="INSERT INTO workshopitem(wsitem_type,wsitem_typeid,wsitem_quan,wsitem_orderid) VALUES ('".$_POST['type1'][$list]."' ,'".$_POST['typeid'][$list]."','".$_POST['itmquan'][$list]."',$orderid)";
            // echo $sql;
             $this->db->query($sql);

             if($_POST['type1'][$list]=='order')
             {
             $o_item->update_status_workshop($_POST['typeid'][$list]);
            $order8->oder_ws_status($_POST['orderstat'][$list]);
            }
             
            }
            $list++;
            return true;}



function getall_ws_item($WS_ITEMID){
    $sql="SELECT * FROM workshopitem left join orderitem on orderitem.orderitem_id=workshopitem.wsitem_typeid join item on item.item_id=workshopitem.wsitem_typeid WHERE wsitem_status='ACTIVE' AND wsitem_orderid=$WS_ITEMID ";
    $res=$this->db->query($sql);
        $ws_array=array();
        while($row=$res->fetch_array()){
            $ws_item=new workshopitem();
          
            
           // $orderdetails=new order();

            $ws_item->wsitem_id=$row["wsitem_id"];
            $ws_item->wsitem_orderid=$row["wsitem_orderid"];
            $ws_item->wsitem_type=$row["wsitem_type"];
            $ws_item->wsitem_typeid=$row["wsitem_typeid"];
            $ws_item->wsitem_quan=$row["wsitem_quan"];
            $ws_item->wsitem_date=$row["wsitem_date"];
            $ws_item->wsitem_status=$row["wsitem_status"];
            if($row["wsitem_type"]=='sales'){
                $ws_item->orderweight=$row["item_nettwt"];
                $ws_item->orderpurity=$row["item_purity"];
                $ws_item->ordersize=$row["item_size"];
              //  $ws_item->orderunit=$row[""];
                $ws_item->ordername=$row["item_name"];
                $ws_item->ordercategory=$row["item_cat"];

            }
            else{ 
                $ws_item->orderpurity=$row["orderitm_purity"];
                $ws_item->orderweight=$row["orderitm_weight"];
                $ws_item->ordersize=$row["orderitm_size"];
               // $ws_item->orderunit=$row[""];
                $ws_item->ordername=$row["orderitm_name"];
                $ws_item->ordercategory=$row["orderitm_cat"];
                $ws_item->orderstatus=$row["orderitem_status"];
            }
            
            // $ws_item->=$row[""];
            // $ws_item->=$row[""];

            $ws_array[]=$ws_item;
        }
        return $ws_array;
    }
}

?>