angular.module('team', [])
.controller('TeamController', ['$scope', 'teamModel', function ($scope, teamModel) {
	$scope.teams = teamModel.getTeams();
}])
.factory('teamModel', ['$resource', function ($resource) {
	var teamRes = $resource('/api/teams');
	
	return {
		getTeams: function(){ return teamRes.query({orderByRating: 'desc'}); }
	};
}]);