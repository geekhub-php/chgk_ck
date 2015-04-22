angular.module('gameResult', [])
.controller('GameResultsController', ['gameResultAPI', '$routeParams', '$scope', 'userAPI', function(gameResultAPI, $routeParams, $scope, userAPI){
	$scope.gameResults = gameResultAPI.getGameResults($routeParams.gameId);
	$scope.makeResultOpinion = gameResultAPI.makeResultOpinion;
	$scope.userInfo = userAPI.getUserInfo();
  	$scope.predicate = '';
  	$scope.reverse = false;
  	$scope.goFilters = false;
  	$scope.search = function(result){
		if(!$scope.query || (result.team && result.team.name.indexOf($scope.query)!=-1) 
			|| (result.player && result.player.last_name.indexOf($scope.query)!=-1) ){
			return true;		
		} else {
			return false;		
		}	
  	}
}])
.factory('gameResultAPI', ['$resource', 'opinionAPI', '$routeParams', 'opinionableModel', function($resource, opinionAPI, $routeParams, opinionableModel){
	var gameResultUrl = '/api/games/:gameId/gameResults/:gameResultId';
	var gameId = $routeParams.gameId;	
	
	return {
		getGameResults: function(gameId){
			var results = $resource(gameResultUrl, {gameId: gameId}).query();
			results.$promise.then(function(){
				results.forEach(function(result){
					opinionAPI.setParentUrl(gameResultUrl, {gameId: gameId, gameResultId: result.id});
					result.opinions = opinionAPI.getOpinions();
					result.opinions.$promise.then(function(){
						opinionableModel.fillOpinionableStats(result);					
					});		
				});			
			});

			return results;		
		},
		
		makeResultOpinion: function(gameResult, is_positive){
			opinionAPI.setParentUrl(gameResultUrl, {gameId: gameId, gameResultId: gameResult.id});
			opinionAPI.makeOpinion(is_positive).then(function(addedOpinion){
				opinionableModel.addNewOpinion(gameResult, addedOpinion);		
			});		
		}	
	};
}]);