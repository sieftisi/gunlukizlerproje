<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gunluk Izler</title>
    <link rel="stylesheet" type="text/css" href="gunluk.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@500&family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="ust-menu">
    <a href="index.php"> <img src="pic/logopic.png" class="logo" alt="Günlük İzler Logo"></a>
    <i><b class="slogan">Anılarını paylaş, izi kalsın...</b></i>
	<hr class="ust-cizgi"></hr>
    <center><h1 class="h1">Günlük Oluştur</h1></center>
    <form action="" method="post">
<center><div class="gunluk">
    <input type="text" class="baslik" name="baslik" placeholder="Başlık giriniz.">
    <textarea class="icerik" rows="8" cols="40" name="icerik" placeholder="İçerik giriniz." required></textarea>
    <input type="date" class="tarih" name="tarih" placeholder="Tarih giriniz." required>
    <input type="submit" class="kaydet" name="kaydet" value="Kaydet">
</div></center>
</form>
<a href="gunlugum.php"><input type="submit" class="gunlugum" value="Günlüğüm"></a>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION["kullaniciadi"])) {
    header("Location: giris.php");
    exit();
}

if (isset($_POST['kaydet'])) {
    $b = $_POST['baslik'];
    $i = $_POST['icerik'];
    $t = $_POST['tarih'];

    $db = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', ''); // bağlantı oluşturuluyor

    $ekle = $db->exec("INSERT INTO gunluk (baslik, icerik, tarih) VALUES ('$b','$i','$t')");

    // Kullanıcının postlarını çek
    $gunluk_id = $db->lastInsertId();

    if (isset($_SESSION["kullaniciadi"])) {
        $kullanici_id = $_SESSION["kullaniciadi"];

        // Kullanıcı bilgilerini çek
        $kullaniciBilgisi = $db->query("SELECT * FROM kullanici WHERE kullaniciadi='$kullanici_id'");
        while ($kullanici = $kullaniciBilgisi->fetch()) {
            $kullanici_id = $kullanici['kullanici_id'];
            $e_guncelle = $db->exec("UPDATE gunluk SET kullanici_id='$kullanici_id' WHERE gunluk_id='$gunluk_id'");
        }
    }
}
?>
