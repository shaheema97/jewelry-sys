<?php
include_once ("../files/config.php");
include_once ("../staff/staff.php");



class workshop{
    public $workshop_id;
    public $workshop_craftsman;
    public $workshop_staff;
    public $workshop_date;
    public $workshop_duedt;
    public $workshop_workstatus;
    public $workshop_status;
    public $craftsman;
    public $staff;
    
    public $db;

    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }  



    function insert_workshop(){
        $sql="INSERT INTO workshop (workshop_craftsman,workshop_staff,workshop_date,workshop_duedt) VALUES ('$this->workshop_craftsman','$this->workshop_staff','$this->workshop_date','$this->workshop_duedt')";
      //  echo $sql;
        $this->db->query($sql);
        $id=$this->db->insert_id; //insert_id is a php term do not change it

        return $id;


    }

    function getall_workshop(){
        $sql="SELECT * FROM  workshop  ";
        $res=$this->db->query($sql);
        $workshop_array=array();
       // echo $sql;
        while($row=$res->fetch_array()){
            $workshop1=new workshop();
            $ws_staff=new staff();
            $ws_staff1=new staff();

            $workshop1->workshop_id=$row["workshop_id"];
            $workshop1->workshop_craftsman=$row["workshop_craftsman"];
            $workshop1->craftsman=$ws_staff1->get_all_byid($workshop1->workshop_craftsman);
            $workshop1->workshop_staff=$row["workshop_staff"];
            $workshop1->staff=$ws_staff->get_all_byid($workshop1->workshop_staff);
            $workshop1->workshop_date=$row["workshop_date"];
            $workshop1->workshop_duedt=$row["workshop_duedt"];
            $workshop1->workshop_status=$row["workshop_status"];
            $workshop1->workshop_workstatus=$row["workshop_workstatus"];
            
            $workshop_array[]=$workshop1;
        }
        return $workshop_array;
    }

    
    function getall_workshop_id($WS_ID ){
        $sql="SELECT * FROM  workshop WHERE workshop_id=$WS_ID  ";
        $res=$this->db->query($sql);
      
       // echo $sql;
        $row=$res->fetch_array();
            $workshop1=new workshop();
            $ws_staff=new staff();
            $ws_staff1=new staff();

            $workshop1->workshop_id=$row["workshop_id"];
            $workshop1->workshop_craftsman=$row["workshop_craftsman"];
            $workshop1->craftsman=$ws_staff1->get_all_byid($workshop1->workshop_craftsman);
            $workshop1->workshop_staff=$row["workshop_staff"];
            $workshop1->staff=$ws_staff->get_all_byid($workshop1->workshop_staff);
            $workshop1->workshop_date=$row["workshop_date"];
            $workshop1->workshop_duedt=$row["workshop_duedt"];
            $workshop1->workshop_status=$row["workshop_status"];
           
        return $workshop1;
    }

    function update_status($orderitemid){
        $sql="UPDATE workshop SET workshop_workstatus='$this->workshop_workstatus' WHERE workshop_id=$orderitemid ";
        $this->db->query($sql);
       // echo $sql;
        
        return true;
    }

   
  


}


?>