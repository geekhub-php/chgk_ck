angular.module('team', [])
.controller('TeamsController', ['$scope', 'teamAPI', function ($scope, teamAPI) {
	$scope.teams = teamAPI.getTeams();
	$scope.search = function(team){
		if(!$scope.query || team.name.indexOf($scope.query)!=-1 || (team.rating+'').indexOf($scope.query)!=-1
			|| team.age_category.name.indexOf($scope.query)!=-1){
			return true;		
		} else {
			return false;		
		}
	}
	$scope.predicate = '-rating';
  	$scope.reverse = false;
}])
.controller('TeamController', ['$scope', 'teamAPI', '$routeParams', function($scope, teamAPI, $routeParams){
	$scope.team = teamAPI.getTeam($routeParams.teamId);
	$scope.players = teamAPI.getPlayers($routeParams.teamId);
}])
.factory('teamAPI', ['$resource', function ($resource) {
	var teamRes = $resource('/api/teams/:teamId');
	
	return {
		getTeams: function(){ 
			return teamRes.query({orderByRating: 'desc'}); 
		},
		
		getTeam: function(teamId){
			return teamRes.get({teamId: teamId});		
		},
		
		getPlayers: function(teamId){
			return $resource('api/teams/:teamId/players', {teamId: teamId}).query();		
		}
	};
}]);