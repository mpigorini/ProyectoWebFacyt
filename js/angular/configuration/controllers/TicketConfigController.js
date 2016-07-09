angular.module('helpDesk').controller('TicketConfigController',
    ['$scope', '$rootScope','$http',
        function($scope, $rootScope, $http) {
            // show configuration option as active
            $rootScope.select(3);
            $scope.edit = false;
            $scope.model =null;
            $http.get('index.php/configuration/TicketsConfigController/getTicketTypes')
                .then(function(response){
                    if(response.data.message === "success"){
                        $scope.ticketTypes = response.data.data;
                    }
                })
            
            
            $scope.loadTicketType = function(id){
                var obj = $scope.ticketTypes;
                $scope.model={};
                $scope.model.id = obj[id].id;
                $scope.model.name = obj[id].name;
                $scope.model.states = obj[id].states;
                $scope.model.types = obj[id].types;
                $scope.model.priorities = obj[id].priorities;
                $scope.model.levels = obj[id].levels;
                $scope.model.active = obj[id].active;
                $scope.model.answerTimes = obj[id].answerTimes;
            }
            
            $scope.save = function() {
                if ($scope.model.name == null ||
                    $scope.model.states == null ||
                    $scope.model.types == null ||
                    $scope.model.priorities == null ||
                    $scope.model.levels == null ||
                    $scope.model.answerTimes == null) {
                        swal("Falta información", "Debe proveer toda la información solicitada", "error");
                } else {
                    swal({
                        title: "Confirmación",
                        text: $scope.model.id === "undefined" ? "Su nueva configuración de solicitud será creada. ¿Desea proceder?" : "Se actualizara la configuracion "+$scope.model.name+". ¿Desea proceder?",
                        type: "info",
                        confirmButtonText: "Sí",
                        cancelButtonText: "No",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        showLoaderOnConfirm: true,
                        
                    }, function(){
                            $http.get('index.php/configuration/TicketsConfigController/save',{params:$scope.model})
                                .then(function(response) {
                                    console.log(response)
                                    if (response.data.message == "success") {
                                        $scope.edit = false;
                                        $scope.model =null;
                                        $http.get('index.php/configuration/TicketsConfigController/getTicketTypes')
                                            .then(function(response){
                                                if(response.data.message === "success"){
                                                    $scope.ticketTypes = response.data.data;
                                                    console.log("tickets type:" + $scope.ticketTypes);
                                                    swal("Configuración creada", "Su nueva configuración para tickets ha sido creada exitosamente.", "success");
                                                } else {
                                                    swal("Oops!", "Su solicitud fue procesada, pero ha ocurrido un error actualizando los datos.", "error");
                                                }
                                            });
                                    } else {
                                        swal("Oops!", "Ha ocurrido un error y su solicitud no ha podido ser procesada. Por favor intente más tarde.", "error");
                                    }
                            }) 
    
                    });
                }
            }
            
            $scope.delete = function(index){
                       swal({
                        title: "Confirmación",
                        text: "Se va a eliminar la configuracion "+$scope.ticketTypes[index].name+". ¿Desea proceder?",
                        type: "info",
                        confirmButtonText: "Sí",
                        cancelButtonText: "No",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        showLoaderOnConfirm: true,
                        
                    }, function(){
                            $http.get('index.php/configuration/TicketsConfigController/delete',{params:{id:$scope.ticketTypes[index].id}})
                                .then(function(response) {
                                    console.log(response)
                                    if (response.data.message == "success") {
                                       $http.get('index.php/configuration/TicketsConfigController/getTicketTypes')
                                        .then(function(response){
                                            if(response.data.message === "success"){
                                                $scope.ticketTypes = response.data.data;
                                            }
                                        })
                                        swal("Configuración eliminada", "La configuración selecionada ha sido eliminada exitosamente.", "success");
                                    } else {
                                        swal("Oops!", "Ha ocurrido un error y su solicitud no ha podido ser procesada. Por favor intente más tarde.", "error");
                                    }
                            }) 
    
                    });
            }
            $scope.newTicketType = function(){
                $scope.model={};
                $scope.edit=true;
            }
            $scope.viewMode = function() {
                $scope.edit = false;
            }
            $scope.editMode = function(){
                $scope.edit =true;
            }
            
        }
    ]
);