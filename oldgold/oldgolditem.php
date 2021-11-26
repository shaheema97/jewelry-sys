<?php
include_once ("../files/config.php");

class oldgolditem{
    public $ogitem_id;
    public $ogitem_oldgoldid;
    public $ogitem_status;
    public $ogitem_condition;
    public $ogitem_date;
    public $ogitemt_unitprice;
    public $ogitem_qty;
    public $ogitem_totprice;
    public $ogitem_redprice;
    public $ogitem_nettprice;



function __construct(){
    $this->db=new mysqli(host,un,pw,db1);
}


function addogitem($ogid){
    $list=0;
    foreach($_POST["itemstat"] as $item){
        //print_r($_SESSION["pawn"]);
         $sql="INSERT INTO oldgolditem(ogitem_condition,ogitemt_unitprice,ogitem_qty,ogitem_totprice,ogitem_redprice,ogitem_nettprice,ogitem_oldgoldid) VALUES ('".$_POST['itemstat'][$list]."' ,'".$_POST['mkv'][$list]."', '".$_POST['quant'][$list]."','".$_POST['tot'][$list]."' , '".$_POST['dics_amt'][$list]."','".$_POST['final_amt'][$list]."',$ogid)";
        echo $sql;
         $this->db->query($sql);
         $list++;
        }
        return true;}
//FUNCTION TO ADD GOLS ITEM TO ITEM TABLE
        function addogitem_itemtbl($ogid){
            $list=0;
            foreach($_POST["itemstat"] as $item){
                //print_r($_SESSION["pawn"]);
                 $sql="INSERT INTO item(ogitem_condition,ogitemt_unitprice,ogitem_qty,ogitem_totprice,ogitem_redprice,ogitem_nettprice,ogitem_oldgoldid) VALUES ('".$_POST['itemstat'][$list]."' ,'".$_POST['mkv'][$list]."', '".$_POST['quant'][$list]."','".$_POST['tot'][$list]."' , '".$_POST['dics_amt'][$list]."','".$_POST['final_amt'][$list]."',$ogid)";
                echo $sql;
                 $this->db->query($sql);
                 $list++;
                }
                return true;}
        

function getby_oldgoldid($og_id){

    $sql="SELECT * FROM oldgolditem WHERE ogitem_oldgoldid=$og_id";
    $res=$this->db->query($sql);
    $ogitem_array=array();
    while($row=$res->fetch_array()){

        $ogitem1=new oldgolditem();
        $oldgold3=new oldgold();

        $ogitem1->ogitem_id=$row["ogitem_id"];
        $ogitem1->ogitem_oldgoldid=$row["ogitem_oldgoldid"];
        $ogitem1->ogitem_status=$row["ogitem_status"];
        $ogitem1->ogitem_condition=$row["ogitem_condition"];
        $ogitem1->ogitem_date=$row["ogitem_date"];
        $ogitem1->ogitemt_unitprice=$row["ogitemt_unitprice"];
        $ogitem1->ogitem_qty=$row["ogitem_qty"];
        $ogitem1->ogitem_totprice=$row["ogitem_totprice"];
        $ogitem1->ogitem_redprice=$row["ogitem_redprice"];
        $ogitem1->ogitem_nettprice=$row["ogitem_nettprice"];
      
        $ogitem_array[]=$ogitem1;
    }
        return $ogitem_array;
}

    
}

?>
