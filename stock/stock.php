<?php
include_once ("../files/config.php");
class stock{
    public $stock_id;
    public $ref_type;
    public $ref_type_id;
    public $item_id;
    public $qty;
    public $stock_date;
    public $stock_status;
    public $db;


    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }

    function insert_stock_add($ref_id){
        $list=0;
        foreach($_POST["proc_type"] as $item){
            $sql="INSERT INTO stock (ref_type,item_id,qty,ref_type_id) VALUES ('".$_POST['proc_type'][$list]."','".$_POST['itm_name'][$list]."','".-$_POST['itm_quan'][$list]."',$ref_id) ";
           echo $sql;
           $this->db->query($sql);
           $list++;

        }
        return true;
    }
//note->itm_name index for item id in buygold2.php
    function insertstock_minus($procid){
        $list=0;
        foreach($_POST["proc_type"] as $item){

            $sql="INSERT INTO stock (ref_type,item_id,qty,ref_type_id) VALUES ('".$_POST['proc_type'][$list]."','".$_POST['item'][$list]."','".$_POST['itm_quan'][$list]."',$procid) ";
          // echo $sql;
           $this->db->query($sql);
           $list++;

        }
        return true;
    }
    function insert_stock_item($itemid,$reftype,$qty){
        
            $sql="INSERT INTO stock (ref_type,qty,item_id) VALUES ($reftype,$qty,$itemid) ";
           //echo $sql;
           $this->db->query($sql);
           return true;
    }

    function sum_stock(){
        $sql="SELECT *, SUM(stock.qty) as tot  FROM stock GROUP BY stock.item_id";
        $res=$this->db->query($sql);
        echo $sql;   
        $row=$res->fetch_array();

        $stock1=new stock();
        $stock1->stock_id=$row["stock_id"];
        $stock1->ref_type=$row["ref_type"];
        $stock1->ref_type_id=$row["ref_type_id"];
        $stock1->item_id=$row["item_id"];
        $stock1->totqty=$row["tot"];
        $stock1->qty=$row["qty"];
        $stock1->stock_date=$row["stock_date"];
        $stock1->stock_status=$row["stock_status"];

        return $stock1;
    
    }

    function sum_stock_id($itemid){
        $sql="SELECT *, SUM(stock.qty) as tot FROM stock WHERE item_id=$itemid GROUP BY stock.item_id";
        $res=$this->db->query($sql);
        echo $sql;   
        $row=$res->fetch_array();

        $stock1=new stock();
        $stock1->stock_id=$row["stock_id"];
        $stock1->ref_type=$row["ref_type"];
        $stock1->ref_type_id=$row["ref_type_id"];
        $stock1->item_id=$row["item_id"];
        $stock1->qty=$row["qty"];
        $stock1->totqty=$row["tot"];
        $stock1->stock_date=$row["stock_date"];
        $stock1->stock_status=$row["stock_status"];

        return $stock1;
    
    }




}


?>