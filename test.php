<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$data = 'emlak1';
$user = 'root';   // önce root ile deneyelim
$pass = '';       // şifre yok

try {
    $db = new PDO("mysql:host=$host;dbname=$data;charset=utf8", $user, $pass);
    echo "Veritabanına bağlandım.";
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}