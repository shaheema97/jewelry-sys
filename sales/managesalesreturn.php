<?php
include_once ("../staff/staff.php");//for dropdown
$s1=new staff();
$result_staff=$s1->get_all();

include_once ("../customer/cust.php");
$c1=new cust();
$result_cust=$c1-> get_all_cus();

include_once ("../sales/salesreturn.php");
$sales2=new salesreturn();
$result_sales=$sales2->getall_salesreturn();

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
                
                <li class="breadcrumb-item"><a href="#!">Manage sales</a>
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
                    <div class="p-2">
                            <a href="manageorders.php" class="btn btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            Manage Orders
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="buygold2.php" class="btn btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            New Sales
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--end 1 -->
    <div class="row"> <!--start 2 -->
        <div class="col-sm-12">
            <div class="card rounded border border-primary" style="">
                <div class="class-header">
                    
                </div>
                <div class="card-block">
                <form action="managesales.php" method="POST">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="" class="col-form-label"><strong>Start Date</strong></label>
                            <input type="date" class="form-control"  name="sales_srtdt">
                        </div>
                        <div class="col-sm-6">
                            <label for="" class="col-form-label"><strong>End Date</strong></label>
                            <input type="date" class="form-control" name="sales_endt">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Sales id</label>
                            <input type="text" class="form-control" name="salesid">
                        </div>
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Customer</label>
                            <select id="" class="form-control" name="filter_sales_cust">
                                <option value="-1"></option><?php
                                foreach($result_cust as $item){
                                                
                                                echo"<option value='$item->cust_id'>$item->cust_first_nm</option>";
                                            }
                                        ?>
                                
                                            
                                
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Recieved by</label>
                            <select  id="" class="form-control" name="filter_sales_emp">
                                <option value="-1"></option>
                                <?php
                                foreach($result_staff as $item){
                                                
                                            echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                                echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                            }
                                        ?>
                                    

                                    
                                
                            </select>
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
            </div>
        </div>
    </div> <!--end 1 -->
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table  id="basic-btn" class="table table-striped table-bordered nowrap">
                <thead>
                    <th>ID</th>
                    <th>Sales ID</th>
                    <th>Customer</th>
                    <th>SalesDate</th>
                    <th>Staff</th>
                    <th>Return Amount</th>
<!--                     
                    <th>Action</th> -->

                    <!-- <th>Price</th> -->
                    
                </thead>
                <tbody>
                <?php
                foreach($result_sales as $item){
                    echo"<tr>
                        <td>$item->salesreturn_id</td>
                        <td>$item->salesreturn_salesid</td>
                        <td>".$item->sales_details->cust_name->cust_first_nm."</td>
                        <td>$item->salesreturn_date</td>
                        <td>".$item->return_emp->st_firstname."</td>

                        <td>$item->salesreturn_amount</td>
                      
                        ";

                       
                }
                ?>


                </tbody>
            </table>
        </div>
    </div>



</div>



<?php
include_once ("../files/bottom_dt.php");
?>