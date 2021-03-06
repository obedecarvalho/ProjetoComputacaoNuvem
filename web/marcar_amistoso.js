var app = angular.module("marcar_amistoso", []);
app.controller("marcar_amistoso_ctrl", function($scope,$http){
    $scope.login_valido = 0;
    $scope.clubes = [];
    
    $scope.listar_clubes = function(){
        url = "https://fastfoot.herokuapp.com/listar_clubes.php";
        $http.get(url).then(function (response) {
            $scope.clubes = response.data.records;
        });
    }
    
    $scope.marcar_amistoso = function(clube){
        var data = $.param({
            id_clube: clube.id_clube
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }
        var url = "https://fastfoot.herokuapp.com/marcar_amistoso.php";
        $http.post(url, data, config).then(function (response) {
            var resp = response.data.records;
            var m = resp[0]['marcado'];
            if(m == 1){
                alert("Amistoso marcado");
            }
        });
    }
    
    $scope.verificar_sessao = function (){
        url = "https://fastfoot.herokuapp.com/session.php";
        $http.get(url).then(function (response) {
            var resp = response.data.records;
            $scope.login_valido = resp[0]['logado'];
            if($scope.login_valido == 0){
                window.location.href = "https://fastfoot.herokuapp.com/index.html";
            } else {
                $scope.listar_clubes();
            }
        });
    }                    
    
    //execucao
    $scope.verificar_sessao();
    
})
