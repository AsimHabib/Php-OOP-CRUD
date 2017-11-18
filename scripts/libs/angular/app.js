var validationApp = angular.module('validationApp', ['ngMessages']);

validationApp.controller('mainController', ['$scope', '$http', function($scope, $http) {
  $scope.insert = {};
  
  // function to submit the form after all validation has occurred            
  $scope.submitForm = function(isValid) {
    // check to make sure the form is completely valid
    if (isValid) {     
      //alert($scope.insert.fname);
     //alert('The form is valid');

     var x;
     for(x in $scope.insert){
        console.log($scope.insert[x]);
     }
   
      
     /* $http({
        method:"POST",
        url:"add-data.1.php",
        data:$scope.insert,
      }).success(function(data){

      });*/
    }

  };

}]);  
