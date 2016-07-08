angular
    .module('helpDesk')
    .controller('UsersAdminController', usersAdministration);

usersAdministration.$inject = ['$scope', '$rootScope', '$http', '$cookies'];

function usersAdministration($scope, $rootScope, $http, $cookies) {
    'use strict';
    // show administration option as active
    $rootScope.select(2);
    $scope.editUser = false;
    // load all the users
    $http.get('index.php/administration/UsersAdminController/getAllUsers')
    	.then(function(response) {
            if(response.data.message == "success") {
                $scope.users = response.data.data;
                console.log("response: " + response);
            }
        });
    // load all the departments and his positions
    $http.get('index.php/administration/UsersAdminController/getAllDepartments')
    	.then(function(response) {
            if(response.data.message == "success") {
                $scope.departments = response.data.data;
                console.log("response: " + response);
                console.log("$scope.departments:" + $scope.departments)
                console.log("$scope.departments[0].id:" + $scope.departments[0].id)
                console.log("$scope.departments[0].name:" + $scope.departments[0].name)
                console.log("$scope.departments[0].positions[0].name:" + $scope.departments[0].positions[0].name)
                console.log("$scope.departments[0].positions[1].name:" + $scope.departments[0].positions[1].name)
            }
        });         

    $scope.loadUser = function(id) {
    	console.log("id: " + id);
        var object = $scope.users;
        console.log("object[id].id: " + object[id].id);
        $scope.user = {};
        $scope.user.id = object[id].id;
        $scope.user.login = object[id].login;
        $scope.user.password = object[id].password;
        $scope.user.name = object[id].name;
        $scope.user.lastname = object[id].lastname;
        $scope.user.cedula = object[id].cedula;
        $scope.user.phone = object[id].phone;
        $scope.user.type = object[id].type;
        $scope.user.department = object[id].department;
        $scope.user.position = object[id].position;
    }

    $scope.updateUser = function() {
    	console.log("$scope.user.id: " + $scope.user.id)
    	console.log("$scope.user.login: " + $scope.user.login)
        console.log("$scope.user.password: " + $scope.user.password)
        console.log("$scope.user.name: " + $scope.user.name)
        console.log("$scope.user.lastname: " + $scope.user.lastname)
        console.log("$scope.user.cedula: " + $scope.user.cedula)
        console.log("$scope.user.phone: " + $scope.user.phone)
        console.log("$scope.user.position: " + $scope.user.position)
        console.log("$scope.user.department: " + $scope.user.department)
        console.log("$scope.user.type: " + $scope.user.type)
        console.log("$scope.user.newType: " + $scope.user.newType)
    } 

    $scope.deleteUser = function(id) {
    	console.log("id: " + id);
    }

    $scope.userEditMode = function(id) {
        $scope.editUser = true;
        $scope.loadUser(id);
    }
   	$scope.userViewMode = function() {
        $scope.editUser = false;
    }
}