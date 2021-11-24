
<?php
include ("cust.php");
//create an object for the class
$cust1=new cust();

//fetch values frm thee fom and assign in to the object
if(isset($_GET['edit']))
{
    // $res_cust=$cust1->get_all_cus_byid($_GET['edit']);
    $cust1=$cust1->get_all_cus_byid($_GET['edit']);

}


if(isset($_POST["firstnm"]))
{
    $cust1->cust_first_nm=$_POST["firstnm"];
    $cust1->cust_last_nm=$_POST["lastnm"];
    $cust1->cust_add=$_POST["add"];
    $cust1->cust_gen=$_POST["gen"];
    $cust1->cust_dob=$_POST["dob"];
    $cust1->cust_mob1=$_POST["mob1"];
    $cust1->cust_mob2=$_POST["mob2"];
    $cust1->cus_nic=$_POST["nic"];
    $cust1->cust_mail=$_POST["mail"];
        
    if(isset($_POST["uid"]))
    {
        $cust1->edit_cust($_POST["uid"]);//call function to edit data
        echo '<script>
        setTimeout(function() {
            swal({
                title: "Updated successful!",
                text: "Cusomer information  is updated!",
                type: "success"
            }, function() {
                window.location = "../customer/managecus.php";
            });
            }, 1000);
            </script>';
        
    }
    else
    { $cust1->addcust(); //call function to save data}
    echo '<script>
    setTimeout(function() {
        swal({
            title: "Inserted successful!",
            text: "New Customer is added!",
            type: "success"
        }, function() {
            window.location = "../customer/managecus.php";
        });
        }, 1000);
        </script>';
           
        

   // $res_cust=$cust1->get_all_cus_byid($_GET['edit']);

        }
}





include_once ("../files/top.php");
?>

<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
            <div class="card-block success-breadcrumb">
                <div class="breadcrumb-header">
                    <h2>Customer Information</h2><br>
                    
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#!">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        
                        <li class="breadcrumb-item"><a href="#!">Add Customer</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
<!-- Success-color Breadcrumb card end -->

<div class="card">
    <div class="d-flex">
    <div class="mr-auto p-2">
                <a href="../customer/managecus.php" class="btn btn-sm btn-inverse" style="float: right;">
                <i class="fa fa-angle-double-left"></i>
                Back
                </a>
    </div>
    </div>
                                                   
<div class="row">
        <div class="col-lg-12 col-xl-6">
            <!-- Date card start -->
            <div class="card">
                <div class="card-header">
                    <p class="f-24 f-w-700" class ><font color="blue">Personal Details</font></p>
                </div>
                <div class="card-block">

                    <form method="POST"  action="form2.php" id="custadd">
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label" name="">First Name</label>
                                <!-- <span class="error" style="color: red; display: none">* Input letters only</span> -->
                                        
                            </div>
                            <div class="col-sm-9">
                                <input type="text" placeholder="ex:Ann" pattern="[a-zA-Z0-9\s]+" data-mask=""class="form-control" value="<?=$cust1->cust_first_nm?>" name="firstnm" required>
                               
                                        
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Last Name</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" pattern="[a-zA-Z\s]+" palceholder="ex:Frank"  data-mask="" class="form-control" value="<?=$cust1->cust_last_nm?>" name="lastnm" required>
                              
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Date Of Birth</label>
                            </div>
                            <div class="col-sm-9">
                            <input class="form-control" type="date" name="dob" value="<?=$cust1->cust_dob?>" required>
                            </div>
                        </div> <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Gender</label>
                            </div>
                            <div class="col-sm-9">
                            <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="gen" value="Male" <?php if($cust1->cust_gen=="Male"){echo "checked";}?> required>
                                            Male
                                        </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="gen" value="Female" <?php if($cust1->cust_gen=="Female"){echo "checked";}?> required>
                                            
                                            Female
                                        </label>
                                    </div>
                            </div>
                        </div> <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label" >NIC/Passport</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text"  data-mask="" placeholder="897426534V" name="nic" id="cus-nic" value="<?=$cust1->cus_nic?>" class="form-control" pattern="[0-9]{9}V" onblur="checknic()"  required>
                                <div class="col-form-label" id="niccheck" style="display:none;">Sorry, that NIC taken. Try
                                                            another?
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <!-- <div class="col-sm-3">
                                <label class="col-form-label">NIC/Passport Image</label>
                            </div>
                            <div class="col-sm-9">
                            <input type="file" class="form-control" name="nicpic" >
                            </div> -->
                        </div>
                    <!-- </form>-->
                </div>
            </div>
            <!-- Date card end -->
        </div>
        <?php
                                   
                                   if(isset($_GET["edit"])){
                                   echo"  <input type='hidden'  class='form-control' value='".$_GET['edit'] ."' name='uid' required>";
                                   }
            ?>                       
        <div class="col-lg-12 col-xl-6">
            <!-- Time card start -->
            <div class="card">
                <div class="card-header">
                <p class="f-24 f-w-700" class ><font color="blue">Contact Details</font></p>
                    
                    
                </div>
                <div class="card-block">
                    <form method="POST" action="form_s.php">
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">Telephone 1</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text"   class="form-control mob_no" data-mask="999-999-9999" value="<?=$cust1->cust_mob1?>" name="mob1" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Telephone 2</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text"  data-mask="999-999-9999" class="form-control mob_no" value="<?=$cust1->cust_mob2?>" name="mob2">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Email</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="mail" class="form-control" placeholder="ex:ann@gmail.com" id="cus-mail" name="mail" value="<?=$cust1->cust_mail?>" onblur="checkmail()" onkeyup="checkmail()" >
                                <div class="col-form-label" id="mailcheck" style="display:none;">Sorry, that email taken. Try
                                                            another?
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Address</label>
                            </div>
                            
                            <div class="col-sm-9">
                            <textarea rows="5" cols="5" class="form-control" placeholder="Default textarea"  name="add"><?php if(isset($_GET['edit'])) { echo "$cust1->cust_add";} ?></textarea>
                        </div>
                        </div><br>
                       <!-- <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Email</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="cus-mail" name="mail" onblur="chekmail()">
                                <div class="col-form-label" id="mailcheck" style="display:none;">Sorry, that email taken. Try
                                                            another?
                                </div>
                            </div>
                        </div><br>-->
                        <div class="row">
                            <div class="col-sm-5">
                                
                            </div>
                            <div class="col-sm-3">
                            <button type="submit" id="sub1" class="btn btn-success" onclick="sub()" > Submit</button>
                            </div>
                            
                            <div class="col-sm-3">
                            <button class="btn btn-primary" type="reset">Reset</button>
                            
                            </div>
                            
                        </div><br>
                    
                    
                        
                    </form>
                </div>
            </div>
            <!-- Time card end -->
        </div>
    </div>
    </div>
	
	<?php 
    include_once ("../files/bottom.php");
