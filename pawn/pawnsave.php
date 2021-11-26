<?php
session_start();
 include_once ("../staff/staff.php");
 include_once ("../customer/cust.php");
$s=new staff();
$r=$s->get_all();
$c=new cust();
$rc=$c->get_all_cus();
include_once ("pawn.php");
include_once ("pawnitem.php");
$p1=new pawn();
if(isset($_POST["sub"])){
    $p1->pawn_dt=$_SESSION["pawn"]["pdt"];
    $p1->pawn_cus=$_SESSION["pawn"]["pcus"];
    $p1->pawn_em=$_SESSION["pawn"]["pem"];
    $p1->pawn_mvtot=$_SESSION["pawn"]["mktval"];
    $p1->pawn_avtot=$_SESSION["pawn"]["asvtot"];
    $p1->pawn_period=$_SESSION["pawn"]["periodtime"];
    $p1->pawn_int=$_SESSION["pawn"]["lint"];
    $p1->pawn_intval=$_SESSION["pawn"]["intval"];
    $p1->pawn_rvtot=$_SESSION["pawn"]["rvtot"];
   

    $z=$p1->insertpawn();
    
   $pt=new pawnitem();
   $pt->addpawnitem($z);
    //$_SESSION["pawn"]["cat"]=$pt;
  $a=$pt->addpawnitem($z);
   
}
include_once ("../files/top.php");
?>

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
			<div class="card-header">
                        
			</div>
			<div class="card-block">
                <!-- Start of general info-->

            
                        <div class="row invoive-info">
                            <div class="col-md-4 col-xs-12 invoice-client-info">
                                <h6>Customer Information :</h6>
                                <h6 class="m-0"> </h6>
                                <h6>Staff Information :</h6>
                                <h6 class="m-0"><?=$_SESSION["pawn"]["pem"]?></h6>
                                
                                
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h6>Pawn Information :</h6>
                                <table class="table table-responsive invoice-table invoice-order table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>Pawn Date :</th>
                                            <td><?=$_SESSION["pawn"]["pdt"]?></td>
                                        </tr>
                                        <tr>
                                            <th>End Date :</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Time Duration :</th>
                                            <td>
                                               <?=$_SESSION["pawn"]["periodtime"]  ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status :</th>
                                            <td>
                                                <span class="label label-warning">New Pawn</span>
                                            </td>
                                        </tr>
                                        <tr>
                                           
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h6 class="m-b-20">Ticket  Number: <span></span></h6>
                                <h6 class="text-uppercase text-primary">Total Due :
                                    <span><?=$_SESSION["pawn"]["rvtot"] ?></span>
                                </h6>
                            </div>
                        </div>
                <!--End of general info -->
                 <!--Start of item description info -->        
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table  invoice-detail-table">
                                    <thead>
                                        <tr class="thead-default">
                                            <th>Description</th>
                                            <th>Market Value</th>
                                            <th>Principal Amount</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tbody>
                                        <?php
                                            $c=0;
                                            foreach($_SESSION["pawn"]["cat"] as $item){


                                      echo"  <tr>
                                            <td>
                                                <span>".$_SESSION["pawn"]["cat"][$c]."</span><span> |</span >".$_SESSION["pawn"]["item"][$c]." <span><span> |</span >".$_SESSION["pawn"]["kar"][$c]." </span><span> |</span >".$_SESSION["pawn"]["wt"][$c]."
                                                
                                            </td>
                                            
                                            <td>".$_SESSION["pawn"]["mkv"][$c]."</td>
                                            <td>".$_SESSION["pawn"]["rvt"][$c]."</td>
                                        </tr>} " ;
                                        
                                        $c++;
                                        }?>
                                        
                                    </tbody>

                                    
                                        
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                <!--End of item description info -->        
                <!-- start of payment-->
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-responsive invoice-table invoice-total">
                            <tbody>
                                <tr>
                                    <th>Total Market Value:</th>
                                    <td><?=$_SESSION["pawn"]["mktval"]?></td>
                                </tr>
                                <tr>
                                    <th>Total Principal :</th>
                                    <td><?=$_SESSION["pawn"]["asvtot"]?></td>
                                </tr>
                                <tr>
                                    <th>Interest (<?= $_SESSION["pawn"]["lint"];?>) :</th>
                                    <td><?=$_SESSION["pawn"]["intval"] ?></td>
                                </tr>
                                <tr class="text-info">
                                    <td>
                                        <hr>
                                        <h5 class="text-primary">Total Pawn Value :<?= $_SESSION["pawn"]["rvtot"] ?></h5>
                                    </td>
                                    <td>
                                        <hr>
                                        <h5 class="text-primary"></h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                                    <form action="pawnsave.php" method="POST">
                <!-- end of payment-->
                <!--start buton -->
                <div class="row">
                    <div class="col-sm-12">
                    <div class="text-center">
                            <a href="pawnfrm2.php" class="btn btn-inverse m-r-10 m-b-5 "  >
                            <i class="icofont icofont-double-left"></i>
                            Go back
                            </a>
                           

                            <button type="submit" class="btn btn-primary m-r-10 m-b-5 " name="sub"  >
                            <i class="icofont icofont-printer"></i>
                            savee
                            </button>

                            <button type="button" class="btn btn-danger m-r-10 m-b-5 "  >
                            <i class="icofont icofont-ui-close"></i>
                            Cancel
                            </button>
                        </div>
                    </div></form>
                </div>
                                    
                <!--end  buton -->
            </div>
        </div>
    </div>
</div>


<?php
    include_once ("../files/bottom.php");
?>