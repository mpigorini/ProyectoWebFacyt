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
            }
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
        // TODO: Replace templateUrl with function that return the URL to the View ONLY if user has the corresponding permissions
        // TODO: At the END -- tell codeigniter to redirect to base URL when any other url is (manually) specified
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
    })
    .state('solve-tickets', {
        url: '/solve-tickets',
        module: 'private',
        templateUrl: 'index.php/administration/SolveTicketsController',
        controller: 'SolveTicketsController'
    })
    .state('forbidden', {
        url: '/forbidden',
        module: 'private',
        templateUrl: 'index.php/ForbiddenAccessController'
    });
    // Application theme
    $mdThemingProvider.theme('default')
        .primaryPalette('teal')//teal
        .accentPalette('deep-orange', {
            'default': '500',
        }); // deep-orange
    $mdThemingProvider.theme('blue-grey').backgroundPalette('blue-grey', {
          'default': '600',
    });
    // Progress bars themes for reports
    $mdThemingProvider.theme('red-bar')
        .primaryPalette('red');
    $mdThemingProvider.theme('orange-bar')
        .primaryPalette('orange');
    $mdThemingProvider.theme('teal-bar')
        .primaryPalette('teal');
    $mdThemingProvider.theme('inactive-bar')
        .primaryPalette('grey', {
            'default': '300'
        });
});

// $routeChangeStart changed for $locationChangeStart because event.preventDefault was
// NOT being fired, thus breaking angular when .otherwise('login') is triggered and
// user was already logged in.
// $locationChangeStart does not provide $state information so can't really use it at all.
angular.module('helpDesk')
     .run(['$rootScope', '$location','$state','auth', '$cookies', function ($rootScope, $location, $state, auth, $cookies) {
        $rootScope.$on("$locationChangeStart", function(e, toState, toParams, fromState, fromParams) {

        if (!auth.isLoggedIn() && $location.url() != "/login") {
            // if user is not logged in and is trying to access
            // private content, send to login.
            e.preventDefault();
            $state.go('login');
        }
        else if(auth.isLoggedIn() && $location.url() == "/login") {
            // if user Is logged in and is trying to access login page
            // send to home page (tickets)
            e.preventDefault();
            $state.go('tickets');
        } else if (auth.isLoggedIn() && !userHasPermission($cookies.getObject("session").perfil, $location.url())) {
            // check if user actually has access permission to intended url

            e.preventDefault();
            // if user does not have the propper permission, send home
            // or maybe send to error page.
            $state.go('forbidden');
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

  function userHasPermission(userType, url) {
      switch (url) {
        case '/profile':
            // everybody can see it's profile
            return true;
        case '/new-ticket':
            // everybody can create a new ticket
            return true;
        case '/tickets':
            // everybody can access home page
            return true;
        case '/solve-tickets':
            // check for technician rights
            return userType <= 3;
        case '/tickets-administration':
            // check rights for administrator
            return userType <= 2;
        case '/users-administration':
            // check rights for administrator
            return userType <= 2;
        case '/tickets-config':
            // check for administrator rights
            return userType <= 2;
        case '/organization-config':
            // check for administrator rights
            return userType <= 2;
        case '/reportes-tiempo':
            // check for manager rights
            return userType == 1;
        case '/reportes-departamento':
            // check for manager rights
            return userType == 1;
        case '/reportes-analista':
            // check for manager rights
            return userType == 1;
        case '/reportes-tickets':
            // check for manager rights
            return userType == 1;
        case '/reportes-satisfaccion':
            // check for manager rights
            return userType == 1;
      }
      // maybe going to login (.otherwise('login'))? if so, keep going!
      return true;
  }
}])
