<?php
include('includes/connection.php');
setlocale(LC_MONETARY,"it_IT");
include('header.php');
?>

<div id="wrapper">

    <div id="content-wrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-2">

                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Carrello</li>
                    </ol>

                    <?php
                    if(isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
                        $total          = 0;
                        $list_tax 		= '';
                        $cart_box 		= '<ul class="view-cart">';
                        foreach($_SESSION["products"] as $product){ //Print each item, quantity and price.
                            $product_name   = $product["product_name"];
                            $product_qty    = $product["product_qty"];
                            $product_price  = $product["product_price"];
                            // $product_code   = $product["product_code"];

                            $item_price 	= sprintf("%01.2f",($product_price * $product_qty));  // price x qty = total item price

                            $cart_box 		.=  "<li>  $product_name x$product_qty <span> $item_price  &euro;</span></li>";

                            $subtotal 		= ($product_price * $product_qty); //Multiply item quantity * price
                            $total 			= ($total + $subtotal); //Add up to total price
                        }
                        $grand_total = $total ; //grand total

                        // foreach($taxes as $key => $value){ //list and calculate all taxes in array
                        //  $tax_amount 	= round($total * ($value / 100));
                        //  $tax_item[$key] = $tax_amount;
                        //  $grand_total 	= $grand_total + $tax_amount;
                        // }

                        // foreach($tax_item as $key => $value){ //taxes List
                        //  $list_tax .= $key. ' '. $currency. sprintf("%01.2f", $value).'<br />';
                        // }

                        // $shipping_cost = ($shipping_cost)?'Shipping Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';

                        //Print Shipping, VAT and Total
                        $cart_box .= "<li class=\"view-cart-total\"> <br><strong>Totale: ".sprintf("%01.2f", $grand_total). " &euro;</strong></li>";
                        $cart_box .= "</ul>";

                        echo $cart_box;

                    } else {
                        echo '<p class="lead">Il tuo carrello è vuoto!</p>';
                        echo '<a class="btn btn-lg btn-block btn-danger mb-4" href="index.php">Torna indietro</a>';
                    }


                    // do not work - test it ------------------------------------------------------------------------------------------

                    if(isset($_SESSION['username']) && count($_SESSION['products']) > 0) {
                        echo('<a class="btn btn-block btn-danger mr-2" onclick="SubmitCart()" href="#">Prenota</a>');
                    }

                    if(!isset($_SESSION['username'])) {
                        echo '
                            <a class="btn btn btn-primary my-2 my-sm-0 mr-2" href="login.php">Accedi</a>
                            <a class="btn btn btn-primary my-2 my-sm-0 mr-2" href="register.php">Registrati</a>
                        ';
                    }
                    ?>

                </div><!-- END col -->

            </div> <!-- END row -->

        </div><!-- END container-fluid -->

    </div><!-- END content-wrapper -->

</div><!-- END wrapper -->

<?php include('footer.php'); ?>
