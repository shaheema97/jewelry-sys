<?php

//session_start();
//get latest gold rate
include_once ("../goldrate/rate.php");
$r1=new rate();
$result=$r1->get_today_rate();


//get category name for the drop doen list
include_once ("../item/category.php");
$cat3=new category();
$result_cat =$cat3->get_all_cat();

//get customer names for dropdown list
include_once ("../customer/cust.php");
$ogcust=new cust();
$result_cust=$ogcust->get_all_cus();

include_once ("../staff/staff.php");   
    $ogsatff=new staff();
    $result_staff=$ogsatff->get_all();

include_once ("../oldgold/oldgold.php");
$oldgold1=new oldgold();

include_once ("../oldgold/oldgolditem.php");
$ogitem1=new oldgolditem();

include_once ("../item/item.php");
$item_og=new item();

if(isset($_POST["ogcus"])){
    $oldgold1->oldgold_cus=$_POST["ogcus"];
    $oldgold1->oldgold_emp=$_POST["ogemp"];
    $oldgold1->oldgold_date=$_POST["ogdt"];
    $oldgold1->oldgold_qty=$_POST["totqty"];
    $oldgold1->oldgold_subtot=$_POST["subtot"];
    $oldgold1->oldgold_nettot=$_POST["nettot"];
    $oldgold1->oldgold_redtot=$_POST["disctot"];

    $result_goldid=$oldgold1->insert_oldgold();
    $ogitem1->addogitem($result_goldid);
    $item_og->addogitem_itemtbl($result_goldid);

    // $_SESSION["oldgold"]=$_POST;
    // $_SESSION["oldgoldid"]=$result_goldid;

    header("location:oldgoldconfirm.php?did=yes&ogid=".$result_goldid);

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
                
                <li class="breadcrumb-item"><a href="../purchase/purch_order_frm.php">Oldgoldbuy</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Success-color Breadcrumb card end -->
<!-- top button start  -->
<div class="row">
    <div class="col-sm-12">
        <div class="class-header">
            <div class="d-flex ">
            <div class="mr-auto p-2">
                <a href="pawntran.php" class="btn btn-sm btn-inverse" style="float: right;">
                <i class="fa fa-angle-double-left"></i>
                Back
                </a>
                </div>
                <div class="p-2">
                <a href="pawntran.php" class="btn btn-sm btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                           Mange oldgold
                            </a>
                </div>
                <div class="p-2">
                <!-- <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#default-Modal" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            Redeem Items
                </button> -->
            </div>
                
            </div>
        </div>
    </div>
</div>
<!-- top button end -->
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
          <div class="card-header"></div>
            <form action="oldgoldform.php" method="POST">
            <!-- top form start -->
            <div class="card-block">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <div class="col-form-label">Customer</div>
                        <div class="input-group">
                            <select name="ogcus" id="" class="form-control form-control-primary">
                                <option value="">---Select Customer---</option>
                                <?php foreach($result_cust as $item) {
                                            echo"<option value='$item->cust_id'>$item->cust_first_nm</option>";
                                        }?>
                            </select>
                            <a href="../supplier/supp_form.php" class="btn btn-primary btn-icon btn-sm"><i class="icofont icofont-plus"></i></a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="" class="col-form-label form-control-primary" >Date</label>
                        <input type="date" name="ogdt" class="form-control form-control-primary" value="<?php echo date('Y-m-d');?>">
                    </div>
                    <div class="col-sm-4">
                        <label for="" class="col-form-label ">Recieved by</label>
                        <select name="ogemp" id="" class="form-control form-control-primary">
                            <option value="">Select Staff</option>
                            <?php foreach ($result_staff as $item){
                    
                    echo "<option value='$item->st_id'>$item->st_firstname</option>	";
                }?>
                        </select>
                    </div>
                </div>
            
            <!-- topform end  -->
                <div class="card-body bg bg-primary">
                    <h5 class="sub-title">Item Info</h5>
                    <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="" class="col-form-label">Category</label>&nbsp<button class="btn btn-mini btn-danger" data-toggle="modal" data-target="#category-Modal">New Category</button>
                        <select  id="og_cat" class="form-control">
                            <option value="">Select Category</option>
                            <?php foreach($result_cat as $item) {
                                                echo"<option value='$item->cat_id'>$item->cat_name</option>";
                                            }?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label for="" class="col-form-label">Item Name</label>&nbsp<button class="btn btn-mini btn-danger" data-toggle="modal" data-target="#item-Modal" >New item</button>
                        <select  id="og_itemname" class="form-control ogitem">
                            <option value="">Select Item Name</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label for="" class="col-form-label">Purity</label>
                        <select name="" id="og_purity" class="form-control">
                            <option value="">Select purity</option>
                            <option value="18" name="" >18</option>
                            <option value="19" name=" ">19</option>
                            <option value="20" name="">20</option>
                            <option value="21" name=" ">21</option>
                            <option value="22" name=" ">22</option>
                            <option value="23" name=" ">23</option>
                            <option value="24" name=" ">24</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label for="" class="col-form-label">Item weight(g)</label>
                        <input type="text" class="form-control" id="og_weight" placeholder="eg:2.3">
                    </div>
                    <div class="col-sm-2">
                        <label for="" class="col-form-label">Stone weight(g)</label>
                        <input type="text" class="form-control" id="og_stnweight">
                    </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                        <label for="" class="col-form-label">Quantity</label>
                        <input type="number" class="form-control" id="og_qty">
                        </div>
                        <div class="col-sm-2">
                        <label for="" class="col-form-label">Size</label>
                        <input type="text" class="form-control" id="og_size">
                        </div>
                        <div class="col-sm-2">
                        <label for="" class="col-form-label">Unit</label>
                        <select name="" id="" class="form-control" id="og_unit"></select>
                        </div>
                        <div class="col-sm-2">
                        <label for="" class="col-form-label">Discount</label>
                        <select name="" class="form-control" id="og_disc">
                        <option value="10">10%</option>
                        <option value="20">20%</option>
                        <option value="30">30%</option>
                        </select>
                        </div>
                        <div class="col-sm-2">
                        <label for="" class="col-form-label">Status</label>
                        <select name="" id="og_condition" class="form-control">
                            <option value="good">Good condition</option>
                            <option value="medium">Medium Condition</option>
                            <option value="scrap">Scrap</option>
                        </select>
                        
                        </div>

                        <div class="col-sm-2">
                        <div class="">
                            <div class="">
                                <label for="" class=""></label><br>
                                <button type="button" id="btnadd" class="btn  btn-success"   >
                                <i class="icofont icofont-plus"></i>
                                Add 
                                </button>
                            </div>
                        </div>
                        </div>
                    </div>
                
                
                </div>
                </div>
                <div class="card-body">
                <div class="dt-responsive table-responsive">
                                <table  id="" class="table table-striped table-bordered nowrap" style="width : 100% ">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <!-- <th>Size</th> -->
                                            <th>Purity </th>
                                            <th>Item/Wgt</th>
                                            <th>Nett/Wgt</th>
                                            <th>Qty</th>
                                            <th>U.Price</th>

                                            <th>T.Price</th>
                                            <th>Reduction</th>
                                            <th>Final</th>

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
                                        <th> Total Weight :</th>
                                        <td ><input type="text" id="weight_total" name="weighttot" data-a-sign="Rs. " class=" form-control form-control-sm autonumber"></td>
                                    </tr>
                                    <tr>
                                        <th> Total :</th>
                                        <td ><input type="text" id="mtot" name="mtot" class="form-control form-control-sm  autonumber" data-a-sign="Rs. " ></td>
                                    </tr>
                                    <tr>
                                        <th> Total discount :</th>
                                        <td ><input type="text" id="disctot" name="disctot" class="form-control form-control-sm  autonumber" data-a-sign="Rs. " ></td>
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
                                        <button type="submit" class="btn btn-inverse" style="float: right;">
                                        <i class="icofont icofont-plus"></i>
                                        Submit Estimate
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
                </div>
             
            </form>
        </div>
        </div>
    </div>
</div>

<?php
include_once ("../files/bottom.php");
?>

<script>

//function to filter item name according to selected category
$("#og_cat").change(function(){

//get the id
var cat_id=$("#og_cat").val();
 console.log(cat_id);
 //get the data using ajax
 $.get("../files/ajax.php?type=get_itemname_bycat",{cat:cat_id},function(data){
     console.log(data);

 //convert json to 
 var d=JSON.parse(data);

 //remove any existing data from the item dropdown
 $("#og_itemname").html("");

 //cos we have list of items to be displayed, we use a loop
 $.each(d,function(i,x){
     console.log(i);//loop number
     console.log(x);//data
     $("#og_itemname").append("<option value='"+d[i].itemname_id+"'> "+d[i].item_name+" </option>");
 });
     
 });

 $("select.ogitem").change(function(){
       // console.log("hi");
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

$("#btnadd").click(function(){
        //alert("done");
        goldrate();
        additem();
        clear();
         mv_total();
         qty_total()
         weight_total()
        disc_tot();
        finaltot();
        final();
        
    });

    var vari;
    var poundrate;
    function goldrate(){
         
          vari=<?=$result->rate_gram?>;
          poundrate=<?=$result->rate_pound ?>;
        }

    function additem(){ 
        //validation to make sure allthe text boxes are filled

    // if($("#pint").val()=='' || $("#ploantime").val()==''){
    //     alert("Fill interest and time");
    // }else{
    
    //  if($(".pcat").val()=='' || $(".pitem").val()==''|| $(".pkar").val()==''  || $("#pwei").val()==''){
    //      alert("Fill all the fields in item info");
    //  } 
    //  else{

        name;
        cat;
        category=$("#og_cat").val();
        itemname=$("#og_itemname").val();
        purity=$("#og_purity").val();
        itemweight=$("#og_weight").val();
        stoneweight=$("#og_stnweight").val();
        nettweight=itemweight- stoneweight;
        quantity=$("#og_qty").val();
        size=$("#og_size").val();
        unit=$("#og_unit").val();
        status=$("#og_condition").val();
        discount=$("#og_disc").val();
        type="oldgold";

        // discount_amount=;
        // finalprice=;

        
         goldrate1= vari; //gold rate for 24k per gram
         rate_purity_gram = (parseFloat(goldrate1* purity)/24).toFixed(2); //gold  rate for certain purity
         marketval = (rate_purity_gram* parseFloat(nettweight)).toFixed(2); //pergram*wieght of item
         totalprice=(parseFloat(marketval)*parseFloat(quantity)).toFixed(2);
         discount_amount=(parseFloat(totalprice)* discount/100).toFixed(2);
         finalprice=(totalprice-discount_amount).toFixed(2);
        console.log(discount);
        console.log(totalprice);
        console.log(discount_amount);
        console.log(finalprice);
        $("#itembody").append("<tr><td><input type='hidden' name='cat[]' value='"+category +"' required>"+cat +"</td><td><input type='hidden' name='item[]' value='"+ itemname+"' required>"+name+"</td><td><input type='hidden' name='kar[]' value='"+ purity+"' required>"+purity +"</td><input type='hidden' name='itemsize[]' value='"+size +"' required><input type='hidden' name='sizeunit[]' value='"+ unit+"' required><input type='hidden' name='itemstat[]' value='"+ status+"' required><td><input type='hidden' class='w_tot' name='wt[]' value='"+ itemweight +"' required>"+ itemweight +"</td><input type='hidden' name='itemst_wt[]' value='"+stoneweight +"' required><td><input type='hidden' class='w_tot' name='nwt[]' value='"+ nettweight +"' required>"+ nettweight +"</td><td><input type='hidden' class='quant' name='quant[]' value='"+ quantity +"' quantity>"+ quantity +"</td><input type='hidden' name='itemtype[]' value='"+type +"' required><td><input type='hidden' name='mkv[]' class='m_tot' value='"+ marketval+"' required>"+ marketval+"</td> <td><input type='hidden' class='total' name='tot[]' value='"+ totalprice +"' required>"+ totalprice +"</td><input type='hidden' name='disc[]' class='r_tot' value='"+ discount+"' required><td><input type='hidden' name='dics_amt[]' class='discog' value='"+discount_amount +"' required>"+discount_amount +"</td><td><input type='hidden'  name='final_amt[]' class='final' value='"+finalprice +"' required>"+finalprice +"</td><td><button type='button'  onclick='delete_row(this)' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td></tr>");
       
        }
    //   }
    // }   

function clear(){
         $("#og_cat").val(" ");
     $("#og_itemname").val("");
     $("#og_purity").val("");
       $("#og_weight").val("");
      $("#og_stnweight").val("");
      
      $("#og_qty").val("");
      $("#og_size").val("");
     $("#og_unit").val("");
        $("#og_condition").val("");
        $("#og_disc").val("");
}

function qty_total(){
       
       qty=0;
       var w=$(".quant");
       $.each(w,function(i,item){
        qty= qty+parseFloat($(w[i]).val());
        qty.toFixed(1);
       })
       $("#total_quan").val(qty.toFixed(3));
   }
function weight_total(){
       
       weighttot=0;
       var w=$(".w_tot");
       $.each(w,function(i,item){
           weighttot= weighttot+parseFloat($(w[i]).val());
           weighttot.toFixed(1);
       })
       $("#weight_total").val(weighttot.toFixed(3));
   }

   function mv_total(){
       
       mvtot=0;
       var m=$(".total");
       $.each(m,function(i,item){
           mvtot=mvtot+parseFloat($(m[i]).val());
           mvtot.toFixed(1);
       })
       $("#mtot").val(mvtot.toFixed(3));
   }

   function disc_tot(){
        disc=0;
        var r=$(".discog");
        $.each(r,function(i,item){
            disc=disc+ parseFloat($(r[i]).val());//as the class is inside the text box we have to use textbox
            disc.toFixed(2);
        })
        $("#disctot").val(disc.toFixed(3));

    }

    function finaltot(){
       
       ftot=0;
       var m=$(".final");
       $.each(m,function(i,item){
        ftot=ftot+parseFloat($(m[i]).val());
        ftot.toFixed(1);
       })
       $("#sub_total").val(ftot.toFixed(3));
   }

    function final(){
        nett_tot=ftot+disc;
        $("#net_total").val(nett_tot.toFixed(3));


    }

</script>


