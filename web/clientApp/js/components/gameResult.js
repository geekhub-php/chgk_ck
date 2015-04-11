angular.module('gameResult', [])
.controller('GameResultsController', ['gameResultAPI', '$routeParams', '$scope', function(gameResultAPI, $routeParams, $scope){
	$scope.gameResults = gameResultAPI.getGameResults($routeParams.gameId);
	$scope.makeResultOpinion = gameResultAPI.makeResultOpinion;
}])
.factory('gameResultAPI', ['$resource', 'opinionAPI', '$routeParams', function($resource, opinionAPI, $routeParams){
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
						opinionAPI.fillOpinionableStats(result);					
					});		
				});			
			});

			return results;		
		},
		
		makeResultOpinion: function(gameResultId, is_positive){
			opinionAPI.setParentUrl(gameResultUrl, {gameId: gameId, gameResultId: gameResultId});
			opinionAPI.makeOpinion(is_positive);		
		}	
	};
}]);