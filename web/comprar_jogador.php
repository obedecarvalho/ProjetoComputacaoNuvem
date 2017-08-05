<?php
    include("./info_bd.php");
    $con = pg_connect($dbopts);//$con = new mysqli($host, $login, $senha, $bd);
    session_start();
    
    /*$data = json_decode(file_get_contents('php://input'), true);

    if($data){
    	$id_clube = $data["id_clube"];
    	$id_jogador = $data["id_jogador"];
    	$valor = $data["valor"];
    	$sql1 = "UPDATE jogador SET id_cluble=".$id_cluble." WHERE id_jogador=".$id_jogador.";";
    	$sql2 = "UPDATE cluble SET patrimonio = patrimonio-".$valor." WHERE id_clube=".$id_clube.";";

    	if ($con->query($sql1) === TRUE) {
    		echo "Sucesso";
    		$con->query($sql2);
		} else {
    		//O banco não foi atualizado
		}
    }*/



    $sql = "SELECT nome_clube, patrimonio FROM clube WHERE id_clube=".$_SESSION["id_clube"].";";
    $res = pg_query($con, $sql);//$res = $con->query($sql);
    $outp = "";

    if(pg_num_rows($res) > 0){//if($res->num_rows > 0) {
        $clube = pg_fetch_assoc($res);//$clube = $res->fetch_assoc();
        $outp .= '{"id_clube":"'.$_SESSION["id_clube"].'",';
        $outp .= '"nome_clube":"'. $clube["nome_clube"] . '",';
        $outp .= '"patrimonio":"'.$clube["patrimonio"] . '"}';
    }

    //$con->close();
    $outp ='{"records":['.$outp.']}';
    echo $outp;
    //debug_to_console("Teste");
?>
