'use strict';
angular.module('app').controller('AppCtrl', ['$scope','$document','$rootScope','$stateParams','$http','$state',
    function($scope,$document,$rootScope,$stateParams,$http,$state) {
              $scope.app = {
            name: 'BBT',
            version: '1.0.0',
            type: 'general',
            color: {
                primary: '#673AB7',
                accent: '#FF6E40',
                info: '#26C6DA',
                success: '#46be8a',
                warning: '#fdb45d',
                danger: '#F44336',
                secondary: '#a9a9a9',
                text: '#767676'
            },
            settings: {
                menuProfile: true,
                menuFolded: false,
                chatFolded: true,
                layoutBoxed: false,
                searchFocus: false,
                pagetitle: 'BBT',
            }
        }
        $scope.text = "Hellow";
        $scope.app.breadcrumb = [];
    }
    ]);