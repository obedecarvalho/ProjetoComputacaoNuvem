<?php
    include("./info_bd.php");
    $con = pg_connect($dbopts);//$con = new mysqli($host, $login, $senha, $bd);
    session_start();
    $sql = "SELECT id_clube, nome_clube FROM clube WHERE id_clube!=".$_SESSION["id_clube"].";";
    $res = pg_query($con, $sql);//$res = $con->query($sql);
    $outp = "";
    while ($clu = pg_fetch_assoc($res)){//while($clu = $res->fetch_assoc()) {
        if ($outp != "") {$outp .= ",";}
        $outp .= '{"id_clube":"'  . $clu["id_clube"] . '",';
        $outp .= '"nome_clube":"'. $clu["nome_clube"] . '"}';
    }
    //$con->close();
    $out ='{"records":['.$outp.']}';
    echo $out;
?>
