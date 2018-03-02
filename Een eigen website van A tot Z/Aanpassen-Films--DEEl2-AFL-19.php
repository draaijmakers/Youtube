/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=iv0Vm41jFEs//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Films wijzigen / deel 2 - Een eigen website van A tot Z */

<?php<?php
if (isset($_SESSION['login'])){
	$functie = array('filmtoevoegen', 'filmwijzigen');
	if (isset($_GET['actie'])){
		if (in_array($_GET['actie'], $functie)){
			function filmtoevoegen(){
				global $MySQL;
				
				$aanmaken = "INSERT INTO `van_a_tot_z`.`film` SET `filmTitel` = 'Film NEW'";
				if (mysqli_query($MySQL, $aanmaken)){
					echo 'De film is aangemaakt';
				}else{
					echo 'Sorry, '.mysqli_error();
				}
			}
			
			function filmwijzigen(){
				global $MySQL;
				
				if (isset($_GET['filmid'])){
					$wijzigen = mysqli_query($MySQL, "SELECT * FROM `film` WHERE `filmId` = '".$_GET['filmid']."'");
					if (mysqli_num_rows($wijzigen) == 1){
						$data = mysqli_fetch_assoc($wijzigen);
						
						if (isset($_POST['opslaan'])){
							$opslaan = mysqli_query($MySQL, "
								UPDATE 
									`film` 
								
								SET
									`filmTitel` 		= '".mysqli_real_escape_string($MySQL, $_POST['film-titel'])."',
									`filmGenreId` 		= '".mysqli_real_escape_string($MySQL, $_POST['film-genre'])."',
									`filmBeeld` 		= '".mysqli_real_escape_string($MySQL, $_POST['film-beeld'])."',
									`filmVideo` 		= '".mysqli_real_escape_string($MySQL, $_POST['film-video'])."',
									`filmBeoordeling` 	= '".mysqli_real_escape_string($MySQL, $_POST['film-beoordeling'])."',
									`filmJaar` 			= '".mysqli_real_escape_string($MySQL, $_POST['film-jaar'])."',
									`filmInfo` 			= '".mysqli_real_escape_string($MySQL, $_POST['film-info'])."'
									
								WHERE 
									`filmId` = '".mysqli_real_escape_string($MySQL, $_GET['filmid'])."'");
									
							if ($opslaan == true){
								echo 'oke';
							}else{
								echo 'niet oke';
							}
						}

						?>
						<form action="?module=beheer&actie=filmwijzigen&filmid=<?php echo $_GET['filmid'];?>" method="post">
							<p><strong>Titel</strong><br />
							<input type="text" name="film-titel" value="<?php echo $data['filmTitel']; ?>" required="required" /></p>
							
							<p><strong>Genre</strong><br />
							<select name="film-genre" required="required" >
							<?php
								$genreUitlezen = mysqli_query($MySQL, "SELECT * FROM `genre` ORDER BY `genreNaam` ASC");
								if (mysqli_num_rows($genreUitlezen) > 0){
									while($genreData = mysqli_fetch_assoc($genreUitlezen)){
										if ($genreData['genreId'] == $data['filmGenreId']){
											echo '<option value="'.$genreData['genreId'].'" selected="selected">'.ucfirst($genreData['genreNaam']).'</option>';
										}else{
											echo '<option value="'.$genreData['genreId'].'">'.ucfirst($genreData['genreNaam']).'</option>';
										}
									}
								}
							?>
							</select></p>
							
							<p><strong>Afbeelding</strong><br />
							<input type="text" name="film-beeld" value="<?php echo $data['filmBeeld']; ?>" /></p>
							
							<p><strong>Video</strong><br />
							<input type="text" name="film-video" value="<?php echo $data['filmVideo']; ?>" /></p>
							
							<p><strong>Beoordeling</strong> <em>(1 tot 5)</em><br />
							<input type="text" name="film-beoordeling" value="<?php echo $data['filmBeoordeling']; ?>" size="1" required="required" /></p>
							
							<p><strong>Jaar van publicatie</strong><br />
							<input type="text" name="film-jaar" value="<?php echo $data['filmJaar']; ?>" required="required" /></p>
							
							<p><strong>Informatie</strong></br >
							<textarea name="film-info"><?php echo $data['filmInfo']; ?></textarea></p>
							
							<p><input type="submit" name="opslaan" value="opslaan"></p>
						</form>
						<?php
					}else{
						echo 'Deze film bestaat niet.';
					}
				}else{
					echo 'Er is geen film geselecteerd';
				}
			}
			
			echo $_GET['actie'] ();
		}else{
			echo 'Sorry, deze functie is niet gevonden';
		}
	}
}else{
	echo '<h1>Login</h1>';
	
	if (isset($_POST['submit'])){
			$sqlUitlezen = mysqli_query($MySQL, "SELECT * FROM `gebruiker` WHERE `gebruikerEmail` = '".mysqli_real_escape_string($MySQL, $_POST['User'])."' AND `gebruikerWachtwoord` = '".mysqli_real_escape_string($MySQL, $_POST['Pass'])."'");
			$sqlAantal = mysqli_num_rows($sqlUitlezen);
					
			if ($sqlAantal == 1){
				$sqlData = mysqli_fetch_assoc($sqlUitlezen);
				
				$_SESSION['login'] = $sqlData['gebruikerNaam'];
				echo 'Welkom';
			}else{
				echo 'Sorry, deze gevens ken ik niet';
			}
	}
	
	?>
		<form method="post" action="#">
		 <table width="100%" border="0" cellspacing="5" cellpadding="0">
		 <tr>
		  <td width="100">Gebruikersnaam:</td>
		  <td><input type="text" name="User" size="15" required="required" /></td>
		 </tr>
		 <tr>
		  <td>Wachtwoord:</td>
		  <td><input type="password" name="Pass" size="15" required="required" /></td>
		 </tr>
		 <tr>
		  <td>&nbsp;</td>
		  <td><input type="submit" name="submit" value="Login" /></td>
		 </tr>
		</table></form>
	<?php
}
?>