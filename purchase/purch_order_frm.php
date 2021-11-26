<?php
    include_once ("../supplier/supplier.php");
    $purch_sup1=new supplier();
    $result_sup1=$purch_sup1->get_all_sup();

    include_once ("../staff/staff.php");
    $purch_staff1=new staff();
    $result_staff1=$purch_staff1->get_all();
//include category class to get categorynames for dropdown
    include_once ("../item/category.php");
    $purch_cat1=new category();
    $result_cat1=$purch_cat1->get_all_cat();
//include item class to get names for dropdown
    include_once ("../item/item.php");
    $purch_item1=new item();
    $result_item1=$purch_item1->get_all_item();

//include the purchaseorder file which has the purchase order file
    include_once ("purchaseorder.php");
    $p_order=new purchaseorder();

//include the file which has the purchase orderoitem class
    include_once ("../purchase/purchaseorderitem.php");
    $p_item=new purchaseorderitem();

//include the file which has the notification class
    include_once ("../notification/notification.php");
    $notify=new notification();

/**check if the POST array contains any value for input box
 * with attribute name as p_ordersup */
    if(isset($_POST["p_ordersup"])){
        $p_order->purchorder_supp=$_POST["p_ordersup"];
        $p_order->purchorder_emp=$_POST["p_ordersemp"];
        $p_order->purchorder_date=$_POST["p_orderdate"];
        //function to save the a purchase order which return its ID
        $id=$p_order->insert_purchorder(); 
        $p_item->insert_purchitem($id);//function to save order item
        $msg1="you have new order. ref : $id"; //notification message to be send
        $notify->insert_not($_POST["p_ordersup"],$msg1); //function to save notification details

        session_start();//start sssion
        $_SESSION["invoiceid"]=$id;//session variabe to store id
        $_SESSION["purchorder"]=$_POST; //session to store POST array data
        $_SESSION["success2"]="Added successfully";//session to store successmessage
        //to rediect once the form is submiited
        header("location:orderconfirm.php");
    }

    include_once ("../files/top.php");

