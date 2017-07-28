<?php
    session_start();
	session_destroy();
    //destroi dados do usuario armazenado na sessao e volta ao inicio
    header("Location: ./index.html");
?>
