<?php
include_once ("../files/config.php");
include_once ("../item/category.php");
 include_once ("../item/item.php");
class estimateitem{
    public $est_item_id;
    public $estimateid;
    public $est_item_cat;
    public $est_item_name;
    public $est_item_karat;
    public $est_item_weight;
    public $est_item_qty;
    public $est_item_int;
    public $est_item_mv;
    public $est_item_asv; 
    public $est_item_rv;
    public $est_item_status;
    public $itemcat;
    public $itemname;
    public $db;


    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }

    function insertestimateitem($estimateid){
        $list=0;
        foreach($_POST["cat"] as $item){

            $sql="INSERT INTO  estimate_item (est_item_cat,est_item_name,est_item_weight,est_item_karat,est_item_mv,est_item_int,est_item_rv,est_item_asv,estimateid) VALUES ('".$_POST['cat'][$list]."' , '".$_POST['item'][$list]."','".$_POST['wt'][$list]."' , '".$_POST['kar'][$list]."','".$_POST['mkv'][$list]."','".$_POST['pint'][$list]."','".$_POST['rvt'][$list]."','".$_POST['ploan'][$list]."',$estimateid)";
            echo $sql;
            $this->db->query($sql);
            $list++;
        }
        return true;
    }  

    function getitem_by_estimateid($estimateid){
         $sql="SELECT * FROM estimate_item WHERE estimateid='$estimateid' ";
         //echo $sql;
         $result=$this->db->query($sql);
         $est_item_array=array();

         while($row=$result->fetch_array()){
         $est_item=new estimateitem();
         $est_itemcat=new category();
         $est_itemname=new item();

         $est_item->est_item_id=$row["est_item_id"];
         $est_item->estimateid=$row["estimateid"];
         $est_item->est_item_cat=$row["est_item_cat"];
         $est_item->itemcat=$est_itemcat->getbyid_category($est_item->est_item_cat);
         $est_item->est_item_name=$row["est_item_name"];
         $est_item->itemname=$est_itemname->getitem_by_id($est_item->est_item_name);
         $est_item->est_item_karat=$row["est_item_karat"];
         $est_item->est_item_weight=$row["est_item_weight"];
         $est_item->est_item_qty=$row["est_item_qty"];
         $est_item->est_item_mv=$row["est_item_mv"];
         $est_item->est_item_int=$row["est_item_int"];
         $est_item->est_item_asv=$row["est_item_asv"];
         $est_item->est_item_rv=$row["est_item_rv"];
         $est_item->est_item_status=$row["est_item_status"];

         $est_item_array[]=$est_item;
         }
        return   $est_item_array;

    }


    

    



}

?>