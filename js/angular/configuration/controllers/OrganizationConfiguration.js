angular
    .module('helpDesk')
    .controller('OrganizationConfiguration', organizationConfiguration);

organizationConfiguration.$inject = ['$scope', '$rootScope'];

function organizationConfiguration($scope, $rootScope) {
    'use strict';
    // show configuration option as active
    $rootScope.select(3);
    
}