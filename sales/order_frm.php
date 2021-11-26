 <?php
include_once ("../item/category.php");
$cat3=new category();
$result_cat =$cat3->get_all_cat();

include_once ("../item/item.php");
$item7=new item();
$result_item=$item7->get_all_item();

include_once ("order.php");
$order1=new order();

include_once ("orderitem.php");
$o_item=new orderitem();

include_once ("../customer/cust.php");
$cust_order=new cust();
$result_cus=$cust_order->get_all_cus();

include_once ("../staff/staff.php");
$staff_order=new staff();
$result_emp=$staff_order->get_all();

include_once ("../goldrate/rate.php");
    $r1=new rate();
    $result=$r1->get_today_rate();
    




if(isset($_POST["ordercus"])){
    $order1->order_cus=$_POST["ordercus"];
    $order1->order_emp=$_POST["orderemp"];
    $order1->order_date=$_POST["orderdate"];
    $order1->order_duedate=$_POST["orderduedate"];
    $order1->order_goldrate=$_POST["ordergoldrate"];
   
       
    $itemid=$order1->insert_order();
    $o_item->insert_orderitem($itemid);
    echo '<script>
        setTimeout(function() {
            swal({
                title: "New order added!",
                text: "Order info is added!",
                type: "success"
            }, function() {
                window.location = "../sales/order_frm.php.";
            });
            }, 1000);
            </script>';

//exit;

}



include_once ("../files/top.php");

?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
        <div class="card-block success-breadcrumb">
            <div class="breadcrumb-header">
                <strong>Sales Order</strong>
                <br>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#!">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    
                    <li class="breadcrumb-item"><a href="#!">Sales Order</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!-- Success-color Breadcrumb card end -->

<div class="page-body">
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
<!--card start -->
<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
        
                </div>
                <div class="card-block">
                    <form action="order_frm.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                           
                            <div class="col-sm-3">
                                
                                <label class="col-form-label" >Customer</label>
                                <div class="input-group">
                                <select id="cust_list" class="form-control form-control-primary " name="ordercus" required>
                                    <option value="">Select customer</option>
                                <?php foreach($result_cus as $item) {
                                
                                        echo"<option value='$item->cust_id' selected='$selected'>$item->cust_first_nm</option>";
                                    }?>

                                            
                                </select>
                                <a href="../customer/form2.php" class="btn btn-primary btn-icon btn-sm" ><i class="icofont icofont-plus"></i></a>
                                </div>
                            </div>  
                            
                            <div class="col-sm-3">
                                <label class="col-form-label">Recieved By</label>
                                <select id="" class="form-control form-control-primary " name="orderemp" required>
                                    <option value="">Select Staff</option>
                                <?php foreach ($result_emp as $item){
            
                                            echo "<option value='$item->st_id'>$item->st_firstname</option>	";
                                        }?>

                                </select>   
                            </div>
                            <div class="col-sm-3">
                                <label class="col-form-label" >Order Date</label>
                                <input type="date" class="form-control form-control-primary " value="<?php echo date('Y-m-d');?>" name="orderdate" required >
                            </div>

                            <div class="col-sm-3">
                                <label class="col-form-label" > Due Date</label>
                                <input type="date" class="form-control form-control-primary " value="<?=$order1->order_duedate ?>" name="orderduedate" required >
                            </div>
                        </div>
                <!-- ..................................... -->
                            <input type="hidden" class="form-control" value="<?=$result->rate_gram?>" name="ordergoldrate">
                     <!-- ...................................... -->
                        <!--item info start -->
                        <div class="card-block bg-primary ">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label" >Category</label>
                                   
                                                
                                    <select name="" id="catlist" class="form-control form-control-sm orderitemcat">
                                        <option value="">Select Category</option>
                                        <?php foreach($result_cat as $item) {
                                             echo"<option value='$item->cat_id'>$item->cat_name</option>";
                                        }?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label" >Item</label>
                                    
                                    <select name="" id="orderitemname" class="form-control form-control-sm order_item">
                                        <option value="">Select Item</option>
                                       
                                       
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label ">Purity(Karat)</label>
                                    
                                    <select name="" id="orderitempurity" class="form-control form-control-sm">
                                        <option value="">Select Purity</option>
                                        <option value="18">18</option>
                                        <option value="19" name=" ">19</option>
                                        <option value="20" name="">20</option>
                                        <option value="21" name=" ">21</option>
                                        <option value="22" name=" ">22</option>
                                        <option value="23" name=" ">23</option>
                                        <option value="24" name=" ">24</option>

                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label ">Quantity</label>
                                    <input type="number" id="orderitemquan" class="form-control form-control-sm" placeholder="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="" class="col-form-label " >Item weight(in gram)</label>
                                        <input type="text" id="orderitemweight" class="form-control form-control-sm" onkeypress="return IsNumeric(event);">
                                        <span class="error" style="color: red; display: none">* Input digits (0 - 9)</span>
                                </div>
                                <div class="col-sm-2">
                                    <label for="" class="col-form-label" >Size/Legnth</label>
                                    <input type="text" id="orderitemsize" class="form-control form-control-sm" onkeypress="return IsNumeric2(event);">
                                    <span class="error2" style="color: red; display: none">* Input digits (0 - 9)</span>
                                </div>
                                <div class="col-sm-1">
                                    <label for="" class="col-form-label">Unit</label>
                                    <select name="" id="orderitemunit" class="form-control form-control-sm">
                                        <option value="">Unit</option>
                                        <option value="mm">mm</option>
                                        <option value="cm">cm</option>
                                        <option value="inch">inch</option>
                                    </select>
                                </div>
                                
                                <!-- <div class="col-sm-3">
                                <label for="" class="col-form-label" >Image</label>
                                    <input type="file" id="orderitempic" class="form-control form-control-sm" >
                                </div> -->
                                <div class="col-sm-3">
                                    <label for=""></label><br>
                                    <div class="d-flex flex-row-reverse">
                                    <div class="p-2">
                                        <button type="button" id="orderitemadd" class="btn btn-success m-r-10 m-b-5"   >
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
                            
                        
                             
                                    
                                    <!-- <th>Category</th> -->
                                    <th>Item</th>
                                    <th>Image</th>
                                    <th>Karat</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Gross Weight</th>
                                   
                                    <th>Action</th>
                                    <hr style='color:#000001;'>
                                </tr>
                            </thead>
                            <tbody id='itembody'>
                            
                            

                            </tbody>
                        </table>
                        <!--dynamic table-->
                        <!-- final values-->
                       
                        <!--final values -->
                        <!--button-->
                        <div class="d-flex flex-row-reverse">
                        <div class="p-2">
                                <button type="submit" class="btn btn-success" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                 Submit 
                                </button>
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
    </div><!--card end-->
    
        <!-- modal for category -->

    <div class="modal fade" id="category-Modal" tabindex="-1" role="dialog">
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
        <!-- modal for item name -->
        
    <div class="modal fade" id="item-Modal" tabindex="-1" role="dialog">
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

