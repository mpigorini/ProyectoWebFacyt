var helpDesk = angular.module("helpDesk", ["ngRoute"]);
    
helpDesk.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
 $routeProvider
    .when('/', {
        templateUrl: function(params) {
            // return 'index.php/login/Halo'
            return 'index.php/MainController'
        }
    })
    .when('/hola', {
    templateUrl: function(params){
        return 'index.php/login/Hola';
    }, 
    controller : ''
    })
      
          
}]); 