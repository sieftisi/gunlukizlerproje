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

</body>
</html>
<?php
    $y = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', '');
    $listele = $y->query("SELECT * FROM mesaj", PDO::FETCH_ASSOC);
    if ($listele->rowCount()) {
        echo '<center><table border="1" class="mesajtablo" style="border-collapse: collapse; width: 84%;">';
        echo '<tr style="background-color: #B46060;"><th>Ad Soyad</th><th>Mail</th><th>Başlık</th><th>Mesaj</th></tr>';
        foreach ($listele as $gelenveri) {
            echo '<tr>';
            echo '<td>' . $gelenveri['adsoyad'] . '</td>';
            echo '<td>' . $gelenveri['mail'] . '</td>';
            echo '<td>' . $gelenveri['baslik'] . '</td>';
            echo '<td>' . $gelenveri['mesaj'] . '</td>';
            echo '</tr>';
        }
    }
?>