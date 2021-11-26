<?php
include ("rate.php");
$obj_rate=new rate();

if(isset($_POST['goldrate_gram'])){
    $obj_rate->rate_gram=$_POST['goldrate_gram'];
    $obj_rate->rate_pound=$_POST['goldrate_pound'];
    $obj_rate->insert_rate();
}



 include_once ("../files/top.php");


?>
<div class="page-body">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
            <H3>GOLD RATE</H3>
            </div>

            <form action="goldrate2.php" method="POST">
                <div class="form-group ">
                    <div class="col-sm-3"><label for="" class="col-form-label">XAU RATE TO USD :</label></div>
                    <div class="col-sm-4"><input type="text" class="form-control"  id="xauusdrate"></div>
                    <div class="col-sm-3"><label for="" class="col-form-label">USD RATE TO LKR :</label></div>
                    <div class="col-sm-4"><input type="text" class="form-control"  id="usdlkrrate"></div>
                    <div class="col-sm-3"><label for="" class="col-form-label">GOLD RATE (1 OUNCE):</label></div>
                    <div class="col-sm-4"><input type="text" class="form-control"  id="rate"></div>
                    <div class="col-sm-3"><label for="" class="col-form-label">GOLD RATE (1 gram):</label></div>
                    <div class="col-sm-4"><input type="text" class="form-control" name="goldrate_gram" id="rate_gram"></div>
                    <div class="col-sm-3"><label for="" class="col-form-label">GOLD RATE (1 pound):</label></div>
                    <div class="col-sm-4"><input type="text" class="form-control" name="goldrate_pound" id="rate_pound"></div>
                    <!-- <div class="col-sm-2"><label for="" class="col-form-label">LKR RATE :</label></div>
                    <div class="col-sm-2"><label for="" class="col-form-label">XAU:</label></div> -->
                    
                    <div class="col-sm-4"> 
                    <button type="button" class="btn btn-success"  id="convert" style="float: right;">
                        <i class="icofont icofont-plus"></i>
                        CONVERT
                    </button>&nbsp
                    <button type="submit" class="btn btn-success"  id="submit" style="float: right;">
                        <i class="icofont icofont-plus"></i>
                        SUBMIT
                    </button>
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

        console.log(ratexau_usd);
      
        $("#xauusdrate").val(ratexau_usd.toFixed(3));
       
   
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
        $("#rate_gram").val(goldrate_gram);
        $("#rate_pound").val(goldrate_pound);

       
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