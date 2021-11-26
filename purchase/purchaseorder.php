<?php 
    include_once ("../files/config.php");
    include_once ("../supplier/supplier.php");
    include_once ("../staff/staff.php");
    include_once ("../payment/payment.php");
   class purchaseorder{
       public $purchorder_id;
       public $purchorder_supp;
       public $purchorder_emp;
       public $purchorder_date;
       public $purchorder_status;
       public $purchorder_work_status;
       public $emp_name;
       public $supp_name;
       public $db;
      
       //function for db connection
       function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }
    
       //function to insert data
       function insert_purchorder(){
        $sql="INSERT INTO purchase_order (purchorder_supp,purchorder_emp,purchorder_date) VALUES ('$this->purchorder_supp','$this->purchorder_emp','$this->purchorder_date')";
        $this->db->query($sql);
        $id=$this->db->insert_id;
        
        return $id;


       }
       //function-->get data when status is acive (loop)
       function get_all_purchorder(){
           $sql="SELECT * FROM purchase_order WHERE purchorder_status='ACTIVE' ";
           $res=$this->db->query($sql);
           $purch_arr=array();
           while($row=$res->fetch_array()){
            
            $supplier=new supplier();
            $purchorder_1=new purchaseorder();
            $emp=new staff();
            $purchorder_1->purchorder_id=$row["purchorder_id"];
            $purchorder_1->purchorder_supp=$row["purchorder_supp"];
            $purchorder_1->supp_name=$supplier->get_supp_byid($purchorder_1->purchorder_supp);
            $purchorder_1->purchorder_emp=$row["purchorder_emp"];
            $purchorder_1->emp_name=$emp->get_all_byid($purchorder_1->purchorder_emp);
            $purchorder_1->purchorder_date=$row["purchorder_date"];
            $purchorder_1->purchorder_status=$row["purchorder_status"];
            $purchorder_1->purchorder_work_status=$row["purchorder_work_status"];

           $purch_arr[]= $purchorder_1;

    

           }
           return $purch_arr;


       }

       function get_all_purchorder_byidd(){
        $sql="SELECT * FROM purchase_order WHERE purchorder_status='ACTIVE' ";
        $res=$this->db->query($sql);
        $purch_arr=array();
        while($row=$res->fetch_array()){
         
         $supplier=new supplier();
         $purchorder_1=new purchaseorder();
         $emp=new staff();
         $purchorder_1->purchorder_id=$row["purchorder_id"];
         $purchorder_1->purchorder_supp=$row["purchorder_supp"];
         $purchorder_1->supp_name=$supplier->get_supp_byid($purchorder_1->purchorder_supp);
         $purchorder_1->purchorder_emp=$row["purchorder_emp"];
         $purchorder_1->emp_name=$emp->get_all_byid($purchorder_1->purchorder_emp);
         $purchorder_1->purchorder_date=$row["purchorder_date"];
         $purchorder_1->purchorder_status=$row["purchorder_status"];
         $purchorder_1->purchorder_work_status=$row["purchorder_work_status"];

        $purch_arr[]= $purchorder_1;

 

        }
        return $purch_arr;
    }
       //function-->get data when status is acive (loop) with filter
       function filter_purchorder(){
           $filter_sup=$_POST['filter_sup'];
           $filter_orderid=$_POST['filter_id'];
           $filter_emp=$_POST['filter_emp'];
           $filter_st_date=$_POST['filter_stdate'];
           $filter_en_date=$_POST['filter_endt'];
           $filter_status=$_POST['filter_status'];


           $sql="SELECT * FROM purchase_order WHERE purchorder_status='ACTIVE' ";

        if($filter_sup != -1){
            $sql.=" and purchorder_supp='$filter_sup'";
        }
        if($filter_orderid != ''){
            $sql.=" and purchorder_id='$filter_orderid'";
        }
        if($filter_emp != -1){
            $sql.=" and purchorder_emp='$filter_emp'";
        }
        if($filter_st_date != '' && $filter_en_date!=''){
            $sql.=" and purchorder_date BETWEEN '".$_POST['filter_stdate']."' AND '".$_POST['filter_endt']."' " ;
        }
        if($filter_status != -1){
            $sql.=" and purchorder_status='$filter_status'";
        }
      
        $res=$this->db->query($sql);
        $purch_arr=array();
        while($row=$res->fetch_array()){
         
         $supplier=new supplier();
         $purchorder_1=new purchaseorder();
         $emp=new staff();
         $purchorder_1->purchorder_id=$row["purchorder_id"];
         $purchorder_1->purchorder_supp=$row["purchorder_supp"];
         $purchorder_1->supp_name=$supplier->get_supp_byid($purchorder_1->purchorder_supp);
         $purchorder_1->purchorder_emp=$row["purchorder_emp"];
         $purchorder_1->emp_name=$emp->get_all_byid($purchorder_1->purchorder_emp);
         $purchorder_1->purchorder_date=$row["purchorder_date"];
         $purchorder_1->purchorder_status=$row["purchorder_status"];
         $purchorder_1->purchorder_work_status=$row["purchorder_work_status"];

        $purch_arr[]= $purchorder_1;

 

        }
        return $purch_arr;
    }


       //function -->get data when order id is given
       function get_all_purch_byorderid($orderid){
        $sql="SELECT * FROM purchase_order WHERE purchorder_id='$orderid' ";
        $res=$this->db->query($sql);
        $row=$res->fetch_array();
       
        $purchorder_1=new purchaseorder();
         $supplier=new supplier();
         $emp=new staff();
         $purchorder_1->purchorder_id=$row["purchorder_id"];
         $purchorder_1->purchorder_supp=$row["purchorder_supp"];
         $purchorder_1->supp_name=$supplier->get_supp_byid( $purchorder_1->purchorder_supp);
         $purchorder_1->purchorder_emp=$row["purchorder_emp"];
         $purchorder_1->emp_name=$emp->get_all_byid($purchorder_1->purchorder_emp);
         $purchorder_1->purchorder_date=$row["purchorder_date"];
         $purchorder_1->purchorder_status=$row["purchorder_status"];
         $purchorder_1->purchorder_work_status=$row["purchorder_work_status"];

       return $purchorder_1;
    }
       //function -->get data when supp id is given
       function get_all_purch_bysupid($supid){
        $sql="SELECT * FROM purchase_order WHERE purchorder_supp='$supid' ";
        $res=$this->db->query($sql);
        $row=$res->fetch_array();
       
        $purchorder_1=new purchaseorder();
         $supplier=new supplier();
         $emp=new staff();
         $purchorder_1->purchorder_id=$row["purchorder_id"];
         $purchorder_1->purchorder_supp=$row["purchorder_supp"];
         $purchorder_1->supp_name=$supplier->get_supp_byid($purch_1->purchase_supp);
         $purchorder_1->purchorder_emp=$row["purchorder_emp"];
         $purchorder_1->emp_name=$emp->get_all_byid($purch_1->purchase_emp);
         $purchorder_1->purchorder_date=$row["purchorder_date"];
         $purchorder_1->purchorder_status=$row["purchorder_status"];
         $purchorder_1->purchorder_work_status=$row["purchorder_work_status"];

       return $purchorder_1;
    }


       //function -->get data when supp id is given for multiple orders(loops)
       function get_all_supid_2(){
        $sql="SELECT * FROM purchase_order WHERE purchorder_supp='$supid' ";
        $res=$this->db->query($sql);
        $purch_arr=array();
        while($row=$res->fetch_array()){
         $purch_1=new purchase();
         $supplier=new supplier();
         $emp=new staff();
         $purchorder_1->purchorder_id=$row["purchorder_id"];
         $purchorder_1->purchorder_supp=$row["purchorder_supp"];
         $purchorder_1->supp_name=$supplier->get_supp_byid($purch_1->purchase_supp);
         $purchorder_1->purchorder_emp=$row["purchorder_emp"];
         $purchorder_1->emp_name=$emp->get_all_byid($purch_1->purchase_emp);
         $purchorder_1->purchorder_date=$row["purchorder_date"];
         $purchorder_1->purchorder_status=$row["purchorder_status"];
         $purchorder_1->purchorder_work_status=$row["purchorder_work_status"];

        $purch_arr[]= $purchorder_1;

 

        }
        return $purch_arr;
    }

       //function to edit order
       function edit_purchorder($edit_id){
           $sql="UPDATE purchase_order SET purchorder_supp='$this->purchorder_supp', purchorder_emp='$this->purchorder_emp', purchorder_date='$this->purchorder_date', purchorder_work_status='$this->purchorder_work_status' WHERE purchorder_id='$edit_id' ";
           $this->db->query($sql);
          echo $sql;
        }

       //function to delete temporarily
       function del_order(){
           $sql="UPDATE purchase_order SET purchorder_status='INACTIVE' ";
           $this->db->query($sql);
           echo $sql; 
       }
       //function to delete permanantly



   }
?>