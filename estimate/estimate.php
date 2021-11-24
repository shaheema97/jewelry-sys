<?php
include_once ("../files/config.php");
include_once ("../customer/cust.php");
include_once ("../staff/staff.php");

class estimate{
    public $estimate_id;
    public $estimate_type;
    public $estimate_cust;
    public $estimate_staff;
    public $estimate_date;
    public $estimate_pawnperiod;
    public $estimate_int;
    public $estimate_intval;
    public $estimate_mvtot;
    public $estimate_avtot;
    public $estimate_rvtot;
    public $estimate_status;
    public $cust_name;
    public $emp_name;
    public $db;

    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }

    function insertestimate(){
        $sql="INSERT INTO estimate(estimate_cust,estimate_staff,estimate_date,estimate_type,estimate_pawnperiod,estimate_int,estimate_intval,estimate_mvtot,estimate_avtot,estimate_rvtot) VALUES ('$this->estimate_cust','$this->estimate_staff','$this->estimate_date','$this->estimate_type ','$this->estimate_pawnperiod','$this->estimate_int','$this->estimate_intval','$this->estimate_mvtot','$this->estimate_avtot','$this->estimate_rvtot')";
        echo $sql; 
        $this->db->query($sql);
        $id=$this->db->insert_id;
       
        return $id;
    }

    function get_estimatebyid($est_id){
        $sql="SELECT * FROM estimate WHERE estimate_id='$est_id' ";
        $res=$this->db->query($sql);
        $row=$res->fetch_array();
        $est_1=new estimate();
        $cust=new cust();
        $emp=new staff();

        $est_1->estimate_id=$row["estimate_id"];
        $est_1->estimate_type=$row["estimate_type"];
        $est_1->estimate_cust=$row["estimate_cust"];
        $est_1->cust_name=$cust->get_cus_id($est_1->estimate_cust);
        $est_1->estimate_staff=$row["estimate_staff"];
        $est_1->emp_name=$emp-> get_all_byid($est_1->estimate_staff);
        $est_1->estimate_date=$row["estimate_date"];
        $est_1->estimate_pawnperiod=$row["estimate_pawnperiod"];
        $est_1->estimate_int=$row["estimate_int"];
        $est_1->estimate_intval=$row["estimate_intval"];
        $est_1->estimate_mvtot=$row["estimate_mvtot"];
        $est_1->estimate_avtot=$row["estimate_avtot"];
        $est_1->estimate_rvtot=$row["estimate_rvtot"];
        $est_1->estimate_status=$row["estimate_status"];

        return $est_1;
    }

    function get_estimate(){
        $sql="SELECT * FROM estimate WHERE estimate_status='ACTIVE' ";
        $res=$this->db->query($sql);
        $est_arr=array();
        while($row=$res->fetch_array()){
        $est_1=new estimate();
        $cust=new cust();
        $emp=new staff();

        $est_1->estimate_id=$row["estimate_id"];
        $est_1->estimate_type=$row["estimate_type"];
        $est_1->estimate_cust=$row["estimate_cust"];
        $est_1->cust_name=$cust->get_cus_id($est_1->estimate_cust);
        $est_1->estimate_staff=$row["estimate_staff"];
        $est_1->emp_name=$emp-> get_all_byid($est_1->estimate_staff);
        $est_1->estimate_date=$row["estimate_date"];
        $est_1->estimate_pawnperiod=$row["estimate_pawnperiod"];
        $est_1->estimate_int=$row["estimate_int"];
        $est_1->estimate_intval=$row["estimate_intval"];
        $est_1->estimate_mvtot=$row["estimate_mvtot"];
        $est_1->estimate_avtot=$row["estimate_avtot"];
        $est_1->estimate_rvtot=$row["estimate_rvtot"];
        $est_1->estimate_status=$row["estimate_status"];

        $est_arr[]=$est_1;
        }
        return $est_arr;
    }








}






?>