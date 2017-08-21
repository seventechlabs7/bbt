var app =  angular.module('app')
  .config(
    [        '$controllerProvider', '$compileProvider', '$filterProvider', '$provide','$httpProvider','uiGmapGoogleMapApiProvider',
    function ($controllerProvider,   $compileProvider,   $filterProvider,   $provide,  $httpProvider ,GoogleMapApiProviders) {
        
        // lazy controller, directive and service
        app.controller = $controllerProvider.register;
        app.directive  = $compileProvider.directive;
        app.filter     = $filterProvider.register;
        app.factory    = $provide.factory;
        app.service    = $provide.service;
        app.constant   = $provide.constant;
        app.value      = $provide.value;
        $httpProvider.interceptors.push('authHttpResponseInterceptor');
         GoogleMapApiProviders.configure({
            china: true
        });

        

    }   
  ]);
  app.factory('authHttpResponseInterceptor',['$q','$location',function($q,$location){

    return {
        request: function (config) {
            // use this to destroying other existing headers
            // config.headers = {'X-Requested-With':'XMLHttpRequest'}
            // use this to prevent destroying other existing headers
            if (window.localStorage['token']) {
               config.headers['Authorization'] = 'Bearer ' + window.localStorage['token'];
            }
            return config;
        },
        response: function(response){
            return response || $q.when(response);
        },
        responseError: function(rejection) {
            return $q.reject(rejection);
        }
    }
}]);


