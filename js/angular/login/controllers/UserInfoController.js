angular.module('helpDesk.MostrarPerfil').controller('UserInfoController', 
    ['$scope', 
        function($scope) {
            $scope.usuarios = [
              {
                nombre : "Genessis",
                edad : "22"
              },
              {
                nombre : "Manuel",
                edad : "12"
              }
            ]
        }
    ]
);