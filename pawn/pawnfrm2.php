<?php


    //get staff name for the dropdown list
    include_once ("../staff/staff.php");   
    $pawnsatff=new staff();
    $result_staff=$pawnsatff->get_all();
    
    //get latest gold rate
    include_once ("../goldrate/rate.php");
    $r1=new rate();
    $result=$r1->get_today_rate();
    
    //get customer names for dropdown list
    include_once ("../customer/cust.php");
    $pawncust=new cust();
    $result_cust=$pawncust->get_all_cus();
   
    //get itemname for the dropdownlist
    include_once ("../item/itemname.php");
    $item7=new itemname();
    $result_item=$item7->getall_itemname();

    //get category name for the drop doen list
    include_once ("../item/category.php");
    $cat3=new category();
    $result_cat =$cat3->get_all_cat();

     
    include_once ("pawn.php");
    $pawn1=new pawn();
    

    include_once ("pawnitem.php");
    $pawn_item=new pawnitem();
    //get the list of redeem pawn items
    $result_redeem=$pawn_item->get_redeem();
 
    include_once ("../estimate/estimate.php");
    $est1=new estimate();

    include_once ("../estimate/estimateitem.php");
    $est_item=new estimateitem();


   

    //insert a new pawn
    if(isset($_POST["save"])){
        $pawn1->pawn_dt=$_POST["pdt"];
        $pawn1->pawn_cus=$_POST["pcus"];
        $pawn1->pawn_em=$_POST["pem"];
        $pawn1->pawn_period=$_POST["pperiod"];
        $pawn1->pawn_duedt=$_POST["pduedt"];
        $pawn1->pawn_int=$_POST["p_int"];
        $pawn1->pawn_intval=$_POST["intval"];
        $pawn1->pawn_rvtot=$_POST["rvtot"];
        $pawn1->pawn_mvtot=$_POST["mktval"];
        $pawn1->pawn_avtot=$_POST["asvtot"];
        $result_pawnid= $pawn1->insertpawn();
        $pawn_item->addpawnitem($result_pawnid);
        
        
       
        // $_SESSION["status"]="Added a new pawn successfully";
        // $_SESSION["status_code"]="success";
       
       
        header("location:pawnconfirm.php?did=yes&pid=".$result_pawnid);
     
    }//insert a pawn estimate
    elseif (isset($_POST["estimate"])) {
        $est1->estimate_date=$_POST["pdt"];
        $est1->estimate_cust=$_POST["pcus"];
        $est1->estimate_staff=$_POST["pem"];
        $est1->estimate_pawnperiod=$_POST["pperiod"];
        //$est1->pawn_duedt=$_POST["pduedt"];
        $est1->estimate_int=$_POST["p_int"];
        $est1->estimate_intval=$_POST["intval"];
        $est1->estimate_rvtot=$_POST["rvtot"];
        $est1->estimate_mvtot=$_POST["mktval"];
        $est1->estimate_avtot=$_POST["asvtot"];
        $result_estid=$est1->insertestimate();
        $est_item->insertestimateitem($result_estid);
        
   
        
        $_SESSION["estimate"]=$_POST;
        $_SESSION["estid"]=$result_estid;
        $_SESSION["success_estime"]="Added an estimate successfully";
        header("location:estimateconfirm.php?did=yes");
        
    }
    // else{
    //     echo '<script>
    //     swal("Error");
    //     </script>';
    // }



    include_once ("../files/top.php");
?>

 <!-- Success-color Breadcrumb card start -->
    <div class="card borderless-card">
        <div class="card-block success-breadcrumb">
            <div class="breadcrumb-header">
            <strong>New Pawn/Pawn Estimate</strong>
            <br>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#!">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    
                    <li class="breadcrumb-item"><a href="#!">New Pawn</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!-- Success-color Breadcrumb card end -->

