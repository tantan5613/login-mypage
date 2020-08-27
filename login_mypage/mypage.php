<?php
mb_internal_encoding("utf8");
session_start();

if(empty($_SESSION['id'])){

    try{
        //try catch文。DBに接続できなければエラーメッセージを表示
        $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
    } catch(PDOException $e){
        die ("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインをしてください。</p>
        <a href='./login.php'>ログイン画面へ</a>"
    );
    }

    //prepared statementでSQL分の型を作る
    $stmt = $pdo->prepare("select * from members_data where mail = ? && password = ?");

    //bindValueメソッドでパラメータをセット
    $stmt->bindValue(1,$_POST["mail"]);
    $stmt->bindValue(2,$_POST["password"]);

    //executeでクエリを実行
    $stmt->execute();
    $pdo = NULL;

    //fetch・while文でデータ取得し、sessionに代入
    while ($row = $stmt->fetch()){//foreach ($stmt as $row){
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['mail'] = $row['mail'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['picture'] = $row['picture'];
        $_SESSION['comments'] = $row['comments'];
    }

    if(empty($_SESSION['id'])){
        header("Location:Login_error.php");
    }

    if(!empty($_POST['login_keep'])){
        $_SESSION['login_keep']=$_POST['login_keep'];
    }

}

if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])){
    setcookie('mail',$_SESSION['mail'],time()+60+60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);
}else if(empty($_SESSION['login_keep'])){
    setcookie('mail','',time()-1);
    setcookie('login_keep','',time()-1);
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
                <div class="mydata-wrap">
                    <img src="<?php echo $_SESSION['picture']; ?>" alt="">
                    <p>
                        氏名：<?php echo $_SESSION['name']; ?> <br>
                        メール：<?php echo $_SESSION['mail']; ?> <br>
                        パスワード：<?php echo $_SESSION['password']; ?> <br>
                    </p>
                </div><!-- /.wrap -->
                <p class="comments">
                <?php echo $_SESSION['comments']; ?>
                </p><!-- /.comments -->
                <form action="mypage_hensyu.php" method="post">
                    <input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage">
                    <input type="submit" value="編集する">
                </form>
            </div><!-- /#form-wrap -->
        </div><!-- /#content -->
        <footer>
            <p class="copy">©2018 InterNous All rights reserved.</p><!-- /.copy -->
        </footer>
    </div><!-- /#wrapper -->
</body>
</html>