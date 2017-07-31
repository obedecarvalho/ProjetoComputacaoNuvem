<?php
    session_start();
    include("./info_bd.php");
    $con = new mysqli($host, $login, $senha, $bd);
    $sql = "UPDATE amistoso SET estado=2 WHERE id_amistoso=".$_REQUEST["id_amistoso"].";";
    $outp = "";
    if ($res = $con->query($sql)){
        $outp .= '{"rejeitado":"1"}';
    } else {
        $outp .= '{"rejeitado":"0"}';
    }
    $con->close();
    $outp ='{"records":['.$outp.']}';
    echo $outp;
?>

