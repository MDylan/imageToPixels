<?php

$filename = "proba";

if(file_exists($filename.".png")) {
    $im = imagecreatefrompng($filename.".png");
    echo $filename.".png adatai:<br/>";
} elseif(file_exists($filename.".jpg")) {
    $im = imagecreatefromjpeg ($filename.".jpg");
    echo $filename.".jpg adatai:<br/>";
} elseif(file_exists($filename.".jpeg")) {
    $im = imagecreatefromjpeg ($filename.".jpeg");
    echo $filename.".jpeg adatai:<br/>";
} elseif(file_exists($filename.".bmp")) {
    $im = imagecreatefromwbmp  ($filename.".bmp");
    echo $filename.".bmp adatai:<br/>";
} else {
    die("Nem létezik a kép!");
}

$X = imagesx($im);
$Y = imagesy($im);

echo "A kép méretei: X:".$X." px Y:".$Y." px<br/>";

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

echo "<a href=\"adatok.txt\">Adatok letöltése</a>";

?>