<?php
include_once ("../staff/staff.php");//for dropdown
$s1=new staff();
$result_staff=$s1->get_all();

include_once ("../customer/cust.php");
$c1=new cust();
$result_cust=$c1-> get_all_cus();

include_once ("../sales/sales.php");
$sales2=new sales();
$result_sales=$sales2-> getall_sales();

if(isset($_POST['filter'])){
    $result_sales=$sales2->search_sales($_POST['filter']);
}

 include_once ("../files/top.php");

?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
    <div class="card-block success-breadcrumb">
        <div class="breadcrumb-header">
            <h2></h2><br>
            
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#!">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                
                <li class="breadcrumb-item"><a href="#!">Manage sales</a>
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
                            <a href="manageorders.php" class="btn btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            Manage Orders
                            </a>
                    </div>
                    <div class="p-2">
                            <a href="buygold2.php" class="btn btn-inverse" style="float: right;">
                            <i class="icofont icofont-plus"></i>
                            New Sales
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--end 1 -->
    <div class="row"> <!--start 2 -->
        <div class="col-sm-12">
            <div class="card rounded border border-primary">
                <div class="class-header">
                    
                </div>
                <div class="card-block">
                <form action="../sales/managesales.php" method="POST">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="" class="col-form-label"><strong>Start Date</strong></label>
                            <input type="date" class="form-control"  name="sales_srtdt">
                        </div>
                        <div class="col-sm-6">
                            <label for="" class="col-form-label"><strong>End Date</strong></label>
                            <input type="date" class="form-control" name="sales_endt">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Sales id</label>
                            <input type="text" class="form-control" name="salesid">
                        </div>
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Customer</label>
                            <select id="" class="form-control" name="filter_sales_cust">
                                <option value="-1" selected='selected'></option><?php
                                foreach($result_cust as $item){
                                                
                                                echo"<option value='$item->cust_id'>$item->cust_first_nm</option>";
                                            }
                                        ?>
                                
                                            
                                
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="" class="col-form-label">Recieved by</label>
                            <select  id="" class="form-control" name="filter_sales_emp">
                                <option value="-1" selected='selected'></option>
                                <?php
                                foreach($result_staff as $item){
                                                
                                            echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                                echo"<option value='$item->st_id'>$item->st_firstname</option>";
                                            }
                                        ?>
                                    

                                    
                                
                            </select>
                        </div>
                    
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10"></div>
                        <div class="col-sm-2">
                            <button type="submit" name="filter" class="btn btn-success m-r-10 m-b-5"  >
                            <i class="icofont icofont-search" ></i>
                            Search
                            </button>
                        </div>
                    
                    </div>
                </form>
                
                </div>
            </div>
        </div>
    </div> <!--end 1 -->
    <!-- .................................................................................  -->
    <input type="hidden" value="Sales" id="type1">
    <!-- ................................................................................. -->
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table  id="basic-btn" class="table table-striped table-bordered nowrap">
                <thead>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>SalesDate</th>
                    <th>Staff</th>
                    <th>Total Price</th>
                    <th>AmountPaid</th>
                    <th>Amount Due</th>
                    <th>Action</th>

                    <!-- <th>Price</th> -->
                    
                </thead>
                <tbody>
                <?php
                foreach($result_sales as $item){
                    echo"<tr>
                        <td>$item->sales_id</td>
                        <td>".$item->cust_name->cust_first_nm."</td>
                        <td>$item->sales_date</td>
                        <td>".$item->emp_name->st_firstname."</td>

                        <td>$item->sales_nettot</td>
                        <td>$item->sales_paid_amt</td>
                        <td>$item->sales_due_amt</td>
                        ";

                        echo'   <td class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                        <div class="dropdown-menu dropdown-menu-right b-none contact-menu">';
                          echo"  <a href='../sales/salesinvoice.php?view=$item->sales_id' class='dropdown-item' ><i class='icofont icofont-edit'>View Invoice</i></a>";
                          echo"
                            <a class='dropdown-item' href='../sales/salespay.php?view2=$item->sales_id'><i class='icofont icofont-eye-alt'></i>Make Payment</a>
                            <a class='dropdown-item' href='../sales/salesreturn_frm.php?view=$item->sales_id'><i class='icofont icofont-eye-alt'></i>Sales Return</a>
                            <a class='dropdown-item payhistory'  data-toggle='modal' data-target='#payhistorymodal' id='$item->sales_id' href=''><i class='icofont icofont-eye-alt'></i>Payment History</a>
                        </div>
                    </td>

                        

                    </tr>";
                }
                ?>


                </tbody>
            </table>
        </div>
    </div>
<!-- modal for payment history  -->
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
<!-- modal for payment history -->


</div>



<?php
include_once ("../files/bottom_dt.php");
?>

<script>
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
        // $(".tablebody").html(""); 

        $.each(d,function(i,x){
            console.log(i);//loop number
            console.log(x);//data
            $(".tablebody").append("<tr><td>"+d[i].pay_id+"</td><td>"+d[i].pay_date+"</td><td>Rs."+d[i].pay_amount+"</td><tr>")
        });
    });

});


</script>