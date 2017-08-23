'use strict';
angular.module('app').controller('camp', ['$scope','$document','$rootScope','$stateParams','$http','$state','NgTableParams','$timeout','uiGmapGoogleMapApi',
    function($scope,$document,$rootScope,$stateParams,$http,$state,NgTableParams,$timeout,uiGmapGoogleMapApi) {

    	$('.dropdown-toggle.sharp').on('click', function (event) {
		    $(this).parent().toggleClass('open');
		});
		$('body').on('click', function (e) {
		    if (!$('.dropdown.sharp').is(e.target) 
		        && $('.dropdown.sharp').has(e.target).length === 0 
		        && $('.open').has(e.target).length === 0
		    ) {
		        $('.dropdown.sharp').removeClass('open');
		    }
		});

		$(document).ready(
			function()
			{
				setTimeout(
					function()
					{
						$('.angular-google-map-container').height($('.top_places').outerHeight());
					},2000);				
			}
		)	

		$(window).resize(
			function()
			{
				$('.angular-google-map-container').height($('.top_places').outerHeight());
			});

        $scope.text = "Camp";
        $scope.spent = {};
        $scope.spent = {'total':'RM 5,320','today':'RM 540','total_spent':'RM 5,320'};
        $scope.spentpercentage = [{'label':'w','percent':'45'}];
        $scope.selected_date = "DECEMBER 2010";

        $scope.monthly = [];
        $scope.fromdate = {};
        $scope.todate = {};
        $scope.parsedMonthly = [];
        $scope.currentSet = ['03-12-2016'];
        $scope.monthly = [{'date':'03-12-2016'},{'date':'01-01-2017'},{'date':'02-02-2017'}];


        $scope.currentSet[0] = moment().format('DD-MM-YYYY');
        console.log($scope.currentSet);
        /*var newdate = moment($scope.monthly[1].date,"DD-MM-YYYY");
        console.log(newdate);
       	console.log(moment(newdate,"DD-MM-YYYY").format('MMMM'));*/


       	$scope.getReadableDates = function(strDate)
       	{
       		if($.isArray(strDate))
       		{
       			var tempArr = [];
       			for(var i = 0;i<strDate.length;i++)
       			{
       				var tempObj = {};
		       		var newdate = moment(strDate[i],"DD-MM-YYYY"); 
		       	    tempObj.day = moment(newdate,"DD-MM-YYYY").format('DD');
		       	    tempObj.month = moment(newdate,"DD-MM-YYYY").format('MMMM');
		       	    tempObj.n_month = moment(newdate,"DD-MM-YYYY").format('MM');
		       	    tempObj.s_month = moment(newdate,"DD-MM-YYYY").format('MMM');
		       	    tempObj.year = moment(newdate,"DD-MM-YYYY").format('YYYY');
		       	    tempObj.s_year = moment(newdate,"DD-MM-YYYY").format('YY');
		       	    tempObj.date = strDate[i];
		       	    tempArr.push(tempObj);		       	    
       			}
       			return tempArr;
       		}
       		else
       		{
       			var tempObj = {};
	       		var newdate = moment(strDate,"DD-MM-YYYY"); 
	       	    tempObj.day = moment(newdate,"DD-MM-YYYY").format('DD');
	       	    tempObj.month = moment(newdate,"DD-MM-YYYY").format('MMMM');
	       	    tempObj.n_month = moment(newdate,"DD-MM-YYYY").format('MM');
	       	    tempObj.s_month = moment(newdate,"DD-MM-YYYY").format('MMM');
	       	    tempObj.year = moment(newdate,"DD-MM-YYYY").format('YYYY');
	       	    tempObj.s_year = moment(newdate,"DD-MM-YYYY").format('YY');
	       	    tempObj.date = strDate;
       			return tempObj;
       		}
       		
       	    
       	}


       	$scope.parsedCurrentSet = $scope.getReadableDates($scope.currentSet[0]);

       	for(var i=0;i<$scope.monthly.length;i++)
       	{      		      	           	    
       	    $scope.parsedMonthly.push($scope.getReadableDates($scope.monthly[i].date));
       	}
		
       	console.log($scope.parsedMonthly);
       	console.log($scope.parsedCurrentSet);

		$scope.setCurrent = function(readableDateObj)
		{

			if(readableDateObj=="starttoend")
			{
				$scope.currentSet = [];
				$scope.currentSet =  ["03-12-2016","10-12-2016"];
				$scope.parsedCurrentSet = $scope.getReadableDates($scope.currentSet);
				$scope.fromdate.day = $scope.parsedCurrentSet[0].day;
				$scope.fromdate.month = $scope.parsedCurrentSet[0].n_month;
				$scope.fromdate.year = $scope.parsedCurrentSet[0].year;
				$scope.todate.day = $scope.parsedCurrentSet[$scope.parsedCurrentSet.length-1].day;
				$scope.todate.month = $scope.parsedCurrentSet[$scope.parsedCurrentSet.length-1].n_month;
				$scope.todate.year = $scope.parsedCurrentSet[$scope.parsedCurrentSet.length-1].year;

			}
			else if(readableDateObj == "thisweek")
			{
				$scope.currentSet = [];
				$scope.currentSet =  [moment().day(1).format('DD-MM-YYYY'),moment().day(7).format('DD-MM-YYYY')];
				$scope.parsedCurrentSet = $scope.getReadableDates($scope.currentSet);
				$scope.fromdate.day = $scope.parsedCurrentSet[0].day;
				$scope.fromdate.month = $scope.parsedCurrentSet[0].n_month;
				$scope.fromdate.year = $scope.parsedCurrentSet[0].year;
				$scope.todate.day = $scope.parsedCurrentSet[$scope.parsedCurrentSet.length-1].day;
				$scope.todate.month = $scope.parsedCurrentSet[$scope.parsedCurrentSet.length-1].n_month;
				$scope.todate.year = $scope.parsedCurrentSet[$scope.parsedCurrentSet.length-1].year;
			}
			else if(readableDateObj == "today")
			{
				$scope.currentSet = [];
				$scope.currentSet[0] = moment().format('DD-MM-YYYY');
				$scope.parsedCurrentSet = $scope.getReadableDates($scope.currentSet[0]);
				$scope.fromdate.day = $scope.parsedCurrentSet.day;
				$scope.fromdate.month = $scope.parsedCurrentSet.n_month;
				$scope.fromdate.year = $scope.parsedCurrentSet.year;
				$scope.todate.day = "";
				$scope.todate.month = "";
				$scope.todate.year = "";
			}
			else
			{
				$scope.parsedCurrentSet = readableDateObj;
				$scope.currentSet = readableDateObj.date;

				var newdate = moment(readableDateObj.date,"DD-MM-YYYY"); 
	       	    console.log(moment(newdate,"DD-MM-YYYY").daysInMonth());

				$scope.fromdate.day = "01";
				$scope.fromdate.month = readableDateObj.n_month;
				$scope.fromdate.year = readableDateObj.year;

				$scope.todate.day = moment(newdate,"DD-MM-YYYY").daysInMonth();
				$scope.todate.month = readableDateObj.n_month;
				$scope.todate.year = readableDateObj.year;

				if (!$scope.$$phase) {
	                      $scope.$apply();
	                }
				
			}

				console.log($scope.parsedCurrentSet);
				console.log($scope.currentSet);

			
		}  

		  $scope.data_table = [{'ad_name':'Ads#1','status':true,'spent':'RM304','ctr':{'percent':2.34,'riseorfall':'rise'},'impressions':23.230,'clicks':3.321,'conversions':'12%'},{'ad_name':'Ads#1','status':false,'spent':'RM304','ctr':{'percent':2.34,'riseorfall':'rise'},'impressions':23.230,'clicks':3.321,'conversions':'12%'}];
		  $scope.numberofAds = $scope.data_table.length;
		  $scope.tableParams = new NgTableParams({}, { dataset: $scope.data_table });
		  $scope.places = [{'place':'Raffles Hospital','visitors':'5,340'},{'place':'Raffles Hospital','visitors':'5,340'},{'place':'Raffles Hospital','visitors':'5,340'},{'place':'Raffles Hospital','visitors':'5,340'},{'place':'Raffles Hospital','visitors':'5,340'},{'place':'Raffles Hospital','visitors':'5,340'},{'place':'Raffles Hospital','visitors':'5,340'},{'place':'Raffles Hospital','visitors':'5,340'},{'place':'Raffles Hospital','visitors':'5,340'},{'place':'Raffles Hospital','visitors':'5,340'}];


		  google.maps.visualRefresh = true;
          $scope.map = {
              control: {},
              center: {
                latitude: 2.811125, 
                longitude: 102.398501
              },                    
              bounds: {},
              markers: [
                {
                  id: 1,
                  latitude: 45,
                  longitude: -74,
                  showWindow: true,
                  title: 'Marker 2'
                },
                {
                  id: 2,
                  latitude: 15,
                  longitude: 30,
                  showWindow: true,
                  title: 'Marker 2'
                },
                {
                  id: 3,
                  icon: 'assets/images/plane.png',
                  latitude: 37,
                  longitude: -122,
                  showWindow: true,
                  title: 'Plane'
                }
              ],
              markers2: [
                {
                  id: 1,
                  icon: 'map_pin_2.png',
                  showWindow: true,
                  latitude: 46,
                  longitude: -77,
                  title: '[46,-77]'
                },
                {
                  id: 2,
                  icon: 'map_pin_2.png',
                  showWindow: true,
                  latitude: 48,
                  longitude: -79,
                  title: '[33,-77]'
                },
                {
                  id: 3,
                  icon: 'map_pin_2.png',
                  showWindow: true,
                  latitude: 47,
                  longitude: -78,
                  title: '[35,-125]'
                }
              ],
              dynamicMarkers: [],
              refresh: function () {
                alert(origCenter);
                $scope.map.control.refresh(origCenter);
              }
            };
            $scope.windowoptions = {
                maxWidth:15,
                pixelOffset: new google.maps.Size(1000,100),
                closeBoxMargin: "0px 0px 0px 0px",
            }
        $scope.options = {
            scrollwheel: false,
            streetViewControl: false,
            panControl: false,
            styles: [
            {elementType: 'geometry', stylers: [{color: '#023D58'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#97C4B8'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#1A3646'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#1A3646'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#1A3646'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#1A3646'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#2A6474'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#2A6474'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#1A3646'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#2A6474'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#2A6474'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#1A3646'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#1A3646'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263C'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#1A3646'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#97C4B8'}]
            }
          ],
            
        };
        $scope.coordsUpdates = 0;
        $scope.dynamicMoveCtr = 0;

        $scope.markersEvents = {
            click: function (gMarker, eventName, model) {
              if(model.$id){
                model = model.coords;//use scope portion then
                console.log(gMarker);
                console.log(eventName);
                console.log(model);                
              }
              //alert("Model: event:" + eventName + " " + JSON.stringify(model));
            }
          };

          var markerToClose = null;
          $scope.onMarkerClicked = function (marker) {       
            markerToClose = marker; 
            marker.setIcon("../app/imgs/pin-selected.png");
            marker.showWindow = true;
            $scope.$apply();    
          };
            $scope.refreshMap = function () {
                //optional param if you want to refresh you can pass null undefined or false or empty arg
                $scope.map.control.refresh({latitude: 32.779680, longitude: -79.935493});
                $scope.map.control.getGMap().setZoom(11);
              };

          $timeout(function () {
            var dynamicMarkers = [
              {   id: 1,
                latitude: 2.760105, 
                icon: '../app/imgs/map_pin_2.png',
                wcontent:{
                    name:"ABC",
                    address:"asdfghjk",
                    image:"../app/imgs/Hydrangeas.jpg",
                    percent:"8932.233"
                },
                longitude: 102.228674
              },
              {
                id: 2,
                latitude: 2.611791,
                icon: '../app/imgs/map_pin_2.png',
                 wcontent:{
                    name:"ABC",
                    address:"asdfghjk",
                    image:"../app/imgs/Hydrangeas.jpg",
                    percent:"8932.233"
                },
                longitude: 102.477555
              },
              {
                id: 3,
                icon: '../app/imgs/map_pin_2.png',
                 wcontent:{
                    name:"ABC",
                    address:"asdfghjk",
                    image:"../app/imgs/Hydrangeas.jpg",
                    percent:"8932.233"
                },
                latitude: 2.802337, 
                longitude: 102.453726
              },
              {
                id: 4,
                latitude: 2.879511, 
                icon: '../app/imgs/map_pin_2.png',
                wcontent:{
                    name:"ABC",
                    address:"asdfghjk",
                    percent:"8932.233",
                    image:"../app/imgs/Hydrangeas.jpg"
                },
                longitude: 102.304520
              },
              {
                id: 5,
                latitude: 2.959787, 
                 wcontent:{
                    name:"ABC",
                    address:"asdfghjk",
                    percent:"8932.233",
                    image:"../app/imgs/Hydrangeas.jpg"
                },
                icon: '../app/imgs/map_pin_2.png',
                longitude: 102.377189
              },
              {
                id: 6,
                latitude: 2.997844, 
                icon: '../app/imgs/map_pin_2.png',
                 wcontent:{
                    name:"ABC",
                    address:"asdfghjk",
                    image:"../app/imgs/Hydrangeas.jpg",
                    percent:"8932.233"
                },
                longitude: 102.451347
              },
              {
                id: 7,
                latitude: 3.001273, 
                wcontent:{
                    name:"DEF",
                    address:"asdfghjk",
                    percent:"8932.233",
                    image:"../app/imgs/map_pin_2.png"
                },
                icon: '../app/imgs/map_pin_2.png',
                longitude: 102.598289
              }
            ];
            _.each(dynamicMarkers, function (marker) {
              marker.closeClick = function () {
                marker.showWindow = false;
                $scope.$apply();
              };
              marker.onClicked = function () {
                $scope.onMarkerClicked(marker);
              };
            });
            $scope.map.dynamicMarkers = dynamicMarkers;
          }, 2000);
          var origCenter = {latitude: $scope.map.center.latitude, longitude: $scope.map.center.longitude};


          /* Line Chart*/
          	$scope.currentChartindex = 0;
            $scope.labels = ['1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7'];
	        $scope.line_data = [
	            [65, 59, 80, 81, 56, 55, 40,65, 59, 80, 81, 56, 55, 40]	            
	        ];
	        $scope.line_colours = [{ // grey
	                fillColor: "rgba(255,110,64,0.0)",
	                strokeColor: "rgba(0,0,0,1)",
	                pointColor: "rgba(71,141,203,1)",
	                pointStrokeColor: "#fff",
	                pointHighlightFill: "#fff",
	                pointHighlightStroke: "rgba(255,110,64,1)"
	        }];

	        $scope.lineChartData = [
	        {'label':'CTR','value':3.46,'suffix':'%','chart_data':{'labels':['1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7'],'line_data':[65, 59, 80, 81, 56, 55, 40,65, 9, 80, 81, 56, 55, 40]}},
	        {'label':'Impressions','value':'19,243','suffix':'','chart_data':{'labels':['1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7'],'line_data':[65, 569, 80, 81, 56, 5, 40, 5, 529, 80, 1, 56, 55, 40]}},
	        {'label':'Clicks','value':'5.332','suffix':'','chart_data':{'labels':['1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7'],'line_data':[65, 569, 80, 381, 5, 5, 40, 5, 59, 30, 1, 56, 55, 40]}},
	        {'label':'Conversions','value':'23','suffix':'%','chart_data':{'labels':['1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7'],'line_data':[65, 569, 80, 81, 56, 5, 40, 5, 549, 80, 1, 56, 55, 40]}},
	        {'label':'Lift ( 95% Confidence )','value':'29.4','suffix':'%','chart_data':{'labels':['1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7'],'line_data':[65, 59, 80, 581, 56, 55, 40,65, 59, 80, 81, 56, 55, 40]}},
	        {'label':'Incremental Visits','value':'31.039','suffix':'','chart_data':{'labels':['1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7'],'line_data':[65, 569, 80, 81, 56, 5, 40, 65, 59, 80, 1, 56, 55, 40]}},
	        {'label':'Cost / Visit(Incremental)','value':'1.45','suffix':'RM','chart_data':{'labels':['1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7'],'line_data':[65, 569, 80, 81, 567, 5, 40, 5, 59, 80, 1, 56, 55, 40]}},
	        {'label':'Sales','value':'5.400','suffix':'RM','chart_data':{'labels':['1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7'],'line_data':[65, 569, 80, 81, 56, 5, 40, 5, 59, 808, 1, 56, 55, 40]}}
	        ]

	        $scope.drawLineChart = function(obj,index)
	        {
	        	console.log(obj);
	        	$scope.currentChartindex = index;
	        	console.log(obj.chart_data.labels);
	        	console.log(obj.chart_data.line_data);
	        	//$scope.labels = obj.chart_data.labels;
	        	$scope.line_data = $scope.line_data.map(function(data) {
                return obj.chart_data.line_data
            });

	        }

          /*Eo Line Chart*/

    }
    ]);