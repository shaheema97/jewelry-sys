<?php
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
                    <li class="breadcrumb-item"><a href="#!">BuyGold</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Payments</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
    <div class=""> <!--start 1 -->
        <div class="">
           
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                            <a href="managesales.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-ui-delete"></i><br>
                           Delete Invoice
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="order_frm.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-printer"></i><br>
                            Print Invoice
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="order_frm.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-search"></i><br>
                           Search Invoice
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="order_frm.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-plus"></i><br>
                            New Invoice
                            </a>
                    </div>
                </div>
            
        </div>
    </div> <!--end 1 -->
</div>
<!-- start of invoice details-->
<form action="">
        <div class="row">
            <div class="col-sm-12">
                <div class="card ">
                    <div class="card bg-primary"><h4 style="text-align:center">INVOICE DETAILS</h4></div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table-xs" style="width : 100% ;border:none;">
                                <tr>
                                    <th>Customer</th>
                                    <td><input type="text" class="form-control form-control-sm"></td>
                                    <th>Payment</th>
                                    <td><input type="text" class="form-control  form-control-sm"></td>
                                    <th>Invoice ID</th>
                                    <td><input type="text" class="form-control form-control-sm"></td>

                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td><input type="text" class="form-control form-control-sm"></td>
                                    <th>Due Date</th>
                                    <td><input type="text" class="form-control form-control-sm"></td>
                                    <th>Recieved by</th>
                                    <td><input type="text" class="form-control form-control-sm"></td>

                                </tr>
                            </table>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table table-xs  table-fixed table-info nowrap table" style="width : 100% ,border:none;">
                               <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Purity</th>
                                        <th>Weight</th>
                                        <th>Nett Weight</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>F.Price</th>
                                    </tr>
                               </thead>
                               <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th>Taxes</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                    <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th>Total Discount</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>56</td>
                                        <td>bangle</td>
                                        <td>bangle abds</td>
                                        <td>18k</td>
                                        <td>45g</td>
                                        <td>45g</td>
                                        <td>56</td>
                                        <td>7894563</td>
                                        <td>7875453</td>
                                    </tr>
                                    <tr>
                                        <td>56</td>
                                        <td>bangle</td>
                                        <td>bangle abds</td>
                                        <td>18k</td>
                                        <td>45g</td>
                                        <td>45g</td>
                                        <td>56</td>
                                        <td>7894563</td>
                                        <td>7875453</td>
                                    </tr>
                               </tbody>
                               </table>

                               <table  class="table-xs" style="width: auto;margin-right: 0px;margin-left: auto;" >
                                        <tr>
                                        <TH ></TH>
                                        <td style="" class="f-16 f-w-100"></td>
                                        
                                        
                                        <th>Total</th>
                                        <td style="" class="f-16 f-w-100">896235.5</td>
                                       
                                        <th>Payments</th>
                                        <td style=" " class="f-16 f-w-300">500000</td>
                                       
                                       <th>Payments Due</th>
                                        <td style="" class="f-16 f-w-300">300000</td>

                                       
                                       </tr>


                               </table>
                              
                                
                               
                            
                        </div>
                    
                    </div>
                </div>

                <!-- button start -->
                <div class="d-flex justify-content-center">
                    <div class="p-2">
                            <button type="button" id="paynow" class="btn btn-success" >
                            <i class="icofont icofont-plus"></i>
                            Make Payment Now
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="order_frm.php" id="paylater" class="btn btn-inverse" >
                            <i class="icofont icofont-plus"></i>
                            Make Payment Later
                            </a>
                    </div>
                    <!-- <div class="p-2">
                            <button type="button" class="btn btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                           Manage purchase invoice
                            </button>
                    </div> -->
                </div>


                <!-- buttons end -->
            </div>
        </div>

    <!-- end of invoice details-->
    <!-- start of invoice checkout-->
    <div class="row">
        <div class="col-sm-12">
            <div class="card " id="invoicecheckout">
                <div class="card bg-primary"><h4 style="text-align:center">INVOICE CHECKOUT</h4></div>
                <div class="card-block">
                    <div class=" row">
                            <div class="col-sm-1">
                            <label class="col-form-label">Type</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-info">
                                <span class="input-group-addon"><i class="fa fa-calendar "></i></span>
                                    <input type="input" class="form-control" placeholder="type">
                                </div>
                           </div>
                            <div class="col-sm-2"><label class="col-form-label">Payment Type</label></div>
                            <div class="col-sm-6 ">
                                <div class="d-flex justify-content-around">
                                    <button  type="button" class="btn btn-sm btn-primary" >Cash</button>
                                    <button  type="button" class="btn  btn-mini btn-warning" data-toggle="modal" data-target="#default-Modal">Card</button>
                                    <button  type="button" class="btn btn-mini btn-inverse"  data-toggle="modal" data-target="#default-Modal-bank">Cheque</button>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-sm-1">
                            <label class="col-form-label">Date</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-info">
                                <span class="input-group-addon"><i class="fa fa-calendar "></i></span>
                                    <input type="date" class="form-control " placeholder="Date">
                                </div>
                           </div>
                            <div class="col-sm-2"><label class="col-form-label">Amount Tendered</label></div>
                            <div class="col-sm-6"><input type="text" class="form-control form-control-primary"></div>
                    </div>
                    <div class=" row">
                            <div class="col-sm-1">
                            <label class="col-form-label">Staff</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <select id="" class="form-control" name=" " placeholder="">
                                        <option value=""  style="font-color:'grey'" disabled selected hidden >Recieved By</option>
                                        
                                    </select>
                                </div>
                           </div>
                            <div class="col-sm-2"><label class="col-form-label">Balance Amount</label></div>
                            <div class="col-sm-6"><input type="text" class="form-control form-control-danger"></div>
                    </div>
                
                    <div class="  ">
                        <div class="d-flex  flex-row-reverse">
                            <div class="p-2">  <button type="reset" class="btn btn-danger"><i class="icofont  icofont-ui-close"></i>CANCEL</button></div>
                            <div class="p-2"> <button  type="button" class="btn btn-inverse"><i class="icofont icofont-printer"></i>PRINT RECEIPT</button></div>
                            <div class="p-2"> <button type="submit" class="btn btn-success"><i class="icofont icofont-tick-mark"></i>PROCESS PAYMENT</button></div>
                            
                        </div>
                    </div>
                   
                   
                
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end of invoice checkout-->

<?php
    include_once ("../files/bottom.php");

?>

<script>
$("#invoicecheckout").hide();

//show invoice checkout
$("#paynow").click(function(){
    $("#paynow").hide();
    $("#paylater").hide();

    $("#invoicecheckout").show();
});

</script>