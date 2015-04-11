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
	.when('/news/:newsId',
	{
		templateUrl: 'clientApp/templates/event.html',
		controller:  'EventController'	
	})
	.when('/games',
	{
		templateUrl: 'clientApp/templates/games.html',
		controller:  'GamesController'	
	})
	;
});