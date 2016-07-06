angular
    .module('helpDesk')
    .controller('UsersAdministration', usersAdministration);

usersAdministration.$inject = ['$scope', '$rootScope'];

function usersAdministration($scope, $rootScope) {
    'use strict';
    // show administration option as active
    $rootScope.select(2);
    
}