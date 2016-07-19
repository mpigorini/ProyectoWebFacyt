angular
    .module('helpDesk')
    .controller('NewTicketController', newTicket);

newTicket.$inject = ['$scope', '$rootScope', '$http', '$cookies'];

function newTicket($scope, $rootScope, $http, $cookies) {
    'use strict';
    //cerramos automáticamente el mobile sideNav
    $('.button-collapse').sideNav('hide');
    // show NewTicket option as active
    $rootScope.select(4);
    $scope.ticket = {}

    $http.get('index.php/tickets/NewTicketController/getAllDepartments')
    	.then(function(response) {
            if(response.data.message == "success") {
                $scope.departments = response.data.data;
               // There must be at least one value for each parameters,
               // which will be used to initialize the dropdown and avoid
               // empty option.
               $scope.ticket.department = $scope.departments[0];
            }
    });

    $http.get('index.php/tickets/NewTicketController/getConfiguration')
        .then(function(response) {
            if (response.data.message == "success") {
               $scope.config = response.data;
               // There must be at least one value for each parameters,
               // which will be used to initialize the dropdown and avoid
               // empty option.
               $scope.ticket.type = $scope.config.types[0];
               $scope.ticket.priority = $scope.config.priorities[0];
               $scope.ticket.level = $scope.config.levels[0];
            }
    });

    $scope.saveTicket = function() {
        $scope.ticket.user = $cookies.getObject("session").id;
        $scope.ticket.state = "En espera";
        console.log("ticket department: " + $scope.ticket.department);
        console.log("ticket type: " + $scope.ticket.type);
        console.log("ticket level: " + $scope.ticket.level);
        console.log("ticket priority: " + $scope.ticket.priority);
        console.log("ticket subject: " + $scope.ticket.subject);
        console.log("ticket description: " + $scope.ticket.description);
        console.log("ticket state: " + $scope.ticket.state);
        console.log("user reporter ID: " + $scope.ticket.user);

        if ($scope.ticket.subject == null
            || $scope.ticket.description == null
            || $scope.ticket.type == null
            || $scope.ticket.level == null
            || $scope.ticket.department == null
            || $scope.ticket.priority == null
            || $scope.ticket.subject == ""
            || $scope.ticket.description == ""
            || $scope.ticket.type == ""
            || $scope.ticket.level == ""
            || $scope.ticket.department == ""
            || $scope.ticket.priority == "") {
            swal("Falta información", "Debe proveer toda la información solicitada", "error");
        } else {
            swal({
                title: "Confirmación",
                text: "Su ticket será enviado. ¿Desea proceder?",
                type: "info",
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: true,

            }, function() {
                    $http.get('index.php/tickets/NewTicketController/saveTicket',{params:$scope.ticket})
                        .then(function(response) {
                            console.log(response)
                            if (response.data.message == "success") {
                                swal({
                                    title: "Incidente <b>#"+ response.data.paddedId +"</b> reportado",
                                    text: "Su ticket ha sido enviado exitosamente bajo el ID <b>#"+response.data.paddedId+"</b>. Nuestro técnicos analizarán el problema a la mayor brevedad posible.",
                                    html: true,
                                    type: "success"
                                });
                            } else {
                                swal("Oops!", "Ha ocurrido un error y su solicitud no ha podido ser procesada. Por favor intente más tarde.", "error");
                            }
                    })

            });
        }

    }

}
