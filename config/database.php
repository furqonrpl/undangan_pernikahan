<?php
$host = 'localhost';
$nama_database = 'db_undangan';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$nama_database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $kesalahan) {
    die("Koneksi database gagal: " . $kesalahan->getMessage());
}
