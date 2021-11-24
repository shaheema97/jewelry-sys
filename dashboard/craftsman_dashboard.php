<?php

session_start();
if(!isset($_SESSION["user"])){
    header("location:../login/loginfrm.php");
    exit;

    
   // echo $res_pawn;

}
include_once ("../pawn/pawn.php");
    $pawn1=new pawn();
    $res_pawn=$pawn1->ticket();

include_once ("../sales/order.php");
$order1=new order();
$res_order=$order1->order_month();
$order3=new order();
$resultorder=$order3-> getall_order();

include_once ("../workshop/workshop.php");
$workshop2=new workshop();
$res_ws=$workshop2->getall_workshop();



include_once ("../sales/sales.php");
$sales7=new sales();
//$re_sales=$sales7->();

// include_once ("../customer/cust.php");
// $cust5=new cust();
// $res_cus=$cust5->cust_month();

include_once ("../notification/notification.php");
    $notify2=new notification();
    $notify3=new notification();

    $result_not=$notify2->getmsg_byid($_SESSION["user"]["u_id"]);
  // print_r($result_not);
  $result_rows=$notify3->count($_SESSION["user"]["u_id"]);
  //echo($result_rows);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Adminty - Premium Admin Template by Colorlib </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="..\files\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="..\files\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- radial chart.css -->
    <link rel="stylesheet" href="..\files\assets\pages\chart\radial\css\radial.css" type="text/css" media="all">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\feather\css\feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\jquery.mCustomScrollbar.css">
     <!-- label -->
     <link rel="stylesheet" type="text/css" href="..\sales\label.css">
