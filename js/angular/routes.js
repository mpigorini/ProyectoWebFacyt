helpDesk.config(function($routeProvider) {
    
    $routeProvider 
        
        .when('/', {
            templateUrl:''
        })
        .when('/hola', {
            templateUrl: 'application/views/hola',
            controller : ''
        })
});