<?php
 include_once ("../files/config.php");
 include_once ("../item/category.php");
 include_once ("../item/item.php");

class purchaseorderitem{
    public $purchorderitem_id;
    public $purchorderitem_purch_id;
    public $purchorderitem_date;
    public $purchorderitem_status;
    public $purchorderitem_cat;
    public $purchorderitem_item;
    public $purchorderitem_size;
    public $purchorderitem_unit;
    public $purchorderitem_purity;
    public $purchorderitem_weight;
    public $purchorderitem_qty;
    public $purchorderitem_req;
    public $itemcat;
    public $itemname;
    public $db;
    
    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }

    function insert_purchitem($orderid){
        $list=0;
        foreach($_POST["p_itemcat"] as $item){

            $sql="INSERT INTO purchse_orderitem (purchorderitem_cat,purchorderitem_item,purchorderitem_size,purchorderitem_purity,purchorderitem_weight,purchorderitem_qty,purchorderitem_purch_id) VALUES ('".$_POST['p_itemcat'][$list]."','".$_POST['p_itemname'][$list]."','".$_POST['p_itemsize'][$list]."','".$_POST['p_itempurity'][$list]."','".$_POST['p_itemweight'][$list]."','".$_POST['p_itemqty'][$list]."',$orderid)";
            echo $sql;
            $this->db->query($sql);
            $list++;
        }
        return true;
    }

    function update_purchitem($orderid){
        $list=0;
        foreach($_POST["p_itemname"] as $item){

            // $sql="INSERT INTO purchse_orderitem (purchorderitem_cat,purchorderitem_item,purchorderitem_size,purchorderitem_purity,purchorderitem_weight,purchorderitem_qty,purchorderitem_purch_id) VALUES ('".$_POST['p_itemcat'][$list]."','".$_POST['p_itemname'][$list]."','".$_POST['p_itemsize'][$list]."','".$_POST['p_itempurity'][$list]."','".$_POST['p_itemweight'][$list]."','".$_POST['p_itemqty'][$list]."',$orderid)";
            $sql="UPDATE purchse_orderitem SET purchorderitem_item='".$_POST['p_itemname'][$list]."' ,purchorderitem_size='".$_POST['p_itemsize'][$list]."', purchorderitem_unit='".$_POST['p_itemunit'][$list]."',purchorderitem_purity='".$_POST['p_itempurity'][$list]."',purchorderitem_weight='".$_POST['p_itemweight'][$list]."',purchorderitem_qty='".$_POST['p_itemqty'][$list]."' WHERE   purchorderitem_purch_id=$orderid ";
            echo $sql;
            $this->db->query($sql);
            $list++;
        }
        return true;
    }

    function getall_purchitem(){
        $sql="SELECT * FROM purchse_orderitem WHERE purchorderitem_status='ACTIVE'";
        $result=$this->db->query($sql);
        $purchitem=array();
        while($row=$result->fetch_array()){
            $item_name_=new item();
            $item_cat=new category();
            $purchitem=new purchaseorderitem();

            $purchitem->purchorderitem_id=$row["purchorderitem_id"];
            $purchitem->purchorderitem_purch_id=$row["purchorderitem_purch_id"];
            $purchitem->purchorderitem_date=$row["purchorderitem_date"];
            $purchitem->purchorderitem_status=$row["purchorderitem_status"];
            $purchitem->purchorderitem_cat=$row["purchorderitem_cat"];
            $purchitem->purchorderitem_item=$row["purchorderitem_item"];
            $purchitem->purchorderitem_size=$row["purchorderitem_size"];
            $purchitem->purchorderitem_unit=$row["purchorderitem_unit"];
            $purchitem->purchorderitem_purity=$row["purchorderitem_purity"];
            $purchitem->purchorderitem_weight=$row["purchorderitem_weight"];
            $purchitem->purchorderitem_qty=$row["purchorderitem_qty"];
            $purchitem->purchorderitem_req=$row["purchorderitem_req"];

            $purchitem[]=$purchitem;
        }
        return $purchitem;
    }
    function getall_purchitem_byorderid($id){
        $sql="SELECT * FROM purchse_orderitem WHERE purchorderitem_purch_id='$id'";
        $result=$this->db->query($sql);
        $purchitem_array=array();
        while($row=$result->fetch_array()){
           $item_name=new item();
           $item_cat=new category();
            $purchitem=new purchaseorderitem();

            $purchitem->purchorderitem_id=$row["purchorderitem_id"];
            $purchitem->purchorderitem_purch_id=$row["purchorderitem_purch_id"];
            $purchitem->purchorderitem_date=$row["purchorderitem_date"];
            $purchitem->purchorderitem_status=$row["purchorderitem_status"];
            $purchitem->purchorderitem_cat=$row["purchorderitem_cat"];
            $purchitem->itemcat=$item_cat->getbyid_category($purchitem->purchorderitem_cat);
            $purchitem->purchorderitem_item=$row["purchorderitem_item"];
            $purchitem->itemname=$item_name->getitem_by_id($purchitem->purchorderitem_item);
            $purchitem->purchorderitem_size=$row["purchorderitem_size"];
            $purchitem->purchorderitem_unit=$row["purchorderitem_unit"];
            $purchitem->purchorderitem_purity=$row["purchorderitem_purity"];
            $purchitem->purchorderitem_weight=$row["purchorderitem_weight"];
            $purchitem->purchorderitem_qty=$row["purchorderitem_qty"];
            $purchitem->purchorderitem_req=$row["purchorderitem_req"];

            $purchitem_array[]=$purchitem;
        }
        return $purchitem_array;
    }

    function del_purchitem($delitm_id){
        $sql="UPDATE purchaseitem SET purchorderitem_status='INACTIVE' WHERE purchorderitem_id='$delitm_id' ";
        $this->db->query($sql);
        
    }

    function edit_item(){

    }
}
?>