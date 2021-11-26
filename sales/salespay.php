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

if(isset($_GET["del"])){
    $sales2->delete_sales($_GET["del"]);
}


if(isset($_POST["pay_cus"])){
    $salespay->pay_cust=$_POST["pay_cus"];
    $salespay->pay_date=$_POST["pay_date"];
    $salespay->pay_type=$_POST["pay_type1"];
    $salespay->pay_type_id=$_POST["saleid"];
    $salespay->pay_amount=$_POST["pay_amt"];
    $salespay->pay_staff=$_POST["staffpay"];
    $salespay->pay_persontype=$_POST["pay_persontype"];
    $cus_account->account_cusid=$_POST["pay_cus"];
    $cus_account->account_credit=$_POST["pay_amt"];

    $salespay->insert_payment();
  //  $cus_account->insert_creditamount(); //balance to pay
    $result_sales=$sales2->cal_paytot_sales($_GET['view2']);
    $result_sales2=$salesitem2->getitem_by_salesid($_GET['view2']);
    $res_ammount=$cus_account->cal_tot_credit( $result_sales->sales_cus);
    $result_staff1=$sales_staff->get_all();

   
      
        
  
    
}else{
    $result_sales=$sales2->cal_paytot_sales($_GET['view2']);
    $result_sales2=$salesitem2->getitem_by_salesid($_GET['view2']);
    $res_ammount=$cus_account->cal_tot_credit($result_sales->sales_cus);
    $result_staff1=$sales_staff->get_all();

    

     
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
                            <button href="managesales.php" class="btn btn-inverse  btn-sm" onclick='delu(<?=$result_sales->sales_id ?> )' style="float: right;">
                            <i class="icofont icofont-ui-delete"></i><br>
                           Delete Invoice
                    </button>
                    </div>
                    <!-- <div class="p-2">
                            <a href="" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-printer"></i><br>
                            Print Invoice
                            </a>
                    </div> -->
                    <div class="p-2">
                            <a href="../sales/managesales.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-search"></i><br>
                           Search Invoice
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="../sales/buygold2.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-plus"></i><br>
                            New Invoice
                            </a>
                    </div>
                </div>
            
        </div>
    </div> <!--end 1 -->
</div>
<!-- start of invoice details-->
<form action="../sales/salespay.php?view2=<?= $result_sales->sales_id?>"  method="POST">
        <div class="row">
            <div class="col-sm-12">
                <div class="card ">
                    <div class="card bg-primary"><h4 style="text-align:center">INVOICE DETAILS</h4></div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table-xs" >
                                <tr>
                                    <th>Customer</th>
                                    <td><input type="text" style="border:none;" readonly value="<?=$result_sales->cust_name->cust_first_nm ?>" class="form-control " ></td>
                                    <input type="hidden" value="<?=$result_sales->sales_cus ?>" name="pay_cus">
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
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Final/Price</th>
                                        
                                    </tr>
                                    
                               
                               </thead>
                               <tbody>
                               <?php
                                foreach($result_sales2 as $item){
                                echo " <tr>
                                
                                <td>".$item->itemname->item_name."</td>
                                <td> ".$item->itemname->item_purity." K</td>
                                <td> ".$item->itemname->item_size." ".$item->itemname->item_unit."</td>
                                <td> ".$item->itemname->item_grosswt."g</td>
                                <td class='text-center'>$item->salesitem_qty</td>
                                <td class='text-center'>$item->salesitem_price</td>
                                <td class='text-center'>$item->salesitem_discount</td>
                                <td class='text-center'>$item->salesitem_nettprice</td>
                                   
                               </tr>";
                                    
                                }
                                    ?>  
                               </tbody>
                               </table>

                               <table  class="table table-xs  " style="" >
                                        <tr>
                                       
                                        <td style="" ><label class="label bg-primary">TOTAL:</label></td>
                                        
                                        
                                        

                                       
                                       </tr>
                                       <tfoot>
                                            <!-- <td></td>
                                            <td></td> -->
                                            <th >Total Amount</th>
                                            <th class="text-success f-20"><?=$result_sales->sales_nettot?></th>
                                            <th >Paid Amount</th>
                                            <th class="text-success f-20"><?=$result_sales->sales_paid_amt?></th>
                                            <th >Due Amount</th>
                                            <th class="text-success f-20"><?=$result_sales->sales_due_amt?></th>
                                            
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
                            <a href="../sales/managesales.php" id="paylater" class="btn btn-inverse" >
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
                            <label class="col-form-label">Date</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-info">
                                <span class="input-group-addon"><i class="fa fa-calendar "></i></span>
                                    <input type="date" class="form-control " placeholder="Date" name="pay_date" required>
                                </div>
                           </div>
                           <div class="col-sm-1"> <label class="col-form-label"><b>Customer</b> :</label></div>
                           <div class="col-sm-1"><span>Rs.</span><?= $res_ammount->credit_tot ?></div>
                           
                           <div class="col-sm-3"> <label class="col-form-label"><B>Total Amount payable:</b></label></div>
                           <div class="col-sm-1"><span id="payable"><span>Rs.</span><?= $result_sales->sales_nettot-$res_ammount->credit_tot ?></span></div>
                          
                         
                            
                    </div>
                    <div class="row">
                    <!-- ------- -->
                            <input type="hidden" value="customer" name="pay_persontype">
                            <input type="hidden" value="Sales" name="pay_type1">

                    <!-- ------ -->
                    
                    <div class="col-sm-1">
                            <label class="col-form-label">Staff</label>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-info">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <select id="" class="form-control" name="staffpay" placeholder="" required>
                                        <option value=""  style="font-color:'grey'" disabled selected hidden >Recieved By</option>
                                        <?php
                                            foreach($result_staff1 as $item){
                                                echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                            }

                                        ?>
                                    </select>
                                </div>
                           </div>
                            
                            <div class="col-sm-2"><label class="col-form-label">Amount Tendered</label></div>
                            <div class="col-sm-6"><input type="text" id="amt"  class="form-control form-control-primary" name="pay_amt" onkeypress="return IsNumeric(event);"></div>
                            <span class="error" style="color: red; display: none">* Input digits (0 - 9)</span>
                    </div>
                    <div class=" row">

                    <!-- ------- -->
                   
                           
                    <!-- ------ -->
                           <div class="col-sm-4"></div>
                            <div class="col-sm-2"><label class="col-form-label">Balance Amount</label></div>
                            <div class="col-sm-6"><input type="text" class="form-control form-control-danger"></div>
                    </div>
                
                    <div class="  ">
                        <div class="d-flex  flex-row-reverse">
                            <div class="p-2">  <button type="reset" class="btn btn-danger"><i class="icofont  icofont-ui-close"></i>CANCEL</button></div>
                            <!-- <div class="p-2"> <button  type="button" class="btn btn-inverse"><i class="icofont icofont-printer"></i>PRINT RECEIPT</button></div> -->
                            <div class="p-2"> <button type="submit"  class="btn btn-success" onlick="" name="pay"><i class="icofont icofont-tick-mark"></i>PROCESS PAYMENT</button></div>
                            
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

function delu(d){
			if(confirm("u want to delete"+""+d))
			{
				window.location.href="salespay.php?del="+d;
			}
			}



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