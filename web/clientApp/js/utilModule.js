angular.module('util', [])
.filter('timestampToFormat', ['dateFilter', function(dateFilter){
	return function (timestamp, format) {
			var date = new Date(timestamp * 1000);
			return dateFilter(date, format);
	}
}])
.filter('booleanFormater', [function(){
	return function(value){
		return value ? 'да' : 'не';
	} 
}]);