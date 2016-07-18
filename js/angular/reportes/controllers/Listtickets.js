'use strict';

/**
 * @ngdoc function
 * @name reportesApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the reportesApp
 */
angular.module('helpDesk')
  .controller('ListticketsCtrl', listTicket);


listTicket.$inject=['$scope','$http'];


  function listTicket ($scope,$http) {
	
	$scope.lists='';	
	$http.get('index.php/reportes/ListticketsController/ListTickets')
            .then(function(response) {
            console.log(response.data);
            if (response.data.message == "success") {
            $scope.lists=response.data.tickets;
            } else
            {
            alert(response.data); 
            }
    });
   
  }
