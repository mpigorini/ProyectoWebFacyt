var helpDesk = angular.module("helpDesk", ["ui.router", "helpDesk.login"]);

angular.module('helpDesk').controller('MainController',
    ['$rootScope','$scope', 'auth',
        function($rootScope,$scope, auth) {

            $rootScope.model = {};
            $rootScope.model.errorLogin = "";
            $scope.logout = function (){
                auth.logout();
            };

        }
    ]
);

helpDesk.config(function($stateProvider, $urlRouterProvider) {
 $stateProvider

    .state('home', {
        url: '/home',
        module: 'private',
        templateUrl: 'index.php/HomeController',
        controller: 'MainController'
    })
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
        templateUrl: 'index.php/tickets/NewTicket',
        controller: 'NewTicket'
    })
    .state('tickets', {
        url: '/tickets',
        module: 'private',
        templateUrl: 'index.php/tickets/Tickets',
    })
    .state('tickets-administration', {
        url: '/tickets-administration',
        module: 'private',
        templateUrl: 'index.php/administration/TicketsAdministration',
    })
    .state('users-administration', {
        url: '/users-administration',
        module: 'private',
        templateUrl: 'index.php/administration/UsersAdministration',
    })
    .state('tickets-config', {
        url: '/tickets-config',
        module: 'private',
        templateUrl: 'index.php/configuration/TicketsConfiguration',
    })
    .state('organization-config', {
        url: '/organization-config',
        module: 'private',
        templateUrl: 'index.php/configuration/OrganizationConfiguration',
    })
});

angular.module('helpDesk')
     .run(['$rootScope', '$location','$state','auth', function ($rootScope, $location, $state,auth) {
        $rootScope.$on('$stateChangeStart', function(e, toState, toParams, fromState, fromParams) {
        console.log(auth.isLoggedIn());
        if (!auth.isLoggedIn() && toState.module == 'private') {
          console.log('DENY : Redirecting to Login');
          e.preventDefault();
          $state.go('login');
          //$location.path('/login');
          console.log($location.url());
        }
        else if(auth.isLoggedIn() && toState.module == 'public') {
          console.log('ALLOW');
          e.preventDefault();
          $state.go('home');
        }
  });
}])
