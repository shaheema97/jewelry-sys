<?php
    include_once ("../files/config.php");

    class cust
    {
        public $cust_id;
        public $cust_first_nm;
        public $cust_last_nm;
        public $cus_nic;
        public $cust_add;
        public $cust_gen;
        public $cust_dob;
        public $cust_mob1;
        public $cust_mob2;
        public $cust_mail;
        public $cust_nicpic;
        public $cus_regdt;
        public $cus_stt;
        private $db;

        function __construct(){
            $this->db=new mysqli(host,un,pw,db1);
        }
    
        function addcust()
        {
            $sql="INSERT INTO customer (cust_first_nm,cust_last_nm,cus_nic,cust_add,cust_gen,cust_dob,cust_mob1,cust_mob2,cust_mail) VALUES 
            ('$this->cust_first_nm','$this->cust_last_nm','$this->cus_nic','$this->cust_add','$this->cust_gen','$this->cust_dob','$this->cust_mob1','$this->cust_mob2','$this->cust_mail')";
           // echo $sql;
            $this->db->query($sql);
            return true;
        }

        function edit_cust($editid){
            $sql="UPDATE customer SET cust_first_nm='$this->cust_first_nm',cust_last_nm='$this->cust_last_nm', cus_nic='$this->cus_nic' ,cust_add='$this->cust_add',cust_gen='$this->cust_gen',cust_dob='$this->cust_dob',cust_mob1='$this->cust_mob1',cust_mob2='$this->cust_mob2',cust_mail='$this->cust_mail' WHERE cust_id=$editid";
            $this->db->query($sql);
            //echo $sql;
            return true;
        }

        function get_all_cus()
        {
            $sql="SELECT * FROM customer WHERE cus_stt='ACTIVE'";
            $result=$this->db->query($sql);

            $custarr=array();
            while($row=$result->fetch_array())
                { 
                    $cust3=new cust();
                    $cust3->cust_id=$row["cust_id"];
                    $cust3->cust_first_nm=$row["cust_first_nm"];
                    $cust3->cust_last_nm=$row["cust_last_nm"];
                    $cust3->cus_nic=$row["cus_nic"];
                    $cust3->cust_add=$row["cust_add"];
                    $cust3->cust_gen=$row["cust_gen"];
                    $cust3->cust_dob=$row["cust_dob"];
                    $cust3->cust_mob1=$row["cust_mob1"];
                    $cust3->cust_mob2=$row["cust_mob2"];
                    $cust3->cust_mail=$row["cust_mail"];
                    $cust3->cust_cust_nicpic=$row["cust_nicpic"];

                    $custarr[]=$cust3;

                }
                $this->db->close();
                return $custarr;

        }

        function get_all_cus_byid($id)
        {
            $sql="SELECT * FROM customer WHERE cus_stt='ACTIVE' AND cust_id=$id";
            $result=$this->db->query($sql);
            $row=$result->fetch_array();
                
                    $cust3=new cust();
                    $cust3->cust_id=$row["cust_id"];
                    $cust3->cust_first_nm=$row["cust_first_nm"];
                    $cust3->cust_last_nm=$row["cust_last_nm"];
                    $cust3->cus_nic=$row["cus_nic"];
                    $cust3->cust_add=$row["cust_add"];
                    $cust3->cust_gen=$row["cust_gen"];
                    $cust3->cust_dob=$row["cust_dob"];
                    $cust3->cust_mob1=$row["cust_mob1"];
                    $cust3->cust_mob2=$row["cust_mob2"];
                    $cust3->cust_mail=$row["cust_mail"];
                    $cust3->cust_cust_nicpic=$row["cust_nicpic"];

                    
                
                $this->db->close();
                return $cust3;

        }

        function del($id)
        {
            $sql="UPDATE customer SET cus_stt='deleted' WHERE  cust_id=$id";
            //echo $sql;
            $this->db->query($sql);
        }

        function get_del()
        {
            $sql="SELECT * FROM customer WHERE cus_stt='deleted'";
            $result=$this->db->query($sql);

            $custarr1=array();
            while($row=$result->fetch_array())
                { 
                    $cust4=new cust();
                    $cust4->cust_id=$row["cust_id"];
                    $cust4->cust_first_nm=$row["cust_first_nm"];
                    $cust4->cust_last_nm=$row["cust_last_nm"];
                    $cust4->cus_nic=$row["cus_nic"];
                    $cust4->cust_add=$row["cust_add"];
                    $cust4->cust_gen=$row["cust_gen"];
                    $cust4->cust_dob=$row["cust_dob"];
                    $cust4->cust_mob1=$row["cust_mob1"];
                    $cust4->cust_mob2=$row["cust_mob2"];
                    $cust4->cust_mail=$row["cust_mail"];
                    $cust4->cust_cust_nicpic=$row["cust_nicpic"];
                    $custarr1[]=$cust4;

                }
                return $custarr1;

        }

        function reactivate($rid){
            $sql="UPDATE customer SET cus_stt='ACTIVATE' WHERE  cust_id=$rid";
            //echo $sql;
            $this->db->query($sql);

        }


       function get_cust_mail($em){
           $sql="SELECT * FROM CUSTOMER WHERE cust_mail='$em' ";
           $res=$this->db->query($sql);
           $row=$res->fetch_array();

           $this->cust_id=$row["cust_id"];
           return $this;

       }

       function get_cust_nic($nic){
        $sql="SELECT * FROM CUSTOMER WHERE cus_nic='$nic' ";
        $res=$this->db->query($sql);
        $row=$res->fetch_array();

        $this->cust_id=$row["cust_id"];
        return $this;

    }

       function get_cus_id($cid){ 
           $sql="SELECT * FROM customer WHERE cust_id='$cid'";
           $res=$this->db->query($sql);
           $row=$res->fetch_array();

           $this->cust_id=$row['cust_id'];
           $this->cust_first_nm=$row['cust_first_nm'];
           $this->cust_last_nm=$row['cust_last_nm'];
           $this->cus_nic=$row['cus_nic'];
           $this->cust_add=$row["cust_add"];
            $this->db->close();
           return $this;
       }
      
       function del_CUS($delid){
       
        $sql="UPDATE customer SET cus_stt='deleted' WHERE  cust_id=$delid";
        $this->db->query($sql);
       // echo $sql;
        
    }
        
//     function cust_month(){
//         $sql="SELECT * FROM customer WHERE cus_stt='ACTIVE' AND year(now())=year(cus_regdt) AND month(now())=month(order_date)" ;
//     //echo $sql;
//     $res=$this->db->query($sql);
//     if($res->num_rows>0){
//         $num=$res->num_rows;
//         //echo $num;
//         return $num;
//     }else{
//     return false;
// }
//     }


    }


?>