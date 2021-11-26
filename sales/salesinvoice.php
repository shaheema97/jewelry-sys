<?php 

include_once ("../sales/sales.php");
 $sales2=new sales();
 
 
 include_once ("salesitem.php");
 $salesitem2=new salesitem(); 
 
 include_once ("../staff/staff.php");
$sales_staff=new staff();


include_once ("../payment/payment.php");
$salespay=new payment();

include_once ("../customer/account.php");
$cus_account=new account();

$result_sales=$sales2->cal_paytot_sales($_GET['view']);
    $result_sales2=$salesitem2->getitem_by_salesid($_GET['view']);
    $res_ammount=$cus_account->cal_tot_credit( $result_sales->sales_cus);



include_once ("../files/top.php");


?>

<div  class="card">
    <div class="row invoice-contact">
    <div class="col-md-8">
    <div class="invoice-box row">
    <div class="col-sm-12">
    <table class="table table-responsive invoice-table table-borderless">
    <tbody>
    <tr>
    <td><img src="..\files\assets\images\logo-blue.png" class="m-b-10" alt=""></td>
    </tr>
    <tr>
    <th><h3>New Star Jewellers</h3></th>
    </tr>
    <tr>
    <td> No,85 Kotugodella Street Kandy</td>
    </tr>
    <tr>
    <td><a href="..\..\..\cdn-cgi\l\email-protection.htm#99fdfcf4f6d9fef4f8f0f5b7faf6f4" target="_top"><span class="__cf_email__" data-cfemail="690d0c0406290e04080005470a0604">[email&#160;protected]</span></a>
    </td>
    </tr>
    <tr>
    <td>+94 81-22-32-184</td>

    </tbody>
    </table>
    </div>
    </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
<!-- End of header 1 -->
    <div class="card-block">
            <!-- Start of header 2-->
            <div class="row invoive-info">
                <div class="col-md-4 col-xs-12 invoice-client-info">
                    <h6>Customer Information : </SPAN></h6>
                    <p class="m-0 m-t-10"><span><?=$result_sales->cust_name->cust_first_nm ?></span><span><?=$result_sales->cust_name->cust_last_nm ?></span></p>
                    <p class="m-0 m-t-10"><?=$result_sales->cust_name->cust_add ?></p>
                    <p class="m-0"><?=$result_sales->cust_name->cust_mob1 ?></p>
                    
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6>Sales Information :</h6>
                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                        <tbody>
                            <!-- <tr>
                                <th>Status :</th>
                                <td>
                                    <span class="label label-warning"></span>
                                </td>
                            </tr> -->
                            <tr>
                                <th>Date :</th>
                                <td><?=$result_sales->sales_date?></td>
                            </tr>
                            <!-- <tr>
                                <th>Period:</th>
                                <td>&nbsp<span>months</span></td>
                            </tr> -->
                            <tr>
                                <th>Due Date :</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Staff:</th>
                                <td><?=$result_sales->emp_name->st_firstname ?></td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Invoice Number :<span><?=$result_sales->sales_id ?></span></h6>
                    <h6 class="text-uppercase text-success">Total Paid :
                        <span><?=$result_sales->sales_paid_amt?></span>

                    </h6>
                    <h6 class="text-uppercase text-danger">Total Due :
                        <span><?=$result_sales->sales_due_amt?></span>

                    </h6>
                </div>
            </div>
            <!-- END of header 2-->
            <!-- START of item table-->
            <div class="row">
                <div class="col-sm-12 table-border-style">
                    <div class="table-responsive">
                        <table class="table table table-borderless">
                            <thead>
                                <tr class="thead-default">
                                    <th>Item Description</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Nett Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($result_sales2 as $item){
                                        echo " <tr>
                                        
                                        <td><span>".$item->itemname->item_name."<span>
                                        <span> ".$item->itemname->item_purity." K</span>
                                        <span> ".$item->itemname->item_size." ".$item->itemname->item_unit."</pan>
                                        <pan> ".$item->itemname->item_grosswt."g</span></td>
                                        <td class='text-center'>$item->salesitem_qty</td>
                                        <td class='text-center'>$item->salesitem_price</td>
                                        <td class='text-center'>$item->salesitem_discount</td>
                                        <td class='text-center'>$item->salesitem_nettprice</td>
                                           
                                       </tr>";
                                
                                    }
                                
                                ?>

                            </tbody>                            
                               
                            
                        </table>
                    </div>
                </div>
            </div>
            <!-- END of item table-->
            <!--start of invoice table -->
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-responsive invoice-table invoice-total">
                        <tbody>
                            <tr>
                                <th>Sub total :</th>
                                <td><?=$result_sales->sales_subtot?></td>
                            </tr>
                            <tr>
                                <th>Discount Total:</th>
                                <td><?=$result_sales->sales_totdisc?></td>
                            </tr>
                            
                            <tr class="text-info">
                                <td>
                                    <hr>
                                    <h5 class="text-primary">Nett Total :</h5>
                                </td>
                                <td>
                                    <hr>
                                    <h5 class="text-primary"><?=$result_sales->sales_nettot?></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--End of invoice table -->
            
            <!--start of invoice note -->
            <div class="row">
                <div class="col-sm-12">
                    <h6>Terms And Condition :</h6>
                    <p>lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor </p>
                </div>
            </div>
            <!--end of invoice note -->
            <!--start of buttons -->
            <div class="row text-center">
                <div class="col-sm-12 invoice-btn-group text-center">
                    <button type="button" class="btn btn-primary btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20">Print</button>
                    <button type="button" class="btn btn-danger waves-effect m-b-10 btn-sm waves-light">Cancel</button>
                </div>
            </div>
            <!--end of buttons -->


    </div>

</div>


<?php
include_once ("../files/bottom.php");
?> 