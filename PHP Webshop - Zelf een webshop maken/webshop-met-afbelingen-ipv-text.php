/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=uDfN975fYz8//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Webshop met Afbeeldingen ipv Tekst - Zelf een webshop maken #EXTRA */

<?php
$item = array(
	array ('Appel','/img/appel.jpg','500','1'),
	array ('Kers','/img/kers.jpg','1000','3'),
	array ('Peer','/img/peer.jpg','1500','6')
);

echo '<h1>Webshop</h1>';

foreach($item AS $itemInfo){
	echo '<p><strong>'.$itemInfo[0].'</strong><br /><img src="'.$itemInfo[1].'" height="150px" boder="1px" /></p>';
	echo '<p>&euro; '.($itemInfo[2]/100).',- </p>';
	echo '<a href="?module=webshop&actie=bestel&id='.$itemInfo[3].'">Bestellen</a>';
}
?>