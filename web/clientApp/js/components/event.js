angular.module('event', [])
.controller('EventsController', ['$scope', 'eventAPI', 'eventModel', function ($scope, eventAPI, eventModel) {
	eventModel.setData(eventAPI.getEvents(), true);
	$scope.events = eventModel.getData();
	$scope.makeOpinion = eventAPI.makeOpinion;
}])
.controller('EventController', ['$scope', 'eventAPI', '$routeParams', 'eventModel', function ($scope, eventAPI, $routeParams, eventModel) {
	eventModel.setData(eventAPI.getEvent($routeParams.newsId));	
	$scope.event = eventModel.getFirst();
	$scope.makeOpinion = eventAPI.makeOpinion;
	$scope.putComment = eventAPI.putComment;
	$scope.deleteComment = eventAPI.deleteComment;
	$scope.postComment = eventAPI.postComment;
	$scope.makeCommentOpinion = eventAPI.makeCommentOpinion;
}])
.factory('eventAPI', ['$resource', 'opinionAPI', '$q', 'commentAPI', 'opinionableModel', 'eventModel', function ($resource, opinionAPI, $q, commentAPI, opinionableModel, eventModel) {
	var eventResUrl = '/api/events/:eventId';
	var eventRes = $resource(eventResUrl);
	
	var eventAPI = {
		getEvents: function(){
			var events = eventRes.query();
			events.$promise.then(function(){
				events.forEach(function(event){
					event.opinions = eventAPI.getOpinions(event.id);
					event.opinions.$promise.then(function(){
						opinionableModel.fillOpinionableStats(event);					
					});
					
				});			
			});

			return events;
		},
		
		getEvent: function(eventId){
			var event = eventRes.get({eventId: eventId});	
			event.$promise.then(function(){
				event.opinions = eventAPI.getOpinions(event.id);
				event.opinions.$promise.then(function(){
					opinionableModel.fillOpinionableStats(event);					
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
						opinionableModel.fillOpinionableStats(comment);							
					});
				});
			});

			return event;
		},
		
		getOpinions: function(eventId){
			opinionAPI.setParentUrl(eventResUrl, {eventId: eventId});
			return opinionAPI.getOpinions();
		},
		
		makeOpinion: function(event, is_positive){
			opinionAPI.setParentUrl(eventResUrl, {eventId: event.id});
			opinionAPI.makeOpinion(is_positive).then(function(addedOpinion){
				opinionableModel.addNewOpinion(event, addedOpinion);	
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
		},
		
		makeCommentOpinion: function(event, comment, is_positive){
			commentAPI.setParentUrl(eventResUrl, {eventId: event.id});
			commentAPI.makeCommentOpinion(comment.id, is_positive)
			.then(function(addedOpinion){
				opinionableModel.addNewOpinion(comment, addedOpinion);			
			});		
		}
	};
	
	return eventAPI;
}])
.factory('eventModel', [function(){
	var events = null;	
	
	eventModel = {
		setData: function(modelData, isArray){
			events = isArray ? modelData : [modelData];
		},
		
		getData: function(){
			return events;		
		},
		
		getFirst: function(){
			return events[0];		
		},
		
		getEvent: function(eventId){
			for(var i = 0; i < events.length; i++) {	
				if (events[i].id == eventId) {
					return events[i];				
				}			
			}
			
			return null;	
		}		
	};

	return eventModel;
}]);