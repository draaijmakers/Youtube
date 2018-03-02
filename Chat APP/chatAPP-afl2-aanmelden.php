/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=vMbJFuanv1o//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Profiel aanmaken - YouTube gegevens ophalen - CHAT APP #2 */

<?php
$actie = array("home","laden","aanmelden");

function aanmelden (){
	echo '<section>';
	if (isset($_POST['goToStep2'])){
		$url = $_POST['userLink'].'/about';
	
		$html = file_get_contents($url);
		$doc = new DOMDocument();
		$doc->loadHTML($html);
		
		$xpath = new DOMXpath($doc);
		$links = $xpath->query('//span[starts-with(@class, "about-stat")]');
	
		$youtubedataArray = array();
		foreach ($links AS $youtubedata){
			$youtubedataArray[] = $youtubedata->textContent;
		}
		
		$links = $xpath->query('//a[starts-with(@dir, "ltr")]');	
		foreach ($links AS $youtubedata){
			$youtubedataArray[] = $youtubedata->textContent;
		}
	
		echo '<h1>'.$youtubedataArray[3].'</h1>';
		echo '<em>U heeft '.$youtubedataArray[0].'</em>';
		if ($youtubedataArray[0] > 5){
		?>
			<form action="/aanmelden/" method="post">
				<input type="hidden" name="userLink" value="<?php echo $_POST['userLink']; ?>" />
				<p><strong>Klopt dit?</strong><br /><input type="submit" name="goToStep3" value="Ja, ga naar stap 3" /></p>
			</form>
		<?php 
		}else{
			echo 'Helaas, u moet minimaal 5 abonnees hebben om u aan te melden.';
		}
		echo '<p><a href="/aanmelden/">Kies een ander kanaal!</a></p>';
	}else if (isset($_POST['goToStep3'])){
		?>
			<form action="/aanmelden/" method="post">
				<input type="hidden" name="userLink" value="<?php echo $_POST['userLink']; ?>" />
				<input type="hidden" name="userName" value="<?php echo $_POST['userName']; ?>" />
				<p><input type="submit" name="goToStep2" value="verder" /></p>
			</form>
		<?php
	}else{
		?>
			<form action="/aanmelden/" method="post">
				<p><strong>Uw kanaal link:</strong><br /><input type="url" name="userLink" value="" /></p>
				<p><input type="submit" name="goToStep2" value="verder" /></p>
			</form>
		<?php
	}
	echo '</section>';
}

function home (){
	echo '<p>home</p>';
}

function laden (){
	echo '<p>Laden</p>';
}
?>