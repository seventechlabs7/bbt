  angular.module('app').config(function(ChartJsProvider) {
        // Configure all charts        
        // Configure all doughnut charts
        ChartJsProvider.setOptions('Doughnut', {
        	segmentShowStroke : false,
        	animationSteps : 75,
        	responsive:true,
        	width:100,
        	height:100,
            animateScale: false,
            percentageInnerCutout:83,
            legend:true,
            legendTemplate : '<div class="col-md-6 col-sm-6 col-xs-12"><ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul></div>'
        });

        ChartJsProvider.setOptions('Line',{
            responsive: true,
            datasetStrokeWidth : 4,
            legend:false,
            pointDot : true,
            bezierCurve:false,
            pointDotRadius:8,
            maintainAspectRatio: false,
            scaleShowGridLines: false,
            scaleGridLineWidth: 0,
            scaleGridLineColor: "rgba(0,0,0,0.1)"
        })

    });