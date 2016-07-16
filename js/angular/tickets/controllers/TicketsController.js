angular
    .module('helpDesk')
    .controller('TicketsController', tickets);

tickets.$inject = ['$scope', '$rootScope', '$http'];

function tickets($scope, $rootScope, $http) {
    'use strict';
    // show Tickets option as active
    $rootScope.select(1);
    $http.get('index.php/tickets/TicketsController/listTicket')
        .then(function(response) {
            if(response.data.message === "success") {
              $scope.list = response.data.tickets;
            }
          }, function (response){

      })
}
