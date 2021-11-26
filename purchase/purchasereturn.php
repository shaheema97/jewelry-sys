<?php
class purchasereturn{
    //variables for purchase return item
    public $preturnitem_id ;
    public $preturn_returnid; 
    public $preturn_purchitemid;
    public $preturn_itemid;
    public $preturn_amount;
    public $preturn_status;

    //variables for purchase return
    public $purchreturn_id;
    public $purchreturn_purchid;
    public $purchreturn_emp;
    public $purchreturn_date;
    public $purchreturn_amount;
    public $purchreturn_status;

    public $db;

    function __construct(){
        //create database connection
        $this->db=new mysqli(host,un,pw,db1);
    }

    function insertsalesreturn(){
        $sql="INSERT INTO purchasereturn(purchreturn_purchid,purchreturn_emp,purchreturn_date,purchreturn_amount) VALUES('$this->purchreturn_purchid','$this->purchreturn_emp','$this->purchreturn_date','$this->purchreturn_amount')";
        echo $sql; 
        $this->db->query($sql);
        $id=$this->db->insert_id;
       
        return $id;
    }
    function insert_purchitems($returnid){
        $list=0;
        foreach($_POST["saleid"] as $item) {
            
            $sql="INSERT INTO purchasereturn(preturn_purchitemid,preturn_itemid,preturn_amount,purchreturn_purchid) VALUES ('".$_POST['saleid'][$list]."','".$_POST['item'][$list]."','".$_POST['price'][$list]."',$returnid)";
            echo $sql;
            $this->db->query($sql);
            
            $list++;
        }
        return true;
    }
}

?>