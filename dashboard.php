<?php
session_start();

// Kullanıcı giriş yaptı mı kontrol et
if (!isset($_SESSION['ogrencino'])) {
    // Kullanıcı giriş yapmamışsa, login sayfasına yönlendir
    header("Location: login.php");
    exit();
}

echo "Hoş geldiniz, " . $_SESSION['ogrencino'] . "!"; // Öğrenci numarasını göster
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Öğrenci Paneli</h2>
    <p>Bu alan, giriş yaptıktan sonra öğrenciye gösterilecek içeriktir.</p>
    <a href="logout.php">Çıkış Yap</a>
</body>
</html>
