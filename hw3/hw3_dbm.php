<?php
function getDb()
{
    $dsn = 'mysql:dbname=keijiban2; host=127.0.0.1';
    $usr = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $usr, $password);
        $db->exec('SET NAMES utf8');
    } catch (PDOException $e) {
        die("接続エラー:{$e->getMessage()}");
    }
    return $db;
}