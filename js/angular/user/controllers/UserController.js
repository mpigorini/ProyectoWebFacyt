angular.module('helpDesk').controller('UserController', 
    ['$scope', '$rootScope', '$cookies', '$http', 'auth',
        function($scope, $rootScope, $cookies, $http, auth) {
            var id = $cookies.getObject("session").id;
            console.log("$cookies.getObject('session').id: " + id)
            $http.get('index.php/user/UserController/userInfo', {params:{id: id}})
            	.then(function(response) {
            		//Este monton de console son para estar al tanto de los valores del perfil
                    console.log("response.data.login: " + response.data.login)
                    console.log("response.data.password: " + response.data.password)
                    console.log("response.data.name: " + response.data.name)
                    console.log("response.data.lastname: " + response.data.lastname)
                    console.log("response.data.type: " + response.data.type)
                    $scope.edit.login = response.data.login;
                    $scope.edit.password = response.data.password;
                    $scope.edit.username = response.data.name;
                    $scope.edit.lastname = response.data.lastname;
                    $scope.edit.type = response.data.type;
                    $scope.label = response.data.name;
                }, function (response){
                    
                })
            $scope.edit = function (element){
            	console.log("Editar User")
            	if( ($scope.edit.login==undefined) || ($scope.edit.password==undefined) ){
            		sweetAlert("Oops...", "Los campos de Login y Contraseña no pueden estar vacios", "error");
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
								$http.get('index.php/user/UserController/editUserInfo', {params:
									{id: id, login: $scope.edit.login, password: $scope.edit.password, 
										username: $scope.edit.username, lastname: $scope.edit.lastname, type: $scope.edit.type}})
			                		.then(function(response) {
										if(response.data.message != "Error") {
											$scope.label = $scope.edit.username;
					                    	swal("Actualizado!", "Los cambios en tu información personal se han guardado exitosamente.", "success");
					                    }else{
					                    	swal("ERROR!", "Ha ocurrido un evento inesperado al tratar de realizar los cambios.", "error");
					                    }
					                }, function (response){
					                    
					                })
				           }
	                	});
	            }
            };
        }
    ]
);