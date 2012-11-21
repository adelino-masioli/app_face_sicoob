<?php 
  require 'facebook-php-sdk-master/src/facebook.php';
  $config = array(
  'appId' => '123456',
  'secret' => '123456789',
  'fileUpload' => true
  'cookie' => true
);

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();

  $facebook->setFileUploadSupport(true);
  $access_token = $facebook->getAccessToken();

  $post_data = array(
    'message' => 'Mural do Pensar Diferente.',
    'source' => '@' . realpath($_POST['txtcover']),
  );

echo '
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Mural do Pensar Diferente</title>
  <link rel="stylesheet" type="text/css" media="all" href="assets/css/style.css" />
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery.limit-1.2.source.js"></script>
  <script src="assets/js/jquery.featureCarousel.js"></script>
  <script src="assets/js/jquery.popupWindow.js"></script>
  <script src="assets/js/jquery.default.js"></script>

  </head>
  <body>
';
    if($user_id) {
    try {
      @require("app/PDOConnectionFactory.php");
      @require('app/cadastroDAO.php');
      $user_profile = $facebook->api('/me','GET');

      $fql = 'SELECT uid, name, username,  first_name,current_location from user where uid = ' . $user_id;
      $ret_obj = $facebook->api(array(
        'method' => 'fql.query',
        'query' => $fql,
      ));

      } catch(FacebookApiException $e) {
        $login_url = $facebook->getLoginUrl(); 
        error_log($e->getType());
        error_log($e->getMessage());
      }   

      //publish cover
		  if(isset($_POST['txtcover'])){
				$uploadPhoto = $facebook->api('/me/photos', 'post', $post_data );
        echo '<script language= "JavaScript">
        window.top.location.href="http://www.facebook.com/profile.php?preview_cover='.$uploadPhoto["id"].'";
        </script>';
			 }
			 //publish on timeline
			if($acao == "publish"){
					if($_POST['idcom'] != "" ){
						$id = $_POST['idcom'];            
            $DAO = new cadastroDAO();
              $rows = $DAO->Listar("SELECT * FROM  app14112012 WHERE id = $id LIMIT 1");
              foreach ($rows as $rows){
              $image = "imageshare/".$rows['photoShare'];						
              $post_data = array(
                'message' => 'Name post',
                'source' => '@' . realpath($image)
              );
            $uploadPhoto = $facebook->api('/me/photos', 'post', $post_data );
            }
					}else{
						$post_data = array(
							'message' => 'Mural do Pensar Diferente.',
							'source' => '@' . realpath($_POST['image'])
							);
							$uploadPhoto = $facebook->api('/me/photos', 'post', $post_data );
					}
				 
		     }
?>
<div class="cloudtop"></div>
  <div class="wrapper">
      <div class="container"><!--begin container!-->
        <div class="header"></div><!--header!-->
            <div class="panelcloud">
              <div class="feature-carousel-container">
                <div class="carousel-container">
                  <div id="carousel">
<?php
    $DAO = new cadastroDAO();
      $rows = $DAO->Listar("SELECT * FROM  app14112012 WHERE status = 2  ORDER BY id DESC LIMIT 3");
      $rows->execute();
      $rowCounts = $rows->rowCount();
      if($rowCounts > 0){
      foreach ($rows as $rows){
?>
                    <div class="carousel-feature" id="<?php echo $rows['id']; ?>"><a href="#">
                        <img class="carousel-image" id="babk" src="assets/images/panelcloud.png" alt=""/></a>
                      <img class="carousel-image" src="covercloud/<?php echo $rows['photoCloud']; ?>" alt=""/></a>
                    </div>       
<?php } } ?>
                </div>
              </div>
            </div>

          <div class="controllerplay">
            <div id="prev" title="Voltar"></div>
            <div id="pause" title="Pausar"></div>
            <div id="next" title="Avançar"></div>
            <div id="curtir"><a href="javascript: void(0)" title="Curtir"></a></div>    
<?php
      //WHERE uidFace = $user_id
      $DAO = new cadastroDAO();
        $rowComp = $DAO->Listar("SELECT * FROM  appFace WHERE uidFace = $user_id   ORDER BY id DESC LIMIT 1");
        $rowComp->execute();
        $rowCountss = $rowComp->rowCount();
      if($rowCount != 0){
        $DAO = new cadastroDAO();
        $rowCompss = $DAO->Listar("SELECT * FROM  appFace WHERE uidFace = $user_id   ORDER BY id DESC LIMIT 1");
      }else{
        $DAO = new cadastroDAO();
        $rowCompss = $DAO->Listar("SELECT * FROM  appFace ORDER BY id DESC LIMIT 1");
      }
      foreach ($rowCompss as $rowCompss){
        $image = "imageshare/".$rowCompss['photoShare'];
        $title = $rowCompss['textThink']; 
?>	
<input type="hidden" name="caption" id="caption" value="<?php echo $title; ?>"/>
<input type="hidden" name="picture" id="picture" value="<?php echo $image; ?>"/>
<input type="hidden" name="idcom" id="idcom" value=""/>
<div id="compartilhar"><a class="compar" href="https://www.facebook.com/<?php echo $ret_obj[0]['username']; ?>" target="_blank"  title="Compartilhar"></a></div>         
<?php }?>
         </div>
        </div>
         <div class="center">
          <form action="" method="post" name="frmpensamento" id="frmpensamento">
              <textarea name="txtpensamento" id="txtpensamento"></textarea>
                <div class="limit"><span id="charsLeft"></span> Caracteres</div>
                <input type="hidden" name="userFace" id="userFace" value="<?php echo $ret_obj[0]['name']; ?>"/>
                <input type="hidden" name="nameFace" id="nameFace" value="<?php echo $ret_obj[0]['first_name']; ?>"/>
                <input type="hidden" name="uidFace" id="uidFace" value="<?php echo $user_id; ?>"/>
                <input type="hidden" name="locationFace" id="locationFace" value="<?php echo $ret_obj[0]['current_location']['name']; ?>"/>
                <input type="button" name="btnenviar" id="btnenviar" value=""/>
                <div id="msgerro"></div>
                <?php if(isset($_GET['res'])){  ?>
                    <div id="msgerros">Pensamento enviado com sucesso. Aguardando moderação.</div>
                <?php } ?>
            </form>
         </div><!--center!-->
         <div class="footer">
          <div class="contentfooter">
            <div id="covers">
<?php
    $DAO = new cadastroDAO();
    $rowss = $DAO->Listar("SELECT * FROM  app14112012 WHERE uidFace = $user_id ORDER BY id DESC LIMIT 1");
    $rowss->execute();
    $rowCount = $rowss->rowCount();
    if($rowCount == 0){
      $DAO = new cadastroDAO();
        $row = $DAO->Listar("SELECT * FROM  app14112012 ORDER BY id DESC LIMIT 1");
    }else{
      $DAO = new cadastroDAO();
        $row = $DAO->Listar("SELECT * FROM  app14112012 WHERE uidFace = $user_id ORDER BY id DESC LIMIT 1");
    }
        foreach ($row as $row){
?>              <ul>
                  <li class="ocut" id="cvbtgray"><img src="coversquare/<?php echo $row['photoCoverGray']; ?>" width="512" /></li>
                    <li class="ocut" id="cvbtblue"><img src="coversquare/<?php echo $row['photoCoverBlue']; ?>" width="512" /></li>
                    <li class="ocut" id="cvbtgreen"><img src="coversquare/<?php echo $row['photoCoverGreen']; ?>" width="512" /></li>
                    <li class="ocut" id="cvbtyellow"><img src="coversquare/<?php echo $row['photoCoverYellow']; ?>" width="512" /></li>
                </ul>                        
            </div>

            <div id="avatar"></div>
            <div class="controller">
              <ul>
                  <li class="selectcolor" id="btgray/<?php echo $row['photoCoverGray']; ?>"></li>
                    <li class="selectcolor" id="btblue/<?php echo $row['photoCoverBlue']; ?>"></li>
                    <li class="selectcolor" id="btgreen/<?php echo $row['photoCoverGreen']; ?>"></li>
                    <li class="selectcolor" id="btyellow/<?php echo $row['photoCoverYellow']; ?>"></li>                    
                </ul>
            </div>
            <form method="post" action="" id="frmpostface" name="frmpostface">
              <input type="hidden" name="txtcover" id="txtcover" value="coversquare/<?php echo $row['photoCoverGray']; ?>"/>
                <input type="submit" name="btnenviarparacover" id="btnenviarparacover" value=""/>
            </form>

<?php } ?>
            </div>
         </div><!--footer!-->
        </div><!--end container!-->
    </div>
<div class="barfooter"></div>

<?php
    } else {
$canvas_url = 'https://urldoapp/facebook/redirect.php';
$loginperm = 'email,publish_stream, user_online_presence, offline_access, user_photos, user_birthday, user_location, user_work_history, user_about_me, user_hometown, read_stream';

$login_url = $facebook->getLoginUrl(array(
		'canvas' => 1,
		'fbconnect' => 0,
		'next' => $canvas_url, 
		'redirect_uri' => $canvas_url,
		'cancel_url' => $canvas_url,
		'req_perms' => $loginperm,
		'scope' => 'read_stream, friends_likes, publish_actions,'.$loginperm
));
		  
    echo '<script language= "JavaScript">
    window.top.location.href="'.$login_url.'";
    </script>';
        }
?>
</body>
</html>