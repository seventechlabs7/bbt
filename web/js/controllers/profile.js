'use strict';


angular.module('app').controller('profile', ['$scope','$document','$rootScope','$stateParams','$http','$state','$timeout','uiGmapGoogleMapApi','$filter','Upload','notify','$translate',
    function($scope,$document,$rootScope,$stateParams,$http,$state,$timeout,uiGmapGoogleMapApi,$filter,Upload,notify ,$translate) {
        
        $scope.profileName ="Home";
        $scope.c_next_index = 1;
        $('#horizontalTab').easyResponsiveTabs({
			type: 'default', //Types: default, vertical, accordion           
			width: 'auto', //auto or any width like 600px
			fit: true,   // 100% fit in a container
			closed: 'accordion', // Start closed if in accordion view
			activate: function(event) { // Callback function if tab is switched
			var $tab = $(this);
			var $info = $('#tabInfo');
			var $name = $('span', $info);
			$name.text($tab.text());
			$info.show();
			}
		});

		$scope.messageFile = "js/messages.html";

        $scope.currentPage ="home";

        $scope.shiftTab = function(index)
        {
        	$('.step_head_li').removeClass('active');
        	$('#step_head_'+index).addClass('active');
        	$('.step_body_li').removeClass('active');
        	$('#step_body_'+index).addClass('active');
        }

        $scope.teacher = {};
        $scope.password ={};
        $scope.teacherdetail = {};
        $scope.teacher.virtual_money = 25.00;
        $scope.step = 1;
        $scope.teacher_id = "";
        console.log($stateParams.teacher_id);
		$scope.openModal = function()
		{			
			$('#addStudent').modal('show');
			$scope.step= 1;
		}
               
		$scope.nextstep = function()
		{
			if($scope.step == 1)
				$scope.step = 2;
			else if($scope.step == 2)
				$scope.step = 3;
		}

		$scope.prevstep = function()
		{
			if($scope.step == 2)
				$scope.step = 1;
			else if($scope.step == 3)
				$scope.step = 2;
		}

		$scope.selectFile = function(file)
		{
			console.log(file);
			$scope.file = file;
		}



		$scope.checkTime = function(index)
		{		
		  notify.closeAll();	
			$scope.pastDateCheck();
			if($scope.teacher.start_date != undefined && $scope.teacher.start_date != null)
				var from = $scope.teacher.start_date;
			if($scope.teacher.end_date != undefined && $scope.teacher.end_date != null)
		      	var to = $scope.teacher.end_date;
		      var timeDiff = Math.abs(to.getTime() - from.getTime());
		      var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));  
		      if(to.getTime() < from.getTime())
		      {
		      	notify({
		      		message: $translate.instant('invalid_end_date'),
		      		classes: 'alert-danger',
		      		duration: 2000
		      	});
		      	$scope.teacher.end_date = null;
		      	return;
		      }
		}

		$scope.getteacherdetails = function(){
			
			$http({
				method: 'GET',
				url: 'api/getteacherdetails/'+$stateParams.teacher_id
			}).then(function(success){
				console.log(success);
				$scope.teacher = success.data.data;
				$scope.teacher.isGroup = success.data.isGroup;
				console.log($scope.teacher);
				
						$scope.teacherstatus ={};
					console.log($scope.teacher);
					if(!$scope.teacher.isGroup)			
						{
							$state.go('app.profile', {
					    		teacher_id: $stateParams.teacher_id
							});	
						}
					$scope.teacherstatus.name = $scope.teacher.name;
					$scope.teacherstatus.surname =$scope.teacher.surname;
					$scope.teacherstatus.email = $scope.teacher.email;
					$scope.teacherstatus.oldemail = angular.copy( $scope.teacher.email);
					$scope.teacherstatus.university = $scope.teacher.university;
					$scope.teacherstatus.about = $scope.teacher.about;
					$scope.teacherstatus.teach_place = $scope.teacher.teach_place;
					$scope.teacherstatus.work = $scope.teacher.work;
					$scope.teacherstatus.id =	$scope.teacher.id;
					$scope.profileImageUrl = success.data.profileImageUrl ;
					//$scope.profileImageUrl = success.data.profileImageUrl+"/"+$scope.teacher.id+".jpeg";
					if(!$scope.teacher.virtual_money)
						$scope.teacher.virtual_money = "25.00";
					$scope.teacher.id = $scope.teacher.id;
					$timeout(function() {
			    $scope.teacher.start_date = new Date();
			}, 200);
							
				//$('#addStudent').modal('show');
				$scope.oldteacherstatus = angular.copy($scope.teacherstatus);
				$scope.shiftTab(1);
			},function(error){
				
			});
		}

		$scope.teacher_status = function(){
			$http({
				method: 'POST',
				url: 'api/teacher/status',
				data:{
				id: $stateParams.teacher_id,
				teacher :$scope.teacherstatus,
			}
			}).then(function(success){
				console.log(success);
				if(success.data.status == 'success')
				{
					notify.closeAll();
					notify({
						message:$translate.instant('profile_updated'),
						classes:'alert-success',
						duration:3000
					});
				}
			},function(error){
				
			});
		}





	    $scope.selectAvatar = function(avatar)

	    {
	    	$scope.avatarFile = avatar;
	    	if(avatar.type !="image/png" && avatar.type !="image/jpeg" && avatar.type !="image/gif")
	    		{
	    			notify({
							message:$translate.instant('select_valid_image'),
							classes:'alert-warning',
							duration:3000
						});
	    			return ;
	    		}
	    	if(avatar)
	    		$scope.imageSelected = true;
	    }

	    $scope.uploadAvatar = function()
	    {
	    	notify.closeAll();

	    		if(!$scope.avatarFile)
	    	{
	    		notify({
							message: $translate.instant('select_image'),
							classes:'alert-warning',
							duration:3000
						});
	    		 return;
	    	}

	    	Upload.upload({
				method: 'POST',				
				url: 'api/avatar',
				data:{
					file: $scope.avatarFile,
					userId :$scope.teacher.id,
				}
			})
			.then(function(success){
				console.log(success)
				if(success.data.status == "success")
				{
					notify({
								message: $translate.instant(success.data.reason),
								classes:'alert-success',
								duration:3000
							});
					/*$scope.profileImageUrl = "";
					$scope.imageSelected =false;
					$scope.getteacherdetails();*/
			     }
			     else
			     {
			     	notify({
								message: $translate.instant(success.data.reason),
								classes:'alert-danger',
								duration:3000
							});
			     }				
			},function(error){

			})
	    }

		$scope.saveChanges = function()
		{	
			$scope.teacherstatus.id = $stateParams.teacher_id;
			notify.closeAll();	
			if(!$scope.teacherstatus.name)
			{
				notify({
					message:$translate.instant('enter_first_name'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(!$scope.teacherstatus.surname)
			{
				notify({
					message:$translate.instant('enter_surname'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(!$scope.teacherstatus.email)
			{
				notify({
					message:$translate.instant('enter_valid_email'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(!$scope.teacherstatus.university)
			{
				notify({
					message:$translate.instant('enter_university'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(!$scope.teacherstatus.about)
			{
				notify({
					message:$translate.instant('enter_about'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(!$scope.teacherstatus.teach_place)
			{
				notify({
					message:$translate.instant('enter_teach_place'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(!$scope.teacherstatus.work)
			{
				notify({
					message:$translate.instant('enter_work'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if($scope.teacherstatus.oldemail != $scope.teacherstatus.email)
			{
				swal({
				title: "Email changed",
				// text: "Are you sure you want to update email ? You will have to verify email to update email",
				text : $translate.instant('confirm_email_update'),
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes",
				cancelButtonText: "Cancel!",
				closeOnConfirm: true,
				closeOnCancel: true,
			},
			function(isConfirm){
				if (isConfirm) {

				$http({
				method: 'POST',
				url: 'api/teacher/update',
				data:{				
				teacher :$scope.teacherstatus,
			}
			}).then(function(success){
				console.log(success);
				if(success.data.status == 'success')
				{
					notify.closeAll();
					notify({
						message: $translate.instant(success.data.reason),
						classes:'alert-success',
						duration:3000
					});

					$timeout(function() {
			  	$state.go('app.profile', {
					    teacher_id: $stateParams.teacher_id
					});	
			}, 3000);
				}
				else
				{
					notify.closeAll();
					notify({
						message: $translate.instant(success.data.reason),
						classes:'alert-danger',
						duration:3000
					});
				}
			},function(error){
				
			});
				
					
				} else {
					return;
				}
			});
					return;
			}
			else
			{
				$http({
				method: 'POST',
				url: 'api/teacher/update',
				data:{				
				teacher :$scope.teacherstatus,
			}
			}).then(function(success){
				console.log(success);
				if(success.data.status == 'success')
				{
					notify.closeAll();
					notify({
						message: $translate.instant(success.data.reason),
						classes:'alert-success',
						duration:3000
					});

					$timeout(function() {
			  	$state.go('app.profile', {
					    teacher_id: $stateParams.teacher_id
					});	
			}, 3000);
				}
				else
				{
					notify.closeAll();
					notify({
						message: $translate.instant(success.data.reason),
						classes:'alert-danger',
						duration:3000
					});
				}
			},function(error){
				
			});
			}
		
		}

		$scope.passwordCheck =function()
		{
			if(($scope.teacherstatus.password && $scope.teacher.password) || (!$scope.teacher.password && !$scope.teacher.confirm))
			{
				return ($scope.teacher.password == $scope.teacher.password) 
			}
			else
			{
				return false;
			}
		}

		$scope.checkCurrentPassword = function()
		{
			notify.closeAll();
			if(!$scope.password.currentPassword)
				return ;
			$http({
				method: 'POST',
				url: 'api/password/current',
				data:{				
					password :$scope.password.currentPassword,
					tId : $scope.teacher.id,
				}
			}).then(function(success){
				console.log(success);
				if(success.data.status == 'success')
				{
					
				}
				else
				{
					$scope.password.currentPassword ='';
					notify.closeAll();
					swal("Failed!", $translate.instant(success.data.reason), "error", {
						  confirmButtonText: "Try Again!",
						});
					
				}
			},function(error){
				
			});
		}

		$scope.updatePassword = function()
		{
			notify.closeAll();
			if(!$scope.password.currentPassword)
			{
				swal("Failed!", "enter_current_password", "warning", {
						  confirmButtonText: "Try Again!",
						});		
				return;
			}
			if($scope.password.password != $scope.password.confirm)
			{
				swal("Failed!", "password_confirm_password_not_same!", "error", {
						  confirmButtonText: "Try Again!",
						});			
						return;		
			}
			if($scope.password.password == $scope.password.currentPassword)
			{
				{
					swal("Failed!", "new_current_password_same", "error", {
						  confirmButtonText: "Try Again!",
						});					
						return;		
				}
			}
			$http({
				method: 'POST',
				url: 'api/password/update',
				data:{				
				password :$scope.password,tId:$scope.teacher.id,
			}
			}).then(function(success){
				console.log(success);
				$scope.password ={};
				if(success.data.status == 'success')
				{
					notify.closeAll();
					swal("Success!", $translate.instant(success.data.reason), "success", {
						  confirmButtonText: "Close",
						});
				}
				else
				{
					notify.closeAll();
					swal("failed!", $translate.instant(success.data.reason), "error", {
						  confirmButtonText: "Try Again",
						});				
						return;	
				
				}
			},function(error){
				
			});
		}

		$scope.changeNav = function(page)
		{
			if(!angular.equals($scope.oldteacherstatus, $scope.teacherstatus))
				{
						swal({
				title: $translate.instant('unsaved_data'),
				text: $translate.instant('leave_page'),
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes",
				cancelButtonText: "Cancel!",
				closeOnConfirm: true,
				closeOnCancel: true,
			},
			function(isConfirm){
				if (isConfirm) {

					if(page == 'ranking')
				{
					$state.go('app.ranking', {
						    teacher_id: $stateParams.teacher_id
						});	
				}
				if(page == 'profile')
				{
					$state.go('app.profile', {
						    teacher_id: $stateParams.teacher_id
						});	
				}
				
					
				} else {
					return;
				}
			});
					return;
				}
			else
			{
				if(page == 'ranking')
				{
					$state.go('app.ranking', {
						    teacher_id: $stateParams.teacher_id
						});	
				}
				if(page == 'profile')
				{
					$state.go('app.profile', {
						    teacher_id: $stateParams.teacher_id
						});	
				}
			}

		}

		$scope.logout = function()
		{
			window.location.href = "/index";
		}

		$rootScope.changeLanguage = function (langKey) {		 
		   $translate.use(langKey);
		  };

		
    }
    ]);