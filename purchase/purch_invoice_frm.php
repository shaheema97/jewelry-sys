<?php
 include_once ("../supplier/supplier.php");
 $purch_sup1=new supplier();
 $result_sup1=$purch_sup1->get_all_sup();

 include_once ("../staff/staff.php");
 $purch_staff1=new staff();
 $result_staff1=$purch_staff1->get_all();

 include_once ("../item/category.php");
 $purch_cat1=new category();
 $result_cat1=$purch_cat1->get_all_cat();

 include_once ("../item/item.php");
 $purch_item1=new item();
 $result_item1=$purch_item1->get_all_item();

 include_once ("../stock/stock.php");
 $purch_stock=new stock();

 include_once ("purchase.php");
$purch_in=new purchase();
$r="";

 if(isset($_POST["invoice_sup"])){
    if( empty($_POST["invoice_sup"]) || empty($_POST["invoice_sup"])){
            $r="Please fil all the fields";
    }else{
    $purch_in->purchase_supp=$_POST["invoice_sup"];
    $purch_in->purchase_emp=$_POST["invoice_emp"];
    $purch_in->purchase_date=$_POST["invoice_date"];
    $purch_in->purchase_payment=$_POST["invoice_pay"];
    $purch_in->purchase_pay_duedt=$_POST["invoice_paydue"];
    $purch_in->purchase_subtot=$_POST["subtot"];
    $purch_in->purchase_stoneamt=$_POST["stonetot"];
    $purch_in->purchase_nettot=$_POST["nettot"];
    $purch_res=$purch_in->insert_purchase();
    $purch_item1->insert_item_2($purch_res);
    $purch_stock->insert_stock_add($purch_res);

    
    header("location:../purchase/purchasepay.php&pid=".$purch_res);
    }
 }


 include_once ("../files/top.php");
