<?php
    include("./info_bd.php");
    $con = pg_connect($dbopts);//$con = new mysqli($host, $login, $senha, $bd);
    session_start();
    $sql = "UPDATE jogador SET escalado=".$_REQUEST["escalado"]." WHERE id_jogador=".$_REQUEST["id_jogador"].";";
    $outp = "";
    if(pg_query($con,$sql)){//if ($res = $con->query($sql)){
        $outp .= '{"escalado":"'.$_REQUEST["escalado"].'"}';
    }
    //$con->close();
    $outp ='{"records":['.$outp.']}';
    echo $outp;
?>
