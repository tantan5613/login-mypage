<?php
session_start();
//ログイン時にアクセスしたらマイページにリダイレクト
if(isset($_SESSION['id'])){
    header("Location:mypage.php");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン｜4eachblog</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="wrapper">
        <header>
            <h1><a href="login.php"><img src="4eachblog_logo.jpg" alt=""></a></h1>
            <a href="register.php" class="login">新規会員登録</a><!-- /.login -->
        </header>
        <div id="content">
            <div id="form-wrap">
                <form action="mypage.php" method="post">
                    <p>メールアドレス</p>
                    <input type="email" name="mail" value="<?php if(isset($_COOKIE['login_keep'])){echo $_COOKIE["mail"];}?>" id="" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                    <p>パスワード</p>
                    <input type="password" name="password" value="<?php if(isset($_COOKIE['login_keep'])){echo $_COOKIE["password"];}?>" id="password" pattern="^[a-zA-Z0-9]{6,}$" required>
                    <p><label for="hold"><input type="checkbox" name="login_keep" value="login_keep" name="hold" id="hold"
                        <?php 
                            if(isset($_COOKIE["login_keep"])){
                                echo "checked='checked'";
                            }
                        ?>>ログインを保持する</label></p>
                    <input type="submit" value="ログイン" id="button" class="">
                </form>
            </div><!-- /#form-wrap -->
        </div><!-- /#content -->
        <footer>
            <p class="copy">©2018 InterNous All rights reserved.</p><!-- /.copy -->
        </footer>
    </div><!-- /#wrapper -->
</body>
</html>