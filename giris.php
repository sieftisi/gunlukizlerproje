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
    <center>
        <div class="kayitol">
            <form class="kayitform" method="POST">
                <h1>Giriş Yap</h1>
                <input type="text" name="kullaniciadi" class="kullanici" placeholder="Kullanıcı adı giriniz.">
                <input type="password" name="sifre" class="kullanici" placeholder="Şifre giriniz.">
                <input type="submit" name="girisbtn" class="buton" value="Giriş Yap">
                <p>Hesabınız yok mu?</p> <a href="kayit.php">Kayıt Ol</a>
            </form>
        </div>
</body>

</html>

<?php
if(isset($_POST['girisbtn']))
{
	session_start();
    $adsoyad=$_POST['adsoyad'];
	$kullanici_adi=$_POST['kullaniciadi'];
	$sifre=$_POST['sifre'];
	
	$list = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', ''); //bağlantı kodu
	$listele= $list-> query("SELECT * FROM kullanici");
	while ($row = $listele->fetch()) {
		if ($kullanici_adi==$row['kullaniciadi'] && $sifre==$row['sifre'])
		{   
            $_SESSION["kullanici_id"] = $kullanici_id;
			$_SESSION["kullaniciadi"] = $kullanici_adi;
			$_SESSION["kullanicisifresi"] = $sifre;
			$_SESSION["tur"]=$row['ktur'];
 
			if($row['ktur']=='admin')
				header('location: panel.php');
			elseif($row['ktur']=='')
				header('location: index.php');
            else
                echo "Kullanıcı Bulunamadı!";
			
	    }
	}
}
?>