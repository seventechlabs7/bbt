'use strict';

// Declare app level module which depends on views, and components
angular.module('app', [
    //'ngAnimate',
    //'ngCookies',
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
   'blockUI'
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
.service('APIInterceptor', function($rootScope, UserService,$state) {
    var service = this;
    service.request = function(config) {
        console.log(config);
        var currentUser = UserService.getCurrentUser(),
            access_token = currentUser ? currentUser.access_token : null;
        if (access_token) {
           // config.headers.authorization = access_token;
            config.headers['Authorization'] = 'Bearer ' + access_token;
        }
        return config;
    };
    service.responseError = function(response) {
      console.log(response);
      if(response.status == 403)
        {
      swal({
        title: "Please Login to continue",        
        timer: 2000
      });
          $state.go('app.home', {
                    
                });
        } 
        return response;
    };
})

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
