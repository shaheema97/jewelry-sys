<?php

   include_once ("../workshop/workshop.php");
   $workshop2=new workshop();
   $res_ws=$workshop2->getall_workshop();

//    if(($_SESSION["user"]["usertype"])==3){
//     include_once ("../files/top_craft.php");
//    }else{

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
<div class="row"> <!--start 1 -->
            <div class="col-sm-12">
                <div class="class-header">
                    <div class="d-flex flex-row-reverse">
                        <div class="p-2">
                                <a href="../workshop/order_frm.php" class="btn btn-inverse" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                Add worshop order
                                </a>
                        </div>
                        <!-- <div class="p-2">
                                <a href="../item/managecategory.php" class="btn btn-success"  data-toggle="modal" data-target="#itemnamemodal" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                Manage Category
                                </a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div> <!--end 1 -->
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
                            <label for="" class="col-form-label">Craftsman</label>
                            <select name="filter_sup" id="" class="form-control">
                            <option value="-1">Select supplier</option>
                            
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
                            <td>Craftsman</td>
                            <td>Date</td>
                            <th>Due</th>
                            <td>Staff</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody id="itembody">
                    <?php
                        foreach($res_ws as $item){
                            echo"
                            <tr>
                            <td>$item->workshop_id</td>
                            <td>".$item->craftsman->st_firstname."</td>
                            <td>$item->workshop_date</td>
                            <td>$item->workshop_duedt</td>
                            <td>".$item->staff->st_firstname."</td>
                            <td id='statustd'>$item->workshop_workstatus</td>
                            <td><div class='btn-group btn-group-sm' style='float: none;'>
                            <a href='../workshop/orderedit.php?edit=$item->workshop_id' class='tabledit-edit-button btn btn-primary waves-effect waves-light' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></a >
                               
                               <button type='button' data-toggle='modal' data-target='#small-Modal' onclick=status($item->workshop_id,\"$item->workshop_workstatus\") class='tabledit-delete-button btn btn-inverse waves-effect waves-light' style='float: none;margin: 5px;'>Status</button>
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
<!-- modal status   -->
<div class="modal fade" id="small-Modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal title</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
                    </div>
                    <div class="modal-body">
                        <form action="../workshop/edit_status.php" method="POST" id="savestatus">
                            <div class="form-group">
                            <input type="text" name="ws_id" id="wsid">  
                            <select id="statusname" class="form-control" name="status">
                                        <option value=""></option>
                                        <option value="NEW">NEW</option>
                                        <option value="ONGOING">ONGOING</option>
                                        <option value="PAUSED">PAUSED</option>
                                        <option value="DISCARDED">DISCARDED</option>
                                        <option value="COMPLETED">COMPLETED</option>
                                        
                                    </select>
                            </div>

                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div>

<?php

include_once ("../files/bottom_dt.php");

?>

<script>

    function status(id,status){
        console.log(status);
        $("#wsid").val(id);
        $("#statusname").val(status);
        
        

    }

    $("#savestatus").on("submit",function(e){
                
                e.preventDefault();
                var cusfrm = $("#savestatus"); // Modal Id
                    status_name=$("#statusname").val();
                    console.log(status_name);
                $.post("../workshop/edit_status.php", cusfrm.serialize(), function(res) {

                     //alert(v);
                    $("#small-Modal").modal('hide'); // hide after submited
                   //$("#itembody td").eq(6).html(status_name);
                });

                        
            }); 


    
</script>
