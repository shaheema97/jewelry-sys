<?php
session_start();

include_once ("../purchase/purchase.php");
$purch=new purchase();

include_once ("../payment/payment.php");
$pay_purch=new payment();

include_once ("../staff/staff.php"); 
$purch_staff1=new staff();
$result_staff1=$purch_staff1->get_all();

if(isset($_POST["pay_sup"])){
    $pay_purch->pay_cust=$_POST["pay_sup"];
    $pay_purch->pay_date=$_POST["pay_date"];
    $pay_purch->pay_type=$_POST["pay_type1"];
    $pay_purch->pay_type_id=$_POST["purch_id"];
    $pay_purch->pay_amount=$_POST["pay_amt"];
    $pay_purch->pay_staff=$_POST["pay_staff"];
    $pay_purch->pay_persontype=$_POST["pay_persontype"];
    $pay_purch->insert_payment(); 
    $purch->update_purchase_payment($_POST["purch_id"],$_POST["pay_amt"]);
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
<form action="purchasepay.php" method="POST">
        <div class="row">
            <div class="col-sm-12">
                <div class="card ">
                    <?php
                        if(isset($_SESSION['success']) && $_SESSION['success']!= ''){
                            echo'<div class="card-block bg-success" id="msg" onload="fademsg()"><h5>'.$_SESSION['success'].'</h5></div>';
                        }
                        
                    
                    ?>
                    <div class="card bg-primary"><h4 style="text-align:center">INVOICE DETAILS</h4></div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table-xs" style="width : 100% ;border:none;">
                                <tr>
                                    <th>Supplier</th>
                                    <td><input type="text" value="<?=$_SESSION["purchinvoice"]["invoice_sup"]?>" class="form-control form-control-sm" name="pay_sup"></td>
                                    <th>Payment</th>
                                    <td><input type="text" value="<?=$_SESSION["purchinvoice"]["invoice_pay"]?>" class="form-control  form-control-sm" name=""></td>
                                    <th>Invoice ID</th>
                                    <td><input type="text" value="<?=$_SESSION["invoiceid"]?>"  class="form-control form-control-sm" name="purch_id"></td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td><input type="text" value="<?=$_SESSION["purchinvoice"]["invoice_date"]?>" class="form-control form-control-sm"></td>
                                    <th>Due Date</th>
                                    <td><input type="text" value="<?=$_SESSION["purchinvoice"]["invoice_paydue"]?>" class="form-control form-control-sm"></td>
                                    <th>Recieved by</th>
                                    <td><input type="text" value="<?=$_SESSION["purchinvoice"]["invoice_emp"]?>" class="form-control form-control-sm"></td>

                                </tr>
                            </table>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table table-xs  table-fixed table-info nowrap table" style="width : 100% ,border:none;">
                               <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Item</th>
                                        <th>Purity</th>
                                        <th>Size</th>
                                        <th>Weight</th>
                                    
                                        <th>Gross/wt</th>
                                        <th>Qty</th>
                                        <th>Unit/Price</th>
                                        <th>Tot/Price</th>
                                       
                                    </tr>
                               </thead>
                               <tbody>
                               <?php
                               $c=0;
                               foreach($_SESSION["purchinvoice"]["itm_cat"] as $item)
                                   {
                                       echo"
                                       <tr>
                                       <td>".$_SESSION["purchinvoice"]["itm_cat"][$c]."</td>
                                       <td>".$_SESSION["purchinvoice"]["itm_name"][$c]."</td>
                                       <td>".$_SESSION["purchinvoice"]["itm_purity"][$c]."</td>
                                       <td>".$_SESSION["purchinvoice"]["item_size"][$c]." ".$_SESSION["purchinvoice"]["item_unit"][$c]."</td>
                                       <td>".$_SESSION["purchinvoice"]["itm_wt"][$c]."</td>
                                       <td>".$_SESSION["purchinvoice"]["itm_cat"][$c]."</td>
                                       <td>".$_SESSION["purchinvoice"]["itm_gwt"][$c]."</td>
                                       <td>".$_SESSION["purchinvoice"]["item_unitprice"][$c]."</td>
                                       <td>".$_SESSION["purchinvoice"]["tot_price"][$c]."</td>
                                       
                                       
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
                                        <td></td>
                                        <td></td>
                                        <th>Subtotal</th>
                                        <td><?=$_SESSION["purchinvoice"]["subtot"]?></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th>Stone Amount</th>
                                        <td><?=$_SESSION["purchinvoice"]["stonetot"]?></td>
                                    </tr>
                               </tfoot>
                               </table>

                               <table  class="table-xs" style="width: auto;margin-right: 0px;margin-left: auto;" >
                                        <tr>
                                        <TH ></TH>
                                        
                                        <td style="" class="f-16 f-w-100"></td>
                                        
                                        
                                        <th>Total</th>
                                        <td style="" class="f-16 f-w-100"><?=$_SESSION["purchinvoice"]["nettot"]?></td>
                                       
                                        <th>Payments</th>
                                        <td style=" " class="f-16 f-w-300">000.00</td>
                                       
                                       <th>Payments Due</th>
                                        <td style="" class="f-16 f-w-300">30000.0</td>

                                       
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
                    <!-- ------- -->
                            <input type="hidden" value="suppplier" name="pay_persontype">
                            <input type="hidden" valu="Purchase" name="pay_type1">

                    <!-- ------ -->
                            <div class="col-sm-1">
                            <label class="col-form-label">Date</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-info">
                                <span class="input-group-addon"><i class="fa fa-calendar "></i></span>
                                    <input type="date" class="form-control " placeholder="Date" name="pay_date">
                                </div>
                           </div>
                            <div class="col-sm-2"><label class="col-form-label">Amount Tendered</label></div>
                            <div class="col-sm-6"><input type="text" class="form-control form-control-primary" name="pay_amt"></div>
                    </div>
                    <div class=" row">
                            <div class="col-sm-1">
                            <label class="col-form-label">Staff</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <select id="" class="form-control" name="pay_staff" placeholder="">
                                        <option value=""  style="font-color:'grey'" disabled selected hidden >Recieved By</option>
                                        <?php
                                            foreach($result_staff1 as $item){
                                                echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                            }

                                        ?>
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


function fademsg(){
    console.log("hi");
    $("#msg").fadeOut(3000);
}



</script>