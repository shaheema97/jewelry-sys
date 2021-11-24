<?php
include "cust.php";
$ct=new cust();


if(isset($_GET["did"])){
   $ct->del_CUS($_GET["did"]);
   

    }
    $res=$ct->get_all_cus();


include_once ("../files/top.php");
?>

<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
            <div class="card-block success-breadcrumb">
                <div class="breadcrumb-header">
                    <h2></h2>
                    
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#!">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        
                        <li class="breadcrumb-item"><a href="#!">Manage Customer</a>
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
                        
                </div>
                <div class="p-2">
                        <a href="../customer/form2.php" class="btn btn-inverse" style="float: right;">
                        <i class="icofont icofont-plus"></i>
                        Add Customer
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-sm-12">
<!-- Zero config.table start -->
<div class="card">
    <div class="card-header">
    <div class="" >
                                    <div class="class-header"></div>
                                    <div class="card-block">
                                        <!--Start of search filter -->
                                        <form action="managestaff.php" method="POST">
                                           
                                            
                                            
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                                <div class="card-block">
                                                <div class="dt-responsive table-responsive">
                                                    <table  id="basic-btn" class="table table-striped table-bordered nowrap" style="width : 100% ">
                                                            <thead>
                                                            <tr class="table-primary table-*">
                                                                <th>ID</th>
                                                                <th>Name</th>
                                                                <th>NIC</th>
                                                                <th>Telephone</th>
                                                                <th>e-mail</th>
                                                                
                                                                <th>Action</th>
                                                               
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            foreach($res as $item){
                                                            echo"
                                                                <tr>
                                                                    <td>$item->cust_id</td>
                                                                    <td>$item->cust_first_nm</td>
                                                                    <td>$item->cus_nic</td>
                                                                    <td>$item->cust_mob1</td>
                                                                    <td>$item->cust_mail</td>
                                                                 
                                                                    
                                                                   <td style='white-space: nowrap, width: 1%;'>  
                                                                        <div class='tabledit-toolbar btn-toolbar' style='text-align: left;'>
                                                                            <div class='btn-group btn-group-sm' style='float: none;'>
                                                                             <a href='../customer/form2.php?edit=$item->cust_id' type='button'; class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></a>
                                                                                <button type='button'  onclick='delu($item->cust_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
                                                                                <a type='button' href='../customer/cust_prof.php?edit=$item->cust_id' class='tabledit-delete-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;' ><span class='zmdi zmdi-eye'></span></a>
                                                                            </div>
                                                                    </td>
                                                                    
                                                                </tr>  ";}?>
                                                                
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Position</th>
                                                                <th>Office</th>
                                                                <th>Age</th>
                                                                <th>Start date</th>
                                                                <th>Salary</th>
                                                            </tr>
                                                            </tfoot>
                                                            
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Zero config.table end -->


</div>

<script> 
            function delu(d){
			if(confirm("u want to delete"+d))
			{
				window.location.href="managecus.php?did="+d;
			}
			}
			</script>



<?php

include_once ("../files/bottom_dt.php");

?>
