angular
    .module('helpDesk')
    .controller('TicketsController', tickets);

tickets.$inject = ['$scope', '$rootScope', '$http', '$cookies'];

function tickets($scope, $rootScope, $http, $cookies) {
    'use strict';
    //cerramos automáticamente el mobile sideNav
    $('.button-collapse').sideNav('hide');
    // show Tickets option as active
    $rootScope.select(1);
    $scope.loading = true;
    $scope.ticketSelected = false;
    $scope.edit = false;
    $scope.states="";
    $scope.tabs=[];
    $scope.selected = [];
    var userId = $cookies.getObject("session").id;

    $http.get('index.php/tickets/TicketsController/getStates',{params:{userId:userId}})
        .then(function (response){
            if (response.data.message== "success") {
                $scope.states = response.data.states;
                $scope.tickets = response.data.tickets;
                console.log($scope.states);
                console.log($scope.tickets);
                $scope.loading = false;

            }
        });
    $http.get('index.php/tickets/TicketsController/getActiveQoS')
        .then(function(response) {
            if(response.data.message=="success") {
                $scope.qualityOfServices = response.data.qualityOfServices;
                console.log($scope.qualityOfServices);
            }
        });

   $scope.show = function() {
       console.log($scope.selected);
   }
    $scope.query = {
        order: 'subject',
        limit: 5,
        page: 1
    };

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
        $scope.model.answerTime = item.answerTime;
        $scope.model.qualityOfService = item.qualityOfService;
        $scope.model.userAssigned = item.userAssigned ? item.userAssigned.showName : null;
        $scope.model.evaluation = item.evaluation;
        $scope.searchText = "";

        if(item.submitDate != null) {
          var date = new Date(item.submitDate.date);
          // The getMonth() method returns the month (from 0 to 11) for the specified date, according to local time.
          $scope.model.submitDate = date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();
        }
        if(item.closeDate != null) {
          var  date =  new Date(item.closeDate.date);
          // The getMonth() method returns the month (from 0 to 11) for the specified date, according to local time.
           $scope.model.closeDate = date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();
        }else {
            $scope.model.closeDate = "";
        }
        $scope.model.department = item.department;
        $scope.model.userReporter = item.userReporter
        $scope.ticketSelected = true;

    }

     $scope.save = function() {
            console.log($scope.model.qualityOfService);
            swal({
                title: "Confirmación",
                text: "Se enviará la evaluación para el ticket con asunto "+$scope.model.subject+". ¿Desea proceder?" ,
                type: "info",
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: true,

            }, function() {
                    $http.get('index.php/tickets/TicketsController/save',{params:$scope.model})
                        .then(function(response) {
                            if (response.data.message == "success") {
                                $http.get('index.php/tickets/TicketsController/getStates',{params:{userId:userId}})
                                    .then(function (response){
                                        if (response.data.message== "success") {
                                            var states = response.data.states;
                                            console.log(states);
                                            // Render UI
                                            var tickets = response.data.tickets;
                                            for (var i = 0; i < states.length; i++) {
                                                if (typeof states[i].table !== "undefined") {
                                                    // found a table for this state
                                                    for (var j = 0; j < states[i].table.length; j++) {
                                                        $scope.states[i].table[j] = states[i].table[j];
                                                    }
                                                }
                                            }
                                            $scope.tickets = tickets;
                                            console.log($scope.tickets);
                                        }
                                    });
                                swal("Evaluación enviada", "Su evaluación ha sido enviada exitosamente. ¡Gracias!.", "success");
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
        $scope.edit = true;
    }
}
