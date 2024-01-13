<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gunluk Izler</title>
    <link rel="stylesheet" type="text/css" href="etkinlikekle.css">
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
    </div>
    <form action="" method="POST">
    <div class="etkinlik">
        <div class="baslik">
            <span class="baslikyazi">Başlık:</span><br>
            <input class="baslikborder" type="text" name="etkinlik_baslik">
        </div>
        <div class="icerik">
            <span class="icerikyazi">Etkinlikten bahsediniz:</span><br>
            <textarea class="icerikborder" type="text" name="etkinlik_tm"></textarea>
        </div>
        <span class="konum">Konum:</span><input class="konumborder" type="text" name="konum"><br>
        <span class="tarih">Tarih:</span><input class="tarihborder" type="date" name="tarih"><br>
        <span class="saat">Saat:</span><input class="saatborder" type="text" name="saat"><br>
        <span class="fotograf">Fotoğraf seçiniz:</span><br>
        <div class="upload"><input class="fotografborder" type="file" name="fotograf" value="+"></div>
        <input class="paylasborder" type="submit" name="paylas" value="Etkinliği Paylaş">
    </div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION["kullaniciadi"])) {
    header("Location: giris.php");
    exit();
}


if (isset($_POST['paylas'])) {
    $eb = $_POST['etkinlik_baslik'];
    $etm = $_POST['etkinlik_tm'];
    $konum = $_POST['konum'];
    $ft = $_POST['fotograf'];
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];
    

    $db = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', ''); // bağlantı

    // Postu oluştur
    $e_ekle = $db->exec("INSERT INTO etkinlik (etkinlik_baslik, etkinlik_tm,konum,fotograf,tarih,saat) VALUES ('$eb','$etm','$konum',' $ft','$tarih','$saat')");

    // Kullanıcıyı güncelle
    $etkinlik_id = $db->lastInsertId();
    
    if (isset($_SESSION["kullaniciadi"])) {
        $kullanici_id = $_SESSION["kullaniciadi"];

        // Kullanıcı bilgilerini çek
        $kullaniciBilgisi = $db->query("SELECT * FROM kullanici WHERE kullaniciadi='$kullanici_id'");
        while ($kullanici = $kullaniciBilgisi->fetch()) {
            $kullanici_id = $kullanici['kullanici_id'];
            $e_guncelle = $db->exec("UPDATE etkinlik SET kullanici_id='$kullanici_id' WHERE etkinlik_id='$etkinlik_id'");
        }

    }
    
    if ($e_ekle)
    header("Location: etkinlik.php");
    exit();
}

?>
