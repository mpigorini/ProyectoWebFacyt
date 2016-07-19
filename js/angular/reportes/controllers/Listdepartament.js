'use strict';

/**
 * @ngdoc function
 * @name reportesApp.controller:ListdepartamentCtrl
 * @description
 * # ListdepartamentCtrl
 * Controller of the reportesApp
 */
angular.module('helpDesk')
  .controller('ListdepartamentCtrl',['$scope','$http', function ($scope,$http) {
      //cerramos automáticamente el mobile sideNav
      $('.button-collapse').sideNav('hide');
    $scope.loader=true;
    // show reports option as active
    $rootScope.select(6);
    console.log($scope.loader);
    	//data de prrueba, este scope sera cambiando por lo que retorne el controlador reportes.php
  	/*	$scope.miembros=[
	    {id:"1",subject:"subject1",description:"d1",type:"atendida",level:"l1",priority:"1",answerTime:"1",qualityOfService:"exelente",userReporter:"asdasd",departament:"fisica",submitDate:"28-06-2016",closeDate:"",state:"",solutionDescription:"asd",evaluation:"eva1",observations:"obsr1"},
	    {id:"2",subject:"subject2",description:"d2",type:"espera",level:"l2",priority:"2",answerTime:"2",qualityOfService:"bueno",userReporter:"asdf",departament:"quimica",submitDate:"29-06-2016",closeDate:"",state:"",solutionDescription:"asdf",evaluation:"eva2",observations:"obsr2"},
	    {id:"3",subject:"subject3",description:"d3",type:"excedieron",level:"l3",priority:"3",answerTime:"3",qualityOfService:"aceptable",userReporter:"asdf",departament:"computacion",submitDate:"30-06-2016",closeDate:"",state:"asdf",solutionDescription:"eva3",evaluation:"",observations:"obsr3"},
	    {id:"4",subject:"subject4",description:"d4",type:"atendida",level:"l4",priority:"1",answerTime:"4",qualityOfService:"regular",userReporter:"adsf",departament:"quimica",submitDate:"01-07-2016",closeDate:"01-07-2016",state:"",solutionDescription:"asdf",evaluation:"eva4",observations:"obsr4"},
	    {id:"5",subject:"subject5",description:"d5",type:"espera",level:"l5",priority:"2",answerTime:"6",qualityOfService:"exelente",userReporter:"asdf",departament:"fisica",submitDate:"02-07-2016",closeDate:"02-07-2016",state:"",solutionDescription:"adf",evaluation:"eva5",observations:"obsr5"},
	    {id:"6",subject:"subject6",description:"d6",type:"excedieron",level:"l6",priority:"3",answerTime:"3",qualityOfService:"bueno",userReporter:"asdf",departament:"computacion",submitDate:"03-07-2016",closeDate:"",state:"",solutionDescription:"adsf",evaluation:"eva6",observations:"obsr6"},
	    {id:"7",subject:"subject7",description:"d7",type:"atendida",level:"l7",priority:"1",answerTime:"1",qualityOfService:"aceptable",userReporter:"asdf",departament:"quimica",submitDate:"04-07-2016",closeDate:"04-07-2016",state:"",solutionDescription:"adsf",evaluation:"eva7",observations:"obsr7"},
	    {id:"8",subject:"subject8",description:"d8",type:"espera",level:"l8",priority:"2",answerTime:"2",qualityOfService:"regular",userReporter:"asdfa",departament:"fisica",submitDate:"05-07-2016",closeDate:"05-07-2016",state:"",solutionDescription:"asdf",evaluation:"eva8",observations:"obsr8"},
	    {id:"9",subject:"subject9",description:"d9",type:"excedieron",level:"l9",priority:"3",answerTime:"3",qualityOfService:"exelente",userReporter:"asdfa",departament:"computacion",submitDate:"06-07-2016",closeDate:"",state:"",solutionDescription:"asdf",evaluation:"eva9",observations:"obsr9"},
	    {id:"10",subject:"subject10",description:"d10",type:"atendida",level:"l10",priority:"1",answerTime:"3",qualityOfService:"bueno",userReporter:"asdfa",departament:"quimica",submitDate:"07-07-2016",closeDate:"",state:"",solutionDescription:"asdf",evaluation:"eva10",observations:"obsr10"}
    ];
    */



    $http.get('index.php/reportes/ListdepartamentController/listTicket')
      .then(function(response) {
          if(response.data.message === "success") {
            $scope.miembros = response.data.tickets;

            $scope.loader=false;
            console.log($scope.loader);
          }
        }, function (response){

          console.log(response.data);
          $scope.loader=false;
        console.log($scope.loader);
    });

    $scope.gridOptions={
//defincion de las propiedades del ng-Grid

    jqueryUITheme: true,
    showGroupPanel: true,
    showGridFooter: true,
    showColumnFooter: true,
    columnDefs:[
    { name:'id' , displayName:'NumberTicket' },
    { name:'subject' },
    { name:'type', displayName:'StateTicket' },
    { name:'answerTime' },
    { name:'qualityOfService' },
    { name:'department' },
   ],
	  data : 'miembros'

	};



  }]);
