angular.module('helpDesk').controller('TicketConfigController',
    ['$scope', '$rootScope','$http','$mdConstant',
        function($scope, $rootScope, $http, $mdConstant) {
            // show configuration option as active
            $rootScope.select(3);
            $scope.edit = false;
            $scope.model = null;
            $http.get('index.php/configuration/TicketsConfigController/getTicketTypes')
                .then(function(response){
                    if(response.data.message === "success"){
                        $scope.ticketTypes = response.data.data;
                        // Look for active one.
                        for (var i = 0; i < $scope.ticketTypes.length; i++) {
                            if ($scope.ticketTypes[i].active) {
                                $scope.active = i;
                            }
                        }
                    }
                });
            
            // Use common key codes found in $mdConstant.KEY_CODE...
            $scope.keys = [$mdConstant.KEY_CODE.ENTER, $mdConstant.KEY_CODE.COMMA];
            $scope.tags = [];
            // Any key code can be used to create a custom separator
            var semicolon = 186;
            $scope.customKeys = [$mdConstant.KEY_CODE.ENTER, $mdConstant.KEY_CODE.COMMA, semicolon];
            $scope.statesArray = [];
            $scope.typesArray = [];
            $scope.levelsArray = [];
            $scope.prioritiesArray = [];
            $scope.answerTimesArray = []
    
            $scope.loadTicketType = function(id){
                var obj = $scope.ticketTypes;
                $scope.model={};
                $scope.model.id = obj[id].id;
                $scope.model.name = obj[id].name;
                $scope.model.states = obj[id].states;
                console.log(obj[id].states.split(','));
                $scope.statesArray = obj[id].states.split(',');
                $scope.model.types = obj[id].types;
                $scope.typesArray = obj[id].types.split(',');
                $scope.model.priorities = obj[id].priorities;
                $scope.prioritiesArray = obj[id].priorities.split(',');
                $scope.model.levels = obj[id].levels;
                $scope.levelsArray = obj[id].levels.split(',');
                $scope.model.active = obj[id].active;
                $scope.model.answerTimes = obj[id].answerTimes;
                $scope.answerTimesArray = obj[id].answerTimes.split(',');
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
                                                    // Look for active one.
                                                    for (var i = 0; i < $scope.ticketTypes.length; i++) {
                                                        if ($scope.ticketTypes[i].active) {
                                                            $scope.active = i;
                                                        }
                                                    }
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
                    text: "Se va a eliminar la configuración "+$scope.ticketTypes[index].name+". ¿Desea proceder?",
                    type: "warning",
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
                                        if(response.data.message === "success") {
                                            $scope.ticketTypes = response.data.data;
                                           // Look for active one.
                                            for (var i = 0; i < $scope.ticketTypes.length; i++) {
                                                if ($scope.ticketTypes[i].active) {
                                                    $scope.active = i;
                                                }
                                            }
                                        }
                                    })
                                    swal("Configuración eliminada", "La configuración selecionada ha sido eliminada exitosamente.", "success");
                                } else {
                                    swal("Oops!", "Ha ocurrido un error y su solicitud no ha podido ser procesada. Por favor intente más tarde.", "error");
                                }
                        }) 
    
                });
            }
            
            $scope.setAsActive = function(id) {
                // switch off the previous config and switch on selected one
                $scope.ticketTypes[$scope.active].active = false
                $scope.ticketTypes[id].active = true;
                swal({
                    title: "Confirmación",
                    text: "¿La configuración de sus tickets será cambiada por \"" + $scope.ticketTypes[id].name + "\". ¿Desea proceder?",
                    type: "info",
                    confirmButtonText: "Sí",
                    cancelButtonText: "No",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    allowEscapeKey: false,
                    showLoaderOnConfirm: true,
                
                }, function(isConfirm) {
                    if (isConfirm) {
                        $http.get('index.php/configuration/TicketsConfigController/setAsActive',{params:{id:$scope.ticketTypes[id].id, oldId:$scope.ticketTypes[$scope.active].id}})
                            .then(function(response) {
                                console.log(response)
                                if (response.data.message == "success") {
                                   $http.get('index.php/configuration/TicketsConfigController/getTicketTypes')
                                    .then(function(response){
                                        if(response.data.message === "success") {
                                            $scope.ticketTypes = response.data.data;
                                        }
                                    })
                                    swal("Configuración cambiada", "La configuración de los tickets ha sido cambiada exitosamente", "success");
                                } else {
                                    swal("Oops!", "Ha ocurrido un error y su solicitud no ha podido ser procesada. Por favor intente más tarde.", "error");
                                }
                        })
                    } else {
                        // switch on the previous config and switch off selected one
                        $scope.ticketTypes[$scope.active].active = true;
                        $scope.ticketTypes[id].active = false;
                        // refresh
                        $scope.$apply();
                    }
                
                });
            }
            
            $scope.isActive = function(id) {
                return $scope.ticketTypes[id].active;
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