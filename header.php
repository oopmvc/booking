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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- BEGIN shopping cart -->
    <script>
    $(document).ready(function(){

        $(".form-item").submit(function(e) {
            var form_data = $(this).serialize();
            var button_content = $(this).find('button[type=submit]');
            button_content.html('Aggiungendo...'); //Loading button text
            $.ajax({ //make ajax request to cart_process.php
                url: "cart_process.php",
                type: "POST",
                dataType:"json", //expect json value from server
                data: form_data
            }).done(function(data) { //on Ajax success
                $("#cart-info").html(data.items); //total items in cart-info element
                button_content.html('+ Aggiungi'); //reset button text to original text
                alert("Servizio aggiunto!"); //alert user
                if($(".shopping-cart-box").css("display") == "block") { //if cart box is still visible
                    $(".cart-box").trigger( "click" ); //trigger click to update the cart box.
                }
            })
            console.log('Debug on .form-item');
            alert('ciao');
            e.preventDefault();
        });

        //Show Items in Cart
        $( ".cart-box").click(function(e) { //when user clicks on cart box
            e.preventDefault();
            $(".shopping-cart-box").fadeIn(); //display cart box
            $("#shopping-cart-results").html('<img src="images/ajax-loader.gif">'); //show loading image
            $("#shopping-cart-results" ).load( "cart_process.php", {"load_cart":"1"}); //Make ajax request using jQuery Load() & update results
        });

        //Close Cart
        $( ".close-shopping-cart-box").click(function(e){ //user click on cart box close link
            e.preventDefault();
            $(".shopping-cart-box").fadeOut(); //close cart-box
        });

        //Remove items from cart
        $("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
            e.preventDefault();
            var pcode = $(this).attr("data-code"); //get product code
            $(this).parent().fadeOut(); //remove item element from box
            $.getJSON( "cart_process.php", {"remove_code":pcode} , function(data){ //get Item count from Server
                $("#cart-info").html(data.items); //update Item count in cart-info
                $(".cart-box").trigger( "click" ); //trigger click on cart-box to update the items list
            });
        });

    });
    </script>
    <!-- END shopping cart -->

    <!-- BEGIN calendar functions
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
            <!--
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product-management.php">Prodotti</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="resource-management.php">Staff</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reservation-management.php">Prenotazioni</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Prenotazioni
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Crea Prenotazione</a>
                </div>
            </li>
            -->
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <!--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
            <button class="btn btn-sm btn-info my-2 my-sm-0 mr-2" type="submit">Accedi</button>
            <button class="btn btn-sm btn-info my-2 my-sm-0 mr-2" type="submit">Registrati</button>
        </form>
        <a class="btn btn-sm btn-info" href="/maurizio-barber-shop">Torna al sito</a>
    </div>
</nav>
