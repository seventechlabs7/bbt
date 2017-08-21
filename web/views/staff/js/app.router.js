
angular.module('app')
    .config(
        ['$stateProvider', '$urlRouterProvider', 'JQ_CONFIG',
            function($stateProvider, $urlRouterProvider, JQ_CONFIG) {
                alert("stateProvider")
                $urlRouterProvider
                    .otherwise('/');
                $stateProvider
                    .state('home', {
                        url: '/',
                        templateUrl: 'Resources/view/staff/partials/home.html.twig',
                        resolve: {
                            deps: ['uiLoad',
                                function(uiLoad) {
                                    return uiLoad.load(['js/controllers/home.js']);
                                }
                            ]
                        }
                    })
                    .state('home.profile', {
                        url: '/home/profile/:pid',
                        templateUrl: 'Resources/view/staff/partials/profile.html.twig',
                        resolve: {
                            deps: ['uiLoad',
                                function(uiLoad) {
                                    return uiLoad.load(['js/controllers/home.js']);
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
