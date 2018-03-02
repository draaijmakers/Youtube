/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=P-LkSli_nzU//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* DATE() deel 2 - PHP #5 */


<?php
	$tijd = date('G');

	if ($tijd <= 6){
		$groet = 'Goedenacht';
	}elseif ($tijd > 6 && $tijd <= 12){
		$groet = 'Goedemorgen';
	}elseif ($tijd > 12 && $tijd <= 18){
		$groet = 'Goedemiddag';
	}elseif ($tijd > 18 && $tijd <= 23){
		$groet = 'Goedeavond';
	}else{
		$groet = 'Welkom';
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="nl" xml:lang="nl" xmlns="http://www.w3.org/1999/xhtml">
   <head>
	<title>Mijn Eerste webpagina - 2015</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
   </head>

   <body>
	<div class="menu"><a href="#">Link 1</a> - <a href="#">Link 2</a> - <a href="#">Link 3</a></div>
	<div class="banner"><?php echo $groet; ?></div>
	<div class="content">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus, risus a laoreet aliquet, nibh nisi molestie est, sed iaculis erat erat eu quam. Donec elit tellus, consectetur ut augue a, finibus aliquam nunc. Ut nec nisi vitae magna posuere faucibus quis ut libero. Vivamus efficitur quam at velit convallis, sed feugiat urna tempus. Vestibulum nec blandit lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus pellentesque volutpat risus, vel pretium nisl suscipit vel. Aliquam molestie sagittis nulla eget molestie. Curabitur commodo sapien a lacus facilisis rhoncus. Vestibulum feugiat sed diam sed fringilla. Quisque ullamcorper tristique justo, vitae aliquam purus accumsan nec. Aenean rutrum aliquam lorem sed mattis. Suspendisse vel purus in leo congue scelerisque ut eu felis. Aliquam eu dolor libero.</p><p>Nunc feugiat velit eget neque efficitur, sed ultrices urna ultrices. Morbi in odio lorem. Integer rhoncus malesuada nibh ac porta. Sed tincidunt diam et tortor gravida, ut placerat massa vehicula. Morbi ligula magna, molestie et neque at, pellentesque egestas mi. Donec nec quam in dolor ultricies dapibus. Sed augue sapien, mollis et ante non, porta mattis odio. Mauris vestibulum hendrerit ipsum. Maecenas et purus eget erat suscipit viverra ut quis sapien. Aenean dapibus, neque sit amet congue eleifend, est orci eleifend purus, a mollis urna nisl vel nibh. Donec eget augue a tortor dictum rutrum. Etiam molestie enim pharetra dui ultricies, sit amet porttitor sapien consequat.
</p>
	</div>
	<div class="footer">Deze website is gemaakt door: Davey raaijmakers</div>
   </body>
</html>