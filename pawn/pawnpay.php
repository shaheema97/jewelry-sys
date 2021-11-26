<?php
 

include_once ("pawn.php");
$pawn2=new pawn(); 
$pawn3=new pawn();


include_once ("../staff/staff.php");
$pawnstaff=new staff();


include_once ("../payment/payment.php");
$pawnpay=new payment();



include_once ("pawnitem.php");
$pawnitem2=new pawnitem(); 

//print_r($result_pawnitem2);

include_once ("../customer/account.php");
$cus_acc=new account();
//$result_acc=$cus_acc->cal_tot_credit($result_pawn2->pawn_cus);
//print_r($result_acc);

if(isset($_POST["pay"])){
    $pawnpay->pay_cust=$_POST["pay_cus"];
    $pawnpay->pay_date=$_POST["pay_date"];
    $pawnpay->pay_type=$_POST["pay_type1"];
    $pawnpay->pay_type_id=$_POST["pawn_id"];
    $pawnpay->pay_amount=$_POST["pay_amt"];
    $pawnpay->pay_staff=$_POST["paystaff"];
    $pawnpay->pay_persontype=$_POST["pay_persontype"];
    $pawnpay->insert_payment(); 
    $pawn2->update_pawnpayment($_POST["pawn_id"],$_POST["pay_amt"]);
    $pawn2-> update_status_complete($_POST["pawn_id"]);

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

   
    //include_once ("../files/confirmation.php");
  
    
}else{
    $result_staff1=$pawnstaff->get_all();
    $result_pawn2=$pawn2->get_pawn_id2 ($_GET['pay1']);
    $result_pawnitem2=$pawnitem2->get_pitem_id($_GET['pay1']);
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
                        <a href="index-1.htm"> <i class="feather icon-home"></i></a>
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
                            <a href="../pawn/pawntran.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-search"></i><br>
                           Search Invoice
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="../pawn/pawnfrm2.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-plus"></i><br>
                            New Invoice
                            </a>
                    </div>
                </div>
            
        </div>
    </div> <!--end 1 -->
</div>
<!-- start of invoice details-->
<form action="pawnpay.php" method="POST">
        <div class="row">
            <div class="col-sm-12">
                <div class="card ">
                    <div class="card bg-primary"><h4 style="text-align:center">INVOICE DETAILS</h4></div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table-xs" >
                                <tr>
                                    <th>Customer</th>
                                    <td><input type="text" style="border:none;" readonly class="form-control "  value="<?=$result_pawn2->cusname->cust_first_nm ?>" name="pay_cus"></td>
                                    <th>Payment(months)</th>
                                    <td><input type="text" style="border:none;" readonly  class="form-control " value="<?=$result_pawn2->pawn_period?>"></td>
                                    <th>Invoice ID</th>
                                    <td><input type="text" style="border:none;" readonly  class="form-control " value="<?=$result_pawn2->pawn_id?>" name="pawn_id"></td>

                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td><input type="text" style="border:none;" readonly class="form-control " value="<?=$result_pawn2->pawn_dt?>"></td>
                                    <th>Due Date</th>
                                    <td><input type="text" style="border:none;" readonly  class="form-control " value="<?=$result_pawn2->pawn_duedt?>"></td>
                                    <th>Recieved by</th>
                                    <td><input type="text" style="border:none;" readonly  class="form-control " value="<?=$result_pawn2->stname->st_firstname?>"></td>

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
                                        <td>".$item->itemcat->cat_name." |  $item->pawnit_karat K|$item->pawnit_wei g</td>
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
                                            <!-- <td></td>
                                            <td></td> -->
                                            <th >Loan Amount</th>
                                            <th class="text-success f-20"><?=$result_pawn2->pawn_rvtot?></th>
                                            <th >Paid Amount</th>
                                            <th class="text-success f-20"><?=$result_pawn2->pawn_paid?></th>
                                            <th >Due Amount</th>
                                            <th class="text-success f-20"><?=$result_pawn2->pawn_due?></th>
                                            
                                            
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
                            <a href="../pawn/pawntran.php" id="paylater" class="btn btn-inverse" >
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
                   
                    <div class="row">
                    <!-- ------- -->
                            <input type="hidden" value="customer" name="pay_persontype">
                            <input type="hidden" value="Pawn" name="pay_type1">

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
                            <div class="col-sm-6"><input type="text" id="amt" onkeyup="cal_bal()" onkeypress="return IsNumeric(event);" class="form-control form-control-primary" name="pay_amt" required></div>
                            <span class="error" style="color: red; display: none">* Input digits (0 - 9)</span> 
                    </div>
                    <div class=" row">
                            <div class="col-sm-1">
                            <label class="col-form-label">Staff</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <select id="" class="form-control" name="paystaff" placeholder="" required>
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
                            <div class="col-sm-6"><input type="text" id="balance" readonly class="form-control form-control-danger"></div>
                    </div>
                
                    <div class="  ">
                        <div class="d-flex  flex-row-reverse">
                            <div class="p-2">  <button type="reset" class="btn btn-danger"><i class="icofont  icofont-ui-close"></i>CANCEL</button></div>
                           
                            <div class="p-2"> <button type="submit"  class="btn btn-success" onlick="jsfunction" name="pay"><i class="icofont icofont-tick-mark"></i>PROCESS PAYMENT</button></div>
                            
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
   // include_once ("../files/confirm.php");
    
?>

<script>
$("#invoicecheckout").hide();

//show invoice checkout
$("#paynow").click(function(){
    $("#paynow").hide();
    $("#paylater").hide();

    $("#invoicecheckout").show();
});


function jsfunction(){
   console.log("hi");
}

function cal_bal(){
      total=<?=$result_pawn2->pawn_due?>;
    amount=parseFloat($("#amt").val());
    bal=total-amount;
   $("#balance").val(bal);
}

    //FUNCTION TO VALIDATE TO ONLY INPUT NUMBERS 
    function IsNumeric(e) {
            var keycode = e.which ? e.which : e.keyCode
            if (!(keycode == 8 || keycode == 46) && (keycode < 48 || keycode > 57) ) {
            $(".error").css("display", "inline");
            
            return false;
          }else{
            $(".error").css("display", "none");

          }
        }


</script>