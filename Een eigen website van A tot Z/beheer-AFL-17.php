/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=87yQELp6s_8//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Aflevring 17 - Een eigen website van A tot Z */

<?php
if (isset($_SESSION['login'])){
	$functie = array('filmtoevoegen');
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
			
			echo $_GET['actie'] ();
		}else{
			echo 'Sorry, deze functie is niet gevonden';
		}
	}
}else{
	echo '<h1>Login</h1>';
	
	if (isset($_POST['submit'])){
			$sqlUitlezen = mysqli_query($MySQL, "SELECT * FROM `gebruiker` WHERE `gebruikerEmail` = '".$_POST['User']."' AND `gebruikerWachtwoord` = '".$_POST['Pass']."'");
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