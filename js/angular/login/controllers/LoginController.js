angular.module('helpDesk.login').controller('LoginController', 
    ['$scope', '$rootScope', 'auth',
        function($scope, $rootScope, auth) {
            
            console.log($rootScope.model)
            $scope.login = function (element){
                auth.login($scope.model.login, $scope.model.password);
            };
        }
    ]
);