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
}])
.filter('teamRolesToString', [function(){
	return function(value, separator){
		var result = '';		
		for(var i = 0; i < value.length; i++){
			result += value[i].name;
			if(i + 1 < value.length) {
				result += separator;			
			}		
		}
		return result;	
	}
}]);