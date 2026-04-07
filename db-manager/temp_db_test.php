<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3307;dbname=mydb','root','');
    echo 'OK';
} catch (PDOException $ex) {
    echo 'ERR:'.$ex->getMessage();
}
