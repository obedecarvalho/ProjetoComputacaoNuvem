var app = angular.module("comprar_jogador", []);
app.controller("comprar_jogador_controller", function($scope,$http){
    $scope.jogadores = [];
    $scope.listar_jogadores = function(){
        url = "https://fastfoot.herokuapp.com/jogadores_vender.php";
        $http.get(url).then(function (response) {
            $scope.lista_jogadores = response.data.records;
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
                $scope.listar_jogadores();
            }
        });
    }
    
    $scope.comprar_jogador = function(jog){
        //~ console.log(jog);
        url = "https://fastfoot.herokuapp.com/comprar_jogador.php";
        $http.get(url).then(function (response) {
            var resp = response.data.records;
            //console.log(response.data);
            var patrimonio = resp[0].patrimonio;
            
            var valor = jog.forca * 9;
            if(patrimonio >= valor){
                //~ console.log('pode efetuar a compra');
                $scope._comprar(resp[0].id_clube,jog.id_jogador,valor);
            }
            else{
                alert('Seu saldo é insuficiente');
                //~ console.log('não pode efetuar a compra');
            }
        });
    }


    $scope._comprar = function(id_clube,id_jogador,valor){
        //~ console.log(id_clube, id_jogador, valor);
        var data = {
            id_clube: id_clube,
            id_jogador: id_jogador,
            valor: valor,
        };
        //~ console.log(data);
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }
        var url = "https://fastfoot.herokuapp.com/comprar.php";
        $http.post(url, data, config).then(function (response) {
            //~ console.log("response",response);
            $scope.listar_jogadores();//window.location.reload();
        });
    }
    
    
    //execucao
    $scope.verificar_sessao();
    
});  
