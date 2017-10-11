'use strict';


angular.module('app').controller('password', ['$scope','$document','$rootScope','$stateParams','$http','$state','$timeout','uiGmapGoogleMapApi','$filter','Upload','notify','NgTableParams','blockUI','$translate',
    function($scope,$document,$rootScope,$stateParams,$http,$state,$timeout,uiGmapGoogleMapApi,$filter,Upload,notify,NgTableParams,blockUI,$translate) {
        
      
    	$scope.password = {};
    	$scope.type = "start";

    	$scope.forgotPasword = function()
    	{
				if(!$scope.password.email)
				{
					notify.closeAll();
					notify({
						message:$translate.instant('enter_valid_email'),
						classes:'alert-warning',
						duration:3000
					});
					return ;
				}
				$http({
					method: 'POST',
					url: 'anon/forgotpassword',
					data:{
					
					email :$scope.password.email,
				}
				}).then(function(success){
					console.log(success);
					if(success.data.status == 'success')
					{
						notify.closeAll();
						notify({
						message:$translate.instant(success.data.reason),
						classes:'alert-success',
						duration:3000
						});
						$scope.type ="resend";
					}
					else
					{
						notify.closeAll();
						notify({
						message:$translate.instant(success.data.reason),
						classes:'alert-warning',
						duration:3000
						});						
					}
				},function(error){

				});
    	}

    	$scope.newPassword = function()
    	{
    		alert("1");
    	}

		$scope.logout = function()
		{
			window.location.href = "/index";
		}


		$rootScope.changeLanguage = function (langKey)
		{		 
			$translate.use(langKey);
		};



			
    }
    ]);