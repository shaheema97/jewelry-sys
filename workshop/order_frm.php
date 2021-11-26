<?php
include_once ("../item/category.php");
$cat3=new category();
$result_cat =$cat3->get_all_cat();
include_once ("../staff/staff.php");
$staff_order=new staff();
$result_emp=$staff_order->get_all();

include_once ("../item/item.php");
$item7=new item();
$result_item=$item7->get_all_item();

include_once ("../sales/order.php");
$order1=new order();

include_once ("../sales/orderitem.php");
$o_item=new orderitem();
 $res_order=$o_item->getall_orderitem_statusorder();

include_once ("../item/item.php");
$item7=new item();
$res_item=$item7->get_all_item();

include_once ("../workshop/workshop.php");
$ws_order=new workshop();

include_once ("../workshop/workshopitem.php");
$ws_orderitem=new workshopitem();

//include the file which has the notification class
include_once ("../notification/notification.php");
$notify=new notification();





if(isset($_POST["ordercraft"])){
    $ws_order->workshop_craftsman=$_POST["ordercraft"];
    $ws_order->workshop_staff=$_POST["orderemp"];
    $ws_order->workshop_date=$_POST["orderdate"];
    $ws_order->workshop_duedt=$_POST["orderduedate"];
    //$order1->order_goldrate=$_POST["ordergoldrate"];
   
       
    $itemid=$ws_order->insert_workshop();
    $ws_orderitem->add_workshopitem($itemid);
    $msg1="you have new order. ref : $itemid"; //notification message to be send
    $notify->insert_not($_POST["ordercraft"],$msg1); //function to save notification details
    echo '<script>
    setTimeout(function() {
        swal({
            title: "Inserted Successfully!",
            text: " Order submitted to workshop!",
            type: "success"
        }, function() {
            window.location = "../workshop/manage_workshop.php";
        });
        }, 1000);
        </script>';


//exit;

}



include_once ("../files/top.php");

?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
        <div class="card-block success-breadcrumb">
            <div class="breadcrumb-header">
                <strong>Sales Order</strong>
                <br>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#!">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    
                    <li class="breadcrumb-item"><a href="#!">Sales Order</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!-- Success-color Breadcrumb card end -->

<div class="page-body">
<div class="row"> <!--start top button-->
                    <div class="col-sm-12">
                        <div class="class-header">
                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                            <a href="manageorders.php" class="btn btn-sm btn-inverse" style="float: right;">
                                            <i class="fa fa-angle-double-left"></i>
                                            Back
                                            </a>
                                </div>
                                <div class="p-2">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#order-Modal" style="float: right;">
                                            <i class="icofont icofont-plus"></i>
                                            Order Items
                                            </button>
                                </div>
                                <div class="p-2">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#item-Modal" style="float: right;">
                                            <i class="icofont icofont-plus"></i>
                                            Item table
                                            </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div> <!--end top button -->
