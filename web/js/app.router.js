
angular.module('app')
    .config(
        ['$stateProvider', '$urlRouterProvider', 'JQ_CONFIG',
            function($stateProvider, $urlRouterProvider, JQ_CONFIG) {
             
                $urlRouterProvider
                    .otherwise('/dashboard');
                $stateProvider
                   .state('app', {
                        abstract: true,
                        url: '/app',
                        template: '<div ui-view class=""></div>',
                    })
                    .state('app.home', {
                        url: '/signup',
                        templateUrl: 'views/staff/partials/home.html.twig',
                        resolve: {
                            deps: ['uiLoad',
                                function(uiLoad) {
                                    return uiLoad.load(['js/controllers/home.js']);
                                }
                            ]
                        }
                    })
                    .state('app.profile', {
                        url: '/profile/:teacher_id',
                        templateUrl: 'views/staff/partials/teacherprofile.html.twig',
                        resolve: {
                            deps: ['uiLoad',
                                function(uiLoad) {
                                    return uiLoad.load(['js/controllers/home.js']);
                                }
                            ]
                        }
                    })
                    .state('app.editprofile', {
                        url: '/editprofile/:teacher_id',
                        templateUrl: 'views/staff/partials/editteacherprofile.html.twig',
                        resolve: {
                            deps: ['uiLoad',
                                function(uiLoad) {
                                    return uiLoad.load(['js/controllers/profile.js']);
                                }
                            ]
                        }
                    })
                    .state('app.campaign', {
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
