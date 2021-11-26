<?php
include_once ("../files/config.php");
class notification{

    public $not_id;
    public $not_date;
    public $not_from;
    public $not_to;
    public $not_msghead;
    public $not_msgbody;
    public $not_status;
    public $db;


    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }


    function insert_not($reciever,$msg){
        $sql="INSERT INTO notifications  (not_to,not_msghead)VALUES ($reciever,'$msg') ";
        $this->db->query($sql);
       // echo $sql;
        
        return true;
    }


    function getmsg_byid($recieverid){
        $sql="SELECT * FROM notifications WHERE not_to='$recieverid' AND not_status='PENDING'  ";
        $result=$this->db->query($sql);
       // echo $sql;
        $not_arr=array();
    
        while($row=$result->fetch_array()){
            $notify1=new notification();

            $notify1->not_id=$row['not_id'];
            $notify1->not_date=$row['not_date'];
            $notify1->not_from=$row['not_from'];
            $notify1->not_to=$row['not_to'];
            $notify1->not_msghead=$row['not_msghead'];
            $not_arr[]=$notify1;
        }
        return $not_arr;
    }
    function update_status($recieverid){
        $sql="UPDATE notifications set not_status='READ' WHERE not_to='$recieverid'" ;
        $this->db->query($sql);
        echo $sql;
    }

    function count($recieverid){
        $sql="SELECT * FROM notifications WHERE not_to='$recieverid' AND not_status='PENDING'  ";
        $result=$this->db->query($sql);
       
        if($result->num_rows>0){
        $num=$result->num_rows;
        
        return $num;
    }else
    return false;

    
    }

}

?>