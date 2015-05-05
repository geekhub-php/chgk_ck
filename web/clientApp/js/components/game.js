angular.module('game', [])
.controller('GamesController', ['$scope', 'gameAPI', function($scope, gameAPI){
	$scope.games = gameAPI.getGames();
	$scope.search = function(game){
		if($scope.search.is_home || $scope.search.is_locally_rated || $scope.search.is_globally_rated || $scope.search.is_complete){
			if(($scope.search.is_home && game.is_home) || ($scope.search.is_locally_rated && game.is_locally_rated)
				|| ($scope.search.is_globally_rated && game.is_globally_rated) || ($scope.search.is_complete && game.is_complete)			
			){
				//return true;
			} else {
				return false;			
			}	
		}		
		
		if(!$scope.query || game.name.indexOf($scope.query)!=-1 || game.play_place.indexOf($scope.query)!=-1 
			|| game.age_category.name.indexOf($scope.query)!=-1){
			return true;		
		} else {
			return false;		
		}
	};
	$scope.predicate = '-play_date';
  	$scope.playDateReverse = false;
}])
.factory('gameAPI', ['$resource', function($resource){
	var gameRes = $resource('/api/games/:gameId');	
	
	return {
		getGames: function(){
			return gameRes.query();		
		},
		
		getGame: function(gameId){
			return gameRes.get({gameId: gameId});		
		}	
	};
}]);