angular.module('game', [])
.controller('GamesController', ['$scope', 'gameAPI', function($scope, gameAPI){
	$scope.games = gameAPI.getGames();
}])
.factory('gameAPI', ['$resource', function($resource){
	var gameRes = $resource('/api/games');	
	
	return {
		getGames: function(){
			return gameRes.query();		
		}	
	};
}]);