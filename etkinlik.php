<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etkinlikler</title>
    <link rel="stylesheet" type="text/css" href="etkinlik.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
<div class="ust-menu">
        <a href="index.php"> <img src="pic/logopic.png" class="logo" alt="Günlük İzler Logo"></a>
        <i><b class="slogan">Anılarını paylaş, izi kalsın...</b></i>
        <hr class="ust-cizgi"></hr>
</div>

<div class="hakkinda">
<h1 class="baslik">Sitemizde neden etkinlik özelliği var?</h1>
<text class="yazi">Etkinliklere katılmak veya düzenlemek, insanların birbirleriyle bağlantı kurmasını, stresi azaltmasını, yaratıcılıklarını geliştirmesini ve topluluk bağlarını güçlendirmesini sağlar. Bu deneyimler, insanların sosyal, duygusal ve zihinsel sağlığını iyileştirmenin etkili bir yoludur.</text>
</div>

<a href="etkinlikekle.php"><button id="ekle">Etkinlik Ekle</button></a>

<div class="ortadiv">

<?php
$list = new PDO("mysql:host=localhost;dbname=mertmaki_gunlukizler", 'root', ''); // bağlantı kodu
$listele = $list->query("SELECT * FROM etkinlik ORDER BY etkinlik_id ASC");
while ($row = $listele->fetch()) {
    $id = $row['etkinlik_id'];
    $etknpp = '';
    $fotograf = $row['fotograf'];

    echo "<tr><td>";
    echo "<div class='etk-div'>";
    echo "<form action='etkinlikgor.php' method='get'>";
    echo "<input type='hidden' name='Eid' value='$id'>";
    echo "<h2 class='etk-baslik'><font color='white'>" . $row['etkinlik_baslik'] . "</font></h2>";
    echo  $row['etkinlik_tm']."<br>";
    echo  $row['konum']."<br>";
    echo  "<input type='submit' class='devamibtn' value='&#10097;'></form>";

    echo "</div></td></tr>";
}

echo "</table></center>";

?>

</div>

</body>

</html>