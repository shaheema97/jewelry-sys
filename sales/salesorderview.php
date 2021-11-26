<?php

include_once ("../sales/order.php");
$sales4=new order();
include_once ("../sales/orderitem.php");
$salesitem4=new orderitem();

include_once ("../item/itemname.php");
$itemname3=new itemname();


$res_item=$itemname3->getall_itemname();
$res_sales=$sales4->getall_order_byid($_GET['edit']);
$res_sales_item=$salesitem4->getall_orderitem_byorderid($_GET['edit']);


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
                                        <td></td>
                                        <td>$item->orderitm_size</td>
                                        <td>$item->orderitm_unit</td>
                                        <td>$item->orderitm_purity</td>
                                        <td>$item->orderitm_weight</td>
                                        <td>'$item->orderitm_quan</td>
                                        <td>$item->orderitem_ws_status</td>
                                        
                                       
                                        </tr>";
                                       }
                                       ?>

                                      
                                    </tbody>
                                </table>
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