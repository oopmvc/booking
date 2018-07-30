<?php

require_once "config.php";

$redirectURL = "http://localhost/maurizio-barber-shop/Facebook/fb-callback.php";
$permissions = ['email'];
$loginURL    = $helper->getLoginUrl($redirectURL, $permissions);

?>

<!doctype html>
<html lang="it">
<head>
    <title>Prenotazione - Maurizio Barber Shop</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
    integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <!-- BEGIN calendar functions-->
    <link href='fullcalendar-3.9.0/fullcalendar.css' rel='stylesheet' />
    <link href='fullcalendar-3.9.0/scheduler.css' rel='stylesheet' />
    <script src='fullcalendar-3.9.0/moment.js'></script>
    <script src='fullcalendar-3.9.0/jquery.js'></script>
    <script src='fullcalendar-3.9.0/fullcalendar.js'></script>
    <script src='fullcalendar-3.9.0/scheduler.js'></script>
    <!-- END calendar functions -->
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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/"><img src="img/logo-maurizio-02.png" alt="logo maurizio barber shop foggia" class="img-fluid" style="max-width:70px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Prodotti
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="product-management.php">Gestione Prodotti</a>
                    <a class="dropdown-item" href="product-create.php">Crea Prodotto</a>
                    <a class="dropdown-item" href="product-update.php">Modifica Prodotto</a>
                    <a class="dropdown-item" href="product-delete.php">Elimina Prodotto</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Prenotazioni
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Crea Prenotazione</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <!--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
            <button class="btn btn-sm btn-info my-2 my-sm-0 mr-2" type="submit">Accedi</button>
            <button class="btn btn-sm btn-info my-2 my-sm-0 mr-2" type="submit">Registrati</button>
        </form>
    </div>
</nav>
