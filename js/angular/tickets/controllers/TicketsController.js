angular
    .module('helpDesk')
    .controller('TicketsController', tickets);

tickets.$inject = ['$scope', '$rootScope'];

function tickets($scope, $rootScope) {
    'use strict';
    // show Tickets option as active
    $rootScope.select(1);
    
}