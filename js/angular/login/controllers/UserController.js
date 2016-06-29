angular.module('helpDesk.login').controller('UserController', 
    ['$scope', 
        function($scope) {
            
            $scope.model={
                login : 'mpigorini',
                password : '123456',
                name : 'marioandre',
                lastName : 'pigorini',
                type : '0'
            }
            
            $scope.save = function (element){
              console.log(element);  
              Materialize.updateTextFields()
            };
        }
    ]
);