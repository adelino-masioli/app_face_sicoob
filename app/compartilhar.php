<?php 
	require '../facebook-php-sdk-master/src/facebook.php';
	$config = array(
		'appId' => '123456789',
		'secret' => '123456789789',
		'fileUpload' => true,
		'cookie' => true
	);

	$facebook = new Facebook($config);
	$user_id = $facebook->getUser();

	$facebook->setFileUploadSupport(true);
	$access_token = $facebook->getAccessToken();

	if($_POST['idcom'] != "" ){
		$id = $_POST['idcom'];
		error_reporting(0);
		@require("PDOConnectionFactory.php");
		@require('cadastroDAO.php');

		$DAO 	= new cadastroDAO();
		$rows 	= $DAO->Listar("SELECT * FROM  appFace WHERE id = $id LIMIT 1");
		foreach ($rows as $rows){

			$image 				= "imageshare/".$rows['photoShare'];
			$title 				= $rows['textThink']; 
			$url 				= "https://apps.facebook.com/yourapp/";
			$titulocom 			= "NAME ALBUM";
			$caption			= "https://apps.facebook.com/yourapp";

			$args = array(
				'access_token'	=>$access_token,
				'message'   	=> $titulocom,
				'caption'   	=> $caption,
				'picture' 		=> $image,
				'link'			=> $url,
				'description' 	=> $title
			);
			$post_id = $facebook->api("/me/feed", "post", $args);
		}
	 }else{
		  $url 					= "https://apps.facebook.com/yourapp/";
		  $titulocom 			= "NAME ALBUM";
		  $caption				= "https://apps.facebook.com/yourapp";
			
		 $args = array(
		 	'access_token'	=>$access_token,
			'message'   	=> $titulocom,
			'caption'   	=> $caption,
			'picture' 		=> $_POST['image'],
			'link'			=> $url,
			'description' 	=> $_POST['textThink']
		);
		$post_id = $facebook->api("/me/feed", "post", $args);
 }