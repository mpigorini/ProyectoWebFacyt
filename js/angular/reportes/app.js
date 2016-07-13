'use strict';

/**
 * @ngdoc overview
 * @name reportesApp
 * @description
 * # reportesApp
 *
 * Main module of the application.
 */
angular
  .module('reportesApp', [
    'ngRoute',
    'ngAnimate',
    'ngTouch',
    'ui.grid',
    'ui.grid.grouping',
    'ui.grid.selection'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl',
        controllerAs: 'main'
      })
      .when('/listickets', {
        templateUrl: 'views/listickets.html',
        controller: 'MainCtrl',
        controllerAs: 'lisTickets'
      })
      .when('/listDepartament', {
        templateUrl: 'views/listdepartament.html',
        controller: 'ListdepartamentCtrl',
        controllerAs: 'listDepartament'
      })
      .when('/listSatisfaction', {
        templateUrl: 'views/listsatisfaction.html',
        controller: 'ListsatisfactionCtrl',
        controllerAs: 'listSatisfaction'
      })
      .when('/listTime', {
        templateUrl: 'views/listtime.html',
        controller: 'ListtimeCtrl',
        controllerAs: 'listTime'
      })
      .when('/listTimeAnalyst', {
        templateUrl: 'views/listtimeanalyst.html',
        controller: 'ListtimeanalystCtrl',
        controllerAs: 'listTimeAnalyst'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
