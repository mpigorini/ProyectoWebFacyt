var helpDesk = angular.module("helpDesk", ["ui.router", "helpDesk.login", "ui.materialize", "ngMaterial", "md.data.table","ui.grid",
    "ui.grid.grouping",
    "ui.grid.selection",
    "ngAnimate"]);


angular.module('helpDesk').controller('MainController',
    ['$rootScope','$scope', 'auth',
        function($rootScope,$scope, auth) {
            $rootScope.model = {};
            $rootScope.model.errorLogin = "";
            $rootScope.helpers = false;
            $scope.logout = function () {
                auth.logout();
            };
            $rootScope.choice = 1;
            $rootScope.select = function(selection) {
                $rootScope.choice = selection;
            };
            $rootScope.isSelected = function(selection) {
              return ($rootScope.choice == selection);
            };
            $scope.helpers = function () {
                if($rootScope.helpers){
                    $rootScope.helpers=false;
                }else{
                    $rootScope.helpers=true;
                }
            };
            $scope.isLoggedIn = function() {
              return(auth.isLoggedIn());
            };
            if(auth.isLoggedIn()){
              console.log(auth.perfil());
            }
            $scope.isGerente = function(){
              if(auth.isLoggedIn()){
                return(auth.perfil() == '1');
              }
            };
            $scope.isCoordinador = function(){
              if(auth.isLoggedIn()){
                return(auth.perfil() == '2');
              }
            };
            $scope.isTecnico = function(){
              if(auth.isLoggedIn()){
                return(auth.perfil() == '3');
              }
            };
        }
    ]
);

helpDesk.config(function($stateProvider, $urlRouterProvider, $mdThemingProvider) {
  $urlRouterProvider
                  .otherwise('login');
  $stateProvider
    .state('login', {
        url: '/login',
        module: 'public',
        templateUrl: 'index.php/login/LoginController',
        controller: 'LoginController'
    })
    .state('profile', {
        url: '/profile',
        module: 'private',
        templateUrl: 'index.php/user/UserController',
        controller: 'UserController'
    })
    .state('new-ticket', {
        url: '/new-ticket',
        module: 'private',
        templateUrl: 'index.php/tickets/NewTicketController',
        controller: 'NewTicketController'
    })
    .state('tickets', {
        url: '/tickets',
        module: 'private',
        templateUrl: 'index.php/tickets/TicketsController',
        controller: 'TicketsController'
    })
    .state('tickets-administration', {
        url: '/tickets-administration',
        module: 'private',
        templateUrl: 'index.php/administration/TicketsAdminController',
        controller: 'TicketsAdminController'
    })
    .state('users-administration', {
        url: '/users-administration',
        module: 'private',
        templateUrl: 'index.php/administration/UsersAdminController',
        controller: 'UsersAdminController'
    })
    .state('tickets-config', {
        url: '/tickets-config',
        module: 'private',
        templateUrl: 'index.php/configuration/TicketsConfigController',
        controller: 'TicketConfigController'


    })
    .state('organization-config', {
        url: '/organization-config',
        module: 'private',
        templateUrl: 'index.php/configuration/OrganizationConfigController',
        controller: 'OrganizationConfigController'
    })
    .state('reportes-tiempo', {
        url: '/reportes-tiempo',
        module: 'private',
        templateUrl: 'index.php/reportes/ListtimeController',
        controller: 'ListtimeCtrl'
    })
    .state('reportes-departamento', {
        url: '/reportes-departamento',
        module: 'private',
        templateUrl: 'index.php/reportes/ListdepartamentController',
        controller: 'ListdepartamentCtrl'
    })
    .state('reportes-analista', {
        url: '/reportes-analista',
        module: 'private',
        templateUrl: 'index.php/reportes/ListtimeanalystController',
        controller: 'ListtimeanalystCtrl'
    }).state('reportes-tickets', {
        url: '/reportes-tickets',
        module: 'private',
        templateUrl: 'index.php/reportes/ListticketsController',
        controller: 'ListticketsCtrl'
    })
    .state('reportes-satisfaccion', {
        url: '/reportes-satisfaccion',
        module: 'private',
        templateUrl: 'index.php/reportes/ListsatisfactionController',
        controller: 'ListsatisfactionCtrl'
    });
    // Application theme
    $mdThemingProvider.theme('default')
        .primaryPalette('deep-orange')//teal
        .accentPalette('blue-grey');//deep-orange
});

// $routeChangeStart changed for $locationChangeStart because event.preventDefault was
// NOT being fired, thus breaking angular when .otherwise('login') is triggered and
// user was already logged in.
// $locationChangeStart does not provide $state information so can't really use it at all.
angular.module('helpDesk')
     .run(['$rootScope', '$location','$state','auth', function ($rootScope, $location, $state,auth) {
        $rootScope.$on("$locationChangeStart", function(e, toState, toParams, fromState, fromParams) {

        if (!auth.isLoggedIn() && $location.url() != "/login") {
          // console.log('DENY : Redirecting to Login');
          e.preventDefault();
          $state.go('login');
          //$location.path('/login');
          // console.log($location.url());
        }
        else if(auth.isLoggedIn() && $location.url() == "/login") {
          console.log('lool');
          e.preventDefault();
          $state.go('tickets');
        }
        if(auth.isLoggedIn() && auth.perfil() != '1' && auth.perfil() != '2')
        {
          if($location.url() == "/users-administration" || $location.url() == "/tickets-config" || $location.url() == "/organization-config"){
            e.preventDefault();
            $state.go('tickets');
          }
        }
        if(auth.isLoggedIn() && auth.perfil() != '1'){
          if($location.url() == '/reportes-tiempo' || $location.url() == '/reportes-departamento'
          || $location.url() == '/reportes-analista' || $location.url() == '/reportes-tickets'
          || $location.url() =='/reportes-satisfaccion'){
            e.preventDefault();
            $state.go('tickets');
          }
        }
  });
}])
