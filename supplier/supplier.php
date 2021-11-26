<?php
include_once ("../files/config.php");

class supplier
{
    public $sup_id;
    public $sup_firstname;
    public $sup_lastname;
    public $sup_nic;
    public $sup_comnm;
    public $sup_comadd;
    public $sup_mob1;
    public $sup_mob2;
    //public $sup_mob2;
    public $sup_add;
    public $sup_city;
    public $sup_mail;
    public $sup_stt;
    public $sup_regdt;
    private $db;

    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }


    function addsupp(){

            $sql="INSERT INTO supplier(sup_firstname,sup_lastname,sup_nic,sup_comnm,sup_comadd,sup_mob1,sup_mob2,sup_add,sup_city,sup_mail) 
            VALUES('$this->sup_firstname','$this->sup_lastname','$this->sup_nic','$this->sup_comnm','$this->sup_comadd','$this->sup_mob1','$this->sup_mob2','$this->sup_add','$this->sup_city','$this->sup_mail')";
            //echo $sql;
            $this->db->query($sql);
            return true;    
       }

function get_all_sup(){
    
            $sql="SELECT * FROM supplier WHERE sup_stt='ACTIVE'";
            $res=$this->db->query($sql);
            $suparr=array();
            while($row=$res->fetch_array())
            {
                $sup1=new supplier();
                $sup1->sup_id=$row["sup_id"];
                $sup1->sup_firstname=$row["sup_firstname"];
                $sup1->sup_lastname=$row["sup_lastname"];
                $sup1->sup_nic=$row["sup_nic"];
                $sup1->sup_mob1=$row["sup_mob1"];
                $sup1->sup_mob2=$row["sup_mob2"];
                $sup1->sup_comnm=$row["sup_comnm"];
                $sup1->sup_comadd=$row["sup_comadd"];
                $sup1->sup_add=$row["sup_add"];
                $sup1->sup_city=$row["sup_city"];
                $sup1->sup_mail=$row["sup_mail"];
                
                $suparr[]=$sup1;

    }
    return $suparr;
}

function get_supp_byid($supid){
    $sql="SELECT * FROM supplier WHERE sup_id='$supid'";
    $res=$this->db->query($sql);
    $row=$res->fetch_array();
    
    $this->sup_id=$row["sup_id"];
    $this->sup_firstname=$row["sup_firstname"];
    $this->sup_lastname=$row["sup_lastname"];
    $this->sup_nic=$row["sup_nic"];
    // $sup1->sup_mob1=$row["sup_mob1"];
    // $sup1->sup_mob2=$row["sup_mob2"];
    // $sup1->sup_comnm=$row["sup_comnm"];
    // $sup1->sup_comadd=$row["sup_comadd"];
    // $sup1->sup_add=$row["sup_add"];
    // $sup1->sup_city=$row["sup_city"];
    // $sup1->sup_mail=$row["sup_mail"];
    $this->db->close();
    return $this;
}



function del($id){
    $sql="UPDATE supplier SET sup_stt='DELETED' WHERE sup_id='$id' ";
    $this->db->query("$sql");
    return true;
}


FUNCTION get_all_del()
{
    $sql="SELECT * FROM supplier WHERE sup_stt='DELETED'";
    $res->$this->db->query($sql);
    $suparr1=array();
    while($row=$res->fetch_array())
    {
        $sup2=new supplier();
        $sup2->$sup_id=$row["sup_id"];
        $sup2->$sup_firstname=$row["sup_firstname"];
        $sup2->$sup_lastname=$row["sup_lastname"];
        $sup2->$sup_nic=$row["sup_nic"];
        $sup2->$sup_mob1=$row["sup_mob1"];
        $sup1->$sup_add=$row["sup_add"];
        $sup2->$sup_city=$row["sup_city"];
        $sup2->$sup_mail=$row["sup_mail"];
        
        $suparr1[]=$sup2;

    }
    return $suparr;
}


}



?>