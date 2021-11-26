<?php
include_once ("../files/config.php");
include_once ("../customer/cust.php");
include_once ("../staff/staff.php");
include_once ("../item/item.php");
include_once ("../item/itemname.php");
include_once ("../sales/order.php");

class salesitem{
    public $saleitem_id;
    public $sales_id;
    
    public $salesitem_cat;
    public $salesitem_name;
    public $salesitem_qty;
    public $salesitem_price;
    public $salesitem_discount;
    public $salesitem_nettprice;
    public $salesitem_status;
    public $itemname;
    public $name;
    public $db;

    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }

   
    function insert_saleitems($salesid){
        $list=0;
        $o_item=new item();
        $order8=new order();
        foreach($_POST["itm_name"] as $item) {
            
            $sql="INSERT INTO salesitem(salesitem_name,salesitem_qty,salesitem_price,salesitem_discount,salesitem_nettprice,sales_id) VALUES ('".$_POST['itm_name'][$list]."','".$_POST['itm_quan'][$list]."','".$_POST['b_cprice'][$list]."','".$_POST['b_itemdisc'][$list]."','".$_POST['b_sprice'][$list]."',$salesid)";
            //echo $sql;
            $this->db->query($sql);
            
         
            $o_item->del_item_order($_POST['itm_name'][$list]);
            $order8->oder_sales_status($_POST['order'][$list]);
            
          
            
            $list++;
        }
        return true;
    }

    function getall_saleitem(){
        $sql="SELECT * FROM salesitem WHERE salesitem_status='ACTIVE' ";
        $result=$this->db->query($sql);
        $salesitemarray=array();
        while($row=$result->fetch_array()){
            $s_item1=new salesitem();
            $item_name_id=new item();

            $s_item1->saleitem_id=$row["saleitem_id"];
            $s_item1->sales_id=$row["sales_id"];
            $s_item1->salesitem_cat=$row["salesitem_cat"];
            $s_item1->salesitem_name=$row["salesitem_name"];
            $s_item1->itemname=$item_name_id->getitem_by_id($s_item1->salesitem_name);
            $s_item1->salesitem_qty=$row["salesitem_qty"];
            $s_item1->salesitem_price=$row["salesitem_price"];
            $s_item1->salesitem_discount=$row["salesitem_discount"];
            $s_item1->salesitem_nettprice=$row["salesitem_nettprice"];
            $s_item1->salesitem_status=$row["salesitem_status"];


            $salesitemarray[]=$s_item1;
        }
        return $salesitemarray;
    }

    function getitem_by_salesid($salesid){
        $sql="SELECT * FROM salesitem  WHERE salesitem_status='ACTIVE' AND sales_id='$salesid' ";
        $result=$this->db->query($sql);
        $salesitemarray=array();
        while($row=$result->fetch_array()){
            $s_item1=new salesitem();
            $item_name_id=new item();
            $item_name1=new itemname();

            $s_item1->saleitem_id=$row["saleitem_id"];
            $s_item1->sales_id=$row["sales_id"];
           // $s_item1->salesitem_cat=$row["salesitem_cat"];
            $s_item1->salesitem_name=$row["salesitem_name"]; //id
            $s_item1->itemname=$item_name_id->getitem_by_id($s_item1->salesitem_name); //nammeid and category

    //echo $item_name_id->item_name;
           //$s_item1->name=$item_name1->getall_itemname_byitem($item_name_id->item_name);
            $s_item1->salesitem_qty=$row["salesitem_qty"];
            $s_item1->salesitem_price=$row["salesitem_price"];
            $s_item1->salesitem_discount=$row["salesitem_discount"];
            $s_item1->salesitem_nettprice=$row["salesitem_nettprice"];
            $s_item1->salesitem_status=$row["salesitem_status"];


            $salesitemarray[]=$s_item1;
        }
        return $salesitemarray;
    }

    function getby_saleitem_id($sitem_id){
        $sql="SELECT * FROM salesitem WHERE saleitem_id='$sitem_id' ";
        $result=$this->db->query($sql);
       
        $row=$result->fetch_array();
            $s_item1=new salesitem();

            $s_item1->saleitem_id=$row["saleitem_id"];
            $s_item1->sales_id=$row["sales_id"];
            $s_item1->salesitem_cat=$row["salesitem_cat"];
            $s_item1->salesitem_name=$row["salesitem_name"];
            $s_item1->salesitem_qty=$row["salesitem_qty"];
            $s_item1->salesitem_price=$row["salesitem_price"];
            $s_item1->salesitem_discount=$row["salesitem_discount"];
            $s_item1->salesitem_nettprice=$row["salesitem_nettprice"];
            $s_item1->salesitem_status=$row["salesitem_status"];


          
        return $s_item1;

    }

    function del_salesitem($del_sitem_id){
        $sql="UPDATE salesitem SET salesitem_status='INACTIVE' WHERE saleitem_id=$del_sitem_id";
        $this->db->query($sql);

    }

   
 
}

?>