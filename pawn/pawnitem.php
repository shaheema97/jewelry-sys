<?php
include_once ("../files/config.php");
include_once ("pawn.php");
include_once ("../item/category.php");
include_once ("../item/item.php");
include_once ("../item/itemname.php");
include_once ("../goldrate/rate.php");
//session_start();
class pawnitem{

    public $pawnit_id;
    public $pawnid;
    public $pawn_cat;
    public $pawn_item;
    public $pawnregdt;
    public $pawnit_wei;
    public $pawnit_karat;
    public $pawnit_mv;
    public $pawnit_rv;
    public $pawnit_int;
    public $pawnit_redeem;
    public $pawn_status;
    public $pawnitem_status;
    public $itemcat;
    public $item_name;
    
    public $db;

    function __construct(){
        $this->db=new mysqli(host,un,pw,db1);
    }


    function addpawnitem($sid){
        $list=0;
        foreach($_POST["cat"] as $item){
            //print_r($_SESSION["pawn"]);
             $sql="INSERT INTO pawnitem(pawn_cat,pawn_item,pawnit_wei,pawnit_karat,pawnit_int,pawnit_mv,pawnit_rv,pawnit_redeem,pawnid) VALUES ('".$_POST['cat'][$list]."' , '".$_POST['item'][$list]."','".$_POST['wt'][$list]."' , '".$_POST['kar'][$list]."','".$_POST['pint'][$list]."','".$_POST['mkv'][$list]."','".$_POST['rvt'][$list]."','".$_POST['ploan'][$list]."',$sid)";
            echo $sql;
             $this->db->query($sql);
             $list++;
            }
            return true;}


function get_all_pitem(){
    $rate=new rate();
    $r=$rate->get_today_rate();
    $sql="SELECT * FROM pawnitem where pawnitem_status='ACTIVE'";
    $res=$this->db->query($sql);
    $pitem=array();
    while($row=$res->fetch_array()){
        $pt=new pawnitem();
        $p=new pawn();
        $pawn_itemcat=new category();
       $pawn_itemname=new itemname();
        $pt->pawnit_id=$row["pawnit_id"];
        
        $pt->pawnid=$row["pawnid"];
    
        $pt->pawn_cat=$row["pawn_cat"];
       $pt->itemcat=$pawn_itemcat->getbyid_category($pt->pawn_cat);
        $pt->pawn_item=$row["pawn_item"];
        $pt->itemname=$pawn_itemname-> getall_itemname_byitem($pt->pawn_item);
        $pt->pawnit_wei=$row["pawnit_wei"];
        $pt->pawnit_karat=$row["pawnit_karat"];
        $pt->pawnit_mv=$row["pawnit_mv"];
        $pt->pawnit_rv=$row["pawnit_rv"];
        $pt->pawnit_int=$row["pawnit_int"];
        $pt->pawnit_redeem=$row["pawnit_redeem"];
        $pt->item_price=round($row["pawnit_karat"]* $r->rate_gram/24*$row["pawnit_wei"],2);

        $pt->pawnregdt=$row["pawnregdt"];
        $pt->pawnitem_status=$row["pawnitem_status"];
        $pt->pawn_status=$row["pawn_status"];
        $pitem[]= $pt; 
    }
    return  $pitem;
}

function get_pitem_id($pawnid){
    $sql="SELECT * FROM pawnitem where pawnid='$pawnid'";
    $res=$this->db->query($sql);
   // echo $sql;
    $ptitem=array();
   while( $row=$res->fetch_array())
   {

    $pawnitem = new pawnitem();
    $pawn_itemcat=new category();
    $pawn_itemname=new itemname();
    $pawnitem->pawnit_id=$row["pawnit_id"];
    $pawnitem->pawnid=$row["pawnid"];
    $pawnitem->pawn_cat=$row["pawn_cat"];
    $pawnitem->itemcat=$pawn_itemcat->getbyid_category($pawnitem->pawn_cat);
    $pawnitem->pawn_item=$row["pawn_item"];
    $pawnitem->item_name=$pawn_itemname->getall_itemname_byitem($pawnitem->pawn_item);
    $pawnitem->pawnit_wei=$row["pawnit_wei"];
    $pawnitem->pawnit_karat=$row["pawnit_karat"];
    $pawnitem->pawnit_mv=$row["pawnit_mv"];
    $pawnitem->pawnit_rv=$row["pawnit_rv"];
    $pawnitem->pawnit_int=$row["pawnit_int"];
    $pawnitem->pawnit_redeem=$row["pawnit_redeem"];
    $pawnitem->pawnregdt=$row["pawnregdt"];
    $pawnitem->pawnitem_status=$row["pawnitem_status"];
    $pawnitem->pawn_status=$row["pawn_status"];
    $ptitem[]=$pawnitem;
   }
    return $ptitem;

}
function del_pawnitem($id){
   //UPDATE FUNCTION WITH FOR EACH 
   $sql="UPDATE pawnitem SET pawnitem_status='INACTIVE' WHERE  pawnid=$id";
           
   $this->db->query($sql);
 
  
}

function get_redeem(){
    $rate=new rate();
    $r=$rate->get_today_rate();

    $sql="SELECT * FROM pawnitem where pawn_status='REDEEM'"; 
    //echo $sql;
    $res=$this->db->query($sql);
    $ptitem=array();
   while( $row=$res->fetch_array())
   {

    $pawnitem = new pawnitem(); 
    $pawn_itemcat=new category();
    $pawn_itemname=new item();
    $pawnitem->pawnit_id=$row["pawnit_id"];
    $pawnitem->pawnid=$row["pawnid"];
    $pawnitem->pawn_cat=$row["pawn_cat"];
    
    //echo "######".$pawnitem->pawn_cat;

    $pawnitem->itemcat=$pawn_itemcat->getbyid_category($pawnitem->pawn_cat);



    $pawnitem->pawn_item=$row["pawn_item"];
    //echo $pawnitem->pawn_item;
    $pawnitem->itemname=$pawn_itemname->getitem_by_id($pawnitem->pawn_item);
    $pawnitem->pawnit_wei=$row["pawnit_wei"];
    $pawnitem->pawnit_karat=$row["pawnit_karat"];
    $pawnitem->pawnit_mv_new=round($row["pawnit_karat"]* $r->rate_gram/24*$row["pawnit_wei"],2);
    $pawnitem->pawnit_rv=$row["pawnit_rv"];
    $pawnitem->pawnit_int=$row["pawnit_int"];
    $pawnitem->asv_rate=round($r->rate_pound-($r->rate_pound*10/100),2);
   // $pawnitem->pawnit_rv_new=round(($pawnitem->asv_rate*$row["pawnit_karat"]/24)/8 *$row["pawnit_wei"],2);
    //$pawnitem->pawnit_intval=round(assesedval*(12/100)*(pawn_time/12));
    $pawnitem->pawnit_redeem=$row["pawnit_redeem"];
    $pawnitem->pawnregdt=$row["pawnregdt"];
    $pawnitem->pawnitem_status=$row["pawnitem_status"];
    $pawnitem->pawn_status=$row["pawn_status"];
    $ptitem[]=$pawnitem;
   }
    return $ptitem;

}


function get_all_pitem_search(){
  
    $filter_cat=$_POST['filter_cat'];
    $filter_item=$_POST['filter_item'];
    $filter_stdt=$_POST['filter_stdt'];
    $filter_endt=$_POST['filter_endt'];

    $sql="SELECT * FROM pawnitem where pawn_status='ACTIVE' ";
    
    if($filter_stdt!='' &&  $filter_endt!='' )
    {
        $sql.=" and pawnregdt BETWEEN  '".$_POST['filter_stdt']."' AND '".$_POST['filter_endt']."'  "; 
    }
        
    if($filter_cat!=-1)
    
     {
        $sql.=" and  pawn_cat='$filter_cat' ";
        //$sql.=" and  pawn_cat='".$_POST['filter_cat']."' ";
    }
    if($filter_item!=-1) 
    
    {
        $sql.=" and pawn_item='".$_POST['filter_item']."'  ";
    }

    if($filter_stdt!='' &&  $filter_endt='' )
    {
        $sql.="and pawnregdt BETWEEN  '".$_POST['filter_stdt']."' AND ".$_POST['filter_endt']."'  "; 
    }
    echo $sql;
    $res=$this->db->query($sql);
    $pitem=array();
    while($row=$res->fetch_array()){
        $pt=new pawnitem();
        $p=new pawn();
        $pt->pawnit_id=$row["pawnit_id"];
        
        $pt->pawnid=$row["pawnid"];
        
        $pt->pawn_cat=$row["pawn_cat"];
        $pt->pawn_item=$row["pawn_item"];
        $pt->pawnit_wei=$row["pawnit_wei"];
        $pt->pawnit_karat=$row["pawnit_karat"];
        $pt->pawnit_mv=$row["pawnit_mv"];
        $pt->pawnit_rv=$row["pawnit_rv"];
        $pt->pawnit_int=$row["pawnit_int"];
        $pt->pawnit_redeem=$row["pawnit_redeem"];
        $pt->pawnregdt=$row["pawnregdt"];
        $pt->pawnitem_status=$row["pawnitem_status"];
        $pt->pawn_status=$row["pawn_status"];
        $pitem[]= $pt; 
    }
    return  $pitem;
}
function get_all_pitem_searchdt(){
  
    
     $filter_stdt=$_POST['filter_stdt'];
     $filter_endt=$_POST['filter_endt'];
 
     $sql="SELECT * FROM pawnitem ";
 
         if($filter_stdt!='' &&  $filter_endt!='' )
     {
         $sql.=" where pawnregdt BETWEEN  '".$_POST['filter_stdt']."' AND '".$_POST['filter_endt']."'  "; 
     }
     echo $sql;
     $res=$this->db->query($sql);
     $pitem=array();
     while($row=$res->fetch_array()){
         $pt=new pawnitem();
        
         $pt->pawnit_id=$row["pawnit_id"];
         
         $pt->pawnid=$row["pawnid"];
         
         $pt->pawn_cat=$row["pawn_cat"];
         $pt->pawn_item=$row["pawn_item"];
         $pt->pawnit_wei=$row["pawnit_wei"];
         $pt->pawnit_karat=$row["pawnit_karat"];
         $pt->pawnit_mv=$row["pawnit_mv"];
         $pt->pawnit_rv=$row["pawnit_rv"];
         $pt->pawnit_int=$row["pawnit_int"];
         $pt->pawnit_redeem=$row["pawnit_redeem"];
         $pt->pawnregdt=$row["pawnregdt"];
         $pt->pawnitem_status=$row["pawnitem_status"];
         $pt->pawn_status=$row["pawn_status"];

         $pitem[]= $pt; 
     }
     return  $pitem;
 }
 

}

?>