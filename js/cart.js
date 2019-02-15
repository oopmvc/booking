var tmpProduct = null;

function addProductSelection(form) {
    tmpProduct = form;
    jQuery([document.documentElement, document.body]).animate({
        scrollTop: jQuery('#resourcesSelection').offset().top
    }, 1600)
}


/**
* Add to cart
*
*/
function submitProductRequest() {
    // get selected options
    tableObject = [];
    selectedOptions =
    [...document.querySelectorAll("form[name='reservation-form'] select")].filter(item => item.value !== "");
    selectedOptions.forEach(
        item => {
            tableObject.push({
                "product_id": item.getAttribute("data-value"),
                "qty": item.value,
                "name": item.getAttribute("data-name"),
                "price": item.getAttribute("data-price")
            })
        }
    )
    //user clicks form submit button
    var form_data = "products_selection=" + JSON.stringify(tableObject) + "&resource=" + jQuery("#resource").val() +
    "&slotTime=" + jQuery("#timeSlotSelection").val() +
    "&datepicker=" + jQuery('#datepicker').val() +
    "&resourceName=" + jQuery("#resource option:selected").text();
    console.log(tableObject)

    // check if all fields are ok
    if (jQuery("#resource").val() === "" ||
        jQuery("#timeSlotSelection").val() === "" ||
        jQuery('#datepicker').val() === "" ||
        selectedOptions.length === 0) {
            alert("Tutti i campi sono obbligatori!");
            return false;
        }
        jQuery.ajax({ //make ajax request to cart_process.php
            url: "cart_process.php",
            type: "POST",
            dataType: "html",
            data: form_data,
            success: function (data) { //on Ajax success
                if (data !== "false") {
                    jQuery("#LastActionOncartResume").html(data)
                    alert('Servizio aggiunto al carrello')
                    window.location.href = "/view_cart.php";
                } else {
                    alert("Impossibile continuare con la richiesta")
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
        var form_data = "checkTimeSlot=true&resource=" + jQuery("#resource").val()
        + "&datepicker=" + jQuery('#datepicker').val(); //prepare form data for Ajax post
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
        console.log(xhr);
        console.log("controllo disponibilità risorsa effettuato!");
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
                    alert("Prenotazione eseguita con successo!, \n grazie!");
                    window.location.href = "dashboard.php";
                } else
                alert("Spiacente, prenotazione non accettata \nper favore riprova.");
            }
        })
    }

    function handleTimeSlot (){
        console.log("page ready")
        if([...document.querySelectorAll('#timeSlotSelection')].length > 0 ){
            var date = new Date();
            [...document.querySelectorAll('#timeSlotSelection option')].forEach(item =>
                {
                    var a = item.value
                    if(Date.parse('01/01/2011 '+ date.getHours()+":"+date.getMinutes() + ":"+date.getSeconds())
                    > Date.parse('01/01/2011 '+ a)) {
                        item.disabled = true ;}})}};

                        jQuery(document).ready(function () {

                            handleTimeSlot();
                            jQuery("#LastActionOncartResume").load("cart_process.php", {"load_cart": "1"});
                            jQuery("#datepicker").datepicker({
                                minDate: 0,
                                dateFormat: 'dd-mm-yy',
                                closeText: 'Chiudi',
                                prevText: 'Prec',
                                nextText: 'Succ',
                                currentText: 'Oggi',
                                monthNames: ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno', 'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
                                monthNamesShort: ['Gen','Feb','Mar','Apr','Mag','Giu', 'Lug','Ago','Set','Ott','Nov','Dic'],
                                dayNames: ['Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato'],
                                dayNamesShort: ['Dom','Lun','Mar','Mer','Gio','Ven','Sab'],
                                dayNamesMin: ['D','L','M','M','G','V','S'],
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

                        function getOrderDetails(order_id, customer_name, resource_name) {

                            if (order_id === false)
                            return;
                            $.ajax({
                                url: "cart_process.php",
                                type: "POST",
                                data: {"order_id": order_id, "customer_name": customer_name, "resource_name": resource_name},
                                success: function (data) {
                                    var html = "";
                                    html += "<div><strong>Prodotti:</strong></div>";
                                    html += "<ul>";
                                    JSON.parse(data).forEach(item => {
                                        if(item.product_quantity > 0) {
                                            html += "<li>" +  item.name + " : " + item.product_quantity +  "</li>";
                                        }
                                    });
                                    html += "</ul>";

                                    $("#modalBodyContainer").html(html);
                                    $(".modal").modal();
                                }
                            });

                        }

                        function addResourceCart() {
                            var r = document.getElementById("resource").value;
                            document.getElementById("resourceCart").innerHTML = r;
                        }
