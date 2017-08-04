<?php
    include("./info_bd.php");
    $con = pg_connect($dbopts);//$con = new mysqli($host, $login, $senha, $bd);
    session_start();
    $sql = "SELECT nome_clube, patrimonio FROM clube WHERE id_clube=".$_SESSION["id_clube"].";";
    $res = pg_query($con, $sql);//$res = $con->query($sql);
    $outp = "";
    if(pg_num_rows($res) > 0){//if($res->num_rows > 0) {
        $clube = pg_fetch_assoc($res);//$clube = $res->fetch_assoc();
        $outp .= '{"nome_clube":"'. $clube["nome_clube"] . '",';
        $outp .= '"patrimonio":"'.$clube["patrimonio"] . '"}';
    }
    //$con->close();
    $outp ='{"records":['.$outp.']}';
    echo $outp;
?>
