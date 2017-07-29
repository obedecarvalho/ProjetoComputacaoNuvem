<?php
    include("./info_bd.php");
    $con = new mysqli($host, $login, $senha, $bd);
    session_start();
    $sql = "SELECT tatica FROM clube WHERE id_clube=".$_SESSION["id_clube"].";";
    $res = $con->query($sql);
    $out = -1;
    $outp = "";
    if ($res->num_rows != 0){
        $tat = $res->fetch_assoc();
        $out = $tat["tatica"];
    }
    $outp .= '{"tatica":"'.$out.'"}';
    $con->close();
    $outp ='{"records":['.$outp.']}';
    echo $outp;
?>
