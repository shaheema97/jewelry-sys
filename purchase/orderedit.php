<?php

include_once ("../purchase/purchaseorder.php");
$purch4=new purchaseorder();
include_once ("../purchase/purchaseorderitem.php");
$purchitem=new purchaseorderitem();

include_once ("../item/itemname.php");
$itemname3=new itemname();

if(isset($_POST['uid'])){
    //update function
 $purchitem->update_purchitem($_POST['uid']);

   
}
else{

$res_item=$itemname3->getall_itemname();

$res_purch=$purch4->get_all_purch_byorderid($_GET['edit']);

$res_purch_item=$purchitem-> getall_purchitem_byorderid($_GET['edit']);
}

//update order item details
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
    <!--start top button-->
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
                
            </div>
        </div>
    </div>
    <!--end top button -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-block">
                        <form action="orderedit.php" method="POST">
                            <!-- top card  -->
                            <div class="form-group row">
                           
                           <div class="col-sm-4">
                               
                               <label class="col-form-label" >Supplier</label>
                               <input type="text" class="form-control" readonly="" value="<?=$res_purch->supp_name->sup_firstname ?>">
                            </div>  
                           
                           <div class="col-sm-4">
                               <label class="col-form-label">Recieved By</label>
                               <input type="text" name="salesid" class="form-control" readonly="" value=" <?=$res_purch->emp_name->st_firstname?>">
                           </div>
                           <div class="col-sm-4">
                               <label class="col-form-label" >Order ID</label>
                               <input type="text" class="form-control form-control-primary " readonly=""  value="<?=$res_purch->purchorder_id ?>"  required >
                           </div>

                           
                       </div>
                       <div class="for-group row">
                       <div class="col-sm-4">
                               <label class="col-form-label" >Order Date</label>
                               <input type="date" class="form-control form-control-primary " readonly=""  value="<?=$res_purch->purchorder_date ?>" name="" required >
                           </div>
                            

                       </div>
                            <!-- top card -->
                            <!-- order item table  -->
                            
                            <div class="table-responsive">
                                <table class="table table-styling table-hover table-striped">
                                    <thead>
                                        <tr class="table-primary">
                                            <th>Category</th>
                                            <th>Item</th>
                                            <th>Size</th>
                                            <th>Unit</th>
                                            <th>Purity</th>
                                            <th>Weight</th>
                                            <th>Quantity</th>
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
 <?php
                                       foreach($res_purch_item as $item){
                                           echo"
                                         <tr> 
                                        <td>$item->purchorderitem_cat</td>
                                        <td> <select id='' class='form-control' name='p_itemname[]' style='witdh:150px'>";
                                        foreach ($res_item as $item1){
                                            if($item1->itemname_id==$item->purchorderitem_item)
                             
                             echo "<option value='$item1->itemname_id'  selected='selected'>$item1->item_name</option>	";
                             else
                             echo "<option value='$item1->itemname_id'>$item1->item_name</option>	";
                         }
                                      echo"</select></td>  <td><input class='form-control' value='$item->purchorderitem_size' name='p_itemsize[]'></td>
                                        <td>$item->purchorderitem_unit</td>
                                        <td>$item->purchorderitem_purity</td>
                                        <td>
                                        <select id='' class='form-control' name='p_itempurity'>$item->purchorderitem_purity
                                        <option value=''></option>
                                        <option name='' value='18' if( $item->purchorderitem_purity=='18') selected='selected'  >18</option>
                                        <option name='' value='19' if( $item->purchorderitem_purity=='19') selected='selected' >19</option>
                                        <option name='' value='20' if( $item->purchorderitem_purity=='20')  selected='selected'  >20</option>
                                        <option name='' value='21' if( $item->purchorderitem_purity=='21') selected='selected'  >21</option>
                                         <option name='' value='22' if( $item->purchorderitem_purity=='22') selected='selected' >22</option>
                                        
                                        
                                    </select></td>
                                        <td><input class='form-control' value='$item->purchorderitem_weight' name='p_itemweight[]'></td>
                                       
                                        <td><input class='form-control' value='$item->purchorderitem_qty' name='p_itemqty[]'></td>
                                        
                                        <td></td>
                                        </tr>";
                                       }
                                       ?>

                                       <?php
                                        if(isset($_GET["edit"])){
                                            echo"  <input type='text'  class='form-control' value='".$_GET['edit'] ."' name='uid' required>";
                                           }
                                       ?>
                                       
                                    </tbody>
                                </table>

                            </div>
                            <div class="d-flex flex-row-reverse">
                                <div class="p-2">
                                        <button type="submit" class="btn btn-success" style="float: right;">
                                        <i class="icofont icofont-plus"></i>
                                       Edit Order
                                        </button>
                                </div>
                                <div class="p-2">
                                        <button type="reset" class="btn btn-danger" style="float: right;">
                                        <i class="icofont icofont-ui-close"></i>
                                        Cancel
                                        </button>
                                </div>
                            </div>
                           
                            <!-- order item table -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</div>

<?php
include_once ("../files/bottom.php");
?>