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
                                    <td><input type="text" class="form-control "></td>
                                    <th>Payment</th>
                                    <td><input type="text" class="form-control "></td>
                                    <th>Invoice ID</th>
                                    <td><input type="text" class="form-control "></td>

                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td><input type="text" class="form-control "></td>
                                    <th>Due Date</th>
                                    <td><input type="text" class="form-control "></td>
                                    <th>Recieved by</th>
                                    <td><input type="text" class="form-control "></td>

                                </tr>
                            </table>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table table-xs  table-fixed table-info nowrap table" style="width : 100% ,border:none;">
                               <thead>
                                    <tr>
                                        
                                        <th>Item Desription</th>
                                        <th>Market/Price</th>
                                        <th>Assessed/Val</th>
                                        <th>Interest</th>
                                        <th>Redeem/Value</th>
                                        
                                    </tr>
                               </thead>
                               <tbody>
                                    <tr>
                                        <td>Ring xyz | 18k |45g</td>
                                        <td>4526397.12</td>
                                        <td>4526397.12</td>
                                        <td>4526397.12</td>
                                        <td>4526397.12</td>
                                        
                                    </tr>
                                    
                               </tbody>
                               </table>

                               <table  class="table table-xs  " style="" >
                                        <tr>
                                       
                                        <td style="" ><label class="label bg-primary">TOTAL:</label></td>
                                        
                                        
                                        <td style="" class="">896235.5</td>
                                        <td style="" class="">896235.5</td>
                                       
                                        
                                        <td style=" " class="">500000</td>
                                       
                                      
                                        <td style="" class="">300000</td>

                                       
                                       </tr>
                                       <tfoot>
                                            <td></td>
                                            <td></td>
                                            <th >Loan Amount</th>
                                            <td class="border border-success">789456.326</td>
                                            
                                       </tfoot>


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
                            <div class="col-sm-2">Payment Type</div>
                            <div class="col-sm-7">
                            <div class="d-flex justify-content-around">
                                    <button  type="button" class="btn btn-sm btn-primary" >Cash</button>
                                    <button  type="button" class="btn  btn-mini btn-warning" data-toggle="modal" data-target="#default-Modal">Card</button>
                                    <button  type="button" class="btn btn-mini btn-inverse"  data-toggle="modal" data-target="#default-Modal-bank">Cheque</button>
                                </div>
                            </div>
                            <div class="p-2"> <button type="submit" class="btn btn-success" style="width:197px"><i class="icofont icofont-tick-mark"></i>PROCESS PAYMENT</button></div>
                           
                    </div>
                    <div class="row">
                            <div class="col-sm-2">Amount Tendered</div>
                            <div class="col-sm-7"><input type="text" class="form-control form-control-primary"></div>
                            <div class="p-2"> <button type="submit" class="btn btn-inverse" style="width:197px"><i class="icofont icofont-printer"></i>PRINT RECEIPT</button></div>
                    </div>
                    <div class=" row">
                            <div class="col-sm-2">Balance Amount</div>
                            <div class="col-sm-7"><input type="text" class="form-control form-control-danger"></div>
                            <div class="p-2">  <button type="reset" class="btn btn-danger" style="width:197px"><i class="icofont  icofont-ui-close"></i>CANCEL</button></div>
                    </div>
                
                    <!-- <div class="  ">
                        <div class="d-flex  flex-row-reverse">
                            <div class="p-2">  <button type="reset" class="btn btn-danger"><i class="icofont  icofont-ui-close"></i>CANCEL</button></div>
                            <div class="p-2"> <button  type="button" class="btn btn-inverse"><i class="icofont icofont-printer"></i>PRINT RECEIPT</button></div>
                            <div class="p-2"> <button type="submit" class="btn btn-success"><i class="icofont icofont-tick-mark"></i>PROCESS PAYMENT</button></div>
                            
                        </div>
                    </div> -->
                   
                   
                
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