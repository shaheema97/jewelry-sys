<?php

include ("staff.php");
$st2=new staff();

$val=$st2->get_all();
//print_r($val);

include_once ("../login/user_role.php");
$role=new user_role();
$role_res=$role->get_all_user();

if(isset($_GET["did"])){
    $st2->del_staff($_GET["did"]);
    echo '<script>
        setTimeout(function() {
            swal({
                title: "Deleted!",
                text: "Staff is deleted!",
                type: "success"
            }, function() {
                window.location = "../staff/staff.php";
            });
            }, 1000);
            </script>';
    
}
if(isset($_POST['filter'])){
        
    $val=$st2-> get_all_filter($_POST);
   // print_r( $r1);
    // exit;}
  
}




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
                        
                        <li class="breadcrumb-item"><a href="#!">Manage Staff</a>
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
                        <a href="../staff/managestaff" class="btn btn-inverse" style="float: right;">
                        <i class="icofont icofont-plus"></i>
                        Manage Staff
                        </a>
                </div>
                <div class="p-2">
                        <a href="../staff/staff-frm.php" class="btn btn-inverse" style="float: right;">
                        <i class="icofont icofont-plus"></i>
                        Add Staff
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>


    
    <div class="col-sm-12">
                                    <div class="card rounded border border-primary" style="">
                                    <div class="class-header"></div>
                                    <div class="card-block">
                                        <!--Start of search filter -->
                                        <form action="managestaff.php" method="POST">
                                           
                                            <div class="form-group row">
                                                <div class="col-sm-3 " id="filter_id">
                                                    <label>Staff ID:</label>
                                                    <input type="text" class="form-control form-control-default" name="filter_id" >
                                                </div>
                                                <div class="col-sm-3 ">
                                                    <label>Profession:</label>
                                                    <select name="filter_role" id="" class="form-control">
                                                    <option selected='selected' value="-1">-- select Role --</option>
                                                    <?php foreach ($role_res as $item){
                          
            
                                                        echo "<option value='$item->role_id'  selected='selected'>$item->role_name</option>	";
           
                                                    }?>
                                                    
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 ">
                                                        <label>Transaction Type:</label>
                                                        <input type="text" class="form-control" name="filter_nic">
                                                       
                                                </div>
                                                <div class="col-sm-3 ">
                                                        <label>Staff:</label>
                                                        <select id=""  class="form-control" name="filter_staff">
                                                            <option selected='selected' value="-1">-- select Role --</option>
                                                            <?php
                                                                foreach($val as $item){
                                                                    
                                                                    echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                </div>
                                                
                                            </div>
                                            <!--button search-->
                                            <div class="form-group row">
                                                <div class="col-sm-10"></div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="btn btn-success m-r-10 m-b-5" name="filter"  >
                                                    <i class="icofont icofont-search" ></i>
                                                    Search
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- END of button search-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
    
    </div>
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table id="basic-btn" class="table  table-sm table-striped table-bordered nowrap">
                <thead>
                <tr class="table-primary table-*">
                    <th>ID</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>NIC</th>
                    <th>Telephone</th>
                    <th>e-mail</th>
                    <th>Action</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($val as $item){
                echo"
                    <tr>
                        <td>$item->st_id</td>
                        <td>$item->st_firstname</td>
                        <td>$item->st_dob</td>
                        <td>$item->st_nic</td>
                        <td>$item->st_mob1</td>
                        <td>$item->st_mail</td>
                        
                        
                        <td style='white-space: nowrap, width: 1%;'>
                            <div class='tabledit-toolbar btn-toolbar' style='text-align: left;'>
                                <div class='btn-group btn-group-sm' style='float: none;'>
                                    <a href='staff-frm.php?edit=$item->st_id' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></a>
                                    <button type='button'  onclick='delu($item->st_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
                                    <a href='staff_prof.php?di=$item->st_id'  class='tabledit-delete-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;' ><span class='zmdi zmdi-eye'></span></a>
                                </div>
                        </td>
                            
                    </tr>  ";}?>
                    
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>NIC</th>
                    <th>Telephone</th>
                    <th>e-mail</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                
            </table>
        </div>
    </div>
</div>
<!-- Zero config.table end -->


</div>
<?php
include_once ("../files/bottom_dt.php");
?>

        <script> 
            function delu(d){
			if(confirm("Do want to delete item name  "+d))
			{
				window.location.href="managestaff.php?did="+d;
			}
			}
			</script>








