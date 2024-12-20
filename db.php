<?php
// MySQL veritabanı bilgilerini girin
$servername = "sql213.infinityfree.com";  // Veritabanı sunucu adresi
$username = "if0_37950048";  // Kullanıcı adı
$password = "Ts3llZjdSaPw0K";  // Şifre
$dbname = "if0_37950048_matfen";  // Veritabanı adı

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
