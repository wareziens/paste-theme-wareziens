angular.module('paste', ['ui.bootstrap', 'ngClipboard', 'ngTable'])	
.config(function(ngClipProvider) {
  ngClipProvider.setPath("templates/wareziens/bower_components/zeroclipboard/ZeroClipboard.swf");
})

.controller('searchCtrl', function() {

})

.controller('pasteCtrl', function($scope) {

	$scope.getTextToCopy = function() {
		console.dir(document.getElementById('code_textarea').textContent)
		return document.getElementById('code_textarea').textContent
	}

})
.directive('highlight', function(){
	return {
		name: 'highlight',
		scope: {
			highlight: '@'
		},
		restrict: 'A', 
		link: function($scope, iElm, iAttrs, controller) {
			var text = iElm.find('code').text()

			if(text.length) {
				iElm.find('code').html(hljs.highlight($scope.highlight, text).value)
			}			
		}
	};
})

.controller('trendCtrl', function($scope, ngTableParams, $http, $filter){
		
		$scope.tableParams = new ngTableParams({
      page: 1,
      count: 10,
      sorting: {
      	hits: 'desc'
      }
    }, {
      total: 0,
      counts: [], 
      getData: function($defer, params) {

				$http({method: 'GET', url: window.location.pathname + '?json=true'}).
			    success(function(data, status, headers, config) {

			    	for(var i in data) {
			    		data[i].hits = parseFloat(data[i].hits)
			    		data[i].age = parseFloat(data[i].age)
			    		data[i].pid = parseFloat(data[i].pid)
			    		console.log(data[i])
			    	}

			    	console.log(params.orderBy())

						params.total(data.length)

						data = params.sorting() ?
                    $filter('orderBy')(data, params.orderBy()) :
                    data

		        $defer.resolve(data.slice((params.page() - 1) * params.count(), params.page() * params.count()))
			    }).
			    error(function(data, status, headers, config) {
			      console.error('%s: Error occured while getting Trends', status)
			    })

        // var orderedData = params.sorting() ?
        //         $filter('orderBy')(data, params.orderBy()) :
        //         data;

			}
    })
})