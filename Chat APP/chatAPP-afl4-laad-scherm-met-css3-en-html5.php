/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=AaKQOek8ZQg//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Splash screen / Laat scherm maken  - CHAT APP #4 */

<?php
$actie = array("home","aanmelden","laden");

function laden (){
	echo '<section>
	<p><img src="/img/loading.gif" class="laden" alt="Laden..." /></p>
	<p>Laden...</p>
	<p><a href="/home.html">Open de APP</a></p>
	</section>';
}

function aanmelden (){
	include ('db.php');
	echo '<section><h1>Aanmelden</h1>';
	if (isset($_POST['goToStep2'])){
		echo '<h2>Controleer uw gegevens</h2>';
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
		
		if ($youtubedataArray[0] > 5){
			echo '<p><strong>Is uw Kanaalnaam?</strong><br />'.$youtubedataArray[3].'</p>
			<p><strong>U heeft (ongeveer*)</strong><br />'.$youtubedataArray[0].'?</p>';
		?>
			<form action="/aanmelden/" method="post">
				<input type="hidden" name="userLink" value="<?php echo $_POST['userLink']; ?>" />
				<p><input type="submit" name="goToStep3" value="Ja, dit is mijn kanaal" /></p>
			</form>
		<?php 
		}else{
			echo '<p class="error">Helaas, u moet minimaal 5 abonnees hebben om u aan te melden</p>';
		}
		echo '<p><a href="/aanmelden/">Kies een ander kanaal!</a></p><p><em>* Uw abonnee aantal is afkomstig van YouTube</em></p>';
	}else if (isset($_POST['goToStep3'])){
		?>
			<h2>Uw contact gegevens*</h2>
			<form action="/aanmelden/" method="post">
				<input type="hidden" name="userLink" value="<?php echo $_POST['userLink']; ?>" />
				<input type="hidden" name="userName" value="<?php echo $_POST['userName']; ?>" />
				<p><strong>Uw Naam</strong><br /><input type="text" name="userCName" value="" required autofocus /></p>
				<p><strong>Uw Email</strong><br /><input type="text" name="userCEmail" value="" required /></p>
				<p><strong>Uw Tel</strong><br /><input type="text" name="userCTel" value="" required /></p>
				<p><input type="submit" name="goToStep4" value="Opslaan" /></p>
			</form>
			<p><em>* Deze zullen NIET met 3de gedeeld worden</em></p>
		<?php
	}else if (isset($_POST['goToStep4'])){
		echo '<h2>Opslaan</h2>';
		$qInvoer = "
			INSERT INTO
				`Users`
			SET
				`userChannel` 		= '".mysqli_real_escape_string($MySQL, $_POST['userLink'])."',
				`userChannelName` 	= '".mysqli_real_escape_string($MySQL, $_POST['userName'])."',
				`userName`		= '".mysqli_real_escape_string($MySQL, $_POST['userCName'])."',
				`userEmail`		= '".mysqli_real_escape_string($MySQL, $_POST['userCEmail'])."',
				`userTel`		= '".mysqli_real_escape_string($MySQL, $_POST['userCTel'])."',
				`userDate` 		= NOW()";

		if (mysqli_query($MySQL, $qInvoer)){echo '<p class="goed">Uw gegevens zijn opgeslagen</p>';}
		else {echo '<p class="error">Sorry, niet opgeslagen.</p>'; echo mysqli_error($MySQL);}
	}else{
		?>
			<h2>Uw kanaal URL</h2>
			<form action="/aanmelden/" method="post">
				<p><strong>Uw kanaal link:</strong><br /><input type="url" name="userLink" value="http://youtube.com/channel/" required autofocus placeholder="http://youtube.com/channel/..." /></p>
				<p><input type="submit" name="goToStep2" value="Verder" /></p>
			</form>
		<?php
	}
	echo '</section>';
}

function home (){
	echo '<section>
	<h1>Home</h1>
	<p>Chat APP</p>
	</section>';
}
?>