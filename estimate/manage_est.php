<?php
include_once ("../estimate.php");
$est=new estimate();
$est->get_estimate();



include_once ("../files/top.php");
?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
            <div class="card-block success-breadcrumb">
                <div class="breadcrumb-header">
                    <strong>Estimate</strong><br>
                    
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#!">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        
                        <li class="breadcrumb-item"><a href="#!">Manage Purchase Invoice</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> 
<!-- Success-color Breadcrumb card end -->

<div class="page-body">

<div class="col-sm-12">
<!--start 1 -->
<div class="col-sm-12">
                    <div class="class-header">
                        <div class="d-flex flex-row-reverse">
                            <div class="p-2">
                                    <a href="form2.php" class="btn btn-inverse" style="float: right;">
                                    <i class="icofont icofont-plus"></i>
                                    Pawn Etimate
                                    </a>
                            </div>
                            <div class="p-2">
                                     <a href="form2.php" class="btn btn-inverse" style="float: right;">
                                    <i class="icofont icofont-plus"></i>
                                    Oldgold Estimat
                                    </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div> <!--end 1 -->
<div class="card">
    <!-- filter start -->
        
        <div class="card-block border border-primary">
            <form action="manage_purchinvoice.php" method="POST">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="" class="col-form-label">Start Date</label>
                            <input type="date" class="form-control" name='filter_stdt'>
                        </div>
                        <div class="col-sm-6">
                        <label for="" class="col-form-label">End Date</label>
                            <input type="date" class="form-control" name='filter_endt'>
                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="col-form-label">Purchase Invoice No</label>
                            <input type="text" class="form-control" name="filter_purchin">
                        </div>
                        <div class="col-sm-3">
                            <label for="" class="col-form-label">Supplier</label>
                            <select id="" class="form-control" name="filter_purchsupp">
                                <option value="-1">Select Supplier</option>
                                <?php
                                    foreach($result_sup1 as $item){
                                        echo"<option value='$item->sup_id'>$item->sup_firstname</option>";
                                    }

                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="" class="col-form-label">Recieved by</label>
                            <select name="filter_emp" id="" class="form-control">
                                    <option value="-1">Select staff</option>
                            <?php
                                foreach($result_staff1 as $item){
                                    echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                }

                            ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="" class="col-form-label">Type</label>
                            <select name="" id="" class="form-control">
                                <option value="">Select Type</option>
                                <option value="estimate">Estimate</option>
                                <option value="Pawn">Pawn</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="form-group row">
                    <div class="col-sm-10"></div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success m-r-10 m-b-5"  >
                        <i class="icofont icofont-search" ></i>
                        Search
                        </button>
                    </div>
                
                </div>
            </form>
        </div>

    <!-- filter end -->
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table id="basic-btn" class="table table-sm table-striped  table-bordered nowrap">
                <thead>
                    <tr>
                    <td>#</td>
                    <td>Supplier</td>
                    <td>Date</td>
                    <td>Staff</td>
                    <!-- <td>Status</td> -->
                    <td>Amount</td>
                    <td>Paid/Amt</td>
                    <td>Due/Amt</td>
                    <td>Action</td>
                    
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($r1 as $item){
                    echo"   <tr>
                        <td >$item->pawn_id</td>
                        <td>".$item->cusname->cust_first_nm."</td>
                        <td>$item->pawn_dt</td>
                        <td>$item->pawn_duedt</td>
                        <td>$item->pawn_type</td>
                        <td>".$item->stname->st_firstname."</td>
                        <td>$item->pawn_rvtot</td>
                        <td>$item->pawn_paid</td>
                        <td>$item->pawn_due</td>";
                    echo'   <td class="dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                            <div class="dropdown-menu dropdown-menu-right b-none contact-menu">';
                                echo"  <a href='ticket.php?di=$item->pawn_id'class='dropdown-item' ><i class='icofont icofont-edit'>View Ticke</i></a>";
                                echo" <a  class='dropdown-item extend' onclick='pop($item->pawn_id,\"$item->pawn_dt\",\"$item->pawn_rvtot\",\"$item->pawn_int\",\"$item->pawn_intval\",\"$item->pawn_avtot\",\"$item->pawn_cus\",\"$item->pawn_id\",\"$item->pawn_rvtot\",\"$item->pawn_paid\",\"$item->pawn_due\")'  data-toggle='modal' data-target='#large-Modal' ><i class='icofont icofont-ui-delete'>Extend</i></a>
                                    <a class='dropdown-item payhistory' onclick='pop($item->pawn_id,\"$item->pawn_dt\",\"$item->pawn_rvtot\",\"$item->pawn_int\",\"$item->pawn_intval\",\"$item->pawn_avtot\",\"$item->pawn_cus\",\"$item->pawn_id\",\"$item->pawn_rvtot\",\"$item->pawn_paid\",\"$item->pawn_due\")' data-toggle='modal' data-target='#payhistorymodal' id='$item->pawn_id' ><i class='icofont icofont-ui-delete'>Payment</i></a>
                                <a class='dropdown-item' href='pawnpay.php?di=$item->pawn_id'><i class='icofont icofont-eye-alt'></i>Make Payment</a>
                                
                            </div>
                        </td>";
                    echo"</tr>";
                    
                    }  ?>
                </tbody>
                
            </table>
        </div>
                                                    </div>
                                                </div>
</div>
</div>
</div>

<?php
include_once ("../files/bottom_dt.php");
?>




