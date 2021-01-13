<!DOCTYPE html>
<html lang="en" xmlns: xmlns:>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= WEBROOT;?>assets/plugins/images/suNuSVA_logo.png">
    <title><?= $this->lang['login'] ?></title>
    <!-- jQuery -->
    <link href="<?= WEBROOT; ?>assets/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <script src="<?= WEBROOT; ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Font-awesome CSS -->
    <link href="<?= WEBROOT;?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="<?= WEBROOT; ?>assets/ampleadmin-minimal/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?= WEBROOT; ?>assets/ampleadmin-minimal/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= WEBROOT; ?>assets/ampleadmin-minimal/css/styleadmin.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= WEBROOT; ?>assets/ampleadmin-minimal/css/colors/blue.css" id="theme"  rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .login-register {
            /* The image used */
            background-image: url('<?= WEBROOT; ?>assets/images/mecquehd.jpg');

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .login-sidebar{
            margin: 3px;
            margin-left: -50px;
            top:-3px;
            right: 24px;
        }
        .blue-box{
            margin:0px;
            margin-top: 0px;
        }

    </style>
</head>
<body >
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>

<section id="wrapper" class="login-register " >
         <!--style="background-image: url('<?= WEBROOT; ?>assets/pictures/20191025161150.jpg'); background-size: cover; background-repeat: no-repeat; "-->


    <div class="login-box" >
        <div class="blue-box">
            <form class="form-horizontal form-material" id="loginform" data-type="update" role="form" name="form" action="<?= WEBROOT ?>home/login" method="post">
                <br/><br/>
                <a href="javascript:void(0)" class="text-center db"><img src="<?= WEBROOT; ?>assets/images/logo-Comsec 2020.png" width="200px" height="60px" alt="Home" /><br/></a>

                <div class="form-group m-t-40">@media only screen and (min-width: 400px) {
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="login" id="login" required="" placeholder="Nom d'utilisateur" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="password" id="password" name="password"  class="form-control" placeholder="Mot de passe" style="width: 100%">

                    </div>
                    <?//= $token;?>
                </div>
                <div class="form-group">
                    <div class="col-md-12">

<!--                        <a href="javascript:void(0)" id="to-recover" class="text-white pull-right"><i class="fa fa-lock m-r-5 blanc-label"></i>Mot de passe oublié? </a>-->
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12" id="msg">
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">

                        <button type="submit"  class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">Se connecter</button>
<!--                        <button  type="button" id="resetpass" onclick="resetpassword()" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">--><?php //echo $this->lang['regenere_pass']?><!--</button>-->
                    </div>
                </div>

            </form>

        </div>
        <footer class="footer text-center" style="background-color: #FFFFFF;color: blue"> © 2021 BY COMSEC</footer>
    </div>

</section>

<!-- Bootstrap Core JavaScript -->

<script src="<?= WEBROOT ?>assets/plugins/bower_components/sweetalert/sweetalert.min.js"></script>

<script src="<?= ASSETS; ?>/ampleadmin-minimal/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?= ASSETS; ?>/ampleadmin-minimal/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="<?= ASSETS; ?>/ampleadmin-minimal/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?= ASSETS; ?>/ampleadmin-minimal/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?= ASSETS; ?>/ampleadmin-minimal/js/custom.min.js"></script>


<!--Style Switcher -->
<script src="<?= ASSETS; ?>/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
