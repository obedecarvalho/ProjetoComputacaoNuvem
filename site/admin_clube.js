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
        var valido = true;
        for (j = 1; j < 5; j++){
            var cont = 0;
            for (i = 0; i < $scope.lista_jogadores.length; i++){
                if (($scope.lista_jogadores[i].escalado == 1) && ($scope.lista_jogadores[i].posicao == j)){
                    cont++;
                }
            }
            if (!((j == 1 && cont <= 1) ||
                (j == 2 && cont <= parseInt($scope.formacao_tatica[0])) ||
                (j == 3 && cont <= parseInt($scope.formacao_tatica[2])) ||
                (j == 4 && cont <= parseInt($scope.formacao_tatica[4])))){                    
                    valido = false;
            }
        }
        if (valido){
            var data = $.param({
                tatica: ($scope.taticas.indexOf($scope.formacao_tatica)+1)
            });
            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }
            var url = "http:./alterar_tatica.php";
            $http.post(url, data, config).then(function (response) {
                var resp = response.data.records;
                var alt = resp[0]['alterado'];
                if(alt == 0){
                    $scope.buscar_tatica();
                }
            });
        } else {
            alert("Formacao nao e compativel, desescale alguns jogadores!");
            $scope.buscar_tatica();
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
        $scope._vender(jog);
        //alert(jog.id_jogador);
    }

    $scope._vender = function (jog){
        var data = {
            id_jogador: jog.id_jogador,
            valor: jog.forca * 9,
        };
        console.log(data);
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }
        var url = "http:./vender_jogador.php";
        $http.post(url, data, config).then(function (response) {
            console.log("response",response);
            window.location.reload();
        });

    }
    
    $scope.escalar_jogador = function(jog){
        var cont = 0;
        for (i = 0; i < $scope.lista_jogadores.length; i++){
            if (($scope.lista_jogadores[i].escalado == 1) && ($scope.lista_jogadores[i].posicao == jog.posicao)){
                cont++;
            }
        }
        if ((jog.posicao == 1 && cont == 1) ||
                (jog.posicao == 2 && cont == parseInt($scope.formacao_tatica[0])) ||
                (jog.posicao == 3 && cont == parseInt($scope.formacao_tatica[2])) ||
                (jog.posicao == 4 && cont == parseInt($scope.formacao_tatica[4]))){
            alert("Formacao nao e compativel com a escalacao desse jogador!");
        } else {
            var data = $.param({
                id_jogador: jog.id_jogador,
                escalado: "1"
            });
            var config = {
                headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }
            var url = "http:./escalar_jogador.php";
            $http.post(url, data, config).then(function (response) {
                var resp = response.data.records;
                var esc = resp[0]['escalado'];
                if(esc == 1){
                    jog.escalado = 1;
                }
            });
        }
    }
    
    $scope.desescalar_jogador = function(jog){
        var data = $.param({
            id_jogador: jog.id_jogador,
            escalado: "0"
        });
        var config = {
            headers : {
            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }
        var url = "http:./escalar_jogador.php";
        $http.post(url, data, config).then(function (response) {
            var resp = response.data.records;
            var esc = resp[0]['escalado'];
            if(esc == 0){
                jog.escalado = 0;
            }
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
    
    //execucao
    $scope.verificar_sessao();
    
})
