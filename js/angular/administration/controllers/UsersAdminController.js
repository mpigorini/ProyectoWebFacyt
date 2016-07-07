angular
    .module('helpDesk')
    .controller('UsersAdminController', usersAdministration);

usersAdministration.$inject = ['$scope', '$rootScope', '$http', '$cookies'];

function usersAdministration($scope, $rootScope, $http, $cookies) {
    'use strict';
    // show administration option as active
    $rootScope.select(2);
    // $scope.users = {};
    $http.get('index.php/administration/UsersAdminController/getAllUsers')
    	.then(function(response) {
            if(response.data.message == "success") {
                $scope.users = response.data.data;
                console.log("response: " + response);
            }
        });
}