angular
    .module('helpDesk')
    .controller('NewTicket', newTicket);

newTicket.$inject = ['$scope', '$rootScope'];

function newTicket($scope, $rootScope) {
    'use strict';
    // show NewTicket option as active
    $rootScope.select(4);
    
}