<?php
    session_start();
    include("./info_bd.php");
    $con = new mysqli($host, $login, $senha, $bd);
    $sql = "SELECT id_jogador, nome, forca FROM jogador WHERE id_clube='".$_SESSION["id_clube"]."';";
    $res = $con->query($sql);
    while ($jog = $res->fetch_assoc()){
        
    }
    $con->close();
    echo "";
?>
