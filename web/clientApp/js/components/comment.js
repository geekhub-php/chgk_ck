angular.module('comment', [])
.factory('commentModel', [function(){
	var commentRes;
	
	return {
		setModelResource: function(modelResource){
			commentRes = modelResource;		
		},		
		
		getComments: function(){
			return commentRes.query();		
		},		
		
		postComment: function(text){
			return commentRes.save({}, {text: text});
		},
		
		putComment: function(comment){
			return commentRes.put({commentId: comment.id}, comment);
		},
		
		deleteComment: function(comment){
			return commentRes.delete({commentId: comment.id}, comment);
		}	
	};
}]);