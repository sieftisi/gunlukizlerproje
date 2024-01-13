<?php
session_start();

$list = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');

// Eğer oturum açılmışsa ve kullanıcı bilgileri mevcutsa
if (isset($_SESSION["kullaniciadi"])) {
    // Kullanıcının profil fotoğrafını çek
    $pp = ''; // Bu değişkeni önceden tanımla

    // Kullanıcı bilgilerini veritabanından çek
    $kullaniciID = $_SESSION["kullaniciadi"];
    $kullaniciBilgisi = $list->query("SELECT * FROM kullanici WHERE kullaniciadi='$kullaniciID'");

    while ($kullanici = $kullaniciBilgisi->fetch()) {
        $k_adi = $kullanici['kullaniciadi'];
        $postpp = $kullanici['pp']; // Kullanıcının veritabanındaki fotoğraf sütununu al
        $adsoyad = $kullanici['adsoyad'];
        $pp = $kullanici['pp'];
        $wp = $kullanici['wp'];
        $instagram = $kullanici['instagram'];
        $twitter = $kullanici['twitter'];
        $facebook = $kullanici['facebook'];
        $tiktok = $kullanici['tiktok'];
    }

    // Kullanıcının post sayısını çek
    $postSayisiSorgu = $list->prepare("SELECT COUNT(*) as sayi FROM post_yonetimi WHERE kullanici_id='$kullaniciID'");
    $postSayisiSorgu->execute(); // Sorguyu çalıştır
    $postSayisi = $postSayisiSorgu->fetchColumn();

} else {
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="css/profil.css">
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

<div class="wp">
<?php
        if ($wp) {
            echo "<img src='$wp'</a>"; // Eğer kullanıcı fotoğrafı varsa onu kullan
        } else {
            echo "<img src='pic/bannerpic.png'</a>"; // Varsayılan kullanıcı fotoğrafını kullan
        }
        ?>
</div>

<text class="adsoyadtxt">
            <?php
            if ($adsoyad){
                echo $adsoyad;
            }
            else {
                echo "Ad Soyad";
            }
          ?>
    </text>

<text class="kadi">
            <?php
                echo "@"."$k_adi";
          ?>
    </text>

<text class="postbaslik">
        Anı Sayısı
</text>
<text class="postveri">
<?php
            if ($postSayisi){
                echo $postSayisi;
                echo " Gönderi";
            }
            else {
                echo "0 Gönderi";
            }
          ?>
</text>

<a href="profilduzenle.php"><button id="duzenle">Profil Düzenle</button></a>

<a href="cikis.php"><button id="cikis">Çıkış Yap</button></a>

<div class="iconlar">
<?php
    echo "<a href='$instagram' target='_blank'><i class='fa-brands fa-instagram'></i></a>";
    echo "<a href='$twitter' target='_blank'><i class='fa-brands fa-x-twitter'></i></a>";
    echo "<a href='$facebook' target='_blank'><i class='fa-brands fa-facebook-f'></i></a>";
    echo "<a href='$tiktok' target='_blank'><i class='fa-brands fa-tiktok'></i></a>";
    ?>
</div>
<div class="profilpic">
<?php
        if ($pp) {
            echo "<img src='$pp'</a>"; // Eğer kullanıcı fotoğrafı varsa onu kullan
        } else {
            echo "<img src='pic/userpic.png'</a>"; // Varsayılan kullanıcı fotoğrafını kullan
        }
        ?>
</div>
<hr class="profilcizgi"></hr>

<div class="postlar">

</div>


<?php

// Veritabanı bağlantısı
$list = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');

$listele = $list->prepare("SELECT * FROM post_yonetimi WHERE kullanici_id = $kullaniciID ORDER BY post_id DESC");
if (isset($_SESSION["kullaniciadi"])) {
    $pp = ''; // Bu değişkeni önceden tanımla

    $kullaniciID = $_SESSION["kullaniciadi"];
    $kullaniciBilgisi = $list->query("SELECT * FROM kullanici WHERE kullaniciadi='$kullaniciID'");


echo "<center><table width='1000'>";

while ($row = $listele->fetch()) {
    $id = $row['post_id'];
    $k_adi = ''; // Kullanıcı adını başlat
    $postpp = ''; // Varsayılan olarak fotoğrafı boş olarak başlat

    $kullaniciBilgisi = $list->prepare("SELECT * FROM kullanici WHERE kullanici_id = $kullaniciID");
    $kullaniciBilgisi->execute();

    // Verileri çek
    $kullanici = $kullaniciBilgisi->fetch();
    $k_adi = $kullanici['kullaniciadi'];
    $postpp = $kullanici['pp'];

    echo "<tr><td>";
    echo "<div class='post'>";
    if ($postpp) {
        echo "<div class='kullanicipost'><img src='$postpp' class='userpicpost'></a>";
    } else {
        echo "<div class='kullanicipost'><img src='pic/userpic.png' class='userpicpost'></a>";
    }
    echo "<span class='adsoyad'>@$k_adi</a></span>";
    echo "<form action='postlar.php' method='get'>";
    echo "<input type='hidden' name='id' value='$id'>";
    echo "<h2 class='baslik'><font color='white'>" . $row['baslik'] . "</font></h2>";
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp" . $row['kisaltma'] . "..." . "<input type='submit' class='devamibtn' value='&#10097;'></form>";
    echo "</div></td></tr>";
}

echo "</table></center>";
} else {
    echo "olmii";
}
?>

</body>
</html>
