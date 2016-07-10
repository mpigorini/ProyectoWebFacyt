angular
    .module('helpDesk')
    .controller('UsersAdminController', usersAdministration);

usersAdministration.$inject = ['$scope', '$rootScope', '$http', '$cookies'];

function usersAdministration($scope, $rootScope, $http, $cookies) {
    'use strict';
    // show administration option as active
    $rootScope.select(2);
    $scope.user = {};
    $scope.editUser = false;
    $scope.notOld = true;
    $scope.selectType = ["Gerente", "Coordinador de sistema", "Técnico", "Solicitante"];

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
                console.log("$scope.departments[0]:" + $scope.departments[0])
                console.log("$scope.departments[0].id:" + $scope.departments[0].id)
                console.log("$scope.departments[0].name:" + $scope.departments[0].name)
                console.log("$scope.departments[0].positions[0].name:" + $scope.departments[0].positions[0].name)
                console.log("$scope.departments[0].positions[1].name:" + $scope.departments[0].positions[1].name)
            }
        });	

    $scope.loadUser = function(id) {
    	console.log("id: " + id);
        var object = $scope.users;
        //
        var sizeUsers = Object.keys($scope.users).length, i=-1, flagUser = true;
        console.log("sizeUsers: " + sizeUsers);
        console.log("id: " + id);
        while ( (i<sizeUsers) && (flagUser) ){
        	i++;
        	if ($scope.users[i].id == id){
        		console.log("VALOR DE i: " + i);
        		flagUser = false;
        	}
        }
        //
        $scope.user = {};
        $scope.user.id = object[i].id;
        $scope.user.login = object[i].login;
        $scope.user.password = object[i].password;
        $scope.user.name = object[i].name;
        $scope.user.lastname = object[i].lastname;
        $scope.user.cedula = parseInt(object[i].cedula, 10);
        $scope.user.phone = parseInt(object[i].phone, 10);
        $scope.user.type = object[i].type;
        $scope.user.department = object[i].department;
        $scope.user.position = object[i].position;
        $scope.labelName = object[i].name;
        $scope.labelLastname = object[i].lastname;
    }

    $scope.checkUpdateUser = function() {
    	// console.log("$scope.user.id: " + $scope.user.id)
    	// console.log("$scope.user.login: " + $scope.user.login)
     //    console.log("$scope.user.password: " + $scope.user.password)
     //    console.log("$scope.user.name: " + $scope.user.name)
     //    console.log("$scope.user.lastname: " + $scope.user.lastname)
     //    console.log("$scope.user.cedula: " + $scope.user.cedula)
     //    console.log("$scope.user.phone: " + $scope.user.phone)
     //    //the select options...
     //    console.log("$scope.user.position: " + $scope.user.position)
     //    console.log("$scope.user.department: " + $scope.user.department)
     //    console.log("$scope.user.type: " + $scope.user.type)
     //    console.log("$scope.user.newPosition: " + $scope.user.newPosition)
     //    console.log("$scope.user.newDepartment: " + $scope.user.newDepartment)
     //    console.log("$scope.user.newType: " + $scope.user.newType)

	    if( ($scope.user.login==undefined) || ($scope.user.login=="") ||
	    		($scope.user.password==undefined) || ($scope.user.password=="") ||
	    		($scope.user.name==undefined) || ($scope.user.name=="") ||
	    		($scope.user.lastname==undefined) || ($scope.user.lastname=="") ||
	    		($scope.user.phone==undefined) || ($scope.user.phone=="") ||
	    		($scope.user.cedula==undefined) || ($scope.user.cedula=="") ){
	            sweetAlert("Oops...", "Asegúrese de que ningún campo se encuentre vació.", "error");
	    }else{
	        //solving the type of the user
	        if( $scope.user.newType==undefined ) {
	        	$scope.user.updateType = $scope.user.type;
	        	console.log("$scope.user.updateType: " + $scope.user.updateType)
	        } else {
	        	$scope.user.updateType = $scope.user.newType;
	        	console.log("$scope.user.updateType: " + $scope.user.updateType)
	        }
	        $scope.solvingType($scope.user.updateType);

	        //solving the department-position of the users whit the index
	        if( ( $scope.user.newDepartment == undefined ) || ( $scope.user.newDepartment == null ) ) {
	        	$scope.user.updateDepartment = $scope.user.department;
	        	$scope.user.updatePosition = $scope.user.position;
	        	$scope.findIndex();
	        	console.log("$scope.user.updateDepartment: " + $scope.user.updateDepartment)
	        	console.log("$scope.user.updatePosition: " + $scope.user.updatePosition)
	        	// update users info
	        	$scope.updateUser();
	        } else if ( ( $scope.user.newPosition == undefined ) || ( $scope.user.newPosition == null ) ){
	        	sweetAlert("Oops...", "Asegúrese de elegir el CARGO.", "error");
	        } else {
	        	$scope.user.updateDepartment = $scope.user.newDepartment;
	        	$scope.user.updatePosition = $scope.user.newPosition;
	        	$scope.findIndex();
	        	// console.log("$scope.user.updateDepartment: " + $scope.user.updateDepartment)
	        	// console.log("$scope.user.updatePosition: " + $scope.user.updatePosition)
	        	// update users info
	        	$scope.updateUser();
	        }
    	}
    }

    $scope.checkNewUser = function () {
    	//new user, id dont exist
    	$scope.user.id = "";
    	console.log("$scope.user.id: " + $scope.user.id)
    	console.log("$scope.user.login: " + $scope.user.login)
        console.log("$scope.user.password: " + $scope.user.password)
        console.log("$scope.user.name: " + $scope.user.name)
        console.log("$scope.user.lastname: " + $scope.user.lastname)
        console.log("$scope.user.cedula: " + $scope.user.cedula)
        console.log("$scope.user.phone: " + $scope.user.phone)
        //the select options...
        console.log("$scope.user.newPosition: " + $scope.user.newPosition)
        console.log("$scope.user.newDepartment: " + $scope.user.newDepartment)
        console.log("$scope.user.newType: " + $scope.user.newType)

        if( ($scope.user.login==undefined) || ($scope.user.login=="") ||
    		($scope.user.password==undefined) || ($scope.user.password=="") ||
    		($scope.user.name==undefined) || ($scope.user.name=="") ||
    		($scope.user.lastname==undefined) || ($scope.user.lastname=="") ||
    		($scope.user.phone==undefined) || ($scope.user.phone=="") ||
    		($scope.user.cedula==undefined) || ($scope.user.cedula=="") ||
    		($scope.user.newDepartment==undefined) || ($scope.user.newDepartment=="")||
    		($scope.user.newPosition==undefined) || ($scope.user.newPosition=="") ||
    		($scope.user.newType==undefined) || ($scope.user.newType=="") ){
        	sweetAlert("Oops...", "Asegúrese de que ningún campo se encuentre vació.", "error");
        }else{
        	console.log("nuevo user");
        	//solving type
	        $scope.solvingType($scope.user.newType);

	        //solving index
	        $scope.user.updateDepartment = $scope.user.newDepartment;
        	$scope.user.updatePosition = $scope.user.newPosition;
        	console.log("$scope.user.updateDepartment: " + $scope.user.updateDepartment)
        	console.log("$scope.user.updatePosition: " + $scope.user.updatePosition)
        	$scope.findIndex();

        	//saving user
        	$scope.updateUser();

        }
    }

    $scope.findIndex = function() {
    	var size = Object.keys($scope.departments).length;
    	console.log("DEPARTMENTS size: " + size);
    	console.log("$scope.departments[0].name: " + $scope.departments[0].name);
    	var i = 0, flag = true;
        while( ( i < size ) && (flag) ){
        	if( $scope.departments[i].name == $scope.user.updateDepartment ){
        		// $scope.department.positions = obj[i].positions;
        		$scope.user.entityDepartment = $scope.departments[i];
        		$scope.user.indexDepartment = $scope.departments[i].id;
        		flag = false;

        		//
        		var size2 = Object.keys($scope.user.entityDepartment.positions).length;
        		console.log("DEPARTMENTS.POSITIONS size2: " + size2);
        		var j = 0, flag2 = true;
				while( ( j < size2 ) && (flag2) ){
					// console.log("$scope.departments[i].positions[j].name: " + $scope.departments[i].positions[j].name);
		        	if( $scope.departments[i].positions[j].name == $scope.user.updatePosition ){
		        		$scope.user.indexPosition = $scope.departments[i].positions[j].id;
		        		flag2 = false;
		        	}
		        	j++;
		        }
		        //
        	}
        	i++;
        }
        console.log("$scope.user.indexDepartment: " + $scope.user.indexDepartment);
        console.log("$scope.user.indexPosition: " + $scope.user.indexPosition);
    }

    $scope.updateUser = function() {
    	var message, saveOrUpdate;
    	if(!$scope.notOld){
    		message = "¿Estas seguro de que deseas agregar a este usuario?";
    		saveOrUpdate = "Se ha creado el nuevo perfil exitosamente.";
    	}else{
    		message = "¿Estas seguro de que deseas realizar estos cambios?";
    		saveOrUpdate = "El perfil se ha actualizado exitosamente.";
    	}
    	swal({
        	title: message,   
        	text: "Si es así, ingresa tu contraseña...",   
        	type: "input",
        	inputType: "password",   
        	showCancelButton: true,   
        	closeOnConfirm: false,   
        	animation: "slide-from-top",   
        	inputPlaceholder: "Contraseña"
        }, 
        	function(inputValue){
        		if (inputValue === false) return false;      
        		if (inputValue === "") {     
        			swal.showInputError("Debes ingresar tu contraseña");     
        			return false   
        		}else if (inputValue!=$cookies.getObject("session").password){
        			console.log("$cookies.getObject('session').password: " + $cookies.getObject("session").password)
        			swal.showInputError("Contraseña incorrecta");
        		}else{
        			console.log("$scope.user.id: " + $scope.user.id)
					$http.get('index.php/administration/UsersAdminController/saveUser', {params:$scope.user})
                		.then(function(response) {
							if(response.data.message != "Error") {
								console.log("response.data.message: " + response.data.message)
								$scope.labelName = $scope.user.name;
								$scope.labelLastname = $scope.user.lastname;
								// Esta linea se ejecuta si el usuario se edita a si mismo	
								if ( $scope.user.id == $cookies.getObject("session").id ){
									console.log("Me edite")
									$cookies.putObject('session', {username: $scope.user.login , password:$scope.user.password, id:$scope.user.id});
									console.log("$cookies.getObject('session').login: " + $cookies.getObject("session").username)
									console.log("$cookies.getObject('session').password: " + $cookies.getObject("session").password)
									console.log("$cookies.getObject('session').id: " + $cookies.getObject("session").id)
								}
								// reload the table of users
							    $scope.loadAllUsers();
		                    	swal("Actualizado!", saveOrUpdate, "success");
		                    }else{
		                    	swal("ERROR!", "Ha ocurrido un evento inesperado al tratar de realizar los cambios.", "error");
		                    }
		                }, function (response){
		                    
		                })
	           }
        	})
    }

    $scope.deleteUser = function(id) {
    	console.log("deleteUser id: " + id);
        var sizeUsers = Object.keys($scope.users).length, i=-1, flagUser = true;
        console.log("sizeUsers: " + sizeUsers);
        console.log("id: " + id);
        while ( (i<sizeUsers) && (flagUser) ){
        	i++;
        	if ($scope.users[i].id == id){
        		console.log("VALOR DE i: " + i);
        		flagUser = false;
        	}
        }
        console.log("$scope.users[i].name: " + $scope.users[i].name);
        console.log("$scope.users[i].id: " + $scope.users[i].id);
        $scope.user.deleteId = $scope.users[i].id;
        console.log("$scope.user.deleteId: " + $scope.user.deleteId);
        if ($scope.user.deleteId == $cookies.getObject("session").id ){
        	swal("ERROR!", "No puedes eliminar tu propio usuario", "error");
        }else{
        	console.log("otro user");
        	swal({
	        	title: "¿Estas seguro de que deseas eliminar a este usuario?",   
	        	text: "Si es así, ingresa tu contraseña...",   
	        	type: "input",
	        	inputType: "password",   
	        	showCancelButton: true,   
	        	closeOnConfirm: false,   
	        	animation: "slide-from-top",   
	        	inputPlaceholder: "Contraseña"
	        }, 
	        	function(inputValue){
	        		if (inputValue === false) return false;      
	        		if (inputValue === "") {     
	        			swal.showInputError("Debes ingresar tu contraseña");     
	        			return false   
	        		}else if (inputValue!=$cookies.getObject("session").password){
	        			console.log("$cookies.getObject('session').password: " + $cookies.getObject("session").password)
	        			swal.showInputError("Contraseña incorrecta");
	        		}else{
						$http.get('index.php/administration/UsersAdminController/deleteUser', {params:$scope.user})
	                		.then(function(response) {
								if(response.data.message != "Error") {
									console.log("response.data.message: " + response.data.message)
									// reload the table of users
								    $scope.loadAllUsers();
								    $scope.editUser = false;
			                    	swal("Actualizado!", "El perfil se ha eliminado exitosamente.", "success");
			                    }else{
			                    	swal("ERROR!", "Ha ocurrido un evento inesperado al tratar de realizar los cambios.", "error");
			                    }
			                }, function (response){
			                    
			                })
		           }
	        	})
        }
    }

    $scope.userEditMode = function(id) {
        $scope.editUser = true;
        $scope.notOld = true;
        $scope.loadUser(id);
    }

    $scope.userNewMode = function() {
        $scope.editUser = true;
        $scope.notOld = false;
        $scope.user = {};
    }

   	$scope.userViewMode = function() {
        $scope.editUser = false;
        $scope.user = {};
    }

    $scope.loadPositions = function() {
    	console.log("loadPositions $scope.user.newDepartment: " + $scope.user.newDepartment);

        var obj = $scope.departments;
        $scope.department = {};
        var size = Object.keys(obj).length;
        console.log("loadPositions size: " + size);
        var i = 0, flag = true;
        while( ( i < size ) && (flag) ){
        	if( obj[i].name == $scope.user.newDepartment ){
        		$scope.department.positions = obj[i].positions;
        		flag = false;
        	}
        	i++;
        }
    }

    $scope.loadAllUsers = function () {
    	$http.get('index.php/administration/UsersAdminController/getAllUsers')
    	.then(function(response) {
            if(response.data.message == "success") {
                $scope.users = response.data.data;
                console.log("response: " + response);
            }
        });
    }

    $scope.solvingType = function (type) {
    	switch (type) {
	        	case "Gerente":
	        		$scope.user.updateType = 1;
	        		break;
	        	case "Coordinador de sistema":
	        		$scope.user.updateType = 2;
	        		break;
	        	case "Técnico":
	        		$scope.user.updateType = 3;
	        		break;
	        	case "Solicitante":
	        		$scope.user.updateType = 4;
	        		break;
	        }
	        console.log("!!!$scope.user.updateType: " + $scope.user.updateType)
    }
}