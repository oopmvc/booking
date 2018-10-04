<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- BEGIN JCalendar -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- END JCalendar -->


    <!-- BEGIN shopping cart -->
    <script>
        var tmpProduct = null;

        function addProductSelection(form) {
            tmpProduct = form;
            jQuery([document.documentElement, document.body]).animate({
                scrollTop: jQuery('#ressroucesSelection').offset().top
            }, 1600)
        }


        /**
         * Add to cart
         *
         */
        function submitProductRequets() {
            //user clicks form submit button
            var form_data = tmpProduct + "&ressource=" + jQuery("#resource").val() +
                "&slotTime=" + jQuery("#timeSlotSelection").val() +
                "&date=" + jQuery('#datepicker').val() +
                "&ressourceName=" + jQuery("#resource option:selected").text();
            // check if all fields are ok
            if (jQuery("#resource").val() === ""
                || jQuery("#timeSlotSelection").val() === ""
                || jQuery("#timeSlotSelection").val() === ""
                || jQuery('#datepicker').val() === "" || !tmpProduct) {
                alert("Please fill all the required fields");
                return false;
            }
            jQuery.ajax({ //make ajax request to cart_process.php
                url: "cart_process.php",
                type: "POST",
                dataType: "html",
                data: form_data,
                success: function (data) { //on Ajax success
                    if(data !== "false")
                    {
                        jQuery("#LastActionOncartResume").html(data)
                        alert('Product add to cart')
                    }
                    else {
                        alert("Can't process request")
                    }
                }
            }).done()
                .fail(function () {
                    alert("Errore nell'inserimento del prodotto nel carrello");
                })
            e.preventDefault();
        }

        /**
         * Find avalable time slot for the selected date | datepicker input
         */
        function fetchDateAvailability() {
            jQuery('#timeSlotSelection').attr("disabled", "disabled")
            var form_data = "checkTimeSlot=true&ressource=" + jQuery("#resource").val()
                + "&date=" + jQuery('#datepicker').val(); //prepare form data for Ajax post
            // check if all fields are ok
            jQuery.ajax({ //make ajax request to cart_process.php
                url: "cart_process.php",
                type: "POST",
                dataType: "json", //expect json value from server
                data: form_data,
                success: function (xhr) {
                    if (xhr !== 0) {
                        unavailableDate = xhr.map(xhr => xhr.start_time);
                        jQuery('#timeSlotSelection option').each(function () {
                            unavailableDate.filter((m) => {
                                if (m === jQuery(this).val())
                                    jQuery(this).addClass("alert alert-danger").attr("disabled", "disabled")
                            })

                        })
                    } else {
                        jQuery('#timeSlotSelection option').each(function () {
                            jQuery(this).removeAttr("disabled").removeClass("alert alert-danger")
                        })
                    }
                    jQuery('#timeSlotSelection').removeAttr("disabled")

                }
            })
        }

        /**
         * Finalise cart and save customer selection as ORDER
         * @constructor
         */
        function SubmitCart() {

            jQuery.ajax({ //make ajax request to cart_process.php
                url: "cart_process.php",
                type: "POST",
                dataType: "json", //expect json value from server
                data: "save_to_db=true",
                success: function (xhr) {
                    if (xhr === true) {
                        alert("Order processed succesfully, \n thank you");
                        window.location.href = "dashboard.php";
                    }
                    else
                        alert("Sorry, can't process you order now \nplease retry later");
                }
            })
        }


        jQuery(document).ready(function () {
            jQuery("#LastActionOncartResume").load("cart_process.php", {"load_cart": "1"});
            jQuery("#datepicker").datepicker({
                minDate: 0,
                dateFormat: 'dd-mm-yy',
                beforeShowDay: function (date) {
                    var day = date.getDay();
                    return [(day != 0 && day != 1)];
                }
            });
            //Add Item to Cart
            jQuery(".form-item").submit(function (e) {
            });

            //Remove items from cart

            // jQuery("#productInCartNames").on('click', '.remove-item', function (e) {
            // });

            //Show Items in Cart
            jQuery(".cart-box").click(function (e) { //when user clicks on cart box
                e.preventDefault();
                jQuery(".shopping-cart-box").fadeIn(); //display cart box
                jQuery("#shopping-cart-results").html('<img src="img/ajax-loader.gif">'); //show loading image
                jQuery("#cartresumer").load("cart_process.php", {"load_cart": "1"}); //Make ajax request using jQuery Load() & update results
            });
            jQuery(".close-shopping-cart-box").click(function (e) { //user click on cart box close link
                e.preventDefault();
                jQuery(".shopping-cart-box").fadeOut(); //close cart-box
            });
        });

        function deleteFromCart($key) {
            event.preventDefault();
            var pcode = $key; //jQuery(this).attr("data-code"); //get product code
            $.ajax({
                url: "cart_process.php",
                type: "GET",
                dataType: "html", //expect json value from server
                data: {"remove_code": pcode},
                success: function (xhr) {

                    jQuery("#LastActionOncartResume").html(xhr); //update Item count in cart-info
                    jQuery(".cart-box").trigger("click"); //trigger click on cart-box to update the items list
                }
            }).done(function (xhr) {

            });
            // jQuery.getJSON("cart_process.php", , function (data) { //get Item count from Server
            //
            // });
        }
    </script>
    <!-- END shopping cart -->


</head>
<body>


<!-- Facebook Login BEGIN -->
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '373162053089946',
            autoLogAppEvents: true,
            xfbml: true,
            version: 'v3.1'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
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
    <a class="navbar-brand" href="/"><img src="img/logo-maurizio-02.png" alt="logo maurizio barber shop foggia"
                                          class="img-fluid" style="max-width:70px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

        </ul>

        <?php
        if (isset($_SESSION['username'])) {
            echo('
                    <a class="text-white btn btn-sm mr-2" href="member-read.php?username=' . $_SESSION['username'] . '">Ciao ' . $_SESSION['username'] . '</a>' . '
                    <a class="btn btn-sm btn-info my-2 my-sm-0 mr-2" href="dashboard.php">Dashboard</a>
                    <a class="btn btn-sm btn-info my-2 my-sm-0 mr-2" href="logout.php">Esci</a>
                ');
        }

        if (!isset($_SESSION['username'])) {
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
