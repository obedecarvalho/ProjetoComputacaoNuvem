<?php
    include("./info_bd.php");
    $con = new mysqli($host, $login, $senha, $bd);
    session_start();
    $sql = "SELECT id_jogador, nome_jogador, forca, posicao FROM jogador WHERE id_clube IS NULL;";
    $res = $con->query($sql);
    $outp = "";
    while($jog = $res->fetch_assoc()) {
        if ($outp != "") {$outp .= ",";}
        $outp .= '{"id_jogador":"'  . $jog["id_jogador"] . '",';
        $outp .= '"nome_jogador":"'   . $jog["nome_jogador"] . '",';
        $outp .= '"posicao":"'   . $jog["posicao"] . '",';
        $outp .= '"forca":"'. $jog["forca"] . '"}';
    }
    $con->close();
    $out ='{"records":['.$outp.']}';
    echo $out;
?>