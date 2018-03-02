/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=UEBAIUHa1CY//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* Twitter verwerken in onze APP - PHP APP maken #5 */

<?php
$actie = array("home", "overmij", "videos", "tweets");

function home (){
	echo '<p><strong>Welkom op de Gio APP!</strong></p>';
	echo '<center><iframe style="width: 100%; height: 100%;" src="https://www.youtube-nocookie.com/embed/yk7U2w4tN84?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></center>';
	echo '<p>Ik ben Giovanni en ik probeer het publiek op YouTube te entertainen met video\'s! Al mijn video\'s zijn in 1080p, dat betekent dus HD! Ik upload video\'s als Sims 4, maar vooral verhalen over levensgebeurtenissen, vlogs en allerlei challenges en random dingen. Ik upload ook veel video\'s met mijn familie, want dat word altijd goed ontvangen. Op mijn kanaal upload ik ook met veel vrienden zoals Ties , Joey van JoeyCraig, Shaquille van SJAAK, Maarten van Mjearten en meer!</p>';
	echo '<center><a class="twitter-follow-button" href="https://twitter.com/GameplayWorldXL">Twitter van: @GameplayWorldXL</a></center>';
}

function overmij (){
	echo '<p><strong>Welkom op de Gio APP!</strong></p>
	<p>Ik ben Giovanni - beter bekend als Gio - ik ben 17 jaar oud en ik maak video\'s op Youtube.<br />
	Dit is een gezellig Nederlands kanaal! Alles word geüpload in minstens 1080p HD! Er wordt veel geüpload met vrienden, die je in mijn subbox kan vinden. Dit uploaden doe ik met plezier!</p>
	<p>Vind jij mijn video\'s leuk? Laat dan zeker een blauw duimpje achter en vergeet niet te abonneren!</p>';
}

function videos (){
	$url = 'https://www.youtube.com/user/GameplayWorldXL/videos';

	$html = file_get_contents($url);
	$doc = new DOMDocument();
	$doc->loadHTML($html);
	
	$xpath = new DOMXpath($doc);
	$links = $xpath->query('//a[starts-with(@href, "/watch")]');

	$count = 0;
	foreach ($links AS $youtubedata){
		if ($count < 10){
			if (!empty($youtubedata->getAttribute('title'))){
				$videocode = explode('/watch?v=',$youtubedata->getAttribute('href'));
				echo '<a href="https://m.youtube.com/watch?v='.$videocode[1].'" target="_blank" title="Bekijk via YouTube: '.$youtubedata->getAttribute('title').'"><img alt="'.$youtubedata->getAttribute('title').'" class="video" width="196" src="https://i.ytimg.com/vi/'.$videocode[1].'/mqdefault.jpg"></a>';	
				$count = $count+1;
			}
		}
	}
	echo '<p><center><a href="https://m.youtube.com/user/GameplayWorldXL/videos">Meer video\'s zien?</a></center></p>';
}

function tweets (){
	echo '<p><center><a href="https://twitter.com/intent/tweet?screen_name=GameplayWorldXL" class="twitter-mention-button">Stuur een Tweet naar: @GameplayWorldXL</a></center></p>';
	echo '<a class="twitter-timeline" data-tweet-limit="10" data-chrome="noborders noheader noscrollbar transparent" data-lang="nl" href="https://twitter.com/GameplayWorldXL">Twitter van GameplayWorldXL</a>';
}

if (isset($_GET['actie']) && (in_array($_GET['actie'], $actie))){
	echo $_GET['actie']();
}else{
	echo home();
}
?>




















