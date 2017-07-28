<?php
    include("./info_bd.php");
    $con = new mysqli($host, $login, $senha, $bd);
    $sql = "SELECT id_usr FROM usr WHERE login='".$_REQUEST["login"]."' AND senha='".$_REQUEST["senha"]."';";
    $res = $con->query($sql);
    $out = 0;
    if ($res->num_rows != 0){
        $out = 1;
        $id_usr_t = $res->fetch_assoc();
        session_start();
        $_SESSION["id_usr"] = $id_usr_t["id_usr"];
    }
    $con->close();
    echo $out;
?>
