<?php
	session_start();
    $logado = 0;
    if(isset($_SESSION["id_usr"])){
    	$logado = 1;
	}
    echo $logado;
?>
