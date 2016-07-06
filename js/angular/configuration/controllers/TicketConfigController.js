angular.module('helpDesk').controller('TicketConfigController',
    ['$scope', '$rootScope','$http',
        function($scope, $rootScope, $http) {
            $scope.edit = false;
            $scope.model =null;
            $http.get('index.php/configuration/TicketsConfiguration/getTicketTypes')
                .then(function(response){
                    if(response.data.message === "success"){
                        $scope.ticketTypes = response.data.data;
                        console.log($scope.ticketTypes);
                    }
                })
            
            
            $scope.loadTicketType = function(id){
                var obj = $scope.ticketTypes;
                $scope.model={};
                $scope.model.id = obj[id].id;
                $scope.model.name = obj[id].name;
                $scope.model.states = obj[id].states;
                $scope.model.types = obj[id].types;
                $scope.model.priorities = obj[id].priorities;
                $scope.model.levels = obj[id].levels;
                $scope.model.active = obj[id].active;
                $scope.model.answerTimes = obj[id].answerTimes;
            }
            
            $scope.save = function() {
                $http.get('index.php/configuration/TicketsConfiguration/save',{params:$scope.model})
                    .then(function(response) {
                        console.log(response)
                    })
            }
            
            $scope.newTicketType = function(){
                $scope.model={};
                $scope.edit=true;
            }
            $scope.viewMode = function() {
                $scope.edit = false;
            }
            $scope.editMode = function(){
                $scope.edit =true;
            }
            
        }
    ]
);