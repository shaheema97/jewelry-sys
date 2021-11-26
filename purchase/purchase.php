<?php 
 include_once ("../files/config.php");
 include_once ("../supplier/supplier.php");
 include_once ("../staff/staff.php");
 include_once ("../payment/payment.php");

class purchase{
 public $purchase_id;
 public $purchase_supp; 
 public $purchase_emp;
 public $purchase_date;
 public $purchase_qty;
 public $purchase_stoneamt;
 public $purchase_subtot;
 public $purchase_nettot;
 public $purchase_status;
 public $purchase_payment;
 public $payment_status;
 public $purchase_pay_duedt;
 public $purchase_paid_amt;
 public $purchase_due_amt;
 public $emp_name;
 public $supp_name;
 public $db;


 function __construct(){
    $this->db=new mysqli(host,un,pw,db1);
}

function insert_purchase(){
    $sql="INSERT INTO purchase (purchase_supp,purchase_emp,purchase_date,purchase_payment,purchase_pay_duedt,purchase_subtot,purchase_stoneamt,purchase_nettot) VALUES ('$this->purchase_supp','$this->purchase_emp','$this->purchase_date','$this->purchase_payment' ,'$this->purchase_pay_duedt','$this->purchase_subtot','$this->purchase_stoneamt','$this->purchase_nettot')";
    $this->db->query($sql);
    $id=$this->db->insert_id; //insert_id is a php term do not change it

    return $id;

}
//function to display data when status is active
function get_all_purchase(){
    $sql="SELECT * FROM purchase WHERE purchase_status='ACTIVE' ";
    $result=$this->db->query($sql);
    $purch_arr=array();

    while($row=$result->fetch_array()){
        $purch_1=new purchase();
        $supplier=new supplier();
        $emp=new staff();

        $purch_1->purchase_id=$row["purchase_id"];
        $purch_1->purchase_supp=$row["purchase_supp"];
        $purch_1->supp_name=$supplier->get_supp_byid($purch_1->purchase_supp);
        $purch_1->purchase_emp=$row["purchase_emp"];
        $purch_1->emp_name=$emp->get_all_byid($purch_1->purchase_emp);
        $purch_1->purchase_date=$row["purchase_date"];
        $purch_1->purchase_qty=$row["purchase_qty"];
        $purch_1->purchase_stoneamt=$row["purchase_stoneamt"];
        $purch_1->purchase_subtot=$row["purchase_subtot"];
        $purch_1->purchase_nettot=$row["purchase_nettot"];
        $purch_1->purchase_status=$row["purchase_status"];
        $purch_1->payment_status=$row["payment_status"];
        $purch_1->purchase_payment=$row["purchase_payment"];
        $purch_1->purchase_pay_duedt=$row["purchase_pay_duedt"];
        $purch_1->purchase_paid_amt=$row["purchase_paid_amt"]; 
        $purch_1->purchase_due_amt=$row["purchase_due_amt"];

        $purch_arr[]=$purch_1;
    }
            return $purch_arr;
}

//function to filter dataacording to given criteria

function filter_purchase(){

    $filter_sup=$_POST['filter_purchsupp'];
    $filter_purchid=$_POST['filter_purchin'];
    $filter_emp=$_POST['filter_emp'];
    $filter_st_date=$_POST['filter_stdt'];
    $filter_en_date=$_POST['filter_endt'];


 $sql="SELECT * FROM purchase  WHERE purchase_status='ACTIVE' ";

 if($filter_sup != -1){
     $sql.=" and purchase_supp='$filter_sup'";
 }
 if($filter_purchid != ''){
     $sql.=" and purchase_id='$filter_purchid'";
 }
 if($filter_emp != -1){
     $sql.=" and purchase_emp='$filter_emp'";
 }
 if($filter_st_date != '' &&     $filter_en_date!= ''){
     $sql.=" and purchase_date BETWEEN '".$_POST['filter_stdt']."' AND '".$_POST['filter_endt']."' " ;
 }
  

    echo $sql;
    $result=$this->db->query($sql);
    $purch_arr=array();

    while($row=$result->fetch_array()){
        $purch_1=new purchase();
        $supplier=new supplier();
        $emp=new staff();

        $purch_1->purchase_id=$row["purchase_id"];
        $purch_1->purchase_supp=$row["purchase_supp"];
        $purch_1->supp_name=$supplier->get_supp_byid($purch_1->purchase_supp);
        $purch_1->purchase_emp=$row["purchase_emp"];
        $purch_1->emp_name=$emp->get_all_byid($purch_1->purchase_emp);
        $purch_1->purchase_date=$row["purchase_date"];
        $purch_1->purchase_qty=$row["purchase_qty"];
        $purch_1->purchase_stoneamt=$row["purchase_stoneamt"];
        $purch_1->purchase_subtot=$row["purchase_subtot"];
        $purch_1->purchase_nettot=$row["purchase_nettot"];
        $purch_1->purchase_status=$row["purchase_status"];
        $purch_1->payment_status=$row["payment_status"];
        $purch_1->purchase_payment=$row["purchase_payment"];
        $purch_1->purchase_pay_duedt=$row["purchase_pay_duedt"];
        $purch_1->purchase_paid_amt=$row["purchase_paid_amt"]; 
        $purch_1->purchase_due_amt=$row["purchase_due_amt"];

        $purch_arr[]=$purch_1;
    }
            return $purch_arr;
}

//function to get data by purchase id
function get_by_purchaseid($purchid){
    $sql="SELECT * FROM purchase WHERE purchase_id='$purchid' ";
    $result=$this->db->query($sql);
    $row=$result->fetch_array();

    $purch_1=new purchase();
    $supplier=new supplier();
    $emp=new staff();
    $purch_1->purchase_id=$row["purchase_id"];
    $purch_1->purchase_supp=$row["purchase_supp"];
    $purch_1->supp_name=$supplier->get_supp_byid($purch_1->purchase_supp);
    $purch_1->purchase_emp=$row["purchase_emp"];
    $purch_1->emp_name=$emp->get_all_byid($purch_1->purchase_emp);
    $purch_1->purchase_date=$row["purchase_date"];
    $purch_1->purchase_qty=$row["purchase_qty"];
    $purch_1->purchase_stoneamt=$row["purchase_stoneamt"];
    $purch_1->purchase_subtot=$row["purchase_subtot"];
    $purch_1->purchase_nettot=$row["purchase_nettot"];
    $purch_1->purchase_status=$row["purchase_status"];
    $purch_1->purchase_payment=$row["purchase_payment"];
    $purch_1->purchase_pay_duedt=$row["purchase_pay_duedt"];
    $purch_1->purchase_paid_amt=$row["purchase_paid_amt"]; 
    $purch_1->purchase_due_amt=$row["purchase_due_amt"];
    $this->db->close();
    return $purch_1;
    
}

//function to delete sales 
function deletesale($del_purhid){
    $sql="UPDATE purchase SET purchase_status='INACTIVE' WHERE purchase_id='$del_purhid'";
        $this->db->query($sql);
    
}

//function to update paid and due amount
function update_purchase_payment($purchaseid,$amount){
    $sql="UPDATE purchase SET  purchase_paid_amt=purchase_paid_amt + $amount , purchase_due_amt=purchase_nettot-purchase_paid_amt WHERE purchase_id='$purchaseid'";
    $this->db->query($sql);
    echo $sql;

}

function cal_paytotal(){
    $sql="SELECT * FROM purchase join payment on purchase.purchase_id=payment.pay_type_id WHERE pay_type_id=$typeid and pay_type='Purchase' ";
}

function num_invoice(){
       
    $sql="SELECT * FROM purchase WHERE purchase_status='ACTIVE' " ;
//echo $sql;
$res=$this->db->query($sql);
if($res->num_rows>0){
    $num=$res->num_rows;
    //echo $num;
    return $num;
}else{
return false;
}


}


}

?>