?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
    <div class="card-block success-breadcrumb">
        <div class="breadcrumb-header">
            <strong>Purchase Invoice</strong>
            <br>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#!">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                
                <li class="breadcrumb-item"><a href="#!">Purchase Invoice</a>
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
                <div class="mr-auto p-2">
                                            <a href="pawntran.php" class="btn btn-sm btn-inverse" style="float: right;">
                                            <i class="fa fa-angle-double-left"></i>
                                            Back
                                            </a>
                                </div>
                    <div class="p-2">
                            <a href="managesales.php" class="btn btn-sm btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            Manage Order
                            </a>
                    </div>
                   
                    <div class="p-2">
                            <button type="button" class="btn btn-sm btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                           Manage purchase invoice
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--end 1 -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <form action="purch_invoice_frm.php" method="POST" onSubmit="if(!confirm('Is the form filled out correctly?')){return false;}">
                        <!-- purchase form top start -->
                        <div class="col-md-12">
                                            <h6 class="text-center" style="color:red;"><?=$r?></h6>
                                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="col-form-label">Supplier</div>
                                    <div class="input-group">
                                        <select name="invoice_sup" id="" class="form-control form-control-primary">
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
                                    <input type="date" id="purchdate" name="invoice_date" value="<?php echo date('Y-m-d');?>" class="form-control form-control-primary">
                            </div>
                            <div class="col-sm-4">
                                    <div class="col-form-label">Recieved by</div>
                                    <select name="invoice_emp" id="" class="form-control form-control-primary">
                                        <option value="">---Select Staff--</option>
                                        <?php
                                                foreach($result_staff1 as $item){
                                                    echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                                }

                                            ?>
                                    </select>
                            </div>
                            
                            </div>
                            <div class="row">
                                    <div class="col-sm-4">
                                        <div class="col-form-label">Payment</div>
                                        <select name="invoice_pay" id="" class="form-control form-control-primary purchpayperiod">
                                        <option value="cash">cash</option>
                                        <option value="1">1 month</option>
                                        <option value="2">2 months</option>
                                        <option value="3">3 months</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="col-form-label">Payment</div>
                                        <input type="text" class="form-control form-control-primary" id="duedate" name="invoice_paydue">
                                    </div>
                            
                            </div>

                        </div>
                        <!-- purchase form top end -->
                        <!-- purchase item start -->
                            <div class="card-block bg bg-primary">
                                <div class="form-group itemlist">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="col-form-label">Category</div> 
                                            <select name="" id="purchinv_cat" class="form-control form-control-sm pcat ">
                                            <option value="">Select Catgory</option>
                                            <?php 
                                                foreach($result_cat1 as $item){
                                                    echo"<option value='$item->cat_id'>$item->cat_name</option>";
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="col-form-label">Item</div> 
                                            <select name="" id="purchinv_name" class="form-control form-control-sm pitem">
                                                <option value="">Select Item</option>
                                            </select>
                                            
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="col-form-label">Purity</div> 
                                            <select name="" id="purchinv_purity" class="form-control form-control-sm">
                                                <option value="">Select Purity</option>
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
                                        <div class="col-sm-3">
                                            <div class="col-form-label">Item Weight</div> 
                                            <input type="text" name="" id="purchinv_itemwt" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="col-form-label">Stone Weight</div> 
                                            <input type="text" name="" id="purchinv_stonewt" class="form-control form-control-sm">
                                        </div>
                                        
                                         <!-- nett weight    -->
                                            <input type="hidden" name="" id="purchinv_ntwt" class="form-control form-control-sm">
                                        <!-- nett weight    -->
                                        <div class="col-sm-3">
                                            <div class="col-form-label">Gross Weight</div> 
                                            <input type="text" name="" id="purchinv_grosswt" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="col-form-label">Size</div> 
                                            <input name="" id="purchinv_size" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="col-form-label">Unit</div> 
                                            <select name="" id="purchinv_unit" class="form-control form-control-sm">
                                            <option value="inch">inch</option>
                                            <option value="cm">cm</option>
                                            <option value="mm">mm</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="col-form-label">Quantity</div> 
                                            <input type="number" name="" id="purchinv_qty" value="1" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-3">
                                            <div class="col-form-label">Unit Price</div> 
                                            <input type="text" name="" id="purchinv_unitprice" class="form-control form-control-sm" data-a-sign="Rs. ">
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="col-form-label">Stone Price</div> 
                                            <input type="text" name="" id="purchinv_stoneprice" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-sm-3">
                                            <!-- <div class="col-form-label">Img/Receipt</div> 
                                            <input type="file" name="" id="" class="form-control form-control-sm"> -->
                                        </div>
                                        <div class="col-sm-3">
                                            <label for=""></label><br>
                                            <div class="d-flex flex-row-reverse">
                                                <div class="p-2">
                                                    <button type="button" id="addpurchrow" class="btn btn-sm btn-success"   >
                                                    <i class="icofont icofont-plus"></i>
                                                    Add 
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            
                            </div>
                        <!-- purchase item end -->
                        
                        <div class="card-block">
                            <!-- dynamic table start -->
                            <div class="dt-responsive table-responsive">
                                <table  id="" class="table table-striped table-bordered nowrap" style="width : 100% ">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Size</th>
                                            <th>Purity </th>
                                            <th>Item/Wgt</th>
                                            <th>Gross/Wgt</th>
                                            <th>Qty</th>
                                            <th>U.Price</th>
                                            <th>T.Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itembody">
                                    
                                    </tbody>
                                </table>
                                
                            </div>
                            <!-- dynamic table end -->
                            <!-- final values-->
                            <table class="table table-responsive invoice-table invoice-total">
                                <tbody class="pricelist">
                                    <tr>
                                        <th> Total Quantity :</th>
                                        <td ><input type="text" id="total_quan" name="totqty" class="form-control form-control-sm" ></td>
                                    </tr>
                                    <tr>
                                        <th> Total Stone Amount :</th>
                                        <td ><input type="text" id="stone_total" name="stonetot" data-a-sign="Rs. " class=" form-control form-control-sm autonumber"></td>
                                    </tr>
                                    <tr>
                                        <th> Sub Total :</th>
                                        <td ><input type="text" id="sub_total" name="subtot" class="form-control form-control-sm  autonumber" data-a-sign="Rs. " ></td>
                                    </tr>
                                   
                                    <tr class="text-info">
                                        <td>
                                            <hr>
                                            <h5 class="text-primary">Total :</h5>
                                        </td>
                                        <td>
                                            <hr>
                                            <h5 class="text-primary"><input type="text" id="net_total" name="nettot"  class="form-control"></h5>
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

                        
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>




<?php
 include_once ("../files/bottom.php");
?>

<script>
//function to filter item name according to selected category
$(".pcat").change(function(){

//get the id
var cat_id=$(".pcat").val();
 console.log(cat_id);
 //get the data using ajax
 $.get("../files/ajax.php?type=get_itemname_bycat",{cat:cat_id},function(data){
     console.log(data);

 //convert json to 
 var d=JSON.parse(data);

 //remove any existing data from the item dropdown
 $("#purchinv_name").html("");

 //cos we have list of items to be displayed, we use a loop
 $.each(d,function(i,x){
     console.log(i);//loop number
     console.log(x);//data
     $("#purchinv_name").append("<option value='"+d[i].itemname_id+"'> "+d[i].item_name+" </option>");
 });
     
 });

 $("select.pitem").change(function(){
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
});

$(".itemlist").delegate("#purchinv_unitprice","keyup",function(){
    var qty=$("#purchinv_qty").val();
        var itemweight=$(this);
        var price=itemweight.val();
        
        var total=price*qty;
        console.log(total);
        $("#purchinv_totprice").val(total);
        
        //problem-> when we type unit price first and then quantity price is 0
        }); 


$("#addpurchrow").click(function(){
    
    addrows();//
    
    cal_totquantity();
    cal_subtotal();
    cal_tot_stoneprice();

    final_total();

    clear();
});

function addrows(){

    name;
    cat;
    var category=$("#purchinv_cat").val();
    var item=$("#purchinv_name").val();
    var weight=$("#purchinv_itemwt").val();
    var stoneweight=$("#purchinv_stonewt").val();
    var grossweight=$("#purchinv_grosswt").val();
    var nettweight=weight-stoneweight;
    var purity=$("#purchinv_purity").val();
    var size=$("#purchinv_size").val();
    var unit=$("#purchinv_unit").val();
    var qty=$("#purchinv_qty").val();
    var proctype="supplier";
    var stoneprice=$("#purchinv_stoneprice").val();
    console.log(stoneprice);
    
    var unitprice=$("#purchinv_unitprice").val(); 
    totprice=parseFloat(unitprice)*parseFloat(qty);
    console.log(weight);

    //   if(category =="" || item =="" || itemsize=="" || weight=="" ||  stoneweight=="" || grossweight=="" || nettweight=="" ||  purity=="" || size=="" || unit=="" || qty=="" ){
    //             alert("Please fill all fields");
    //             //problem--the existing data in the text boxes also removes
    //     }else{

    $("#itembody").append("<tr><td><input type='hidden' class='' id='' name='itm_cat[]' value='"+category+"'>"+cat+"</td><input type='hidden' class='' id='' name='proc_type[]' value='"+proctype+"'><td><input type='hidden' class='' id='' name='itm_name[]' value='"+item+"'>"+name+"</td><td><input type='hidden' class='' id='' name='item_size[]' value='"+size+"'>"+size+"<input type='hidden' class='' id='' name='item_unit[]' value='"+unit+"'>"+unit+"</td><td><input type='hidden' class='' id='' name='itm_purity[]' value='"+purity+"'>"+purity+"</td><td><input type='hidden' class='' id='' name='itm_wt[]' value='"+weight+"'>"+weight+"</td><input type='hidden' class='' id='' name='' value='"+stoneweight+"'><td><input type='hidden' class='' id='' name='itm_gwt[]' value='"+grossweight+"'>"+grossweight+"</td><input type='hidden' class='' id='itm_nwt[]' name='' value='"+nettweight+"'><td><input type='hidden' class='quantity' id='' name='itm_quan[]' value='"+qty+"'>"+qty+"</td><td><input type='hidden' class='unitprice' id='' name='item_unitprice[]' value='"+unitprice+"'>"+unitprice+"</td><input type='hidden' class='stone_price' id='' name='' value='"+stoneprice+"'><td><input type='hidden' class='totalprice' id='' name='tot_price[]' value='"+totprice+"'>"+totprice+"</td><td><button type='button'  onclick='delete_row(this)' class='badge badge-danger btn-delete' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td></tr>");
// }



}
function clear(){
    $("#purchinv_cat").val("");
    $("#purchinv_name").val("");
    $("#purchinv_itemwt").val("");
    $("#purchinv_stonewt").val("");
    $("#purchinv_grosswt").val("");
    $("#purchinv_ntwt").val("");
    $("#purchinv_purity").val("");
    $("#purchinv_size").val("");
    $("#purchinv_unit").val("");
    $("#purchinv_qty").val("");
    $("#purchinv_unitprice").val("");
    $("#purchinv_totprice").val("");
    $("#purchinv_cat").focus("");

}




function cal_totquantity(){
    console.log("quantity");
    tot_quan=0;

    var quan=$(".quantity");
    $.each(quan,function(i,item){
        tot_quan=tot_quan+ parseInt($(quan[i]).val());
    })
    $("#total_quan").val(tot_quan);
}

function cal_tot_stoneprice(){
    stonetot=0;
    
    var tot=$(".stone_price");
    console.log(tot);
    $.each(tot,function(i,item){
        stonetot=stonetot+parseFloat($(tot[i]).val());

    })
    $("#stone_total").val(stonetot);
}

function cal_subtotal(){
    console.log("subtotal");
    subtot=0;
    var tot=$(".totalprice");
    $.each(tot,function(i,item){
        subtot=subtot+ parseFloat($(tot[i]).val());

    })
    $("#sub_total").val(subtot);
}



function final_total(){

    final=0;
   
    final=subtot+stonetot;
    $("#net_total").val(final);
    // }
}

function delete_row(x){
        $(x).parent().parent().remove();
        cal_totquantity();
    cal_subtotal();
 cal_tot_stoneprice();

    final_total();
    }


$(".pricelist").delegate("#stone_total","keyup",function(){
   
        var stoneprice=$(this);
        var price=stoneprice.val();
        
        var total=parseFloat(price)+parseFloat(final);
        console.log(total);
        $("#net_total").val(total);
        
        //problem->keuup is not the appropraite function
        }); 


//duedate
$("select.purchpayperiod").change(function(){
    console.log("hi");
    var time = $(this).children("option:selected").val();


    if(time==="cash"){
        msg="no due date"
        $("#duedate").val(msg);
    }else{

    
    var date=$("#purchdate").val(); //get the value from  textbox
    console.log(date);
    var d=new Date(date);
    var h=d.getDate();
    console.log(h);
    //var k = d.getMonth();


    d.setMonth(d.getMonth() + parseInt(time));
    if (d.getDate() != h) {
        d.setDate(0);
        }
        console.log(d);
    
        dd=d.getDate();
        mm=d.getMonth()+1;
        yy=d.getFullYear();
        console.log(dd);
        console.log(mm);
        console.log(yy);
        today = mm+'/'+dd+'/'+yy;
        console.log(today);
        $("#duedate").val(today);}
//purchpayperiod duedate
 
});





</script>