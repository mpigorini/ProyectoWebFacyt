
/**
 * @ngdoc function
 * @name reportesApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the reportesApp
 */
angular.module('helpDesk')

  .controller('ListsatisfactionCtrl', listTicket);


listTicket.$inject=['$scope','$http', '$rootScope'];


  function listTicket ($scope,$http, $rootScope) {
	
    $http.get('index.php/reportes/ListsatisfactionController/getStatics')
      .then(function (response){
        if(response.data.message ="suceess") {
          console.log(response);
          $scope.static = response.data.static;
          $scope.todas = response.data.todas;
          $scope.undf = response.data.undf;
        }
      })


   
  }
