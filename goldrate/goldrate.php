<?php
 include_once ("../files/top.php");


?>
<div class="page-body">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
            <H3>GOLD RATE</H3>
            </div>

            <form action="goldrate.php" method="POST">
                <div class="form-group ">
                    <div class="col-sm-3"><label for="" class="col-form-label">XAU RATE TO LKR (1 ounce):</label></div>
                    <div class="col-sm-4"><input type="text" class="form-control"  id="xaulkrrate"></div>
                    <div class="col-sm-3"><label for="" class="col-form-label">XAU RATE TO LKR (1 gram):</label></div>
                    <div class="col-sm-4"><input type="text" class="form-control"  id="rate_gram"></div>
                    <div class="col-sm-3"><label for="" class="col-form-label">XAU RATE TO LKR (8 gram/1 pound):</label></div>
                    <div class="col-sm-4"><input type="text" class="form-control"  id="rate_pound"></div>
                    <!-- <div class="col-sm-2"><label for="" class="col-form-label">LKR RATE :</label></div>
                    <div class="col-sm-2"><label for="" class="col-form-label">XAU:</label></div> -->
                    
                    <div class="col-sm-4"> 
                    <button type="button" class="btn btn-success"  id="convert" style="float: right;">
                        <i class="icofont icofont-plus"></i>
                        CONVERT
                    </button>
                    <button type="submit" class="btn btn-success"  id="convert" style="float: right;">
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
   console.log("success");
   let x=$("#xaulkrrate").val();
    console.log(x);
    $.get("https://api.exchangerate.host/convert?from=XAU&to=INR", "" ,function(data){
        console.log(data);
       // var tmp=JSON.parse('{"success":true,"query":{"from":"XAU","to":"LKR","amount":1},"info":{"rate":361787.632619},"historical":false,"date":"2020-09-19","result":361787.632619}');
       // console.log(tmp);
        // console.log(data.info.rate);
        //the above 3 codes are not necessary because its alreadt in json forat
        var rate=data.info.rate;

        console.log(rate);
        $("#xaulkrrate").val(rate.toFixed(3));
        ratepergram=rate/31;
        console.log(ratepergram);
        $("#rate_gram").val(ratepergram.toFixed(3));
        ratepound=ratepergram*8;
        $("#rate_pound").val( ratepound.toFixed(3));
   
        });


});
</script>