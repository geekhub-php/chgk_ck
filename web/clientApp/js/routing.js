angular.module('app')
.config(function ($routeProvider, $locationProvider) {
	$routeProvider
	.when('/teams', 
	{
		templateUrl: 'clientApp/templates/teams.html',
		controller:  'TeamController'
	})
	.when('/news', 
	{
		templateUrl: 'clientApp/templates/events.html',
		controller:  'EventsController'
	})
	;
});