angular.module('comment', [])
.factory('commentAPI', ['$resource', function($resource){
	var commentRes, commentResUrl, commentResUrlShort = '/api/comments/:commentId';
	
	return {
		setParentUrl: function(parentUrl, parentUrlParams){
			commentResUrl = parentUrl + '/comments/:commentId';
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
		}	
	};
}]);