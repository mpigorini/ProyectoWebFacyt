angular
    .module('helpDesk')
    .controller('OrganizationConfiguration', organizationConfiguration);

organizationConfiguration.$inject = ['$scope', '$rootScope', '$http'];

function organizationConfiguration($scope, $rootScope, $http) {
    'use strict';
    // show configuration option as active
    $rootScope.select(3);
    $http.get('index.php/configuration/OrganizationConfiguration/getAllDepartments')
    	.then(function(response) {
            console.log("response: " + response);
            console.log("entré? " + response.data.here);
            var departments = response.data.departments;
            console.log("Departments: " + departments.length);
            for(var i=0; i<departments.length; i++) {
                console.log("department " + i + ": " + departments[i]);
            }
            if(response.data.message == "success") {
            	sweetAlert("!Felicidades!", "La consulta a la base de datos se realizó exitosamente", "success");
            }else{
            	sweetAlert("Oops...", "Ha ocurrido un problema al cargar tus datos de usuario", "error");
            }
        }, function (response){
            
        });
}