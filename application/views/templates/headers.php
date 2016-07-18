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
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-2.2.4.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.9/angular-material.min.css" media="screen,projection">
        <!-- Angular Material requires Angular.js Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-aria.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-messages.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-touch.js"></script>
        
         <!-- Data table-->
        <script type="text/javascript" src="<?php echo base_url(); ?>data-table/dist/md-data-table.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>data-table/dist/md-data-table.min.css">
          <!-- START ui-Grid bowers-->
        <link rel="stylesheet" type="text/css" href="ui-grid/ui-grid.css" />
        <script src="ui-grid/ui-grid.js"></script>
        <!-- END ui-Grid bowers-->

        <!-- Angular Material Library -->
        <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.9/angular-material.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular-route.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.8/angular-ui-router.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/cookies.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/login/login.module.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/login/authenticate.factory.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/login/controllers/LoginController.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular-materialize.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/materialize.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/myApp.module.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/user/controllers/UserController.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/tickets/controllers/NewTicketController.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/tickets/controllers/TicketsController.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/administration/controllers/TicketsAdminController.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/administration/controllers/UsersAdminController.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/configuration/controllers/TicketConfigController.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/configuration/controllers/OrganizationConfigController.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/reportes/controllers/Listtimeanalyst.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/reportes/controllers/Listdepartament.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/reportes/controllers/Listsatisfaction.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/angular/reportes/controllers/Listtime.js"></script>
        
        
        <script type="text/javascript" src="<?php echo base_url(); ?>js/init.js"></script>
        <!-- Sweet Alert load -->
        <script type="text/javascript" src="<?php echo base_url(); ?>sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>sweetalert/dist/sweetalert.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>sweetalert/themes/google/google.css">
        <title>Help Desk</title>
</head>
</head>
<body>
  <div ng-controller="Navbar">
    <header ng-controller="MainController">
        <nav class="teal accent-4">
            <ul id="opProfile" class="dropdown-content">
              <li><a href="#/profile">Editar perfil</a></li>
              <li class="divider"></li>
              <li><a href="#" ng-click="logout()">Cerrar Sesión</a></li>
            </ul>
            <div class="container nav-wrapper">
                <a ng-show="isLoggedIn()" class="brand-logo" href="#/main"><i class="material-icons left">supervisor_account</i>Company name help Desk</a>
                <a ng-show="!isLoggedIn()" class="brand-logo center" href="#/main"><i class="material-icons left">supervisor_account</i>Company name help desk</a>
                <ul class="right hide-on-med-and-down" ng-show="isLoggedIn()">
                    <li ng-class="{active:isSelected(4)}"><a class="waves-effect waves-light yellow darken-4 btn" href="#/new-ticket">Nuevo ticket</a></li>
                    <li ng-class="{active:isSelected(5)}"><a class="dropdown-button" href="#" data-activates="opProfile">Mi perfil<i class="material-icons right">perm_identity</i></a></li>
                </ul>
                <!-- Mobile nav-bar -->
				<ul id="nav-mobile" class="side-nav" ng-show="isLoggedIn()">
                    <li><a href="#/new-ticket" class="waves-effect waves-teal"><i class="material-icons right">fiber_new</i>Nuevo ticket</a></li>
                    <!-- My Profile -->
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a class="collapsible-header waves-effect waves-teal">Mi perfil<i class="material-icons right">perm_identity</i></a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="#/profile" class="waves-effect waves-teal">Editar perfil</a></li>
                                        <li><a href="#" class="waves-effect waves-teal" ng-click="logout()">Cerrar Sesión</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#/tickets"><i class="material-icons right">mail_outline</i>Tickets</a></li>
                    <!-- Administration -->
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a class="collapsible-header waves-effect waves-teal">Administración<i class="material-icons right">business</i></a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="#/tickets-administration" class="waves-effect waves-teal">Tickets</a></li>
                                        <li><a href="#/users-administration" class="waves-effect waves-teal">Usuarios</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Configuration -->
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a class="collapsible-header waves-effect waves-teal">Configuración<i class="material-icons right">settings</i></a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="#/tickets-config" class="waves-effect waves-teal">Tickets</a></li>
                                        <li><a href="#/organization-config" class="waves-effect waves-teal">Organización</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
				<a ng-show="isLoggedIn()" href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </header>
    <!-- Main menu -->
    <nav ng-show="isLoggedIn()" class="hide-on-med-and-down #1de9b6 orange lighten-3">
        <div class="container nav-wrapper #1de9b6 orange lighten-3">
            <!-- Configuration dropdown menu -->
            <ul id="configMenu" class="dropdown-content">
                <li><a href="#/tickets-config" class="waves-effect waves-teal">Tickets</a></li>
                <li class="divider"></li>
                <li><a href="#/organization-config" class="waves-effect waves-teal">Organización</a></li>
            </ul>
            <!-- Administration dropdown menu -->
            <ul id="administrationMenu" class="dropdown-content">
                <li><a href="#/tickets-administration" class="waves-effect waves-teal">Tickets</a></li>
                <li class="divider"></li>
                <li><a href="#/users-administration" class="waves-effect waves-teal">Usuarios</a></li>
            </ul>
             <!-- Reportes dropdown menu -->
            <ul id="reportesMenu" class="dropdown-content">
                <li><a href="#/reportes-tiempo" class="waves-effect waves-teal">Por tiempo</a></li>
                <li class="divider"></li>
                <li><a href="#/reportes-departamento" class="waves-effect waves-teal">Por departamento</a></li>
                <li class="divider"></li>
                <li><a href="#/reportes-analista" class="waves-effect waves-teal">Por Analista</a></li>
                <li class="divider"></li>
                <li><a href="#/reportes-satisfaccion" class="waves-effect waves-teal">Nivel de Satisfaccion</a></li>
            </ul>
            <!-- END Reportes dropdown menu-->
            <!-- Actual menu -->
            <ul class="left">
                <li ng-class="{active:isSelected(1)}"><a href="#/tickets">Tickets</a></li>
                <li ng-class="{active:isSelected(2)}"><a class="dropdown-button" href="#" data-activates="administrationMenu">Administración</a></li>
                <li ng-class="{active:isSelected(3)}"><a class="dropdown-button" href="#" data-activates="configMenu">Configuración</a></li>
                <li ng-class="{active:isSelected(4)}"><a class="dropdown-button" href="#" data-activates="reportesMenu">Reportes</a></li>
            </ul>
        </div>
    </nav>
    </div>
    <main ui-view autoscroll="false"></main>
