<?php
require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');
$userType = $_SESSION['type'];
$customerID = $_SESSION["memberID"];
?>


<div class="container-fluid">
    <div class="row">

        <?php include(__DIR__ . '/templates/dashboard-sidebar.html.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-4">

            <?php

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                try {

                    $customerID = $_SESSION['memberID'];

                    $sql = "INSERT INTO `orders`(`order_date`, `start_time`, `resource`, `customer`)
                    VALUES (:order_date, :start_time, :resource, :customer)";

                    $statement = $pdo->prepare($sql);

                    $order_date = date('d-m-Y', strtotime($_POST['date']));

                    $statement->bindParam(":order_date", $order_date);
                    $statement->bindParam(":start_time", $_POST['slotTime']);
                    $statement->bindParam(":resource", $_POST['resource']);
                    $statement->bindParam(":customer", $customerID);
                    $statement->execute();

                    if ($lastInsertedId = $pdo->lastInsertId()) {

                        $products = $_POST['product'];

                        $sql = "INSERT INTO `order_details`( `order_id`, `product_id`, `product_quantity`)";

                        $values = "";

                        // $productNbr = count($products);
                        // $i = 1;

                        // foreach ($products as $key => $product) {
                        //     $values .= "( '"
                        //     . $lastInsertedId . "' , '"
                        //     . $product['product_id'] . "' , '"
                        //     . $product['product_qty'] . "'
                        //     )  ";
                        //     if ($i < $productNbr)
                        //     $values .= " , ";
                        //     $i++;
                        // }

                        //////////////////////////////////////////////////////////////////////////////////////
                        // todo insert OrderDetails only if Quantity > 0
                        //////////////////////////////////////////////////////////////////////////////////////
                        $productBuyed = 0;
                        foreach ($products as $key => $product) {
                            if($product['product_qty'] > 0) {
                                $productBuyed += 1;
                            }
                        }

                        $i = 1;

                        foreach ($products as $key => $product) {

                            if ($product['product_qty'] > 0) {
                                echo 'qty: ' . $product['product_qty'] . '<br>';
                                $values .= "( '"
                                    . $lastInsertedId . "' , '"
                                    . $product['product_id'] . "' , '"
                                    . $product['product_qty'] . "'
                                )";
                            }

                            if ($i < $productBuyed) {
                                $values .= ",";
                            }

                            $i++;

                        }

                        $sql .= " VALUES " . $values . ';';
                        echo 'query: ' . $sql . '<br>';
                        $statement = $pdo->prepare($sql);
                        if ($statement->execute()) {
                            echo "<br><div class='alert alert-success'>Prenotazione salvata correttamente</div>";
                        }
                    } else
                    echo "<br><div class='alert alert-danger'>La prenotazione non è stata salvata correttamente</div>";

                } // show error
                catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }

            }
            ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Nuova Prenotazione</h1>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="start">Con chi?</label>
                    <?php

                    // Attempt select query execution
                    $sql_resource = "SELECT * FROM resources";

                    if ($result_resource = $pdo->query($sql_resource)) {
                        if ($result_resource->rowCount() > 0) {
                            echo "<select class='custom-select d-block w-100' id='resource' required>";
                            while ($row_resources = $result_resource->fetch()) {
                                echo "<option value='" . $row_resources['id_resource'] . ' ' . $row_resources['last_name'] . "'>" . $row_resources['first_name'] . ' ' . $row_resources['last_name'] . "</option>";
                            }
                            echo "</select>";

                            // Free result set
                            unset($row_resource);
                        } else {
                            echo "<p class='lead'><em>Nessun collaboratore trovato.</em></p>";
                        }
                    } else {
                        echo "ERROR: Non posso eseguire la richiesta $sql_resource. " . mysqli_error($link);
                    }

                    // Close connection
                    ?>
                </div>
                <div class="form-group">
                    <label for="start">Quando?</label><br>
                    <input type="text" id="datepicker" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="start">A che ora?</label>

                    <?php

                    //include('opening-time-hour.php');

                    // echo '<select class="form-control" id="slot_time" name="slot_time">';
                    echo "<select class='custom-select d-block w-100' name='slot_time' required>";
                    $sql = "SELECT * FROM slot_time ORDER BY start_slot ASC;";
                    $result_slot_time = $pdo->query($sql);
                    while ($row_slot_time = $result_slot_time->fetch()) {
                        echo '<option value="' . $row_slot_time['start_slot'] . '">' . $row_slot_time['start_slot'] . "</option>";
                    }
                    echo '</select>';
                    ?>

                </div>
                <div class="form-group">
                    <label for="start">Cliente</label>

                    <?php
                    if ($_SESSION['type'] != 1) :
                        ?>
                        Voi
                        <input type="text" id="customer" class="form-control" value="<?php echo $customerID; ?>">
                        <?php
                    else:
                        // get all users
                        $sql = "select * from members ";
                        $result_resource = $pdo->query($sql);
                        echo "<select class='custom-select d-block w-100' name='customer' required>";
                        while ($row_resources = $result_resource->fetch()) {
                            echo "<option value='" . $row_resources['id_resource'] .  "'>" . $row_resources['first_name'] . ' ' . $row_resources['last_name'] . "</option>";
                        }
                        echo "</select>";
                    endif; ?>
                </div>
                <?php

                $sql = "SELECT * FROM products ORDER BY name";
                if ($result = $pdo->query($sql)) {
                    if ($result->rowCount() > 0) {
                        ?>
                        <div class='table-responsive'>
                            <table class='table table-striped table-md'>
                                <thead>
                                    <tr>
                                        <th>Prodotto</th>
                                        <th>Quantità</th>
                                        <th>Prezzo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $result->fetch()) {
                                        $index = $row['id_product'];
                                        echo '
                                        <tr>
                                        <td><strong>' . $row['name'] . ' </strong>
                                        <input class="d-none" name="product[' . $row['id_product'] . '][product_id]" type="hidden" value="' . $row['id_product'] . '">' . '
                                        <div style="max-width: 300px;">(' . $row['time'] . ' minuti)</div>
                                        </td>
                                        <td>
                                        <select class="custom-select d-block w-100"
                                        data-price="' . $row['price'] . '"
                                        data-value="' . $index . '"
                                        data-name="' . $row['name'] . '"
                                        name="product[' . $row['id_product'] . '][product_qty]">
                                        <option value="">Persone</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        </select>
                                        </td>
                                        <td><strong>' . $row['price'] . ' € </strong></td>
                                        </tr>
                                        ';
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="form-group">
                    <input type="submit" value="Salva" class="btn btn-primary"/>
                </div>
            </form>
        </main>
    </div>
</div>

<?php unset($pdo); ?>

<?php include('footer.php'); ?>
