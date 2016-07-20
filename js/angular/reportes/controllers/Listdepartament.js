'use strict';

/**
 * @ngdoc function
 * @name reportesApp.controller:ListdepartamentCtrl
 * @description
 * # ListdepartamentCtrl
 * Controller of the reportesApp
 */
angular.module('helpDesk')
  .controller('ListdepartamentCtrl',['$scope','$http', function ($scope,$http) {
    'use strict';
    // close mobile sideNav
    $('.button-collapse').sideNav('hide');
    $rootScope.select(6);
    $scope.ticketSelected = false;
    $scope.selected = [];
    $scope.result = false;

    $scope.query = {
        order: 'subject',
        limit: 5,
        page: 1
    };

    $http.get('index.php/reportes/ListdepartamentController/getDepartments')
    .then(function (response){
        if (response.data.message== "success") {
            $scope.departments =  response.data.departments
        }
    })
    $scope.getTicketsForDepartment = function () {
      $http.get('index.php/reportes/ListdepartamentController/getTicketsForDepartment' , {params : $scope.department})
        .then(function (response){
            if (response.data.message== "success") {
                $scope.tickets = response.data.tickets;
                $scope.todas = response.data.todas;
                $scope.enEspera = response.data.enEspera;
                $scope.atendidas = response.data.atendidas;
                $scope.excedidas = response.data.excedidas;
                console.log(response);
                console.log($scope.tickets);
                $scope.result = true;
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



    $http.get('index.php/reportes/ListdepartamentController/listTicket')
      .then(function(response) {
          if(response.data.message === "success") {
            $scope.miembros = response.data.tickets;

            $scope.loader=false;
            console.log($scope.loader);
          }
        }, function (response){

          console.log(response.data);
          $scope.loader=false;
        console.log($scope.loader);
    });


//     $scope.gridOptions={
// //defincion de las propiedades del ng-Grid
//
//     jqueryUITheme: true,
//     showGroupPanel: true,
//     showGridFooter: true,
//     showColumnFooter: true,
//     columnDefs:[
//     { name:'id' , displayName:'NumberTicket' },
//     { name:'subject' },
//     { name:'type', displayName:'StateTicket' },
//     { name:'answerTime' },
//     { name:'qualityOfService' },
//     { name:'department' },
//    ],
// 	  data : 'miembros'
//
// 	};

}]);
