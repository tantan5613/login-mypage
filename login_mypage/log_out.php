<?php
session_start();
//Sessionの削除
session_destroy();

header("Location:login.php");
?>