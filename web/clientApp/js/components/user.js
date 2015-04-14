angular.module('user', [])
.controller('UserPanelController', ['$scope', 'userAPI', function($scope, userAPI){
	$scope.userInfo = userAPI.getUserInfo();
}])
.factory('userAPI', ['$http', function($http){
	var url = '/userInfo';
	return {
		getUserInfo: function(){
			var userInfo = $http.get(url);
			userInfo.then(function(response){
				 userInfo.username = response.data.username;
				 userInfo.isLoggedIn = !!response.data.username;	
			});
			
			return userInfo;	
		}	
	};
}]);