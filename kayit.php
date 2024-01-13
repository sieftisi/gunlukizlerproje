<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gunluk Izler</title>
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@500&family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
</head>
<body id="kayitbg">
<div class="ust-menu">
    <a href="index.php"> <img src="pic/logopic.png" class="logo" alt="Günlük İzler Logo"></a>
    <i><b class="slogan">Anılarını paylaş, izi kalsın...</b></i>
</div>
    <center><div class="kayitol">
        <form class="kayitform" method="POST">
            <h1>Kayıt Ol</h1>
            <input type="text" name="adsoyad" class="kullanici" placeholder="Ad-Soyad giriniz.">
            <input type="text" name="eposta" class="kullanici" placeholder="E-Posta giriniz.">
            <input type="text" name="kullaniciadi" class="kullanici" placeholder="Kullanıcı adı giriniz.">
            <input type="password" name="sifre" class="kullanici" placeholder="Şifre giriniz.">
            <input type="submit" name="kayitbutton" class="buton" value="Kayıt Ol">
            <p>Zaten hesabınız var mı?</p> <a href="giris.php">Giriş Yap</a>
        </form>
    </div>
</body>
</html>
<?php

if(isset($_POST['kayitbutton']))
{
    $adsoyad=$_POST['adsoyad'];
    $eposta=$_POST['eposta'];
    $kullaniciadi=$_POST['kullaniciadi'];
    $sifre=$_POST['sifre'];
   
	//Bağlantı kodu:
	$db = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');
	//ekleme kodu:
	$ekle=$db->exec("INSERT INTO kullanici( adsoyad, eposta, kullaniciadi, sifre) VALUES ( '$adsoyad', '$eposta', '$kullaniciadi', '$sifre')");

	if($ekle)
		echo "Kaydınız başarıyla gerçekleştirilmiştir.";
	else
		echo "Kayıt başarısız";

        if ($ekle)
    header("Location: giris.php");
    exit();
}
?>