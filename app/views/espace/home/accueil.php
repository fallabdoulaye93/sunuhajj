<!DOCTYPE html>
<html lang="<?= \app\core\Session::getAttribut('lang');?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Espace partenaire</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content=""/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= ASSETS; ?>plugins/images/favicon.ico">
    <link rel="icon" href="<?= ASSETS; ?>plugins/images/favicon.ico" type="image/x-icon">

    <!-- Data table CSS -->
    <link href="<?= ASSETS; ?>partenaire/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <!-- Toast CSS -->
    <link href="<?= ASSETS; ?>partenaire/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

    <!-- Morris Charts CSS -->
    <link href="<?= ASSETS; ?>partenaire/vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>

    <!-- Chartist CSS -->
    <link href="<?= ASSETS; ?>partenaire/vendors/bower_components/chartist/dist/chartist.min.css" rel="stylesheet" type="text/css"/>


    <!-- vector map CSS -->
    <link href="<?= ASSETS; ?>partenaire/vendors/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" type="text/css"/>

    <!-- Custom CSS -->
    <link href="<?= ASSETS; ?>partenaire/dist/css/style.css" rel="stylesheet" type="text/css">
</head>
<body data-racine="<?= RACINE; ?>" class="fix-header">
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<!-- Preloader -->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!-- /Preloader -->
<div class="wrapper theme-2-active navbar-top-light">
    <!-- Top Menu Items -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="nav-wrap">
            <div class="mobile-only-brand pull-left">
                <div class="nav-header pull-left">
                    <div class="logo-wrap">
                        <a href="index.html">
                            <img class="brand-img" src="<?= ASSETS; ?>partenaire/img/logo.png" alt="brand"/>
                            <span class="brand-text"><img  src="<?= ASSETS; ?>partenaire/img/logo-sunuhajj.png" alt="brand"/></span>
                        </a>
                    </div>
                </div>
                <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="ti-align-left"></i></a>
                <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
                <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="ti-more"></i></a>
                <form id="search_form" role="search" class="top-nav-search collapse pull-left">
                    <div class="input-group">
                        <input type="text" name="example-input1-group2" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
							<button type="button" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
							</span>
                    </div>
                </form>
            </div>
            <div id="mobile_only_nav" class="mobile-only-nav pull-right">
                <ul class="nav navbar-right top-nav pull-right">
                    <li class="dropdown auth-drp">
                        <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?= ASSETS; ?>partenaire/img/user1.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
                        <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                            <li>
                                <a href="profile.html"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="zmdi zmdi-card"></i><span>my balance</span></a>
                            </li>
                            <li>
                                <a href="inbox.html"><i class="zmdi zmdi-email"></i><span>Inbox</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>
                            </li>
                            <li class="divider"></li>
                            <li class="sub-menu show-on-hover">
                                <a href="#" class="dropdown-toggle pr-0 level-2-drp"><i class="zmdi zmdi-check text-success"></i> available</a>
                                <ul class="dropdown-menu open-left-side">
                                    <li>
                                        <a href="#"><i class="zmdi zmdi-check text-success"></i><span>available</span></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="zmdi zmdi-circle-o text-warning"></i><span>busy</span></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="zmdi zmdi-minus-circle-outline text-danger"></i><span>offline</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- /Top Menu Items -->
    <!-- ============================================================== -->
    <!-- Left Sidebar Menu -->
    <div class="fixed-sidebar-left">
        <ul class="nav navbar-nav side-nav nicescroll-bar">
            <li class="navigation-header">
                <span>Menu</span>
                <hr/>
            </li>
            <li style="padding: 5px;">
                <a class="active" href="javascript:void(0);"><div class="pull-left"><i class="ti-dashboard mr-20"></i><span class="right-nav-text">Tableau de bord</span></div><div class="clearfix"></div></a>
            </li>
            <li style="padding: 5px;">
                <a class="active" href="javascript:void(0);"><div class="pull-left"><i class="ti-user mr-20"></i><span class="right-nav-text">Gestion des comptes</span></div><div class="clearfix"></div></a>
            </li>
            <li style="padding: 5px;">
                <a class="active" href="javascript:void(0);"><div class="pull-left"><i class="ti-layers mr-20"></i><span class="right-nav-text">Gestion des services</span></div><div class="clearfix"></div></a>
            </li>
            <li style="padding: 5px;">
                <a class="active" href="javascript:void(0);"><div class="pull-left"><i class="ti-receipt mr-20"></i><span class="right-nav-text">Suivi des transactions</span></div><div class="clearfix"></div></a>
            </li>
            <li style="padding: 5px;">
                <a class="active" href="javascript:void(0);"><div class="pull-left"><i class="ti-bar-chart mr-20"></i><span class="right-nav-text">Suivi facturation</span></div><div class="clearfix"></div></a>
            </li>
        </ul>
    </div>
    <!-- /Left Sidebar Menu -->
