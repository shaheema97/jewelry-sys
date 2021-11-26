<?php
include_once ("../files/config.php");
include_once ("../customer/cust.php");
include_once ("../staff/staff.php");
include_once ("../payment/payment.php");
class oldgold{
    public $oldgold_id;
    public $oldgold_cus;
    public $oldgold_emp;
    public $oldgold_date;
    public $oldgold_qty;
    public $oldgold_subtot;
    public $oldgold_nettot;
    public $oldgold_redtot;
    public $oldgold_status; 
    public $oldgold_paidamt;
    public $cusname;
    public $stname;
    public $db;

    
    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }
    function insert_oldgold(){
        $sql="INSERT INTO oldgold (oldgold_cus,oldgold_emp,oldgold_date,oldgold_qty,oldgold_subtot,oldgold_nettot,oldgold_redtot) VALUES ('$this->oldgold_cus','$this->oldgold_emp','$this->oldgold_date','$this->oldgold_qty','$this->oldgold_subtot','$this->oldgold_nettot','$this->oldgold_redtot')";
        echo $sql;
        $this->db->query($sql);
        $id=$this->db->insert_id; //insert_id is a php term do not change it

        return $id;


    }

    function getall_oldgold(){

        $sql="SELECT * FROM oldgold WHERE oldgold_status='ACTIVE'";
        $res=$this->db->query($sql);
        $og_array=array();
        while($row=$res->fetch_array()){
            $oldgold2=new oldgold(); 
            $ogcus=new cust();
            $ogemp=new staff();

            $oldgold2->oldgold_id=$row["oldgold_id"];
            $oldgold2->oldgold_cus=$row["oldgold_cus"];
            $oldgold2->cusname=$c->get_cus_id($oldgold2->pawn_cus);
            $oldgold2->oldgold_emp=$row["oldgold_emp"];
            $oldgold2->stname=$s->get_all_byid($oldgold2->pawn_em);
            $oldgold2->oldgold_date=$row["oldgold_date"];
            $oldgold2->oldgold_qty=$row["oldgold_qty"];
            $oldgold2->oldgold_subtot=$row["oldgold_subtot"];
            $oldgold2->oldgold_nettot=$row["oldgold_nettot"];
            $oldgold2->oldgold_redtot=$row["oldgold_redtot"];
            $oldgold2->oldgold_status=$row["oldgold_status"];
            
            $og_array[]=$oldgold2;

        }
        return $og_array;
    }

    function getall_oldgold_item($itemid){
//oldgold.* == select all colomns from oldgoldtable
        //$sql="SELECT * FROM oldgold WHERE oldgold_status='ACTIVE'";
        $sql="SELECT * FROM oldgold join oldgolditem on oldgold.oldgold_id=oldgolditem.ogitem_oldgoldid join item on oldgolditem.ogitem_oldgoldid=item.item_type_id WHERE oldgold_id='$itemid' ";
        $res=$this->db->query($sql);
 //echo $sql;
        $og_array=array();
        while($row=$res->fetch_array()){
            $oldgold2=new oldgold(); 
            $ogcus=new cust();
            $ogemp=new staff();

            $oldgold2->oldgold_id=$row["oldgold_id"];
            $oldgold2->condition=$row["ogitem_condition"];
            $oldgold2->name=$row["item_name"];
            $oldgold2->purity=$row["item_purity"];
            $oldgold2->nettweight=$row["item_grosswt"];
            $oldgold2->size=$row["item_size"];
            $oldgold2->unit=$row["item_unit"];
            $oldgold2->price=$row["ogitem_totprice"];
            $oldgold2->reduce_price=$row["ogitem_redprice"];
            $oldgold2->finalprice=$row["ogitem_nettprice"];
            // $oldgold2->cusname=$c->get_cus_id($oldgold2->pawn_cus);
            // $oldgold2->oldgold_emp=$row["oldgold_emp"];
            // $oldgold2->stname=$s->get_all_byid($oldgold2->pawn_em);
            // $oldgold2->oldgold_date=$row["oldgold_date"];
            // $oldgold2->oldgold_qty=$row["oldgold_qty"];
            // $oldgold2->oldgold_subtot=$row["oldgold_subtot"];
            // $oldgold2->oldgold_nettot=$row["oldgold_nettot"];
            $oldgold2->oldgold_redtot=$row["oldgold_redtot"];
            $oldgold2->oldgold_status=$row["oldgold_status"];
            
            $og_array[]=$oldgold2;

        }
        return $og_array;
    }

    function getbyid($ogid){
        $sql="SELECT * FROM oldgold WHERE oldgold_status='ACTIVE' AND oldgold_id=$ogid";
        $res=$this->db->query($sql);
        $row=$res->fetch_array();

        $oldgold2=new oldgold();
        $ogcus=new cust();
        $ogemp=new staff();

        $oldgold2->oldgold_id=$row["oldgold_id"];
        $oldgold2->oldgold_cus=$row["oldgold_cus"];
        $oldgold2->cusname=$ogcus->get_cus_id($oldgold2->oldgold_cus);
        $oldgold2->oldgold_emp=$row["oldgold_emp"];
        $oldgold2->stname=$ogemp->get_all_byid($oldgold2->oldgold_emp);
        $oldgold2->oldgold_date=$row["oldgold_date"];
        $oldgold2->oldgold_qty=$row["oldgold_qty"];
        $oldgold2->oldgold_subtot=$row["oldgold_subtot"];
        $oldgold2->oldgold_nettot=$row["oldgold_nettot"];
        $oldgold2->oldgold_redtot=$row["oldgold_redtot"];
        $oldgold2->oldgold_status=$row["oldgold_status"];
        
        return   $oldgold2;


    }

    function del_oldgold($delid){
        $sql="UPDATE oldgold SET oldgold_status='INACTIVE' where oldgold_id='$delid'";
                $this->db->query($sql);
                return true;
                
    }
    }
?>