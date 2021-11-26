<?php

//session_start();
include_once ("../item/category.php");
$cat3=new category();
$result_cat =$cat3->get_all_cat();

include_once ("../item/item.php");

$item8=new item();

$item_order=$item8->get_all_item_typeorder();
//exit;
include_once ("../staff/staff.php");

    $staff6=new staff();
    $result_emp=$staff6->get_all();

include_once ("../stock/stock.php");
$stock_sale=new stock();

include_once ("../customer/cust.php");
$cust6=new cust();
$result_cus=$cust6->get_all_cus();



$error_msg="";

include_once ("sales.php");
$sales2=new sales();

include_once ("../customer/account.php");
$cus_account=new account();

include_once ("salesitem.php");
$s_item=new salesitem();
if(isset($_POST["salescus"])){
    $sales2->sales_cus=$_POST["salescus"];
    $sales2->sales_emp=$_POST["salesemp"];
    $sales2->sales_date=$_POST["salesdt"];
    $sales2->sales_qty=$_POST["totqty"];
    $sales2->sales_subtot=$_POST["subtot"];
    $sales2->sales_totdisc=$_POST["totdisc"];
    $sales2->sales_nettot=$_POST["nettot"];
    $cus_account->account_cusid=$_POST["salescus"];
    $cus_account->account_debit=$_POST["nettot"];


    $saleitemid=$sales2->insert_sales();
    $s_item->insert_saleitems($saleitemid);
    $stock_sale-> insertstock_minus($saleitemid);
    $cus_account->insert_debitamount(); 
    // $_SESSION["sales"]=$_POST;
    // $_SESSION["salesid"]=$saleitemid;
    // $_SESSION["status"]="Added a new sales successfully";
    // $_SESSION["status_code"]="success";
   
   
    header("location:salespay.php?did=yes&view2=".$saleitemid);
 


}


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
                <div class="d-flex ">
                    <div class="mr-auto p-2">
                            <a href="../sales/managesales.php" class="btn btn-sm btn-inverse" style="float: right;">
                            <i class="fa fa-angle-double-left"></i>
                            Back
                            </a>
                    </div>
                    <!-- <div class="p-2">
                            <a href="form2.php" class="btn btn-sm btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            Manage Sales
                            </a>
                    </div> -->
                    <div class="p-2">
                            <button type="button" class="btn btn-sm btn-success"  data-toggle="modal" data-target="#default-Modal" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            OrderItem
                            </button>


                    </div>
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
                    <form action="buygold2.php" method="POST">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                
                                <label class="col-form-label" >Customer</label>
                                <div class="input-group">
                                <select id="cust_list" class="form-control form-control-primary" name="salescus" required>
                                        <?php foreach($result_cus as $item) {
                                            echo"<option value='$item->cust_id'>$item->cust_first_nm</option>";
                                        }?>
                                </select>
                                       
                                    <button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#customer_modal"><i class="icofont icofont-plus"></i></button>
                                </div>
                            </div>  
                            <div class="col-sm-4">
                                <label class="col-form-label" >Sales Date</label>
                                <input type="date" class="form-control form-control-primary" value='<?php echo date('Y-m-d');?>' name="salesdt" required >
                            </div>
                            
                            <div class="col-sm-4">
                                <label class="col-form-label">Recieved By</label>
                                <select id="" class="form-control form-control-primary" name="salesemp" required>
                                <?php foreach ($result_emp as $item){
            
                                            echo "<option value='$item->st_id'>$item->st_firstname</option>	";
                                        }?>

                                </select>   
                            </div>
                        
                        </div>

                        <!--item info start -->
                        <div class="card-block bg-primary ">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label" >Category</label>&nbsp<button type="button"class="btn btn-mini btn-danger" data-toggle="modal" data-target="#category-Modal">New Category</button>
                                    <select name="" id="buyitemcat" class="form-control form-control-sm">
                                        <option value="">Select Category</option>
                                        <?php foreach($result_cat as $item) {
                                             echo"<option value='$item->cat_id'>$item->cat_name</option>";
                                        }?>
                                                        
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label" >Item Name</label>&nbsp<button type="button"class="btn btn-mini btn-danger" data-toggle="modal" data-target="#category">New Category</button>
                                    <select name="" id="buyitemname" class="form-control form-control-sm">
                                        <option value="-1" selected='selected'>Select Item Name</option>
                                        
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label for="" class="col-form-label" >Item</label>
                                    <select name="" id="buyitem" class="form-control form-control-sm">
                                        <option value="-1" selected='selected'>Select Item</option>
                                        
                                    </select>
                                </div>
                                
                                <div class="col-sm-1">
                                    <label for="" class="col-form-label ">Quantity</label>
                                    <input type="number" id="quantity" class="form-control form-control-sm" placeholder="0">
                                </div>
                                <div class="col-sm-2">
                                <label for="" class="col-form-label" >Discount(%)</label>
                                        <input type="text" class="form-control form-control-sm " id="itemdiscount">
                                    <!-- <select name="" id="itemdiscount" class="form-control form-control-sm">
                                        <option value="0">Select Discount</option>
                                        <option value="10">10%</option>
                                        <option value="15">15%</option>
                                    </select> -->
                                </div>
                                <div class="col-sm-1">
                                    <label for=""></label><br>
                                    <div class="d-flex flex-row-reverse">
                                        <div class="p-2">
                                            <button type="button" id="addsalerow" class="btn btn-success btn-sm"   >
                                            <i class="icofont icofont-plus"></i>
                                            Add 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                            <div class="col-sm-12a">
                            <table id="itemtable" class="table table-responsive " style="border:none;" >
                            <tr>
                                <th>Item id:</th>
                                <td id="itemid"></td>
                                <th >Item weight :</th>
                                <td id="itemweight"></td>
                                <th>Stone Weight :</th>
                                <td id="itemstoneweight"></td>
                                <th>Nettweight :</th>
                                <td id="itemnettweight"></td>
                                <th>Wastage</th>
                                <td id="itemwastage"></td>
                                

                            </tr>
                            <tr>
                                <th>Available</th>
                                <td id="quan"></td>
                                <th>Labour fee</th>
                                <td id="labourfee"></td>
                                <th>Stone fee</th>
                                <td id="stonefee">NOT DONE</td>
                                <th>Cost price</th>
                                <td id="costprice"></td>
                                <th>Selling Price</th>
                                <td id="sellprice">NOT DONE</td>
                                
                            </tr>
                            
                            </table>
                            </div>   
                               
                            </div> 
                        </div>

                        <!--item info end-->
                        <!--dynamic table-->
                        <table id="" class="table table-responsive table-bordered table-condensed " >
                            <thead>
                                <tr>
                                    <th>Item id</th>
                                
                                    <th>Item</th>
                                    <th>Size</th>
                                    <th>Karat</th>
                                    <th>G/Weight</th>
                                    <th>Qty</th>
                                    <th>Cost</th>
                                    <th>Discount</th>
                                    <!-- <th>Disc</th> -->
                                    <th>Final/Price</th>
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
                                    <th> Total Quantity :</th>
                                    <td ><input type="text" readonly id="total_quan" name="totqty" class="form-control form-control-primary form-control-sm" ></td>
                                </tr>
                                <tr>
                                    <th>Sub Total :</th>
                                    <td ><input type="text" readonly id="sub_total" name="subtot" class="form-control form-control-primary form-control-sm" ></td>
                                </tr>
                               
                                <tr>
                                    <th>Discount  :</th>
                                    <td ><input type="text" readonly id="dis_total" name="totdisc" class="form-control form-control-primary form-control-sm"></td>
                                </tr>
                                <tr class="text-info">
                                    <td>
                                        <hr>
                                        <h5 class="text-primary">Total :</h5>
                                    </td>
                                    <td>
                                        <hr>
                                        <h5 class="text-primary"><input type="text" readonly id="net_total" name="nettot" class="form-control form-control-primary form-control-sm" ></h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--final values -->
                        <!--button-->
                        <div class="d-flex flex-row-reverse">
                        <div class="p-2">
                                <button type="submit" class="btn btn-success" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                 Submit Invoice
                                </button>
                        </div>
                        <div class="p-2">
                                <button type="reset" class="btn btn-danger" style="float: right;">
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

    <!-- customer modal -->
    <div class="modal fade" id="customer_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Customer Registration</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5></h5>
                    <form action="order_frm.php" method="POST" id="savecus">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6"><label for="" class="col-form-label">First Name</label><input type="text" name="firstnm" id="custname" class="form-control"></div>
                            <div class="col-sm-6"><label for="" class="col-form-label">Last Name</label><input type="text" name="lastnm" class="form-control"></div>
                        </div>
                        <div class="row">
                                        <div class="col-sm-6">
                                        <label for="" class="col-form-label">NIC</label>
                                        <input type="text" class="form-control" name="nic" pattern="[0-9]{9}V" required>
                                        
                                        </div>
                                        <div class="col-sm-6">
                                        <label for="" class="col-form-label">Gender</label><br>
                                        <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="gen" value="Male" required>
                                            Male
                                        </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="gen" value="Female" required>
                                            
                                            Female
                                        </label>
                                    </div>
                                        
                                        </div>
                        </div>
                        
                        <div class="row">
                                <div class="col-sm-6"><label for="" class="col-form-label">Date of Birthe</label><input type="date" name="dob" class="form-control"></div>
                                <div class="col-sm-6"><label for="" class="col-form-label">Mobile Number 2</label><input type="text" name="mob1"data-mask="999-999-9999" class="form-control mob_no"></div>
                        </div>
                        
                        <label for="" class="col-form-label">email</label>
                        <input type="text" class="form-control" id="cus-mail" name="mail" onblur="checkmail()"  >
                                <div class="col-form-label" id="mailcheck" style="display:none;">Sorry, that email taken. Try
                                                            another?
                                </div>
                                <label for="" class="col-form-label">Address</label>
                        <textarea name="add" id="" class="form-control" cols="5" rows="5"></textarea>
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
    <!-- modal customer end -->

    <!-- modal order start -->
    <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="dt-responsive table-responsive">
                    <table id="basic-btn" class="table table-striped table-bordered nowrap">
                        <thead>
                     
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Itemid</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Action</th>
                            
                        </thead>
                        <tbody>
                        <?php   
                        foreach($item_order as $item){
                        echo"<tr>
                                <td>$item->item_type_id</td>
                               <td>".$item->ordercus->order_cus_name->cust_first_nm."</td>
                                <td>$item->item_id</td>
                                <td>$item->name_item</td>
                            
                            
                                <td>$item->item_price</td>
                                    <td>
                                    <div class='btn-group btn-group-sm' style='float: none;'>
                                        <button onclick='addorders($item->item_type_id,\"$item->item_id\",\"$item->item_cat\",\"$item->item_name\",\"$item->item_purity\",\"$item->item_size\",\"$item->item_grosswt\",\"$item->item_price\",\" $item->item_quan\",this)' class='tabledit-edit-button btn btn-primary waves-effect waves-light add' style='float: none;margin: 5px;'><span class='icofont icofont-plus'></span></button><button type='button' id=''  class='tabledit-edit-button btn-mini btn-danger waves-effect waves-light delete' onclick='' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button >
                                        
                                    </div>
                                    </td>
                            
                            </tr>";

                        }
                        ?>   
                        </tbody>     

                            
                        
                    
                    </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal order end -->

    <!-- category modal  -->
    <div class="modal fade" id="category" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5></h5>
                    <form action="itemadd.php" method="POST" id="savecat" enctype="multipart/form-data">
                        <div class=" col-sm-10 form-group row">
                        <label for="" class="col-form-label">Category</label>
                        <input type="text"  id="cat_name" class="form-control" placeholder="Create new category" name="cat">
                        <label for="" class="col-form-label">Image</label>
                            <input type="file" class="form-control" placeholder="" name="uimg">
                            
                        
                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    <!-- item name modal  -->
    


