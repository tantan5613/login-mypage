<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録｜4eachblog</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div id="wrapper">
        <header>
            <h1><a href="login.php"><img src="4eachblog_logo.jpg" alt=""></a></h1>
            <a href="login.php" class="login">ログイン</a><!-- /.login -->
        </header>
        <div id="content">
            <h2>会員登録</h2>
            <div id="form-wrap">
                <!-- ファイルアップロード時には必ずenctype="multipart/form-data"が必要 -->
                <form action="register_confirm.php" method="post" enctype="multipart/form-data">
                    <p><span>必須</span>指名</p>
                    <!-- required　必須項目に必要　エラー内容を指定しないとデフォのものが出る -->
                    <input type="text" name="name" id="" required>
                    <p><span>必須</span>メールアドレス</p>
                    <input type="email" name="mail" id="" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                    <p><span>必須</span>パスワード(半角英数字6文字以上)</p>
                    <input type="password" name="password" id="password" pattern="^[a-zA-Z0-9]{6,}$" required>
                    <p><span>必須</span>パスワード確認</p>
                    <input type="password" name="confirm_password" id="confirm" oninput="Confirmpassword(this)" required>
                    <p>プロフィール写真</p>
                    <!-- ファイル容量のアップロード上限を決める -->
                    <input type="hidden" name="max_file_size" value="1000000">
                    <input type="file" name="picture" id="">
                    <p>コメント</p>
                    <textarea name="comments" id="" cols="40" rows="10"></textarea><!-- /# -->
                    <input type="submit" value="登録する" id="button" class="">
                </form>
            </div><!-- /#form-wrap -->
        </div><!-- /#content -->
        <footer>
            <p class="copy">©2018 InterNous All rights reserved.</p><!-- /.copy -->
        </footer>
    </div><!-- /#wrapper -->
    <script>
        function Confirmpassword(confirm){
            var input1 = password.value;
            var input2 = confirm.value;
            if(input1 != input2){
                confirm.setCustomValidity("パスワードが一致しません。");
            }else{
                confirm.setCustomValidity("");
            }
        }
    </script>
</body>
</html>