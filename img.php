<?php

set_time_limit(0);

$filename = "image";

if(file_exists($filename.".png")) {
    $im = imagecreatefrompng($filename.".png");
    echo $filename.".png adatai:<br/>\n";
} elseif(file_exists($filename.".jpg")) {
    $im = imagecreatefromjpeg ($filename.".jpg");
    echo $filename.".jpg adatai:<br/>\n";
} elseif(file_exists($filename.".jpeg")) {
    $im = imagecreatefromjpeg ($filename.".jpeg");
    echo $filename.".jpeg adatai:<br/>\n";
} elseif(file_exists($filename.".bmp")) {
    $im = imagecreatefrombmp ($filename.".bmp");
	if($im === false) $im = imagecreatefromxbm($filename.".bmp");
    echo $filename.".bmp adatai:<br/>\n";
} else {
    die("HIBA! Nem létezik a kép!\n");
}

if($im === false) die("Valami nem stimmel a képpel. Ha hibaüzenetet látsz, jelezd a fejlesztőnek.");

$X = imagesx($im);
$Y = imagesy($im);

echo "A kép méretei: X:".$X." px Y:".$Y." px<br/>\n";
echo "Feldolgozás folyamatban, várj...\n\n";
$fp = fopen('adatok.txt', 'w');
$sor = "X;Y;R;G;B\n";
fwrite($fp, $sor);

for($cx=0;$cx<$X;$cx++) {
    for($cy=0;$cy<$Y;$cy++) {
        $rgb = imagecolorat($im, $cx, $cy);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        $sor = $cx.";".$cy.";".$r.";".$g.";".$b."\n";
        fwrite($fp, $sor);
    }
}
fclose($fp);

echo "Kész! Az adatok.txt fájlban találod a részleteket. <a href=\"adatok.txt\">Adatok letöltése</a>";

?>