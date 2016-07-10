angular.module('helpDesk').controller('TicketConfigController',
    ['$scope', '$rootScope','$http','$mdConstant',
        function($scope, $rootScope, $http, $mdConstant) {
            // show configuration option as active
            $rootScope.select(3);
            $scope.edit = false;
            // initialize chips containers
            initializeChipsContainers();
            // Use common key codes found in $mdConstant.KEY_CODE...
            $scope.keys = [$mdConstant.KEY_CODE.ENTER, $mdConstant.KEY_CODE.COMMA];
            $scope.tags = [];
            // Any key code can be used to create a custom separator
            var semicolon = 186;
            $scope.customKeys = [$mdConstant.KEY_CODE.ENTER, $mdConstant.KEY_CODE.COMMA, semicolon];

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
    
            $scope.loadTicketType = function(id) {
                var obj = $scope.ticketTypes;
                $scope.model={};
                $scope.model.id = obj[id].id;
                $scope.model.name = obj[id].name;
                $scope.model.states = obj[id].states.split(',');
                $scope.model.types = obj[id].types.split(',');
                $scope.model.priorities = obj[id].priorities.split(',');
                $scope.model.levels = obj[id].levels.split(',');
                $scope.model.answerTimes = obj[id].answerTimes.split(',');
                $scope.model.active = obj[id].active;
                // default state array for loaded tickets will always be first and last index.
                $scope.defaultStates = [$scope.model.states[0], $scope.model.states[$scope.model.states.length-1]]
                 // remove default values from model var.
                $scope.model.states.splice(0, 1);
                $scope.model.states.splice($scope.model.states.length-1, 1);
            }
            
            // helper function that initializes chip containers
            function initializeChipsContainers() {
                $scope.model = {};
                $scope.model.states = [];
                $scope.model.types = [];
                $scope.model.levels = [];
                $scope.model.priorities = [];
                $scope.model.answerTimes = [];
                // default states array
                $scope.defaultStates = ["En espera", "Cerrado"];
            }
            
            $scope.check = function(id) {
                console.log("Checked chip index: " + id);
            }
            
            $scope.save = function() {
                if ($scope.model.name == null ||
                    $scope.model.states == null ||
                    $scope.model.types == null ||
                    $scope.model.priorities == null ||
                    $scope.model.levels == null ||
                    $scope.model.answerTimes == null ||
                    $scope.model.name == ""
                    || $scope.model.states.length == 0
                    || $scope.model.types.length == 0
                    || $scope.model.levels.length == 0
                    || $scope.model.priorities.length == 0
                    || $scope.model.answerTimes.length == 0) {
                        swal("Falta información", "Debe proveer toda la información solicitada", "error");
                } else {
                    var result = parseResult();
                    // console.log(result);
                    swal({
                        title: "Confirmación",
                        text: typeof result.id === "undefined" ? "Su nueva configuración de solicitud será creada. ¿Desea proceder?" : "Se actualizara la configuracion "+result.name+". ¿Desea proceder?",
                        type: "info",
                        confirmButtonText: "Sí",
                        cancelButtonText: "No",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        showLoaderOnConfirm: true,
                        
                    }, function() {
                            $http.get('index.php/configuration/TicketsConfigController/save',{params:result})
                                .then(function(response) {
                                    console.log(response)
                                    if (response.data.message == "success") {
                                        $http.get('index.php/configuration/TicketsConfigController/getTicketTypes')
                                            .then(function(response){
                                                if(response.data.message === "success") {
                                                    $scope.ticketTypes = response.data.data;
                                                    $scope.edit = false;
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
            
            function parseResult() {
                var obj = {};
                obj.id = $scope.model.id;
                obj.name = $scope.model.name;
                // parse types
                obj.types = $scope.model.types.toString();
                // parse states. Must joint default states
                obj.states = parseStates($scope.model.states);
                // console.log("states: " + obj.states);
                // parse levels
                obj.levels = $scope.model.levels.toString();
                // parse priorities
                obj.priorities = $scope.model.priorities.toString();
                // parse answerTimes
                obj.answerTimes = $scope.model.answerTimes.toString();

                return obj;
            }
            
            function parseStates(array) {
                var result = "";
                // First must be the default's first index
                result = result + $scope.defaultStates[0] + ",";
                result = result + array.toString() + ",";
                // Last must be the default's last index
                result = result + $scope.defaultStates[$scope.defaultStates.length-1];
                return result;
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
                                            $scope.edit = false;
                                            initializeChipsContainers();
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
                $scope.ticketTypes[$scope.active].active = false;
                console.log("Disabling config ID: " + $scope.active);
                $scope.ticketTypes[id].active = true;
                console.log("Enabling config ID: " + id);
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
                                    .then(function(response) {
                                        if(response.data.message === "success") {
                                            $scope.active = id;
                                            $scope.ticketTypes = response.data.data;
                                        }
                                    })
                                    swal("Configuración cambiada", "La configuración de los tickets ha sido cambiada exitosamente", "success");
                                    
                                } else {
                                    swal("Oops!", "Ha ocurrido un error y su solicitud no ha podido ser procesada. Por favor intente más tarde.", "error");
                                    // revert back switching
                                    $scope.ticketTypes[$scope.active].active = true;
                                    $scope.ticketTypes[id].active = false;
                                    // refresh
                                    $scope.$apply();
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
                initializeChipsContainers();
                $scope.edit=true;
            }
            $scope.viewMode = function() {
                $scope.edit = false;
            }
            $scope.editMode = function(){
                $scope.edit =true;
            }
            
            $scope.noUserInput = function() {
                return (
                    ($scope.model.name == null || $scope.model.name == "")
                    && $scope.model.states.length == 0
                    && $scope.model.types.length == 0
                    && $scope.model.levels.length == 0
                    && $scope.model.priorities.length == 0
                    && $scope.model.answerTimes.length == 0);
            }
            
        }
    ]
);