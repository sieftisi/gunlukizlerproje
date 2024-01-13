<div class="ortadiv">
    <?php

    session_start();
    $x = $_GET['Eid'];
    $list = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', ''); //bağlantı kodu
    $listele = $list->query("SELECT * FROM etkinlik WHERE etkinlik_id=$x");
    echo "<center><table width='1000'>";
    while ($row = $listele->fetch()) {
        $a = $row['fotograf'];
        $id = $row['etkinlik_id'];
        $k_id = $row['kullanici_id'];

        $k_adi = '';
        $etknpp = '';

        $kullanicilar = $list->query("SELECT * FROM kullanici WHERE kullanici_id='$k_id'");
        while ($users = $kullanicilar->fetch()) {
            $k_adi = $users['kullaniciadi'];
            $etknpp = $users['pp']; // Kullanıcının veritabanındaki fotoğraf sütununu al
        }
    
        echo "<tr><td>";
        echo "<div class='post'>";
        if ($etknpp) {
            echo "<div class='kullanicipost'><a href='profil1.php?c=$k_id'><img src='$etknpp' class='userpicpost'></a></div>"; // Eğer kullanıcı fotoğrafı varsa onu kullan
        } else {
            echo "<div class='kullanicipost'><a href='profil1.php?c=$k_id'><img src='pic/userpic.png' class='userpicpost'></a></div>"; // Varsayılan kullanıcı fotoğrafını kullan
        }
        echo "<span class='adsoyad2'><a href='profil1.php?c=$k_id'> @$k_adi</a></span>";
        echo "<text class='etktarih'>Tarih = " . $row['tarih'] ."<br> Saat = ". $row['saat'] . "</text>";
        echo "<h2 class='etkbaslik'><font color='white'>" . $row['etkinlik_baslik'] . "</font></h2>";
        echo "<div class='postfoto'>";
        if (!empty($a)) {
            echo "<a href='$a' target='_blank'><img src='$a' alt='Fotoğraf' class='onizleme'></a>";
        }
        echo "</div>";
        echo "<div class='postyazi'>&nbsp;&nbsp;&nbsp;&nbsp;" . $row['etkinlik_tm'] ."&nbsp;&nbsp;&nbsp;&nbsp; <br> <br> <br>". $row['konum'] . "</div>";
        echo "</div></td></tr>";
       
        


    }
    echo "</table>";
    ?>
</div>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gunluk Izler</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@500&family=Playfair+Display:wght@500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="ust-menu">
        <a href="index.php"> <img src="pic/logopic.png" class="logo" alt="Günlük İzler Logo"></a>
        <i><b class="slogan">Anılarını paylaş, izi kalsın...</b></i>

        <div class="aramadiv">
            <div class="arama">
                <svg class="search_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <path
                        d="M46.599 46.599a4.498 4.498 0 0 1-6.363 0l-7.941-7.941C29.028 40.749 25.167 42 21 42 9.402 42 0 32.598 0 21S9.402 0 21 0s21 9.402 21 21c0 4.167-1.251 8.028-3.342 11.295l7.941 7.941a4.498 4.498 0 0 1 0 6.363zM21 6C12.717 6 6 12.714 6 21s6.717 15 15 15c8.286 0 15-6.714 15-15S29.286 6 21 6z">
                    </path>
                </svg>
                <input class="inputBox" id="inputBox" type="text" placeholder="Ara...">
            </div>
        </div>
        <div class="butonlar">
            <a href="etkinlikekle.php"> <button class="btn1">
                <b>Etkinlik+</b>
            </button> </a>
            <a href="gunlukekle.php"> <button class="btn2">
                <b>Günlük+</b>
            </button> </a>
        </div>

        <text class="merhaba">
            <?php

            if (isset($_SESSION["kullaniciadi"])) {
                echo "Merhaba, " . $_SESSION["kullaniciadi"];
            } else {
                echo "Merhaba, Misafir";
            }
            ?>
        </text>
        <a href="profil.php">
            <?php
            // Eğer oturum açılmışsa ve kullanıcı bilgileri mevcutsa
            if (isset($_SESSION["kullaniciadi"])) {
                // Kullanıcının profil fotoğrafını çek
                $pp = ''; // Bu değişkeni önceden tanımla
            
                // Kullanıcı bilgilerini veritabanından çek
                $kullaniciID = $_SESSION["kullaniciadi"];
                $kullaniciBilgisi = $list->query("SELECT * FROM kullanici WHERE kullaniciadi='$kullaniciID'");
                while ($kullanici = $kullaniciBilgisi->fetch()) {
                    $pp = $kullanici['pp'];
                }

                // Eğer kullanıcının profil fotoğrafı varsa onu göster, yoksa varsayılan fotoğrafı göster
                echo "<img src='" . ($pp ? $pp : 'pic/userpic.png') . "' class='userpic'>";
            } else {
                // Kullanıcı giriş yapmamışsa varsayılan fotoğrafı göster
                echo "<img src='pic/userpic.png' class='userpic'>";
            }
            ?>
        </a>



        <hr class="ust-cizgi">
        </hr>
    </div>

    <div class="sol-menu">
        <hr class="sol-cizgi">
        </hr>
        <div class="kategori">
            <a href="romantik.php"><i class="fa-solid fa-heart"></i>Romantik</a> <br>
            <a href="paranormal.php"><i class="fa-solid fa-skull-crossbones"></i>Paranormal</a> <br>
            <a href="komedi.php"><i class="fa-solid fa-face-grin-tears"></i>Komedi</a> <br>
            <a href="macera.php"><i class="fa-brands fa-space-awesome"></i>Macera</a> <br>
            <a href="huzun.php"><i class="fa-regular fa-face-sad-tear"></i>Hüzün</a> <br>
            <a href="utanc.php"><i class="fa-solid fa-person-harassing"></i>Utanç</a> <br>
            <a href="basari.php"><i class="fa-regular fa-thumbs-up"></i>Başarı</a><br>


            <div class="destek">
                <hr class="sol-cizgi2">
                <a href="sss.php"><i class="fa-solid fa-question"></i>SSS</a><br>
                <a href="mesaj.php" id="mesaj"><i class="fa-solid fa-message"></i>İstek,Şikayet,Öneri</a>
            </div>
        </div>

        <div class="anasayfakategori">
            <a href="index.php"><i class="fa-solid fa-house"></i>Ana Sayfa</a><br>
            <hr class="sol-ust-menu">
            </hr>
        </div>
    </div>

    <div class="sag-menu">
        <hr class="sag-cizgi">
        </hr>
        <a href="postekle.php">
            <button class="postekle">Bir şeyler yaz...&nbsp&nbsp&nbsp<i
                    class="fa-solid fa-feather"></i></button>
        </a>
        <hr class="sag-ust-menu">
        </hr>
        <div class="populer"></div>
        <div class="takip">

        </div>
    </div>
    </body>
</html>