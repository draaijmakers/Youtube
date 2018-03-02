/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=JKOy8TiYLy4//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Een loginpagina maken - Een eigen website van A tot Z */

<?php
include('db.php');

if (isset($_SEESION['login'])){
	echo 'Welkom';
}else{
	echo 'Login';
	
	if (isset($_POST['submit'])){
			$sqlUitlezen = mysqli_query($MySQL, "SELECT * FROM `gebruiker` WHERE `gebruikerEmail` = '".$_POST['User']."' AND `gebruikerWachtwoord` = '".$_POST['Pass']."'");
			$sqlAantal = mysqli_num_rows($sqlUitlezen);
					
			if ($sqlAantal == 1){
				$sqlData = mysqli_fetch_assoc($sqlUitlezen);
				
				$_SEESION['login'] = $sqlData['gebruikerNaam'];
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