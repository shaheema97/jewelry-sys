<?php
include_once ("../files/config.php");
include_once ("../customer/cust.php");
include_once ("../staff/staff.php");
include_once ("../payment/payment.php");
include_once ("../sales/salesreturn.php");
class sales{
    public $sales_id;
    public $sales_cus;
    public $sales_emp;
    public $sales_date;
    public $sales_qty;
    public $sales_subtot;
   public $sales_totdisc;
    public $sales_nettot;
    public $sales_status;
    public $sales_paid_amt;
    public $sales_due_amt;
    public $cust_name;
    public $emp_name;

    public $db;

    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }

    function insert_sales(){
        $sql="INSERT INTO sales (sales_cus,sales_emp,sales_date,sales_qty,sales_subtot,sales_totdisc,sales_nettot,sales_due_amt) VALUES ('$this->sales_cus','$this->sales_emp','$this->sales_date','$this->sales_qty','$this->sales_subtot','$this->sales_totdisc','$this->sales_nettot','$this->sales_nettot')";
        echo $sql;
        $this->db->query($sql);
        $id=$this->db->insert_id; //insert_id is a php term do not change it

        return $id;


    }



    function getall_sales(){
        $sql="SELECT * FROM sales WHERE sales_status='ACTIVE'";
        $result=$this->db->query($sql);
        $salesarray=array();
        while($row=$result->fetch_array()){

            $sales1=new sales();
            $cust=new cust();
            $emp=new staff();

            $sales1->sales_id=$row["sales_id"];
            $sales1->sales_cus=$row["sales_cus"];
            $sales1->cust_name=$cust->get_cus_id($sales1->sales_cus);
            $sales1->sales_emp=$row["sales_emp"];
            $sales1->emp_name=$emp-> get_all_byid($sales1->sales_emp);
            $sales1->sales_date=$row["sales_date"];
            $sales1->sales_qty=$row["sales_qty"];
            $sales1->sales_subtot=$row["sales_subtot"];
           
            $sales1->sales_totdisc=$row["sales_totdisc"];
            $sales1->sales_nettot=$row["sales_nettot"];
            $sales1->sales_status=$row["sales_status"];
            $sales1->sales_paid_amt=$row["sales_paid_amt"];
            $sales1->sales_due_amt=$row["sales_due_amt"];
            
            $salesarray[]=$sales1;

        }
        return $salesarray;
    }


    function search_sales()
    {
        $sales_srtdt=$_POST["sales_srtdt"];
        $sales_endt=$_POST["sales_endt"];
        $salesid=$_POST["salesid"];
        $filter_sales_cust=$_POST["filter_sales_cust"];
        $filter_sales_emp=$_POST["filter_sales_emp"];

        $sql="SELECT * FROM sales WHERE sales_status='ACTIVE' ";
        
        if($salesid!='') {
            $sql.="and sales_id='$salesid'";
        }
        if($filter_sales_cust!=-1) {
            $sql.="and sales_cus='$filter_sales_cust'";
        }
        if($filter_sales_emp!=-1) {
            $sql.="and sales_emp='$filter_sales_emp'";
        }
        if($sales_srtdt!='' &&  $sales_endt!='' )
        {
            $sql.="and sales_date BETWEEN '".$_POST['sales_srtdt']."' AND '".$_POST['sales_endt']."' "; 
        }
        if($sales_srtdt!=''){
            $sql.="and sales_date='$sales_srtdt'";
        }
       
        echo $sql;
        $result=$this->db->query($sql);
        $salesarray=array();
        while($row=$result->fetch_array()){

            $sales1=new sales();
            $cust=new cust();
            $emp=new staff();

            $sales1->sales_id=$row["sales_id"];
            $sales1->sales_cus=$row["sales_cus"];
            $sales1->cust_name=$cust->get_cus_id($sales1->sales_cus);
            $sales1->sales_emp=$row["sales_emp"];
            $sales1->emp_name=$emp-> get_all_byid($sales1->sales_emp);
            $sales1->sales_date=$row["sales_date"];
            $sales1->sales_qty=$row["sales_qty"];
            $sales1->sales_subtot=$row["sales_subtot"];
           
            $sales1->sales_totdisc=$row["sales_totdisc"];
            $sales1->sales_nettot=$row["sales_nettot"];
            $sales1->sales_status=$row["sales_status"];
            $sales1->sales_paid_amt=$row["sales_paid_amt"];
            $sales1->sales_due_amt=$row["sales_due_amt"];
            
            $salesarray[]=$sales1;

        }
        return $salesarray;


    }
    function getsales_by_id($salesid){
        $sql="SELECT * FROM sales WHERE sales_id='$salesid'";
         //echo $sql;
        $result=$this->db->query($sql);
        $row=$result->fetch_array();
        $sales1=new sales();
        $cust=new cust();
        $emp=new staff();
        $refund=new salesreturn();

        $sales1->sales_id=$row["sales_id"];
        $sales1->sales_cus=$row["sales_cus"];
        $sales1->cust_name=$cust->get_cus_id($sales1->sales_cus);
        $sales1->sales_emp=$row["sales_emp"];
        $sales1->emp_name=$emp-> get_all_byid($sales1->sales_emp);
        $sales1->sales_date=$row["sales_date"];
        $sales1->sales_qty=$row["sales_qty"];
        $sales1->sales_subtot=$row["sales_subtot"];
        
        $sales1->sales_totdisc=$row["sales_totdisc"];
        $sales1->sales_nettot=$row["sales_nettot"];
        //$sales1->salesrefund=$refund->get_salesreturn_saleid($sales1->sales_id); //causing a fetch array error
        //$sales1->total=$sales1->sales_nettot - $sales1->salesrefund->salesreturn_amount;
        $sales1->sales_status=$row["sales_status"];
        $sales1->sales_paid_amt=$row["sales_paid_amt"];
        $sales1->sales_due_amt=$row["sales_due_amt"];

        return $sales1;


    }

    function delete_sales($del_salesid){
        $sql="UPDATE sales SET sales_status='INACTIVE' WHERE sales_id='$del_salesid'";
        $this->db->query($sql);

    }

    function update_sales($edit_salesid){
        $sql="UPDATE sales SET sales_cus='$this->sales_cus',sales_emp='$this->sales_emp',sales_date='$this->sales_date',sales_subtot='$this->sales_subtot',sales_totdisc='$this->sales_totdisc',sales_nettot='$this->sales_nettot'";
        echo $sql; 
        $this->db->query($sql);

    }

    function update_pay_amount($salesid,$amt){
        $pay3=new payment();
        $res=$pay3->get_pay_by_saleid($salesid);
        

        $sql="UPDATE sales SET  sales_paid_amt=sales_paid_amt + $amt , sales_due_amt=sales_nettot-sales_paid_amt WHERE sales_id=$salesid";
        echo $sql;
        $this->db->query($sql);
    }

    function cal_paytot_sales($typeid){
    $sql="SELECT *, SUM(payment.pay_amount) AS totalpay FROM sales left join payment on sales.sales_id=payment.pay_type_id WHERE  sales_id=$typeid or (pay_type_id=$typeid and pay_type='Sales')  GROUP BY payment.pay_type_id";
    $res=$this->db->query($sql);
    $row=$res->fetch_array();
    // echo $sql; 
     $sales1=new sales();
     $cust=new cust();
     $emp=new staff();

     $sales1->sales_id=$row["sales_id"];
     $sales1->sales_cus=$row["sales_cus"];
     $sales1->cust_name=$cust->get_cus_id($sales1->sales_cus);
     $sales1->sales_emp=$row["sales_emp"];
     $sales1->emp_name=$emp-> get_all_byid($sales1->sales_emp);
     $sales1->sales_date=$row["sales_date"];
     $sales1->sales_qty=$row["sales_qty"];
     $sales1->sales_subtot=$row["sales_subtot"];

     $sales1->sales_totdisc=$row["sales_totdisc"];
     $sales1->sales_nettot=$row["sales_nettot"];
     $sales1->sales_status=$row["sales_status"];
     $sales1->sales_paid_amt=$row["totalpay"];
     $sales1->sales_due_amt=$sales1->sales_nettot-$sales1->sales_paid_amt;
     

     return $sales1;

    }

    function sum_sales(){
        $sql="SELECT sales_date, SUM(sales.sales_nettot) AS income FROM sales WHERE sales_status='ACTIVE' GROUPBY date(sales_date) ";
        $res=$this->db->query($sql);
     
        $sales1=new sales();
        $salesarray=array();
        while($row=$res->fetch_array()){
            $sales1->tot_income=$row["income"];
            $sales1->date=$row["sales_date"];

            $salesarray[]=$sales1;
        }


       
        return $salesarray;
    }

    function update_nett_tot($salesid, $amt ){
        $sql="UPDATE sales SET  sales_nettot=sales_nettot - $amt  WHERE sales_id=$salesid";
        $this->db->query($sql);
        return true;
    }

    function num_invoice(){
       
            $sql="SELECT * FROM sales WHERE sales_status='ACTIVE' " ;
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