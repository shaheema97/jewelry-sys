<?php
include_once ("../files/config.php");
class rate{
    public $rate_id;
    public $rate_ounce;
    public $rate_gram;
    public $rate_pound;
    public $rate_status;
    public $rate_date;  
    public $pawnrate;
    private $db;

    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }

    function insert_rate(){
        $sql="INSERT INTO goldrate (rate_gram,rate_pound,pawnrate) VALUES ('$this->rate_gram','$this->rate_pound','$this->pawnrate')";
        echo $sql;
        $this->db->query($sql);
        return true;

    }
    
    function get_today_rate(){
        $sql="SELECT * FROM goldrate where date(rate_date)=date(now()) and rate_status='ACTIVE' ";
        $result=$this->db->query($sql);
        if($result->num_rows>0){
            $row=$result->fetch_array();
            $r=new rate();
            $r->rate_gram=$row["rate_gram"];
            $r->rate_pound=$row["rate_pound"];
            $r->pawnrate=$row["pawnrate"];
            return $r;
            
        }else{
            return null;
        }

        
    }
   

        
  



}

?>