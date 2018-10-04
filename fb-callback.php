<?php

    require_once 'config.php';

    try {
        $accessToken = $helper->getAccessToken();
    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
        echo "Response exception: " . $e->getMessage();
        exit;
    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
        echo "SDK Exception: " . $e->getMessage();
        exit;
    }

    if (!$accessToken) {
        header('Location: login.php');
        exit();
    }

    $oAuth2Client = $FB->getOAuth2Client();

    if(!$accessToken->isLongLived()) {
        $accessToken = $oAuth2Client->getLongLivedAccessToken();
    }

    $response = $FB->get("/me?fields=id, first_name, last_name, email", $accessToken);
    $userData = $response->getGraphNode()->asArray();
    $_SESSION['userData'] = $userData;
    $_SESSION['access_token'] = $accessToken;
    header('Location: index.php');
    exit();

?>
