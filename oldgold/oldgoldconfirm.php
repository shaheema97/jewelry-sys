<?php

include_once ("oldgold.php");
$oldgold4=new oldgold();


include_once ("oldgolditem.php");
$ogitem4=new oldgolditem();

include_once ("../payment/payment.php");
$ogpay=new payment();
if(isset($_POST[''])){
    $ogpay->pay_cust=$_POST["pay_cus"];
    $ogpay->pay_date=$_POST["pay_date"];
    $ogpay->pay_type=$_POST["pay_type1"];
    $ogpay->pay_type_id=$_POST["saleid"];
    $ogpay->pay_amount=$_POST["pay_amt"];
    $ogpay->pay_staff=$_POST["staffpay"];
    $ogpay->pay_persontype=$_POST["pay_persontype"];
    $ogpay->insert_payment(); 
  
}else{

$result_og=$oldgold4->getbyid($_GET["ogid"]);

$result_item=$oldgold4->getall_oldgold_item($_GET["ogid"]);
//  print_r($result_item);
//  exit;
}


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
                    <li class="breadcrumb-item"><a href="#!">Oldgold</a>
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
                            <table  id="" class="table-xs" >
                            <tr>
                                    <th class="text-center">Customer</th>
                                    <td><input type="text" class="form-control "  value="<?=$result_og->cusname->cust_first_nm ?>"></td>
                                    <th class="text-center">Recieved by</th>
                                    <td><input type="text" class="form-control " value="<?=$result_og->stname->st_firstname ?> "></td>
                                    

                                </tr>
                               <tr>
                                    <th class="text-center">Invoice ID</th>
                                    <td><input type="text" class="form-control " value="<?=$result_og->oldgold_id ?>"></td>
                                    <th class="text-center">Date</th>
                                    <td><input type="text" class="form-control " value="<?=$result_og->oldgold_date ?>"></td>
                               </tr>
                            </table>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table table-xs  table-fixed table-info nowrap table" style="width : 100% ,border:none;">
                               <thead>
                                    <tr>
                                        <!-- <th>Category</th> -->
                                       <th>Item</th>
                                       <th>Condition</th>
                                       <th>Nett/Weight</th>
                                       <th>Size</th>
                                       <th>Purity</th>
                                       <th>Unit Price</th>
                                       <th>Discount</th>
                                       <th>Final Price</th>
                                    </tr>
                                    
                               
                               </thead>
                               <tbody>
                               <?php
                               foreach($result_item as $item){
                                   echo"<tr>
                                  
                                   <td>$item->name</td>
                                   <td>$item->condition</td>
                                   <td>$item->nettweight</td>g
                                   <td>$item->size $item->unit</td>
                                   <td>$item->purity</td>
                                   <td>$item->price</td>
                                   <td>$item->reduce_price</td>
                                   <td>$item->finalprice</td>
                                   </tr>
                                   ";
                               }
                               
                                ?>  
                               </tbody>
                               </table>

                               <table  class="table table-xs  " style="" >
                                    <tr>
                                        <td style="" ><label class="label bg-primary">TOTAL:</label></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?=$result_og->oldgold_subtot?></td>
                                        <td><?=$result_og->oldgold_redtot ?></td>
                                        <td><?=$result_og->oldgold_nettot ?></td>
                                    </tr>
                                    <tfoot>
                                        <td></td>
                                        <td></td>
                                        <th >Final Amount</th>
                                        <th class="text-success f-20"><?=$result_og->oldgold_nettot ?></th>
                                        
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
            
            <div class="card bg-primary">
                <div class="d-flex justify-content-between">
                    <div class="p-2"></div>
                    <div class="p-2">
                    <h4 style="text-align:center">INVOICE CHECKOUT</h4>
                    </div>
                    <div class="p-2">
                    <button type="button" class="btn btn-mini btn-danger" id="closebtn"><i class="icofont icofont-ui-close"></i></button>
                    </div>
                </div>
            </div>
                <div class="card-block">
                    <div class=" row">
                            <div class="col-sm-2">Payment Type</div>
                            <div class="col-sm-7">
                            <div class="d-flex justify-content-around">
                                    <button  type="button" id="cashbtn" class="btn btn-sm btn-primary" >Cash</button>
                                    <button  type="button" class="btn  btn-mini btn-warning" data-toggle="modal" data-target="#default-Modal">Card</button>
                                    <button  type="button" class="btn btn-mini btn-inverse"  data-toggle="modal" data-target="#default-Modal-bank">Cheque</button>
                                </div>
                            </div>
                            <div class="p-2"> <button type="submit" class="btn btn-success" style="width:197px"><i class="icofont icofont-tick-mark"></i>PROCESS PAYMENT</button></div>
                           
                    </div>
                    <div class="row asessed_amt">
                            <div class="col-sm-2">Assesed Amount </div>
                            <div class="col-sm-7"><input type="text" class="form-control form-control-primary" value="<?=$result_pawn2->pawn_avtot?>"></div>
                            <div class="p-2"> <button type="submit" class="btn btn-inverse"  style="width:197px"><i class="icofont icofont-printer"></i>PRINT RECEIPT</button></div>
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
                            <div class="p-2"> <button  type="" class="btn btn-inverse"><i class="icofont icofont-printer"></i>PRINT RECEIPT</button></div>
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
    if(isset($_GET["did"])){
        include_once ("../files/confirmation.php");
    }
   

?>

<script>
$("#invoicecheckout").hide();
$(".asessed_amt").hide();

//show invoice checkout
$("#paynow").click(function(){
    $("#paynow").hide();
    $("#paylater").hide();

    $("#invoicecheckout").show();
});

$("#closebtn").click(function(){
   $("#invoicecheckout").hide();
   $("#paynow").show();
    $("#paylater").show();
});

$("#cashbtn").click(function(){
    $(".asessed_amt").show();
});




function del_pawn(id){

    console.log(id);
    if(confirm("Do  want to delete invoice"+" "+id))
			{
				window.location.href="pawnconfirm.php?delid="+id;
			}
}



</script>