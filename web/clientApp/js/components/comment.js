angular.module('comment', [])
.factory('commentAPI', ['$resource', 'opinionAPI', function($resource, opinionAPI){
	var commentRes, commentResUrl, commentResUrlShort = '/api/comments/:commentId', parentUrlParams; 
	
	return {
		setParentUrl: function(parentUrl, params){
			commentResUrl = parentUrl + '/comments/:commentId';
			parentUrlParams = params; 
			commentRes = $resource(commentResUrl, parentUrlParams);
		},		
		
		getComments: function(){
			return commentRes.query();		
		},		
		
		postComment: function(text){
			return commentRes.save({}, {text: text});
		},
		
		putComment: function(comment){
			return $resource(commentResUrlShort, null, {
				'put': {method: 'PUT'}			
			}).put({commentId: comment.id}, comment);
		},
		
		deleteComment: function(commentId, defer){
			return $resource(commentResUrlShort, null, {
				'delete': {method: 'DELETE'}			
			}).delete({commentId: commentId}, function(){defer.resolve();});
		},
		
		getCommentOpinions: function(commentId){
			opinionAPI.setParentUrl(commentResUrl, angular.extend({commentId: commentId}, parentUrlParams));
			return opinionAPI.getOpinions();		
		},
		
		makeCommentOpinion: function(commentId, is_positive){
			opinionAPI.setParentUrl(commentResUrl, angular.extend({commentId: commentId}, parentUrlParams));
			return opinionAPI.makeOpinion(is_positive);
		}	
	};
}])
.factory('commentableModel', ['opinionableModel', function(opinionableModel){
	return {
		addComment: function(commentable, comment){
			comment.made_by_current_user = true;
			comment.opinions = [];
			opinionableModel.fillOpinionableStats(comment);
			commentable.comments.push(comment);	
		},
		
		deleteComment: function(commentable, commentId){
			for (var i = 0; i < commentable.comments.length; i++) {
				if (commentable.comments[i].id == commentId) {
					commentable.comments.splice(i, 1);
					return;				
				}
			}		
		}	
	};
}]);