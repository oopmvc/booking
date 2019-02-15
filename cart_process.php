<?php

include_once 'includes/connection.php'; //include config file
setlocale(LC_MONETARY, "it_IT"); // IT national format (see : http://php.net/money_format)
    /**
    * Check for time slot availability
    */
    if (isset($_POST['checkTimeSlot'])) {
        $formattedDate = date('Y-m-d', strtotime($_POST['datepicker']));
        $sql = "SELECT start_time FROM orders WHERE order_date = :order_dateValue AND resource = :resource";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":order_dateValue", $_POST['datepicker']);
        $statement->bindParam(":resource", $_POST['resource']);

        $statement->execute();
        $statement->rowCount();

        if ($statement->rowCount() > 0) {
            echo json_encode($statement->fetchAll());
        } else {
            echo 0;
        }

    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    /** add products to session */
    if (isset($_POST['products_selection'])) {
        //    check if date is available
        $products = json_decode($_POST['products_selection']);
        foreach ($products as $product) {
            $new_product['product_id'] = $product->product_id; //fetch product name from database
            $new_product['product_name'] = $product->name; //fetch product name from database
            $new_product['product_price'] = $product->price;  //fetch product price from database
            $new_product['product_qty'] = $product->qty;  //fetch product price from database
            $new_product['resource'] = $_POST['resource'];  //fetch product price from database
            $new_product['resourceName'] = $_POST['resourceName'];  //fetch product price from database
            $new_product['date'] = $_POST['datepicker'];  //fetch product price from database
            $new_product['slotTime'] = $_POST['slotTime'];  //fetch product price from database

            if (isset($_SESSION['products'])) { //if session var already exist

                if (isset($_SESSION['products'][$new_product['product_id']])) { //check item exist in products array
                    unset($_SESSION['products'][$new_product['product_id']]); //unset old item
                }
            }
            /**
            * store information for order : customer / starttime / resource /  order_date
            * This data will be saved to order table
            * Information about the order details will be stored
            * inside orders_details table
            */
            if (isset($_SESSION["order_details"])) {
                unset($_SESSION["order_details"]);
            }
            $_SESSION["order_details"] = array(
                "customer" => isset($_SESSION["memberID"]) ? $_SESSION["memberID"] : "",
                "resource" => $_POST['resource'],
                "date" => $_POST['datepicker'],
                "slotTime" => $_POST['slotTime'],
            );

            $_SESSION['resourceName'] = $new_product['resourceName']; //update products with new item array
            $_SESSION['products'][$product->product_id] = $new_product; //update products with new item array
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
                <strong>Cosa: </strong>
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
                                        (Qta:<?php echo $product["product_qty"] ?>)
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
                                if ($i > 0) {
                                    break;
                                }

                                ?>
                                <?php echo $_POST["resourceName"]; ?>
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
                                if ($i > 0) {
                                    break;
                                }

                                ?>
                                <?php echo $product["slotTime"]; ?>
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
                                $total += $product['product_price'] * $product['product_qty'];?>
                                <?php
                            endforeach;
                            echo $total . " &euro;";endif;
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
                                            if ($i > 0) {
                                                break;
                                            }

                                            ?>
                                            <?php echo $product["resourceName"] ?>
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
                                            if ($i > 0) {
                                                break;
                                            }

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
                                            $total += $product['product_price'] * $product['product_qty'];?>
                                            <?php
                                        endforeach;
                                        echo $total . " &euro;";endif;
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
                                                            (Quantità:<?php echo $product["product_qty"] ?>)
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
                                                    if ($i > 0) {
                                                        break;
                                                    }

                                                    ?>
                                                    <?php echo $product["resourceName"] ?>
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
                                                    if ($i > 0) {
                                                        break;
                                                    }

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
                                                    $total += $product['product_price'] * $product['product_qty'];?>
                                                    <?php
                                                endforeach;
                                                echo $total . " &euro;";endif;
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

                                if ($_SESSION["order_details"]['customer'] == "") {
                                    $_SESSION["order_details"]['customer'] = $_SESSION['memberID'];
                                }

                                $order_details = $_SESSION["order_details"];
                                $customerID = ($_SESSION["memberID"]);

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

                                        $order_date = DateTime::createFromFormat('j-m-Y', $order_details['date']);
                                        $order_date = $order_date->format('Y-m-d');
                                        $statement->bindParam(":order_date", $order_date);
                                        $statement->bindParam(":start_time", $order_details['slotTime']);
                                        $statement->bindParam(":resource", $order_details['resource']);
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
                                                    . $product['product_id'] . "' , '"
                                                    . $product['product_qty'] . "'
                                                    )  ";
                                                    if ($i < $productNbr) {
                                                        $values .= " , ";
                                                    }

                                                    $i++;
                                                }
                                                $sql .= " VALUES " . $values;
                                                $statement = $pdo->prepare($sql);
                                                if ($statement->execute()) {
                                                    $pdo->lastInsertId();
                                                    //send email to customer
                                                    $resourceName = "";
                                                    $requested_product = "<b>prodotti</b><br><ul>";
                                                    foreach ($_SESSION['products'] as $value) {
                                                        $resourceName = $value['resourceName'];
                                                        $requested_product .= " " . $value['product_name'] . " prezzo " . $value['product_price'] . "&euro;.";
                                                    }

                                                    $subject = "Conferma della Prenotazione";

                                                    $body = "Ricevi questa e-mail a seguito della tua prenotazione. "
                                                    . " Giorno: "        . $order_details['date']
                                                    . " Ora: "           . $order_details['slotTime']
                                                    . " Collaboratore: " . $resourceName
                                                    . " Servizi: "       . $requested_product;

                                                    $body .= $requested_product;

                                                    if ($order_details['note'] != "") {
                                                        $body .= " Commento: " . $order_details['note'] . " ";
                                                    }

                                                    $to = $_SESSION['user_email'];
                                                    $from = "From: " . SITEEMAIL;
                                                    mail($to, $subject, $body, $from);

                                                    unset($_SESSION['products']);

                                                    echo json_encode(true);

                                                    // send SMS booking details
                                                    curl "https://platform.clickatell.com/messages/http/send?apiKey=WXxMXbVwRS6fjEFbyCrwjw==&to=393472295261&content=" . $body;
                                                }
                                            } else {
                                                echo json_encode(false);
                                            }

                                        }

                                        /**
                                        * Get order details
                                        */

                                        if (isset($_POST["order_id"])) {
                                            $sql = "SELECT * FROM order_details left join products on (products.id_product = order_details.product_id) WHERE order_id = :order_id ";
                                            $statement = $pdo->prepare($sql);
                                            $statement->bindParam(":order_id", $_POST['order_id']);
                                            $statement->execute();
                                            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            $json = json_encode($results);
                                            echo $json;
                                        }
