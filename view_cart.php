<?php
include('includes/connection.php');
setlocale(LC_MONETARY,"it_IT");
include('header.php');
?>



<div class="container mb-4">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="pt-4">Controlla la tua prenotazione</h1>
        </div>
    </div>
    <?php
    if(isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
        $total 			= 0;
        $list_tax 		= '';
        $cart_box 		= '<ul class="view-cart">';
        foreach($_SESSION["products"] as $product){ //Print each item, quantity and price.
            $product_name   = $product["product_name"];
            $product_qty    = $product["product_qty"];
            $product_price  = $product["product_price"];
            $product_code   = $product["product_code"];

            $item_price 	= sprintf("%01.2f",($product_price * $product_qty));  // price x qty = total item price

            $cart_box 		.=  "<li> $product_code &ndash;  $product_name (Qty : $product_qty) <span> $currency. $item_price </span></li>";

            $subtotal 		= ($product_price * $product_qty); //Multiply item quantity * price
            $total 			= ($total + $subtotal); //Add up to total price
        }

        $grand_total = $total + $shipping_cost; //grand total

        foreach($taxes as $key => $value){ //list and calculate all taxes in array
            $tax_amount 	= round($total * ($value / 100));
            $tax_item[$key] = $tax_amount;
            $grand_total 	= $grand_total + $tax_amount;
        }

        foreach($tax_item as $key => $value){ //taxes List
            $list_tax .= $key. ' '. $currency. sprintf("%01.2f", $value).'<br />';
        }

        $shipping_cost = ($shipping_cost)?'Shipping Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';

        //Print Shipping, VAT and Total
        $cart_box .= "<li class=\"view-cart-total\">$shipping_cost  $list_tax <hr>Payable Amount : $currency ".sprintf("%01.2f", $grand_total)."</li>";
        $cart_box .= "</ul>";

        echo $cart_box;

    } else {
        echo '<p class="lead">Il tuo carrello è vuoto!</p>';
        echo '<a class="btn btn-lg btn-block btn-primary mb-4" href="index.php">Torna indietro</a>';
    }
    ?>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <?php





                // do not work - test it ------------------------------------------------------------------------------------------

                if(isset($_SESSION['username']) && count($_SESSION['products']) > 0) {
                    echo('<a class="btn btn-lg btn-block btn-danger mr-2" href="#">Prenota</a>');
                }

                if(!isset($_SESSION['username'])) {
                    echo '
                        <a class="btn btn-sm btn-primary my-2 my-sm-0 mr-2" href="login.php">Accedi</a>
                        <a class="btn btn-sm btn-primary my-2 my-sm-0 mr-2" href="register.php">Registrati</a>
                    ';
                }
            ?>
        </div>
    </div>
</div>



<?php include('footer.php'); ?>