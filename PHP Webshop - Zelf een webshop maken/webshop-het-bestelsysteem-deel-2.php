/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=mqzFX4NRFXE//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Artikelen bestellen - Zelf een webshop maken #3 */

<?php
$item = array(
	array ('Bioscoopbon 1','Dit is de eerste bioscoopbon','500','1'),
	array ('Bioscoopbon 2','Dit is de tweede bioscoopbon','1000','3'),
	array ('Bioscoopbon 3','Dit is de derde bioscoopbon','1500','6')
);

echo '<h1>Webshop</h1>';

if ((isset($_GET['actie']) && ($_GET['actie'] == 'bestel')) && (isset($_GET['id']) && ($_GET['id'] != ''))){
	if (isset($_SESSION['bestel'])){
		$bestelItem = explode('[@]', $_SESSION['bestel']);
		if (!in_array($_GET['id'], $bestelItem)){
			$_SESSION['bestel'] = $_GET['id'].'[@]'.$_SESSION['bestel'];
		}
		
		echo $_SESSION['bestel'];
	}else{
		$_SESSION['bestel'] = $_GET['id'].'[@]';
	}
}

foreach($item AS $itemInfo){
	echo '<p><strong>'.$itemInfo[0].'</strong><br />'.$itemInfo[1].'</p>';
	echo '<p>&euro; '.($itemInfo[2]/100).',- </p>';
	echo '<a href="?module=webshop&actie=bestel&id='.$itemInfo[3].'">Bestellen</a>';
}
?>