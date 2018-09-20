<?php
require('includes/connection.php');
include('header.php');
?>



<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="pt-4">Sistema di prenotazione</h1>
            <p class="lead mb-5">Da oggi puoi prenotare i nostri servizi ovunque tu sia.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3"><span class="bg-dark">1</span> Scegli uno o più servizi</h4>

            <div class="needs-validation">

                <!-- STEP 1: scegli servizi -->
                <?php

                // Attempt select query execution
                $sql = "SELECT * FROM products ORDER BY name";
                if($result = $pdo->query($sql)) {
                    if($result->rowCount() > 0) {

                        // echo "<table class='table'>";
                        //     echo "<tbody>";
                        //     while($row = $result->fetch()) {
                        //         echo "<tr>";
                        //             echo "<td class='d-none'><input name='id_product' type='hidden' value='" . $row['id_product'] . "'>" . $row['id_product'] . "</td>";
                        //             echo "<td><strong>" . $row['name'] . " " . $row['price'] . " € </strong><br>" . $row['description'] . " (" . $row['time'] . " minuti)</td>";
                        //             echo "<td><button class='btn btn-md btn-success' type='submit'>Aggiungi</button></td>";
                        //         echo "</tr>";
                        //     }
                        //     echo "</tbody>";
                        // echo "</table>";

                        while($row = $result->fetch()) {
                            echo '
                                <form class="form-item">
                                    <div class="row pb-5">
                                        <div class="col-lg-8">
                                            <input class="d-none" name="id_product" type="hidden" value="' . $row['id_product'] . '">' . '
                                              <strong>' . $row['name'] . ' ' . $row['price'] . ' € </strong><br>' . $row['description'] . ' (' . $row['time'] . ' minuti)
                                        </div>
                                        <div class="col-lg-2">
                                            <select class="custom-select d-block w-100" name="quantity" required>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <button class="btn btn-md btn-success" type="submit">Aggiungi</button>
                                        </div>
                                    </div>
                                </form>
                            ';
                        }
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
                <h4 class="pt-4 mb-4"><span class="bg-dark">2</span> Scegli con chi</h4>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="country">Scegli con chi</label>

                        <?php

                        // Attempt select query execution
                        $sql_resource = "SELECT * FROM resources";

                        if($result_resource = $pdo->query($sql_resource)) {
                            if($result_resource->rowCount() > 0) {
                                echo "<select class='custom-select d-block w-100' id='resource' required>";
                                while($row_resources = $result_resource->fetch()) {
                                    echo "<option value='" . $row_resources['first_name'] . ' ' . $row_resources['last_name'] .  "'>" . $row_resources['first_name'] . ' ' . $row_resources['last_name'] . "</option>";
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
                        <input type="text" id="datepicker" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slot_time">Fascia oraria</label>

                        <?php

                        // Attempt select query execution
                        $sql = "SELECT * FROM slot_time";

                        if($result = $pdo->query($sql)) {
                            if($result->rowCount() > 0) {
                                echo "<select class='custom-select d-block w-100' id='slot_time' required>";
                                while($row = $result->fetch()){
                                    $from = substr($row['start_slot'],0,5);
                                    $to = substr($row['end_slot'],0,5);
                                    if($row['start_slot'] >= date("H:i:s")) {
                                        echo "<option value='" . $row['start_slot'] . ' ' . $row['end_slot'] .  "'>" . $from . ' - ' . $to . "</option>";
                                    }
                                }
                                echo "</select>";

                                // Free result set
                                unset($row);
                            } else {
                                echo "<p class='lead'><em>Nessun collaboratore trovato.</em></p>";
                            }
                        } else {
                            echo "ERROR: Non posso eseguire la richiesta " . $sql . mysqli_error($link);
                        }

                        // Close connection
                        //unset($pdo);
                        ?>

                    </div>
                </div>
                <!-- END STEP 3: scegli con chi -->

                <button class="mt-4 mb-5 btn btn-lg btn-block btn-danger" type="submit">Prenota ora</button>
            </div>
        </div>



        <!-- BEGIN carrello -->

        <div class="col-md-4 order-md-2 mb-4">
            <!-- <h4 class="mb-3">Orari di apertura</h4>
            <hr class="mb-4">
            <ul style="list-style:none; padding:0px;">
                <li><strong>Lun</strong> CHIUSO </li>
                <li><strong>Mar</strong> 8.00 - 13.20 / 15.10 - 20.30</li>
                <li><strong>Mer</strong> 8.00 - 13.20 / 15.10 - 20.30</li>
                <li><strong>Gio</strong> 8.00 - 13.20 / 15.10 - 20.30</li>
                <li><strong>Ven</strong> 8.00 - 13.20 / 15.10 - 20.30</li>
                <li><strong>Sab</strong> 8.00 - 20.30</li>
                <li><strong>Dom</strong> CHIUSO</li>
            </ul>
            <hr class="mb-4"> -->
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span>La tua prenotazione</span>  <!--class="text-muted"-->
                <span class="badge badge-secondary badge-pill">
                    <i class="fa fa-shopping-cart fa-1x openCloseCart" aria-hidden="true"></i>
                    <?php
                    if(isset($_SESSION['products'])) {
                        echo count($_SESSION["products"]);
                    } else {
                        echo 0;
                    }
                    ?>
                </span>
            </h4>



            <ul class="list-group mb-3">

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <strong>Cosa</strong>

                    <div class="shopping-cart-box">
                        <a href="#" class="close-shopping-cart-box" >Chiudi</a>
                        <h3>Carrello</h3>
                        <div id="shopping-cart-results">
                        </div>
                    </div>
                    <!-- <div id="cartItems">
                        <h6 class="my-0">Product name</h6>
                        <small class="text-muted">Product description</small>
                    </div> -->
                    <span class="text-muted"></span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <strong>Con chi</strong>
                    <span id="who"></span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <strong>Quando</strong>
                    <span id="when"></span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span><strong>Totale</strong></span>
                    <span id="cartTotal"></span>
                </li>

            </ul>
            <button type="submit" class="btn btn-lg btn-block btn-danger">Prenota ora</button>
            <hr>
            <div id="cart-container">
                <div id="cart">
                    <i class="fa fa-shopping-cart fa-2x openCloseCart" aria-hidden="true"></i>
                </div>
                <span id="itemCount"></span>
            </div>

        </div>
        <!-- END carrello -->

    </div>
</div>



<?php include('footer.php'); ?>
