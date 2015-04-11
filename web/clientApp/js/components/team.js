angular.module('team', [])
.controller('TeamsController', ['$scope', 'teamAPI', function ($scope, teamAPI) {
	$scope.teams = teamAPI.getTeams();
}])
.controller('TeamController', ['$scope', 'teamAPI', '$routeParams', function($scope, teamAPI, $routeParams){
	$scope.team = teamAPI.getTeam($routeParams.teamId);
}])
.factory('teamAPI', ['$resource', function ($resource) {
	var teamRes = $resource('/api/teams/:teamId');
	
	return {
		getTeams: function(){ 
			return teamRes.query({orderByRating: 'desc'}); 
		},
		
		getTeam: function(teamId){
			return teamRes.get({teamId: teamId});		
		}
	};
}]);