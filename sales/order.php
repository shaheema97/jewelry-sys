<?php
include_once ("../files/config.php");
include_once ("../customer/cust.php");
include_once ("../staff/staff.php");
class order{
    public $order_id;
    public $order_cus;
    public $order_emp;
    public $order_date;
    public $order_duedate;
    public $order_status;
    public $order_workstatus;
    public $order_goldrate;
    
    // public $tcolor;
    private $db;


function __construct(){
    $this->db=new mysqli(host,un,pw,db1);
}

function insert_order(){
    $sql="INSERT INTO orders (order_cus,order_emp,order_date,order_duedate,order_goldrate) VALUES ('$this->order_cus','$this->order_emp','$this->order_date','$this->order_duedate','$this->order_goldrate')";
    //echo $sql; 
    $this->db->query($sql);
    $id=$this->db->insert_id;

    return $id;
}
function getall_order(){
    $sql="SELECT * from orders WHERE order_status='ACTIVE'";
    $result=$this->db->query($sql);
    $orderarray=array();
    while($row=$result->fetch_array()){
        $order2=new order();
        $cus_order=new cust();
        $emp_order=new staff();

        $order2->order_id=$row["order_id"];
        $order2->order_cus=$row["order_cus"];
        $order2->order_cus_name=$cus_order->get_cus_id($order2->order_cus);
        $order2->order_emp=$row["order_emp"];
        $order2->order_emp_name=$emp_order->get_all_byid($order2->order_emp);
        $order2->order_date=$row["order_date"];
        $order2->order_duedate=$row["order_duedate"];
        $order2->order_status=$row["order_status"];
        $order2->order_workstatus=$row["order_workstatus"];
        $order2->order_goldrate=$row["order_goldrate"];
       
        if($row["order_workstatus"]=='NEW'){
            $order2->tcolor ="red";
        }

        $orderarray[]=$order2;
    }

    return $orderarray; 
}
    function getall_order_byid($orderid){
        $sql="SELECT * from orders WHERE order_id='$orderid'";
        $result=$this->db->query($sql);
        $row=$result->fetch_array();
        
            $order2=new order();
            $cus_order=new cust();
            $emp_order=new staff(); 
    
            $order2->order_id=$row["order_id"];
            $order2->order_cus=$row["order_cus"];
            $order2->order_cus_name=$cus_order->get_cus_id($order2->order_cus);
            $order2->order_emp=$row["order_emp"];
            $order2->order_emp_name=$emp_order->get_all_byid($order2->order_emp);
            $order2->order_date=$row["order_date"];
            $order2->order_duedate=$row["order_duedate"];
            $order2->order_status=$row["order_status"];
            $order2->order_workstatus=$row["order_workstatus"];
            $order2->order_goldrate=$row["order_goldrate"];
          
    
          
    
        return $order2;
    }

        function order_edit($editorderid){
            $sql="UPDATE orders SET order_cus='$this->order_cus',order_emp='$this->order_emp',order_date='$this->order_date',order_duedate='$this->order_duedate',order_finalprice='$this->order_finalprice' WHERE order_id='$editorderid' ";
            echo $sql; 
            $this->db->query($sql);

        }

        function order_delete($delorderid){
            $sql="UPDATE orders SET order_status='INACTIVE' WHERE order_id='$delorderid'";
            $this->db->query($sql);

        }

        function filterorders(){
        $filter_cus=$_POST['filter_cus'];
        $filter_staff=$_POST['filter_staff'];
        
        $filter_id=$_POST['filter_id'];
        $filter_stdt=$_POST['filter_stdt'];
        $filter_endt=$_POST['filter_endt'];
        $filter_status=$_POST['filter_status'];

        $sql="SELECT * FROM orders WHERE order_status='ACTIVE'   ";
        // if($filter_stdt!='' )
        // {
        //     $sql.=" and pawn_dt='$filter_stdt'";
        // }
        
        if($filter_cus!=-1) {
            $sql.=" and order_cus='$filter_cus'";
        }
        if($filter_staff!=-1) {
            $sql.=" and order_emp='$filter_staff'";
        }
        if($filter_status!=-1) {
            $sql.=" and order_workstatus='$filter_status'";
        }
        if($filter_stdt!='' &&  $filter_endt!='' )
        {
            $sql.="and order_date BETWEEN  '".$_POST['filter_stdt']."' AND '".$_POST['filter_endt']."' "; 
        }
       
        if($filter_id!='')
        {
            $sql.=" and order_id='$filter_id'";
        }
        if($filter_stdt!=''){
            $sql.=" and order_date='$filter_stdt'";
        }

        $result=$this->db->query($sql);
        $orderarray=array();
        while($row=$result->fetch_array()){
            $order2=new order();
            $cus_order=new cust();
            $emp_order=new staff();
    
            $order2->order_id=$row["order_id"];
            $order2->order_cus=$row["order_cus"];
            $order2->order_cus_name=$cus_order->get_cus_id($order2->order_cus);
            $order2->order_emp=$row["order_emp"];
            $order2->order_emp_name=$emp_order->get_all_byid($order2->order_emp);
            $order2->order_date=$row["order_date"];
            $order2->order_duedate=$row["order_duedate"];
            $order2->order_status=$row["order_status"];
            $order2->order_workstatus=$row["order_workstatus"];
            $order2->order_goldrate=$row["order_goldrate"];
           
    
            $orderarray[]=$order2;

        }
    return  $orderarray;
    }

    function del_order($delid){
        $sqlcheck="SELECT * FROM orders WHERE order_id=$delid AND order_status='ACTIVE'";
        $result=$this->db->query($sqlcheck);
        //echo $sqlcheck; 
        $row=$result->fetch_array();
       
        $order2=new order();
        $order2->order_workstatus=$row["order_workstatus"];
       
        //$num=$result->num_rows;
        //echo $num;
    if($row["order_workstatus"]=='NEW'){

        $sql="UPDATE orders SET order_status='INACTIVE' where  order_id=$delid";
        $this->db->query($sql);
       echo $sql;
        return true;
    }
        else 
        //echo "no rows";
        return false;
        
    }

    function order_month(){
        $sql="SELECT * FROM orders WHERE order_status='ACTIVE' AND year(now())=year(order_date) AND month(now())=month(order_date)" ;
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


    function oder_sales_status($delid){
        $sql="UPDATE orders SET order_status='INACTIVE' where  order_id=$delid";
        $this->db->query($sql);
      // echo $sql;
        return true;
    }

    function oder_ws_status($delid){
        $sql="UPDATE orders SET order_workstatus='PROCESSING' where  order_id=$delid";
        $this->db->query($sql);
      // echo $sql;
        return true;
    }

}

?> 