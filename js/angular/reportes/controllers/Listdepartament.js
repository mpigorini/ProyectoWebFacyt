'use strict';

/**
 * @ngdoc function
 * @name reportesApp.controller:ListdepartamentCtrl
 * @description
 * # ListdepartamentCtrl
 * Controller of the reportesApp
 */
angular.module('helpDesk')
  .controller('ListdepartamentCtrl',['$scope','$http','$rootScope', function ($scope,$http,$rootScope) {
    'use strict';
    // close mobile sideNav
    $('.button-collapse').sideNav('hide');
    $rootScope.select(6);
    $scope.ticketSelected = false;
    $scope.selected = [];
    $scope.result = false;
    $scope.noData = false;
    $scope.query = {
        order: 'subject',
        limit: 5,
        page: 1
    };

    $http.get('index.php/reportes/ListdepartamentController/getDepartments')
    .then(function (response){
        if (response.data.message== "success") {
            $scope.departments =  response.data.data
            console.log($scope.departments);
        }
    })
    $scope.getTicketsForDepartment = function () {
      $http.get('index.php/reportes/ListdepartamentController/getTicketsForDepartment' , {params : $scope.model.departmentSelect})
        .then(function (response){
            if (response.data.message== "success") {
                $scope.tickets = response.data.tickets;
                 if(typeof $scope.tickets !== 'undefined'){
                  $scope.result = true;  
                  $scope.noData = false;
                }else {
                  $scope.result = false; 
                  $scope.noData = true;
                }
            }
        })
    }
    $scope.selectItem = function(item) {
        setTimeout(prueba(item), 1000);
    }

    function prueba(item) {
        $scope.model.id = item.id;
            $scope.model.paddedId = item.paddedId;
            $scope.model.subject = item.subject;
            $scope.model.description =item.description;
            $scope.model.type = item.type;
            $scope.model.level = item.level;
            $scope.model.priority = item.priority;
            $scope.model.state = item.state;
            $scope.model.answerTime = item.maxAnswerTime ? item.maxAnswerTime + "d" : null;
            $scope.model.qualityOfService = item.qualityOfService;
            $scope.model.evaluation = item.evaluation;
            if(typeof item.userAssigned != 'undefined') {
                $scope.model.userAssigned = item.userAssigned;
            } else {
               $scope.model.userAssigned = null;
            }

            $scope.searchText = "";

            if(item.submitDate != null) {
              var  date =  new Date(item.submitDate.date);
              $scope.model.submitDate = date.getDate()+'/'+date.getMonth()+'/'+date.getFullYear();
            }
            if(item.closeDate != null) {
              var  date =  new Date(item.closeDate.date);
               $scope.model.closeDate = date.getDate()+'/'+date.getMonth()+'/'+date.getFullYear();
            }else {
                $scope.model.closeDate = "";
            }
            $scope.model.department = item.department;
            $scope.model.userReporter = item.userReporter
            $scope.ticketSelected = true;
    }

    $scope.clearModel = function() {
        $scope.ticketSelected = false;
        $scope.selected = [];
    }
    $scope.deselectItem = function() {
        $scope.ticketSelected = false;
    }


}]);
