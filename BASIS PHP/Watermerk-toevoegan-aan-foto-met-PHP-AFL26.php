/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=w1l1T-SbZYE//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* WATERMERK met PHP toevoegen - PHP #26 */

<?php
$imgOrgineel = base64_decode($_GET['img']);

list($breedte, $hoogte) = getimagesize('./'.$imgOrgineel);
if ($breedte > 550){$waterMerk = "../img/logo.png";}
else {$waterMerk = "../img/logo_klein.png";}

$imgExt = substr($imgOrgineel, -3);
if (strtolower($imgExt) == "gif"){if (!$newImg = imagecreatefromgif($imgOrgineel)){echo "Error opening $imgOrgineel!"; exit;}}
else if(strtolower($imgExt) == "jpg"){if (!$newImg = imagecreatefromjpeg($imgOrgineel)){echo "Error opening $imgOrgineel!"; exit;}}
else if(strtolower($imgExt) == "png"){if (!$newImg = imagecreatefrompng($imgOrgineel)){echo "Error opening $imgOrgineel!"; exit;}}
else {die;}

$newWaterMerk = imagecreatefrompng($waterMerk);
$colorOverlay = imagecolorallocatealpha($newImg, 255, 255, 255, 80);
$breedteImg = imagesx($newImg);
$hoogteImg = imagesy($newImg);
$breedteWaterMerk = imagesx($newWaterMerk);
$hoogteWaterMerk = imagesy($newWaterMerk);

imagefilledrectangle($newImg, 0, 0, $breedteImg, $hoogteImg, $colorOverlay);
imagecopy($newImg, $newWaterMerk, (($breedteImg/2)-($breedteWaterMerk/2)), (($hoogteImg/2)-($hoogteWaterMerk/2)), 0, 0, $breedteWaterMerk, $hoogteWaterMerk);

$last_modified = gmdate('D, d M Y H:i:s T', filemtime ($imgOrgineel));

header("Last-Modified: $last_modified");
header("Content-Type: image/jpeg");
imagejpeg($newImg,NULL,95);
imagedestroy($newWaterMerk);
imagedestroy($newImg);
?>