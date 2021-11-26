<?php

include_once ("../files/config.php");
include_once ("../sales/sales.php");
class salesreturn{
    public $salesreturn_id;
    public $salesreturn_salesid;
    public $salereturn_emp;
    public $salesreturn_cus;
    public $salesreturn_date;
    public $salesreturn_amount;
    PUBLIC $salesreturn_status;
    public $db;

     //function to establish connection to the database
     function __construct(){
        //create database connection
        $this->db=new mysqli(host,un,pw,db1);
    }

    function insertsalesreturn(){
        $sql="INSERT INTO sales_return(salesreturn_salesid,salereturn_emp,salesreturn_date,salesreturn_amount) VALUES('$this->salesreturn_salesid','$this->salereturn_emp','$this->salesreturn_date','$this->salesreturn_amount')";
       // echo $sql; 
        $this->db->query($sql);
        $id=$this->db->insert_id;
       
        return $id;
    }

    function getall_salesreturn(){
        $sql="SELECT * FROM sales_return WHERE salesreturn_status='ACTIVE'";
        $result=$this->db->query($sql);
        $return_arr=array();
        while($row=$result->fetch_array()){
            $s_return=new salesreturn();
            $sales1=new sales();
            $emp=new staff();

            $s_return->salesreturn_id=$row["salesreturn_id"];
            $s_return->salesreturn_salesid=$row["salesreturn_salesid"];
            $s_return->sales_details=$sales1->getsales_by_id($s_return->salesreturn_salesid);
            $s_return->salesreturn_status=$row["salesreturn_status"];
            $s_return->salereturn_emp=$row["salereturn_emp"];
            $s_return->return_emp=$emp->get_all_byid( $s_return->salereturn_emp);
            $s_return->salesreturn_amount=$row["salesreturn_amount"];
            $s_return->salesreturn_date=$row["salesreturn_date"];
            $s_return->salesreturn_status=$row["salesreturn_status"];
           
            $return_arr[]=$s_return;

        }
        return $return_arr;
    }
    function get_salesreturn_saleid($saleid){
        $sql="SELECT * FROM sales_return WHERE salesreturn_salesid=$saleid";
        $result=$this->db->query($sql);
        
       $row=$result->fetch_array();
            $s_return=new salesreturn();
            $sales1=new sales();
            $emp=new staff();

            $s_return->salesreturn_id=$row["salesreturn_id"];
            $s_return->salesreturn_salesid=$row["salesreturn_salesid"];
            $s_return->sales_details=$sales1->getsales_by_id($s_return->salesreturn_salesid);
            $s_return->salesreturn_status=$row["salesreturn_status"];
            $s_return->salereturn_emp=$row["salereturn_emp"];
            $s_return->return_emp=$emp->get_all_byid( $s_return->salereturn_emp);
            $s_return->salesreturn_amount=$row["salesreturn_amount"];
            $s_return->salesreturn_date=$row["salesreturn_date"];
            $s_return->salesreturn_status=$row["salesreturn_status"];
           
            
        return $s_return;
    }
}
?>