<?php
//require_once('routes.php');
//
// function __autoload($class_name) {
//
//     if(file_exists('./classes/' . $class_name . '.php')){
//         require_once './classes/' . $class_name . '.php';
//     } else if(file_exists('./controllers/' . $class_name . '.php')) {
//         require_once './controllers/' . $class_name . '.php';
//     }
//
// }

require 'includes/connection.php';
include 'header.php';
?>

<div id="wrapper">

    <div id="content-wrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-6 col-md-12 col-sm-12 offset-lg-3 offset-md-0">

                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Prenotazione</li>
                    </ol>

                    <h1>Sistema di Prenotazione</h1>
                    <span>Da oggi puoi prenotare ovunque tu sia.</span>
                    <hr> <div class="mb-5"></div>

                    <h4 class="mb-3">
                        <span class="bg-dark">1</span> Scegli uno o più servizi
                    </h4>

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
                                    data-price="' . $row['price'] . '"
                                    data-value="' . $index . '"
                                    data-name="' . $row['name'] . '"
                                    name="qty" required>
                                    <option value="">Persone</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
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
                        <h4 class="pt-4 mb-4" id="resourcesSelection"><span class="bg-dark">2</span> Scegli con chi</h4>
                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <label for="country">Scegli con chi</label>

                                <?php

                                // Attempt select query execution
                                $sql_resource = "SELECT * FROM resources";

                                if ($result_resource = $pdo->query($sql_resource)) {
                                    if ($result_resource->rowCount() > 0) {
                                        echo "<select class='custom-select d-block w-100' onchange='fetchDateAvailability()' id='resource' required>";
                                        echo "<option value=''>" . ' - ' . "</option>";
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
                            <div class="col-md-6 mb-5">
                                <label for="datepicker">Giorno</label>
                                <input type="text" id="datepicker" class="form-control" onchange="fetchDateAvailability()">
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="slot_time">Fascia oraria</label>

                                <?php
                                echo '<select id="timeSlotSelection" class="custom-select d-block w-100" onchange="fetchDateAvailability()">';
                                require 'opening-time-hour.php';
                                echo '</select>';
                                ?>

                            </div>
                        </div>
                        <!-- END STEP 3: scegli con chi -->

                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span>La tua prenotazione</span>
                        </h4>
                        <div id="cartResumer">
                            <ul id="LastActionOncartResume"></ul>
                        </div>
                        <!-- <button type="submit" class="btn btn-lg btn-block btn-danger">Prenota ora</button> -->
                        <a onclick="submitProductRequest()" href="view_cart.php" class="btn btn-lg btn-block btn-danger mb-5">Conferma</a>

                        </div>
                        <!-- END carrello -->

                    </div>

                </div><!-- END col -->

            </div><!-- END row -->

        </div><!-- END container-fluid -->

    </div><!-- END content-wrapper -->

</div><!-- END wrapper -->

<?php include 'footer.php';?>
