/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=rGC0j-d1nAw//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Het bestelsysteem - Zelf een webshop maken #2 */

<?php
$item = array(
	array ('Film 1','Dit is de eerste film','100','1'),
	array ('Film 2','Dit is de tweede film','200','3'),
	array ('Film 3','Dit is de derde film','300','6')
);

echo '<h1>Webshop</h1>';

if (isset($_GET['actie']) && (isset($_GET['id']) && $_GET['id'] != '')){
	echo 'Het id is '.$_GET['id'];
}

foreach($item AS $itemInfo){
	echo '<p><strong>'.$itemInfo[0].'</strong><br />'.$itemInfo[1].'</p>';
	echo '<p>&euro; '.($itemInfo[2]/100).',- </p>';
	echo '<a href="?actie=bestel&id='.$itemInfo[3].'">Bestellen</a>';
}
?>