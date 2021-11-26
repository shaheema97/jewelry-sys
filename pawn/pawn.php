<?php
//get the variable  to establish database connectiom
include_once ("../files/config.php");

include_once ("../customer/cust.php");
include_once ("../staff/staff.php");

 class pawn{
    public $pawn_id; //attributes of pawn class
    public $pawn_dt;
    public $pawn_duedt;
    public $pawn_em;
    public $pawn_cus;
    public $pawn_mvtot;
    public $pawn_avtot;
    public $pawn_period;
    public $pawn_int;
    public $pawn_intval;
    public $pawn_rvtot;
    public $pawn_paid;
    public $pawn_due;
    public $pawn_type;
    public $pawn_stt;
    public $day_remain;
    public $stname;
    public $cusname;
    public $cusnamev;
    public $staffnamev;
    private $db;

    //function to establish connection to the database
    function __construct(){
        //create database connection
        $this->db=new mysqli(host,un,pw,db1);
    }
    //function to insert pawn details to the database
    function insertpawn(){
        $sql="INSERT INTO pawn(pawn_dt,pawn_duedt,pawn_em,pawn_cus,pawn_mvtot,pawn_avtot,pawn_int,pawn_intval,pawn_rvtot,pawn_period,pawn_due) VALUES('$this->pawn_dt','$this->pawn_duedt','$this->pawn_em','$this->pawn_cus','$this->pawn_mvtot','$this->pawn_avtot','$this->pawn_int','$this->pawn_intval','$this->pawn_rvtot','$this->pawn_period','$this->pawn_rvtot')";
        //echo $sql; 
        $this->db->query($sql);
        $id=$this->db->insert_id;
       
        return $id;
    }
    //function to delete a particular pawn
    function del_pawn($id){
        $sql="UPDATE pawn SET pawn_stt='INACTIVE' WHERE  pawn_id=$id";
         
        $this->db->query($sql);
      
    }
   //function to edit pawn details
    function edit_pawn($editid){
        $sql="UPDATE pawn SET pawn_em->'$this->pawn_em' , pawn_cus='$this->pawn_cus' , pawn_int='$this->pawn_int' ,pawn_period='$this->pawn_period' WHERE pawn_id='$editid";
        $this->db->query($sql);

    }
   

   function get_pawn_id2($pid){
    $sql="SELECT * FROM pawn WHERE pawn_id='$pid'";
    $res=$this->db->query($sql);
    $row=$res->fetch_array();
    $c=new cust();
    $p=new pawn();
    $e=new staff();
    $p->pawn_id=$row["pawn_id"];
    $p->pawn_dt=$row["pawn_dt"];
    $p->pawn_duedt=$row["pawn_duedt"];
   
    $p->pawn_em=$row["pawn_em"];
    $p->stname=$e->get_all_byid($p->pawn_em);
    $p->pawn_cus=$row["pawn_cus"];
    $p->cusname=$c->get_cus_id($p->pawn_cus);
    $p->pawn_mvtot=$row["pawn_mvtot"];
    $p->pawn_avtot=$row["pawn_avtot"];
    $p->pawn_period=$row["pawn_period"];
    $p->pawn_int=$row["pawn_int"];
    $p->pawn_intval=$row["pawn_intval"];
    $p->pawn_rvtot=$row["pawn_rvtot"];
    $p->pawn_paid=$row["pawn_paid"];
    $p->pawn_due=$row["pawn_due"];
    $p->pawn_type=$row["pawn_type"];

    
     
    return $p;}


    function getall_pawn(){
        $sql="SELECT * , datediff(pawn_duedt, now()) dayr FROM pawn WHERE pawn_stt='ACTIVE' "; //dayr is new colomn name
       
       
        $res=$this->db->query($sql);
        $pawnarr=array();
        while($row=$res->fetch_array()){
            $p=new pawn();
            $c= new cust();
            $s=new staff();
            $p->pawn_id=$row["pawn_id"];
            
            $p->pawn_dt=$row["pawn_dt"];
            $p->pawn_duedt=$row["pawn_duedt"];
            $p->day_remain=$row["dayr"];
            $p->pawn_em=$row["pawn_em"];
            $p->stname=$s->get_all_byid($p->pawn_em);
            $p->pawn_cus=$row["pawn_cus"];
            $p->cusname=$c->get_cus_id($p->pawn_cus);
            $p->pawn_mvtot=$row["pawn_mvtot"];
            $p->pawn_avtot=$row["pawn_avtot"];
            $p->pawn_rvtot=$row["pawn_rvtot"];
            $p->pawn_paid=$row["pawn_paid"];
            $p->pawn_due=$row["pawn_due"];
            $p->pawn_type=$row["pawn_type"];
            $p->pawn_int=$row["pawn_int"];
            $p->pawn_intval=$row["pawn_intval"];
            $p->pawn_period=$row["pawn_period"];
            $pawnarr[]=$p;
        }
            return $pawnarr;
    }

    // function update_expire(){
    //     $sql2="UPDATE pawn SET pawn_type='EXPIRED'  AND pawn_stt='ACTIVE'";
    //     $sql="SELECT * , datediff(pawn_duedt, now()) dayr FROM pawn WHERE pawn_stt='ACTIVE' AND pawn_stt='ACTIVE'";
    //     $res=$this->db->query($sql);
        
    //     if
    //       $sql="UPDATE pawn";

    // }



    function get_all_pawnsearch(){
       
        $filter_cus=$_POST['filter_cus'];
        $filter_staff=$_POST['filter_staff'];
        $filter_type=$_POST['filter_type'];
        $filter_id=$_POST['filter_id'];
        $filter_stdt=$_POST['filter_stdt'];
        $filter_endt=$_POST['filter_endt'];

        $sql="SELECT * FROM pawn WHERE pawn_stt='ACTIVE'   ";
        // if($filter_stdt!='' )
        // {
        //     $sql.=" and pawn_dt='$filter_stdt'";
        // }
        
        if($filter_cus!=-1) {
            $sql.=" and pawn_cus='$filter_cus'";
        }
        if($filter_staff!=-1) {
            $sql.=" and pawn_em='$filter_staff'";
        }
        if($filter_type!=-1) {
            $sql.=" and pawn_type='$filter_type'";
        }
        if($filter_stdt!='' &&  $filter_endt!='' )
        {
            $sql.="and pawn_dt BETWEEN  '".$_POST['filter_stdt']."' AND '".$_POST['filter_endt']."' "; 
        }
       
        if($filter_id!='')
        {
            $sql.=" and pawn_id='$filter_id'";
        }

        //echo $sql;
        $res=$this->db->query($sql);
        
        $pawnarr=array();
        while($row=$res->fetch_array()){
            $p=new pawn();
            $c= new cust();
            $s=new staff();
            $p->pawn_id=$row["pawn_id"];
            $p->pawn_dt=$row["pawn_dt"];
            $p->pawn_duedt=$row["pawn_duedt"];
            $p->pawn_em=$row["pawn_em"];
            $p->stname=$s->get_all_byid($p->pawn_em);
            $p->pawn_cus=$row["pawn_cus"];
            $p->cusname=$c->get_cus_id($p->pawn_cus);
            $p->pawn_mvtot=$row["pawn_mvtot"];
            $p->pawn_avtot=$row["pawn_avtot"];
            $p->pawn_rvtot=$row["pawn_rvtot"];
            $p->pawn_paid=$row["pawn_paid"];
            $p->pawn_due=$row["pawn_due"];
            $p->pawn_type=$row["pawn_type"];
            

            $pawnarr[]=$p;
        }
            return $pawnarr;


    }
    function insertpawnextend(){
        $sql="INSERT INTO pawn(pawn_dt,pawn_em,pawn_cus,pawn_int,pawn_intval,pawn_rvtot,pawn_period,pawn_refid	) VALUES('$this->pawn_dt','$this->pawn_em','$this->pawn_cus','$this->pawn_int','$this->pawn_intval','$this->pawn_rvtot','$this->pawn_period','$this->pawn_id')";
        echo $sql;
        $this->db->query($sql);
        $id=$this->db->insert_id;
       
        return $id;
    }
  function updtexten($id){
    $sql="UPDATE PAWN SET pawn_type='EXTENDED' WHERE  pawn_id=$id";
    //echo $sql;
    $this->db->query($sql);
  }

  function update_pawnpayment($pawnid,$amt){
    $sql="UPDATE pawn SET  pawn_paid=pawn_paid + $amt , pawn_due=pawn_rvtot-pawn_paid WHERE pawn_id=$pawnid";
    //echo $sql;
    $this->db->query($sql);

    

  }

  function del_complete(){

  }

  function cal_paytot_array($typeid){
    $sql="SELECT *, SUM(payment.pay_amount) AS totalpay FROM pawn left join payment on pawn.pawn_id=payment.pay_type_id WHERE pay_type_id=$typeid and pay_type='Pawn' GROUP BY payment.pay_type_id";
    $res=$this->db->query($sql);
     echo $sql;   
        $pawnarr=array();
        while($row=$res->fetch_array()){
            $p=new pawn();
            $c= new cust();
            $s=new staff();
            $p->pawn_id=$row["pawn_id"];
            $p->pawn_dt=$row["pawn_dt"];
            
            $p->pawn_duedt=$row["pawn_duedt"];
            $p->pawn_em=$row["pawn_em"];
            $p->stname=$s->get_all_byid($p->pawn_em);
            $p->pawn_cus=$row["pawn_cus"];
            $p->cusname=$c->get_cus_id($p->pawn_cus);
            $p->pawn_mvtot=$row["pawn_mvtot"];
            $p->pawn_avtot=$row["pawn_avtot"];
            $p->pawn_rvtot=$row["pawn_rvtot"];
            $p->pawn_paid=$row["totalpay"];
            $p->pawn_due=$p->pawn_rvtot-$p->pawn_paid;
            
            $p->pawn_type=$row["pawn_type"];
            

            $pawnarr[]=$p;
        }
            return $pawnarr;


  }
  function cal_paytot($typeid){
    //$sql="SELECT *, SUM(payment.pay_amount) AS totalpay FROM pawn left join payment on pawn.pawn_id=payment.pay_type_id WHERE pay_type_id=$typeid and pay_type='Pawn' and pawn_id=  GROUP BY payment.pay_type_id";
    $sql="SELECT *, SUM(payment.pay_amount) AS totalpay FROM pawn left join payment on pawn.pawn_id=payment.pay_type_id WHERE  pawn_id=$typeid or (pay_type_id=$typeid and pay_type='Pawn')  GROUP BY payment.pay_type_id";
    $res=$this->db->query($sql);
    echo $sql;   
       
$row=$res->fetch_array();
            $p=new pawn();
            $c= new cust();
            $s=new staff();
            $p->pawn_id=$row["pawn_id"];
            $p->pawn_dt=$row["pawn_dt"];
            
            $p->pawn_duedt=$row["pawn_duedt"];
            $p->pawn_em=$row["pawn_em"];
            $p->stname=$s->get_all_byid($p->pawn_em);
            $p->pawn_cus=$row["pawn_cus"];
            $p->cusname=$c->get_cus_id($p->pawn_cus);
            $p->pawn_mvtot=$row["pawn_mvtot"];
            $p->pawn_avtot=$row["pawn_avtot"];
            $p->pawn_rvtot=$row["pawn_rvtot"];
            $p->pawn_paid=$row["totalpay"];
            $p->pawn_due=$p->pawn_rvtot-$p->pawn_paid;
            
            $p->pawn_type=$row["pawn_type"];
            

            
            return $p;


  }

  function update_status_complete($typeid ){
    $sql="SELECT * FROM pawn ";
    $res=$this->db->query($sql);
    $row=$res->fetch_array();

    if($row["pawn_due"]<0){
        $sql_edit="UPDATE pawn SET pawn_type='COMPLETE' WHERE pawn_id=$typeid ";
        $this->db->query($sql);
        echo $sql;
        return true;
    }else {
        return false;
    }

}

function ticket(){
    $sql="SELECT * FROM pawn WHERE pawn_type='NEWPAWN'";
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