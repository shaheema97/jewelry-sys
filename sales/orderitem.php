<?php
include_once ("../files/config.php");
include_once ("../item/item.php");
include_once ("../item/category.php");
class orderitem{
    public $orderitem_id;
    public $order_id;
    public $orderitem_dt;
    public $orderitem_status;
    public $orderitm_cat;
    public $orderitm_name;
    public $orderitm_purity;
    public $orderitm_quan;
    public $orderitm_weight;
    public $orderitm_size;
    public $orderitm_unit;
    public $orderitem_ws_status;
  
    public $catname;
    public $name;
    public $db;
    
    

function __construct(){
    $this->db=new mysqli(host,un,pw,db1);
}
function insert_orderitem($orderid){
        $list=0;
        foreach($_POST['cat']as $item){
            $sql="INSERT INTO orderitem(orderitm_cat,orderitm_name,orderitm_purity,orderitm_quan,orderitm_weight,orderitm_size,orderitm_unit,order_id) VALUES ('".$_POST['cat'][$list]."','".$_POST['itemname'][$list]."','".$_POST['itmpurity'][$list]."','".$_POST['itmquan'][$list]."','".$_POST['itmweight'][$list]."','".$_POST['size'][$list]."','".$_POST['unit'][$list]."',$orderid)";
            //echo $sql;
            $this->db->query($sql);
            $u_id=$this->db->insert_id;
            move_uploaded_file($_FILES["uimg"]["tmp_name"][$list],"../sales/order_images/$u_id.jpg");
            //print_r($_FILES);
            $list++;
        }
        return true;
    }

    function update_orderitem($order_id){
        $list=0;
        foreach($_POST['itemname']as $item){
            $sql="UPDATE orderitem SET  orderitm_name='".$_POST['itemname'][$list]."' , orderitm_purity='".$_POST['itmpurity'][$list]."' , orderitm_quan= '".$_POST['itmquan'][$list]."',orderitm_weight='".$_POST['itmweight'][$list]."' ,orderitm_size='".$_POST['size'][$list]."', orderitm_unit='".$_POST['unit'][$list]."' WHERE order_id=$order_id ";
            echo $sql;
            $this->db->query($sql);
           // $u_id=$this->db->insert_id;
           // move_uploaded_file($_FILES["uimg"]["tmp_name"][$list],"../sales/order_images/$u_id.jpg");
            //print_r($_FILES);
            $list++;
        }
        return true;
    }

    function getall_orderitem(){
        $sql="SELECT * FROM orderitem WHERE orderitem_status='ACTIVE' ";
        $result=$this->db->query($sql);
        $orderitemarray=array();
        while($row=$result->fetch_array()){
            $o_item1=new orderitem();
            $catname=new category();
            $itemname=new item();
    
            $o_item1->orderitem_id=$row["orderitem_id"];
            $o_item1->order_id=$row["order_id"];
            $o_item1->orderitem_dt=$row["orderitem_dt"];
            $o_item1->orderitem_status=$row["orderitem_status"];
            $o_item1->orderitm_cat=$row["orderitm_cat"];
            $o_item1->cat_details=$catname->getbyid_category($o_item1->orderitm_cat);
            $o_item1->orderitm_name=$row["orderitm_name"];
            $o_item1->item_details=$itemname-> getitem_by_id($o_item1->orderitm_name);
            $o_item1->orderitm_purity=$row["orderitm_purity"];
            $o_item1->orderitm_quan=$row["orderitm_quan"];
            $o_item1->orderitm_weight=$row["orderitm_weight"];
            $o_item1->orderitm_size=$row["orderitm_size"];
            $o_item1->orderitm_unit=$row["orderitm_unit"];
            $o_item1->orderitem_ws_status=$row["orderitem_ws_status"];
          //  $o_item1->item_price=round($row["item_purity"]* $r->rate_gram/24*$row["item_grosswt"],2);
    
    
            $orderitemarray[]=$o_item1;
        }
        return $orderitemarray;
    
    }
    function getall_orderitem_byorderid($order_id){
        $sql="SELECT * FROM orderitem WHERE orderitem_status='ACTIVE' AND order_id=$order_id ";
        $result=$this->db->query($sql);
        $orderitemarray=array();
        while($row=$result->fetch_array()){
            $o_item1=new orderitem();
            $catname=new category();
            $itemname=new item();
    
            $o_item1->orderitem_id=$row["orderitem_id"];
            $o_item1->order_id=$row["order_id"];
            $o_item1->orderitem_dt=$row["orderitem_dt"];
            $o_item1->orderitem_status=$row["orderitem_status"];
            $o_item1->orderitm_cat=$row["orderitm_cat"];
            $o_item1->cat_details=$catname->getbyid_category($o_item1->orderitm_cat);
            $o_item1->orderitm_name=$row["orderitm_name"];
            $o_item1->item_details=$itemname-> getitem_by_id($o_item1->orderitm_name);
            $o_item1->orderitm_purity=$row["orderitm_purity"];
            $o_item1->orderitm_quan=$row["orderitm_quan"];
            $o_item1->orderitm_weight=$row["orderitm_weight"];
            $o_item1->orderitm_size=$row["orderitm_size"];
            $o_item1->orderitm_unit=$row["orderitm_unit"];
            $o_item1->orderitem_ws_status=$row["orderitem_ws_status"];
          
    
    
            $orderitemarray[]=$o_item1;
        }
        return $orderitemarray;
    
    }
    function getall_orderitem_statusorder(){
        $sql="SELECT * FROM orderitem WHERE orderitem_status='ACTIVE' AND orderitem_ws_status='ORDER' ";
        $result=$this->db->query($sql);
        $orderitemarray=array();
        while($row=$result->fetch_array()){
            $o_item1=new orderitem();
            $catname=new category();
            $itemname=new item();
    
            $o_item1->orderitem_id=$row["orderitem_id"];
            $o_item1->order_id=$row["order_id"];
            $o_item1->orderitem_dt=$row["orderitem_dt"];
            $o_item1->orderitem_status=$row["orderitem_status"];
            $o_item1->orderitm_cat=$row["orderitm_cat"];
            $o_item1->cat_details=$catname->getbyid_category($o_item1->orderitm_cat);
            $o_item1->orderitm_name=$row["orderitm_name"];
            $o_item1->item_details=$itemname-> getitem_by_id($o_item1->orderitm_name);
            $o_item1->orderitm_purity=$row["orderitm_purity"];
            $o_item1->orderitm_quan=$row["orderitm_quan"];
            $o_item1->orderitm_weight=$row["orderitm_weight"];
            $o_item1->orderitm_size=$row["orderitm_size"];
            $o_item1->orderitm_unit=$row["orderitm_unit"];
            $o_item1->orderitem_ws_status=$row["orderitem_ws_status"];
    
    
            $orderitemarray[]=$o_item1;
        }
        return $orderitemarray;
    
    }