<!-- Main Content -->
<div class="page-wrapper">
    <div class="container pt-30">
        <!-- Row -->
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="panel panel-default card-view pa-0">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0">
                                    <div class="sm-data-box">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                    <span class="txt-dark block counter"><span class="counter-anim">914,001</span></span>
                                                    <span class="capitalize-font block">Nombre de transactions</span>
                                                </div>
                                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                    <i class="icon-globe data-right-rep-icon"></i>
                                                </div>
                                            </div>
                                            <div class="progress-anim">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-orange
															wow animated progress-animated" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="panel panel-default card-view pa-0">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0">
                                    <div class="sm-data-box">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                    <span class="txt-dark block counter"><span class="counter-anim">46.41</span></span>
                                                    <span class="capitalize-font block">Nombre de services</span>
                                                </div>
                                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                    <i class="icon-layers  data-right-rep-icon"></i>
                                                </div>
                                            </div>
                                            <div class="progress-anim">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-orange
															wow animated progress-animated" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="panel panel-default border-panel card-view panel-refresh">
                            <div class="refresh-container">
                                <div class="la-anim-1"></div>
                            </div>
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Courbe évolutive des transactions</h6>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="pull-left inline-block refresh mr-15">
                                        <i class="zmdi zmdi-replay"></i>
                                    </a>
                                    <a href="#" class="pull-left inline-block full-screen mr-15">
                                        <i class="zmdi zmdi-fullscreen"></i>
                                    </a>
                                    <div class="pull-left inline-block dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
                                        <ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
                                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Devices</a></li>
                                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>General</a></li>
                                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>Referral</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div id="ct_chart_2" class="" style="height:326px;"></div>
                                    <ul class="flex-stat mt-40">
                                        <li>
                                            <span class="block">Weekly Users</span>
                                            <span class="block txt-dark weight-500 font-18"><span class="counter-anim">3,24,222</span></span>
                                        </li>
                                        <li>
                                            <span class="block">Monthly Users</span>
                                            <span class="block txt-dark weight-500 font-18"><span class="counter-anim">1,23,432</span></span>
                                        </li>
                                        <li>
                                            <span class="block">Trend</span>
                                            <span class="block">
														<i class="zmdi zmdi-trending-up txt-success font-24"></i>
													</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="panel panel-default border-panel panel-tabs card-view">
                            <div class="panel-heading">
                                <div class="pull-left auto-width">
                                    <h6 class="panel-title txt-dark">Project Sales</h6>
                                </div>
                                <div class="pull-right auto-width mt-0">
                                    <div  class="tab-struct custom-tab-1">
                                        <ul role="tablist" class="nav nav-tabs" id="myTabs_9">
                                            <li class="active pull-left" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" id="home_tab_9" href="#home_9">Last Month</a></li>
                                            <li role="presentation" class="pull-left"><a  data-toggle="tab" id="profile_tab_9" role="tab" href="#profile_9" aria-expanded="false">All Time</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0 row">
                                    <div class="tab-content" id="myTabContent_9">
                                        <div  id="home_9" class="tab-pane fade active in" role="tabpanel">
                                            <div class="table-wrap">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mt-15 mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Products</th>
                                                            <th>Popularity</th>
                                                            <th>Sales</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Milk Powder</td>
                                                            <td><span class="peity-line" data-width="90" data-peity='{ "fill": ["transparent"], "stroke":["#ff6028"]}' data-height="40">0,-3,-2,-4,5,-4,3,-2,5,-1</span> </td>
                                                            <td><span class="text-danger text-semibold"><i class="fa fa-level-down" aria-hidden="true"></i> 28.76%</span> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Air Conditioner</td>
                                                            <td><span class="peity-line" data-width="90" data-peity='{ "fill": ["transparent"], "stroke":["#ff6028"]}' data-height="40">0,-1,1,-2,-3,1,-2,-3,1,-2</span> </td>
                                                            <td><span class="text-danger text-semibold"><i class="fa fa-level-down" aria-hidden="true"></i> 8.55%</span> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>RC Cars</td>
                                                            <td><span class="peity-line" data-width="90" data-peity='{ "fill": ["transparent"], "stroke":["#ff6028"]}' data-height="40">0,3,6,1,2,4,6,3,2,1</span> </td>
                                                            <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 58.56%</span> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>Down Coat</td>
                                                            <td><span class="peity-line" data-width="90" data-peity='{ "fill": ["transparent"], "stroke":["#ff6028"]}' data-height="40">0,3,6,4,5,4,7,3,4,2</span> </td>
                                                            <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 35.76%</span> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>5</td>
                                                            <td>Xyz Byke</td>
                                                            <td><span class="peity-line" data-width="90" data-peity='{ "fill": ["transparent"], "stroke":["#ff6028"]}' data-height="40">0,3,6,4,5,4,7,3,4,2</span> </td>
                                                            <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 35.76%</span> </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="profile_9" class="tab-pane fade" role="tabpanel">
                                            <div class="table-wrap">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Products</th>
                                                            <th>Popularity</th>
                                                            <th>Sales</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Milk Powder</td>
                                                            <td><span class="peity-line" data-width="90" data-peity='{ "fill": ["transparent"], "stroke":["#ff6028"]}' data-height="40">4,-4,-2,-4,5,-4,3,-1,5,-1</span> </td>
                                                            <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 18.76%</span> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Air Conditioner</td>
                                                            <td><span class="peity-line" data-width="90" data-peity='{ "fill": ["transparent"], "stroke":["#ff6028"]}' data-height="40">0,-1,1,-4,-3,1,-2,-3,2,-2</span> </td>
                                                            <td><span class="text-danger text-semibold"><i class="fa fa-level-down" aria-hidden="true"></i> 48.55%</span> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>RC Cars</td>
                                                            <td><span class="peity-line" data-width="90" data-peity='{ "fill": ["transparent"], "stroke":["#ff6028"]}' data-height="40">0,9,6,1,2,4,6,3,7,1</span> </td>
                                                            <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 8.56%</span> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>Down Coat</td>
                                                            <td><span class="peity-line" data-width="90" data-peity='{ "fill": ["transparent"], "stroke":["#ff6028"]}' data-height="40">7,5,6,4,5,4,6,5,4,2</span> </td>
                                                            <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 98.76%</span> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>5</td>
                                                            <td>Xyz Byke</td>
                                                            <td><span class="peity-line" data-width="90" data-peity='{ "fill": ["transparent"], "stroke":["#ff6028"]}' data-height="40">0,3,6,4,5,4,7,3,4,2</span> </td>
                                                            <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 12.76%</span> </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="panel panel-default border-panel card-view panel-refresh">
                            <div class="refresh-container">
                                <div class="la-anim-1"></div>
                            </div>
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Audience location</h6>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="pull-left inline-block refresh mr-15">
                                        <i class="zmdi zmdi-replay"></i>
                                    </a>
                                    <a href="#" class="pull-left inline-block full-screen mr-15">
                                        <i class="zmdi zmdi-fullscreen"></i>
                                    </a>
                                    <div class="pull-left inline-block dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
                                        <ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
                                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>option 1</a></li>
                                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>option 2</a></li>
                                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>option 3</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div id="usa" style="height: 385px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="panel panel-default border-panel card-view panel-refresh">
                            <div class="refresh-container">
                                <div class="la-anim-1"></div>
                            </div>
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Revenue</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div id="ct_chart_7" class="" style="height:298px;"></div>
                                    <hr class="light-grey-hr row mt-10 mb-0"/>
                                    <div class="label-chatrs">
                                        <div class="pt-30 pb-10">
                                            <div class="pull-left"><span class="block txt-dark weight-600 font-24">$<span class="counter-anim">15,678</span></span></div>
                                            <div class="pull-right"><span class="block pt-5"><i class="zmdi zmdi-trending-up txt-success font-18 mr-5"></i><span class="weight-500 uppercase-font">growth</span></span></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="panel panel-default border-panel card-view panel-refresh">
                            <div class="refresh-container">
                                <div class="la-anim-1"></div>
                            </div>
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">social campaigns</h6>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="pull-left inline-block refresh mr-15">
                                        <i class="zmdi zmdi-replay"></i>
                                    </a>
                                    <a href="#" class="pull-left inline-block full-screen mr-15">
                                        <i class="zmdi zmdi-fullscreen"></i>
                                    </a>
                                    <div class="pull-left inline-block dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
                                        <ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
                                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Edit</a></li>
                                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>Delete</a></li>
                                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>New</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body row pa-0">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                <tr>
                                                    <th>Campaign</th>
                                                    <th>Client</th>
                                                    <th>Changes</th>
                                                    <th>Budget</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td><span class="txt-dark weight-500">Facebook</span></td>
                                                    <td>Beavis</td>
                                                    <td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>2.43%</span></span></td>
                                                    <td>
                                                        <span class="txt-dark weight-500">$1478</span>
                                                    </td>
                                                    <td>
                                                        <span class="label label-warning">Active</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span class="txt-dark weight-500">Youtube</span></td>
                                                    <td>Felix</td>
                                                    <td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>1.43%</span></span></td>
                                                    <td>
                                                        <span class="txt-dark weight-500">$951</span>
                                                    </td>
                                                    <td>
                                                        <span class="label label-danger">Closed</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span class="txt-dark weight-500">Twitter</span></td>
                                                    <td>Cannibus</td>
                                                    <td><span class="txt-danger"><i class="zmdi zmdi-caret-down mr-10 font-20"></i><span>-8.43%</span></span></td>
                                                    <td>
                                                        <span class="txt-dark weight-500">$632</span>
                                                    </td>
                                                    <td>
                                                        <span class="label label-default">Hold</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span class="txt-dark weight-500">Spotify</span></td>
                                                    <td>Neosoft</td>
                                                    <td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>7.43%</span></span></td>
                                                    <td>
                                                        <span class="txt-dark weight-500">$325</span>
                                                    </td>
                                                    <td>
                                                        <span class="label label-default">Hold</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div id="weather_4" class="panel panel-default card-view pa-0 weather-warning overflow-hide">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0">
                                    <div class="row ma-0">
                                        <div class="col-xs-6 pa-0">
                                            <div class="left-block-wrap pa-30" style="background: #243f6b;">
                                                <p class="block nowday"></p>
                                                <span class="block nowdate"></span>
                                                <div class="left-block  mt-30" style="font-size: 31px;font-weight: 900;"><b>Mon solde</b></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 pa-0">
                                            <div class="right-block-wrap pa-15">
                                                <div class="right-block" style="margin-top: 40px;font-size: 25px;color: #ff5100;font-weight: 700;">
                                                    120 000 000 XOF
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="panel panel-default border-panel card-view panel-refresh">
                            <div class="refresh-container">
                                <div class="la-anim-1"></div>
                            </div>
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Traffic Types</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div id="ct_chart_5" class="" style="height:215px;"></div>
                                    <hr class="light-grey-hr row mt-10 mb-15"/>
                                    <div class="label-chatrs">
                                        <div class="">
                                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span class="block font-15 weight-500 mb-5">organic</span><span class="block txt-grey">356 visits</span></span>
                                            <div class="pull-right"><span class="font-18">44.46%</span></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <hr class="light-grey-hr row mt-10 mb-15"/>
                                    <div class="label-chatrs">
                                        <div class="">
                                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span class="block font-15 weight-500 mb-5">Refrral</span><span class="block txt-grey">36 visits</span></span>
                                            <div class="pull-right"><span class="font-18">5.46%</span></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <hr class="light-grey-hr row mt-10 mb-15"/>
                                    <div class="label-chatrs">
                                        <div class="">
                                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span class="block font-15 weight-500 mb-5">Other</span><span class="block txt-grey">245 visits</span></span>
                                            <div class="pull-right"><span class="font-18">50%</span></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="panel panel-default border-panel card-view panel-refresh">
                            <div class="refresh-container">
                                <div class="la-anim-1"></div>
                            </div>
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Advertising & Promotions</h6>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="pull-left inline-block refresh mr-15">
                                        <i class="zmdi zmdi-replay"></i>
                                    </a>
                                    <div class="pull-left inline-block dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
                                        <ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
                                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>option 1</a></li>
                                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>option 2</a></li>
                                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>option 3</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="pt-20">
                                        <canvas id="chart_2" height="210"></canvas>
                                    </div>
                                    <div class="label-chatrs text-center mt-30">
                                        <div class="inline-block mr-15">
                                            <span class="clabels inline-block bg-orange mr-5"></span>
                                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font">Active</span>
                                        </div>
                                        <div class="inline-block mr-15">
                                            <span class="clabels inline-block bg-orange-light-1 mr-5"></span>
                                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font">Closed</span>
                                        </div>
                                        <div class="inline-block">
                                            <span class="clabels inline-block bg-orange-light-2 mr-5"></span>
                                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font">Pending</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="panel panel-default border-panel card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Timelines</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="streamline user-activity">
                                        <div class="sl-item">
                                            <a href="javascript:void(0)">
                                                <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                    <img class="img-responsive img-circle" src="../img/user.png" alt="avatar"/>
                                                </div>
                                                <div class="sl-content">
                                                    <p class="inline-block"><span class="capitalize-font txt-orange mr-5 weight-500">Clay Masse</span><span>invited to join the meeting in the conference room at 9.45 am</span></p>
                                                    <span class="block txt-grey font-12 capitalize-font">3 Min</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="sl-item">
                                            <a href="javascript:void(0)">
                                                <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                    <img class="img-responsive img-circle" src="../img/user1.png" alt="avatar"/>
                                                </div>
                                                <div class="sl-content">
                                                    <p class="inline-block"><span class="capitalize-font txt-orange mr-5 weight-500">Evie Ono</span><span>added three new photos in the library</span></p>
                                                    <div class="activity-thumbnail">
                                                        <img src="../img/thumb-1.jpg" alt="thumbnail"/>
                                                        <img src="../img/thumb-2.jpg" alt="thumbnail"/>
                                                        <img src="../img/thumb-3.jpg" alt="thumbnail"/>
                                                    </div>
                                                    <span class="block txt-grey font-12 capitalize-font">8 Min</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="sl-item">
                                            <a href="javascript:void(0)">
                                                <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                    <img class="img-responsive img-circle" src="../img/user2.png" alt="avatar"/>
                                                </div>
                                                <div class="sl-content">
                                                    <p class="inline-block"><span class="capitalize-font txt-orange mr-5 weight-500">madalyn rascon</span><span>assigned a new task</span></p>
                                                    <span class="block txt-grey font-12 capitalize-font">28 Min</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="sl-item">
                                            <a href="javascript:void(0)">
                                                <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                    <img class="img-responsive img-circle" src="../img/user3.png" alt="avatar"/>
                                                </div>
                                                <div class="sl-content">
                                                    <p class="inline-block"><span class="capitalize-font txt-orange mr-5 weight-500">Ezequiel Merideth</span><span>completed project wireframes</span></p>
                                                    <span class="block txt-grey font-12 capitalize-font">yesterday</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="sl-item">
                                            <a href="javascript:void(0)">
                                                <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                    <img class="img-responsive img-circle" src="../img/user4.png" alt="avatar"/>
                                                </div>
                                                <div class="sl-content">
                                                    <p class="inline-block"><span class="capitalize-font txt-orange mr-5 weight-500">jonnie metoyer</span><span>created a group 'Hencework' in the discussion forum</span></p>
                                                    <span class="block txt-grey font-12 capitalize-font">18 feb</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="panel panel-default border-panel card-view">
                            <div class="panel-heading">
                                <div class="">
                                    <h6 class="panel-title txt-dark text-center">Latest testimonials</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div  class="panel-body">
                                    <!-- START carousel-->
                                    <div id="testimonial_slider" data-ride="carousel" class="carousel slide testimonial-slider-wrap text-slider mb-85">
                                        <ol class="carousel-indicators">
                                            <li data-target="#testimonial_slider" data-slide-to="0" class="active"></li>
                                            <li data-target="#testimonial_slider" data-slide-to="1"></li>
                                            <li data-target="#testimonial_slider" data-slide-to="2"></li>
                                        </ol>
                                        <div role="listbox" class="carousel-inner">
                                            <div class="item active">
                                                <div class="testimonial-wrap text-center">
                                                    <p class="pt-20 font-16">"Activist, criteria planned giving dignity, committed democratizing the global financial system progressive."</p>
                                                    <span class="testi-pers-name block mt-15  txt-dark capitalize-font head-font">
																Jens Brincker
															</span>
                                                    <span class="testi-pers-desg block capitalize-font">
																Interaction Designer
															</span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="testimonial-wrap text-center">
                                                    <p class="pt-20 font-16">"Nelson Mandela equal opportunity change accelerate pathway to a better life invest our ambitions catalyst."</p>
                                                    <span class="testi-pers-name block mt-15  txt-dark capitalize-font head-font">
																Mark Hay
															</span>
                                                    <span class="testi-pers-desg block capitalize-font">
																Interface Designer
															</span>
                                                </div>
                                            </div>

                                            <div class="item">
                                                <div class="testimonial-wrap text-center">
                                                    <p class="pt-20 font-16">"Making progress contribution compassion Ford Foundation, cross-agency coordination Bill development."</p>
                                                    <span class="testi-pers-name block mt-15  txt-dark capitalize-font head-font">
																Anthony Davie
															</span>
                                                    <span class="testi-pers-desg block capitalize-font">
																Project Manager
															</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- END carousel-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->

    </div>

    <!-- Footer -->
    <footer class="footer pl-30 pr-30">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p>2019 &copy; Sunubus. Powered by Numherit</p>
                </div>
                <!--<div class="col-sm-6 text-right">
                    <p>Follow Us</p>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                </div>-->
            </div>
        </div>
    </footer>
    <!-- /Footer -->

