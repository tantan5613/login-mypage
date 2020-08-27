<?php
mb_internal_encoding("utf8");
//Sessionスタート
session_start();

//maypage.php以外からは「login_error.php」へリダイレクト
if(empty($_POST['from_mypage'])){
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
    <link rel="stylesheet" href="mypage.css">
</head>
<body>
    <div id="wrapper">
        <header>
            <h1><a href="login.php"><img src="4eachblog_logo.jpg" alt=""></a></h1>
        </header>
        <div id="content">
            <h2>会員情報</h2><a href="log_out.php" class="log_out">ログアウト</a>
            <div id="form-wrap">
                <p class="hello">こんにちは！<?php echo $_SESSION['name']; ?>さん</p><!-- /.hello -->

                <form method="post" action="mypage_update.php">
                    <div class="mydata-wrap">
                        <img src="<?php echo $_SESSION['picture']; ?>" alt="">
                        <p>
                            氏名：<input type="text" name="name" value="<?php echo $_SESSION['name']; ?>" id="" required><br>
                            メール：<input type="email" name="mail" value="<?php echo $_SESSION['mail']; ?>" id="" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required><br>
                            パスワード：<input type="password" name="password" value="<?php echo $_SESSION['password']; ?>" pattern="^[a-zA-Z0-9]{6,}$" required><br>
                        </p>
                    </div><!-- /.my-data-wrap -->
                <p class="comments">
                <textarea name="comments" value="" id="" cols="60" rows="10"><?php echo $_SESSION['comments']; ?></textarea>
                </p><!-- /.comments -->
                <input type="submit" value="この内容に登録する" id="button" class="">
                </form>
            </div><!-- /#form-wrap -->
        </div><!-- /#content -->
        <footer>
            <p class="copy">©2018 InterNous All rights reserved.</p><!-- /.copy -->
        </footer>
    </div><!-- /#wrapper -->
</body>
</html>