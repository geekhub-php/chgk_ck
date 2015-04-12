angular.module('user', [])
.factory('userAPI', ['$http', function($http){
	var url = '/userInfo';
	return {
		isLoggedIn: function(){
			return $http.get(url).then(function(response){
				return !!response.data.username;			
			});	
		}	
	};
}]);