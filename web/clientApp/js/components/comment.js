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
		
		deleteComment: function(commentId){
			return $resource(commentResUrlShort, null, {
				'delete': {method: 'DELETE'}			
			}).delete({commentId: commentId});
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
}]);