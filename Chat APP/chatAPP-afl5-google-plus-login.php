/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=7CMaZrvkNQk//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Inloggen met Google PLUS - CHAT APP #5 */

<?php
if (isset($_SESSION['inloggenAPP']) && ($_SESSION['inloggenAPP'] != '')){
	$actie = array("home","aanmelden","laden");

	function laden (){
		echo '<section>
		<h1>Welkom</h1>
		<p><em><strong>"</strong>Welkom bij de YouTube Chat APP,<br />de APP voor en door YouTube-ers!<strong>"</strong></em></p>
		<p><a href="/home.html"><strong>Open de APP</strong></a></p>
		<meta http-equiv="refresh" content="10; URL=/home.html">
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
					<input type="hidden" name="userChannelName" value="<?php echo $youtubedataArray[3]; ?>" />
					<p><input type="submit" name="goToStep3" value="Ja, dit is mijn kanaal" /></p>
				</form>
			<?php 
			}else{
				echo '<p class="error">Helaas, u moet minimaal 5 abonnees hebben om u aan te melden</p>';
			}
			echo '<p><a href="/aanmelden/">Kies een ander kanaal!</a></p><p><em>* Uw abonnee aantal is afkomstig van YouTube</em></p>';
		}else if (isset($_POST['goToStep3'])){
			echo '<h2>Opslaan</h2>';
			$qInvoer = "
				INSERT INTO
					`Users`
				SET
					`userId` 		= '".mysqli_real_escape_string($MySQL, $_SESSION['id'])."',
					`userChannel` 	= '".mysqli_real_escape_string($MySQL, $_POST['userLink'])."',
					`userChannelName` = '".mysqli_real_escape_string($MySQL, $_POST['userChannelName'])."',
					`userName`		= '".mysqli_real_escape_string($MySQL, $_SESSION['name'])."',
					`userEmail`		= '".mysqli_real_escape_string($MySQL, $_SESSION['email'])."',
					`userDate` 		= NOW()";

			if (mysqli_query($MySQL, $qInvoer)){echo '<p class="goed">Uw gegevens zijn opgeslagen</p>';}
			else {echo '<p class="error">Sorry, niet opgeslagen.</p>'; echo mysqli_error($MySQL);}
		}else{
			?>
				<h2>Uw kanaal URL</h2>
				<form action="/aanmelden/" method="post">
					<p><strong>Uw kanaal link:</strong><br /><input type="url" name="userLink" value="" required autofocus placeholder="http://youtube.com/channel/..." /></p>
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
}else{
	include ('google_login/index.php');
}
?>