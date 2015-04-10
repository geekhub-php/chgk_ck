angular.module('opinion', [])
.factory('opinionModel', [function(){
	var opinionRes;
	
	return {
		setModelRes: function(modelResource){
			opinionRes = modelResource;
		},
		
		getOpinions: function(){
			return opinionRes.query();		
		},
		
		deleteOpinion: function(opinionId){
			return opinionRes.delete({opinionId: opinionId});		
		},
		
		postOpinion: function(is_positive){
			return opinionRes.save({}, {is_positive: is_positive});		
		}
	};

}]);