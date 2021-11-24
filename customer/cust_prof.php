<?php

include ("cust.php");
//create an object for the class
$cust1=new cust();
$res_cust=$cust1->get_all_cus_byid($_GET['edit']);



include_once ("../files/top.php");
?>

        <div class="row">
        
            <div class="col-lg-12">
            <div class="">
        <a href='../customer/managecus.php' type="button btn-sm btn-inverse" class="btn btn-primary m-r-10 m-b-5"><i class=""></i>Back </a>
    <!-- <button type="button" class="btn btn-primary"><i class="icofont icofont-ui-messaging"></i> Message</button> -->
         </div>
                <div class="cover-profile">
                    <div class="profile-bg-img">
                        <img class="profile-bg-img img-fluid" src="..\files\assets\images\user-profile\bg-img1.jpg" alt="bg-img">
                        <div class="card-block user-info">
                            <div class="col-md-12">
                                <div class="media-left">
                                    <!-- <a href="#" class="profile-image">
                                        <img class="user-img img-radius" src="..\files\assets\images\user-profile\user-img.jpg" alt="user-img">
                                    </a> -->
                                </div>
                                <div class="media-body row">
                                    <div class="col-lg-12">
                                        <div class="user-title">
                                            <h2><?=$res_cust->cust_first_nm?></h2>
                                            <!-- <span class="text-white"><?=$a->st_prof?></span> -->
                                        </div>
                                    </div>
                                    <div>
                                        <div class="pull-right cover-btn">
                                            <a href='../customer/form2.php?edit=<?=$res_cust->cust_id ?>' type="button" class="btn btn-primary m-r-10 m-b-5"><i class="icofont icofont-plus"></i>Edit  </a>
                                            <!-- <button type="button" class="btn btn-primary"><i class="icofont icofont-ui-messaging"></i> Message</button> -->
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   <!--profile cover end-->
   <div class="row">        <!--whole page-->
        <div class="col-lg-12"> <!--whole page-->
            <div class="card">
                <!-- carh header-->
                <div class="card-header">
                    <h5 class="card-header-text">About Me</h5>
                </div>
                <!--end of div card-->
                <!--start of card bloock-->

                <div class="card-block">
                    <div class="view-info">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="general-info">
                                    <div class="row">
                                        <div class="col-lg-12 col-xl-6">
                                            <div class="table-responsive">
                                                <table class="table m-0">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">First Name</th>
                                                            <td><span><?=$res_cust->cust_first_nm?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Last Name</th>
                                                            <td><span><?=$res_cust->cust_last_nm?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Gender</th>
                                                            <td><?=$res_cust->cust_gen?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Birth Date</th>
                                                            <td><?=$res_cust->cust_dob?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">NIC</th>
                                                            <td><?= $res_cust->cus_nic ?></td>
                                                        </tr>
                                                        <!--<tr>
                                                            <th scope="row">Location</th>
                                                            <td>New York, USA</td>
                                                        </tr>-->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end of table col-lg-6 -->
                                        <div class="col-lg-12 col-xl-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Email</th>
                                                            <td><a href="#!"><span><?=$res_cust->cust_mail?> </span></a></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Mobile Number 1</th>
                                                            <td><?=$res_cust->cust_mob1?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Mobile Number 2</th>
                                                            <td><?=$res_cust->cust_mob2?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Address</th>
                                                            <td><?=$res_cust->cust_add?></td>
                                                        </tr>
                                                        <!--<tr>
                                                            <th scope="row">Website</th>
                                                            <td><a href="#!">www.demo.com</a></td>
                                                        </tr>-->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end of table col-lg-6 -->
                                    </div>
                                    <!-- end of row -->
                                </div>
                                <!-- end of general info -->
                            </div>
                            <!-- end of col-lg-12 -->
                        </div>
                        <!-- end of row -->
                    </div>


                </div>
                 <!--end of card bloock-->
            </div>
        </div>
    <div>    




<?php
include_once ("../files/bottom.php");
?>