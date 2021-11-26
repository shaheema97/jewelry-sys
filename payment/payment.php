<?php
include_once ("../files/config.php");
include_once ("../customer/cust.php");
include_once ("../staff/staff.php");

class payment{

    public $pay_id;
    public $pay_cust;
    public $pay_status;
    public $pay_date;
    public $pay_type;
    public $pay_type_id;
    public $pay_amount;
    public $pay_change;
    public $pay_persontype;
    public $pay_staff;
    public $db;

    
    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }

    function insert_payment(){
        $sql="INSERT INTO payment (pay_cust,pay_date,pay_type,pay_type_id,pay_amount,pay_persontype,pay_staff) VALUES ('$this->pay_cust','$this->pay_date','$this->pay_type','$this->pay_type_id','$this->pay_amount','$this->pay_persontype','$this->pay_staff')";
        //echo $sql;
        //exit;
        $this->db->query($sql);
            return true;}
    

    function get_pay_by_typeid($typeid,$type ){
        $sql="SELECT * FROM payment WHERE pay_type_id=$typeid AND pay_type='$type' ";
        $result=$this->db->query($sql);
        echo $sql;
        $pay_arr=array();
        while($row=$result->fetch_array()){

        $pay2=new payment();
        $cust=new cust();
        $staff=new staff();


        $pay2->pay_id=$row["pay_id"];
        $pay2->pay_cust=$row["pay_cust"];
        //$pay2->custname=$cust->get_cus_id($pay2->pay_cust);
        $pay2->pay_status=$row["pay_status"];
        $pay2->pay_staff=$row["pay_staff"];
        //$pay2->staffname=$staff->get_all_byid($pay2->pay_staff);
        $pay2->pay_date=$row["pay_date"];
        $pay2->pay_type=$row["pay_type"];
        $pay2->pay_type_id=$row["pay_type_id"];
        $pay2->pay_amount=$row["pay_amount"];
        $pay_arr[]=$pay2;

    }
         return $pay_arr;

    }

    

    






}

?>