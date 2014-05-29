angular.module('paste', ['ui.bootstrap', 'ngClipboard'])	
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
});