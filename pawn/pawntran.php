<?php
    include_once ("../staff/staff.php");//for dropdown
    $s1=new staff();
    $r=$s1->get_all();

    include_once ("../customer/cust.php");
    $c1=new cust();   
    $t=$c1-> get_all_cus();

    include_once ("pawn.php");
    $pt2=new pawn();
    $r1=$pt2->getall_pawn();

    //get latest gold rate
    include_once ("../goldrate/rate.php");
    $rate=new rate();
    $result=$rate->get_today_rate();

   
    
    //empty($_POST['filter_stdt']) || empty($_POST['filter_endt']) || empty($_POST['filter_id']) || empty($_POST['filter_type']) ||empty($_POST['filter_staff']) || empty($_POST['filter_cus'])

    if(isset($_POST['filter'])){
        
        $r1=$pt2-> get_all_pawnsearch($_POST);
       // print_r( $r1);
        // exit;}
      
    }

    $pt3=new pawn();
    if(isset($_POST['pid'])){
        $pt3->pawn_id=$_POST["pid"];
        $pt3->pawn_dt=$_POST["pexdt"];
        $pt3->pawn_em=$_POST["pexstaff"];
        $pt3->pawn_cus=$_POST["pcus"];
        $pt3->pawn_period=$_POST["pexp"];
        $pt3->pawn_int=$_POST["pexint"];      
        $pt3->pawn_intval=$_POST["pexint_rate"];
        $pt3->pawn_rvtot=$_POST["pexloan"];
        
        $pt3-> insertpawnextend();
        $pt3->updtexten($_POST["pid"]);

    }
    



    
    // $pt3=new pawn();
    // $c= $pt3->get_pawn_id2($_GET['ti']);
    

    include_once ("../files/top.php");
