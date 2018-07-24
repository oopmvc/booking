<?php

require_once "config.php";

$redirectURL = "http://localhost/maurizio-barber-shop/Facebook/fb-callback.php";
$permissions = ['email'];
$loginURL    = $helper->getLoginUrl($redirectURL, $permissions);

?>

<!doctype html>
<html lang="it">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '373162053089946',
            cookie     : true,
            xfbml      : true,
            version    : 'v3.0'
        });

        FB.AppEvents.logPageView();

    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
