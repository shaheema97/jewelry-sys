<?php 
include ("rate.php");
$obj_rate=new rate();

if(isset($_POST['goldrate_gram'])){
    $obj_rate->rate_gram=$_POST['goldrate_gram'];
    $obj_rate->rate_pound=$_POST['goldrate_pound'];
    $obj_rate->pawnrate=$_POST['add_rate'];
    $obj_rate->insert_rate();

    header("location:../dashboard/admindashoard.php" );
}

include_once ("top_j-pro.php");


?>



    <!-- Page body start -->
    <div class="page-body">
    

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Gold Rate</h2>
                        <span>Get the latest gold rate with the click of the button and update the gold price for the day</span>

                    </div>
                    <div class="card-block">
                    
                        <div class="wrapper wrapper-640 j-forms"  >
                        <div class="j-unit"><br><button class="btn btn-primary btn-block" id="convert">CLICK TO GET LATEST GOLD RATE</button></div>
                            
                        <form action="rate_form.php" method="post" id="j-forms" novalidate="">
                            
                                <div class="content">
                                
                                    <div class="divider-text gap-top-20 gap-bottom-45">
                                        <span>Today's Gold Exchange Rate</span>
                                    </div>
                                    <!-- start comma apostrophe -->
                                    <div class="j-row">
                                        <div class="j-unit">
                                            <label class="j-label ">Date</label>
                                            <div class="input">
                                                <label class="icon-right " for="coma">
                                                    <i class="fa fa-calendar"></i>
                                                </label>
                                                <input type="text" id="date" class="currency">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- end comma apostrophe -->
                                    <!-- start period space -->
                                    <div class="j-row">
                                    
                                        <div class="span6 unit">
                                            
                                            <div class="input">
                                            <label class="j-label">XAU/USD</label>        
                                                <input type="text" id="xauusdrate" class="currency" data-a-sign="$">
                                            </div>
                                        </div>
                                        
                                            
                                        <div class="span6 unit">
                                            
                                            <div class="input">
                                            <label class="j-label">USD/LKR</label>
                                                <input type="text" id="usdlkrrate" class="currency" data-a-sign="$">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="j-row">
                                        <div class="">
                                            <label class="j-label ">Gold rate (1 ounce)</label>
                                            <div class="input">
                                                <label class="icon-right" for="coma">
                                                    <i class="fa fa-usd"></i>
                                                </label>
                                                <input type="text" id="rate" class="currency" data-a-sign="$">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- end period space -->
                                    <div class="divider-text gap-top-20 gap-bottom-45">
                                        <span>FINAL GOLD RATE</span>
                                    </div>
                                    <!-- start dollar yen -->
                                    <div class="j-row">
                                        <div class="span6 unit">
                                        <label class="j-label col-form-label">Pawn Rates</label>
                                            <div class="input ">
                                            <input name="int_rate" id="others">
                                                

                                            </div>
                                        </div>
                                        <div class="span6 unit">
                                            <label class="j-label col-form-label">Interest Rates</label>
                                            <div class="input ">
                                            <input name="add_rate" id="others">
                                                

                                            </div>
                                        </div>
                                    </div>
                                    <!-- end dollar yen -->
                                    <!-- start euro pound -->
                                    <div class="j-row">
                                    
                                    
                                        <div class="span6 unit">
                                            <label class="j-label">Goldrate(per gram)</label>
                                            <div class="input">
                                                <input type="text" class="currency" name="goldrate_gram" id="rate_gram" data-a-sign="€ ">
                                            </div>
                                        </div>
                                        <div class="span6 unit">
                                            <label class="j-label">Goldrate(per sovereign)</label>
                                            <div class="input">
                                                <input type="text" class="currency"  name="goldrate_pound" id="rate_pound" data-a-sign="£ ">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success btn-block" id="submit">SUBMIT</button>
                                    
                                </div>
                                <!-- end /.content -->
                                <!-- <div class="footer">
                                    
                                   
                                </div> -->
                                <!-- end /.footer -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body end -->
<?php 
include_once ("bottom_j-pro.php");


?>
<script>

$.ajaxSetup({ cache: false });

$("#convert").click(function(){
    getxau_lkr();
    calculate_goldrate();

 });

    function getxau_lkr(){
   console.log("success");
   let x=$("#xaulkrrate").val();
    console.log(x);
    $.get("https://api.exchangerate.host/convert?from=XAU&to=USD", "" ,function(data){
        console.log(data);
       
        ratexau_usd=data.info.rate;
        ratedate=data.date;
        console.log(ratedate);

        console.log(ratexau_usd);
      
        $("#xauusdrate").val(ratexau_usd.toFixed(3));
        $("#date").val(ratedate);

       
   
        });
        $.get("https://api.exchangerate.host/convert?from=USD&to=LKR", "" ,function(data){
        console.log(data);
      
        rateusd_lkr=data.info.rate;

        console.log(rateusd_lkr);
        $("#usdlkrrate").val(rateusd_lkr.toFixed(3));

        var xau_usd=$("#xauusdrate").val();
        var usd_lkr=$("#usdlkrrate").val();
        var goldrate=usd_lkr* xau_usd;
        var goldrate_gram= goldrate/31;
        var goldrate_pound=goldrate_gram*8;
        console.log( goldrate_pound);
        $("#rate_gram").val(goldrate_gram.toFixed(3));
        $("#rate_pound").val(goldrate_pound.toFixed(3));

       
        });}

        function calculate_goldrate(){
       
        
            console.log("echooooooo");

        //  $("#xauusdrate").val(ratexau_usd);
        // ratepergram=rate/31;
        // console.log(ratepergram);
        // $("#rate_gram").val(ratepergram.toFixed(3));
        // ratepound=ratepergram*8;
        // $("#rate_pound").val( ratepound.toFixed(3));
   
        }
        




</script>
