<?php
include ("supplier.php");
$sup3= new supplier();
 
$res1=$sup3->get_all_sup();

if(isset($_GET["did"])){
    $sup3->del($_GET["did"]);

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
                        
                        <li class="breadcrumb-item"><a href="#!">Manage Supplier</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
<!-- Success-color Breadcrumb card end -->


<div class="col-sm-12">
<!-- Zero config.table start -->
<div class="card">
                                            <div class="card-header">
                                            <div class="row">
                                                <div class="col-sm-10" >
                                                    <H4>Manage Supplier</H4>
                                                </div>
                                                    
                                                    <div class="col-sm-2">
                                                    <a href="supp.form.php" class="btn btn-inverse m-r-10 m-b-5">
                                                    <i class="icofont icofont-plus"></i>
                                                    Add Supplier
                                                    </a>
                                                    </div>
                                                </div>
                                            <div>
                                                    
                                            </div>
                                                   
                                                </div>
                                                <div class="col-sm-12">
                                                
                                                </div>
                                                <div class="card-block">
                                                    <div class="dt-responsive table-responsive">
                                                        <table  id="basic-btn" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                            <tr class="table-primary table-*">
                                                                <th>ID</th>
                                                                <th>Name</th>
                                                                <th>NIC</th>
                                                                <th>Telephone</th>
                                                                <th>City</th>

                                                                <th>e-mail</th>
                                                                <th>Action</th>
                                                               
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            foreach($res1 as $item){
                                                            echo"
                                                                <tr>
                                                                    <td>$item->sup_id</td>
                                                                    <td>$item->sup_firstname</td>
                                                                    <td>$item->sup_nic</td>
                                                                    <td>$item->sup_mob1</td>
                                                                    <td>$item->sup_city</td>
                                                                    <td>$item->sup_mail</td>
                                                                  
                                                                    
                                                                   <td style='white-space: nowrap, width: 1%;'>
                                                                        <div class='tabledit-toolbar btn-toolbar' style='text-align: left;'>
                                                                            <div class='btn-group btn-group-sm' style='float: none;'>
                                                                             <button type='button'; class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button>
                                                                                <button type='button'  onclick='delu($item->sup_id)' class='tabledit-delete-button btn btn-danger waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button>
                                                                                <button type='button' class='tabledit-delete-button btn btn-success waves-effect waves-light' style='float: none;margin: 5px;' ><span class='zmdi zmdi-eye'></span></button>
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
                                                                <th>City</th>
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
<script> 
            function delu(d){
			if(confirm("u want to delete"+""+d))
			{
				window.location.href="managesup.php?did="+d;
			}
			}
			</script>

<?php
include_once ("../files/bottom_dt.php");
?>