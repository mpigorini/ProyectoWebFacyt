angular
    .module('helpDesk')
    .controller('ListTicketController', listTicket);

listTicket.$inject = ['$scope', "$http"];

function listTicket($scope, $http) {
  $http.get('index.php/tickets/Tickets/listTicket')
      .then(function(response) {
          if(response.data.message === "success") {
            $scope.list = response.data.tickets;
          }
        }, function (response){

    })
}
