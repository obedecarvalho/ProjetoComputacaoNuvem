var app = angular.module("admin_clube", []);
app.controller("admin_clube_ctrl", function($scope,$http){
    $scope.login_valido = 0;
    $scope.lista_jogadores = [];
    $scope.amistosos = [];
    
    $scope.listar_jogadores = function (){
        url = "http:./listar_jogadores.php";
        $http.get(url).then(function (response) {
            $scope.lista_jogadores = response.data.records;
        });
    }
    
    $scope.listar_amistosos = function (){
        url = "http:./listar_amistosos.php";
        $http.get(url).then(function (response) {
            $scope.amistosos = response.data.records;
        });
    }
    
    $scope.get_info_clube = function(){
        url = "http:./info_clube.php";
        $http.get(url).then(function (response) {
            var resp = response.data.records;
            $scope.nome_clube = resp[0]["nome_clube"];
            $scope.patrimonio_clube = resp[0]["patrimonio"];
        });
    }

    
    $scope.taticas = ['3-4-3','3-5-2','4-4-2','4-3-3','5-4-1'];
    $scope.buscar_tatica = function(){
        url = "http:./tatica.php";
        $http.get(url).then(function (response) {
            var resp = response.data.records;
            var pos_tatica = parseInt(resp[0]['tatica']) - 1;
            if(resp != -1){
                $scope.formacao_tatica = $scope.taticas[pos_tatica];
            }
        });        
    }
    
    $scope.alterar_tatica = function (){
        alert($scope.formacao_tatica);
    }
    
    $scope.salvar_escalacao = function (){
        alert($scope.formacao_tatica);
    }
    
    $scope.limpar_escalacao = function (){
        for (i = 0; i < $scope.lista_jogadores.length; i++) {
            $scope.lista_jogadores[i].escalado = 0;
        }
    }
    
    $scope.rejeitar_amistoso = function(amistoso){
        var data = $.param({
            id_amistoso: amistoso.id_amistoso,
        });
        var config = {
            headers : {
            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }
        var url = "http:./rejeitar_amistoso.php";
        $http.post(url, data, config).then(function (response) {
            var resp = response.data.records;
            var rej = resp[0]['rejeitado'];
            if(rej == 1){
                $scope.listar_amistosos();
            }
        });
    }
    
    $scope.disputar_amistoso = function(id_amistoso){
        alert(id_amistoso);
    }
    
    $scope.vender_jogador = function(jog){
        alert(jog.nome_jogador);
    }
    
    $scope.escalar_jogador = function(jog){
        alert(jog.nome_jogador);
    }
    
    $scope.descalar_jogador = function(jog){
        jog.escalado = 0;
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
    
    //execucao
    $scope.verificar_sessao();
    
})