    function getbyid_orderitem_list($id){
        $sql="SELECT * FROM orderitem WHERE  order_id='$id' ";
        $result=$this->db->query($sql);
        $orderitemarray=array();
        while( $row=$result->fetch_array())
        {
            $o_item2=new orderitem();
            $ordercatname=new category();
            $orderitemname=new item();
    
            $o_item2->orderitem_id=$row["orderitem_id"];
            $o_item2->order_id=$row["order_id"];
            $o_item2->orderitem_dt=$row["orderitem_dt"];
            $o_item2->orderitem_status=$row["orderitem_status"];
            $o_item2->orderitm_cat=$row["orderitm_cat"];
            $o_item2->catname=$ordercatname->getbyid_category($o_item2->orderitm_cat);
            $o_item2->orderitm_name=$row["orderitm_name"];
            $o_item2->name=$orderitemname->getitem_by_id($o_item2->orderitm_name);
            $o_item2->orderitm_purity=$row["orderitm_purity"];
            $o_item2->orderitm_quan=$row["orderitm_quan"];
            $o_item2->orderitm_weight=$row["orderitm_weight"];
            $o_item2->orderitm_size=$row["orderitm_size"];
            $o_item2->orderitm_unit=$row["orderitm_unit"];
            $o_item2->orderitem_ws_status=$row["orderitem_ws_status"];
    
            $orderitemarray[]=$o_item2;
        }
        return $orderitemarray;
    
    }
    
    function edit_orderitem($edito_itemid){
        $sql="UPDATE orderitem SET orderitm_cat='$this->orderitm_cat',orderitm_name='$this->orderitm_name',orderitm_purity='$this->orderitm_purity' ,orderitm_quan='$this->orderitm_quan', orderitm_weight='$this->orderitm_weight',orderitm_size='$this->orderitm_size',orderitm_req='$this->orderitm_req' WHERE orderitem_id='$edito_itemid' ";
        echo $sql; 
        $this->db->query($sql);
        }


    function del_orderitem($delo_itemid){
        $sql="UPDATE orderitem SET orderitem_status='INACTIVE' WHERE order_id='$delo_itemid'";
        $this->db->query($sql);
    }        

    function update_status_workshop($orderitemid){
        $sql="UPDATE orderitem SET orderitem_ws_status='WORKSHOP' WHERE orderitem_id=$orderitemid ";
        $this->db->query($sql);
        echo $sql;
        return true;
    }

    function update_order($orderitemid){
    //     $sql2="SELECT * FROM orders join orderitem  on orders.order_id=orderitem.order_id WHERE orderitem_ws_status='WORKSHOP' and orderitem_id=$orderitemid  ";
    //     $res=$this->db->query($sql2);
    // if($res->num_rows>0){
    //     $sqlcheck="UPDATE orders SET order_workstatus='WORKSHOP' WHERE order_status='ACTIVE'";
    //     $this->db->query($sqlcheck);
    //     echo $sqlcheck;
    //     return true;
    // }else{

    //   echo"error";
    // }
    $SQL="UPDATE orders set orders.order_workstatus=orderitem.orderitem_ws_status from orders inner join orderitem on orders.order_id=orderitem.order_id WHERE orderitem. orderitem_id=$orderitemid";
    $this->db->query($SQL);
        echo $SQL;
        return true;
    }









}

?>