/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=_ETqvSLLC-M//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Aantallen aanpassen in PHP webshop */

<?php
session_start();
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
	}else{
		$_SESSION['bestel'] = $_GET['id'].'[@]';
	}
	echo $_SESSION['bestel'];
	echo 'Bedankt voor uw besteling. <a href="?module=webshop&actie=winkelwagen">Ga verder naar uw winkelwagen</a>';
}else if(isset($_GET['actie']) && ($_GET['actie'] == 'winkelwagen')){
	if (isset($_SESSION['bestel'])){
		$winkelwagenItem = explode('[@]', trim($_SESSION['bestel'], '[@]'));
		echo '<table border="0" width="100%"><form method="post">';
		echo '<tr><td width="15%"><strong>Aantal</strong></td><td width="20%"><strong>Artiekel</strong></td><td><strong>Bedrag</strong></td></tr>';
		$rekenprijs = 0;
		foreach($winkelwagenItem AS $itemInWagen){
			if (isset($_POST['aantal-'.$itemInWagen])){
				$aantal = $_POST['aantal-'.$itemInWagen];
			}else{$aantal = 1;}
			
			foreach($item AS $itemInfo){
				if ($itemInWagen == $itemInfo[3]){
					$itemNaam = $itemInfo[0];
					$itemPrijs = ($itemInfo[2]*$aantal);
					$rekenprijs = $itemPrijs+$rekenprijs;
				}
			}
			echo '<tr><td><input type="text" value="'.$aantal.'" name="aantal-'.$itemInWagen.'" size="2" /> <input type="submit" value=">>" /></td><td>'.$itemNaam.'</td><td>&euro; '.($itemPrijs/100).'</td></tr>';
		}
		echo '<tr><td colspan="2"><strong>Totaal</strong></td><td><em>&euro;'.($rekenprijs/100).'</em></td></tr>';
		echo '</form></table>';
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