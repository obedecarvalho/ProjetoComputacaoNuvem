<?php
    include("./info_bd.php");
    $con = new mysqli($host, $login, $senha, $bd);
    $sql = "SELECT id_usr FROM usr WHERE login='".$_REQUEST["login"]."' AND senha='".$_REQUEST["senha"]."';";
    $res = $con->query($sql);
    $outp = "";
    $out = 0;
    if ($res->num_rows == 1){
        echo "logou";
        $out = 1;
        $id_usr_t = $res->fetch_assoc();
        session_start();
        $_SESSION["id_usr"] = $id_usr_t["id_usr"];
        $sql = "SELECT id_clube FROM clube WHERE id_usr=".$id_usr_t["id_usr"].";";
        $res = $con->query($sql);
        $id_clube = $res->fetch_assoc();
        $_SESSION["id_clube"] = $id_clube["id_clube"];
        //armazena id_usr e id_clube na sessao
    }
    $outp .= '{"login_valido":"'.$out.'"}';
    $outp ='{"records":['.$outp.']}';
    $con->close();
    echo $outp;
?>
