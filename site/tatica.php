<?php
    include("./info_bd.php");
    $con = pg_connect($dbopts);//$con = new mysqli($host, $login, $senha, $bd);
    session_start();
    $sql = "SELECT tatica FROM clube WHERE id_clube=".$_SESSION["id_clube"].";";
    $res = pg_query($con,$sql);//$res = $con->query($sql);
    $out = -1;
    $outp = "";
    if(pg_num_rows($res) != 0){ //if ($res->num_rows != 0){
        $tat = pg_fetch_assoc($res);//$tat = $res->fetch_assoc();
        $out = $tat["tatica"];
    }
    $outp .= '{"tatica":"'.$out.'"}';
    //$con->close();
    $outp ='{"records":['.$outp.']}';
    echo $outp;
?>