</div>


<?php 
include_once ("../files/bottom.php");
?>

<script>

$(".orderitemcat").change(function(){

//get the id
var cat_id=$(".orderitemcat").val();
$.get("../files/ajax.php?type=get_itemname_bycat",{cat:cat_id},function(data){
    console.log(data);

 //convert json to 
 var d=JSON.parse(data);

 //remove any existing data from the item dropdown
 $("#orderitemname").html("");
 $.each(d,function(i,x){
            console.log(i);//loop number
            console.log(x);//data
            $("#orderitemname").append("<option value='"+d[i].itemname_id+"'> "+d[i].item_name+" </option>");
        });
});
 
 });

 $("select.order_item").change(function(){
        console.log("hi");
        var item_id = $(this).children("option:selected").val();
        console.log(item_id);
        $.get("../files/ajax.php?type=get_itemname_byitem",{name:item_id},function(data){
            console.log(data);
            var i_data = JSON.parse(data);
            name=i_data.itemname;
            cat=i_data.catname.cat_name;
            console.log(name);
            console.log(cat);
        });
 
    });

 $("#orderitemadd").click(function(){
       addrows();
      clear()

    });

    

    function addrows(){
        if($("#orderitemcat").val()=='' || $("#orderitemname").val()=='' || $("#orderitempurity").val()=='' || $("#orderitemquan").val()=='' || $("#orderitemweight").val()=='' || $("#orderitemsize").val()=='' ){
            alert("Please fill all the fields")
        }else{

        name;
        cat;
        
        var category=$(".orderitemcat").val();
        var itemname= $("#orderitemname").val();
        var purity=$("#orderitempurity").val();
        var quantity=$("#orderitemquan").val();
        var weight=$("#orderitemweight").val();
        
        var size=$("#orderitemsize").val();
        var unit=$("#orderitemunit").val();
        var requirement=$("#orderitemreq").val();  
  
        $("#itembody").append("<tr><input type='hidden' name='cat[]' value='"+category +"' required><td></td><td><input type='hidden' name='itemname[]' value='"+itemname +"' required>"+name +"</td><td><input type='file' name='uimg[]' value='' ></td><td><input type='hidden' name='itmpurity[]' value='"+purity +"' required>"+purity +"</td><td><input type='hidden' name='itmquan[]' value='"+quantity +"' required>"+quantity +"</td><td><input type='hidden' name='itmweight[]' value='"+weight +"' required>"+weight +"</td><td><input type='hidden' name='size[]' value='"+size+"' required>"+size +"</td><input type='hidden' name='unit[]' value='"+unit+"' required><td><button type='button'  onclick='delorder(this)' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td></tr>");
        }
        }

    function clear(){
        $("#orderitemcat").val("");
        $("#orderitemname").val("");
        $("#orderitempurity").val("");
        $("#orderitemweight").val("");
        $("#orderitemweight").val("");
        $("#orderitemsize").val("");
        $("#orderitemreq").val("");
    }

 function delorder(del){
    $(del).parent().parent().remove();
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

//FUNCTION TO VALIDATE TO ONLY INPUT NUMBERS 
function IsNumeric(e) {
            var keycode = e.which ? e.which : e.keyCode
            if (!(keycode == 8 || keycode == 46) && (keycode < 48 || keycode > 57) ) {
            $(".error").css("display", "inline");
            
            return false;
          }else{
            $(".error").css("display", "none");

          }
        }

        function IsNumeric2(e) {
            var keycode = e.which ? e.which : e.keyCode
            if (!(keycode == 8 || keycode == 46) && (keycode < 48 || keycode > 57) ) {
            $(".error2").css("display", "inline");
            
            return false;
          }else{
            $(".error2").css("display", "none");

          }
        }


</script>

