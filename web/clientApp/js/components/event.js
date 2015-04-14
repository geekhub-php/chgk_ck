angular.module('event', [])
.controller('EventsController', ['$scope', 'eventAPI', 'eventModel', 'userAPI', 'filterHelper', function ($scope, eventAPI, eventModel, userAPI, filterHelper) {
	$scope.events = eventModel.getData();
	$scope.makeOpinion = eventAPI.makeOpinion;
	$scope.userInfo = userAPI.getUserInfo();
	$scope.search = function (event){
		if(!$scope.query || event.title.indexOf($scope.query)!=-1
			|| event.text.indexOf($scope.query)!=-1 || filterHelper.likeIsInArray($scope.query, event.tags)	
			|| event.author.username.indexOf($scope.query)!=-1
		){
   		return true;
  		}
   	return false;
  };
  $scope.predicate = '+event_date';
  $scope.eventDateReverse = false;
  $scope.fetchNewEvents = function(){
  		var events = eventAPI.getEvents($scope.defaultEventsPortionSize, $scope.offset);
  		events.$promise.then(function(){
  			if(events.length < $scope.defaultEventsPortionSize) {
				 $scope.canLoadMoreEvents = false;
  			}
			eventModel.addPortionOfEvents(events);
			$scope.offset += $scope.defaultEventsPortionSize; 		
  		});
  };
  $scope.defaultEventsPortionSize = 6;
  $scope.offset = 0;
  eventModel.reset();
  $scope.fetchNewEvents();
  $scope.canLoadMoreEvents = true;
}])
.controller('EventController', ['$scope', 'eventAPI', '$routeParams', 'eventModel', 'userAPI', function ($scope, eventAPI, $routeParams, eventModel, userAPI) {
	eventModel.setData(eventAPI.getEvent($routeParams.newsId));	
	$scope.event = eventModel.getFirst();
	$scope.makeOpinion = eventAPI.makeOpinion;
	$scope.putComment = eventAPI.putComment;
	$scope.deleteComment = eventAPI.deleteComment;
	$scope.postComment = eventAPI.postComment;
	$scope.makeCommentOpinion = eventAPI.makeCommentOpinion;
	$scope.userInfo = userAPI.getUserInfo();
}])
.factory('eventAPI', ['$resource', 'opinionAPI', '$q', 'commentAPI', 'opinionableModel', 'eventModel', 'commentableModel', function ($resource, opinionAPI, $q, commentAPI, opinionableModel, eventModel, commentableModel) {
	var eventResUrl = '/api/events/:eventId';
	var eventRes = $resource(eventResUrl);
	
	var eventAPI = {
		getEvents: function(maxCount, offset){
			var events = eventRes.query({maxCount: maxCount, offset: offset});
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
		
		deleteComment: function(event, commentId){
			var defer = $q.defer();
			defer.promise.then(function(){
				commentableModel.deleteComment(event, commentId);			
			});
			commentAPI.deleteComment(commentId, defer);			
		},
		
		postComment: function(event, text){
			commentAPI.setParentUrl(eventResUrl, {eventId: event.id});
			commentAPI.postComment(text).$promise
			.then(function(addedComment){
				commentableModel.addComment(event, addedComment);		
			});	
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
	var events = [];	
	
	eventModel = {
		setData: function(modelData, isArray){
			events = isArray ? modelData : [modelData];
		},
		
		addPortionOfEvents: function(newEvents){
			for (var i = 0; i < newEvents.length; i++) {
				events.push(newEvents[i]);			
			}
		},
		
		reset: function(){
			events.splice(0, events.length)		
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