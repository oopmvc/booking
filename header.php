<?php

//Facebook Login
//require_once "config.php";

// $redirectURL = "http://localhost/maurizio-barber-shop/fb-callback.php";
//
// $permissions = ['email'];
// $loginURL    = $helper->getLoginUrl($redirectURL, $permissions);

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
    <link rel="stylesheet" href="css/custom.css">

    <!-- CSS calendar -->
    <!-- <link rel="stylesheet" href="assets/style.css"> -->
    <link rel="stylesheet" href="assets/dateTimePicker.css">
    <script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- BEGIN JCalendar -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $(function() {
      $("#datepicker").datepicker();
    });
    </script>
    <!-- END JCalendar -->



    <!-- BEGIN shopping cart -->
    <script>

    $(document).ready(function(){

        //Add Item to Cart
        $(".form-item").submit(function(e) { //user clicks form submit button

            var form_data = $(this).serialize(); //prepare form data for Ajax post
            console.log("form_data: " + form_data);

            var button_content = $(this).find('button[type=submit]'); //get clicked button info
            button_content.html('Aggiungendo...'); //Loading button text //change button text

            $.ajax({ //make ajax request to cart_process.php
                url: "cart_process.php",
                type: "POST",
                dataType: "json", //expect json value from server
                data: form_data
            }).done(function(data) { //on Ajax success

                alert("inizio!'");

                $("#cart-info").html(data.items); //total items count fetch in cart-info element
                button_content.html('Aggiungi al carrello'); //reset button text to original text

                alert("Prodotto aggiunto al carrello!"); //alert user

                if($(".shopping-cart-box").css("display") == "block"){ //if cart box is still visible
                    $(".cart-box").trigger( "click" ); //trigger click to update the cart box.
                }

                alert("Ben fatto!'");

            })
            .fail(function() {
                alert("Errore nell'inserimento del prodotto nel carrello");
            })
            e.preventDefault();
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

        //Show Items in Cart
        $( ".cart-box").click(function(e) { //when user clicks on cart box
            e.preventDefault();
            $(".shopping-cart-box").fadeIn(); //display cart box
            $("#shopping-cart-results").html('<img src="img/ajax-loader.gif">'); //show loading image
            $("#shopping-cart-results" ).load( "cart_process.php", {"load_cart":"1"}); //Make ajax request using jQuery Load() & update results
        });
        $( ".close-shopping-cart-box").click(function(e){ //user click on cart box close link
            e.preventDefault();
            $(".shopping-cart-box").fadeOut(); //close cart-box
        });
    });

    </script>
    <!-- END shopping cart -->



</head>
<body>



<!-- Facebook Login BEGIN -->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId            : '373162053089946',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v3.1'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script type="text/javascript">
    function addResourceCart() {
        var r = document.getElementById("resource").value;
        document.getElementById("resourceCart").innerHTML = r;
    }
</script>
<!-- Facebook Login END -->



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/"><img src="img/logo-maurizio-02.png" alt="logo maurizio barber shop foggia" class="img-fluid" style="max-width:70px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

        </ul>

        <?php
            if(isset($_SESSION['username'])) {
                echo ('
                    <a class="text-white btn btn-sm mr-2" href="member-read.php?username=' . $_SESSION['username'] . '">Ciao ' . $_SESSION['username'] . '</a>' . '
                    <a class="btn btn-sm btn-info my-2 my-sm-0 mr-2" href="dashboard.php">Dashboard</a>
                    <a class="btn btn-sm btn-info my-2 my-sm-0 mr-2" href="logout.php">Esci</a>
                ');
            }

            if(!isset($_SESSION['username'])) {
                echo '
                    <a class="btn btn-sm btn-info my-2 my-sm-0 mr-2" href="login.php">Accedi</a>
                    <a class="btn btn-sm btn-info my-2 my-sm-0 mr-2" href="register.php">Registrati</a>
                ';
            }
        ?>

        <a class="btn btn-sm btn-primary" href="reservation-create.php">Prenota ora</a>
        <a class="btn btn-sm btn-primary ml-2" href="/maurizio-barber-shop">Home</a>
    </div>
</nav>
