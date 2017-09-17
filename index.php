<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="index, 主页">
    <meta name="description" content="某主页">
    <meta name="robots" content="index">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>某主页</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/header_footer.css">
</head>

<body>
    <?php 
        //include('./includes/header.inc.php');
        include('./includes/login.inc.php');
    ?>
	
	<header>
		<div class="wrapper">
			<svg width="100%" height="35vw">
				<text text-anchor="middle" x="50%" y="80%" class="text-cat text-1">
					喵
				</text>
				<text text-anchor="middle" x="50%" y="80%" class="text-cat text-2">
					喵
				</text>
				<text text-anchor="middle" x="50%" y="80%" class="text-cat text-3">
					喵
				</text>
				<text text-anchor="middle" x="50%" y="80%" class="text-cat text-4">
					喵
				</text>
			</svg> 
			<svg width="100%" height="6vw">
				<text text-anchor="middle" x="50%" y="80%" class="text-url text-1">
					catprogrammer.com
				</text>
				<text text-anchor="middle" x="50%" y="80%" class="text-url text-2">
					catprogrammer.com
				</text>
				<text text-anchor="middle" x="50%" y="80%" class="text-url text-3">
					catprogrammer.com
				</text>
				<text text-anchor="middle" x="50%" y="80%" class="text-url text-4">
					catprogrammer.com
				</text>
			</svg> 
		</div>
	</header>

    <section>
        <form name="login_input" method="post" action="<?php echo htmlspecialchars($_SERVER[ 'PHP_SELF' ]);?>">
            <h4 id="hint">
                <?php echo $hint; ?>
            </h4>
			<div class="inputs">
				<div>
					<label for="id">账号：</label>
					<input class="text-box" type="text" id="id" name="id" value="<?php echo $id;?>" required />
				</div>
				<div>
					<label for="pw">密码：</label>
					<input class="text-box" type="password" id="pw" name="pw" value="<?php echo $pw;?>" required />
				</div>
			</div>
            <div class="inputs">
                <input class="submit-btn" type="submit" value="登陆" />
            </div>
        </form>
    </section>
    <?php include('./includes/footer.inc.php'); ?>
</body>

</html>
