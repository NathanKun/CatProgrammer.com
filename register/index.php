<!DOCTYPE html>
<html>

<head>
    <title>某注册页面</title>
    <meta charset="utf-8">
    <meta name="keywords" content="注册，登录名，昵称，密码" />
    <meta name="description" content="某注册页面" />
    <meta name="robots" content="none">
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/header_footer.css" />
</head>

<body>
    <?php include('../includes/header.inc.php'); ?>

    <h2>注册页面</h2>

    <section>
        <?php include "../includes/register.inc.php"?>
        <form id="reg_input" method="post" action="<?php echo htmlspecialchars($_SERVER[ 'PHP_SELF' ]);?>">
            <h4 id="hint">
                <?php echo $hint; ?>
            </h4>
            <div class="input">
                <label for="id">登录名：</label>
                <label for="username">昵称：</label>
                <label for="pw">密码：</label>
                <label for="pw2">确认密码：</label>
            </div>
            <div class="input">
                <input type="text" id="id" name="id" value="<?php echo $id;?>" required />
                <input type="text" id="username" name="name" value="<?php echo $name;?>" required />
                <input type="password" id="pw" name="pw" value="<?php echo $pw;?>" required />
                <input type="password" id="pw2" name="pw2" value="<?php echo $pw2;?>" required />
            </div>
            <div class="button">
                <input type="submit" value="注册" />
            </div>
        </form>
    </section>
    <?php include "../includes/footer.inc.php"?>
</body>

</html>
