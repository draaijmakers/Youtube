/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=If04AOX1j-c//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Aanmaken ChatRooms - CHAT APP #6 */

<?php
if (isset($_SESSION['inloggenAPP']) && ($_SESSION['inloggenAPP'] != '')){
	$actie = array("home","aanmelden","laden","addrooms");
	
	function addrooms (){
		include ('db.php');
		echo '<section><h1>Groep aanmaken:</h1>';
		
		if (isset($_POST['submit'])){
			$loginCheckQuery = mysqli_query($MySQL, "SELECT `roomName` FROM `Rooms` WHERE `roomName` = '".$_POST['roomName']."'");
			if (mysqli_num_rows($loginCheckQuery) > 0){
				echo '<p class="error">Sorry, deze groep betaat al.</p><p><a class="button" href="/addrooms/"><< Ga terug</a></p>';
			}else{
				$qInvoer = "
				INSERT INTO
					`Rooms`
				SET
					`roomName` 		= '".mysqli_real_escape_string($MySQL, $_POST['roomName'])."',
					`roomAdminid` 	= '".mysqli_real_escape_string($MySQL, $_SESSION['id'])."',
					`roomUsers`		= '".mysqli_real_escape_string($MySQL, $_SESSION['id']).",'";
					
				if (mysqli_query($MySQL, $qInvoer)){echo '<p class="goed">Uw gegevens zijn opgeslagen</p><p><a class="button" href="/home.html">Ga verder >></a></p>';}
				else {echo '<p class="error">Sorry, niet opgeslagen.</p><p><a class="button" href="/addrooms/"><< Ga terug</a></p>'; echo mysqli_error($MySQL);}
			}
		}
		
		echo '<form action="/addrooms/" method="post">
			<p><strong>Groep Naam:</strong><br /><input type="text" name="roomName" value="" required /></p>
			<p><input type="submit" name="submit" value="Verder" /></p>
		</form></section>';
	}
	
	function home (){
		include ('db.php');
		$rooms = mysqli_query($MySQL, "SELECT * FROM `Rooms` WHERE `roomUsers` LIKE '%".$_SESSION['id'].",%' ");
		while ($date = mysqli_fetch_assoc($rooms)){
			$users = explode(', ', $date['roomUsers']);
			foreach ($users AS $users2){
				if ($users2 = $_SESSION['id']){
					echo 'goed';
				}
			}
		}
		
		
		echo '<section>
		<h1>Home</h1>
		<p>Chat APP</p>
		</section>';
	}
	
	function laden (){
		echo '<section>
		<h1>Welkom</h1>
		<p><em><strong>"</strong>Welkom bij de YouTube Chat APP,<br />de APP voor en door YouTube-ers!<strong>"</strong></em></p>
		<p><a href="/home.html"><strong>Open de APP</strong></a></p>
		<meta http-equiv="refresh" content="5; URL=/home.html">
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
				echo '<p class="error">Helaas, u moet minimaal 5 abonnees hebben om u aan te melden</p><p><a class="button" herf="/aanmelden/"><< Ga terug</a></p>';
			}
			echo '<p><a href="/aanmelden/">Kies een ander kanaal!</a></p><p><em>* Uw abonnee aantal is afkomstig van YouTube</em></p>';
		}else if (isset($_POST['goToStep3'])){
			echo '<h2>Opslaan</h2>';
			$loginCheckQuery = mysqli_query($MySQL, "SELECT `userChannelName` FROM `Users` WHERE `userChannelName` = '".$_POST['userChannelName']."'");
			if (mysqli_num_rows($loginCheckQuery) > 0){
				echo '<p class="error">Sorry, dit kanaal staat al in geschreven.</p><p><a class="button" href="/aanmelden/"><< Ga terug</a></p>';
			}else{
				$qInvoer = "
				INSERT INTO
					`Users`
				SET
					`userId` 		= '".mysqli_real_escape_string($MySQL, $_SESSION['id'])."',
					`userChannel` 	= '".mysqli_real_escape_string($MySQL, $_POST['userLink'])."',
					`userChannelName` = '".mysqli_real_escape_string($MySQL, $_POST['userChannelName'])."',
					`userName`		= '".mysqli_real_escape_string($MySQL, $_SESSION['name'])."',
					`userEmail`		= '".mysqli_real_escape_string($MySQL, $_SESSION['email'])."',
					`userDate` 		= NOW(),
					`userLoginIp`	= '".$_SERVER['REMOTE_ADDR']." 