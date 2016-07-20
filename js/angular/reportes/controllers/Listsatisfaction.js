
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

      // The higer the better
    $scope.goodProgressTheme = function(value) {
        var porcentage = parseInt(value, 10);
        if (isNaN(porcentage)) {
            return 'inactive-bar';
        } else if (porcentage <= 20) {
            return 'red-bar';
        }else if (porcentage <= 70) {
            return 'orange-bar';
        } else {
            return 'teal-bar';
        }
    }
    // The higer the badder
    $scope.badProgressTheme = function (value){
        var porcentage = parseInt(value, 10);
        if (isNaN(porcentage)) {
            return 'inactive-bar';
        } else if (porcentage <= 20) {
            return 'teal-bar';
        }else if (porcentage <= 70) {
            return 'orange-bar';
        } else {
            return 'red-bar';
        }
    }
   
  }
