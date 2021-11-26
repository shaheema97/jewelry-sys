<?php
include_once ("../files/config.php");
class user_role{
    public $role_id;
    public $role_name;
    public $role_status;
    public $role_regdate;
 public $db;
 
 function __construct(){
    $this->db=new mysqli(host,un,pw,db1);
}


 function get_all_user(){
    $sql="SELECT * FROM user_role ";
    $result=$this->db->query($sql);
    echo $sql;
    $user_array= array();
    while($row=$result->fetch_array()){
        $user_getall=new user_role();

        $user_getall->role_id=$row["role_id"];
        $user_getall->role_name=$row["role_name"];
        $user_getall->role_status=$row["role_status"];
        $user_getall->role_regdate=$row["role_regdate"];
        $user_array[]=$user_getall;
        
    }
    return  $user_array;
}

function get_role_byid($id){
    $sql="SELECT * FROM user_role WHERE role_id=$id " ;
    $result=$this->db->query($sql);
    $row=$result->fetch_array();
    //echo $sql;
        $user_getall=new user_role();

        $user_getall->role_id=$row["role_id"];
        $user_getall->role_name=$row["role_name"];
        $user_getall->role_status=$row["role_status"];
        $user_getall->role_regdate=$row["role_regdate"];
        
        
    
    $user_getall;

}

}

?>