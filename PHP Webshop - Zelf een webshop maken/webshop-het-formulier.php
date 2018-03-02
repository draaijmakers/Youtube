/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=ipuz3hDC_-c//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Een bestelformulier maken - Zelf een webshop maken #5 */

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
}else if(isset($_GET['actie']) && ($_GET['actie'] == 'winkelwagen')){
	if (isset($_SESSION['bestel'])){
		$winkelwagenItem = explode('[@]', trim($_SESSION['bestel'], '[@]'));
		echo '<table border="1">';
		foreach($winkelwagenItem AS $itemInWagen){
			foreach($item AS $itemInfo){
				if ($itemInWagen == $itemInfo[3]){
					$itemNaam = $itemInfo[0];
					$itemPrijs = $itemInfo[2];
				}
			}
			echo '<tr><td>1</td><td>'.$itemNaam.'</td><td>&euro; '.($itemPrijs/100).'</td></tr>';
		}
		echo '</table>';
	}else{
		echo 'Er ging iets mis';
	}
}else{
	foreach($item AS $itemInfo){
		echo '<p><strong>'.$itemInfo[0].'</strong><br />'.$itemInfo[1].'</p>';
		echo '<p>&euro; '.($itemInfo[2]/100).',- </p>';
		echo '<a href="?module=webshop&actie=bestel&id='.$itemInfo[3].'">Bestellen</a>';
	}
}
?>