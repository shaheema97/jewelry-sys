<?php
include_once ("../staff/staff.php");//for dropdown
$s1=new staff();
$result_staff=$s1->get_all();

include_once ("../customer/cust.php");
$c1=new cust();
$result_cust=$c1-> get_all_cus();

include_once ("order.php");
$order3=new order();
$resultorder=$order3-> getall_order();

if(isset($_POST['filter'])){
        
    $resultorder=$order3->filterorders($_POST);
   // print_r( $r1);
    // exit;}
  
}
if(isset($_GET["del"])){
    if ($order3->del_order($_GET["del"])){
    // echo '
    //<script>
    // setTimeout(function() {
    //     swal({
    //         title: "Category Deleted!",
    //         text: "Category is deleted successfully!",
    //         type: "success"
    //     }, function() {
    //         window.location = "../sales/manageorders.php.";
    //     });
    //     }, 1000);
    //     </script>';
    echo'DONE';}


    else{
    // echo '<script>
    // setTimeout(function() {
    //     swal({
    //         title: "Category not Added!",
    //         text: "Items exist so unable to delete!",
    //         type: "error"
    //     });
    //     }, 1000);
    //     </script>'; 
        echo'not done';
}

   }
include_once ("../files/top.php");
?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
            <div class="card-block success-breadcrumb">
                <div class="breadcrumb-header">
                    <strong>Sales order</strong><br>
                    
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
    <div class="row"> <!--start 1 -->
        <div class="col-sm-12">
            <div class="class-header">
                <div class="d-flex flex-row-reverse">
                    <!-- <div class="p-2">
                            <a href="managesales.php" class="btn btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            Manage Sales
                            </a>
                    </div> -->
                    <div class="p-2">
                            <a href="order_frm.php" class="btn btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            New Orders
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--end 1 -->
    <div class="row"> <!--start top button-->
                    <div class="col-sm-12">
                        <div class="class-header">
                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                            <a href="manageorders.php" class="btn btn-sm btn-inverse" style="float: right;">
                                            <i class="fa fa-angle-double-left"></i>
                                            Back
                                            </a>
                                </div>
                                <div class="p-2">
                                <!-- <a href="manageorders.php" class="btn btn-sm btn-success" style="float: right;">
                                            <i class="icofont icofont-plus"></i>
                                            Manage orders
                                            </a>
                                </div> -->
                                <!-- <div class="p-2">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#default-Modal" style="float: right;">
                                            <i class="icofont icofont-plus"></i>
                                            Redeem Items
                                            </button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
        </div> <!--end top button -->
    <div class="row"> <!--start 2 -->
            <div class="col-sm-12">
                <div class="card rounded border border-primary" style="">
                    <div class="class-header">
                        
                    </div>
                    <div class="card-block">
                    <form action="manageorders.php" method="POST">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="" class="col-form-label"><strong>Start Date</strong></label>
                                <input type="date" class="form-control"  name="filter_stdt">
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="col-form-label"><strong>End Date</strong></label>
                                <input type="date" class="form-control" name="filter_endt">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="" class="col-form-label">Order id</label>
                                <input type="text" class="form-control" name="filter_id">
                            </div>
                            <div class="col-sm-3">
                                <label for="" class="col-form-label">Customer</label>
                                <select id="" class="form-control" name="filter_cus">
                                    <option selected='selected' value="-1"></option><?php
                                    foreach($result_cust as $item){
                                                    
                                                    echo"<option value='$item->cust_id'>$item->cust_first_nm</option>";
                                                }
                                            ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="" class="col-form-label">Recieved by</label>
                                <select  id="" class="form-control" name="filter_staff">
                                    <option selected='selected' value="-1"></option>
                                    <?php
                                    foreach($result_staff as $item){
                                                    
                                             echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                                    echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                                }
                                            ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="" class="col-form-label">Status</label>
                                <select  id=""  class="form-control" name="filter_status">
                                    <option selected='selected' value="-1"></option>
                                    <option value="new">New Order</option>
                                    <option value="ongoing"></option>
                                    <option value="complete"></option>
                                    <select>
                            </div>
                        
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10"></div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-success m-r-10 m-b-5" name="filter" >
                                <i class="icofont icofont-search" ></i>
                                Search
                                </button>
                            </div>
                        
                        </div>
                    </form>
                    
                    </div>
                </div>
            </div>
        </div> <!--end 2 -->
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table  id="basic-btn" class="table table-striped table-bordered nowrap">
                    <thead>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>OrderDate</th>
                        <th>Duedate</th>
                        <th>Staff</th>
                        <th>Status</th>
                        <!-- <th>Price</th> -->
                        <th>Action</th>
                    </thead>
                    <tbody>
                    <?php
                    foreach($resultorder as $item){
                        echo"<tr >
                            <td>$item->order_id</td>
                            <td>".$item->order_cus_name->cust_first_nm."</td>
                            <td>$item->order_date</td>
                            <td>$item->order_duedate</td>
                            <td>".$item->order_emp_name->st_firstname."</td>
                            <td ><label class='badge st$item->order_workstatus'>$item->order_workstatus</label></td>
                            <td><div class='btn-group btn-group-sm' style='float: none;'>
                                     <a href='../sales/salesorderedit.php?edit=$item->order_id' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></a >
                                        <button type='button'  onclick='delu($item->order_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
                                        <a href='../sales/salesorderview.php?edit=$item->order_id' class='tabledit-delete-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;' ><span class='zmdi zmdi-eye'></span></a>
                                    </div>
                            </td>
                            

                            

                       </tr>";}
                    ?>


                    </tbody>
                </table>
            </div>
        </div>



</div>


<?php

include_once ("../files/bottom_dt.php");

?>

<script>
function delu(d){
			if(confirm("u want to delete"+""+d))
			{
				window.location.href="manageorders.php?del="+d;
			}
			}

</script>




   