<!--card start -->
<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
        
                </div>
                <div class="card-block">
                    <form action="../workshop/order_frm.php" method="POST" >
                        <div class="form-group row">
                           
                            <div class="col-sm-3">
                                
                                <label class="col-form-label" >Craftsman</label>
                                <select id="" class="form-control form-control-primary " name="ordercraft" required>
                                <?php foreach ($result_emp as $item){
            
                                            echo "<option value='$item->st_id'>$item->st_firstname</option>	";
                                        }?>

                                </select>   
                               
                            </div>  
                            
                            <div class="col-sm-3">
                                <label class="col-form-label">Recieved By</label>
                                <select id="" class="form-control form-control-primary " name="orderemp" required>
                                <?php foreach ($result_emp as $item){
            
                                            echo "<option value='$item->st_id'>$item->st_firstname</option>	";
                                        }?>

                                </select>   
                            </div>
                            <div class="col-sm-3">
                                <label class="col-form-label" >Order Date</label>
                                <input type="date" class="form-control form-control-primary " value="" name="orderdate" required >
                            </div>

                            <div class="col-sm-3">
                                <label class="col-form-label" > Due Date</label>
                                <input type="date" class="form-control form-control-primary " value="" name="orderduedate" required >
                            </div>
               
                        <!--item info start -->

                        <!--item info end-->
                        <!--dynamic table-->
                        <table id="" class="table table-responsive " style="border:none;">
                            <thead></tr> 
                                    <th>Type</th>
                                    <th>Type/ID</th>
                                    <!-- <th>Item</th> -->
                                    <th>Description</th>
                                    <!-- <th>Gross Weight</th> -->
                                    <th>Quantity</th>
                                    <th>Action</th>
                                    <hr style='color:#000001;'>
                                </tr>
                            </thead>
                            <tbody id='itembody'>
                            
                            

                            </tbody>
                        </table>
                        <!--dynamic table-->
                        <!-- final values-->
                       
                        <!--final values -->
                        <!--button-->
                        <div class="col-sm-8"></div>
                        <div class="col-sm-4 d-flex flex-row-reverse">
                            <div class="p-2">
                                    <button type="submit" class="btn btn-success" style="float: right;">
                                    <i class="icofont icofont-plus"></i>
                                    Submit 
                                    </button>
                            </div>
                            <div class="p-2">
                                    <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#default-Modal" style="float: right;">
                                    <i class="icofont icofont-ui-close"></i>
                                    Cancel
                                    </button>
                            </div>
                        </div>
                        
                        <!-- button-->
                    </form>
                </div>
            </div>
        </div>
    </div><!--card end-->
    <!-- modal for order item  -->
    <div class="modal fade" id="order-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="dt-responsive table-responsive">
                    <table id="basic-btn" class="table table-striped table-bordered nowrap">
                        <thead>
                     
                            
                            
                            <th>O.ItemID</th>
                            <th>Orderid</th>
                            <th>Category</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Action</th>
                            
                        </thead>
                        <tbody>
                        <?php   
                        foreach($res_order as $item){
                        echo"<tr>
                                <td>$item->orderitem_id</td>
                               <td>$item->order_id</td>
                                <td>".$item->cat_details->cat_name."</td>
                                <td>".$item->item_details->name_item."</td>
                                <td>$item->orderitm_purity K, $item->orderitm_weight</td>
                                <td>$item->orderitm_quan </td>
                                <input type='hidden' id='typeo' value='order'>
                                    <td>
                                    <div class='btn-group btn-group-sm' style='float: none;'>
                                        <button onclick='addrows($item->order_id,$item->orderitem_id,$item->orderitm_purity,\"".$item->item_details->name_item."\",$item->orderitm_quan)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-plus'></span></button>
                                        
                                    </div>
                                    </td>
                            
                            </tr>";

                        }
                        ?>   
                        </tbody>     

                            
                        
                    
                    </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal for order item end -->
    <!-- modal for item list -->
    <div class="modal fade" id="item-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="dt-responsive table-responsive">
                    <table id="basic-btn" class="table table-striped table-bordered nowrap">
                        <thead>
                     
                            <th>Item/ID</th>
                            <th>Category</th>
                            <th>ItemName</th>
                            <th>Description</th>
                            <th>Size</th>
                            
                            <th>Available/qty</th>
                            <th>Qty</th>
                            <th>Action</th>
                            
                        </thead>
                        <tbody>
                        <?php   
                        foreach($res_item as $item){
                        echo"<tr>
                                <td>$item->item_id</td>
                                <td>".$item->catname->cat_name."</td>
                                <td>$item->name_item</td>
                                <td>$item->item_purity K,$item->item_weight</td>
                                <td>$item->item_size $item->item_unit</td>
                                <td>$item->item_quan</td>
                                <td><input type='text' class='form-control qty' style='width:70px'></td>
                                <input type='hidden' class='type' value='sales'>
                                    <td>
                                    <div class='btn-group btn-group-sm' style='float: none;'>
                                        <button onclick='additem($item->item_id,\"$item->name_item\",\"$item->item_purity \",\"$item->item_weight\",\"$item->item_size\",\"$item->item_unit\",this)' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-plus'></span></button>
                                        
                                    </div>
                                    </td>
                            
                            </tr>";

                        }
                        ?>   
                       
                        </tbody>     

                            
                        
                    
                    </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal for item list end -->
