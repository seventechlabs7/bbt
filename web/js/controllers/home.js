'use strict';


angular.module('app').controller('homepage', ['$scope','$document','$rootScope','$stateParams','$http','$state','$timeout','uiGmapGoogleMapApi','$filter','Upload','notify','UserService',
    function($scope,$document,$rootScope,$stateParams,$http,$state,$timeout,uiGmapGoogleMapApi,$filter,Upload,notify,UserService) {
        
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

		$scope.start = function()
		{
			$scope.teacher.id = $stateParams.teacher_id;//$scope.teacher.mail_list == undefined || 
			
			var list = $scope.teacher.mail_list.split(',');
			var emailregex = /\S+@\S+\.\S+/;
      
			for (var i = 0; i < list.length; i++) 
			{
				if(list[i] == null)
				{
					notify({
						message:'Should Seperate by single comma',
						classes:'alert-danger',
						duration:2000
					});
					return;
				}
				if(!list[i].match(emailregex))
				{
					notify({
						message:'Invalid Mail Id',
						classes:'alert-danger',
						duration:2000
					});
				return;

				}
			}	
					
			if($scope.teacher.start_date == undefined || $scope.teacher.start_date == null)
			{				
				notify({
					message:'Fill Start Date',
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if($scope.teacher.end_date == undefined || $scope.teacher.end_date == null)
			{				
				notify({
					message:'Fill End Date',
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if($scope.teacher.assets == undefined || $scope.teacher.assets == 0)
			{				
				notify({
					message:'Select Assets',
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if($scope.teacher.league_name == undefined || $scope.teacher.league_name == null)
			{				
				notify({
					message:'Enter League Name',
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if($scope.teacher.virtual_money == undefined || $scope.teacher.virtual_money == null)
			{				
				notify({
					message:'Enter Virtual Money',
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if($scope.teacher.feedback == undefined || $scope.teacher.feedback == null)
			{				
				notify({
					message:'Select Feedback',
					classes:'alert-danger',
					duration:2000
				});
				return;
			}

			console.log($scope.teacher)

			if($scope.teacher.start_date != undefined && $scope.teacher.start_date != null)
				$scope.teacher.start_date = $filter('date')($scope.teacher.start_date, 'yyyy-MM-dd');
			
			if($scope.teacher.end_date != undefined && $scope.teacher.end_date != null)
				$scope.teacher.end_date = $filter('date')($scope.teacher.end_date, 'yyyy-MM-dd');
			console.log($scope.teacher)

			Upload.upload({
				method: 'POST',				
				url: 'api/saveteacher',
				data:{
					file: $scope.file,
					teacher :$scope.teacher,
				}
			})
			.then(function(success){
				console.log(success)
				if(success.data.status == 'success')
				{
					$scope.shiftTab(4);
					//$('#addStudent').modal('hide');
				}				
			},function(error){

			})
		}

		$scope.checkTime = function(index)
		{			
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
		      		message: 'Invalid End Date',
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
				console.log($scope.teacher);
				for(var i in $scope.teacher){
					console.log($scope.teacher[i]);
					$scope.teacherdetail.name = $scope.teacher[i].name;
					$scope.teacherdetail.surname =$scope.teacher[i].surname;
					$scope.teacherdetail.email = $scope.teacher[i].email;
					$scope.teacherdetail.university = $scope.teacher[i].university;
					$scope.teacherstatus ={};
					$scope.teacherstatus.about = $scope.teacher[i].about;
					$scope.teacherstatus.teach_place = $scope.teacher[i].teach_place;
					$scope.teacherstatus.work = $scope.teacher[i].work;
					$scope.profileImageUrl = success.data.profileImageUrl ;
					$scope.profileImageUrl = success.data.profileImageUrl+"/"+$scope.teacher[i].id+".jpeg";
					if(!$scope.teacher.virtual_money)
						$scope.teacher.virtual_money = "25000.00";
					$scope.teacher.id = $scope.teacher[i].id;
					$timeout(function() {
			    $scope.teacher.start_date = new Date();
			}, 100);
				}	
				$scope.getTimeLine();
				if(!$scope.teacherstatus.about)			
					$('#addStudent').modal('show');
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
						message:'Your Status is Saved Successfully',
						classes:'alert-success',
						duration:3000
					});
				}
			},function(error){
				
			});
		}


		$scope.teacher_signup = function()
		{						
				console.log($scope.teacher)
				$http({
					method: 'POST',
					url: 'api/teacher/signup',
					data:$scope.teacher
				}).then(function(success){
					console.log(success)
					if(success.data.status == 'success')
					{
						$scope.teacher.id = success.data.teacher_id;
						$scope.teacher_id = $scope.teacher.id;
						notify({
						message: success.data.reason,
						classes:'alert-success',
						duration:3000
					});
					/*$state.go('app.profile', {
					    teacher_id: $scope.teacher_id 
					});	*/
					$scope.completed = true;	
					$scope.signupReason = success.data.reason;		
					}else if(success.data.status == 'failed')
					{
						notify({
							message: success.data.reason,
							classes:'alert-danger',
							duration:3000
						});
						return;			
					}
				},function(error){

				});
		}
		console.log($scope.teacher_id);
		/*var today = new Date();
	    var dd = today.getDate();
	    var mm = today.getMonth()+1;
	    var yyyy = today.getFullYear();
	     if(dd<10){
	            dd='0'+dd
	        } 
	        if(mm<10){
	            mm='0'+mm
	        } 

	    $scope.today = yyyy+'-'+mm+'-'+dd;
	    console.log($scope.today);*/
	    //faiyaz
	    $scope.pastDateCheck = function()
	    {
	    	if($scope.teacher.start_date)
	    	{
	    		var date = new Date($scope.teacher.start_date)	    		
	    		if(date.setHours(0,0,0,0) < new Date().setHours(0,0,0,0))
	    		{
	    			$scope.teacher.start_date = undefined;
	    			notify({
							message:'Past Dates Not Allowed',
							classes:'alert-danger',
							duration:3000
						});
						return;	
	    			
	    		}
	    	}
	    }

	    $scope.initSettings = function()
		{
			var input = document.getElementById("sDateField");
			var today = new Date();
			var day = today.getDate();
			// Set month to string to add leading 0
			var mon = new String(today.getMonth()+1); //January is 0!
			var yr = today.getFullYear();

			if(mon.length < 2) { mon = "0" + mon; }

			var date = new String( yr + '-' + mon + '-' + day );

			input.disabled = false; 
			input.setAttribute('min', date);
			
			   
			   // $('#sDateField').val(today);
		}

	    $scope.selectAvatar = function(avatar)

	    {
	    	$scope.avatarFile = avatar;
	    }

	    $scope.uploadAvatar = function()
	    {
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
				notify({
							message:'Avatar Uploaded Successfully',
							classes:'alert-danger',
							duration:3000
						});
				$scope.getteacherdetails();
						return;					
			},function(error){

			})
	    }

	    $scope.getTimeLine = function()
	    {
	    	$http({
					method: 'GET',
					url: 'api/getUserOperations/'+$stateParams.teacher_id,
					
				}).then(function(success){
					console.log(success)
					$scope.timeLine = success.data;
					console.log("timeLine")
					console.log($scope.timeLine);
				},function(error){

				});
	    }
	    
		//$("#signup").validate();
		$scope.postLike = function(rId)
		{
			$http({
					method: 'POST',
					url: 'api/timeline/postLike',
					data:{'rId': rId , 'uId' : $scope.teacher.id}
				}).then(function(success){
					 $scope.getTimeLine();
					console.log(success)
					//$scope.timeLine = success.data;
					console.log("timeLine")
					console.log($scope.timeLine);
				},function(error){
					 $scope.getTimeLine();
				});
		}
		$scope.postComment = function(rId,c)
		{
			$http({
					method: 'POST',
					url: 'api/timeline/postComment',
					data:{'rId': rId  ,uId : $scope.teacher.id ,comment : c}
				}).then(function(success){
					console.log(success)
					 $scope.getTimeLine();
					//$scope.timeLine = success.data;
					console.log("timeLine")
					console.log($scope.timeLine);
				},function(error){
 						$scope.getTimeLine();
				});
		}

		$scope.postCommentLike = function(rId,cId)
		{
			$http({
					method: 'POST',
					url: 'api/timeline/postCommentLike',
					data:{'rId': rId , 'uId' : $scope.teacher.id , 'cId' :cId}
				}).then(function(success){
					 $scope.getTimeLine();
					console.log(success)
					//$scope.timeLine = success.data;
					console.log("timeLine")
					console.log($scope.timeLine);
				},function(error){
					 $scope.getTimeLine();
				});
		}

		$scope.editProfile = function()
		{
			$state.go('app.editprofile', {
					    teacher_id: $scope.teacher.id 
					});	
		}
		
		
		$scope.changeNav = function(page)
		{
			if(page == 'ranking')
			{
				$state.go('app.ranking', {
					    teacher_id: $scope.teacher.id 
					});	
			}
		}
		$scope.login = {};
		$scope.loginNow = function()
		{
			if($scope.login.email && $scope.login.password)
			{
				$http({
					method: 'POST',
					url: 'auth/login',
					data: $scope.login,
				}).then(function(success){
					if(success.data.status =="success")
					{
						var user ={};
						 user.access_token = success.data.token;
		                 UserService.setCurrentUser(user);
		                 $rootScope.$broadcast('authorized');
		                 $state.go('app.profile', {
					    		teacher_id: success.data.id 
							});	
					}
					else
						{
							notify({
							message: 'Invalid Credentials',
							classes:'alert-danger',
							duration:3000
							});

						}
				},function(error){
					
					notify({
							message: 'Invalid Credentials 1',
							classes:'alert-danger',
							duration:3000
							});
				});
			}
			else
			{
					notify({
							message: 'Enter valid email and password',
							classes:'alert-danger',
							duration:3000
						});
				return ;
			}
		}

		$scope.logout = function()
		{
			window.location.href = "/index";
		}

    }
    ]);