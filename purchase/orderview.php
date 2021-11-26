<?php
include_once ("../files/top.php");
include_once ("../purchase/purchaseorder.php");
$purch4=new purchaseorder();
include_once ("../purchase/purchaseorderitem.php");
$purchitem=new purchaseorderitem();

include_once ("../item/itemname.php");
$itemname3=new itemname();
$res_item=$itemname3->getall_itemname();

$res_purch=$purch4->get_all_purch_byorderid($_GET['edit']);

$res_purch_item=$purchitem-> getall_purchitem_byorderid($_GET['edit']);


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
                               
                               <label class="col-form-label" >Supplier</label>
                               <input type="text" class="form-control" readonly="" value="<?=$res_purch->supp_name->sup_firstname ?>">
                            </div>  
                           
                           <div class="col-sm-4">
                               <label class="col-form-label">Recieved By</label>
                               <input type="text" name="salesid" class="form-control" readonly="" value=" <?=$res_purch->emp_name->st_firstname?>">
                           </div>
                           <div class="col-sm-4">
                               <label class="col-form-label" >Order ID</label>
                               <input type="text" class="form-control form-control-primary " readonly=""  value="<?=$res_purch->purchorder_id ?>" name="orderdate" required >
                           </div>

                           
                       </div>
                       <div class="for-group row">
                       <div class="col-sm-4">
                               <label class="col-form-label" >Order Date</label>
                               <input type="date" class="form-control form-control-primary " readonly=""  value="<?=$res_purch->purchorder_date ?>" name="orderdate" required >
                           </div>
                            

                       </div>
                            <!-- top card -->
                            <!-- order item table  -->
                            
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
                                           
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
 <?php
                                      foreach($res_purch_item as $item){
                                        echo"
                                      <tr> 
                                     <td>$item->purchorderitem_cat</td>
                                     <td>$item->purchorderitem_item</td>
                                     <td>$item->purchorderitem_size</td>
                                     <td>$item->purchorderitem_unit</td>
                                     <td>$item->purchorderitem_purity  K</td>
                                     <td>$item->purchorderitem_weight</td>
                                    
                                     <td>$item->purchorderitem_qty</td>
                                     
                                    
                                     </tr>";
                                    }
                                    ?>
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