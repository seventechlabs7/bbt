'use strict';


angular.module('app').controller('ranking', ['$scope','$document','$rootScope','$stateParams','$http','$state','$timeout','uiGmapGoogleMapApi','$filter','Upload','notify','NgTableParams','blockUI',
    function($scope,$document,$rootScope,$stateParams,$http,$state,$timeout,uiGmapGoogleMapApi,$filter,Upload,notify,NgTableParams,blockUI) {
        
       $scope.screen = "start";
       $scope.init = function(gId)
       {          		
       		$scope.getTeacherDetails();  			
       }
       $scope.type = "ranking";
       $scope.getTeacherDetails = function()
       {
       		$http({
				method: 'GET',
				url: 'api/getteacherdetails/'+$stateParams.teacher_id
			}).then(function(success){
				console.log(success);
				$scope.teacher = success.data.data;
				$scope.teacher.isGroup = success.data.isGroup;
				if(!$scope.teacher.isGroup)			
						{
							$state.go('app.profile', {
					    		teacher_id: $stateParams.teacher_id
							});	
						}
				console.log($scope.teacher);
				for(var i in $scope.teacher){					
					$scope.teacher.id = $scope.teacher.id;			
				}				
				$scope.loadRanking();
			},function(error){
				
			});
       }

       $scope.loadRanking = function(gId)
       {
			$http({
				method: 'POST',
				url: 'api/ranking/load',
				data:{'gId': gId ,uId : $scope.teacher.id }
			}).then(function(success){
				var data = success.data;
				if(data.status == "success")
				{
					$scope.groupData =data.groupData;
					$scope.feedbackData = data.feedback;
					
					$scope.groups = data.groups;
					$scope.currentGroupId = parseInt($scope.groupData.id);

					if($scope.groups.length < 1)
					{
						$scope.teacher.start_date = new Date();
			   			$scope.teacher.start_date = $filter('date')($scope.teacher.start_date, 'dd/MM/yyyy');
			   			$scope.teacher.virtual_money = "25000.00";
			   			$scope.teacher.assets = [0,0,0];
						$scope.teacher.feedback = [0,0,0,0];
						$('#addStudent').modal('show');
						$scope.shiftTab(1);
					}
					else if($scope.groups.length >0 && !$scope.groupData)
					{

						$scope.savedGroup = data.groups[0].id;
						$scope.currentGroupId = $scope.savedGroup;
						$scope.teacher.start_date = new Date();
			   			$scope.teacher.start_date = $filter('date')($scope.teacher.start_date, 'dd/MM/yyyy');
			   			$scope.teacher.virtual_money = "25000.00";
			   			$scope.teacher.assets = [0,0,0];
						$scope.teacher.feedback = [0,0,0,0];
						$('#addStudent').modal('show');
						$('.step_head_li').removeClass('active');
				    	$('#step_head_'+2).addClass('active');
				    	$('.step_body_li').removeClass('active');
				    	$('#step_body_'+2).addClass('active'); 
					}
					else if($scope.feedbackData.length ==0)
					{
						$scope.savedGroup = data.groups[0].id;
						$scope.teacher.feedback = [0,0,0,0];
						$('#addStudent').modal('show');
						$('.step_head_li').removeClass('active');
				    	$('#step_head_'+3).addClass('active');
				    	$('.step_body_li').removeClass('active');
				    	$('#step_body_'+3).addClass('active'); 
					}
					$scope.groupData.start_date =   $filter('date')($scope.groupData.start_date, 'dd/MM/yyyy');
					$scope.groupData.end_date =   $filter('date')($scope.groupData.end_date, 'dd/MM/yyyy');
					var deadline = new Date($scope.groupData.end_date);
					//$scope.initializeClock('clockdiv', deadline);
					$scope.currentEndDate = angular.copy($scope.groupData.end_date);
					$scope.stopcountdown = false;
					updateClockNg();
					$scope.loadRankingList();					
				}

			},function(error){

			});
       }

       $scope.loadRankingList = function()
       {
       	$http({
				method: 'POST',
				url: 'api/ranking/list',
				data:{uId :  $stateParams.teacher_id }
			}).then(function(success){
				var data = success.data;
				console.log("list");
				console.log(data)
				$scope.rankingList = data;
				
				$scope.dashBoard();		

			},function(error){

			});
       }

        $scope.dashBoard = function()
       {
       	$http({
				method: 'POST',
				url: 'api/ranking/dashboard',
				data:{uId :  $stateParams.teacher_id }
			}).then(function(success){
				var data = success.data;
				console.log("===data====");
				console.log(data);
				$scope.report = data.report;
				if($scope.report)
				{
					if($scope.report.count == 0)
					{
						$scope.report.benefits = parseFloat("00.0000");
						$scope.report.operations = 0;
						$scope.report.percentage = "0.00";
						$scope.rankingList = [];
					}
					else
						$scope.processRankingTable();	
				}
				$scope.report.benefits = parseFloat($scope.report.benefits).toLocaleString("de-DE");							
			},function(error){

			});
       }


       $scope.processRankingTable = function()
       {
	       	for(var i=0;i<$scope.rankingList.length;i++)
	       	{
	       		var obj = $scope.rankingList[i];
	       		obj.benefitPercent = (((parseFloat(obj.newamount)-2500000)/2500000) * 100).toFixed(2) ; 
	       		obj.position = parseInt(obj.position);
	       		obj.amount = parseFloat(obj.amount).toLocaleString("de-DE");;
	       		obj.operations = parseInt(obj.operations);
	       		obj.benefits =parseFloat(obj.benefits).toLocaleString("de-DE"); ;      	
	       	}
       	    $scope.rankTable = createUsingFullOptionsRanking();
       }

       $scope.positionCheck = function(oldPos , newPos)
       {
       		return (parseInt(newPos) <= parseInt(oldPos));
       }

       $scope.removeStudent = function(sId)
       {
			swal({
				title: "Are you sure?",
				text: "This will permanently remove user from group",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Delete",
				cancelButtonText: "Cancel!",
				closeOnConfirm: false,
				closeOnCancel: true,
				showLoaderOnConfirm: true,
			},
			function(isConfirm){
				if (isConfirm) {

				$http({
				method: 'POST',
				url: 'api/student/removeFromGroup',
				data:{uId : $stateParams.teacher_id ,'sId': sId}
				}).then(function(success){

				var data = success.data;
				if(data.status =="success")
					{
						swal({
						title:"Deleted!", 
						text:data.reason,
						type:"success",
						closeOnConfirm:true,});
					}
				else
				{
					swal({
						title:"Error!", 
						text:data.reason,
						type:"warning",
						closeOnConfirm:true,});
				}
				//$scope.loadRankingList();
				$scope.rankTable;
				console.log($scope.rankTable)
			},function(error){
				swal("Error!", "Something Went Wrong", "error");
			});
					
				} else {
					
				}
			});

       }

       $scope.strToDate = function(date)
       {
       		 var from = date.split("-");
       		 var f = new Date(from[0], from[1] - 1, from[2]);
       		 return f;
       }

       /*clock*/
       	$scope.resetClock = function()
       	{
       		$scope.days = null
			$scope.hours  = null;
			$scope.minutes = null
			$scope.seconds  = null;

       		/*var clock = document.getElementById('clockdiv');
			var daysSpan = clock.querySelector('.days');
			var hoursSpan = clock.querySelector('.hours');
			var minutesSpan = clock.querySelector('.minutes');
			var secondsSpan = clock.querySelector('.seconds');

			daysSpan.innerHTML = undefined;
			hoursSpan.innerHTML = undefined;
			minutesSpan.innerHTML = undefined;
			secondsSpan.innerHTML = undefined;*/
			//initializeClock('clockdiv','a','reset');
       	}

			function getTimeRemaining(endtime) 
			{
				var t = Date.parse(endtime) - Date.parse(new Date());
				var seconds = Math.floor((t / 1000) % 60);
				var minutes = Math.floor((t / 1000 / 60) % 60);
				var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
				var days = Math.floor(t / (1000 * 60 * 60 * 24));
				return {
				'total': t,
				'days': days,
				'hours': hours,
				'minutes': minutes,
				'seconds': seconds
				};
			}
				var timeinterval ;
			$scope.initializeClock = function(id, endtime,reset) {

				var clock = document.getElementById(id);
				/*var daysSpan = clock.querySelector('.days');
				var hoursSpan = clock.querySelector('.hours');
				var minutesSpan = clock.querySelector('.minutes');
				var secondsSpan = clock.querySelector('.seconds');*/

				
				updateClock(endtime);
				timeinterval = $timeout(updateClock(endtime), 1000);
				}
		function updateClock (endtime) {
			var t = getTimeRemaining(endtime);

			/*daysSpan.innerHTML = t.days;
			hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
			minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
			secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);*/

			$scope.days = t.days;
			$scope.hours  = ('0' + t.hours).slice(-2);
			$scope.minutes = ('0' + t.minutes).slice(-2);
			$scope.seconds  = ('0' + t.seconds).slice(-2);

			if (t.total <= 0) {

			clearInterval(timeinterval);
			}

			
			}

			$scope.changeScreen= function(screen)
			{
				$scope.screen = screen;
				if(screen == "start")
					{
						$scope.type = "ranking";
						$scope.unsaved = false;
					}
				$scope.teacher ={};
				$scope.teacher.gId = $scope.groupData.id;
				$scope.teacher.mail_list = "";
				$scope.teacher.assets = [];
				if(screen =="league")
				{
					$scope.getLeagueDetails(); // currently using group data
				}
				if(screen == "editfeedback")
				{
					$scope.getLeagueDetails(); 
				}
			}

			$scope.selectFile = function(file)
			{
				$scope.file = file;
			}

			$scope.addStudents = function()
			{
				$scope.teacher.id = $stateParams.teacher_id;	
				
				var list =[];
				notify.closeAll();
				if($scope.teacher.mail_list)
				{
					list = $scope.teacher.mail_list.split(',');
					var emailregex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		      		notify.closeAll();
					for (var i = 0; i < list.length; i++) 
					{
						if(list[i] == null)
						{
							notify({
								message:'Should be Seperated by single comma',
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
				if(list.length == 0 && !$scope.file)
				{
					notify({
						message:'Enter valid comma sepearated emails or upload a email list file',
						classes:'alert-danger',
						duration:4000
					});
					return;
				}
				if(list.length > 0 && $scope.file)
				{
					notify({
						message:'Cannot add both mail list and file . Choose either of the two',
						classes:'alert-danger',
						duration:4000
					});
					return;
				}

				swal({
				title: "Upload Students",
				text: "Are you sure you want to upload ?",
				type: "info",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Upload",
				cancelButtonText: "Cancel!",
				closeOnConfirm: false,
				closeOnCancel: true,
				showLoaderOnConfirm: true,
			},
			function(isConfirm){
				if (isConfirm) {

				Upload.upload({
					method: 'POST',				
					url: 'api/addstudents',
					data:{
							file: $scope.file,
							teacher :$scope.teacher,
						}
					})
					.then(function(success){
					console.log(success)
					var data = success.data;
				if(data.status =="success")
					{
						swal("Uploaded!", data.reason, "success");
						$scope.teacher.mail_list = "";
						$scope.file = null;
						$scope.changeScreen('start');
					}
				else
					swal("Error!", data.reason, "warning");	

					},function(error){

					})
					
				} else {
					
				}
			});
			
				
			}

			$scope.getLeagueDetails =function()
			{
				$http({
				method: 'POST',
				url: 'api/league/details',
				data:{uId : $scope.teacher.id ,gId:$scope.teacher.gId }
				}).then(function(success){
				var data = success.data;
				console.log("data league");
				console.log(data)
				
				$scope.teacher.league_name = data.league.league_name;
				$scope.teacher.start_date = new Date(data.league.start_date);
				$scope.teacher.end_date = new Date(data.league.end_date);

				/*date filter*/
			    $scope.teacher.start_date = $filter('date')($scope.teacher.start_date, 'dd/MM/yyyy');
			    $scope.teacher.end_date = $filter('date')($scope.teacher.end_date, 'dd/MM/yyyy');

				$scope.teacher.virtual_money = parseFloat(data.league.virtual_money).toLocaleString("de-DE");

				$scope.teacher.assets =(data.assets).split(',');

				$scope.teacher.feedback = (data.feedback).split(',');
				console.log($scope.teacher.feedback)
				//$scope.processArrays();
				$scope.oldObj = angular.copy($scope.teacher);
				$scope.unsaved =true;
				if($scope.screen == "start")
					$scope.unsaved = false;
				},function(error){

				});
			}

/*			$scope.processArrays = function()
			{
				for (var i = 0; i < $scope.teacher.feedback.length; i++) {
					var obj = JSON.stringify($scope.teacher.feedback[i]);

				}
				console.log($scope.teacher.feedback)
			}*/
			$scope.editVirtualMoney = function()
			{
				if(!$scope.teacher.start_date )
					return;
				var from = new Date($scope.teacher.start_date.split("/").reverse().join("-"));
				$scope.currentDate =  new Date();
				var current = 	$scope.currentDate;
				$scope.DisableStartDate = false;
		      if(	current.getTime() > from.getTime())
		      		{
		      			$scope.DisableStartDate = true;
		      			return true;
		      		}
		      		else
		      		{
		      			return false;
		      		}
			}

			$scope.stopcountdownFun = function(index)
			{
				//$scope.pastDateCheck();
				$scope.stopcountdown = true;
				$scope.checkTime(index);
			}
			$scope.checkTime = function(index)
		{	

			notify.closeAll();
			if(!$scope.DisableStartDate)	
			    {
			    	$scope.pastDateCheck();
			    }

			if($scope.teacher.start_date && $scope.teacher.end_date)
			{
				var from = new Date($scope.teacher.start_date.split("/").reverse().join("-"));
				var to = new Date($scope.teacher.end_date.split("/").reverse().join("-"));
			}
			else
				 return;
		      var timeDiff = Math.abs(to.getTime() - from.getTime());
		      var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));  
		      if(to.getTime() < from.getTime())
		      {
		      	notify.closeAll();
		      	notify({
		      		message: 'Invalid End Date',
		      		classes: 'alert-danger',
		      		duration: 2000
		      	});
		      	$scope.teacher.end_date = null;
		      	return;
		      }
		      var curDate = new Date();
		      var curDate1 = curDate.setHours(0,0,0,0);
		       if(to.getTime() < curDate.getTime())
		      {
		      	notify.closeAll();
		      	notify({
		      		message: 'End date is less than current date',
		      		classes: 'alert-danger',
		      		duration: 2000
		      	});
		      	$scope.teacher.end_date = null;
		      	return;
		      }
		     // var deadline = new Date($scope.teacher.end_date);
		      $scope.currentEndDate = angular.copy($scope.teacher.end_date);
		      //return;
		      $scope.stopcountdown =false;
		     // updateClockNg();
				

/*		      $timeout(function()
		      	{
		      		 
		      	},2000);*/
		}

		   $scope.pastDateCheck = function()
	    {
	    	notify.closeAll();
	    	if($scope.teacher.start_date)
	    	{
	    		var date = new Date($scope.teacher.start_date.split("/").reverse().join("-"));
	    		//var date = new Date($scope.teacher.start_date)	    		
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

		$scope.updateLeague = function()
		{
			notify.closeAll();
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
				console.log(a)
				if(a =="1" )
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
			//$scope.teacher.assets = $scope.teacher.assets.join(",");
			console.log($scope.teacher.assets);
			$scope.teacher.start_date = new Date($scope.teacher.start_date.split("/").reverse().join("-"));
			$scope.teacher.start_date =  $filter('date')($scope.teacher.start_date, 'yyyy-MM-dd');

			$scope.teacher.end_date = new Date($scope.teacher.end_date.split("/").reverse().join("-"));
			$scope.teacher.end_date =  $filter('date')($scope.teacher.end_date, 'yyyy-MM-dd');
			$scope.unsaved =false;
			$http({
				method: 'POST',
				url: 'api/league/update',
				data:{uId : $scope.teacher.id ,data:$scope.teacher }
				}).then(function(success){
				var data = success.data;
				notify.closeAll();
				if(data.status =="success")
				{
					notify({
					message: data.reason,
					classes:'alert-success',
					duration:2000
				});
					$scope.changeScreen('start');
				}
				else
				{
					notify({
					message: data.reason,
					classes:'alert-danger',
					duration:2000
					});
				}
				$scope.changeScreen('start');			
				},function(error){

				});
		}

		$scope.updateFeedback = function()
		{
			if(!$scope.teacher.feedback)
				$scope.teacher.feedback = [];
			for (var i = 0; i < $scope.teacher.feedback.length; i++) {
				var a = $scope.teacher.feedback[i];
				console.log(a)
				if(a == "1")
					{
						$scope.feedbackCheck = true;
						break;
					}

			}
			if(!$scope.feedbackCheck)
			{				
				notify({
					message:'Select Feedback',
					classes:'alert-danger',
					duration:2000
				});
				return;
			}
			$scope.unsaved =false;
			$http({
				method: 'POST',
				url: 'api/feedback/update',
				data:{uId : $scope.teacher.id ,data:$scope.teacher }
				}).then(function(success){
				var data = success.data;
				notify.closeAll();
				if(data.status =="success")
				{
					notify({
					message: data.reason,
					classes:'alert-success',
					duration:2000
				});
					$scope.changeScreen('start');
				}
				else
				{
					notify({
					message: data.reason,
					classes:'alert-danger',
					duration:2000
					});
				}
				$scope.changeScreen('start');			
				},function(error){

				});
		}

		$scope.chatNow = function(row)
		{
			$scope.chatUserId = row;
			$scope.chat = {};
			$http({
				method: 'POST',
				url: 'api/chat/get',
				data:{tId : $stateParams.teacher_id ,uId : $scope.chatUserId }
				}).then(function(success){
				var data = success.data;

				$scope.processMessages(data,success.data.myName);
				$scope.curEncUID = success.data.encUID;
						

				//$scope.changeScreen('start');			
				},function(error){

				});
		}

		//$scope.sendMessage($stateParams.teacher_id,row.userId,inputValue);
		$scope.processMessages = function(data,myName)
		{
			console.log(data);
			$scope.messageList = [];
			$scope.chat = {};
			$scope.chat.partnerName = data.partnerName;
			var messages = data.list.messages.split(/<p>(.*?)<em>/);
			console.log(messages);
			for(var i = 0 ; i <messages.length;i++)
			{
				var message = messages[i];
				if(message)
				{
					var finalOj = {};
					var newObj = message.split(":");
					var j = 0;
					if(newObj.length == 2)
					{						
						finalOj.user = newObj[0];
						finalOj.myName = myName;
						if(finalOj.user == myName)
							finalOj.type = "right";
						else
							finalOj.type = "left";
						finalOj.message = newObj[1];
						$scope.messageList.push(finalOj);
						j++;
					}
					/*else
					{
						finalOj.time = message;
						$scope.messageList.splice(j, 0, finalOj);
					}*/
					
					
				}
			}
			$scope.chatActive = true;
			$scope.chat.messages = [];
			$scope.chat.messages = $scope.messageList;
			console.log($scope.chat);
		}

		$scope.chatType = function(message)
		{
			if(message.user != message.myName)
				return "message-partner";
		}

		$scope.closeChat = function()
		{
			$scope.chatActive = false;
		}

		$scope.sendMessage = function()
		{
			notify.closeAll();
			if(!$scope.chat.newMessage)
			{
				notify({
					message: 'Enter a message',
					classes:'alert-warning',
					duration:2000
					});
				return;
			}
			else
			{
				if($scope.chat.newMessage.trim().length >30)
				{
					notify({
					message: 'Message length too long',
					classes:'alert-warning',
					duration:2000
					});
					return;
				}
			}
			var message = $scope.chat.newMessage;
			$scope.chat.newMessage = "";
			blockUI.stop();
			$http({
				method: 'POST',
				url: 'api/chat/send',
				data:{uId :$scope.chatUserId ,tId:$stateParams.teacher_id ,'message':$scope.curEncUID+":"+message }
				}).then(function(success){
				var data = success.data;
				$scope.chatNow($scope.chatUserId);
						
				},function(error){

				});
		}

		/*for countdown v2 - Angular*/
			$scope.timeTillEvent = {};

			var updateClockNg = function ()
			 {
			 	/*if($scope.stopcountdown)
			 		return;*/
			 	$scope.timeTillEvent = {};
				var e = angular.copy($scope.currentEndDate);
				e = new Date(e.split("/").reverse().join("-"));
				var d1 = e;
				d1.setHours(24,0,0,0);
				var d2 = new Date();
				//d2.setHours(0,0,0,0);
				var t1 = d1.getTime();
				var t2 = d2.getTime();
				$scope.seconds = (t1-t2)/1000;
				$scope.timeTillEvent = {
				days: parseInt($scope.seconds / 86400),
				hours: parseInt($scope.seconds % 86400 / 3600),
				mins: parseInt($scope.seconds % 86400 % 3600 / 60),
				seconds: parseInt($scope.seconds % 86400 % 3600 % 60)
				}
				
			}

			setInterval(function () {
				$scope.$apply(updateClockNg);
				}, 1000);
			

             $scope.changeNav = function(page)
			{
				console.log($scope.oldObj);
				console.log($scope.teacher);
				if(!angular.equals($scope.oldObj, $scope.teacher) && $scope.unsaved)
				{
						swal({
				title: "unsaved Data",
				text: "Are you sure you want to leave page ?",
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
						$state.go('app.profile', {
						    teacher_id: $stateParams.teacher_id
						});	
				
					
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


		$scope.userBasedFeedBack = function(userId)
		{
			$scope.studentId = userId;
			$http({
				method: 'POST',
				url: 'api/ranking/student',
				data:{uId :  $stateParams.teacher_id ,sId:userId ,gId : $scope.currentGroupId}
			}).then(function(success){
				$scope.type = "studentFeedback";
				var data = success.data;

				$scope.students = data.students;

				$scope.purchaseData = data.purchase;
				$scope.processPurchaseTable();
				
				$scope.operationsData = data.operations;
				$scope.processOperationsTable()					

			},function(error){

			});
		}

		 $scope.processPurchaseTable = function()
       {
	       	for(var i=0;i<$scope.purchaseData.length;i++)
	       	{
	       		var obj = $scope.purchaseData[i];
	       		obj.purchasePrice = parseFloat(obj.purchasePrice).toLocaleString("de-DE");;
	       		obj.purchaseShare = parseFloat(obj.purchaseShare).toLocaleString("de-DE");; 
				obj.purchaseDate = moment(new Date(obj.purchaseDate)).format("DD/MM/YYYY");
				obj.currentPrice = parseFloat(obj.current_price).toLocaleString("de-DE");;
				obj.benefits = parseFloat(obj.benefit).toLocaleString("de-DE");;
	       	}
       	  $scope.purchaseTable = createUsingFullOptionsPurchase();
       }

        $scope.processOperationsTable = function()
       {
	       	for(var i=0;i<$scope.operationsData.length;i++)
	       	{
	       		var obj = $scope.operationsData[i];
	       		obj.purchasePrice 		= parseFloat(obj.purchasePrice).toLocaleString("de-DE");;
	       		obj.purchaseShare 		= parseFloat(obj.purchaseShare).toLocaleString("de-DE");;
	       		obj.salePrice 	  		= parseFloat(obj.salePrice).toLocaleString("de-DE");;
	       		obj.saleShare     		= parseFloat(obj.saleShare).toLocaleString("de-DE");;   
	       		obj.benefits      		= parseFloat(obj.benefits).toLocaleString("de-DE");;
	       		obj.benefitPercentage 	= parseFloat(obj.benefitPercentage);  
	       		
	       		obj.purchaseDate = moment(new Date(obj.purchaseDate)).format("DD/MM/YYYY");
	       		obj.saleDate = moment(new Date(obj.saleDate)).format("DD/MM/YYYY");
	       	}
       	   $scope.operationsTable = createUsingFullOptionsOperations();
       }

		/*Ng table for rangking list*/

		   function createUsingFullOptionsRanking() {
                  var initialParams = {
                    count: 10 // initial page size
                  };
                  var initialSettings = {
                    // page size buttons (right set of buttons in demo)
                    counts: [],
                    // determines the pager buttons (left set of buttons in demo)
                    paginationMaxBlocks: 10,
                    paginationMinBlocks: 2,
                    dataset: $scope.rankingList
                  };
                  return new NgTableParams(initialParams, initialSettings);
                }
        /*Ng table for purchase list*/

		   function createUsingFullOptionsPurchase() {
                  var initialParams = {
                    count: 10 // initial page size
                  };
                  var initialSettings = {
                    // page size buttons (right set of buttons in demo)
                    counts: [],
                    // determines the pager buttons (left set of buttons in demo)
                    paginationMaxBlocks: 10,
                    paginationMinBlocks: 2,
                    dataset: $scope.purchaseData
                  };
                  return new NgTableParams(initialParams, initialSettings);
                }
           /*Ng table for purchase list*/

		   function createUsingFullOptionsOperations() {
                  var initialParams = {
                    count: 10 // initial page size
                  };
                  var initialSettings = {
                    // page size buttons (right set of buttons in demo)
                    counts: [],
                    // determines the pager buttons (left set of buttons in demo)
                    paginationMaxBlocks: 10,
                    paginationMinBlocks: 2,
                    dataset: $scope.operationsData
                  };
                  return new NgTableParams(initialParams, initialSettings);
                }

         $scope.buttonColor1 = function(key)
         {

         	var a = parseFloat(key);
         	console.log(a)
         	if(a > 0)
         		return 'success';
         	if(a == parseFloat(0))
         		return 'warning';
         	if(a < 0)
         		return 'danger';
         } 


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
								message:'Should be Seperated by single comma',
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
				if(list.length == 0 && !$scope.file)
				{
					notify({
						message:'Enter valid comma sepearated emails or upload a email list file',
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
			console.log($scope.teacher.assets)
			$scope.assetsCheck = false;
			if(!$scope.teacher.assets)
				$scope.teacher.assets = [];
			console.log($scope.teacher.assets);
			for (var i = 0; i < $scope.teacher.assets.length; i++) {
				var a = $scope.teacher.assets[i];
				console.log(a)
				if(a =="1" || a == 1)
					{
						$scope.assetsCheck = true;
						break;
					}

			}
			console.log($scope.teacher.assets)
		
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
			$scope.currentStep =2;
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
					message:'Select Feedback',
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

        	$scope.start = function(index)
		{
			$scope.teacher.save_step = $scope.currentStep;
			$scope.teacher.id = $stateParams.teacher_id; 

			console.log($scope.teacher)
			if($scope.currentStep ==2)
			{
			if($scope.teacher.start_date != undefined && $scope.teacher.start_date != null)
				{
					 $scope.teacher.start_date = new Date($scope.teacher.start_date.split("/").reverse().join("-"));
			
					$scope.teacher.start_date = $filter('date')($scope.teacher.start_date, 'yyyy-MM-dd');
				}
			if($scope.teacher.end_date != undefined && $scope.teacher.end_date != null)
				{
					 $scope.teacher.end_date = new Date($scope.teacher.end_date.split("/").reverse().join("-"));
					$scope.teacher.end_date = $filter('date')($scope.teacher.end_date, 'yyyy-MM-dd');
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

					$scope.savedGroup = success.data.group;
					$('.step_head_li').removeClass('active');
			    	$('#step_head_'+index).addClass('active');
			    	$('.step_body_li').removeClass('active');
			    	$('#step_body_'+index).addClass('active'); 

			    	$scope.loadRanking($scope.savedGroup);
				    
				}				
			},function(error){

			})
		}

		$scope.checkTime1 = function(index)
		{			
			notify.closeAll();
			$scope.pastDateCheck();
			var from = new Date($scope.teacher.start_date.split("/").reverse().join("-"));
			var to = new Date($scope.teacher.end_date.split("/").reverse().join("-"));
			/*if($scope.teacher.start_date != undefined && $scope.teacher.start_date != null)
				var from = $scope.teacher.start_date;
			if($scope.teacher.end_date != undefined && $scope.teacher.end_date != null)
		      	var to = $scope.teacher.end_date;*/
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
		$scope.pastDateCheck = function()
	    {
	    	notify.closeAll();
	    	if($scope.teacher.start_date)
	    	{
	    		var date = new Date($scope.teacher.start_date.split("/").reverse().join("-"));
	    		//var date = new Date($scope.teacher.start_date)	    		
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
			$scope.logout = function()
		
		{
			window.location.href = "/index";
		}



			
    }
    ]);