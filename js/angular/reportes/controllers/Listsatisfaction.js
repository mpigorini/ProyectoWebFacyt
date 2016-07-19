'use strict';

/**
 * @ngdoc function
 * @name reportesApp.controller:ListsatisfactionCtrl
 * @description
 * # ListsatisfactionCtrl
 * Controller of the reportesApp
 */
angular.module('helpDesk')
  .controller('ListsatisfactionCtrl', function () {
  //cerramos automáticamente el mobile sideNav
  $('.button-collapse').sideNav('hide');
  // show reports option as active
  $rootScope.select(6);
    this.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  });
