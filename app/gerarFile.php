<?php
	header('Content-type: image/png');
	$im = imagecreatefrompng("../assets/images/panelcloud.png");

	imagealphablending($im, false);
	imagesavealpha($im,true);

	$green = imagecolorallocate($im, 0, 175, 157);
	$red = imagecolorallocate($im, 255, 0, 0);
	$black = imagecolorallocate($im, 0, 0, 0);

	$transparent = imagecolorallocatealpha($im, 0, 0, 0, 127); 

	imagefilledrectangle($im, 0, 0, 300, 1, $transparent );

	$text  = strtoupper(strtr('"'.$_POST['textThink'].'"', "áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
	$newtext = wordwrap($text, 34, "\n");

	$font2 = 'MyriadPro-Regular.ttf';
	$fsize2 = 9;
	$text2 = $_POST['nameFace']." - ".$_POST['locationFace'];
	$text2  = strtoupper(strtr($text2 ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));

	$font = 'MyriadPro-Bold.ttf';
	$font_size = 10;

	imagettftext($im, $font_size, 0, 120, 85 , $green, $font, $newtext);
	imagettftext($im, $fsize2, 0, 150, 200, $green, $font2, $text2);

	imagepng($im, '../covercloud/'.$imagesCloud);
	imagedestroy($im);