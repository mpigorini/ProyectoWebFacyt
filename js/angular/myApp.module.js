var helpDesk = angular.module("helpDesk", ["ngRoute", "helpDesk.login"]);
    
helpDesk.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
 $routeProvider
    .when('/', {
        templateUrl: function(params) {
            return 'index.php/login/Halo';
            
        }
    })
    .when('/hola', {
        templateUrl: function(params){
            return 'index.php/login/Hola';
        }, 
        controller : 'UserController'
    })
      
          
}]); 