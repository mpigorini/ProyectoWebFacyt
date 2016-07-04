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
    .state('coordinador', {
        url: '/coordinador',
        module: 'private',
        templateUrl: 'index.php/coordinador/CoordinadorController',
        controller:  'MainController'
    })
    .state('coordinador.tickets', {
        url: '/tickets',
        module: 'private',
        templateUrl: 'index.php/coordinador/TicketsController',
    })
    .state('coordinador.administracion', {
        url: '/administracion',
        module: 'private',
        templateUrl: 'index.php/coordinador/AdministracionController',
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
        else if(auth.isLoggedIn() && toState.module == 'public'){
          console.log('ALLOW');
          e.preventDefault();
          $state.go('coordinador');
        }
  });
}])
