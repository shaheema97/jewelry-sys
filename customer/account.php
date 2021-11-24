<?php
include_once ("../files/config.php");
    class account{
        public $account_id;
        public $account_cusid;
        public $account_credit;
        public $account_debit;
        public $account_date;
        public $db;

        
    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }

    function insert_creditamount(){
        $sql="INSERT INTO customer_account(account_cusid,account_credit) VALUES('$this->account_cusid','$this->account_credit')";
        echo $sql; 
        $this->db->query($sql);
        return true;
    }

    function insert_debitamount(){
        $sql="INSERT INTO customer_account(account_cusid,account_debit) VALUES('$this->account_cusid','$this->account_debit')";
       // echo $sql; 
        $this->db->query($sql);
        return true;
    } 
    function cal_tot_credit($cusid){
        $sql="SELECT  SUM(customer_account.account_credit) AS totalcredit ,SUM(customer_account.account_debit) AS totaldebit FROM  customer_account WHERE account_cusid=$cusid GROUP BY customer_account.account_cusid";

        //echo $sql;
        $res=$this->db->query($sql);
        $row=$res->fetch_array();

        $acc_detail=new account();

        
        $acc_detail->credit_tot=$row["totalcredit"];
        $acc_detail->debit_tot=$row["totaldebit"];
        $acc_detail->final_amout=($acc_detail->debit_tot)-($acc_detail->credit_tot);

         return $acc_detail;

    }
    }

?>