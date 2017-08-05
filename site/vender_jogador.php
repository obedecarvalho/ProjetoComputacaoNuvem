<?php
    include("./info_bd.php");
    $con = pg_connect($dbopts);//$con = mysqli_connect($host, $login, $senha, $bd);
    session_start();
    
    //mysqli_autocommit($con, FALSE);

    $data = json_decode(file_get_contents('php://input'), true);
    
    $id_clube = $_SESSION["id_clube"];
    $id_jogador = $data["id_jogador"];
    $valor = $data["valor"];
    $error = 0;


    //echo $id_clube." ";
    //echo $id_jogador." ";
    //echo $valor." ";
    $sql1 = "UPDATE jogador SET id_clube=NULL WHERE id_jogador=".$id_jogador.";";    
    $sql2 = "UPDATE clube SET patrimonio = patrimonio+".$valor." WHERE id_clube=".$id_clube.";";
    //echo $sql1." ";
    //echo $sql2." ";

    if(!pg_query($con, $sql1)){//if (!mysqli_query($con,$sql1)) {
    	$error++;
    	echo "erro1 ";
    }
    if(!pg_query($con, $sql2)){//if (!mysqli_query($con,$sql2)) {
    	$error++;
    	echo $sql2." ";
    }

    if($error == 0){
    	echo "comprou";
    	//mysqli_commit($con);
    }else{
    	echo "falha";
    	//mysqli_rollback($con);
    }

?>


