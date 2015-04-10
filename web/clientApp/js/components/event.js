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
.factory('eventModel', ['$resource', 'opinionModel', '$q', 'commentModel', function ($resource, opinionModel, $q, commentModel) {
	var eventRes = $resource('/api/events/:id');
	
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
			var event = eventRes.get({id: eventId});	
			event.$promise.then(function(){
				event.opinions = eventModel.getOpinions(event.id);
				event.opinions.$promise.then(function(){
					fillEventStats(event);					
				});
			});
			event.$promise.then(function(){
				var commentRes = $resource('/api/events/:eventId/comments', {eventId: eventId});
				commentModel.setModelResource(commentRes);
				event.comments = commentModel.getComments();		
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
			var commentRes = $resource('/api/comments/:commentId', null, {
				'put': {method: 'PUT'},			
			});
			commentModel.setModelResource(commentRes);	
			return commentModel.putComment(comment);
		},
		
		deleteComment: function(comment){
			var commentRes = $resource('/api/comments/:commentId', null, {
				'delete': {method: 'DELETE'},			
			});
			commentModel.setModelResource(commentRes);
			return commentModel.deleteComment(comment);			
		},
		
		postComment: function(eventId, text){
			var commentRes = $resource('/api/events/:eventId/comments', {eventId: eventId})
			commentModel.setModelResource(commentRes);	
			return commentModel.postComment(text);	
		}
	};
	
	return eventModel;
}]);