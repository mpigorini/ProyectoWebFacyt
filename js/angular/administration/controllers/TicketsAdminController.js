angular
    .module('helpDesk')
    .controller('TicketsAdminController', ticketsAdministration);

ticketsAdministration.$inject = ['$scope', '$rootScope', '$http'];

function ticketsAdministration($scope, $rootScope, $http) {
    'use strict';
    // show administration option as active
    $rootScope.select(2);
    $scope.ticketSelected = false;
    $scope.edit = false;
    $scope.states="";
    $scope.tabs=[];
    $scope.selected = [];
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
        $scope.ticketSelected = true;
        
    }
    
     $scope.save = function() {
           
               
            swal({
                title: "Confirmación",
                text: "Su actualizara el ticke con el asunto "+$scope.model.subject+" de solicitud será creada. ¿Desea proceder?" ,
                type: "info",
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: true,
                
            }, function() {
                    $http.get('index.php/administration/TicketsAdminController/save',{params:$scope.model})
                        .then(function(response) {
                            console.log(response)
                            if (response.data.message == "success") {
                                swal("Ticket Actualizado", "El ticket se ha actualizado exitosamente.", "success");
                            } else {
                                swal("Oops!", "Ha ocurrido un error y su solicitud no ha podido ser procesada. Por favor intente más tarde.", "error");
                            }
                    }) 

            });
    }
    
    $scope.clearModel = function() {
        $scope.ticketSelected = false;
        $scope.selected = [];
    }
    $scope.deselectItem = function() {
        $scope.ticketSelected = false;
    }
    
    $scope.viewMode = function() {
        $scope.edit = false;
    }
    
    $scope.editMode = function(){
        $scope.edit =true;
    }
  
    
}