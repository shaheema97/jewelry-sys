<?php
//category form
include_once ("../item/category.php");
$cat3=new category();
$result_cat =$cat3->get_all_cat();

include_once ("../item/item.php");
$item7=new item();
$result_item=$item7->get_all_item();


include_once ("../files/top.php");
?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
        <div class="card-block success-breadcrumb">
            <div class="breadcrumb-header">
                <strong>Buy Gold</strong>
                <br>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#!">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    
                    <li class="breadcrumb-item"><a href="#!">Buy Gold</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!-- Success-color Breadcrumb card end -->

<div class="page-body">
    <!-- top buttons-->
    <div class="row"> 
        <div class="col-sm-12">
            <div class="">
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                            <a href="form2.php" class="btn btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            Manage Sales
                            </a>
                    </div>
                    <!-- <div class="p-2">
                            <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#default-Modal" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            
                            </button>
                    </div> -->
                </div>
            </div>
        </div>
    </div> 
    <!-- top buttons -->
    <!--card start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
        
                </div>
                <div class="card-block">
                    <form action="buygold.php" method="POST">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                
                                <label class="col-form-label" >Customer</label>
                                <div class="input-group">
                                <select id="" class="form-control form-control-primary" name="salescu">
                                        <!-- <?php foreach($rc as $item) {
                                            echo"<option value='$item->cust_id'>$item->cust_first_nm</option>";
                                        }?> -->
                                </select>
                                    <a href="../customer.form2.php" class="btn btn-primary btn-icon btn-sm"><i class="icofont icofont-plus"></i></a>
                                </div>
                            </div>  
                            <div class="col-sm-4">
                                <label class="col-form-label" >Sales Date</label>
                                <input type="date" class="form-control form-control-primary " name="salesdt" >
                            </div>
                            
                            <div class="col-sm-4">
                                <label class="col-form-label">Recieved By</label>
                                <select id="" class="form-control form-control-primary" name="salesemp">
                                <!-- <?php foreach ($r as $item){
            
                                            echo "<option value='$item->st_id'>$item->st_firstname</option>	";
                                        }?> -->

                                </select>   
                            </div>
                        </div>
                        <!--item info start -->
                        <div class="card-block bg-primary ">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label" >Category</label>
                                    <select name="" id="itemcat" class="form-control form-control-sm">
                                        <option value="">Select Category</option>
                                        <?php foreach($result_cat as $item) {
                                             echo"<option value='$item->cat_id'>$item->cat_name</option>";
                                        }?>
                                                        
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label" >Item</label>
                                    <select name="" id="itemname" class="form-control form-control-sm">
                                        <option value="-1" selected='selected'>Select Item</option>
                                        <!-- <?php foreach($result_item as $item) {
                                             echo"<option value='$item->item_id'>$item->item_name</option>";
                                        }?> -->
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label ">Purity(Karat)</label>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="">Select Purity</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label ">Quantity</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label " >Item weight(in gram)</label>
                                        <input type="text" class="form-control form-control-sm">
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label" >Gross Weight(in gram)</label>
                                    <input type="text" class="form-control form-control-sm">
                                </div>
                                <div class="col-sm-3">
                                <label for="" class="col-form-label" >Discount</label>
                                    <select name="" id="" value="0" class="form-control form-control-sm">
                                        <option value="">Select Discount</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for=""></label><br>
                                    <div class="d-flex flex-row-reverse">
                                    <div class="p-2">
                                        <button type="button" class="btn btn-success m-r-10 m-b-5" id="btnadd"  >
                                        <i class="icofont icofont-plus"></i>
                                        Add 
                                        </button>
                                    </div>
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <!--item info end-->
                        <!--dynamic table-->
                        <table id="" class="table table-responsive " style="border:none;">
                            <thead>
                                <tr>
                                    <th>Item id</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Karat</th>
                                    <th>Quantity</th>
                                    <th>Gross Weight</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                    <hr style="color:#000001;">
                                </tr>
                            </thead>
                            <tbody id="itembody">

                            </tbody>
                        </table>
                        <!--dynamic table-->
                        <!-- final values-->
                        <table class="table table-responsive invoice-table invoice-total">
                            <tbody>
                                <tr>
                                    <th>Sub Total :</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Sub Total :</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Taxes () :</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Discount () :</th>
                                    <td></td>
                                </tr>
                                <tr class="text-info">
                                    <td>
                                        <hr>
                                        <h5 class="text-primary">Total :</h5>
                                    </td>
                                    <td>
                                        <hr>
                                        <h5 class="text-primary">$4827.00</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--final values -->
                        <!--button-->
                        <div class="d-flex flex-row-reverse">
                        <div class="p-2">
                                <a href="form2.php" class="btn btn-success" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                 Submit Invoice
                                </a>
                        </div>
                        <div class="p-2">
                                <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#default-Modal" style="float: right;">
                                <i class="icofont icofont-ui-close"></i>
                                Cancel
                                </button>
                        </div>
                    </div>
                        
                        <!-- button-->
                    </form>
                </div>
            </div>
        
        </div>
    
    </div>

    <!--card end-->


</div><!--/pagebody -->


<?php

include_once ("../files/bottom.php");
?>

<script>
$("#itemcat").change(function(){
    var cat_id=$("#itemcat").val();
    console.log(cat_id);
    $.get("../files/ajax.php?type=get_cat",{catid:cat_id},function(data){
        console.log(data);
        $("#itemname").html("");

			var d = JSON.parse(data);


        $.each(d,function(i,x){
            $("#itemname").append("<option value='"+d[x].item_id+"'>"+d[x].item_name+"</option>");
        });
    });


});

</script>