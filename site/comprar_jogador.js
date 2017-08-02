var app = angular.module("comprar_jogador", []);
app.controller("comprar_jogador_controller", function($scope,$http){
    $scope.jogadores = [];
    $scope.listar_jogadores = function(){
        url = "http:./jogadores_vender.php";
        $http.get(url).then(function (response) {
            $scope.lista_jogadores = response.data.records;
        });
    }
    
    $scope.verificar_sessao = function (){
        url = "http:./session.php";
        $http.get(url).then(function (response) {
            var resp = response.data.records;
            $scope.login_valido = resp[0]['logado'];
            if($scope.login_valido == 0){
                window.location.href = "http:./index.html";
            } else {
                $scope.listar_jogadores();
                $scope.buscar_tatica();
                $scope.listar_amistosos();
                $scope.get_info_clube();
            }
        });
    }
    
    $scope.comprar_jogador = function(jog,valor){
        console.log(jog);
        url = "http:./comprar_jogador.php";
        $http.get(url).then(function (response) {
            var resp = response.data.records;
            var valor = jog.forca * 9;
            if(resp.patrimonio >= valor){
                console.log('pode efetuar a compra');
            }
            else{
                alert('Seu saldo é insufciciente');
                console.log('não pode efetuar a compra');
            }
        });
    }
    
    
    //execucao
    $scope.verificar_sessao();
    $scope.listar_jogadores();
});  
