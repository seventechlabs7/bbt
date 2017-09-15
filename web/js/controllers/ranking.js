'use strict';


angular.module('app').controller('ranking', ['$scope','$document','$rootScope','$stateParams','$http','$state','$timeout','uiGmapGoogleMapApi','$filter','Upload','notify','NgTableParams',
    function($scope,$document,$rootScope,$stateParams,$http,$state,$timeout,uiGmapGoogleMapApi,$filter,Upload,notify,NgTableParams) {
        
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
				$scope.processRankingTable();
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
				console.log("list");
				console.log(data)
				$scope.report = data.report;							
			},function(error){

			});
       }


       $scope.processRankingTable = function()
       {
	       	for(var i=0;i<$scope.rankingList.length;i++)
	       	{
	       		var obj = $scope.rankingList[i];
	       		obj.benefitPercent = ((parseFloat(obj.newamount)-25000.00)/25000.00) * 100 ; 
	       		obj.position = parseInt(obj.position);
	       		obj.amount = parseFloat(obj.amount);
	       		obj.operations = parseInt(obj.operations);
	       		obj.benefits =parseFloat(obj.benefits) ;      	
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
					$scope.type = "ranking"
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
				
				if($scope.teacher.mail_list)
			{	
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
			}
			else
				$scope.teacher.mail_list = "";

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

				$scope.teacher.virtual_money = data.league.virtual_money;
				$scope.teacher.assets = data.assets.split(',');
				$scope.teacher.feedback = data.feedback.split(',');
				console.log($scope.teacher.assets)
				$scope.oldObj = angular.copy($scope.teacher);
				$scope.unsaved =true;
				},function(error){

				});
			}

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
				$scope.pastDateCheck();
				$scope.stopcountdown = true;
				$scope.checkTime(index);
			}
			$scope.checkTime = function(index)
		{	
			notify.closeAll();
			if(!$scope.DisableStartDate)	
			    $scope.pastDateCheck();
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
				if(a)
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
				if(a)
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

			var updateClockNg = function ()
			 {
			 	if($scope.stopcountdown)
			 		return;
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
	       		obj.purchasePrice = parseFloat(obj.purchasePrice);
	       		obj.purchaseShare = parseFloat(obj.purchaseShare); 
				obj.purchaseDate = moment(new Date(obj.purchaseDate)).format("DD/MM/YYYY");
				obj.currentPrice = parseFloat(obj.current_price);
				obj.benefits = parseFloat(obj.benefit);
	       	}
       	  $scope.purchaseTable = createUsingFullOptionsPurchase();
       }

        $scope.processOperationsTable = function()
       {
	       	for(var i=0;i<$scope.operationsData.length;i++)
	       	{
	       		var obj = $scope.operationsData[i];
	       		obj.purchasePrice 		= parseFloat(obj.purchasePrice);
	       		obj.purchaseShare 		= parseFloat(obj.purchaseShare);
	       		obj.salePrice 	  		= parseFloat(obj.salePrice);
	       		obj.saleShare     		= parseFloat(obj.saleShare);   
	       		obj.benefits      		= parseFloat(obj.benefits);
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


			$scope.logout = function()
		
		{
			window.location.href = "/index";
		}



			
    }
    ]);