<?php
    require_once "../config.php";
    require_once (ROOT_DIR.'/includes/param.inc.php');

    global $lifeTimeInMin;
    session_start();

    if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true){
        // logged in
    } else {
        session_destroy();
        echo "<h3>请登录。</h3>";
        include "footer.inc.php";
        header("refresh:1;url=//".$_SERVER['HTTP_HOST']);
        die();
    }

    if(isset($_SESSION["lastActivity"]) && (time() - $_SESSION["lastActivity"] > 60 * $lifeTimeInMin)) {
        session_destroy();
        echo "<h3>登录已过期</h3>";
        include "footer.inc.php";
        header("refresh:1;url=//".$_SERVER['HTTP_HOST']);
    } else{
        $_SESSION["lastActivity"] = time();
        session_regenerate_id(true);
    }
?>
