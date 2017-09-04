'use strict';


angular.module('app').controller('ranking', ['$scope','$document','$rootScope','$stateParams','$http','$state','$timeout','uiGmapGoogleMapApi','$filter','Upload','notify',
    function($scope,$document,$rootScope,$stateParams,$http,$state,$timeout,uiGmapGoogleMapApi,$filter,Upload,notify) {
        
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
					$scope.teacher.id = $scope.teacher[i].id;			
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
					initializeClock('clockdiv', deadline);
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
				data:{uId : $scope.teacher.id }
			}).then(function(success){
				var data = success.data;
				console.log("list");
				console.log(data)
				$scope.rankingList = data;
				
			},function(error){

			});
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
				closeOnCancel: false
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
					swal("Deleted!", data.reason, "success");
				else
					swal("Error!", data.reason, "warning");
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

			function initializeClock(id, endtime) {
			var clock = document.getElementById(id);
			var daysSpan = clock.querySelector('.days');
			var hoursSpan = clock.querySelector('.hours');
			var minutesSpan = clock.querySelector('.minutes');
			var secondsSpan = clock.querySelector('.seconds');

			function updateClock() {
			var t = getTimeRemaining(endtime);

			daysSpan.innerHTML = t.days;
			hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
			minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
			secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

			if (t.total <= 0) {
			clearInterval(timeinterval);
			}
			}

			updateClock();
			var timeinterval = setInterval(updateClock, 1000);
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
					if(success.data.status == 'success')
					{
						notify({
							message: success.data.reason,
							classes:'alert-success',
							duration:2000
						});
					}	
					else
					{
						notify({
							message: 'Something Went Wrong',
							classes:'alert-danger',
							duration:2000
						});
					}			
					},function(error){

					})
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
				$scope.teacher.assets = data.assets.split(',');

				},function(error){

				});
			}

			$scope.editVirtualMoney = function()
			{

				var from = $scope.teacher.start_date;

				$scope.currentDate =  new Date();
				var current = 	$scope.currentDate
				$scope.teacher.DisableStartDate = false;
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

		$scope.updateLeague = function()
		{

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
				if(data.status =="success")
				{
					notify({
					message: data.reason,
					classes:'alert-success',
					duration:2000
				});
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
			
    }
    ]);