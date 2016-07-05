angular
    .module('helpDesk')
    .controller('TicketsConfiguration', ticketsConfiguration);

ticketsConfiguration.$inject = ['$scope', '$rootScope'];

function ticketsConfiguration($scope, $rootScope) {
    'use strict';
    // show configuration option as active
    $rootScope.select(3);
    
}