<?php
    session_start();
    include("./info_bd.php");
    $con = pg_connect($dbopts)//$con = new mysqli($host, $login, $senha, $bd);
    $sql = "UPDATE clube SET tatica=".$_REQUEST["tatica"]." WHERE id_clube=".$_SESSION["id_clube"].";";
    $outp = "";
    if($con->query($con,$sql)){//if ($res = $con->query($sql)){
        $outp .= '{"alterado":"1"}';
    } else {
        $outp .= '{"alterado":"0"}';
    }
    //$con->close();
    $outp ='{"records":['.$outp.']}';
    echo $outp;
?>
