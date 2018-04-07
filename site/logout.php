<?php
    session_start();

    if (isset($_SESSION["logged"])){
        unset($_SESSION["logged"]);
        unset($_SESSION["user"]);
		//todo unset all variables
        session_destroy();

        header("Location: index.php");
    }
?>
