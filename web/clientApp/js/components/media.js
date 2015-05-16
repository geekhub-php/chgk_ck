angular.module('media', [])
.factory('mediaAPI', ['$resource', function($resource){
	var mediaRes = $resource('/api/gallerys/:galleryId/medias');
	
	return {
		getMedias: function(galleryId){
			return mediaRes.query({galleryId: galleryId});		
		}	
	};
}]);