</div><!--/pagebody -->


<?php

include_once ("../files/bottom_dt.php");
?>

<script>

//function to filter item name according to chosen category-----------
$("#buyitemcat").change(function(){
    var cat_id=$("#buyitemcat").val();
    console.log(cat_id);
    $.get("../files/ajax.php?type=get_itemname_bycat",{cat:cat_id},function(data){
        console.log(data);
        $("#buyitemname").html("");

			var d = JSON.parse(data);

            $.each(d,function(i,x) {
                console.log(i);
            console.log(x);
            $("#buyitemname").append("<option value='"+d[i].itemname_id+"'>"+d[i].item_name+"</option>");
            })


     
        });
    });
//---------------------------------------------------
//function to select item according to item name
$("#buyitemname").change(function(){
    var itemname_id=$("#buyitemname").val();
    console.log(itemname_id);
    $.get("../files/ajax.php?type=get_item_by_name",{item_id:itemname_id},function(data){
        console.log(data);
        $("#buyitem").html("");

			var d = JSON.parse(data);

            $.each(d,function(i,x) {
                console.log(i);
            console.log(x);
            $("#buyitem").append("<option value='"+d[i].item_id+"'>"+d[i].item_purity+","+d[i].item_size+"</option>");
            })

            //name=i_data.itemname;
     
        });
    });

    $("#buyitem").change(function(){
        console.log("hii");
        var item_id_qty= $("#buyitem").val();
        console.log(item_id_qty);

        $.get("../files/ajax.php?type=get_stock",{itemid_qty:item_id_qty},function(data){
        console.log(data);
       

			var d = JSON.parse(data);
            console.log("qty is");
            console.log(d.tot);

            $("#quan").attribute(max==d.tot);
            

            
     
        });


    });


    $("#itemtable").hide();

    $("#buyitem").change(function(){

        $("#itemtable").show();

    var item_id=$("#buyitem").val();
    console.log(item_id);
    $.get("../files/ajax.php?type=get_item",{itemid:item_id},function(data){
        console.log(data);
        var i_data = JSON.parse(data);

        $("#itemid").html(i_data.item_id);
        $("#itemweight").html(i_data.item_purity);
        $("#itemstoneweight").html(i_data.item_stonewt);
        $("#itemnettweight").html(i_data.item_nettwt);
        $("#itemwastage").html(i_data.item_waste);
        $("#quan").html(i_data.item_quan);
        $("#labourfee").html(i_data.item_labfee);
        // $("#stonefee").html(i_data.);
        $("#costprice").html(i_data.item_price);
        // $("#sellprice").html(i_data.);

        grossweight=i_data.item_grosswt;
        purity=i_data.item_grosswt;
        size=i_data.item_size;
        name=i_data.name_item;
       console.log(size);
       console.log(purity);
       console.log(name);
       console.log(grossweigt);
       
    });

});
$(".delete").hide();

