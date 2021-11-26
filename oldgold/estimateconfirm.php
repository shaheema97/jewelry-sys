<?php
session_start();
      include_once ("../estimate/estimate.php");
      $est2=new estimate();
      $result_est2=$est2->get_estimatebyid($_SESSION["estid"]);
       
      include_once ("../estimate/estimateitem.php");
      $est_item2=new estimateitem();
      $result_estitem2=$est_item2->getitem_by_estimateid($_SESSION["estid"]);




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
                    <li class="breadcrumb-item"><a href="#!">Oldgoldbuy </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Estimate</a>
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
                           Delete Estimate
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="order_frm.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-printer"></i><br>
                            Print Estimate
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="order_frm.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-search"></i><br>
                           Search Estimate
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="pawnfrm2.php" class="btn btn-inverse  btn-sm" style="float: right;">
                            <i class="icofont icofont-plus"></i><br>
                            New Estimate
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
                                    <th class="text-center">Customer</th>
                                    <td><input type="text" class="form-control " value=""></td>
                                    <th class="text-center">Payment</th>
                                    <td><input type="text" class="form-control " value=" "></td>
                                    

                                </tr>
                               <tr>
                                    <th class="text-center">Invoice ID</th>
                                    <td><input type="text" class="form-control " value=""></td>
                                    <th class="text-center">Date</th>
                                    <td><input type="text" class="form-control " value=""></td>
                               </tr>
                            </table>
                        </div>
                        <div class="dt-responsive table-responsive">
                        <table  id="" class="table table-xs  table-fixed table-info nowrap table" style="width : 100% ,border:none;">
                               <thead>
                                    <tr>
                                        
                                       <th>Category</th>
                                       <th>Item</th>
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
                                
                                
                                    ?>  
                                    
                               </tbody>
                               </table>

                               <table  class="table table-xs  " style="" >
                                        <tr>
                                       
                                        <td style="" ><label class="label bg-primary">TOTAL:</label></td>
                                        
                                        
                                        <td style="" class=""><?= $result_est2->estimate_mvtot?></td>
                                        <td style="" class=""><?= $result_est2->estimate_avtot?></td>
                                       
                                        
                                        <td style=" " class=""><?= $result_est2->estimate_intval?></td>
                                       
                                      
                                        <td style="" class=""><?= $result_est2->estimate_rvtot?></td>

                                       
                                       </tr>
                                       <tfoot>
                                            <td></td>
                                            <td></td>
                                            <th >Final Amount</th>
                                            <td class="border border-success"><?= $result_est2->estimate_rvtot?></td>
                                            
                                       </tfoot>


                               </table>
                              
                                
                               
                            
                        </div>
                    
                    </div>
                </div>

                <!-- button start -->
                <div class="d-flex justify-content-center">
                    <div class="p-2">
                            <a href="" id="paynow" class="btn btn-success" >
                            <i class="icofont icofont-plus"></i>
                            DONE
                            </a>
                    </div>
                    
                </div>


                <!-- buttons end -->
            </div>
        </div>

    <!-- end of invoice details-->
   
<?php
    include_once ("../files/bottom.php");

?>

