<?php 

include_once ("pawn.php");
$pi=new pawn();
$a= $pi->get_pawn_id2($_GET['di']);
include_once ("pawnitem.php");
$pti=new pawnitem();
$b=$pti->get_pitem_id($_GET['di']);



include_once ("../files/top.php");


?>

<div  class="card">
    <div class="row invoice-contact">
    <div class="col-md-8">
    <div class="invoice-box row">
    <div class="col-sm-12">
    <table class="table table-responsive invoice-table table-borderless">
    <tbody>
    <tr>
    <td><img src="..\files\assets\images\logo-blue.png" class="m-b-10" alt=""></td>
    </tr>
    <tr>
    <th><h3>New Star Jewellers</h3></th>
    </tr>
    <tr>
    <td> No,85 Kotugodella Street Kandy</td>
    </tr>
    <tr>
    <td><a href="..\..\..\cdn-cgi\l\email-protection.htm#99fdfcf4f6d9fef4f8f0f5b7faf6f4" target="_top"><span class="__cf_email__" data-cfemail="690d0c0406290e04080005470a0604">[email&#160;protected]</span></a>
    </td>
    </tr>
    <tr>
    <td>+94 81-22-32-184</td>

    </tbody>
    </table>
    </div>
    </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
<!-- End of header 1 -->
    <div class="card-block">
            <!-- Start of header 2-->
            <div class="row invoive-info">
                <div class="col-md-4 col-xs-12 invoice-client-info">
                    <h6>Customer Information : </SPAN></h6>
                    <p class="m-0 m-t-10"><span><?= $a->cusname->cust_first_nm ?></span><span><?= $a->cusname->cust_last_nm ?></span></p>
                    <p class="m-0 m-t-10"><?= $a->cusname->cus_nic ?></p>
                    <p class="m-0"><?= $a->cusname->cust_add ?></p>
                    
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6>Pawn Information :</h6>
                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                        <tbody>
                        <tr>
                                <th>Status :</th>
                                <td>
                                    <span class="label label-warning"><?= $a->pawn_type?></span>
                                </td>
                            </tr>
                            <tr>
                                <th>Date :</th>
                                <td><?= $a->pawn_dt ?></td>
                            </tr>
                            <tr>
                                <th>Period:</th>
                                <td><?=$a->pawn_period ?>&nbsp<span>months</span></td>
                            </tr>
                            <tr>
                                <th>Due Date :</th>
                                <td><?= $a->pawn_duedt ?></td>
                            </tr>
                            
                           
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Ticket Number <span><?= $a->pawn_id ?></span></h6>
                    <h6 class="text-uppercase text-success">Total Paid :
                        <span><?= $a->pawn_paid ?></span>

                    </h6>
                    <h6 class="text-uppercase text-danger">Total Due :
                        <span><?= $a->pawn_due ?></span>

                    </h6>
                </div>
            </div>
            <!-- END of header 2-->
            <!-- START of item table-->
            <div class="row">
                <div class="col-sm-12 table-border-style">
                    <div class="table-responsive">
                        <table class="table table table-borderless">
                            <thead>
                                <tr class="thead-default">
                                    <th>Item Description</th>
                                    <th>Market Value</th>
                                    <th>Assesed Value</th>
                                    <th>Interest</th>
                                    <th>Redeem Amount</th>
                                </tr>
                            </thead>
                            <?php
                         
                            
                             
                             
                             foreach($b as $item){
                                //print_r( $item);
                                   // exit;

                       echo"  <tr>
                            <td><h6>".$item->itemcat->cat_name." | ".$item->itemname->item_name."</h6>
                            <p>$item->pawnit_karat K |  $item->pawnit_wei g </p>
                            
                            </td>
                             <td> $item->pawnit_mv</td>
                             <td> $item->pawnit_rv</td>
                             <td> $item->pawnit_int</td>
                             <td> $item->pawnit_redeem</td>
                         </tr> " ;
                        
                             }?>

                            
                               
                            
                        </table>
                    </div>
                </div>
            </div>
            <!-- END of item table-->
            <!--start of invoice table -->
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-responsive invoice-table invoice-total">
                        <tbody>
                            <tr>
                                <th>Market Total Value :</th>
                                <td><span><?= $a->pawn_mvtot ?></td>
                            </tr>
                            <tr>
                                <th>Assesed Total Value :</th>
                                <td><span><?= $a->pawn_avtot ?></td>
                            </tr>
                            <tr>
                                <th>Interest (<?= $a->pawn_int?>) :</th>
                                <td><span><?= $a->pawn_intval ?></td>
                            </tr>
                            <tr class="text-info">
                                <td>
                                    <hr>
                                    <h5 class="text-primary">Total Pawn Loan :</h5>
                                </td>
                                <td>
                                    <hr>
                                    <h5 class="text-primary"><span><?= $a->pawn_rvtot ?></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--End of invoice table -->
            
            <!--start of invoice note -->
            <div class="row">
                <div class="col-sm-12">
                    <h6>Terms And Condition :</h6>
                    <p>lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor </p>
                </div>
            </div>
            <!--end of invoice note -->
            <!--start of buttons -->
            <div class="row text-center">
                <div class="col-sm-12 invoice-btn-group text-center">
                    <button type="button" class="btn btn-primary btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20">Print</button>
                    <button type="button" class="btn btn-danger waves-effect m-b-10 btn-sm waves-light">Cancel</button>
                </div>
            </div>
            <!--end of buttons -->


    </div>

</div>


<?php
include_once ("../files/bottom.php");
?>