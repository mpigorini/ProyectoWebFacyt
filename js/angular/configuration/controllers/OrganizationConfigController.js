angular
    .module('helpDesk')
    .controller('OrganizationConfigController', organizationConfiguration);

organizationConfiguration.$inject = ['$scope', '$rootScope', '$http'];

function organizationConfiguration($scope, $rootScope, $http) {
    'use strict';
    // show configuration option as active
    $rootScope.select(3);
    $scope.editDepartment = false;
    $scope.editPosition = false;
    $scope.department = {};
    $scope.position = {};
    $('.tooltipped').tooltip({delay: 50});
    $http.get('index.php/configuration/OrganizationConfigController/getAllDepartments')
    	.then(function(response) {
            if(response.data.message == "success") {
                $scope.departments = response.data.data;
                console.log("response: " + response);
            }
        });
        
    $scope.loadDepartment = function(id) {
        var obj = $scope.departments;
        $scope.department = {};
        $scope.department.id = obj[id].id;
        $scope.department.name = obj[id].name;
        $scope.department.description = obj[id].description;
        $scope.department.positions = obj[id].positions;
        if ($scope.department.positions == null) {
            $scope.department.positions = {};
        }
        $('.tooltipped').tooltip('remove');
    }
    
    $scope.loadPosition = function(id) {
        var obj = $scope.department.positions[id];
        $scope.position = {};
        $scope.position.id = obj.id;
        $scope.position.name = obj.name;
        $scope.position.description = obj.description;
    }
    
    $scope.saveDepartment = function() {
        if ($scope.department.name == null || $scope.department.description == null
            || $scope.department.name == "" || $scope.department.description == "") {
            swal("Falta información", "Debe proveer toda la información solicitada", "error");
        } else {
            swal({
                title: "Confirmación",
                text: "Su nuevo departamento será creado. ¿Desea proceder?",
                type: "info",
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: true,
                
            }, function(){
                    $http.get('index.php/configuration/OrganizationConfigController/saveDepartment',{params:$scope.department})
                        .then(function(response) {
                            console.log(response)
                            if (response.data.message == "success") {
                                    $scope.editDepartment = false;
                                    $scope.editPosition = false;
                                    $scope.department = {};
                                    $scope.position = {};
                                    $('.tooltipped').tooltip({delay: 50});
                                    // refresh the data
                                    $http.get('index.php/configuration/OrganizationConfigController/getAllDepartments')
                                    	.then(function(response) {
                                            if(response.data.message == "success") {
                                                $scope.departments = response.data.data;
                                                console.log("response: " + response);
                                                swal("Departamento creado", "Su nuevo departamento ha sido creado exitosamente.", "success");
                                            } else {
                                                swal("Oops!", "Su nuevo departamento ha sido creado, pero ha ocurrido un error actualizando los datos.", "error");
                                            }
                                        });
                            } else {
                                swal("Oops!", "Ha ocurrido un error y su solicitud no ha podido ser procesada. Por favor intente más tarde.", "error");
                            }
                    }) 
    
            });
        }
    }
    
    $scope.savePosition = function() {
        if ($scope.position.name == null || $scope.position.description == null 
            || $scope.position.name == "" || $scope.position.description == "") {
            swal("Falta información", "Debe proveer toda la información solicitada", "error");
        } else {
            swal({
                title: "Confirmación",
                text: "El cargo " + $scope.position.name + " será agregado al Departamento de " + $scope.department.name + ". ¿Desea proceder?",
                type: "info",
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                showLoaderOnConfirm: true,
                
            }, function() {
                $scope.position.department = $scope.department.id;
                    $http.get('index.php/configuration/OrganizationConfigController/savePosition',{params:$scope.position})
                        .then(function(response) {
                            console.log(response)
                            if (response.data.message == "success") {
                                    $scope.editPosition = false;
                                    $scope.position = {};
                                    // refresh the data
                                    $http.get('index.php/configuration/OrganizationConfigController/getAllPositions',{params:{department : $scope.department.id}})
                                    	.then(function(response) {
                                            if(response.data.message == "success") {
                                                $scope.department.positions = response.data.data;
                                                console.log("response: " + response);
                                                swal("Cargo creado", "Su nuevo cargo ha sido creado exitosamente.", "success");
                                            } else {
                                                swal("Oops!", "Su nuevo cargo ha sido creado, pero ha ocurrido un error actualizando los datos.", "error");
                                            }
                                        });
                            } else {
                                swal("Oops!", "Ha ocurrido un error y su solicitud no ha podido ser procesada. Por favor intente más tarde.", "error");
                            }
                    }) 
    
            });
        }
    }
    
    $scope.deletePosition = function(id) {
        var position = $scope.department.positions[id];
        swal({
            title: "Advertencia",
            text: "El cargo \"" + position.name + "\" será eliminado del Departamento de " + $scope.department.name + ". ¿Desea proceder?",
            type: "warning",
            confirmButtonText: "Sí",
            cancelButtonText: "No",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            showLoaderOnConfirm: true,
            
        }, function() {
                $http.get('index.php/configuration/OrganizationConfigController/deletePosition',{params:position})
                    .then(function(response) {
                        console.log(response)
                        if (response.data.message == "success") {
                                $scope.editPosition = false;
                                $scope.position = {};
                                // refresh the data
                                $http.get('index.php/configuration/OrganizationConfigController/getAllPositions',{params:{department : $scope.department.id}})
                                	.then(function(response) {
                                        if(response.data.message == "success") {
                                            $scope.department.positions = response.data.data;
                                            console.log("response: " + response);
                                            swal("Cargo eliminado", "Su cargo ha sido eliminado exitosamente", "success");
                                        } else {
                                            swal("Oops!", "Su cargo ha sido eliminado, pero ha ocurrido un error actualizando los datos.", "error");
                                        }
                                    });
                        } else {
                            swal("Oops!", "Ha ocurrido un error y su solicitud no ha podido ser procesada. Por favor intente más tarde.", "error");
                        }
                }) 

        });
    }
    
    $scope.deleteDepartment = function(id) {
        var department = $scope.departments[id];
        swal({
            title: "Advertencia",
            text: "El departamento \"" + department.name + "\" será eliminado, así como todos los cargos asociados a él. ¿Desea proceder?",
            type: "warning",
            confirmButtonText: "Sí",
            cancelButtonText: "No",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            showLoaderOnConfirm: true,
            
        }, function() {
                $http.get('index.php/configuration/OrganizationConfigController/deleteDepartment',{params:department})
                    .then(function(response) {
                        console.log(response)
                        if (response.data.message == "success") {
                            // refresh the data
                            $scope.editDepartment = false;
                            $scope.editPosition = false;
                            $scope.department = {};
                            $scope.position = {};
                            $('.tooltipped').tooltip({delay: 50});
                            // refresh the data
                            $http.get('index.php/configuration/OrganizationConfigController/getAllDepartments')
                            	.then(function(response) {
                                    if(response.data.message == "success") {
                                        $scope.departments = response.data.data;
                                        console.log("response: " + response);
                                        swal("Departamento eliminado", "Su departamento ha sido eliminado exitosamente.", "success");
                                    } else {
                                        swal("Oops!", "Su departamento ha sido eliminado, pero ha ocurrido un error actualizando los datos.", "error");
                                    }
                                });
                        } else {
                            swal("Oops!", "Ha ocurrido un error y su solicitud no ha podido ser procesada. Por favor intente más tarde.", "error");
                        }
                }) 

        });
    }
    
    $scope.isDepartmentLoaded = function() {
        return $scope.department.name != null && $scope.department.description != null;
    }
    
    $scope.isPositionLoaded = function() {
        return $scope.position.name != null && $scope.position.description != null;
    }
    
    $scope.newDepartment = function() {
        $scope.department = {};
        $('.tooltipped').tooltip({delay: 50});
        $scope.editDepartment = true;
    }
    
    $scope.newPosition = function() {
        $scope.position = {};
        $scope.editPosition = true;
    }
    
    $scope.departmentViewMode = function() {
        $scope.editDepartment = false;
    }
    
    $scope.positionViewMode = function() {
        $scope.editPosition = false;
    }
    
    $scope.departmentEditMode = function() {
        $scope.editDepartment = true;
    }
    
    $scope.positionEditMode = function() {
        $scope.editPosition = true;
    }
}