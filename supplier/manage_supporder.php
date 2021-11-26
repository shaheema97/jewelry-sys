<?php
 include_once ("../staff/staff.php");
 $purch_staff1=new staff();
 $result_staff1=$purch_staff1->get_all();

 include_once ("../purchase/purchaseorder.php");
 $p_order=new purchaseorder();
 $result=$p_order->get_all_purchorder();
 
include_once ("../files/top_supp.php");

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
                    <li class="breadcrumb-item"><a href="#!">Manage Orders</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
    <div class="row">
        <div class="col-sm-12">
             <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="" class="col-form-label">Start Date</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label for="" class="col-form-label">End Date</label>
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label">Order ID</label>
                                    <select name="" id="" class="form-control"></select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label">Recieved by</label>
                                    <select name="" id="" class="form-control"></select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label">Status</label>
                                    <select name="" id="" class="form-control"></select>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-sm-10"></div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-success m-r-10 m-b-5"  >
                                    <i class="icofont icofont-search" ></i>
                                    Search
                                    </button>
                                </div>
                
                            </div>
                        </div>
                        <!-- end of form -->
                    </form>

                   
                </div>
                <!-- end of top card-body -->
                 <!-- table start  -->
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table  id="basic-btn" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <td>#</td>
                           
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
                       
                        <td>$item->purchorder_date</td>
                        <td>".$item->emp_name->st_firstname."</td>
                        <td>$item->purchorder_status</td>
                        <td></td> ";
                        echo'   <td class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                        <div class="dropdown-menu dropdown-menu-right b-none contact-menu">';
                          echo"  <a href=''class='dropdown-item' ><i class='icofont icofont-edit'>View Invoice</i></a>";
                           echo" <a  class='dropdown-item'  href='../supplier/orderinfo.php?view=$item->purchorder_id'  ' ><i class='icofont icofont-ui-delete'>Item Info</i></a>
                            <a class='dropdown-item'><i class='icofont icofont-eye-alt'></i>Make Payment</a>
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
    <!-- table end -->

             </div>
        </div>
    </div>


<?php
include_once ("../files/bottom_dt.php");

?>