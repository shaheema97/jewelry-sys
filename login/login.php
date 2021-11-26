<?php
include_once ("../files/config.php");
class login{
    public $admin_id;
    public $u_id;
    public $u_name;
    public $user_mail;
    public $usertype;
    public $ad_pass;
    public $db;

    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }

    function insert_login($uid){
        $sql="INSERT INTO admin (u_name,user_mail,usertype,ad_pass,u_id) VALUES ('$this->u_name','$this->user_mail','$this->usertype','$this->ad_pass',$uid)";
        $this->db->query($sql);
        echo $sql;
        return true;
    }

    function edit_login($id){

    }

    function login_by_uid($user){
        $sql="SELECT * FROM admin WHERE u_id= $user";
        echo $sql;
        $result=$this->db->query($sql);
        $row=$result->fetch_array();

        $userlogin=new login();

        $userlogin->admin_id=$row["admin_id"];
        $userlogin->u_id=$row["u_id"];
        $userlogin->u_name=$row["u_name"];
        $userlogin->user_mail=$row["user_mail"];
        $userlogin->usertype=$row["usertype"];
        $userlogin->ad_pass=$row["ad_pass"];

        return $userlogin;

    }
  


    function ad_login($un,$pw)
    {
        //$db=new mysqli("localhost","root","","jewel_sys");
        $query="SELECT * FROM admin WHERE user_mail='$un' and ad_pass='$pw' ";
        //echo $query;
        $result=$this->db->query($query);
        
        if($row=$result->fetch_array())
        {
            session_start();
            $_SESSION["user"]=$row;
			//$_SESSION["user_mail"]=$row["user_mail"];
			return true;
				
        }
        else{
            return false;     
        //     echo '<script type="text/Javascript">
        //     alert(Incorrect username or password);
        //     </script>';

        
        }


    }
}

?>