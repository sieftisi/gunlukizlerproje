<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesaj Formu</title>
    <link rel="stylesheet" type="text/css" href="mesaj.css">
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
<div class="oneriform">
    <i><b class="iosf">İstek, Öneri ve Şikayet Formu</b></i>
    <div class="msjlar">
        <label for="adsoyad">AD SOYAD :</label>
        <br><br>
        <label for="eposta">E-POSTA :</label>
        <br><br>
        <label for="kbas">KONU BAŞLIĞI :</label>
        <br><br>
        <label for="msj">MESAJINIZ :</label>
    </div>
    <form class="txtbox" method="POST" action="">
       <input type="text" name="adsoyad" style="text-align: center; font-size: 1.5rem; font-family: 'Playfair Display', serif; border-radius: 4rem; height: 2rem; width: 25rem;"  id="name"><br><br><br>
       <input type="text" name="eposta" style="text-align: center; font-size: 1.5rem; font-family: 'Playfair Display', serif; border-radius: 4rem; height: 2rem; width: 25rem;"  id="epost"><br><br><br>
       <input type="text" name="kbas" style="text-align: center; font-size: 1.5rem; font-family: 'Playfair Display', serif; border-radius: 4rem; height: 2rem; width: 25rem;"  id="kbas"><br><br><br>
       <textarea name="msj" id="msj" style="text-align: center; font-size: 1.5rem; font-family: 'Playfair Display', serif; border-radius: 3rem; height: 15rem; width: 25rem;"></textarea>
       <input class="gonder" name="gonder" type="submit" value="Gönder">
    </form>
</div>
</body>
</html>

<?php

if(isset($_POST['gonder']))
{
    $adsoyad = $_POST['adsoyad'];
    $eposta = $_POST['eposta'];
    $kbas = $_POST['kbas'];
    $msj = $_POST['msj'];

    // Bağlantı kodu:
    $db = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');

    // Ekleme kodu:
    $ekle = $db->exec("INSERT INTO mesaj(adsoyad, mail, baslik, mesaj) VALUES ('$adsoyad', '$eposta', '$kbas', '$msj')");

    if($ekle)
        echo "Mesajınız başarıyla iletilmiştir.";
    else
        echo "Mesaj gönderimi başarısız";
}
?>
