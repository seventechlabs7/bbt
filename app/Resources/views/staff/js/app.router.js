
angular.module('app')
    .config(
        ['$stateProvider', '$urlRouterProvider', 'JQ_CONFIG',
            function($stateProvider, $urlRouterProvider, JQ_CONFIG) {

                $urlRouterProvider
                    .otherwise('/');
                $stateProvider
                    .state('home', {
                        url: '/',
                        templateUrl: 'partials/home.html',
                        resolve: {
                            deps: ['uiLoad',
                                function(uiLoad) {
                                    return uiLoad.load(['js/controllers/home.js']);
                                }
                            ]
                        }
                    })
                    .state('home.profile', {
                        url: '/home/profile',
                        templateUrl: 'partials/profile.html',
                        resolve: {
                            deps: ['uiLoad',
                                function(uiLoad) {
                                    return uiLoad.load(['js/controllers/profile.js']);
                                }
                            ]
                        }
                    })
                    .state('home.campaign', {
                        url: '/camp',
                        templateUrl: 'partials/campaign.html',
                        resolve: {
                            deps: ['uiLoad',
                                function(uiLoad) {
                                    return uiLoad.load(['js/controllers/campaign.js']);
                                }
                            ]
                        }
                    })

                                        
            }

        ]);
