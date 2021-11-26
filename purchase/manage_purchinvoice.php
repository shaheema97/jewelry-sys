<?php
include_once ("../supplier/supplier.php");
$purch_sup1=new supplier();
$result_sup1=$purch_sup1->get_all_sup();

include_once ("../staff/staff.php");
$purch_staff1=new staff();
$result_staff1=$purch_staff1->get_all();

include_once ("../purchase/purchase.php");
$purch_2=new purchase();
$result_purch=$purch_2->get_all_purchase();

if(isset($_POST['filter_stdt'])){
    $result_purch=$purch_2->filter_purchase($_POST);
  // print_r( $result_purch);
    //exit;
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
                        
                        <li class="breadcrumb-item"><a href="#!">Manage Purchase Invoice</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> 
<!-- Success-color Breadcrumb card end -->
<div class="row"> 
            <div class="col-sm-12">
                <div class="class-header">
                    <div class="d-flex flex-row-reverse">
                        <div class="p-2">
                                <a href="../purchase/manage_purchorder.php" class="btn btn-inverse" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                Manage Purchase order
                                </a>
                        </div>
                        <div class="p-2">
                                <a href="../purchase/purch_invoice_frm.php" class="btn btn-inverse" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                Purchase invoice
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="page-body">
<div class="col-sm-12">
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
                            <label for="" class="col-form-label">Payment Status</label>
                            <select name="" id="" class="form-control">

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
                    foreach($result_purch as $item){
                        echo"<tr>
                        <td>$item->purchase_id</td>
                        <td>".$item->supp_name->sup_firstname."</td>
                        <td>$item->purchase_date</td>
                        <td>".$item->emp_name->st_firstname."</td>

                        <td>$item->purchase_payment</td>
                        <td>$item->purchase_paid_amt</td>
                        <td>$item->purchase_due_amt</td>";

                        echo'   <td class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                        <div class="dropdown-menu dropdown-menu-right b-none contact-menu">';
                          echo"  <a href=''class='dropdown-item' ><i class='icofont icofont-edit'>View Invoice</i></a>";
                           echo" <a  class='dropdown-item'   data-toggle='modal' data-target='#large-Modal' ><i class='icofont icofont-ui-delete'>Item Info</i></a>
                            <a class='dropdown-item' href='../purchase/manage_purchasepay.php?view=$item->purchase_id'><i class='icofont icofont-eye-alt'></i>Make Payment</a>
                            <a class='dropdown-item' href=''><i class='icofont icofont-eye-alt'></i>Payment History</a>
                        </div>
                    </td>

                        

                    </tr>";
                    }
                ?>
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