<?php


include_once ("../sales/sales.php");
$sales2=new sales();

include_once ("../sales/salesitem.php");
$s_item=new salesitem();

if(isset($_GET["view"])){
    $sales_res=$sales2->getsales_by_id($_GET['view']);
    $res_saleitem=$s_item->getitem_by_salesid($_GET['view']);
}

include_once ("payment.php");
$payment1=new payment();

if(isset($_POST["paycus"])){
    $payment1->pay_cust=$_POST["paycus"];
    $payment1->pay_date=$_POST["paydt"];
    $payment1->pay_type=$_POST["paytype"];
    $payment1->pay_type_id=$_POST["paytype_id"];
    $payment1->pay_amount=$_POST["amt_pd"];
    $payment1->insert_payment();    
    $sales2->update_pay_amount($_POST['paytype_id'],$_POST['amt_pd']);

}




 include_once ("../files/top.php");

?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
            <div class="card-block success-breadcrumb">
                <div class="breadcrumb-header">
                    <h2></h2>
                    
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#!">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        
                        <li class="breadcrumb-item"><a href="#!">Payment</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
<!-- Success-color Breadcrumb card end -->
<div class="page-body">
    <div class="row">
        <div class="col-lg-12 col-xl-6">
        <div class="card h-100 border border-dark  ">
            <div class="card-block bg-primary"><div class="card-title"><h3>INVOICE CHECKOUT</h3></div></div>
                <div class="card-block  ">
                    <form action="payfrm_sales.php" method="POST">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="icofont icofont-file-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Invoice ID" value="<?=$sales_res->sales_id ?>" name="paytype_id">
                                </div>
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-calendar "></i></span>
                                        <input type="date" class="form-control" placeholder="Date" name="paydt">
                                </div>
                                 <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control" value="<?=$sales_res->sales_cus?>"  name="paycus">
                                </div>
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                    <select id="" class="form-control" name=" " placeholder="">
                                        <option value=""  disabled selected hidden >Discount</option>
                                        <option value="Extended">Extended</option>
                                        <option value="Redeemed">Redeemed</option>
                                        <option value="Expired">Expired</option>
                                    </select>
                                </div>
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <select id="" class="form-control" name="paytype" placeholder="">
                                        <option  name="paytype" value=""  style="font-color:'grey'" disabled selected hidden >Payment Type</option>
                                        <option  name="paytype" value="sales">Sales</option>
                                        <option  name="paytype" value="pawn">Pawn</option>
                                        <option  name="paytype" value="oldgold">Old Gold Buy</option>
                                    </select>
                                </div>
                                <tr>
                                    <th>Payment Method:</th><td></td>
                                    </tr><br>
                                    <tr>
                                        <td><button type="button" class="btn btn-default btn-mini" style=" border: 2px solid purple;"> Cash</button>
                                        <button type="button" class="btn btn-default btn-mini" style=" border: 2px solid purple;" data-toggle="modal" data-target="#default-Modal">Card</button>
                                        <button type="button" class="btn btn-default btn-mini" style=" border: 2px solid purple;" data-toggle="modal" data-target="#default-Modal-bank">Cheque</button></td>
                                    </tr><br><br>
                            <table class="table-sm table-responsive table-borderless"    >
                                <tbody>
                                
                                    <tr></tr>
                                    <tr>
                                        <TD style="text-align: center"><button type="submit" class=" btn btn-primary btn-sm " style="width:120px">Process Payment</button></TD>
                                    </tr>
                                    <tr>
                                        <TD style="text-align: center"><button class=" btn btn-success btn-sm" style="width:120px">Print   Reciept</button></TD>
                                    </tr>
                                    <tr>
                                        <TD style="text-align: center"><button class=" btn btn-danger btn-sm" style="width:120px">Cancel Payment</button></TD>
                                    </tr>
                                
                                </tbody>
                            </table>
                            </div>
                            <div class="col-sm-6"> <!-- tbl-->
                                <table class="table-sm  table-responsive   table-borderless">
                                    <tr>
                                    <th>Sub Total:</th><td><input type="text" class="form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Interest:</th><td style="border-bottom: 1pt solid black;"><input type="text" class="form-control form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Retail Total:</th><td ><input type="text" value="<?=$sales_res->sales_subtot ?>" class="form-control form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Tax:</th><td><input type="text" class="form-control form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Discount</th><td style="border-bottom: 1pt solid black;"><input type="text" value="<?=$sales_res->sales_totdisc?>" class="form-control form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Total:</th><td><input type="text" class="form-control form-control form-control-right" value="<?=$sales_res->sales_nettot?>" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Previous Tot:</th><td style="border-bottom: 1pt solid black;"><input type="text" value="<?=$sales_res->sales_paid_amt?>" class="form-control form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Grand Total:</th><td><input type="text" class="form-control form-control form-control-right" value="<?=$sales_res->sales_due_amt?>" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Amount Paid:</th><td><input type="text" class="form-control form-control form-control-right"  placeholder="0.00" name="amt_pd"></td>
                                    </tr>
                                    <tr>
                                    <th>Change Due:</th><td><input type="text" class="form-control form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>


                                </table>
                            </div><!-- tbl-->
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-6">
            <div class="card h-100 border border-dark">
                
                <div class="card-block bg-primary"><div class="card-title"><h3>INVOICE DETAILS</h3></div></div>
                <div class="card-block">
                    <div class="card-body  ">
                        <div class="row">
                            <!--<div class="col-sm-6"><input type="text" class="form-control"></div>
                            <div class="col-sm-6"><input type="text" class="form-control"></div>-->
                            <div class="table-responsive">
                                <table class="table table-xs ">
                                    <tbody>
                                        <tr>
                                            <th>Invoice ID:</th>
                                            <td><?=$sales_res->sales_id ?></td>
                                            <th>Customer:</th>
                                            <td><?=$sales_res->cust_name->cust_first_nm ?></td>
                                        </tr>
                                        <tr>
                                            <th>Date:</th>
                                            <td><?=$sales_res->sales_date ?></td>
                                            <th>Type:</th>
                                            <td>SALES</td>
                                        </tr>
                                        <tr>
                                        
                                        </tr>
                                        <tr>
                                        <th>Payment Type:</th>
                                        <td></td>
                                        <th>Due Date:</th>
                                        <td></td>
                                        </tr>
                                    </tbody>
                                
                                </table>

                                <div class=" table-responsive">
                                <table class="table table-sm  table-striped h-75">
                                <thead>
                                
                                <th>Item Description</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Subtotal</th>
                                
                                </thead>
                                <tbody id="itembody">
                                    <?php
                                        foreach($res_saleitem as $item){
                                            echo"
                                                <td>".$item->itemname->item_name."|".$item->itemname->item_purity."K|".$item->itemname->item_grosswt."</td>
                                                <td>$item->salesitem_qty</td>
                                                <td>$item->salesitem_price</td>
                                                <td>$item->salesitem_nettprice</td>
                                            ";
                                        }

                                    ?>
                                        
                                        
                                </tbody>
                                <tfoot>
                                <td></td>
                                <td></td>
                                <th>Subtotal:</th>
                                <th>
                                </th>
                                </tfoot>

                                
                                </table>
                            
                            </div>
                        
                        </div>
                        
                    </div>
                    <div class="card-footer">
                    <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                    
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--Modal 1 -->
    <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Card Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5></h5>
                    <div class="col-sm-12">
                        <form action="">
                            <div class="form-group">
                                <label for="" class="col-form-label">Card Holder's Name</label>
                                <input type="text" class="form-control">
                                <label for="" class="col-form-label">Card Number</label>
                                <input type="text" class="form-control">
                                <label for="" class="col-form-label">Card Expirary Date</label>
                                <div class="row">
                               
                                    <div class="col-sm-4"><input type="text" class="form-control"></div>
                                    <div class="col-sm-4"><input type="text" class="form-control"></div>
                                    <div class="col-sm-4"><input type="text" class="form-control" placeholder="CVC"></div>
                                </div>
                                <label for="" class="col-form-label">Tendered Amount</label>
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control">
                                </div>

                            
                            </div>
                        
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal 1 -->
    <!--Modal 2 -->
    <div class="modal fade" id="default-Modal-bank" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cheque Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5></h5>
                    <div class="col-sm-12">
                        <form action="">
                            <div class="form-group">
                                <label for="" class="col-form-label">Bank Name</label>
                                <input type="text" class="form-control">
                                <label for="" class="col-form-label">Accout Number</label>
                                <input type="text" class="form-control">
                                
                                <label for="" class="col-form-label">Tendered Amount</label>
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control">
                                </div>

                            
                            </div>
                        
                        </form>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal 2-->
</div>

<?php
 include_once ("../files/bottom.php");
?>