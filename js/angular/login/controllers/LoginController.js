angular.module('helpDesk.login').controller('LoginController',
    ['$scope', '$rootScope', 'auth', '$http',
        function($scope, $rootScope, auth, $http) {
            $rootScope.loading=false;
            $scope.recovery = {};
            $scope.recovery.recoveryView = true;//false;
            $scope.recovery.showQuestion = false;
            console.log("$rootScope.model: " + $rootScope.model)
            console.log("$scope.recovery.recoveryView: " + $scope.recovery.recoveryView)
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
                console.log("recoveryPass")
                $scope.recovery.recoveryView = true;
            };

            $scope.showLogin = function () {
                $scope.recovery.recoveryView = false;
            };

            $scope.showQuestion = function () {
                console.log("$scope.recovery.recoveryLogin: " + $scope.recovery.recoveryLogin)
                if( ($scope.recovery.recoveryLogin=="") || ($scope.recovery.recoveryLogin==undefined) ){
                    sweetAlert("Oops...", "Ingrese el LOGIN", "error");
                }else{
                    // $scope.recovery.recoveryLogin = 1;
                    $http.get('index.php/login/LoginController/getQuestion', {params:{login:$scope.recovery.recoveryLogin}})
                        .then(function(response) {
                            console.log("response.data.message: " + response.data.message)
                            if(response.data.message != "Error") {
                                // swal("Actualizado!", "Los cambios en tu información personal se han guardado exitosamente.", "success");
                                $scope.recovery.login = response.data.login;
                                console.log('$scope.recovery.login: ' + $scope.recovery.login)
                                $scope.recovery.question = response.data.question;
                                console.log('$scope.recovery.question: ' + $scope.recovery.question)
                                $scope.recovery.answer = response.data.answer;
                                console.log('$scope.recovery.answer: ' + $scope.recovery.answer)
                                //LLAMO FUNCTION PARA MOSTRAR LA PREGUNTA
                                $scope.recovery.showQuestion = true;
                            }else{
                                swal("ERROR!", "El LOGIN ingresado no existe en nuestro sistema.", "error");
                            }
                        }, function (response){
                            
                        })
                }
            };
        }
    ]
);
