<?php
    include("./info_bd.php");

    $con = new mysqli($host, $login, $senha, $bd);
    session_start();


    $id_clube = $_SESSION["id_clube"];
    $id_amistoso = $data["id_amistoso"];

	//id_amistoso | id_clube_convite | id_clube_convidado | estado
    $sql = "SELECT id_clube_convite , id_clube_convidado FROM amistoso WHERE id_amistoso=".$id_amistoso." AND estado=1;";
    $res = $con->query($sql);

    if($res->num_rows > 0) {
        $amistoso = $res->fetch_assoc();
    }

    //id_clube | tatica
    $sql = "SELECT tatica FROM clube WHERE id_clube=".$amistoso["id_clube_convite"].";";
    $res = $con->query($sql);

    if($res->num_rows > 0) {
        $clube1 = $res->fetch_assoc();
    }


    //id_jogador | id_clube | nome_jogador | forca | posicao | escalado
    $sql = "SELECT nome_jogador, forca, posicao FROM jogador WHERE id_clube=".$amistoso["id_clube_convite"]." AND ecalado=1;";
    $res = $con->query($sql);

    if($res->num_rows > 0) {
        $jogadores1 = $res->fetch_assoc();
    }


    $sql = "SELECT tatica FROM clube WHERE id_clube=".$amistoso["id_clube_convidado"].";";
    $res = $con->query($sql);


    if($res->num_rows > 0) {
        $clube2 = $res->fetch_assoc();
    }


    $sql = "SELECT nome_jogador, forca, posicao FROM jogador WHERE id_clube=".$amistoso["id_clube_convidado"]." AND ecalado=1;";
    $res = $con->query($sql);

    if($res->num_rows > 0) {
        $jogadores2 = $res->fetch_assoc();
    }




    // $con = mysqli_connect($host, $login, $senha, $bd);
    // session_start();
    
    // mysqli_autocommit($con, FALSE);

    // $data = json_decode(file_get_contents('php://input'), true);
    



    /*$id_jogador = $data["id_jogador"];
    $valor = $data["valor"];
    $error = 0;

    $sql1 = "UPDATE jogador SET id_clube=NULL WHERE id_jogador=".$id_jogador.";";    
    $sql2 = "UPDATE clube SET patrimonio = patrimonio+".$valor." WHERE id_clube=".$id_clube.";";


    if (!mysqli_query($con,$sql1)) {
    	$error++;
    	echo "erro1 ";
    }
    if (!mysqli_query($con,$sql2)) {
    	$error++;
    	echo $sql2." ";
    }

    if($error == 0){
    	echo "comprou";
    	mysqli_commit($con);
    }else{
    	echo "falha";
    	mysqli_rollback($con);
    }*/

?>



