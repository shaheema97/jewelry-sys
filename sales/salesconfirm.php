<?php
//session_start();
include_once ("../files/config.php");
include_once ("../sales/sales.php");
 $sales2=new sales();
 $result_sales=$sales2->getsales_by_id($_GET["sid"]);




include_once ("../staff/staff.php");
$sales_staff=new staff();

include_once ("../payment/payment.php");
$salespay=new payment();

include_once ("../customer/cust.php");
$salescust=new cust();

include_once ("salesitem.php");
$salesitem2=new salesitem(); 
$result_sales2=$salesitem2->getitem_by_salesid($_GET["sid"]);

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
            <?php
                 echo"  <div class='p-2'>
                            <button type='button'  onclick='del_pawn($result_sales2->sales_id)' class='btn btn-inverse  btn-sm' style='float: right'>
                            <i class='icofont icofont-ui-delete'></i><br>
                           Delete Invoice
                            </button> ";
            ?>
                    </div>
                    <div class="p-2">
                            <a href="order_frm.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-printer"></i><br>
                            Print Invoice
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="managesales.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-search"></i><br>
                           Search Invoice
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="buygold2.php" class="btn btn-inverse  btn-sm" style="float: right;">
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
                <?php
                        if(isset($_SESSION['success_pawn']) && $_SESSION['success_pawn']!= ''){
                            echo'<div class="card-block bg-success" id="msg" onload="fademsg()"><h5>'.$_SESSION['success_pawn'].'</h5></div>';
                        }
                        
                    
                    ?>
                    <div class="card bg-primary"><h4 style="text-align:center">INVOICE DETAILS</h4></div>
                   
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table-xs" >
                            <tr>
                                    <th>Customer</th>
                                    <td><input type="text" style="border:none;" readonly class="form-control "  value="<?=$result_sales->cust_name->cust_first_nm ?>" name="pay_cus"></td>
                                    <th>Payment(months)</th>
                                    <td><input type="text" style="border:none;" readonly  class="form-control " value=""></td>
                                    <th>Invoice ID</th>
                                    <td><input type="text" style="border:none;" readonly  class="form-control " value="<?=$result_sales->sales_id ?>" name="saleid"></td>

                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td><input type="text" style="border:none;" readonly class="form-control " value="<?=$result_sales->sales_date?>"></td>
                                    <th>Due Date</th>
                                    <td><input type="text" style="border:none;" readonly  class="form-control " value=""></td>
                                    <th>Recieved by</th>
                                    <td><input type="text" style="border:none;" readonly  class="form-control " value="<?=$result_sales->emp_name->st_firstname ?>"></td>

                                </tr>
                            </table>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table table-xs  table-fixed table-info nowrap table" style="width : 100% ,border:none;">
                               <thead>
                              
                                    <tr>
                                        
                                        <th>#</th>
                                        <th class="text-center">Item</th>
                                        <th class="text-center">Purity</th>
                                        <th class="text-center">Size</th>
                                        <th class="text-center">weight</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Unit/Price</th>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Final/Price</th>
                                        
                                    </tr>
                                    
                               
                               </thead>
                               <tbody>
                               <?php
                                foreach($result_sales2 as $item){
                                echo " <tr>
                                        
                                        <td>".$item->itemname->item_name."</td>
                                        <td>".$item->itemname->name_item."</td>
                                        <td> ".$item->itemname->item_purity." K</td>
                                        <td> ".$item->itemname->item_size." ".$item->itemname->item_unit."</td>
                                        <td> ".$item->itemname->item_grosswt."g</td>
                                        
                                        <td class='text-center'>$item->salesitem_price</td>
                                        <td class='text-center'>$item->salesitem_discount</td>
                                        <td class='text-center'>$item->salesitem_status</td>
                                   
                               </tr>";
                                    
                                }
                                    ?>  
                               </tbody>
                               </table>

                               <table  class="table table-xs  " style="" >
                                        
                                       <tfoot>
                                            <td></td>
                                            <td></td>
                                            <th >Net Amount</th>
                                            <th class="text-success f-20"></th>
                                            
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
                            <div class="col-sm-7"><input type="text" class="form-control form-control-primary" value=""></div>
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