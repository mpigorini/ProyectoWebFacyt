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
    }
    
    $scope.loadPosition = function(id) {
        var obj = $scope.departments[id].positions;
        $scope.position = {};
        $scope.position.id = obj.id;
        $scope.position.name = obj.name;
        $scope.position.description = obj.description;
        $scope.position.department = $scope.departments[id].id;
    }
    
    $scope.saveDepartment = function() {
        if ($scope.department.name == null || $scope.department.description == null) {
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
        if ($scope.position.name == null || $scope.position.description == null) {
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
                                    $http.get('index.php/configuration/OrganizationConfigController/getAllPositions')
                                    	.then(function(response) {
                                            if(response.data.message == "success") {
                                                $scope.departments = response.data.data;
                                                console.log("response: " + response);
                                                swal("Cargo creado", "Su nuevo departamento ha sido creado exitosamente.", "success");
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
    
    $scope.isDepartmentLoaded = function() {
        return $scope.department.name != null && $scope.department.description != null;
    }
    
    $scope.isPositionLoaded = function() {
        return $scope.position.name != null && $scope.position.description != null;
    }
    
    $scope.newDepartment = function() {
        $scope.department = {};
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