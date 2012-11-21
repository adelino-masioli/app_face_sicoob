<?php
	$im = imagecreatefrompng("../assets/images/cover/coverappsicoobyellow.png");
	$font = 'MyriadPro-Bold.ttf';
	$fsize = 12;
	$text  = strtoupper(strtr($_POST['textThink'],"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
	$newtext = wordwrap($text, 28, "\n");

	$font2 = 'MyriadPro-Regular.ttf';
	$fsize2 = 10;
	$text2 = $_POST['nameFace']." - ".$_POST['locationFace'];
	$text2  = strtoupper(strtr($text2 ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));

	$textcolor = ImageColorAllocate($im, 0, 175, 157);

	$bg = ImageColorAllocate($im, 255, 255, 255);
	imagettftext($im, $fsize, 0, 387, 105 , $textcolor, $font, $newtext);
	imagettftext($im, $fsize2, 0, 420, 232, $textcolor, $font2, $text2);

	header("Content-type: image/png");

	ImagePNG($im, '../coversquare/'.$imagesCoverYellow);
	imagedestroy($im);