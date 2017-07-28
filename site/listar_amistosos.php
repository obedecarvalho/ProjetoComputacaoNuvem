<?php
    session_start();
    include("./info_bd.php");
    $con = new mysqli($host, $login, $senha, $bd);
    $sql = "SELECT c.nome_clube, a.id_amistoso FROM clube as c, amistoso as a WHERE a.id_clube_convite = c.id_clube AND a.id_clube_convidado =".$_SESSION["id_clube"]." AND estado = 1;";
    $res = $con->query($sql);
    $outp = "";
    while ($amis = $res->fetch_assoc()){
        if ($outp != "") {$outp .= ",";}
        $outp .= '{"nome_clube":"'  . $amis["nome_clube"] . '",';
        $outp .= '"id_amistoso":"'. $amis["id_amistoso"] . '"}';
    }
    $con->close();
    $outp ='{"records":['.$outp.']}';
    echo $outp;
?>

