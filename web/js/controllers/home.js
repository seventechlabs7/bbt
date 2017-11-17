'use strict';


angular.module('app').controller('homepage', ['$scope','$document','$rootScope','$stateParams','$http','$state','$timeout','uiGmapGoogleMapApi','$filter','Upload','notify','UserService','translateService','$translate',
    function($scope,$document,$rootScope,$stateParams,$http,$state,$timeout,uiGmapGoogleMapApi,$filter,Upload,notify,UserService,translateService,$translate) {
        
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


        $scope.openclosecmt = function(a)
        {
        	$('#multiwhole'+a).slideToggle(500);
        }

		$scope.messageFile = "js/messages.html";

        $scope.currentPage ="home";

        $scope.shiftTab = function(index)
        {
        	notify.closeAll();
        	if(index == 2)
        	{

				var list =[];
				if($scope.teacher.mail_list)
				{
					list = $scope.teacher.mail_list.split(',');
					var emailregex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;;
		      		notify.closeAll();
					for (var i = 0; i < list.length; i++) 
					{
						if(list[i] == null)
						{
							notify({
								message: $translate.instant('comma_sepearated_email'),
								classes:'alert-danger',
								duration:2000
							});
							return;
						}
						if(!emailregex.test(list[i]))
						{
							notify({
								message:  $translate.instant('invalid_mail'),
								classes:'alert-danger',
								duration:2000
							});
						return;

						}
					}
				}	
				else
					$scope.teacher.mail_list = "";
				if(list.length == 0 && !$scope.file)
				{
					notify({
						message: $translate.instant('mail_list_or_file'),
						classes:'alert-danger',
						duration:4000
					});
					return;
				}
				if(list.length > 0 && $scope.file)
				{
					notify({
						message: $translate.instant('only_one_email_list'),
						classes:'alert-danger',
						duration:4000
					});
					return;
				}
				$scope.currentStep = 1;
				$scope.start(index);
				return;
        	}
        	if(index == 3)
        	{
        	if(!$scope.teacher.start_date)
			{				
				notify({
					message: $translate.instant('fill_start_date'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(!$scope.teacher.end_date)
			{				
				notify({
					message: $translate.instant('fill_end_date'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			console.log($scope.teacher.assets)
			$scope.assetsCheck = false;
			if(!$scope.teacher.assets)
				$scope.teacher.assets = [];
			for (var i = 0; i < $scope.teacher.assets.length; i++) {
				var a = $scope.teacher.assets[i];
				console.log(a)
				if(a =="1")
					{
						$scope.assetsCheck = true;
						break;
					}

			}
			if(!$scope.assetsCheck)
			{				
				notify({
					message:$translate.instant('select_assets'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(!$scope.teacher.league_name)
			{				
				notify({
					message:$translate.instant('enter_league_name'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(!$scope.teacher.virtual_money)
			{				
				notify({
					message:$translate.instant('enter_virtual_money'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(parseFloat($scope.teacher.virtual_money) <= 0)
				{
					notify.closeAll();			
					notify({
					message:$translate.instant('virtual_money_not_zero'),
					classes:'alert-danger',
					duration:2000
				});
					return;
				}
				$scope.currentStep = 2;
				$scope.start(index);
				return;
        	}
        	if(index == 4)
        {
        	$scope.feedbackCheck = false;
			if(!$scope.teacher.feedback)
				$scope.teacher.feedback = [];
			for (var i = 0; i < $scope.teacher.feedback.length; i++) {
				var a = $scope.teacher.feedback[i];
				if(a == "1")
					{
						$scope.feedbackCheck = true;
						break;
					}

			}
			if(!$scope.feedbackCheck)
			{				
				notify({
					message:$translate.instant('select_feedback'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
        	$scope.currentStep =3;
        	$scope.start(index);
        	return;
        }
		$('.step_head_li').removeClass('active');
    	$('#step_head_'+index).addClass('active');
    	$('.step_body_li').removeClass('active');
    	$('#step_body_'+index).addClass('active');    	

						
        }

        $scope.teacher = {};
        $scope.teacherdetail = {};
        $scope.teacher.virtual_money = "25.000";
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
				{
					$scope.step = 2;
				}
			else if($scope.step == 2)
				{
					$scope.step = 3;
				}
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

		$scope.start = function(index)
		{
			$scope.teacher.save_step = $scope.currentStep;
			$scope.teacher.id = $stateParams.teacher_id; 
/*			if($scope.currentStep ==1)
			{
			if($scope.teacher.mail_list)
			{
				var list = $scope.teacher.mail_list.split(',');
				var emailregex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;;
	      		notify.closeAll();
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
					if(!emailregex.test(list[i]))
					{
						notify({
							message:'Invalid Mail Id',
							classes:'alert-danger',
							duration:2000
						});
					return;

					}
				}
			}	
			else
				$scope.teacher.mail_list = "";
		    }
			if($scope.currentStep == 2)
			{		
			if(!$scope.teacher.start_date)
			{				
				notify({
					message:'Fill Start Date',
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(!$scope.teacher.end_date)
			{				
				notify({
					message:'Fill End Date',
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			$scope.assetsCheck = false;
			if(!$scope.teacher.assets)
				$scope.teacher.assets = [];
			for (var i = 0; i < $scope.teacher.assets.length; i++) {
				var a = $scope.teacher.assets[i];
				if(a == "1")
					{
						$scope.assetsCheck = true;
						break;
					}
			}
			if(!$scope.assetsCheck)
			{				
				notify({
					message:'Select Assets',
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(!$scope.teacher.league_name)
			{				
				notify({
					message:'Enter League Name',
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			if(!$scope.teacher.virtual_money)
			{				
				notify({
					message:'Enter Virtual Money',
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			else
				$scope.teacher.virtual_money = parseFloat($scope.teacher.virtual_money);
		   }*/
		   if($scope.currentStep == 3)
		   {
			$scope.feedbackCheck = false;
			if(!$scope.teacher.feedback)
				$scope.teacher.feedback = [];
			console.log($scope.teacher.feedback)
			for (var i = 0; i < $scope.teacher.feedback.length; i++) {
				var a = $scope.teacher.feedback[i];
				if(a == "1")
					{
						$scope.feedbackCheck = true;
						break;
					}

			}
			if(!$scope.feedbackCheck)
			{	
				notify.closeAll();			
				notify({
					message:$translate.instant('select_feedback'),
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
		   }
			console.log($scope.teacher)
			if($scope.currentStep ==2)
			{
			if($scope.teacher.start_date != undefined && $scope.teacher.start_date != null)
				{
					 $scope.teacher.start_date = $scope.getDateObj($scope.teacher.start_date);
			
					$scope.teacher.start_date = $filter('date')($scope.teacher.start_date, 'yyyy-MM-dd');
				}
			if($scope.teacher.end_date != undefined && $scope.teacher.end_date != null)
				{
					 $scope.teacher.end_date = $scope.getDateObj($scope.teacher.end_date);
					$scope.teacher.end_date = $filter('date')($scope.teacher.end_date, 'yyyy-MM-dd');
				}
				if(parseFloat($scope.teacher.virtual_money) <= 0)
				{
					notify.closeAll();			
					notify({
					message:$translate.instant('virtual_money_not_zero'),
					classes:'alert-danger',
					duration:2000
				});
				return;
				}
			}
			console.log($scope.teacher)

			Upload.upload({
				method: 'POST',				
				url: 'api/saveteacher',
				data:{

					file: $scope.file,
					teacher :$scope.teacher,
					groupId : $scope.savedGroup,
				}
			})
			.then(function(success){
				console.log(success);
				$scope.response = success.data;
				if(success.data.status == 'success')
				{
					if(success.data.dupelicateArray.length >0 || success.data.invalidArray.length >0)
					{
						$('#errorEmails').modal('show');
							/*swal({
						  title: '<i>Failed Emails</i> ',
						  type: 'warning',
						  html:
						   '<div ng-if="response.invalidArray.length >0"> '+
		        			   'following emails are invalid and not added' +
		        			   '<p ng-repeat="email in response.invalidArray">'+
		        			   '{{email}}'+
		        				'</p>'+
	        		       '</div>'+
    					   '<div ng-if="response.dupelicateArray.length >0">'+
    					   'following emails already exists and not added'+
    					   '<p ng-repeat="email in response.dupelicateArray">'+
    					   '{{email}}'+
    					   '</p>'+	        							
    					   '</div>',
						  showCloseButton: true,
						  showCancelButton: false,
						  focusConfirm: false,
						  confirmButtonText:
						    '<i class="fa fa-thumbs-up"></i> Great!',
						})*/
					}
					$scope.savedGroup = success.data.group;
					$('.step_head_li').removeClass('active');
			    	$('#step_head_'+index).addClass('active');
			    	$('.step_body_li').removeClass('active');
			    	$('#step_body_'+index).addClass('active'); 			    
				}	
				else
				{
					$('#zeroEmails').modal('show');
				}			
			},function(error){

			})
		}

		
		$scope.checkTime = function(index)
		{			
			notify.closeAll();
			$scope.pastDateCheck();
			var from = $scope.getDateObj($scope.teacher.start_date);
			var to = $scope.getDateObj($scope.teacher.end_date);
			/*if($scope.teacher.start_date != undefined && $scope.teacher.start_date != null)
				var from = $scope.teacher.start_date;
			if($scope.teacher.end_date != undefined && $scope.teacher.end_date != null)
		      	var to = $scope.teacher.end_date;*/
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
		$scope.pastDateCheck = function()
	    {
	    	notify.closeAll();
	    	if($scope.teacher.start_date)
	    	{
	    		var date = $scope.getDateObj($scope.teacher.start_date);
	    		//var date = new Date($scope.teacher.start_date)	    		
	    		if(date.setHours(0,0,0,0) < new Date().setHours(0,0,0,0))
	    		{
	    			$scope.teacher.start_date = undefined;
	    			notify({
							message: $translate.instant('past_date_error'),
							classes:'alert-danger',
							duration:3000
						});
						return;	
	    			
	    		}
	    	}
	    }

		$scope.getteacherdetails = function(){
			
			$http({
				method: 'GET',
				url: 'api/getteacherdetails/'+$stateParams.teacher_id
			}).then(function(success){
				console.log(success);
				$scope.teacher = success.data.data;
				$scope.teacher.assets = [0,0,0];

				$scope.teacher.feedback = [0,0,0,0];
				$scope.teacher.isGroup = success.data.isGroup;
				console.log($scope.teacher);
			
					console.log($scope.teacher);
					$scope.teacherdetail.name = $scope.teacher.name;
					$scope.teacherdetail.surname =$scope.teacher.surname;
					$scope.teacherdetail.email = $scope.teacher.email;
					$scope.teacherdetail.university = $scope.teacher.university;
					$scope.teacherstatus ={};
					$scope.teacherstatus.about = $scope.teacher.about;
					$scope.teacherstatus.teach_place = $scope.teacher.teach_place;
					$scope.teacherstatus.work = $scope.teacher.work;
					$scope.imageSelected = false;
					$scope.profileImageUrl = success.data.profileImageUrl ;
					//$scope.profileImageUrl = success.data.profileImageUrl+"/"+$scope.teacher.id+".png";
					if(!$scope.teacher.virtual_money)
						$scope.teacher.virtual_money = "25.000";
					$scope.teacher.id = $scope.teacher.id;
					$timeout(function() {
			    $scope.teacher.start_date = new Date();
			    $scope.teacher.start_date = $filter('date')($scope.teacher.start_date, 'dd/MM/yyyy');
			}, 100);
					//alert($scope.teacher.isGroup)
				if(!$scope.teacher.isGroup)			
					$('#addStudent').modal('show');
				$scope.getTimeLine();
				
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


		$scope.teacher_signup = function()
		{				
			$scope.login ={};
			notify.closeAll();		
				console.log($scope.teacher)
				$http({
					method: 'POST',
					url: 'anon/teacher/signup',
					data:$scope.teacher
				}).then(function(success){
					console.log(success)
					if(success.data.status == 'success')
					{
						/*$scope.teacher.id = success.data.teacher_id;
						$scope.teacher_id = $scope.teacher.id;*/
						
						$scope.teacher ={};
						$scope.signup.$setPristine();
						$scope.signup.$setUntouched();

						/*notify({
						message: $translate.instant(success.data.reason),
						classes:'alert-success',
						duration:5000,
						position:'center'
						});*/
						swal({ title : $translate.instant("SUCCESS"),
							text : $translate.instant(success.data.reason),
							type : "success",
						  showConfirmButton: true,
						  confirmButtonText: $translate.instant("CLOSE"),
						});

					$scope.signupReason = $translate.instant(success.data.reason);		
					}else if(success.data.status == 'failed')
					{
						/*notify({
							message: translateService.translate(success.data.reason),
							classes:'alert-danger',
							duration:3000
						});
						return;	*/
						swal( { 
					title : $translate.instant("FAILED"),
				 	text : $translate.instant(success.data.reason),
				 	type: "warning", 
					showConfirmButton: true,
					confirmButtonText: $translate.instant("OK"),
						});				
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


	    $scope.dashBoard = function()
       {
       	$http({
				method: 'POST',
				url: 'api/ranking/dashboard',
				data:{uId :  $stateParams.teacher_id }
			}).then(function(success){
				var data = success.data;
				$scope.report = data.report;	
				if($scope.report)
				{
					if($scope.report.count == 0)
					{
						$scope.report.benefits = parseFloat("00.0000");
						$scope.report.operations = 0;
						$scope.report.percentage = "0.00"
					}
				}
				if(!$scope.report.benefits)
					$scope.report.benefits = "00.0000";
				$scope.report.benefits = parseFloat($scope.report.benefits).toLocaleString("de-DE");	

			},function(error){

			});
       }

	    $scope.initSettings = function()
		{/*
			var input = document.getElementById("sDateField");
			var today = new Date();
			var day = today.getDate();
			// Set month to string to add leading 0
			var mon = new String(today.getMonth()+1); //January is 0!
			var yr = today.getFullYear();

			if(mon.length < 2) { mon = "0" + mon; }

			var date = new String( yr + '-' + mon + '-' + day );

			input.disabled = false; 
			input.setAttribute('min', date);*/
			
			   
			   // $('#sDateField').val(today);
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
					$scope.getteacherdetails();					
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
					$scope.processTimeline();
					console.log("timeLine")
					console.log($scope.timeLine);
				},function(error){

				});
	    }

	    $scope.processTimeline = function()
	    {
	    	for (var i = 0; i < $scope.timeLine.length; i++) 
	    	{
	    		var obj = $scope.timeLine[i];
	    		obj.shares = parseFloat(obj.shares).toLocaleString("de-DE");
	    		obj.amount = parseFloat(obj.amount).toLocaleString("de-DE");
	    	}
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
			else if(page == 'profile')
			{
				$state.go('app.profile', {
					    teacher_id: $scope.teacher.id 
					});	
			}
			else if(page == 'feedback')
			{
				$state.go('app.feedback', {
					    teacher_id: $scope.teacher.id 
					});	
			}
			else if(page == 'forgotpassword')
			{
				$state.go('app.forgotpassword', {
					    
					});	
			}
		}
		$scope.login = {};
		$scope.loginNow = function()
		{
			if($scope.blocked)
				return;
			notify.closeAll();
			if($scope.login.email && $scope.login.password)
			{
				$scope.blocked = true;
				$http({
					method: 'POST',
					url: 'anon/login',
					data: $scope.login,
				}).then(function(success){
					$scope.blocked = false;
					if(success.data.status =="success")
					{
						var user ={};
						 user.access_token = $translate.instant(success.data.token);
		                 UserService.setCurrentUser(user);
		                 $rootScope.$broadcast('authorized');
		                 $state.go('app.profile', {
					    		teacher_id: success.data.id 
							});	
					}
					else
						{
							notify.closeAll();
							notify({
							message: $translate.instant(success.data.reason),
							classes:'alert-danger',
							duration:5000
							});

						}
				},function(error){
					$scope.blocked = false;
					notify.closeAll();
					notify({
							message: $translate.instant('invalid_credentials'),
							classes:'alert-danger',
							duration:5000
							});
				});
			}
			else
			{
				notify.closeAll();
					notify({
							message: $translate.instant('enter_email_and_password'),
							classes:'alert-danger',
							duration:5000
						});
				return ;
			}
		}

		 $scope.getDateObj = function(date)
	    {
	    	var e = date.split("/").reverse().join("-");
				var e2= e.split(" 00");				
				var e3 = e2[0];
				var e1 = e3.replace(/-/g , "/");				
			return	e1 = new Date(e1);	

	    }

	     $scope.checkVirtualMoney = function()
	    {
	    	if((parseFloat($scope.teacher.virtual_money).toLocaleString("de-DE")).length >16)
	    	{
				$scope.teacher.virtual_money = "";
				notify({
					message: $translate.instant('virtual_money_too_long'),
					classes:'alert-danger',
					duration:3000
				});
				return;	

	    	}
	    }


		/*initialiser for date*/

		/*$scope.dateinitialize = function()
		{
		        console.log("date called")
		             $("#picker1").datepicker();
		             $('[data-toggle="datepicker"]').datepicker();
		}*/

    }
    ]);