function addorders(orderid,itemid,itemcat,itemname,itempurity,itemsize,itemgwt,price,qty,n1){
    console.log(price);
    console.log(qty);
    finalprice=parseFloat(price)*parseFloat(qty);  
    type='sales';
    $("#itembody").append("<tr><td><input type='hidden' value='"+itemid+"' name='itm_name[]' >"+itemid+"</td><td><input type='hidden' value='"+itemname+"' name='' >"+itemname+"</td><input type='hidden' value='"+orderid+"' name='order[]' ><input type='hidden' value='"+type+"' name='proc_type[]' ><td><input type='hidden' value='"+itemsize+"' name='' >"+itemsize+"</td><td><input type='hidden' value='"+itempurity+"' name='' >"+itempurity+"K</td><td><input type='hidden' value='"+itemgwt+"' name='' >"+itemgwt+"g</td><td><input type='hidden' value='"+qty+"' name='itm_quan[]' >"+qty+"</td><td><input type='hidden' value='"+price+"' class='' name='b_cprice[]' >Rs."+price+"</td><td></td><td><input type='hidden' value='"+finalprice+"' class='sel_price' name='b_sprice[]' >Rs."+finalprice+"</td><td><td><button type='button'  onclick='delete_row(this)' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td><tr>");

    $(n1).parent().find(".add").hide();
      
    $(n1).parent().find(".delete").show();
 y=n1;
}


