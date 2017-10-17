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

/*.service('Common', function($scope,$rootScope,$translate,UserService) {
    var service = this;
       service.logout = function()
       {
          alert("here")
          UserService.setCurrentUser(null);
           window.location.href = "/index";
       };
       
})*/
.run(function($rootScope,UserService,$translate,blockUI,blockUIConfig) {
        $rootScope.logout = function()
       {
          UserService.setCurrentUser(null);

           window.location.href = "/index";
       }

       $rootScope.changeLanguage = function(langKey)
       {
         $translate.use(langKey);
          blockUIConfig.message = $translate.instant("PLEASE_WAIT");
        // location.reload();
       }

    })
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
.service('translateService', function($translate,$rootScope) {
    var service = this;
    
    service.translate = function(key) {
        
      return $translate.instant(key);  
      /*start*/
      var a ;
      $translate(key).then(function (anotherOne) {
     
          $rootScope.a = anotherOne;
         // return anotherOne;
      }, function (translationId) {
    
          $rootScope.a = translationId;
         // return $rootScope.a;
      });
      return  $rootScope.a;
      /*end*/

       // return currentUser;
    };

})
.service('APIInterceptor', function($rootScope, UserService,$state ,$timeout,$translate ,blockUI) {
    var service = this;
    
    service.request = function(config) {
        console.log(config);
        var currentUser = UserService.getCurrentUser(),
            access_token = currentUser ? currentUser.access_token : null;
        if (access_token) {
           // config.headers.authorization = access_token;
            config.headers['Authorization'] = 'Bearer ' + access_token;           
        }
        config.headers['Accept-Language'] = $translate.use() ;
        return config;
    };
    service.responseError = function(response) {
      console.log(response);
       blockUI.stop();
      if(response.status == 403)
        {
           window.onkeydown = null;
          window.onfocus = null;
          swal({
            title: $translate.instant("SESSION_EXPIRED"),
            text: $translate.instant("SESSION_EXPIRED_TEXT"),  
            confirmButtonText : $translate.instant("OK"),   
           
          });
          $timeout(function()
          {
             $state.go('app.home', {
                    
                });
           },2000);
         
        } 
         if(response.status == 500)
        {
           window.onkeydown = null;
          window.onfocus = null;
          swal({
            title: $translate.instant("something_went_wrong"),                         
          });
        
        } 
         if(response.status == 404)
        {
           window.onkeydown = null;
          window.onfocus = null;
          swal({
            title: $translate.instant("something_went_wrong"),                         
          });
        
        } 
        return response;
    };
})
/*.config(function(blockUIConfig,$translate) {
  
  // Change the default overlay message
  blockUIConfig.message  =  $translate.instant("PLEASE_WAIT");
  
  // Change the default delay to 100ms before the blocking is visible
  blockUIConfig.delay = 100;
  
})*/
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


/* var app = angular.module('app', []);
  app.run(function($rootScope) {
        $rootScope.logout = function()
       {
          alert("here")
          UserService.setCurrentUser(null);
           window.location.href = "/index";
       };
    });*/