?>

 <!-- Success-color Breadcrumb card start -->
    <div class="card borderless-card">
        <div class="card-block success-breadcrumb">
            <div class="breadcrumb-header">
            <strong>Pawn Transaction</strong>
            <br>
                
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#!">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    
                    <li class="breadcrumb-item"><a href="#!">Pawn Transaction</a>
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
                    <div class="d-flex flex-row-reverse">
                        <div class="p-2">
                                <a href="../pawn/pawninven.php" class="btn btn-inverse" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                Manage Pawn Item
                                </a>
                        </div>
                        <div class="p-2">
                                <a href="../pawn/pawnfrm2.php" class="btn btn-inverse" style="float: right;">
                                <i class="icofont icofont-plus"></i>
                                New Pawn
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end 1 -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card rounded border border-primary" style="">
                                    <div class="class-header"></div>
                                    <div class="card-block">
                                        <!--Start of search filter -->
                                        <form action="pawntran.php" method="POST">
                                            <div class="form-group row">
                                                <div class="col-sm-6 ">
                                                            <label>Start Date:</label>
                                                            <input type="date" class="form-control form-control-default" name="filter_stdt">
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <label>End Date:</label>
                                                    <input type="date" class="form-control form-control-default" name="filter_endt" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3 " id="filter_id">
                                                    <label>Ticket No:</label>
                                                    <input type="text" class="form-control form-control-default" name="filter_id" >
                                                </div>
                                                <div class="col-sm-3 ">
                                                    <label>Customer:</label>
                                                    <select name="filter_cus" id="filter_cus" class="form-control">
                                                    <option selected='selected' value="-1">-- select Role --</option>
                                                    <?php
                                                    foreach($t as $item){
                                                        echo"<option value='$item->cust_id'>$item->cust_first_nm</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 ">
                                                        <label>Transaction Type:</label>
                                                        <select id="filter_type" class="form-control" name="filter_type">
                                                        <option selected='selected' value="-1">-- select Role --</option>
                                                            <option value="NewPawn">New Pawn</option>
                                                            <option value="Extended">Extended</option>
                                                            <option value="Redeemed">Redeemed</option>
                                                            <option value="Expired">Expired</option>
                                                        </select>
                                                </div>
                                                <div class="col-sm-3 ">
                                                        <label>Recieved By:</label>
                                                        <select id=""  class="form-control" name="filter_staff">
                                                            <option selected='selected' value="-1">-- select Role --</option>
                                                            <?php
                                                                foreach($r as $item){
                                                                    
                                                                    echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                </div>
                                                
                                            </div>
                                            <!--button search-->
                                            <div class="form-group row">
                                                <div class="col-sm-10"></div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="btn btn-success m-r-10 m-b-5" name="filter"  >
                                                    <i class="icofont icofont-search" ></i>
                                                    Search
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- END of button search-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End of Search filters -->
                            <input type="hidden" value="Pawn" id="type1">
                            <!--Start of datatable -->
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table  id="basic-btn" class="table table-striped table-bordered no-wrap" >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="th-sm">Customer</th>
                                                <th class="th-sm">Date</th>
                                                <th class="th-sm">Expiry</th>
                                                <th class="th-sm">PawnType</th>
                                                <th class="th-sm">Employee</th>
                                                <th class="th-sm">Loan</th>
                                                <th class="th-sm">Paid</th>
                                                <th class="th-sm">Due</th>
                                                <th class="th-sm">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach($r1 as $item){
                                            echo"   <tr>
                                                <td >$item->pawn_id</td>
                                                <td>".$item->cusname->cust_first_nm."</td>
                                                <td>$item->pawn_dt</td>
                                                <td>$item->pawn_duedt <br> <label class='label label-inverse'> $item->day_remain days </label></td>
                                                <td>$item->pawn_type</td>
                                                <td>".$item->stname->st_firstname."</td>
                                                <td>$item->pawn_rvtot</td>
                                                <td>$item->pawn_paid</td>
                                                <td>$item->pawn_due</td>";
                                            echo'   <td class="dropdown">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right b-none contact-menu">';
                                                        echo"  <a href='ticket.php?di=$item->pawn_id'class='dropdown-item' ><i class='icofont icofont-money'>View Ticket</i></a>";
                                                        echo" <a  class='dropdown-item extend' onclick='pop($item->pawn_id,\"$item->pawn_dt\",\"$item->pawn_duedt\",\"$item->pawn_rvtot\",\"$item->pawn_int\",\"$item->pawn_intval\",\"$item->pawn_avtot\",\"$item->pawn_cus\",\"$item->pawn_paid\",\"$item->pawn_due\")'  data-toggle='modal' data-target='#large-Modal' ><i class='icofont icofont-clock-time'>Extend</i></a>
                                                            <a class='dropdown-item payhistory' onclick='pop($item->pawn_id,\"$item->pawn_dt\",\"$item->pawn_rvtot\",\"$item->pawn_int\",\"$item->pawn_intval\",\"$item->pawn_avtot\",\"$item->pawn_cus\",\"$item->pawn_id\",\"$item->pawn_rvtot\",\"$item->pawn_paid\",\"$item->pawn_due\")' data-toggle='modal' data-target='#payhistorymodal' id='$item->pawn_id'  ><i class='icofont icofont-history'>Payment</i></a>
                                                        <a class='dropdown-item' href='pawnpay.php?pay1=$item->pawn_id'><i class='icofont icofont-eye-alt'></i>Make Payment</a>
                                                        <a class='dropdown-item' ><i class='icofont icofont-ui-delete'></i>Delete invoice</a>
                                                        
                                                    </div>
                                                </td>";
                                            echo"</tr>";
                                            
                                            }  ?>
                                            
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            <!--End of datatable -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal for extend start-->
    <div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Extend Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="card-block border border-dark">
                    <form action="pawntran.php" method="POST" >
                                <h3 class="sub-title" style="color: blue;"><strong>Previous Pawn Info </strong></h3>
                                <div class="row">
                                    <div class="col-sm-2"><label class="col-form-label">Pawn id</label></div>
                                    <div class="col-sm-4"><input type="text" readonly style="border:0;" class="form-control" name="pid" id="pawnid" required></div>
                                    <div class="col-sm-2"><label class="col-form-label"> Customer</label></div>
                                    <div class="col-sm-4"><input type="text" readonly style="border:0;" class="form-control" name="pcus" id="pawncus"  required></div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"><label class="col-form-label">Pawn Date</label></div>
                                    <div class="col-sm-4"><input type="text" readonly style="border:0;" class="form-control" name="" id="pawndate" required></div>
                                    <div class="col-sm-2"><label class="col-form-label">Expiry Date </label></div>
                                    <div class="col-sm-4"><input type="text" readonly style="border:0;" class="form-control" name="" id="exp_date"  required></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"><label class="col-form-label">Total Loan</label></div>
                                    <div class="col-sm-4"><input type="text" readonly style="border:0;" class="form-control" name="" id="tot_loan" required></div>
                                    <div class="col-sm-2"><label class="col-form-label" >Paid amount</label></div>
                                    <div class="col-sm-4"><input type="text" readonly style="border:0;" class="form-control" name="" id="paidamt"required></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"><label class="col-form-label">Intrest Value <span id="int_rate"></span></label></div>
                                    <div class="col-sm-4"><input type="text" readonly style="border:0;" class="form-control" name="" id="int_val" required></div>
                                    <div class="col-sm-2"><label class="col-form-label">Amount Due</label></div>
                                    <div class="col-sm-4"><input type="text" readonly style="border:0;" class="form-control" name="" id="int_due" required></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"><label class="col-form-label" >Assesed Value</label></div>
                                    <div class="col-sm-4"><input type="text" readonly style="border:0;" class="form-control" name="" id="asv_tot" required></div>
                                    <div class="col-sm-2"><label class="col-form-label">Interst Due</label></div>
                                    <div class="col-sm-4"><input type="text" readonly style="border:0;" class="form-control" id="asv_due" name="" required></div>
                                </div>
                    </div>
                        <div class="card">
                        
                                <div class="form-group row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label">Recieved By</label>
                                        
                                        <select id="" class="form-control form-control-primary" name="pexstaff">
                                        <?php foreach ($r as $item){
                    
                                                    echo "<option value='$item->st_id'>$item->st_firstname</option>	";
                                                }?>

                                        </select>   
                                    
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Rate/interest</label>
                                        <input type="number" class="form-control form-control-primary " id="intrate" value=<?=$result->pawnrate ?> name="pexint">
                                            
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Extended Date</label>
                                        <input type="date" id="pexdate" class="form-control form-control-primary" value="<?php echo date('Y-m-d');?>" name="pexdt" >
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label" >Extended Period</label>
                                        <select  class="form-control form-control-primary pexperiod" name="pexp" id="period">
                                        <option value="3">3 months</option>
                                        <option value="6">6 months</option>
                                        <option value="12">12 months</option>
                                        </select>
                                            
                                    </div>
                                    
                            </div>
                                <div class="row">
                                <div class="col-sm-3">
                                <label class="col-form-label">Due Date</label>
                                        <input type="text"  class="form-control form-control-primary " name="pexduedt" id="pexduedate" required>
                                                
                                        
                                        </div>
                                    <!-- <div class="col-sm-3">
                                        <label class="col-form-label">Interest</label>
                                        
                                        <select id="" class="form-control form-control-primary pexinterest" name="pexint">
                                        <option value="0">0</option>	
                                        <option value='12'>12%</option>	
                                        <option value="14">14%</option>	        

                                        </select>
                                    </div> -->
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Interest Value</label>
                                        <input type="text" readonly  class="form-control form-control-primary" id="newint" name="pexint_rate" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">New Loan Amt</label>
                                        <input type="text" readonly class="form-control form-control-primary" id="newloan" name="pexloan" required>
                                    </div>
                                    
                                </div>
                            
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
    <!-- modal for extend end-->

    <!-- modal for payment history start-->
    <div class="modal fade" id="payhistorymodal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Payment History</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="table-resposive">
                            <table class="table" >
                                <tbody class="tablebody">
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><label for="">TOTAL: Rs.<span  id="rvtot"></span></td>
                                        <td><label for="">PAID:  Rs.</label><span id="paid"></span></td>
                                        <td><label for="">DUE:  Rs.</label><span id="due"></span></td>
                                    </tr>
                                </tfoot>
                                
                            </table>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- modal for payment history end-->
<?php
    include_once ("../files/bottom_dt.php");
?>


<script>



//automtically calculate due date for extend
$("select.pexperiod").change(function(){
var time = $(this).children("option:selected").val();

    
    var date=$("#pexdate").val(); //get the value from  textbox
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
    // console.log(dd);
    // console.log(mm);
    // console.log(yy);
    today = mm+'/'+dd+'/'+yy;
    console.log(today);
    $("#pexduedate").val(today);

    interest=$("#intrate").val()
    timeloan=time;
    int_value=$("#int_val").val();
    paid_amt=$("#paid").html();
    total_amt=$("#rvtot").html();

    //remaining loan amount to be paid
    amount_afterint=parseFloat(paid_amt-int_value);
    //remainingloan-interest
    remain_loan=parseFloat(total_amt-amount_afterint);
    // new  interest 
    int_remainloan=(parseFloat(remain_loan*(interest/100)*(timeloan/12))).toFixed(2);
    //new loan amount
    newloan=(parseFloat(remain_loan)+parseFloat(int_remainloan)).toFixed(2);
   
    $("#newint").val(int_remainloan);
    $("#newloan").val(newloan);

 
});

//if an input with the interest value is changed execute the below functions


//pop($item->pawn_id,\"$item->pawn_dt\",\"$item->pawn_duedt\",\"$item->pawn_rvtot\",\"$item->pawn_int\",\"$item->pawn_intval\",\"$item->pawn_avtot\",\"$item->pawn_cus\",\"$item->pawn_paid\",\"$item->pawn_due\")'

//calculations for extend
function pop(id,date,duedate,rvtot,int,intval,avtot,cus,paid,due){

$("#pawndate").val(date);
$("#tot_loan").val(rvtot);
$("#int_rate").html(int);
$("#int_val").val(intval);
$("#asv_tot").val(avtot);
$("#pawncus").val(cus);
$("#pawnid").val(id);
//$("#rvtot").html(v9);
$("#paidamt").val(paid);
$("#int_due").val(due);
$("#exp_date").val(duedate);

if(paid>intval){
    console.log("Interest paid");
}else{
    console.log("not eligible");
}


console.log(intval);
}

//get payment history details
$(".payhistory").click(function(){
    //get id
    var pawn_id1=$(this).attr("id");
    console.log(pawn_id1);
    var pawntype=$("#type1").val();
    console.log(pawntype);
    //get data  using ajax
    $.get("../files/ajax.php?type=get_payment_bytypeid",{pawnid:pawn_id1,paytype:pawntype},function(data){
        console.log(data);
        var d=JSON.parse(data);
        $(".tablebody").html(""); 

        $.each(d,function(i,x){
            console.log(i);//loop number
            console.log(x);//data 
            $(".tablebody").append("<tr><td>"+d[i].pay_id+"</td><td>"+d[i].pay_date+"</td><td>Rs."+d[i].pay_amount+"</td><tr>")
        });
    });

});
</script>
