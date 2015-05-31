angular.module('game', [])
.controller('GamesController', ['$scope','seasonsAPI', 'gameAPI', function($scope,seasonsAPI, gameAPI){
	$scope.games = gameAPI.getGames();
	$scope.resultTable = false;
	$scope.seasonsYear = seasonsAPI.getSeasons();
	$scope.search = function(game){
		if($scope.search.is_home || $scope.search.is_locally_rated || $scope.search.is_globally_rated || $scope.search.is_complete){
			if(($scope.search.is_home && game.is_home) || ($scope.search.is_locally_rated && game.is_locally_rated)
				|| ($scope.search.is_globally_rated && game.is_globally_rated) || ($scope.search.is_complete && game.is_complete)
				|| ($scope.search.id && game.season.id)
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
	$scope.searchIsComplete = function(game){
		if(game.is_complete){
				//return true;
			} else {
				return false;
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
.factory('gameAPI', ['$resource', 'gameResultAPI', function($resource, gameResultAPI){
	var gameRes = $resource('/api/games/:gameId');
	
	return {
		getGames: function(){
			var games = gameRes.query();
			games.$promise.then(function(game){
				for(var i = 0; i<game.length; i++){
				game[i].gameResults = gameResultAPI.getGameResults(game[i].id);
				}
			});
			return games;
		},
		
		getGame: function(gameId){
			return gameRes.get({gameId: gameId});
		}
	};
}])
.factory('seasonsAPI', ['$resource', function($resource){
	var seasonsRes = $resource('api/seasons');
	return {
		getSeasons: function(){
			return seasonsRes.query();
		}
	};
}])