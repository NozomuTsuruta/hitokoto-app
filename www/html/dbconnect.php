<?php
try {
    $db=new PDO('mysql:dbname=hitokoto;host=db;charset=utf8','root','secret');
} catch (PDOException $e) {
    echo 'DB接続エラー：'.$e->getMessage();
}
?>