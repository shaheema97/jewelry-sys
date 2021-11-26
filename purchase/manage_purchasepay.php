<?php
include_once ("../purchase/purchase.php");
$purch_2=new purchase();

include_once  ("../item/item.php");
$item_purch=new item();

include_once ("../payment/payment.php");
$pay_purch=new payment();

include_once ("../staff/staff.php"); 
$purch_staff1=new staff();
$result_staff1=$purch_staff1->get_all();

//view detals
if(isset($_GET['view'])){
    $purch_res=$purch_2->get_by_purchaseid($_GET['view']);
}

//payment submit and edit
if(isset($_POST["pay_sup"])){
    $pay_purch->pay_cust=$_POST["pay_sup"];
    $pay_purch->pay_date=$_POST["pay_date"];
    $pay_purch->pay_type=$_POST["pay_type1"];
    $pay_purch->pay_type_id=$_POST["idpurch"];
    $pay_purch->pay_amount=$_POST["pay_amt"];
    $pay_purch->pay_staff=$_POST["pay_staff"];
    $pay_purch->pay_persontype=$_POST["pay_persontype"];
    $pay_purch->insert_payment(); 
    $purch_2->update_purchase_payment($_POST["idpurch"],$_POST["pay_amt"]);

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
<form action="manage_purchasepay.php" method="POST">
        <div class="row">
            <div class="col-sm-12">
                <div class="card ">
                    <div class="card bg-primary"><h4 style="text-align:center">INVOICE DETAILS</h4></div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table  id="" class="table-xs" style="width : 100% ;border:none;">
                                <tr>
                                    <th>Supplier</th>
                                    <td><input type="text" class="form-control form-control-sm" value="<?= $purch_res->supp_name->sup_firstname  ?>"></td>
                                    <!-- supplier id -->
                                        <input type="hidden" name="pay_sup" value="<?= $purch_res->purchase_supp ?>">
                                    <th>Payment</th>
                                    <td><input type="text" class="form-control  form-control-sm" value="<?= $purch_res->purchase_payment ?>"></td>
                                    <th>Invoice ID</th>
                                    <td><input type="text" class="form-control form-control-sm" value="<?=$purch_res->purchase_id?>" name="idpurch"></td>

                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td><input type="text" class="form-control form-control-sm" value="<?= $purch_res->purchase_date ?>"></td>
                                    <th>Due Date</th>
                                    <td><input type="text" class="form-control form-control-sm" value="<?= $purch_res->purchase_pay_duedt ?>"></td>
                                    <th>Recieved by</th>
                                    <td><input type="text" class="form-control form-control-sm" value="<?= $purch_res->emp_name->st_firstname ?> "></td>

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
                                    
                               </tbody>
                               </table>

                               <table  class="table-xs" style="width: auto;margin-right: 0px;margin-left: auto;" >
                                        <tr>
                                        <TH ></TH>
                                        <td style="" class="f-16 f-w-100"></td>
                                        
                                        
                                        <th>Total</th>
                                        <td style="" class="f-16 f-w-100"><?= $purch_res->purchase_nettot ?></td>
                                       
                                        <th>Payments</th>
                                        <td style=" " class="f-16 f-w-300"><?= $purch_res->purchase_paid_amt ?></td>
                                       
                                       <th>Payments Due</th>
                                        <td style="" class="f-16 f-w-300"><?= $purch_res->purchase_due_amt ?></td>

                                       
                                       </tr>


                               </table>
                              
                                
                               
                            
                        </div>
                    
                    </div>
                </div>

                <!-- button start -->
                    <!-- <div class="d-flex justify-content-center">
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
                    
                    </div> -->


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
                                    <input type="input" class="form-control" placeholder="type" value="Purchase" name="pay_type1">
                                    <input type="hidden" class="form-control" placeholder="type" value="supplier" name="pay_persontype" >
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

