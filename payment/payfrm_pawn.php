<?php

include_once ("../pawn/pawn.php");
$pawn4=new pawn();

include_once ("../pawn/pawnitem.php");
$pawnitem2=new pawnitem();

if(isset($_GET['view']))
{$pawn4= $pawn4->get_pawn_id2($_GET['view']);
$pawnitem2=$pawnitem2->get_pitem_id('view');

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
    $pawn4->update_pawnpayment($_POST['paytype_id'],$_POST['amt_pd']);

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
                    <form action="payfrm_pawn.php" method="POST">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="icofont icofont-file-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Invoice ID"  value="<?=$pawn4->pawn_id?>" name="paytype_id">
                                </div>
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-calendar "></i></span>
                                        <input type="date" class="form-control" placeholder="Date" name="paydt">
                                </div>
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control" value="<?=$pawn4->pawn_cus?>"  name="paycus">
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
                                
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                    <select id="" class="form-control" name=" " placeholder="">
                                        <option value=""  disabled selected hidden >Discount</option>
                                        <option value="Extended">Extended</option>
                                        <option value="Redeemed">Redeemed</option>
                                        <option value="Expired">Expired</option>
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
                                    <th>Retail Total:</th><td ><input type="text" class="form-control form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Tax:</th><td><input type="text" class="form-control form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Others</th><td style="border-bottom: 1pt solid black;"><input type="text" class="form-control form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Total:</th><td><input type="text" class="form-control form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Previous Tot:</th><td style="border-bottom: 1pt solid black;"><input type="text" class="form-control form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Grand Total:</th><td><input type="text" class="form-control form-control form-control-right" style="border: none;" placeholder="0.00"></td>
                                    </tr>
                                    <tr>
                                    <th>Amount Paid:</th><td><input type="text" name="amt_pd" class="form-control form-control form-control-right"  placeholder="0.00"></td>
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
                    <div class="card-body h-75 ">
                        <div class="row">
                            <!--<div class="col-sm-6"><input type="text" class="form-control"></div>
                            <div class="col-sm-6"><input type="text" class="form-control"></div>-->
                            <div class="table-responsive">
                                <table class="table table-xs " stlye="width:100%">
                                    <tbody>
                                        <tr>
                                            <th>Ticket No:</th>
                                            <td><?= $pawn4->pawn_id?></td>
                                            <th>Customer:</th>
                                            <td><?= $pawn4->cusname->cust_first_nm?></td>
                                        </tr>
                                        <tr>
                                            <th>Date:</th>
                                            <td><?= $pawn4->pawn_dt?></td>
                                            <th>Type:</th>
                                            <td><?= $pawn4->pawn_type?></td>
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
                                <th>Rate</th>
                                <th>Subtotal</th>
                                
                                </thead>
                                <tbody id="itembody">
                               
                                        
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