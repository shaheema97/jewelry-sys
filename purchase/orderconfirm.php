<?php
    session_start();
    include_once ("../supplier/supplier.php");
    $purch_sup2=new supplier();
    $result_sup2=$purch_sup2-> get_supp_byid($_SESSION["purchorder"]["p_ordersup"]);

    include_once ("../staff/staff.php");
    $purch_staff2=new staff();
    $result_staff2=$purch_staff2->get_all_byid($_SESSION["purchorder"]["p_ordersemp"]);

    
    include_once ("../purchase/purchaseorderitem.php");
    $p_item=new purchaseorderitem();
    $result_pitem=$p_item->getall_purchitem_byorderid($_SESSION["invoiceid"]);
   // print_r($result_pitem);

    include_once ("../files/top.php");


    
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
                    <li class="breadcrumb-item"><a href="#!">Purchse Order</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Confirmation</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- top buutons start -->
    <div class="d-flex flex-row-reverse">
        <div class="p-2">
        <a href="" class="btn btn-inverse  btn-sm">
        <i class="icofont icofont-ui-plus"></i><br>
        New Order</a>
        </div>
        <div class="p-2">
        <a href="" class="btn btn-inverse  btn-sm">
        <i class="icofont icofont-ui-search"></i><br>
        Manage order</a>
        </div>
        <div class="p-2">
        <a href="" class="btn btn-inverse  btn-sm">
        <i class="icofont icofont-ui-delete"></i><br>
        Delete Order</a>
        </div>
    </div>
    <!-- top buttons end -->

    <!-- order details start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
            <?php
                        if(isset($_SESSION['success2']) && $_SESSION['success2']!= ''){
                            echo'<div class="card-block bg-success" id="msg" onload="fademsg()"><h5>'.$_SESSION['success2'].'</h5></div>';
                        }
                        
                    
                    ?>
                <div class="card-block">
                    <form action="">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label">Supplier</label>
                                    <input type="text" class="form-control" value="<?=$result_sup2->sup_firstname?>">
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label">Date</label>
                                    <input type="text" class="form-control" value="<?=$_SESSION["purchorder"]["p_orderdate"]?>">
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label">Recieved by</label>
                                    <input type="text" class="form-control" value="<?=$result_staff2->st_firstname?>">
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label">Order id</label>
                                    <input type="text" class="form-control" value="<?=$_SESSION["invoiceid"]?>">
                                </div>

                            </div>
                        </div>
                        <h5 class="sub-title">Item Info</h5>
                        <!-- table of item -->
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table table-xs table-info nowrap table" style="width : 100% ,border:none;">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Size</th>
                                    <th>Purity</th>
                                    <th>Weight</th>
                                    <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach( $result_pitem as $item){
                                            echo"
                                <tr>
                                
                                <td>".$item->itemcat->cat_name."</td>
                                <td>".$item->itemname->item_name."</td>
                                <td>$item->purchorderitem_size</td>
                                <td>$item->purchorderitem_purity</td>
                                <td>$item->purchorderitem_weight</td>
                                <td>$item->purchorderitem_qty</td>

                            </tr>
                                
                                ";
                                        }

                                    ?>
                                  
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th>Total Quantiy</th>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                         <!-- table of item -->

                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- order details end -->
    <!-- button start -->
    <div class="d-flex justify-content-center">
                    <div class="p-2">
                            <a href="manage_purchorder.php" id="" class="btn btn-success" >
                            <i class="icofont icofont-tick-mark"></i>
                            DONE
                            </a>
                    </div>
                    <!-- <div class="p-2">
                            <a href="order_frm.php" id="paylater" class="btn btn-inverse" >
                            <i class="icofont icofont-plus"></i>
                            Make Payment Later
                            </a>
                    </div> -->
                    <!-- <div class="p-2">
                            <button type="button" class="btn btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                           Manage purchase invoice
                            </button>
                    </div> -->
                </div>


                <!-- buttons end -->
    
<?php
    include_once ("../files/bottom.php");

?>