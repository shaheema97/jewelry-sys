<?php
 include_once ("../files/top.php");
?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
    <div class="card-block success-breadcrumb">
        <div class="breadcrumb-header">
            <strong>Purchase Invoice</strong>
            <br>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#!">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                
                <li class="breadcrumb-item"><a href="#!">Purchase Invoice</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Success-color Breadcrumb card end -->

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            
                <!-- <div class="card-header"> -->
                
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                            <a href="managesales.php" class="btn btn-sm btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            Manage Order
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="order_frm.php" class="btn btn-sm btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                           Manage purchase invoice
                            </a>
                    </div>
                    
                </div>
                <!-- </div> -->
                <div class="card">
                <div class="card-body">
                    <div class="card-body bg bg-primary">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="col-form-label">Supplier</div>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-form-label">Date</div>
                                    <input type="text" class="form-control">
                                </div> 
                                <div class="col-sm-3">
                                    <div class="col-form-label">Recieved by</div>
                                    <input type="text" class="form-control">
                                </div> 
                                <div class="col-sm-2">
                                    <label for=""></label><br>
                                    <div class="d-flex flex-row-reverse">
                                        <div class="p-2">
                                            <button type="button" id=" " class="btn btn btn-success"   >
                                            <i class="icofont icofont-search"></i>
                                            Search
                                            </button>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="card-body">
                    <div class="">
                                                    <table id="" class="table table-fixed">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>First name</th>
                                                                <th>Last name</th>
                                                                <th>ZIP / Post code</th>
                                                                <th>Country</th>
                                                            </tr>
                                                        </thead> 
                                                        <tbody >
                                                        <tr>
                                                        <td>56</td>
                                                        <td>emanual</td>
                                                        <td>samson</td>
                                                        <td>5689132</td>
                                                        <td>canada</td>
                                                        
                                                        </tr>
                                                        <tr>
                                                        <td>56</td>
                                                        <td>emanual</td>
                                                        <td>samson</td>
                                                        <td>5689132</td>
                                                        <td>canada</td>
                                                       
                                                        </tr>
                                                        <tr>
                                                        <td>56</td>
                                                        <td>emanual</td>
                                                        <td>samson</td>
                                                        <td>5689132</td>
                                                        <td>canada</td>
                                                        </tr>
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                        <td>  </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>TOTAL:</td>
                                                        <td></td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>                    </div>
                        <!-- <div class="card-body border border-primary" style="height:150px;"> -->
                            <div class="row">
                                <div class="card-body col-sm-3 "></div>
                                <div class="card-body col-sm-6 border border-primary">
                                    <div class=" form-group row">
                                        <div class="col-sm-4">
                                            <label for="" class="col-form-label">Payment Type</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="d-flex justify-content-around">
                                                <button  type="button" class="btn btn-mini btn-primary" >Cash</button>
                                                <!-- <button  type="button" class="btn  btn-mini btn-warning" data-toggle="modal" data-target="#default-Modal">Card</button> -->
                                                <button  type="button" class="btn btn-mini btn-inverse"  data-toggle="modal" data-target="#default-Modal-bank">Cheque</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="" class="col-form-label">Total Amount</label>
                                        </div>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control  form-control-sm">
                                        </div>
                                        
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="d-flex  d-flex justify-content-center">
                                            <div class="p-2">  <button type="reset" class="btn btn-sm btn-danger" style="width:146px"><i class="icofont  icofont-ui-close"></i>CANCEL</button></div>
                                            <div class="p-2"> <button  type="button" class="btn btn-sm btn-inverse style="width:146px"><i class="icofont icofont-printer"></i>PRINT RECEIPT</button></div>
                                            <div class="p-2"> <button type="submit" class="btn btn-sm btn-success"><i class="icofont icofont-tick-mark"></i>PROCESS PAYMENT</button></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body ">
                                
                                
                                </div>
                            </div>
                           
                            
                        <!-- </div>  -->
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<?php

include_once ("../files/bottom_dt.php");

?>

<script>

</script>