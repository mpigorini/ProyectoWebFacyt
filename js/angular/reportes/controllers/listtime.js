'use strict';

/**
 * @ngdoc function
 * @name reportesApp.controller:ListtimeCtrl
 * @description
 * # ListtimeCtrl
 * Controller of the reportesApp
 */
angular.module('reportesApp')
  .controller('ListtimeCtrl', function ($scope) {
    
    $scope.table=false;
    $scope.title=false;

    $scope.search= function (){
//aqui va la peticion $http al controllador reportes.php, que devolvera los datos reales
//y seran cambiados en los respectivos scope

  $scope.total=200;
  $scope.atendidas=100;
  $scope.espera=50;
  $scope.exedieron=50;
    $scope.table=true;
    $scope.title=true;
    console.log($scope.search,$scope.title);
};


  });
