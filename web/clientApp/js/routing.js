angular.module('app')
.config(function ($routeProvider, $locationProvider) {
	$routeProvider
	.when('/teams', 
	{
		templateUrl: 'clientApp/templates/teams.html',
		controller:  'TeamController'
	})
	;
});