<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gunluk Izler</title>
    <!-- <link rel="stylesheet" type="text/css" href="gunluk.css"> -->
    <link rel="stylesheet" href="gunluk.css">
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
        <center><h1 class="h1">Günlüğüm</h1>
        <div class='gunluk'>
        <?php
    session_start();
    if (!isset($_SESSION["kullaniciadi"])) {
        header("Location: giris.php");
        exit();
    }

    $kullaniciadi = $_SESSION["kullaniciadi"];
    
    $db = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');

    // Kullanıcının ID'sini al
    $kullaniciSorgu = $db->query("SELECT kullanici_id FROM kullanici WHERE kullaniciadi = '$kullaniciadi'");
    $kullanici = $kullaniciSorgu->fetch();
    $profil_kullanici_id = $kullanici['kullanici_id'];

    // Kullanıcının günlüklerini çek
    $gunlukSorgu = $db->query("SELECT `gunluk_id`, `baslik`, `icerik`, `tarih` FROM `gunluk` WHERE kullanici_id = '$profil_kullanici_id' ORDER BY `tarih` DESC");

    while ($gunluk = $gunlukSorgu->fetch()) {
        $gunlukid = $gunluk['gunluk_id'];
        $baslik = $gunluk['baslik'];    
        $icerik = $gunluk['icerik'];
        $tarih = date("d/m/Y", strtotime($gunluk['tarih'])); // Tarihi gün/ay/yıl formatına çeviriyoruz

        echo "<div class='gunluk1'>";
        echo "<span class='baslikspan'>$baslik</span><br>";
        echo "<span class='tarihspan'>$tarih</span><br>";
        echo "<div class='icerikspan'>$icerik</div><br>";
        echo "<form action='gunlugumduzen.php' method='get'>";
        echo "<input type='hidden' name='gid' value='$gunlukid'>";
        echo "<a href='gunlugumduzen.php'><input type='submit' class='gduzen' value='Günlüğümü düzenle'></a></form><br>";
        echo "</div>";
    }
    ?></div></center>

    
</body>
</html>
