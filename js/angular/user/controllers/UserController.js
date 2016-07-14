angular.module('helpDesk').controller('UserController', 
    ['$rootScope','$scope', '$cookies', '$http',
        function($rootScope, $scope, $cookies, $http) {
			// show my profile option as active
		    $rootScope.select(5);
		    $scope.edit = {};
		    $scope.mode = {};
		    $scope.mode = false;
            var id = $cookies.getObject("session").id;
            console.log("$cookies.getObject('session').id: " + id)
            $http.get('index.php/user/UserController/userInfo', {params:{id: id}})
            	.then(function(response) {
            		//Este monton de console son para estar al tanto de los valores del perfil
                    console.log("response.data.login: " + response.data.login)
                    console.log("$cookies.getObject('session').username: " + $cookies.getObject('session').username)
                    console.log("response.data.password: " + response.data.password)
                    console.log("$cookies.getObject('session').password: " + $cookies.getObject('session').password)
                    console.log("response.data.name: " + response.data.name)
                    console.log("response.data.lastname: " + response.data.lastname)
                    console.log("response.data.cedula: " + response.data.cedula)
                    console.log("response.data.phone: " + response.data.phone)
                    console.log("response.data.position: " + response.data.position)
                    console.log("response.data.department: " + response.data.department)
                    console.log("response.data.type: " + response.data.type)
                    console.log("response.data.email: " + response.data.email)
                    if(response.data.message != "Error") {
                    	$scope.edit.id = id;
                    	$scope.edit.login = response.data.login;
	                    $scope.edit.password = response.data.password;
	                    $scope.edit.username = response.data.name;
	                    $scope.edit.lastname = response.data.lastname;
	                    $scope.edit.cedula = response.data.cedula;
	                    $scope.edit.phone = parseInt(response.data.phone, 10);
	                    $scope.edit.position = response.data.position;
	                    $scope.edit.department = response.data.department;
	                    $scope.edit.type = response.data.type;
	                    $scope.edit.email = response.data.email;
	                    $scope.label = response.data.name;
                    }else{
                    	sweetAlert("Oops...", "Ah ocurrido un problema al cargar tus datos de usuario", "error");
                    }
                }, function (response){
                    
                })
            $scope.viewMode = function() {
                $scope.mode = false;
            };
            $scope.editMode = function(){
                $scope.mode = true;
            };   
            $scope.save = function (element){
            	console.log("Editar User")
            	if( ($scope.edit.login==undefined) || ($scope.edit.password==undefined) ){
            		sweetAlert("Oops...", "El campo de Contraseña no puede estar vacio", "error");
            	}else{
	                swal({
	                	title: "¿Estas Seguro?",   
	                	text: "Si es así, ingresa tu contraseña para guardar los cambios:",   
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
								$http.get('index.php/user/UserController/editUserInfo', {params: $scope.edit})
			                		.then(function(response) {
										if(response.data.message != "Error") {
											$scope.mode = false;
											$scope.label = $scope.edit.username;
											$cookies.putObject('session', {username: $scope.edit.login , password:$scope.edit.password, id:id});
					                    	swal("Actualizado!", "Los cambios en tu información personal se han guardado exitosamente.", "success");
					                    }else{
					                    	swal("ERROR!", "Ha ocurrido un evento inesperado al tratar de realizar los cambios.", "error");
					                    }
					                }, function (response){
					                    
					                })
				           }
	                	})
	            }
            }
        }
    ]
);