?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
    <div class="card-block success-breadcrumb">
        <div class="breadcrumb-header">
            <strong>Purchase Order</strong>
            <br>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#!">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                
                <li class="breadcrumb-item"><a href="../purchase/purch_order_frm.php">New Order</a>
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
                            <a href="../purchase/purch_order_frm.php" class="btn btn btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            Manage Order
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="order_frm.php" class="btn  btn-success" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                             OrderItems
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--end 1 -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <form action="../purchase/purch_order_frm.php" method="POST" onSubmit="if(!confirm('Do you want to place the order?')){return false;}">
                     <!-- purchase form top start -->
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="col-form-label">Supplier</div>
                                <div class="input-group">
                                    <select name="p_ordersup" id="" class="form-control form-control-primary" required> 
                                        <option value="">---Select Supplier---</option>
                                        <?php
                                            foreach($result_sup1 as $item){
                                                echo"<option value='$item->sup_id'>$item->sup_firstname</option>";
                                            }

                                        ?>
                                    </select>
                                    <a href="../supplier/supp_form.php" class="btn btn-primary btn-icon btn-sm"><i class="icofont icofont-plus"></i></a>
                                </div>
                            </div>
                           <div class="col-sm-4">
                                <div class="col-form-label">Purchase Date</div>
                                <input type="date" class="form-control form-control-primary" name="p_orderdate" required>
                           </div>
                           <div class="col-sm-4">
                                <div class="col-form-label">Recieved by</div>
                                <select name="p_ordersemp" id="" class="form-control form-control-primary" required>
                                    <option value="">---Select Staff--</option>
                                    <?php
                                            foreach($result_staff1 as $item){
                                                echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                            }

                                        ?>
                                </select>
                           </div>
                        
                        </div>

                    <!-- purchase form top end -->

                    
                    <!-- item info box start -->
                        <div class="card-block  bg-primary ">
                            <div class="form-group itemlist">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="col-form-label">Category</div>
                                        <select name="" id="purchitemcat" class="form-control form-control-sm itemcat">
                                            <option value=""></option>
                                            <?php 
                                                foreach($result_cat1 as $item){
                                                    echo"<option value='$item->cat_id'>$item->cat_name</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 itemnaaama" >
                                        <div class="col-form-label">Item Name</div>
                                        <select name="" id="purchitemname" class="form-control form-control-sm itemname" ></select>
                                        <div class="col-form-label text-danger"> Item not available</div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="col-form-label">Size</div>
                                        <input type="text" id="purchitemsize" class="form-control form-control-sm size" >
                                        <div id="msg1"></div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="col-form-label">Unit</div>
                                        <select name="" id="purchitemsizeunit" class="form-control form-control-sm">
                                                <option value="inches">inches</option>
                                                <option value="mm">mm</option>
                                                <option value="cm">cm</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="col-form-label">Weight(in grams)</div>
                                        <input type="text" id="purchitemweight" class="form-control form-control-sm weight">
                                        <div id="msg2"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="" class="col-form-label" >Quantity</label>
                                        <input type="number" id="purchitemqty"class="form-control form-control-sm qty">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" class="col-form-label form-control-sm">Purity</label>
                                        <select name="" id="purchitempurity" class="form-control">
                                            <option value=""></option>
                                            <option value="18" name="" >18</option>
                                            <option value="19" name=" ">19</option>
                                            <option value="20" name="">20</option>
                                            <option value="21" name=" ">21</option>
                                            <option value="22" name=" ">22</option>
                                            <option value="23" name=" ">23</option>
                                            <option value="24" name=" ">24</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="" class="col-form-label form-control-sm">Description</label>
                                        <input type="text" id="purchitemdes" class="form-control">
                                    </div>
                                    <div class="col-sm-1">
                                        <label for=""></label><br>
                                        <div class="d-flex flex-row-reverse">
                                            <div class="p-2">
                                                <button type="button" id="purchitemmadd" class="btn btn-sm btn-success"  >
                                                <i class="icofont icofont-plus"></i>
                                                Add 
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <!-- item info box end -->
                    <!-- purchase item table start -->
                        <div class="dt-responsive table-responsive">
                            <table  id="tbl_user_data" class="table table-sm table-striped table-bordered nowrap" style="width : 100% ">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Purity </th>
                                        <th>Weight</th>
                                        <th>Qty</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="itembody">
                                
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <label for="" class="col-form-label">Order Note</label><br>
                                <textarea name="" id="" rows="5" cols="5" class="form-control form-control-primary" placeholder="Type an order note if neccessary....."></textarea>
                            </div>
                            <!-- <div class="">
                            
                            </div> -->

                        </div>
                        <div class="d-flex flex-row-reverse">
                                <div class="p-2">
                                        <button type="submit" class="btn btn-success" style="float: right;">
                                        <i class="icofont icofont-plus"></i>
                                        Submit Order
                                        </button>
                                </div>
                                <div class="p-2">
                                        <button type="reset" class="btn btn-danger" style="float: right;">
                                        <i class="icofont icofont-ui-close"></i>
                                        Cancel
                                        </button>
                                </div>
                            </div>
                    <!-- purchase item table end -->
                    </form>
                </div>
    </div>
</div>

<?php
    include_once ("../files/bottom.php");

?>

<script>

    

    //function to filter items according to the selected category
    $("#purchitemcat").change(function(){
        //get the id
        var cat_id=$("#purchitemcat").val();
       
        //get the data using ajax
        $.get("../files/ajax.php?type=get_item_bycat",{catid:cat_id},function(data){
            //console.log(data);

        //convert json to 
        var d=JSON.parse(data);

        //remove any existing data from the item dropdown
        $("#purchitemname").html("");

        //cos we have list of items to be displayed, we use a loop
        

        $.each(d,function(i,x){
            console.log(i);//loop number
            console.log(x);//data
            $("#purchitemname").append("<option value='"+d[i].item_id+"'> "+d[i].item_name+" </option>");
        });
        });
    });

    //function to get item category name and item name
    $("select.itemcat").change(function(){
        var cat_id=$(this).children("option:selected").val();
        console.log(cat_id);

        $.get("../files/ajax.php?type=get_cat_bycatid",{categoryid:cat_id},function(data){
            var i_data = JSON.parse(data);
            category=i_data.cat_name;
            console.log(category);
        });

    });

    $("select.itemname").change(function(){
        var item_id=$(this).children("option:selected").val();
        console.log(item_id);

        $.get("../files/ajax.php?type=get_item",{itemid:item_id},function(data){
            var i_data = JSON.parse(data);
            name=i_data.item_name;
            console.log(name);
        });
    });




    //dynamic table
    $("#purchitemmadd").click(function(){
        
        additems();
        clear_rows();


    });


    function   additems(){
        category;
       //console.log(name); 
      var itemcat=$("#purchitemcat").val();
      var itemname=$("#purchitemname").val();
      var itemsize=$("#purchitemsize").val();
      var itemweight=$("#purchitemweight").val();
      var itemunit=$("#purchitemsizeunit").val();
      var itemdes=$("#purchitemdes").val();
      var itemqty=$("#purchitemqty").val();
      var itempurity=$("#purchitempurity").val();
      
    
    //   if(itemcat =="" || itemname =="" || itemsize=="" || itemweight=="" || itemunit=="" || itemqty=="" || itempurity==""){
    //             alert("Please fill all fields");
    //             //problem--the existing data in the text boxes also removes
    //     }else{
      
      $("#itembody").append("<tr><td><input type='hidden' value='"+itemcat+"' class='row_data' edit_type='click' name='p_itemcat[]' >"+category+"</td><td><input type='hidden' value='"+itemname+"' class='row_data' edit_type='click' name='p_itemname[]' >"+name+"</td><td><input type='hidden' value='"+itemsize+"' name='p_itemsize[]' class='row_data' edit_type='click' >"+itemsize+"</td><td><input type='hidden' value='"+itempurity+"' class='row_data' edit_type='click' name='p_itempurity[]' >"+itempurity+"</td><td><input type='hidden' value='"+itemweight+"' class='row_data' edit_type='click' name='p_itemweight[]' >"+itemweight+"g</td><td><input type='hidden' class='row_data' edit_type='click' value='"+itemqty+"' name='p_itemqty[]' >"+itemqty+"</td><td><button type='button'  onclick='delete_row(this)' class='badge badge-danger btn-delete' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button><button type='button'  onclick='showbutton()' class='badge badge-primary btn-edit' style='float: none;margin: 5px;'><span class='icofont icofont-ui-edit'></span></button><span id='btn-save'><button type='button'  onclick='' class='badge badge-success' style='float:none;margin: 5px;'>Save</button></span><span class=' btn-cancel'><button type='button'  onclick='' class='badge badge-danger' style='float:none;margin: 5px;'>Cancel</button></span></td><tr>");
        // }

    }
    //hide buttons
    $("#btn-save").hide();

//--------------------------------------------------------------------------------------------------------------------------------------------------------------
    function clear_rows(){

      $("#purchitemcat").val("");
      $("#purchitemname").val("");
      $("#purchitemsize").val("");
      $("#purchitemweight").val("");
      $("#purchitemsizeunit").val("");
      $("#purchitemdes").val("");
      $("#purchitemqty").val("");
      $("#purchitempurity").val("");
      $("#purchitemcat").focus();
    }

    function delete_row(x){
        $(x).parent().parent().remove();
        //first parent ->tr
        //second parent->td

    }

    $(".itemlist").delegate(".weight","keypres",function(){
        var itemweight=$(this);
        if(isNaN(itemweight.val())){
            alert("Please enter valid data");
            }
        });

        $(".itemlist").delegate(".size","keyup",function(){
        var size=$(this);
        if(isNaN(size.val())){
           console.log("Please enter valid data");
            $("#msg1").append("<p>Please enter valid data</p>");
            // $("#msg1").hide(1000);
                $(".size").val("");
                }
        });



    
</script>