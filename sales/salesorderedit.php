<?php

include_once ("../sales/order.php");
$sales4=new order();
include_once ("../sales/orderitem.php");
$salesitem4=new orderitem();

include_once ("../item/itemname.php");
$itemname3=new itemname();

if(isset($_POST['uid'])){
    //update function
 $salesitem4->update_orderitem($_POST['uid']);

 

 $res_item=$itemname3->getall_itemname();
$res_sales=$sales4->getall_order_byid($_GET['edit']);
$res_sales_item=$salesitem4->getall_orderitem_byorderid($_GET['edit']);
echo '<script>
        setTimeout(function() {
            swal({
                title: "Order updated!",
                text: "Order info is updated!",
                type: "success"
            }, function() {
                window.location = "../sales/manageorders.php.";
            });
            }, 1000);
            </script>';
   
}
else{

$res_item=$itemname3->getall_itemname();
$res_sales=$sales4->getall_order_byid($_GET['edit']);
$res_sales_item=$salesitem4->getall_orderitem_byorderid($_GET['edit']);
}

//update order item details
include_once ("../files/top.php");


?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
        <div class="card-block success-breadcrumb">
            <div class="breadcrumb-header">
                <strong>Edit order</strong>
                <br>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#!">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="../sales/manageorders.php">Orders</a>
                    </li>
                    <li class="breadcrumb-item"><a href="../sales/salesorderedit.php">OrderEdit</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!-- Success-color Breadcrumb card end -->
<div class="page-body">
    <!--start top button-->
    <div class="col-sm-12">
        <div class="class-header">
            <div class="d-flex">
                <div class="mr-auto p-2">
                            <a href="../sales/manageorders.php" class="btn btn-sm btn-inverse" style="float: right;">
                            <i class="fa fa-angle-double-left"></i>
                            Back
                            </a>
                </div>
                <div class="p-2">
                
            </div>
        </div>
    </div>
    <!--end top button -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-block">
                        <form action="salesorderedit.php?edit= <?= $res_sales->order_id ?>" method="POST">
                            <!-- top card  -->
                            <div class="form-group row">
                           
                           <div class="col-sm-4">
                               
                               <label class="col-form-label" >Customer</label>
                               <input type="text" class="form-control form-control-primary" readonly="" value="<?=$res_sales->order_cus_name->cust_first_nm ?>">
                            </div>  
                           
                           <div class="col-sm-4">
                               <label class="col-form-label">Recieved By</label>
                               <input type="text" name="salesid" class="form-control form-control-primary" readonly="" value=" <?=$res_sales->order_emp_name->st_firstname?>">
                           </div>
                           <div class="col-sm-4">
                               <label class="col-form-label" >Order ID</label>
                               <input type="text" class="form-control form-control-primary " readonly  value="<?=$res_sales->order_id ?>"  required >
                           </div>

                           
                       </div>
                       <div class="for-group row">
                        <div class="col-sm-4">
                               <label class="col-form-label" >Order Date</label>
                               <input type="text" class="form-control form-control-primary " readonly  value="<?=$res_sales->order_date  ?>" name="" required >
                           </div>
                           <div class="col-sm-4">
                               <label class="col-form-label" >Order Due Date</label>
                               <input type="text" class="form-control form-control-primary " readonly  value="<?=$res_sales->order_duedate ?>" name="" required >
                           </div>

                       </div>
                            <!-- top card -->
                            <!-- order item table  -->
                        <div class="card-body">    
                            <div class="table-responsive">
                                <table class="table table-styling table-hover table-striped">
                                    <thead>
                                        <tr class="table-primary">
                                            <th>Category</th>
                                            <th>Item</th>
                                            <th>Size</th>
                                            <th>Unit</th>
                                            <th>Purity</th>
                                            <th>Weight</th>
                                            <th>Quantity</th>
                                           
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
 <?php
                                       foreach($res_sales_item as $item){
                                           echo"
                                         <tr> 
                                        <td>".$item->cat_details->cat_name."</td>
                                        <td> <select id='' class='form-control' name='itemname[]' style='witdh:150px'>";
                                        foreach ($res_item as $item1){
                                            if($item1->itemname_id==$item->orderitm_name)
                             
                             echo "<option value='$item1->itemname_id'  selected='selected'>$item1->item_name</option>	";
                             else
                             echo "<option value='$item1->itemname_id'>$item1->item_name</option>	";
                         }
                                      echo"</select></td>  <td><input class='form-control' value='$item->orderitm_size' name='size[]'></td>
                                        
                                        <td>
                                        <select id='' class='form-control' name='unit[]'>
                                        <option value=''></option>
                                        <option value='mm' name='unit[]'  ";
                                        if($item->orderitm_unit=='mm') echo "selected='selected'";
                                        echo ">cm</option>
                                        <option value='cm' name='unit[]'  ";
                                        if($item->orderitm_unit=='cm') echo "selected='selected'";
                                        echo ">mm</option>
                                        <option value='inch' name='unit[]'  ";
                                        if($item->orderitm_unit=='inch') echo "selected='selected'";
                                        echo ">inch</option>
                                        
                                       
                                        
                                        
                                    </select></td>
                                       
                                        <td>
                                        <select id='' class='form-control' name='itmpurity[]'>
                                        <option value=''></option>
                                        <option value='18' name='itmpurity[]'  ";
                                        if($item->orderitm_purity=='18') echo "selected='selected'";
                                        echo ">18</option>
                                        <option value='19' name=itmpurity[]'  ";
                                        if($item->orderitm_purity=='19') echo "selected='selected'";
                                        echo ">19</option>
                                        <option value='20' name='itmpurity[]'  ";
                                        if($item->orderitm_purity=='20') echo "selected='selected'";
                                        echo ">20</option>
                                        <option value='21' name='itmpurity[]'  ";
                                        if($item->orderitm_purity=='21') echo "selected='selected'";
                                        echo ">21</option>
                                        <option value='22' name='itmpurity[]'  ";
                                        if($item->orderitm_purity=='22') echo "selected='selected'";
                                        echo ">22</option>
                                        <option value='23' name='itmpurity[]'  ";
                                        if($item->orderitm_purity=='23') echo "selected='selected'";
                                        echo ">23</option>
                                        <option value='24' name='itmpurity[]'  ";
                                        if($item->orderitm_purity=='24') echo "selected='selected'";
                                        echo ">24</option>

                                        
                                        
                                        
                                    </select></td>
                                        <td><input class='form-control' value='$item->orderitm_weight' name='itmweight[]'></td>
                                       
                                        <td><input class='form-control' value='$item->orderitm_quan' name='itmquan[]'></td>
                                        <td>$item->orderitem_ws_status</td>
                                       
                                        </tr>";
                                       }
                                       ?>

                                       <?php
                                        if(isset($_GET["edit"])){
                                            echo"  <input type='hidden'  class='form-control' value='".$_GET['edit'] ."' name='uid' required>";
                                           }
                                       ?>
                                       
                                    </tbody>
                                </table>
                              </div>  

                            </div>
                            <div class="d-flex flex-row-reverse">
                                <div class="p-2">
                                        <button type="submit" class="btn btn-success" style="float: right;">
                                        <i class="icofont icofont-plus"></i>
                                       Edit Order
                                        </button>
                                </div>
                                
                            </div>
                           
                            <!-- order item table -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</div>

<?php
include_once ("../files/bottom.php");
?>