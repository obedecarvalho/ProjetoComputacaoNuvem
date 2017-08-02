<?php
    include("./info_bd.php");
    $con = new mysqli($host, $login, $senha, $bd);
    session_start();
    $sql = "SELECT nome_clube, patrimonio FROM clube WHERE id_clube=".$_SESSION["id_clube"].";";
    $res = $con->query($sql);
    $outp = "";

    $patrimonio = 0;

    if($res->num_rows > 0) {
        $clube = $res->fetch_assoc();
        $outp .= '{"id_clube":"'.$_SESSION["id_clube"].'",';
        $outp .= '"nome_clube":"'. $clube["nome_clube"] . '",';
        $outp .= '"patrimonio":"'.$clube["patrimonio"] . '"}';
    }

    $con->close();
    $outp ='{"records":['.$outp.']}';
    echo $outp;
?>
