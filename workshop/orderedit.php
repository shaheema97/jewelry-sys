<?php
include_once ("../workshop/workshop.php");
$order3=new workshop();
$result_order=$order3->getall_workshop_id($_GET['edit']);

include_once ("../workshop/workshopitem.php");
$orderitem3=new workshopitem();
$result_orderitem=$orderitem3-> getall_ws_item($_GET['edit']);

include_once ("../item/category.php");
    $cat3=new category();
    $result_cat =$cat3->get_all_cat();

include_once ("../files/top.php");
?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
        <div class="card-block success-breadcrumb">
            <div class="breadcrumb-header">
                <strong>Buy Gold</strong>
                <br>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#!">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    
                    <li class="breadcrumb-item"><a href="#!">Buy Gold</a>
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
                            <a href="manageorders.php" class="btn btn-sm btn-inverse" style="float: right;">
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
                        <form action="">
                            <!-- top card  -->
                            <div class="form-group row">
                           
                               <div class="col-sm-4">
                                    <label for="" class="col-form-label">Crafstman</label>
                                    <input type="text" class="form-control" readonly="" value="<?=$result_order->craftsman->st_firstname ?>">
                                </div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label">Invoice No</label>
                                    <input type="text" name="salesid" class="form-control" readonly="" value=" <?=$result_order->workshop_id?>"">
                                </div>
                                    
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label">Order Date</label>
                                    <input type="text"  class="form-control" readonly="" value="<?=$result_order->workshop_date?>">
                                </div>
                          </div>
                          <div class="form-group row">
                           
                               <div class="col-sm-4">
                                    <label for="" class="col-form-label">Due date</label>
                                    <input type="text" class="form-control" readonly="" value="<?=$result_order->workshop_duedt?>">
                                </div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label">Recieved by</label>
                                    <input type="text" name="salesid" class="form-control" readonly="" value="<?=$result_order->staff->st_firstname?>">
                                </div>
                                
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label">Status</label>
                                    <input type="text" name="salesid" class="form-control" readonly="" value=" <?=$result_order->workshop_status?>"">
                                </div>
                                    
                               
                          </div>
                            <!-- top card -->
                            <!-- order item table  -->
                            
                            <div class="table-responsive">
                                <table class="table table-styling table-hover table-striped">
                                    <thead>
                                        <tr class="table-primary">
                                            
                                            <!-- <th>Image</th> -->
                                            <th>Type</th>
                                            <th>Type/ID</th>
                                            <th>Category</th>
                                            <th>Item</th>
                                            <th>Purity</th>
                                            <th>Weight</th>
                                            <th>Size</th> -->
                                            <th>Quantity</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       foreach($result_orderitem as $item){
                                           echo"
                                         <tr> 
                                        <td>$item->wsitem_type</td>
                                        <td>$item->wsitem_typeid</td>
                                        <td>$item->ordercategory</td>
                                        <td>$item->ordername</td>
                                        <td>$item->orderweight</td>
                                        <td>$item->orderpurity K</td>
                                        <td>$item->ordersize</td>
                                        <td>$item->wsitem_quan</td>
                                        </tr>";
                                       }
                                       ?>
                                    </tbody>
                                </table>
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