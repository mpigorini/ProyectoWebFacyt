angular
    .module('helpDesk')
    .controller('TicketsAdminController', ticketsAdministration);

ticketsAdministration.$inject = ['$scope', '$rootScope'];

function ticketsAdministration($scope, $rootScope) {
    'use strict';
    // show administration option as active
    $rootScope.select(2);
    
}