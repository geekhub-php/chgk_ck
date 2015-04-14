angular.module('app')
.config(function ($routeProvider, $locationProvider) {
	$routeProvider
	.when('/teams', 
	{
		templateUrl: 'clientApp/templates/teams.html',
		controller:  'TeamsController'
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
	.when('/games/:gameId/gameResults',
	{
		templateUrl: 'clientApp/templates/gameResults.html',
		controller:  'GameResultsController'	
	})
	.when('/team/:teamId',
	{
		templateUrl: 'clientApp/templates/team.html',
		controller:  'TeamController'	
	})
	.when('/players',
	{
		templateUrl: 'clientApp/templates/players.html',
		controller:  'PlayersController'	
	})
	.when('/players/:playerId',
	{
		templateUrl: 'clientApp/templates/player.html',
		controller:  'PlayerController'	
	})
	.when('/about',
	{
		templateUrl: 'clientApp/templates/about.html'
	})
	.when('/galleries',
	{
		templateUrl: 'clientApp/templates/galleries.html',
		controller:  'GalleriesController'	
	})
	.when('/galleries/:galleryId',
	{
		templateUrl: 'clientApp/templates/gallery.html',
		controller:  'GalleryController'	
	})
	;
});