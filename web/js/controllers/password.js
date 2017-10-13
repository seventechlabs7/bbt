'use strict';


angular.module('app').controller('password', ['$scope','$document','$rootScope','$stateParams','$http','$state','$timeout','uiGmapGoogleMapApi','$filter','Upload','notify','NgTableParams','blockUI','$translate',
    function($scope,$document,$rootScope,$stateParams,$http,$state,$timeout,uiGmapGoogleMapApi,$filter,Upload,notify,NgTableParams,blockUI,$translate) {
        
      
    	$scope.password = {};
    	$scope.type = "start";

    	$scope.forgotPasword = function(resend)
    	{
				if(!$scope.password.email)
				{
					notify.closeAll();
					notify({
						message:$translate.instant('invalid_email'),
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
						// notify({
						// message:$translate.instant(success.data.reason),
						// classes:'alert-success',
						// duration:3000
						// });
						$scope.resetMessage = $translate.instant(success.data.reason);
						$scope.type ="resend";
						if(resend)
						{
						 notify({
						 message:$translate.instant("link_sent_agin"),
						 classes:'alert-success',
						 duration:3000
						 });
						}
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

    	$scope.resend  = function()
    	{

    	}

    	$scope.initNewPassword = function()
    	{
    		$http({
				method: 'POST',
				url: '/anon/checkpasswordvalidlink',
				data:{				
				verifyLink : $stateParams.verifyLink,
			}
			}).then(function(success){
				console.log(success);

				if(success.data.status == 'success')
				{

				}
				else
				{
					window.onkeydown = null;
					window.onfocus = null;
						swal({
							title: $translate.instant(success.data.reason),    
							showConfirmButton : false
						});
						$timeout(function()
						{
						$state.go('app.home', {

						});
						},2000);							
				}
			},function(error){
				
			});
    	}

    		$scope.updatePassword = function()
		{
			notify.closeAll();
			if(!$scope.password.newPassword)
			{
				notify.closeAll();
						notify({
						message:$translate.instant("NEW_PASSWORD_PH"),
						classes:'alert-warning',
						duration:3000
						});		
				return;
			}
			if($scope.password.newPassword != $scope.password.confirmPassword)
			{
				notify.closeAll();
						notify({
						message:$translate.instant("password_confirm_password_not_same"),
						classes:'alert-warning',
						duration:3000
						});		
				return;		
			}

			$http({
				method: 'POST',
				url: '/anon/changepassword',
				data:{				
				password :$scope.password , verifyLink : $stateParams.verifyLink,
			}
			}).then(function(success){
				console.log(success);

				if(success.data.status == 'success')
				{
					$scope.password ={};
					$scope.type = "success";
					$scope.passwordChangeMsg = $translate.instant(success.data.reason)
				}
				else
				{
					notify.closeAll();
					notify({
						message:$translate.instant(success.data.reason),
						classes:'alert-danger',
						duration:3000
						});	
				
				}
			},function(error){
				
			});
		}

		$scope.login = function()
		{
			$state.go('app.home', {});
		}






			
    }
    ]);