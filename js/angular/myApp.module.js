var helpDesk = angular.module("helpDesk", ["ngRoute", "helpDesk.login"]);
    
angular.module('helpDesk').controller('MainController', 
    ['$rootScope','$scope', 'auth',
        function($rootScope,$scope, auth) {
            
            $rootScope.model = {};
            $rootScope.model.errorLogin = "";
            $scope.logout = function (){
                console.log('sadsadsdas');
                console.log($rootScope.model);
                auth.logout();
            };
           
        }
    ]
);
helpDesk.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
 $routeProvider
    .when('/home', {
        templateUrl: function(params) {
            return 'index.php/login/Halo';
        },
        controller: 'MainController'
    })
    .when('/login', {
        templateUrl: function(params){
            return 'index.php/login/LoginController';
        }, 
        controller : 'LoginController'
    })
      
          
}]); 
angular.module('helpDesk')
     .run(['$rootScope', '$location', 'auth', function ($rootScope, $location, auth) {
        $rootScope.$on('$routeChangeStart', function (event) {

        console.log(auth.isLoggedIn());
        if (!auth.isLoggedIn() && $location.url() !== '/login') {
          console.log('DENY : Redirecting to Login');
          event.preventDefault();
          $location.path('/login');
          console.log($location.url());
        }
        else {
          console.log('ALLOW');
        }
  });
}])