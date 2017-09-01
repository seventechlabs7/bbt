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
       		 var f = new Date(from[0], from[1] - 1, from[1]);
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

			
    }
    ]);