$("#addsalerow").click(function(){

    $("#itemtable").hide();
     addrows();
     clear();
     cal_totquantity();
     cal_subtotal();
     cal_total_discount();
     cal_finalprice();
     
     
});

function addrows(){
    if($("#quantity").val()==''){
            alert("Please fill quantity")
        }else{
    id=$("#itemid").html();
    name;
    size;
    purity;
    grossweight;
    quan=$("#quantity").val();
    discount=$("#itemdiscount").val();
    c_price=$("#costprice").html();
    price=(parseFloat(c_price)*parseFloat(quan)).toFixed(2);
    if($("#itemdiscount").val()==''){
        dis_price=0.00;
        s_price=(parseFloat(price)-parseFloat(dis_price)).toFixed(2);
    }else{
    dis_price= (parseFloat(price)* parseFloat(discount)/100).toFixed(2);
    s_price=(parseFloat(price)-parseFloat(dis_price)).toFixed(2);}
    proctype="sales";
       
    
    $("#itembody").append("<tr><td><input type='hidden' value='"+id+"' name='itm_name[]' >"+id+"</td><input type='hidden' value='"+proctype+"' name='proc_type[]' ><td><input type='hidden' value='"+name+"' name='' >"+name+"</td><td><input type='hidden' value='"+size+"' name='' >"+size+"</td><td><input type='hidden' value='"+purity+"' name='' >"+purity+"K</td><td><input type='hidden' value='"+grossweight+"' name='' >"+grossweight+"g</td><td><input type='hidden' value='"+quan+"' class='quantity' name='itm_quan[]' >"+quan+"</td><td><input type='hidden' value='"+price+"' name='b_cprice[]' >"+price+"</td><td><input type='hidden' value='"+discount+"' name='' >"+discount+"</td><td><input type='hidden' class='discount' value='"+dis_price+"' name='b_itemdisc[]' >Rs."+dis_price+"</td><td><input type='hidden' value='"+s_price+"' class='sel_price' name='b_sprice[]' >Rs."+s_price+"</td><td><button type='button'  onclick='delete_row(this)' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td><tr>");
        }


}

