<?php
    include("./info_bd.php");
    $con = pg_connect($dbopts);//$con = new mysqli($host, $login, $senha, $bd);
    session_start();
    $sql = "SELECT id_jogador, nome_jogador, forca, posicao FROM jogador WHERE id_clube IS NULL;";
    $res = pg_query($con, $sql);//$res = $con->query($sql);
    $outp = "";
    while ($jog = pg_fetch_assoc($res)){//while($jog = $res->fetch_assoc()) {
        if ($outp != "") {$outp .= ",";}
        $outp .= '{"id_jogador":"'  . $jog["id_jogador"] . '",';
        $outp .= '"nome_jogador":"'   . $jog["nome_jogador"] . '",';
        $outp .= '"posicao":"'   . $jog["posicao"] . '",';
        $outp .= '"forca":"'. $jog["forca"] . '"}';
    }
    //$con->close();
    $out ='{"records":['.$outp.']}';
    echo $out;
?>
