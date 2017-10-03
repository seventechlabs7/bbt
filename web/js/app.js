'use strict';

// Declare app level module which depends on views, and components
angular.module('app', [
    //'ngAnimate',
    'ngCookies',
//    'ngResource',
   'ngSanitize',
    'ngTouch',
    //'ngStorage',
    //'ngclipboard',
    //'ng-echarts',
    'ui.router',
    //'ui.bootstrap',
    'ui.utils',
    'ui.load',
    'ui.jq',
    'oc.lazyLoad',
    //'perfect_scrollbar',
   'angular-inview',
   'ui.knob',
   'chart.js',
   'uiGmapgoogle-maps',
   'ngTable',
   'ngFileUpload',
   'cgNotify',
   'ngMessages',
   'angular-storage',
   'ngTable',
   'blockUI',
   'pascalprecht.translate'
       //'angular-loading-bar', 
    //'ng-token-auth',
    //'ngFileUpload',
    //'satellizer'
    //'blueimp.fileupload'
    //'imageCropper',
    //'angular-image-cropper'
    //'htmlSortable'
])

.service('UserService', function(store) {
    var service = this,
        currentUser = null;
    service.setCurrentUser = function(user) {
        currentUser = user;
        store.set('user', user);
        return currentUser;
    };
    service.getCurrentUser = function() {
        if (!currentUser) {
            currentUser = store.get('user');
        }
        return currentUser;
    };
})
.service('translateService', function($translate) {
    var service = this;
    
    service.translate = function(key) {
        
      /*start*/
      var a ;
      $translate(key).then(function (anotherOne) {
          a = anotherOne;
      }, function (translationId) {
          a = translationId;
      });
      return  a;
      /*end*/

       // return currentUser;
    };

})
.service('APIInterceptor', function($rootScope, UserService,$state ,$timeout) {
    var service = this;
    service.request = function(config) {
        console.log(config);
        var currentUser = UserService.getCurrentUser(),
            access_token = currentUser ? currentUser.access_token : null;
        if (access_token) {
           // config.headers.authorization = access_token;
            config.headers['Authorization'] = 'Bearer ' + access_token;
            config.headers['Accept-Language'] = 'es-ES';
        }
        return config;
    };
    service.responseError = function(response) {
      console.log(response);
      if(response.status == 403)
        {
           window.onkeydown = null;
          window.onfocus = null;
          swal({
            title: "Session Expired or unauthorized", 
            text: "Please login to continue",       
           
          });
          $timeout(function()
          {
             $state.go('app.home', {
                    
                });
           },2000);
         
        } 
        return response;
    };
})

.config(['$translateProvider', function ($translateProvider) {
  $translateProvider.translations();
  // configures staticFilesLoader
  $translateProvider.useStaticFilesLoader({
    prefix: './i18n/locale-',
    suffix: '.json'
  });
  // load 'en' table on startup

  $translateProvider.preferredLanguage('en');
  $translateProvider.useLocalStorage();
}]);

window.paceOptions = {
    document: true, // disabled
    eventLag: true,
    restartOnPushState: true,
     elements: true,
    restartOnRequestAfter: true,
    ajax: {
        trackMethods: [ 'POST','GET']
    }

};


