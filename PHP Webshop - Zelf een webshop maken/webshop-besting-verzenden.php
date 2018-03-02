/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=HumvJS_FwLY//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Een bestelling verzenden - Een eigen PHP webshop EXTRA */

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
	echo 'Bedankt voor uw besteling. <a href="?module=webshop&actie=winkelwagen">Ga verder naar uw winkelwagen</a>';
}else if(isset($_GET['actie']) && ($_GET['actie'] == 'winkelwagen')){
	if (isset($_SESSION['bestel'])){
		$besteling = '';
		$winkelwagenItem = explode('[@]', trim($_SESSION['bestel'], '[@]'));
		$besteling = '<form method="post"><table border="0" width="100%">';
		$besteling .= '<tr><td width="25%"><strong>Aantal</strong></td><td width="20%"><strong>Artiekel</strong></td><td><strong>Bedrag</strong></td></tr>';
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
			$besteling .= '<tr><td><input type="text" value="'.$aantal.'" name="aantal-'.$itemInWagen.'" size="2" /> <input type="submit" value=">>" /></td><td>'.$itemNaam.'</td><td>&euro; '.($itemPrijs/100).'</td></tr>';
		}
		$besteling .= '<tr><td colspan="2"><strong>Totaal</strong></td><td><em>&euro;'.($rekenprijs/100).'</em></td></tr></table>';
		$besteling .= '<p>&nbsp;</p><table border="0">
                <tr><td><strong>Naam: </strong></td><td><input name="naam" type="text" value="'.$_POST['naam'].'" /></td></tr>
                <tr><td><strong>Email: </strong></td><td><input name="mail" type="text" value="'.$_POST['mail'].'" /></td></tr>
				<tr><td><strong>Adres: </strong></td><td><input name="adres" type="text" value="'.$_POST['adres'].'" /></td></tr>
                <tr><td colspan="2"><input name="bestellen" type="submit" value="Plaats u bestelling" /></td></tr>
            </table></form>';
			
		if (isset($_POST['bestellen'])){
			$headers = 'From: Website <info@daveyraaijmakers.nl>'."\n";
			$headers .= 'Reply-To: '.$_POST['naam'].' <'.$_POST['email'].'>'."\n";
			$headers .= 'X-Mailer: PHP/' . phpversion();
			$headers .= 'Return-Path: Mail-Error <info@daveyraaijmakers.nl>'."\n";
			$headers .= 'MIME-Version: 1.0'."\n";
			$headers .= 'Content-Transfer-Encoding: 8bit'."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1'."\n";
	
			if (mail(
				'Davey Raaijmakers <info@daveyraaijmakers.nl>', 
				'Besteling door: '.$_POST['naam'],
				$besteling, 
				$headers)
			){echo 'De besteling is verzonden';}
		}
		echo $besteling;
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