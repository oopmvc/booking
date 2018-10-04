<?php

include_once('includes/connection.php'); //include config file
setlocale(LC_MONETARY, "it_IT"); // IT national format (see : http://php.net/money_format)
/**
 * Check for time slot availability
 */
if (isset($_POST['checkTimeSlot'])) {
    $formattedDate = date('Y-m-d', strtotime($_POST['date']));
    $sql = "SELECT start_time FROM orders WHERE order_date = :order_dateValue AND resource = :ressource";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(":order_dateValue", $_POST['date']);
    $statement->bindParam(":ressource", $_POST['ressource']);


    $statement->execute();
    $statement->rowCount();
    $statement->rowCount();
    if ($statement->rowCount() > 0)
        echo json_encode($statement->fetchAll());
    else  echo 0;
}

/** add products to session */
if (isset($_POST['id_product'])) {
//    check if date is available
    foreach ($_POST as $key => $value) {
        $new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING); //create a new product array
    }
    // we need to get product name and price from database
    $sql = 'SELECT name, price FROM products WHERE id_product=:s LIMIT 1';
    $statement = $pdo->prepare($sql);
    $statement->execute(array('s' => $new_product['id_product']));

    while ($product = $statement->fetch()) {
        $new_product['product_name'] = $product['name']; //fetch product name from database
        $new_product['product_price'] = $product['price'];  //fetch product price from database
        $new_product['product_qty'] = $_POST['quantity'];  //fetch product price from database
        $new_product['ressource'] = $_POST['ressource'];  //fetch product price from database
//        $new_product['ressource_name'] =      $_POST['ressourceName'];  //fetch product price from database
        $new_product['date'] = $_POST['date'];  //fetch product price from database
        $new_product['slotTime'] = $_POST['slotTime'];  //fetch product price from database
        if (isset($_SESSION['products'])) {  //if session var already exist
            if (isset($_SESSION['products'][$new_product['id_product']])) { //check item exist in products array
                unset($_SESSION['products'][$new_product['id_product']]); //unset old item
            }
        }
        /**
         * store information for order : customer / starttime / ressource /  order_date
         * This data will be saved to order table
         * Information about the order details will be stored
         * inside orders_details table
         */
        if (isset($_SESSION["order_details"])) {
            unset($_SESSION["order_details"]);
        }
        $_SESSION["order_details"] = array(
            "customer" => isset($_SESSION["memberID"]) ? $_SESSION["memberID"] : "",
            "ressource" => $_POST['ressource'],
            "date" => $_POST['date'],
            "slotTime" => $_POST['slotTime'],
        );
        $_SESSION['products'][$new_product['id_product']] = $new_product; //update products with new item array
    }
    $total_items = count($_SESSION['products']); //count total items
    if ($total_items > 0) {
        die(GenerateCartView()); //output json
    } else {
        die("false"); //output json
    }
}

function GenerateCartView()
{
    if (isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
        ?>
        <li class="list-group-item d-block justify-content-between lh-condensed">
            <strong>Cosa : </strong>
            <div class="shopping-cart-boxC">
                <div id="productInCartNames">
                    <ul>
                        <?php
                        if (isset($_SESSION['products'])):
                            foreach ($_SESSION['products'] as $key => $product): ?>
                                <li class="d-flex">
                                        <span>
                                            <?php echo $product["product_name"] ?>
                                        </span>
                                    <span>
                                            (Qty:<?php echo $product["product_qty"] ?>)
                                        </span>
                                    <a href="#" class="remove-item" data-code="<?php echo $key ?>"
                                       onclick="deleteFromCart(<?php echo $key ?>)">&times;</a>

                                </li>
                            <?php endforeach;
                        endif;
                        ?>
                    </ul>
                </div>

        </li>
        <li class="list-group-item d-flex justify-content-between">
            <strong>Con chi </strong>
            <span id="who">
                     <?php
                     if (isset($_SESSION['products'])):
                         $i = 0;
                         foreach ($_SESSION['products'] as $product):
                             if ($i > 0)
                                 break;
                             ?>
                             <?php echo $product["ressourceName"] ?>
                             <?php
                             $i++;
                         endforeach;
                     endif;
                     ?>
                </span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
            <strong>Quando</strong>
            <span id="when">
                        <?php
                        if (isset($_SESSION['products'])):

                            $i = 0;
                            foreach ($_SESSION['products'] as $product):
                                if ($i > 0)
                                    break;
                                ?>
                                <?php echo $product["slotTime"] ?>
                                <?php
                                $i++;
                            endforeach;
                        endif;
                        ?>
                    </span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
            <span><strong>Totale</strong></span>
            <span id="cartTotal">
                         <?php
                         if (isset($_SESSION['products'])):

                             $total = 0;
                             foreach ($_SESSION['products'] as $product):
                                 $total += $product['product_price'] * $product['product_qty']; ?>
                             <?php
                             endforeach;
                             echo $total . " &euro;"; endif;
                         ?>
            </span>
        </li>

        <?php
    } else {
        die("Carrello è vuoto!"); //we have empty cart
    }
}

