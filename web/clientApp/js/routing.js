angular.module('app')
.config(function ($routeProvider, $locationProvider) {
	$routeProvider
	.when('/teams', 
	{
		templateUrl: 'clientApp/templates/team/teams.html',
		controller:  'TeamController'
	})
	;
});