function clear(){
    $("#buyitemcat").val("");
    $("#buyitemname").val("");
    $("#buyitem").val("");
    $("#quantity").val("");
    $("#itemdiscount").val("");
    

}

function delete_row(x){
        $(x).parent().parent().remove();
        //first parent->tr
        //second parent->td
        cal_totquantity();
     cal_subtotal();
     cal_total_discount();
     cal_finalprice();
     $(y).parent().find(".add").show();
      
      $(y).parent().find(".delete").hide();
     

    }

function cal_totquantity(){
    tot_quan=0;

    var quan=$(".quantity");
    $.each(quan,function(i,item){
        tot_quan=tot_quan+ parseInt($(quan[i]).val());
    })
    $("#total_quan").val(tot_quan)
}



function cal_subtotal(){
    subtot=0;
    var tot=$(".sel_price");
    $.each(tot,function(i,item){
        subtot=subtot+ parseFloat($(tot[i]).val());

    })
    $("#sub_total").val(subtot);
}

function cal_total_discount(){
    dis_tot=0;
    var tot=$(".discount");
    $.each(tot,function(i,item){
        dis_tot=dis_tot+ parseFloat($(tot[i]).val());

    })
    $("#dis_total").val(dis_tot);

}

function cal_finalprice(){

 nettprice=subtot-dis_tot;
 console.log(nettprice);

 $("#net_total").val(nettprice);

// function to add customers
$("#savecus").on("submit",function(e){
                
                e.preventDefault();
                var cusfrm = $("#savecus"); // Modal Id
                    cust_name=$("#custname").val();
                $.post("../customer/customerhandle.php", cusfrm.serialize(), function(res) {

                     //alert(v);
                    $("#customer_modal").modal('hide'); // hide after submited
                   $("#cust_list").append("<option value='+res+' >"+cust_name+"</option>");
                });

                        
            });
            //email validation
function checkmail(){
    let x=$("#cus-mail").val();
    //alert(x);
    $.get("../customer/ajax.php?type=check_cusmail&ee="+x, "" ,function(data){
        //alert(data);
        var tmp=JSON.parse(data);
        if(tmp.cust_id>0){
            $("#mailcheck").show();}
        
       
        }
    );
}

//function to add category
$("#savecat").on("submit",function(e){
                
                e.preventDefault();
                var catfrm = $("#savecat"); // Modal Id
                    catname=$("#cat_name").val();
                $.post("../item/categoryhandle.php", catfrm.serialize(), function(res) {

                     //alert(v);
                    $("#category-Modal").modal('hide'); // hide after submited
                   $("#orderitemcat ").append("<option value='+res+' >"+catname+"</option>");
                });

                        
            });

//function to add itemname
$("#saveitemame").on("submit",function(e){
                
                e.preventDefault();
                var itemfrm = $("#saveitemame"); // Modal Id
                    itemname=$("#item_name").val();
                $.post("../item/itemnamehandle.php", itemfrm.serialize(), function(res) {

                     //alert(v);
                    $("#item-Modal").modal('hide'); // hide after submited
                   $("#orderitemname ").append("<option value='+res+' >"+itemname+"</option>");
                });

                        
            });

}

function check_quan(){
    itemqty=$("#itemqty").html();
    num=$("#num").val();
    console.log(itemqty);
    console.log(num);
    $("#namecheck1").hide();
    if(num> itemqty){
        $("#namecheck1").show();
        console.log("Improper qty")
    }
}


</script>