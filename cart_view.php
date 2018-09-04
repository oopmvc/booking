<?php

if(isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
    $total = 0;
    $cart_box = '<ul class="view-cart">';
    foreach($_SESSION["products"] as $product){ //Print each item, quantity and price.
        $id_product = $product["id_product"];
        $name = $product["name"];
        $quantity = $product["quantity"];
        $price = $product["price"];
        $item_price 	= sprintf("%01.2f",($price * $quantity));  // price x qty = total item price
        $cart_box 	   .= "<li> $id_product &ndash;  $name (Qty : $quantity ) <span> $currency. $item_price </span></li>";
        $subtotal 		= ($price * $quantity); //Multiply item quantity * price
        $total 			= ($total + $subtotal); //Add up to total price
    }

    $grand_total = $total + $shipping_cost; //grand total

    // foreach($taxes as $key => $value){ //list and calculate all taxes in array
    //     $tax_amount 	= round($total * ($value / 100));
    //     $tax_item[$key] = $tax_amount;
    //     $grand_total 	= $grand_total + $tax_amount;
    // }

    // foreach($tax_item as $key => $value){ //taxes List
    //     $list_tax .= $key. ' '. $currency. sprintf("%01.2f", $value).'<br />';
    // }

    // $shipping_cost = ($shipping_cost)?'Shipping Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';

    //Print Shipping, VAT and Total
    $cart_box .= "<li class=\"view-cart-total\">$shipping_cost  $list_tax <hr>Importo : $currency ".sprintf("%01.2f", $grand_total)."</li>";
    $cart_box .= "</ul>";

    echo $cart_box;
} else {
    echo "Il carrello è vuoto";
}

?>
