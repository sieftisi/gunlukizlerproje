<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Paneli</title>
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

<div class="postguncelle">
    <form action="" method="post">
    <input type="text" name="pid" class="kullanici" placeholder="Post id"><p>
    <input type="text" name="baslik" class="kullanici" size="40"  placeholder="Post başlığı">
    <textarea rows="8" cols="40" name="tammetin" class="kullanici"  placeholder="Tam metin" ></textarea>
    <input type="file" name="fotograf" class="kullanici"><br>
    <span for="kategoriler">Kategori:</span>
    <select  class="kategoriborder" id="kategoriler" name="kategoriler">
            <option  name="kategoriler" value="" disabled selected hidden>Lütfen bir kategori seçin</option>
            <option  name="kategoriler" value="romantik">Romantik</option>
            <option  name="kategoriler" value="paranormal">Paranormal</option>
            <option  name="kategoriler" value="komedi">Komedi</option>
            <option  name="kategoriler" value="macera">Macera</option>
            <option  name="kategoriler" value="huzun">Hüzün</option>
            <option  name="kategoriler" value="utanc">Utanç</option>
            <option  name="kategoriler" value="basari">Başarı</option>
        </select>
    <input type="submit" name="psil" class="butonlar"  value="Post Sil">
    <input type="submit" name="pguncelle" class="butonlar"  value="Post Güncelle">
    <input type="submit" name="plistele" class="butonlar" value="Listele">
    </form>
</div>

</body>
</html>
<?php
if (isset($_POST['pguncelle'])) {
    $pid = $_POST['pid'];
    $baslik = $_POST['baslik'];
    $tammetin = $_POST['tammetin'];
    $fotograf = $_POST['fotograf'];
    $kategoriler = $_POST['kategoriler'];

    // Bağlantı kodu:
    $y = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');
    
    // Güncelleme kodu:
     $pguncel = $y->prepare("UPDATE `post_yonetimi` SET `baslik`=?, `tammetin`=?, `fotograf`=?, `kategoriler`=? WHERE post_id=?");
     $pguncel->execute([$baslik, $tammetin, $fotograf, $kategoriler, $pid]);

    if ($pguncel) {
        echo "<span>Güncellendi.</span>";
    } else {
        echo "<span>Güncelleme başarısız.</span>";
    }
    
}


if(isset($_POST['psil']))
{
	$pid=$_POST['pid'];
	//Bağlantı kodu:
	$p = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');
	//ekleme kodu:
	$sil=$p->exec("DELETE FROM `post_yonetimi` WHERE post_id='$pid'");
	if($sil)
		echo "<span>post silindi</span>";
}

if (isset($_POST['plistele'])) {
    $y = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');
    $listele = $y->query("SELECT * FROM post_yonetimi", PDO::FETCH_ASSOC);
    if ($listele->rowCount()) {
        echo '<center><table border="1" class="listetablo" style="border-collapse: collapse; width: 99%;">';
        echo '<tr style="background-color: #B46060;"><th>ID</th><th>Başlık</th><th>Kisaltma</th><th>Tam Metin</th><th>Kategori</th></tr>';
        foreach ($listele as $gelenveri) {
            echo '<tr>';
            echo '<td>' . $gelenveri['post_id'] . '</td>';
            echo '<td>' . $gelenveri['baslik'] . '</td>';
            echo '<td>' . $gelenveri['kisaltma'] . '</td>';
            echo '<td>' . $gelenveri['tammetin'] . '</td>';
            echo '<td>' . $gelenveri['kategoriler'] . '</td>';
            echo '</tr>';
        }
    }
}
?>