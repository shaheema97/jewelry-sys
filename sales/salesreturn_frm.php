 <?php
include_once ("../sales/sales.php");
$sales2=new sales();
//$result_sales=$sales2->getsales_by_id($_GET['view']);

include_once ("../sales/salesitem.php");
$salesitem2=new salesitem(); 
//$result_sales2=$salesitem2->getitem_by_salesid($_GET['view']);

include_once ("../staff/staff.php");
$sales_staff=new staff();


include_once ("../sales/salesreturn.php");
$sreturn=new salesreturn();

include_once ("../sales/salesreturnitem.php");
$sreturnitem=new salesreturnitem();

include_once ("../customer/account.php");
$cus_account=new account();

include_once ("../stock/stock.php");
$returnstock=new stock();

if(isset($_POST["salesid"])){
    $sreturn->salesreturn_salesid=$_POST["salesid"];
    $sreturn->salereturn_emp=$_POST["returnstaff2"];
    $sreturn->salesreturn_date=$_POST["returndt"];
    $sreturn->salesreturn_amount=$_POST["ref_tot"];
    $cus_account->account_cusid=$_POST["cust"];
    $cus_account->account_credit=$_POST["ref_tot"];

    $return_salesreturnid=$sreturn->insertsalesreturn();
    $sreturnitem->insert_saleitems($return_salesreturnid);
    $returnstock-> insertstock_minus($_POST["salesid"]);
    $sales2-> update_nett_tot($_POST["salesid"],$_POST["ref_tot"]);
    $cus_account->insert_creditamount();

   
    
}else{

$result_sales=$sales2->getsales_by_id($_GET['view']);

$result_sales2=$salesitem2->getitem_by_salesid($_GET['view']);

$result_staff1=$sales_staff->get_all();
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
                        
                        <li class="breadcrumb-item"><a href="../sales/salesreturn_frm.php">Sales Return</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
<!-- Success-color Breadcrumb card end -->
<div class="page-body">
    <!--start 1 -->
    <div class="row"> 
        <div class="col-sm-12">
            <div class="class-header">
                <div class="d-flex ">
                <div class="mr-auto p-2">
                    <a href="../sales/managesales.php" class="btn btn-sm btn-inverse" style="float: right;">
                    <i class="fa fa-angle-double-left"></i>
                    Back
                    </a>
                </div>
                    <!-- <div class="p-2">
                            <a href="managesales.php" class="btn btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            Manage Sales
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="order_frm.php" class="btn btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            New Orders
                            </a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
     <!--end 1 -->
     <!-- card start-->
     <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                </div>
                    <div class="card-block">
                        <form action="salesreturn_frm.php" method="POST">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label">Customer</label>
                                    <input type="text" class="form-control" readonly="" value="<?=$result_sales->cust_name->cust_first_nm ?>">
                                </div>
                                
                                    
                                    <input type="hidden" name="cust" class="form-control" readonly="" value="<?=$result_sales->sales_cus ?>">
                              
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label">Invoice No</label>
                                    <input type="text" name="salesid" class="form-control" readonly="" value=" <?=$result_sales->sales_id ?>"">
                                </div>
                                    
                                <div class="col-sm-4">
                                    <label for="" class="col-form-label">Sales Date</label>
                                    <input type="text"  class="form-control" readonly="" value="<?=$result_sales->sales_date?>">
                                </div>
                            
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-1">
                                    <label for="" class="col-form-label">Recieved by:</label>
                                   </div>
                                <div class="col-sm-5">
                                <select id="" class="form-control" name="returnstaff2" placeholder="">
                                        <option value=""  style="font-color:'grey'" disabled selected hidden >Recieved By</option>
                                        <?php
                                            foreach($result_staff1 as $item){
                                                echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                            }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-1"> 
                                    <label for="" class="col-form-label">Return Date:</label>
                                   </div>
                                <div class="col-sm-5">
                                    <input type="date" class="form-control" name="returndt" value="<?php echo date('Y-m-d');?>">
                                </div>
                            </div>
                            <!-- card block-->
                            <div class="card-block border border-primary">
                                <h5 class="sub-title">Item Info</h5>
                                    <div class="">
                                        <table class="table table-responsive table-xstable-condensed ">
                                            <thead>
                                                <th>Sales/ID</th>
                                                <th>Item/ID</th>
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <!-- <th>Purity</th>
                                                <th>G.Weight</th> -->
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>Total</th>
                                                <th>Return/Qty</th>
                                                <th>Action</th>
                                            
                                            </thead>
                                            <tbody>
                                            
                                            </tbody>
                                            <?php
                                foreach($result_sales2 as $item){
                                echo " <tr>
                                <td class='text-center'>$item->saleitem_id</td>
                                <td class='text-center'>$item->salesitem_name</td>
                                <td class='text-center'>".$item->itemname->name_item."</td>
                               
                                <td class='text-center' id='itemqty'>$item->salesitem_qty</td>
                                
                                
                                <td class='text-center'>$item->salesitem_price</td>
                                <td class='text-center'>$item->salesitem_discount</td>
                                <td class='text-center'>$item->salesitem_nettprice</td>
                              <td><input type='text' id='num' onkeyup='check_quan()'  class='form-control qty' style='width:100px'><div class='col-form-label text-danger' class='' id='namecheck1' style='display:none;'>*Invalid
                  </div></td>
                                <td><button type='button' id='' class='tabledit-edit-button btn-mini btn-primary waves-effect waves-light add'  onclick='additem($item->saleitem_id,\"$item->salesitem_name\" ,\"".$item->itemname->name_item."\",\"$item->salesitem_qty\",\"$item->salesitem_price\",\"$item->salesitem_discount\",\"$item->salesitem_nettprice\",this)' style='float: none;margin: 5px;'><span class='icofont icofont-plus'></span></button ><button type='button' id=''  class='tabledit-edit-button btn-mini btn-danger waves-effect waves-light delete' onclick='' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button ></td>
                               </tr>";
                                    
                                }
                                    ?>
                                                
                                            <tfoot>
                                            <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <th><strong>Net Total:</strong></th>
                                                    <td><?=$result_sales->sales_nettot?></td>
                                            </tr>
                                            
                                            </tfoot>
                                        </table>
                                    </div>
                            </div>

                            <!-- card block-->
                            <div class="card-block ">
                                <h5 class="sub-title"> Retur Item Info</h5>
                                    <div class="">
                                        <table class="table table-responsive table-xs ">
                                            <thead>
                                                <th>SalesID</th>
                                                <th>ItemID</th>
                                                <th>Name</th>
                                                <th>Item/Price</th>
                                                <th>Return/Qty</th>
                                                
                                                <th>Return/Price</th>
                                               
                                                <th>Action</th>
                                            
                                            </thead>
                                            <tbody id="itembody">
                                            
                                            </tbody>
                                                
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                        <!-- final values-->
                                        <table class="table table-responsive  table-xs invoice-table invoice-total">
                                            <tbody>
                                                <tr>
                                                    <th>Refund Total :</th>
                                                    <td><input type="text" readonly  class="form-control form-control-primary form-control-sm" id="refund" name="ref_tot" ></td>
                                                </tr>
                                                <tr>
                                                    <th>Sub Total :</th>
                                                    <td><input type="text" readonly  class="form-control form-control-primary form-control-sm" id="final" name="" ></td>
                                                </tr>
                                                <!-- <tr>
                                                    <th>Taxes () :</th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>Discount () :</th>
                                                    <td></td>
                                                </tr> -->
                                                <!-- <tr class="text-info">
                                                    <td>
                                                        <hr>
                                                        <h5 class="text-primary">Total :</h5>
                                                    </td>
                                                    <td>
                                                        <hr>
                                                        <h5 class="text-primary">$4827.00</h5>
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                        <!--final values -->
                                    </div>
                                    <!--button-->
                                    <div class="d-flex flex-row-reverse">
                                        <div class="p-2">
                                                <button type="submit" class="btn btn-success" style="float: right;">
                                                <i class="icofont icofont-plus"></i>
                                                Submit Invoice
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
                            </div>

                            <!-- card block-->

                        </form>
                    </div>

            </div>
        </div>
     </div>

     <!-- card end-->

</div>

<?php
 include_once ("../files/bottom.php");
?>
<script>

$(".delete").hide();

function additem(saleid,itemid,itemname,qty,itemprice,discount,nettprice,n1){
    // console.log(saleid);
    // console.log(itemid);
    // //console.log(itemname);
    quantity=$(n1).parent().parent().find(".qty").val();
if(quantity==''){
    alert("Please fill quantity");
}
else{
    unitprice=parseFloat(itemprice)/parseFloat(qty);
   type="sales";
   quantity=$(n1).parent().parent().find(".qty").val();
  // cal_qty();
   finalprice=parseFloat(unitprice)*parseFloat(quantity)
   
    $("#itembody").append(" <tr><td><input type='hidden' name='saleid[]' value='"+saleid +"' required>"+saleid +"</td><input type='hidden' name='proc_type[]' value='sales' required><td><input type='hidden' name='item[]' value='"+ itemid+"' required>"+itemid+"</td><td><input type='hidden' name='itm_quan[]' value='"+ itemname+"' required>"+itemname +"</td><td><input type='hidden' class='w_tot' name='price[]' value='"+ unitprice +"' required>"+ unitprice +"</td><td><input type='hidden' name='disc[]' class='' value='"+quantity+"' required>"+ quantity+"</td><td><input type='hidden' name='nettprice[]' class='nett_tot' value='"+finalprice+"' required>"+finalprice+"</td><td><button type='button'  onclick='delete_row(this)' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td></tr>");
   
    $(n1).parent().find(".add").hide();
      
    $(n1).parent().find(".delete").show();
 y=n1;

    refund_total();
    sub_tot();
    console.log(unitprice);
    console.log(finalprice);
    console.log(quantity);
    
    //change_button();
}
    
}
function change_button(){
   
}
//function to validate function


//function to calculate refund total
function refund_total(){
       
       ref_tot=0;
       var m=$(".nett_tot");
       $.each(m,function(i,item){
        ref_tot=ref_tot+parseFloat($(m[i]).val());
        ref_tot.toFixed(1);
       })
    //    console.log(ref_tot);
       $("#refund").val(ref_tot.toFixed(3));
   }

function sub_tot(){

    total=<?=$result_sales->sales_nettot?>;
    net_total=total-ref_tot;
    // console.log(net_total);
    $("#final").val(net_total.toFixed(3));
}


function delete_row(x){
        $(x).parent().parent().remove();
        refund_total();
        sub_tot();
       $(y).parent().find(".add").show();
      
    $(y).parent().find(".delete").hide();
    $("#num").val("");
 

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
// $("#itemqty").keyup(function(){

// });
    
    

</script>