/** list products in cart */
if (isset($_POST["load_cart"]) && $_POST["load_cart"] == 1) {

    if (isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
        ?>
        <ul class="list-group mb-3" id="LastActionOncartResume">

            <li class="list-group-item d-block justify-content-between lh-condensed">
                <strong>Cosa : </strong>
                <div class="shopping-cart-boxC">
                    <div id="productInCartNames">
                        <ul>
                            <?php
                            if (isset($_SESSION['products'])):
                                foreach ($_SESSION['products'] as $key => $product): ?>
                                    <li class="d-flex">
                                        <span>
                                        <?php echo $product["product_name"] ?>
                                        </span>
                                        <span>
                                        (Qty:<?php echo $product["product_qty"] ?>)
                                        </span>

                                        <a href="#" class="remove-item" data-code="<?php echo $key ?>"
                                           onclick="deleteFromCart(<?php echo $key ?>)">&times;</a>

                                    </li>
                                <?php endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>
            </li>

            <li class="list-group-item d-flex justify-content-between">
                <strong>Con chi </strong>
                <span id="who">
                     <?php
                     if (isset($_SESSION['products'])):
                         $i = 0;
                         foreach ($_SESSION['products'] as $product):
                             if ($i > 0)
                                 break;
                             ?>
                             <?php echo $product["ressourceName"] ?>
                             <?php
                             $i++;
                         endforeach;
                     endif;
                     ?>
                </span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
                <strong>Quando</strong>
                <span id="when">
                        <?php
                        if (isset($_SESSION['products'])):

                            $i = 0;
                            foreach ($_SESSION['products'] as $product):
                                if ($i > 0)
                                    break;
                                ?>
                                <?php echo $product["slotTime"] ?>
                                <?php
                                $i++;
                            endforeach;
                        endif;
                        ?>
                    </span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
                <span><strong>Totale</strong></span>
                <span id="cartTotal">
                         <?php
                         if (isset($_SESSION['products'])):

                             $total = 0;
                             foreach ($_SESSION['products'] as $product):
                                 $total += $product['product_price'] * $product['product_qty']; ?>
                             <?php
                             endforeach;
                             echo $total . " &euro;"; endif;
                         ?>
                    </span>
            </li>

        </ul>
        <?php
    } else {
        die("Carrello è vuoto!"); //we have empty cart
    }
}


