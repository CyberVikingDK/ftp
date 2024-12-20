<?php
session_start();
include('db.php');

// Check if the user is an admin
if (!isset($_SESSION['admin'])) {
    die("Bu sayfayı görüntüleme izniniz yok.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ogrencino = mysqli_real_escape_string($conn, $_POST['ogrencino']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the student number already exists
    $sql_check = "SELECT * FROM users WHERE ogrencino = '$ogrencino'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "Bu öğrenci numarası zaten kayıtlı.";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (ogrencino, password) VALUES ('$ogrencino', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "Yeni kullanıcı başarıyla kaydedildi.";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kullanıcı Kaydı</title>
</head>
<body>
    <h2>Kullanıcı Kaydı</h2>
    <form method="POST">
        <label for="ogrencino">Öğrenci Numarası</label>
        <input type="text" id="ogrencino" name="ogrencino" required>
        
        <label for="password">Şifre</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Kayıt Et</button>
    </form>
</body>
</html>
