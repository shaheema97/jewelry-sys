<?php

include_once ("../purchase/purchaseorderitem.php");
$orderitem=new purchaseorderitem();

if(isset($_GET['view'])){
    $result=$orderitem->getall_purchitem_byorderid($_GET['view']);
  //  print_r($result);
}

include_once ("../files/top_supp.php");
?>
<!-- Page-header start -->
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Manage Orders</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Order info</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    
                </div>
                <div class="card-block">
                <form action="">
                    <!-- table start -->
                    <div class="dt-responsive table-responsive">
                            <table  id="" class="table table-xs table-info nowrap table" style="width : 100% ,border:none;">
                                <thead>
                                <tr>
                                    <th>orderid</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Size</th>
                                    <th>Purity</th>
                                    <th>Weight</th>
                                    <th>Qty</th>
                                    <th>Available</th>
                                    <th>Qty</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                               
                               foreach($result as $item)
                                   {
                                       echo"
                                       <tr>
                                       <td>$item->purchorderitem_purch_id</td>
                                       <td>$item->purchorderitem_cat</td>
                                       <td>$item->purchorderitem_item</td>
                                       <td>$item->purchorderitem_size</td>
                                       <td>$item->purchorderitem_purity</td>
                                       <td>$item->purchorderitem_weight</td>
                                       <td>$item->purchorderitem_qty</td>";
                                     echo'  <td>
                                     <input type="checkbox" value="" class="form-control">
                                    </td>
                                       <td><input type="text" class="form-control"></td>
                                       
                                      
                                     
                                   </tr>
                                       ';
                                   }
                                 ?>   
                                  
                                </tbody>
                                
                            </table>
                        </div>

                    <!-- table end -->
                    <div class="form-group row">
                    <div class="d-flex flex-row-reverse">
                                <div class="p-2">
                                        <button type="submit" class="btn btn-success" style="float: right;">
                                        <i class="icofont icofont-plus"></i>
                                        Submit Invoice
                                        </button>
                                </div>
                                <div class="p-2">
                                        <button type="reset" class="btn btn-danger" style="float: right;">
                                        <i class="icofont icofont-ui-close"></i>
                                        Cancel
                                        </button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include_once ("../files/bottom_dt.php");

?>