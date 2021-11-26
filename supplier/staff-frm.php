<?php


include_once ("../files/top.php");
?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
            <div class="card-block success-breadcrumb">
                <div class="breadcrumb-header">
                    
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#!">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        
                        <li class="breadcrumb-item"><a href="#!">Add Staff</a>
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
            <div class="d-flex flex-row-reverse">
                <div class="p-2">
                        <a href="" class="btn btn-inverse" style="float: right;">
                        <i class="icofont icofont-plus"></i>
                         Manage Supplier
                        </a>
                </div>
                 
            </div>
        </div>
    </div>
</div>
<!-- top button end -->
<div class="page-body">
<form method="POST"  action="staff-frm.php" id="" enctype="multiport/form-data">
    <div class="card col-sm-12">
        <div class="row">
            <div class="card-body col-sm-4 ">
               
            <p class="f-24 f-w-700" class ><font color="blue">PERSONAL INFO</font></p>
                    <div class="form-group">
                        <label for="" class="col-form-label">First Name</label>
                         <input type="text" class="form-control" value="<?=$st->st_firstname ?>" name="firstnm" required>
                        <label for="" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" value="<?=$st->st_lastname ?>"class="form-control" name="lastnm" required>
                        <label for="" class="col-form-label">Date of birth</label>
                        <input type="date" class="form-control" value="<?=$st->st_dob?>" name="dob" required>
                        <label for="" class="col-form-label">NIC/Passport</label>
                        <input type="text" class="form-control" name="nic" id="staff-nic" pattern="[0-9]{9}[V]" onblur="checknic()" value="<?=$st->st_nic?>" required>
                        <div class="col-form-label text-danger" id="nic_check" style="display:none;">Sorry, that nic taken. Try
                                                            another?
                                </div>
                        <label for="" class="col-form-label">Gender</label><br>
                        <div class="radio radio-inline">
                            <label>
                                <input type="radio" name="gen1" class="" value="Male" <?php if($st->st_gen=="Male"){echo "checked";}?> >
                                Male
                            </label>
                        </div>
                        <div class="radio radio-inline">
                            <label>
                                <input type="radio" name="gen1" class="" value="Female" <?php if($st->st_gen=="Female"){ ?> checked="checked"<?php } ?>>
                            
                                Female
                            </label>
                        </div>
                    </div>
               
                </div>
            <div class="card-body col-sm-4 ">
            <p class="f-24 f-w-700" class ><font color="blue">CONTACT INFO</font></p>
                <div class="form-group">
                    <label for="" class="col-form-label">Telephone</label>
                        <input type="text" class="form-control mob_no" name="mob1" value="<?=$st->st_mob1 ?> data-mask="999-999-9999">
                    <label for="" class="col-form-label">Email</label>
                    <input type="email" class="form-control" id="staff-mail" value="<?=$st->st_mail ?>" name="mail" onblur="checkmail()">
                    <div class="col-form-label text-danger" id="mailcheck" style="display:none;">Sorry, that email taken. Try
                                                            another?
                                </div>
                                <!-- <span class="error" style="color: red; display: none">* Sorry, that email taken. Try
                                                            another?</span> -->
                    <label for="" class="col-form-label">Address</label>
                    <textarea rows="5" cols="5" class="form-control" placeholder="Default textarea"  name="add"> <?php if(isset($_GET['edit'])) { echo "$st->st_add";} ?></textarea>
                    <label for="" class="col-form-label">Staff image</label>
                    <input type="file" class="form-control" name="staffpic">
                </div>
            
            </div>
            <!-- </form>-->
            <?php
                                   
            if(isset($_GET["edit"])){
            echo"  <input type='hidden'  class='form-control' value='".$_GET['edit'] ."' name='uid' required>";
            }
            

            ?>
            <div class="card-body col-sm-4 ">
            <p class="f-24 f-w-700" class ><font color="blue">LOGIN INFO</font></p>
            <div class="form-group">
                    <!-- <label for="" class="col-form-label">Profession</label>
                    <select name="" id="" class="form-control" name="proffesion">
                    <option value=""></option>
                        <option value="General Manager" name="proffesion" <?php if( $st->st_prof== 'General Manager') { ?> selected="selected"<?php } ?> >General Manager</option>
                        <option value="Sales Person" name="proffesion" <?php if( $st->st_prof== 'Sales Person') { ?> selected="selected"<?php } ?>>Sales Person</option>
                        <option value="Pawn Broker" name="proffesion" <?php if( $st->st_prof== 'Pawn Broker') { ?> selected="selected"<?php } ?>>Pawn Broker</option>
                    </select> -->
                    <label for="" class="col-form-label">Usertype</label>
                    <select name="" id="" class="form-control"></select>
                    <label for="" class="col-form-label">Username</label>
                    <input type="text" class="form-control">
                    <label for="" class="col-form-label">Password</label>
                    <input type="password" class="form-control">
                    <label for="" class="col-form-label" onblur="confirm()">Confirm password</label>
                    <input type="password" class="form-control">
                </div>
            </div>
        </div>
        

    </div>
    <!-- bottom button start  -->
    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-6">
            <button type="submit" id="btnsubmit" class="btn btn-success btn-block" > <i class="icofont icofont-plus"></i>Submit</button>
            </div>
            <div class="col-sm-6">
                <button  type="reset" class="btn btn-danger btn-block"><i class="icofont icofont-user-alt-3"></i>Cancel</button>
            </div>
        
        </div>
        </div>

       <!-- bottom button end -->
</form>
</div>

<?php
include_once ("../files/bottom.php");

?>

<script>
function checkmail(){
    let x=$("#staff-mail").val();
    console.log(x);
    $.get("../files/ajax.php?type=mail_staff&stmail="+x, "" ,function(data){
        console.log(data);
        var tmp=JSON.parse(data);
        if(tmp.st_id>0){
            $("#mailcheck").show();
            // $(".error").css("display", "none");
          }
            
       
         }
    );
}
function checknic(){
    let nic=$("#staff-nic").val();
    console.log(nic);
    $.get("../files/ajax.php?type=check_nic_staff&stnic="+nic, "" ,function(data){
        console.log(data);
        var tmp=JSON.parse(data);
        if(tmp.st_id>0){
            console.log("hi");
            $("#nic_check").show();
            // $(".error").css("display", "none");
          }else{
              console.log("error");
          }
            
       
         }
    );
}

function confirm(){
    alert("hi");
    var passsword=$("#password").val();
    var confirmpass=$("#confirm").val();

    console.log(passsword);
    console.log(confirmpass);
    // if(passsword !=confirmpass){
    //     alert("Passwords do not match!");
    //     return false;
    // }
    // return true;
    
}

// $("#confirm").blur(function()
//{
//     alart("hi");
//     var passsword=$("#password").val();
//     var confirmpass=$("#confirm").val();

//     console.log(passsword);
//     console.log(confirmpass);
//     if(passsword !=confirmpass){
//         alert("Passwords do not match!");
//         return false;
//     }
//     return true;

// }
//);
   

//$(".error").css("display", "none");

</script>