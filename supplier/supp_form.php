<?php
include ("supplier.php");

$sup4=new supplier();
if(isset($_POST["firstnm"])){
    $sup4->sup_firstname=$_POST["firstnm"];
    $sup4->sup_lastname=$_POST["lastnm"];
    $sup4->sup_nic=$_POST["nic"];
    $sup4->sup_comnm=$_POST["compname"];
    $sup4->sup_comadd=$_POST["addcom"];
    $sup4->sup_mob1=$_POST["mob1"];
    $sup4->sup_mob2=$_POST["mob2"];
    $sup4->sup_add=$_POST["add"];
    $sup4->sup_city=$_POST["city"];
    $sup4->sup_mail=$_POST["mail"];

    $sup4->addsupp();


}



include_once ("../files/top.php");

?>
<!-- Success-color Breadcrumb card start -->
<div class="card borderless-card">
            <div class="card-block success-breadcrumb">
                <div class="breadcrumb-header">
                    <h2>Supplier Information</h2><br>
                    
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
                                                   
<div class="row">
        <div class="col-lg-12 col-xl-6">
            <!-- Date card start -->
            <div class="card">
                <div class="card-header">
                    <p class="f-24 f-w-700" class ><font color="blue">Personal Details</font></p>
                </div>
                <div class="card-block">

                    <form method="POST"  action="supp_form.php">
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label" name="">First Name</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text"  data-mask="" class="form-control" name="firstnm" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Last Name</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text"  data-mask="" class="form-control" name="lastnm" required>
                            </div>
                        </div><br>
                        
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label" name="">NIC</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text"  data-mask="" class="form-control" name="nic" pattern="[0-9]{9}V" required>
                            </div>
                        </div>
                        
                    <p class="f-18 f-w-200" class ><font color="blue">Company Details</font></p>
                
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label" >Company</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text"  data-mask="" name="compname" class="form-control">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Address</label>
                            </div>
                            
                            <div class="col-sm-9">
                            <textarea rows="2" cols="5" class="form-control" placeholder="Default textarea" name="addcom"></textarea>
                        </div>
                        </div>
                        
                       
                    <!-- </form>-->
                </div>
            </div>
            <!-- Date card end -->
        </div>
        <div class="col-lg-12 col-xl-6">
            <!-- Time card start -->
            <div class="card">
                <div class="card-header">
                <p class="f-24 f-w-700" class ><font color="blue">Contact Details</font></p>
                    
                    
                </div>
                <div class="card-block">
                   
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">Telephone 1</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text"  data-mask="999-999-9999" class="form-control mob_no" name="mob1" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Telephone 2</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text"  data-mask="999-999-9999" class="form-control mob_no" name="mob2">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Address</label>
                            </div>
                            
                            <div class="col-sm-9">
                            <textarea rows="2" cols="5" class="form-control" placeholder="Default textarea" name="add"></textarea>
                        </div>
                        </div><br>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label" name="">City</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text"  data-mask="" class="form-control" name="city" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="col-form-label">Email</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" data-mask="" name="mail" pattern="[a-z]+[a-z0-9]*@[a-z].[a-z]" required>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-5">
                                
                            </div>
                            <div class="col-sm-3">
                            <button type="submit"class="btn btn-success" > Submit</button>
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