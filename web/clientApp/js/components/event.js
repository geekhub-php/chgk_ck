angular.module('event', [])
.controller('EventsController', ['$scope', 'eventModel', function ($scope, eventModel) {
	$scope.events = eventModel.getEvents();
	$scope.makeOpinion = eventModel.makeOpinion;
}])
.controller('EventController', ['$scope', 'eventModel', '$routeParams', function ($scope, eventModel, $routeParams) {
	$scope.event = eventModel.getEvent($routeParams.newsId);
	$scope.makeOpinion = eventModel.makeOpinion;
	$scope.putComment = eventModel.putComment;
	$scope.deleteComment = eventModel.deleteComment;
	$scope.postComment = eventModel.postComment;
	$scope.makeCommentOpinion = eventModel.makeCommentOpinion;
}])
.factory('eventModel', ['$resource', 'opinionAPI', '$q', 'commentAPI', function ($resource, opinionAPI, $q, commentAPI) {
	var eventResUrl = '/api/events/:eventId';
	var eventRes = $resource(eventResUrl);
	
	function fillOpinionableStats(opinionable){
		opinionable.dislikesCount = 0;
		opinionable.likesCount = 0;
		for(var i = 0; i < opinionable.opinions.length; i++) {
			var opinion = opinionable.opinions[i];
			opinion.is_positive ? opinionable.likesCount++ : opinionable.dislikesCount++;
			
			if (opinion.made_by_current_user) {
				opinionable.currentUserOpinion = opinion;	
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
						fillOpinionableStats(event);					
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
					fillOpinionableStats(event);					
				});
			});
			event.$promise.then(function(){
				commentAPI.setParentUrl(eventResUrl, {eventId: eventId});
				var comments = commentAPI.getComments();
				event.comments = comments;
				return comments.$promise;		
			})
			.then(function(comments){
				comments.forEach(function(comment){
					comment.opinions = commentAPI.getCommentOpinions(comment.id);
					comment.opinions.$promise.then(function(opinions){
						fillOpinionableStats(comment);							
					});
				});
			});

			return event;
		},
		
		getOpinions: function(eventId){
			opinionAPI.setParentUrl(eventResUrl, {eventId: eventId});
			return opinionAPI.getOpinions();
		},
		
		makeOpinion: function(eventId, is_positive){
			opinionAPI.setParentUrl(eventResUrl, {eventId: eventId});
			return opinionAPI.makeOpinion(is_positive);
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
		},
		
		makeCommentOpinion: function(eventId, commentId, is_positive){
			commentAPI.setParentUrl(eventResUrl, {eventId: eventId});
			commentAPI.makeCommentOpinion(commentId, is_positive);		
		}
	};
	
	return eventModel;
}]);