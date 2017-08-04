<?php
    include("./info_bd.php");
    $con = pg_connect($dbopts);//$con = new mysqli($host, $login, $senha, $bd);
    session_start();
    $sql = "INSERT INTO amistoso VALUE (null,".$_SESSION["id_clube"].",".$_REQUEST["id_clube"].",1)";
    $outp = "";
    if(pg_query($con,$sql)){ //if($con->query($sql)) {
        $outp .='{"marcado":["1"]}';
    }
    //$con->close();
    $out ='{"records":['.$outp.']}';
    echo $out;
?>
