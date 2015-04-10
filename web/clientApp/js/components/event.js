angular.module('event', [])
.controller('EventsController', ['$scope', 'eventModel', function ($scope, eventModel) {
	$scope.events = eventModel.getEvents();
	$scope.likeEvent = eventModel.likeEvent;
}])
.controller('EventController', ['$scope', 'eventModel', '$routeParams', function ($scope, eventModel, $routeParams) {
	$scope.event = eventModel.getEvent($routeParams.newsId);
	$scope.likeEvent = eventModel.likeEvent;
	$scope.putComment = eventModel.putComment;
	$scope.deleteComment = eventModel.deleteComment;
	$scope.postComment = eventModel.postComment;
}])
.factory('eventModel', ['$resource', 'opinionModel', '$q', 'commentAPI', function ($resource, opinionModel, $q, commentAPI) {
	var eventResUrl = '/api/events/:eventId';
	var eventRes = $resource(eventResUrl);
	
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
		
		getEvent: function(eventId){
			var event = eventRes.get({eventId: eventId});	
			event.$promise.then(function(){
				event.opinions = eventModel.getOpinions(event.id);
				event.opinions.$promise.then(function(){
					fillEventStats(event);					
				});
			});
			event.$promise.then(function(){
				commentAPI.setParentUrl(eventResUrl, {eventId: eventId});
				event.comments = commentAPI.getComments();		
			});

			return event;
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
				
		},
		
		putComment: function(comment){
			return commentAPI.putComment(comment);
		},
		
		deleteComment: function(commentId){
			return commentAPI.deleteComment(commentId);			
		},
		
		postComment: function(eventId, text){
			commentAPI.setParentUrl(eventResUrl, {eventId: eventId});
			return commentAPI.postComment(text);	
		}
	};
	
	return eventModel;
}]);