?>

	
    <script>

//email validation
function checkmail(){
    let x=$("#cus-mail").val();
    var len=x.length;
   
    $.get("../customer/ajax.php?type=check_cusmail&ee="+x, "" ,function(data){
        //alert(data);
        var tmp=JSON.parse(data);
        if(tmp.cust_id>0){
            $("#mailcheck").show();}
            $("#mailcheck").fadeOut("6000");
       
        }
    );
 }

function checknic(){
    let x=$("#cus-nic").val();
    $.get("../customer/ajax.php?type=check_nic&nic_cus="+x, "" ,function(data){
        //alert(data);
        var tmp=JSON.parse(data);
        if(tmp.cust_id>0){
            $("#niccheck").show();
            $("#niccheck").fadeOut("6000");}
        
       
        }
    );  
   
    //alert(x);
  }

  function IsNumeric(e) {
            console.log("hi");
            var keycode = e.which ? e.which : e.keyCode
            if (!(keycode == 8 || keycode == 46) && (keycode < 48 || keycode > 57) ) {
            $(".error").css("display", "inline");
            
            return false;
          }else{
            $(".error").css("display", "none");

          }
        }

        function Isalpha(e) {
            var keycode = e.which ? e.which : e.keyCode
            if ((keycode > 64 && keycode < 91) || (keycode > 96 && keycode < 123) || keycode == 8 || keycode == 32){
            $(".error").css("display", "inline");
            
            return false;
          }else{
            $(".error").css("display", "none");

          }
        }

        
        function Isalpha1(e) {
            var charCode = e.which ? e.which : e.charCode
            if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || charCode == 32) {
            $(".error1").css("display", "inline");
            
            return false;
          }else{
            $(".error1").css("display", "none");

          }
        }



  function checkmail2(){
    let x=$("#cus-mail").val();
    var len=x.length;
    $("#mailcheck").show();
   if(len>1){
        //alert(x);
    $.get("../customer/ajax.php?type=check_cusmail&ee="+x, "" ,function(data){
        //alert(data);
        var tmp=JSON.parse(data);
        if(tmp.cust_id>0){
            $("#mailcheck").show();}
        
       
        }
    );
   }}


   function checknic2(){
    let x=$("#cus-nic").val();
    var len=x.length;
    $("#niccheck").show();
    //alert(x);
   if(len>1){
    $.get("../customer/ajax.php?type=check_nic&nic_cus="+x, "" ,function(data){
        //alert(data);
        var tmp=JSON.parse(data);
        if(tmp.cust_id>0){
            $("#niccheck").show();}
        
       
        }
    );
   }}
</script>


