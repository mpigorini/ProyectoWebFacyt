<!DOCTYPE html>
<html  ng-app="helpDesk" >
    <head>
       <?php
            include (APPPATH. '/libraries/ChromePhp.php')
       ?>
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/materialize.min.css"  media="screen,projection"/>
        <!--Import custom style.css -->
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/style.css"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="utf-8">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Utils are important for page functionality so load before showing content -->
        <script src="https://use.fontawesome.com/4330ea9880.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/init.js"></script>
        <!--<script type="text/javascript" src="<?//php echo base_url(); ?>js/utils.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular-route.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/cookies.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/login/login.module.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/login/authenticate.factory.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/login/controllers/LoginController.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/myApp.module.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/user/controllers/UserController.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/materialize.min.js"></script> 
        <!-- Sweet Alert load -->
        <script type="text/javascript" src="<?php echo base_url(); ?>sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>sweetalert/dist/sweetalert.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>sweetalert/themes/google/google.css">
</head>
<body>
    <header ng-controller="MainController">
        <nav class="teal accent-4">
            <ul id="opProfile" class="dropdown-content">
              <li><a href="#/profile">Mi perfil</a></li>
              <li class="divider"></li>
              <li><a href="#" ng-click="logout()">Cerrar Sesión</a></li>
            </ul>
            <div class="container nav-wrapper">
                <a class="brand-logo">Company name help Desk<i class="material-icons left">supervisor_account</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a class="waves-effect waves-light yellow darken-4 btn" href="#">Nuevo ticket</a></li>
                    <li><a class="dropdown-button" href="#" data-activates="opProfile">Mi perfil<i class="material-icons right">perm_identity</i></a></li>
                </ul>
                <!-- Mobile nav-bar -->
				<ul id="nav-mobile" class="side-nav">
                    <li><a href="#"><i class="material-icons right">fiber_new</i>Nuevo ticket</a></li>
                    <li><a class="dropdown-button" href="#" data-activates="opProfile">Mi perfil<i class="material-icons right">perm_identity</i></a></li>				</ul>
				<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </header>
    <div ng-view></div>
</body>