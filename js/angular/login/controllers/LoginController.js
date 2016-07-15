angular.module('helpDesk.login').controller('LoginController',
    ['$scope', '$rootScope', 'auth', '$http',
        function($scope, $rootScope, auth, $http) {
            $rootScope.loading=false;
            $scope.recovery = {};
            $scope.recovery.recoveryView = false;
            $scope.recovery.showQuestion = false;
            $scope.recovery.showSetPass = false;
            $scope.login = function (element){
                $rootScope.loading=true;
                auth.login($scope.model.login, $scope.model.password);
                $rootScope.model = {};
                $rootScope.model.errorLogin = "";
            };
            $scope.logout = function (){
                auth.logout();
            };

            $scope.recoveryPass = function (){
                $scope.recovery.recoveryView = true;
            };

            $scope.showLogin = function () {
                $scope.recovery.recoveryView = false;
                $scope.recovery = {};
            };

            $scope.showSetPass = function () {
                if( ($scope.recovery.recoveryAnswer=="") || ($scope.recovery.recoveryAnswer==undefined) ){
                    sweetAlert("Campo vacio...", "Ingrese su respuesta.", "error");
                }else if ($scope.recovery.recoveryAnswer == $scope.recovery.answer){
                    $scope.recovery.showSetPass = true;
                    $scope.recovery.showQuestion = false;
                }else{
                    sweetAlert("Oops...", "La respuesta es incorrecta.", "error");
                }
            };

            $scope.setPass = function () {
                if( ($scope.recovery.recoveryPassword=="") || ($scope.recovery.recoveryPassword==undefined) || 
                    ($scope.recovery.recoveryPassword2=="") || ($scope.recovery.recoveryPassword2==undefined)){
                    sweetAlert("Campo vacio...", "Ingrese su nueva contraseña.", "error");
                }else if ($scope.recovery.recoveryPassword!=$scope.recovery.recoveryPassword2) {
                    sweetAlert("Error...", "Las contraseñas no coinciden.", "error");
                }else{
                    $http.get('index.php/login/LoginController/setPassword', {params:{id:$scope.recovery.id, newPassword:$scope.recovery.recoveryPassword}})
                        .then(function(response) {
                            console.log("response.data.message: " + response.data.message)
                            if(response.data.message != "Error") {
                                swal("Actualizado!", "Tu nueva contraseña se ha almacenado exitosamente. Ya puedes usarla para ingresar al sistema.", "success");
                                $scope.showLogin();
                            }else{
                                swal("Oops...", "Ocurrió un error al tratar de guardar su nueva contraseña.", "error");
                            }
                        }, function (response){
                            
                        })
                }
            };

            $scope.showQuestion = function () {
                if( ($scope.recovery.recoveryLogin=="") || ($scope.recovery.recoveryLogin==undefined) ){
                    sweetAlert("Oops...", "Ingrese el LOGIN", "error");
                }else{
                    $http.get('index.php/login/LoginController/getQuestion', {params:{login:$scope.recovery.recoveryLogin}})
                        .then(function(response) {
                            console.log("response.data.message: " + response.data.message)
                            if(response.data.message != "Error") {
                                $scope.recovery.id = response.data.id;
                                $scope.recovery.question = response.data.question;
                                $scope.recovery.answer = response.data.answer;
                                $scope.recovery.showQuestion = true;
                            }else{
                                swal("ERROR!", "El LOGIN ingresado no existe en el sistema.", "error");
                            }
                        }, function (response){
                            
                        })
                }
            };
        }
    ]
);
