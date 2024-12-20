<?php
session_start();
include('db.php'); // Veritabanı bağlantısını dahil et

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen veriyi al
    $ogrencino = mysqli_real_escape_string($conn, $_POST['ogrencino']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Veritabanında öğrenci numarası ve şifreyi kontrol et
    $sql = "SELECT * FROM users WHERE ogrencino = '$ogrencino' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kullanıcı bulundu, giriş başarılı

        // Kullanıcı bilgilerini session'a kaydet
        $_SESSION['ogrencino'] = $ogrencino; // Öğrenci numarasını session'a ekle

        // Giriş yaptıktan sonra kullanıcını dashboard sayfasına yönlendir
        header("Location: dashboard.php");
        exit(); // Yönlendirmeden sonra işlemi sonlandır
    } else {
        // Kullanıcı adı veya şifre yanlış
        echo "Geçersiz kullanıcı adı veya şifre.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matfen Obs</title>
    <style>

        /* Genel Gövde Ayarları */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #74b9ff, #a29bfe);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Bu, footer'ın alt tarafta kalmasını sağlar */
        }

        /* Giriş Konteyneri */
        .login-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            width: 400px;
            padding: 30px;
            margin: 85px auto; /* Daha fazla boşluk için arttırıldı */
            text-align: center;
        }

        /* Logo */
        .login-container img {
            max-width: 150px;
            margin: 20px auto;
        }

        /* Başlık */
        .login-container h2 {
            color: #0f488b;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Etiketler ve Giriş Alanları */
        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
            color: #0f488b;
        }
        
        /**/

        input[type="text"], 
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #dfe6e9;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        /* Giriş Butonu */
        button {
            background: #0984e3;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
        }

        button:hover {
            background: #74b9ff;
        }

        /* Footer */
        .footer-container {
            background-color: #2C2C2C;
            color: white;
            width: 100%;
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
        }

        .footer-section {
            margin-bottom: 20px;
        }

        .footer-section h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #ffffff;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 8px;
        }

        .footer-section ul li a {
            color: #8e8e8e;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section ul li a:hover {
            color: #ffffff;
        }

        .footer-bottom {
            border-top: 1px solid #444;
            padding-top: 10px;
            margin-top: 10px;
            font-size: 12px;
        }

        .footer-bottom .social-links {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin: 10px 0 0;
        }

        .footer-bottom .social-links li {
            margin: 0 15px;
        }

        .footer-bottom .social-links li a {
            color: #8e8e8e;
            font-size: 20px;
            text-decoration: none;
            transition: color 0.3s, transform 0.3s;
        }

        .footer-bottom .social-links li a:hover {
            color: #ffffff;
            transform: scale(1.2);
        }

    </style>
</head>
<body>
    <div class="login-container">
        <img src="https://www.matfen.com.tr/upload/1757175012272593.png" alt="Logo">
        <h2>Matfen eğitim kurumları öğrenci giriş sistemi</h2>
        <form action="login.php" method="POST">
            <label for="ogrencino">Öğrenci numaranız</label>
            <input type="text" id="ogrencino" name="ogrencino" placeholder="Öğrenci Numaranızı Girin" required pattern="[0-9]{4}">

            <label for="password">Şifreniz</label>
            <input type="password" id="password" name="password" placeholder="Şifrenizi Girin" required autocomplete="off">

            <button type="submit">Giriş Yap</button>
        </form>
    </div>
    
    <footer class="footer-container">
        <div class="footer-section">
            <h3>Yararlı Bağlantılar</h3>
            <ul>
                <li><a href="http://www.meb.gov.tr/">MEB</a></li>
                <li><a href="https://ankara.meb.gov.tr/">MEB ANKARA</a></li>
                <li><a href="http://cankaya.meb.gov.tr/">MEB ÇANKAYA</a></li>
                <li><a href="https://eokulyd.meb.gov.tr/">E-OKUL</a></li>
                <li><a href="http://www.ankara.gov.tr/">ANKARA VALİLİĞİ</a></li>
                <li><a href="https://www.tdk.gov.tr/">TÜRK DİL KURUMU</a></li>
                <li><a href="https://www.anitkabir.tsk.tr/">ANITKABİR</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Kurumsal</h3>
            <ul>
                <li><a href="sayfa/tarihce">Tarihçe</a></li>
                <li><a href="sayfa/kurucularimizin-mesaji">Kurucularımızın Mesajı</a></li>
                <li><a href="sayfa/temel-degerlerimiz">Temel Değerlerimiz</a></li>
                <li><a href="sayfa/idari-kadro">İdari Kadro</a></li>
                <li><a href="kategori/etkinlik">Sosyal Sorumluluk Projelerimiz</a></li>
                <li><a href="kategori/haberler">Medyada MATFEN</a></li>
                <li><a href="sayfa/kisisel-verileri-koruma">Kişisel Verileri Koruma</a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>Copyright © Matfen All Rights Reserved.</p>
            <ul class="social-links">
                <li><a href="https://www.facebook.com/matfenegitimkurumlari" target="_blank">Facebook</a></li>
                <li><a href="https://twitter.com/matfenegitim" target="_blank">Twitter</a></li>
                <li><a href="https://www.instagram.com/matfenegitimkurumlari/" target="_blank">Instagram</a></li>
                <li><a href="https://www.youtube.com/matfenegitimkurumlari" target="_blank">YouTube</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>