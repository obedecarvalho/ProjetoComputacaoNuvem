<!DOCTYPE html>
<html>

<head>
	<title>Amistoso</title>
	<meta charset="utf-8" />
    <script src="angular.min.js"></script>
    <link rel="stylesheet" type="text/css" href="fastfoot.css">
</head>

<body>
    <center>
	<div class="principal" ng-app="amistoso" ng-controller="amistoso_ctrl">
        <div class="secundaria">
            <center>
                <h1>FASTFOOT</h1>
            </center>
        </div>
        <center>
        <div id="lances">
            <h3>Lances do Jogo</h3><br>
            <div class="secundaria">
                <?php
                    include("./info_bd.php");

                    $tatica[1] = '3-4-3';
                    $tatica[2] = '3-5-2';
                    $tatica[3] = '4-4-2';
                    $tatica[4] = '4-3-3';
                    $tatica[5] = '5-4-1';
                    
                    $con = pg_connect($dbopts);//$con = new mysqli($host, $login, $senha, $bd);
                    
                    session_start();
                    
                    $id_amistoso = $_REQUEST["id_amistoso"];
                    //~ $id_clube = $_SESSION["id_clube"];
                    

                    //id_amistoso | id_clube_convite | id_clube_convidado | estado
                    //$sql = "SELECT id_clube_convite , id_clube_convidado FROM amistoso WHERE id_amistoso=".$id_amistoso." AND estado=1;";
                    $sql = "SELECT a.id_clube_convite, a.id_clube_convidado, c1.nome_clube as convite_nome, c2.nome_clube as convidado_nome from amistoso as a, clube as c1, clube as c2 WHERE a.id_amistoso = ".$id_amistoso." AND a.id_clube_convite = c1.id_clube AND a.id_clube_convidado = c2.id_clube";
                    $res = pg_query($con,$sql);//$res = $con->query($sql);

                    if(pg_num_rows($res)>0){//if($res->num_rows > 0) {
                        $id_clubes = pg_fetch_assoc($res);//$amistoso = $res->fetch_assoc();
                    }
                    
                    //id_clube | tatica
                    $sql = "SELECT tatica FROM clube WHERE id_clube=".$id_clubes["id_clube_convite"].";";
                    $res = pg_query($con,$sql);//$res = $con->query($sql);

                    if(pg_num_rows($res) > 0){//if($res->num_rows > 0) {
                        $tat_clube1 = pg_fetch_assoc($res);//$clube1 = $res->fetch_assoc();
                    }
                    

                    //id_jogador | id_clube | nome_jogador | forca | posicao | escalado
                    $sql = "SELECT forca, posicao FROM jogador WHERE id_clube=".$id_clubes["id_clube_convite"]." AND escalado=1;";
                    $res = pg_query($con,$sql);//$res = $con->query($sql);

                    $na = pg_num_rows($res);
                    if($na == 11){//if($res->num_rows > 0) {
                        $jogadores1 = pg_fetch_all($res);//$jogadores1 = $res->fetch_assoc();
                    } else {
                        echo "Número de jogadores insuficiente: ".$na."<br>";
                        exit();
                    }


                    $sql = "SELECT tatica FROM clube WHERE id_clube=".$id_clubes["id_clube_convidado"].";";
                    $res = pg_query($con,$sql);//$res = $con->query($sql);


                    if(pg_num_rows($res) > 0){//if($res->num_rows > 0) {
                        $tat_clube2 = pg_fetch_assoc($res);//$clube2 = $res->fetch_assoc();
                    }



                    $sql = "SELECT forca, posicao FROM jogador WHERE id_clube=".$id_clubes["id_clube_convidado"]." AND escalado=1;";
                    $res = pg_query($con,$sql);//$res = $con->query($sql);

                    $na = pg_num_rows($res);
                    if($na == 11){//if($res->num_rows > 0) {
                        $jogadores2 = pg_fetch_all($res);//$jogadores2 = $res->fetch_assoc();
                    } else {
                        echo "Número de jogadores insuficiente: ".$na."<br>";
                    }
                    
                    
                    $q1["1"] = 0;
                    $q1["2"] = 0;
                    $q1["3"] = 0;
                    $q1["4"] = 0;
                    for ($i = 0; $i < 11; $i++){
                        $q1[$jogadores1[$i]["posicao"]] += $jogadores1[$i]["forca"];
                    }
                    
                    $q2["1"] = 0;
                    $q2["2"] = 0;
                    $q2["3"] = 0;
                    $q2["4"] = 0;
                    for ($i = 0; $i < 11; $i++){
                        $q2[$jogadores2[$i]["posicao"]] += $jogadores2[$i]["forca"];
                    }

                    
                    $campo[1]["forca1"] = $q1["1"];
                    $campo[1]["forca2"] = ($q2["4"]/$tatica[$tat_clube2["tatica"]][4]);
                    $campo[2]["forca1"] = $q1["2"];
                    $campo[2]["forca2"] = $q2["4"];
                    $campo[3]["forca1"] = $q1["3"];
                    $campo[3]["forca2"] = $q2["3"];
                    $campo[4]["forca1"] = $q1["4"];
                    $campo[4]["forca2"] = $q2["2"];
                    $campo[5]["forca1"] = ($q1["4"]/$tatica[$tat_clube1["tatica"]][4]);
                    $campo[5]["forca2"] = $q2["2"];
                    $campo[0] = 3; //posicao bola

                    
                    mt_srand();
                    $gol1 = 0;
                    $gol2 = 0;
                    for($i=0; $i<25; $i++){
                        $num = mt_rand(0,$campo[$campo[0]]["forca1"] + $campo[$campo[0]]["forca2"]);
                        if ($campo[0] == 1){
                            if($num < $campo[$campo[0]]["forca1"]){
                                $campo[0] = 2;
                                echo "<br>Defesa do goleiro do ".$id_clubes["convite_nome"];
                            } else {
                                $gol2++;
                                $campo[0] = 3;
                                echo "<br><b>Goooolllll do clube ".$id_clubes["convidado_nome"]."</b>";
                            }
                        } else if ($campo[0] == 5){
                            if($num < $campo[$campo[0]]["forca1"]){
                                $gol1++;
                                $campo[0] = 3;
                                echo "<br><b>Goooolllll do clube ".$id_clubes["convite_nome"]."</b>";
                            } else {
                                $campo[0] = 4;
                                echo "<br>Defesa do goleiro do ".$id_clubes["convidado_nome"];
                            }
                        } else if ($num < $campo[$campo[0]]["forca1"]){
                            $campo[0]++;
                            echo "<br>Posse do clube ".$id_clubes["convite_nome"];
                        } else {
                            $campo[0]--;
                            echo "<br>Posse do clube ".$id_clubes["convidado_nome"];
                        }
                    }
                    echo "<h3> Resultado </h3>";
                    echo $id_clubes["convite_nome"];
                    echo " ".$gol1;
                    echo " x ";
                    echo $gol2." ";
                    echo $id_clubes["convidado_nome"];
                    
                    if ($gol1 > $gol2){
                        $sql = "UPDATE clube SET patrimonio = patrimonio+10 WHERE id_clube=".$id_clubes["id_clube_convite"].";";
                        $res = pg_query($con,$sql);
                    }else if ($gol1 > $gol2){
                        $sql = "UPDATE clube SET patrimonio = patrimonio+10 WHERE id_clube=".$id_clubes["id_clube_convidado"].";";
                        $res = pg_query($con,$sql);
                    } else {
                        $sql = "UPDATE clube SET patrimonio = patrimonio+3 WHERE id_clube=".$id_clubes["id_clube_convite"].";"."UPDATE clube SET patrimonio = patrimonio+3 WHERE id_clube=".$id_clubes["id_clube_convidado"].";";
                        $res = pg_query($con,$sql);
                    }
                    
                ?>
            </div>
            <br><a href="./admin_clube.html">Voltar</a>	
            <br><a href="./deslogar.php">Sair</a>
            </center>
        </div>
    </div>	
    </center>
</body>

</html>
