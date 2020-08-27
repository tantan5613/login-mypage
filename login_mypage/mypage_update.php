<?php
mb_internal_encoding("utf8");
session_start();

echo $_POST['name'].$_POST['mail'].$_POST['password'].$_POST['comments']."<br><br>";

try{
    //try catch文。DBに接続できなければエラーメッセージを表示
    $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
} catch(PDOException $e){
    die ("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインをしてください。</p>
    <a href='./login.php'>ログイン画面へ</a>"
);
}

//prepared statementでSQL分の型を作る
$stmt = $pdo->prepare("update members_data set name = ?, mail = ?, password = ?, comments = ? where id = ?");

//bindValueメソッドでパラメータをセット
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
$stmt->bindValue(5,$_SESSION['id']);

//executeでクエリを実行
$stmt->execute();

//prepared statementで更新された情報をDBからselect文で取得
$stmt = $pdo->prepare("select * from members_data where mail = ? && password = ?");
$stmt->bindValue(1,$_POST['mail']);
$stmt->bindValue(2,$_POST['password']);

//executeでクエリを実行
$stmt->execute();
$pdo = NULL;

while ($row = $stmt->fetch()){//foreach ($stmt as $row){
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['picture'] = $row['picture'];
    $_SESSION['comments'] = $row['comments'];
}

echo     $_SESSION['id'] .
$_SESSION['name'] .
$_SESSION['mail'] .
$_SESSION['password'] .
$_SESSION['picture'] .
$_SESSION['comments'] ;

header("Location:mypage.php");




?>