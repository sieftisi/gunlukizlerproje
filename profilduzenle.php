<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["kullaniciadi"])) {
    header("Location: giris.php");
    exit();
}

// Get the user ID from the session
$kullanici_id = $_SESSION["kullanici_id"];

// Process the form submission
if (isset($_POST['guncellebtn'])) {
    // Get other POST data
    $as = $_POST['adsoyad'];
    $kadi = $_POST['kullaniciadi'];
    $psifre = $_POST['sifre'];
    $iurl = $_POST['instagramurl'];
    $turl = $_POST['twitterurl'];
    $furl = $_POST['facebookurl'];
    $tturl = $_POST['tiktokurl'];
    
    // Connection code:
    $y = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');

    // Update query:
    $guncel = $y->prepare("UPDATE `kullanici` SET `adsoyad`=?, `kullaniciadi`=?, `sifre`=?, `instagram`=?, `twitter`=?, `facebook`=?, `tiktok`=? WHERE `kullanici_id`=?");

    // Execute the query:
    $result = $guncel->execute([$as, $kadi, $psifre, $iurl, $turl, $furl, $tturl, $kullanici_id]);
}

?>
?>              
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="profilduzenle.css">
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
<div class="profilduzenle">
<form action="" method="POST">
<div class="wp">
    <input type="file" name="wpbtn" class="wpbtn" id="fileInput1">
    <span><i class="fa-solid fa-camera"></i></span>
    
</div>

<div class="profilpic">
    <input type="file" name="profilpicbtn" class="profilpicbtn" id="fileInput">
    <span><i class="fa-solid fa-camera"></i></span>
</div>

<div class="guncelle">
    <input type="text" class="adsoyad" name="adsoyad" placeholder="Ad-Soyad giriniz.">
    <input type="text" class="kullaniciadi" name="kullaniciadi" placeholder="@Kullanıcı adı giriniz.">
    <input type="text" class="sifre" name="sifre" placeholder="Şifre giriniz.">
</div>

<hr class="profilcizgi"></hr>

<p class="yaziinstagram">İnstagram:<input type="text" name="instagramurl" class="instagramurl" placeholder="Url giriniz."></p>
<p class="yazitwitter">Twitter:<input type="text" name="twitterurl" class="twitterurl" placeholder="Url giriniz."></p>
<p class="yazifacebook">Facebook:<input type="text" name="facebookurl" class="facebookurl" placeholder="Url giriniz."></p>
<p class="yazitiktok">Tiktok:<input type="text" name="tiktokurl" class="tiktokurl" placeholder="Url giriniz."></p>
<input type="hidden" name="kullanici_id" value="<?php echo $kullanici_id; ?>">
<input type="submit" name="guncellebtn" class="guncellebtn" value="Güncelle">
</form>
</div>
</body>
</html>