angular.module('opinion', [])
.factory('opinionAPI', ['$resource', function($resource){
	var opinionRes, opinionResUrl;
	
	return {
		setParentUrl: function(parentUrl, parentUrlParams){
			opinionResUrl = parentUrl + '/opinions/:opinionId';
			opinionRes = $resource(opinionResUrl, parentUrlParams);
		},
		
		getOpinions: function(){
			return opinionRes.query();		
		},
		
		makeOpinion: function(is_positive){
			return opinionRes.query().$promise
			.then(function(opinions){
				for(var i = 0; i < opinions.length; i++) {
					var opinion = opinions[i];
					if (opinion.made_by_current_user) {
						return opinionRes.delete({opinionId: opinion.id}).$promise;
					}			
				}			
			})
			.then(function(){
				return opinionRes.save({}, {is_positive: is_positive}).$promise;			
			});		
		}
			
	};
}])
.factory('opinionableModel', [function(){
	
	var opinionableModel = {
		fillOpinionableStats: function(opinionable){
			opinionable.dislikesCount = 0;
			opinionable.likesCount = 0;
			for(var i = 0; i < opinionable.opinions.length; i++) {
				var opinion = opinionable.opinions[i];
				opinion.is_positive ? opinionable.likesCount++ : opinionable.dislikesCount++;
				
				if (opinion.made_by_current_user) {
					opinionable.currentUserOpinion = opinion;	
				}				
			}		
		},
		
		addNewOpinion: function(opinionable, opinion){
			for (var i = 0; i < opinionable.opinions.length; i++) {
				if (opinionable.opinions[i].made_by_current_user) {
					opinionable.opinions.splice(i, 1);				
				}			
			}
			opinion.made_by_current_user = true;
			opinionable.opinions.push(opinion);	
					
			opinionableModel.fillOpinionableStats(opinionable);		
		}	
	};
	
	return opinionableModel;
}]);