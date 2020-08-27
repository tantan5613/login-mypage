<?php
mb_internal_encoding("utf8");
//仮保存されたファイル名で画像ファイルを取得(サーバーへ仮アップロードされたディレクトリとファイル名)
$temp_pic_name = $_FILES['picture']['tmp_name'];

//もとのファイル名で画像ファイルを取得。事前に画像を格納する[image]という名前のフォルダを作成しておく必要あり
$orijinal_pic_name = $_FILES['picture']['name'];
$path_filename = './image/'.$orijinal_pic_name;

//仮保存のファイル名をimageフォルダに元のファイル名で移動させる
move_uploaded_file($temp_pic_name,'./image/'.$orijinal_pic_name);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ登録｜4eachblog</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="register_confirm.css">
</head>
<body>
    <div id="wrapper">
        <header>
            <h1><a href="login.php"><img src="4eachblog_logo.jpg" alt=""></a></h1>
        </header>
        <div id="content">
            <h2>会員登録　確認</h2>
            <p>こちらの内容で登録しても宜しいでしょうか？</p>
            <div id="form-wrap">
                <p>指名:
                    <?php echo $_POST["name"]; ?>
                </p>
                <p>メールアドレス:
                    <?php echo $_POST["mail"]; ?>
                </p>
                <p>パスワード:
                    <?php echo $_POST["password"]; ?>
                </p>
                <p>プロフィール写真:
                    <?php echo $orijinal_pic_name; ?>
                </p>
                <p>コメント:
                    <?php echo $_POST["comments"]; ?>
                </p>
                <!-- 内容を修正する -->
                <div id="buttons">
                    <form action="register.php">
                        <input type="submit" class="return-button" value="戻って修正する">
                    </form>
                    <!-- 次の画面に情報を渡す -->
                    <form action="register_insert.php" method="post">
                        <input type="submit"  class="button" value="登録する">
                        <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
                        <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                        <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
                        <input type="hidden" value="<?php echo $path_filename; ?>" name="path_filename">
                        <input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments">
                    </form>
                </div><!-- /#buttons -->
            </div><!-- /#form-wrap -->
        </div><!-- /#content -->
        <footer>
            <p class="copy">©2018 InterNous All rights reserved.</p><!-- /.copy -->
        </footer>
    </div><!-- /#wrapper -->
</body>
</html>