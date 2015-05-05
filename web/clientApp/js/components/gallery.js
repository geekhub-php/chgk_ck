angular.module('gallery', [])
.controller('GalleriesController', ['galleryAPI', '$scope', function(galleryAPI, $scope){
	$scope.galleries = galleryAPI.getGalleries();
}])
.controller('GalleryController', ['galleryAPI', '$routeParams', '$scope', function(galleryAPI, $routeParams, $scope){
	$scope.gallery = galleryAPI.getGallery($routeParams.galleryId);
}])
.factory('galleryAPI', ['$resource', 'mediaAPI', function($resource, mediaAPI){
	var galleryRes = $resource('/api/gallerys/:galleryId');
	return {
		getGalleries: function(){
			var galleries = galleryRes.query();
			galleries.$promise.then(function(){
				galleries.forEach(function(gallery){
					gallery.medias = mediaAPI.getMedias(gallery.id);				
				});			
			});	
			
			return galleries;	
		},
		
		getGallery: function(galleryId){
			var gallery = galleryRes.get({galleryId: galleryId});
			gallery.$promise.then(function(){
				gallery.medias = mediaAPI.getMedias(galleryId);							
			});	

			return gallery;	
		}	
	};
}])