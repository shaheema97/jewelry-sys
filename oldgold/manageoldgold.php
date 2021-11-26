<?php
include_once ("../oldgold/oldgold.php");
$oldgold5=new oldgold();
$res_oldgold=$oldgold5->getall_oldgold();

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
                        
                        <li class="breadcrumb-item"><a href="#!">Manage Oldgold</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> 
<!-- Success-color Breadcrumb card end -->

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
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Oldgold No</label>
                            <input type="text" class="form-control" name="filter_purchin">
                        </div>
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Customer</label>
                            <select id="" class="form-control" name="filter_purchsupp">
                                <option value="-1">Select Customer</option>
                                
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Recieved by</label>
                            <select name="filter_emp" id="" class="form-control">
                                    <option value="-1">Select staff</option>
                            <!-- <?php
                                // foreach($result_staff1 as $item){
                                //     echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                // }

                            ?> -->
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
                    <td>Customer</td>
                    <td>Date</td>
                    <td>Staff</td>
                    <!-- <td>Status</td> -->
                    <td>Total</td>
                    
                    <td>Action</td>
                    
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($res_oldgold as $item){
                        echo"<tr>
                        <td>$item->oldgold_id</td>
                        <td>".$item->cusname->cust_first_nm."</td>
                        <td>$item->oldgold_date</td>
                        <td>".$item->stname->st_firstname."</td>

                        <td>$item->oldgold_subtot</td>
                        <td>$item->oldgold_redtot</td>
                        <td>$item->oldgold_nettot</td>

                        <td><div class='btn-group btn-group-sm' style='float: none;'>
                        
                           <button type='button'  onclick='delu($item->oldgold_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
                           <button type='button' class='tabledit-delete-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;' ><span class='zmdi zmdi-eye'></span></button>
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

<script>
<script>
function delu(d){
			if(confirm("u want to delete"+""+d))
			{
				window.location.href="manageoldgold.php?del="+d;
			}
			}
</script>
</script>