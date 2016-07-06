angular
    .module('helpDesk')
    .controller('UsersAdminController', usersAdministration);

usersAdministration.$inject = ['$scope', '$rootScope'];

function usersAdministration($scope, $rootScope) {
    'use strict';
    // show administration option as active
    $rootScope.select(2);
    
}