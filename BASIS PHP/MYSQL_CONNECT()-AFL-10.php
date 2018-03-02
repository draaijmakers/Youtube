/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=SzRjkt_Jx-c//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* MYSQL_CONNECT() - PHP #10 LET OP MYSQLI_CONNECT() is beter!! */


<?php
$username    = 'root';
$password    = '';
$host        = 'localhost';
$database    = 'daveyraaijmakers';

if(mysql_connect($host,$username,$password)){
	if(!mysql_select_db($database)){
		echo 'Sorry, ik kon helaas geen verbinding maken met de databasetabel!';
		exit();
	}
}else {
	echo 'Sorry, ik kon helaas geen verbinding maken met de databaseserver!';
	exit();
}

function login (){
	if (isset($_SESSION['login'])){
		echo 'Welkom';
	}else{
		if (isset($_POST['submit'])){
			$db_login = mysql_query("SELECT * FROM `login` WHERE `loginGB` = '".$_POST['userName']."' AND `loginPass` = '".$_POST['userPass']."'");
			if (mysql_num_rows($db_login) == 1){
				echo 'Welkom';
				$_SESSION['login'] = 1;
			}else{
				echo 'Uw gegevens komen niet overeen';
			}
		}

		echo '<form method="post" action="#">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
		<tr><td width="100">Gebruikersnaam:</td><td><input type="text" name="userName" value="" size="15" /></td></tr>
		<tr><td>Wachtwoord:</td><td><input type="password" name="userPass" value="" size="15" /></td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" name="submit" value="Login" /></td></tr>
		</table></form>';
		
	}
}
?>