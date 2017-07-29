<?php
	session_start();
    $outp = "";
    $logado = 0;
    if(isset($_SESSION["id_usr"])){
    	$logado = 1; //se usuario logado
	}
    $outp .= '{"logado":"'.$logado.'"}';
    $outp ='{"records":['.$outp.']}';
    echo $outp;
?>
