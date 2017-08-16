angular.module('app').directive('progressChart',function()
{   
    
    return{
    restrict: 'E',
    scope: {
      prgdata: '='
    },
        template:'<div class="chart_cont progressbar" ng-repeat="data in prgdata"><div class="col-md-10 col-sm-10 col-xs-10 pl0"><div class="percent_cont"><div class="percent_text_block"><div class="percent_text left label">{{data.label}}</div></div><div class="percent_loader_cont"><div class="percent_bar left" style=width:{{data.percent}}%></div></div></div></div><div class="col-md-1 col-sm-1 col-xs-1 p0"><div class="percent_text right white">{{data.percent}}%</div></div></div>'
    }
});

angular.module('app').directive('progressSingle',function()
{

	return{
		restrict:"E",
		scope: {
			singleprgdata:'='
		},
		template:'<div class="chart_cont progressbar single" ng-repeat="data in singleprgdata"><div class="col-md-12 col-sm-12 col-xs-12 pl0"><div class="percent_cont"><div class="percent_loader_cont"><div class="percent_bar single left" style="width: {{data.percent}}%;">{{data.percent}}%</div></div></div></div></div>'
	}

})