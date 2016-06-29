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
        <!--<script type="text/javascript" src="<?//php echo base_url(); ?>js/utils.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>bower_components/angular/angular.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>bower_components/angular-route/angular-route.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/myApp.module.js"></script>
        <!-- Sweet Alert load -->
        <script type="text/javascript" src="<?php echo base_url(); ?>sweetalert/dist/sweetalert.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>sweetalert/dist/sweetalert.css">
</head>
<body>
    <header>
        <nav class="teal accent-4">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo center">Help Desk</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li class="active"><a href="#">Nuevo ticket</a></li>
                    <li><a href="#">Mi perfil</a></li>
                    <li><a href="#">Cerrar Sesión</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- <div ng-view class="container"></div> -->
</body>