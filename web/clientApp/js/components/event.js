angular.module('event', [])
.controller('EventsController', ['$scope', 'eventModel', function ($scope, eventModel) {
	$scope.events = eventModel.getEvents();
	$scope.events.$promise.then(function(){
		$scope.events.forEach(function(event){
			event.dislikesCount = 0;
			event.likesCount = 0;
			for(var i = 0; i < event.opinions.length; i++) {
				event.opinions[i].is_positive ? event.likesCount++ : event.dislikesCount++;				
			}
		});
	});
}])
.factory('eventModel', ['$resource', function ($resource) {
	var eventRes = $resource('/api/events');
	
	return {
		getEvents: function(){ return eventRes.query(); }
	};
}]);