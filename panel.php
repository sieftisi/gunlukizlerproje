<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="stylesheet" type="text/css" href="panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
<div class="ust-menu">
        <a href="index.php"> <img src="pic/logopic.png" class="logo" alt="Günlük İzler Logo"></a>
        <i><b class="slogan">Anılarını paylaş, izi kalsın...</b></i>
        <text class="baslik">Admin Panel V0.00002</text>
        <hr class="ust-cizgi"></hr>
</div>

<div class="sol-menu">
        <hr class="sol-cizgi">
        </hr>
        <div class="kategori">
            <a href="panel.php"><i class="fa-solid fa-user"></i>Kullanıcı</a> <br>
            <a href="postpanel.php"><i class="fa-solid fa-feather"></i>Post</a> <br>
            <a href="etkinlikpanel.php"><i class="fa-regular fa-calendar"></i>Etkinlik</a> <br>
            <a href="mesajpanel.php"><i class="fa-solid fa-message"></i>Mesajlar</a> <br>
        </div>
</div>

<div class="guncelleme">
    <form action="" method="post">
            <input type="text" name="id" class="kullanici" placeholder="ID"><p>
            <input type="text" name="adsad" class="kullanici" placeholder="Ad Soyad"><p>
            <input type="text" name="mail" class="kullanici" placeholder="Mail"><p>
            <input type="text" name="kad" class="kullanici" placeholder="Kullanıcı Adı"><p>
            <input type="password" name="sifre" class="kullanici" placeholder="Şifre"><p>
        
        <input type="submit" name="gonder" class="butonlar" value="Kayıt Ol">
        <input type="submit" name="guncelle" class="butonlar" value="Verileri Güncelle">
        <input type="submit" name="sil" class="butonlar" value="Verileri Sil">
        <tr>
            <input type="submit" name="listele" class="butonlar" value="Listele">
        </tr>
        </form>
</div> <br>

</body>
</html>
<?php
if(isset($_POST['gonder']))
{
	$id=$_POST['id'];
	$adsad=$_POST['adsad'];
	$mail=$_POST['mail'];
	$kad=$_POST['kad'];
	$sifre=$_POST['sifre'];
	//Bağlantı kodu:
	$y = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');
	//ekleme kodu:
	$ekle=$y->exec("INSERT INTO kullanici(adsoyad, eposta, kullaniciadi, sifre) VALUES ('$adsad','$mail','$kad','$sifre')");
	if($ekle)
		echo "<span>Kayıt başarıyla gerçekleştirilmiştir.</span>";
	else
		echo "<span>Kayıt başarısız</span>";
}

if (isset($_POST['guncelle'])) {
    $id = $_POST['id'];
    $adsad = $_POST['adsad'];
    $mail = $_POST['mail'];
    $kad = $_POST['kad'];
    $sifre = $_POST['sifre'];
    
    // Bağlantı kodu:
    $y = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');

    // Güncelleme kodu1:
    $guncel = $y->prepare("UPDATE `kullanici` SET `adsoyad`=?, `eposta`=?, `kullaniciadi`=?, `sifre`=? WHERE kullanici_id=?");
    $guncel->execute([$adsad, $mail, $kad, $sifre, $id]);

    if ($guncel) {
        echo "<span>Güncellendi.</span>";
    } else {
        echo "<span>Güncelleme başarısız.</span>";
    }
}

if(isset($_POST['sil']))
{
	$id=$_POST['id'];
	//Bağlantı kodu:
	$y = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');
	//ekleme kodu:
	$sil=$y->exec("DELETE FROM `kullanici` WHERE kullanici_id='$id'");
	if($sil)
		echo "<span>Kayıt silindi</span>";
}

if (isset($_POST['listele'])) {
    $y = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');
    $listele = $y->query("SELECT * FROM kullanici", PDO::FETCH_ASSOC);
    if ($listele->rowCount()) {
        echo '<center><table border="1" class="listetablo" style="border-collapse: collapse; width: 99%;">';
        echo '<tr style="background-color: #B46060;"><th>ID</th><th>Ad Soyad</th><th>Mail</th><th>K.Adı</th><th>Şifre</th></tr>';
        foreach ($listele as $gelenveri) {
            echo '<tr>';
            echo '<td>' . $gelenveri['kullanici_id'] . '</td>';
            echo '<td>' . $gelenveri['adsoyad'] . '</td>';
            echo '<td>' . $gelenveri['eposta'] . '</td>';
            echo '<td>' . $gelenveri['kullaniciadi'] . '</td>';
            echo '<td>' . $gelenveri['sifre'] . '</td>';
            echo '</tr>';
        }
    }
}
?>