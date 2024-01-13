<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gunluk Izler</title>
    <link rel="stylesheet" type="text/css" href="postekle.css">
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
<center><div class="bilgiler">
<form action="" method="post">
    <div class="baslik">
        <span>Başlık:</span><br>
        <input class="baslikborder" type="text" name="baslik" size="40" required>
    </div>
    <div class="metin">
        <span>İçerik:</span><br>
        <textarea class="metinborder" rows="8" cols="40" name="tammetin" required></textarea>
    </div>

    <div class="fotograf">
        <label class="label" for="fileInput">+</label>
        <input class="fotografborder" type="file" id="fotografInput" name="fotograf" onchange="showPreview()">
        <div id="fotoPreview"></div>
    </div>

    <div class="yayinla">
        <input class="yayinlaborder" type="submit" name="yayinla" value="Yayınla">
    </div>

    <p class="yaziktgr"><td>Kategoriler:</td></p>
    <tr>
        <select class="kategoriborder" id="kategoriler" name="Kategoriler" required>
            <option value="" disabled selected hidden>Lütfen bir kategori seçin</option>
            <option value="romantik">Romantik</option>
            <option value="paranormal">Paranormal</option>
            <option value="komedi">Komedi</option>
            <option value="macera">Macera</option>
            <option value="huzun">Hüzün</option>
            <option value="utanc">Utanç</option>
            <option value="basari">Başarı</option>
        </select>
    </tr>
</form>

</div></center>
</body>
</html>

<?php


session_start();
if (!isset($_SESSION["kullaniciadi"])) {
    header("Location: giris.php");
    exit();
}


if (isset($_POST['yayinla'])) {
    $b = $_POST['baslik'];
    $t = $_POST['tammetin'];
    $f = $_POST['fotograf'];
    $kategori = $_POST['Kategoriler'];
    $t2 = $_POST['tammetin'];

    $db = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', ''); // bağlantı

    // Postu oluştur
    $ekle = $db->exec("INSERT INTO post_yonetimi (baslik, tammetin, fotograf, kategoriler, kisaltma) VALUES ('$b','$t','$f', '$kategori', '$t2')");

    // Kullanıcıyı güncelle
    $post_id = $db->lastInsertId();
    
    if (isset($_SESSION["kullaniciadi"])) {
        $kullanici_id = $_SESSION["kullaniciadi"];

        // Kullanıcı bilgilerini çek
        $kullaniciBilgisi = $db->query("SELECT * FROM kullanici WHERE kullaniciadi='$kullanici_id'");
        while ($kullanici = $kullaniciBilgisi->fetch()) {
            $kullanici_id = $kullanici['kullanici_id'];
            $guncelle = $db->exec("UPDATE post_yonetimi SET kullanici_id='$kullanici_id' WHERE post_id='$post_id'");
        }

        if ($ekle && $guncelle)
            echo "<div class='yenikayit'>POST BAŞARIYLA EKLENDİ</div>";
        else
            echo "Ekleme başarısız.";
    } else {
        echo "Kullanıcı bilgileri bulunamadı.";
    }
}

?>