/** remove item from shopping cart */
if (isset($_GET["remove_code"]) && isset($_SESSION["products"])) {

    $id_product = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING); //get the product code to remove

    if (isset($_SESSION["products"][$id_product])) {
        unset($_SESSION["products"][$id_product]);
    }

    $total_items = count($_SESSION["products"]);
    if (isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {

        ?>
        <ul class="list-group mb-3" id="LastActionOncartResume">

            <li class="list-group-item d-block justify-content-between lh-condensed">
                <strong>Cosa : </strong>
                <div class="shopping-cart-boxC">
                    <div id="productInCartNames">
                        <ul>
                            <?php
                            if (isset($_SESSION['products'])):
                                foreach ($_SESSION['products'] as $key => $product): ?>
                                    <li class="d-flex">
                                        <span>
                                        <?php echo $product["product_name"] ?>
                                        </span>
                                        <span>
                                        (Qty:<?php echo $product["product_qty"] ?>)
                                        </span>

                                        <a href="#" class="remove-item" data-code="<?php echo $key ?>"
                                           onclick="deleteFromCart(<?php echo $key ?>)">&times;</a>

                                    </li>
                                <?php endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>
            </li>

            <li class="list-group-item d-flex justify-content-between">
                <strong>Con chi </strong>
                <span id="who">
                     <?php
                     if (isset($_SESSION['products'])):
                         $i = 0;
                         foreach ($_SESSION['products'] as $product):
                             if ($i > 0)
                                 break;
                             ?>
                             <?php echo $product["ressourceName"] ?>
                             <?php
                             $i++;
                         endforeach;
                     endif;
                     ?>
                </span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
                <strong>Quando</strong>
                <span id="when">
                        <?php
                        if (isset($_SESSION['products'])):

                            $i = 0;
                            foreach ($_SESSION['products'] as $product):
                                if ($i > 0)
                                    break;
                                ?>
                                <?php echo $product["slotTime"] ?>
                                <?php
                                $i++;
                            endforeach;
                        endif;
                        ?>
                    </span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
                <span><strong>Totale</strong></span>
                <span id="cartTotal">
                         <?php
                         if (isset($_SESSION['products'])):

                             $total = 0;
                             foreach ($_SESSION['products'] as $product):
                                 $total += $product['product_price'] * $product['product_qty']; ?>
                             <?php
                             endforeach;
                             echo $total . " &euro;"; endif;
                         ?>
                    </span>
            </li>

        </ul>
        <?php
    } else {
        echo "Carrello è vuoto!";
    }
}


/**
 * Save cart to orders
 */
if (isset($_POST['save_to_db'])) {
//    var_dump($_SESSION["order_details"]);
    if ($_SESSION["order_details"]['customer'] == "")
        $_SESSION["order_details"]['customer'] = $_SESSION['memberID'];

    $order_details = $_SESSION["order_details"];
    echo $customerID = ($_SESSION["memberID"]);
//    var_dump($_SESSION["order_details"]);

// insert the new order to the DB
    $sql = 'INSERT INTO `orders`(
          `order_date`, 
          `start_time`, 
          `resource`, 
          `customer`, 
          `status`, 
          `note`)    VALUES (
                    :order_date ,     
                    :start_time ,   
                    :resource ,    
                    :customer ,   
                    :status ,     
                    :note )';
    $statement = $pdo->prepare($sql);

    $statement->bindParam(":order_date", $order_details['date']);
    $statement->bindParam(":start_time", $order_details['slotTime']);
    $statement->bindParam(":resource", $order_details['ressource']);
    $statement->bindParam(":customer", $order_details['customer']);
    $statement->bindParam(":status", $order_details['status']);
    $statement->bindParam(":note", $order_details['note']);
    $statement->execute();
    if ($lastInsertedId = $pdo->lastInsertId()) {

        $products = $_SESSION['products'];


        $sql = 'INSERT INTO `order_details`(
          `order_id`, 
          `product_id`, 
          `product_quantity`) ';
        $values = "";
        $productNbr = count($products);
        $i = 1;
        foreach ($products as $key => $product) {
            $values .= "( '"
                . $lastInsertedId . "' , '"
                . $product['id_product'] . "' , '"
                . $product['product_qty'] . "' 
                   )  ";
            if ($i < $productNbr)
                $values .= " , ";
            $i++;
        }
        echo$sql .= " VALUES " . $values;
        $statement = $pdo->prepare($sql);
        if ($statement->execute()) {
            echo $pdo->lastInsertId();
            die();
            //unset($_SESSION['products']);
            //echo json_encode(true);
        }
    } else
        echo json_encode(false);
}