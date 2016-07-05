angular
    .module('helpDesk')
    .controller('Tickets', tickets);

tickets.$inject = ['$scope', '$rootScope'];

function tickets($scope, $rootScope) {
    'use strict';
    // show Tickets option as active
    $rootScope.select(1);
    
}