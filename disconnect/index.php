<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="注销，登陆，退出">
    <meta name="description" content="注销登陆。">
    <meta name="robots" content="none">
    <title>注销登陆</title>
    <link rel="stylesheet" href="../css/header_footer.css">
    <link rel="stylesheet" href="../css/disconnect.css">
</head>

<body>
    <?php
    include "../includes/header.inc.php";
    include "../path.php";
    session_start();
    
    if(isset($_SESSION["usr_id"])){
        $_SESSION=array();
        session_destroy();
        echo "<h3>您已退出登录。</h3>";
    } else {
        echo "<h3>这里是退出登录页。</h3>";
    }
    echo "<p><a href=\"../\">返回主页</a></p>";
    header("refresh:2; url=..");
    
    include "./includes/footer.inc.php" ;
    ?>
</body>

</html>
