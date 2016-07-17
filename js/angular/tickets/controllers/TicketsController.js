angular
    .module('helpDesk')
    .controller('TicketsController', tickets);

tickets.$inject = ['$scope', '$rootScope', '$http', '$cookies'];

function tickets($scope, $rootScope, $http, $cookies) {
    'use strict';
    // show Tickets option as active
    $rootScope.select(1);
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
                console.log($scope.states);
                // put all tickets (regardless of state) from this user in a single container
                $scope.tickets = [];
                for (var i = 0; i < $scope.states.length; i++) {
                    console.log($scope.states[i].table);
                    if (typeof $scope.states[i].table !== "undefined") {
                        // found a table for this state
                        for (var j = 0; j < $scope.states[i].table.length; j++) {
                            $scope.tickets.push($scope.states[i].table[j]);
                        }
                    }
                }
                console.log($scope.tickets);
                $scope.loading = false

            }
        });
    $http.get('index.php/tickets/TicketsController/getActiveQoS')
        .then(function(response) {
            if(response.data.message=="success") {
                $scope.config = response.data;
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


    $scope.selectItem = function(item,key) {
        console.log(item);
        $scope.model.id = item.id;
        $scope.model.paddedId = item.paddedId;
        $scope.model.subject = item.subject;
        $scope.model.description =item.description;
        $scope.model.type = item.type;
        $scope.model.level = item.level;
        $scope.model.priority = item.priority;
        $scope.model.state = item.state;
        $scope.model.answerTime = item.asweTime;
        $scope.model.qualityOfService = item.qualityOfService;
        $scope.model.userAssigned = item.userAssigned ? item.userAssigned : null;
        $scope.model.evlauation = item.evaluation;
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

            swal({
                title: "Confirmación",
                text: "Su actualizara el ticket con el asunto "+$scope.model.subject+" de solicitud será creada. ¿Desea proceder?" ,
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
                            if (response.data.message == "success") {
                                swal("Ticket Actualizado", "El ticket se ha actualizado exitosamente.", "success");
                            } else {
                                swal("Oops!", "Ha ocurrido un error y su solicitud no ha podido ser procesada. Por favor intente más tarde.", "error");
                            }
                    })

            });
    }

    $scope.getUsers = function (filter) {

        $scope.filter = filter;
        var result = filter ? $scope.users.filter(filterForName) : $scope.users;

        return result;

    }

    function filterForName(user) {

        var filter = angular.lowercase($scope.filter);
        return user.value.indexOf(filter) >= 0;

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