<!-- Form Start-->
    <div class="page-body">
        <div class="row"> <!--start top button-->
                    <div class="col-sm-12">
                        <div class="class-header">
                            <div class="d-flex">
                                <div class="mr-auto p-2">
                                            <a href="pawntran.php" class="btn btn-sm btn-inverse" style="float: right;">
                                            <i class="fa fa-angle-double-left"></i>
                                            Back
                                            </a>
                                </div>
                                <div class="p-2">
                                <a href="pawntran.php" class="btn btn-sm btn-success" style="float: right;">
                                            <i class="icofont icofont-plus"></i>
                                            Pawn Transaction
                                            </a>
                                </div>
                                <div class="p-2">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#default-Modal" style="float: right;">
                                            <i class="icofont icofont-plus"></i>
                                            Redeem Items
                                            </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div> <!--end top button -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-block">
                        <form method="POST" action="pawnfrm2.php" name="pawn"  onSubmit="">
                            
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="col-form-label">Customer</label>
                                        
                                        <select id="" class="form-control form-control-primary" name="pcus" required>
                                        <option value="">Select Customer</option>
                                        <?php foreach($result_cust as $item) {
                                            echo"<option value='$item->cust_id'>$item->cust_first_nm</option>";
                                        }?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label" >Pawn Date</label>
                                        
                                        <input type="date" id="pawndate" class="form-control form-control-primary" value="<?php echo date('Y-m-d');?>" name="pdt" required >
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label">Recieved By</label>
                                    
                                        <select id="" class="form-control form-control-primary" name="pem" required>
                                        <option value="">Select Staff</option>
                                            <?php foreach ($result_staff as $item){
                    
                                                    echo "<option value='$item->st_id'>$item->st_firstname</option>	";
                                                }?>

                                        </select>   
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for=" " class="col-form-label">Loan Period</label>
                                       
                                        <select name="pperiod" id="ploantime" class="form-control form-control-primary ploantime" required>
                                        <option value="">Select Loan Period</option>
                                        <option value="3">3 months</option>
										<option value="6">6 months</option>
                                        <option value="12">12 months</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for=" " class="col-form-label">Due date</label>
                                        <input type="text" name="pduedt" id="pawnduedt" class="form-control form-control-primary" required>
                                       
                                
                                    </div>
                                    <div class="col-sm-4">
                                        <label for=" " class="col-form-label">Rate of Interest</label>
                                        <input name="p_int" id="pint" readonly class="form-control form-control-primary" value="<?=$result->pawnrate ?>" required>
                                            
                                    </div>
                                </div>
                            <div class="card-block bg-primary "  >
                                <h5 class="sub-title">Item Info</h5>
                                <div class= "row iteminfo">
                                    <div class="col-sm-3 form-group">
                                            <label>Category</label>
                                            <!--<input type="text" class="form-control form-control-default" id="pcat" >-->
                                            <select id="catlist" class="form-control pcat" name=" " >
                                            <option value="">Select Category</option>
                                            <?php foreach($result_cat as $item) {
                                                echo"<option value='$item->cat_id'>$item->cat_name</option>";
                                            }?>
                                            </select> 
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>Item</label>
                                        <!--<input type="text" class="form-control form-control-default" id="pitem" >-->
                                        <select  class="form-control pitem" name=" " id="pawnitem1" >
                                        <option value="">Select Item</option>
                                        
                                        </select>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>Karat</label>
                                        <!-- input type="text" class="form-control form-control-default" id="pkar" >-->
                                        <select id="" class="form-control pkar" name=" " >
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
                                    <div class="col-sm-2 form-group">
                                        <label>Weight(grams)</label>
                                        <input type="text" class="form-control weight " id="pwei" name="weight" onkeypress="return IsNumeric(event);">
                                        <span class="error" style="color: red; display: none">* Input digits (0 - 9)</span> 
                                    </div>
                                    <div class="col-sm-2 form-group"  >
                                    <label for=""></label><br>
                                    <div class="d-flex flex-row-reverse">
                                        <div class="p-2">
                                            <button type="button" id="btnadd" class="btn btn-success"   >
                                            <i class="icofont icofont-plus"></i>
                                            Add 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                   
                                            
                                    
                                       
                                </div>
                            </div >
                            
					
                        <table id="" class="table table-responsive table-bordered table-condensed ">
                        <thead>
                            <tr>
                                <th>Category</th>
								<th>Item</th>
								<th>Karat</th>
                                <th>Weight</th>
								<th>Market/Val</th>
                                <th>Assesed/Val </th>
                                <th>Interest</th>
                                <th>Redeem</th>
                                <th>Action</th>
								<hr style="color:#000001;">
                            </tr>
                        </thead>
                        <tbody id="itembody">

                        </tbody>
                        

					
                    </table>
                    <!-- final values-->
                    <table class="table table-responsive invoice-table invoice-total">
                            <tbody>
                                <tr>
                                    <th> Total Gold :</th>
                                    <td ><input type="text" readonly  class="form-control form-control-primary form-control-sm" id="wtot" name="" ></td>
                                </tr>
                                <tr>
                                    <th> Total Market Value :</th>
                                    <td ><input type="text" readonly  class="form-control form-control-primary form-control-sm" id="mtot" name="mktval" ></td>
                                </tr>
                                <tr>
                                    <th> Total Assesed Value:</th>
                                    <td><input type="text" readonly  class="form-control form-control-primary form-control-sm" id="rtot" name="asvtot" ></td>
                                </tr>
                                <tr>
                                    <th>Total Interest()  :</th>
                                    <td ><input type="text" readonly class="form-control form-control-primary form-control-sm" id="inttot" name="intval" ></td>
                                </tr>
                                <tr class="text-info">
                                    <td>
                                        <hr>
                                        <h5 class="text-primary">Loan Amount:</h5>
                                    </td>
                                    <td>
                                        <hr>
                                        <h5 class="text-primary"><input type="text" readonly  class="form-control form-control-primary" id="pawntot" name="rvtot" ></h5>
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                    <!--final values -->
                    <!--button-->
                        <div class="d-flex flex-row-reverse">
                        <div class="p-2">
                                <button type="submit" class="btn btn-success" name="save" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                 Submit Invoice
                                </button>
                        </div>
                        <!-- <div class="p-2">
                                <button type="submit" class="btn btn-inverse" name="estimate" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                 Estimate
                                </button>
                        </div> -->
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
    </div>
    <!--form end -->

    <!-- Modal for redeem items -->
    <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
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
                            
                            <th>Category</th>
                            <th>Name</th>
                            <th>Karat</th>
                            <th>Weight</th>
                            <th>Price</th>
                            <th>As/price</th>
                            <th>Action</th>
                            <!-- onclick='addredeemitem($item->pawnid,\"$item->pawn_cat\",\"$item->pawn_item\",\"$item->pawnit_wei\",\"$item->pawnit_karat\")' -->
                            
                        </thead>
                        <tbody>
                        <?php   
                        foreach($result_redeem as $item){
                        echo"<tr>
                                <td>$item->pawnid</td>                                                                                                                                                             
                                <td>$item->pawn_cat</td> 
                                <td>$item->pawn_item</td>
                                <td>$item->pawnit_karat</td>
                                <td>$item->pawnit_wei</td>
                                <td>$item->pawnit_mv_new<td>
                                <td>$item->asv_rate</td>
                                    <td><div class='btn-group btn-group-sm' style='float: none;'>
                                    <button  class='tabledit-edit-button btn btn-primary waves-effect waves-light' onclick='addredeemitem($item->pawnid,\"$item->pawn_cat\",\"$item->pawn_item\",\"$item->pawnit_wei\",\"$item->pawnit_karat\",\"$item->pawnit_mv_new\",\"$item->asv_rate\")' style='float: none;margin: 5px;'><span class='icofont icofont-plus'></span></button >
                                       
                                        
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
     <!-- Modal for redeem items end -->

   <!--modal to add new category start -->
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
                        <form action="itemadd.php" method="POST" id="savecus">
                            <div class=" col-sm-10 form-group row">
                            <label for="" class="col-form-label">Category</label>
                            <input type="text"  id="cat_name" class="form-control" placeholder="Create new category" name="cat">
                            </div>
                            
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>

   <!--modal to add new category end -->

   <!--modal to add new item start -->
   <div class="modal fade" id="item-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Itemname</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5></h5>
                <form action="itemadd.php" method="POST">
                    <div class=" col-sm-10 form-group row">
                    <label for="" class="col-form-label">Item Name</label>
                    <input type="text" class="form-control" placeholder="Create new category" name="cat">
                    </div>
                    <div class=" col-sm-10 form-group row">
                        <label for="" class="col-form-label">Item Name</label>
                        <select name="" id="" class="form-control " >
                            <option value="">--Select Category</option>
                            <?php foreach($result_item as $item)
                                echo"<option value='$item->cat_id'>$item->cat_name</option>";

                            ?>
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

   <!--modal to add new item end -->






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
 $("#pawnitem1").html("");

 //cos we have list of items to be displayed, we use a loop
 $.each(d,function(i,x){
     console.log(i);//loop number
     console.log(x);//data
     $("#pawnitem1").append("<option value='"+d[i].itemname_id+"'> "+d[i].item_name+" </option>");
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


 //fuctions to execute when the add button is clicked
 $("#btnadd").click(function(){
        //alert("done");
        goldrate();
        additem();
        clear();
        mv_total();
        rv_total();
        weight_total()
        int_tot();
        pawnloan();

        
    });
    //get latest gold rate 
    var vari;
    var poundrate;
    function goldrate(){
         
          vari=<?=$result->rate_gram?>;
          poundrate=<?=$result->rate_pound ?>;
        }

     //add items in the dynamic table
    function additem(){ 
        //validation to make sure allthe text boxes are filled

    if($("#pint").val()=='' || $("#ploantime").val()==''){
        alert("Fill interest and time");
    }else{
    
     if($(".pcat").val()=='' || $(".pitem").val()==''|| $(".pkar").val()==''  || $("#pwei").val()==''){
         alert("Fill all the fields in item info");
     } 
     else{

        name;
        cat;
        pawn_category=$(".pcat").val();
        pawn_item=$(".pitem").val();
        pawn_purity=$(".pkar").val();
        pawn_weight=$("#pwei").val();
        pawn_int=$("#pint").val();
        pawn_time=$("#ploantime").val();
        
        goldrate1= vari; //gold rate for 24k per gram
        rate_purity_gram = (parseFloat(goldrate1* pawn_purity)/24).toFixed(2); //gold  rate for certain purity
        marketval = (rate_purity_gram* parseFloat(pawn_weight)).toFixed(2); //pergram*wieght of item
        goldrate_asv=(poundrate-(poundrate*10/100)).toFixed(2);
        goldrate_asv_purity_gram= ((parseFloat(goldrate_asv* pawn_purity)/24)/8).toFixed(2);
        assesedval=(goldrate_asv_purity_gram*pawn_weight).toFixed(2);
        intval=(assesedval*(pawn_int/100)*(pawn_time/12)).toFixed(2);
        redeemval=(parseFloat(assesedval)+parseFloat(intval)).toFixed(2);

        $("#itembody").append("<tr><td><input type='hidden' name='cat[]' value='"+pawn_category +"' required>"+cat +"</td><td><input type='hidden' name='item[]' value='"+ pawn_item+"' required>"+name+"</td><td><input type='hidden' name='kar[]' value='"+ pawn_purity+"' required>"+pawn_purity +"</td><td><input type='hidden' class='w_tot' name='wt[]' value='"+ pawn_weight +"' required>"+ pawn_weight +"</td><td><input type='hidden' name='mkv[]' class='m_tot' value='"+ marketval+"' required>"+ marketval+"</td><td><input type='hidden' name='rvt[]' class='r_tot' value='"+ assesedval+"' required>"+ assesedval+"</td><td><input type='hidden' name='pint[]' class='pawnint' value='"+intval +"' required>"+intval +"</td><td><input type='hidden' name='ploan[]' value='"+redeemval +"' required>"+redeemval +"</td><td><button type='button'  onclick='delete_row(this)' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td></tr>");
       
        }
      }
    }   
    function clear(){
        $(".pcat").val(""); 
        $(".pitem").val("");
        $(".pkar").val("");
        $("#pwei").val("");
        $(".pcat").focus("");

    }

    function addredeemitem(pawnid,i_cat,i_name,i_weight,i_purity,i_mkval,i_asval){
      

     
     

        // $("#itembody").append(" <tr><td><input type='hidden' name='cat[]' value='"+i_cat +"' required>"+i_cat +"</td><td><input type='hidden' name='item[]' value='"+ i_name+"' required>"+i_name+"</td><td><input type='hidden' name='kar[]' value='"+ i_purity+"' required>"+i_purity +"</td><td><input type='hidden' class='w_tot' name='wt[]' value='"+ i_weight +"' required>"+ i_weight +"</td><td><input type='hidden' name='mkv[]' class='m_tot' value='"+ marketval+"' required>"+ marketval+"</td><td><input type='hidden' name='rvt[]' class='r_tot' value='"+ assesedval+"' required>"+ assesedval+"</td><td><input type='hidden' name='pint[]' class='pawnint' value='"+intval +"' required>"+intval +"</td><td><input type='hidden' name='ploan[]' value='"+redeemval +"' required>"+redeemval +"</td><td><td><button type='button'  onclick='delete_row(this)' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td></tr>");
        $("#itembody").append(" <tr><td><input type='hidden' name='cat[]' value='"+i_cat +"' required>"+i_cat +"</td><td><input type='hidden' name='item[]' value='"+ i_name+"' required>"+i_name+"</td><td><input type='hidden' name='kar[]' value='"+ i_purity+"' required>"+i_purity +"</td><td><input type='hidden' class='w_tot' name='wt[]' value='"+ i_weight +"' required>"+ i_weight +"</td><td><input type='hidden' name='mkv[]' class='m_tot' value='"+i_mkval+"' required>"+ i_mkval+"</td><td><input type='hidden' name='mkv[]' class='m_tot' value='"+i_asval+"' required>"+ i_asval+"</td></tr>");

    }
//function to add category
    $("#savecus").on("submit",function(e){
                e.preventDefault();
                var cusfrm = $("#savecus"); // Modal Id
                    v=$("#cat_name").val();
                $.post("../item/categoryhandle.php", cusfrm.serialize(), function(res) {

                     alert(res);
                    $("#category-Modal").modal('hide'); // hide after submited
                   $("#catlist").append("<option value='+res+' >"+v+"</option>");
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

    //calculate total of market value
    function mv_total(){
       
        mvtot=0;
        var m=$(".m_tot");
        $.each(m,function(i,item){
            mvtot=mvtot+parseFloat($(m[i]).val());
            mvtot.toFixed(1);
        })
        $("#mtot").val(mvtot.toFixed(3));
    }
    //calculate total gold weight
    function weight_total(){
       
        weighttot=0;
        var w=$(".w_tot");
        $.each(w,function(i,item){
            weighttot= weighttot+parseFloat($(w[i]).val());
            weighttot.toFixed(1);
        })
        $("#wtot").val(weighttot.toFixed(3));
    }

    //calculate total of redeemed value 
    function  rv_total(){
        rvtot=0;
        var r=$(".r_tot");
        $.each(r,function(i,item){
            rvtot=rvtot+ parseFloat($(r[i]).val());//as the class is inside the text box we have to use textbox
            rvtot.toFixed(2);
        })
        $("#rtot").val(rvtot.toFixed(3));

   
    }
    //calculate total interest
    function int_tot(){
        interest=0;
        var r=$(".pawnint");
        $.each(r,function(i,item){
            interest=interest+ parseFloat($(r[i]).val());//as the class is inside the text box we have to use textbox
            interest.toFixed(2);
        })
        $("#inttot").val(interest.toFixed(3));

    }
    //calculate total loan
    function pawnloan(){
        loan=rvtot+interest;
        $("#pawntot").val(loan.toFixed(3));


    }
    function delete_row(x){
        $(x).parent().parent().remove();
        mv_total()
        weight_total();
        rv_total();
        int_tot();
        pawnloan();

    }
    
    
       
     

     //calculate due date
     $("select.ploantime").change(function(){
    var time = $(this).children("option:selected").val();

    
    var date=$("#pawndate").val(); //get the value from  textbox
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
       
        today = mm+'/'+dd+'/'+yy;
        console.log(today);
        $("#pawnduedt").val(today);

 });



  //check calculation
    //validation to type numbers for weight
     //validation to make sure u have added item list
     //display interest
     //delete
     //unable to display loan again when we change period or select interest and then select
   

</script>