</head>
<!-- Menu sidebar static layout -->

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="index-1.htm">
                            <img class="img-fluid" src="..\files\assets\images\logo.png" alt="Theme-Logo">
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-bell"></i>
                                        <span class="badge bg-c-pink"><?=$result_rows ?></span>
                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <?php
                                    foreach($result_not as $item){
                                        echo'<li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="..\files\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                            <div class="media-body">';
                                                
                                             echo"   <p class='notification-msg'>$item->not_msghead</p>";
                                            echo'    <span class="notification-time"></span>
                                            </div>
                                        </div>
                                    </li>';
                                    }
                                    ?>
                                </ul>
                                </div>
                            </li>
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-message-square"></i>
                                        <span class="badge bg-c-green">3</span>
                                    </div>
                                </div>
                            </li>
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="..\files\assets\images\avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                        <span>John Doe</span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="#!">
                                                <i class="feather icon-settings"></i> Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="user-profile.htm">
                                                <i class="feather icon-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="email-inbox.htm">
                                                <i class="feather icon-mail"></i> My Messages
                                            </a>
                                        </li>
                                        <li>
                                            <a href="auth-lock-screen.htm">
                                                <i class="feather icon-lock"></i> Lock Screen
                                            </a>
                                        </li>
                                        <li>
                                            <a href="../login/logout.php">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sidebar chat start -->
            <div id="sidebar" class="users p-chat-user showChat">
                <div class="had-container">
                    <div class="card card_main p-fixed users-main">
                        <div class="user-box">
                            <div class="chat-inner-header">
                                <div class="back_chatBox">
                                    <div class="right-icon-control">
                                        <input type="text" class="form-control  search-text" placeholder="Search Friend" id="search-friends">
                                        <div class="form-icon">
                                            <i class="icofont icofont-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-friend-list">
                                <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius img-radius" src="..\files\assets\images\avatar-3.jpg" alt="Generic placeholder image ">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Josephin Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe" data-toggle="tooltip" data-placement="left" title="Lary Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="..\files\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Lary Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice" data-toggle="tooltip" data-placement="left" title="Alice">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="..\files\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alice</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="4" data-status="online" data-username="Alia" data-toggle="tooltip" data-placement="left" title="Alia">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="..\files\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alia</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="5" data-status="online" data-username="Suzen" data-toggle="tooltip" data-placement="left" title="Suzen">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="..\files\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Suzen</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat start-->
            <div class="showChat_inner">
                <div class="media chat-inner-header">
                    <a class="back_chatBox">
                        <i class="feather icon-chevron-left"></i> Josephin Doe
                    </a>
                </div>
                <div class="media chat-messages">
                    <a class="media-left photo-table" href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="..\files\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                    </a>
                    <div class="media-body chat-menu-content">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                </div>
                <div class="media chat-messages">
                    <div class="media-body chat-menu-reply">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                    <div class="media-right photo-table">
                        <a href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="..\files\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                        </a>
                    </div>
                </div>
                <div class="chat-reply-box p-b-20">
                    <div class="right-icon-control">
                        <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                        <div class="form-icon">
                            <i class="feather icon-navigation"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                <nav class="pcoded-navbar">
                    <div class="pcoded-inner-navbar main-menu">
                        <div class="pcoded-navigatio-lavel">Navigation</div>
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                    <span class="pcoded-mtext">Dashboard</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="../dashboard/craftsman_dashboard.php">
                                            <span class="pcoded-mtext">Default</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>

                           
                        </ul>
                        
                        <ul class="pcoded-item pcoded-left-item">
                            <li class=" ">
                                <!-- <a href="../customer/managecus.php">
                                    <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                                    <span class="pcoded-mtext">Customer management</span>
                                    
                                </a> -->
                            </li>
                            <li class=" ">
                                <!-- <a href="../staff/managestaff.php">
                                    <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                                    <span class="pcoded-mtext">Staff management</span>
                                    
                                </a> -->
                            </li>
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="fa fa-diamond "></i></span>
                                    <span class="pcoded-mtext">Item Management</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class=" ">
                                        <a href="../item/managecategory.php">
                                            <span class="pcoded-mtext">Category</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../item/manageitemname.php">
                                            <span class="pcoded-mtext">Item Names</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../item/manageitem.php">
                                            <span class="pcoded-mtext">Item inventory</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                            <li class="pcoded-hasmenu">
                                <!-- <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="fa fa-usd"></i></span>
                                    <span class="pcoded-mtext">Sales</span>
                                </a> -->
                                <ul class="pcoded-submenu">
                                    <!-- <li class=" ">
                                        <a href="../sales/manageorders.php">
                                            <span class="pcoded-mtext">Sales order</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../sales/managesales.php">
                                            <span class="pcoded-mtext">Sales Invoice</span>
                                        </a>
                                    </li> -->
                                    <!-- <li class=" ">
                                        <a href="../sales/salesreturn_frm.php">
                                            <span class="pcoded-mtext">Sales Return</span>
                                        </a>
                                    </li> -->

                                </ul>
                            </li>
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span>
                                    <span class="pcoded-mtext">Work Shop</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="../workshop/manage_workshop.php">
                                            <span class="pcoded-mtext">Order Submission</span>
                                        </a>
                                    </li>
                                    
                                    
                                </ul>
                            </li>
                            <!-- <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="fa fa-balance-scale "></i></span>
                                    <span class="pcoded-mtext">Pawning</span>
                                    
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="../pawn/pawntran.php">
                                            <span class="pcoded-mtext">Pawn transaction</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../pawn/pawninven.php">
                                            <span class="pcoded-mtext">Pawn inventory</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->
                           
                            <!-- <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="feather icon-command"></i></span>
                                    <span class="pcoded-mtext">Purchase</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class=" ">
                                        <a href="../supplier/managesup.php">
                                            <span class="pcoded-mtext">Supplier Management</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../purchase/manage_purchorder.php">
                                            <span class="pcoded-mtext">Purchase Orders</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../purchase/manage_purchinvoice.php">
                                            <span class="pcoded-mtext">Purchase ivoice</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="../purchase/purchasereturn_frm.php">
                                            <span class="pcoded-mtext">Purchase Returns</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li> -->
                        </ul>
                        <!-- <div class="pcoded-navigatio-lavel">Forms</div> -->
                        <!-- <ul class="pcoded-item pcoded-left-item">
                            <li class=" ">
                                <a href="../oldgold/manageoldgold.php">
                                    <span class="pcoded-micon"><i class="feather icon-cpu"></i></span>
                                    <span class="pcoded-mtext">Old Gold Buys</span>
                                    
                                </a>
                            </li>
                            
                            
                            <li class="../estimate/manage_est.php">
                                <a href="form-masking.htm">
                                    <span class="pcoded-micon"><i class="fa fa-sort-numeric-desc "></i></span>
                                    <span class="pcoded-mtext">Estimations</span>
                                </a>
                            </li>
                           
                            
                      
                        </ul> -->
                            
                    </div>
                </nav>
             
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <div class="row">

                                            <!-- statustic-card start -->
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-yellow text-white">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <p class="m-b-5">New Customer</p>
                                                                <h4 class="m-b-0"></h4>
                                                            </div>
                                                            <div class="col col-auto text-right">
                                                                <i class="feather icon-user f-50 text-c-yellow"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-green text-white">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <p class="m-b-5">Income</p>
                                                                <h4 class="m-b-0">Rs5,852</h4>
                                                            </div>
                                                            <div class="col col-auto text-right">
                                                                <i class="feather icon-credit-card f-50 text-c-green"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-pink text-white">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <p class="m-b-5">Ticket</p>
                                                                <h4 class="m-b-0"><?=$res_pawn ?></h4>
                                                            </div>
                                                            <div class="col col-auto text-right">
                                                                <i class="feather icon-book f-50 text-c-pink"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-blue text-white">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <p class="m-b-5">Orders</p>
                                                                <h4 class="m-b-0"><?=$res_order ?></h4>
                                                            </div>
                                                            <div class="col col-auto text-right">
                                                                <i class="feather icon-shopping-cart f-50 text-c-blue"></i>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- statustic-card start -->

                                            <!-- statustic-card start -->
                                            <!-- <div class="col-xl-9 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Sales Analytics</h5>
                                                        <span class="text-muted">For more details about usage, please refer <a href="https://www.amcharts.com/online-store/" target="_blank">amCharts</a> licences.</span>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                                                <li><i class="feather icon-trash-2 close-card"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <div id="sales-analytics" style="height: 265px;"></div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-xl-8 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-header-left ">
                                                            <h5>Monthly View</h5>
                                                            <span class="text-muted">For more details about usage, please refer <a href="https://www.amcharts.com/online-store/" target="_blank">amCharts</a> licences.</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-big">
                                                        <div id="sales-analytics" style="height:250px"></div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-xl-4 col-md-12">
                                                <div class="card feed-card">
                                                    <div class="card-header">
                                                        <h5>Feeds</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="row m-b-30">
                                                            <div class="col-auto p-r-0">
                                                                <i class="feather icon-bell bg-simple-c-blue feed-icon"></i>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5">You have 3 pending tasks. <span class="text-muted f-right f-13">Just Now</span></h6>
                                                            </div>
                                                        </div>
                                                        <div class="row m-b-30">
                                                            <div class="col-auto p-r-0">
                                                                <i class="feather icon-shopping-cart bg-simple-c-pink feed-icon"></i>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5">New order received <span class="text-muted f-right f-13">Just Now</span></h6>
                                                            </div>
                                                        </div>
                                                        <div class="row m-b-30">
                                                            <div class="col-auto p-r-0">
                                                                <i class="feather icon-file-text bg-simple-c-green feed-icon"></i>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5">You have 3 pending tasks. <span class="text-muted f-right f-13">Just Now</span></h6>
                                                            </div>
                                                        </div>
                                                        <div class="row m-b-30">
                                                            <div class="col-auto p-r-0">
                                                                <i class="feather icon-shopping-cart bg-simple-c-pink feed-icon"></i>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5">New order received <span class="text-muted f-right f-13">Just Now</span></h6>
                                                            </div>
                                                        </div>
                                                        <div class="row m-b-30">
                                                            <div class="col-auto p-r-0">
                                                                <i class="feather icon-file-text bg-simple-c-green feed-icon"></i>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5">You have 3 pending tasks. <span class="text-muted f-right f-13">Just Now</span></h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- statustic-card start -->

                                            <!-- income start -->
                                            <!-- <div class="col-xl-4 col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Total Leads</h5>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                <li><i class="fa fa-minus minimize-card"></i></li>
                                                                <li><i class="fa fa-refresh reload-card"></i></li>
                                                                <li><i class="fa fa-trash close-card"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <p class="text-c-green f-w-500"><i class="feather icon-chevrons-up m-r-5"></i> 18% High than last month</p>
                                                        <div class="row">
                                                            <div class="col-4 b-r-default">
                                                                <p class="text-muted m-b-5">Overall</p>
                                                                <h5>76.12%</h5>
                                                            </div>
                                                            <div class="col-4 b-r-default">
                                                                <p class="text-muted m-b-5">Monthly</p>
                                                                <h5>16.40%</h5>
                                                            </div>
                                                            <div class="col-4">
                                                                <p class="text-muted m-b-5">Day</p>
                                                                <h5>4.56%</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <canvas id="tot-lead" height="150"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Total Vendors</h5>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                <li><i class="fa fa-minus minimize-card"></i></li>
                                                                <li><i class="fa fa-refresh reload-card"></i></li>
                                                                <li><i class="fa fa-trash close-card"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <p class="text-c-pink f-w-500"><i class="feather icon-chevrons-down m-r-15"></i> 24% High than last month</p>
                                                        <div class="row">
                                                            <div class="col-4 b-r-default">
                                                                <p class="text-muted m-b-5">Overall</p>
                                                                <h5>68.52%</h5>
                                                            </div>
                                                            <div class="col-4 b-r-default">
                                                                <p class="text-muted m-b-5">Monthly</p>
                                                                <h5>28.90%</h5>
                                                            </div>
                                                            <div class="col-4">
                                                                <p class="text-muted m-b-5">Day</p>
                                                                <h5>13.50%</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <canvas id="tot-vendor" height="150"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Invoice Generate</h5>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                <li><i class="fa fa-minus minimize-card"></i></li>
                                                                <li><i class="fa fa-refresh reload-card"></i></li>
                                                                <li><i class="fa fa-trash close-card"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <p class="text-c-green f-w-500"><i class="feather icon-chevrons-up m-r-15"></i> 20% High than last month</p>
                                                        <div class="row">
                                                            <div class="col-4 b-r-default">
                                                                <p class="text-muted m-b-5">Overall</p>
                                                                <h5>68.52%</h5>
                                                            </div>
                                                            <div class="col-4 b-r-default">
                                                                <p class="text-muted m-b-5">Monthly</p>
                                                                <h5>28.90%</h5>
                                                            </div>
                                                            <div class="col-4">
                                                                <p class="text-muted m-b-5">Day</p>
                                                                <h5>13.50%</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <canvas id="invoice-gen" height="150"></canvas>
                                                </div>
                                            </div> -->
                                            <!-- income end -->

                                            <!-- ticket and update start -->
                                            <div class="col-xl-6 col-md-12">
                                                <div class="card table-card">
                                                    <div class="card-header">
                                                        <h5>Sales orders</h5>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                <li><i class="fa fa-minus minimize-card"></i></li>
                                                                <li><i class="fa fa-refresh reload-card"></i></li>
                                                                <li><i class="fa fa-trash close-card"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Status</th>
                                                                        <th>Order id</th>
                                                                        <th>Due Date</th>
                                                                        <th>Customer</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                    foreach($resultorder as $item){
                                                                        echo"<tr >
                                                                        <td ><label class='badge st$item->order_workstatus'>$item->order_workstatus</label></td>
                                                                            <td>$item->order_id</td>
                                                                        
                                                                        
                                                                            <td>$item->order_duedate</td>
                                                                            <td>".$item->order_cus_name->cust_first_nm."</td>
                                                                        
                                                                            

                                                                            

                                                                    </tr>";}
                                                                    ?>
                                                                                                                </tbody>
                                
                                                            </table>
                                                            <div class="text-right m-r-20">
                                                                <a href="#!" class=" b-b-primary text-primary">View all Projects</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-md-12">
                                                <div class="card latest-update-card">
                                                    <div class="card-header">
                                                        <h5>Workshop orders</h5>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                <li><i class="fa fa-minus minimize-card"></i></li>
                                                                <li><i class="fa fa-refresh reload-card"></i></li>
                                                                <li><i class="fa fa-trash close-card"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                    <div class="table-responsive">
                                                            <table class="table table-hover table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Status</th>
                                                                        <th>Order id</th>
                                                                        <th>Due Date</th>
                                                                        <th>Craftsman</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </div>
                                                    <?php
                        foreach($res_ws as $item){
                            echo"
                            <tr>
                            <td id='statustd'>$item->workshop_workstatus</td>
                            <td>$item->workshop_id</td>
                           
                           
                            <td>$item->workshop_duedt</td>
                            <td>".$item->craftsman->st_firstname."</td>
                            
                            
                            </tr>
                            ";
                        }
                    ?>
                                                                                                                </tbody>
                                
                                                            </table>
                                                            <div class="text-right m-r-20">
                                                                <a href="#!" class=" b-b-primary text-primary">View all Projects</a>
                                                            </div>
                                                  
                                                      
                                                        <div class="text-center">
                                                            <a href="#!" class="b-b-primary text-primary">View all Projects</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ticket and update end -->


                                        </div>
                                    </div>
                                </div>

                                <div id="styleSelector">

                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="../files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="../files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="../files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="..\files\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="..\files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="..\files\bower_components\modernizr\js\modernizr.js"></script>
    <script type="text/javascript" src="..\files\bower_components\modernizr\js\css-scrollbars.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="..\files\bower_components\chart.js\js\Chart.js"></script>
    <!-- Google map js -->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="..\files\assets\pages\google-maps\gmaps.js"></script>
    <!-- gauge js -->
    <script src="..\files\assets\pages\widget\gauge\gauge.min.js"></script>
    <script src="..\files\assets\pages\widget\amchart\amcharts.js"></script>
    <script src="..\files\assets\pages\widget\amchart\serial.js"></script>
    <script src="..\files\assets\pages\widget\amchart\gauge.js"></script>
    <script src="..\files\assets\pages\widget\amchart\pie.js"></script>
    <script src="..\files\assets\pages\widget\amchart\light.js"></script>
    <!-- Custom js -->
    <script src="..\files\assets\js\pcoded.min.js"></script>
    <script src="..\files\assets\js\vartical-layout.min.js"></script>
    <script src="..\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="..\files\assets\pages\dashboard\crm-dashboard.min.js"></script>
    <script type="text/javascript" src="..\files\assets\pages\dashboard\custom-dashboard.js"></script>
    <script type="text/javascript" src="..\files\assets\js\script.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
</body>

</html>