</div>


<?php 
include_once ("../files/bottom_dt.php");
?>

<script>


 

    function addrows(orderid,orderitemid,purity,weight,quan){
        
        type4=$("#typeo").val();
        //console.log(n2);
        console.log(weight);
        
        $("#itembody").append("<tr><td><input type='hidden' name='type1[]' value='"+type4+"' required>"+type4 +"</td><td><input type='hidden' name='typeid[]' value='"+orderitemid +"' required>"+orderitemid +"</td><input type='hidden' name='orderstat[]' value='"+orderid+"' required><td><input type='hidden'  value='' required>"+purity+"K</td><td><input type='hidden' name='itmquan[]' value='"+quan+"' required>"+quan +"</td><td><button type='button'  onclick='delete_row(this)' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td></tr>");
        // $("#itembody").append("<tr><td><input type='hidden' name='cat[]' value='"+category +"' required>"+cat +"</td><td><input type='hidden' name='itemname[]' value='"+itemname +"' required>"+name +"</td><td><input type='file' name='uimg[]' value='' required></td><td><input type='hidden' name='itmpurity[]' value='"+purity +"' required>"+purity +"</td><td><input type='hidden' name='itmquan[]' value='"+quantity +"' required>"+quantity +"</td><td><input type='hidden' name='itmweight[]' value='"+weight +"' required>"+weight +"</td><td><input type='hidden' name='size[]' value='"+size+"' required>"+size +"</td><td><input type='hidden' name='' value='"+price+"' required>"+price+"</td><td><button type='button'  onclick='' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td></tr>");
       
        }

        function additem(itemid,itemname,purity,weight,size,unit,n2){
        
        quan=$(n2).parent().parent().parent().find(".qty").val();
        console.log(quan);
        type3=$(".type").val();
        console.log(type3);

        console.log(purity);
        console.log(weight);
        
        
        // $("#itembody").append("<tr><td><input type='hidden' name='type[]' value='"+type3 +"' required>"+type3 +"</td><td><input type='hidden' name='typeid[]' value='"+itemid +"' required>"+itemid +"</td><td><input type='hidden' value='"+itemname +"' required>"+itemname +"</td><td><input type='hidden'  value=' required>"+purity+"K</td><td><input type='hidden' name='type[]' value='"+ +"' required>"size +"</td><td><input type='hidden' name='itmquan[]' value='"+quan +"' required>"+quan +"</td><td><input type='hidden' name='itmweight[]' value='"+weight +"' required>"+weight +"g</td><td><button type='button'  onclick='' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td></tr>");
         $("#itembody").append("<tr><td><input type='hidden' name='type1[]' value='"+type3 +"' required>"+type3 +"</td><td><input type='hidden' name='typeid[]' value='"+itemid +"' required>"+itemid +"</td><td><input type='hidden'  value='' required>"+purity+"K</td><td><input type='hidden' name='itmquan[]' value='"+quan+"' required>"+quan +"</td><td><button type='button'  onclick='delete_row(this)' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td></tr>");
        // <td><input type='hidden' name='type[]' value='"+ +"' required>"size +"</td><td><input type='hidden' name='itmquan[]' value='"+quan +"' required>"+quan +"</td><td><input type='hidden' name='itmweight[]' value='"+weight +"' required>"+weight +"g</td><td><button type='button'  onclick='' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td></tr>
        }

        function delete_row(x){
        $(x).parent().parent().remove();
        
     

    }
    
</script>

