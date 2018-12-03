<?php

require_once "Facebook/autoload.php";
$fb = new Facebook\Facebook([
    'app_id' => '373162053089946',
    'app_secret' =>  'df5ba5587f9318af0b20812b50d2cacd',
    'default_graph_version' => 'v3.1',
  ]);


  $helper = $fb->getRedirectLoginHelper();
  

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://booking.mauriziobarbershop.com/fachecklogin.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
 ?>
