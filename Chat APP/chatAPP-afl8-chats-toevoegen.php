/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=XQLbkLrs6-g//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Chats Toevoegen - CHAT APP #8 */

<?php
if (isset($_SESSION['inloggenAPP']) && ($_SESSION['inloggenAPP'] != '')){
	$actie = array("home","aanmelden","laden","addrooms","chat");
	
	function chat (){
		include ('db.php');
		$chechRoom = mysqli_query($MySQL, 'SELECT `roomName` FROM `Rooms` WHERE `roomId` = "'.$_GET['room'].'"');
		if (mysqli_num_rows($chechRoom) == 1){
			if (isset($_POST['submit'])){
				$qInvoer = "
				INSERT INTO
					`Chats`
				SET
					`chatUser` = '".mysqli_real_escape_string($MySQL, $_SESSION['id'])."',
					`chatRoomId` = '".mysqli_real_escape_string($MySQL, $_GET['room'])."',
					`chatText` = '".mysqli_real_escape_string($MySQL, $_POST['chatText'])."',
					`chatDate` = NOW()";
					
				if (!mysqli_query($MySQL, $qInvoer)){echo '<p class="error">Sorry, niet opgeslagen.</p>'; echo mysqli_error($MySQL);}
			}
			
			$chechRoomData = mysqli_fetch_assoc($chechRoom);
			echo '<header>
				<a href="#" title="Mijn porfiel">'.$chechRoomData['roomName'].'</a>
				<span class="nav-right"><a href="/home.html" title="Home"><i class="material-icons">home</i></a></span>
			</header>';
			
			if (isset($_GET['aantal'])){$aantal = $_GET['aantal'];}else{$aantal = 0;}
			$roomInfo = mysqli_query($MySQL, 'SELECT * FROM `Chats` WHERE `chatRoomId` = "'.$_GET['room'].'" ORDER BY `chatDate` ASC LIMIT '.$aantal.', 25');
			
			$count = mysqli_num_rows($roomInfo);	
			if ($count > 24){echo '<section class="chat small center"><a herf="/chat/'.$_GET['room'].'/'.($aantal+10).'/">Lees meer <i class="material-icons">replay_10</i></a></section>';}
			if ($count == 0){echo '<section class="chat small center">Verstuur het eerst bericht</section>';}
			
			while ($data = mysqli_fetch_assoc($roomInfo)){
				$userInfo = mysqli_query($MySQL, 'SELECT `userName` FROM `Users` WHERE `userId` = "'.$data['chatUser'].'"');
				$userInfoData = mysqli_fetch_assoc($userInfo);
				if (mysqli_num_rows($userInfo) == 1){$user = ucwords($userInfoData['userName']);}else {$user = 'Anoniem';}
				if ($userInfoData['userName'] == $_SESSION['name']){$class = 'me';}else{$class = '';}
				
				echo '<section class="chat '.$class.'"><strong>'.$user.'</strong><br />'.ucfirst($data['chatText']).'</section>';
			}
			echo '<section class="chat" style="background: none; box-shadow: none;"><p><a name="bottum">&nbsp;</a></p></section>';
			
			echo '</main><footer><form action="/chat/'.$_GET['room'].'/" method="post"><input type="text" name="chatText" value="" required /><input type="submit" class="button" name="submit" value=">>" /></form></footer>';
		}else{
			echo '<header>
				<a href="#" title="Sorry">Oeps, niet Gevonden</a>
				<span class="nav-right"><a href="/home.html" title="Home"><i class="material-icons">home</i></a></span>
			</header><section><h1>Dit ging niet goed!</h1><p>De door u gezochte groep is helaas niet gevonden.</p><p><a href="/home.html" class="button"><< Ga terug</a></p></section>';
		}
	}
	
	function addrooms (){
		include ('db.php');
		
		echo '<header>
			<a href="#" title="Connecties Maken">Connecties Maken</a>
			<span class="nav-right"><a href="/home.html" title="Home"><i class="material-icons">home</i></a></span>
		</header>';
			
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
		}else{
			echo '<p>Kies en leuke groepsnaam, en begin direct met chaten.</p><form action="/addrooms/" method="post">
				<p><strong>Naam:</strong><br /><input type="text" name="roomName" value="" required /></p>
				<p><input type="submit" class="button" name="submit" value="Aanmaken" /></p>
			</form></section>';
		}
	}
	
	function home (){
		include ('db.php');
		
		echo '<header>
			<a href="#" title="Mijn Connecties">Mijn Connecties</a>
			<span class="nav-right"><a href="/home.html" title="Home"><i class="material-icons">home</i></a></span>
			</header>';

		$rooms = mysqli_query($MySQL, "SELECT * FROM `Rooms` WHERE `roomUsers` LIKE '%".$_SESSION['id'].",%'");
		while ($data = mysqli_fetch_assoc($rooms)){
			$users = explode(',', $data['roomUsers']);
			foreach ($users AS $users2){
				if ($users2 = $_SESSION['id']){$oke = 1;}
				else{$oke = 0;}
			}
			
			if ($oke == 1){
				echo '<section class="roomsHome"><p><a href="/chat/'.$data['roomId'].'/#bottum">'.ucwords($data['roomName']).'</a></p></section>';
			}
		}
		echo '<section class="roomsHome"><p><a href="/addrooms/"><i class="material-icons green">add_box</i> Connectie maken</a></p></section>';
	}
	
	function laden (){
		echo '<section>
		<h1>Welkom</h1>
		<p><em><strong>"</strong>Welkom bij de CreatorChat,<br />de Chat APP voor en door YouTube-ers!<strong>"</strong></em></p>
		<p><a href="/home.html" class="button"><strong>Open de APP</strong></a></p>
		<meta http-equiv="refresh" content="5; URL=/home.html">
		</section>';
	}

	function aanmelden (){
		include ('db.php');
		echo '<header>
			<a href="#" title="Connecties Maken">Connecties Maken</a>
			<span class="nav-right"><a href="/home.html" title="Home"><i class="material-icons">home</i></a></span>
		</header>';
		
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
					<p><input type="submit" class="button" name="goToStep3" value="Ja, dit is mijn kanaal" /></p>
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
					`userImg`		= '".mysqli_real_escape_string($MySQL, $_SESSION['picture'])."',
					`userName`		= '".mysqli_real_escape_string($MySQL, $_SESSION['name'])."',
					`userEmail`		= '".mysqli_real_escape_string($MySQL, $_SESSION['email'])."',
					`userDate` 		= NOW(),
					`userLoginIp`	= '".$_SERVER['REMOTE_ADDR']." 