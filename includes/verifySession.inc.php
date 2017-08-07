<?php
    require_once "../config.php";
    require_once (ROOT_DIR.'/includes/param.inc.php');

    global $lifeTimeInMin;
    session_start();

    if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true){
        // logged in
    } else {
        session_destroy();
        echo "<h3>Vous ne vous êtes pas encore identifié.</h3>";
        echo "<p><a href='https://catprogrammer.com'>Return to index</a></p>";
        include "footer.inc.php";
        die();
    }

    if(isset($_SESSION["lastActivity"]) && (time() - $_SESSION["lastActivity"] > 60 * $lifeTimeInMin)) {
        session_destroy();
        echo "<p><a href=\"./index.php\">Retourner à la page d'acceuil</a></p>";
        die("Votre session est expédié.");
    } else{
        $_SESSION["lastActivity"] = time();
        session_regenerate_id(true);
    }
?>
