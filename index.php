<?php
require('includes/connection.php');
include('header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2">
            <h1 class="pt-4">Sistema di prenotazione</h1>
            <p class="lead mb-5">Da oggi puoi prenotare i nostri servizi ovunque tu sia.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 order-md-1">
            <h4 class="mb-3"><span class="bg-dark">1</span> Scegli uno o più servizi</h4>

            <div class="needs-validation">
                <!-- STEP 1: scegli servizi -->
                <?php
                // Attempt select query execution
                $sql = "SELECT * FROM products ORDER BY name";
                if ($result = $pdo->query($sql)) {
                    if ($result->rowCount() > 0) {
                        echo '<form class="form-item" name="reservation-form" >';
                        while ($row = $result->fetch()) {
//                            var_dump($row);
                            $index = $row['id_product'];
                            echo '
                                    <div class="row pb-5">
                                        <div class="col-lg-9 col-md-6 pb-3">
                                            <input class="d-none" name="product" type="hidden" value="' . $row['id_product'] . '">' . '
                                              <strong>' . $row['name'] . ' ' . $row['price'] . ' € </strong><br>' . $row['description'] . ' (' . $row['time'] . ' minuti)
                                        </div>
                                        <div class="col-lg-3 col-xs-6">
                                            <select class="custom-select d-block w-100"
                                             data-price="'. $row['price']  .'"
                                             data-value="' . $index . '"
                                             data-name="'. $row['name'] .'"
                                             name="qty" required>
                                                <option value="">Persone</option>
                                                <option  value="1">1</option>
                                                <option  value="2">2</option>
                                                <option  value="3">3</option>
                                                <option  value="4">4</option>
                                                <option  value="5">5</option>
                                            </select>
                                        </div>
                                    </div>

                            ';
                        }
                        echo '</form>';
                        // Free result set
                        unset($result);
                    } else {
                        echo "<p class='lead'><em>Nessun servizio trovato.</em></p>";
                    }
                } else {
                    echo "ERRORE: Non posso eseguire la richiesta " . $sql . mysqli_error($link);
                }
                ?>
                <!-- END STEP 1: scegli servizi -->


                <!-- BEGIN STEP 2: scegli con chi -->
                <h4 class="pt-4 mb-4" id="ressroucesSelection"><span class="bg-dark">2</span> Scegli con chi</h4>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="country">Scegli con chi</label>

                        <?php

                        // Attempt select query execution
                        $sql_resource = "SELECT * FROM resources";

                        if ($result_resource = $pdo->query($sql_resource)) {
                            if ($result_resource->rowCount() > 0) {
                                echo "<select class='custom-select d-block w-100' onchange='fetchDateAvailability()' id='resource' required>";
                                while ($row_resources = $result_resource->fetch()) {
                                    echo "<option value='" . $row_resources['id_resource'] . "'>" . $row_resources['first_name'] . ' ' . $row_resources['last_name'] . "</option>";
                                }
                                echo "</select>";

                                // Free result set
                                unset($row_resource);
                            } else {
                                echo "<p class='lead'><em>Nessun collaboratore trovato.</em></p>";
                            }
                        } else {
                            echo "ERROR: Non posso eseguire la richiesta " . $sql_resource . mysqli_error($link);
                        }

                        ?>

                    </div>
                </div>
                <!-- END STEP 2: scegli con chi -->


                <!-- BEGIN STEP 3: scegli quando -->
                <h4 class="pt-4 mb-4"><span class="bg-dark">3</span> Scegli quando</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date">Giorno</label>
                        <input type="text" id="datepicker" class="form-control" onchange="fetchDateAvailability()">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slot_time">Fascia oraria</label>

                        <?php
                        echo '<select disabled  class="custom-select d-block w-100"  id="timeSlotSelection" >';
                        require 'opening-time-hour.php';
                        echo '</select>';
                        ?>

                    </div>
                </div>
                <!-- END STEP 3: scegli con chi -->

                <!-- <button class="mt-4 mb-5 btn btn-lg btn-block btn-danger" type="button"
                        onclick="submitProductRequets()">Prenota ora
                </button> -->

                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span>La tua prenotazione</span>  <!--class="text-muted"-->
                    <span class="badge badge-secondary badge-pill">

                        <a href="#" class="cart-box" id="cart-info" title="Vedi carrello">
                            <?php
                            if (isset($_SESSION['products'])):
                                if (isset($_SESSION['products'])) {
                                    echo count($_SESSION["products"]);
                                } else {
                                    echo 0;
                                } endif;

                            ?>
                    </a>
                    </span>

                    </h4>
                    <div id="cartResumer">
                        <ul id="LastActionOncartResume"></ul>
                    </div>
                    <!-- <button type="submit" class="btn btn-lg btn-block btn-danger">Prenota ora</button> -->
                    <a onclick="submitProductRequets()" href="view_cart.php" class="btn btn-lg btn-block btn-danger">Conferma</a>

                </div>
                <!-- END carrello -->

            </div>
        </div>


    </div>
    <?php include('footer.php'); ?>
