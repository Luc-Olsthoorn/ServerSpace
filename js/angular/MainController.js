app.controller('myCtrl', function($scope) {
    $scope.in = "0";
    $scope.iterat = "0";
    
    $scope.output = function(){
        var text = "";
        var x =  100 - $scope.in;
        var i;
        
      
        var total = 0;
        for(i=0; i < $scope.iterat; i++){
            total += Math.pow(10, -2*i)*Math.pow(x,i);
            var a = total.toString();
            text += a + "\n";
        }
        return text;
        
    }
    $scope.added = function(){
        var text = "";
        var x =  100 - $scope.in;
        var i;
        
      
        var total = 0;
        for(i=0; i < $scope.iterat; i++){
            total = Math.pow(10, -2*i)*Math.pow(x,i);
            var a = total.toFixed(20); 
            text += a + "\n";
        }
        return text;
        
    }
     $scope.total = function(){
       
        var x =  100 - $scope.in;
        var i;
        
      
        var total = 0;
        for(i=0; i < $scope.iterat; i++){
            total += Math.pow(10, -2*i)*Math.pow(x,i);
            
            
        }
        return total;
        
    }
     $scope.actual = function(){
       
        
        return 100/$scope.in;
        
    }
     $scope.accuracy = function(){
       return $scope.total / $scope.actual * 100;
        
    }
});