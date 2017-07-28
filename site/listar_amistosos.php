<?php
    session_start();
    include("./info_bd.php");
    $con = new mysqli($host, $login, $senha, $bd);
    $sql = "SELECT id_clube FROM amistosos WHERE id_clube_convidade='".$_SESSION["id_clube"]."' AND status=1;";
    $res = $con->query($sql);
    while ($jog = $res->fetch_assoc()){
        
    }
    $con->close();
    echo "";
?>
