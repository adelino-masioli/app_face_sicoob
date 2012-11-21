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


      error_reporting(0);
      @require("PDOConnectionFactory.php");
      @require('cadastroDAO.php');
      @require('cadastroModel.php');

      if($_POST['textThink'] == ""){
            echo '<span class="errorsend">Favor informar o pensamento.</span>';
      }else{

            $imagesCloud            = md5("Cloud".time().$_POST['uidFace']).".png";
            $imagesCoverGray        = md5("CoverGray".time().$_POST['uidFace']).".png";
            $imagesCoverBlue        = md5("CoverBlue".time().$_POST['uidFace']).".png";
            $imagesCoverGreen       = md5("CoverGreen".time().$_POST['uidFace']).".png";
            $imagesCoverYellow      = md5("CoverYellow".time().$_POST['uidFace']).".png";
		        $imagesShare     		    = md5("imagesShare".time().$_POST['uidFace']).".png";

            include('gerarFile.php');
            include('gerarFileGray.php');
            include('gerarFileBlue.php');
            include('gerarFileGreen.php');
            include('gerarFileYellow.php');
			      include('gerarFileShare.php');


            $cadastro  = new cadastroModel();
            $cadastro->setPhotoCloud($imagesCloud);
            $cadastro->setPhotoCoverGray($imagesCoverGray);
            $cadastro->setPhotoCoverBlue($imagesCoverBlue);
            $cadastro->setPhotoCoverGreen($imagesCoverGreen);
            $cadastro->setPhotoCoverYellow($imagesCoverYellow);
		        $cadastro->setPhotoShare($imagesShare);
            $cadastro->setTextThink($_POST['textThink']);
            $cadastro->setUserFace($_POST['userFace']);
            $cadastro->setNameface($_POST['nameFace']);
            $cadastro->setUidface($_POST['uidFace']);
            $cadastro->setLocationFace($_POST['locationFace']);
            $cadastro->setStatus(1);
            
            
            $DAO = new CadastroDAO();
            $DAO->Inserir($cadastro);


            $url            = "https://www.facebook.com/Fanpage/yourapp";
            $image          = $imagesShare;
            $titulocom      = "NAME ALBUM";
            $caption		    = "https://apps.facebook.com/yourapp";

            //share  timeline
            $args = array(
              'message'     => $titulocom,
              'caption'     => $caption,
              'picture' 	  => $image,
              'link'        => 'https://apps.facebook.com/yourapp/',
              'description' => $_POST['textThink']
            );
              
            $post_id = $facebook->api("/me/feed", "post", $args);
              
            echo '<span class="sucesssend">Pensamento enviado com sucesso. Aguardando moderação.</span>';
            echo '<script language= "JavaScript"> document.frmpensamento.reset();  </script>';
            echo '<script language= "JavaScript">
            var delay = 2000;
            setTimeout(function(){window.location = "https://urldaappe.com/"; }, delay)
            </script>';
    } 