angular
    .module('helpDesk')
    .controller('TicketsAdminController', ticketsAdministration);

ticketsAdministration.$inject = ['$scope', '$rootScope', '$http'];

function ticketsAdministration($scope, $rootScope, $http) {
    'use strict';
    // show administration option as active
    $rootScope.select(2);
    $scope.states="";
    $scope.model.closeDate = new Date();
    $scope.tabs=[];
    $http.get('index.php/administration/TicketsAdminController/getStates')
        .then(function (response){
            if (response.data.message== "success") {
                $scope.states = response.data.states;
                console.log($scope.states);
                $scope.loading = false
                
            }
        })
    $http.get('index.php/administration/TicketsAdminController/getTickets')
        .then(function (response){
            if(response.data.message == "success") {
               $scope.tickets = response.data.tickets; 
              
                console.log($scope.tickets);
               console.log($scope.states);
            }
        })
    $http.get('index.php/administration/TicketsAdminController/getConfiguration')
        .then(function(response) {
            if(response.data.message=="success") {
                $scope.config = response.data;
            }
        })
    $scope.selected = [];
    
   $scope.show = function() {
       console.log($scope.selected);
   }
    $scope.query = {
        order: 'subject',
        limit: 5,
        page: 1
    };

    
    $scope.selectItem = function(item,key) {
        console.log(item);
        $scope.model.id = item.id;
        $scope.model.subject = item.subject;
        $scope.model.description =item.description;
        $scope.model.type = item.type;
        $scope.model.level = item.level;
        $scope.model.priority = item.priority;
        $scope.model.state = item.state;
        $scope.model.answerTime = item.asweTime;
        $scope.model.qualityOfService = item.qualityOfService;
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
        
    }

  
    
}