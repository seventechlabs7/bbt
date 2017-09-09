'use strict';


angular.module('app').controller('ranking', ['$scope','$document','$rootScope','$stateParams','$http','$state','$timeout','uiGmapGoogleMapApi','$filter','Upload','notify','NgTableParams',
    function($scope,$document,$rootScope,$stateParams,$http,$state,$timeout,uiGmapGoogleMapApi,$filter,Upload,notify,NgTableParams) {
        
       $scope.screen = "start";
       $scope.init = function(gId)
       {          		
       		$scope.getTeacherDetails();  			
       }

       $scope.getTeacherDetails = function()
       {
       		$http({
				method: 'GET',
				url: 'api/getteacherdetails/'+$stateParams.teacher_id
			}).then(function(success){
				console.log(success);
				$scope.teacher = success.data.data;
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
					$scope.groupData =data.groupData[0];
					$scope.currentGroupId = $scope.groupData.id;
					$scope.groups = data.groups;
					
					$scope.groupData.start_date = $scope.strToDate($scope.groupData.start_date);
					$scope.groupData.end_date = $scope.strToDate($scope.groupData.end_date);
					var deadline = new Date($scope.groupData.end_date);
					//$scope.initializeClock('clockdiv', deadline);
					$scope.currentEndDate =$scope.groupData.end_date;
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
				$scope.rankTable = createUsingFullOptions();
				
			},function(error){

			});
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
				data:{uId : $scope.teacher.id ,'sId': sId}
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
				$scope.loadRankingList();
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
				$scope.teacher ={};
				$scope.teacher.gId = $scope.groupData.id;
				$scope.teacher.mail_list = [];
				$scope.teacher.assets = [];
				if(screen =="league")
				{
					$scope.getLeagueDetails(); // currently using group data
				}
			}

			$scope.selectFile = function(file)
			{
				$scope.file = file;
			}

			$scope.addStudents = function()
			{
				$scope.teacher.id = $stateParams.teacher_id;		
				var list = $scope.teacher.mail_list.split(',');
				var emailregex = /\S+@\S+\.\S+/;
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
						$scope.teacher.mail_list = [];
						$scope.file = null;
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
				
				$scope.teacher.league_name = data.league_name;
				$scope.teacher.start_date = new Date(data.start_date);
				$scope.teacher.end_date = new Date(data.end_date);
				$scope.teacher.virtual_money = data.virtual_money;
				$scope.teacher.assets =[]; //data.assets.split(',');
				$scope.oldObj = angular.copy($scope.teacher);
				$scope.unsaved =true;
				},function(error){

				});
			}

			$scope.editVirtualMoney = function()
			{
				if(!$scope.teacher.start_date )
					return;
				var from = $scope.teacher.start_date;
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

			$scope.checkTime = function(index)
		{			
			if($scope.teacher.start_date != undefined && $scope.teacher.start_date != null)
				var from = $scope.teacher.start_date;
			else
				return;
			if($scope.teacher.end_date != undefined && $scope.teacher.end_date != null)
		      	var to = $scope.teacher.end_date;
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
		      var deadline = new Date($scope.teacher.end_date);
		      $scope.currentEndDate = angular.copy($scope.teacher.end_date);
		      return;
		      updateClockNg();
		}

		$scope.updateLeague = function()
		{
			notify.closeAll();
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
			$scope.teacher.assets = $scope.teacher.assets.join(",");
			$scope.teacher.start_date =  $filter('date')($scope.teacher.start_date, 'yyyy-MM-dd');
			$scope.teacher.end_date =  $filter('date')($scope.teacher.end_date, 'yyyy-MM-dd');
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

		$scope.chatNow = function(row)
		{
			$http({
				method: 'POST',
				url: 'api/chat/get',
				data:{tId : 815 ,uId:row.userId }
				}).then(function(success){
				var data = success.data.list;
				$scope.curEncUID = success.data.encUID;
						swal({
							title: "Chat with "+row.name,
							text: data.messages,
							type: "input",
							showCancelButton: true,
							closeOnConfirm: false,
							animation: "slide-from-top",
							inputPlaceholder: "type your message here",
							html:true,
							showLoaderOnConfirm: true,
						},
						function(inputValue){
						if (inputValue === false) 
							return false;
						if (inputValue === "") {
							swal.showInputError("You need to write something!");
							return false
						}
						$scope.sendMessage(815,row.userId,inputValue);
						
						});

				$scope.changeScreen('start');			
				},function(error){

				});
		}

		$scope.sendMessage = function(uId,tId,inputValue)
		{
			$http({
				method: 'POST',
				url: 'api/chat/send',
				data:{uId :uId ,tId:tId ,'message':$scope.curEncUID+":"+inputValue }
				}).then(function(success){
				var data = success.data;
				swal("Success!", "Your message has been sent");
						
				},function(error){

				});
		}

		/*for countdown v2 - Angular*/
			$scope.timeTillEvent = {};

			var updateClockNg = function () {
				var d1 = new Date($scope.currentEndDate);
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
			setInterval(function () {
			$scope.$apply(updateClockNg);
			}, 1000);
			};

			/*Ng table for rangking list*/

			   function createUsingFullOptions() {
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

             $scope.changeNav = function(page)
			{
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

			$scope.logout = function()
		{
			window.location.href = "/index";
		}

			
    }
    ]);