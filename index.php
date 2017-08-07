<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="index, 主页">
    <meta name="description" content="某主页">
    <meta name="robots" content="index">
    <title>某主页</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/header_footer.css">
</head>

<body>
    <?php 
        include('./includes/header.inc.php');
        include('./includes/login.inc.php');
    ?>

    <section>
        <form name="login_input" method="post" action="<?php echo htmlspecialchars($_SERVER[ 'PHP_SELF' ]);?>">
            <h4 id="hint">
                <?php echo $hint; ?>
            </h4>
            <div class="input">
                <label>账号：</label>
                <label>密码：</label>
            </div>
            <div class="input">
                <input type="text" id="id" name="id" value="<?php echo $id;?>" required />
                <input type="password" id="pw" name="pw" value="<?php echo $pw;?>" required />
            </div>
            <div class="button">
                <input type="submit" value="登陆" />
            </div>
            <div class="link">
                <a href="./register/">注册</a>
            </div>
        </form>
    </section>
    <?php include('./includes/footer.inc.php'); ?>
</body>

</html>
