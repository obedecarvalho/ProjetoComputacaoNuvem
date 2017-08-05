var app = angular.module("inicio_fastfoot", []);
app.controller("inicio_fastfoot_controller", function($scope,$http){
    $scope.logar = function(){
        alert('Logar');
        var data = $.param({
            login: $scope.login,
            senha: $scope.senha,
        });
        var config = {
            headers : {
            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }
        var url = "http:./login_valido.php";
        $http.post(url, data, config).then(function (response) {
            var resp = response.data.records;
            console.log(resp);
            $scope.login_valido = resp[0]['login_valido'];
            if($scope.login_valido == 1){
                alert('OK');
                window.location.href = "http:./admin_clube.html";
                alert('OK');
            } else {
                $scope.mostrar_login_invalido = 1;
            }
        });
    }
    $scope.verificar_sessao = function (){
        url = "http:./session.php";
        $http.get(url).then(function (response) {
            var resp = response.data.records;
            $scope.login_valido = resp[0]['logado'];
            if($scope.login_valido == 1){
                window.location.href = "http:./admin_clube.html";
            }
        });
    } 
    
    $scope.cadastrar = function(){
        alert("cad"); //fazer
    }

    $scope.mostrar_login_invalido = 0;
    
    //execucao
    $scope.verificar_sessao();
})
