<?php
    include_once ("../supplier/supplier.php");
    $purch_sup1=new supplier();
    $result_sup1=$purch_sup1->get_all_sup();
   
    include_once ("../staff/staff.php");
    $purch_staff1=new staff();
    $result_staff1=$purch_staff1->get_all();
   
    include_once ("purchaseorder.php");
    $p_order=new purchaseorder();
    $result=$p_order->get_all_purchorder();

    if(isset($_POST['filter_stdate'])){
        $result=$p_order->filter_purchorder($_POST['filter_stdate']);
    }
    


    include_once ("../files/top.php");

?>

<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
            <div class="card-block success-breadcrumb">
                <div class="breadcrumb-header">
                    <h2></h2><br>
                    
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#!">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        
                        <li class="breadcrumb-item"><a href="#!">Manage orders</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> 
<!-- Success-color Breadcrumb card end -->
<div class="page-body">
    <!--start 1 -->
    <div class="row"> 
            <div class="col-sm-12">
                <div class="class-header">
                    <div class="d-flex flex-row-reverse">
                        <div class="p-2">
                                <a href="../purchase/manage_purchinvoice.php" class="btn btn-inverse" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                Manage Purchase invoice
                                </a>
                        </div>
                        <div class="p-2">
                                <a href="../purchase/purch_order_frm.php" class="btn btn-inverse" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                Purchase order
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end 1 -->
<div class="col-sm-12">
<div class="card">
    <!-- filter start -->
        
        <div class="card-block border border-primary">
            <form action="manage_purchorder.php" method="POST">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="" class="col-form-label">Start Date</label>
                            <input type="date" class="form-control" name="filter_stdate">
                        </div>
                        <div class="col-sm-6">
                        <label for="" class="col-form-label">End Date</label>
                            <input type="date" class="form-control" name="filter_endt">
                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="col-form-label">Order No</label>
                            <input type="text" class="form-control" name="filter_id">
                        </div>
                        <div class="col-sm-3">
                            <label for="" class="col-form-label">Supplier</label>
                            <select name="filter_sup" id="" class="form-control">
                            <option value="-1">Select supplier</option>
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

                            ?></select>
                        </div>
                        <div class="col-sm-3">
                            <label for="" class="col-form-label">Status</label>
                            <select name="filter_status" id="" class="form-control">
                            <option value="-1">Select status</option>

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
    <!-- table start  -->
        <div class="card-body">
        <div class="dt-responsive table-responsive">
            <table  id="basic-btn" class="table table-striped table-bordered nowrap" style="width : 100% ">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Supplier</td>
                            <td>Date</td>
                            <td>Staff</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                    
                            foreach($result as $item){
                                echo"
                                <tr>
                                <td>$item->purchorder_id</td>
                                <td>".$item->supp_name->sup_firstname."</td>
                                <td>$item->purchorder_date</td>
                                <td>".$item->emp_name->st_firstname."</td>
                                <td><label class='badge badge-success'>$item->purchorder_work_status </labeel></td>
                                <td><div class='btn-group btn-group-sm' style='float: none;'>
                                <a href='../purchase/orderedit.php?edit=$item->purchorder_id' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></a >
                                   <button type='button'  onclick='delu($item->purchorder_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
                                   <a href='../purchase/orderedit?edit=$item->purchorder_id' class='tabledit-delete-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;' ><span class='zmdi zmdi-eye'></span></a>
                               </div>
                       </td>
                       

                            </tr>
                                
                                ";
                            }
                       ?>
                    </tbody>
                </table>
            </div>
        </div>
    <!-- table end -->

</div>
</div>
</div>

<?php

include_once ("../files/bottom_dt.php");

?>

<script>
    
</script>
