angular
    .module('helpDesk')
    .controller('NewTicketController', newTicket);

newTicket.$inject = ['$scope', '$rootScope', '$http'];

function newTicket($scope, $rootScope, $http) {
    'use strict';
    // show NewTicket option as active
    $rootScope.select(4);
    $scope.originDepartment = "";
    $scope.ticket = {}
    
    $http.get('index.php/tickets/NewTicketController/getAllDepartments')
	.then(function(response) {
        if(response.data.message == "success") {
            $scope.departments = response.data.data;
        }
    });
    
    $http.get('index.php/tickets/NewTicketController/getConfig')
    .then(function(response) {
       if (response.data.message == "success") {
           $scope.config = response.data.data;
       }
    });
    
    $scope.saveTicket = function() {
        console.log("User selected department: " + $scope.ticket.department);
        console.log("User selected type: " + $scope.ticket.type);
        console.log("User selected level: " + $scope.ticket.level);
        console.log("User selected priority: " + $scope.ticket.priority);

    }
    
}