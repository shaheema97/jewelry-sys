<?php
//session_start();
include_once ("pawn.php"); 
$pawn2=new pawn();


include_once ("../staff/staff.php");
$pawnstaff=new staff();

include_once ("../payment/payment.php");
$pawnpay=new payment();

include_once ("../customer/cust.php");
$pawncust=new cust();   

include_once ("pawnitem.php");
$pawnitem2=new pawnitem(); 





if(isset($_GET["delid"])){
    $pawn2->del_pawn($_GET["delid"]);
    $pawnitem2->del_pawnitem($_GET["delid"]);

    echo '<script>
    setTimeout(function() {
        swal({
            title: "Deleted!",
            text: "Invoice deleted successfully!",
            type: "success"
        }, function() {
            window.location = "pawnfrm2.php";
        });
        }, 1000);
        </script>';
    }

    if(isset($_POST["pay_cus"])){
        $pawnpay->pay_cust=$_POST["pay_cus"];
        $pawnpay->pay_date=$_POST["pay_date"];
        $pawnpay->pay_type=$_POST["pay_type1"];
        $pawnpay->pay_type_id=$_POST["pawn_id"];
        $pawnpay->pay_amount=$_POST["pay_amt"];
        $pawnpay->pay_staff=$_POST["paystaff"];
        $pawnpay->pay_persontype=$_POST["pay_persontype"];
        $pawnpay->insert_payment(); 
       // $pawn2->update_pawnpayment($_POST["pawn_id"],$_POST["pay_amt"]);
        $pawn2-> update_status_complete($_GET["pid"]);
    
        echo '<script>
        setTimeout(function() {
            swal({
                title: "Payment successful!",
                text: "Thank you for the payment!",
                type: "success"
            }, function() {
                window.location = "pawnfrm2.php";
            });
            }, 1000);
            </script>';
            $result_pawn2=$pawn2->get_pawn_id2($_GET["pid"]);
            $result_pawnitem2=$pawnitem2->get_pitem_id($_GET["pid"]);

    
        }else{
            $result_pawn2=$pawn2->get_pawn_id2($_GET["pid"]);
            $result_pawnitem2=$pawnitem2->get_pitem_id($_GET["pid"]);

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
            <?php
                 echo"  <div class='p-2'>
                            <button type='button'  onclick='del_pawn($result_pawn2->pawn_id)' class='btn btn-inverse  btn-sm' style='float: right'>
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
<form action="pawnconfirm.php?pid=<?=$result_pawn2->pawn_id ?>" method="POST">
        <div class="row">
            <div class="col-sm-12">
                <div class="card ">
               
                    <div class="card bg-primary"><h4 style="text-align:center">INVOICE DETAILS</h4></div>
                   
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table-xs" >
                                <tr>
                                    <th>Customer</th>
                                    <td><input type="text" style="border:none;" readonly class="form-control "  value="<?=$result_pawn2->cusname->cust_first_nm ?>"></td>
                                    <input type="hidden" value="<?=$result_pawn2->pawn_cus?>" name="pay_cus">
                                    <th>Payment(months)</th>
                                    <td><input type="text" style="border:none;" readonly  class="form-control " value="<?=$result_pawn2->pawn_period?>"></td>
                                    <th>Invoice ID</th>
                                    <td><input type="text" style="border:none;" readonly  class="form-control " value="<?=$result_pawn2->pawn_id?>" name="pawn_id"></td>

                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td><input type="text" style="border:none;" readonly class="form-control " value="<?=$result_pawn2->pawn_dt?>" name="pay_date"></td>
                                    <th>Due Date</th>
                                    <td><input type="text" style="border:none;" readonly  class="form-control " value="<?=$result_pawn2->pawn_duedt?>"></td>
                                    <th>Recieved by</th>
                                    <td><input type="text" style="border:none;" readonly  class="form-control " value="<?=$result_pawn2->stname->st_firstname?>" name="paystaff"></td>

                                </tr>
                            </table>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table table-xs  table-fixed table-info nowrap table" style="width : 100% ,border:none;">
                               <thead>
                              
                                    <tr>
                                        
                                        <th>Item Desription</th>
                                        <th class="text-center">Market/Price</th>
                                        <th class="text-center">Assessed/Val</th>
                                        <th class="text-center">Interest</th>
                                        <th class="text-center">Redeem/Value</th>
                                        
                                    </tr>
                                    
                               
                               </thead>
                               <tbody>
                               <?php
                                foreach($result_pawnitem2 as $item){
                                echo " <tr>
                                        <td>".$item->itemcat->cat_name."  | $item->pawnit_karat K|$item->pawnit_wei g</td>
                                        <td class='text-center'>$item->pawnit_mv</td>
                                        <td class='text-center'>$item->pawnit_rv</td>
                                        <td class='text-center'>$item->pawnit_int</td>
                                        <td class='text-center'>$item->pawnit_redeem</td>
                                   
                               </tr>";
                                    
                                }
                                    ?>  
                               </tbody>
                               </table>

                               <table  class="table table-xs  " style="" >
                                        <tr>
                                       
                                        <td style="" ><label class="label bg-primary">TOTAL:</label></td>
                                        
                                        
                                        <th style="" class="text-center text-primary " ><?=$result_pawn2->pawn_mvtot?></th>
                                        <th style="" class="text-center text-primary"><?=$result_pawn2->pawn_avtot?></th>
                                        <th style=" " class="text-center text-primary"><?=$result_pawn2->pawn_intval ?></th>
                                        <th style="" class="text-center text-primary"><?=$result_pawn2->pawn_rvtot?></th>

                                       
                                       </tr>
                                       <tfoot>
                                            <td></td>
                                            <td></td>
                                            <th >Loan Amount</th>
                                            <th class="text-success f-20"><?=$result_pawn2->pawn_rvtot?></th>
                                            
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
                    <!-- <div class=" row">
                            <div class="col-sm-2">Payment Type</div>
                            <div class="col-sm-7">
                            <div class="d-flex justify-content-around">
                                    <button  type="button" id="cashbtn" class="btn btn-sm btn-primary" >Cash</button>
                                    <button  type="button" class="btn  btn-mini btn-warning" data-toggle="modal" data-target="#default-Modal">Card</button>
                                    <button  type="button" class="btn btn-mini btn-inverse"  data-toggle="modal" data-target="#default-Modal-bank">Cheque</button>
                                </div>
                            </div>
                            <div class="p-2"> <button type="submit" class="btn btn-success" style="width:197px"><i class="icofont icofont-tick-mark"></i>PROCESS PAYMENT</button></div>
                           
                    </div> -->

                    <input type="hidden" value="customer" name="pay_persontype">
                    <input type="hidden" value="Pawn" name="pay_type1">
                    <div class="row asessed_amt">
                            <div class="col-sm-2">Assesed Amount </div>
                            <div class="col-sm-7"><input type="text" class="form-control form-control-primary" value="<?=$result_pawn2->pawn_avtot?>"></div>
                            <div class="p-2"> <button type="submit" class="btn btn-inverse"  style="width:197px"><i class="icofont icofont-printer"></i>PRINT RECEIPT</button></div>
                    </div>
                    <div class="row">
                            <div class="col-sm-2">Amount Tendered</div>
                            <div class="col-sm-7"><input type="text" class="form-control form-control-primary" name="pay_amt"></div>
                            <div class="p-2"> <button type="submit" class="btn btn-success" style="width:197px"><i class="icofont icofont-tick-mark"></i>PROCESS PAYMENT</button></div>
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