<?php
	session_start();
    unset($_SESSION["id_usr"]);
    header("Location: ./index.html");
?>
