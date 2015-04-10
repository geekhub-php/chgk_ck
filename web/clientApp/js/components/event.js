angular.module('event', [])
.controller('EventsController', ['$scope', 'eventModel', function ($scope, eventModel) {
	$scope.events = eventModel.getEvents();
	$scope.likeEvent = eventModel.likeEvent;
}])
.factory('eventModel', ['$resource', 'opinionModel', '$q', function ($resource, opinionModel, $q) {
	var eventRes = $resource('/api/events');
	
	function fillEventStats(event){
		event.dislikesCount = 0;
		event.likesCount = 0;
		for(var i = 0; i < event.opinions.length; i++) {
			var opinion = event.opinions[i];
			opinion.is_positive ? event.likesCount++ : event.dislikesCount++;
			
			if (opinion.made_by_current_user) {
				event.currentUserOpinion = opinion;	
			}				
		}	
	}
	
	var eventModel = {
		getEvents: function(){
			var events = eventRes.query();
			events.$promise.then(function(){
				events.forEach(function(event){
					event.opinions = eventModel.getOpinions(event.id);
					event.opinions.$promise.then(function(){
						fillEventStats(event);					
					});
					
				});			
			});

			return events;
		},
		
		getOpinions: function(eventId){
			var opinionRes = $resource('/api/events/:eventId/opinions/:opinionId', {eventId: eventId});
			opinionModel.setModelRes(opinionRes);
			return opinionModel.getOpinions();
		},
		
		likeEvent: function(event, is_positive){
			var opinionRes = $resource('/api/events/:eventId/opinions/:opinionId', {eventId: event.id});
			opinionModel.setModelRes(opinionRes);
			
			var deletePromise = null;
			for(var i = 0; i < event.opinions.length; i++) {
				var opinion = event.opinions[i];
				if (opinion.made_by_current_user) {
					deletePromise = opinionModel.deleteOpinion(opinion.id).$promise;
					break;					
				}			
			}
			$q.when(deletePromise)
			.then(function(){
				opinionModel.postOpinion(is_positive);				
			});
				
		}
	};
	
	return eventModel;
}]);