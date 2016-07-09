var helpDesk = angular.module("helpDesk", ["ui.router", "helpDesk.login", "ui.materialize"]);


angular.module('helpDesk').controller('MainController',
    ['$rootScope','$scope', 'auth',
        function($rootScope,$scope, auth) {
            $rootScope.model = {};
            $rootScope.model.errorLogin = "";
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
        }
    ]
);

angular.module('helpDesk').controller('Navbar',function($rootScope, $scope,auth){
  $scope.isLoggedIn = function() {
    return(auth.isLoggedIn());
  };
});

helpDesk.config(function($stateProvider, $urlRouterProvider) {
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
          // console.log('ALLOW');
          e.preventDefault();
          $state.go('tickets');
        }
  });
}])
