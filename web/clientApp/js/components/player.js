angular.module('player', [])
.controller('PlayersController', ['$scope' , 'playerAPI', function($scope, playerAPI){
	$scope.players = playerAPI.getPlayers();
}])
.controller('PlayerController', ['$scope', 'playerAPI', '$routeParams', function($scope, playerAPI, $routeParams){
	$scope.player = playerAPI.getPlayer($routeParams.playerId);
}])
.factory('playerAPI', ['$resource', function($resource){
	var playerRes = $resource('/api/players/:playerId');


	return {
		getPlayer: function(playerId){
			return playerRes.get({playerId: playerId});	
		},
		
		getPlayers: function(){
			return playerRes.query();		
		}	
	};
}]);