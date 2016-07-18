'use strict';

/**
 * @ngdoc function
 * @name reportesApp.controller:ListtimeanalystCtrl
 * @description
 * # ListtimeanalystCtrl
 * Controller of the reportesApp
 */
angular.module('helpDesk')
  .controller('ListtimeanalystCtrl',['$scope','$http', function ($scope,$http) {

    $scope.table=false;
    $scope.title=false;
    $scope.loader=false;
    $scope.search=function(){
    $scope.loader=true;
    console.log($scope.loader);
        $http.get('index.php/reportes/ListtimeanalystController/TicketsFiltered',{params:$scope.date})
                .then(function(response) {
                console.log(response.data);
                if (response.data.message == "success") {
                $scope.total=response.data.tickets;
                $scope.atendidas=response.data.atendidas;
                $scope.espera=response.data.En_espera;
                $scope.exedieron=response.data.exedidos;
                $scope.avg=response.data.avg;
                $scope.table=true;
                $scope.title=true;
                $scope.loader=false;
                console.log($scope.loader,$scope.search,$scope.title);  
                } else
                {
                alert(response.data.message); 
                }
        }); 
    };	



  	
    
}]);
