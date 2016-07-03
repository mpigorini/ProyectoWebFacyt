angular.module('helpDesk.login').controller('LoginController', 
    ['$scope', '$rootScope', 'auth',
        function($scope, $rootScope, auth) {
            $rootScope.loading=false;
            console.log("$rootScope.model: " + $rootScope.model)
            $scope.login = function (element){
                $rootScope.loading=true;
                auth.login($scope.model.login, $scope.model.password);
            };
        }
    ]
);