</div>
<!-- /Main Content -->
</div>
<!-- /#wrapper -->

<!-- JavaScript -->

<!-- jQuery -->
<script src="<?= ASSETS; ?>partenaire/vendors/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= ASSETS; ?>partenaire/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Data table JavaScript -->
<script src="<?= ASSETS; ?>partenaire/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

<!-- Slimscroll JavaScript -->
<script src="<?= ASSETS; ?>partenaire/dist/js/jquery.slimscroll.js"></script>

<!-- Progressbar Animation JavaScript -->
<script src="<?= ASSETS; ?>partenaire/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="<?= ASSETS; ?>partenaire/vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>

<!-- Fancy Dropdown JS -->
<script src="<?= ASSETS; ?>partenaire/dist/js/dropdown-bootstrap-extended.js"></script>

<!-- Sparkline JavaScript -->
<script src="<?= ASSETS; ?>partenaire/vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>

<!-- Owl JavaScript -->
<script src="<?= ASSETS; ?>partenaire/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

<!-- Switchery JavaScript -->
<script src="<?= ASSETS; ?>partenaire/vendors/bower_components/switchery/dist/switchery.min.js"></script>

<!-- Vector Maps JavaScript -->
<script src="<?= ASSETS; ?>partenaire/vendors/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?= ASSETS; ?>partenaire/vendors/vectormap/jquery-jvectormap-us-aea-en.js"></script>
<script src="<?= ASSETS; ?>partenaire/vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= ASSETS; ?>dist/js/vectormap-data.js"></script>

<!-- Toast JavaScript -->
<!--<script src="<?/*= ASSETS; */?>partenaire/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>-->

<!-- Piety JavaScript -->
<script src="<?= ASSETS; ?>partenaire/vendors/bower_components/peity/jquery.peity.min.js"></script>
<script src="<?= ASSETS; ?>partenaire/dist/js/peity-data.js"></script>

<!-- Chartist JavaScript -->
<script src="<?= ASSETS; ?>partenaire/vendors/bower_components/chartist/dist/chartist.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="<?= ASSETS; ?>partenaire/vendors/bower_components/raphael/raphael.min.js"></script>
<script src="<?= ASSETS; ?>partenaire/vendors/bower_components/morris.js/morris.min.js"></script>
<!--<script src="<?/*= ASSETS; */?>partenaire/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>-->

<!-- ChartJS JavaScript -->
<script src="<?= ASSETS; ?>partenaire/vendors/chart.js/Chart.min.js"></script>

<!-- Init JavaScript -->
<script src="<?= ASSETS; ?>partenaire/dist/js/init.js"></script>
<script src="<?= ASSETS; ?>partenaire/dist/js/dashboard-data.js"></script>
</body>

</html>